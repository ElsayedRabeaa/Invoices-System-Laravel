<?php

namespace App\Http\Controllers;

use App\details_invoices;
use Illuminate\Http\Request;
use App\invoices;
use App\invoice_attachments;
use App\sections;
use App\products;

class DetailsInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $details  = details_invoices::where('id_invoices',$id)->get();
        $attachments  = invoice_attachments::where('id_invoices',$id)->get();

        return view('invoices.details',compact('invoices','details','attachments'));
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
     * @param  \App\details_invoices  $details_invoices
     * @return \Illuminate\Http\Response
     */
    public function show(details_invoices $details_invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\details_invoices  $details_invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(details_invoices $details_invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\details_invoices  $details_invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, details_invoices $details_invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\details_invoices  $details_invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(details_invoices $details_invoices)
    {
        //
    }
}
