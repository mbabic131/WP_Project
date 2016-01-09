<?php
session_start();
include 'public/modal_delete.php';

$page_title = "Podaci o štednji";
include_once "header.php";

if(isset($_SESSION['username'])) {

    echo "<p><a href='public/login.php?action=logout'>Odjavi se</a></p>";
    echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Izračunaj štednju</a>";
    echo "</div>";

    //show the message if the user are deleted some data
    if(isset($_GET['deleted'])) {

        echo "<div class=\"alert alert-success alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Podaci su uspješno obrisani";
        echo "</div>";
    }

    elseif(isset($_GET['warning'])) {

        echo "<div class=\"alert alert-danger alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Pogreška prilikom brisanja podataka.";
        echo "</div>";
    }

    // page given in URL parameter, default page is one
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // set number of records per page
    $records_per_page = 5;

    // calculate for the query LIMIT clause
    $from_record_num = ($records_per_page * $page) - $records_per_page;

    // include database and object files
    include_once 'config/databaseC.php';
    include_once 'objects/podaci.php';

    // instantiate database and row object
    $database = new \config\databaseC();
    $db = $database->getConnection();

    $podaci = new \objects\podaci($db);

    // query rows
    $stmt = $podaci->readAll($page, $from_record_num, $records_per_page);
    $num = $stmt->rowCount();

    // display the rows if there are any
    if($num>0){

        echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
        echo "<th>Iznos oročenja</th>";
        echo "<th>Period oročenja</th>";
        echo "<th>Kamatna stopa</th>";
        echo "<th>Ukupna ostvarne kamata</th>";
        echo "<th>Ukupna štednja</th>";
        echo "<th>#</th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            extract($row);

            echo "<tr>";
            echo "<td>{$IznosOrocenja}</td>";
            echo "<td>{$Porocenja}</td>";
            echo "<td>{$Kstopa}</td>";
            echo "<td>{$Kamate}</td>";
            echo "<td>{$Tvrijednost}</td>";

            echo "<td>";
            echo "<a href='Podaci_update.php?id={$id}' class='btn btn-default left-margin'>Edit</a>";
            //echo "<a delete-id='{$id}' class='btn btn-default delete-object'>Delete</a>";
            echo "<a rel='$id' href='javascript:void(0)' class='delete_link btn btn-default'>Delete</a>";
            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";

        include_once 'Lista_podaci.php';

    } else {

        echo "<hr><div class='col-md-6 col-md-offset-3'><h3 style='text-center'>Nemate spremljenih podataka.</h3></div>";
    }

} else {

    echo "<h5>Za prikaz podataka morate se <a href='public/login.php?action=login'>prijaviti</a> ili <a href='public/registration.php'>registrirati.</a></h5>";
}

include_once "footer.php";

?>

<script>

//Old version of delete function
/*    $(document).on('click', '.delete-object', function(){

        var id = $(this).attr('delete-id');
        var q = confirm("Jeste li sigurni?");

        if (q == true){

            $.post('Podaci_delete.php', {
                object_id: id
            }, function(data){
                location.reload();
            }).fail(function() {
                    alert('Brisanje nije uspjelo!.');
                });

        }

        return false;
    });*/


//Show the delete modal and include delete page
    $(document).ready(function(){
        
        $(".delete_link").on("click", function() {
            
            var id = $(this).attr("rel");
            var delete_url = "Podaci_delete.php?id="+id;
            
            $(".modal_delete_link").attr("href", delete_url);
            
            $("#myModal").modal('show');
            
        });
    });

</script>