@extends('web.master')

@section('meta:title', 'Teaching and Learning')
@section('content')

<section class="page-frame aow-frm aow-frm1">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">our Areas of Work</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">Teaching and Learning</h2>
		</div>
		<div class="aow-frm__content frm-slider-bullets">			
			<h1 class="s-margin-b type-2 font-2 fntwght--bold">{{ $pageItems['teaching_and_learning_header_title'] }}</h1>
			<div class="aow-frm__img-holder">
				<div class="page-bg page-bg--cover align-t" style="background-image: url({{ $pageItems['teaching_and_learning_banner_image'] }})"></div>
			</div>
		</div>
	</div>
</section>

<section class="page-frame aow-frm aow-frm2 teaching-learning">
	<graphical-info
		:challenges="{{ $challenges }}"
	></graphical-info>
</section>

<section class="page-frame aow-frm aow-frm5">
	<div class="page-bg page-bg--cover bring-back" style="background: #f1f1f1"></div>
	<div class="width--85 margin-a">
		<div class="page-section__titleCon align-c width--45 margin-a">
			<div class="s-margin-b">
				<small class="fntwght--bold uppercase">our solution</small>
			</div>
			<h3 class="font-1 type-2 fntwght--bold">{{ $pageItems['teaching_and_learning_our_solution_title'] }}</h3>
		</div>
		<div class="aow-frm5__cntnr inlineBlock-parent">
			@foreach($solutions as $solution)<div class="aow-frm5__col">
				<div class="aow-frm5__img-holder">
					<div class="page-bg page-bg--contain" style="background-image: url({{ $solution->renderImagePath() }})"></div>
				</div>
				<div class="aow-frm5__desc">
					<description
						description="{{ $solution->description }}"
					></description>
					{{-- {!! $solution->description !!} --}}
				</div>
			</div>@endforeach
		</div>
	</div>
</section>

<section class="page-frame aow-frm aow-frm6">
	<div class="width--85 margin-a">
		<div class="page-section__titleCon align-c width--45 margin-a">
			<h3 class="font-1 type-2 fntwght--bold">Our Initiatives</h3>
		</div>
		<div class="aow-frm6__slider">
			@foreach($projects as $project)
				@if(!$project->is_other_page)
					<div class="aow-frm6__col">
						<a class="unlink" href="{{ route('web.projects.show' , [$project->id, $project->name]) }}">
							<div class="aow-frm6__img-holder">
								<div class="page-bg page-bg--contain" style="background-image: url({{ $project->renderImagePath('icon') }})"></div>
							</div>
							<div class="aow-frm6__desc">
								<p>{{ $project->name }}</p>
							</div>
						</a>
					</div>
				@else
					<div class="aow-frm6__col">
						<a class="unlink" href="{{  $project->link }}" target="_blank">
							<div class="aow-frm6__img-holder">
								<div class="page-bg page-bg--contain" style="background-image: url({{ $project->renderImagePath('icon') }})"></div>
							</div>
							<div class="aow-frm6__desc">
								<p>{{ $project->name }}</p>
							</div>
						</a>
					</div>
				@endif
			@endforeach
		</div>
	</div>
</section>
@endsection