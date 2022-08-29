<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\InsertIntoCarreras;


class executeInsertIntoCarreras extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carrera:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserta las carreras de sicoes en el protal';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new InsertIntoCarreras());
    }
}
