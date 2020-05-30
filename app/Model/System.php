<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    const SYSTEMSHOPMAINTAINERMOOD = 'shop-maintainer-mood';
    static public function IsShopMaintainerMood() {
        $sys = System::where('name', System::SYSTEMSHOPMAINTAINERMOOD)->first();
        return $sys != null && $sys->value == 'true';
    }
}
