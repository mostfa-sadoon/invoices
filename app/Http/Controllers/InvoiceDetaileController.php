<?php

namespace App\Http\Controllers;

use App\Invoice_Detaile;
use App\Invoice;
use App\Invoice_attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateInvoices;
use Illuminate\Http\Request;

class InvoiceDetaileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
         // $invoice=invoice::where('id',$id)->first();
          $invoice=invoice::find($id);
          $detailes=Invoice_Detaile::where('id_invoice',$id)->get();
          $attachments=Invoice_attachment::where('invoice_id',$id)->get();
        
          return view('invoices.Detail_invoices',compact('invoice','detailes','attachments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice_Delaile  $invoice_Delaile
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_Delaile $invoice_Delaile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice_Delaile  $invoice_Delaile
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice_Delaile $invoice_Delaile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice_Delaile  $invoice_Delaile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_Delaile $invoice_Delaile)
    {
        //
    }

    public function open_file($invoice_id,$file_name)
    {
         $files=storage::disk('public_uploads')->getDriver()->getAdapter()->applypathprefix($invoice_id.'/'.$file_name);
         return response()->file($files);
    }
    public function get_file($invoice_id,$file_name)
    {
        $contents=storage::disk('public_uploads')->getDriver()->getAdapter()->applypathprefix($invoice_id.'/'.$file_name);
        return response()->download($contents);
    }


    
    public function store_attachment(Request $request)
    {   
        $invoice_id=$request->invoice_id;
        $invoice_number=$request->invoice_number;
        if($request->hasFile('pic'))
        {
            $image=$request->file('pic');
            $file_name=$image->getClientOriginalName();
            $invoice_number= $request->invoice_number;
            $attatchments=new  Invoice_attachment();
            $attatchments->file_name=$file_name;
            $attatchments->invoice_number=$invoice_number;
            $attatchments->created_by=Auth::user()->name;
            $attatchments->invoice_id=$invoice_id;
            $attatchments->save();
            $imagename=$request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attatchments/'.$invoice_id),$imagename);
            session()->flash('Add',"تم اضافه مرفق جديد  للفاتوره بنجاح");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice_Delaile  $invoice_Delaile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
     $invoice_attacment=invoice_attachment::findorfail($request->attachment_id);
     $file_name=$invoice_attacment->file_name;
     $invoice_attacment->delete();
     $contents=storage::disk('public_uploads')->delete($request->invoice_id.'/'.$file_name);
     session()->flash('delete','تم الحذف بنجاح');
     return back();
    }
}
