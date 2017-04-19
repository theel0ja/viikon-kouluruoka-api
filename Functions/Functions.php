<?php
    function downloadData($url) {
        $data = file_get_contents($url);
        return $data;
    }

    function error500($errorText = "Error") { # TODO: i8n for "Error"
        header("HTTP/1.1 500 Internal Server Error");
        
        die($errorText);
    }