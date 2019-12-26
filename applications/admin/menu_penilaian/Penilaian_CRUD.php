<?php
include dirname(__FILE__, 4) . '/config/Koneksi.php';

class Penilaian_CRUD
{
    protected $db;
    public $id_permintaan;
    public $id_sales;
    public $nama_item;
    public $id_spv;

    public function __construct()
    {
        $connect = new Koneksi();

        $this->db = $connect->createConnection();
    }

    public function getAllIdSales()
    {
        $res = $this->db->query("SELECT id_sales FROM tbl_sales");
        return $res;
    }

    public function getAllPenilaian()
    {
        $bln = date('m');
        $res = $this->db->query("SELECT id_penilaian,tbl_sales.nama as nama_sales,tbl_users.nama as nama_spv,nilai_hadir,nilai_materi,keterangan,tgl_penilaian FROM tbl_penilaian INNER JOIN tbl_sales ON tbl_penilaian.id_salesman = tbl_sales.id_sales INNER JOIN tbl_users ON tbl_sales.id_spv = tbl_users.id_users WHERE MONTH(tgl_penilaian) = '{$bln}'");
        return $res;
    }

    public function searchPenilaianBySpvAndSales()
    {
        $res = $this->db->query("SELECT id_penilaian,tbl_sales.nama as nama_sales,tbl_users.nama as nama_spv,nilai_hadir,nilai_materi,keterangan,tgl_penilaian FROM tbl_penilaian INNER JOIN tbl_sales ON tbl_penilaian.id_salesman = tbl_sales.id_sales INNER JOIN tbl_users ON tbl_sales.id_spv = tbl_users.id_users WHERE tbl_penilaian.id_salesman = '{$this->id_sales}' AND tbl_sales.id_spv = '{$this->id_spv}'");
        return $res;
    }

    public function checkAlternative()
    {
        $res = $this->db->query("SELECT * FROM tbl_permintaan");
        return $res;
    }

    public function getJumlahHadir(String $bln, String $thn, String $total_hari)
    {
        @$sales = $this->getAllIdSales();
        $tgl_awal = $thn . '-' . $bln . '-01';
        $tgl_akhir = $thn . '-' . $bln . '-' . $total_hari;
        foreach ($sales as $sal) {
            $jmlHadir[$sal['id_sales']] = $this->db->query("SELECT * FROM tbl_permintaan INNER JOIN tbl_pengambilan ON tbl_permintaan.id_permintaan = tbl_pengambilan.id_permintaan WHERE id_salesman='{$sal['id_sales']}' AND tbl_pengambilan.tgl_pengambilan BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}'")->fetch_assoc();
        }
        return $jmlHadir;
    }

    public function getPemasanganMateri($permintaan)
    {
        $materi = 0;
        $barang = 0;
        // for ($i = 0; $i < sizeof($permintaan); $i++) {
        $query = "SELECT id_permintaan,nama,brg_baru+brg_bekas as jumlah FROM tbl_detil_permintaan INNER JOIN tbl_barang ON tbl_barang.id_barang = tbl_detil_permintaan.id_barang WHERE id_permintaan={$permintaan['id_permintaan']} AND tbl_barang.nama LIKE '%Sunblind%' ";
        $query2 = "SELECT id_permintaan,nama,brg_baru+brg_bekas as jumlah FROM tbl_detil_permintaan INNER JOIN tbl_barang ON tbl_barang.id_barang = tbl_detil_permintaan.id_barang WHERE id_permintaan={$permintaan['id_permintaan']} AND tbl_barang.nama NOT LIKE '%Sunblind%'";
        
        $stmt = $this->db->query($query);
        $materi = $stmt->num_rows;

        $stmt2 = $this->db->query($query2);
        $barang = $stmt2->num_rows;
        // }
        // foreach ($dataMateri as $materiPer) {
        //     foreach ($materiPer as $per) {
        //         if (sizeof($per) != 0) {
        //             $materi++;
        //         }
        //     }
        // }

        // foreach ($dataBarang as $barangPer) {
        //     foreach ($barangPer as $perb) {
        //         if (sizeof($perb) != 0) {
        //             $barang++;
        //         }
        //     }
        // }
        $totalMateri = (($materi + 3) + $barang);
        if ($totalMateri > 300) {
            $totalMateri = 300;
        }
        $nilai = round((100 / 300) * $totalMateri, 2);
        return $nilai;
    }

    public function insertPenilaian($sales)
    {
        foreach ($sales as $key => $value) {
            $id_sales = $key;
            $query = "INSERT INTO tbl_penilaian(id_salesman,nilai_hadir,nilai_materi,keterangan,tgl_penilaian) VALUES('{$id_sales}','{$sales[$key]['nilai_hadir']}','{$sales[$key]['nilai_materi']}','{$sales[$key]['keterangan']}',NOW())";
            $stmt = $this->db->prepare($query);
            if (!$stmt->execute()) {
                return false;
            }
        }

        return true;
    }
}
