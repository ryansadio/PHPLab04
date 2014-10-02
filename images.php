<?php
/**
 * Created by PhpStorm.
 * User: Edwin, Ryan
 * Date: 29/09/2014
 * Time: 11:16 AM
 */
$imageFiles[] = array();

/**
 * Returns all files (incl. path) contained within a directory
 * and all it's subdirectory.
 * A recursive function that calls itself when
 * entering another folder.
 * @param $imageFiles Array containing paths of files
 * @return array Array containing paths of files
 */
function listFolderFiles( $dir, &$imageFiles )
{
    $folderFiles = scandir( $dir );
    foreach ( $folderFiles as $folderFile ) {
        // Disregard current directory and 'up' directory
        if ( $folderFile != '.' && $folderFile != '..' ) {
            // Add  file path, name, and extension to the array
            // excluding folders
            if ( !is_dir( $dir . '/' . $folderFile ) )
                $imageFiles[] = $dir . '/' . $folderFile;
            else
                listFolderFiles( $dir . '/' . $folderFile, $imageFiles );
        }
    }
    return $imageFiles;
}

/**
 * @param $imageFiles
 */
function FilterFileList( $imageFiles )
{
    $targetFiles = array();
    $imgExt = "/.*\\.(jpg|jpeg|png|gif|bmp|tif|tiff)/i";
    foreach ( $imageFiles as $imageFile ) {
        if( !is_array( $imageFile ) && preg_match( $imgExt, $imageFile ) ) {
            $targetFiles[] = $imageFile;
            echo ' <img src=" ' . $imageFile . ' " width="400"/><br />';
        }
    }
/*    var_dump( $targetFiles );*/
}

$fileList = listFolderFiles( 'images', $imageFiles );
$filteredFileList = FilterFileList( $imageFiles );