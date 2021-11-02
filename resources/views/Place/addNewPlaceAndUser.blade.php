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
              <h2 style="font-size: xx-large;"> إضافة المستخدم والمكان</h2>
            </div>
            <div class="col-lg-7 col-md-4 col-sm-12">
              <ul class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{url('admin/home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">إضافة المستخدم والمكان </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col-md-12">
            <div class="card">
              <div class="body">
                <form id="basic-form" method="post" action="{{url('admin/savePlaceAndUser') }}"
                  enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <h3>بيانات المستخدم</h3>
                  <hr><br>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="user_type">نوع المستخدم</label>
                      <select name="user_type" id="user_type" class="form-control">
                          <option value="present" {{old('user_type') == 'present' ? 'selected' : ''}}>موجود</option>
                          <option value="new" {{old('user_type') == 'new' ? 'selected' : ''}}>جديد</option>
                      </select>
                    </div>
                    </div>
                    <br><hr><br>

                  <div id="present_form_group" {{-- style="display:none;" --}}>
                  <div class="form-group col-md-6">
                        <label for="users">المستخدمين</label>
                        <select class="form-control text-right " id="users" name="user_id" style="direction: rtl" required>
                          <option style="display:none">أختر صاحب المكان</option>
                          @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                          @endforeach
                        </select>
                      </div>
                      </div>

                <div id="new_form_group" style="display:none;">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="username">الاسم</label>
                      <input type="text" class="form-control" name='username' value="{{ old('username') }}"
                        id="username" placeholder="الاسم">
                      @if ($errors->has('username'))
                        <div class="error text-danger">{{ $errors->first('username') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email">الإيميل</label>
                      <input type="email" class="form-control" name='email' value="{{ old('email') }}"
                        id="email" placeholder="الإيميل">
                      @if ($errors->has('email'))
                        <div class="error text-danger">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-4">
                      <label for="phone_user">الموبايل</label>
                      <input type="text" class="form-control" name='phone_user' value="{{ old('phone_user') }}"
                        id="phone_user" placeholder="الموبايل">
                      @if ($errors->has('phone_user'))
                        <div class="error text-danger">{{ $errors->first('phone_user') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="password">كلمة المرور</label>
                      <input type="password" class="form-control" name='password' value="{{ old('password') }}"
                        id="password" placeholder="كلمة المرور">
                      @if ($errors->has('password'))
                        <div class="error text-danger">{{ $errors->first('password') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password_confirmation">تأكيد كلمة المرور</label>
                      <input type="password" class="form-control" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" id="password_confirmation"
                        placeholder="تأكيد كلمة المرور">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="city_user">المحافظة</label>
                      <select name="city_id_user" id="city_user" class="form-control">
                        {{-- <option selected disabled>اختر...</option> --}}
                        @foreach ($city as $citys)
                          <option value="{{ $citys->id }}" {{old('city_id_user') == $citys->id ? 'selected' : ''}}>
                            {{ $citys->name_ar }} -- {{ $citys->name_en }}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('city_id_user'))
                        <div class="error text-danger">{{ $errors->first('city_id_user') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="area_user">المدينة</label>
                      <select name="area_id_user" id="area_user" class="form-control">
                      </select>
                      @if ($errors->has('area_id_user'))
                        <div class="error text-danger">{{ $errors->first('area_id_user') }}</div>
                      @endif
                    </div>
                  </div>
                  </div>

                  <br>
                  <br>
                  <h3>بيانات المكان</h3>
                  <hr><br>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>الاسم بالعربى</label>
                      <input type="text" name='name_ar' value="{{ old('name_ar') }}" class="form-control" required>
                      @if ($errors->has('name_ar'))
                        <div class="error text-danger">{{ $errors->first('name_ar') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label>الاسم بالكردي</label>
                      <input type="text" name='name_en' value="{{ old('name_en') }}" class="form-control" required>
                      @if ($errors->has('name_en'))
                        <div class="error text-danger">{{ $errors->first('name_en') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>رقم الهاتف</label>
                      <input type="text" name='phone_place' value="{{ old('phone_place') }}" class="form-control"
                        required>
                      @if ($errors->has('phone_place'))
                        <div class="error text-danger">{{ $errors->first('phone_place') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label>الصورة </label>
                      <input type="file" name='image' class="form-control">
                      @if ($errors->has('image'))
                        <div class="error text-danger">{{ $errors->first('image') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>الوصف بالعربى</label>
                      <input type="text" name='description_ar' value="{{ old('description_ar') }}" class="form-control">
                      @if ($errors->has('description_ar'))
                        <div class="error text-danger">{{ $errors->first('description_ar') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label>الوصف بالكردي</label>
                      <input type="text" name='description_en' value="{{ old('description_en') }}" class="form-control">
                      @if ($errors->has('description_en'))
                        <div class="error text-danger">{{ $errors->first('description_en') }}</div>
                      @endif
                    </div>
                  </div>


                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>القسم الرئيسى</label>
                      <select class="form-control formselect required" placeholder="Select Category"
                        id="sub_category_name" name="main_category_id">
                        {{-- <option value="0" disabled selected>أختر القسم الرئيسى</option> --}}
                        @foreach ($data as $categories)
                          <option value="{{ $categories->id }}" {{old('main_category_id') == $categories->id ? 'selected' : ''}}>
                            {{ $categories->name_ar }} -- {{ $categories->name_en }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label>القسم الفرعى</label>
                      <select class="form-control formselect required" placeholder="أختر القسم الفرعى" id="sub_category"
                        name="subCategory_id">
                      </select>
                      @if ($errors->has('subCategory_id'))
                        <div class="error text-danger">{{ $errors->first('subCategory_id') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>المحافظات</label>
                      <select class="form-control formselect required" placeholder="Select Category" id="city_place"
                        required name="city_id_place">
                        {{-- <option value="0" disabled selected>أختر المحافظة</option> --}}
                        @foreach ($city as $citys)
                          <option value="{{ $citys->id }}" {{old('city_id_place') == $citys->id ? 'selected' : ''}}>
                            {{ $citys->name_ar }} -- {{ $citys->name_en }}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('city_id_place'))
                        <div class="error text-danger">{{ $errors->first('city_id_place') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label>المدينة</label>
                      <select class="form-control formselect required" placeholder="أختر المدينة" id="area_place" required
                        name="area_id_place">
                      </select>
                      @if ($errors->has('area_id_place'))
                        <div class="error text-danger">{{ $errors->first('area_id_place') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>FaceBook link</label>
                      <input type="text" name='Facebook' value="{{ old('Facebook') }}" class="form-control">
                      @if ($errors->has('Facebook'))
                        <div class="error text-danger">{{ $errors->first('Facebook') }}</div>
                      @endif
                    </div>

                    <div class="form-group col-md-6">
                      <label>Twitter link</label>
                      <input type="text" name='Twitter' value="{{ old('Twitter') }}" class="form-control">
                      @if ($errors->has('Twitter'))
                        <div class="error text-danger">{{ $errors->first('Twitter') }}</div>
                      @endif
                    </div>
                  </div>
                  <br>
                  <button type="submit" class="btn btn-primary" style="margin-right: 556px;font-size: 22px;">حفظ</button>

                </form>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
</div>

{{-- @push('scripts') --}}
{{-- 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('#users').select2({
      dir: "rtl"
    });

    @if (session('success'))
    Swal.fire({
      icon: 'success',
      title: 'نجاح',
      text: "{{session('success')}}",
      showConfirmButton: false,
      timer: 2000
    })
    @elseif(session('error'))
    Swal.fire({
      icon: 'error',
      title: 'فشل',
      text: "{{session('error')}}",
      showConfirmButton: false,
      timer: 2000
    })
    @endif

    $(document).ready(function() {
 setTimeout(() => {
        $('#user_type, #city_user, #city_place, #sub_category_name' ).trigger('change');
        }, 1000);

      $('#user_type').on('change', function() {
          let user_type = $(this).val();
          if (user_type == 'new') {
          $('#new_form_group').show()
          $('#present_form_group').hide()
          }else{
          $('#present_form_group').show()
          $('#new_form_group').hide()
          }
      });

        
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
            // $('#sub_category').append(`<option value="0" disabled selected>أختر القسم الفرعى</option>`);
                var sub_cat_id = "{{old('subCategory_id')}}";
            response.forEach(element => {
                var html = (sub_cat_id.length > 0 && sub_cat_id == element['id'])
                ? `<option value="${element['id']}" selected >${element['name_ar']} -- ${element['name_en']}</option>`
                : `<option value="${element['id']}">${element['name_ar']} -- ${element['name_en']}</option>`;
              $('#sub_category').append(html);
            });
          }
        });
      });


       
      $('#city_user').on('change', function() {
        let ids = $(this).val();
        $('#area_user').empty();
        $('#area_user').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
          type: 'GET',
          url: 'AreaData_byCityId/' + ids,
          success: function(response) {
            var response = JSON.parse(response);
            console.log(response);
            $('#area_user').empty();
            // $('#area_user').append(`<option value="0" disabled selected>أختر المدينة</option>`);
            var area_id_user = "{{old('area_id_user')}}";
            response.forEach(element => {
                var html = (area_id_user.length > 0 && area_id_user == element['id'])
                ? `<option value="${element['id']}" selected>${element['name_ar']} -- ${element['name_en']}</option>`
                : `<option value="${element['id']}">${element['name_ar']} -- ${element['name_en']}</option>`;
              $('#area_user').append(html);
            });
          }
        });
      });

      $('#city_place').on('change', function() {
        let ids = $(this).val();
        $('#area_place').empty();
        $('#area_place').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
          type: 'GET',
          url: 'AreaData_byCityId/' + ids,
          success: function(response) {
            var response = JSON.parse(response);
            console.log(response);
            $('#area_place').empty();
            // $('#area_place').append(`<option value="0" disabled selected>أختر المدينة</option>`);
            var area_id_place = "{{old('area_id_place')}}";
            response.forEach(element => {
                var html = (area_id_place.length > 0 && area_id_place == element['id'])
                ? `<option value="${element['id']}" selected>${element['name_ar']} -- ${element['name_en']}</option>`
                : `<option value="${element['id']}">${element['name_ar']} -- ${element['name_en']}</option>`;
              $('#area_place').append(html);
            });
          }
        });
      });
    });

  </script>
{{-- @endpush --}}
@endsection

