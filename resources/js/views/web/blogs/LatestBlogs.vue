<template>
	<div>
		<div class="nws-frm__cntnr">
			<div class="nws-frm__main">
				<a :href="selectedBlog.show_url">
					<div class="cstm-box-shadow-15 cstm-border-radius--8 cstm__card-2 overflow-hidden">
						<div class="cstm__crd2ImgCon">
							<div class="page-bg page-bg--cover" :style="{ backgroundImage: `url(${ selectedBlog.full_image_path })` }"></div>
						</div>
						<div class="cstm__crd2TextCon">
							<h3 class="font-1 type-2 fntwght--bold m-margin-b">{{ selectedBlog.name }}</h3>
							<div class="d-md-flex align-items-center justify-content-between">
								<small class="cstm__crd2Misc">{{ selectedBlog.author }} | {{ selectedBlog.date_posted }}</small>
								
								<div class="nws-frm__share-cntnr">								
									<a target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u=' + selectedBlog.show_url">
										<img src="images/icons/fb_share.png">
									</a>
									<a target="_blank" :href="'https://twitter.com/share?url=' + selectedBlog.show_url">
										<img src="images/icons/twitter_share.png">
									</a>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="nws-frm__side-bar scroll-custom">
				<!-- {{-- loop --}} -->
				<div class="d-flex align-items-start m-margin-b" v-for="blog in latestBlogs" @click="selectedBlog = blog">
					<div class="nws-frm__img-holder">
						<div class="page-bg--16">							
							<div class="page-bg page-bg--cover cstm-border-radius--8" :style="{ backgroundImage: `url(${ blog.full_image_path })` }"></div>
						</div>
					</div>
					<div class="nws-frm__content">
						<p class="type-1 fntwght--bold">{{ blog.name }}</p>
						<small class="type-3">{{ blog.author }} <template v-if="blog.formatted_created_at">|</template> {{ blog.formatted_created_at }}</small>
					</div>
				</div>
				<!-- {{-- end loop --}} -->
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props: {
			latestBlogs: Array
		},

		data() {
			return {
				selectedBlog: this.latestBlogs[0]
			}
		}
	}
</script>