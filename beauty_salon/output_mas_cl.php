<?php
try
{
    $conn = mysqli_connect('', '', '', 'beauty salon');
    $article_master = mysqli_query($conn, "SELECT `Код_майстра`, `ПІБ`, `Види послуг`.`Назва_виду`, `Телефон` FROM `Майстри` INNER JOIN `Види послуг` ON `Види послуг`.`Код_виду` = `Майстри`.`Код_виду`");
    $article_client = mysqli_query($conn, "SELECT `ПІБ`, `Телефон` FROM `Клієнти`");
    $delete_master = $_POST['id_delete_master'];
    if (isset($_POST['delete_master_button']) && $delete_master) {
        mysqli_query($conn, "DELETE FROM `Майстри` WHERE `Майстри`.`Код_майстра` = '$delete_master'");
        header("Location: output_mas_cl.php"); exit;
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
        $(document).ready( function () {
            $('.datatable').DataTable({
                paging: false,
                searching: false,
                info: false
            });
        });
    </script>
</head>

<body>
<div class="container">
    <a href="index.php" class="btn btn-outline-dark" style="border: 3px solid black;">На головну</a><br><br>
    <div style="display: flex; justify-content: space-between;">
        <h2>Майстри</h2>
        <form action="" method="POST">
            <button type="button" class="btn btn-outline-danger" style="border: 3px solid black;" data-bs-toggle="modal" data-bs-target="#exampleModal">Видалити майстра</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Видалення майстра</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <select class="form-control" name="id_delete_master" style="font-size: 18px;">
                                <option value="" disabled selected>-Оберіть майстра-</option>
                                <?php while ($art_del=mysqli_fetch_array($article_master)) {?>
                                    <option value="<?=$art_del['Код_майстра'];?>"><?=$art_del['ПІБ'];?></option>
                                <?php } mysqli_data_seek($article_master, 0);?>
                            </select><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                            <button name="delete_master_button" type="submit" class="btn btn-danger">Видалити</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="text-center">
        <table class="table table-dark table-hover datatable" style="border: 2px solid darkslategray;">
            <thead>
                <tr>
                    <th scope="col" style="border: 0.5px solid darkslategray;">ПІБ</th>
                    <th scope="col" style="border: 0.5px solid darkslategray;">Назва виду</th>
                    <th scope="col" style="border: 0.5px solid darkslategray;">Телефон</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($art_m=mysqli_fetch_array($article_master)) {?>
                    <tr>
                        <td style="border: 0.5px solid darkslategray;"><?php echo $art_m['ПІБ']; ?></td>
                        <td style="border: 0.5px solid darkslategray;"><?php echo $art_m['Назва_виду']; ?></td>
                        <td style="border: 0.5px solid darkslategray;"><?php echo $art_m['Телефон']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div><br>

    <h2>Клієнти</h2>
    <div class="text-center">
        <table class="table table-dark table-hover datatable" style="border: 2px solid darkslategray;">
            <thead>
            <tr>
                <th scope="col" style="border: 0.5px solid darkslategray;">ПІБ</th>
                <th scope="col" style="border: 0.5px solid darkslategray;">Телефон</th>
            </tr>
            </thead>
            <tbody>
                <?php while ($art_c=mysqli_fetch_array($article_client)) {?>
                    <tr>
                        <td style="border: 0.5px solid darkslategray;"><?php echo $art_c['ПІБ']; ?></td>
                        <td style="border: 0.5px solid darkslategray;"><?php echo $art_c['Телефон']; ?></td>
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