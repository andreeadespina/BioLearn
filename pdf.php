<?php
if(isset($_FILES['pdf'])) {
    $file_name = $_FILES['pdf']['name'];
    $file_tmp = $_FILES['pdf']['tmp_name'];
    $file_size = $_FILES['pdf']['size'];
    $file_type = $_FILES['pdf']['type'];
    $target_dir = "pdf/";
    $lectie=$_POST['lectie'];

    // Check if the file is a PDF
    $allowed_types = array("application/pdf");
    if(!in_array($file_type, $allowed_types)) {
        echo "Error: Only PDF files are allowed.";
        exit;
    }

    // Check if the file size is less than 40MB
    $max_file_size = 40 * 1024 * 1024; // 40MB
    if($file_size > $max_file_size) {
        echo "Error: File size is too large. Maximum file size is 40MB.";
        exit;
    }

    // Generate a unique file name to prevent overwriting existing files
    $file_name = time() . "_" . $file_name;

    // Upload the file to the server
    $target_file = $target_dir . $file_name;
    if(move_uploaded_file($file_tmp, $target_file)) {
        // Insert the PDF source into the database
        include('config.php');

        $sursa_pdf = mysqli_real_escape_string($conn, $target_file);
        $sql = "INSERT INTO pdf (sursa_pdf,lectie) VALUES ('$sursa_pdf','$lectie')";
        if(mysqli_query($conn, $sql)) {
            echo "Fisierul a fost incarcat cu succes. Numele fisierului: " . $file_name;
        } else {
            echo "Eroare.";
        }

        mysqli_close($conn);
    } else {
        echo "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Incarca PDF</title>
</head>
<body>
    <h1>Incarca PDF</h1>
    <form action="pdf.php" method="post" enctype="multipart/form-data">
        <input type="file" name="pdf"><br>
        <select required name="lectie">

        <option value="laborator_biologie">Laboratorul de biologie</option>
    <option value="pajistea">Pajistea</option>
    <option value="pestera">Pestera</option>
    <option value="test">Test</option>
    <option value="bacterii">Clasificarea vietuitoarelor. Bacterii</option>
    <option value="protiste">Protiste</option>
    <option value="muschi_si_ferigi">Muschi si ferigi</option>
    <option value="pestii">Pestii</option>
    //de creat mai multe optiuni pentru fiecare clasa
</select>

        <input type="submit" value="Incarca">

    </form>
</body>
</html>
