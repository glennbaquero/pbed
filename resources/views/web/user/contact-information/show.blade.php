@extends('web.dashboard-master')

@section('meta:title', $item->name)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('web.contact-information.index') }}" class="fntwght--semibold"><h4 class="fntwght--semibold font-1"><i class="fa fa-chevron-left btn--back"></i>{{ $item->name }} {{-- <span class="badge">CEO</span> --}}</h4></a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('web.contact-information.index') }}">Contact Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <page-pagination fetch-url="{{ route('web.contact-information.fetch.pagination', $item->id) }}"></page-pagination>

    <!-- Main content -->
    <section class="content">
        <div class="row no-gutters">
            <div class="col-12">
                <contact-information-user-view
                fetch-url="{{ route('web.contact-information.fetch.item', $item->id) }}"
                submit-url="{{ route('web.contact-information.store') }}"
                :has-remove-button="true"
                :update="true"
                ></contact-information-user-view>
            </div>
        </div>
    </section>
</div>

{{-- <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $item->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('web.contact-information.index') }}">Contact Information</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <page-pagination fetch-url="{{ route('web.contact-information.fetch.pagination', $item->id) }}"></page-pagination>
    
    <section class="content">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <contact-information-user-view
                        fetch-url="{{ route('web.contact-information.fetch.item', $item->id) }}"
                        :has-remove-button="true"
                        :update="true"
                        ></contact-information-user-view>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> --}}

@endsection