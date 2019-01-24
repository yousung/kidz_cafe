<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * @param       $query
     * @param       $lat    [좌표 lat]
     * @param       $lng    [좌표 lng]
     * @param float $km     [반경 km]
     * @return mixed
     */
    public function scopeDistance($query, $lat, $lng, $km = 0.5)
    {
        $haversine = "(6371 * acos(cos(radians($lat)) 
                     * cos(radians(lat)) 
                     * cos(radians(lng) 
                     - radians($lng)) 
                     + sin(radians($lat)) 
                     * sin(radians(lat))))";

        return $query
            ->select()
            ->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$km])
            ->orderBy('distance', 'asc');
    }
}
