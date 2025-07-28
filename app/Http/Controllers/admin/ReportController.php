<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function report(){
        // Logic for generating reports can be added here
        return view('admin.report.report');
    }

    public function orders(){
        // Logic for generating order reports can be added here
        return view('admin.report.__order_report');
    }

    public function income(){
        return view('admin.report.__income_report');
    }

    public function technicians(){
        return view('admin.report.__technician_performance_report');
    }

    public function popularServices(){
        return view('admin.report.__most_popular_services_report');
    }
}
