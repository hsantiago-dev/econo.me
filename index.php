<?php

  //Configs iniciais
  $recurso = $_SERVER['REQUEST_URI'] ?? 'index';
  $controlador = "./backend$recurso.controller.php";

  if (file_exists($controlador)) {

    // Existe! Portanto puxe o controller
    require($controlador);
  } else {

    // Serviço não encontrado
    header("HTTP/1.1 500 Internal Server Error");
    echo "Serviço não existente.";
  }
