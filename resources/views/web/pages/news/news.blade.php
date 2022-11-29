@extends('web.master')

@section('meta:title', 'News')
@section('content')

<section class="page-frame nws-frm nws-frm1">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">news</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">{{ $pageItems['news_header_title'] }}</h2>
		</div>

		<news
			:news="{{ $news }}"
		></news>
	</div>
</section>


@endsection