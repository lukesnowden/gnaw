<?php

namespace Ensphere\Gnaw\Contracts;

use Ensphere\Gnaw\Generators\Base\Code;
use Ensphere\Gnaw\Generators\Base\Container;
use Ensphere\Gnaw\Generators\Base\Forms;
use Ensphere\Gnaw\Generators\Base\Images;
use Ensphere\Gnaw\Generators\Base\Lists;
use Ensphere\Gnaw\Generators\Base\Page;
use Ensphere\Gnaw\Generators\Base\Tables;
use Ensphere\Gnaw\Generators\Base\Text;
use Ensphere\Gnaw\PCSSBuilder;

class Base implements PCSSBuilder
{

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var array
     */
    protected $generators = [
        Code::class,
        Container::class,
        Forms::class,
        Images::class,
        Lists::class,
        Page::class,
        Tables::class,
        Text::class
    ];

    /**
     * @return array
     */
    public function generateFiles(): array
    {
        foreach( $this->generators as $generator ) {
            $this->gnawFile( ( new $generator )->generate() );
        }
        return $this->files;
    }

    /**
     * @param GnawFile $file
     */
    private function gnawFile( GnawFile $file )
    {
        $this->files[] = $file;
    }

    /**
     * @return array
     */
    public function getReplacements(): array
    {
        return [
            '$heading--color' => gnaw_config( 'gnaw.text.color' ),
            '$font-size' => gnaw_config( 'gnaw.text.font-size' ) . 'px',
            '$font-color' => gnaw_config( 'gnaw.text.color' ),
            '$font-family' => gnaw_config( 'gnaw.text.font-family' ),
            '$line-height' => line_height( 'gnaw.text.font-size' ),

            '$heading--very-large-font-size' => gnaw_config( 'gnaw.text.headings.very-large.font-size' ) . 'px',
            '$heading--very-large-line-height' => line_height( 'gnaw.text.headings.very-large.font-size' ),
            '$heading--large-font-size' => gnaw_config( 'gnaw.text.headings.large.font-size' ) . 'px',
            '$heading--large-line-height' => line_height( 'gnaw.text.headings.large.font-size' ),
            '$heading--medium-font-size' => gnaw_config( 'gnaw.text.headings.medium.font-size' ) . 'px',
            '$heading--medium-line-height' => line_height( 'gnaw.text.headings.medium.font-size' ),
            '$heading--small-font-size' => gnaw_config( 'gnaw.text.headings.small.font-size' ) . 'px',
            '$heading--small-line-height' => line_height( 'gnaw.text.headings.small.font-size' ),
            '$heading--very-small-font-size' => gnaw_config( 'gnaw.text.headings.very-small.font-size' ) . 'px',
            '$heading--very-small-line-height' => line_height( 'gnaw.text.headings.very-small.font-size' ),
            '$heading--font-family' => gnaw_config( 'gnaw.text.font-family' ),
            '$heading--spacing' => gnaw_config( 'gnaw.text.headings.spacing' ) . 'px',

            '$anchor--color' => gnaw_config( 'gnaw.text.anchors.color' ),
            '$anchor--transition' => config( 'gnaw.text.anchors.transition' ),
            '$anchor--hover-color' => gnaw_config( 'gnaw.text.anchors.hover-color' ),

            '$space--very-large' => gnaw_config( 'gnaw.spacing.very-large' ) . 'px',
            '$space--large' => gnaw_config( 'gnaw.spacing.large' ) . 'px',
            '$space--medium' => gnaw_config( 'gnaw.spacing.medium' ) . 'px',
            '$space--small' => gnaw_config( 'gnaw.spacing.small' ) . 'px',
            '$space--very-small' => gnaw_config( 'gnaw.spacing.very-small' ) . 'px',
            
            '$form--border-color' => gnaw_config( 'gnaw.form.border-color' ),
            '$form--border-radius' => gnaw_config( 'gnaw.form.border-radius' ) . 'px',
            '$form--color' => gnaw_config( 'gnaw.form.color' ),
            '$form--font-size' => gnaw_config( 'gnaw.form.font-size' ) . 'px',
            '$form--line-height' => line_height( 'gnaw.form.font-size' ),

            '$table--border-width' => gnaw_config( 'gnaw.table.border-width' ) . 'px',
            '$table--border-color' => gnaw_config( 'gnaw.table.border-color' ),
            '$table--border-style' => gnaw_config( 'gnaw.table.border-style' ),
            '/** GNAW[container-sizes] **/' => $this->containerSizes(),
            '$container--default-padding' => gnaw_config( 'gnaw.container.default-padding' ) . 'px'
            
        ];
    }

    /**
     * @return string
     */
    protected function containerSizes(): string
    {
        $css = '';
        foreach( config( 'gnaw.container.sizes' ) as $name => $details ) {
            $width = ! $details['width'] ? '100%' : $details['width'] . 'px';

            $css .= "@media(min-width: {$details['break_point']}px) {\n";
            $css .= "   .container {\n";
            $css .= "       width: {$width};\n";
            $css .= "       max-width: 100%;\n";
            $css .= "       padding-left: {$details['padding']}px;\n";
            $css .= "       padding-right: {$details['padding']}px;\n";
            $css .= "   }\n";
            $css .= "}\n";
        }
        return $css;
    }

}
