<?php

use Illuminate\Database\Seeder;

class PortfoliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Corp\Portfolio::class, 8)->create()->each(function ($portfolio) {
            $portfolio->alias = $portfolio->alias . '-' . $portfolio->id;
            $portfolio->img = '{"mini":"' . $portfolio->id . '_mini.jpg","max":"' . $portfolio->id . '_max.jpg","path":"' . $portfolio->id . '.jpg"}';

            $portfolio->save();
        });
    }
}
