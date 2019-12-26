<section class="content-header">
    <h1>
        Tambah User
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah user</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah User</h3>
                </div>
                <form role="form" action="" method="post" id="tbh">
                    <div class="box-body">
                        <?php if (@$_SESSION['alert']) : ?>

                        <?php endif;
                    unset($_SESSION['alert']) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukan E-mail">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No hp</label>
                                    <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan No hp">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select class="form-control" name="level" id="level">
                                        <option value="admin">admin</option>
                                        <option value="SPV">SPV</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="window.history.go(-1)" class="btn btn-md btn-danger">
                                <i class="fa fa-arrow-circle-left"></i> Kembali
                            </button>
                            <button id="tambah" type="submit" class="btn btn-md btn-primary" name="tambah">
                                <i class="fa fa-plus"></i> Tambah User
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $('#tbh').on('submit', function(evt) {
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url: './applications/admin/menu_users/modul/insert.php',
            method: 'POST',
            data: data,
            success: function(val) {
                if (val) {
                    alert("Berhasil tertambah");
                    window.location.href = '?content=m_users';
                } else {
                    alert("Error");
                }
            }
        })
    })
</script>