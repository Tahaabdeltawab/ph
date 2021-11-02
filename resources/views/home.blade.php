<?php
use App\Models\User;
use App\Models\Place;
use App\Models\SubCategory;
$users = User::where('role', 2)->count();
$places = Place::count();
$subcategory = SubCategory::count();
?>

@extends('layouts.admin_const')

@section('content')

  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-5 col-md-8 col-sm-12">
            <h2>لوحه التحكم</h2>
          </div>
          <div class="col-lg-7 col-md-4 col-sm-12 text-right">
            <ul class="breadcrumb justify-content-end">
              <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item active">لوحة التحكم</li>


            </ul>
          </div>

        </div>

      </div>

      <div class="row clearfix">
        <div class="col-12">
          <div class="card top_report">
            <div class="row">
              @if (auth()->user()->isAdmin())
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="body">
                    <div class="clearfix">
                      <div class="float-right">
                        <i class="fa fa-2x  fa-users text-col-blue"></i>
                      </div>
                      <div class="number ">
                        <h6>المستخدمين</h6>
                        <span class="font700">{{ $users }}</span>
                      </div>
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                      <div class="progress-bar" data-transitiongoal="{{ $users }}"></div>
                    </div>
                    {{-- <small class="text-muted">19% compared to last week</small> --}}
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="body">
                    <div class="clearfix">
                      <div class="float-right">
                        <i class="fa fa-2x fa-bank text-col-green"></i>
                      </div>
                      <div class="number ">
                        <h6>الاماكن</h6>
                        <span class="font700">{{ $places }}</span>
                      </div>
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                      <div class="progress-bar" data-transitiongoal="{{ $places }}"></div>
                    </div>
                    {{-- <small class="text-muted">19% compared to last week</small> --}}
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="body">
                    <div class="clearfix">
                      <div class="float-right">
                        <i class="fa fa-2x icon-diamond text-col-red"></i>
                      </div>
                      <div class="number">
                        <h6>الأقسام</h6>
                        <span class="font700">{{ $subcategory }}</span>
                      </div>
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                      <div class="progress-bar" data-transitiongoal="{{ $subcategory }}"></div>
                    </div>
                    {{-- <small class="text-muted">19% compared to last week</small> --}}
                  </div>
                </div>
              @elseif (auth()->user()->isSupervisor())
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="body">
                    <div class="clearfix">
                      <div class="float-right">
                        <i class="fa fa-2x fa-bank text-col-green"></i>
                      </div>
                      <div class="number ">
                        <h6>الاماكن</h6>
                        <span class="font700">{{ auth()->user()->places->count() }}</span>
                      </div>
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                      <div class="progress-bar" data-transitiongoal="{{ $places }}"></div>
                    </div>
                    {{-- <small class="text-muted">19% compared to last week</small> --}}
                  </div>
                </div>
              @endif
              {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-thumbs-up text-col-yellow"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>LIKES</h6>
                                            <span class="font700">21,215</span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-yellow mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="75"></div>
                                    </div>
                                    <small class="text-muted">19% compared to last week</small>
                                </div>
                            </div> --}}
            </div>
          </div>
        </div>
      </div>




    </div>
  </div>


@endsection
