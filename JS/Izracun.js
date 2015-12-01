// JavaScript Document

//deklariranje varijabli
var iznos = 0;
var period = 0;
var stopa = 0;

//provjerava jesu li podaci ispravno unešeni
function validacijaUnesenihPodataka() {
	//dodjeljivanje vrijednosti varijablama
	var iznos = document.mojaforma.iznosOrocenja.value;
	var stopa = document.mojaforma.kamatnaStopa.value;
	var period = document.mojaforma.periodOrocenja.value;
						//ako je u polje iznos unešeno nešto što nije broj tada izbaci alert poruku
	if (iznos <= 0 || isNaN(Number(iznos)) ) {
		alert("Niste unijeli pravilan iznos oročenja!");
		document.mojaforma.iznosOrocenja.value = ""; //isprazni polje u koje su uneseni krivi podaci
		}
	else if (stopa <= 0 || isNaN(Number(stopa)) ) {
		alert("Niste unijeli pravilnu kamatnu stopu!");
		document.mojaforma.kamatnaStopa.value = ""; //isprazni polje u koje su uneseni krivi podaci
		}
	else if (period <= 0 || isNaN(Number(period)) ) {
		alert("Niste unijeli pravilan iznos perioda oročenja!");
		document.mojaforma.periodOrocenja.value = ""; //isprazni polje u koje su uneseni krivi podaci
		}
	else {
		izracunaj(parseFloat(iznos), parseFloat(period), parseFloat(stopa)); //ako je sve ispravno unešeno vrati podatke kao broj i izvrši funkciju izracunaj
		}
	}

//funkcija koja izračunava oročenu štednju	
function izracunaj(iznos, period, stopa) {
    /* sM: deklarirao sam lokalnu varijablu tj stavio var*/
    var i = stopa / 100; //kamatna stopa
	
	var buducaVri = iznos * Math.pow((1.0 + i),period); //izračun oročene štednje, formula za izračun
	var ukupneKamate = buducaVri - iznos; //izračun ukupnih kamata
	buducaVri = round(buducaVri, 2); //ispis buduće vrijednosti na dvije decimale
	ukupneKamate = round(ukupneKamate, 2); //isipis ukupnih kamata na dvije decimale

    var ispis = "";

    ispis += "<tr>";
    ispis += "<td>Ukupna kamata: </td>";
    ispis += "<td><div class='col-xs-5'><input type='text' name='zbrojKamata' id='zbrojKamata' class='form-control' value='"+ukupneKamate+"'></div></td>";
    ispis += "</tr>";

    ispis += "<tr>";
    ispis += "<td>Ukupna ostvarena štednja: </td>";
    ispis += "<td><div class='col-xs-5'><input type='text' name='trenutnaVrijednost' id='trenutnaVrijednost' class='form-control' value='"+buducaVri+"'></div></td>";
    ispis += "</tr>";

    document.getElementById("tablica").innerHTML = ispis;

	}

//funkcija koja zaokružuje broj na dvije decimale
function round(broj, dec) {
	return (Math.round(broj*Math.pow(10,dec))/ Math.pow(10,dec)).toFixed(dec);
	}

//funkcija koja briše sve podatke koji su prije uneseni
function resetiraj() {
	document.mojaforma.periodOrocenja.value="";
	document.mojaforma.iznosOrocenja.value="";
	document.mojaforma.kamatnaStopa.value="";
    document.mojaforma.zbrojKamata.value="";
    document.mojaforma.trenutnaVrijednost.value="";

	}