<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="frm-prfl__row frm-fields">
                <div class="frm-prfl__col col-3">
                    <p>Form Name</p>
                </div>
                <div class="frm-prfl__col col-9">
					<text-box
					:showLabel="false"
					v-model="item.name"
					name="name"
					></text-box>
                </div>
            	<div class="frm-prfl__col col-3">
                    <p>Form Fields</p>
                </div>
                <template v-for="field, key in arrayOfInput">
	                <div class="frm-prfl__col col-9">
	                	<div class="row px-0">
	                		<div class="col-md-1 text-center px-0 line-height-35">
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
	                			<template v-if="key > 0 && !hasRemoveButton">
	                				<button type="button" class="btn" v-if="!field.removeUrl" @click="removeField(key)"><i class="fa fa-trash-alt"></i></button>
	                			</template>
	                			<action-button
	                			v-if="field.removeUrl"
	                			color="fa fa-trash-alt"
	                			:action-url="field.removeUrl"
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
                <div class="frm-prfl__col col-9 add-field">
					<button type="button" class="btn btn-light mb-2" @click="addField">Add</button>
					<p>If the fields unchecked, users can view the details on the text field regardless of user classification</p>
                </div>
            </div>

			<!-- <div class="row">
				<div class="form-group col-md-2 text-center">
					<label>Form Fields</label>
				</div>
				<div class="form-group col-md-10">
					<div class="row" v-for="field, key in arrayOfInput">
						<div class="form-group col-md-1 text-center">
							<input type="checkbox" :name="'canView['+key+']'" v-model="field.hidden">
						</div>
						<div class="form-group col-md-9">
							<input type="text" :name="'fieldName['+key+']'" v-model="field.fieldName" class="form-control" placeholder="Enter Field Label">
						</div>
						<div class="form-group col-md-2 text-right">
							<template v-if="key > 0 && !hasRemoveButton">
								<button type="button" class="btn btn-flat btn-danger" v-if="!field.removeUrl" @click="removeField(key)">Remove</button>
							</template>
							<action-button
							v-if="field.removeUrl"
							color="btn-danger"
							:action-url="field.removeUrl"
							label="Remove"
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
			</div> -->
			<!-- <div class="row">
				<div class="form-group col-sm-3 text-right">
					<button type="button" class="btn btn-flat btn-primary" @click="addField">Add</button>
				</div>
				<div class="form-group col-sm-9 text-right">
				</div>
				<div class="form-group col-sm-2">
				</div>
				<div class="form-group col-sm-10">
					
				</div>
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
            :message="'Are you sure you want to archive Contact Category #' + item.id + '?'"
            :alt-message="'Are you sure you want to restore Contact Category #' + item.id + '?'"
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
	props: {
		hasRemoveButton: {
			default: false,
			type: Boolean
		}
	},

	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.arrayOfInput = data.item ? data.item.arrayOfInput : this.arrayOfInput;	
		},

		removeField(key) {
			this.arrayOfInput = this.arrayOfInput.filter((x, i) => i !== key);
			// this.arrayOfInput.splice(key, 1);
		},

		addField() {
			var field = {
				fieldName: null,
				hidden: false,
				new: true
			};

			this.arrayOfInput.push(field);
		}
	},

	data() {
		return {
			arrayOfInput: [
				{
					fieldName: null,
					hidden: false,
				}
			],
		}
	},

	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'image-picker': ImagePicker,
		'text-editor': TextEditor,
		'selector': Select,
	},

	mixins: [ CrudMixin ],
}
</script>