@extends('web.dashboard-master')

@section('meta:title', 'My Account')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">My Account</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">My Account</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row no-gutters">
            <div class="col-12">
                <profile-view
               :editable="false"
               fetch-url="{{ route('web.profiles.fetch') }}"
               submit-url="{{ route('web.profiles.update') }}"
               ></profile-view>
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
        <change-password-form submit-url="{{ route('web.profiles.change-password') }}"></change-password-form>
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