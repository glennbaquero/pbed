<template>
	<div>
		<div class="aow-frm2__content inlineBlock-parent">
			<div class="aow-frm2__col" v-for="(challenge, key) in challenges">
				<div class="aow-frm2__img-holder">
					<div class="page-bg page-bg--cover" :id="'chartHolder'+key" v-if="!challenge.is_image">
						<canvas :id="'myChart'+key" height="200"></canvas>
						<!-- <img :src="challenge.full_image_path" v-if="challenge.is_image" width="100%" height="100%"> -->
					</div>
					<div v-if="challenge.is_image" class="page-bg page-bg--contain" :style="{ backgroundImage: `url(${ challenge.full_image_path })` }"></div>
				</div>
				<div class="aow-frm2__desc list-style" v-html="challenge.description"></div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props: {
			challenges: Array
		},

		mounted() {
			_.each(this.challenges, (challenge, key) => {
				if(!challenge.is_image) {
					this.runChart(challenge.data, challenge.label, challenge.bgcolor, challenge.title, key, challenge.y_axis_label);
				}
			})
		},

		methods: {
			runChart(data, label, bgcolor, title, key, y_axis_label) {

				$('#myChart'+key).remove();
				$('#chartHolder'+key).append('<canvas id="myChart'+key+'"></canvas>')
				var ctx = document.getElementById("myChart"+key).getContext("2d");
				ctx.height = 100;

				var splittedValue = data.split(',');
				if(splittedValue.length) {
					var dataSet = [];

					_.each(splittedValue, (value) => {
						dataSet.push(parseInt(value));
					})

					var splittedLabel = label.split(',');
					var splittedbgcolor = bgcolor.split(',');
					var myLineChart = new Chart(ctx, this.config(splittedLabel, dataSet, splittedbgcolor, title, y_axis_label));
				}
			},

			config(labelList = [], data = [], bgcolor = [], title = '', y_axis_label) {
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
				        	        labelString: y_axis_label ? y_axis_label : '' 
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
	}
</script>