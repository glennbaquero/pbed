@extends('web.master')

@section('meta:title', $blog->name)

@section('og:image', $blog->renderImagePath())
@section('og:title', $blog->name)
@section('og:description', $blog->content)

@section('content')

<section class="page-frame nws-frm nws-frm1">
	<div class="width--90 margin-a">
		<div class="width--60">
			<small><a href="/blogs" class="type-3">< Back</a></small>
			<h2 class="font-1 type-2 fntwght--bold s-margin-tb">{{ $blog->name }}</h2>
			<small class="type-3">{{ $blog->author }}</small>
			<div class="d-flex align-items-center m-margin-t nws-frm__share-cntnr">
				<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $blog->show_url }}">
					<img class="ml-0" src="/images/icons/fb_share.png">
				</a>
				<a target="_blank" href="https://twitter.com/share?url={{ $blog->show_url }}">
					<img src="/images/icons/twitter_share.png">
				</a>
			</div>
		</div>

		<div class="nws-frm__cntnr">
			<div class="nws-frm__main">
				<div class="cstm-border-radius--8 cstm__card-2 overflow-hidden">
					<div class="cstm__crd2ImgCon">
						<div class="page-bg page-bg--cover" style="background-image: url({{ $blog->renderImagePath() }})"></div>
					</div>
				</div>

				<div class="list-style frm-desc">
					<description
						description="{{ $blog->content }}"
					></description>
					{{-- {!! $blog->content !!} --}}
				</div>
			</div>
			<div class="nws-frm__side-bar scroll-custom">
				<p class="type-3 m-margin-b fntwght--bold">Latest Blogs</p>
				@foreach($blogs as $blog)
				<a href="{{ $blog->show_url }}">
				<div class="d-flex align-items-start m-margin-b">
					<div class="nws-frm__img-holder">
						<div class="page-bg--16">
							<div class="page-bg page-bg--cover cstm-border-radius--8" style="background-image: url({{ $blog->renderImagePath() }})"></div>
						</div>
					</div>
					<div class="nws-frm__content">
						<p class="type-1 fntwght--bold">{{ $blog->name }}</p>
						<small class="type-3">{{ $blog->author }} | {{ $blog->formatted_created_at }}</small>
					</div>
				</div>
				</a>
				@endforeach
			</div>
		</div>
	</div>
</section>

@endsection