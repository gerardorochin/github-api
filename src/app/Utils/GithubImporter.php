<?php

namespace App\Utils;

use GrahamCampbell\GitHub\Facades\GitHub;
use App\Models\GithubUser;
use App\Models\GithubUserRepository;

class GithubImporter
{
    protected $github_user = null;

    public function __construct($github_user)
    {
        $this->github_user = $github_user;
    }

    public function getUser(): array
    {
        $user = GitHub::user()->show($this->github_user);
        return [
            'github_user_id' => $user['id'],
            'login' => $user['login'],
            'url' => $user['html_url'],
            'name' => $user['name'],
            'email' => $user['email'],
            'avatar_url' => $user['avatar_url'],
        ];
    }

    public function getRepositories(): array
    {
        $repos = GitHub::user()->repositories($this->github_user);
        $userRepositories = [];

        foreach ($repos as $repo) {
            $userRepo = [
                'github_repository_id' => $repo['id'],
                'name' => $repo['name'],
                'description' => $repo['description'],
                'fork' => $repo['fork'],
                'url' => $repo['html_url'],
            ];
            array_push($userRepositories, $userRepo);
        }

        return $userRepositories;
    }

    public function import(): array
    {
        $user = $this->getUser($this->github_user);
        $repositories = $this->getRepositories($this->github_user);

        GithubUser::updateOrCreate($user);
        GithubUserRepository::where('github_user_id', $user['github_user_id'])->delete();

        $now = date('Y-m-d H:i:s');
        foreach ($repositories as $repository => $repo) {
            $repositories[$repository]['github_user_id'] = $user['github_user_id'];
            $repositories[$repository]['created_at'] = $now;
            $repositories[$repository]['updated_at'] = $now;
        }

        GithubUserRepository::insert($repositories);

        return [
            'user' => $user,
            'repositories' => $repositories
        ];
    }
}