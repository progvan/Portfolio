<?php
try
{
    $conn = mysqli_connect('', '', '', 'beauty salon');
    $article_notate = mysqli_query($conn, "SELECT `Клієнти`.`ПІБ` AS `Клієнти_ПІБ`, `Послуги`.`Назва_послуги`, `Майстри`.`ПІБ` AS `Майстри_ПІБ`, `Запис`.`Дата_час` FROM `Запис` INNER JOIN `Клієнти` ON `Клієнти`.`Код_клієнта` = `Запис`.`Код_клієнта` LEFT JOIN `Послуги` ON `Послуги`.`Код_послуги` = `Запис`.`Код_послуги` LEFT JOIN `Майстри` ON `Майстри`.`Код_майстра` = `Запис`.`Код_майстра`");
    $delete_not = $_POST['id_delete_not'];
    $sum_price = mysqli_query($conn, "SELECT SUM(`Послуги`.`Ціна`) FROM `Запис`, `Послуги` WHERE `Запис`.`Код_послуги` = `Послуги`.`Код_послуги`");
    $sum_price = mysqli_fetch_assoc($sum_price);
    if (isset($_POST['delete_button']) && $delete_not) {
        mysqli_query($conn, "DELETE FROM `Запис` WHERE `Запис`.`Код_запису` = '$delete_not'");
        header("Location: output_notate.php");exit;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable({
                paging: false,
                searching: false,
                info: false
            });

            // Функція для оновлення даних таблиці
            function updateTableData(start_date, end_date) {
                $.ajax({
                    url: 'update_table.php',
                    type: 'POST',
                    data: {
                        start_date: start_date,
                        end_date: end_date
                    },
                    success: function (response) {
                        $('.datatable').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            }

            // Отримання значень start_date та end_date при їх зміні
            $('#start_date, #end_date').change(function () {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();

                updateTableData(start_date, end_date);
            });

            // Оновлення таблиці при завантаженні сторінки
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            updateTableData(start_date, end_date);
        });
    </script>
</head>

<body>
<div class="container">
    <a href="index.php" class="btn btn-outline-dark ml-auto" style="border: 3px solid black;">На головну</a><br><br>
    <div style="display: flex; justify-content: space-between; font-size: large;">
        <input type="datetime-local" class="form-control-inline" id="start_date" value="2023-01-01 00:00">
        <input type="datetime-local" class="form-control-inline" id="end_date" value="2023-12-31 23:59">
    </div>

    <div class="text-center">
        <h2 style="margin-top: 20px;">Записи</h2>
        <table class="table table-dark table-hover datatable" style="border: 2px solid darkslategray;" id="table_id">
            <caption style="font-size: 18px">Всього зароблено: <?php echo $sum_price['SUM(`Послуги`.`Ціна`)'];?></caption>
            <thead>
            <tr>
                <th scope="col" style="border: 0.5px solid darkslategray;">Клієнт</th>
                <th scope="col" style="border: 0.5px solid darkslategray;">Назва послуги</th>
                <th scope="col" style="border: 0.5px solid darkslategray;">Майстер</th>
                <th scope="col" style="border: 0.5px solid darkslategray;">Дата Час</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($art_n=mysqli_fetch_array($article_notate)) {?>
                <tr>
                    <td style="border: 0.5px solid darkslategray;"><?php echo $art_n['Клієнти_ПІБ']; ?></td>
                    <td style="border: 0.5px solid darkslategray;"><?php if (is_null($art_n['Назва_послуги'])){echo "Видалено (ціна = 0)";} else{echo $art_n['Назва_послуги'];} ?></td>
                    <td style="border: 0.5px solid darkslategray;"><?php if (is_null($art_n['Майстри_ПІБ'])){echo "Видалено";} else{echo $art_n['Майстри_ПІБ'];} ?></td>
                    <td style="border: 0.5px solid darkslategray;"><?php echo $art_n['Дата_час']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
