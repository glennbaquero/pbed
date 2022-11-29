<template>
	<div>
		<form-request :submit-url="updateSampleFormatTable" @load="load" submit-on-success method="POST" :action="updateSampleFormatTable">
			<card>
		        <template v-slot:header>
		        	<div class="row mt-2">
		        		<div class="col-sm-2 text-center">
		        			<label>Batch Upload To</label>
		        		</div>
		        		<selector class="col-sm-2"
		        		v-model="item.category_id"
		        		name="category" 
		        		label=""
		        		:items="categories"
		        		item-value="id"
		        		item-text="name"
		        		:showLabel="false"
		        		placeholder="Select contact category"
		        		></selector>
		        		<div class="col-sm-8">
							<action-button type="submit" v-if="item.category_id" :disabled="loading" class="btn-primary btn-sm">Download Format <small>(Don't change the {{ selectedCategory.name }} category when you upload this format.)</small></action-button>
		        		</div>
		        	</div>  
		    	</template>
		    </card>
		</form-request>

		<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
				<card>
				<div class="row">

					<selector class="col-sm-2"
					v-show="false"
					v-model="item.category_id"
					name="category" 
					label=""
					:items="categories"
					item-value="id"
					item-text="name"
					:showLabel="false"
					placeholder="Select contact category"
					></selector>

					<!-- <div class="form-group col-md-12">
						<a :href="sampleFormatUrl">Download Sample Format</a>
					</div> -->
					<div class="form-group col-md-12">
						<input type="file" name="manifest" accept=".xls, .xlsx" class="form-class">
					</div>
				</div>

				<template v-slot:footer>
					<action-button type="submit" :disabled="loading" class="btn-primary">Save Changes</action-button>
				</template>
			</card>
			
			<loader :loading="loading"></loader>

		</form-request>
	</div>
</template>

<script type="text/javascript">
import CrudMixin from 'Mixins/crud.js';
import ActionButton from 'Components/buttons/ActionButton.vue';
import Textbox from 'Components/inputs/Textbox.vue';
import ImagePicker from 'Components/inputs/ImagePicker.vue';
import TextEditor from 'Components/inputs/TextEditor.vue';
import Select from 'Components/inputs/Select.vue';

export default {
	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'image-picker': ImagePicker,
		'text-editor': TextEditor,
		'selector': Select,
	},

	data() {
		return {
			selectedCategory: {}
		}
	},

	watch: {
		'item.category_id'(val) {
			_.each(this.categories, (category) => {
				if(category.id == val) {
					this.selectedCategory = category
				}
			})
		}
	},

	props: {
		categories: Array,
		sampleFormatUrl: String,
		updateSampleFormatTable: String
	},

	mixins: [ CrudMixin ],
}
</script>