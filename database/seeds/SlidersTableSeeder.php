<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Corp\Slider::class, 3)->create()->each(function ($slide) {
            $slide->img = $slide->id . '.jpg';
            $slide->save();
        });
    }
}
