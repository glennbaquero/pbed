<template>
	<div>

		<loader
		:loading="loading"
		></loader>

		<div class="card">
			<div class="card-body">
				<div class="row">
					<text-box
					v-model="solution.name"
					name="name"
					label="Name"
					></text-box>
				</div>

				<div class="row">
					<text-box
					v-model="solution.description"
					name="description"
					label="Description"
					></text-box>
				</div>

				<div class="row">
					<div class="form-group col-md-12 text-right">
						<button 
						type="button" 
						@click="addItem"
						class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Add Solution Items</button>
					</div>
				</div>

				<template v-for="(solutionItem, index) in items">
					<div class="card">
						<div class="card-header p-2">
							<div class="row">
								<div class="col-md-6 text-left">
						            <h5 class="font-weight-bold m-0">Item #{{ index + 1 }}</h5>
					            </div>
					            <div class="col-md-6 text-right">
						            <button 
						            @click="removeItem(index)"
						            class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
					            </div>
				            </div>
						</div>
						<div class="card-body">			
							<div class="row">
								<text-box
								v-model="solutionItem.name"
								name="name"
								label="Name"
								></text-box>
							</div>

							<div class="row">
								<text-box
								v-model="solutionItem.description"
								name="description"
								label="Description"
								></text-box>
							</div>

							<div class="row">
								<div class="form-group col-sm-12">
									<label>Icon  [.jpg, .jpeg, .png]</label>
									<input 
									type="file" 
									:name="'icon' + index" 
									:ref="'icon' + index"
									:data-index="index"
									@change="change"
									accept=".png,.jpeg,.jpg,.bmp" 
									class="form-control">

									<div class="d-inline-block align-top mt-2">
						                <img v-if="solutionItem.preview || solutionItem.icon" :src="solutionItem.preview ? solutionItem.preview : solutionItem.icon" class="img-thumbnail" width="120px" height="auto" />
					            		
					            	</div>

								</div>								
							</div>							

						</div>
					</div>
				</template>
			</div>
		</div>
		<div class="col-12 px-0 align-r mt-4">
			<div class="text-right">
				<button
				@click="submit()"
				:disabled="loading"
				class="btn frm-btn type-1 px-4 ml-2">Save Changes</button>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">

import ActionButton from 'Components/buttons/ActionButton.vue';
import Textbox from 'Components/inputs/Textbox.vue';
import Loader from 'Components/loaders/Loader.vue';

import ResponseMixins from 'Mixins/response.js';
import {bus} from 'EventBus/bus.js';

export default {

    props: {
        submitUrl: {
            type: String,
            default: null
        },
    },

	components: {
		'action-button': ActionButton,
		'text-box': Textbox,
		'loader': Loader 
	},

	data() {
		return {
			solution: {
				name: null,
				description: null
			},
			items: [],

			url: null,
			loading: false,
		}
	},

	mounted() {
		this.eventHandler();
		this.init();
	},
	
	mixins: [ ResponseMixins ],

	methods: {

		/*
		|--------------------------------------------------------------------------
		| @Initialize
		|--------------------------------------------------------------------------
		*/
		init() {
			this.url = this.submitUrl;
		},


		/*
		|--------------------------------------------------------------------------
		| @Methods
		|--------------------------------------------------------------------------
		*/

		addItem() {
			this.items.push({'name': null, 'description': null, 'preview': null, 'icon': null })
		},

		removeItem(index) {
			this.items.splice(index, 1);
		},

		getPostData() {
			let post = new FormData();
			
			post.append('id', this.solution.id ? this.solution.id: '');
			post.append('name', this.solution.name);
			post.append('description', this.solution.name);

			for (var i = 0; i < this.items.length; i++) {
				post.append('items[]', JSON.stringify(this.items[i]));
			}

			return post;
		},

		change(event) {
			let files = event.target.files,
				index = event.target.dataset.index;

			var reader = new FileReader(),
				$this = this;
			reader.onloadend = function() {
				$this.items[index].icon = reader.result;
				$this.items[index].preview = URL.createObjectURL(files[0]);
			}
			reader.readAsDataURL(files[0]);
		},

		/**
		 * Submit post request
		 * 
		 */
		submit() {

			this.loading = true;

            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                }
            }

			axios.post(this.url, this.getPostData(), config)
				.then((response) => {

					this.loading = false;

					if(response.status === 200) {
						this.parseSuccess(response.data.message);
						this.resetFields();
						this.$emit('refresh');
					}
				}).catch((err) => {
					this.loading = false;					
					this.parseError(err);
				});

		},

		/**
		 * Reset fields
		 * 
		 */
		resetFields() {
			this.solution = {
				name: null,
				description: null
			};
			this.items = [];
			this.url = this.submitUrl;
		},

		/**
		 * Event handler
		 * 
		 */
		eventHandler() {
			bus.$on('fetchSolution', (data) => {
				this.solution = data.item;
				this.items = data.solution_items;
				this.url = this.solution.updateUrl;
			});

			bus.$on('cancelEdit', (data) => {
				this.resetFields();
			});
			
		},	


	},
}
</script>