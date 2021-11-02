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
                            <li class="breadcrumb-item">الاماكن</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">

                            <ul class="nav nav-tabs-new ">
                                <li ><h2 style="font-size: xx-large;">الاقسام الرئيسية :</h2> </li> &nbsp;&nbsp;
                                <li class="nav-item" style="margin-top: -5px;font-size: x-large;"><a class="nav-link"  href="{{url('admin/newPlace')}}">اضافة مكان</a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom text-center">

                                       <thead>
                                        <tr>
                                            <th>الصورة</th>
                                            <th>الأسم بالعربى</th>
                                            <th>الوصف بالعربى</th>
                                            <th>رقم الهاتف</th>
                                            <th>الموقع</th>
                                            <th>مميز</th>
                                            <th>نشط</th>
                                            <th>وقت الانشاء</th>

                                            <th>الأجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($data as $cat)
                                        <tr>
                                            <td>
                                                <?php  $image = $cat->image;

                                                  if( $image == '' && $image == NULL){

                                                  }else{?>
                                                  <img src="{{asset('uploads/places/' . $cat->image)}}" width="80" height="80">
                                                  <?php } ?>
                                            </td>
                                            <td>{{$cat->name_ar}}</td>
                                            <td>{{$cat->description_ar}}</td>
                                            <td>{{$cat->phone}}</td>
                                            <td>
                                                <a href="http://maps.google.com/maps?q=".{{$cat->Latitude}}.",".{{$cat->Longitude}}."&ll=".{{$cat->Latitude}}.",".{{$cat->Longitude}}."&z=14" target="_blank">
                                                    <i class="icon-pointer" style="    font-size: x-large;  "> </i>
                                                </a>
                                            </td>
                                            <td>
                                                <?php if($cat->popular_section ==1 ) {?>
                                                    <h6>فعال</h6>
                                                <?php  }else{ ?>
                                                        <h6>غير فعال</h6>
                                                <?php } ?>
                                            </td>
                                            {{--  <td>
                                                <form action="{{url('admin/subcategory')}}" method="GET"  id="sub_{{$cat->id}}" enctype="multipart/form-data">

                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="category_id" value="{{$cat->id}}">

                                                    <a  onclick="$('#sub_{{$cat->id}}').submit();">

                                                        <button class="btn btn-outline-secondary" data-toggle="tooltip" data-original-title="الى الاقسام الفرعيه">
                                                            أقسام فرعية
                                                        </button>
                                                    </a>

                                                </form>
                                              </td>  --}}
                                              <td>
                                                <div class="form-group">
                                                  <select class="place_status" data-place_id="{{ $cat->id }}">
                                                    <option value="1" {{ $cat->status ? 'selected' : '' }}>نشط</option>
                                                    <option value="0" {{ !$cat->status ? 'selected' : '' }}>غير نشط</option>
                                                  </select>
                                                </div>
                                              </td>
                                            <td>{{$cat->created_at}}</td>
                                            <td>

                                                <form action="{{url('admin/placeDetails')}}" method="GET"  id="sub_{{$cat->id}}" enctype="multipart/form-data" style="display:inline;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="place_id" value="{{$cat->id}}">
                                                    <a  onclick="$('#sub_{{$cat->id}}').submit();">
                                                     <button class="btn btn-info" data-toggle="tooltip" data-original-title="التفاصيل">
                                                             <i class="icon-eye" aria-hidden="true"></i>
                                                     </button>
                                                    </a>
                                                </form>
                                                <form action="{{url('places_delete/'.$cat->id)}}" method="POST"  id="delete_{{$cat->id}}" enctype="multipart/form-data" style="display:inline;">
                                                    {{ csrf_field() }}
                                                    @method('delete')
                                                    {{-- <input type="hidden" name="place_id" value="{{$cat->id}}"> --}}
                                                    <a  onclick="$('#delete_{{$cat->id}}').submit();">
                                                     <button class="btn btn-danger" data-toggle="tooltip" data-original-title="حذف">
                                                             <i class="icon-trash" aria-hidden="true"></i>
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

@push('scripts')
  <script>
    $(document).ready(function() {
          $(document).on('change', '.place_status', function() {
            let status = $(this).val();
            let place_id = $(this).data('place_id');
            $.ajax({
              type: 'POST',
              data: {"place_id": place_id, "status": status},
              url: 'places_status',
              success: function(response) {
                if (response.success == '1' ) {
                  Swal.fire({
                    icon: 'success',
                    title: 'نجاح',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                  });
                } else {
                  Swal.fire({
                      icon: 'error',
                      title: 'فشل',
                      text: "فشل",
                      showConfirmButton: false,
                      timer: 2000
                    });
                  }
                },
                error: function(xhr,code,msg){
                    console.log(xhr);
                    console.log(code);
                    console.log(msg);
                }
            });
          });
          });

  </script>
@endpush
