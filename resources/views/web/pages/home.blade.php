@extends('web.master', ['frm_body' => 'frm-body__hm'])


@section('content')

<div class="nav-side"></div>
<section class="hm-fr1 full--scroll frm-slider-bullets" data-section-name="1">
	<div class="frm__sliderCon">
		@foreach($sliders as $slider)
		<div class="hmfr1__sliderList">
			<div class="hm-fr1__mbl-bg">
				<div class="hmfr1__sliderListBG" style="background-image: url({{ $slider->renderImagePath() }})"></div>
				<div class="hm-fr1__overlay"></div>
			</div>
			<div class="vertical-parent">
				<div class="vertical-align">
					<div class="hmfr1__sliderTextCon">
						<h1 class="s-margin-b type-white font-2 fntwght--bold">{{ $slider->header }}</h1>
						<h4 class="type-white font-1">{{ $slider->description }}</h4>
					</div>
				</div>
			</div>
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
</section>
<section class="page-frame hm-fr2 full--scroll" data-section-name="2">
	<div class="width--80 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">Areas of Work</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">Our Advocacies</h2>
		</div>
		<div class="cstm-border-radius--8 cstm-box-shadow-15 overflow-hidden hmfr2__card">
			<div class="inlineBlock-parent hmfr2__innerCard">
				<div class="width--40">
					<div class="hmfr2__sliderThumbCon">
						@foreach($advocacy_images as $image)
							<div class="hmfr2__cardImg" style="background-image: url({{ $image }})"></div>
						@endforeach
						{{-- <div class="hmfr2__cardImg" style="background-image: url('/images/home/hm-2.png')"></div> --}}

					</div>
				</div
				><div class="width--60">
					<div class=" hmfr2__sliderCon cstm__card">
						@foreach($advocacy_bodies as $body)
						<div class="hmfr2__sliderList">
							<small class="type-dullBlack s-margin-b">Advocacy</small>
							<h3>{{ $body['title'] }}</h3>
							<div class="hmfr2__desc m-margin-b">
								<description description="{{ $body['description'] }}"></description>
								{{-- {!! $body['description'] !!} --}}
							</div>
							@if($body['link'])
								<a class="mbl-btn" href="{{ $body['link'] }}"><button class="btn type-1 m-margin-t">{{ $all_pages['know_more_button_label'] }}</button></a>
							@endif
						</div>
						@endforeach
					</div>
					<div class="cstm__cardArrowCon"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hm-fr3 full--scroll" data-section-name="3">
	<div class="width--90 margin-a hmfr3__innerCon d-flex">
		<div class="page-frame hmfr3__textCon">
			<div class="vertical-parent">
				<div class="vertical-align">
					<div class="page-section__titleCon">
						<div class="s-margin-b inlineBlock-parent">
							<div class="page-section__line"></div>
							<small class="fntwght--bold type-white uppercase">Organization</small>
						</div>
						<h2 class="font-2 type-white fntwght--bold">{{ $home['pageItems']['who_we_are_title'] }}</h2>
					</div>
					<div class="cstm-color--white hm-fr3__descCon l-margin-b scroll-custom">
						<description description="{{ $who_we_are }}"></description>
						{{-- {!! $who_we_are !!} --}}
					</div>
					<a class="mbl-btn" href="{{ route('web.organizations') }}"><button class="btn type-2 --2">Meet the Team</button></a>
				</div>
			</div>
		</div>
	</div>
	<div class="hmfr3__bgCon">
		<div class="page-bg page-bg--cover" style="background-image: url({{ $pageItems['organization_image_banner'] }})"></div>
	</div>
</section>
{{-- <section class="page-frame hm-fr4 full--scroll" data-section-name="4">
	<div class="width--80 margin-a">
		<div class="cstm-border-radius--8 cstm-box-shadow-15 overflow-hidden hmfr4__card">
			<div class="inlineBlock-parent hmfr4__innerCard">
				<div class="width--50 hmfr4__leftCon">
					<div class="page-section__titleCon">
						<div class="s-margin-b inlineBlock-parent">
							<div class="page-section__line"></div>
							<small class="fntwght--bold uppercase">{{ $home['pageItems']['latest_studies_title_label'] }}</small>
						</div>
					</div>
					<div class=" hmfr4__sliderCon">
						@foreach($latest_study_bodies as $study)
						<div class="hmfr4__sliderList">
							<h2 class="font-2 type-1 fntwght--bold mb-3">{{ $study['header'] }}</h2>
							<div class="hm-fr4__desc scroll-custom m-margin-b">	
								{{ $study['description'] }}
							</div>
							<div class="mbl-btn">
							@if($study['downloadable'])
							<button class="btn type-1" data-toggle="modal" data-target="#hmModal__study">Download</button>
							@endif								
							</div>
						</div>
						@endforeach
					</div>
					<div class="cstm__cardArrowCon4"></div>
				</div
				><div class="width--50">
					<div class="hmfr4__sliderThumbCon">
						@foreach($latest_study_images as $study)
						<div class="hmfr4__cardImg" style="background-image: url({{ $study }})"></div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>	
</section> --}}
<latest-study
	title-label="{{ $home['pageItems']['latest_studies_title_label'] }}"
	:latest-studies="{{ $latest_study_bodies }}"
	:images="{{ $latest_study_images }}"
	store-url="{{ route('web.download.latest-study') }}"
