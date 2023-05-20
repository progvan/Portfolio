<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
try
{
    $conn = mysqli_connect('', '', '', 'beauty salon');
    $article = mysqli_query($conn, "SELECT * FROM `Види послуг`");

    $type_service = $_POST['type_service'];
    $name_service = $_POST['name_service'];
    $time_service = $_POST['time_service'];
    $price = $_POST['price'];
if (isset($_POST['submit']) && $type_service && $name_service && $time_service && $price) {
    mysqli_query($conn, "INSERT INTO `Послуги` (`Код_послуги`, `Код_виду`, `Час_послуги`, `Назва_послуги`, `Ціна`) VALUES (NULL, '$type_service', '$time_service', '$name_service', '$price')");
}
}catch(PDOException $e)
{
    echo "error" .$e->getMessage();
}
    ?>
<body>
    <div class="container">
        <div class="text-center">
            <h2>Додайте нову послугу</h2>
            <form action="" method="POST">
                <div class="form-group input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Оберіть вид послуги</label>
                    </div>
                    <select class="form-control" name="type_service" style="font-size: 18px;" placeholder="Вид послуги" id="FormControlSelect1">
                        <?php foreach ($article as $art): ?>
                            <option value="<?=$art['Код_виду'];?>"><?=$art['Назва_виду'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name ="name_service" class="form-control" style="font-size: 20px;" placeholder="Назва послуги" aria-label="name_type" aria-describedby="basic-addon1"><br>
                    <input type="number" name ="time_service" class="form-control" style="font-size: 20px;" placeholder="Час послуги" aria-label="name_type" aria-describedby="basic-addon1"><br>
                    <input type="number" name ="price" class="form-control" style="font-size: 20px;" placeholder="Ціна" aria-label="name_type" aria-describedby="basic-addon1">
                </div>

                <button type="submit" name="submit" class="btn btn-success btn-lg">Додати послугу</button>
            </form><br>
        </div>
        <a href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">На головну</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>