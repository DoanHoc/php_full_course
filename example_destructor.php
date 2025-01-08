<?php
class MyClassssssss {
    public function __destruct() {
        echo "Đối tượng MyClass đã bị hủy.\n";
    }
}

// Kiểm tra bộ nhớ trước khi tạo đối tượng
echo "Bộ nhớ trước khi tạo đối tượng: " . memory_get_usage() . " bytes\n";

// Tạo đối tượng
$obj = new MyClassssssss();

// Kiểm tra bộ nhớ sau khi tạo đối tượng
echo "Bộ nhớ sau khi tạo đối tượng: " . memory_get_usage() . " bytes\n";

// Xóa đối tượng và kiểm tra bộ nhớ
unset($obj);
echo "Bộ nhớ sau khi hủy đối tượng: " . memory_get_usage() . " bytes\n";
