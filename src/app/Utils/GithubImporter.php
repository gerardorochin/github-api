<?php

namespace App\Utils;

use GrahamCampbell\GitHub\Facades\GitHub;

class GithubImporter {

    public function getUser(string $github_user): array {
        $user = GitHub::user()->show($github_user);
        return [
            'github_id' => $user['id'],
            'login' => $user['login'],
            'url' => $user['html_url'],
            'name' => $user['name'],
            'email' => $user['email'],
            'avatar_url' => $user['avatar_url'],
        ];
    }

    public function getRepos(string $github_user): array {
        $repos = GitHub::user()->repositories($github_user);
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
}
