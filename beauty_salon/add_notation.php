<?php
try
{
    $conn = mysqli_connect('', '', '', 'beauty salon');
    $id_client = $_POST['id_client'];
    $id_service = $_POST['id_service'];
    $id_master = $_POST['id_master'];
    $date_time = $_POST['id_date_time'];
    $article_clients = mysqli_query($conn, "SELECT * FROM `Клієнти`");
    $article_services = mysqli_query($conn, "SELECT * FROM `Послуги` ORDER BY `Код_виду`");
   if (isset($_POST['submit']) && $id_client && $id_service && $id_master && $date_time) {
           mysqli_query($conn, "INSERT INTO `Запис` (`Код_запису`, `Код_клієнта`, `Код_послуги`, `Код_майстра`, `Дата_час`) VALUES (NULL, '$id_client', '$id_service', '$id_master', '$date_time')");
   }
}catch(PDOException $e)
{
    echo "error" .$e->getMessage();
}
?>

<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#service").change(function () {
                var service_id=$(this).val();
                $.ajax({
                    url:"action_active_list.php",
                    method:"POST",
                    data:{serviceID: service_id},
                    success:function (data){
                        $("#master").html(data);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on("change", "#date_time", function () {
                var dt_id = $(this).val();
                dt_id = dt_id.replace("T", " ");
                $.ajax({
                    url:"check_date.php",
                    method:"POST",
                    data:{dtID: dt_id},
                    success:function (data){
                        $("#date_t").html(data);
                    }
                });
            });
        });
    </script>
</head>

<body>
<div class="container">
    <div class="text-center">
        <h2>Додайте новий запис</h2>
        <form action="" method="POST">

            <div class="form-group input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Оберіть клієнта</span>
                <select class="form-control" name="id_client" style="font-size: 18px;" placeholder="id_client" id="FormControlSelect1">
                    <?php foreach ($article_clients as $art_с): ?>
                        <option value="<?=$art_с['Код_клієнта'];?>"><?=$art_с['ПІБ'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <select class="form-control" name="id_service" style="font-size: 18px;" placeholder="id_client" id="service">
                <option value="" disabled selected>-Оберіть послугу-</option>
                <?php while ($art_s=mysqli_fetch_array($article_services)) {?>
                    <option value="<?=$art_s['Код_послуги'];?>"><?=$art_s['Назва_послуги'];?></option>
                <?php } ?>
            </select><br>

            <select class="form-control" name="id_master" style="font-size: 18px;" placeholder="id_client" id="master">
                <option value="" disabled selected>-Оберіть майстра-</option>
            </select><br>

            <div class="form-floating" id="date_t">
                <input type="datetime-local" name ="id_date_time" class="form-control" style="font-size: 18px;" id="date_time">
                <label for="date_time">Введіть дату</label><br>
                <button type="submit" name="submit" class="btn btn-success btn-lg">Додати запис</button>
            </div><br>

        </form><br>
    </div>
    <a href="index.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true">На головну</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
