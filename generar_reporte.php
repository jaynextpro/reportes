<?php 
    // include autoloader
    require_once 'dompdf/autoload.inc.php';
    require_once 'conexion.php';

    use Dompdf\Dompdf;

    $consulta="SELECT * FROM tbl_invesproduct";

    $palabra_clave = isset($_POST["palabra_clave"]) ? $_POST["palabra_clave"] : null;
    $existencias = isset($_POST["existencias"]) ? $_POST["existencias"] : null;
    $vencimiento = isset($_POST["vencimiento"]) ? $_POST["vencimiento"] : null;

    if(!empty($palabra_clave)) {
        $consulta .= " WHERE (producto LIKE '%$palabra_clave%' OR proveedor LIKE '%$palabra_clave%')";

        if(!empty($existencias)) {
            $consulta .= " AND existencias = $existencias";
        }
        if(!empty($vencimiento)) {
            $consulta .= " AND vencimiento = '$vencimiento'";
        }
    } else {
        if(!empty($existencias)) {
            $consulta .= " WHERE existencias = $existencias";

            if(!empty($vencimiento)) {
                $consulta .= " AND vencimiento = '$vencimiento'";
            }
        } else {
            if(!empty($vencimiento)) {
                $consulta .= " WHERE vencimiento = '$vencimiento'";
            }
        }
    }

    $ejecucion= mysqli_query($conexion,$consulta);

    $html = "<table border=1 cellspacing=1>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>Existencias</th>
                    <th>Bodegas</th>
                    <th>Precio</th>
                    <th>Vencimiento</th>
                    <th>Introduccion</th>
                </tr>";

    while($fila = $ejecucion->fetch_assoc()) {
        $html .= "<tr>
                    <td>". $fila["id"] ."</td>
                    <td>". $fila["producto"] ."</td>
                    <td>". $fila["proveedor"] ."</td>
                    <td>". $fila["existencias"] ."</td>
                    <td>". $fila["bodegas"] ."</td>
                    <td>". $fila["precio"] ."</td>
                    <td>". $fila["vencimiento"] ."</td>
                    <td>". $fila["introduccion"] ."</td>
                </tr>";
    }

    $html .= "</table>";

    $nombre_archivo = "reporte_productos_". date("Ymd_His");

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream($nombre_archivo);
?>