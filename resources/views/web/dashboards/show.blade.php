@extends('web.dashboard-master')

@section('meta:title', 'Contact Details')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('web.profiles.show') }}" class="fntwght--semibold"><h4 class="fntwght--semibold font-1"><i class="fa fa-chevron-left btn--back"></i>Mr. Benes Jr, Markus U. <span class="badge">CEO</span></h4></a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Contact Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Mr. Benes Jr, Markus U.</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row no-gutters">
			<div class="col-12">
                <contacts-view></contacts-view>
			</div>
		</div>
    </section>
</div>




@endsection