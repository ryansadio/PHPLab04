<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>PHP - Lab04</title>
</head>
<body>

<div id="photo" class="">Hello</div>
<style>
    #photo { background-image: url(<?php echo $photo;?>); }
</style>

<?php
/**
 * Created by PhpStorm.
 * User: Edwin, Ryan
 * Date: 29/09/2014
 * Time: 11:13 AM
 */
$dir = 'images';
if (file_exists($dir)) {
    require_once 'images.php';
}
else {
    echo "there are no images";
}


?>
</body>
</html>
