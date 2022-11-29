<?php

namespace App\Extenders\Controllers\ActivityLogs;

use Illuminate\Http\Request;
use App\Extenders\Controllers\FetchController as Controller;

use App\Models\ActivityLogs\ActivityLog;

use App\Models\Pages\Page;
use App\Models\Pages\MetaTag;

class ActivityLogFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass() 
    {
        $this->class = new ActivityLog;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query) 
    {
        $query = $this->additionalQuery($query);

        $query = $this->filterSubject($query, 'sample', 'App\Models\Samples\SampleItem');
        $query = $this->filterSubject($query, 'roles', 'App\Models\Roles\Role');
        $query = $this->filterSubject($query, 'pageitems', 'App\Models\Pages\PageItem');
        $query = $this->filterSubject($query, 'user', 'App\Models\Users\User');
        $query = $this->filterSubject($query, 'admin', 'App\Models\Users\Admin');
        $query = $this->filterSubject($query, 'articles', 'App\Models\Articles\Article');
        $query = $this->filterSubject($query, 'subject_type', $this->request->input('subject_type'));

        $query = $this->filterSubject($query, 'works', 'App\Models\CMS\Works\Work');
        $query = $this->filterSubject($query, 'projects', 'App\Models\CMS\Projects\Project');        
        $query = $this->filterSubject($query, 'studies', 'App\Models\CMS\Studies\Study');
        $query = $this->filterSubject($query, 'corporations', 'App\Models\CMS\Corporations\Corporation');
        $query = $this->filterSubject($query, 'blogs', 'App\Models\CMS\Blogs\Blog');
        $query = $this->filterSubject($query, 'youth-works-courses', 'App\Models\CMS\YouthWorks\YouthWorksCourses');
        $query = $this->filterSubject($query, 'contact-categories', 'App\Models\CIS\ContactCategories\ContactCategory');
        $query = $this->filterSubject($query, 'contact-informations', 'App\Models\CIS\ContactInformations\ContactInformation');
        $query = $this->filterSubject($query, 'home-first-frame', 'App\Models\CMS\Home\Carousels\FirstFrame');
        $query = $this->filterSubject($query, 'home-latest-study', 'App\Models\CMS\Home\LatestStudies\LatestStudy');
        $query = $this->filterSubject($query, 'procurements', 'App\Models\CMS\Procurements\Procurement');
        $query = $this->filterSubject($query, 'advocacies', 'App\Models\CMS\AreasOfWork\Advocacy');
        $query = $this->filterSubject($query, 'events', 'App\Models\CMS\News\Event');
        $query = $this->filterSubject($query, 'our-leaderships', 'App\Models\CMS\Organizations\OurLeadership');
        $query = $this->filterSubject($query, 'advisers', 'App\Models\CMS\Organizations\Adviser');
        $query = $this->filterSubject($query, 'members', 'App\Models\CMS\Organizations\Member');
        $query = $this->filterSubject($query, 'our-people', 'App\Models\CMS\Organizations\OurPeople');
        $query = $this->filterSubject($query, 'project-priority-areas', 'App\Models\CMS\YouthWorks\ProjectPriorityArea');
        $query = $this->filterSubject($query, 'faqs', 'App\Models\CMS\Faqs\Faq');
        $query = $this->filterSubject($query, 'challenges', 'App\Models\CMS\AreasOfWork\TheChallenge');
        $query = $this->filterSubject($query, 'solutions', 'App\Models\CMS\AreasOfWork\OurSolution');
        $query = $this->filterSubject($query, 'frame-four', 'App\Models\CMS\AreasOfWork\FrameFour');
        $query = $this->filterSubject($query, 'request-information', 'App\Models\CIS\ContactInformations\RequestInformation');

        /* Get page and related page item logs */
        if ($this->request->filled('pagecontents')) {
            $subjects = ['App\Models\Pages\PageItem', 'App\Models\Pages\Page', ''];

            $pageIds = $query->where('subject_type', 'App\Models\Pages\Page')->pluck('id')->toArray();
            $pageItems = $query->where('subject_type', 'App\Models\Pages\PageItem');

            if ($this->request->filled('id')) {
                $page = Page::withTrashed()->findOrFail($this->request->input('id'));
                $pageItemIds = $page->page_items()->pluck('id')->toArray();
                $pageItems = $pageItems->whereIn('subject_id', $pageItemIds);
            }

            $pageItemIds = $pageItems->pluck('id')->toArray();

            $query = $query->whereIn('id', array_merge($pageIds, $pageItemIds));
        }

        return $query;
    }

    /**
     * Filter Subject
     * @param  QueryBuilder $query   
     * @param  string $param  
     * @param  string $subject 
     * @return Query Builder          
     */
    protected function filterSubject($query, $param, $subject, $id = false) 
    {
        if ($this->request->filled($param)) {
            $filters = [
                'subject_type' => $subject,
            ];

            if ($id) {
                $filters = array_merge($filters, [
                    'subject_id' => $id,
                ]);
            } else {
                if ($this->request->filled('id')) {
                    $filters = array_merge($filters, [
                        'subject_id' => $this->request->input('id'),
                    ]);
                }
            }

            $query = $query->where($filters);
        }

        return $query;
    }

    /**
     * Additional Query for when being extended
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function additionalQuery($query) 
    {
        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items) 
    {
        $result = [];

        foreach($items as $item) {
            $data = $this->formatItem($item);

            array_push($result, array_merge($data, [
                'id' => $item->id,
                'name' => $item->renderName(),
                'caused_by' => $item->renderCauserName(),
                'show_causer' => $item->renderCauserShowUrl(),
                'subject_type' => $item->renderSubjectType(),
                'subject_name' => $item->renderSubjectName(),
                'created_at' => $item->renderDate(),
            ]));
        }

        return $result;
    }

    /**
     * Additional property when extended
     * 
     * @param  App\Contracts\AvailablePosition
     * @return array
     */
    protected function formatItem($item) 
    {
        return [
            'showUrl' => $item->renderShowUrl(),
        ];
    }
}
