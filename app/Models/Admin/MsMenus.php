<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MsMenus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "ms_menus";
    protected $primaryKey = "menu_id";
    protected $guarded = [];

    public function group_menus(): HasMany
    {
        return $this->hasMany(GroupMenus::class, 'menu_id', 'menu_id');
    }
}
