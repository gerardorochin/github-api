<?php

namespace App\Http\Controllers\Api\V1;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\Queue;
use App\Utils\GithubImporter;
use App\Models\GithubUser;
use App\Jobs\GithubImporterJob;

class GithubUserController extends Controller
{
    public function getUsers(): object
    {
        $users = GithubUser::get();

        return response()->json($users);
    }

    public function getUser(string $githubUser): object
    {
        $user = GithubUser::where('login', $githubUser)->get();

        if ($user->isEmpty()) {
            $github = new GithubImporter($githubUser);
            $user[] = $github->getUser();

            Queue::push(new GithubImporterJob($githubUser));
        }

        return response()->json($user);
    }
}