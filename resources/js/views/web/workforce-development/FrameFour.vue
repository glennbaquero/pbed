<template>
	<div>
		<section class="page-frame aow-frm aow-frm4" v-for="(data, key) in frameFour">
			<div class="width--90 margin-a">
				<div class="aow-frm4__cntnr">
					<div class="aow-frm4__col">
						<div class="aow-frm4__img-holder">
							<div class="page-bg page-bg--cover" :id="'chartHolder-framefour'+key">
								<canvas :id="'myChart-framefour'+key" height="200" v-if="!data.is_image"></canvas>
								<img :src="data.full_image_path" v-if="data.is_image" width="100%" height="100%">
							</div>
						</div>
					</div>
					<div class="aow-frm4__col">
						<div class="l-margin-b list-style">
							<h3 class="font-1 type-2 fntwght--bold mb-3">{{ data.first_header }}</h3>
							<span v-html="data.first_content"></span>
						</div>
						<div class="list-style">
							<h3 class="font-1 type-2 fntwght--bold mb-3">{{ data.second_header }}</h3>
							<span v-html="data.second_content"></span>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
	export default {
		props: {
			frameFour: Array
		},

		mounted() {
			_.each(this.frameFour, (data, key) => {
				if(!data.is_image) {
					this.runChart(data.data, data.label, data.bgcolor, data.name, key, data.y_axis_label);
				}
			})
		},

		methods: {
			runChart(data, label, bgcolor, title, key, y_axis_label) {

				$('#myChart-framefour'+key).remove();
				$('#chartHolder-framefour'+key).append('<canvas id="myChart-framefour'+key+'"></canvas>')
				var ctx = document.getElementById("myChart-framefour"+key).getContext("2d");
				ctx.height = 100;

				var splitVerticalBar = data ? data.split('|') : [];
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

					_.each(labelStack, (stackLabel,key) => {
						var dataset = {
							label: stackLabel,
							backgroundColor: bgcolor ? bgcolor.split(',')[key] : 'red',
							data: stackData[key]
						}
						dataSets.push(dataset);
					});

					var splittedLabel = label ? label.split(',') : [];
					var myLineChart = new Chart(ctx, this.config(splittedLabel, dataSets, title, y_axis_label));
				}
			},

			config(labelList = [], dataSets = [], title, y_axis_label) {
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
				        	        labelString: y_axis_label ? y_axis_label : '' 
				        	    }
					      	}],
					    },
					    legend: {
				            display: true,
				        },
				        title: {
			                display: true,
			                text: title
			            }
					}
				};

				return config;
			},
		}
	}
</script>