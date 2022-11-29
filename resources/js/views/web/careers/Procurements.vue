<template>
	<div>
		<section class="page-frame crrs-frm crrs-frm2">
			<div class="width--90 margin-a">
				<h2 class="font-1 type-2 fntwght--bold l-margin-b">{{ procurementTitle }}</h2>
				<h3 class="font-1 type-2 fntwght--bold m-margin-b">Call for Proposals</h3>
				<div class="crrs-frm2__cntnr">
					<div class="cstm-box-shadow-15 cstm-border-radius--8 overflow-hidden cstm__card-2" v-for="call in callProcurements">
						<div class="cstm__crd2TextCon">
							<p class="m-margin-b fntwght--bold">{{ call.cfp_no }}</p>
							<p class="m-margin-b fntwght--bold type-2">{{ call.title }} | Deadline : {{ call.deadline }}</p>
							<div class="m-margin-b" v-html="call.description"></div>
							<a @click="showModal(call)" v-if="call.downloadable" class="type-2 fntwght--bold">Download</a>
						</div>
					</div>
				</div>
				<h3 class="font-1 type-2 fntwght--bold m-margin-b">{{ proposalLabel }}</h3>
				<div class="crrs-frm2__cntnr">
					<div class="cstm-box-shadow-15 cstm-border-radius--8 overflow-hidden cstm__card-2" v-for="request in requestProcurements">
						<div class="cstm__crd2TextCon">
							<p class="m-margin-b fntwght--bold">{{ request.cfp_no }}</p>
							<p class="m-margin-b fntwght--bold type-2">{{ request.title }} | Deadline : {{ request.deadline }}</p>
							<div class="m-margin-b" v-html="request.description"></div>
							<a @click="showModal(request)" v-if="request.downloadable" class="type-2 fntwght--bold">Download</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<before-you-submit-email-only-procurement
			:store-url="storeUrl"
			:procurement="selectedProcurement"
		></before-you-submit-email-only-procurement>
	</div>
</template>
<script>
	export default {
		props: {
			callProcurements: Array,
			requestProcurements: Array,
			storeUrl: String,
			proposalLabel: String,
			procurementTitle: String
		},

		data() {
			return {
				selectedProcurement: {}
			}
		},

		methods: {
			showModal(request) {
				this.selectedProcurement = request
				$('#hmModal__precurement-procurement').modal('show')
			}
		}
	}
</script>