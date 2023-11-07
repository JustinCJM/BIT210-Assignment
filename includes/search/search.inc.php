<?php

if(isset($_POST['submit'])) {

    require_once 'includes/dbh.inc.php';
    require_once 'includes/search/search_model.inc.php';
    require_once 'includes/search/search_contr.inc.php';
    require_once 'includes/search/search_view.inc.php';

    $search = $_POST["search"];

    search_method($mysqli, $search);

}