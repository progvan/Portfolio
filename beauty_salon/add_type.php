<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<?php
try {
    $conn = mysqli_connect('', '', '', 'beauty salon');
    $name_type = $_POST['name_type'];

    if (isset($_POST['submit']) && $name_type) {
            mysqli_query($conn, "INSERT INTO `Види послуг` (`Код_виду`, `Назва_виду`) VALUES (NULL, '$name_type')");
    }

}catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<body>
    <div class="container">
        <div class="text-center">
            <h2>Додайте новий вид послуги</h2>
            <form action="" method="POST">
                <center><input type="text" name ="name_type" class="form-control" style="width: auto; font-size: 20px;" placeholder="Назва виду послуги" aria-label="name_type" aria-describedby="basic-addon1" autocomplete="off"></center><br>
                <button type="submit" name="submit" class="btn btn-success btn-lg">Додати</button>
            </form><br>
        </div>
        <a href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">На головну</a>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>