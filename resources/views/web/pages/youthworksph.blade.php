@extends('web.master')

@section('meta:title', 'YouthWorksPH')
@section('content')

<section class="page-frame ythwrk-frm ythwrk-frm1">
	<div class="width--45 margin-a align-c">
		<div class="ythwrk-frm1__logo-holder">
			<div class="page-bg page-bg--contain" style="background-image: url({{ $pageItems['youthworkph_logo'] }})"></div>
		</div>
		{!! $pageItems['youthworkph_description'] !!}
	</div>
	<div class="width--90 margin-a l-margin-t frm-slider-bullets">
		<div class="ythwrk-frm1__slider frm__sliderCon mb-0">
			@foreach($sliders as $slider)
			<div class="ythwrk-frm1__img-holder">
				<div class="page-bg page-bg--cover cstm-border-radius--8" style="background-image: url({{ $slider->renderImagePath() }})"></div>
			</div>
			@endforeach
		</div>
		<div class="progressBarContainer inlineBlock-parent">
			@foreach($sliders as $slider)
			<div class="item">
				<span class="progressBar"></span>
			</div>
			@endforeach
		</div>
	</div>
</section>

<section class="page-frame ythwrk-frm ythwrk-frm2">
	<div class="width--45 margin-a list-style">
		<h2 class="font-2 type-2 fntwght--bold l-margin-b align-c">{{ $pageItems['youthworkph_frame_two_title'] }}</h2>
		{!! $pageItems['youthworkph_frame_two_content'] !!}
		<div class="align-c">
			<a class="btn type-1 m-margin-t align-c ythwrk-frm2__btn">Register</a>
		</div>
	</div>
	<div class="width--60 margin-a">
		<div class="ythwrk-frm2__cntnr">
			<div class="d-flex align-items-center align-c flex-wrap ythwrk-frm2__header">
				<div class="col">
					<p class="fntwght--bold">Site</p>
				</div>
				<div class="col">
					<p class="fntwght--bold">Course</p>
				</div>
				<div class="col">
					<p class="fntwght--bold">Registration Link</p>
				</div>
			</div>
			{{-- loop --}}
			@foreach($courses as $course)
			<div class="d-flex align-items-center align-c flex-wrap ythwrk-frm2__row">
				<div class="col">
					<p>{{ $course->site }}</p>
				</div>
				<div class="col">
					<p>{{ $course->course }}</p>
				</div>
				<div class="col">
					<a href="{{ $course->link }}">{{ $course->link }}</a>
				</div>
			</div>
			@endforeach
			{{-- end loop --}}
		</div>
	</div>
	<div class="width--100 l-margin-t">
		<div class="ythwrk-frm2__slider">
			@foreach($videos as $video)
			<div class="ythwrk-frm2__item">
				<div class="cstm-border-radius--8 overflow-hidden">
					<iframe  class="page-bg page-bg--cover cstm-border-radius--8" src="{{ str_replace('watch?v=', 'embed/', $video->link) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

<section class="ythwrk-frm ythwrk-frm3">
	<div class="page-bg page-bg--cover" style="background: #731022"></div>
	<div class="d-flex flex-wrap">
		<div class="ythwrk-frm3__col">
			<div class="page-bg page-bg--cover" style="background-image: url({{ $pageItems['youthworksph_project_priority_areas_and_growth_sectors_in_philippines_background_image'] }})"></div>
		</div>
		<div class="ythwrk-frm3__col cstm-color--white list-style color-white">
			<h2 class="font-2 type-white fntwght--bold m-margin-tb">{{ $pageItems['project_priority_areas'] }}</h2>
			<ul>
				@foreach($project_priorities as $priority)
					<li>{{ $priority->name }}</li>
				@endforeach
			</ul>
			<h2 class="font-2 type-white fntwght--bold m-margin-tb">{{ $pageItems['growth_sectors_of_the_project'] }}</h2>
			<ul>
				@foreach($growth_sectors as $sector)
					<li>{{ $sector->name }}</li>
				@endforeach
			</ul>
		</div>
	</div>
</section>

<section class="page-frame ythwrk-frm ythwrk-frm4">
	<div class="width--80 margin-a">
		<h2 class="font-2 type-2 fntwght--bold l-margin-b align-c">Frequently Asked Questions</h2>

		<div class="d-flex ythwrk-frm4__content">
			@foreach($faqs as $faq)
			<div class="ythwrk-frm4__drpdwn dropdown">
			  	<div class="ythwrk-frm4__drpdwn-menu" id="faq-1" data-toggle="dropdown">
			    	<p class="">{{ $faq->question }}</p>
			    	<i class="fa fa-angle-down"></i>
			  	</div>
			  	<div class="ythwrk-frm4__drpdwn-cntnr dropdown-menu list-style" aria-labelledby="faq-1">
			    	{!! $faq->answer !!}
			  	</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

