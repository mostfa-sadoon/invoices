@extends('layouts.master')
@section('title')
قائمه الاقسام
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
<div class="row row-sm">
                 
                 @if(session()->has('add'))
                   <div class="alert alert-success fade show" role="alert">
				        <strong>{{session()->get('add')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-lable="close">
						 <span aria-hidden="true">&times;</span>
						</button>
				   </div>
				 @endif
				 @if(session()->has('edit'))
                   <div class="alert alert-success fade show" role="alert">
				        <strong>{{session()->get('edit')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-lable="close">
						 <span aria-hidden="true">&times;</span>
						</button>
				   </div>
				 @endif
				 @if(session()->has('delete'))
                   <div class="alert alert-success fade show" role="alert">
				        <strong>{{session()->get('delete')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-lable="close">
						 <span aria-hidden="true">&times;</span>
						</button>
				   </div>
				 @endif
			            	 @error('section_name')
                             <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
							@error('description')
                              <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
				 @if(session()->has('Error'))
                   <div class="alert alert-success fade show" role="alert">
				        <strong>{{session()->get('add')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-lable="close">
						 <span aria-hidden="true">&times;</span>
						</button>
				   </div>
				 @endif
  
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافه قسم</a>
									
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">اسم القسم</th>
												<th class="wd-20p border-bottom-0">الوصف</th>
												<th class="wd-15p border-bottom-0">العمليات</th>
												<th class="wd-15p border-bottom-0">حذف</th>
												
											</tr>
										</thead>
										<tbody>
										<?php $i=1 ?>
										@foreach($sections as $section)
											<tr>
											  <td>{{$i++}}</td>
                                               <td>{{$section->section_name}}</td>
											   <td>{{$section->description}}</td>
                                                <td>
												   
												<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
                                                       data-description="{{ $section->description }}" data-toggle="modal" href="#exampleModal2"
                                                       title="تعديل"><i class="las la-pen"></i></a>

                                                 
                                                 <td>

													   <form action="sections/destroy" method="POST"  >
													   @method('delete')
													     @csrf
													   <input type="hidden" name="id" value="{{$section->id}}">
													   <button type="submit" class="btn btn-danger btn-icon">
													   <i class="las la-trash"></i>
                                                        </button>
													   </form>
													   
                                                  </td>

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

				
                       	<!-- Basic modal -->
		<div class="modal" id="modaldemo8">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">اضافه قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<form action="{{route('sections.store')}}" method="post">
					@csrf
					<div class="modal-body">
						<div class="form-group">
						    <lable for="exampleInputEmail">اسم القسم</lable>
							<input type="text" class="form-control" id="section_name" name="section_name" required>
							
						</div>
						<div class="form-group">
						    <lable for="exampleFormControlTextarea1">ملاحظات</lable>
							<textarea type="text" class="form-control" rows="3" id="description" name="description" required></textarea>

						
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary" type="submit">تاكيد</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- End Basic modal -->

		 <!-- edit -->
		 <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
									<form action="sections/update" method="POST">
									{{method_field('patch')}}	
                                     @csrf
										<div class="modal-body">  
											<div class="form-group">
											<input type="hidden" name="id" id="id" value="$section->id">
												<lable for="exampleInputEmail">اسم القسم</lable>
												<input type="text" class="form-control" id="section_name" name="section_name" required>
												
											</div>
											<div class="form-group">
												<lable for="exampleFormControlTextarea1">ملاحظات</lable>
												<textarea type="text" class="form-control" rows="3" id="description" name="description" required></textarea>											
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn ripple btn-primary" type="submit">تاكيد</button>
											<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
										</div>
										</form>    
                                
                            </div>
                        </div>
                       <!-- end edit -->




				
					
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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>



<script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>
@endsection