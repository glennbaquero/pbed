@extends('web.master')

@section('meta:title', 'Projects')
@section('content')

<section class="page-frame prjcts-frm prjcts-frm1 pb-0">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">projects</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">{{ $project->header_title_label }}</h2>
		</div>
		<div class="prjcts-frm1__content align-c">
			<h1 class="s-margin-b type-2 font-2 fntwght--bold">{{ $project->name }}</h1>

			<div class="frm-slider-bullets">
				<div class="prjcts-frm1__slider frm__sliderCon">
					@foreach($slider_image as $slider_images)
					<div class="prjcts-frm1__item">
						<div class="page-bg page-bg--cover cstm-border-radius--8 align-t" style="background-image: url({{ Storage::url($slider_images->image_path) }})"></div>
					</div>
					@endforeach
				</div>
				<div class="progressBarContainer inlineBlock-parent">
					@foreach($slider_image as $slider_images)
					<div class="item">
						<span class="progressBar"></span>
					</div>
					@endforeach
				</div>
			</div>

			<div class="inlineBlock-parent l-margin-t prjcts-frm1__cntnr">
				<div class="prjcts-frm1__img-holder align-t">
					<div class="page-bg page-bg--contain" style="background-image: url({{ Storage::url($project->icon) }})"></div>
				</div>
				<div class="prjcts-frm1__desc align-t list-style color-red">
					<h3 class="font-1 type-2 fntwght--bold mb-2">About the Project</h3>
					<description
						description="{{ $project->description }}"
					></description>
				</div>
			</div>
		</div>
	</div>
</section>
@if(count($milestone))
	<section class="page-frame prjc1ts-frm prjcts-frm2">
		<div class="width--80 margin-a list-style color-red">
			<div class="prjcts-frm2__content d-flex">
			@forelse($milestone as $key => $milestones)
				@if(($key+1)%2)
					<div class="prjcts-frm2__col">
						@if($milestones->image_path)
						<div class="prjcts-frm2__img-holder cstm-border-radius--8">
							<div class="page-bg page-bg--cover cstm-border-radius--8" style="background-image: url('{{ Storage::url($milestones->image_path) }}')"></div>
						</div>
						@endif
					</div>
					<div class="prjcts-frm2__col">
						@if($milestones->name)
						<h3 class="font-1 type-2 fntwght--bold m-margin-b">{{ $milestones->name }}</h3>
						@endif
						<description
							description="{{ $milestones->description }}"
						></description>
						{{-- {!! $milestones->description !!} --}}
						@if($milestones->know_more)
						 <a href="{!! $milestones->know_more !!}" target="_blank" class="btn type-1 s-margin-t">Know More</a>
						 @endif 
					</div>
				@else
					<div class="prjcts-frm2__col">
						<description
							description="{{ $milestones->description }}"
						></description>
						{{-- {!! $milestones->description !!} --}}
						@if($milestones->know_more)
						 <a href="{!! $milestones->know_more !!}" target="_blank" class="btn type-1 s-margin-t">Know More</a>
						 @endif 
					</div>
					<div class="prjcts-frm2__col">
						@if($milestones->image_path)
						<div class="prjcts-frm2__img-holder cstm-border-radius--8">
							<div class="page-bg page-bg--cover cstm-border-radius--8" style="background-image: url({{ Storage::url($milestones->image_path) }})"></div>
						</div>
						@endif
					</div>
				@endif
				@empty
					No milestones yet.
			@endforelse
			</div>
		</div>
	</section>
@endif
@if(count($project_member))
	<section class="page-frame prjcts-frm prjcts-frm3">

		<div class="width--90 margin-a align-c">
			<h3 class="font-1 type-2 fntwght--bold">Project Team</h3>
			<div class="prjcts-frm3__content">
				@forelse($project_member as $project_members)
				<div class="prjcts-frm3__card">
						<div class="prjcts-frm3__img-holder align-t">
							<div class="page-bg page-bg--cover align-t" style="background-image: url({{ Storage::url($project_members->image_path) }})"></div>
						</div>
						<p class="fntwght--bold">{{ $project_members->name }}</p>
				</div>
				@empty
					<p class="fntwght--bold">No members yet.</p>
				@endforelse
			</div>
		</div>
	</section>
@endif

@endsection