@extends('admin.master')

@section('meta:title', 'Contact Requests')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">Contact Requests</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Contact Requests</a></li>
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
                        <li class="nav-item"><a @click="initList('table-1')" class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">REQUEST INFORMATION</a></li>
                        <li class="nav-item"><a @click="initList('table-2')" class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">REQUEST TO EDIT</a></li>
                        <li class="nav-item"><a @click="initList('table-3')" class="nav-link" data-target="#tab3" href="javascript:void(0)" data-toggle="tab">Archived</a></li>
                        <li class="nav-item"><a @click="initList('table-4')" class="nav-link" data-target="#tab4" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <request-information-table
                        ref="table-1"
                        fetch-url="{{ route('admin.request-information.fetch', ['type' => 'REQUEST INFORMATION']) }}"
                        ></request-information-table>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <request-information-table
                        ref="table-2"
                        fetch-url="{{ route('admin.request-information.fetch', ['type' => 'REQUEST TO EDIT']) }}"
                        ></request-information-table>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <request-information-table
                        ref="table-3"
                        fetch-url="{{ route('admin.request-information.fetch.archive') }}"
                        ></request-information-table>
                    </div>
                    <div class="tab-pane" id="tab4">
                        <activity-log-table 
                        ref="table-4"
                        disabled
                        show-subject
                        fetch-url="{{ route('admin.activity-logs.fetch.request-information') }}"
                        ></activity-log-table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection