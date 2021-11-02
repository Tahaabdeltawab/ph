<!doctype html>
<html lang="en">

<head>
  <title>Madienty | Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
  <meta name="engy_ashraf" content="dashboard_madienty">

  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <!-- VENDOR CSS -->
  <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/animate-css/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/chartist/css/chartist.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">


  <link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert/sweetalert.css')}}" />

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/color_skins.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  @stack('styles')
</head>

<body class="theme-blue rtl">

  <!-- Page Loader -->
  <div class="page-loader-wrapper">
    <div class="loader">
      <div class="m-t-30"><img src="{{asset('assets/images/logo-icon.png')}}" width="48" height="48" alt="Madienty"></div>
      <p>Please wait...</p>
    </div>
  </div>
  <!-- Overlay For Sidebars -->
  <div class="overlay" style="display: none;"></div>
  @yield('content')

  <div id="wrapper">

    <nav class="navbar navbar-fixed-top">
      <div class="container-fluid">

        <div class="navbar-brand">
          <a href="{{url('admin/home') }}">
            <img src="{{asset('uploads/Logo.png')}}" alt="Madienty Logo" class="img-responsive logo">
            <span class="name">Madienty</span>
          </a>
        </div>

        <div class="navbar-right">
          <ul class="list-unstyled clearfix mb-0">
            <li>
              <div class="navbar-btn btn-toggle-show">
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
              </div>
              <a href="javascript:void(0);" class="btn-toggle-fullwidth btn-toggle-hide"><i class="fa fa-bars"></i></a>
            </li>
            <!-- <li>
                        <form id="navbar-search" class="navbar-form search-form">
                            <input value="" class="form-control" placeholder="Search here..." type="text">
                            <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                        </form>
                    </li>-->
            <li>
              <div id="navbar-menu">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                      <img class="rounded-circle" src="{{asset('uploads/users/img.png')}}" width="30" alt="">
                    </a>
                    <div class="dropdown-menu animated flipInY user-profile">
                      <div class="d-flex p-3 align-items-center">
                        <div class="drop-left m-r-10">
                          <img src="{{asset('uploads/users/img.png')}}" class="rounded" width="50" alt="">
                        </div>
                        <div class="drop-right">
                          <h4>{{ Auth::user()->username }}</h4>
                          <p class="user-name">{{ Auth::user()->email }}</p>
                        </div>
                      </div>
                      <div class="m-t-10 p-3 drop-list">
                        <ul class="list-unstyled">
                          <!-- <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                                                <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                                                <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>-->
                          <li class="divider"></li>
                          <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                              تسجيل الخروج
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                              {{ csrf_field() }}
                            </form>
                          </li>


                        </ul>
                      </div>
                    </div>
                  </li>
                  <li>
                    <a href="javascript:void(0);" class="icon-menu js-right-sidebar"><i class="icon-settings"></i></a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div id="leftsidebar" class="sidebar">
      <div class="sidebar-scroll">
        <nav id="leftsidebar-nav" class="sidebar-nav">
          <ul id="main-menu" class="metismenu" style="font-size: large;">
            <li class="heading">Main</li>
            <li class="{{ Request::segment(1) === 'home' ? 'active' : null }}">
              <a href="{{url('admin/home') }}"><i class="icon-home"></i> <span>لوحة التحكم</span></a>
            </li>
            @if(auth()->user()->isSupervisor())
            <li class="{{ Request::segment(1) === 'addPlaceAndUser' ? 'active' : null }}"><a
                href="{{url('admin/addPlaceAndUser') }}"><i class="fa fa-bank"></i><span>إضافة المستخدم والمكان
                </span></a></li>
            @endif
            @if(auth()->user()->isAdmin())
            <li class="{{ Request::segment(1) === 'users' ? 'active' : null }}">
              <a href="{{url('admin/users') }}"><i class="icon-users"></i> <span>المستخدمين</span></a>
            </li>
            <li class="{{ Request::segment(1) === 'supervisors' ? 'active' : null }}">
              <a href="{{url('admin/supervisors') }}"><i class="icon-users"></i> <span>المشرفين</span></a>
            </li>
            <li class="{{ Request::segment(1) === 'category' ? 'active' : null }}">
              <a href="{{url('admin/category') }}"><i class="icon-calendar"></i> <span>الاقسام</span></a>
            </li>
            <li class="{{ Request::segment(1) === 'slider' ? 'active' : null }}"><a href="{{url('admin/slider') }}">
                <i class="fa  fa-file-image-o"></i> <span> مجلد صور </span></a>
            </li>


            <li class="{{ Request::segment(1) === 'places' ? 'active' : null }}"><a href="{{url('admin/places') }}"><i
                  class="fa fa-bank"></i><span>الاماكن </span></a></li>

            <li class="{{ Request::segment(1) === 'city' ? 'active' : null }}"><a href="{{url('admin/city') }}"><i
                  class=" icon-pointer"></i><span>المحافظات</span></a></li>
            <li class="{{ Request::segment(1) === 'policy' ? 'active' : null }}"><a href="{{url('admin/policy') }}"><i
                  class="icon-doc"></i><span>سياسه الخصوصية </span></a></li>
            <li class="{{ Request::segment(1) === 'agreement' ? 'active' : null }}"><a
                href="{{url('admin/agreement') }}"><i class="icon-docs"></i><span>أتفاقية الاستخدام </span></a></li>
            <li class="{{ Request::segment(1) === 'notify' ? 'active' : null }}"><a href="{{url('admin/notify') }}"><i
                  class="fa fa-bell-o"></i><span>أرسال رسالة</span></a></li>
            @endif
            {{-- <li class="middle">
                <a href="#uiElements" class="has-arrow"><i class="icon-diamond"></i><span>Category</span></a>
                <ul>
                    <li><a href="main_category">Main Category</a></li>
                    <li><a href="show_category">Category</a></li>
                    <li><a href="show_subCategory">SubCategory</a></li>
                </ul>
            </li> --}}
            {{-- <li><a href="{{url('admin/show_affiliators')}}"><i class="icon-globe"></i><span>المسوقين </span></a></li>
            <li><a href="{{url('admin/show_whatsUser_page')}}"><i class="fa fa-whatsapp"></i><span>التواصل عبر الواتس </span></a></li>
            <li><a href="{{url('admin/show_stages')}}"><i class="icon-bar-chart"></i><span>المراحل </span></a></li>
            <li><a href="{{url('admin/show_call')}}"><i class="fa fa-users"></i><span>معلومات التواصل</span></a></li>
            <li><a href="{{url('admin/show_reivew')}}"><i class="icon-diamond"></i><span> اراء العملاء</span></a></li>
            <li><a href="{{url('admin/show_webcontent')}}"><i class="icon-star"></i><span>  محتوى الموقع </span></a></li>
            <li><a href="{{url('admin/show_video')}}"><i class="fa fa-youtube"></i><span>    محتوى الفديو و اللوجو </span></a></li>
            <li><a href="{{url('admin/show_social')}}"><i class="fa fa-share-alt"></i><span> وسائل التواصل الاجتماعى   </span></a></li>
            <li><a href="{{url('admin/show_colorpage')}}"><i class="fa fa-paint-brush"></i><span> تغير اللوان الموقع</span></a></li>
            <li><a href="{{url('admin/show_reservationPage')}}"><i class="fa  fa-money"></i><span> الحجوزات الخارجية</span></a></li>
            <li><a href="{{url('admin/show_addCoupon')}}"><i class="fa  icon-present"></i><span> أضافة كوبون </span></a></li> --}}

            <br>


          </ul>
        </nav>
      </div>
    </div>




  </div>


  <div id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs tab-nav-right" role="tablist">
      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#skins" aria-expanded="true">Mplify</a>
      </li>
      <!--    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact" aria-expanded="false">Contact</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Timeline" aria-expanded="false">Timeline </a></li>
       -->
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane animated fadeIn in active" id="skins" aria-expanded="true">
        <div class="sidebar-scroll">

          <div class="card">
            <div class="header">
              <h2>Color Skins</h2>
            </div>
            <div class="body">
              <ul class="choose-skin list-unstyled">
                <li data-theme="purple">
                  <div class="purple"></div>
                  <span>Purple</span>
                </li>
                <li data-theme="blue" class="active">
                  <div class="blue"></div>
                  <span>Blue</span>
                </li>
                <li data-theme="cyan">
                  <div class="cyan"></div>
                  <span>Cyan</span>
                </li>
                <li data-theme="green">
                  <div class="green"></div>
                  <span>Green</span>
                </li>
                <li data-theme="orange">
                  <div class="orange"></div>
                  <span>Orange</span>
                </li>
                <li data-theme="blush">
                  <div class="blush"></div>
                  <span>Blush</span>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

