<?php

	include('../../traducciones.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$id_solicitud = $_POST['id_solicitud'];
    $email = $_POST['email'];

    $asignatura;

    global $wpdb;
    $results1 = $wpdb->get_results('SELECT id_asignatura FROM ' . $wpdb->prefix . 'solicitud_solicitudes WHERE id=' . $id_solicitud);
    foreach($results1 as $result1) {
        $asignatura = $result1->id_asignatura;
    }

    $sistemaOperativo = [];
    $results2 = $wpdb->get_results('SELECT id_so FROM ' . $wpdb->prefix . 'solicitud_so_solicitudes WHERE id_solicitud=' . $id_solicitud);
    foreach($results2 as $result2) {
        array_push($sistemaOperativo, $result2->id_so);
    }
    $nSoftware;
    $results3 = $wpdb->get_results('SELECT COUNT(*) AS cuenta FROM ' . $wpdb->prefix . 'softwareSolicitud_solicitudes WHERE id_solicitud=' . $id_solicitud);
    foreach($results3 as $result3){
        $nSoftware = $result3->cuenta;
    }
    $msg = '<form id="fprogramas" name="fprogramas" action="" method="post" enctype="multipart/form-data">
    <input type="text" value="'.$asignatura.'" name="asig" style="visibility: hidden;"/>
            <input type="text" value="'.$_POST['email'].'" name="email" style="visibility: hidden;"/>
    <input type="text" value="'.implode(",",$sistemaOperativo).'" name="sistOp" style="visibility: hidden;"/>
    <input type="text" value="'.$nSoftware.'" name="nSoftware" style="visibility: hidden;"/>';

    $results4 = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'softwareSolicitud_solicitudes WHERE id_solicitud=' . $id_solicitud);
    $i = 0;
    foreach($results4 as $result4){
        $msg = $msg . '<table>
            <tr>
                <td>
                    '.obtenerTraduccion("nombrePrograma").'*: 
                </td>
                <td width="70%">
                    <input type="text" id="programa'.$i.'" name="programa'.$i.'" class="texto-form" value="'.$result4->nombre .'">
                </td>
            </tr>
            <tr>
                <td>
                    '.obtenerTraduccion("version").'*: 
                </td>
                <td>
                    <input type="text" id="version'.$i.'" name="version'.$i.'" class="texto-form" value="'.$result4->version .'">
                </td>
            </tr>
            <tr>
                <td>
                    '.obtenerTraduccion("infoAdicional").'*: 
                </td>
                <td>
                    <textarea rows = "3" id="descrip'.$i.'" name="descrip'.$i.'" class="texto-form">'.$result4->notas .'</textarea>
                </td>
            </tr>
            </table>';
        $i = $i + 1;
    }

    $msg = $msg . '<table>
        <tr>
            <td>
                <input type="button" id="send" name="send" value="'.obtenerTraduccion("enviar").'" onclick="enviarSolicitud()">
                <input type="button" id="back" name="back" value="'.obtenerTraduccion("volver").'" onclick="volverSolicitud()">
            </td>
            <td width="100%">
                <p id="mensaje"></p>
            </td>
        </tr>
        </table></form>';

    $return = array('status'=>1, 'msg'=>$msg);
    echo json_encode($return);

	return 0;

?>