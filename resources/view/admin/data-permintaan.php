<?php
session_start();
include '../../../functions/functions.php';
include '../../../functions/connection.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


$query = mysqli_query($conn, "SELECT distinct(divisi), tgl_permintaan FROM permintaan WHERE status != 1");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Permintaan Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="https://dprd.jabarprov.go.id/assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body class="bg-gray-100">

    <?php include '../../partials/sidebar.php' ?>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="mx-auto max-w-screen-xl">
                <!-- Start coding here -->
                <div class="bg-white relative shadow-md rounded-lg overflow-hidden">
                    <h2 class="text-2xl text-center font-medium my-4">Data Permintaan Barang</h2>
                    <div class="overflow-x-auto p-4">
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Divisi</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    if (mysqli_num_rows($query)) :
                                        while ($row = mysqli_fetch_assoc($query)) :
                                ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $row['divisi'] ?></td>
                                            <td><?= indoDate($row['tgl_permintaan']) ?></td>
                                            <td><a href="detail-permintaan.php?divisi=<?= $row['divisi'];?>&tgl=<?= $row['tgl_permintaan'] ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none">Detail</button></span></a> </td>
                                        </tr>
                                    <?php $no++;
                                    endwhile;
                                else : ?>

                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>