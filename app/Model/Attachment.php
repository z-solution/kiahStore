<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    
    /**
     * Get the user for this attachment.
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
    
    /**
     * Get the inventory for this attachment.
     */
    public function inventory()
    {
        return $this->belongsTo('App\Model\Inventory');
    }
}
