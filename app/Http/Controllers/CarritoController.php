<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // 1. Mostrar el carrito del usuario actual
    public function index()
    {
        // Traemos los items del carrito junto con la información del producto
        $items = Auth::user()->carritos()->with('producto')->get();
        
        // Calculamos el total
        $total = $items->sum(function($item) {
            return $item->cantidad * $item->producto->precio;
        });

        return view('comercio.carrito', compact('items', 'total'));
    }

    // 2. Añadir un producto al carrito
    public function add(Request $request, Producto $producto)
    {
        $user = Auth::user();

        // Verificamos si el producto ya está en el carrito
        $carrito = Carrito::where('user_id', $user->id)
                          ->where('producto_id', $producto->id)
                          ->first();

        if ($carrito) {
            // Si ya existe, sumamos 1 a la cantidad
            $carrito->cantidad += 1;
            $carrito->save();
        } else {
            // Si no existe, creamos el registro
            Carrito::create([
                'user_id' => $user->id,
                'producto_id' => $producto->id,
                'cantidad' => 1
            ]);
        }

        return redirect()->route('comercio.index')->with('success', 'Producto añadido al carrito.');
    }

    // 3. Eliminar un producto del carrito
    public function remove(Carrito $carrito)
    {
        // Por seguridad, verificamos que el item pertenezca al usuario autenticado
        if ($carrito->user_id === Auth::id()) {
            $carrito->delete();
        }

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }

    // 4. Solicitar aprobación (Checkout)
    public function checkout(Request $request)
    {
        // 1. Validar los datos de pago y envío
        $request->validate([
            'numero_tarjeta' => 'required|string|min:13|max:19',
            'mes_expiracion' => 'required|digits:2',
            'anio_expiracion' => 'required|digits:4',
            'cvv' => 'required|digits_between:3,4',
            'tipo_envio' => 'required|in:tienda,domicilio',
            'direccion_envio' => 'required_if:tipo_envio,domicilio|nullable|string|max:500',
        ], [
            'numero_tarjeta.required' => 'El número de tarjeta es obligatorio.',
            'cvv.required' => 'El código de seguridad CVV es obligatorio.',
            'direccion_envio.required_if' => 'Debes especificar una dirección para el envío a domicilio.'
        ]);

        $user = Auth::user();
        $items = $user->carritos()->with('producto')->get();

        if ($items->isEmpty()) {
            return redirect()->route('carrito.index')->withErrors(['error' => 'Tu carrito está vacío.']);
        }

        $total = $items->sum(function($item) {
            return $item->cantidad * $item->producto->precio;
        });

        // 2. Seguridad PCI-DSS: NUNCA guardamos la tarjeta completa ni el CVV.
        // Solo guardamos los últimos 4 dígitos para referencia.
        $ultimos_digitos = substr($request->numero_tarjeta, -4);

        // Generamos la orden con estado 'pendiente'
        Orden::create([
            'user_id' => $user->id,
            'estado' => 'pendiente',
            'total' => $total,
            'metodo_pago' => 'tarjeta_simulada',
            'ultimos_digitos_tarjeta' => $ultimos_digitos,
            'tipo_envio' => $request->tipo_envio,
            'direccion_envio' => $request->tipo_envio === 'domicilio' ? strip_tags($request->direccion_envio) : null
        ]);

        // Vaciamos el carrito del usuario
        Carrito::where('user_id', $user->id)->delete();

        return redirect()->route('carrito.mis_compras')->with('success', '¡Pago procesado (simulado) y solicitud enviada! Un técnico revisará tu compra pronto.');
    }

    // 5. Historial de Compras del Cliente
    public function misCompras()
    {
        // Traemos las órdenes del usuario, ordenadas por la más reciente
        $ordenes = Auth::user()->ordenes()->orderBy('created_at', 'desc')->get();
        return view('comercio.mis_compras', compact('ordenes'));
    }
}