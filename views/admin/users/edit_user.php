<?php
include dirname(__FILE__, 4) . '/applications/admin/menu_users/Users_CRUD.php';
$Users = new Users_CRUD();
if (!isset($_GET['id'])) {
    die("Error");
}
$user = $Users->getUsersById($_GET['id'])->fetch_assoc();

?>
<section class="content-header">
    <h1>
        Edit User
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit user</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit User</h3>
                </div>
                <form role="form" action="" method="post" id="edt">
                    <input type="hidden" name="id_users" value="<?= $user['id_users'] ?>">
                    <input type="hidden" name="enc_password" value="<?= $user['password'] ?>">
                    <div class="box-body">
                        <?php if (@$_SESSION['alert']) : ?>

                        <?php endif;
                    unset($_SESSION['alert']) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input value="<?= $user['nama'] ?>" type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input value="<?= $user['email'] ?>" type="email" class="form-control" name="email" id="email" placeholder="Masukan E-mail">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No hp</label>
                                    <input value="<?= $user['no_hp'] ?>" type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan No hp">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input value="<?= $user['username'] ?>" type="text" class="form-control" name="username" id="username" placeholder="Masukan Username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="window.history.go(-1)" class="btn btn-md btn-danger">
                                <i class="fa fa-arrow-circle-left"></i> Kembali
                            </button>
                            <button id="edit" type="submit" class="btn btn-md btn-primary" name="edit">
                                <i class="fa fa-plus"></i> Edit User
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $('#edt').on('submit', function(evt) {
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url: './applications/admin/menu_users/modul/update.php',
            method: 'POST',
            data: data,
            success: function(val) {
                if (val) {
                    alert("Berhasil ter edit");
                    window.location.href = '?content=m_users';
                } else {
                    alert("Error");
                }
            }
        })
    })
</script>