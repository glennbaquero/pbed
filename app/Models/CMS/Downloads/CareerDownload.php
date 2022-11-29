<?php

namespace App\Models\CMS\Downloads;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CMS\Careers\Career;

class CareerDownload extends Model
{
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'career' => $this->career ? $this->career->name : null,
            'email' => $this->email,
        ];
    }


    public function career() {
    	return $this->belongsTo(Career::class)->withTrashed();
    }
}
