<template>
	<div>
		<a :href="item.show_url">
			<div class="cstm__crd2ImgCon page-bg--16">
				<div class="page-bg page-bg--cover" :style="{ backgroundImage: `url(${ item.image_path })` }"></div>
			</div>
			<div class="cstm__crd2TextCon">
				<p class="cstm__crd2Desc">{{ item.name }}</p>
				<div class="d-flex">
					<p class="cstm__crd2Misc">{{ item.date_posted }}</p>
					<p class="cstm__crd2Misc m-margin-lr" v-if="item.date_posted">|</p>
					<p class="cstm__crd2Misc">{{ item.author }}</p>
				</div>
				<p class="cstm__crd2Misc blog__desc-text s-margin-t list-style" v-html="item.content"></p>
			</div>
		</a>
	</div>
</template>

<script>
	export default {
		props: {
			item: {},
		},
	}
</script>