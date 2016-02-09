<?php

class View
{

    function generate($content_view, $data = null)
    {
        include 'views/' . $content_view;
    }
}

?>
