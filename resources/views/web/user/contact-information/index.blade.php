@extends('web.dashboard-master')

@section('meta:title', 'Dashboard')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">Contact Dashboard</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Contact Dashboard</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row no-gutters">
            <div class="col-12">
                <contact-information-user-table
                export-url="{{ route('web.contact-information.export') }}"
                fetch-url="{{ route('web.contact-information.fetch') }}"
                :categories="{{ $categories }}"
                ></contact-information-user-table>
            </div>
        </div>
    </section>
    
    {{-- <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="bg--gray">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a @click="initList('table-1')" class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">All Contacts</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <contact-information-user-table
                        export-url="{{ route('web.contact-information.export') }}"
                        fetch-url="{{ route('web.contact-information.fetch') }}"
                        :categories="{{ $categories }}"
                        ></contact-information-user-table>
                    </div>
                </div>
        <div class="row no-gutters">
            <div class="col-12">
                <contact-information-user-table
                export-url="{{ route('web.contact-information.export') }}"
                fetch-url="{{ route('web.contact-information.fetch') }}"
                :categories="{{ $categories }}"
                ></contact-information-user-table>
            </div>
        </div>

        <div>
            <a href=""></a>
        </div>
    </section> --}}
</div>




@endsection