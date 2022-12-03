<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice_attachments extends Model
{
   protected $fiilable=[
    'file_name',
    'id_invoices',
    'invoice_number	',
    'created_by	',
   ];
}
