<?php

declare(strict_types = 1);

function check_login_errors() {
    if (isset($_SESSION["error_login"])) {
        $errors = $_SESSION["error_login"];

        echo '<script>';
        echo 'alert("Errors: ' . implode('\n', $errors) . '");';
        echo '</script>';

        unset($_SESSION["error_login"]);
    }
}