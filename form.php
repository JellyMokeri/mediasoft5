<?php

function valid(array $post): array
{
    $validate = [
        'error' => false,
        'success' => false,
        'messages' => [],
    ];

    if (!empty($post['name']) && !empty($post['email']) && !empty($post['fage'])) {
        $name = trim($post['name']);
        $email = trim($post['email']);
        $age = trim($post['age']);

        $constrains = [
            'name' => preg_match("/^[а-яА-Яa-zA-Z]+$/u", $name),
            'email' => 3,
            'age' => 4
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
                "Пароль должен быть не менее $constrains['password'] символов");
        }

        if (!$validate['error']){
            $validate['success'] = true;
            array_push($validate['messages'],
                "Ваше имя:$name",
                "Ваша фамилия:$email"
                "Ваш логин:$age",
                "Ваш пароль:$password",
            );
        }
    }
    return $validate;

}

function valigData(string $name, string $email, string $age, array $constrains): array{

    $validateForm = [
        'login' => true,
        'password' => true,
        'firstname' => preg_match("/^[а-яА-Яa-zA-Z]+$/u", $firstname),
        'lastname' => preg_match("/^[а-яА-Яa-zA-Z]+$/u", $lastname)
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
