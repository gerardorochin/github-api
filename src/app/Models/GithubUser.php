<?php

namespace App\Models;
use App\Models\GithubUserRepository;

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

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function repositories(): object
    {
        return $this->hasMany(GithubUserRepository::class, 'github_user_id');
    }

    public function whereLogin(string $githubUser): object
    {
        return $this->where('login', $query);
    }
}