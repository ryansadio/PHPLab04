<?php
/**
 * Created by PhpStorm.
 * User: Edwin, Ryan
 * Date: 29/09/2014
 * Time: 11:16 AM
 */
$imageFiles[] = array();
$textFileName = "images.txt";

/**
 * Returns all files (incl. path) contained within a directory
 * and all it's subdirectory.
 * A recursive function that calls itself when
 * entering another folder.
 * @param $currDir current directory to scan
 * @param $imageFiles Array containing paths of files
 * @return array Array containing paths of files
 */
function listFolderFiles( $currDir, &$imageFiles )
{
    $folderFiles = scandir( $currDir );
    foreach ( $folderFiles as $folderFile ) {
        // Disregard current directory and 'up' directory
        if ( $folderFile != '.' && $folderFile != '..' ) {
            // Add  file path, name, and extension to the array
            // excluding folders
            if ( !is_dir( $currDir . '/' . $folderFile ) )
                $imageFiles[] = $currDir . '/' . $folderFile;
            else
                listFolderFiles( $currDir . '/' . $folderFile, $imageFiles );
        }
    }
    return $imageFiles;
}

/**
 * @param $imageFiles
 * @return array filtered list of images
 */
function FilterFileList( $imageFiles )
{
    $targetFiles = array();
    $imgExt = "/.*\\.(jpg|jpeg|png|gif|bmp|tif|tiff)/i";
    foreach ( $imageFiles as $imageFile )
        if( !is_array( $imageFile ) && preg_match( $imgExt, $imageFile ) )
            $targetFiles[] = $imageFile;
    return $targetFiles;
}

$filteredFileList = FilterFileList( listFolderFiles( $dir, $imageFiles ) );
$_SESSION['TaggedImages'] = $filteredFileList;
WriteTaggedImagesToFile($textFileName);

/* Show image and ask for input */
foreach ($filteredFileList as $photo) {
    echo ' <img src=" ' . $photo . ' " width="400"/><br />';
}

function WriteTaggedImagesToFile($textFileName) {
    $fp = fopen($textFileName, 'a+') or die("Cannot open file.");
    fwrite($textFileName, $_SESSION['TaggedImages']);
    fclose($fp);
}

/* TODO: come back later. This is to read from file.
 * ReadTextFile($textFileName);

function ReadTextFile( $textFileName ) {
    $fp = fopen($textFileName, 'a+') or die("Cannot open file.");
    //Create array to hold temporary tagged images and their path
    $tempImagePaths = array();
    $tempImageFiles = array();

}*/