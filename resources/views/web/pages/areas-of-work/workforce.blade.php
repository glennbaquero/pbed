@extends('web.master')

@section('meta:title', 'Workforce Development')
@section('content')

<section class="page-frame aow-frm aow-frm1">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">Our Areas of Work</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">Workforce Development</h2>
		</div>
		<div class="aow-frm__content">			
			<h1 class="s-margin-b type-2 font-2 fntwght--bold">{{ $pageItems['workforce_development_header_text'] }}</h1>
			<div class="aow-frm__img-holder">
				<div class="page-bg page-bg--cover align-t" style="background-image: url({{ $pageItems['workforce_development_image_banner']  }})"></div>
			</div>
		</div>
	</div>
</section>

<section class="page-frame aow-frm aow-frm2">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon">
			<div class="s-margin-b">
				<small class="fntwght--bold uppercase">the challenge</small>
			</div>
			<h3 class="font-1 type-1 fntwght--bold">{{ $pageItems['workforce_development_the_challenges_header_title'] }}</h3>
		</div>

		<frame-two-workforce-devt
			:challenges="{{ $challenges }}"
		></frame-two-workforce-devt>
	</div>
</section>

<section class="page-frame aow-frm aow-frm3">
	<div class="page-bg page-bg--cover bring-back" style="background: #762b1c"></div>
	<div class="page-bg page-bg--cover aow-frm3__overlay" style="background: radial-gradient(115.21% 204.82% at 118.83% 55.15%, rgba(118, 43, 28, 0.69) 0%, #762B1C 100%)"></div>
	<div class="page-bg page-bg--cover bring-back aow-frm3__bg" style="background-image: url('//via.placeholder.com/1000x400');"></div>
	<div class="width--75 margin-a">
		<div class="aow-frm3__content width--65 cstm-color--white">
			<div class="aow-frm3__desc list-style">
				<description
					description="{{ $pageItems['workforce_development_frame_three_description'] }}"
				></description>
			</div>
		</div>
	</div>
	<div class="page-bg page-bg--cover aow-frm3__overlay" style="background: radial-gradient(115.21% 204.82% at 118.83% 55.15%, rgba(118, 43, 28, 0.69) 0%, #762B1C 100%)"></div>
	<div class="page-bg page-bg--cover bring-back aow-frm3__bg" style="background-image: url({{ $pageItems['workforce_development_frame_three_background'] }});"></div>


</section>

<frame-four-workforce-devt
	:frame-four="{{ $frame_four }}"
></frame-four-workforce-devt>

<section class="page-frame aow-frm aow-frm5">
	<div class="page-bg page-bg--cover bring-back" style="background: #f1f1f1"></div>
	<div class="width--85 margin-a">
		<div class="page-section__titleCon align-c width--45 margin-a">
			<div class="s-margin-b">
				<small class="fntwght--bold uppercase">our solution</small>
			</div>
			<h3 class="font-1 type-2 fntwght--bold">{{ $pageItems['workforce_development_our_solution_header_title'] }}</h3>
		</div>
		<div class="aow-frm5__cntnr inlineBlock-parent">
			@foreach($solutions as $solution)<div class="aow-frm5__col">
				<div class="aow-frm5__img-holder">
					<img src="{{ $solution->renderImagePath() }}" class="img-fit">
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
						<a class="unlink" href="{{ $project->link }}" target="_blank">
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