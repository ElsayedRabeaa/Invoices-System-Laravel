@extends('layouts.master')
@section('title')
قسم الفواتير
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4>
						</div>
					</div>
		
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

 @if (session()->has('delete_invoice'))
<script>
    window.onload = function() {
        notif({
            msg: "تم استعادة الفاتورة بنجاح",
            type: "success"
        })
    }
</script>
@endif 

	<!-- row opened -->
    <div class="row">

        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                        class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                        <a href="export" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp;  تصدبر الفواتبر</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table id="example-delete" class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>رقم الفاتورة</th>
                                    <th>تاريخ الفاتورة</th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th>المنتج</th>
                                    <th>القسم</th>
                                    <th>الخصم</th>
                                    <th>التحصيل</th>
                                    <th>نسبة العمولة</th>
                                    <th>نسبة الضريبة</th>
                                    <th>فيمة الضريبة</th>
                                    <th>الاجمالي</th>
                                    <th>الحالة</th>
                                    <th>ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>



                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    
                                <tr>
                                    <td> {{$invoice->id}} </td>
                                    <td>{{$invoice->invoice_number}}</td>
                                    <td>{{$invoice->invoice_Date}}</td>
                                    <td>{{$invoice->Due_date}}</td>
                                    <td>{{$invoice->product}}</td>
                                    {{-- <td>{{$invoice->section->section_name}}</td> --}}
                                    <td>
                                        <a href="{{url('invoicesdetails')}}/{{$invoice->id}}">{{$invoice->section->section_name}}</a>
                                    
                                    </td>
                                    <td>{{$invoice->Discount}}</td>
                                    <td>{{$invoice->Amount_collection}}</td>
                                    <td>{{$invoice->Amount_Commission}}</td>
                                    <td>{{$invoice->Rate_VAT}}</td>
                                    <td>{{$invoice->Value_VAT}}</td>
                                    <td>{{$invoice->Total}}</td>
                                    <td> 
                                    @if($invoice->Value_Status == 1)
                                   <h4 class="text-success">{{$invoice->Status}}</h4>
                                   @elseif($invoice->Value_Status == 2)
                                   <h4  class="text-danger">{{$invoice->Status}}</h4>
                                   @else
                                   <h4  class="text-primary">{{$invoice->Status}}</h4>
                                    @endif
                                </td>
                                    <td>{{$invoice->note}}</td>
                                    <td>                <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                            type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item"
                                                    href=" {{ url('edit_invoice') }}/{{ $invoice->id }} "><i class="typcn typcn-edit"></i>تعديل
                                                    الفاتورة </a>

                                                <a class="dropdown-item"  data-invoice_id="{{ $invoice->id }}"
                                                    data-toggle="modal" data-target="#delete_invoice"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                    الفاتورة</a>

                                                <a class="dropdown-item"  href="{{ URL::route('Status_show', [$invoice->id]) }}" ><i
                                                        class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                    حالة
                                                    الدفع</a>

                                                <a class="dropdown-item"  data-invoice_id="{{ $invoice->id }}"
                                                    data-toggle="modal" data-target="#Transfer_invoice"><i
                                                        class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                    الارشيف</a>

                                                <a class="dropdown-item" href="Print_invoice/{{ $invoice->id }}"><i
                                                        class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                    الفاتورة
                                                </a> 
                                        </div>
                                    </div></td>


                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- /row -->
			</div>
             <!-- حذف الفاتورة -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
            </div>
            <div class="modal-body">
                هل انت متاكد من عملية الحذف ؟
                <input type="hidden" name="invoice_id" id="invoice_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
            </div>
            </form>
        </div>
    </div>
</div>

 <!-- ارشيف الفاتورة -->
 <div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                 {{ method_field('delete') }}
                 {{ csrf_field() }}
         </div>
         <div class="modal-body">
             هل انت متاكد من عملية الارشفة ؟
             <input type="hidden" name="invoice_id" id="invoice_id" value="">
             <input type="hidden" name="id_page" id="id_page" value="2">

         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
             <button type="submit" class="btn btn-success">تاكيد</button>
         </div>
         </form>
     </div>
 </div>
</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
    $('#delete_invoice').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>

<script>
    $('#Transfer_invoice').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>


@endsection