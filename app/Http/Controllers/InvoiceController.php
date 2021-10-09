<?php

namespace App\Http\Controllers;
use App\Invoice;
use App\Section;
use Illuminate\Support\Facades\Storage;
use App\Invoice_Detaile;
use App\ Invoice_attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=Invoice::all();
        return view('invoices.invoices',compact('invoices'));
    }
    public function archive()
    {
         $invoices=Invoice::onlyTrashed()->get();
         return view('invoices.archive',compact('invoices'));
    }
    public function restore($id)
    {
       
        $invoice=Invoice::where('id', $id)->withTrashed()->first();
        $invoice->restore();
        return back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sections=Section::all();
        return view('invoices.add_invoice',compact('sections'));

    }
    public function getproducts($id)
    {
      $products=DB::table('products')->where('section_id',$id)->pluck("product_name","id");
       return json_encode($products);
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
      //  return Auth::user()->name;
        
      $invoice=Invoice::create([
         "invoice_number"=>$request->invoice_number,
         'invoice_date'=>$request->invoice_Date,
         'due_date'=>$request->Due_date,
         'section_id'=>$request->Section,
         'amount_collection'=>$request->Amount_collection,
         'amount_commission'=>$request->Amount_Commission,
         'discount'=>$request->Discount,
         'value_vat'=>$request->Value_VAT,
         'product'=>$request->product,
         'rate_vat'=>$request->Rate_VAT,
         'status'=>"غير مدفوعه",
         'value_status'=>2,
         'total'=>$request->Total,
         'note'=>$request->note,
        ]);
        $invoice_id=$invoice->id;
        Invoice_Detaile::create([
            'id_invoice'=>$invoice_id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->Section,
            'status'=>"غير مدفوعه",
            'value_status'=>2,
            'note'=>$request->note,
            'user'=>Auth::user()->name,
        ]);
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
        }
        session()->flash('add',"تم اضافه الفاتوره بنجاح");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
        $sections=Section::all();
        return view('invoices.edit_invoice',compact('invoice','sections'));
    }
    public function status_show($id)
    {
        $invoice=Invoice::find($id);
        return view('invoices.status_show',compact('invoice'));
    }
    public function status_update(Request $request,$id)
    {
      
       
        if($request->status === 'مدفوع'){
           
            $invoice=Invoice::findorfail($id);
            $invoice_detailes=Invoice_Detaile::where('id_invoice', $id);
            $invoice->update([
                'status'=>$request->status,
                'value_status'=>1,
                'payment_Date'=>$request->payment_Date,
               ]);
               $invoice_detailes->update([
                'status'=>$request->status,
                'value_status'=>1,
               ]);
        }
        return redirect('/invoices');
    }
    public function paid()
    {
        $invoices=Invoice::where('value_status',1)->get();
        return view('invoices.paid_invoices',compact('invoices'));
    }
    public function unpaid()
    {
        $invoices=Invoice::where('value_status',2)->get();
        return view('invoices.unpaid_invoices',compact('invoices'));
    }
    public function partial_paid()
    {
        $invoices=Invoice::where('value_status',3)->get();
        return view('invoices.partial_paid_invoices',compact('invoices'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
      $invoice=Invoice::findorfail($id);
        $invoice->update([
            "invoice_number"=>$request->invoice_number,
            'invoice_date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'section_id'=>$request->Section,
            'amount_collection'=>$request->Amount_collection,
            'amount_commission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'value_vat'=>$request->Value_VAT,
            'product'=>$request->product,
            'rate_vat'=>$request->Rate_VAT,
            'status'=>"غير مدفوعه",
            'value_status'=>2,
            'total'=>$request->Total,
            'note'=>$request->note,
           ]);
          $invoice_detailes= Invoice_Detaile::where('id_invoice', $id);
         
           $invoice_detailes->update([
               'id_invoice'=>$id,
               'invoice_number'=>$request->invoice_number,
               'product'=>$request->product,
               'section'=>$request->Section,
               'status'=>"غير مدفوعه",
               'value_status'=>2,
               'note'=>$request->note,
               'user'=>Auth::user()->name,
           ]);
           if($request->hasFile('pic'))
           {
               $image=$request->file('pic');
               $file_name=$image->getClientOriginalName();
               $invoice_number= $request->invoice_number;
               $attatchments=new  Invoice_attachment();
               $attatchments->file_name=$file_name;
               $attatchments->invoice_number=$invoice_number;
               $attatchments->created_by=Auth::user()->name;
               $attatchments->invoice_id=$id;
               $attatchments->save();
               $imagename=$request->pic->getClientOriginalName();
               $request->pic->move(public_path('Attatchments/'.$id),$imagename);
           }
           session()->flash('edit',"تم تعديل الفاتوره بنجاح");
           return back();
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $id=$request->invice_id;
        $invoice=Invoice::where('id',$id)->first();
        if($invoice)
        {
            $invoice->Delete();
            session()->flash('delete_invoice',"تم حذف الفاتوره بنجاح");
            return redirect('/invoices');
        }else{
             $attatchment=Invoice_attachment::where('invoice_id',$id)->first();
           
             if(!empty($attatchment->invoice_id))
             {
             storage::disk('public_uploads')->deleteDirectory($attatchment->invoice_id);
             }
             $invoice= Invoice::where('id', $id)->withTrashed()->first();
             $invoice->forceDelete();
             session()->flash('delete_invoice',"تم حذف الفاتوره نهائيا بنجاح");
             return redirect('/archive');
        }
    }
  
}
