@extends('web.master')

@section('meta:title', 'Projects')
@section('content')

<section class="page-frame prjcts-frm prjcts-frm1">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">projects</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">What We Do</h2>
		</div>
		<div class="prjcts-frm1__content d-flex">
			@foreach($projects as $project)
				<div class="cstm-box-shadow-25 cstm-border-radius--8 overflow-hidden cstm__card-2">
					@if(!$project->is_other_page)
						<a href="{{ route('web.projects.show' , [$project->id, $project->name]) }}">
							<div class="cstm__crd2ImgCon">
								<div class="cstm__crd2Img" style="background-image: url({{ 'storage/' . $project->icon }})"></div>
							</div>
							<div class="cstm__crd2TextCon">
								<p class="cstm__crd2SubTitle mb-0">{{ $project->name }}</p>
							</div>
						</a>
					@else
						<a href="{{ $project->link }}" target="_blank">
							<div class="cstm__crd2ImgCon">
								<div class="cstm__crd2Img" style="background-image: url({{ 'storage/' . $project->icon }})"></div>
							</div>
							<div class="cstm__crd2TextCon">
								<p class="cstm__crd2SubTitle mb-0">{{ $project->name }}</p>
							</div>
						</a>
					@endif
				</div>
			@endforeach
		</div>
	</div>
</section>


@endsection