@extends('layouts.admin_const')

@section('content')



<div id="wrapper">



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                       <!--<h2>Jquery Datatable</h2>-->
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">المحافظات</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">

                            <ul class="nav nav-tabs-new ">
                                <li><h2 style="font-size: xx-large;">الاقسام الرئيسية :</h2> </li> &nbsp;&nbsp;
                                <li class="nav-item" style="margin-top: -5px;font-size: x-large;"><a class="nav-link"  href="{{url('admin/newCity')}}">اضافة محافظة</a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom text-center">

                                       <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الأسم بالعربى</th>
                                            <th>الاسم بالكوردى</th>
                                            <th>المدن</th>
                                            <th>وقت الانشاء</th>

                                            <th>تعديل</th>
                                            <th>مسح</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($data as $cat)
                                        <tr>
                                            <td>{{$cat->id}}</td>
                                            <td>{{$cat->name_ar}}</td>
                                            <td>{{$cat->name_en}}</td>

                                            <td>
                                                <form action="{{url('admin/area')}}" method="GET"  id="sub_{{$cat->id}}" enctype="multipart/form-data">

                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="city_id" value="{{$cat->id}}">

                                                    <a  onclick="$('#sub_{{$cat->id}}').submit();">

                                                        <button class="btn btn-outline-secondary" data-toggle="tooltip" data-original-title="الى المدن">
                                                            المدن
                                                        </button>
                                                    </a>

                                                </form>
                                              </td>
                                            <td>{{$cat->created_at}}</td>

                                            <td>


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


                                            </td>
                                        </tr>
                                      @endforeach

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





@endsection
