<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('company_name', 'Empresa de lucas')->first();
        $models = [
            [
                'name'      => 'Telefono',
                'price'     => 3000,
                'is_good'   => 1,
                'user_id'   => $user->id,
            ],
            [
                'name'      => 'Computadora',
                'price'     => 5000,
                'is_good'   => 0,
                'user_id'   => $user->id,
            ],
        ];
        foreach ($models as $model) {
            Product::create($model);
        }
    }
}
