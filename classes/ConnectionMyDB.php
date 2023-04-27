
<?php

/**
 * ConnectionMyDB
 * Create a connection via mysqli to mysql
 * 
 * @author Gaetano Frascolla
 */
class ConnectionMyDB {

    private $host;
    private $user;
    private $password;
    private $db;

    public $conn;
    
    /**
     * __construct
     *
     * @param  string $_host DB Host
     * @param  string $_user DB Username
     * @param  string $_password DB Password
     * @param  string $_db DB Name
     */
    public function __construct($_host = 'localhost', $_user = 'root', $_password = '', $_db = 'default')
    {
        $this->host = $_host;
        $this->user = $_user;
        $this->password = $_password;
        $this->db = $_db;

        $this->connect();
    }
    
    /**
     * Connect
     * Open the connection
     */
    private function connect(){
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db);
    }

}