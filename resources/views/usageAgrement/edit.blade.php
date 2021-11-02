@extends('layouts.admin_const')

@section('content')

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12" >
                        <h2 style="font-size: xx-large;"> :تعديل  البيانات </h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> اتفاقية الاستخدام</li>
                        </ul>
                    </div>
                </div>
            </div>



             <div class="body">
                 <form id="basic-form" method="post"action="{{url('admin/update_agreement')}}" novalidate enctype="multipart/form-data">
                                           {{ csrf_field() }}

                        @foreach($data as $cat)

                        <input type="hidden" name="usage_id" value="{{$cat->id}}">

                        <div class="form-group">
                            <label style="    font-size: x-large;">الوصف بالعربى</label>
                            <input type="text" name='description_ar' value="{{$cat->description_ar}}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label style="    font-size: x-large;">الوصف بالكوردى</label>
                            <input type="text" name='description_en' value="{{$cat->description_en}}" class="form-control" required>
                        </div>


                        <br>
                        <button type="submit" name="edit_category"class="btn btn-primary" style="margin-right: 556px;font-size: 22px;">حفظ</button>
                          @endforeach
                    </form>
             </div>


        </div>
</div>

@endsection
