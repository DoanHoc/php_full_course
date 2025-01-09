<?php
class Database
{
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,[
                PDO::ATTR_PERSISTENT => true
            ]);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // PDO::FETCH_ASSOC: Trả về mảng liên kết với tên cột làm key.
            // PDO::FETCH_NUM: Trả về mảng số với các chỉ mục là số thứ tự cột.
            // PDO::FETCH_BOTH (mặc định): Trả về cả mảng liên kết và mảng số.
            // PDO::FETCH_OBJ: Trả về một đối tượng với các thuộc tính tương ứng với các tên cột.
            // PDO::FETCH_CLASS: Trả về một đối tượng của một lớp cụ thể.
            // $endMemory = memory_get_usage();
            // echo "Bộ nhớ sử dụng sau khi thêm dữ liệu: " . number_format($endMemory / 1024, 2) . " KB\n";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Insert data (1 dòng hoặc mảng)
    public function insert($table, $data, $isShowSql = false)
    {
        if(!is_array($data)) {
            throw new InvalidArgumentException("Chỉ được truyền vào một mảng."); 
        }else {
            // Insert 1 mảng
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
    
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            
            // Chuẩn bị statement
            $stmt = $this->pdo->prepare($sql);
    
            // Gắn giá trị thực tế vào placeholders
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            // Hiển thị SQL với giá trị thực tế
            if ($isShowSql) {
                $realSql = $sql;
                foreach ($data as $key => $value) {
                    $realSql = str_replace(":$key", is_numeric($value) ? $value : "'$value'", $realSql);
                }
                var_dump($realSql);
            }
        } 
    
        return $stmt->execute();
    }
    

    // Update data (1 dòng hoặc mảng)
    public function update($table, $data, $condition, $isShowSql = false)
    {
        // Tạo chuỗi SET từ mảng $data
        if(!is_array($data)){
            throw new InvalidArgumentException("Chỉ được truyền vào một mảng."); 
        }
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ', ');
        $condition !== "" && $condition = "WHERE $condition";
        // Tạo câu SQL
        $sql = "UPDATE $table SET $setClause $condition";
        // Hiển thị câu SQL với giá trị thực tế
        if ($isShowSql) {
            $realSql = $sql;
            foreach ($data as $key => $value) {
                $realSql = str_replace(":$key", is_numeric($value) ? $value : "'$value'", $realSql);
            }
            var_dump($realSql);
        }
    
        // // Chuẩn bị statement
        $stmt = $this->pdo->prepare($sql);
        var_dump($stmt);
    
        // // Gắn giá trị cho placeholders
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

    //xem log 
    // TRUNCATE TABLE mysql.general_log;

    // SELECT * FROM information_schema.processlist;
    // KILL 117;KILL 118;KILL 119;

    // SET GLOBAL general_log = 'ON';
    // SET GLOBAL log_output = 'TABLE';
    // SHOW VARIABLES LIKE 'general_log';

    // SET GLOBAL slow_query_log = 'ON';
    // SHOW VARIABLES LIKE 'slow_query_log';
    // SHOW VARIABLES LIKE 'long_query_time';
    // SHOW VARIABLES LIKE 'max_connections';
    // SET GLOBAL max_connections = 151;
    // SHOW VARIABLES LIKE 'wait_timeout';

    // SHOW STATUS LIKE 'Threads_connected';
    // SHOW STATUS LIKE 'Connections';
    // SELECT SLEEP(10);
}

?>
