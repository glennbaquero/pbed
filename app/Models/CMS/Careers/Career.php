<?php

namespace App\Models\CMS\Careers;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\FileTrait;

use Carbon\Carbon;

class Career extends Model
{
    use FileTrait;

	protected $dates = ['job_expiry'];
    protected $appends = ['full_file_path', 'expiry', 'full_image_path'];
	/**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'reference_no' => $this->reference_no,
            'description' => $this->description,
            'type' => $this->type,
            'position' => $this->position,
            'job_expiry' => $this->renderDate('job_expiry'),
            'created_at' => $this->renderDate(),
        ];
    }

    /*
	|--------------------------------------------------------------------------
	| @Consts
	|--------------------------------------------------------------------------
	*/



	/*
	|--------------------------------------------------------------------------
	| @Attributes
	|--------------------------------------------------------------------------
	*/



	/*
	|--------------------------------------------------------------------------
	| @Relationships
	|--------------------------------------------------------------------------
	*/



	/*
	|--------------------------------------------------------------------------
	| @Methods
	|--------------------------------------------------------------------------
	*/

     /**
     * Format Object's Properties
     * @param  object
     * @return object
     */
	public static function formatItem($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'reference_no' => $item->reference_no,
            'type' => $item->type,
            'position' => $item->position,
            'downloadable_file' => $item->downloadable_file,
            'job_expiry' => $item->renderDate('job_expiry'),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];
    }

    /**
     * Store/Update resource to storage
     * 
     * @param  array $request
     * @param  object $item
     */
     public static function store($request, $item = null, $columns = ['reference_no', 'type', 'name', 'position', 'description', 'job_expiry'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        if($request->hasFile('downloadable_file'))
        {
            $path = $request->file('downloadable_file')->store('careers-docs', 'public');
                $item->downloadable_file = $path;
                $item->save();
        }

        if($request->hasFile('image_path'))
        {
            $item->storeImage($request->file('image_path'), 'image_path', 'news-images');
        }

        return $item;
    }

    /*
    |--------------------------------------------------------------------------
    | @Appends
    |--------------------------------------------------------------------------
    */
    public function getFullFilePathAttribute() {
        return url($this->renderFilePath('downloadable_file'));
    }

    public function getExpiryAttribute() {
        return Carbon::parse($this->job_expiry)->format('F d, Y');
    }

    public function getFullImagePathAttribute() {
        return url($this->renderImagePath());
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
        $name = 'careers.show';

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
        return route($prefix . '.careers.archive', $this->id);
    }

    /**
     * Render archive url for specific item
     * 
     * @return string/route
     */
    public function renderRestoreUrl($prefix = 'admin') 
    {
        return route($prefix . '.careers.restore', $this->id);
    }

	/*
	|--------------------------------------------------------------------------
	| @Checkers
	|--------------------------------------------------------------------------
	*/
}
