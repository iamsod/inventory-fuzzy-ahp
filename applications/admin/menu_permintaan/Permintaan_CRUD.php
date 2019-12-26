<?php
include dirname(__FILE__, 4) . '/config/Koneksi.php';

class Permintaan_CRUD
{
    private $db;
    protected $tbl_permintaan = 'tbl_permintaan';
    protected $tbl_detil_permintaan = 'tbl_detil_permintaan';
    protected $tbl_barang = 'tbl_barang';
    public $id_salesman;
    public $nama_pembuat;
    public $tgl_penggunaan;
    public $id_barang;
    public $brg_baru;
    public $brg_bekas;
    public $id_permintaan;
    public $no_bppm;
    public $nama_sales;
    public $tgl_pembuatan;

    public function __construct()
    {
        $connect = new Koneksi();

        $this->db = $connect->createConnection();
    }

    public function addBarang()
    {
        $query = "INSERT INTO {$this->tbl_detil_permintaan}(id_permintaan,id_barang,brg_baru,brg_bekas) VALUES(
            '{$this->id_permintaan}', '{$this->id_barang}', '{$this->brg_baru}', '{$this->brg_bekas}'
        )";
        $stmt = $this->db->prepare($query);
        if ($stmt->execute() != false) {
            $data = [
                'id_permintaan' => $this->id_permintaan,
                'id_barang' => $this->id_barang,
                'brg_baru' => $this->brg_baru,
                'brg_bekas' => $this->brg_bekas
            ];
            return $data;
        } else {
            return false;
        }
    }

    public function getDetilPermintaan()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_detil_permintaan} INNER JOIN tbl_barang ON tbl_detil_permintaan.id_barang = tbl_barang.id_barang WHERE id_permintaan = {$this->id_permintaan}");
        return $res;
    }

    public function getAllPermintaan()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_permintaan} INNER JOIN tbl_sales ON tbl_sales.id_sales = tbl_permintaan.id_salesman")->fetchAll();
        return $res;
    }

    public function getAllPermintaanAndPengambilan()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_permintaan} INNER JOIN tbl_pengambilan ON tbl_permintaan.id_permintaan = tbl_pengambilan.id_permintaan INNER JOIN tbl_sales ON tbl_sales.id_sales = tbl_permintaan.id_salesman");
        return $res;
    }

    public function getPermintaanById()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_permintaan} INNER JOIN tbl_sales ON tbl_sales.id_sales = tbl_permintaan.id_salesman WHERE id_permintaan = {$this->id_permintaan}");
        return $res;
    }

    public function getDetilPermintaanById()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_detil_permintaan} INNER JOIN tbl_barang ON tbl_barang.id_barang = tbl_detil_permintaan.id_barang WHERE id_permintaan= {$this->id_permintaan}");
        return $res;
    }

    public function getTglPengambilanByPermintaanId()
    {
        $res = $this->db->query("SELECT tgl_pengambilan FROM tbl_pengambilan WHERE id_permintaan = {$this->id_permintaan}");
        return $res;
    }

    public function search()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_permintaan} INNER JOIN tbl_sales ON tbl_permintaan.id_salesman = tbl_sales.id_sales WHERE
        nama LIKE '%{$this->nama_sales}%' AND 
        nama_pembuat LIKE '%{$this->nama_pembuat}%' AND 
        no_bppm LIKE '%{$this->no_bppm}%' AND 
        tgl_pembuatan LIKE '%{$this->tgl_pembuatan}%' ");
        return $res;
    }

    public function searchNoBppm()
    {
        $res = $this->db->query("SELECT no_bppm FROM {$this->tbl_permintaan} INNER JOIN tbl_pengambilan ON tbl_permintaan.id_permintaan = tbl_pengambilan.id_permintaan WHERE tbl_permintaan.no_bppm LIKE '%{$this->no_bppm}%' AND status = 'Diambil'");
        return $res;
    }

    public function getAllPermintaanBarang($id)
    {
        $res = $this->db->query("SELECT tbl_barang.nama as nama_item,id_permintaan,tbl_barang.id_barang, brg_baru, brg_bekas 
               FROM {$this->tbl_detil_permintaan} INNER JOIN tbl_barang ON tbl_detil_permintaan.id_barang = tbl_barang.id_barang WHERE id_permintaan={$id}")->fetchAll();
        return $res;
    }

    public function insertPermintaan()
    {
        $this->tgl_pembuatan = date('Y-m-d');
        $query = "INSERT INTO {$this->tbl_permintaan}(no_bppm,id_salesman,nama_pembuat,tgl_penggunaan,tgl_pembuatan) VALUES(
            '{$this->no_bppm}',
            '{$this->id_salesman}',
            '{$this->nama_pembuat}',
            '{$this->tgl_penggunaan}',
            '{$this->tgl_pembuatan}'
        )";
        $stmt = $this->db->prepare($query);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }

    public function insertAfterPermintaan()
    {
        $query = "INSERT INTO tbl_pengambilan(id_permintaan,status,tgl_pengambilan) VALUES('{$this->id_permintaan}','Belum diambil',null)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function getAlreadyBarang()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_detil_permintaan} WHERE id_barang = {$this->id_barang} AND id_permintaan={$this->id_permintaan}");
        return $res;
    }

    public function deletePermintaanBarang()
    {
        $query = "DELETE FROM {$this->tbl_detil_permintaan} WHERE id_barang = {$this->id_barang} AND id_permintaan= {$this->id_permintaan}";
        $stmt = $this->db->prepare($query);
        if ($stmt->execute()) {
            $query = "UPDATE tbl_barang SET jml_baru = jml_baru + {$this->brg_baru}, jml_bekas = jml_bekas + {$this->brg_bekas} WHERE id_barang = {$this->id_barang}";
            $stmt = $this->db->prepare($query);
            return $stmt->execute();
        }
        return false;
    }

    public function getBarangYgDimintaByNoBppm()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_permintaan} INNER JOIN {$this->tbl_detil_permintaan} ON tbl_permintaan.id_permintaan = tbl_detil_permintaan.id_permintaan INNER JOIN {$this->tbl_barang} ON tbl_detil_permintaan.id_barang = tbl_barang.id_barang WHERE tbl_permintaan.no_bppm = {$this->no_bppm}");
        return $res;
    }

    public function checkBarangDiPengembalian()
    {
        $query = "SELECT * FROM tbl_pengembalian ";
    }

    public function getNoBppm()
    {
        $nobppm = "";
        $res = $this->db->query("SELECT MAX(no_bppm) as no_bppm FROM {$this->tbl_permintaan}");
        $res = $res->fetch_assoc();
        if ($res['no_bppm'] === null) {
            $nobppm = '00001';
        } else {
            $no = (int) str_replace('0', '', $res['no_bppm']) + 1;
            $panjang = strlen($no);
            $nol = 5 - $panjang;
            $nilai = "";
            for ($i = 0; $i < $nol; $i++) {
                $nilai .= '0';
            }
            $nobppm = $nilai .= $no;
        }
        return $nobppm;
    }

    public function updateStockAfterAddBarang($barang)
    {
        $query = "UPDATE tbl_barang SET jml_baru = jml_baru - {$barang['brg_baru']}, jml_bekas = jml_bekas - {$barang['brg_bekas']} WHERE id_barang = {$barang['id_barang']}";
        $stmt = $this->db->prepare($query);

        return $stmt->execute();
    }
}
