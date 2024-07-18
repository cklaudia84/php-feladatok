<!-- 
Az URL-ben lévő firstDay és reduction paraméterek meglétekor történik a számolás
Kalkuláció: a hónap első napján félreteszek "firstDay" összeget (PL 1500); majd a következő napon már "reduction"-nel kevesebbet (PL 50 esetén a második napon már csak 1450, stb.)
Mennyi jön össze 30 nap alatt? Mennyi egy év alatt?
-->
<!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="UTF-8">
	<title>Spórolás Kalkulátor</title>
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <meta name="format-detection" content="telephone=no">
	<meta name="msapplication-tap-highlight" content="no">
	<link rel="stylesheet" href="src/style.css">
</head>
<body>
<?php
echo'<div id="title-bar"><div><h1>Spórolás Kalkulátor</h1></div></div><div id="main"><section class="input"><h2>Mennyit tudnál félretenni?</h2><form action="" method="get">';

$firstDay = 0;

if(isset($_GET['firstDay']))
{
	$firstDay = $firstDay + $_GET['firstDay'];
}
echo'<div>
	<label for="firstDay">A hónap első napján</label>
	<input type="number" id="firstDay" name="firstDay" value="'. $firstDay .'">
	</div>';

$reduction = 0;

if(isset($_GET['reduction']))
{
	$reduction = $reduction + $_GET['reduction'];
}
echo'<div><label for="reduction">Csökkentés naponta</label>
	<input type="number" id="reduction" name="reduction" value="'. $reduction .'"></div>
	<button>Kalkuláció</button></form></section><section class="outputSummary">';

if(isset($_GET['firstDay']) && isset($_GET['reduction']))
{
	if($_GET['firstDay'] > 0 && $_GET['reduction'] >= 0 && $_GET['firstDay'] - $_GET['reduction'] >= 0)
	{
	echo'<h2>Eredmény</h2>
	<p>Ha a hónap első napján félreteszel <span class="firstDay">'. $firstDay .'</span> Ft-ot, majd aztán minden további nap <span class="reduction">'. $reduction .'</span> Ft-tal kevesebbet, akkor az alábbi megspórolt összegekre számíthatsz:</p>';

	$month = 0;
	$year = 0;

	$napi = $firstDay;
	$osszesen = $firstDay;

	for($i = 1; $i <= 29; $i++)
	{
	$napi -= $reduction;
	if($napi <= 0)    
	{break;}
	
	$osszesen += $napi;
	}
	$month += $osszesen;
	$year = $month * 12;

	if($month < 0)
	{
		$month = $month + $napi;
	}

	echo'<div class="summary"><h3>Egy hónap alatt</h3><p class="result month">'. $month .' Ft</p>';

	echo'<h3>Egy év alatt</h3><p class="result year">'. $year .' Ft</p><a href="index.php" class="new">Új kalkuláció</a></div></section><section class="outputDetails"><h2>Részletek</h2><table><thead><tr><th>Nap</th><th>Napi betét</th><th>Összesen</th></tr></thead>';

	$napi = $firstDay;
	$osszesen = $firstDay;	
	for($i = 1; $i <= 30; $i++)
	{
	if($napi <= 0)
	{break;}
	echo '<tbody>
		<tr>
		<th>'. $i .'.</th>
		<td>'. $napi .' Ft</td>
		<td>'. $osszesen .' Ft</td>
		</tr>';	
	$napi -= $reduction;
	$osszesen += $napi;
	}
	echo'</tbody></table></section></div>';
	}
}
?>
</body>
</html>		