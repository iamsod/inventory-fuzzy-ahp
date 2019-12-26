<?php
include dirname(__FILE__, 4) . '/applications/admin/menu_users/Users_CRUD.php';
$Users = new Users_CRUD();
$users = $Users->getAll();

?>
<section class="content-header">
    <h1>
        Manajemen User
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manajemen user</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data User</h3><br><br>
                    <a href="?content=m_users&action=tambah_user" class="btn btn-success"><i class="fa fa-plus"></i> Tambah user</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>No hp</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php while ( $user = $users->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['nama'] ?></td>
                                    <td><?= $user['no_hp'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['level'] ?></td>
                                    <td>
                                        <a href="?content=m_users&action=edit_user&id=<?= $user['id_users'] ?>" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                                        <button onclick="return confirm('hapus ?') ? hapus(<?= $user['id_users'] ?>) : null" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
<script>
    function hapus(id) {
        $.ajax({
            url: './applications/admin/menu_users/modul/delete.php',
            data: {
                id: id
            },
            method: 'POST',
            success: function(value) {
                if (value) {
                    window.location.reload();
                } else {
                    alert('error');
                }
            }
        });
    }
</script>