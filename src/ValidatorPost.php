<?php

namespace App;

class ValidatorPost
{
    public function validate($post)
    {
        $errors = [];
        if ($post['name'] === ' ') {
            $errors['name'] = "Can't ";
        }

        if (strlen($post['post']) < 15) {
            $errors['post'] = "Can't be blank";
        }

        return $errors;
    }
}