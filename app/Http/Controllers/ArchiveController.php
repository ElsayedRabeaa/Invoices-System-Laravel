<?php

namespace App\Http\Controllers;
use App\invoices;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.Archive_Invoices',compact('invoices'));
    }

    
    public function update(Request $request)
    {
         $id = $request->invoice_id;
         $flight = invoices::withTrashed()->where('id', $id)->restore();
         session()->flash('restore_invoice');
         return redirect('/invoices');
    }

    public function destroy(Request $request)
    {
         $invoices = invoices::withTrashed()->where('id',$request->invoice_id)->first();
         $invoices->forceDelete();
         session()->flash('delete_invoice');
         return redirect('/Archive');
    
    }

}
