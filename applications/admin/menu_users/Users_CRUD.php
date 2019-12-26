<?php
include dirname(__FILE__, 4) . '/config/Koneksi.php';

class Users_CRUD
{
    public $db;
    private $nm_tbl = 'tbl_users';
    public $id_users;
    public $username;
    public $password;
    public $nama;
    public $email;
    public $no_hp;
    public $level;

    public function __construct()
    {
        $connect = new Koneksi();

        $this->db = $connect->createConnection();

    }

    public function getAll()
    {
        $res = $this->db->query("SELECT * FROM {$this->nm_tbl} WHERE id_users<>1");
        return $res;
    }

    public function getUsersById($id)
    {
        $res = $this->db->query("SELECT * FROM {$this->nm_tbl} WHERE id_users='{$id}'");
        return $res;
    }

    public function getUsersByUsername($username)
    {
        $res = $this->db->query("SELECT * FROM tbl_users WHERE username='{$username}'");
        return $res;
    }

    public function insertUsers()
    {
        $query = "INSERT INTO {$this->nm_tbl}(username,password,nama,email,no_hp,level) 
        VALUES('{$this->username}','{$this->password}','{$this->nama}','{$this->email}','{$this->no_hp}','{$this->level}')";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function updateUsers($id)
    {
        $query = "UPDATE {$this->nm_tbl} SET 
                    username='{$this->username}',
                    password='{$this->password}',
                    nama='{$this->nama}',
                    email='{$this->email}',
                    no_hp='{$this->no_hp}',
                    level='{$this->level}' 
                    WHERE id_users='{$id}'";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function deleteUsers($id)
    {
        $query = "DELETE FROM {$this->nm_tbl} WHERE id_users='{$id}'";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function getAllSpv()
    {
        $res = $this->db->query("SELECT * FROM {$this->nm_tbl} WHERE level = 'SPV'");
        return $res;
    }
}
