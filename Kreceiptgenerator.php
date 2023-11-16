<?php
        require_once "includes/config_session.inc.php";
        require_once "Kpayment_init.php";
        require_once 'Kreceipt.php';
        require_once 'includes/dbh.inc.php';
        $info = $_SESSION["info"];
        $products_info = $_SESSION["productInfo"];
        generateReceipt($info, $products_info);
        ?>