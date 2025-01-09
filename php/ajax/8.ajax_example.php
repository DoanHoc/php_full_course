<?php
// process.php

// Lấy dữ liệu JSON từ yêu cầu POST
$data = json_decode(file_get_contents('php://input'), true);

// Kiểm tra nếu dữ liệu có hợp lệ
if (isset($data['name']) && isset($data['age'])) {
    // Tạo một mảng dữ liệu giả để trả về
    $result = [
        [
            'name' => 'John Doe',
            'age' => 30
        ],
        [
            'name' => 'Jane Smith',
            'age' => 25
        ],
        [
            'name' => 'Sam Brown',
            'age' => 40
        ]
    ];

    // Thêm dữ liệu mới vào mảng nếu có
    $newData = [
        'name' => $data['name'],
        'age' => $data['age']
    ];
    array_push($result, $newData);

    // Trả về kết quả dưới dạng JSON
    echo json_encode([
        'status' => 'success',
        'data' => $result
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing name or age data'
    ]);
}
?>
