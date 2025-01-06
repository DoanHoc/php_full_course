<?php

// 1. PHP What is OOP
// ----------------------------------
// Giới thiệu OOP: Lập trình hướng đối tượng dựa trên khái niệm "lớp" và "đối tượng".
// Lớp (class) là khuôn mẫu để tạo ra đối tượng. Đối tượng (object) là thực thể cụ thể từ lớp.

echo "1. PHP What is OOP\n";
echo "OOP (Object-Oriented Programming) là một phương pháp lập trình dựa trên các đối tượng.\n\n";

// 2. PHP Classes/Objects
// ----------------------------------
// Lớp và đối tượng: Mỗi lớp chứa thuộc tính (dữ liệu) và phương thức (hành vi).
class Car {
    public $brand; // Thuộc tính
    public $color;

    // Phương thức
    public function drive() {
        return "Driving a " . $this->color . " " . $this->brand;
    }
}

// Tạo đối tượng từ lớp
$myCar = new Car();
$myCar->brand = "Toyota";
$myCar->color = "Red";
echo "2. PHP Classes/Objects\n";
echo $myCar->drive() . "\n\n"; // Output: Driving a Red Toyota

// 3. PHP Constructor
// ----------------------------------
// Constructor: Phương thức khởi tạo tự động gọi khi đối tượng được tạo.
// khi khởi tạo 1 class thì contructsor sẽ đảm nhiệm vai trò gán giá trị ban đầu cho các biến trong class, nếu không có phải thực hiện gán thủ công
class User {
    public $name;

    public function __construct($name) { // Constructor
        $this->name = $name;
    }
}

$user = new User("Alice"); // Khởi tạo giá trị $name qua constructor
echo "3. PHP Constructor\n";
echo $user->name . "\n\n"; // Output: Alice

// gán thủ công khi không dùng constructor
// $user = new User();
// $user->name = "Alice";


// 4. PHP Destructor
// ----------------------------------
// Destructor: Phương thức tự động gọi khi đối tượng bị hủy, thường dùng để dọn dẹp tài nguyên.
// Giải phóng tài nguyên (đóng kết nối cơ sở dữ liệu, đóng file, giải phóng bộ nhớ, v.v.).
// Ghi lại log hoặc thực hiện các tác vụ dọn dẹp khác.
// Đảm bảo các tác vụ quan trọng được thực hiện trước khi đối tượng không còn tồn tại.
class Test {
    public function __destruct() {
        echo "Object destroyed\n";
    }
}

echo "4. PHP Destructor\n";
$obj = new Test();
//lưu ý __destruct() được tự động gọi khi chương trình kết thúc và đối tượng $obj không còn cần thiết.
//Không nên tạo các đối tượng mới trong destructor:
class LoopDestruct {
    public function __destruct() {
        $obj = new LoopDestruct(); // Có thể gây vòng lặp vô hạn
    }
}
//Thứ tự gọi destructor:
class A {
    public function __destruct() {
        echo "Destroying A\n";
    }
}

class B {
    public function __destruct() {
        echo "Destroying B\n";
    }
}
$a = new A();
$b = new B();
// Destroying B
// Destroying A
// Nếu không định nghĩa __destruct(), PHP sẽ tự động giải phóng tài nguyên cho đối tượng.

// 5. PHP Access Modifiers
// ----------------------------------
// Access modifiers (public, private, protected): Quản lý quyền truy cập thuộc tính/phương thức.

class MyClass {
    public $publicNumber;    // Có thể truy cập từ bất kỳ đâu
    private $privateNumber;   // Chỉ có thể truy cập trong lớp này
    protected $protectedNumber; // Có thể truy cập trong lớp này và lớp con

    public function __construct($pub, $priv, $prot) {
        $this->publicNumber = $pub;
        $this->privateNumber = $priv;
        $this->protectedNumber = $prot;
    }

    public function setPublicNumber($num) {
        $this->publicNumber = $num;
    }

    private function setPrivateNumber($num) {
        $this->privateNumber = $num;
    }

    protected function setProtectedNumber($num) {
        $this->protectedNumber = $num;
    }
    
    public function displayNumbers() {
        echo "Public: $this->publicNumber\n";
        echo "Private: $this->privateNumber\n";
        echo "Protected: $this->protectedNumber\n";
    }
}

class SubClass extends MyClass {
    public function changeProtectedNumber($num) {
        $this->setPublicNumber(1);
    }
}

// Tạo đối tượng MyClass truy cập bên ngoài
$myObject = new MyClass(10, 20, 30);
$myObject->setPublicNumber(100);
$myObject->displayNumbers();
// $myObject->publicNumber; không lỗi
// $myObject->protectedNumber; lỗi


// Tạo đối tượng SubClass
$subClassObject = new SubClass(1, 2, 3);
$subClassObject->changeProtectedNumber(200);
$subClassObject->setPublicNumber(500);
$subClassObject->displayNumbers();

// 6. PHP Inheritance
// ----------------------------------
// Inheritance: Một lớp có thể kế thừa thuộc tính và phương thức từ lớp cha.
class ParentClass {
    public function sayHello() {
        return "Hello from Parent";
    }
}

