<?php


namespace Ensphere\Gnaw\Contracts;


use Ensphere\Gnaw\PCSSBuilder;

class Base implements PCSSBuilder
{

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var string
     */
    protected $route = __DIR__ . '/../../resources/pcss/base/';

    /**
     * @return array
     */
    public function generateFiles(): array
    {
        $this->files[] = $this->textFile();
        $this->files[] = $this->formsFile();
        $this->files[] = $this->codeFile();
        $this->files[] = $this->imageFile();
        $this->files[] = $this->tablesFile();
        $this->files[] = $this->containerFile();
        $this->files[] = $this->pageFile();
        $this->files[] = $this->listsFile();
        return $this->files;
    }

    /**
     * @return GnawFile
     */
    protected function textFile(): GnawFile
    {
        $file = new GnawFile();
        $file->filename( 'text.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}text.pcss" ) );
        return $file;
    }

    /**
     * @return GnawFile
     */
    protected function formsFile(): GnawFile
    {
        $file = new GnawFile();
        $file->filename( 'forms.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}forms.pcss" ) );
        return $file;
    }

    /**
     * @return GnawFile
     */
    protected function imageFile(): GnawFile
    {
        $file = new GnawFile();
        $file->filename( 'images.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}images.pcss" ) );
        return $file;
    }

    /**
     * @return GnawFile
     */
    protected function codeFile(): GnawFile
    {
        $file = new GnawFile();
        $file->filename( 'code.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}code.pcss" ) );
        return $file;
    }

    /**
     * @return GnawFile
     */
    protected function tablesFile(): GnawFile
    {
        $file = new GnawFile();
        $file->filename( 'tables.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}tables.pcss" ) );
        return $file;
    }

    /**
     * @return GnawFile
     */
    protected function containerFile(): GnawFile
    {
        $file = new GnawFile();
        $file->filename( 'container.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}container.pcss" ) );
        return $file;
    }

    /**
     * @return GnawFile
     */
    protected function pageFile(): GnawFile
    {
        $file = new GnawFile();
        $file->filename( 'page.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}page.pcss" ) );
        return $file;
    }

    /**
     * @return GnawFile
     */
    protected function listsFile(): GnawFile
    {
        $file = new GnawFile();
        $file->filename( 'lists.pcss' );
        $file->path( 'base' );
        $file->content( file_get_contents( "{$this->route}lists.pcss" ) );
        return $file;
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
            '$line-height' => line_height( 'gnaw.text.font-size', 'gnaw.text.line-height-percentage' ),

            '$heading--very-large-font-size' => gnaw_config( 'gnaw.text.headings.very-large.font-size' ) . 'px',
            '$heading--very-large-line-height' => line_height( 'gnaw.text.headings.very-large.font-size', 'gnaw.text.line-height-percentage' ),
            '$heading--large-font-size' => gnaw_config( 'gnaw.text.headings.large.font-size' ) . 'px',
            '$heading--large-line-height' => line_height( 'gnaw.text.headings.large.font-size', 'gnaw.text.line-height-percentage' ),
            '$heading--medium-font-size' => gnaw_config( 'gnaw.text.headings.medium.font-size' ) . 'px',
            '$heading--medium-line-height' => line_height( 'gnaw.text.headings.medium.font-size', 'gnaw.text.line-height-percentage' ),
            '$heading--small-font-size' => gnaw_config( 'gnaw.text.headings.small.font-size' ) . 'px',
            '$heading--small-line-height' => line_height( 'gnaw.text.headings.small.font-size', 'gnaw.text.line-height-percentage' ),
            '$heading--very-small-font-size' => gnaw_config( 'gnaw.text.headings.very-small.font-size' ) . 'px',
            '$heading--very-small-line-height' => line_height( 'gnaw.text.headings.very-small.font-size', 'gnaw.text.line-height-percentage' ),
            '$heading--font-family' => gnaw_config( 'gnaw.text.font-family' ),
            '$heading--spacing' => gnaw_config( 'gnaw.text.headings.spacing' ) . 'px',

            '$anchor--color' => gnaw_config( 'gnaw.text.anchors.color' ),
            '$anchor--hover-color' => gnaw_config( 'gnaw.text.anchors.hover-color' ),

            '$space--very-large' => gnaw_config( 'gnaw.spacing.very-large' ) . 'px',
            '$space--large' => gnaw_config( 'gnaw.spacing.large' ) . 'px',
            '$space--medium' => gnaw_config( 'gnaw.spacing.medium' ) . 'px',
            '$space--small' => gnaw_config( 'gnaw.spacing.small' ) . 'px',
            '$space--very-small' => gnaw_config( 'gnaw.spacing.small' ) . 'px',
            
            '$form--border-color' => gnaw_config( 'gnaw.form.border-color' ),
            '$form--border-radius' => gnaw_config( 'gnaw.form.border-radius' ) . 'px',
            '$form--color' => gnaw_config( 'gnaw.form.color' ),
            '$form--font-size' => gnaw_config( 'gnaw.form.font-size' ) . 'px',
            '$form--line-height' => line_height( 'gnaw.form.font-size', 'gnaw.text.line-height-percentage' ),

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
            $css .= "@media(min-width: {$details['size']}px) {\n";
            $css .= "   .container {\n";
            $css .= "       max-width: {$details['size']}px;\n";
            $css .= "       padding-left: {$details['padding']}px;\n";
            $css .= "       padding-right: {$details['padding']}px;\n";
            $css .= "   }\n";
            $css .= "}\n";
        }
        return $css;
    }


}
