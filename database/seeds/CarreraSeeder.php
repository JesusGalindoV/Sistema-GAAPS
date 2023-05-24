<?php

use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! DB::table('carrera')->count() ) 
        {
            DB::table('carrera')->insert([
                'CarreraId' => '1',
                'Clave' => '01',
                'Nombre' => 'LICENCIATURA EN BIOLOGÍA',
                'Abreviatura' => 'LB',
                'DivisionId' => '3',
                'is_activa' => '1',
                'precio' => '1950',
            ]);

            DB::table('carrera')->insert([
                'CarreraId' => '2',
                'Clave' => '02',
                'Nombre' => 'INGENIERÍA INDUSTRIAL EN PRODUCTIVIDAD Y CALIDAD',
                'Abreviatura' => 'IIPC',
                'DivisionId' => '1',
                'is_activa' => '1',
                'precio' => '1950',
            ]);

            DB::table('carrera')->insert([
                'CarreraId' => '3',
                'Clave' => '03',
                'Nombre' => 'LICENCIATURA EN ADMINISTRACIÓN Y EVALUACIÓN DE PROYECTOS',
                'Abreviatura' => 'LAEP',
                'DivisionId' => '2',
                'is_activa' => '1',
                'precio' => '1950',
            ]);

            DB::table('carrera')->insert([
                'CarreraId' => '4',
                'Clave' => '04',
                'Nombre' => 'INGENIERÍA EN SISTEMAS COMPUTACIONALES',
                'Abreviatura' => 'ISC',
                'DivisionId' => '1',
                'is_activa' => '1',
                'precio' => '1950',
            ]);

            DB::table('carrera')->insert([
                'CarreraId' => '5',
                'Clave' => '05',
                'Nombre' => 'LICENCIATURA EN TURISMO',
                'Abreviatura' => 'LAT',
                'DivisionId' => '2',
                'is_activa' => '1',
                'precio' => '1950',
            ]);

            DB::table('carrera')->insert([
                'CarreraId' => '6',
                'Clave' => '06',
                'Nombre' => 'LICENCIATURA EN ADMINISTRACIÓN (en linea)',
                'Abreviatura' => 'LATL',
                'DivisionId' => '2',
                'is_activa' => '1',
                'precio' => '1950',
            ]);

            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln("<info>carreras created</info>");
        }
        else
        {
        	$out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln("<warning>nothing to Seeder</warning>");
        }
    }
}
