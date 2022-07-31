<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Sicoes\Carrera;
use App\Models\CarreraModel;

class InsertIntoCarreras implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(400);

        $obtenCarreras = Carrera::all();
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        foreach($obtenCarreras as $key => $item) {
            $nuevaCarrera = new CarreraModel();
            $nuevaCarrera->CarreraId = $item->CarreraId;
            $nuevaCarrera->Clave = $item->Clave;
            $nuevaCarrera->Nombre = $item->Nombre;
            $nuevaCarrera->Abreviatura = $item->Abreviatura;
            $nuevaCarrera->is_activa = 1;
            $nuevaCarrera->precio = getConfig()->price_inscription;
            $nuevaCarrera->save();

            $out->writeln("<info>Carrera ".$nuevaCarrera->Nombre." insertada exitosamente</info>");
        }
    }
}







