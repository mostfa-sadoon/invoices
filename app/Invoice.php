<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoice extends Model
{
    //
    use SoftDeletes;
    protected $fillable=[
     'invoice_number',
     'invoice_date',
     'due_date',
     'product',   
     'section_id',
     'amount_collection',
     'amount_commission',
      'discount',
      'value_vat',
      'rate_vat',
      'total',
       'status',
       'value_status',
       'note',
        'payment_date'  
    ];

    public function section()
    {
        return $this->belongsTO('App\Section');
    }   
    public function detail()
    {
        return $this->hasOne('App\Invoice_Detaile');
    }
}
