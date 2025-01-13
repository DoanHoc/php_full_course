<?php
## Cấu trúc giải thuật của Array

// Mục đích của FNV-1a là ánh xạ một chuỗi ký tự (hoặc bất kỳ tập dữ liệu nào) thành một giá trị hash cố định. Mỗi giá trị này sẽ đại diện cho chuỗi ban đầu và có thể được sử dụng trong các hệ thống như bảng băm (hash table), kiểm tra dữ liệu, tìm kiếm, hoặc phát hiện xung đột trong các hệ thống phân tán.
// Thuật toán FNV-1a sử dụng một giá trị khởi tạo gọi là FNV offset basis và một hằng số băm gọi là FNV prime để tính toán mã băm.


// FNV-1a 32-bit constants 
define('FNV_OFFSET_BASIS', 2166136261); // tránh Xung đột hash (Collisions)
define('FNV_PRIME', 16777619); // tránh Xung đột hash (Collisions)

// Hàm tính hashcode FNV-1a cho một chuỗi
function fnv1a_hash_32bit($input)
{
    $hash = FNV_OFFSET_BASIS;
    // Duyệt qua từng ký tự trong chuỗi
    foreach (str_split($input) as $char) {
        // XOR với mã ASCII của ký tự và nhân với FNV prime
        $hash ^= ord($char);
        $hash *= FNV_PRIME;

        // hash = (hash XOR 98) * 16777619
        // hash = (2166136261 XOR 98) * 16777619
        // hash = 2166136243 * 16777619
        // hash = 36342608513105757

        // Đảm bảo giá trị hash luôn trong phạm vi 32-bit
        $hash &= 0xFFFFFFFF; // Mask để giữ lại 32-bit cuối cùng
    }
    return $hash;
}

// Khởi tạo:
// hash = 2166136261

// Sau ký tự 'b':
// hash = (2166136261 XOR 98) * 16777619 = 1910100725

// Sau ký tự 'a':
// hash = (1910100725 XOR 97) * 16777619 = 253838742

// Sau ký tự 'n':
// hash = (253838742 XOR 110) * 16777619 = 2165834776

// Sau ký tự 'a':
// hash = (2165834776 XOR 97) * 16777619 = 3137635973

// Sau ký tự 'n':
// hash = (3137635973 XOR 110) * 16777619 = 3277669481

// Sau ký tự 'a':
// hash = (3277669481 XOR 97) * 16777619 = 1780907792
array(
    [1] => array(
        ['key_hash'] => 1965065204,
        ['value_hash'] => 1780907792,
    ),

    [2] => array(
        ['key_hash'] => 1965065203,
        ['value_hash'] => 1228994713,
    )
);



// Mảng cần tính hashcode
$a = [1 => "banana", 2 => "apple"];

// Mảng lưu trữ các hashcode
$hashcodes = [];

foreach ($a as $key => $value) {
    // Tính hashcode cho khóa (key)
    $key_hash = fnv1a_hash_32bit((string)$key);

    // Tính hashcode cho giá trị (value)
    $value_hash = fnv1a_hash_32bit($value);

    // Lưu vào mảng kết quả
    $hashcodes["key_$key"] = $key_hash;
    $hashcodes["value_$value"] = $value_hash;
}

// In kết quả
print_r($hashcodes);
// Lưu ý Hashcode chỉ là một giá trị tạm thời không được lưu trữ:
