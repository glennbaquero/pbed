<?php

namespace App\Http\Controllers\Web\Pages;

use App\Http\Requests\Web\Inquiries\ContactUsStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Web\Downloads\LatestStudyDownloadRequest;


use App\Models\CMS\Home\Carousels\FirstFrame;
use App\Models\CMS\AreasOfWork\Advocacy;
use App\Models\CMS\Home\LatestStudies\LatestStudy;
use App\Models\CMS\News\News;
use App\Models\CMS\News\Event;
use App\Models\CMS\Careers\Procurement;
use App\Models\CMS\Blogs\Blog;
use App\Models\CMS\Careers\Career;
use App\Models\CMS\Downloads\EventDownload;
use App\Models\CMS\Downloads\ProcurementDownload;
use App\Models\CMS\Downloads\CareerDownload;
use App\Models\Pages\PageItem;
use App\Models\Pages\Page;
use App\Models\CMS\Organizations\OurPeople;
use App\Models\CMS\Organizations\Member;
use App\Models\CMS\YouthWorks\YouthWorksCourse;
use App\Models\CMS\YouthWorks\YouthWorksTeam;
use App\Models\CMS\YouthWorks\YouthWorksVideo;
use App\Models\CMS\Faqs\Faq;
use App\Models\CMS\YouthWorks\ProjectPriorityArea;
use App\Models\CMS\Projects\Project;
use App\Models\CMS\Projects\Milestone;
use App\Models\CMS\Projects\ProjectMember;
use App\Models\Picture;
use App\Models\CMS\AreasOfWork\TheChallenge;
use App\Models\CMS\AreasOfWork\OurSolution;
use App\Models\CMS\AreasOfWork\FrameFour;
use App\Models\Inquiries\ContactUs;

use Carbon\Carbon;
use DB;

class PageController extends Controller
{
	/**
	 * Homepage CMS
	 */ 
	
	public function home() 
	{
      $data = $this->getPageData('organizations');
      $data['home'] = $this->getPageData('home');
      $data['location'] = $this->getPageData('contact_us');
      $data['careers_page_item'] = $this->getPageData('careers');
      $today = Carbon::now();
		$sliders = FirstFrame::where('for_youthwork', false)->get();
		$advocacies = Advocacy::all();
      $advocacy_bodies = [];
		$latest_study_bodies = [];
		$latest_study = LatestStudy::get();
      $news = News::where('featured', true)->orderBy('date_posted', 'desc')->get();
      $events = Event::where('featured', true)->orderBy('created_at', 'asc')->get();
      $procurements = Procurement::fetchItem();
      $blogs = Blog::where('for_youthworks', false)->orderBy('date_posted', 'desc')->get();
      $careers = Career::whereDate('job_expiry', '>', $today)->get();
      $who_we_are = PageItem::where('slug', 'who_we_are')->first();

		foreach ($advocacies as $advocacy) {
   		$advocacy_images[] = $advocacy->renderImagePath();
   		array_push($advocacy_bodies, [
   			'title' => $advocacy->title,
   			'description' => $advocacy->description,
            'link' => $advocacy->link
   		]);
		}


      foreach ($latest_study as $study) {
         $latest_study_images[] = $study->renderImagePath();
         array_push($latest_study_bodies, [
            'id' => $study->id,
            'header' => $study->header,
            'description' => $study->description,
            'downloadable' => $study->downloadable,
            'full_file_path' => $study->full_file_path
         ]);
      }

		return view('web.pages.home', array_merge($data, [
			'sliders' => $sliders,
			'advocacy_images' => $advocacy_images,
         'latest_study_bodies' => json_encode($latest_study_bodies),
         'latest_study_images' => json_encode($latest_study_images),
			'advocacy_bodies' => $advocacy_bodies,
			// 'latest_study' => $latest_study,
         'news' => $news,
         'events' => $events,
         'blogs' => $blogs,
         'careers' => $careers,
         'procurements' => json_encode($procurements),
         'who_we_are' => $who_we_are->content
		])); 
	}

   public function downloadLatestStudy(LatestStudyDownloadRequest $request) 
   {
      DB::beginTransaction();
         EventDownload::create($request->all());
      DB::commit();

      return response()->json([
         'message' => 'Submitted',
         'success' => true
      ]);
   }

   public function downloadProcurementOrCareer(Request $request) 
   {
      DB::beginTransaction();
         if($request->filled('procurement_id')) {
            ProcurementDownload::create($request->only(['email', 'procurement_id']));
         } else {
            CareerDownload::create($request->only(['email', 'career_id']));
         }
      DB::commit();

      return response()->json([
         'message' => 'Submitted',
         'success' => true
      ]);
   }

   public function careers() 
   {
      $data = $this->getPageData('home');
      $data['page_item'] = $this->getPageData('careers');

      $today = Carbon::now();
      $call_procurements = Procurement::fetchItem('0');
      $request_procurements = Procurement::fetchItem(1);
      $careers = Career::whereDate('job_expiry', '>', $today)->get();
      return view('web.pages.careers', array_merge($data, [
         'careers' => $careers,
         'call_procurements' => json_encode($call_procurements),
         'request_procurements' => json_encode($request_procurements),
      ])); 
   }

