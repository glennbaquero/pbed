<?php

namespace App\Models\CMS\Downloads;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CMS\News\Event;

class EventDownload extends Model
{
	/**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'event' => $this->event ? $this->event->name : null,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'contact_number' => $this->contact_number,
        ];
    }


    public function event() {
    	return $this->belongsTo(Event::class)->withTrashed();
    }
}
