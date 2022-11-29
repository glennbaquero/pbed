@extends('web.dashboard-master')

@section('meta:title', 'My Account')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('web.profiles.show') }}" class="fntwght--semibold"><h4 class="fntwght--semibold font-1"><i class="fa fa-chevron-left btn--back"></i>My Account</h4></a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('web.profiles.show') }}">My Account</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Change Password</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row no-gutters">
            <div class="col-12">
                <change-password submit-url="{{ route('web.profiles.change-password') }}"></change-password>
            </div>
        </div>
    </section>
    {{-- <div class="tab-pane show active" id="tab1">
       <user-view
       :editable="false"
       fetch-url="{{ route('web.profiles.fetch') }}"
       submit-url="{{ route('web.profiles.update') }}"
       ></user-view>
    </div>
    <div class="tab-pane" id="tab2">
    </div>
    <div class="tab-pane" id="tab3">
        <activity-log-table 
        ref="table-1"
        disabled
        fetch-url="{{ route('web.activity-logs.fetch.profiles') }}"
        ></activity-log-table>
    </div> --}}
</div>

@endsection