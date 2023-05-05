<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function GetVisitorDetails()
    {
        date_default_timezone_set('Asia/Manila');

        $ip_address = $_SERVER['REMOTE_ADDR'];
        $visit_time = date('h:i:s');
        $visit_date = date('d-m-Y');

        $result = Visitor::insert([
            'ip_address' => $ip_address,
            'visit_time' => $visit_time,
            'visit_date' => $visit_date
        ]);

        return $result;
    }
}
