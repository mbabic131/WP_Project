<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once 'config/databaseC.php';
    include_once 'objects/podaci.php';

    // get database connection
    $database = new \config\databaseC();
    $db = $database->getConnection();

    // prepare row object
    $podaci = new \objects\podaci($db);

    // set row id to be deleted
    $podaci->id = $_POST['object_id'];

    // delete the row
    if($podaci->delete()){
        echo "Podaci su obrisani.";
    }

    // if unable to delete the row
    else{
        echo "Brisanje podataka nije uspjelo.";

    }
}
?>