   public function blogs() 
   {
      $data = $this->getPageData('blogs');
      $blogs = Blog::whereNotNull('date_posted')->orderby('date_posted', 'desc')->take(10)->get();
      return view('web.pages.blogs.blogs',array_merge($data, [
         'latest_blogs' => $blogs
      ])); 
   }

   public function selectedBlogs($id, $author, $name)
   {
      $blog = Blog::find($id);
      $blogs = Blog::whereNotNull('date_posted')->orderby('date_posted', 'desc')->take(10)->get();
      return view('web.pages.blogs.show-blog',[
         'blog' => $blog,
         'blogs' => $blogs
      ]); 
   }

   public function projects()
   {
      $projects = Project::get();
      return view('web.pages.project.projects',[
         'projects' => $projects
      ]); 
   }

   public function selectedProjects($id, $name)
   {
      $project = Project::find($id);
      $milestone = Milestone::where('project_id', $id)->get();
      $project_member = ProjectMember::where('project_id', $id)->get();
      $slider_image = Picture::where('parent_id', $id)->get();
      return view('web.pages.project.show-project',[
         'project' => $project,
         'milestone' => $milestone,
         'project_member' => $project_member,
         'slider_image' => $slider_image,
      ]); 
   }

   public function news() 
   {
      $data = $this->getPageData('news');
      $news = News::orderBy('date_posted', 'desc')->get();
      return view('web.pages.news.news', array_merge($data, [
         'news' => $news
      ]));  
   }


   public function selectedNews($id, $author, $name)
   {
      $news = News::find($id);
      $news_list = News::orderBy('date_posted', 'desc')->get();
      return view('web.pages.news.show-news',[
         'news' => $news,
         'news_list' => $news_list,
      ]); 
   }

   public function organizations() 
   {
      $data = $this->getPageData('organizations');
      $people = OurPeople::orderby('order', 'asc')->get();
      $individuals = Member::where('type', 'Individuals')->orderby('order', 'asc')->get();
      $corporations = Member::where('type', 'Corporations')->orderby('order', 'asc')->get();
      return view('web.pages.organization', array_merge($data, [
         'people' => $people,
         'individuals' => $individuals,
         'corporations' => $corporations,
      ]));  
   }

   public function youthWork()
   {
      $data = $this->getPageData('youth_works_ph');
      $sliders = FirstFrame::where('for_youthwork', true)->get();
      $courses = YouthWorksCourse::all();
      $videos = YouthWorksVideo::all();
      $heads = YouthWorksTeam::where('type', 'HEAD')->get();
      $managers = YouthWorksTeam::where('type', 'Managers')->get();
      $coordinators = YouthWorksTeam::where('type', 'City Coordinators')->get();
      $officers = YouthWorksTeam::where('type', 'Officers and Assistants')->get();
      $faqs = Faq::all();
      $featured_blog = Blog::where(['for_youthworks' => true, 'featured' => true])->first();
      $project_priorities = ProjectPriorityArea::where('is_priority_area', true)->get();
      $growth_sectors = ProjectPriorityArea::where('is_priority_area', false)->get();
      return view('web.pages.youthworksph', array_merge($data, [
         'sliders' =>  $sliders,
         'courses' => $courses,
         'videos' => $videos,
         'heads' => $heads,
         'managers' => $managers,
         'coordinators' => $coordinators,
         'officers' => $officers,
         'faqs' => $faqs,
         'featured_blog' => $featured_blog,
         'project_priorities' => $project_priorities,
         'growth_sectors' => $growth_sectors,
      ])); 
   }

   public function workforceDevelopment()
   {
      $data = $this->getPageData('workforce_development');
      $frame_four = FrameFour::all();
      $solutions = OurSolution::where('for_teaching_learning', false)->get();
      $challenges = TheChallenge::where('for_teaching_learning', false)->get();
      $projects = Project::where('for_workforce_development', true)->get();
      return view('web.pages.areas-of-work.workforce', array_merge($data, [
         'frame_four' => $frame_four,
         'solutions' => $solutions,
         'challenges' => $challenges,
         'projects' => $projects,
      ])); 
   }

   public function teachingAndLearning()
   {
      $data = $this->getPageData('teaching_and_learning');
      $challenges = TheChallenge::where('for_teaching_learning', true)->get();
      $solutions = OurSolution::where('for_teaching_learning', true)->get();
      $projects = Project::where('for_teacher_learning', true)->get();

      return view('web.pages.areas-of-work.teaching-and-learning', array_merge($data, [
         'solutions' => $solutions,
         'challenges' => $challenges,
         'projects' => $projects,
      ])); 
   }

   public function contactUs()
   {
      $data['home'] = $this->getPageData('home');
      $data['contact_us'] = $this->getPageData('contact_us');
      return view('web.pages.contact-us', array_merge($data, [])); 
   }

   public function storeContact(ContactUsStoreRequest $request) 
   {
      DB::beginTransaction();
         ContactUs::store($request);
      DB::commit();

      return response()->json([
         'message' => 'success'
      ]);
   }

   public function privacyPolicy() 
   {
      $data = $this->getPageData('privacy_policy');

      return view('web.pages.privacy-policy', array_merge($data, [
         //
      ])); 
   }

   /* Get Page Data */
   protected function getPageData($slug) {
      $item = Page::where('slug', $slug)->firstOrFail();
      return $item->getData();
   }
}
