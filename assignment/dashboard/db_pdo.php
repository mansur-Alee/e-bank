<?php
class Database
{
    private $server = "mysql:host=localhost;dbname=axiomsltd";
    private $username = "root";
    private $password = "";
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $con;

    public function open()
    {
        try {
            $this->con = new PDO($this->server, $this->username, $this->password, $this->options);
            return $this->con;
        } catch (PDOException $th) {
            echo "There has been an error establishing database connenction: <b>" . $th->getMessage() . "</b>";
        }
    }

    public function close()
    {
        $this->con = null;
    }
}

$db = new Database();
