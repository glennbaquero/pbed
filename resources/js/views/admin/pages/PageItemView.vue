<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row">
				<div class="form-group col-sm-12 col-md-6">
					<label>Name</label>
					<input v-model="item.name" name="name" type="text" class="form-control input-sm">
				</div>

				<div class="form-group col-sm-12 col-md-6">
					<label>Slug <small class="text-danger">(Warning: editing this may cause issues)</small></label>
					<input v-model="item.slug" name="slug" type="text" class="form-control input-sm">
				</div>

				<selector class="col-sm-12 col-md-6"
				v-model="item.page_id"
				name="page_id"
				label="Page"
				label-note="(Warning: editing this may cause issues)"
				:items="pages"
				item-value="id"
				item-text="name"
				empty-text="None"
				placeholder="Please select a page"
				></selector>

				<selector class="col-sm-12 col-md-6"
				v-model="item.type"
				name="type"
				label="Type"
				label-note="(Warning: editing this may cause issues)"
				:items="types"
				placeholder="Please select a type"
				></selector>
			</div>

			<page-item-content 
			:type="item.type" 
			name="content" 
			label="Content" 
			:value="item.content"
			></page-item-content>

		</card>
		<div class="col-12 px-0 align-r mt-4">
			<a v-if="item.parentUrl" :href="item.parentUrl" target="_blank" class="btn frm-btn type-3 px-4 ml-2">View Parent</a>
			<action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-4 ml-2">Save Changes</action-button>            
        </div>

		<loader :loading="loading"></loader>
		
	</form-request>
</template>

<script type="text/javascript">
import CrudMixin from '../../../mixins/crud.js';

import ActionButton from '../../../components/buttons/ActionButton.vue';
import Select from '../../../components/inputs/Select.vue';
import PageItemContent from './PageItemContent.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.pages = data.pages ? data.pages : this.pages;
			this.types = data.types ? data.types : this.types;
		}
	},

	data() {
		return {
			types: [],
			pages: [],
		}
	},

	props: {
		pageItem: {},
		noTitle: {
			default: false,
		},
	},

	components: {
		'action-button': ActionButton,
		'selector': Select,
		'page-item-content': PageItemContent,
	},

	mixins: [ CrudMixin ],
}
</script>