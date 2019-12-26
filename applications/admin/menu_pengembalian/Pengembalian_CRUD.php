<?php
include dirname(__FILE__, 4) . '/config/Koneksi.php';

class Pengembalian_CRUD
{
    protected $db;
    private $nm_tbl = 'tbl_pengembalian';
    public $brg_baru_kembali;
    public $brg_bekas_kembali;
    public $brg_sbelum_baru;
    public $brg_sbelum_bekas;
    public $no_bppm;
    public $konsumsi;
    public $id_barang;
    public $tgl_pengembalian;
    public $brg_rusak;
    public $jml_jual;

    public function __construct()
    {
        $connect = new Koneksi();

        $this->db = $connect->createConnection();
    }

    public function insertPengembalian()
    {
        $pengembalian = $this->checkNoBppmBeforeInsert();
        if ($pengembalian->num_rows == 0) {
            $query = "INSERT INTO {$this->nm_tbl}(no_bppm,tgl_pengembalian) 
                VALUES(
                    '{$this->no_bppm}',
                    '{$this->tgl_pengembalian}'
                    )";
            $stmt = $this->db->prepare($query);
            if ($stmt->execute()) {
                $pg_id['id_pengembalian'] = $this->db->insert_id;
                $insertDetail = $this->insertDetilPengembalian($pg_id);
                if ($insertDetail) {
                    $res = $this->updateStockAfterPengembalian();
                    if ($res) {
                        return true;
                    }
                }
            }
        } else {
            $inDetail = $this->insertDetilPengembalian($pengembalian);
            if ($inDetail) {
                $res = $this->updateStockAfterPengembalian();
                if ($res) {
                    return true;
                }
            }
        }
        return false;
    }

    public function insertDetilPengembalian($pengembalian)
    {
        $query = "INSERT INTO tbl_detil_pengembalian(pengembalian_id,id_barang,konsumsi,brg_rusak,jml_jual,brg_sblum_baru,brg_sblum_bekas,brg_baru_kembali,brg_bekas_kembali)
            VALUES(
                '{$pengembalian['id_pengembalian']}',
                '{$this->id_barang}',
                '{$this->konsumsi}',
                '{$this->brg_rusak}',
                '{$this->jml_jual}',
                '{$this->brg_sbelum_baru}',
                '{$this->brg_sbelum_bekas}',
                '{$this->brg_baru_kembali}',
                '{$this->brg_bekas_kembali}'
            )";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function checkNoBppmBeforeInsert()
    {
        $query = "SELECT id_pengembalian,no_bppm FROM {$this->nm_tbl} WHERE no_bppm = '{$this->no_bppm}'";
        $res = $this->db->query($query);
        $res = $res->fetch_assoc();
        return $res;
    }

    public function getJumlahBarangSebelumByNoBppm()
    {
        $res = $this->db->query(" SELECT brg_baru,brg_bekas FROM tbl_detil_permintaan INNER JOIN tbl_permintaan ON tbl_permintaan.id_permintaan = tbl_detil_permintaan.id_permintaan WHERE id_barang = {$this->id_barang} AND no_bppm = {$this->no_bppm}");
        return $res;
    }

    public function getAllPengembalian()
    {
        $res = $this->db->query("SELECT * FROM {$this->nm_tbl}")->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getAllBarangYgKembali()
    {
        $res = $this->db->query("SELECT * FROM tbl_detil_pengembalian INNER JOIN tbl_barang ON tbl_detil_pengembalian.id_barang = tbl_barang.id_barang");
        return $res;
    }

    public function updateStockAfterPengembalian()
    {
        $query = "UPDATE tbl_barang SET jml_baru = jml_baru + {$this->brg_baru_kembali}, jml_bekas = jml_bekas + {$this->brg_bekas_kembali} WHERE id_barang = {$this->id_barang} ";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function getDetilPengembalianByNoBppm()
    {
        $query = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_detil_pengembalian ON tbl_pengembalian.id_pengembalian = tbl_detil_pengembalian.pengembalian_id INNER JOIN tbl_barang ON tbl_detil_pengembalian.id_barang = tbl_barang.id_barang WHERE tbl_pengembalian.no_bppm = {$this->no_bppm}";
        $res = $this->db->query($query);
        return $res;
    }

    public function getDataPengembalianByNoBppm()
    {
        $query = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_permintaan ON tbl_pengembalian.no_bppm = tbl_permintaan.no_bppm WHERE tbl_pengembalian.no_bppm = '{$this->no_bppm}'";
        $res = $this->db->query($query)->fetch_assoc();
        return $res;
    }

    public function updateStock($id_permintaan)
    {
        $res = $this->db->query("SELECT tbl_barang.nama as nama_item,id_permintaan,tbl_barang.id_barang, brg_baru, brg_bekas 
               FROM tbl_detil_permintaan INNER JOIN tbl_barang ON tbl_detil_permintaan.id_barang = tbl_barang.id_barang WHERE id_permintaan={$id_permintaan}")->fetchAll();
        if ($res == true) {
            foreach ($res as $value) {
                $query = "UPDATE tbl_barang SET jml_baru = jml_baru - {$value['brg_baru']}, jml_bekas = jml_bekas - {$value['brg_bekas']} WHERE id_barang = {$value['id_barang']}";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
            }
            return true;
        }
    }

    public function checkPengembalianByNoBppm()
    {
        $res = $this->db->query("SELECT * FROM tbl_pengembalian WHERE no_bppm = '{$this->no_bppm}'");
        return $res;
    }
}
