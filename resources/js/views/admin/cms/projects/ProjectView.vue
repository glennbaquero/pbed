<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>

			<div class="row">
				<div class="custom-control custom-switch ml-3">
					<input
					v-model="item.for_teacher_learning"
					name="for_teacher_learning" :checked="item.for_teacher_learning" type="checkbox" class="custom-control-input" id="for_teacher_learning">
					<label class="custom-control-label" for="for_teacher_learning">Featured in Teaching and Learning Page</label>
				</div>
			</div>

			<div class="row">
				<div class="custom-control custom-switch ml-3">
					<input
					v-model="item.for_workforce_development"
					name="for_workforce_development" :checked="item.for_workforce_development" type="checkbox" class="custom-control-input" id="for_workforce_development">
					<label class="custom-control-label" for="for_workforce_development">Featured in Workforce Development Page</label>
				</div>
			</div>

			<div class="row">
				<div class="custom-control custom-switch ml-3">
					<input
					v-model="item.is_other_page"
					name="is_other_page" :checked="item.is_other_page" type="checkbox" class="custom-control-input" id="is_other_page">
					<label class="custom-control-label" for="is_other_page">Link to others page?</label>
				</div>
			</div>
			
			<div class="row" v-if="showLinkInput">
				<div class="form-group col-md-12">
					<label>Link to other page</label>
					<input type="text" name="link" v-model="item.link" class="form-control">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label>Header Title Label</label>
					<input type="text" name="header_title_label" v-model="item.header_title_label" class="form-control">
				</div>
				<div class="form-group col-md-6">
					<label>Project Name</label>
					<input type="text" name="name" v-model="item.name" class="form-control">
				</div>
			</div>

			<div class="row">
				<text-editor
				v-model="item.description"
				class="col-sm-12"
				label="Description"
				name="description"
				row="5"
				></text-editor>
			</div>
			
			<div class="row">
				<image-picker
				:value="item.path"
				class="form-group col-sm-12 col-md-12 mt-2"
	            label="Icon (Recommended : 1024x768) [.jpg, .jpeg, .png]"
	            name="icon"
	            placeholder="Choose a File"
				></image-picker>
			</div>

			<div class="row">
				<image-picker
				:value="slider_images"
				class="form-group col-sm-12 col-md-12 mt-2"
	            label="Sliders (Recommended : 1024x768)  [.jpg, .jpeg, .png]"
	            name="slider_images[]"
	            placeholder="Choose a File"
	            multiple
	            sortable
	            :sort-url="sortUrl"
	            :remove-url="item.removeImageUrl"
	            @remove="fetch()"
				></image-picker>
			</div>

		</card>
		<div class="col-12 px-0 align-r mt-4">
            <action-button
            v-if="item.archiveUrl && item.restoreUrl"
            color="btn frm-btn type-2 px-4 ml-2"
            alt-color="btn-warning"
            :action-url="item.archiveUrl"
            :alt-action-url="item.restoreUrl"
            label="Archive"
            alt-label="Restore"
            :show-alt="item.deleted_at"
            confirm-dialog
            title="Archive Item"
            alt-title="Restore Item"
            :message="'Are you sure you want to archive Project #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore Project #' + item.id + '?'"
            :disabled="loading"
            @load="load"
            @success="fetch"
            ></action-button>
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
import TextEditor from 'Components/inputs/TextEditor.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.slider_images = data.slider_images ? data.slider_images : this.slider_images;
		}
	},

	data() {
		return {
			slider_images: [],
			showLinkInput: false
		}
	},

	watch: {
		'item.is_other_page'(val) {
			this.showLinkInput = val;
		}
	},

	props: {
		sortUrl:{
			default: 'example'
		},
	},

	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'image-picker': ImagePicker,
		'text-editor': TextEditor
	},

	mixins: [ CrudMixin ],
}
</script>