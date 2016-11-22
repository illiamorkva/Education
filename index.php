<?php
$header = template('header', ['title' => 'Hello World!']);
$content = template('content', ['content' => "Lorem ipsum...", 'meta' => 'Author info']);
$footer = template('footer', ['copy' => "Copyright ". date('Y')]);


echo $header, $content, $footer;

/**
* @param  string $template
* @param  array  $vars
* @return string
*/
function template($template, $vars)
{
    ob_start();
    {
        foreach ($vars as $tag => $value) {
            $$tag = $value;
        }
        include_once './template/' . $template . '.phtml';
    }
   return ob_get_clean();
}
