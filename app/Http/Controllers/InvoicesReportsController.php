<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesReportsController extends Controller
{
    public function index(){
        return view('reports.invoices_reports');
    }

    public function find(Request $request){
        $radio = $request->radio;
        if ($radio == 1){
            if ($request->type && $request->start_at == '' && $request->end_at == ''){
                $invoices = Invoices::select('*')->where('status',$request->type)->get();
                $type = $request->type;
                return view('reports.invoices_reports',compact('type'))->withDetails($invoices);
            }else{
                $start_at = date('Y-m-d',strtotime($request->start_at));
                $end_at = date('Y-m-d',strtotime($request->end_at));
                $type = $request->type;

                $invoices = Invoices::whereBetween('invoice_date', [$start_at,$end_at])->where('status',$type)->get();
                return view('reports.invoices_reports', compact('start_at','end_at','type'))->withDetails($invoices);
            }
        }else{
            $invoices = Invoices::select('*')->where('invoice_number',$request->invoice_number)->get();
            return view('reports.invoices_reports')->withDetails($invoices);
        }
    }
}
