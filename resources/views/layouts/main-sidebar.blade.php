<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='dashboard') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='dashboard') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='dashboard') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='dashboard') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{\Illuminate\Support\Facades\Auth::user()->name}}</h4>
{{--							<span class="mb-0 text-muted">Premium Member</span>--}}
						</div>
					</div>
				</div>
                <ul class="side-menu">
                    <li class="side-item side-item-category">برنامج الفواتير</li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ url('/' . ($page = 'dashboard')) }}"><svg
                                xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                                <path
                                    d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                            </svg><span class="side-menu__label">الرئيسية</span></a>
                    </li>

                    @can('الفواتير')
{{--                        <li class="side-item side-item-category">الفواتير</li>--}}

                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M134H6v16h12V9h-5V4zm314H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"/>
                                    <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>
                                <span class="side-menu__label">الفواتير</span>
                                <i class="angle fe fe-chevron-down"></i>
                            </a>
                            <ul class="slide-menu">

                                @can('قائمة الفواتير')

                                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoices')) }}">قائمة الفواتير</a></li>

                                @endcan

                                @can('الفواتير المدفوعة')

                                    <li><a class="slide-item" href="{{ url('/' . ($page = 'paid_invoices')) }}">الفواتير المدفوعة</a>

                                        @endcan

                                    </li>

                                    @can('الفواتير الغير مدفوعة')
                                        <li><a class="slide-item" href="{{ url('/' . ($page = 'unpaid_invoices')) }}">الفواتير
                                                الغيرمدفوعة</a>
                                        </li>
                                    @endcan

                                    @can('الفواتير المدفوعة')
                                        <li><a class="slide-item" href="{{ url('/' . ($page = 'partial_invoices')) }}">الفواتير المدفوعة
                                                جزئيا</a>
                                        </li>
                                    @endcan

                                    @can('ارشيف الفواتير')
                                        <li><a class="slide-item" href="{{ url('/' . ($page = 'archives')) }}">ارشيف الفواتير</a></li>
                                    @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('التقارير')
{{--                        <li class="side-item side-item-category">التقارير</li>--}}
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                                    <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                                </svg><span class="side-menu__label">التقارير</span>
                                <i class="angle fe fe-chevron-down"></i>
                            </a>
                            <ul class="slide-menu">
                                @can('تقرير الفواتير')
                                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoices_reports')) }}">تقارير الفواتير</a>
                                    </li>
                                @endcan

                                @can('تقرير العملاء')
                                    <li><a class="slide-item" href="{{ url('/' . ($page = 'customers_reports')) }}">تقارير العملاء</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('المستخدمين')
{{--                        <li class="side-item side-item-category">المستخدمين</li>--}}
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3" />
                                    <path
                                        d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z" />
                                </svg><span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                @can('قائمة المستخدمين')
                                    <li><a class="slide-item" href="{{ url('/' . ($page = 'users')) }}">قائمة المستخدمين</a></li>
                                @endcan

                                @can('صلاحيات المستخدمين')
                                    <li><a class="slide-item" href="{{ url('/' . ($page = 'roles')) }}">صلاحيات المستخدمين</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('الاعدادات')
{{--                        <li class="side-item side-item-category">الاعدادات</li>--}}
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg><span class="side-menu__label">الاعدادات</span><i class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                @can('الاقسام')
                                    <li><a class="slide-item" href="{{ url('/' . ($page = 'sections')) }}">الاقسام</a></li>
                                @endcan

                                @can('المنتجات')
                                    <li><a class="slide-item" href="{{ url('/' . ($page = 'products')) }}">المنتجات</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
			</div>
		</aside>
<!-- main-sidebar -->
