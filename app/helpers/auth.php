<?php

function isLogged()
{
    return isset($_SESSION['user']);
}

function auth()
{
    return (object)$_SESSION['user'];
}

function email()
{
    return auth()->email;
}
