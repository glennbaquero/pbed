@extends('admin.master')

@section('meta:title', 'Upload Contact Information')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">Upload Contact Information</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.contact-informations.index') }}">Contact Information</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Upload</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <contact-information-upload
        :categories="{{ $categories }}"
        sample-format-url="{{ $sample }}"
        submit-url="{{ route('admin.contact-informations.upload') }}"
        update-sample-format-table="{{ route('admin.excel-format.update') }}"
        ></contact-information-upload>
    </section>
</div>

@endsection