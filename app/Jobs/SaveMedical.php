<?php

namespace App\Jobs;

use App\Medical;
use App\Domain\MapMedical;
use App\Repository\DataApi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SaveMedical implements ShouldQueue
{
    use Dispatchable;

    private $page;
    private $type;

    public function __construct($page, $type)
    {
        $this->page = $page;
        $this->type = $type;
    }

    public function handle()
    {
        $item = (new DataApi())->{'get'.$this->type}($this->page);
        collect($item['items'])
            ->mapInto(MapMedical::class)
            ->each(function ($item) {
                $item->type = strtolower($this->type);
                $createData = collect($item)->toArray();
                if ($this->isSaveData($createData)) {
                    Medical::create($createData);
                }
            });
    }

    private function isSaveData($data)
    {
        if ($data['lat'] && $data['lng'] && $data['weekday_s'] && $data['weekday_e']) {
            return !Medical::where([
                'type' => $data['type'],
                'hpid' => $data['hpid'],
            ])->first();
        }

        return false;
    }
}
