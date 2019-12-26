<?php
include dirname(__FILE__, 4) . '/config/Koneksi.php';
class Pengambilan_CRUD
{
    protected $db;
    public $id_permintaan;
    public $status;
    public $tgl_pengambilan;
    private $nm_tbl = 'tbl_pengambilan';

    public function __construct()
    {
        $connect = new Koneksi();

        $this->db = $connect->createConnection();
    }

    public function updatePengambilan()
    {
        $query = "UPDATE {$this->nm_tbl} SET status = '{$this->status}' , tgl_pengambilan = '{$this->tgl_pengambilan}' WHERE id_permintaan = {$this->id_permintaan}";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function updateStock($id_permintaan)
    {
        $res = $this->db->query("SELECT tbl_barang.nama as nama_item,id_permintaan,tbl_barang.id_barang, brg_baru, brg_bekas 
               FROM tbl_detil_permintaan INNER JOIN tbl_barang ON tbl_detil_permintaan.id_barang = tbl_barang.id_barang WHERE id_permintaan={$id_permintaan}");
        if ($res->num_rows > 0) {
            @$res = $res;
            foreach ($res as $value) {
                $query = "UPDATE tbl_barang SET jml_baru = jml_baru - {$value['brg_baru']}, jml_bekas = jml_bekas - {$value['brg_bekas']} WHERE id_barang = {$value['id_barang']}";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
            }
            return true;
        }
    }
}
