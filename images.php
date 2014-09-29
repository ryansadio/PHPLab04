<?php
/**
 * Created by PhpStorm.
 * User: Edwin, Ryan
 * Date: 29/09/2014
 * Time: 11:16 AM
 */
$ImageDir = './images/';
$CurrentDirArray = scandir($ImageDir);
$dir = array();
$files = array();

foreach ($CurrentDirArray as $dir) {
    echo "\n<br>";
    var_dump($dir);
}

function listFolderFiles($dir)
{
    $folderFiles = scandir($dir);
    echo '<ol>';
    foreach ($folderFiles as $folderFile) {
        if ($folderFile != '.' && $folderFile != '..') {
            echo '<li>' . $folderFile;
            if (is_dir($dir . '/' . $folderFile))
                listFolderFiles($dir . '/' . $folderFile);
            echo '</li>';
        }
    }
    echo '</ol>';
}

listFolderFiles($ImageDir);

$imgFmt = "/^$/";
