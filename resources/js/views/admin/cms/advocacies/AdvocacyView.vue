<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row py-4">

				<div class="form-group col-sm-12 col-md-6">
					<label>Title</label>
					<input v-model="item.title" name="title" type="text" class="form-control input-sm">
				</div>

				<div class="form-group col-sm-12 col-md-6">
					<label>URL Link</label>
					<input v-model="item.link" name="link" type="text" class="form-control input-sm">
				</div>
				
				<text-editor
				v-model="item.description"
				class="form-group col-sm-12 col-md-12"
				label="Description"
				name="description"
				row="5"
				></text-editor>

				<image-picker
				:value="item.image_path"
				class="form-group col-sm-12 col-md-12 mt-2"
                label="Image (Recommended : 1024x768) [.jpg, .jpeg, .png]"
                name="image_path"
                placeholder="Choose a File"
                format="image/*"
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
import CrudMixin from '../../../../mixins/crud.js';
import ActionButton from '../../../../components/buttons/ActionButton.vue';
import DatePicker from "../../../../components/datepickers/Datepicker.vue"
import TextEditor from '../../../../components/inputs/TextEditor.vue';
import ImagePicker from '../../../../components/inputs/ImagePicker.vue';

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