@extends('layouts.admin_const')

@section('content')

<div class="wrapper">

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2 style="font-size: xx-large;" > اضافة سياسه الخصوصية</h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">اضافة ساسة الخصوصية </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" method="post"action="{{url('admin/add_policy')}}" novalidate enctype="multipart/form-data">
                                                    {{ csrf_field() }}


                                    <div class="form-group">
                                        <label style="    font-size: x-large;">الوصف بالعربى</label>
                                        <input type="text" name='description_ar'  class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label style="    font-size: x-large;">الوصف بالكوردى</label>
                                        <input type="text" name='description_en' class="form-control" required>
                                    </div>

                                    <br>
                                    <button type="submit" name="Add_category"class="btn btn-primary" style="margin-right: 556px;font-size: 22px;">حفظ</button>

                                </form>

                            </div>
                    </div>
                </div>
            </div>

        </div>
</div>
</div>

@endsection
