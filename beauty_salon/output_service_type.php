<?php
try
{
    $conn = mysqli_connect('', '', '', 'beauty salon');
    $article_type = mysqli_query($conn, "SELECT * FROM `Види послуг`");
    $article_service = mysqli_query($conn, "SELECT `Назва_послуги`, `Час_послуги`, `Ціна`, `Види послуг`.`Назва_виду` FROM `Послуги` INNER JOIN `Види послуг` ON `Види послуг`.`Код_виду` = `Послуги`.`Код_виду`");
    $delete_type = $_POST['id_delete_type'];
    if (isset($_POST['delete_type_button']) && $delete_type) {
        mysqli_query($conn, "DELETE FROM `Види послуг` WHERE `Види послуг`.`Код_виду` = '$delete_type'");
        header("Location: output_service_type.php"); exit;
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
        <h2>Види послуг</h2>
        <form action="" method="POST">
            <button type="button" class="btn btn-outline-danger" style="border: 3px solid black;" data-bs-toggle="modal" data-bs-target="#exampleModal">Видалити вид</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Видалення виду послуги</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <select class="form-control" name="id_delete_type" style="font-size: 18px;">
                                <option value="" disabled selected>-Оберіть вид послуги-</option>
                                <?php while ($art_del_type=mysqli_fetch_array($article_type)) {?>
                                    <option value="<?=$art_del_type['Код_виду'];?>"><?=$art_del_type['Назва_виду'];?></option>
                                <?php } mysqli_data_seek($article_type, 0);?>
                            </select><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                            <button name="delete_type_button" type="submit" class="btn btn-danger">Видалити</button>
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
                <th scope="col" style="border: 0.5px solid darkslategray;">Назва виду</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($art_t=mysqli_fetch_array($article_type)) {?>
                <tr>
                    <td style="border: 0.5px solid darkslategray;"><?php echo $art_t['Назва_виду']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div><br>

    <h2>Послуги</h2>
    <div class="text-center">
        <table class="table table-dark table-hover datatable" style="border: 0.5px solid darkslategray;">
            <thead>
            <tr>
                <th scope="col" style="border: 0.5px solid darkslategray;">Назва послуги</th>
                <th scope="col" style="border: 0.5px solid darkslategray;">Час послуги</th>
                <th scope="col" style="border: 0.5px solid darkslategray;">Ціна</th>
                <th scope="col" style="border: 0.5px solid darkslategray;">Назва виду</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($art_s=mysqli_fetch_array($article_service)) {?>
                <tr>
                    <td style="border: 0.5px solid darkslategray;"><?php echo $art_s['Назва_послуги']; ?></td>
                    <td style="border: 0.5px solid darkslategray;"><?php echo $art_s['Час_послуги']; ?></td>
                    <td style="border: 0.5px solid darkslategray;"><?php echo $art_s['Ціна']; ?></td>
                    <td style="border: 0.5px solid darkslategray;"><?php echo $art_s['Назва_виду']; ?></td>
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
