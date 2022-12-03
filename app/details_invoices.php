<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class details_invoices extends Model
{
    protected $fillable=[
        'id_invoices',
        'invoice_number',
        'product',
        'section',
        'Status',
        'Value_Status',
        'note',
        'user',

    ];
}
