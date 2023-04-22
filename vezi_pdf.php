<?php
if(isset($_GET['lectie'])) {
    include('config.php');

    $lectie = mysqli_real_escape_string($conn, $_GET['lectie']);
    $sql = "SELECT sursa_pdf FROM pdf WHERE lectie='$lectie'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pdf <?php echo $lectie;?></title>
</head>
<body>
    <h1> Pdf <?php echo $lectie;?></h1>
    <?php
        while($row = mysqli_fetch_assoc($result)) {
            $pdf_src = $row['sursa_pdf'];
            echo "<embed src='$pdf_src' type='application/pdf' width='100%' height='800px' />";
        }
    ?>
</body>
</html>

<?php
    } else {
        echo "Nu exista fisierul.";
    }

    mysqli_close($conn);
} else {
    echo "Eroare.";
}
?>
