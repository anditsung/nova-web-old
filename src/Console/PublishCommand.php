<?php


namespace Anditsung\NovaWeb\Console;


use Illuminate\Console\Command;
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

        $this->call('vendor:publish', [
            '--tag' => 'novaweb-resources',
            '--force' => $this->options('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'novaweb-webpack',
            '--force' => $this->options('force'),
        ]);

        $this->comment("Installing Vue");
        $this->installVue();
        $this->comment("Done Install Vue");

        $this->comment("Installing Tailwind 0.6.0");
        $this->call('vendor:publish', [
            '--tag' => 'novaweb-novatailwind',
            '--force' => $this->options('force'),
        ]);
        $this->call('vendor:publish', [
            '--tag' => 'novaweb-cssnovatailwind',
            '--force' => $this->options('force'),
        ]);
        $this->installNovaTailwind();
        $this->comment("Done install nova tailwind");
        // changing to tailwind ^1 will break all ui cause changing some name on tailwind ^1

//        if($this->confirm("Use nova tailwind?", true)) {
//            $this->comment("Installing Tailwind 0.6.0");
//            $this->call('vendor:publish', [
//                '--tag' => 'novaweb-novatailwind',
//                '--force' => $this->options('force'),
//            ]);
//            $this->call('vendor:publish', [
//                '--tag' => 'novaweb-cssnovatailwind',
//                '--force' => $this->options('force'),
//            ]);
//            $this->installNovaTailwind();
//            $this->comment("Done install nova tailwind");
//        }
//        else {
//            $this->comment("Installing Tailwind ^1");
//            $this->call('vendor:publish', [
//                '--tag' => 'novaweb-tailwind',
//                '--force' => $this->options('force'),
//            ]);
//            $this->call('vendor:publish', [
//                '--tag' => 'novaweb-csstailwind',
//                '--force' => $this->options('force'),
//            ]);
//            $this->installTailwind();
//            $this->comment("Done install tailwind");
//        }

        $this->comment("Compiling asset");
        $this->compile();
        $this->comment("Done compile asset");

        $this->call('view:clear');
    }

    protected function installVue()
    {
        $this->executeCommand("npm install vue");
    }

    protected function installNovaTailwind()
    {
        // laravel nova masih memakai versi 0.6.0 jika di upgrade maka tidak bisa compile
        $this->executeCommand("npm install tailwindcss@0.6.0");
    }

    protected function installTailwind()
    {
        // install latest tailwind
        $this->executeCommand("npm install tailwindcss@^1");
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
