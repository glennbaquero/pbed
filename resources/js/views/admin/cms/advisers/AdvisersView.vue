<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row py-4">

				<selector
				v-model="item.prefix"
				name="prefix"
				class="col-sm-12 col-md-6"
				:items="prefixes"
				showLabel
				item-value="name"
				item-text="label"
				label="Prefix"
				placeholder="Select a prefix"
				></selector>

				<div class="form-group col-sm-12 col-md-6">
					<label>Name</label>
					<input v-model="item.name" name="name" type="text" class="form-control input-sm">
				</div>

				<div class="form-group col-sm-12 col-md-6">
					<label>Company</label>
					<input v-model="item.company" name="company" type="text" class="form-control input-sm">
				</div>
				<div class="form-group col-sm-12 col-md-6">
					<label>Main Position</label>
					<input v-model="item.main_position" name="main_position" type="text" class="form-control input-sm">
				</div>
			<!-- 	<div class="form-group col-sm-12 col-md-6">
					<label>Position</label>
					<input v-model="item.position" name="position" type="text" class="form-control input-sm">
				</div> -->

				<image-picker
				:value="item.image_path"
				class="form-group col-sm-12 col-md-12 mt-2"
                label="Image (Recommended: 500x500) [.jpg, .jpeg, .png]"
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
import Select from 'Components/inputs/Select.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
		}
	},

	data() {
		return {
			prefixes: [
				{
					name: 'Mr.',
					label: 'Mr',
				},
				{
					name: 'Ms.',
					label: 'Miss (Ms)',
				},
				{
					name: 'Mrs.',
					label: 'Mrs',
				},
				{
					name: 'Dr.',
					label: 'Doctor',
				},
				{
					name: 'Amb.',
					label: 'Ambassador',
				},
				{
					name: 'Atty.',
					label: 'Attorney',
				},
				{
					name: 'Br.',
					label: 'Brother',
				},
				{
					name: 'Prof.',
					label: 'Professor',
				},
			]
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