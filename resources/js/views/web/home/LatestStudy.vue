<template>
	<div>
		<section class="page-frame hm-fr4 full--scroll" data-section-name="4">
			<div class="width--80 margin-a">
				<div class="cstm-border-radius--8 cstm-box-shadow-15 overflow-hidden hmfr4__card">
					<div class="inlineBlock-parent hmfr4__innerCard">
						<div class="width--50 hmfr4__leftCon">
							<div class="page-section__titleCon">
								<div class="s-margin-b inlineBlock-parent">
									<div class="page-section__line"></div>
									<small class="fntwght--bold uppercase">{{ titleLabel }}</small>
								</div>
							</div>
							<div class="hmfr4__sliderCon">
								<!-- @foreach($latest_study_bodies as $study) -->
								<div class="hmfr4__sliderList" v-for="study in latestStudies">
									<h2 class="font-2 type-1 fntwght--bold mb-3">{{ study.header }}</h2>
									<div class="hm-fr4__desc scroll-custom m-margin-b list-style">	
										<p>{{ study.description }}</p>
									</div>
									<!-- @if($study['downloadable']) -->
									<button class="btn type-1" data-toggle="modal" v-if="study.downloadable" @click="selectedStudy = study" data-target="#hmModal__study" >Download</button>
									<!-- @endif -->
								</div>
								<!-- @endforeach -->
							</div>
							<div class="cstm__cardArrowCon4"></div>
						</div
						><div class="width--50">
							<div class="hmfr4__sliderThumbCon">
								<!-- @foreach($latest_study_images as $study) -->
								<div class="hmfr4__cardImg" v-for="image in images" :style="{ backgroundImage: `url(${ image })` }"></div>
								<!-- @endforeach -->
							</div>
						</div>
					</div>
				</div>
			</div>	
		</section>

		<before-you-submit
			:store-url="storeUrl"
			:latest-study="selectedStudy"
		></before-you-submit>
	</div>
</template>
<script type="text/javascript">
	export default{
		props: {
			titleLabel: String,
			latestStudies: Array,
			images: Array,
			storeUrl: String,
		},

		data() {
			return {
				selectedStudy: {}
			}
		}
	}
</script>