<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Models\Section;
use Illuminate\Http\Request;

class CustomersReportsController extends Controller
{
    public function index(){
        $sections = Section::all();
        return view('reports.customers_reports',compact('sections'));
    }

    public function find(Request $request){


        if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {

            $invoices = Invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
            $sections = Section::all();
            return view('reports.customers_reports',compact('sections'))->withDetails($invoices);

        }else{
            $start_at = $request->start_at;
            $end_at = $request->end_at;
            $sections = Section::all();

            $invoices = Invoices::whereBetween('invoice_date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
            return view('reports.customers_reports',compact('sections'))->withDetails($invoices);
        }

    }
}
