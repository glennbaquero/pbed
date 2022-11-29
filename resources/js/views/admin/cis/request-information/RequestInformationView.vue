<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="frm-prfl__row">
                <div class="frm-prfl__col col-3">
                    <p>Form Type</p>
                </div>
                <div class="frm-prfl__col col-9">
					<selector
	        		v-model="item.category_id"
	        		name="category_id"
	        		:items="categories"
	        		item-value="id"
	        		item-text="name"
	        		:showLabel="false"
	        		placeholder="Select contact category"
	        		></selector>
                </div>
                <div class="frm-prfl__col col-3">
                    <p>Confidentiality*</p>
                </div>
                <div class="frm-prfl__col col-9">
					<selector
	        		v-model="item.confidentiality_ids"
	        		name="confidentiality_ids[]"
	        		:items="confidentialities"
	        		item-value="id"
	        		item-text="name"
	        		:showLabel="false"
	        		multiple
	        		placeholder="Please select a confidentiality"
	        		></selector>
                </div>
                <input type="hidden" name="fields" :value="toStringFields(fieldsToDisplay)" class="form-control">
                <template v-for="(field, key) in fieldsToDisplay">
                	<div class="frm-prfl__col col-3">
	                    <p>{{ field.name }}
	                    	<template v-if="field.required">*</template>
	                    </p>
	                </div>
	                <div class="frm-prfl__col col-9">	                	
						<input type="text" :name="field.name_field+'Value'" :value="field.value != undefined ? field.value : null" :required="field.required">
						<input type="hidden" :name="field.name_field+'Name'" v-model="field.name">
	                </div>
				</template>
				<div class="frm-prfl__col col-3">
                    <p>Note</p>
                </div>
                <div class="frm-prfl__col col-9 img-picker">
                    <text-editor
					v-model="item.notes"
					name="notes"
					row="5"
					></text-editor>
                </div>
            </div>
	        <!-- <template v-slot:header>
	        	<div class="row">
	        		<div class="col-sm-2 text-center">
	        			<label>Form Type</label>
	        		</div>
	        		<selector class="col-sm-2"
	        		v-model="item.category_id"
	        		name="category_id" 
	        		label=""
	        		:items="categories"
	        		item-value="id"
	        		item-text="name"
	        		:showLabel="false"
	        		placeholder="Select contact category"
	        		></selector>
	        	</div>  
	    	</template> -->

			<!-- <div class="row">
				<div class="form-group col-sm-2 text-center">
					<label>Confidentiality *</label>
				</div>
        		<selector class="col-sm-10"
        		v-model="item.confidentiality_ids"
        		name="confidentiality_ids[]" 
        		label=""
        		:items="confidentialities"
        		item-value="id"
        		item-text="name"
        		:showLabel="false"
        		multiple
        		placeholder="Please select a confidentiality"
        		></selector>
			</div> -->

			<!-- <div class="row">
				<input type="hidden" name="fields" :value="toStringFields(fieldsToDisplay)" class="form-control">
				<template v-for="(field, key) in fieldsToDisplay">
					<div class="form-group col-sm-2 text-center">
						<label>
							{{ field.name }} 
							<template v-if="field.required">
								*
							</template>
						</label>
					</div>
					<div class="form-group col-sm-10">
						<input type="text" :name="field.name_field+'Value'" :value="field.value != undefined ? field.value : null" :required="field.required">
						<input type="hidden" :name="field.name_field+'Name'" v-model="field.name">
					</div>
				</template>
			</div>

			<div class="row">
				<div class="col-sm-2 text-center">
					<label>Note</label>
				</div>
				<text-editor
				v-model="item.notes"
				class="col-sm-12"
				label=""
				name="notes"
				row="5"
				></text-editor>
			</div> -->

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
            :message="'Are you sure you want to archive Contact Information #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore Contact Information #' + item.id + '?'"
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
import Select from 'Components/inputs/Select.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.categories = data.categories ? data.categories : this.categories;
			this.confidentialities = data.confidentialities ? data.confidentialities : this.confidentialities;
			this.fields = data.fields ? data.fields : this.fields;
			this.definite_fields = data.definite_fields ? data.definite_fields : this.definite_fields;
			this.updateCategoryId = data.item ? data.item.category_id : this.updateCategoryId;
			if(!this.update) {
				this.fieldsToDisplay = this.definite_fields;
			} else {
				this.fieldsToDisplay = [];
				this.fieldsToDisplay = this.item.fieldValues;
				if(fields.length > this.item.fieldValues.length) {
					_.each(this.item.fieldValues, (value) => {
						_.each(fields, (field) => {
							if(field.name != value.name) {
								this.fieldsToDisplay.push(field);
							}
						})
					})
				}
			}
		},

		toStringFields(fields) {
			return JSON.stringify(fields)
		},
	},

	data() {
		return {
			categories: [],
			confidentialities: [],
			fields: [],
			definite_fields: [],
			fieldsToDisplay: [],
			updateCategoryId: 0,
		}
	},

	watch: {
		'item.category_id'(val) {
			var fields = []

			if(this.update && val == this.updateCategoryId) {
				this.fieldsToDisplay = [];
				this.fieldsToDisplay = this.item.fieldValues;
				if(fields.length > this.item.fieldValues.length) {
					_.each(this.item.fieldValues, (value) => {
						_.each(fields, (field) => {
							if(field.name != value.name) {
								this.fieldsToDisplay.push(field);
							}
						})
					})
				}
			} else {
				_.each(this.definite_fields, (predefined) => {
					fields.push(predefined);
				});

				_.each(this.fields, (category_field) => {
					if(val == category_field.contact_category_id) {
						fields.push(category_field)
					}
				})
				// fields = this.fields.filter(x => x.contact_category_id == this.item.category_id);

				this.fieldsToDisplay = fields;
			}
		}
	},

	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'image-picker': ImagePicker,
		'text-editor': TextEditor,
		'selector': Select,
	},

	props: {
		update:{
			default: false,
			type: Boolean
		}
	},

	mixins: [ CrudMixin ],
}
</script>