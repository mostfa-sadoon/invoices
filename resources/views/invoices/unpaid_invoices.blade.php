@extends('layouts.master')
@section('title')
قائمه الفواتير الغير مدفوعه
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
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
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمه الفواتير</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
				  
			
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
							<a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>


								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Bordered Table</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
											    <th class="border-bottom-0">#</th>
										    	<th class="border-bottom-0">رقم القسم</th>
												<th class="border-bottom-0">تاريخ الفاتوره</th>
												<th class="border-bottom-0">تاريخ الاستحقاق</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">الخصم</th>
												<th class="border-bottom-0">نسبه الضريبه </th>
												<th class="border-bottom-0">قيمه الضريبه</th> 
												<th class="border-bottom-0">الاجمالي </th>
												<th class="border-bottom-0">الحاله</th>
												<th class="border-bottom-0">ملاحظات</th> 
												<th class="border-bottom-0">العمليات</th> 
											</tr>
										</thead>
										<tbody>
										<?php $i=1 ?>
										@foreach($invoices as $invoice)
										<tr>
												<td>{{$i++}}</td>
												<td>{{$invoice->invoice_number}}</td>
												<td>{{$invoice->date}}</td>
												<td>{{$invoice->due_date}}</td>
												<td>{{$invoice->product}}</td>
												<td><a href="{{url('invoicesDetails')}}/{{$invoice->id}}">{{$invoice->section->section_name}}</a></td>
												<td>{{$invoice->discount}}</td>
												<td>{{$invoice->rat_vat}}</td>
												<td>{{$invoice->value_vat}}</td>
												<td>{{$invoice->total}}</td>
												<td>
												   @if($invoice->value_status==1)
												   <span class="text-success">{{$invoice->status}}</span>
												   @elseif($invoice->value_status==2)
												   <span class="text-danger">{{$invoice->status}}</span>
												   @else
												   <span class="text-warning">{{$invoice->status}}</span>
												   @endif
												</td>
												<td>{{$invoice->note}}</td>
												<td>
													<div class="dropdown">
														<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
														data-toggle="dropdown" id="dropdownMenuButton" type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
														<div  class="dropdown-menu tx-13">
															<a class="dropdown-item" href="{{ route('invoices.edit',[$invoice])}}">edite</a>
															<button class="btn btn-outline-danger btn-sm " data-invice_id="{{ $invoice->id }}"
																data-invoice_number="{{ $invoice->invoice_number }}" data-toggle="modal"
																data-target="#modaldemo9"> حذف الفاتوره</button>
															<a class="dropdown-item btn " href="{{route('show',[$invoice->id])}}"> حاله الدفع</a>
														</div>
													</div>
												</td>
											</tr>
										@endforeach	
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

				



                    <!-- delete -->
        <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف الفاتوره</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('invoices.destroy','invoice')}}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف للفاتوره رقم ؟</p><br>
                            <input type="hidden" name="invice_id" id="invice_id" value="">
                            <input class="form-control" name="invoice_number" id="invoice_number" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




				</div>
				<!-- /row -->
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
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var Product_name = button.data('name')
            var section_name = button.data('section_name')
            var invice_id = button.data('invice_id')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #invoice_number').val(invoice_number);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #invice_id').val(invice_id);
        })


        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invice_id = button.data('invice_id')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)

            modal.find('.modal-body #invice_id').val(invice_id);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })

    </script>
@endsection