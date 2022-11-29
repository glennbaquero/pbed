/*
|--------------------------------------------------------------------------
| @Components for USER - CIS
|--------------------------------------------------------------------------
*/

/**
 * ContactInformation Components
 */
Vue.component('contact-information-user-table', require('./user/contact-information/ContactInformationTable.vue').default);
Vue.component('contact-information-user-view', require('./user/contact-information/ContactInformationView.vue').default);

Vue.component('contacts-table', require('./ContactsTable.vue').default);
Vue.component('contacts-view', require('./ContactsView.vue').default);

Vue.component('profile-view', require('./profile/Profile.vue').default);
Vue.component('change-password', require('./profile/ChangePassword.vue').default);

Vue.component('procurement', require('./procurements/Procurement.vue').default);
Vue.component('careers', require('./careers/Career.vue').default);
Vue.component('procurements', require('./careers/Procurements.vue').default);
Vue.component('latest-blogs', require('./blogs/LatestBlogs.vue').default);
Vue.component('blogs', require('./blogs/Blogs.vue').default);
Vue.component('news', require('./news/News.vue').default);
Vue.component('our-leadership', require('./organizations/OurLeadership.vue').default);
Vue.component('adviser', require('./organizations/Adviser.vue').default);
Vue.component('youth-work-blogs', require('./youth-works/Blogs.vue').default);
Vue.component('frame-two-workforce-devt', require('./workforce-development/FrameTwo.vue').default);
Vue.component('frame-four-workforce-devt', require('./workforce-development/FrameFour.vue').default);
Vue.component('graphical-info', require('./teaching-and-learning/GraphicalInfo.vue').default);
Vue.component('contact-us', require('./contact-us/ContactUs.vue').default);
Vue.component('google-map', require('./maps/GoogleMap.vue').default);

Vue.component('latest-study', require('./home/LatestStudy.vue').default);

/**
 * Modals
 */
Vue.component('before-you-submit', require('./modals/BeforeYouSubmit.vue').default);
Vue.component('before-you-submit-email-only', require('./modals/BeforeYouSubmitEmailOnly.vue').default);
Vue.component('before-you-submit-email-only-procurement', require('./modals/BeforeYouSubmitEmailOnlyProcurement.vue').default);


Vue.component('description', require('./Others/Description.vue').default);