class ChildClass extends ParentClass {
    // Không cần định nghĩa lại phương thức sayHello()
}

$child = new ChildClass();
echo "6. PHP Inheritance\n";
echo $child->sayHello() . "\n\n"; // Output: Hello from Parent

// 7. PHP Constants
// ----------------------------------
// Constants: Hằng số trong lớp, không thể thay đổi sau khi khai báo.
// Không thay đổi giá trị: Một khi đã khai báo, giá trị của hằng số không thể thay đổi.
// Không cần ký hiệu $: Khác với biến, hằng số không cần dấu $ ở trước tên.
// Phạm vi toàn cục (Global Scope): Hằng số có thể được truy cập từ bất kỳ nơi nào trong mã, bất kể phạm vi (scope).
// Tên phải tuân thủ quy tắc đặt tên:
// Bắt đầu bằng chữ cái hoặc dấu gạch dưới _.
// Không được bắt đầu bằng số.
// Tên hằng số thường viết in hoa để phân biệt với biến.
// Khác với define, const có thể Khai báo bên trong lớp, define thì không

define("PI", 3.14159);
class Config {
    const APP_NAME = "MyApp"; // Định nghĩa hằng số
  
}

echo "7. PHP Constants\n";
echo Config::APP_NAME . "\n\n"; // Output: MyApp

// 8. PHP Abstract Classes
// ----------------------------------
// Abstract class: Lớp trừu tượng không thể tạo đối tượng trực tiếp, dùng để định nghĩa hành vi chung.
// Các lớp con kế thừa bắt buộc phải có Phương thức abstract của hàm cha
// Có thể gọi hàm kế thừa từ hàm cha

// Lớp abstract
abstract class Animal {
    // Phương thức bình thường (có phần thân)
    public function eat() {
        echo "Eating...\n";
    }

    // Phương thức abstract (không có phần thân, phải triển khai trong lớp con)
    abstract public function makeSound();
}

// Lớp con kế thừa lớp abstract
class Dog extends Animal {
    // Triển khai phương thức abstract
    public function makeSound() {
        echo "Woof!\n";
    }
}

// Lớp con kế thừa lớp abstract
class Cat extends Animal {
    // Triển khai phương thức abstract
    public function makeSound() {
        echo "Meow!\n";
    }
}

// Tạo đối tượng của lớp con
$dog = new Dog();
$dog->eat();         // Kế thừa từ lớp abstract
$dog->makeSound();   // Triển khai trong lớp con

$cat = new Cat();
$cat->eat();         // Kế thừa từ lớp abstract
$cat->makeSound();   // Triển khai trong lớp con

// 9. PHP Interfaces
// ----------------------------------
// Interface: Tập hợp các phương thức mà lớp phải triển khai, không chứa logic (thân hàm).
// Các lớp con kế thừa bắt buộc phải có Phương thức của hàm cha


// Định nghĩa một interface
interface AnimalInterface {
    public function makeSound();  // Phương thức chỉ có khai báo, không có phần thân
    public function eat();        // Phương thức chỉ có khai báo, không có phần thân
}

// Lớp Dog thực thi interface AnimalInterface
class Chicken implements AnimalInterface {
    // Triển khai phương thức makeSound
    public function makeSound() {
        echo "Oooooo!\n";
    }
    
    // Triển khai phương thức eat
    public function eat() {
        echo "Eating food...\n";
    }
}

// Tạo đối tượng Chicken và gọi các phương thức
$dog = new Chicken();
$dog->makeSound();  // Output: Woof!
$dog->eat();        // Output: Eating food...



// 10. PHP Traits
// ----------------------------------
// Traits: Cho phép dùng lại các phương thức trong nhiều lớp, giải quyết hạn chế kế thừa đơn.
// PHP chỉ hỗ trợ kế thừa đơn (một lớp chỉ có thể kế thừa từ một lớp cha duy nhất) dùng traits sẽ giải quyết được vấn đề này
// 
// Định nghĩa một Trait
trait MyTrait {
    public function greet() {
        echo "Hello from Trait!\n";
    }

    public function sayGoodbye() {
        echo "Goodbye from Trait!\n";
    }
}

// **Lớp sử dụng Trait**
class MyClassNew {
    use MyTrait;  // Sử dụng Trait MyTrait
    
    public function helloWorld() {
        echo "Hello World!\n";
    }
}

// Tạo đối tượng của lớp MyClass
$obj = new MyClassNew();
$obj->greet();           // Output: Hello from Trait!
$obj->sayGoodbye();      // Output: Goodbye from Trait!
$obj->helloWorld();      // Output: Hello World!


// **Trường hợp 2 train**
// Định nghĩa Trait A
trait TraitA {
    public function methodA() {
        echo "Method A from TraitA\n";
    }
}

// Định nghĩa Trait B
trait TraitB {
    public function methodB() {
        echo "Method B from TraitB\n";
    }
}

// Lớp sử dụng cả hai Traits
class MyClass1 {
    use TraitA, TraitB;  // Sử dụng cả TraitA và TraitB
}

