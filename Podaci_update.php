<?php
session_start();

$page_title = "Izmjeni podatke";
include_once "header.php";

if(isset($_SESSION['username'])) {

    echo "<div class='right-button-margin'>";
    echo "<a href='Kalkulacija.php' class='btn btn-default pull-right'>Prikaži podatke o štednji</a>";
    echo "</div>";

    // get ID of the row to be edited
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    // include database and object files
    include_once 'config/databaseC.php';
    include_once 'objects/podaci.php';

    // get database connection
    $database = new \config\databaseC();
    $db = $database->getConnection();

    // prepare row object
    $podaci = new \objects\podaci($db);

    // set ID property of row to be edited
    $podaci->id = $id;

    // read the details of row to be edited
    $podaci->readOne();

    if(isset($_GET['success'])) {

        $podaci->message($podaci->update());
    }

    if(isset($_GET['warning'])) {

        echo "<div class=\"alert alert-danger alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Niste unijeli ispravne podatke.";
        echo "</div>";
    }

?>

<form action='' method='post'>

    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Iznos oročenja:</td>
            <td><input type='text' name="iznosOrocenja" id="iznos" value="<?php echo $podaci->iznosOrocenja; ?>" class='form-control' required></td>
        </tr>

        <tr>
            <td>Period oročenja:</td>
            <td><input type='text' name="periodOrocenja" maxlength="5" id="period" value="<?php echo $podaci->periodOrocenja; ?>" class='form-control' required></td>
        </tr>

        <tr>
            <td>Kamatna stopa: </td>
            <td><input type='text' name="kamatnaStopa" maxlength="5" id="stopa" value="<?php echo $podaci->kamatnaStopa; ?>" class='form-control' required></td>
        </tr>

        <tr>
            <td>Ukupna kamata: </td>
            <td><input type='text' name="zbrojKamata" id="zbrojKamata" value="<?php echo $podaci->zbrojKamata; ?>" class='form-control' ></td>
        </tr>

        <tr>
            <td>Ukupna ostvarena štednja: </td>
            <td><input type='text' name="trenutnaVrijednost" id="trenutnaVrijednost" value="<?php echo $podaci->trenutnaVrijednost; ?>" class='form-control' ></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" name="submit" class="btn btn-primary">Izmjeni</button>
            </td>
        </tr>

    </table>
</form>

<?php
include_once 'helpers/validation.php';
// if the form was submitted
if(isset($_POST['submit'])){

    // set row property values
    $iznos = $_POST['iznosOrocenja'];
    $period = $_POST['periodOrocenja'];
    $stopa = $_POST['kamatnaStopa'];
    $kamate = $_POST['zbrojKamata'];
    $vrijednost = $_POST['trenutnaVrijednost'];

    $podaci->iznosOrocenja = $iznos;
    $podaci->periodOrocenja = $period;
    $podaci->kamatnaStopa = $stopa;
    $podaci->zbrojKamata = $kamate;
    $podaci->trenutnaVrijednost = $vrijednost;

    if(validate_input($iznos, 1, 50) && validate_input($period, 1, 10) && validate_input($stopa, 1, 25) && validate_input($kamate, 1, 50) && validate_input($vrijednost, 1, 50))
    {
        // update the row
        if($podaci->update()) {

            header("Location: Podaci_update.php?id=$id&success");
        }

    } else {

            header("Location: Podaci_update.php?id=$id&warning");
    }
}
 
?>

<?php } ?>

<?php require_once "footer.php"; ?>