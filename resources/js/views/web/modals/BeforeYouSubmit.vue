<template>
	<div>
		<div class="modal fade gen__modal" id="hmModal__study" tabindex="-1" role="dialog" aria-labelledby="hmModal__studyLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="genMdal__header">
						<h3 class="type-2 fntwght--bold">Before you download...</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="genMdal__body">
						<form  @submit.prevent="submit">
							<div class="frm--input m-margin-b">
								<label class="frm--label"><span>Full Name</span>
									<input class="frm--text" type="text" name="full_name" placeholder="" v-model="payloads.full_name">
								</label>
							</div>
							<div class="frm--input m-margin-b">
								<label class="frm--label"><span>Email Address</span>
									<input class="frm--text" type="email" name="email" placeholder="" v-model="payloads.email">
								</label>
							</div>
							<div class="frm--input m-margin-b">
								<label class="frm--label cstm"><span>Contact Number</span>
									<input class="frm--number prepend cstm" type="number" name="contact_number" placeholder="" v-model="payloads.contact_number">
								</label>
							</div>
							<div class="frm--input m-margin-b">
								<button class="btn type-1 m-margin-t" type="butto" v-if="showButton" @click="download">Continue</button>
							</div>
							<vue-recaptcha sitekey="6LfulaYZAAAAACccSzyGayIQBnNtEflBGwIzTPKM" ref="invisibleRecaptcha" :loadRecaptchaScript="true" @verify="onCaptchaVerified" @expired="onCaptchaExpired"></vue-recaptcha>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import ResponseHandler from 'Mixins/errorResponse.js';
	import VueRecaptcha from 'vue-recaptcha';

	export default {
		props: {
			storeUrl: String,
			latestStudy: Object
		},

		components: { VueRecaptcha },

		data() {
			return {
				payloads: {
					full_name: null,
					email: null,
					contact_number: null,
					latest_study_id: this.latestStudy.id
				},
				showButton: false
			}
		},

		mixins: [ ResponseHandler ],

		watch: {
			'payloads.full_name'(val) {
				this.payloads.latest_study_id = this.latestStudy.id
			}
		},

		methods: {
			submit() {
				this.$refs.invisibleRecaptcha.execute()
			},

			download() {
				this.$refs.invisibleRecaptcha.reset() // Direct call reset method
				this.showButton = false;

				axios.post(this.storeUrl, this.payloads)
					.then(response => {
						this.payloads = {};
						window.open(this.latestStudy.full_file_path, '_blank');
					}).catch(errors => {
						swal.fire('Ooops!', this.parseResponse(errors),'error');
					})
			},

			onCaptchaVerified(token) {
				this.showButton = true;
			},

			onCaptchaExpired: function () {
		      	this.$refs.invisibleRecaptcha.reset();
		    }
		}
	}
</script>