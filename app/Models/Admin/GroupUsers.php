<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GroupUsers extends Model
{
    use HasFactory;
    protected $table = "group_users";
    protected $primaryKey = "gu_id";
    protected $guarded = [];
    public $timestamps = false;

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(MsGroups::class, 'ms_groups', 'group_id', 'group_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'user_id', 'id');
    }
}
