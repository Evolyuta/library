<?php

function clearStr($data)
{
    global $link;
    $data = trim(strip_tags($data));
    return mysqli_real_escape_string($link, $data);
}

function addItemToList($name, $address, $phone, $email, $msg, $date)
{
    global $link;
    $sql = 'INSERT INTO applications (name, address, phone, email, msg, datetime) VALUES (?,?,?,?,?,?)';

    if (!$stmt = mysqli_prepare($link, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $address, $phone, $email, $msg, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}
