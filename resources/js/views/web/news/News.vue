<template>
	<div>
		<div class="nws-frm__cntnr">
			<div class="nws-frm__main">
				<a :href="selectedNews.show_url">
					<div class="cstm-box-shadow-15 cstm-border-radius--8 cstm__card-2 overflow-hidden">
						<div class="cstm__crd2ImgCon">
							<div class="page-bg page-bg--cover" :style="{ backgroundImage: `url(${ selectedNews.full_image_path })` }"></div>
						</div>
						<div class="cstm__crd2TextCon">
							<small class="cstm__crd2Cat s-margin-b">News</small>
							<h3 class="font-1 type-2 fntwght--bold m-margin-b">{{ selectedNews.name }}</h3>

							<div class="d-md-flex align-items-center justify-content-between">
								<small class="cstm__crd2Misc">{{ selectedNews.author }} | {{ selectedNews.formatted_created_at }}</small>
								
								<div class="nws-frm__share-cntnr">								
									<a target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u=' + selectedNews.show_url">
										<img src="images/icons/fb_share.png">
									</a>
									<a target="_blank" :href="'https://twitter.com/share?url=' + selectedNews.show_url">
										<img src="images/icons/twitter_share.png">
									</a>
								</div>
							</div>
						</div>
					</div>
				</a>
				<div class="list-style frm-desc">
					<description
						:description="selectedNews.content"
					></description>				
				</div>
			</div>
			<div class="nws-frm__side-bar scroll-custom">
				<!-- {{-- loop --}} -->
				<a href="#" class="d-flex align-items-start m-margin-b" v-for="_news in news" @click="selectedNews = _news">
					<div class="nws-frm__img-holder">
						<div class="page-bg--16">
							<div class="page-bg page-bg--cover cstm-border-radius--8" :style="{ backgroundImage: `url(${ _news.full_image_path })` }"></div>
						</div>
					</div>
					<div class="nws-frm__content">
						<p class="type-1 fntwght--bold">{{ _news.name }}</p>
						<small class="type-3">{{ _news.author }} | {{ _news.formatted_created_at }}</small>
					</div>
				</a>
				<!-- {{-- end loop --}} -->
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			news: Array
		},

		data() {
			return {
				selectedNews: this.news[0]
			}
		}
	}
</script>