<?php

namespace App\Models\CMS\Downloads;

use App\Extenders\Models\BaseModel as Model;

use App\Models\CMS\Careers\Procurement;

class ProcurementDownload extends Model
{
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'procurement' => $this->procurement ? $this->procurement->name : null,
            'email' => $this->email,
        ];
    }


    public function procurement() {
    	return $this->belongsTo(Procurement::class)->withTrashed();
    }
}
