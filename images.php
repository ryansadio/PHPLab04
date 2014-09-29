<?php
/**
 * Created by PhpStorm.
 * User: Edwin, Ryan
 * Date: 29/09/2014
 * Time: 11:16 AM
 */
$ImageExtensions = [".jpg", ".jpeg", ".png", ".gif", ".bmp", ".tif", ".tiff"];
$imageFiles[] = array();

function listFolderFiles($dir, &$imageFiles)
{
    $folderFiles = scandir($dir);
    echo '<ol>';
    foreach ($folderFiles as $folderFile) {
        if ($folderFile != '.' && $folderFile != '..') {
            echo '<li>' . $folderFile;
            if (!is_dir($dir . '/' . $folderFile)) {
                $imageFiles[] = $folderFile;
            } else {
                listFolderFiles($dir . '/' . $folderFile, $imageFiles);
            }
            echo '</li>';
        }
    }
    echo '</ol>';
    return $imageFiles;
}

function FilterFileList($imageFiles)
{

    var_dump($imageFiles);
}

$fileList = listFolderFiles('./images', $imageFiles);
$filteredFileList = FilterFileList($imageFiles);