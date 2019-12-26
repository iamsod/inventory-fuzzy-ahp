<?php
include dirname(__FILE__, 4) . '/config/Koneksi.php';

class Karyawan_CRUD
{
    private $db;
    public $tbl_sales = 'tbl_sales';
    public $tbl_users = 'tbl_users';
    public $id_sales;
    public $id_spv;
    public $nama;
    public $nik;

    public function __construct()
    {
        $connect = new Koneksi();

        $this->db = $connect->createConnection();
    }

    public function getAllSpv()
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_users} WHERE level = 'SPV'");
        return $res;
    }

    public function insertSalesman()
    {
        $query = "INSERT INTO {$this->tbl_sales}(id_spv,nama,nik) VALUES(
            '{$this->id_spv}',
            '{$this->nama}',
            '{$this->nik}'
        )";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function getAllSalesman()
    {
        $res = $this->db->query("SELECT tbl_sales.id_sales as id_sales,tbl_users.nama as nama_spv, tbl_sales.nama as nama_sales,nik FROM {$this->tbl_sales} INNER JOIN {$this->tbl_users} ON {$this->tbl_sales}.id_spv = {$this->tbl_users}.id_users WHERE level = 'SPV' ");
        return $res;
    }

    public function getSalesById($id)
    {
        $res = $this->db->query("SELECT * FROM {$this->tbl_sales} WHERE id_sales= '{$id}' ");
        return $res;
    }

    public function updateSales()
    {
        $query = "UPDATE {$this->tbl_sales} SET 
                    id_spv='{$this->id_spv}',
                    nama = '{$this->nama}',
                    nik = '{$this->nik}'
                    WHERE id_sales = '{$this->id_sales}'";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function deleteSales($id)
    {
        $query = "DELETE FROM {$this->tbl_sales} WHERE id_sales='{$id}'";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }
}
