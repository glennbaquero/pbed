<?php

namespace App\Http\Controllers\Web\FetchControllers;

use App\Extenders\Controllers\FetchController as Controller;
use App\Models\CMS\Blogs\Blog;

class BlogFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    
    public function setObjectClass()
    {
        $this->class = new Blog;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        /**
         * Queries
         * 
         */
        
        $this->per_page = 6;
        if($this->request->filled('for_youthworks')) {
            $query = $query->where('for_youthworks', $this->request->filled('for_youthworks'));
        }

        $query = $query->orderby('date_posted', 'desc');
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

        foreach($items as $index => $item) {
            $data = $this->formatItem($item);
            array_push($result, $data);   
        }

        return $result;
    }

    /**
     * Build array data
     * 
     * @param  App\Contracts\AvailablePosition
     * @return array
     */
    protected function formatItem($item)
    { 

        return [
            'id' => $item->id,
            'name' => $item->name,
            'author' => $item->author,
            'content' => $item->content,
            'date_posted' => $item->formatted_created_at,
            'show_url' => $item->show_url,
            'image_path' => $item->renderImagePath(),
            'created_at' => $item->created_at,
            'deleted_at' => $item->deleted_at,
        ];
    }

    public function fetchView($id = null) {
        $item = null;

        if ($id) {
        	$item = Blog::withTrashed()->findOrFail($id);      
            $item->image_path = $item->renderImagePath();
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
        }

    	return response()->json([
    		'item' => $item,
    	]);
    }
}
