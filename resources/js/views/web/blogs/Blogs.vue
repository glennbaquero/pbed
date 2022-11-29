<template>
	<div>
		<section class="page-frame nws-frm nws-frm2">
			<div class="width--90 margin-a">
				<div class="nws-frm2__cntnr">
					<!-- {{-- loop --}} -->

					<data-table
					ref="data-table"
					class="row mx-0"
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
								<blogs-card
									:item="item"
								></blogs-card>
							</div>
						</template>
						
					</data-table>
					<!-- {{-- end loop --}} -->
				</div>
			</div>
		</section>
	</div>
</template>
<script>
	import ListMixin from 'Mixins/list.js';
	import BlogsCard from './BlogsCard.vue';

	export default {
		mixins: [ ListMixin ],

		components: {
			'blogs-card': BlogsCard
		},

		props: {
			fetchUrl: String,
		},

		methods: {

		}
	}
</script>