@extends('layouts.admin_const')

@section('content')

<div class="wrapper">

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2 style="font-size: xx-large;" > تفاصيل المكان</h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">تفاصيل المكان </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body" >
                            <ul class="nav nav-tabs" style="direction: rtl;">
                                <li class="nav-item" style="font-size: large;"><a class="nav-link active show" data-toggle="tab" href="#AboutUs">عن المكان</a></li>
                                <li class="nav-item" style="font-size: large;"><a class="nav-link" data-toggle="tab" href="#Services">الخدمات</a></li>
                                <li class="nav-item" style="font-size: large;"><a class="nav-link" data-toggle="tab" href="#products">المنتجات</a></li>
                                <li class="nav-item" style="font-size: large;"><a class="nav-link" data-toggle="tab" href="#Offers">العروض</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="AboutUs">

                                    {{--  <div class="body">  --}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom text-center">

                                                   <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>التفاصيل بالعربى</th>
                                                        <th>التفاصيل بالكوردى</th>
                                                {{--    <th>تعديل</th>
                                                        <th>مسح</th>  --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($aboutUs as $about)
                                                    <tr>
                                                        <td>{{$about->id}}</td>
                                                        <td><pre>{{$about->details_ar}}</pre></td>
                                                        <td><pre>{{$about->details_en}}</pre></td>


                                                        {{--  <td>

                                                            <form action="{{url('admin/editCity')}}" method="GET"  id="sub_{{$cat->id}}" enctype="multipart/form-data">

                                                                {{ csrf_field() }}

                                                                <input type="hidden" name="city_id" value="{{$cat->id}}">

                                                                <a  onclick="$('#sub_{{$cat->id}}').submit();">

                                                                 <button class="btn btn-info" data-toggle="tooltip" data-original-title="تعديل">
                                                                         <i class="fa fa-edit" aria-hidden="true"></i>
                                                                 </button>
                                                                </a>

                                                            </form>

                                                         </td>

                                                        <td>
                                                           <form action="{{url('admin/delete_city')}}" method="GET"  id="sub_{{$cat->id}}" enctype="multipart/form-data">

                                                               {{ csrf_field() }}

                                                               <input type="hidden" name="city_id" value="{{$cat->id}}">

                                                               <a  onclick="$('#sub_{{$cat->id}}').submit();">

                                                                <button class="btn btn-danger  btn-icon " data-toggle="tooltip" data-original-title="مسح">
                                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                </button>
                                                               </a>

                                                           </form>

                                                        </td>   --}}
                                                    </tr>
                                                  @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                     {{--  </div>  --}}


                                </div>
                                <div class="tab-pane show " id="Services">

                                    {{--  <div class="body">  --}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom text-center">

                                                   <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>التفاصيل بالعربى</th>
                                                        <th>التفاصيل بالكوردى</th>
                                                {{--    <th>تعديل</th>
                                                        <th>مسح</th>  --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($services as $serv)
                                                    <tr>
                                                        <td>{{$serv->id}}</td>
                                                        <td><pre>{{$serv->details_ar}}</pre></td>
                                                        <td><pre>{{$serv->details_en}}</pre></td>


                                                        {{--  <td>

                                                            <form action="{{url('admin/editCity')}}" method="GET"  id="sub_{{$serv->id}}" enctype="multipart/form-data">

                                                                {{ csrf_field() }}

                                                                <input type="hidden" name="serve_id" value="{{$serv->id}}">

                                                                <a  onclick="$('#sub_{{$serv->id}}').submit();">

                                                                 <button class="btn btn-info" data-toggle="tooltip" data-original-title="تعديل">
                                                                         <i class="fa fa-edit" aria-hidden="true"></i>
                                                                 </button>
                                                                </a>

                                                            </form>

                                                         </td>

                                                        <td>
                                                           <form action="{{url('admin/delete_city')}}" method="GET"  id="sub_{{$serv->id}}" enctype="multipart/form-data">

                                                               {{ csrf_field() }}

                                                               <input type="hidden" name="city_id" value="{{$serv->id}}">

                                                               <a  onclick="$('#sub_{{$serv->id}}').submit();">

                                                                <button class="btn btn-danger  btn-icon " data-toggle="tooltip" data-original-title="مسح">
                                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                </button>
                                                               </a>

                                                           </form>

                                                        </td>   --}}
                                                    </tr>
                                                  @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                     {{--  </div>  --}}


                                </div>
                                <div class="tab-pane show " id="products">

                                    {{--  <div class="body">  --}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom text-center">

                                                   <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>الصورة</th>
                                                        <th>الاسم بالعربى</th>
                                                        <th>الأسم بالكوردى</th>
                                                        <th>التفاصيل بالعربى</th>
                                                        <th>التفاصيل بالكوردى</th>
                                                        <th>السعر</th>
                                                {{--    <th>تعديل</th>
                                                        <th>مسح</th>  --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($products as $pro)
                                                    <tr>
                                                        <td>{{$pro->id}}</td>
                                                        <td>
                                                            <?php  $image = $pro->image;

                                                              if( $image == '' && $image == NULL){?>
                                                                    <h5>لا يوجد</h5>
                                                              <?php }else{?>
                                                              <img src="{{asset('uploads/products/' . $pro->image)}}" width="80" height="80">
                                                              <?php } ?>
                                                        </td>
                                                        <td>{{$pro->name_ar}}</td>
                                                        <td>{{$pro->name_en}}</td>
                                                        <td><pre>{{$pro->description_ar}}</pre></td>
                                                        <td><pre>{{$pro->description_en}}</pre></td>
                                                        <td>{{$pro->price}}</td>

                                                        {{--  <td>

                                                            <form action="{{url('admin/editCity')}}" method="GET"  id="sub_{{$pro->id}}" enctype="multipart/form-data">

                                                                {{ csrf_field() }}

                                                                <input type="hidden" name="city_id" value="{{$pro->id}}">

                                                                <a  onclick="$('#sub_{{$pro->id}}').submit();">

                                                                 <button class="btn btn-info" data-toggle="tooltip" data-original-title="تعديل">
                                                                         <i class="fa fa-edit" aria-hidden="true"></i>
                                                                 </button>
                                                                </a>

                                                            </form>

                                                         </td>

                                                        <td>
                                                           <form action="{{url('admin/delete_city')}}" method="GET"  id="sub_{{$pro->id}}" enctype="multipart/form-data">

                                                               {{ csrf_field() }}

                                                               <input type="hidden" name="city_id" value="{{$pro->id}}">

                                                               <a  onclick="$('#sub_{{$pro->id}}').submit();">

                                                                <button class="btn btn-danger  btn-icon " data-toggle="tooltip" data-original-title="مسح">
                                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                </button>
                                                               </a>

                                                           </form>

                                                        </td>   --}}
                                                    </tr>
                                                  @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                     {{--  </div>  --}}


                                </div>
                                <div class="tab-pane show " id="Offers">

                                    {{--  <div class="body">  --}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom text-center">

                                                   <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>العنوان بالعربى</th>
                                                        <th>العنوان بالكوردى</th>
                                                        <th>كود</th>
                                                        <th>النسبة</th>
                                                {{--    <th>تعديل</th>
                                                        <th>مسح</th>  --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($offers as $offer)
                                                    <tr>
                                                        <td>{{$offer->id}}</td>
                                                        <td><pre>{{$offer->title_ar}}</pre></td>
                                                        <td><pre>{{$offer->title_en}}</pre></td>
                                                        <td>{{$offer->code}}</td>
                                                        <td>{{$offer->present}}</td>

                                                        {{--  <td>

                                                            <form action="{{url('admin/editCity')}}" method="GET"  id="sub_{{$offer->id}}" enctype="multipart/form-data">

                                                                {{ csrf_field() }}

                                                                <input type="hidden" name="city_id" value="{{$offer->id}}">

                                                                <a  onclick="$('#sub_{{$offer->id}}').submit();">

                                                                 <button class="btn btn-info" data-toggle="tooltip" data-original-title="تعديل">
                                                                         <i class="fa fa-edit" aria-hidden="true"></i>
                                                                 </button>
                                                                </a>

                                                            </form>

                                                         </td>

                                                        <td>
                                                           <form action="{{url('admin/delete_city')}}" method="GET"  id="sub_{{$offer->id}}" enctype="multipart/form-data">

                                                               {{ csrf_field() }}

                                                               <input type="hidden" name="city_id" value="{{$offer->id}}">

                                                               <a  onclick="$('#sub_{{$offer->id}}').submit();">

                                                                <button class="btn btn-danger  btn-icon " data-toggle="tooltip" data-original-title="مسح">
                                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                </button>
                                                               </a>

                                                           </form>

                                                        </td>   --}}
                                                    </tr>
                                                  @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                     {{--  </div>  --}}


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
</div>

@endsection
