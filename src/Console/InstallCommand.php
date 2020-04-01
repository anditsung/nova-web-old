<?php

namespace Anditsung\NovaWeb\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = "novaweb:install";

    protected $description = "Install novaweb to nova";

    public function handle()
    {
        $this->comment('Publishing novaweb');
        $this->call('novaweb:publish', ['--force' => true]);

        $this->info('Novaweb scaffolding installed successfully.');
    }
}
