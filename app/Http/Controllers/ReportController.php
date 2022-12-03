<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;
use App\sections;
use App\products;


class ReportController extends Controller
{
  public function index(){
    return view("Reports.invoices_report");
  }

  public function search(Request $request){

    $rdio = $request->rdio;


 // في حالة البحث بنوع الفاتورة
    
    if ($rdio == 1) {
       
       
 // في حالة عدم تحديد تاريخ
        if ($request->type && $request->start_at =='' && $request->end_at =='') {
            
           $invoices = invoices::select('*')->where('Status','=',$request->type)->get();
           $type = $request->type;
           return view('Reports.invoices_report',compact('type'))->withDetails($invoices);
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
           
          $start_at = date($request->start_at);
          $end_at = date($request->end_at);
          $type = $request->type;
          
          $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
          return view('Reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);
          
        }

 
        
    } 
    
//====================================================================
    
// في البحث برقم الفاتورة
    else {
        
        $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
        return view('Reports.invoices_report')->withDetails($invoices);
        
    }

    
     
    }




    public function customer(){

        $sections = sections::all();
        return view('Reports.customers_report',compact('sections'));
          
      }
  
  
      public function Search_customers(Request $request){
  
  
  // في حالة البحث بدون التاريخ
        
       if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {
  
         
        $invoices = invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
        $sections = sections::all();
         return view('Reports.customers_report',compact('sections'))->withDetails($invoices);
  
      
       }
  
  
    // في حالة البحث بتاريخ
       
       else {
         
         $start_at = date($request->start_at);
         $end_at = date($request->end_at);
  
        $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
         $sections = sections::all();
         return view('Reports.customers_report',compact('sections'))->withDetails($invoices);
  
        
       }
       
    
      
      }
  
    }
