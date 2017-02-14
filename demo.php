<?php
//-------------Solo para  calcular tiempo de ejecucion
function microtime_float()
{
list($useg, $seg) = explode(" ", microtime());
return ((float)$useg + (float)$seg);
}
$tiempo_inicio = microtime_float();
//---------------------------------------------



include('db.php');
$MENSAJE="No se uso Cache";
$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");

$key = md5('lst_ubigeo2006_2'); // Unique Words
$cache_result = array();
$cache_result = $memcache->get($key); // Memcached object 

if($cache_result)
{
// Second User Request
$demos_result=$cache_result;
}
else
{
// First User Request 
$v=mysql_query("SELECT * FROM `ubigeo2006` ORDER BY `ubigeo2006`.`Nombre` ASC");
while($row=mysql_fetch_array($v))
$demos_result[]=$row; // Results storing in array
$memcache->set($key, $demos_result, MEMCACHE_COMPRESSED, 1200); 
// 1200 Seconds
$MENSAJE="Se uso Cache";
}

// Result 
foreach($demos_result as $row)
{
	echo 'CodDpto:'.$row['CodDpto'].'> CodProv'.$row['CodProv'].'> CodDist'.$row['CodDist'].'> Nombre'.$row['Nombre']."<br>";
}

echo "<b>".$MENSAJE."</b>";

//----------calcular el tiempo de ejecucion
$tiempo_fin = microtime_float();
$tiempo = $tiempo_fin - $tiempo_inicio;
echo "<br>--------------------------------------------------------------------<br>";
echo "Tiempo empleado: " . ($tiempo_fin - $tiempo_inicio);

?>