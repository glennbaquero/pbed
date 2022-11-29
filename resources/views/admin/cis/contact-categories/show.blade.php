@extends('admin.master')

@section('meta:title', $item->name)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('admin.contact-categories.index') }}" class="fntwght--semibold"><h4 class="fntwght--semibold font-1"><i class="fa fa-chevron-left btn--back"></i>{{ $item->name }}</h4></a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.contact-categories.index') }}">Contact Category</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <page-pagination fetch-url="{{ route('admin.contact-categories.fetch.pagination', $item->id) }}"></page-pagination>
    
    <section class="content">
        <div class="card bg--transparent">
            <div class="card-header">
                <div class="bg--gray">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
                        <li class="nav-item"><a @click="initList('table-2')" class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <contact-category-view
                        fetch-url="{{ route('admin.contact-categories.fetch.item', $item->id) }}"
                        submit-url="{{ route('admin.contact-categories.update', $item->id) }}"
                        :has-remove-button="true"
                        ></contact-category-view>
                    </div>
                    <div class="tab-pane bg--white" id="tab2">
                        <activity-log-table 
                        ref="table-2"
                        disabled
                        show-subject
                        fetch-url="{{ route('admin.activity-logs.fetch.contact-categories', $item->id) }}"
                        ></activity-log-table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection