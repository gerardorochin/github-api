<?php

namespace App\Utils;

use GrahamCampbell\GitHub\Facades\GitHub;
use App\Models\GithubUser;
use App\Models\GithubUserRepository;

class GithubImporter
{
    protected $githubUser = null;

    public function __construct($githubUser)
    {
        $this->githubUser = $githubUser;
    }

    public function getUser(): array
    {
        $user = GitHub::user()->show($this->githubUser);
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
        $repos = GitHub::user()->repositories($this->githubUser);
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
        $user = $this->getUser($this->githubUser);
        $repositories = $this->getRepositories($this->githubUser);

        GithubUser::updateOrCreate($user);

        foreach ($repositories as $repository => $repo) {
            $repositories[$repository]['github_user_id'] = $user['github_user_id'];
            GithubUserRepository::updateOrCreate($repositories[$repository]);
        }

        return [
            'user' => $user,
            'repositories' => $repositories
        ];
    }
}