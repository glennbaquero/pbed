<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row py-4">
				<div class="form-group col-sm-12 col-md-6">
					<label>Name</label>
					<input v-model="item.name" name="name" type="text" class="form-control input-sm">
				</div>

				<div class="form-group col-sm-12 col-md-6">
					<label>Reference No.</label>
					<input v-model="item.reference_no" name="reference_no" type="text" class="form-control input-sm">
				</div>
				
				<div class="form-group col-sm-12 col-md-6">
					<label>Position</label>
					<input v-model="item.position" name="position" type="text" class="form-control input-sm">
				</div>

				<!-- <selector class="col-sm-12 col-md-6"
				v-model="item.type"
				name="type[]"
				label="Type"
				:items="type"
				item-value="id"
				item-text="name"
				empty-text="None"
				placeholder="Please select a type"
				value="test"
				multiple
				></selector> -->
				
				<div class="form-group col-sm-12 col-md-6">
					<label>Type</label>
					<input v-model="item.type" name="type" type="text" class="form-control input-sm">
				</div>

				<date-picker
				v-model="item.job_expiry"
				class="form-group col-sm-12 col-md-6 mt-2"
				label="Job Expiry"
				name="job_expiry"
				placeholder="Choose a date"
				></date-picker>

				<text-editor
				v-model="item.description"
				class="form-group col-sm-12 col-md-12"
				label="Description"
				name="description"
				row="5"
				></text-editor>

				<div class="form-group col-sm-12 col-md-12">
					<label>File [.pdf]<small v-if="item.fileUrl"><a :href="item.fileUrl" target="_blank">View File </a></small></label>
					<input name="downloadable_file" type="file" class="form-control input-sm">
				</div>

				<image-picker
				v-model="item.image_path"
				class="form-group col-sm-12 col-md-12 mt-2"
                label="Image (Recommended : 500x500)"
                name="image_path"
                placeholder="Choose a File"
				></image-picker>

			</div>

		</card>
		<div class="col-12 px-0 align-r mt-4">
			<a v-if="item.parentUrl" :href="item.parentUrl" target="_blank" class="btn frm-btn type-3 px-4 ml-2">View Parent</a>
        
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
            :message="'Are you sure you want to archive #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore #' + item.id + '?'"
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
import DatePicker from "Components/datepickers/Datepicker.vue"
import TextEditor from 'Components/inputs/TextEditor.vue';
import ImagePicker from 'Components/inputs/ImagePicker.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
		}
	},

	data() {
		return {
		}
	},

	props: {
		noTitle: {
			default: false,
		},
		sortUrl:{
			default: 'example'
		}
	},

	components: {
		'action-button': ActionButton,
		'text-editor': TextEditor,		
		'date-picker': DatePicker,		
		'image-picker': ImagePicker,		
	},

	mixins: [ CrudMixin ],
}
</script>