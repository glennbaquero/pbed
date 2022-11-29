@extends('web.master')

@section('meta:title', 'Organization')
@section('content')

<section class="page-frame org-frm org-frm1">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">organization</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">Who We Are</h2>
		</div>
		<div class="org-frm1__content">			
			<h1 class="s-margin-b type-2 font-2 fntwght--bold">{{ $pageItems['organization_header_title'] }}</h1>
			<div class="org-frm1__img-holder">
				<div class="org-frm1__mbl-bg">
					<div class="page-bg page-bg--cover bring-back" style="background-image: url({{ $pageItems['organization_image_banner'] }})"></div>
					<div class="org-frm1__overlay"></div>
				</div>
				<div class="vertical-parent">
					<div class="vertical-align align-b">
						<div class="org-frm1__desc cstm-color--white scroll-custom">
							{!! $pageItems['organization_description_banner'] !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="page-frame org-frm org-frm2">
	<div class="width--90 margin-a">
		<our-leadership
			our-leadership-text="{{ $pageItems['our_leadership_text'] }}"
			fetch-url="{{ route('web.our-leadership.fetch') }}"
		></our-leadership>

		<div class="org-frm2__cntnr">
			<div class="page-section__titleCon">
				<h3 class="font-1 type-2 fntwght--bold">{{ $pageItems['organizations_advisers_label'] }}</h3>
			</div>
			<adviser
				fetch-url="{{ route('web.advisers.fetch') }}"
			></adviser>
		</div>

		<div class="org-frm2__cntnr">			
			<div class="page-section__titleCon">
				<h3 class="font-1 type-2 fntwght--bold">{{ $pageItems['organization_our_members_label'] }}</h3>
			</div>
			<div class="org-frm2__sub-cntnr">
				<p class="type-2 mb-3">{{ $pageItems['organization_corporation_label'] }}</p>
				<div class="org-frm2__slider">
					@foreach($corporations as $corporation)
					<div class="org-frm2__card">
						<div class="org-frm2__img-holder">
							<div class="page-bg page-bg--contain" style="background-image: url({{ $corporation->renderImagePath() }})"></div>
						</div>
						<div class="org-frm2__content">
							<p class="fntwght--bold">{{ $corporation->name }}</p>
						</div>
					</div>
					@endforeach
				</div>
				<div class="cstm__cardArrowConOrg"></div>
			</div>
			<div class="org-frm2__sub-cntnr">
				<p class="type-2 mb-3">{{ $pageItems['individuals_title_label'] }}</p>
				<div class="org-frm2__content">
					@foreach($individuals as $individual)
					<div class="org-frm2__name">
						<p class="fntwght--bold">{{ $individual->prefix }} {{ $individual->name }}</p>
					</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="org-frm2__cntnr last-child">
			<div class="page-section__titleCon">
				<h3 class="font-1 type-2 fntwght--bold">{{ $pageItems['organization_our_people_label'] }}</h3>
			</div>

			<div class="org-frm2__content">
				@foreach($people as $_people)
				<div class="org-frm2__name col--3">
					<p class="fntwght--bold">{{ $_people->name }}</p>
					<p>{{ $_people->position }}</p>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endsection