<?php 

$ingr = '';
$egr = '';
$sum = '';
$ingr0 = '';
$egr0 = '';
$ingr1 = '';
$egr1 = '';
$ingr2 = '';
$egr2 = '';
$ingr3 = '';
$egr3 = '';
$ingr4 = '';
$egr4 = '';
$ingr5 = '';
$egr5 = '';
$ingr6 = '';
$egr6 = '';

$gra = '';


/////////////////////Ingresos-Egresos/////////////////////////////

// Ingresos
$query = mysqli_query($result,'select SUM(valor) as total from ingresos');

$row = $query->fetch_assoc();
$ingr .= number_format($row['total'], 0, ",", ".");

// Egresos
$query2 = mysqli_query($result,"select SUM(valor) as total from compras");

$row2 = $query2->fetch_assoc();
$egr .= number_format($row2['total'], 0, ",", ".");

/////////////////////Porcentaje Ing-Egr/////////////////////////////

$sum = $row['total'] + $row2['total'];

$porcIng = $sum - $row2['total'];
$porcEgr = $sum - $row['total'];

/////////////////// Ingresos y Egresos por Día/////////////////////

$dia = date("Y-m-d");

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr0 .= 0;
}else{
	$ingr0 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr0 .= 0;
}else{
	$egr0 .= $row4['total'];
}

/////////////
$dia1 = date("Y-m-d", strtotime("-1 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia1."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr1 .= 0;
}else{
	$ingr1 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia1."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr1 .= 0;
}else{
	$egr1 .= $row4['total'];
}

/////////////
$dia2 = date("Y-m-d", strtotime("-2 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia2."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr2 .= 0;
}else{
	$ingr2 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia2."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr2 .= 0;
}else{
	$egr2 .= $row4['total'];
}

////////////
$dia3 = date("Y-m-d", strtotime("-3 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia3."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr3 .= 0;
}else{
	$ingr3 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia3."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr3 .= 0;
}else{
	$egr3 .= $row4['total'];
}

/////////////////
$dia4 = date("Y-m-d", strtotime("-4 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia4."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr4 .= 0;
}else{
	$ingr4 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia4."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr4 .= 0;
}else{
	$egr4 .= $row4['total'];
}

////////////////
$dia5 = date("Y-m-d", strtotime("-5 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia5."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr5 .= 0;
}else{
	$ingr5 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia5."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr5 .= 0;
}else{
	$egr5 .= $row4['total'];
}


////////////////
$dia6 = date("Y-m-d", strtotime("-6 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia6."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr6 .= 0;
}else{
	$ingr6 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia6."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr6 .= 0;
}else{
	$egr6 .= $row4['total'];
}

///////////////////



$ingreso = mysqli_query($result,'select SUM(valor) as total from ingresos where MONTH(fecha) = MONTH(now())');
 	$cam1 = $ingreso->fetch_assoc();
 	$ing = $cam1['total'];

 $egreso = mysqli_query($result,"select SUM(valor) as total from compras where MONTH(fecha) = MONTH(now())");
 	$cam2 = $egreso->fetch_assoc();
 	$egr = $cam2['total'];
