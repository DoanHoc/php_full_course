<?php
interface MyInterface {
    public function doSomething();
}

class MyClass22 implements MyInterface {
    public function doSomething() {
        echo "Doing something!";
    }
}

$obj = new MyClass22();
$obj->doSomething(); // Output: Doing something!
