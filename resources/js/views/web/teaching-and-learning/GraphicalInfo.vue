<template>
	<div>
		<div class="width--90 margin-a">
			<div class="aow-frm2__cntnr" v-for="(challenge, key) in challenges" v-if="(key+1)%2">
				<div class="aow-frm2__col">
					<div class="page-section__titleCon">
						<div class="s-margin-b">
							<small class="fntwght--bold uppercase">the challenge</small>
						</div>
						<h3 class="font-1 type-2 fntwght--bold">{{ challenge.label_teaching_learning}}</h3>
					</div>
					<div class="aow-frm2__content list-style color-red" v-html="challenge.description">
						
					</div>		
				</div>
				<div class="aow-frm2__col">
					<template v-if="!challenge.is_image">
						<div class="aow-frm2__img-holder">
							<div class="page-bg page-bg--contain" :id="'chartHolder-PhaseOne-'+challenge.id">
								<canvas :id="'myChart-PhaseOne-'+challenge.id" height="200"></canvas>
							</div>
						</div>
						<div class="aow-frm2__img-holder">
							<div class="page-bg page-bg--contain" :id="'chartHolder-PhaseTwo-'+challenge.id">
								<canvas :id="'myChart-PhaseTwo-'+challenge.id" height="200"></canvas>
							</div>
						</div>
					</template>
					<div class="aow-frm2__img-holder" v-if="challenge.is_image">
						<div class="page-bg page-bg--contain" :style="{ backgroundImage: `url(${ challenge.full_image_path })` }"></div>
					</div>
				</div>
				<!-- <div class="aow-frm2__img-holder" v-if="challenge.is_image">
					<div class="page-bg page-bg--contain">
						<img :src="challenge.full_image_path" width="100%" height="100%">
					</div>
				</div> -->
			</div>
			<div class="aow-frm2__cntnr" v-for="(challenge, key) in challenges" v-if="!((key+1)%2)">
				<div class="aow-frm2__col">
					<template v-if="!challenge.is_image">
						<div class="aow-frm2__img-holder">
							<div class="page-bg page-bg--contain"  :id="'chartHolder-PhaseOne-'+challenge.id">
								<canvas :id="'myChart-PhaseOne-'+challenge.id" height="200"></canvas>
							</div>
						</div>
						<div class="aow-frm2__img-holder">
							<div class="page-bg page-bg--contain" :id="'chartHolder-PhaseTwo-'+challenge.id">
								<canvas :id="'myChart-PhaseTwo-'+challenge.id" height="200"></canvas>
							</div>
						</div>
					</template>
					<div class="aow-frm2__img-holder" v-if="challenge.is_image">
						<div class="page-bg page-bg--contain" :style="{ backgroundImage: `url(${ challenge.full_image_path })` }"></div>
					</div>
					<!-- <div class="aow-frm2__img-holder" v-if="challenge.is_image">
						<div class="page-bg page-bg--contain">
							<img :src="challenge.full_image_path" width="100%" height="100%">
						</div>
					</div> -->
					
				</div>
				<div class="aow-frm2__col">
					<div class="page-section__titleCon">
						<h3 class="font-1 type-2 fntwght--bold">{{ challenge.label_teaching_learning }}</h3>
					</div>
					<div class="aow-frm2__content  list-style color-red" v-html="challenge.description">
					</div>		
				</div>
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
					this.runChart(challenge.data, challenge.label, challenge.bgcolor, challenge.title, challenge.id, challenge.y_axis_label);
					this.runChartTwo(challenge.data_two, challenge.label_two, challenge.bgcolor_two, challenge.title_two, challenge.id, challenge.y_axis_label_two);
				}
			})
		},

		methods: {
			runChart(data, label, bgcolor, title, id, y_axis_label) {

				$('#myChart-PhaseOne-'+id).remove();
				$('#chartHolder-PhaseOne-'+id).append('<canvas id="myChart-PhaseOne-'+id+'"width="606px" height="242px"></canvas>')
				var ctx = document.getElementById("myChart-PhaseOne-"+id).getContext("2d");
				ctx.height = 50;

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

			runChartTwo(data, label, bgcolor, title, id, y_axis_label) {

				$('#myChart-PhaseTwo-'+id).remove();
				$('#chartHolder-PhaseTwo-'+id).append('<canvas id="myChart-PhaseTwo-'+id+'"></canvas>')
				var ctx = document.getElementById("myChart-PhaseTwo-"+id).getContext("2d");
				ctx.height = 50;

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

			config(labelList = [], data = [], bgcolor = [], title = '', y_axis_label='') {
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