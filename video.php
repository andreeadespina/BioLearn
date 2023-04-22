
<?php
if(isset($_FILES['video'])) {
    $file_name = $_FILES['video']['name'];
    $file_tmp = $_FILES['video']['tmp_name'];
    $file_size = $_FILES['video']['size'];
    $file_type = $_FILES['video']['type'];
    $target_dir = "video/";
$lectie=$_POST['lectie'];
    // Check if the file is a video
    $allowed_types = array("video/mp4", "video/mpeg", "video/quicktime", "video/x-msvideo", "video/x-flv", "video/x-ms-wmv", "video/webm");
    if(!in_array($file_type, $allowed_types)) {
        echo "Error: Se pot incarca doar fisiere video.";
        exit;
    }

    // Check if the file size is less than 100MB (adjust as needed)
    $max_file_size = 40 * 1024 * 1024; // 40MB
    if($file_size > $max_file_size) {
        echo "Fisierul trebuie sa aiba maxim 40mb.";
        exit;
    }

    // Generate a unique file name to prevent overwriting existing files
    $file_name = time() . "_" . $file_name;

    // Upload the file to the server
    $target_file = $target_dir . $file_name;
    if(move_uploaded_file($file_tmp, $target_file)) {

include('config.php');
        $sursa_video = mysqli_real_escape_string($conn, $target_file);
        $sql = "INSERT INTO video (sursa_video,lectie) VALUES ('$sursa_video','$lectie')";
        if(mysqli_query($conn, $sql)) {
            echo "Fisierul a fost incarcat cu succes. Numele fisierului: " . $file_name;
            mysqli_close($conn);

        } else {
            echo "Eroare.";
        }

    } 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Incarca un video pentru o lectie</title>
</head>
<body>
    <h1>Incarca un video pentru o lectie</h1>
    <form action="video.php" method="post" enctype="multipart/form-data">
        <input type="file" name="video"><br>
        <select required name="lectie">

<option value="laborator_biologie">Laboratorul de biologie</option>
<option value="ecosistem">Ecosistem. Biotop. Biocenoză</option>
<option value="delta_dunarii">Delta Dunării. Marea Neagră</option>
<option value="animale_nevertebrate">Animale nevertebrate</option>
<option value="respiratia_in_medii_diferite">Respirația în medii de viață diferite</option>
<option value="alte_tipuri_de_hranire">Alte tipuri de hrănire în lumea vie</option>
//de creat mai multe optiuni pentru toate clasele
</select>
        <input type="submit" value="Incarca">
    </form>
</body>
</html>
