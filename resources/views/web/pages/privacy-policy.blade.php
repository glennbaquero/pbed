@extends('web.master')

@section('meta:title', 'Contact Us')
@section('content')

<section class="page-frame prvcy-frm prvcy-frm1">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">privacy policy</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">Privacy Policy</h2>
		</div>		
	</div>
	<div class="width--65 margin-a">
		<div class="prvcy-frm1__cntnr list-style frm-desc">
			{!! $pageItems['privacy_policy'] !!}
		</div>
	</div>
</section>

@endsection