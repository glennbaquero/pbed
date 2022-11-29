<template>
	<div>

		<loader
		:loading="loading"
		></loader>

		<div class="card">
			<div class="card-body">
				<div class="row">
					<text-box
					v-model="challenge.name"
					name="name"
					label="Name"
					></text-box>
				</div>

				<div class="row">
					<text-box
					v-model="challenge.description"
					name="description"
					label="Description"
					></text-box>
				</div>

				<div class="row">
					<div class="form-group col-md-12 text-right">
						<button 
						type="button" 
						@click="addItem"
						class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Add Challenge Items</button>
					</div>
				</div>

				<template v-for="(challengeItem, index) in items">
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
								v-model="challengeItem.name"
								name="name"
								label="Name"
								></text-box>
							</div>

							<div class="row">
								<text-box
								v-model="challengeItem.description"
								name="description"
								label="Description"
								></text-box>
							</div>

							<div class="row">
								<div class="form-group col-md-12 text-right">
									<button 
									type="button" 
									@click="addGraphItem(index)"
									class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Infograph Item</button>
								</div>
							</div>

							<template v-for="(graph, graphIndex) in challengeItem.graphs">
								<div class="card">
									<div class="card-header p-2">				
										<div class="row">
											<div class="col-md-6 text-left">
									            <h5 class="font-weight-bold m-0">GraphItem #{{ graphIndex + 1 }}</h5>
								            </div>
								            <div class="col-md-6 text-right">
									            <button 
									            @click="removeGraphItem(index, graphIndex)"
									            class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
								            </div>
							            </div>
									</div>
									<div class="card-body">
										<div class="row">
											<text-box
											v-model="graph.label"
											name="label"
											label="Label"
											></text-box>
										</div>

										<div class="row">
											<text-box
											v-model="graph.value"
											name="value"
											label="Value"
											type="number"
											></text-box>
										</div>
									</div>
								</div>
							</template>
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
			challenge: {
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
			this.items.push({'name': null, 'description': null, 'graphs': [] })
		},

		removeItem(index) {
			this.items.splice(index, 1);
		},

		addGraphItem(index) {
			this.items[index].graphs.push({'label': null, 'value': 0});
		},

		removeGraphItem(index, graphIndex) {
			this.items[index].graphs.splice(graphIndex, 1);
		},


		getPostData() {
			let post = this.challenge;
			post.items = this.items

			return post;
		},

		/**
		 * Submit post request
		 * 
		 */
		submit() {

			this.loading = true;

			axios.post(this.url, this.getPostData())
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
			this.challenge = {
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
			bus.$on('fetchChallenge', (data) => {
				this.challenge = data.item;
				this.items = data.graph_items;
				this.url = this.challenge.updateUrl;
			});


			bus.$on('cancelEdit', (data) => {
				this.resetFields();
			});

		},	


	},
}
</script>