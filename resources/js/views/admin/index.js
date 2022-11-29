Vue.component('dashboard-analytics', require('./dashboards/DashboardAnalytics.vue').default);

Vue.component('admin-user-table', require('./admin-users/AdminTable.vue').default);
Vue.component('admin-user-view', require('./admin-users/AdminView.vue').default);

Vue.component('user-table', require('./users/UserTable.vue').default);
Vue.component('user-view', require('./users/UserView.vue').default);

Vue.component('role-table', require('./roles/RoleTable.vue').default);
Vue.component('role-view', require('./roles/RoleView.vue').default);

Vue.component('page-table', require('./pages/PageTable.vue').default);
Vue.component('page-view', require('./pages/PageView.vue').default);

Vue.component('page-item-table', require('./pages/PageItemTable.vue').default);
Vue.component('page-item-view', require('./pages/PageItemView.vue').default);

Vue.component('permission-list', require('./permissions/PermissionList.vue').default);

Vue.component('article-table', require('./articles/ArticleTable.vue').default);
Vue.component('article-view', require('./articles/ArticleView.vue').default);

/*
|--------------------------------------------------------------------------
| @Components for ADMIN - CMS)
|--------------------------------------------------------------------------
*/

/**
 * Works Components
 */
Vue.component('works-table', require('./cms/works/WorksTable.vue').default);
Vue.component('work-view', require('./cms/works/WorkView.vue').default);

/**
 * Challenges Components
 */
Vue.component('challenges-table', require('./cms/works/challenges/ChallengesTable.vue').default);

/**
 * Solutions Components
 */
Vue.component('solutions-table', require('./cms/works/solutions/SolutionsTable.vue').default);

/**
 * Careers Components
 */
Vue.component('career-table', require('./cms/careers/CareerTable.vue').default);
Vue.component('career-view', require('./cms/careers/CareerView.vue').default);

/**
 * Projects Components
 */
Vue.component('projects-table', require('./cms/projects/ProjectsTable.vue').default);
Vue.component('project-view', require('./cms/projects/ProjectView.vue').default);

/**
 * Home FirstFrame Components
 */
Vue.component('home-first-frame-table', require('./cms/home/first-frame/FirstFramesTable.vue').default);
Vue.component('home-first-frame-view', require('./cms/home/first-frame/FirstFrameView.vue').default);

/**
 * Home Latest Study Components
 */
Vue.component('home-latest-study-table', require('./cms/home/latest-study/LatestStudiesTable.vue').default);
Vue.component('home-latest-study-view', require('./cms/home/latest-study/LatestStudyView.vue').default);

/**
 * Procurements Components
 */
Vue.component('procurements-table', require('./cms/procurements/ProcurementsTable.vue').default);
Vue.component('procurement-view', require('./cms/procurements/ProcurementView.vue').default);

/**
 * Advocacies Components
 */
Vue.component('advocacies-table', require('./cms/advocacies/AdvocaciesTable.vue').default);
Vue.component('advocacy-view', require('./cms/advocacies/AdvocacyView.vue').default);

/**
 * Milestones Components
 */
Vue.component('milestones-table', require('./cms/projects/milestones/MilestonesTable.vue').default);

/**
 * Project Members Components
 */
Vue.component('project-members-table', require('./cms/projects/project-members/ProjectMembersTable.vue').default);

/**
 * News Components
 */
Vue.component('news-table', require('./cms/news/NewsTable.vue').default);
Vue.component('news-view', require('./cms/news/NewsView.vue').default);

/**
 * OurLeaderships Components
 */
Vue.component('our-leaderships-table', require('./cms/our-leaderships/OurLeadershipsTable.vue').default);
Vue.component('our-leaderships-view', require('./cms/our-leaderships/OurLeadershipsView.vue').default);

/**
 * Advisers Components
 */
Vue.component('advisers-table', require('./cms/advisers/AdvisersTable.vue').default);
Vue.component('advisers-view', require('./cms/advisers/AdvisersView.vue').default);

/**
 * Advisers Components
 */
Vue.component('members-table', require('./cms/members/MembersTable.vue').default);
Vue.component('members-view', require('./cms/members/MembersView.vue').default);

/**
 * OurPeople Components
 */
Vue.component('our-people-table', require('./cms/our-people/OurPeopleTable.vue').default);
Vue.component('our-people-view', require('./cms/our-people/OurPeopleView.vue').default);

/**
 * Events Components
 */
Vue.component('events-table', require('./cms/events/EventsTable.vue').default);
Vue.component('events-view', require('./cms/events/EventsView.vue').default);

 /**
 * Studies Components
 */