></latest-study>
<section class="page-frame hm-fr5 full--scroll" data-section-name="5">
	<div class="width--90 margin-a hmfr5__innerCard">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase type-white">News</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold type-white">{{ $home['pageItems']['be_up_to_date_label_title'] }}</h2>
		</div>
		<div class="hmfr5__sliderCon white-bullets">
			@foreach($news as $_news)
			<a href="{{ route('web.news.show', [$_news->id, $_news->author, $_news->name]) }}">
				<div class="hm-fr5__card cstm-box-shadow-25 cstm-border-radius--8 overflow-hidden cstm__card-2">
					<div class="cstm__crd2ImgCon">
						<div class="cstm__crd2Img" style="background-image: url({{ $_news->renderImagePath() }})"></div>
					</div>
					<div class="cstm__crd2TextCon">
						<small class="cstm__crd2Cat">News</small>
						<p class="cstm__crd2Desc">{!! str_limit($_news->name, 32) !!}</p>
						<small class="cstm__crd2Misc s-margin-t">{{ $_news->author }} | {{ $_news->formatted_created_at }}</small>
					</div>
				</div>
			</a>
			@endforeach
		</div>
		<div class="align-c l-margin-t">
			<a class="mbl-btn" href="{{ route('web.news') }}"><button class="btn type-2 --2">{{ $all_pages['know_more_button_label'] }}</button></a>
		</div>
	</div>
</section>
<section class="page-frame hm-fr6 full--scroll" data-section-name="6">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">Events</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">{{ $home['pageItems']['homepage_event_frame_title_our_events_'] }}</h2>
		</div>
		<div>
			<div class="hmfr5__sliderCon">
				@foreach($events as $event)
				<div class="hm-fr6__card cstm-box-shadow-25 cstm-border-radius--8 overflow-hidden cstm__card-2">
					<a href="#" data-toggle="modal" data-target="#event-{{ $event->id }}">
						<div class="cstm__crd2ImgCon">
							<div class="cstm__crd2Img" style="background-image: url({{ $event->renderImagePath() }})"></div>
						</div>
						<div class="cstm__crd2TextCon">
							<p class="cstm__crd2SubTitle">{!! str_limit($event->name, 36) !!}</p>
							<div class="cstm__crd2Desc2">{!! str_limit($event->content, 42) !!}</div>
						</div>
					</a>
					
				</div>
				@endforeach
			</div>
		</div>
		
		<div class="align-c l-margin-t">
			<a href="{{ $home['pageItems']['events_frame_view_more_redirect_url'] }}">
				<button class="btn type-1">{{ $all_pages['know_more_button_label'] }}</button>
			</a>
		</div>
	</div>
</section>
<section class="page-frame hm-fr7 full--scroll" data-section-name="7">
	<div class="vertical-parent">
		<div class="vertical-align">
			<div class="width--70 margin-a">
				<div class="page-section__titleCon align-c">
					<div class="s-margin-b inlineBlock-parent">
						<div class="page-section__line"></div>
						<small class="fntwght--bold uppercase">{{ $careers_page_item['pageItems']['careers'] }}</small>
					</div>
					<h2 class="font-2 type-1 fntwght--bold">{{ $home['pageItems']['home_careers_header_title'] }}</h2>
					<p class="s-margin-t">{!! $home['pageItems']['home_careers_frame_short_description'] !!}</p>
				</div>
				<div class="width--70 margin-a">
					<div class="page-grid grid-2 hm-fr7__cntnr scroll-custom">
						@foreach($careers as $career)
						<div class="page__gridChild cstm-box-shadow-1 cstm-border-radius--8">
							<div class="vertical-parent">
								<div class="vertical-align align-c">
									<p class="fntwght--bold">{{ $career->position }}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="align-c m-margin-t">
					<a href="{{ route('web.careers') }}"><button class="btn type-1">{{ $all_pages['know_more_button_label'] }}</button></a>
				</div>
			</div>
		</div>
	</div>
