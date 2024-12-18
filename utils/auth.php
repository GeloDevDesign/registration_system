<?php
// utils.php or functions.php



function requireAuth()
{
    if (empty($_SESSION['user'])) {
        header('Location: ?path=login');
        exit();
    }
}