Vue.component('studies-table', require('./cms/studies/StudiesTable.vue').default);
Vue.component('study-view', require('./cms/studies/StudyView.vue').default);

/**
 * Corporations Components
 */
Vue.component('corporations-table', require('./cms/corporations/CorporationsTable.vue').default);
Vue.component('corporation-view', require('./cms/corporations/CorporationView.vue').default);

/**
 * Blogs Components
 */
Vue.component('blogs-table', require('./cms/blogs/BlogsTable.vue').default);
Vue.component('blog-view', require('./cms/blogs/BlogView.vue').default);

/**
 * YouthWorks:Video
 */
Vue.component('youth-works-courses-table', require('./cms/youth-works/youth-works-courses/YouthWorksCoursesTable.vue').default);
Vue.component('youth-works-course-view', require('./cms/youth-works/youth-works-courses/YouthWorksCourseView.vue').default);

/**
 * YouthWorks:Team
 */
Vue.component('youth-works-teams-table', require('./cms/youth-works/youth-works-teams/YouthWorksTeamsTable.vue').default);
Vue.component('youth-works-team-view', require('./cms/youth-works/youth-works-teams/YouthWorksTeamView.vue').default);

/**
 * YouthWorks:Video
 */
Vue.component('youth-works-videos-table', require('./cms/youth-works/youth-works-videos/YouthWorksVideosTable.vue').default);
Vue.component('youth-works-video-view', require('./cms/youth-works/youth-works-videos/YouthWorksVideoView.vue').default);

/*
|--------------------------------------------------------------------------
| @Components for ADMIN - CIS
|--------------------------------------------------------------------------
*/

/**
 * UserClassification Components
 */
Vue.component('user-classifications-table', require('./cis/user-classifications/UserClassificationsTable.vue').default);
Vue.component('user-classification-view', require('./cis/user-classifications/UserClassificationView.vue').default);

/**
 * ConfidentialityCategory Components
 */
Vue.component('confidentiality-categories-table', require('./cis/confidentiality-categories/ConfidentialityCategoriesTable.vue').default);
Vue.component('confidentiality-category-view', require('./cis/confidentiality-categories/ConfidentialityCategoryView.vue').default);

/**
 * ContactCategories Components
 */
Vue.component('contact-categories-table', require('./cis/contact-categories/ContactCategoriesTable.vue').default);
Vue.component('contact-category-view', require('./cis/contact-categories/ContactCategoryView.vue').default);

/**
 * ProjectPriorityAreas Components
 */
Vue.component('project-priority-areas-table', require('./cms/project-priority-areas/ProjectPriorityAreasTable.vue').default);
Vue.component('project-priority-area-view', require('./cms/project-priority-areas/ProjectPriorityAreaView.vue').default);

/**
 * FAQS Components
 */
Vue.component('faqs-table', require('./cms/faqs/FaqsTable.vue').default);
Vue.component('faqs-view', require('./cms/faqs/FaqsView.vue').default);

/**
 * ContactInformations Components
 */
Vue.component('contact-informations-table', require('./cis/contact-informations/ContactInformationsTable.vue').default);
Vue.component('contact-information-view', require('./cis/contact-informations/ContactInformationView.vue').default);
Vue.component('contact-information-upload', require('./cis/contact-informations/ContactInformationUpload.vue').default);

/**
 * RequestInformation Components
 */
Vue.component('request-information-table', require('./cis/request-information/RequestInformationTable.vue').default);
Vue.component('request-information-view', require('./cis/request-information/RequestInformationView.vue').default);

/**
 * DefiniteFields Components
 */
Vue.component('definite-field-view', require('./cis/definite-fields/DefiniteFieldView.vue').default);

/**
 * Reports Components
 */
Vue.component('reports-table', require('./cis/reports/ReportsTable.vue').default);

/**
 * Challenges Components
 */
Vue.component('challenges-table', require('./cms/challenges/ChallengesTable.vue').default);
Vue.component('challenge-view', require('./cms/challenges/ChallengeView.vue').default);

/**
 * Our Solution Components
 */
Vue.component('solutions-table', require('./cms/solutions/SolutionsTable.vue').default);
Vue.component('solution-view', require('./cms/solutions/SolutionView.vue').default);

/**
 * Frame Four Components
 */
Vue.component('frame-four-table', require('./cms/frame-four/FrameFourTable.vue').default);
Vue.component('frame-four-view', require('./cms/frame-four/FrameFourView.vue').default);