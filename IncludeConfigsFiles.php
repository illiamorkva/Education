<?php
function includeFiles()
{
    $configs = array();
    $env = getenv('CONFIG');

    if(isset($env) && !empty($env)) {

        switch (getenv('CONFIG')) {
            case DEVELOP:
                $configs = includeFileFromPath('./config/default');
                $configs = includeFileFromPath('./config/development');
                break;
            case PROD:
                $configs = includeFileFromPath('./config/production');
                break;
        }
    }
    else {
        $configs = includeFileFromPath('./config/default');
    }

    return $configs;
}

function includeFileFromPath($pathToFiles)
{
    $files = array();
    if (is_dir($pathToFiles)) {
        if ($handle = opendir($pathToFiles)) {
            while (false !== ($file = readdir($handle))) {
                if($file != "." && $file !="..") {
                    $fileName = $pathToFiles . '/' . $file;
                    $files[$file] = getFile($fileName);
                }
            }
        }
    }
    return $files;
}

function getFile($filePath)
{
    return include_once $filePath;
}