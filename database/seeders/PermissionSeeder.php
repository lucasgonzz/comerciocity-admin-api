<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            [
                'es' => 'producto',
                'en' => 'product',
            ],
            [
                'es' => 'venta',
                'en' => 'sale',
            ],
        ];
        $scopes = [
            [
                'text'  => 'Listar',
                'slug'  => 'index',
            ],
            [
                'text'  => 'Crear',
                'slug'  => 'store',
            ],
            [
                'text'  => 'Actualizar',
                'slug'  => 'update',
            ],
            [
                'text'  => 'Eliminar',
                'slug'  => 'delete',
            ],
        ];
        foreach ($models as $model) {
            foreach ($scopes as $scope) {
                Permission::create([
                    'name'  => $scope['text'].' '.$model['es'],
                    'slug'  => $model['en'].'.'.$scope['slug'],
                ]);
            }
        }
    }
}
