<?php
class Database
{
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,[
            //     PDO::ATTR_PERSISTENT => true
            // ]);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $endMemory = memory_get_usage();
            echo "Bộ nhớ sử dụng sau khi thêm dữ liệu: " . number_format($endMemory / 1024, 2) . " KB\n";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Insert data (1 dòng hoặc mảng)
    public function insert($table, $data, $isShowSql = false)
    {
        if (is_array($data)) {
            // Insert 1 mảng
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            if ($isShowSql) {
                var_dump($sql);
            }
            $stmt = $this->pdo->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        } else {
            // Insert 1 dòng
            $sql = "INSERT INTO $table (" . key($data) . ") VALUES (:value)";
            if ($isShowSql) {
                var_dump($sql);
            }
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':value', current($data));
        }

       

        return $stmt->execute();
    }

    // Update data (1 dòng hoặc mảng)
    public function update($table, $data, $condition, $isShowSql = false)
    {
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ', ');

        $sql = "UPDATE $table SET $setClause WHERE $condition";
        if ($isShowSql) {
            var_dump($sql,$setClause);
        }
        $stmt = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        

        return $stmt->execute();
    }

    // Delete data
    public function delete($table, $condition, $isShowSql = false)
    {
        $sql = "DELETE FROM $table WHERE $condition";
        if ($isShowSql) {
            var_dump($sql);
        }
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute();
    }

    // Select query
    public function select($table, $columns, $condition = "", $isShowSql = false)
    {
        if (is_array($columns)) {
            $columns = implode(", ", $columns);
        }
        $sql = "SELECT $columns FROM $table" . ($condition ? " WHERE $condition" : "");
        
        if ($isShowSql) {
            var_dump($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get One
    public function getOne($table, $column, $condition = "", $isShowSql = false)
    {
        // Kiểm tra nếu column là một mảng, ném lỗi
        if (is_array($column)) {
            throw new InvalidArgumentException("Chỉ được truyền vào một cột duy nhất.");
        }
    
        // Tạo câu lệnh SQL
        $sql = "SELECT $column FROM $table" . ($condition ? " WHERE $condition" : "") . " LIMIT 1";
    
        // Hiển thị SQL nếu isShowSql là true
        if ($isShowSql) {
            var_dump($sql);
        }
    
        // Chuẩn bị và thực thi câu lệnh SQL
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    
        // Lấy một giá trị duy nhất và trả về dưới dạng string
        $result = $stmt->fetchColumn();
        
        return $result;
    }
    

    // Get Row
    public function getRow($table, $columns, $condition = "", $isShowSql = false)
    {
        if (is_array($columns)) {
            $columns = implode(", ", $columns);
        }

        $sql = "SELECT $columns FROM $table" . ($condition ? " WHERE $condition" : "") . " LIMIT 1";
        if ($isShowSql) {
            var_dump($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get Col (Lấy 1 cột dữ liệu)
    public function getCol($table, $column, $condition = "", $isShowSql = false)
    {
        $sql = "SELECT $column FROM $table" . ($condition ? " WHERE $condition" : "");
        if ($isShowSql) {
            var_dump($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Get All (Lấy tất cả dữ liệu)
    public function getAll($table, $columns, $condition = "", $isShowSql = false)
    {
        if (is_array($columns)) {
            $columns = implode(", ", $columns);
        }

        $sql = "SELECT $columns FROM $table" . ($condition ? " WHERE $condition" : "");
        if ($isShowSql) {
            var_dump($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function status(){
        return $this->pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    } 
    // public function __destruct()
    // {
    //     $stmt = $this->pdo->query("SHOW PROCESSLIST");
    //     $processList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    //     foreach ($processList as $process) {
    //         if ($process['Command'] === 'Sleep' && $process['Time'] > 30) {
    //             $this->pdo->exec("KILL {$process['Id']}");
    //         }
    //     }          
    // } 
}

?>
