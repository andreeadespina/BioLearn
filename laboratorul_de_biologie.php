<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="div1" >
        <?php
            include 'db.php';

            $sql="SELECT pdf from pdf_file";
            $query=mysqli_query($conn, $sql);
            while($info=mysqli_fetch_array($query)) {
                ?>
                <embed type="aplication/pdf" src="pdf/laboratorul de bio- schița lecției.pdf" width="300" height="300">
                
            <?php 

            }
        ?>
    </div>
    
</body>
</html>
