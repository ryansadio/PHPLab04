<?php
session_start();
if( !( isset($_SESSION['TaggedImages'] ) || isset( $_SESSION['UntaggedImages'] ) ) ) {
    $_SESSION['TaggedImages'] = array();
    $_SESSION['UntaggedImages'] = array();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $humanInput = $_POST["humanInput"];
    $path = $_POST["path"];
    $NAME = $_POST["name"];

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

    appendToFile(dirname($photo), basename($photo), $humanInput);

    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Lab04 - Tag Images</title>
</head>
<body>

<?php
$photo = "images/animals/bird.jpg";
$dir = 'images';
if (file_exists($dir)) require_once 'images.php';
else echo "there are no images";
?>
</body>
</html>
