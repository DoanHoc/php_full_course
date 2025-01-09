<?php
// process.php

// Lấy dữ liệu JSON từ yêu cầu POST
$data = json_decode(file_get_contents('php://input'), true);

// Kiểm tra nếu dữ liệu có hợp lệ
if (isset($data['id']) && isset($data['name'])) {
    // Kiểm tra nếu id bằng 3
    if ($data['id'] == 3) {
        // Thêm độ trễ 1 giây
        sleep(1);
    }

    // Trả về kết quả phản hồi
    echo json_encode([
        'status' => 'success',
        'message' => 'Received data for ID ' . $data['id'] . ' and Name ' . $data['name']
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing ID or Name'
    ]);
}
?>
