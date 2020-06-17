<?php

namespace App;

class ValidatorUser
{
    public function validate(array $user)
    {

        if (strlen($user['password']) < 4 ) {
            $errors['password'] = "Can't be blank";
        }


        if (strlen($user['login']) < 3) {
            $errors['login'] = "Can't ";
        }

        return $errors;
    }
}