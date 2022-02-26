<?php

namespace App\Http\Controllers\Api\V1;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\Queue;
use App\Utils\GithubImporter;
use App\Models\GithubUser;
use App\Jobs\GithubImporterJob;

class GithubUserRepositoryController extends Controller
{
    public function getUserRepositories(string $githubUser): object
    {
        $data = GithubUser::with('repositories')
            ->whereLogin($githubUser)
            ->first();

        if (empty($data)) {
            $github = new GithubImporter($githubUser);
            $data = $github->getUser();
            $data['repositories'] = $github->getRepositories();

            Queue::push(new GithubImporterJob($githubUser));
        }

        return response()->json($data);
    }
}