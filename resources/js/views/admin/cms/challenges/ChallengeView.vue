<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row pt-4">
				<div class="form-group col-sm-12">
					<div class="custom-control custom-switch">
					<input name="for_teaching_learning" v-model="item.for_teaching_learning" :checked="item.for_teaching_learning" type="checkbox" class="custom-control-input" id="for_teaching_learning">
						<label class="custom-control-label" for="for_teaching_learning">For Teaching and Learning Page?</label>
					</div>
				</div>
			</div>
			<div class="row pt-4">
				<div class="form-group col-sm-12">
					<div class="custom-control custom-switch">
					<input name="is_image" v-model="item.is_image" :checked="item.is_image" type="checkbox" class="custom-control-input" id="is_image">
						<label class="custom-control-label" for="is_image">Image Only?</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-12 col-md-12" v-if="item.for_teaching_learning">
					<label>Header</label>
					<input v-model="item.label_teaching_learning" name="label_teaching_learning" type="text" class="form-control input-sm">
				</div>
				<div class="col-sm-6 col-md-6 row">
					<div class="form-group col-sm-12 col-md-12">
						<label>Title</label>
						<input v-model="item.title" name="title" type="text" class="form-control input-sm">
					</div>

					<div class="form-group col-sm-12 col-md-12"  v-if="!item.is_image">
						<label>Y Axis Label</label>
						<input v-model="item.y_axis_label" name="y_axis_label" type="text" class="form-control input-sm">
					</div>
					<div class="form-group col-sm-12 col-md-12"  v-if="!item.is_image">
						<label>Label For Graph <small>(Add comma (,) to add new label)</small></label>
						<input v-model="item.label" name="label" type="text" class="form-control input-sm">
					</div>
					<div class="form-group col-sm-12 col-md-12"  v-if="!item.is_image">
						<label>Data For Graph <small>(Add comma (,) to add new data)</small></label>
						<input v-model="item.data" name="data" type="text" class="form-control input-sm">
					</div>
					<div class="form-group col-sm-12 col-md-12"  v-if="!item.is_image">
						<label>Background Color for each Data <small>(Add comma (,) to add new background color)</small></label>
						<input v-model="item.bgcolor" name="bgcolor" type="text" class="form-control input-sm">
					</div>
				</div>
				<div class="col-sm-6 col-md-6" v-show="!item.is_image">
					<div class="chartSection">
				        <canvas id="myChart" height="200"></canvas>
					</div>
				</div>
				<template v-if="!item.is_image">
					<div class="col-sm-6 col-md-6 row" v-show="item.for_teaching_learning">
						<div class="form-group col-sm-12 col-md-12">
							<h3><label>SECOND GRAPH INFO <small>(Optional)</small></label></h3>
						</div>
						<div class="form-group col-sm-12 col-md-12">
							<label>Title</label>
							<input v-model="item.title_two" name="title_two" type="text" class="form-control input-sm">
						</div>
						<div class="form-group col-sm-12 col-md-12">
							<label>Y Axis Label</label>
							<input v-model="item.y_axis_label_two" name="y_axis_label_two" type="text" class="form-control input-sm">
						</div>
						<div class="form-group col-sm-12 col-md-12">
							<label>Label For Graph <small>(Add comma (,) to add new label)</small></label>
							<input v-model="item.label_two" name="label_two" type="text" class="form-control input-sm">
						</div>
						<div class="form-group col-sm-12 col-md-12">
							<label>Data For Graph <small>(Add comma (,) to add new data)</small></label>
							<input v-model="item.data_two" name="data_two" type="text" class="form-control input-sm">
						</div>
						<div class="form-group col-sm-12 col-md-12">
							<label>Background Color for each Data <small>(Add comma (,) to add new background color)</small></label>
							<input v-model="item.bgcolor_two" name="bgcolor_two" type="text" class="form-control input-sm">
						</div>
					</div>
					<div class="col-sm-6 col-md-6" v-show="item.for_teaching_learning">
						<div class="chartSection-two">
					        <canvas id="myChart-two" height="200"></canvas>
						</div>
					</div>
				</template>
			</div>
			<div class="row"  v-if="item.is_image">
				<image-picker
				:value="item.image_path"
				class="form-group col-sm-12 col-md-12 mt-2"
                label="Image (Recommended : 1024x768)  [.jpg, .jpeg, .png]"
                name="image_path"
                placeholder="Choose a Image"
                format="image/*"
				></image-picker>
			</div>
			<div class="row pb-4">
				<text-editor
				v-model="item.description"
				class="form-group col-sm-12 col-md-12"
				label="Content"
				name="description"
				row="5"
				></text-editor>
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

