@extends('layouts.admin_const')

@section('content')

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12" >
                        <h2 style="font-size: xx-large;"> تعديل بيانات القسم الفرعى :</h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> بيانات القسم الفرعى</li>
                        </ul>
                    </div>
                </div>
            </div>

            <br><br>

             <div class="body">
                 <form id="basic-form" method="post"action="{{url('admin/update_subcategory')}}" novalidate enctype="multipart/form-data">
                                           {{ csrf_field() }}

                        @foreach($data as $cat)

                        <input type="hidden" name="subcategory_id" value="{{$cat->id}}">

                        <div class="form-group">
                            <label style="    font-size: x-large;">الأسم بالعربى</label>
                            <input type="text" name='name_ar' value="{{$cat->name_ar}}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label style="    font-size: x-large;">الاسم بالكوردى</label>
                            <input type="text" name='name_en' value="{{$cat->name_en}}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label style="    font-size: x-large;">الصورة </label>

                            <input type="file" name="image"  class="form-control" required>
                        </div>
                        <?php
                            $image = $cat->image;

                            if( $image == '' && $image == NULL){

                            }else{?>
                                    &nbsp;  &nbsp;<img src="{{asset('uploads/category/' . $cat->image)}}" width="280" height="100"><br><br><br>
                            <?php } ?>

                        <br>

                        <div class="form-group">
                            <label style="    font-size: x-large;"> الصورة المفرغه </label>

                            <input type="file" name="sub_image"  class="form-control" required>
                        </div>
                        <?php
                            $subimage = $cat->sub_image;

                            if( $subimage == '' && $subimage == NULL){

                            }else{?>
                                    &nbsp;  &nbsp;<img src="{{asset('uploads/category/' . $cat->sub_image)}}" width="280" height="100"><br><br><br>
                            <?php } ?>


                        <button type="submit" name="edit_category"class="btn btn-primary" style="margin-right: 556px;font-size: 22px;">حفظ</button>
                          @endforeach
                    </form>
             </div>


        </div>
</div>

@endsection
