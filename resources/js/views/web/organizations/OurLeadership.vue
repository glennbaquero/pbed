<template>
	<div>
		<div class="org-frm2__cntnr">
			<div class="page-section__titleCon">
				<h3 class="font-1 type-2 fntwght--bold">{{ ourLeadershipText }}</h3>
			</div>
			<div class="org-frm2__content">
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
						<div class="org-frm2__card" v-for="item in items">
							<div class="org-frm2__img-holder">
								<div class="page-bg page-bg--cover" :style="{ backgroundImage: `url(${ item.image_path })` }"></div>
							</div>
							<div class="org-frm2__content">
								<p class="type-2">{{ item.main_position }}</p>
								<p class="fntwght--bold">{{ item.name }}</p>
								<p>{{ item.position }}, {{ item.company }}</p>
							</div>
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
			ourLeadershipText: String
		},
	}
</script>