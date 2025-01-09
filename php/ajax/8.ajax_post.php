<?php
// process.php

// Lấy dữ liệu JSON từ yêu cầu POST
$data = json_decode(file_get_contents('php://input'), true);

// Kiểm tra nếu dữ liệu có hợp lệ
if (isset($data['name']) && isset($data['email'])) {
    // Trả về kết quả phản hồi
    echo "Received POST data: Name - " . $data['name'] . ", Email - " . $data['email'];
} else {
    echo "Error: Missing name or email.";
}
?>