<script src="{{asset('js/app.js')}}"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Javascript -->
  <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
  <script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>

  <script src="{{asset('assets/bundles/chartist.bundle.js')}}"></script>
  <script src="{{asset('assets/bundles/knob.bundle.js')}}"></script> <!-- Jquery Knob-->
  <script src="{{asset('assets/bundles/flotscripts.bundle.js')}}"></script> <!-- flot charts Plugin Js -->
  <script src="{{asset('assets/vendor/flot-charts/jquery.flot.selection.js')}}"></script>

  <script src="{{asset('assets/vendor/echart/echarts.min.js')}}"></script>

  <script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>

  <script src="{{asset('assets/js/pages/charts/echart.js')}}"></script>

  <script src="{{asset('assets/js/index.js')}}"></script>



  <!-- Javascript -->

  <script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

  <script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script> <!-- SweetAlert Plugin Js -->


  <script src="{{asset('assets/bundles/morrisscripts.bundle.js')}}"></script>
  <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    });

    @if (session('success'))
      Swal.fire({
      icon: 'success',
      title: 'نجاح',
      text: "{{ session('success') }}",
      showConfirmButton: false,
      timer: 2000
      })
    @endif
    @if (session('error'))
      Swal.fire({
      icon: 'error',
      title: 'فشل',
      text: "{{ session('error') }}",
      showConfirmButton: false,
      timer: 2000
      })
    @endif
  </script>
  @stack('scripts')
</body>

</html>
