<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $labels = ['urgent', 'not urgent'];

        foreach ($labels as $label) {
            $newLabel = new Label();
            $newLabel->fill(['name' => $label]);
            $newLabel->save();
        }
    }
}
