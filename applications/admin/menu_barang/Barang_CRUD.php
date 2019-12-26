<?php
include dirname(__FILE__, 4) . '/config/Koneksi.php';

class Barang_CRUD
{
    protected $db;
    private $nm_tbl = 'tbl_barang';
    public $id_barang;
    public $kode;
    public $nama;
    public $jml_bekas;
    public $jml_baru;
    public $status;
    public $gambar;
    public $brand;

    public function __construct()
    {
        $connect = new Koneksi();

        $this->db = $connect->createConnection();
    }

    public function getAll()
    {
        $res = $this->db->query("SELECT * FROM {$this->nm_tbl}");
        return $res;
    }

    public function getBrand()
    {
        $res = $this->db->query("SELECT brand FROM {$this->nm_tbl} GROUP BY brand");
        return $res;
    }

    public function getBarangById($id)
    {
        $res = $this->db->query("SELECT * FROM {$this->nm_tbl} WHERE id_barang='{$id}'");
        return $res;
    }

    public function getBarangByKode($kode)
    {
        $res = $this->db->query("SELECT * FROM {$this->nm_tbl} WHERE kode='{$kode}'");
        return $res;
    }

    public function insertBarang()
    {
        $query = "INSERT INTO {$this->nm_tbl}(kode,brand,nama,status,gambar,jml_baru,jml_bekas) 
        VALUES('{$this->kode}','{$this->brand}','{$this->nama}','{$this->status}','{$this->gambar}','{$this->jml_baru}','{$this->jml_bekas}')";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function search()
    {
        $res = $this->db->query("SELECT * FROM {$this->nm_tbl} WHERE
        kode LIKE '%{$this->kode}%' AND 
        brand LIKE '%{$this->brand}%' AND 
        nama LIKE '%{$this->nama}%'");
        return $res;
    }

    public function updateStock($id_permintaan)
    {
        $query = "UPDATE {$this->nm_tbl} SET jml_baru = '{$this->jml_baru}', jml_bekas = '{$this->jml_bekas}' WHERE id_barang = {$this->id_barang}";
        $stmt = $this->db->prepare($query);
        return $stmt;
    }

    // public function updateBarang($id)
    // {
    //     $query = "UPDATE {$this->nm_tbl} SET 
    //                 kode='{$this->kode}',
    //                 brand='{$this->brand}',
    //                 nama='{$this->nama}',
    //                 jumlah='{$this->jumlah}',
    //                 status='{$this->status}',
    //                 gambar='{$this->gambar}'
    //                 WHERE id_barang='{$id}'";
    //     $stmt = $this->db->prepare($query);
    //     return $stmt->execute();
    // }

    public function deleteBarang($id)
    {
        $query = "DELETE FROM {$this->nm_tbl} WHERE id_barang='{$id}'";
        $stmt = $this->db->query($query);
        return $stmt->execute();
    }

    function uploadFoto()
    {
        if ($_FILES['gambar_barang']['error'] == 0) {
            //Mengambil data gambar
            $namaFile   = $_FILES['gambar_barang']['name'];
            $ukuranFile = $_FILES['gambar_barang']['size'];
            $error      = $_FILES['gambar_barang']['error'];
            $tmpName    = $_FILES['gambar_barang']['tmp_name'];

            //mengecek error jika gambar belum di masukkan
            // if ($error === 4) {
            //     $err = [
            //         'error' => 'Bukan gambar yang valid'
            //     ];
            //     return $err;
            // }

            //cek apakah yang di upload adalah gambar
            $valid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            //mengambil array yang di belakang dan mengubahnya lowercase
            $ekstensi = strtolower(end($ekstensiGambar));
            //in array di gunakan untuk mencari ekstensi di dalam ekstensi valid
            if (!in_array($ekstensi, $valid)) {
                $err = [
                    'error' => 'Bukan gambar yang valid'
                ];
                return $err;
            }

            //Mengecek ukuran
            if ($ukuranFile > 1000000) {
                $err = [
                    'error' => 'Ukuran terlalu besar'
                ];
                return $err;
            }

            //Setelah dicek gambar di upload
            //genererate nama baru agar tidak menimpa file yang sama
            $namaFileBaru = rand();
            // sambung
            $namaFileBaru .= '.';
            $namaFileBaru .= $ekstensi;

            move_uploaded_file($tmpName, dirname(__FILE__, 4) . '/assets/foto/' . $namaFileBaru);

            return $namaFileBaru;
        } else {
            return 'avatar.png';
        }
    }

    public function checkStock()
    {
        $barangs = $this->getAll();
        foreach ($barangs as $barang) {
            if ($barang['jml_bekas'] == 0 && $barang['jml_baru'] == 0) {
                $id[] = $barang['id_barang'];
            }
        }

        for ($i = 0; $i < sizeof($id); $i++) {
            $query = "UPDATE {$this->nm_tbl} SET status = 'Habis' WHERE id_barang = '{$id[$i]}'";
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute();
        }

        foreach ($barangs as $barang) {
            if ($barang['jml_bekas'] > 0 || $barang['jml_baru'] > 0) {
                $sedia[] = $barang['id_barang'];
            }
        }

        for ($i = 0; $i < sizeof($sedia); $i++) {
            $query = "UPDATE {$this->nm_tbl} SET status = 'Tersedia' WHERE id_barang = '{$sedia[$i]}'";
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute();
        }
        return $res;
    }
}
