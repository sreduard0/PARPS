<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorsModel extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $primarykey = 'id';
}
