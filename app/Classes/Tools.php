<?php
namespace App\Classes;

use App\Models\RecordsModel;

class Tools
{
    //=================================== Visitantes do dia =======================================
    function visitors_day()
    {
        return RecordsModel::where('date_entrance', 'LIKE', date('Y-m-d') .'%')->get();
    }
    //=================================== Visitantes na OM ========================================
    function visitors_on_here()
    {
        return RecordsModel::where('status', 1)->get();
    }
}
