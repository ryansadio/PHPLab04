<?php
/**
 * Created by PhpStorm.
 * User: Edwin, Ryan
 * Date: 29/09/2014
 * Time: 11:13 AM
 */
$dir = './images';
if (file_exists($dir)) {
    require_once 'images.php';
}
else {
    echo "there are no images";
}
