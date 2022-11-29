@extends('admin.master')

@section('meta:title', str_limit($item->header, 50))

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">{{ str_limit($item->header, 50) }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home-latest-study.index') }}">Latest Studies</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ str_limit($item->header, 50) }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <page-pagination fetch-url="{{ route('admin.home-latest-study.fetch-pagination', $item->id) }}"></page-pagination>
    
    <section class="content">
        <div class="card bg--transparent">
            <div class="card-header">
                <div class="bg--gray">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
                        <li class="nav-item"><a @click="initList('table-1')" class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <home-latest-study-view
                        fetch-url="{{ route('admin.home-latest-study.fetch-item', $item->id) }}"
                        submit-url="{{ route('admin.home-latest-study.update', $item->id) }}"
                        ></home-latest-study-view>
                    </div>
                    <div class="tab-pane bg--white" id="tab2">
                        <activity-log-table 
                        ref="table-1"
                        disabled
                        show-subject
                        fetch-url="{{ route('admin.activity-logs.fetch.home-latest-study', $item->id) }}"
                        ></activity-log-table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection