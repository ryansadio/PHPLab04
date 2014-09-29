<?php
/**
 * Created by PhpStorm.
 * User: Edwin, Ryan
 * Date: 29/09/2014
 * Time: 11:16 AM
 */
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
    $targetFiles = array();
    $imgExt = "/^.*\\.(jpg|jpeg|png|gif|bmp|tif|tiff)&/i";
    foreach ($imageFiles as $imageFile) {
        if(preg_match($imgExt, $imageFile)) {
            $targetFiles[] = $imageFile;
        }
    }
    var_dump($targetFiles);
}

$fileList = listFolderFiles('./images', $imageFiles);
$filteredFileList = FilterFileList($imageFiles);