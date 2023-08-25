<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $count_all =Invoices::count();
        $count_invoices1 = Invoices::where('Value_Status', 1)->count();
        $count_invoices2 = Invoices::where('Value_Status', 2)->count();
        $count_invoices3 = Invoices::where('Value_Status', 3)->count();

        if($count_invoices2 == 0){
            $nspainvoices2=0;
        }
        else{
            $nspainvoices2 = $count_invoices2/ $count_all*100;
        }

        if($count_invoices1 == 0){
            $nspainvoices1=0;
        }
        else{
            $nspainvoices1 = $count_invoices1/ $count_all*100;
        }

        if($count_invoices3 == 0){
            $nspainvoices3=0;
        }
        else{
            $nspainvoices3 = $count_invoices3/ $count_all*100;
        }


        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['rgba(244, 44, 44, 0.8)'],
                    'data' => [round($nspainvoices2,2)]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['rgba(44, 244, 63, 0.8)'],
                    'data' => [round($nspainvoices1,2)]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['rgba(244, 196, 44, 0.8)'],
                    'data' => [round($nspainvoices3,2)]
                ],


            ])
            ->options([]);


        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 350, 'height' => 274])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['rgba(244, 44, 44, 0.8)', 'rgba(44, 244, 63, 0.8)','rgba(244, 196, 44, 0.8)'],
                    'data' => [round($nspainvoices2,2), round($nspainvoices1,2),round($nspainvoices3,2)]
                ]
            ])
            ->options([]);


        return view('dashboard',compact('chartjs','chartjs_2'));
    }
}
