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
            $this->con = new mysqli($this->host,$this->username, $this->password, $this->dbname);
            $this->con->set_charset("UTF8");
        }
        catch (Exception $e) 
        {
            echo "Connection Error". $e->getMessage();
        }
        
    }

    public function createTask($title, $description): bool 
    {
        $sql = "INSERT INTO tasks(title, description) VALUES(?, ?)";
        
        $stmt = $this->con->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param('ss', $title, $description);

        if ($stmt->execute()) 
            return true;
        else
            return false;

        $stmt->close();

    }

    public function getTasks(): array
    {
        $data = [];

        $sql = "SELECT * FROM tasks";

        $result = $this->con->query($sql);

        if ($result) 
        {
            while ($rows = mysqli_fetch_assoc($result)) {
                $data[] = $rows;
            }  
        }
        return $data;
            
    }

    public function editTask($id): array
    {
        $data = [];

        $stmt = $this->con->prepare("SELECT title, description FROM tasks WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) 
        {
            $row = $result->fetch_assoc();
            $data = $row;
        } 

        $stmt->close();

        return $data;
            
    }   

    public function updateTask($id, $title, $description): bool 
    {
        $sql = "UPDATE tasks SET title=?, description=? WHERE id=?";

        $stmt = $this->con->prepare($sql);

        if ($stmt === false) 
            return false;

        $stmt->bind_param('ssi', $title, $description, $id);

        if ($stmt->execute())
            return true;
        
        $stmt->close();
        return false;

    }

    public function deleteTask($id): bool 
    {
        $sql = "DELETE FROM tasks WHERE id=".$id;
        
        if ($this->con->query($sql)) 
            return true;
        return false;
    }
    
}


?>