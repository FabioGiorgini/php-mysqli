<?php
require_once __DIR__.'/ConnectionMyDB.php';

/**
 * Department
 * Handle Departments
 * 
 * @author Gaetano Frascolla
 */
class Department {

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
    
    /**
     * Get All Departments
     *
     * @return object
     */
    public function get_all_departments(){
        $sql = "SELECT * FROM `departments`";
        $smts = $this->connection->conn->prepare($sql);
        $smts->execute();
        $result = $smts->get_result();
        return $result;

    }
    
    /**
     * Get Department by id
     *
     * @param  mixed $_id The Department ID
     * @return object
     */
    public function get_department_by_id($_id){

        if(!is_numeric($_id)){
            throw new Exception('ID has to be numeric');
        }

        $sql = "SELECT * FROM `departments` WHERE `id` = ?";
        $smts = $this->connection->conn->prepare($sql);
        $smts->bind_param('i', $_id);
        $smts->execute();
        $result = $smts->get_result();
        return $result;
    }


}

