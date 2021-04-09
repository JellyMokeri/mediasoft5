<?php

$host = 'localhost';
$dbname = 'test1';
$port = '5432';
$user = 'postgres';
$password = 'admin';


$conn = new PDO("pgsql:host={$host};port={$port};dbname={$dbname};user={$user};password={$password}");

function getUsers (): array {
    global $conn;
    return $conn->query('select * from users')->fetchAll(PDO::FETCH_ASSOC);

}

function q($post) {
    
    global $conn;
    $st = $conn->prepare("insert into users (name, email, age, work_id) values (?, ?, ?, ?)");

    $st->execute([
        $post['name'],
        $post['email'],
        $post['age'],
        0,
    ]);

function valid(array $post): array
{
    $validate = [
        'error' => false,
        'success' => false,
        'messages' => [],
    ];

    if (!empty($post['name']) && !empty($post['email']) && !empty($post['age'])) {
        $name = trim($post['name']);
        $email = trim($post['email']);
        $age = trim($post['age']);

        $constrains = [
            'name' => preg_match("/^[а-яА-Яa-zA-Z]+$/u", $name),
            'email' => 3,
            'age' => preg_match("/^[а-яА-Яa-zA-Z]+$/u", $name),
        ];

        $validateForm = valigData($name, $email, $age, $constrains);      
      
        if (!$validateForm['name']) {
            array_push($validate['messages'],
                "Имя не должно содержать цифр");
        }

        if (!$validateForm['email']) {
            array_push($validate['messages'],
                "Логин должен быть не менее $constrains['login'] символов");
        }

        if (!$validateForm['age']) {
            array_push($validate['messages'],
                "Возраст может содержать только цифры");
        }

        if (!$validate['error']){
            $validate['success'] = true;
            array_push($validate['messages'],
                "Ваше имя:$name",
                "Ваша почта:$email"
                "Ваш возраст:$age",
            );
        }
    }
    return $validate;

}

function valigData(string $name, string $email, string $age, array $constrains): array{

    $validateForm = [
        'name' => true,
        'email' => true,
        'age' => true,
    ];

    if (strlen($login) < $constrains['login']) {
        $validateForm['login'] = false;
    }

    if (strlen($password) < $constrains['password']) {
        $validateForm['password'] = false;
    }

    if (!$name) {
        $validateForm['firstname'] = false;
    }

    return $validateForm;

}