</section>
{{-- <section class="page-frame hm-fr8 full--scroll" data-section-name="8">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold type-white uppercase">Procurement</small>
			</div>
		</div>
		<div class="hm-fr8__innerCon">
		</div>
	</div>
</section> --}}
<procurement
	:procurements="{{ $procurements }}"
	store-url="{{ route('web.download.procurement') }}"
	proposal-label="{{ $careers_page_item['pageItems']['request_for_proposal_label'] }}"
	procument-title="{{ $careers_page_item['pageItems']['procurement'] }}"
></procurement>
<section class="hm-fr9 full--scroll" data-section-name="9">
	<div class="hmfr9__bgCon">
		<div class="hmfr9__imgBG" style="background-image: url('/images/home/hm-1.png')"></div>
	</div>
	<div class="width--90 margin-a hmfr9__innerCon">
		<div class="page-frame hmfr9__textCon">
			<div class="page-section__titleCon">
				<div class="s-margin-b inlineBlock-parent">
					<div class="page-section__line"></div>
					<small class="fntwght--bold uppercase">Blogs</small>
				</div>
				<h2 class="font-2 type-1 fntwght--bold">{{ $home['pageItems']['see_what_s_new_blog_in_home_text'] }}</h2>
			</div>
			<div class="cstm-color--white hmfr9__sliderCon l-margin-b">
				@foreach($blogs as $blog)
				<a href="{{ route('web.blogs.show', [ $blog->id, $blog->author, $blog->name ]) }}">
					<div class="hmfr9__sliderList">
						<div class="cstm-box-shadow-25 cstm-border-radius--8 overflow-hidden cstm__card-2">
							<div class="cstm__crd2ImgCon">
								<div class="cstm__crd2Img" style="background-image: url({{ $blog->renderImagePath() }})"></div>
							</div>
							<div class="cstm__crd2TextCon">
								<small class="cstm__crd2Cat">News</small>
								<p class="cstm__crd2Desc">{!! str_limit($blog->name, 32) !!}</p>
								<small class="cstm__crd2Misc s-margin-t">{{ $blog->author }} | {{ $blog->formatted_created_at }}</small>
							</div>
						</div>
					</div>
				</a>
				@endforeach
			</div>
			<div class="s-margin-t mbl-btn">
				<a href="{{ route('web.blogs') }}" class="btn type-1">{{ $all_pages['know_more_button_label'] }}</a>
			</div>
		</div>
	</div>
</section>

<section class="page-frame hm-fr10 full--scroll" data-section-name="10">
	<div class="vertical-parent">
		<div class="vertical-align">
			<div class="width--90 margin-a inlineBlock-parent">
				<div class="hmfr10__leftCon">
					<div class="page-section__titleCon">
						<div class="s-margin-b inlineBlock-parent">
							<div class="page-section__line"></div>
							<small class="fntwght--bold uppercase type-white">Contact Us</small>
						</div>
						<h2 class="font-2 type-1 fntwght--bold type-white">{{ $home['pageItems']['home_contact_us_header_title'] }}</h2>
					</div>
					<div class="hmfr10__textCon">
						<p class="m-margin-b type-white">{{ $home['pageItems']['home_contact_us_short_description'] }}</p>
						<div class="inlineBlock-parent">
							<div class="hmfr10__iconCon align-t" style="background-image: url('/images/icons/map-pin.png')"></div>
							<p class="align-t"><a class="unlink" href="https://www.waze.com/ul?ll=14.55475400%2C121.01783110&navigate=yes" target="_blank">{{ $home['pageItems']['home_contact_us_address'] }}</a></p>
						</div>
						<div class="inlineBlock-parent">
							<div class="hmfr10__iconCon align-t" style="background-image: url('/images/icons/email.png')"></div>
							<p class="align-t"><a class="unlink" href="mailto: {{ $home['pageItems']['home_contact_us_email'] }}" target="_blank">{{ $home['pageItems']['home_contact_us_email'] }}</a></p>
						</div>
						<div class="inlineBlock-parent">
							<div class="hmfr10__iconCon align-t" style="background-image: url('/images/icons/phone.png')"></div>
							<p class="align-t"><a class="unlink" href="tel: {{ $home['pageItems']['home_contact_us_contact_number'] }}" target="_blank">{{ $home['pageItems']['home_contact_us_contact_number'] }}</a></p>
						</div>
					</div>
					<div>
						<a href="{{ route('web.contact-us') }}"><button class="btn type-2">Send Us a Message</button></a>
					</div>
				</div
				><div class="hmfr10__rightCon">
					<google-map
						pbed-latitude="{{ $location['pageItems']['pbed_location_latitude'] }}"
						pbed-longitude="{{ $location['pageItems']['pbed_location_longitude'] }}"
					></google-map>
				</div>
			</div>
		</div>
	</div>
</section>

@foreach($events as $index => $event)
	@include('web.partials.events')
@endforeach
@endsection 