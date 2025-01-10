<?php
// Đặt header JSON
header('Content-Type: application/json');

// Nhận dữ liệu từ yêu cầu
$data = json_decode(file_get_contents('php://input'), true);

// Kiểm tra action và xử lý từng trường hợp
$action = $data['action'] ?? '';
$response = [];

switch ($action) {
    case 'load_tinhthanh':
        // Trả về danh sách tỉnh/thành
        $response = [
            ['id' => 1, 'name' => 'Hà Nội'],
            ['id' => 2, 'name' => 'TP. Hồ Chí Minh'],
            ['id' => 3, 'name' => 'Đà Nẵng'],
        ];
        break;

    case 'load_thanhpho':
        // Trả về danh sách thành phố dựa trên tỉnh
        $provinceId = $data['provinceId'] ?? 0;
        $cities = [
            1 => [
                ['id' => 11, 'name' => 'Quận Ba Đình'],
                ['id' => 12, 'name' => 'Quận Hoàn Kiếm'],
            ],
            2 => [
                ['id' => 21, 'name' => 'Quận 1'],
                ['id' => 22, 'name' => 'Quận 3'],
            ],
            3 => [
                ['id' => 31, 'name' => 'Quận Hải Châu'],
                ['id' => 32, 'name' => 'Quận Thanh Khê'],
            ],
        ];
        $response = $cities[$provinceId] ?? [];
        break;

    case 'load_quanhuyen':
        // Trả về danh sách quận/huyện dựa trên thành phố
        $cityId = $data['cityId'] ?? 0;
        $districts = [
            11 => [
                ['id' => 111, 'name' => 'Phường Điện Biên'],
                ['id' => 112, 'name' => 'Phường Kim Mã'],
            ],
            21 => [
                ['id' => 211, 'name' => 'Phường Bến Nghé'],
                ['id' => 212, 'name' => 'Phường Tân Định'],
            ],
            31 => [
                ['id' => 311, 'name' => 'Phường Thạch Thang'],
                ['id' => 312, 'name' => 'Phường Hòa Thuận Tây'],
            ],
        ];
        $response = $districts[$cityId] ?? [];
        break;

    default:
        // Trường hợp action không hợp lệ
        $response = ['error' => 'Invalid action'];
        break;
}

// Trả về dữ liệu JSON
echo json_encode($response);
