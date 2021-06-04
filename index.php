<?php 

if(!empty($_FILES['image']['tmp_name'])){
    
    // save image 
    $fileName = $_FILES['image']['name'];
    $from = $_FILES['image']['tmp_name'];
    $to = 'img/'.$fileName;
    move_uploaded_file($from,$to);

    $fileDir = $to;

    // include library
    require __DIR__ . "/vendor/autoload.php";
    // set file location
    $qrcode = new Zxing\QrReader($fileDir);
    // decode image to text
    $text = $qrcode->text();

    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <title>QR Reader - PHP Application</title>
</head>
<body>
   <div class="heading"><a href="./"><img src="assets/favicon.png" alt="logo" ><h1>QR CODE READER</h1></a></div>
    <div class="parent">
      <form class="form" method="post" enctype="multipart/form-data">
        <label for="choseImage">Chose Your QR :</label>
        <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" />
      <center>  <button>Decode</button> </center>
    </form>
   <h3>Your Code:</h3>
    <div class="result">
        <code>
           <p>
               <?php if(isset($text)){echo $text; }?>
            </p>
        </code>
    </div>
    </div>
   
</body>
</html>

<?php

if(isset($fileDir)){

// delete moved file
unlink($fileDir);

}
?>

