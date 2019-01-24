<?php

namespace App\Console\Commands;

use App\Service\LocalCafe;
use Illuminate\Console\Command;

class SaveKidzProc extends Command
{
    protected $signature = 'kidz:reset';
    protected $description = 'Kidz Cafe Reset';

    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new LocalCafe();
    }

    public function handle()
    {
        $this->info('SEOUL SAVE');
        $this->service->seoul();

        $this->info('KUNG-KI-DO SAVE');
        $this->service->kungkido();

        $this->info('KANG-WON-DO SAVE');
        $this->service->kangwondo();
    }
}
