<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row">
				<text-box
				v-model="item.name"
				name="name"
				label="Name"
				></text-box>
			</div>

			<div class="row">
				<text-box
				v-model="item.header"
				name="header"
				label="Header"
				></text-box>
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
            :message="'Are you sure you want to archive Areas of Work #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore Areas of Work #' + item.id + '?'"
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

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
		}
	},

	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
	},

	mixins: [ CrudMixin ],
}
</script>