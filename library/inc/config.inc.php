<?php

const DB_HOST = 'localhost';
const DB_LOGIN = 'root';
const DB_PASSWORD = "";
const DB_NAME = 'applications';

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die(mysqli_connect_error());
