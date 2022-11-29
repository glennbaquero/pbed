<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
	        <!-- <template v-slot:header>
	        	<div class="row">
	        		<div class="col-sm-2">
	        			<label>Details</label>
	        		</div>
	        	</div>  
	    	</template> -->
			<div class="frm-prfl__row frm-fields">
                <div class="frm-prfl__col col-3">
                    <p>Column Names</p>
                </div>
                <div class="frm-prfl__col col-9" v-if="!enableEdit">
                </div>
                <template v-for="field, key in arrayOfInput">
	                <div class="frm-prfl__col col-9">
	                	<div class="row px-0">
	                		<div class="col-md-1 text-center px-0 line-height-35" v-if="enableEdit">
	                			<label class="frm-check">
		                			<input class="frm-form__check" type="checkbox" :name="'canView['+key+']'" v-model="field.hidden">
	                                <span class="frm-form__checkbox"></span>
	                            </label>
	                		</div>
	                		<div class="col-md-9 px-0">
	                			<input type="text" :name="'fieldName['+key+']'" v-model="field.fieldName" placeholder="Enter Field Label">
	                			<input type="hidden" :name="'isNew['+key+']'" v-model="field.new" v-if="field.new">
	                			<input type="hidden" :name="'oldFieldId['+key+']'" v-model="field.id" v-if="!field.new">
	                		</div>
	                		<div class="col-md-2 text-right px-0">
	                			<template v-if="key > 0">
	                				<button type="button" class="btn" v-if="!field.archiveUrl" @click="removeField(key)"><i class="fa fa-trash-alt"></i></button>
	                			</template>
	                			<action-button
	                			v-if="key > 0 && field.archiveUrl"
	                			color="fa fa-trash-alt"
	                			:action-url="field.archiveUrl"
	                			:show-alt="field.deleted_at"
	                			confirm-dialog
	                			title="Remove Item"
	                			:message="'Are you sure you want to remove Field ' + field.fieldName + '?'"
	                			:disabled="loading"
	                			@load="load"
	                			@success="fetch"
	                			></action-button>
	                		</div>
	                	</div>
	                </div>
                </template>
                <div class="frm-prfl__col col-9 add-field" v-if="enableEdit">
					<button type="button" class="btn btn-light mb-2" @click="addField">Add</button>
					<p>If the fields unchecked, users can view the details on the text field regardless of user classification</p>
                </div>
            </div>
		</card>
		<div class="col-12 px-0 align-r mt-4">
			<button type="button" class="btn frm-btn type-2 px-4" @click="editColumnNames" v-if="!enableEdit">Edit Column Names</button>
			<action-button type="submit" :disabled="loading" class="btn frm-btn type-1 px-4" v-if="enableEdit">Save Changes</action-button>
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
			if(this.item.length) {
				this.arrayOfInput = [];
				_.each(this.item, (item) => {
					var field = {
						fieldName: item.name,
						hidden: item.hidden,
						required: item.required,
						id: item.id,
						archiveUrl: item.archiveUrl
					}
					this.arrayOfInput.push(field);
				});	
			}
		},

		editColumnNames() {
			this.enableEdit = !this.enableEdit;
		},

		addField() {
			var field = {
				fieldName: null,
				hidden: false,
				required: false,
				new: true
			};

			this.arrayOfInput.push(field);
		},

		removeField(key) {
			this.arrayOfInput.splice(key, 1)
		}
	},

	data() {
		return {
			arrayOfInput: [],

			enableEdit: false
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
		},

		hasRemoveButton: {
			default: false,
			type: Boolean
		}
	},

	mixins: [ CrudMixin ],
}
</script>