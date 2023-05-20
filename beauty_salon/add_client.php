<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
try{
    $conn = mysqli_connect('', '', '', 'beauty salon');

    $name_client = $_POST['name_client'];
    $contact = $_POST['contact'];

    if(isset($_POST['submit']) && $name_client && $contact){
        mysqli_query($conn, "INSERT INTO `Клієнти` (`Код_клієнта`, `ПІБ`, `Телефон`) VALUES (NULL, '$name_client', '$contact')");
    }

}catch(PDOException $e)
{
    echo "error" .$e->getMessage();
}
?>
<body>
    <div class="container">
        <div class="text-center">
            <h2>Додайте нового клієнта</h2>
            <form action="" method="POST">
                <center>
                    <input type="text" name ="name_client" class="form-control" style="width: auto; font-size: 20px;" placeholder="ПІБ" aria-label="name_type" aria-describedby="basic-addon1 "><br>
                    <input type="text" name ="contact" class="form-control" style="width: auto; font-size: 20px;" placeholder="Телефон" aria-label="name_type" aria-describedby="basic-addon1 ">
                </center><br>
                <button type="submit" name="submit" class="btn btn-success btn-lg">Додати клієнта</button><br><br>
            </form>
        </div>
        <a href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">На головну</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>