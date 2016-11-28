<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_de_entradas.xls");

require('conexion.php');
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REPORTE</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="13" bgcolor="skyblue"><CENTER><strong>REPORTE DE LOS PRODUCTOS</strong></CENTER></td>
  </tr>
  <tr >
     <td><strong>RFC</strong></td>
    <td><strong>NOMBRE</strong></td>
    <td><strong>APELLIDOS</strong></td>
    <td><strong>CIUDAD</strong></td>
     <td><strong>ESTADO</strong></td>
    <td><strong>TELEFONO</strong></td>
    <td><strong>FECHA</strong></td>
    <td><strong>CANTIDAD</strong></td>
     <td><strong>PRODUCTO</strong></td>
    <td><strong>PRECIO</strong></td>
    <td><strong>SUBTOTAL</strong></td>
    <td><strong>IVA</strong></td>
    <td><strong>TOTAL</strong></td>
     </tr>

  
<?PHP
ob_start();
$buscar1=strtoupper($_REQUEST['buscar1']);
$criterios=$_REQUEST['criterios'];
if ($buscar1!="" or $criterios=='Todos'  ) {
     if ($criterios=='Usuario') {
      $sql="SELECT   a.rfc_proveedor,a.nombre,a.apellidos,a.ciudad,a.estado,a.telefono,b.fecha,c.cantidad,d.nombre_producto,c.precio,b.subtotal,b.iva,c.total from proveedor a 
inner join entradas b on a.rfc_proveedor=b.rfc_proveR
inner join detalle_entradas c on b.identradas=c.iddetalle_entradas
inner join productos d on c.iddetalle_entradas=d.idproductos WHERE b.fecha LIKE '$buscar1%'ORDER BY a.rfc_proveedor" ;  
     }
    if ($criterios=='Todos') {
        $sql="SELECT   a.rfc_proveedor,a.nombre,a.apellidos,a.ciudad,a.estado,a.telefono,b.fecha,c.cantidad,d.nombre_producto,c.precio,b.subtotal,b.iva,c.total from proveedor a 
inner join entradas b on a.rfc_proveedor=b.rfc_proveR
inner join detalle_entradas c on b.identradas=c.iddetalle_entradas
inner join productos d on c.iddetalle_entradas=d.idproductos ORDER BY a.rfc_proveedor" ;  
    }
}
require('conexion.php');
$rs = mysql_query($sql);
while($res=mysql_fetch_array($rs)){      

   $rfc=$res["rfc_proveedor"];
   $nombre=$res["nombre"];
   $apellidos=$res["apellidos"];
   $ciudad=$res["ciudad"];
   $estado=$res["estado"];
   $telefono=$res["telefono"];
   $fecha=$res["fecha"];
   $cantidad=$res["cantidad"];
   $nombre_producto=$res["nombre_producto"];
   $precio=$res["precio"];
   $subtotal=$res["subtotal"];
   $iva=$res["iva"];
  $total=$res["total"];
?>  
    <td><?php echo $rfc; ?></td>
   <td><?php echo $nombre; ?></td>
   <td><?php echo $apellidos; ?></td>
   <td><?php echo $ciudad; ?></td>
    <td><?php echo $estado; ?></td>
   <td><?php echo $telefono; ?></td>
   <td><?php echo $fecha; ?></td>
   <td><?php echo $cantidad; ?></td>
    <td><?php echo $nombre_producto; ?></td>
   <td><?php echo $precio; ?></td>
   <td><?php echo $subtotal; ?></td>
   <td><?php echo $iva; ?></td>
    <td><?php echo $total; ?></td>                  
 </tr> 
  <?php
}
  ?>
</table>
</body>
</html>