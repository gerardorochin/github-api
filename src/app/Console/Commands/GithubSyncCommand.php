<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utils\GithubImporter;
use App\Models\GithubUser;

class GithubSyncCommand extends Command
{
    protected $signature = 'github:sync';
    protected $description = 'Github sync all user & repositories on database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $githubUsers = GithubUser::all();
        $this->newLine();
        $this->line('Sync users:');
        foreach ($githubUsers as $githubUser) {
            $github = new GithubImporter($githubUser->login);
            $import = $github->import();
            $this->line('.. '.$githubUser->login);
        }

        $this->newLine();
    }
}