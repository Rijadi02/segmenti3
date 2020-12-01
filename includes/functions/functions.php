<?php

function bhash($password)
{
    $options = [
        'cost' => 12
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}

function bcheck($password,$hash)
{
    return password_verify($password, $hash);
}

