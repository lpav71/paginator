<?php
include 'app\Paginator.php';
include 'db.php';
use app\Paginator;

$paginator = new Paginator();
$paginator->qtyrec = 5;
$paginator->table = 'region';
$paginator->file = basename(__FILE__);
$paginator->user = "root";
$paginator->pass = "root";
$paginator->database = "bd";
$paginator->prepare($pdo);

?>
    <!doctype html>
    <html lang="ru">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
              crossorigin="anonymous">

        <title>REGIONS</title>
    </head>
    <body>
    <div class="container">
    <table class="table">
        <?php $array = $paginator->out ?>
        <?php foreach ($array as $arr) { ?>
            <tr>
                <td><?= $arr['id'] ?></td>
                <td><?= $arr['name'] ?></td>
            </tr>
        <?php } ?>
    </table>
        <?php $paginator->viewPaginator(); ?>
    </div>
    </body>
</html>
