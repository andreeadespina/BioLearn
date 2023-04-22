<?php
if(isset($_GET['lectie'])) {
    include('config.php');

    $lectie = mysqli_real_escape_string($conn, $_GET['lectie']);
    $sql = "SELECT sursa_video FROM video WHERE lectie='$lectie'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Video <?php echo $lectie;?></title>
</head>
<body>
    <h1> Video <?php echo $lectie;?></h1>
    <?php while($row = mysqli_fetch_assoc($result)) {
        $video_src = $row['sursa_video']; ?>
        <video controls width="1000rem">
            <source src="<?php echo $video_src; ?>" type="video/mp4">
        </video>
    <?php } ?>
</body>
</html>

<?php
    } else {
        echo "Nu exista videoclipuri pentru aceasta lectie.";
    }

    mysqli_close($conn);
} else {
    echo "Eroare.";
}
?>
