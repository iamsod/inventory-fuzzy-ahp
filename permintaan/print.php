<?php
session_start();
include '../applications/admin/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();
$permintaan = [];
$detil_permintaan = [];
foreach ($_SESSION['id_permintaan'] as $key => $value) {
    $Permintaan->id_permintaan = $value;
    $permintaan[$key] = $Permintaan->getPermintaanById();
    $detil_permintaan[$key] = $Permintaan->getDetilPermintaanById();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar permintaan</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Data Permintaan</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No. BPPM</th>
                        <th>Nama Salesman</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Nama pembuat</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0;
                    foreach ($permintaan as $p) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $p->no_bppm ?></td>
                            <td><?= $p->nama ?></td>
                            <td><?= $p->tgl_penggunaan ?></td>
                            <td><?= $p->nama_pembuat ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<?php
unset($_SESSION['id_permintaan']);
echo "<script>
    window.print()
    setTimeout(function(){
        window.location.href = '../index.php?content=pengambilan'
    },1000)
</script>";
