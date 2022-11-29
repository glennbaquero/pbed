<template>
	<div>
		<div class="modal fade gen__modal" id="hmModal__precurement" tabindex="-1" role="dialog" aria-labelledby="hmModal__precurement" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="genMdal__header">
						<h3 class="type-2 fntwght--bold">Before you download...</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="genMdal__body">
						<form @submit.prevent="submit">
							<div class="inlineBlock-parent">
								<div class="frm--input m-margin-b">
									<label class="frm--label"><span>Email Address</span>
										<input class="frm--text" type="email" name="email" placeholder="" required v-model="payloads.email">
									</label>
								</div>

								<div class="frm--input m-margin-b">
									<button class="btn type-1 align-b" type="button" v-if="showButton" @click="download">Continue</button>
								</div>
								<div>
									<vue-recaptcha sitekey="6LfulaYZAAAAACccSzyGayIQBnNtEflBGwIzTPKM" ref="invisibleRecaptcha" :loadRecaptchaScript="true" @verify="onCaptchaVerified" @expired="onCaptchaExpired"></vue-recaptcha>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import VueRecaptcha from 'vue-recaptcha';
	export default {
		props: {
			storeUrl: String,
			procurement: Object,
			isCareer: {
				default: false,
				type: Boolean
			}
		},

		components: { VueRecaptcha },

		data() {
			return {
				payloads: {
					email: null,
				},
				showButton: false
			}
		},

		watch: {
			procurement(val) {
				if(!this.isCareer) {
					this.payloads.procurement_id = val.id;
				} else {
					this.payloads.career_id = val.id;
				}
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
						this.payloads.email = null;
						window.location.href = this.procurement.full_file_path;
					})
			},

			onCaptchaVerified(token) {
				this.showButton = true;
			},

			resetRecaptcha () {
				this.showButton = false;
		      	this.$refs.recaptcha.reset() // Direct call reset method
		    },
		    
			onCaptchaExpired: function () {
				// this.showButton = false;
		      	this.$refs.invisibleRecaptcha.reset();
		    }
		}

	}
</script>