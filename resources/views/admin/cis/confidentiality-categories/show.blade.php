@extends('admin.master')

@section('meta:title', $item->name)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('admin.confidentiality-categories.index') }}" class="fntwght--semibold"><h4 class="fntwght--semibold font-1"><i class="fa fa-chevron-left btn--back"></i>{{ $item->name }}</h4></a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.confidentiality-categories.index') }}">Confidentiality Categories</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <page-pagination fetch-url="{{ route('admin.confidentiality-categories.fetch.pagination', $item->id) }}"></page-pagination>
    
    <section class="content">
        <div class="card bg--transparent">
            <div class="card-header">
                <div class="bg--gray">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
                        <li class="nav-item"><a @click="initList('table-3')" class="nav-link" data-target="#tab4" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <confidentiality-category-view
                        fetch-url="{{ route('admin.confidentiality-categories.fetch.item', $item->id) }}"
                        submit-url="{{ route('admin.confidentiality-categories.update', $item->id) }}"
                        ></confidentiality-category-view>
                    </div>
                    <div class="tab-pane bg--white" id="tab4">
                        <activity-log-table 
                        ref="table-3"
                        disabled
                        show-subject
                        fetch-url="{{ route('admin.activity-logs.fetch.confidentiality-categories', $item->id) }}"
                        ></activity-log-table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection