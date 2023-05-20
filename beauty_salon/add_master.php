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
$article = mysqli_query($conn, "SELECT * FROM `Види послуг`");

$name_master = $_POST['name_master'];
$id_type = $_POST['id_type'];
$contact = $_POST['contact'];
if (isset($_POST['submit']) && $name_master && $id_type && $contact) {
    mysqli_query($conn, "INSERT INTO `Майстри` (`Код_майстра`, `ПІБ`, `Код_виду`, `Телефон`) VALUES (NULL, '$name_master', '$id_type', '$contact')");
    }
}
catch(PDOException $e)
{
    echo "error" .$e->getMessage();
}
?>
<body>
<div class="container">
    <div class="text-center">
        <h2>Додайте нового майстра</h2>
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" name ="name_master" class="form-control" style="font-size: 20px;" placeholder="ПІБ" aria-label="name_type" aria-describedby="basic-addon1">
            </div>

            <div class="form-group input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Оберіть вид послуги</label>
                </div>
                <select class="form-control" name="id_type" style="font-size: 20px;" placeholder="Оберіть вид послуги" id="FormControlSelect1">
                    <?php foreach ($article as $art): ?>
                        <option value="<?=$art['Код_виду'];?>"><?=$art['Назва_виду'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <input type="text" name ="contact" class="form-control" style="font-size: 20px;" placeholder="Телефон" aria-label="name_type" aria-describedby="basic-addon1">
            </div>

            <button type="submit" name="submit" class="btn btn-success btn-lg">Додати майстра</button>
        </form><br>
    </div>
    <a href="index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">На головну</a>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>