// Tạo đối tượng của lớp MyClass
$obj = new MyClass1();
$obj->methodA();  // Output: Method A from TraitA
$obj->methodB();  // Output: Method B from TraitB



// **Trường hợp xung đột function giữa 2 traits**
// Định nghĩa Trait C
trait TraitC {
    public function method() {
        echo "Method from TraitC\n";
    }
}

// Định nghĩa Trait D
trait TraitD {
    public function method() {
        echo "Method from TraitD\n";
    }
}

// Lớp sử dụng cả hai Traits
class MyClass2 {
    use TraitC, TraitD {
        TraitC::method insteadof TraitD;  // Sử dụng phương thức từ TraitC thay vì TraitD
    }
}

// Tạo đối tượng của lớp MyClass
$obj = new MyClass2();
$obj->method();  // Output: Method from TraitC

// 11. PHP Static Methods
// ----------------------------------
// Static method: Phương thức tĩnh không cần tạo đối tượng để gọi.
class Math {
    public static function add($a, $b) {
        return $a + $b;
    }
}

echo "11. PHP Static Methods\n";
echo Math::add(2, 3) . "\n\n"; // Output: 5

// 12. PHP Static Properties
// ----------------------------------
// Static property: Thuộc tính tĩnh dùng chung cho tất cả các đối tượng của lớp.
// Không cần tạo đối tượng: Phương thức tĩnh có thể được gọi mà không cần phải tạo một đối tượng của lớp.
// Chỉ có thể truy cập thông qua tên lớp cú pháp MyClass::staticMethod();
// Thay $this-> bằng self::,parent:: để truy cập thuộc tính và phương thức tĩnh

class MyClass1111 {
    public $instanceVar = "I am an instance variable";
    public static $staticVar = "I am a static variable";

    // Instance method
    public function instanceMethod() {
        echo "This is an instance method.\n";
        echo "Accessing instance variable: " . $this->instanceVar . "\n";
    }

    // Static method
    public static function staticMethod() {
        echo "This is a static method.\n";
        echo "Accessing static variable: " . self::$staticVar . "\n";
    }
}
// Lớp con kế thừa MyClass1111
class MyClassChild extends MyClass1111 {

    // Phương thức static trong lớp con
    public static function staticMethod() {
        // Gọi phương thức static của lớp cha bằng parent::
        parent::staticMethod();  // Gọi phương thức static của lớp cha
        echo "This is an additional message from MyClassChild.\n";
    }
}

// Gọi phương thức instance
$obj = new MyClass1111();
$obj->instanceMethod();  // Output: This is an instance method. Accessing instance variable: I am an instance variable

// Gọi phương thức static
MyClass1111::staticMethod();  // Output: This is a static method. Accessing static variable: I am a static variable
MyClassChild::staticMethod();

// 13. PHP Namespaces
// ----------------------------------
// Namespaces: Giúp tránh xung đột tên trong các dự án lớn.
// Namespaces cung cấp một không gian riêng biệt cho từng nhóm.
// Namespace được khai báo ở đầu tệp PHP, trước bất kỳ mã nào khác (ngoại trừ các câu lệnh declare)


// namespace MyApp;
// class MyClass {
//     public function sayHello() {
//         echo "Hello from MyApp!";
//     }
// }

// Tệp khác
require 'MyApp.php';

$obj = new \MyApp\MyClass(); // Tham chiếu đầy đủ namespace
$obj->sayHello(); // Output: Hello from MyApp!

// hoặc dùng từ khóa use
// use MyApp\MyClass as Fmt;
// $obj = new MyClass(); // Không cần tham chiếu đầy đủ
// $obj->sayHello(); // Output: Hello from MyApp!
// Fmt::statictismethod();

// 14. PHP Iterables
// ----------------------------------
// Iterables: Dữ liệu có thể duyệt qua như mảng hoặc iterator.
function printIterable(iterable $items) {
    foreach ($items as $item) {
        echo $item . "\n";
    }
}

class MyIterator implements Iterator {
    private $data = ["X", "Y", "Z"];
    private $index = 0;

    // Trả về phần tử hiện tại
    public function current(): mixed {
        return $this->data[$this->index];
    }

    // Trả về khóa hiện tại
    public function key(): int {
        return $this->index;
    }

    // Di chuyển con trỏ đến phần tử tiếp theo
    public function next(): void {
        $this->index++;
    }

    // Đặt lại con trỏ về phần tử đầu tiên
    public function rewind(): void {
        $this->index = 0;
    }

    // Kiểm tra xem phần tử hiện tại có hợp lệ hay không
    public function valid(): bool {
        return isset($this->data[$this->index]);
    }
}

// Sử dụng lớp MyIterator
$iterator = new MyIterator();
foreach ($iterator as $key => $value) {
    echo "Key: $key, Value: $value\n";
}

// Output:
// Key: 0, Value: X
// Key: 1, Value: Y
// Key: 2, Value: Z

$items = ["Apple", "Banana", "Cherry"];
echo "14. PHP Iterables\n";
printIterable($items);
// Output:
// Apple
// Banana
// Cherry
