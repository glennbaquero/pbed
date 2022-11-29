<template>
	<form-request :submit-url="url" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row">
				<div class="form-group col-md-12">
					<label>Name</label>
					<input type="text" name="name" v-model="item.name" class="form-control">
					<input type="hidden" name="project_id" :value="projectId" class="form-control">
				</div>
			</div>

			<div class="row">
				<image-picker
				:value="item.path"
				class="form-group col-sm-12 col-md-12 mt-2"
	            label="Image (Recommended 500x500)  [.jpg, .jpeg, .png]"
	            name="image_path"
	            placeholder="Choose a File"
				></image-picker>
			</div>

		</card>
		<div class="col-12 px-0 align-r mt-4">
			<action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-4 ml-2">Save Changes</action-button>
		</div>
		
		<loader :loading="loading"></loader>

	</form-request>
</template>

<script type="text/javascript">
import CrudMixin from 'Mixins/crud.js';
import ActionButton from 'Components/buttons/ActionButton.vue';
import Textbox from 'Components/inputs/Textbox.vue';
import ImagePicker from 'Components/inputs/ImagePicker.vue';

import {bus} from 'EventBus/bus.js';

export default {
	props: {
		projectId: Number 
	},
	
	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'image-picker': ImagePicker		
	},

	data() {
		return {
			url: null,			
		}
	},

	mounted() {
		this.eventHandler();
		this.init();
	},

	mixins: [ CrudMixin ],

	methods: {

		/*
		|--------------------------------------------------------------------------
		| @Initialize
		|--------------------------------------------------------------------------
		*/
		init() {
			this.url = this.submitUrl;
		},


		/*
		|--------------------------------------------------------------------------
		| @Methods
		|--------------------------------------------------------------------------
		*/
		

		fetch() {
			this.$emit('refresh');
		},

		/**
		 * Event handler
		 * 
		 */
		eventHandler() {
			bus.$on('fetchMembers', (data) => {
				this.item = data.item;
				this.url = this.item.updateUrl;
			});

			bus.$on('cancelEdit', (data) => {
				this.item = {};
				this.url = this.submitUrl;
			});

		},	


	},

}
</script>