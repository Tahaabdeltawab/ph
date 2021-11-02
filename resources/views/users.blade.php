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
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">المستخدمين</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">

                            <ul class="nav nav-tabs-new ">
                                {{--  <li class="nav-item" style="margin-top: -5px;margin-left: 7px;font-size: x-large;margin-left: auto;"><a class="nav-link"  href="{{url('admin/show_addUser')}}">اضافة مستخدم</a></li>  --}}
                                <li><h2 style="font-size: xx-large;">جميع المستخدمين:</h2> </li> &nbsp;&nbsp;
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom text-center">

                                       <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الأسم</th>
                                            <th>البريد الالكترونى</th>
                                            <th>رقم الهاتف</th>
                                            <th>وقت الانشاء</th>

                                            {{--  <th>تعديل</th>  --}}
                                            <th>مسح</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($get_users as $x)
                                        <tr>
                                            <td>{{$x->id}}</td>
                                            <td>{{$x->username}}</td>
                                            <td>{{$x->email}}</td>
                                            <td>{{$x->phone}}</td>
                                            <td>{{$x->created_at}}</td>
                                            <td>
                                               <form action="{{url('admin/delete_user')}}" method="GET"  id="sub_{{$x->id}}" enctype="multipart/form-data">

                                                   {{ csrf_field() }}

                                                   <input type="hidden" name="user_id" value="{{$x->id}}">

                                                   <a  onclick="$('#sub_{{$x->id}}').submit();">

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
