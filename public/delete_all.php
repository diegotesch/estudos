<?php
session_start();

ini_set('display_errors', '1');
error_reporting(E_ALL);
require_once "global-functions/functions.php";
require_once "global-functions/connect.php";

remover_concluidas($conn);