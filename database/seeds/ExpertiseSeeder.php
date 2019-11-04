<?php

use App\Expertise;
use Illuminate\Database\Seeder;

class ExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expertise::create(['description' => 'ALERGOLOGIA']);
        Expertise::create(['description' => 'ANGIOLOGIA']);
        Expertise::create(['description' => 'BUCO MAXILO']);
        Expertise::create(['description' => 'CARDIOLOGIA CLÍNICA']);
        Expertise::create(['description' => 'CARDIOLOGIA INFANTIL']);
        Expertise::create(['description' => 'CIRURGIA CABEÇA E PESCOÇO']);
        Expertise::create(['description' => 'CIRURGIA CARDÍACA']);
        Expertise::create(['description' => 'CIRURGIA DE CABEÇA/PESCOÇO']);
        Expertise::create(['description' => 'CIRURGIA DE TÓRAX']);
        Expertise::create(['description' => 'CIRURGIA GERAL']);
        Expertise::create(['description' => 'CIRURGIA PEDIÁTRICA']);
        Expertise::create(['description' => 'CIRURGIA PLÁSTICA']);
        Expertise::create(['description' => 'CIRURGIA TORÁCICA']);
        Expertise::create(['description' => 'CIRURGIA VASCULAR']);
        Expertise::create(['description' => 'CLÍNICA MÉDICA']);
    }
}
