<template>
	<div>
		<span v-html="parse_desc"></span>
	</div>
</template>
<script>
	export default {
		props: {
			description: String,
		},

		data() {
			return {
				parse_desc: null
			}
		},

		watch: {
			'description'(val) {
				this.init();
			}
		},

		mounted() {
			this.init();
		},

		methods: {
			init() {
				this.parse_desc = this.modifyUrl(this.description);
			},

			modifyUrl(url) {
			     let endpoint = url;
			     endpoint = endpoint.replace('oembed', 'iframe');
			     endpoint = endpoint.replace('url', 'src');
			     endpoint = endpoint.replace('watch?v=', 'embed/');
			     endpoint = endpoint.replace('oembed', 'iframe');
			     console.log(endpoint);
			     return endpoint;
			},
		}
	}
</script>