export default {
	mounted() {
		if(!this.item.is_image) {
			this.runChart();
		}
	},
	
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
		},

		runChart() {
			var ctx = document.getElementById("myChart").getContext("2d");
			ctx.height = 100;
			var myLineChart = new Chart(ctx, this.config([this.item.labels], []));

			if(this.item.for_teaching_learning) {
				var ctx = document.getElementById("myChart-two").getContext("2d");
				ctx.height = 100;
				var myLineChart = new Chart(ctx, this.config([this.item.labels], []));
			}
		},

		config(labelList = [], data = [], bgcolor = [], title='', y_axis_label='') {
			var data = {
			  labels: labelList,
			  datasets: [
			  		{
			            label: '',
			            data: data,
			            backgroundColor: bgcolor,
			            borderColor: '#ddd',
			            borderWidth: 1
			        }
			  	]
			};

			var config = {
			  	type: 'bar',
			  	data: data,
			  	options: {
				    scales: {
				      	yAxes: [{
				        	ticks: {
				          		beginAtZero:true,
				        	},
				        	scaleLabel: {
			        	        display: true,
			        	        labelString: y_axis_label
			        	    }
				      	}],
				    },
				    legend: {
			            display: false,
			        },
			        title: {
		                display: true,
		                text: title
		            }
				}
			};

			return config;
		},
	},


	watch: {

		'item.title'(val) {
			if(!this.item.is_image) {
				$('#myChart').remove();
				$('.chartSection').append('<canvas id="myChart"></canvas>')
				var ctx = document.getElementById("myChart").getContext("2d");
				if(this.item.data) {
					var splittedData = this.item.data.split(',');
					var data = [];

					_.each(splittedData, (value) => {
						data.push(parseInt(value));
					})

					var splittedbgcolor = this.item.bgcolor ? this.item.bgcolor.split(',') : [];
					var splittedLabel = this.item.label ? this.item.label.split(',') : [];
					var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title, this.item.y_axis_label));
				} else {
					var myLineChart = new Chart(ctx, this.config([], [], [], this.item.title, this.item.y_axis_label));
				}
			}
		},

		'item.y_axis_label'(val) {

			if(!this.item.is_image) {
				$('#myChart').remove();
				$('.chartSection').append('<canvas id="myChart"></canvas>')
				var ctx = document.getElementById("myChart").getContext("2d");
				ctx.height = 100;
				if(this.item.data) {
					var splittedData = this.item.data.split(',');
					var data = [];

					_.each(splittedData, (value) => {
						data.push(parseInt(value));
					})

					var splittedbgcolor = this.item.bgcolor ? this.item.bgcolor.split(',') : [];
					var splittedLabel = this.item.label ? this.item.label.split(',') : [];
					var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title, val));
				} else {
					var myLineChart = new Chart(ctx, this.config([], [], [], this.item.title, val));
				}
			}
		},

		'item.label'(val) {
			if(!this.item.is_image) {
				$('#myChart').remove();
				$('.chartSection').append('<canvas id="myChart"></canvas>')
				var ctx = document.getElementById("myChart").getContext("2d");
				ctx.height = 100;
				var splittedLabel = val.split(',');
				if(splittedLabel.length) {
					if(this.item.data) {
						var splittedData = this.item.data.split(',');
						var data = [];

						_.each(splittedData, (value) => {
							data.push(parseInt(value));
						})

						var splittedbgcolor = this.item.bgcolor ? this.item.bgcolor.split(',') : [];
						var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title, this.item.y_axis_label));
					} else {
						var myLineChart = new Chart(ctx, this.config(splittedLabel, [], [], this.item.title, this.item.y_axis_label));
					}
				}
			}
		},

		'item.data'(val) {

			if(!this.item.is_image) {
				$('#myChart').remove();
				$('.chartSection').append('<canvas id="myChart"></canvas>')
				var ctx = document.getElementById("myChart").getContext("2d");
				ctx.height = 100;

				var splittedValue = val.split(',');
				if(splittedValue.length) {
					var data = [];
					var datasets = [];
					_.each(splittedValue, (value) => {
						data.push(parseInt(value));
						var color = '#'+(Math.random()*0xFFFFFF<<0).toString(16);
					})
					var splittedLabel = this.item.label.split(',');
					var splittedbgcolor = this.item.bgcolor ? this.item.bgcolor.split(',') : [];
					var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title, this.item.y_axis_label));
				}
			}
		},

		'item.bgcolor'(val) {

			if(!this.item.is_image) {
				$('#myChart').remove();
				$('.chartSection').append('<canvas id="myChart"></canvas>')
				var ctx = document.getElementById("myChart").getContext("2d");
				ctx.height = 100;

				var splittedValue = this.item.data.split(',');
				if(splittedValue.length) {
					var data = [];

					_.each(splittedValue, (value) => {
						data.push(parseInt(value));
					})

					var splittedLabel = this.item.label.split(',');
					var splittedbgcolor = this.item.bgcolor.split(',');
					var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title, this.item.y_axis_label));
				}
			}
		},

		'item.title_two'(val) {
			$('#myChart-two').remove();
			$('.chartSection-two').append('<canvas id="myChart-two"></canvas>')
			var ctx = document.getElementById("myChart-two").getContext("2d");
			if(this.item.data_two) {
				var splittedData = this.item.data_two.split(',');
				var data = [];

				_.each(splittedData, (value) => {
					data.push(parseInt(value));
				})

				var splittedbgcolor = this.item.bgcolor_two ? this.item.bgcolor_two.split(',') : [];
				var splittedLabel = this.item.label_two ? this.item.label_two.split(',') : [];
				var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title_two, this.item.y_axis_label_two));
			} else {
				var myLineChart = new Chart(ctx, this.config([], [], [], this.item.title_two, this.item.y_axis_label_two));
			}
			
		},


		'item.y_axis_label_two'(val) {
			$('#myChart-two').remove();
			$('.chartSection-two').append('<canvas id="myChart-two"></canvas>')
			var ctx = document.getElementById("myChart-two").getContext("2d");
			ctx.height = 100;
			if(this.item.data_two) {
				var splittedData = this.item.data_two.split(',');
				var data = [];

				_.each(splittedData, (value) => {
					data.push(parseInt(value));
				})

				var splittedbgcolor = this.item.bgcolor_two ? this.item.bgcolor_two.split(',') : [];
				var splittedLabel = this.item.label_two ? this.item.label_two.split(',') : [];
				var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title_two, val));
			} else {
				var myLineChart = new Chart(ctx, this.config([], [], [], this.item.title_two, val));
			}
		},

		'item.label_two'(val) {
			$('#myChart-two').remove();
			$('.chartSection-two').append('<canvas id="myChart-two"></canvas>')
			var ctx = document.getElementById("myChart-two").getContext("2d");
			ctx.height = 100;
			var splittedLabel = val.split(',');
			if(splittedLabel.length) {
				if(this.item.data_two) {
					var splittedData = this.item.data_two.split(',');
					var data = [];

					_.each(splittedData, (value) => {
						data.push(parseInt(value));
					})

					var splittedbgcolor = this.item.bgcolor_two ? this.item.bgcolor_two.split(',') : [];
					var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title_two, this.item.y_axis_label_two));
				} else {
					var myLineChart = new Chart(ctx, this.config(splittedLabel, [], [], this.item.title_two, this.item.y_axis_label_two));
				}
			}


		},

		'item.data_two'(val) {
			$('#myChart-two').remove();
			$('.chartSection-two').append('<canvas id="myChart-two"></canvas>')
			var ctx = document.getElementById("myChart-two").getContext("2d");
			ctx.height = 100;

			var splittedValue = val.split(',');
			if(splittedValue.length) {
				var data = [];
				var datasets = [];
				_.each(splittedValue, (value) => {
					data.push(parseInt(value));
					var color = '#'+(Math.random()*0xFFFFFF<<0).toString(16);
				})
				var splittedLabel = this.item.label_two.split(',');
				var splittedbgcolor = this.item.bgcolor_two ? this.item.bgcolor_two.split(',') : [];
				var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title_two, this.item.y_axis_label_two));
			}
		},

		'item.bgcolor_two'(val) {
			$('#myChart-two').remove();
			$('.chartSection-two').append('<canvas id="myChart-two"></canvas>')
			var ctx = document.getElementById("myChart-two").getContext("2d");
			ctx.height = 100;

			var splittedValue = this.item.data_two.split(',');
			if(splittedValue.length) {
				var data = [];

				_.each(splittedValue, (value) => {
					data.push(parseInt(value));
				})

				var splittedLabel = this.item.label_two.split(',');
				var splittedbgcolor = this.item.bgcolor_two.split(',');
				var myLineChart = new Chart(ctx, this.config(splittedLabel, data, splittedbgcolor, this.item.title_two, this.item.y_axis_label_two));
			}
		}
	},

	data() {
		return {
			item: {
				title: '',
				label: null,
				data: null,
				bgcolor: null,
				y_axis_label: null,

				title_two: '',
				label_two: null,
				data_two: null,
				bgcolor_two: null,
				y_axis_label: null,

				for_teaching_learning: false
			}
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
	},

	mixins: [ CrudMixin ],
}
</script>