<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GithubUser extends Model
{
    protected $table = 'github_users';
    protected $primaryKey = 'github_user_id';
    protected $fillable = [
        'github_user_id',
        'login',
        'name',
        'email',
        'url',
        'avatar_url',
    ];
}
