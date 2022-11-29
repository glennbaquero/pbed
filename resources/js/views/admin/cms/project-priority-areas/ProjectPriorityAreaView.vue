<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row">
				<div class="form-group col-sm-12 col-md-12">
					<label>Name</label>
					<input v-model="item.name" name="name" type="text" class="form-control input-sm">
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
            :message="'Are you sure you want to archive '+ pageName +' #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore '+ pageName +' #' + item.id + '?'"
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
			this.pageName = this.isGrowthSector ? 'Growth Sector' : 'Project Priority Area';
		}
	},

	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'image-picker': ImagePicker,
		'text-editor': TextEditor
	},

	props: {
		isGrowthSector: {
			default: false
		}
	},

	data() {
		return {
			pageName: null
		}
	},

	mixins: [ CrudMixin ],
}
</script>