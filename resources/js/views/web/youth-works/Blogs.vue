<template>
	<div>
		<div class="width--90 margin-a">
			<div class="d-flex ythwrk-frm7__cntnr">
				<data-table
				ref="data-table"
				class="row mx-0 w-100"
				:headers="headers"
				:filters="filters"
				:fetch-url="fetchUrl"
				:no-action="true"
				:disabled="disabled"
				:is-table="false"
				order-by="id"
				@load="load"
				>
					<template v-slot:body="{ items }">
						
							<div class="cstm__card-2" v-for="item in items">
								<a :href="item.show_url">
								<div class="cstm__crd2ImgCon">
									<div class="page-bg page-bg--cover":style="{ backgroundImage: `url(${ item.image_path })` }"></div>
								</div>
								<div class="cstm__crd2TextCon">
									<p class="cstm__crd2Desc">{{ item.name }}</p>
									<div class="d-flex">
										<p class="cstm__crd2Misc">{{ item.formatted_created_at }}</p>
										<p class="cstm__crd2Misc m-margin-lr" v-if="item.formatted_created_at">|</p>
										<p class="cstm__crd2Misc">{{ item.author }}</p>
									</div>
									<p class="cstm__crd2Misc cstm__crd2Content s-margin-t scroll-custom list-style"  v-html="item.content"></p>
								</div>
								</a>
							</div>
					</template>
				</data-table>
			</div>
		</div>
	</div>
</template>
<script>
	import ListMixin from 'Mixins/list.js';

	export default {
		mixins: [ ListMixin ],

		props: {
			fetchUrl: String,
		},

		methods: {

		}
	}
</script>