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
                <li class="breadcrumb-item"><a href="{{url('admin/home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">المشرفين</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col-lg-12">
            <div class="card">
              <div class="header">

                <ul class="nav nav-tabs-new ">
                  <li>
                    <h2 style="font-size: xx-large;">المشرفين :</h2>
                  </li> &nbsp;&nbsp;
                  <li class="nav-item" style="margin-top: -5px;font-size: x-large;"><a class="nav-link"
                      href="{{url('admin/supervisors_create') }}">اضافة مشرف</a></li>
                </ul>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover js-basic-example dataTable table-custom text-center">

                    <thead>
                      <tr>
                        <th>الاسم </th>
                        <th>الإيميل</th>
                        <th>رقم الهاتف</th>
                        <th>عدد الأماكن</th>
                        <th>نشط</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sups as $sup)
                        <tr>

                          <td>{{ $sup->username }}</td>
                          <td>{{ $sup->email }}</td>
                          <td>{{ $sup->phone }}</td>
                        <td>{{ $sup->places->count() }}</td>
                          <td>
                            <div class="form-group">
                              <select class="supervisor_status" data-user_id="{{ $sup->id }}">
                                <option value="1" {{ $sup->status ? 'selected' : '' }}>نشط</option>
                                <option value="0" {{ !$sup->status ? 'selected' : '' }}>غير نشط</option>
                              </select>
                            </div>
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
          $(document).on('change', '.supervisor_status', function() {
            let status = $(this).val();
            let user_id = $(this).data('user_id');
            $.ajax({
              type: 'POST',
              data: {"user_id": user_id, "status": status},
              url: 'supervisors_status',
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
