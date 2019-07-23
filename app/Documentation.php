<?php

namespace App;

use File;
use Parsedown;
use Exception;

class Documentation{

    public function get($version, $page, $basePath = null)
    {
        //dd($this->markdownPath($version, $page, $basePath));
        if(File::exists($page = $this->markdownPath($version, $page, $basePath)))
        {
            $content = File::get($page);
    
            return $this->replaceLinks($version, (new Parsedown)->text($content));
        }

        throw new Exception('The requested doc not found');
    }

    public function markdownPath($version, $page, $basePath = null)
    {
        $basePath = $basePath ?? resource_path();

        return $basePath . '/docs/'.$version.'/'.$page.'.md';

    }

    public static function versions()
    {
        return [
            1.0,
            1.1
        ];
    }

    protected function replaceLinks($version, $content)
    {
        return str_replace('{{version}}', $version, $content);
    }

}