<?php

namespace App\Http\Controllers;

use App\invoices;
use App\details_invoices;
use App\invoice_attachments;
use App\sections;
use App\products;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ShippingPriceController extends Controller
{
    public function index()
    public function GetCities($CountryID)
    {
        $cities = City::where("country_id", $CountryID)->orderby("city_name", 'id')->get();
        return json_encode($cities);
    }


}