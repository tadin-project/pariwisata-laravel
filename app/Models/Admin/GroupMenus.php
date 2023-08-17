<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GroupMenus extends Model
{
    use HasFactory;
    protected $table = "group_menus";
    protected $primaryKey = "gm_id";
    protected $guarded = [];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(MsGroups::class, 'group_id', 'group_id');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(MsMenus::class, 'menu_id', 'menu_id');
    }
}
