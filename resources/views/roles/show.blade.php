@extends('layouts.master')
@section('title')
    عرض الصلاحيات
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الصلاحيات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الصلاحيات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-md-12">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    <div class="pull-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}">رجوع</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- col -->
                                    <div class="col-lg-4">
                                        <ul id="treeview1">
                                            <li><a href="#">{{ $role->name }}</a>
                                                <ul>
                                                    @if(!empty($rolePermissions))
                                                        @foreach($rolePermissions as $r)
                                                            <li>{{ $r->name }}</li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /col -->
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
@endsection
