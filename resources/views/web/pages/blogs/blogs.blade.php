@extends('web.master')

@section('meta:title', 'Blogs')

@section('content')

<section class="page-frame nws-frm nws-frm1">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">blogs</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">{{ $pageItems['blog_title_header'] }}</h2>
		</div>

		<latest-blogs
			:latest-blogs="{{ $latest_blogs }}"
		></latest-blogs>

		
	</div>
</section>

<!-- List of blogs -->
<blogs
	fetch-url="{{ route('web.blogs.fetch') }}"
></blogs>
{{-- 
<section class="page-frame nws-frm nws-frm2">
	<div class="width--90 margin-a">
		<div class="nws-frm2__cntnr">
			loop
			<div class="cstm__card-2">
				<div class="cstm__crd2ImgCon">
					<div class="page-bg page-bg--cover" style="background-image: url('/images/home/hm-2.png')"></div>
				</div>
				<div class="cstm__crd2TextCon">
					<p class="cstm__crd2Desc">PBEd honors private sector partners, project opens 19k Jobs for K to 12 grade</p>
					<div class="d-flex">
						<p class="cstm__crd2Misc">October 23, 2019</p>
						<p class="cstm__crd2Misc m-margin-lr">|</p>
						<p class="cstm__crd2Misc">Jessica Vallejo</p>
					</div>
					<p class="cstm__crd2Misc s-margin-t">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
				</div>
			</div>
			end loop
		</div>
	</div>
</section> --}}

@endsection