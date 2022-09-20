<?php
if (! function_exists('isImage')) {
    function isImage( string $type )
    {
        return substr( $type, 0, 5 ) == 'image';
    }
}