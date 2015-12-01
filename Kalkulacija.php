<?php
$page_title = "Podaci o štednji";
include_once "header.php";

echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='btn btn-default pull-right'>Izračunaj štednju</a>";
echo "</div>";

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object files
include_once 'config/databaseC.php';
include_once 'objects/podaci.php';

// instantiate database and product object
$database = new \config\databaseC();
$db = $database->getConnection();

$podaci = new \objects\podaci($db);

// query products
$stmt = $podaci->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();

// display the products if there are any
if($num>0){

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Iznos oročenja</th>";
    echo "<th>Period oročenja</th>";
    echo "<th>Kamatna stopa</th>";
    echo "<th>Ukupna ostvarne kamata</th>";
    echo "<th>Ukupna štednja</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        echo "<tr>";
        echo "<td>{$IznosOrocenja}</td>";
        echo "<td>{$Porocenja}</td>";
        echo "<td>{$Kstopa}</td>";
        echo "<td>{$Kamate}</td>";
        echo "<td>{$Tvrijednost}</td>";

        echo "<td>";
        echo "<a href='Podaci_update.php?id={$id}' class='btn btn-default left-margin'>Edit</a>";
        echo "<a delete-id='{$id}' class='btn btn-default delete-object'>Delete</a>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

    include_once 'Lista_podaci.php';
}

// tell the user there are no products
else{
    echo "<div>No products found.</div>";
}

include_once "footer.php";
?>

<script>
    $(document).on('click', '.delete-object', function(){

        var id = $(this).attr('delete-id');
        var q = confirm("Are you sure?");

        if (q == true){

            $.post('Podaci_delete.php', {
                object_id: id
            }, function(data){
                location.reload();
            }).fail(function() {
                    alert('Unable to delete.');
                });

        }

        return false;
    });
</script>