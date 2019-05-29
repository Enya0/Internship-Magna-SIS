<?php

	include('../../traducciones.php');

	$path = $_SERVER['DOCUMENT_ROOT']; 
	include_once $path . '/wp-load.php';

	$asignatura = $_POST['asig'];
	$sistemaOperativo = $_POST['sistOp'];
	$nSoftware = $_POST['nSoftware'];

	if(sizeof($sistemaOperativo) == 0){
        $return = array('status'=>0, 'msg'=>obtenerTraduccion("erSistemaOperativoValido"));
        echo json_encode($return);
	}
	elseif (!(isset($_POST['nSoftware']) && is_numeric($nSoftware) && (int)$nSoftware>0 )){
        $return = array('status'=>0, 'msg'=>obtenerTraduccion("erNSoftwareValido"));
        echo json_encode($return);
	}
	else{
	    $msg = '<form id="fprogramas" name="fprogramas" action="" method="post" enctype="multipart/form-data">
        <input type="text" value="'.$asignatura.'" name="asig" style="visibility: hidden;"/>
                <input type="text" value="'.$_POST['email'].'" name="email" style="visibility: hidden;"/>
        <input type="text" value="'.implode(",",$sistemaOperativo).'" name="sistOp" style="visibility: hidden;"/>
        <input type="text" value="'.$nSoftware.'" name="nSoftware" style="visibility: hidden;"/>';

	    for($i = 0; $i < $nSoftware; $i++){
	        $msg = $msg . '<table bgcolor="#FFFFFF">
                <tr>
                    <td>
                        '.obtenerTraduccion("nombrePrograma").'*: 
                    </td>
                    <td width="70%">
                        <input type="text" id="programa'.$i.'" name="programa'.$i.'" class="texto-form" onchange="cambiarNotas('.$i.')" onkeyup="cambiarNotas('.$i.')">
                    </td>
                </tr>
                <tr>
                    <td>
                    <p id="pVersion'.$i.'">
                        '.obtenerTraduccion("version").'*: 
                    </p>
                    </td>
                    <td>
                        <input type="text" id="version'.$i.'" name="version'.$i.'" class="texto-form">
                    </td>
                </tr>
                <tr>
                    <td>
                        '.obtenerTraduccion("infoAdicional").'*: 
                    </td>
                    <td>
                        <textarea rows = "3" id="descrip'.$i.'" name="descrip'.$i.'" class="texto-form"></textarea>
                    </td>
                </tr>
                </table>';
        }

        $msg = $msg . '<table>
            <tr>
                <td>
                    <input type="button" id="send" name="send" value="'.obtenerTraduccion("enviar").'" onclick="enviarSolicitud()">
                    <br/><br/>
                    <input type="button" id="back" name="back" value="'.obtenerTraduccion("volver").'" onclick="volver()">
                </td>
                <td width="100%">
                    <p id="mensaje"></p>
                </td>
            </tr>
            </table></form>';

	    $msg = $msg . '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                    <script type="text/javascript">
                    function volver(){
                        window.location.href = "/solicitud?asig=' . $asignatura . '&sistOp=' .implode(",",$sistemaOperativo). '&nSoftware=' .$nSoftware. '";
                    }
                    function cambiarNotas(num){
                        var programa = $("#programa"+num).val();
                        console.log(programa);
                        if(programa.toLowerCase() == "matlab"){
                          $("#pVersion" + num).html("Toolbox*:");  
                        }else if(programa.toLowerCase() == "eclipse"){
                          $("#pVersion" + num).html("Plugins*:");  
                        }else{
                           $("#pVersion" + num).html("'.obtenerTraduccion("version").'*:");  
                        }
                    }
                    </script>';
        $return = array('status'=>1, 'msg'=>$msg);
        echo json_encode($return);
	}

	return 0;

?>