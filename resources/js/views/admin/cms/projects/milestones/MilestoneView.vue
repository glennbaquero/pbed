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
				<text-editor
				v-if="ckeditor"
				v-model="item.description"
				class="col-sm-12"
				label="Description"
				name="description"
				row="5"
				></text-editor>
			</div>

			
			<div class="row">
				<div class="form-group col-md-12">
					<label>Know More <small>(Optional: add external link)</small></label>
					<input type="text" name="know_more" v-model="item.know_more" class="form-control">
				</div>
			</div>

			<div class="row">
				<image-picker
				:value="item.path"
				class="form-group col-sm-12 col-md-12 mt-2"
	            label="Image (Recommended: 1024x768)  [.jpg, .jpeg, .png]"
	            name="image_path"
	            placeholder="Choose a File"
				></image-picker>
			</div>

			<template v-slot:footer>
				<action-button type="submit" :disabled="loading" class="btn-primary">Save Changes</action-button>
			</template>
		</card>
		
		<loader :loading="loading"></loader>

	</form-request>
</template>

<script type="text/javascript">
import CrudMixin from 'Mixins/crud.js';
import ActionButton from 'Components/buttons/ActionButton.vue';
import Textbox from 'Components/inputs/Textbox.vue';
import TextEditor from 'Components/inputs/TextEditor.vue';
import ImagePicker from 'Components/inputs/ImagePicker.vue';

import {bus} from 'EventBus/bus.js';

export default {

	props: {
		projectId: Number 
	},

	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'text-editor': TextEditor,
		'image-picker': ImagePicker		
	},

	data() {
		return {
			url: null,			
			ckeditor: false
		}
	},

	watch:{ 
		item(val) {
			this.ckeditor = false

			setTimeout(() => {
				this.ckeditor = true
			}, 200)
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
			bus.$on('fetchMilestone', (data) => {
				this.item = data.item;
				this.url = this.item.updateUrl;
				this.ckeditor = true
			});

			bus.$on('cancelEdit', (data) => {
				this.item = {};
				this.url = this.submitUrl;
			});

		},	


	},

}
</script>