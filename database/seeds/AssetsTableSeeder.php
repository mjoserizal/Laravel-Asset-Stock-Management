<?php

use App\Asset;
use App\Team;
use Illuminate\Database\Seeder;

/**
 * Class AssetsTableSeeder
 */
class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $assets = [
            'Neuralgin',
            'Emturnas 650 mg',
            'Farsifen/ Ibuprofen 400 mg',
            'Meloxicam 7,5 mg',
            'Sanmol 500 mg',
            'Puricemia 300 mg',
            'Buscopan 10 mg',
            'Analsik',
            'Cefadroxil 500 mg',
            'Baquinor 500 mg',
            'Taxime/ Cefixime 100mg',
            'Ethlychloride Spray 100 ml',
            'Handsaplast Wound Care 20 gr',
        ];

        foreach ($assets as $asset) {
            Asset::factory()->create([
                'name' => $asset,
                'description' => $asset,
                'id_jenis_obat' => 1,
                'suhu' => 37,
            ]);
        }
    }
}
