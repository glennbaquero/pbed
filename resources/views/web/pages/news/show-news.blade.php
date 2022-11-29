@extends('web.master')

@section('meta:title', $news->name)

@section('og:image', $news->renderImagePath())
@section('og:title', $news->name)
@section('og:description', $news->content)

@section('content')

<section class="page-frame nws-frm nws-frm1">
	<div class="width--90 margin-a">
		<div class="width--60">
			<small><a href="/news" class="type-3">< Back</a></small>
			<h2 class="font-1 type-2 fntwght--bold s-margin-tb">{{ $news->name }}</h2>
			<small class="type-3">{{ $news->author }} | {{ $news->formatted_created_at }}</small>
			<div class="d-flex align-items-center m-margin-t nws-frm__share-cntnr">
				<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $news->show_url }}">
					<img class="ml-0" src="/images/icons/fb_share.png">
				</a>
				<a target="_blank" href="https://twitter.com/share?url={{ $news->show_url }}">
					<img src="/images/icons/twitter_share.png">
				</a>
			</div>
		</div>

		<div class="nws-frm__cntnr">
			<div class="nws-frm__main">
				<div class="cstm-border-radius--8 cstm__card-2 overflow-hidden">
					<div class="cstm__crd2ImgCon">
						<div class="page-bg page-bg--cover" style="background-image: url({{ $news->renderImagePath() }})"></div>
					</div>
				</div>

				<div class="list-style frm-desc">
					<description
						description="{{ $news->content }}"
					></description>
					{{-- {!! $news->content !!} --}}
				</div>
			</div>
			<div class="nws-frm__side-bar scroll-custom">
				<p class="type-3 m-margin-b fntwght--bold">Latest News</p>
				@foreach($news_list as $item)
				<a href="{{ $item->show_url }}">
				<div class="d-flex align-items-start m-margin-b">
					<div class="nws-frm__img-holder">
						<div class="page-bg--16">
							<div class="page-bg page-bg--cover cstm-border-radius--8" style="background-image: url({{ $item->renderImagePath() }})"></div>
						</div>
					</div>
					<div class="nws-frm__content">
						<p class="type-1 fntwght--bold">{{ $item->name }}</p>
						<small class="type-3">{{ $item->author }} | {{ $item->formatted_created_at }}</small>
					</div>
				</div>
				</a>
				@endforeach
			</div>
		</div>
	</div>
</section>

@endsection