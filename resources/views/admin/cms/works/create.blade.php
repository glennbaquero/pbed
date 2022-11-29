@extends('admin.master')

@section('meta:title', 'Create Areas of Work')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">Create Areas of Work</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.works.index') }}">Areas of Works</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card bg--transparent">
            <div class="card-header">
                <div class="bg--gray">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <work-view
                        fetch-url="{{ route('admin.works.fetch.item') }}"
                        submit-url="{{ route('admin.works.store') }}"
                        ></work-view>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="content">
        <work-view
        fetch-url="{{ route('admin.works.fetch.item') }}"
        submit-url="{{ route('admin.works.store') }}"
        ></work-view>
    </section> --}}
</div>

@endsection