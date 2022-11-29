<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row">
				<div class="form-group col-md-12">
					<label>Course</label>
					<input type="text" v-model="item.course" name="course" class="form-control">
				</div>
				<div class="form-group col-md-12">
					<label>Site</label>
					<input type="text" v-model="item.site" name="site" class="form-control">
				</div>
				<div class="form-group col-md-12">
					<label>Registration Link</label>
					<input type="text" v-model="item.link" name="link" class="form-control">
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
            :message="'Are you sure you want to archive YouthWorks: Course #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore YouthWorks: Course #' + item.id + '?'"
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
		}
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