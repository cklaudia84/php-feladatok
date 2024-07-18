	<!DOCTYPE html>
<html lang="hu">
<head>
	
	<meta charset="UTF-8">
	
	<title>Mennyit tankolj?</title>
    
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    
    <meta name="format-detection" content="telephone=no">
	<meta name="msapplication-tap-highlight" content="no">
	
	<link rel="stylesheet" href="src/style.css">
	<link rel="stylesheet" href="src/fontawesome5/css/all.css">
	
</head>
<body>

	<div id="title-bar">
		<h1>
			<i class="fas fa-tint"></i>
			Mennyit tankolj?
		</h1>
	</div>
<div id="main">
		<div class="inside">

			<section>
				
				<h2>Milyen hosszú útra készülsz?</h2>
				
				<form action="" method="get">

<?php
/* Az űrlap elküldését követően lesz az URL-ben distance, avg és price paraméter
Az "eredmények" rész csak akkor jelenjen meg, ha léteznek ilyen paraméterek
A számolt értékek pedig a paraméterek értékei alapján
Átlagfogyasztás: hány litert fogyaszt 100km megtétele alatt */

$distance = 0.0;
if(isset($_GET['distance']))
{ 
	$distance = $distance + $_GET['distance'];
}
echo'<div>
	<label for="distance">Távolság (km)</label>
	<input type="number" step = 0.01 id="distance" value="'. $distance .'" name="distance">
	</div>';

$avg = 0.0;
if(isset($_GET['avg']))
{
	$avg = $avg + $_GET['avg'];
}
	echo'<div>
		<label for="avg">Átlagfogyasztás (L/100km)</label>
		<input type="number" step = 0.01 id="avg" value="'. $avg .'" name="avg">
		</div>';

$price = 0.0;
if(isset($_GET['price']))
{
	$price = $price + $_GET['price'];
}
	echo'<div>
		<label for="price">Üzemanyagár (HUF/L)</label>
		<input type="number" step = 0.01 id="price" value="'. $price .'" name="price">
		</div>';

echo'<button>Kalkuláció</button></form></section>';

if(isset($_GET['distance']) && isset($_GET['avg']) && isset($_GET['price']))
{
	if($_GET['distance'] > 0 && $_GET['avg'] > 0 && $_GET['price'] > 0)
	{
	echo'<section class="collection"><h2>Eredmény</h2><div class="result">';

	$amount = $distance / 100 * $avg;
	echo'<h3>Szükséges mennyiség</h3><p class="amount">'. $amount .' liter</p>';

	$total = $amount * $price;
	echo'<h3>Várható költség</h3><p class="total">'. $total .' HUF</p></div></section>';
	}
}
echo'</div></div>';			
?>
</body>
</html>	
				
					
				
					
					
					
				
					
				