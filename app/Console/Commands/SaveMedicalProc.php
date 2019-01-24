<?php

namespace App\Console\Commands;

use App\Jobs\SaveMedical;
use App\Medical;
use App\Repository\DataApi;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class SaveMedicalProc extends Command
{
    protected $signature = 'medical:reset';
    protected $description = 'Medical List Reset';

    private $service;

    public function handle()
    {
        $this->service = new DataApi();
        $this->command('pharmacy');
        $this->command('Hospital');
    }

    private function command($type)
    {
        $type = title_case($type);

        // All Clear
        $this->info("DB({$type}) Clear");
        Medical::where('type', $type)->delete();

        $this->info("Save {$type} : ");
        $info= $this->service->{"get".$type}();
        $totalPage = $info['totalPage'];
        $bar = $this->output->createProgressBar($totalPage);
        Collection::times($totalPage, function ($page) use ($bar, $type) {
            SaveMedical::dispatch($page, $type);
            $bar->advance();
        });

        $bar->finish();
    }
}
