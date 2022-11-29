<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row">
				<div class="form-group col-sm-12">
					<div class="custom-control custom-switch">
					<input name="downloadable" value="1" :checked="item.downloadable" type="checkbox" class="custom-control-input" id="downloadable">
						<label class="custom-control-label" for="downloadable">Can Download?</label>
					</div>
				</div>
				
				<selector class="col-sm-12 col-md-6"
				v-model="item.type"
				name="type" 
				label="Request"
				showLabel
				:items="types"
				item-value="id"
				item-text="name"
				placeholder="Select request"
				></selector>

				<div class="form-group col-sm-12 col-md-6">
					<label>CFP Number</label>
					<input v-model="item.cfp_no" name="cfp_no" type="text" class="form-control input-sm">
				</div>

				<div class="form-group col-sm-12 col-md-6">
					<label>Title</label>
					<input v-model="item.title" name="title" type="text" class="form-control input-sm">
				</div>

				<date-picker
				v-model="item.deadline"
				class="form-group col-sm-12 col-md-6"
				label="Deadline"
				name="deadline"
				placeholder="Choose a date"
				:enable-time="false"
				></date-picker>

				<text-editor
				v-model="item.description"
				class="form-group col-sm-12 col-md-12"
				label="Description"
				name="description"
				row="5"
				></text-editor>
				
				<div class="form-group col-sm-12 col-md-12" v-if="item.file_path">
					<label><a :href="item.file_path" target="_blank">View File</a></label>
				</div>

				<div class="form-group col-sm-12 col-md-12">
					<label>File  [.pdf]</label>
					<input name="file_path" type="file" class="form-control input-sm" accept=".pdf, .docx, .xlsx, .xls">
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
import Select from 'Components/inputs/Select.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.types = data.types ? data.types : this.types;
		}
	},

	data() {
		return {
			types: []
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
		'selector': Select,	
	},

	mixins: [ CrudMixin ],
}
</script>