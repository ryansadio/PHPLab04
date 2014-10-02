<?php
/* GLOBALS */
$imageFiles[] = array();

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


function appendToFile($path, $name, $text_Input)
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
?>


<?php
$filteredFileList = FilterFileList( listFolderFiles( $dir, $imageFiles ) );

// Create array of UntaggedImages from directory and cross check
$theUntagged = array();
// For each item not in the file, add to theUntagged
foreach ($filteredFileList as $theUnknown) {
    if ( !isInFile(dirname($theUnknown) . "\t" . basename($theUnknown)) ) {
        $theUntagged[] = $theUnknown; // Add to theUntagged
    }
}

if ( !empty($theUntagged) ) {
    echo ' <img src=" ' . $theUntagged[0] . ' " width="400"/><br />';
    $theUntaggedString = (string)$theUntagged[0];
    $path = dirname($theUntaggedString);
    $name = basename($theUntaggedString);
    ?>

    <form class="" id="" action="index.php" method="post">
        <input type="text" name="path" value="/">
        <input type="hidden" name="name" value="<?php echo "$name"; ?>">
        <input type="text" id="humanInput" name="humanInput" aria-label="people" placeholder="people" width="700px">
        <input type="submit" value="Save">
    </form>


<!--/* Show image and ask for input */
foreach ($_SESSION['UntaggedImages'] as $photo) {
    // Check if image is already in text file
    $alreadyThere = false; // TODO: Check here
    $humanInput = "Placeholder"; // TODO: Input field here
    // if there already skip
    if ($alreadyThere) {
        // skip to next image
        echo ' <img src=" ' . $photo . ' " width="400"/><br />';
        // else wait for human to click next and call appendToFile
    } else
    {
        echo ' <img src=" ' . $photo . ' " width="400"/><br />';
        ?>

    <form class="" id="" action="index.php" method="post">
        <input type="text" id="humanInput" name="humanInput" aria-label="people" placeholder="people" width="700px">
        <input type="submit" value="Save">
    </form>-->
<?php
}   //appendToFile(dirname($photo), basename($photo), $humanInput);
?>