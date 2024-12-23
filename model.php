<?php

class Model 
{
    private $host = "todo_list_vue";
    private $username = "root";
    private $password = "root";
    private $dbname = "tasks";
    public $con;

    public function __construct() 
    {
        try 
        {
            $this->con = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            $this->con->set_charset("UTF8");
        }
        catch (Exception $e) 
        {
            echo "Connection Error". $e->getMessage();
        }   
    
    }

    public function create_user($name, $lastname, $login, $pass): bool 
    {
        $sql = "INSERT INTO user_info(name, lastname, login, pass) VALUES (?, ?, ?, ?)";

        $stmt = $this->con->prepare($sql);

        $pass_hashed = password_hash($pass, PASSWORD_DEFAULT);
        if ($stmt === false) 
            return false;

        $stmt->bind_param('ssss', $name, $lastname, $login, $pass_hashed);

        if ($stmt->execute()) {
            $stmt->close();
            return true;    
        }
        else {
            $stmt->close();
            return false;
        }
    }

    public function userLogin($login, $pass): bool 
    {
        $sql = "SELECT id, pass FROM user_info WHERE login=? LIMIT 1";
        $stmt = $this->con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('s', $login);
            $stmt->execute();
            $result = $stmt->get_result();

            $row = $result->fetch_assoc();

            if ($row && password_verify($pass, $row['pass'])) {    
                
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $data = ['session_id' => session_id()];
                session_regenerate_id(true);
               
                return true;
            
            }
        }

        return false;
    
    }

    public function createTask($userId, $title, $description): bool 
    {
        $sql = "INSERT INTO tasks(user_id, title, description) VALUES(?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param('iss', $userId, $title, $description);

        if ($stmt->execute()) { 
            $stmt->close();
            return true;
        }
        else {
            $stmt->close();
            return false;
        }
    }

    public function getTasks($userId): array
    {
        $data = [];

        $sql = "SELECT * FROM tasks WHERE user_id=?";

        $stmt = $this->con->prepare($sql);


        if ($stmt === false) {
            return [];
        }

        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }  
        
        $stmt->close();
        return $data;      
    
    }

    public function editTask($id, $userId): array
    {
        $data = [];

        $stmt = $this->con->prepare("SELECT title, description FROM tasks WHERE id=? AND user_id=?");
        
        if ($stmt == false) {
            return false;
        }

        $stmt->bind_param('ii', $id, $userId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $data = $row;
        } 

        $stmt->close();
        return $data;
            
    }   

    public function updateTask($id, $title, $description, $userId): bool 
    {
        if (empty($id) || empty($title) || empty($description) || empty($userId)) {
            return false;
        }

        $sql = "UPDATE tasks SET title=?, description=? WHERE id=? AND user_id=?";

        $stmt = $this->con->prepare($sql);

        if ($stmt === false) 
            return false;

        $stmt->bind_param('ssii', $title, $description, $id, $userId);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;

    }

    public function deleteTask($id, $userId): bool 
    {
        $sql = "DELETE FROM tasks WHERE id=? AND user_id=?";
        
        $stmt = $this->con->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param('ii', $id, $userId);

        if ($stmt->execute()) {  
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;

    }
    
}

?>