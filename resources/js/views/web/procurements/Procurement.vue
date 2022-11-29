<template>
	<div>
		<section class="page-frame hm-fr8 full--scroll" data-section-name="8">
			<div class="width--90 margin-a">
				<div class="page-section__titleCon align-c">
					<div class="s-margin-b inlineBlock-parent">
						<div class="page-section__line"></div>
						<small class="fntwght--bold type-white uppercase">{{ procumentTitle }}</small>
					</div>
				</div>
				<div class="hm-fr8__innerCon">
					<div class="gen__tabCon">
						<div class="gen__tabNavItem">				
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							  	<li class="nav-item">
							  		<h3 class="nav-link active click-here" id="call-for-proposals" data-toggle="tab" data-target="#tab1" role="tab" aria-controls="home" aria-selected="true" @click="reinit('.hmfr8__sliderCon')">Call for Proposals</h3>
							  	</li>
							  	<li class="nav-item">
							  		<h3 class="nav-link click-here" id="proposal" data-toggle="tab" data-target="#tab2" role="tab" aria-controls="profile" aria-selected="false" @click="reinit('.hmfr8__sliderCon2')">{{ proposalLabel }}</h3>
							  	</li>
							</ul>
						</div>
					</div>
					<div class="gen__article margin-a tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="call-for-proposals">
					  		<div class="hmfr8__sliderCon">
								<div class="hmfr8__sliderListCon" v-for="procurement in procurement_data">
									<div class="cstm-box-shadow-15 cstm-border-radius--8 overflow-hidden cstm__card">
										<small class="type-dullBlack s-margin-b">{{ procurement.cfp_no }}</small>
										<p class="fntwght--bold type-1 s-margin-b">{{ procurement.title }}</p>
										<p class="m-margin-b">{{ procurement.short_description }}</p>
										<div class="align-c">
											<button v-if="procurement.downloadable" class="btn type-1"  data-toggle="modal" data-target="#hmModal__precurement">Download</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="proposal">
					  		<div class="hmfr8__sliderCon2">
								<div class="hmfr8__sliderListCon" v-for="procurement in proposal_data">
									<div class="cstm-box-shadow-15 cstm-border-radius--8 overflow-hidden cstm__card">
										<small class="type-dullBlack s-margin-b">{{ procurement.cfp_no }}</small>
										<p class="fntwght--bold type-1 s-margin-b">{{ procurement.title }}</p>
										<p class="m-margin-b">{{ procurement.short_description }}</p>
										<div class="align-c">
											<button v-if="procurement.downloadable" class="btn type-1"  data-toggle="modal" data-target="#hmModal__precurement" @click="selectedProcurement = procurement">Download</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<before-you-submit-email-only
			:store-url="storeUrl"
			:procurement="selectedProcurement"
		></before-you-submit-email-only>

		<!-- <div class="gen__tabCon">
			<div class="gen__tabNav align-c">
				<ul class="inlineBlock-parent">
					<li data-tab-target="" class="align-c active" @click="proposal=0">
						<h3>Call for Proposals</h3>
					</li>
					<li data-tab-target="" class="align-c" @click="proposal=1">
						<h3>{{ proposalLabel }}</h3>
					</li>
				</ul>
			</div>
			<div class="gen__article margin-a">
				<div class="gen__tabList" data-tab-list="">
					<div class="hmfr8__sliderCon">
						<div class="hmfr8__sliderListCon" v-for="procurement in procurement_data"  >
							<div class="cstm-box-shadow-15 cstm-border-radius--8 overflow-hidden cstm__card">
								<small class="type-dullBlack s-margin-b">{{ procurement.cfp_no }}</small>
								<p class="fntwght--bold type-1 s-margin-b">{{ procurement.title }}</p>
								<p class="m-margin-b">{{ procurement.short_description }}</p>
								<div class="align-c">
									<button v-if="procurement.downloadable" class="btn type-1"  data-toggle="modal" data-target="#hmModal__precurement">Download</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="gen__tabList" data-tab-list="">
					<div class="hmfr8__sliderCon2">
						<div class="hmfr8__sliderListCon" v-for="procurement in procurement_data" >
							<div class="cstm-box-shadow-15 cstm-border-radius--8 overflow-hidden cstm__card">
								<small class="type-dullBlack s-margin-b">{{ procurement.cfp_no }}</small>
								<p class="fntwght--bold type-1 s-margin-b">{{ procurement.title }}</p>
								<p class="m-margin-b">{{ procurement.short_description }}</p>
								<div class="align-c">
									<button v-if="procurement.downloadable" class="btn type-1"  data-toggle="modal" data-target="#hmModal__precurement" @click="selectedProcurement = procurement">Download</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</div>
</template>

<script>
	export default {
		props: {
			procurements: Array,
			storeUrl: String,
			proposalLabel: String,
			procumentTitle: String,
		},


		data() {
			return {
				proposal: 0,
				procurement_data: [],
				proposal_data: [],
				selectedProcurement: {}
			}
		},

		mounted() {
			this.procurement_data = this.procurements.filter(procurement => procurement.type == 0);
			this.proposal_data = this.procurements.filter(procurement => procurement.type == 1);
		},

		methods:{
			reinit(className) {
				$(className).slick('unslick');

				$(className).slick({
					infinite: true,
					arrows: true,
					dots: false,
					autoplay: false,
					speed: 800,
					slidesToShow: 1,
					slidesToScroll: 1,
					centerMode: true,
				});

				setTimeout(function(){
					$(className).slick('reinit');
				}, 300);
			}
		}
	}
</script>
