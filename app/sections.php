<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sections extends Model
{
   public $timestamps = false;
   protected $fillable=[
    'section_name',
    'description',
    'created_by'
   ];
}
