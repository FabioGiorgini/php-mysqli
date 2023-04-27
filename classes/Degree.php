<?php
require_once __DIR__.'/ConnectionMyDB.php';

/**
 * Degree
 * Handle Degree
 * 
 * @author Gaetano Frascolla
 */
class Degree {

    private $connection; 
    
    /**
     * __construct
     *
     * @param  ConnectionMyDB $_connection
     */
    public function __construct(ConnectionMyDB $_connection)
    {
        $this->connection = $_connection;
    }

    public function getAllDegreesForDepartment($department_id){
        $sql = 'SELECT * FROM degrees WHERE ? = degrees.department_id';
        $query = $this->connection->conn->prepare($sql);

        $query->bind_param('i', $department_id);
        $query->execute();
        $result = $query->get_result();

        return $result;
    }
}

?>