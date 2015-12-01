<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once 'config/databaseC.php';
    include_once 'objects/podaci.php';

    // get database connection
    $database = new \config\databaseC();
    $db = $database->getConnection();

    // prepare product object
    $podaci = new \objects\podaci($db);

    // set product id to be deleted
    $podaci->id = $_POST['object_id'];

    // delete the product
    if($podaci->delete()){
        echo "Podaci su obrisani.";
    }

    // if unable to delete the product
    else{
        echo "Brisanje podataka nije uspjelo.";

    }
}
?>