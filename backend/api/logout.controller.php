<?php

    require('backend\services\sessao.controller.php');

    if ($logado) {
        
        session_destroy();
    }