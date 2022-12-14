@extends('admin.master')

@section('meta:title', 'Dashboard')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">Dashboard</h4>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="bg--gray">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">User Analytics</a></li>
                        <li class="nav-item"><a class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Admin Analytics</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <dashboard-analytics
                        title="User Analytics"
                        fetch-url="{{ route('admin.analytics.fetch.user') }}"
                        ></dashboard-analytics>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <dashboard-analytics
                        title="Admin Analytics"
                        fetch-url="{{ route('admin.analytics.fetch.admin') }}"
                        ></dashboard-analytics>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection