<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorsModel extends Model
{
    public function enterprise()
    {
        return $this->hasOne('App\Models\EnterpriseModel', 'id', 'enterprise_id');
    }
    use HasFactory;
    protected $table = 'visitors';
    protected $primarykey = 'id';
}
