<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_Detaile extends Model
{
    //
    protected $table='invoice_detailes';
    protected $fillable=[
       'id_invoice',
       'invoice_number',
       'product',
       'section',
        'status',
        'value_status',
        'note',
        'user',
        'payment_date'
    ];
    public function invoice()
    {
       return $this->belogsTo('App\Invoice');
    }
}
