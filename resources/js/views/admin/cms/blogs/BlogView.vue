<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row py-4">
				<div class="form-group col-md-4">
					<label>Name</label>
					<input type="text" class="form-control" v-model="item.name" name="name">
				</div>
				<div class="form-group col-md-4">
					<label>Author</label>
					<input type="text" class="form-control" v-model="item.author" name="author">
				</div>
				<date-picker
				v-model="item.date_posted"
				class="form-group col-sm-4 "
				label="Publish Date"
				name="date_posted"
				placeholder="Choose a date"
				date-format="Y-m-d"
				enable-time="false"
				></date-picker>
			</div>

				<text-editor
				v-model="item.content"
				class="col-sm-12"
				label="Content"
				name="content"
				row="5"
				></text-editor>		

				<image-picker
				:value="item.path"
				class="form-group col-sm-12 col-md-12 my-4"
	            label="Image (Recommended : 1024x768) [.jpg, .jpeg, .png]"
	            name="image_path"
	            placeholder="Choose a File"
				></image-picker>		

				<div class="form-group col-sm-12 col-md-12">
					<div class="custom-control custom-switch">
					<input name="featured" value="1" :checked="item.featured" type="checkbox" class="custom-control-input" id="featured">
						<label class="custom-control-label" for="featured">Featured in YouthWorkPH Page <small>(Featured this blog in YouthWorkPH Page)</small></label>
					</div>
				</div>

				<div class="form-group col-sm-12 col-md-12">
					<div class="custom-control custom-switch">
					<input name="for_youthworks" value="1" :checked="item.for_youthworks" type="checkbox" class="custom-control-input" id="for_youthworks">
						<label class="custom-control-label" for="for_youthworks">For YouthWorkPH Page <small>(Display this blog in YouthWorkPH Page)</small></label>
					</div>
				</div>				
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
            :message="'Are you sure you want to archive Blog #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore Blog #' + item.id + '?'"
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
import Datepicker from 'Components/datepickers/Datepicker.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
		}
	},

	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'image-picker': ImagePicker,
		'date-picker': Datepicker,
		'text-editor': TextEditor
	},

	mixins: [ CrudMixin ],
}
</script>