<?php

  //Configs iniciais
  $recurso = $_SERVER['REQUEST_URI'] ?? 'index';
  $controlador = explode("?","./backend$recurso");

  header('Content-Type: application/json; charset=utf-8');

  if (isset($_SERVER['HTTP_ORIGIN'])) {
    
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
  }
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
  }

  if (file_exists($controlador[0])) {

    // Existe! Portanto puxe o controller
    require($controlador[0]);
  } else {

    // Serviço não encontrado
    header("HTTP/1.0 404 Not Found");
  }
