<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeModel extends Model
{
    use HasFactory;
    protected $table = 'badge';
    protected $primarykey = 'id';
}
