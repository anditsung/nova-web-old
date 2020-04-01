<?php


namespace Anditsung\NovaWeb\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class PublishCommand extends Command
{

    protected $signature = "novaweb:publish {--force : Overwrite any existing files}";

    protected $description = 'Publish all of the novaweb resources';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'novaweb-config',
            '--force' => $this->option('force'),
        ]);

//        $this->call('vendor:publish', [
//            '--tag' => 'novaweb-views',
//            '--force' => $this->option('force'),
//        ]);
//
//        $this->call('vendor:publish', [
//            '--tag' => 'novaweb-fonts',
//            '--force' => $this->options('force'),
//        ]);

        $this->call('vendor:publish', [
            '--tag' => 'novaweb-resources',
            '--force' => $this->options('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'novaweb-tailwind',
            '--force' => $this->options('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'novaweb-webpack',
            '--force' => $this->options('force'),
        ]);

        $this->comment("Installing Tailwindcss");
        $this->installTailwindcss();
        $this->comment("Done install tailwindcss");

        $this->comment("Compiling asset");
        $this->compile();
        $this->comment("Done compile asset");

//        if ($this->confirm("Would you like to compile the asset's assets?", true)) {
//            $this->compile();
//
//            $this->output->newLine();
//        }

        $this->call('view:clear');

        //exec('npm run prod');
    }

    protected function installTailwindcss()
    {
        $this->executeCommand("npm install tailwindcss");
    }

    /**
     * Compile the asset's assets.
     *
     * @return void
     */
    protected function compile()
    {
        $this->executeCommand('npm run prod');
    }

    /**
     * Run the given command as a process.
     *
     * @param  string  $command
     * @param  string  $path
     * @return void
     */
    protected function executeCommand($command)
    {
        $process = (new Process($command))->setTimeout(null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $process->run(function ($type, $line) {
            $this->output->write($line);
        });
    }
}
