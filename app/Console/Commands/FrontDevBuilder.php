<?php

namespace Ensphere\Gnaw\Console\Commands;

use Ensphere\Gnaw\Contracts\Utilities;
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
     * @var string
     */
    protected $return = '';

    /**
     * @var string
     */
    protected $config = '';

    /**
     * @var int
     */
    protected $baseUnit = 16;

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
        //$this->spacing();
        //$this->colours();
        //$this->columns();
        //$this->helpers();
        //Storage::disk( 'css' )->put( 'utilities/settings.pcss', $this->return );
        ////Storage::disk( 'css' )->put( 'utilities/config.pcss', $this->config );
        //$this->info('saved...');
    }

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

    protected function spacing()
    {
        $types = [ 'padding', 'margin' ];
        $positions = [ 'top', 'bottom', 'left', 'right' ];

        foreach( $this->sizes as $name => $value ) {
            $this->config .= '$space--' . "{$name}: " . ( $this->baseUnit * $value ) . "px;\n";
        }
        $this->config .= "\n";

        foreach( $types as $type ) {
            foreach( $this->sizes as $name => $value ) {
                $this->return .= '.' . $type . '\:' . $name . " {\n";
                $this->return .= "\t{$type}: " . '$space--' . "{$name};\n";
                $this->return .= "}\n";
                $this->return .= '.' . $type . '-y-axis\:' . $name . " {\n";
                $this->return .= "\t{$type}-top: " . '$space--' . "{$name};\n";
                $this->return .= "\t{$type}-bottom: " . '$space--' . "{$name};\n";
                $this->return .= "}\n";
                $this->return .= '.' . $type . '-x-axis\:' . $name . " {\n";
                $this->return .= "\t{$type}-left: " . '$space--' . "{$name};\n";
                $this->return .= "\t{$type}-right: " . '$space--' . "{$name};\n";
                $this->return .= "}\n";
                foreach( $positions as $position ) {
                    $this->return .= '.' . $type . '-' . $position . '\:' . $name . " {\n";
                    $this->return .= "\t{$type}-{$position}: " . '$space--' . "{$name};\n";
                    $this->return .= "}\n";
                }
                foreach( $this->medias as $media ) {
                    $this->return .= "@media (--{$media}){\n";
                    $this->return .= ".{$media}-" . $type . '\:' . $name . " {\n";
                    $this->return .= "\t{$type}: " . '$space--' . "{$name};\n";
                    $this->return .= "}\n";
                    $this->return .= ".{$media}-" . $type . '-y-axis\:' . $name . " {\n";
                    $this->return .= "\t{$type}-top: " . '$space--' . "{$name};\n";
                    $this->return .= "\t{$type}-bottom: " . '$space--' . "{$name};\n";
                    $this->return .= "}\n";
                    $this->return .= ".{$media}-" . $type . '-x-axis\:' . $name . " {\n";
                    $this->return .= "\t{$type}-left: " . '$space--' . "{$name};\n";
                    $this->return .= "\t{$type}-right: " . '$space--' . "{$name};\n";
                    $this->return .= "}\n";
                    foreach( $positions as $position ) {
                        $this->return .= ".{$media}-" . $type . '-' . $position . '\:' . $name . " {\n";
                        $this->return .= "\t{$type}-{$position}: " . '$space--' . "{$name};\n";
                        $this->return .= "}\n";
                    }
                    $this->return .= "}\n";
                }
            }
        }
    }

    protected function columns()
    {
        $this->return .= ".col\:full-width {\n";
        $this->return .= "\tlost-column: 1/1;\n";
        $this->return .= "}\n";

        $maxColumns = [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ];
        while( $maxColumns ) {
            $count = array_shift( $maxColumns );
            for( $x = 1; $x < $count; $x++ ) {
                $this->return .= '.col\:' . $x . "-of-" . $count . " {\n";
                $this->return .= "\tlost-column: {$x}/{$count};\n";
                $this->return .= "}\n";
            }
        }

        foreach( $this->medias as $media ) {
            $maxColumns = [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ];
            $this->return .= "@media (--{$media}){\n";
            $this->return .= ".{$media}-col\:full-width {\n";
            $this->return .= "\tlost-column: 1/1;\n";
            $this->return .= "}\n";
            while( $maxColumns ) {
                $count = array_shift( $maxColumns );
                for( $x = 1; $x < $count; $x++ ) {
                    $this->return .= ".{$media}-col\:" . $x . "-of-" . $count . " {\n";
                    $this->return .= "\tlost-column: {$x}/{$count};\n";
                    $this->return .= "}\n";
                }
            }
            $this->return .= "}\n";
        }
    }

    /**
     * @return void
     */
    protected function helpers()
    {
        $this->_helpers();
        foreach( $this->medias as $media ) {
            $this->return .= "@media (--{$media}){\n";
            $this->_helpers( "{$media}-" );
            $this->return .= "}\n";
        }
    }

    /**
     * @param string $prefix
     * @return void
     */
    public function _helpers( $prefix = '' )
    {
        $this->return .= ".{$prefix}full-width { width:100%; max-width:100%; }";
        $this->return .= ".{$prefix}not-a-list { list-style: none; margin: 0; padding: 0; }";
        $this->return .= ".{$prefix}float\:left { float:left; }";
        $this->return .= ".{$prefix}float\:right { float:right; }";
        $this->return .= ".{$prefix}children\:same-height { display: flex; > * { flex: 1 1 auto; } }";
        $this->return .= ".{$prefix}child\:vertically-aligned { position:relative; > * { position:relative; top: 50%; transform: translateY(-50%); } }";
    }

}
