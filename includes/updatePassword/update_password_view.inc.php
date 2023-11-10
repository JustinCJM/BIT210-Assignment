<?php

declare (strict_types = 1);

function check_pwd_errors() {
    if (isset($_SESSION["error_pwd"])) {
        $errors = $_SESSION["error_pwd"];

        echo '<script>';
        echo 'alert("Errors: ' . implode('\n', $errors) . '");';
        echo '</script>';

        unset($_SESSION["error_pwd"]);
    }
}