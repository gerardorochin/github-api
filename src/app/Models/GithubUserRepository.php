<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GithubUser;

class GithubUserRepository extends Model
{
    protected $table = 'github_users_repositories';
    protected $primaryKey = 'github_repository_id';
    protected $fillable = [
        'github_user_id',
        'github_repository_id',
        'name',
        'description',
        'fork',
        'url',
    ];

    protected $hidden = [
        'github_user_id',
        'updated_at',
        'created_at',
    ];

    public function user(): object
    {
        return $this->belongsTo(GithubUser::class, 'github_user_id');
    }
}