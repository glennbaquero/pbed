@extends('admin.master')

@section('meta:title', 'First Frame (Slider/Banner)')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">First Frame (Slider/Banner)</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">First Frame (Slider/Banner)</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="bg--gray">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a @click="initList('table-1')" class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Active</a></li>
                        <li class="nav-item"><a @click="initList('table-2')" class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Archived</a></li>
                        <li class="nav-item"><a @click="initList('table-3')" class="nav-link" data-target="#tab3" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <home-first-frame-table
                        ref="table-1"
                        fetch-url="{{ route('admin.home-first-frame.fetch') }}"
                        ></home-first-frame-table>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <home-first-frame-table 
                        ref="table-2"
                        disabled
                        fetch-url="{{ route('admin.home-first-frame.fetch.archive') }}"
                        ></home-first-frame-table>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <activity-log-table 
                        ref="table-3"
                        disabled
                        show-subject
                        fetch-url="{{ route('admin.activity-logs.fetch.news') }}"
                        ></activity-log-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="align-r">
            <a href="{{ route('admin.home-first-frame.create') }}" class="btn frm-btn type-1 px-4">CREATE</a>
        </div>
    </section>
</div>

@endsection