<?php
session_start();

$page_title = "IZRAČUN OROČENE ŠTEDNJE PO DOSPIJEĆU DEPOZITA";
include_once "header.php";
?>

<?php
if(isset($_SESSION['username'])) {

echo "<a href='public/login.php?action=logout'>Log out</a>";
echo "<div class='right-button-margin'>";
echo "<a href='Kalkulacija.php' class='btn btn-default pull-right'>Prikaži podatke o štednji</a>";
echo "</div>";

// get database connection
include_once 'config/databaseC.php';

$database = new \config\databaseC();
$db = $database->getConnection();

// if the form was submitted
if($_POST){

    include_once 'objects/podaci.php';
    $podaci = new \objects\podaci($db);

    $podaci->iznosOrocenja = $_POST['iznosOrocenja'];
    $podaci->periodOrocenja = $_POST['periodOrocenja'];
    $podaci->kamatnaStopa = $_POST['kamatnaStopa'];
    $podaci->zbrojKamata = $_POST['zbrojKamata'];
    $podaci->trenutnaVrijednost = $_POST['trenutnaVrijednost'];


    if($podaci->create()){
        echo "<div class=\"alert alert-success alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Podaci su spremljeni.";
        echo "</div>";
    }

    else{
        echo "<div class=\"alert alert-danger alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Pohranjivanje podataka nije uspjelo.";
        echo "</div>";
    }
}   

?>

    <html>
    <head>
        <script type="text/javascript" src="JS/Izracun.js"></script>
    </head>
    <body>

    <form name="mojaforma" action='index.php' method='post'>

        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <td>Iznos oročenja:</label></td>
                <td><div class="col-xs-5"><input type='text' name="iznosOrocenja" id="iznos" value="0" class='form-control' required></div></td>
            </tr>

            <tr>
                <td>Period oročenja:</td>
                <td><div class="col-xs-5"> <input type='text' name="periodOrocenja" maxlength="5" id="period" value="0" class='form-control' required></div></td>
            </tr>

            <tr>
                <td>Kamatna stopa: </td>
                <td><div class="col-xs-5"><input type='text' name="kamatnaStopa" maxlength="5" id="stopa" value="0" class='form-control' required></div></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="button" name="Izračunaj" value="Izračunaj" onclick="validacijaUnesenihPodataka()" class="btn btn-primary">Izračunaj</button>
                    <button type="button" name="KreniPonovno" value="Novi Izračun" onclick="resetiraj()" class="btn btn-primary">Resetiraj</button>
                    <button type="submit" class="btn btn-success">Spremi </button>
                </td>
            </tr>
        </table>

        <table class='table table-hover table-responsive table-bordered' id="tablica">
        </table>

    </form>

    </body>
    </html>

<?php } else { ?>

    <h4>Za nastavak korištenja aplikacije morate se <a href="public/login.php">prijaviti</a> ili <a href="">registrirati.</a></h4>
    
<?php } ?>


<?php
include_once "footer.php";
?>