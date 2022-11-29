<?php

namespace App\Models\CMS\AreasOfWork;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\ImageTrait;

class TheChallenge extends Model
{
    use ImageTrait;

    protected $appends = ['full_image_path'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null, $columns = ['title', 'label', 'data', 'bgcolor', 'title_two', 'label_two', 'data_two', 'bgcolor_two', 'description', 'label_teaching_learning', 'y_axis_label', 'y_axis_label_two'])
    {
        $vars = $request->only($columns);
        $vars['for_teaching_learning'] = $request->filled('for_teaching_learning');
        $vars['is_image'] = $request->filled('is_image');

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('image_path'))
        {
            $item->storeImage($request->file('image_path'), 'image_path', 'the-challenges', false);
        }

        return $item;
    }

    /**
     * Append image full path
     *
     * @return string $image
     */
    public function getFullImagePathAttribute()
    {
        return asset('storage/' . $this->image_path);
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
        $name = 'challenges.show';

        return route($prefix . ".{$name}", $route);
    }

     /**
     * Render name for specific item
     * 
     * @return string/route
     */
    public function renderName() 
    {
        return $this->name;
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderArchiveUrl($prefix = 'admin') 
    {
        return route($prefix . '.challenges.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.challenges.restore', $this->id);
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}
