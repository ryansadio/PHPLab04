<?php
session_start();
if( !( isset($_SESSION['imageArray'] ) || isset( $_SESSION['peopleArray'] ) || isset( $_SESSION['index']) )) {
    $_SESSION['imageArray'] = array();
    $_SESSION['peopleArray'] = array();
    $_SESSION['index'] = 0;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    openMyTags();
    if (sizeof($_SESSION['peopleArray']) - 2 >= $_SESSION['index'])
        $_SESSION['index'] += 1;
    else $_SESSION['index'] = 0;

    header("Location: viewfiles.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Lab04 - View Images</title>
</head>
<body>

<?php

function openMyTags () {
    $row = 1;
    $photoPath = "";
    $photoName = "";
    $humanInputs = array();
    $photoURLs = array();
    if (($handle = fopen( "images.txt", "r" )) !== FALSE) {
        while (($data = fgetcsv( $handle, 1000, "	" )) !== FALSE) {
            $num = count( $data );
            //echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c = 0; $c < $num; $c++) {
                switch ($c) {
                    case (0): $photoPath = $data[$c];
                        break;
                    case (1): $photoName = $data[$c];
                        break;
                    case (2): $humanInputs[] = $data[$c];
                        break;
                }
            }
            $photoURLs[] = $photoPath . "/" . $photoName;
        }
        fclose($handle);
    }
    $_SESSION['imageArray'] = $photoURLs;
    $_SESSION['peopleArray'] = $humanInputs;
}

?>

<img src=" <?php echo $_SESSION['imageArray'][$_SESSION['index']]; ?> " width="400"/><br />
<h3><?php echo $_SESSION['peopleArray'][$_SESSION['index']]; ?></h3>

<form class="" id="" action="viewfiles.php" method="post">
    <input type="submit" value="Next">
</form>

</body>
</html>
