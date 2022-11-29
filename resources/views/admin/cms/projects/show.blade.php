@extends('admin.master')

@section('meta:title', $item->name)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fntwght--semibold font-1">{{ $item->name }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <page-pagination fetch-url="{{ route('admin.projects.fetch.pagination', $item->id) }}"></page-pagination>
    
    <section class="content">
        <div class="card bg--transparent">
            <div class="card-header">
                <div class="bg--gray">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
                        <li class="nav-item"><a @click="initList('table-1')" class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Milestones</a></li>
                        <li class="nav-item"><a @click="initList('table-2')" class="nav-link" data-target="#tab3" href="javascript:void(0)" data-toggle="tab">Members</a></li>
                        <li class="nav-item"><a @click="initList('table-3')" class="nav-link" data-target="#tab4" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <project-view
                        fetch-url="{{ route('admin.projects.fetch.item', $item->id) }}"
                        submit-url="{{ route('admin.projects.update', $item->id) }}"
                        ></project-view>
                    </div>
                    <div class="tab-pane bg--white" id="tab2">
                        <milestones-table
                        fetch-url="{{ route('admin.milestones.fetch.by.project', $item->id) }}"
                        :project-id="{{ $item->id }}"
                        submit-url="{{ route('admin.milestones.store') }}"
                        ></milestones-table>
                    </div>
                    <div class="tab-pane bg--white" id="tab3">
                        <project-members-table
                        fetch-url="{{ route('admin.project-members.fetch.by.project', $item->id) }}"
                        :project-id="{{ $item->id }}"
                        submit-url="{{ route('admin.project-members.store') }}"
                        ></project-members-table>
                    </div>                    
                    <div class="tab-pane bg--white" id="tab4">
                        <activity-log-table 
                        ref="table-3"
                        disabled
                        show-subject
                        fetch-url="{{ route('admin.activity-logs.fetch.projects', $item->id) }}"
                        ></activity-log-table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection