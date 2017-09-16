<?php

/**
 *  * return file size
 *   *
 *    * @param $bytes
 *     * @param int $decimals
 *      * @return string
 *       */
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

/**
 *  * judge file MIME type is image
 *   *
 *    * @param $mimeType
 *     * @return bool
 *      */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}
