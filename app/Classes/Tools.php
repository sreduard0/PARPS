<?php
namespace App\Classes;

use App\Models\RecordsModel;

class Tools
{
    //=================================== Visitantes do dia =======================================
    function visitors_day()
    {
        return RecordsModel::where('date_entrance', date('Y-m-d h:m'))->get();
    }
    //=================================== Visitantes na OM ========================================
    function visitors_on_here()
    {
        return RecordsModel::all();
    }
}
