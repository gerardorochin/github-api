<?php

namespace App\Jobs;
use App\Utils\GithubImporter;

class GithubImporterJob extends Job
{
    public $githubUser;

    public function __construct(string $githubUser)
    {
        $this->githubUser = $githubUser;
    }

    public function handle()
    {
        $github = new GithubImporter($this->githubUser);
        $import = $github->import();
    }
}