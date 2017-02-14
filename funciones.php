<?php 

$hostname = 'localhost';
$database = 'test_memcache';
$username = 'root';
$password = '';
try {
	$con = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
	print "Conexión exitosa!";
}
catch (PDOException $e) {
	print "¡Error!: " . $e->getMessage() . "
	";
	die();
}
$con =null;


function getPais(){

	$query = "SELECT * FROM ubdepartamento";
	print("<table>");
	$resultado = $con->query($query); 
	foreach ( $resultado as $rows) { 
		print("<tr>");
		print("<td>".$rows["ID"]."</td>");
		print("<td>".$rows["CAPACIDAD"]."</td>");
		print("<td>".$rows["DESCRIPCION"]."</td>");
		print("</tr>"); 
	}
	print("</table>");
	$resultado =null;


}
?>}
