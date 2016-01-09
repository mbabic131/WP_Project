<?php

if(isset($_GET['id'])){

    // include database and object file
    include_once 'config/databaseC.php';
    include_once 'objects/podaci.php';

    // get database connection
    $database = new \config\databaseC();
    $db = $database->getConnection();

    // prepare row object
    $podaci = new \objects\podaci($db);

    // set row id to be deleted
    $podaci->id = $_GET['id'];

    // delete the row
    if($podaci->delete()){

        header("Location: Kalkulacija.php?deleted");
    }

    // if unable to delete the row
    else {

        header("Location: Kalkulacija.php?warning");
    }
}
?>