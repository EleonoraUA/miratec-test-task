<?php

class View
{

    function generate($content_view, $template_view = null, $data = null)
    {
        include 'views/' . $template_view;
        include 'views/' . $content_view;
        include 'views/script.html';
    }
}

?>
