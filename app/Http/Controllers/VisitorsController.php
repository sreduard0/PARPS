<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VisitorsModel;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    public function get_profile($id)
    {
        return VisitorsModel::with('enterprise')->find($id);
    }
}
