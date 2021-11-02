@extends('layouts.admin_const')
@push('styles')
@endpush
@section('content')

  <div class="wrapper">

    <div id="main-content">
      <div class="container-fluid">
        <div class="block-header">
          <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
              <h2 style="font-size: xx-large;"> إضافة مشرف</h2>
            </div>
            <div class="col-lg-7 col-md-4 col-sm-12">
              <ul class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{url('admin/home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">إضافة مشرف </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col-md-12">
            <div class="card">
              <div class="body">
                <form id="basic-form" method="post" action="{{url('admin/supervisors_store') }}"
                  enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="username">الاسم</label>
                      <input required type="text" class="form-control" name='username' value="{{ old('username') }}"
                        id="username" placeholder="الاسم">
                      @if ($errors->has('username'))
                        <div class="error text-danger">{{ $errors->first('username') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email">الإيميل</label>
                      <input required type="email" class="form-control" name='email' value="{{ old('email') }}"
                        id="email" placeholder="الإيميل">
                      @if ($errors->has('email'))
                        <div class="error text-danger">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-4">
                      <label for="phone_user">الموبايل</label>
                      <input required type="text" class="form-control" name='phone_user' value="{{ old('phone_user') }}"
                        id="phone_user" placeholder="الموبايل">
                      @if ($errors->has('phone_user'))
                        <div class="error text-danger">{{ $errors->first('phone_user') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="password">كلمة المرور</label>
                      <input required type="password" class="form-control" name='password' value="{{ old('password') }}"
                        id="password" placeholder="كلمة المرور">
                      @if ($errors->has('password'))
                        <div class="error text-danger">{{ $errors->first('password') }}</div>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password_confirmation">تأكيد كلمة المرور</label>
                      <input required type="password" class="form-control" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" id="password_confirmation"
                        placeholder="تأكيد كلمة المرور">
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary" style="margin-right: 556px;font-size: 22px;">حفظ</button>

                </form>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection

@push('scripts')
@endpush
