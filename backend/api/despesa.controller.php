<?php

    require('backend\services\sessao.controller.php');

    if ($logado) {
        
        echo "{\"despesas\": [ \"despesa 1\", \"despesa 2\", \"despesa 3\" ]}";
    }