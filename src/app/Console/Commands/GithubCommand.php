<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utils\GithubImporter;

class GithubCommand extends Command
{
    protected $signature = 'github:import [{--user=?}]';
    protected $description = 'Github import user & repositories';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $githubUser = ($this->option('user') == '?') ? $this->ask('Github User') : $this->option('user');

        $github = new GithubImporter($githubUser);
        $import = $github->import();
        $user = $import['user'];
        $repositories = $import['repositories'];

        $this->newLine();
        $this->table(
            ['user', 'name', 'email', 'url'],
            [
                [
                    $user['login'],
                    $user['name'],
                    $user['email'],
                    $user['url'],
                ]
            ],
        );

        $this->newLine();
        $this->line('Has been imported '.count($repositories).' repositories.');
        $this->newLine();
    }
}
