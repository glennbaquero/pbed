<template>
	<div>
		<form @submit.prevent="recaptcha">
			<div class="frm--input m-margin-b">
				<label class="frm--label"><span>Full Name </span>
					<input class="frm--text" type="text" name="" v-model="payloads.name" placeholder="enter your full name">
				</label>
			</div>
			<div class="frm--input m-margin-b">
				<label class="frm--label"><span>Email Address</span>
					<input class="frm--text" type="text" name="" v-model="payloads.email" placeholder="enter your email">
				</label>
			</div>
			<div class="frm--input m-margin-b">
				<label class="frm--label cstm"><span>Contact Number</span>
					<input class="frm--number prepend cstm" type="number" v-model="payloads.contact_number" name="" placeholder="enter your contact number">
				</label>
			</div>
			<div class="frm--input m-margin-b">
				<label class="frm--label"><span>Message</span>
					<textarea class="frm--textarea" rows="5" placeholder="text here" v-model="payloads.message"></textarea>
				</label>
			</div>
			<div class="frm--input m-margin-b">
				<button class="btn type-1" v-if="showButton" @click="send" type="button">Submit</button>
			</div>
			<vue-recaptcha sitekey="6LfulaYZAAAAACccSzyGayIQBnNtEflBGwIzTPKM" ref="invisibleRecaptcha" :loadRecaptchaScript="true" @verify="onCaptchaVerified" @expired="onCaptchaExpired"></vue-recaptcha>
		</form>
	</div>
</template>

<script>
	import ResponseHandler from 'Mixins/errorResponse.js';
	import VueRecaptcha from 'vue-recaptcha';

	export default {
		props: {
			storeUrl: String,
			message: String
		},

		data() {
			return {
				payloads: {},
				showButton: false
			}
		},

		mixins: [ ResponseHandler ],

		components: { VueRecaptcha },

		methods: {
			recaptcha() {
				this.$refs.invisibleRecaptcha.execute()
			},

			send() {
				this.$refs.invisibleRecaptcha.reset() // Direct call reset method
				this.showButton = false;

				axios.post(this.storeUrl, this.payloads)
					.then(response => {
						this.payloads = {};
						swal.fire('Inquiry sent!', this.message,'success');
					}).catch(errors => {
						swal.fire('Ooops!', this.parseResponse(errors),'error');
					})
			},

			onCaptchaVerified(token) {
				this.showButton = true;
			},

			onCaptchaExpired: function () {
				this.showButton = false;
		      	this.$refs.invisibleRecaptcha.reset();
		    }
		}
	}
</script>