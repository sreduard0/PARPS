<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordsModel extends Model
{
    public function visitor()
    {
        return $this->hasOne('App\Models\VisitorsModel', 'id', 'visitor_id')->with('enterprise');
    }

    public function destination()
    {
        return $this->hasOne('App\Models\DestinationModel', 'id', 'destination_id');
    }

    use HasFactory;
    protected $table = 'records';
    protected $primarykey = 'id';
}
