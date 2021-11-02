@extends('layouts.admin_const')

@section('content')

<div class="wrapper">

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12"style="float: right;margin-left: auto;">
                        <h2 style="font-size: xx-large;" > أرسال رسالة</h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">أرسال رسالة </li>
                        </ul>
                    </div>
                </div>
            </div>


          <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body" >
                            <ul class="nav nav-tabs" style="direction: rtl;">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#user">الى مستخدم</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#all_users">الى الجميع</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="user">

                                    <div class="body">
                                         <form id="basic-form" method="post"action="{{url('admin/notify_user')}}" novalidate enctype="multipart/form-data" >
                                                                   {{ csrf_field() }}


                                                <div class="form-group">
                                                    <label style="    font-size: x-large;"> العنوان </label>
                                                    <input type="text" name='title'  class="form-control" >
                                                </div>


                                                <div class="form-group">
                                                    <label style="    font-size: x-large;">المحتوى </label>
                                                    <input type="text" name='body'  class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label style="    font-size: x-large;">الصورة </label>
                                                    <input type="file" name='image'  class="form-control" >
                                                </div>

                                                <div class="form-group">
                                                    <label style="    font-size: x-large;">المستخدم </label>


                                                    <select class="form-control "  name="user_id" style="direction: rtl" >
                                                      <option style="display: none;">اختار  مستخدم</option>

                                                        <?php  $get_data = \App\Models\User::select('id','username')->where('role' , 2)->get();   ?>
                                                        @foreach($get_data as $data)
                                                            <option value="{{$data->id}}">{{$data->username}}</option>
                                                           @endforeach
                                                  </select>
                                                </div>



                                                <br>
                                                <button type="submit" name="Add_review"class="btn btn-primary" style="margin-right: 556px;font-size: 22px;">حفظ</button>

                                            </form>
                                     </div>


                                </div>
                                <div class="tab-pane" id="all_users">

                                        <div class="body">
                                         <form id="basic-form" method="post"action="{{url('admin/notify_alluser')}}" novalidate enctype="multipart/form-data" >
                                                                   {{ csrf_field() }}


                                                <div class="form-group">
                                                    <label style="    font-size: x-large;"> العنوان </label>
                                                    <input type="text" name='title'  class="form-control" >
                                                </div>


                                                <div class="form-group">
                                                    <label style="    font-size: x-large;">المحتوى </label>
                                                    <input type="text" name='body'  class="form-control" >
                                                </div>
                                                <div class="form-group">
                                                    <label style="    font-size: x-large;">الصورة </label>
                                                    <input type="file" name='image'  class="form-control" >
                                                </div>
                                                <br>
                                                <button type="submit" name="Add_review"class="btn btn-primary" style="margin-right: 556px;font-size: 22px;">حفظ</button>

                                            </form>
                                     </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


        </div>
</div>
</div>

@endsection
