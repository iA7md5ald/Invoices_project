@extends('layouts.master')
@section('title')
    تفاصيل الفاتورة
@endsection
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="">
                    <div class="card mg-b-20" id="tabs-style3">
                        <div class="card-body">
                            <div class="text-wrap">
                                <div class="example">
                                    <div class="panel panel-primary tabs-style-3">
                                        <div class="tab-menu-heading">
                                            <div class="tabs-menu ">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs">
                                                    <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="icon ion-md-paper"></i> معلومات الفاتورة</a></li>
                                                    <li><a href="#tab12" data-toggle="tab"><i class="icon ion-ios-list-box"></i> حالات الدفع</a></li>
                                                    <li><a href="#tab13" data-toggle="tab"><i class="icon ion-md-filing"></i> المرفقات</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab11">
                                                    <div class="table-responsive mt-15">
                                                        <table class="table table-striped" style="text-align:center">
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">رقم الفاتورة</th>
                                                                <td>{{ $invoices->invoice_number }}</td>
                                                                <th scope="row">تاريخ الاصدار</th>
                                                                <td>{{ $invoices->invoice_date }}</td>
                                                                <th scope="row">تاريخ الاستحقاق</th>
                                                                <td>{{ $invoices->due_date }}</td>
                                                                <th scope="row">القسم</th>
                                                                <td>{{ $invoices->section->section_name }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">المنتج</th>
                                                                <td>{{ $invoices->product }}</td>
                                                                <th scope="row">مبلغ التحصيل</th>
                                                                <td>{{ $invoices->amount_collection }}</td>
                                                                <th scope="row">مبلغ العمولة</th>
                                                                <td>{{ $invoices->amount_commission }}</td>
                                                                <th scope="row">الخصم</th>
                                                                <td>{{ $invoices->discount }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">نسبة الضريبة</th>
                                                                <td>{{ $invoices->rate_vat }}</td>
                                                                <th scope="row">قيمة الضريبة</th>
                                                                <td>{{ $invoices->value_vat }}</td>
                                                                <th scope="row">الاجمالي مع الضريبة</th>
                                                                <td>{{ $invoices->total }}</td>
                                                                <th scope="row">الحالة الحالية</th>

                                                                @if ($invoices->value_status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $invoices->status }}</span>
                                                                    </td>
                                                                @elseif($invoices->value_status ==2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $invoices->status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $invoices->status }}</span>
                                                                    </td>
                                                                @endif
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">ملاحظات</th>
                                                                <td>{{ $invoices->note }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab12">
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0 table-hover"
                                                               style="text-align:center">
                                                            <thead>
                                                            <tr class="text-dark">
                                                                <th>#</th>
                                                                <th>رقم الفاتورة</th>
                                                                <th>نوع المنتج</th>
                                                                <th>القسم</th>
                                                                <th>حالة الدفع</th>
{{--                                                                <th>تاريخ الدفع </th>--}}
                                                                <th>ملاحظات</th>
                                                                <th>تاريخ الاضافة </th>
                                                                <th>المستخدم</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($details as $detail)
                                                                    <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $detail->invoice_number }}</td>
                                                                    <td>{{ $detail->product }}</td>
                                                                    <td>{{ $invoices->section->section_name }}</td>
                                                                    @if ($detail->value_status == 1)
                                                                        <td><span
                                                                                class="badge badge-pill badge-success">{{ $detail->status }}</span>
                                                                        </td>
                                                                    @elseif($detail->value_status ==2)
                                                                        <td><span
                                                                                class="badge badge-pill badge-danger">{{ $detail->status }}</span>
                                                                        </td>
                                                                    @else
                                                                        <td><span
                                                                                class="badge badge-pill badge-warning">{{ $detail->status }}</span>
                                                                        </td>
                                                                    @endif
{{--                                                                    <td>{{ $detail->payment_date }}</td>--}}
                                                                    <td>{{ $detail->note }}</td>
                                                                    <td>{{ $detail->created_at }}</td>
                                                                    <td>{{ $detail->created_by }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>


                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab13">
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0 table table-hover"
                                                               style="text-align:center">
                                                            <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">م</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col">العمليات</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($attachments as $attachment)
                                                                    <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $attachment->file_name }}</td>
                                                                    <td>{{ $attachment->created_by }}</td>
                                                                    <td>{{ $attachment->created_at }}</td>
                                                                    <td colspan="2">

                                                                        <a class="btn btn-outline-success btn-sm"
                                                                           href="{{ url('view_file') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                                           role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            عرض</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                           href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                                           role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>

                                                                            <button class="btn btn-outline-danger btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-file_name="{{ $attachment->file_name }}"
                                                                                    data-invoice_number="{{ $attachment->invoice_number }}"
                                                                                    data-id_file="{{ $attachment->id }}" data-target="#delete_file">حذف</button>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
@endsection
