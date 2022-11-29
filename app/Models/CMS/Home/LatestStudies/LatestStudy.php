<?php

namespace App\Models\CMS\Home\LatestStudies;

use App\Extenders\Models\BaseModel as Model;
use Illuminate\Support\Str;
use Storage;

use App\Traits\FileTrait;

class LatestStudy extends Model
{
	use FileTrait;

    protected $appends = ['full_file_path'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'header' => $this->header,
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null, $columns = ['header', 'description', 'file_path'])
    {
        $vars = $request->only($columns);
        $vars['downloadable'] = $request->filled('downloadable');
        $vars['is_active'] = $request->filled('is_active');

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->has('file_path'))
        {
    	    // $path = $request->file('file_path')->store('latest-studies', 'public');
            // Storage::put($absolute_path, $optimized_image);
            $extension = $request->file_path->getClientOriginalExtension();
            $file_path =  'latest-studies/' . uniqid() . Str::random(40) . '.' . $extension;
            $file = Storage::put('public/latest-studies', $request->file('file_path'));
            $item->file_path = $file;
    	    $item->save();
        }

        if($request->hasFile('image_path'))
        {
            $item->storeImage($request->file('image_path'), 'image_path', 'latest-studies');
        }

        return $item;
    }

    /*
    |--------------------------------------------------------------------------
    | @Appends
    |--------------------------------------------------------------------------
    */
    public function getFullFilePathAttribute() {
        return url($this->renderFilePath());
    }

	/*
	|--------------------------------------------------------------------------
	| @Renders
	|--------------------------------------------------------------------------
	*/

    /**
     * Render show url for specific item
     * 
     * @return string/route
     */
	public function renderShowUrl($prefix = 'admin') 
    {
        $route = $this->id;
        $name = 'home-latest-study.show';

        return route($prefix . ".{$name}", $route);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderArchiveUrl($prefix = 'admin') 
    {
        return route($prefix . '.home-latest-study.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.home-latest-study.restore', $this->id);
    }
}
