<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'name' => 'Производитель:',
            'sort' => '5'
        ]);
        DB::table('properties')->insert([
            'name' => 'Гарантия производителя:',
            'sort' => '10'
        ]);
        DB::table('properties')->insert([
            'name' => 'Страна производства:',
            'sort' => '15'
        ]);
        DB::table('properties')->insert([
            'name' => 'Мощность:',
            'sort' => '20'
        ]);
        DB::table('properties')->insert([
            'name' => 'Объем отапливаемого помещения:',
            'sort' => '25'
        ]);
        DB::table('properties')->insert([
            'name' => 'Подвод воздуха:',
            'sort' => '30'
        ]);

        DB::table('properties')->insert([
            'name' => 'Длительность горения:',
            'sort' => '35'
        ]);
        DB::table('properties')->insert([
            'name' => 'Вторичный дожиг газов:',
            'sort' => '40'
        ]);
        DB::table('properties')->insert([
            'name' => 'Высота:',
            'sort' => '45'
        ]);
        DB::table('properties')->insert([
            'name' => 'Ширина:',
            'sort' => '50'
        ]);
        DB::table('properties')->insert([
            'name' => 'Длина:',
            'sort' => '55'
        ]);
        DB::table('properties')->insert([
            'name' => 'Глубина:',
            'sort' => '60'
        ]);
        DB::table('properties')->insert([
            'name' => 'Диаметр:',
            'sort' => '65'
        ]);
        DB::table('properties')->insert([
            'name' => 'Толщина:',
            'sort' => '70'
        ]);

        DB::table('properties')->insert([
            'name' => 'Размер:',
            'sort' => '75'
        ]);
        DB::table('properties')->insert([
            'name' => 'Длинна дров:',
            'sort' => '80'
        ]);
        DB::table('properties')->insert([
            'name' => 'Диаметр дымохода:',
            'sort' => '85'
        ]);
        DB::table('properties')->insert([
            'name' => 'Подключение дымохода:',
            'sort' => '90'
        ]);
        DB::table('properties')->insert([
            'name' => 'Объем:',
            'sort' => '95'
        ]);
        DB::table('properties')->insert([
            'name' => 'Материал:',
            'sort' => '100'
        ]);
        DB::table('properties')->insert([
            'name' => 'Варочная плита:',
            'sort' => '105'
        ]);
        DB::table('properties')->insert([
            'name' => 'Теплообменник:',
            'sort' => '110'
        ]);
        DB::table('properties')->insert([
            'name' => 'Топливо:',
            'sort' => '115'
        ]);

        DB::table('properties')->insert([
            'name' => 'Цвет:',
            'sort' => '120'
        ]);

        DB::table('properties')->insert([
            'name' => 'Облицовка:',
            'sort' => '125'
        ]);
        DB::table('properties')->insert([
            'name' => 'Вес:',
            'sort' => '130'
        ]);

    }
}
