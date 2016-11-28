<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_de_salidas.xls");

require('conexion.php');
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LISTA DE USUARIOS</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="12" bgcolor="skyblue"><CENTER><strong>REPORTE DE LAS SALIDAS</strong></CENTER></td>
  </tr>
  <tr >
     <td><strong>ID</strong></td>
    <td><strong>FECHA</strong></td>
    <td><strong>RFC_CLIENTE</strong></td>
    <td><strong>NOMBRE</strong></td>
     <td><strong>APELLIDOS</strong></td>
    <td><strong>TELEFONO</strong></td>
    <td><strong>DEPARTAMENTO</strong></td>
    <td><strong>EMAIL</strong></td>
     <td><strong>CANTIDAD</strong></td>
    <td><strong>PRODUCTO</strong></td>
    <td><strong>MARCA</strong></td>
    <td><strong>PRECIO</strong></td>
        </tr>
<?php
ob_start();
$buscar1=strtoupper($_REQUEST['buscar1']);
$criterios=$_REQUEST['criterios'];
if ($buscar1!="" or $criterios=='Todos'  ) {
	   if ($criterios=='Usuario') {
			$sql="SELECT a.idsalidas,a.fecha,a.rfc_clienteR,b.nombre,b.apellidos,b.telefono,c.nombre_departamento,b.email,d.cantidad,e.nombre_producto,e.marca,e.precio FROM salidas a inner join clientes b on a.rfc_clienteR=b.rfc_clientes inner join departamentos c on b.id_departamento=c.iddepartamento inner join detalle_salidas d on a.idsalidas=d.id_salidaR inner join productos e on d.id_productooR=e.idproductos WHERE a.fecha LIKE '$buscar1%' ORDER BY a.rfc_clienteR";  
	   }
		if ($criterios=='Todos') {
				$sql="SELECT a.idsalidas,a.fecha,a.rfc_clienteR,b.nombre,b.apellidos,b.telefono,c.nombre_departamento,b.email,d.cantidad,e.nombre_producto,e.marca,e.precio FROM salidas a inner join clientes b on a.rfc_clienteR=b.rfc_clientes inner join departamentos c on b.id_departamento=c.iddepartamento inner join detalle_salidas d on a.idsalidas=d.id_salidaR inner join productos e on d.id_productooR=e.idproductos ORDER BY a.rfc_clienteR";  
		}
}
require('conexion.php');
$rs = mysql_query($sql);
while($res=mysql_fetch_array($rs)){      

   $id=$res["idsalidas"];
   $fecha=$res["fecha"];
   $rfc_cliente=$res["rfc_clienteR"];
   $nombre=$res["nombre"];
   $apellidos=$res["apellidos"];
   $telefono=$res["telefono"];
   $nombre_departamento=$res["nombre_departamento"];
   $email=$res["email"];
   $cantidad=$res["cantidad"];
   $producto=$res["nombre_producto"];
   $marca=$res["marca"];
   $precio=$res["precio"];
  
?>  
    <td><?php echo $id; ?></td>
   <td><?php echo $fecha; ?></td>
   <td><?php echo $rfc_cliente; ?></td>
   <td><?php echo $nombre; ?></td>
    <td><?php echo $apellidos; ?></td>
   <td><?php echo $telefono; ?></td>
   <td><?php echo $nombre_departamento; ?></td>
   <td><?php echo $email; ?></td>
    <td><?php echo $cantidad; ?></td>
   <td><?php echo $producto; ?></td>
   <td><?php echo $marca; ?></td>
   <td><?php echo $precio; ?></td>
                     
 </tr> 
  <?php
}
  ?>
</table>
</body>
</html>