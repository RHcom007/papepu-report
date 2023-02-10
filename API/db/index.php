<?php
class db
{
    private $host = "localhost";
    private $username = "root";
    private $pwd = "";
    private $db = "papepu";
    private function con()
    {
        $con = mysqli_connect($this->host, $this->username, $this->pwd, $this->db);
        return $con;
    }

    public function api()
    {
        // $stmt = $this->con()->prepare("SELECT * FROM api");
        // $stmt->execute();
        // $result = $stmt->get_result();
        $result = mysqli_query($this->con(), "SELECT * FROM api");
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    public function updatetoken($nama,$token)
    {
        $q = mysqli_query($this->con(), "UPDATE api SET token='$token' WHERE nama='$nama'");
        return $q;
    }
}
?>