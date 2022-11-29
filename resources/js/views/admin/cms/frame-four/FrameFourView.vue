<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<card>
			<div class="row pt-4">
				<div class="form-group col-sm-12">
					<div class="custom-control custom-switch">
					<input name="is_image" v-model="item.is_image" :checked="item.is_image" type="checkbox" class="custom-control-input" id="is_image">
						<label class="custom-control-label" for="is_image">Image Only?</label>
					</div>
				</div>
			</div>

			<div class="row pt-4">
				<div class="col-sm-6 col-md-6 row">
					<div class="form-group col-sm-12 col-md-12">
						<label>Title</label>
						<input v-model="item.name" name="name" type="text" class="form-control input-sm">
					</div>
					<div class="form-group col-sm-12 col-md-12" v-if="!item.is_image">
						<label>Y Axis Label</label>
						<input v-model="item.y_axis_label" name="y_axis_label" type="text" class="form-control input-sm">
					</div>
					<div class="form-group col-sm-12 col-md-12" v-if="!item.is_image">
						<label>X Axis Label For Graph <small>(Sample data format: College, Highschool)</small></label>
						<input v-model="item.label" name="label" type="text" class="form-control input-sm">
					</div>
					<div class="form-group col-sm-12 col-md-12" v-if="!item.is_image">
						<label>Y Axis Data For Graph <small>(Sample data format: 1st Year: 10, 20|2nd Year: 30, 40)</small></label>
						<input v-model="item.data" name="data" type="text" class="form-control input-sm">
					</div>
					<div class="form-group col-sm-12 col-md-12" v-if="!item.is_image">
						<label>Background Color for Y Axis Bar <small>(Sample data format: red,blue )</small></label>
						<input v-model="item.bgcolor" name="bgcolor" type="text" class="form-control input-sm">
					</div>
				</div>
				<div class="col-sm-6 col-md-6" v-if="!item.is_image">
					<div class="chartSection">
				        <canvas id="myChart" height="200"></canvas>
					</div>
				</div>
			</div>

			<div class="row pb-4"  v-if="item.is_image">
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
				<div class="form-group col-sm-12 col-md-12">
					<label>First Heading</label>
					<input v-model="item.first_header" name="first_header" type="text" class="form-control input-sm">
				</div>
				<text-editor
				v-model="item.first_content"
				class="form-group col-sm-12 col-md-12"
				label="Content"
				name="first_content"
				row="5"
				></text-editor>
				<div class="form-group col-sm-12 col-md-12 mt-3">
					<label>Second Heading <small>(Optional)</small></label>
					<input v-model="item.second_header" name="second_header" type="text" class="form-control input-sm">
				</div>
				<text-editor
				v-model="item.second_content"
				class="form-group col-sm-12 col-md-12"
				label="Content"
				name="second_content"
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
		this.runChart();
	},
	
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
		},

		runChart() {
			var ctx = document.getElementById("myChart").getContext("2d");
			ctx.height = 100;
			var myLineChart = new Chart(ctx, this.config([this.item.labels], []));
		},

		config(labelList = [], dataSets = [], y_axis_label = '') {
			var data = {
			  labels: labelList,
			  datasets: dataSets
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
			            display: true,
			        },
			        title: {
		                display: true,
		                text: this.item.name
		            }
				}
			};

			return config;
		},
	},


	watch: {
		'item.name'(val) {
			$('#myChart').remove();
			$('.chartSection').append('<canvas id="myChart"></canvas>')
			var ctx = document.getElementById("myChart").getContext("2d");
			var splitVerticalBar = this.item.data ? this.item.data.split('|') : [];
			var stackData = [];
			var dataStack = [];
			var labelStack = [];
			var dataSets = [];
			if(splitVerticalBar) {
				_.each(splitVerticalBar, (value, key) => {
				    dataStack = [];
				    
				    var splittedValue = value.split(':');
					_.each(splittedValue[1].split(','), (split) => {
				        dataStack.push(parseInt(split))
				    });

				    labelStack.push(splittedValue[0])

				    stackData[key] = dataStack;
				});

				_.each(labelStack, (label,key) => {
					var dataset = {
						label: label,
						backgroundColor: this.item.bgcolor ? this.item.bgcolor.split(',')[key] : 'red',
						data: stackData[key]
					}
					dataSets.push(dataset);
				});

				var splittedLabel = this.item.label ? this.item.label.split(',') : [];
				var myLineChart = new Chart(ctx, this.config(splittedLabel, dataSets, this.item.y_axis_label));
			}
			
		},

		'item.label'(val) {
			$('#myChart').remove();
			$('.chartSection').append('<canvas id="myChart"></canvas>')
			var ctx = document.getElementById("myChart").getContext("2d");
			ctx.height = 100;
			var splittedLabel = val.split(',');
			var splitVerticalBar = this.item.data ? this.item.data.split('|') : [];
			var stackData = [];
			var dataStack = [];
			var labelStack = [];
			var dataSets = [];
			if(splitVerticalBar) {
				_.each(splitVerticalBar, (value, key) => {
				    dataStack = [];
				    
				    var splittedValue = value.split(':');
					_.each(splittedValue[1].split(','), (split) => {
				        dataStack.push(parseInt(split))
				    });

				    labelStack.push(splittedValue[0])

				    stackData[key] = dataStack;
				});

				_.each(labelStack, (label,key) => {
					var dataset = {
						label: label,
						backgroundColor: this.item.bgcolor.split(',')[key],
						data: stackData[key]
					}
					dataSets.push(dataset);
				});

				var myLineChart = new Chart(ctx, this.config(splittedLabel, dataSets, this.item.y_axis_label));
			}
			
		},

		'item.y_axis_label'(val) {
			$('#myChart').remove();
			$('.chartSection').append('<canvas id="myChart"></canvas>')
			var ctx = document.getElementById("myChart").getContext("2d");
			ctx.height = 100;
			var splittedLabel = this.item.label ? this.item.label.split(',') : [];
			var splitVerticalBar = this.item.data ? this.item.data.split('|') : [];
			var stackData = [];
			var dataStack = [];
			var labelStack = [];
			var dataSets = [];
			if(splitVerticalBar) {
				_.each(splitVerticalBar, (value, key) => {
				    dataStack = [];
				    
				    var splittedValue = value.split(':');
					_.each(splittedValue[1].split(','), (split) => {
				        dataStack.push(parseInt(split))
				    });

				    labelStack.push(splittedValue[0])

				    stackData[key] = dataStack;
				});

				_.each(labelStack, (label,key) => {
					var dataset = {
						label: label,
						backgroundColor: this.item.bgcolor.split(',')[key],
						data: stackData[key]
					}
					dataSets.push(dataset);
				});

				var myLineChart = new Chart(ctx, this.config(splittedLabel, dataSets, val));
			}
		},

		'item.data'(val) {
			$('#myChart').remove();
			$('.chartSection').append('<canvas id="myChart"></canvas>')
			var ctx = document.getElementById("myChart").getContext("2d");
			ctx.height = 100;

			var splitVerticalBar = val ? val.split('|') : [];
			var stackData = [];
			var dataStack = [];
			var labelStack = [];
			var dataSets = [];
			if(splitVerticalBar) {
				_.each(splitVerticalBar, (value, key) => {
				    dataStack = [];
				    
				    var splittedValue = value.split(':');
					_.each(splittedValue[1].split(','), (split) => {
				        dataStack.push(parseInt(split))
				    });

				    labelStack.push(splittedValue[0])

				    stackData[key] = dataStack;
				});

				_.each(labelStack, (label,key) => {
					var dataset = {
						label: label,
						backgroundColor: this.item.bgcolor ? this.item.bgcolor.split(',')[key] : 'red',
						data: stackData[key]
					}
					dataSets.push(dataset);
				});

				var splittedLabel = this.item.label.split(',');
				var myLineChart = new Chart(ctx, this.config(splittedLabel, dataSets, this.item.y_axis_label));
			}
		},

		'item.bgcolor'(val) {
			$('#myChart').remove();
			$('.chartSection').append('<canvas id="myChart"></canvas>')
			var ctx = document.getElementById("myChart").getContext("2d");
			ctx.height = 100;

			var splitVerticalBar = this.item.data ? this.item.data.split('|') : [];
			var stackData = [];
			var dataStack = [];
			var labelStack = [];
			var dataSets = [];

			if(splitVerticalBar) {
				_.each(splitVerticalBar, (value, key) => {
				    dataStack = [];
				    
				    var splittedValue = value.split(':');
					_.each(splittedValue[1].split(','), (split) => {
				        dataStack.push(parseInt(split))
				    });

				    labelStack.push(splittedValue[0])

				    stackData[key] = dataStack;
				});

				_.each(labelStack, (label,key) => {
					var dataset = {
						label: label,
						backgroundColor: val.split(',')[key],
						data: stackData[key]
					}
					dataSets.push(dataset);
				});

				var splittedLabel = this.item.label.split(',');
				var myLineChart = new Chart(ctx, this.config(splittedLabel, dataSets, this.item.y_axis_label));
			}
		}
	},

	data() {
		return {
			item: {
				name: '',
				label: null,
				data: null,
				bgcolor: null, 
				y_axis_label: ''
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