<template>
	<div>
		<section class="page-frame crrs-frm crrs-frm1">
			<div class="width--90 margin-a">
				<div class="page-section__titleCon align-c">
					<div class="s-margin-b inlineBlock-parent">
						<div class="page-section__line"></div>
						<small class="fntwght--bold uppercase">{{ data.careers }}</small>
					</div>
					<h2 class="font-2 type-1 fntwght--bold">{{ data.careers_page_work_with_great_people }}</h2>
				</div>
				<div class="align-c m-margin-t">
					<h1 class="type-2 font-2 fntwght--bold">{{ data.careers_call_for_applications }}</h1>
				</div>
				<div class="crrs-frm1__cntnr">
					<div class="crrs-frm1__card cstm-border-radius--8 cstm-box-shadow-15 overflow-hidden" v-for="career in careers">
						<div class="crrs-frm1__img-holder">
							<div class="page-bg--100">
								<div class="page-bg page-bg--cover cstm-border-radius--8" :style="{ backgroundImage: `url(${ career.full_image_path })` }"></div>
							</div>
						</div>
						<div class="crrs-frm1__content">
							<p class="type-2 fntwght--bold m-margin-b">{{ career.position }}</p>
							<small class="type-3 fntwght--bold">Job expires on:</small>
							<p class="expiry m-margin-b">{{ career.expiry }}</p>
							<a  class="type-2 fntwght--bold" @click="selectedCareer = career" data-toggle="modal" data-target="#hmModal__precurement">Download</a>
						</div>
					</div>

				</div>
			</div>
		</section>

		<before-you-submit-email-only
			:store-url="storeUrl"
			:procurement="selectedCareer"
			:is-career="true"
		></before-you-submit-email-only>
	</div>
	
</template>
<script>
	export default {
		props: {
			careers: Array,
			storeUrl: String,
			data: Array
		},

		data() {
			return {
				selectedCareer: {}
			}
		}
	}
</script>