<?php

namespace Ensphere\Gnaw\Console\Commands;

use Ensphere\Gnaw\Contracts\Helpers;
use Ensphere\Gnaw\Contracts\Resets;
use Ensphere\Gnaw\Contracts\Utilities;
use Ensphere\Gnaw\Contracts\Base;
use Ensphere\Gnaw\PCSSBuilder;
use Ensphere\Gnaw\PCSSFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
        Resets::class,
        Base::class,
        Helpers::class,
        Utilities::class,
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
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gnaw';

    /**
     * @var array
     */
    protected $replacements = [];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a single .css utility file';

    /**
     * @var string
     */
    protected $content = '';

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
        foreach( $this->contracts as $contract ) {
            app()->singleton( $this->blueprint, $contract );
            $PCSSBuilder = app( $this->blueprint );
            $this->replacements = array_merge( $this->replacements, $PCSSBuilder->getReplacements() );
            $this->files = array_merge( $this->files, $PCSSBuilder->generateFiles() );
        }
        foreach( $this->files as $file ) {
            $this->distributeFiles( $file );
        }
        Storage::disk( $this->postCssDisk )->put( "gnaw.css", $this->content );
        $this->info( "gnaw.css generated!" );
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
     * @param PCSSFile $file
     * @return void
     */
    protected function distributeFiles( PCSSFile $file )
    {
        if( ! $file->isConfigFile() ) {
            $file->replace( $this->replacements );
            //$this->content .= $file->content();
            $this->content .= preg_replace( "/\s*\n\s*/", "", $file->content() );
        }
    }

}
