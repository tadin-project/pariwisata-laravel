<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MsGroups extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "ms_groups";
    protected $primaryKey = "group_id";
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'group_id', 'group_id');
    }

    public function group_menus(): HasMany
    {
        return $this->hasMany(GroupMenus::class, 'group_id', 'group_id');
    }

    public function group_users(): HasMany
    {
        return $this->hasMany(GroupUsers::class, 'group_id', 'group_id');
    }
}
