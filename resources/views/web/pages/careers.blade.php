@extends('web.master')

@section('meta:title', 'Careers')
@section('content')

<careers
	:careers="{{ $careers }}"
	:data="{{ json_encode($page_item['pageItems']) }}"
	store-url="{{ route('web.download.procurement') }}"
></careers>

<procurements
	:call-procurements="{{ $call_procurements }}"
	:request-procurements="{{ $request_procurements }}"
	store-url="{{ route('web.download.procurement') }}"
	proposal-label="{{ $page_item['pageItems']['request_for_proposal_label'] }}"
	procurement-title="{{ $page_item['pageItems']['procurement'] }}"
></procurements>

@endsection