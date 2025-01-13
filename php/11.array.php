<?php
// File PHP tổng hợp các loại mảng và ví dụ về Array Functions

// 1. Indexed Array (Mảng chỉ số)
// Khai báo mảng chỉ số
$fruits = ["Apple", "Banana", "Cherry"];
$numbers = [10, 20, 30, 40, 50];

// Truy cập phần tử
// Ví dụ: Lấy phần tử đầu tiên và phần tử thứ 3
echo "Phần tử đầu tiên của mảng fruits: " . $fruits[0] . "\n"; // Apple
echo "Phần tử thứ 3 của mảng numbers: " . $numbers[2] . "\n"; // 30

// 2. Constant Array (Mảng hằng số)
// Mảng không thể thay đổi sau khi khai báo
const COLORS = ["Red", "Green", "Blue"];
define("NUMBERS", [1, 2, 3]);

// Truy cập phần tử của mảng hằng số
echo "Phần tử đầu tiên của mảng COLORS: " . COLORS[0] . "\n"; // Red

// 3. Associative Array (Mảng kết hợp)
// Khai báo mảng kết hợp
$person = [
    "name" => "John",
    "age" => 25,
    "city" => "New York"
];

// Truy cập phần tử bằng khóa
// Ví dụ: Lấy tên và tuổi từ mảng $person
echo "Tên: " . $person["name"] . "\n"; // John
echo "Tuổi: " . $person["age"] . "\n"; // 25

// 4. Multidimensional Array (Mảng đa chiều)
// Khai báo mảng đa chiều
$students = [
    ["name" => "Alice", "score" => 85],
    ["name" => "Bob", "score" => 78],
    ["name" => "Charlie", "score" => 92]
];

// Truy cập phần tử trong mảng đa chiều
// Ví dụ: Lấy tên và điểm số của sinh viên đầu tiên
echo "Tên sinh viên đầu tiên: " . $students[0]["name"] . "\n"; // Alice
echo "Điểm của sinh viên đầu tiên: " . $students[0]["score"] . "\n"; // 85

// 5. Array Functions

// a) Thao tác cơ bản
// Đếm số phần tử
// Sử dụng hàm count để đếm số lượng phần tử trong mảng
$numFruits = count($fruits);
echo "Số lượng trái cây: " . $numFruits . "\n"; // 3
// Mảng đơn giản
$array = [1, 2, 3, 4];
echo count($array); // Kết quả: 4

// Mảng đa chiều
$array = [1, 2, [3, 4]];
echo count($array); // Kết quả: 3 (vì mảng con không được tính khi sử dụng COUNT_NORMAL)
echo count($array, COUNT_RECURSIVE); // Kết quả: 5 (đếm đệ quy, kể cả phần tử trong mảng con)

// Thêm phần tử vào cuối mảng
array_push($fruits, "Grape", "Pineapple");
echo "Mảng trái cây sau khi thêm: " . implode(", ", $fruits) . "\n";

// Xóa phần tử cuối cùng
array_pop($fruits);
echo "Mảng trái cây sau khi xóa phần tử cuối: " . implode(", ", $fruits) . "\n";

// Xóa phần tử đầu tiên
array_shift($fruits);
echo "Mảng trái cây sau khi xóa phần tử đầu: " . implode(", ", $fruits) . "\n";

// Thêm phần tử vào đầu mảng
array_unshift($fruits, "Mango", "Peach");
echo "Mảng trái cây sau khi thêm vào đầu: " . implode(", ", $fruits) . "\n";

// b) Tìm kiếm và kiểm tra
// Kiểm tra giá trị có tồn tại trong mảng
if (in_array("Banana", $fruits)) {
    echo "Banana có trong mảng trái cây.\n";
} else {
    echo "Banana không có trong mảng trái cây.\n";
}

// Kiểm tra khóa có tồn tại trong mảng kết hợp
if (array_key_exists("city", $person)) {
    echo "Khóa 'city' tồn tại trong mảng.\n";
} else {
    echo "Khóa 'city' không tồn tại trong mảng.\n";
}

// c) Sắp xếp mảng
// Sắp xếp mảng tăng dần
sort($numbers);
echo "Mảng số sắp xếp tăng dần: " . implode(", ", $numbers) . "\n";

// Sắp xếp mảng giảm dần
rsort($numbers);
echo "Mảng số sắp xếp giảm dần: " . implode(", ", $numbers) . "\n";

// Sắp xếp mảng kết hợp tăng dần theo giá trị
asort($person);
echo "Mảng kết hợp sắp xếp theo giá trị: \n";
print_r($person);

// Sắp xếp mảng kết hợp tăng dần theo khóa
ksort($person);
echo "Mảng kết hợp sắp xếp theo khóa: \n";
print_r($person);

// d) Xử lý nâng cao
// Gộp hai mảng lại
$mergedArray = array_merge($fruits, COLORS);
echo "Mảng gộp: " . implode(", ", $mergedArray) . "\n";

// Lấy một phần của mảng
$slicedArray = array_slice($numbers, 1, 3);
echo "Phần cắt của mảng số: " . implode(", ", $slicedArray) . "\n";

// Áp dụng hàm cho từng phần tử của mảng
$squaredNumbers = array_map(function ($num) {
    return $num * $num;
}, $numbers);
echo "Mảng số bình phương: " . implode(", ", $squaredNumbers) . "\n";

// Kết hợp với mảng đa chiều
// Lọc sinh viên có điểm trên 80
$highScorers = array_filter($students, function ($student) {
    return $student["score"] > 80;
});

// Hiển thị danh sách sinh viên có điểm cao
echo "Danh sách sinh viên điểm cao:\n";
foreach ($highScorers as $student) {
    echo $student["name"] . " scored " . $student["score"] . "\n";
}
?>
