<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<template v-slot:header>
                <div class="bg--gray">
                    <h6 class="fntwght--semibold">Selected Contact</h6>
                </div>
            </template>
            <div class="frm-prfl__row">
                <div class="frm-prfl__col col-3">
                    <p>Confidentiality *</p>
                </div>
                <div class="frm-prfl__col col-9">
                    <selector
            		v-model="item.confidentiality_ids"
            		name="confidentiality_ids[]" 
            		label=""
            		:items="confidentialities"
            		item-value="id"
            		item-text="name"
            		:showLabel="false"
            		multiple
            		placeholder="Please select a confidentiality"
            		disabled
            		></selector>
                </div>

                <input type="hidden" name="fields" :value="toStringFields(fieldsToDisplay)" class="form-control">
                <template v-for="(field, key) in fieldsToDisplay">
                	<div class="frm-prfl__col col-3">
	                    <p>{{ key }} </p>
	                </div>
					<div class="frm-prfl__col col-9">
						<input type="text" :value="field" readonly>
					</div>
				</template>
            </div>

			<!-- <div class="row">
				<input type="hidden" name="fields" :value="toStringFields(fieldsToDisplay)" class="form-control">
				<template v-for="(field, key) in fieldsToDisplay">
					<div class="form-group col-sm-2 text-center">
						<label>
							{{ key }} 
							<template v-if="field.required">
								*
							</template>
						</label>
					</div>
					<div class="form-group col-sm-10">
						<input type="text" :name="field.name_field+'Value'" class="form-control" :value="field" readonly>
					</div>
				</template>
			</div> -->

			<!-- <div class="row">
				<div class="col-sm-2 text-center">
					<label>Note</label>
				</div>
				<text-editor
				v-model="item.notes"
				class="col-sm-12"
				label=""
				name="notes"
				row="5"
				disabled
				></text-editor>
			</div>

			<template v-slot:footer>
			</template> -->
		</card>

		<card>
            <template v-slot:header>
                <div class="bg--light-gray">
                    <h6 class="fntwght--semibold">Note</h6>
                </div>
            </template>
            <div class="frm-prfl__row">
                <div class="frm-prfl__col textarea">
                    <text-editor
					v-model="item.notes"
					label=""
					name="notes"
					row="5"
					disabled
					></text-editor>
                    <div class="align-r mt-2">
                        <p>Message {{ item.notes ? item.notes.length : 0  }} words</p>
                    </div>
                </div>
            </div>
        </card>
        	<template v-if="hasNoAccess">
		        <card>
					<template v-slot:header>
		                <div class="bg--gray d-flex">
		                    <h6 class="fntwght--semibold">Request Contact Information</h6>                     
		                </div>
		            </template>
					<div 
						class="frm-prfl__row"
					>
						<div class="frm-prfl__col textarea">					
							<text-editor
							label=""
							v-model="reason.reason"
							name="reason"
							row="5"
							placeholder="Reason"
							:disabled="hasRequest"
							></text-editor>
						</div>
						<input type="hidden" name="contact_information_id" :value="item.id">
					</div>
				</card>

		        <div 
		        	v-if="!request"
		        	class="col-12 px-0 align-l"
		        >
		            <action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-4">Request Information</action-button>
		        </div>
        	</template>
        	<template v-else>
		        <card>
					<template v-slot:header>
		                <div class="bg--gray d-flex">
		                    <h6 class="fntwght--semibold">Request To Edit</h6>                     
		                </div>
		            </template>
					<div 
						class="frm-prfl__row"
					>
						<div class="frm-prfl__col textarea">					
							<text-editor
							label=""
							v-model="reason.reason"
							name="reason"
							row="5"
							placeholder="Reason"
							:disabled="hasRequest"
							></text-editor>
						</div>
						<input type="hidden" name="contact_information_id" :value="item.id">
					</div>
				</card>

		        <div 
		        	v-if="!request"
		        	class="col-12 px-0 align-l"
		        >
		            <action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-4">Request To Edit</action-button>
		        </div>
        	</template>


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
			this.reason = data.reason ? data.reason : this.reason;
			this.hasNoAccess = data.has_no_access;
			this.hasRequest = data.hasRequest ? data.hasRequest : this.hasRequest;
			this.request = data.request;
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
			item: [],
			request: {},
			categories: [],
			confidentialities: [],
			fields: [],
			definite_fields: [],
			fieldsToDisplay: [],
			updateCategoryId: 0,
			reason: {
				reason: null
			},
			hasRequest: false,
			hasNoAccess: false
		}
	},

	computed: {
		disableField() {
			if(this.request) {
				return true;
			}
			return false;
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