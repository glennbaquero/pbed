@extends('web.master')

@section('meta:title', 'Contact Us')
@section('content')

<section class="page-frame cntct-frm cntct-frm1">
	<div class="width--90 margin-a">
		<div class="page-section__titleCon align-c">
			<div class="s-margin-b inlineBlock-parent">
				<div class="page-section__line"></div>
				<small class="fntwght--bold uppercase">contacts us</small>
			</div>
			<h2 class="font-2 type-1 fntwght--bold">{{ $home['pageItems']['home_contact_us_header_title'] }}</h2>
		</div>

		<div class="d-flex align-items-center cntct-frm__cntnr">
			<div class="cntct-frm__col">
				<contact-us
					store-url="{{ route('web.store.contact-us') }}"
					message="{{ $contact_us['pageItems']['inquiry_sent_message'] }}"
				></contact-us>
			</div>
			<div class="cntct-frm__col">
				{{-- cntct-frm__map-holder --}}
				<div class=" cstm-box-shadow-15 cstm-border-radius--8 cntct-frm__map-holder">
					<google-map
						height="100%"
						width="100%"
						pbed-latitude="{{ $contact_us['pageItems']['pbed_location_latitude'] }}"
						pbed-longitude="{{ $contact_us['pageItems']['pbed_location_longitude'] }}"
					></google-map>
				</div>
				<div class="d-flex align-items-start flex-wrap cntct-frm__details">
					<a href="https://www.waze.com/ul?ll=14.55475400%2C121.01783110&navigate=yes" target="_blank" class="cntct-frm__item unlink">
						<img src="/images/icons/map-pin.png">
						<p>{{ $home['pageItems']['home_contact_us_address'] }}</p>
					</a>
					<a href="mailto:{{ $home['pageItems']['home_contact_us_email'] }}" target="_blank" class="cntct-frm__item unlink">
						<img src="/images/icons/email.png">
						<p>{{ $home['pageItems']['home_contact_us_email'] }}</p>
					</a>
					<a href="tel:{{ $home['pageItems']['home_contact_us_contact_number'] }}" target="_blank" class="cntct-frm__item unlink">
						<img src="/images/icons/phone.png">
						<p>{{ $home['pageItems']['home_contact_us_contact_number'] }}</p>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection