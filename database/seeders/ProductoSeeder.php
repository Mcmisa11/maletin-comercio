<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'Refresco Coca-Cola 2 Litros',
                'descripcion' => 'Gaseosa sabor original tamaño familiar.',
                'precio' => 13.00,
                'stock' => 24,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Galletas Wafer Mabel\'s',
                'descripcion' => 'Paquete de galletas con relleno sabor chocolate.',
                'precio' => 4.50,
                'stock' => 50,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Yogurt Pilfrut Durazno',
                'descripcion' => 'Bebida láctea refrescante en sachet.',
                'precio' => 1.50,
                'stock' => 100,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Fideos Lazzaroni',
                'descripcion' => 'Fideo corbatita en bolsa de 400g para sopa.',
                'precio' => 5.00,
                'stock' => 30,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Aceite Fino 900ml',
                'descripcion' => 'Aceite vegetal clásico para cocina.',
                'precio' => 11.00,
                'stock' => 15,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Caramelos Surtidos (100u)',
                'descripcion' => 'Bolsa de caramelos duros de frutas surtidas.',
                'precio' => 10.00,
                'stock' => 10,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Pan de Batalla',
                'descripcion' => 'Pan fresco horneado del día (precio por unidad).',
                'precio' => 0.50,
                'stock' => 150,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Sachet Mayonesa Kris',
                'descripcion' => 'Mayonesa clásica en sachet mediano.',
                'precio' => 2.50,
                'stock' => 40,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Papitas Fritas Lays',
                'descripcion' => 'Snack de papas fritas clásicas con sal.',
                'precio' => 6.00,
                'stock' => 25,
                'imagen_url' => null
            ],
            [
                'nombre' => 'Detergente OMO 500g',
                'descripcion' => 'Detergente en polvo multiuso para ropa.',
                'precio' => 8.50,
                'stock' => 20,
                'imagen_url' => null
            ]
        ];

        foreach ($productos as $prod) {
            Producto::create($prod);
        }
    }
}