<?php

namespace Ensphere\Gnaw\Console\Commands;

use Ensphere\Gnaw\Contracts\Utilities;
use Ensphere\Gnaw\PCSSBuilder;
use Ensphere\Gnaw\PCSSFile;
use Illuminate\Console\Command;

class FrontDevBuilder extends Command
{

    /**
     * @var string
     */
    protected $blueprint = PCSSBuilder::class;

    /**
     * @var array
     */
    protected $contracts = [
        Utilities::class
    ];

    /**
     * @var string
     */
    protected $postCssDisk = 'post-css';

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var bool
     */
    protected $distributeConfig = false;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gnaw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a Post CSS Utility File';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->checkStorageDisk();
        $this->configGenerate();
        foreach( $this->contracts as $contract ) {
            app()->singleton( $this->blueprint, $contract );
            $PCSSBuilder = app( $this->blueprint );
            $this->files = array_merge( $this->files, $PCSSBuilder->generateFiles() );
        }
        foreach( $this->files as $file ) {
            $this->distributeFiles( $file );
        }
    }

    /**
     * @return void
     */
    protected function checkStorageDisk()
    {
        if( ! config( "filesystems.disks.{$this->postCssDisk}" ) ) {
            $this->error( "Disk [{$this->postCssDisk}] not set in config. See readme for more info" );
            exit;
        }
    }

    /**
     * @return void
     */
    protected function configGenerate()
    {
        $this->distributeConfig = $this->confirm( "Do you want to generate the config files? This will overwrite previous generated config files" );
    }

    /**
     * @param PCSSFile $file
     * @return void
     */
    protected function distributeFiles( PCSSFile $file )
    {
        if( ( $file->isConfigFile() && $this->distributeConfig ) || ! $file->isConfigFile() ) {
            $file->distribute();
        }
    }

}