<section class="page-frame ythwrk-frm ythwrk-frm5">
	<div class="page-bg page-bg--cover bring-back" style="background: linear-gradient(180deg, #395d73 41.86%, #a62c21 58.85%)"></div>
	<div class="width--90 margin-a align-c">
		<div class="ythwrk-frm5__cntnr">
			<h3 class="font-1 type-white fntwght--bold l-margin-b">The Team</h3>
			<div class="ythwrk-frm5__card-cntnr justify-content-center">
				@foreach($heads as $head)
				<div class="ythwrk-frm5__card">
					<div class="ythwrk-frm5__img-holder">
						<div class="page-bg page-bg--cover align-t" style="background-image: url({{ $head->renderImagePath() }})"></div>
					</div>
					<div class="ythwrk-frm5__desc">
						<p class="fntwght--bold">{{ $head->name }}</p>
						<p>{{ $head->position }}</p>
					</div>
				</div>
				@endforeach
			</div>

			<h3 class="font-1 type-white fntwght--bold l-margin-b">{{ $pageItems['managers'] }}</h3>
			<div class="ythwrk-frm5__card-cntnr">
				@foreach($managers as $manager)
				<div class="ythwrk-frm5__card">
					<div class="ythwrk-frm5__img-holder">
						<div class="page-bg page-bg--cover align-t" style="background-image: url({{ $manager->renderImagePath() }})"></div>
					</div>
					<div class="ythwrk-frm5__desc">
						<p class="fntwght--bold">{{ $manager->name }}</p>
						<p>{{ $manager->position }}</p>
					</div>
				</div>
				@endforeach
			</div>


			<h3 class="font-1 type-white fntwght--bold l-margin-b"> {{ $pageItems['officers_and_assistants'] }}</h3>
			<div class="ythwrk-frm5__card-cntnr">
				@foreach($officers as $officer)
				<div class="ythwrk-frm5__card">
					<div class="ythwrk-frm5__img-holder">
						<div class="page-bg page-bg--cover align-t" style="background-image: url({{ $officer->renderImagePath() }})"></div>
					</div>
					<div class="ythwrk-frm5__desc">
						<p class="fntwght--bold">{{ $officer->name }}</p>
						<p>{{ $officer->position }}</p>
					</div>
				</div>
				@endforeach
			</div>

			<h3 class="font-1 type-white fntwght--bold l-margin-b"> {{ $pageItems['city_coordinators'] }}</h3>
			<div class="ythwrk-frm5__card-cntnr">
				@foreach($coordinators as $coordinator)
				<div class="ythwrk-frm5__card">
					<div class="ythwrk-frm5__img-holder">
						<div class="page-bg page-bg--cover align-t" style="background-image: url({{ $coordinator->renderImagePath() }})"></div>
					</div>
					<div class="ythwrk-frm5__desc">
						<p class="fntwght--bold">{{ $coordinator->name }}</p>
						<p>{{ $coordinator->position }}</p>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>

@if($featured_blog)
<section class="ythwrk-frm ythwrk-frm6" >
	<div class="page-bg page-bg--cover" style="background-image: url({{ $featured_blog->renderImagePath() }})"></div>
	<div class="vertical-parent">
		<div class="vertical-align align-b">
			<div class="ythwrk-frm6__content d-flex align-items-center justify-content-between">
				<div class="ythwrk-frm6__desc">
					<h3 class="font-1 type-white fntwght--bold s-margin-b">{{ $featured_blog->name }}</h3>
					<div class="d-flex cstm-color--white">
						{{-- <p class="mb-0">{{ $featured_blog->formatted_created_at }}</p> --}}
						{{-- <p class="m-margin-lr mb-0">|</p> --}}
						<p class="mb-0">{{ $featured_blog->author }}</p>
					</div>
				</div>
				<div class="ythwrk-frm6__btn">
					<a href="{{ $featured_blog->show_url }}" class="btn type-2">Read More</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endif

<section class="page-frame ythwrk-frm ythwrk-frm7">
	<div class="page-bg page-bg--cover bring-back" style="background: #fbbf00"></div>
	<youth-work-blogs
		fetch-url="{{ route('web.blogs.fetch', ['for_youthworks' => true]) }}"
	></youth-work-blogs>
</section>

@endsection