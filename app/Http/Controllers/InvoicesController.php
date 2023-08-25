<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\Invoices;
use App\Models\InvoicesDetails;
use App\Models\InvoicesAttachments;
use App\Models\Section;
use App\Models\User;
use App\Notifications\AddInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:الفواتير|قائمة الفواتير', ['only' => ['index']]);
        $this->middleware('permission:اضافة فاتورة', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل الفاتورة', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف الفاتورة', ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoices::all();
        return view('invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoices',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Invoices::create([
           'invoice_number'=>$request->invoice_number,
           'invoice_date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'amount_collection'=>$request->Amount_collection,
            'amount_commission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'rate_vat'=>$request->Rate_VAT,
            'value_vat'=>$request->Value_VAT,
            'total'=>$request->Total,
            'status'=>'غير مدفوعة',
            'value_status'=>2,
            'note'=>$request->note,
        ]);

        $invoiceId= Invoices::latest()->first()->id;
        InvoicesDetails::create([
            'invoice_id'=>$invoiceId,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->Section,
            'status'=>'غير مدفوعة',
            'value_status'=>2,
            'note'=>$request->note,
            'created_by'=>(Auth::user()->name),

        ]);

        if($request->hasFile('pic')){
            $invoiceId= Invoices::latest()->first()->id;
            $file=$request->file('pic');
            $fileName=$file->getClientOriginalName();
            $invoiceNumber = $request->invoice_number;

            InvoicesAttachments::create([
                'file_name'=>$fileName,
                'invoice_number'=>$invoiceNumber,
                'created_by'=>(Auth::user()->name),
                'invoice_id'=>$invoiceId,
            ]);

            $serverFileName=$request->pic->getClientOriginalName();
            $request->pic->move(public_path('attachments/'.$invoiceNumber),$serverFileName);
        }

        $user = User::where('id',1)->get();
        $invoice = Invoices::latest()->first();
        Notification::send($user,new AddInvoice($invoice->id));
        session()->flash('Add' , 'تم اضافة الفاتورة ');
        return redirect('/invoices');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = Invoices::where('id',$id)->first();
        return view('invoices.update_status',compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = Invoices::where('id',$id)->first();
        $sections = Section::all();
        return view('invoices.edit_invoices',compact('invoices','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoices= Invoices::findOrFail($request->invoiceId);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->Amount_collection,
            'amount_commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'value_vat' => $request->Value_VAT,
            'rate_vat' => $request->Rate_VAT,
            'total' => $request->Total,
            'note' => $request->note,
        ]);
        session()->flash('Edit','تم التعديل');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = Invoices::where('id',$id)->first();
        $attachment = InvoicesAttachments::where('invoice_id',$id)->first();
        $id_page = $request->id_page;

        if (!$id_page== 2){

            if (!empty($attachment->invoice_number)){
                Storage::disk('uploads')->deleteDirectory($attachment->invoice_number);
            }

            $invoice->forceDelete();
            session()->flash('Delete');
            return redirect('/invoices');
        }else{
            $invoice->delete();
            session()->flash('Archive');
            return redirect('/archives');

        }


    }

    public function update_status($id , Request $request)
    {

        $invoices = Invoices::findOrFail($id);
        if ($request->status === 'مدفوعة'){
            $invoices->update([
                'status'=>$request->status,
                'value_status'=>1,
                'payment_date'=>$request->payment_date,
            ]);

            InvoicesDetails::create([
                'invoice_id'=>$request->invoice_id,
                'invoice_number'=>$request->invoice_number,
                'product'=>$request->product,
                'section'=>$request->section,
                'status'=>$request->status,
                'value_status'=>1,
                'payment_date'=>$request->payment_date,
                'note'=>$request->note,
                'created_by'=>(Auth::user()->name),
            ]);
        }else{
            $invoices->update([
                'status'=>$request->status,
                'value_status'=>3,
                'payment_date'=>$request->payment_date,
            ]);

            InvoicesDetails::create([
                'invoice_id'=>$request->invoice_id,
                'invoice_number'=>$request->invoice_number,
                'product'=>$request->product,
                'section'=>$request->section,
                'status'=>$request->status,
                'value_status'=>3,
                'payment_date'=>$request->payment_date,
                'note'=>$request->note,
                'created_by'=>(Auth::user()->name),
            ]);
        }
        session()->flash('update_status');
        return redirect('/invoices');

    }

    public function print($id){
        $invoice = Invoices::where('id',$id)->first();
        return view('invoices.print_invoices',compact('invoice'));
    }

    public function paid_invoices(){
        $invoices = Invoices::where('value_status',1)->get();
        return view('invoices.paid_invoices',compact('invoices'));
    }

    public function unpaid_invoices(){
        $invoices = Invoices::where('value_status',3)->get();
        return view('invoices.partial_invoices',compact('invoices'));
    }

    public function partial_invoices(){
        $invoices = Invoices::where('value_status',2)->get();
        return view('invoices.unpaid_invoices',compact('invoices'));
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'users.xlsx');
    }

    public function all(Request $request){
        $unread = \auth()->user()->unreadNotifications;
        if($unread){
            $unread->markAsRead();
            return back();
        }
    }

}
