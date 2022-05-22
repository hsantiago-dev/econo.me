<?php

  //Configs iniciais
 

  $rotas = [
    "/usuario" => "./backend/api/usuario.controller.php",
    "/despesa" => "./backend/api/despesa.controller.php",
    "/login" => "./backend/api/login.controller.php",
    "/logout" => "./backend/api/logout.controller.php",
    "/recuperar_senha" => "./backend/api/recuperar_senha.controller.php",
    "/tipo_despesa" => "./backend/api/tipo_despesa.controller.php",
    "/teste" => "./backend/api/teste.controller.php"
  ];
  require 'backend\vendor\autoload.php';
  $recurso = $_SERVER['REQUEST_URI'] ?? 'index';
  $controlador = explode("?",$recurso)[0];

  header('Content-Type: application/json; charset=utf-8');

  if (isset($_SERVER['HTTP_ORIGIN'])) {
    
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
  }
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: *");
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
  }

  //if (file_exists($controlador[0])) {

    // Existe! Portanto puxe o controller
   // require($controlador[0]);

    if (array_key_exists($controlador,$rotas)){

    require($rotas[$controlador]);

  } else {

    // Serviço não encontrado
    header("HTTP/1.0 404 Not Found");
  }