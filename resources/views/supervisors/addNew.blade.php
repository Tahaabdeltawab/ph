@extends('layouts.admin_const')
{{-- @section('styles') --}}
{{-- @endsection --}}
@section('content')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <div class="wrapper">

    <div id="main-content">
      <div class="container-fluid">
        <div class="block-header">
          <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
              <h2 style="font-size: xx-large;"> اضافة مكان</h2>
            </div>
            <div class="col-lg-7 col-md-4 col-sm-12">
              <ul class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{url('admin/home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">اضافة مكان </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col-md-12">
            <div class="card">
              <div class="body">
                <form id="basic-form" method="post" action="{{url('admin/add_place') }}" novalidate
                  enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="form-group">
                    <label style="    font-size: large;">الأسم بالعربى</label>
                    <input type="text" name='name_ar' class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label style="    font-size: large;">الأسم بالكوردى</label>
                    <input type="text" name='name_en' class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">الصورة </label>

                    <input type="file" name="image" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">الوصف بالعربى</label>
                    <input type="text" name='description_ar' class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">الوصف بالكوردى</label>
                    <input type="text" name='description_en' class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">رقم الهاتف</label>
                    <input type="number" name='phone' class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">القسم الرئيسى</label>
                    <select class="form-control formselect required" placeholder="Select Category" id="sub_category_name">
                      <option value="0" disabled selected>أختر القسم الرئيسى</option>
                      @foreach ($data as $categories)
                        <option value="{{ $categories->id }}">
                          {{ $categories->name_ar }} -- {{ $categories->name_en }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">القسم الفرعى</label>
                    <select class="form-control formselect required" placeholder="أختر القسم الفرعى" id="sub_category"
                      name="subCategory_id">
                    </select>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">المحافظات</label>
                    <select class="form-control formselect required" placeholder="Select Category" id="city_data"
                      name="city_id">
                      <option value="0" disabled selected>أختر المحافظة</option>
                      @foreach ($city as $citys)
                        <option value="{{ $citys->id }}">
                          {{ $citys->name_ar }} -- {{ $citys->name_en }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label style="    font-size: large;">المدينة</label>
                    <select class="form-control formselect required" placeholder="أختر المدينة" id="area" name="area_id">
                    </select>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">FaceBook link</label>
                    <input type="text" name='Facebook' class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: large;">Twitter link</label>
                    <input type="text" name='Twitter' class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label style="    font-size: x-large;">المستخدمين</label>

                    <select class="form-control text-right " id="users" name="user_id" style="direction: rtl" required>
                      <option style="display:none">أختر صاحب المكان</option>

                      @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                      @endforeach

                    </select>
                  </div>
                  <br>
                  <button type="submit" name="Add_category" class="btn btn-primary"
                    style="margin-right: 556px;font-size: 22px;">حفظ</button>

                </form>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  {{-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('#users').select2({
      dir: "rtl"
    });

    $(document).ready(function() {
      $('#sub_category_name').on('change', function() {
        let id = $(this).val();
        $('#sub_category').empty();
        $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
          type: 'GET',
          url: 'myformAjax/' + id,
          success: function(response) {
            var response = JSON.parse(response);
            console.log(response);
            $('#sub_category').empty();
            $('#sub_category').append(`<option value="0" disabled selected>أختر القسم الفرعى</option>`);
            response.forEach(element => {
              $('#sub_category').append(
                `<option value="${element['id']}">${element['name_ar']} -- ${element['name_en']}</option>`
                );
            });
          }
        });
      });
    });


    $(document).ready(function() {
      $('#city_data').on('change', function() {
        let ids = $(this).val();
        $('#area').empty();
        $('#area').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
          type: 'GET',
          url: 'AreaData_byCityId/' + ids,
          success: function(response) {
            var response = JSON.parse(response);
            console.log(response);
            $('#area').empty();
            $('#area').append(`<option value="0" disabled selected>أختر المدينة</option>`);
            response.forEach(element => {
              $('#area').append(
                `<option value="${element['id']}">${element['name_ar']} -- ${element['name_en']}</option>`
                );
            });
          }
        });
      });
    });

  </script>
@endsection

{{-- @section('scripts') --}}

{{-- @endsection --}}
