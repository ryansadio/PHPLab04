<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Lab04 - View Images</title>
</head>
<body>

<?php

function readMyTags ($path, $name, $text_Input)
{
    $file = 'images.txt';
    // Open the file to get existing content
    $current = file_get_contents($file);
    // Append a new record to the file
    $current .= "$path\t$name\t$text_Input\n";
    // Write the contents back to the file
    file_put_contents($file, $current);
}

function isInFile ($theUnknown)
{
    $file = 'images.txt';
    if( strpos(file_get_contents($file),$theUnknown) !== false)
        return true; // somewhere in the file
    else return false;
}

function openMyTags () {
    $row = 1;
    if (($handle = fopen( "images.txt", "r" )) !== FALSE) {
        while (($data = fgetcsv( $handle, 1000, "	" )) !== FALSE) {
            $num = count( $data );
            echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c = 0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
            }
        }
        fclose($handle);
    }
}

openMyTags();

?>

<div id="photo" class=""></div>
<style>
    #photo { background-image: url(<?php echo $photo;?>); }
</style>
<button id="next" class="">Next</button>

</body>
</html>
