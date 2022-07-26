<?php

namespace clinic;
require_once __DIR__."/../consts.php";

abstract class DB {

    private static $instance = null;

    private static function logMessage($msg)
    {
        $dateOfException = date("Y-m-d H:i:s");
        $dataToWrite = $dateOfException . ": " . $msg;
        file_put_contents("logs.txt", $dataToWrite . PHP_EOL, FILE_APPEND);
    } 

    public static function connect()
    {
        if (self::$instance == null) {
            try {
                return self::$instance = new \PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
            } catch (\PDOException $e) {
                self::logMessage($e->getMessage());
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
 
    public function getTable()
    {
        return $this->table;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getData()
    {
        $data = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            $method = 'get'.ucfirst($column);
            $data[$column] = $this->$method();
        }
        return $data;
    }

    public function getEditedData()
    {
        
        $data = [];
        foreach($_POST as $key=>$newValue) {
            $data["{$key}"] =  $newValue;
        }
        // var_dump($data);
        return $data;
    }

    public static function find($id,string $type)
    {
        self::connect();

        $class = get_called_class();
        $object = new $class([]);
        $table =  $object->getTable();

        $sql = "SELECT * FROM {$table} WHERE id = :id";
        $stmt = self::$instance->prepare($sql);
        $stmt->execute(['id' => $id]);

        $result = $stmt->rowCount();

        if ($result == 1) {

            if ($type == 'array') {
                $arr = $stmt->fetch(\PDO::FETCH_ASSOC);
                return $arr;

            } else if ($type == 'object') {

                $arr = $stmt->fetch(\PDO::FETCH_ASSOC);
                $object = new $class($arr);
                return $object;
                
            }    
        }
    }

    public static function all()
    {
        self::connect();
        $class = get_called_class();
        $object = new $class([]);
        $table = $object->getTable();
        $sql = "SELECT * FROM {$table}";
        $stmt =self::$instance->query($sql);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete()
    {
        self::connect();
        $sql = "DELETE FROM {$this->getTable()} WHERE id = :id";
        $stmt = self::$instance->prepare($sql);
        $result = $stmt->execute(['id' => $this->getId()]);
        return $result;
    }

    public function update(array $params)
    {
        self::connect();
        $preparedColumns = [];
        if(isset($params['id'])) {
            unset($params['id']);
        }
        foreach ($params as $key=>$val) {
            $preparedColumns[] = $key . '=:' . $key;
        }
        $preparedColumns = implode(",",$preparedColumns);
        $sql = "UPDATE {$this->getTable()} SET {$preparedColumns} WHERE id =:id";
        $stmt = self::$instance->prepare($sql);
        $arr = array_merge($this->getEditedData(),['id'=> $this->getId()]);
        $stmt->execute($arr);
            

        $result = $stmt->rowCount();
        if($result > 0) {

            return true;
        } 

        return false;
    } 

}