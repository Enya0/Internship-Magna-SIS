<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path . '/wp-load.php';
include('../../traducciones.php');
include('../email/mandarPendienteDeValidacion.php');

if(isset($_POST['pagina']) && isset($_POST['idSoftware']) && isset($_POST['email'])){
    $pagina = $_POST['pagina'];
    if($pagina == 0){

        echo '<form id="fmotivo"><input type="text" id="idSoftware" name="idSoftware" style="visibility: hidden;" value="'
            . $_POST['idSoftware'].'"><table><tr><td>';
        echo obtenerTraduccion('mensaje') . '*:';
        echo '</td><td width="70%"><input type="text" id="motivo" name="motivo" class="texto-form">';
        echo '</td></tr>
        <tr><td><input type="button" id="send" name="send" value="'.obtenerTraduccion("enviar").'" onclick="enviarMotivo()"></td>
        <td><p id="mensaje"></p></td></tr>
        </table></form>';

        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript">

        function enviarMotivo(){
            var motivo = $("#fmotivo").get(0);
            var formData = new FormData(motivo);
            formData.append("email", "'.$_POST["email"].'")
            formData.append("pagina", 1);
            $.ajax({
                url: "/wp-content/plugins/solicitudes/funciones/solicitud/marcarSolicitudPendiente.php",
                type: "POST",
                data: formData,
                dataType: "json",
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
            }).done(function (data) {
                if(data.status == "0"){
                    $("#mensaje").html(data.msg);
                }else{
                    window.location.href = "./ver-solicitud?id='.$_POST['idSolicitud'].'";
                }
                }
            ).fail(function (data) {
                if(data.status == "0"){
                    $("#mensaje").html(data.msg);
                }else{
                    window.location.href = "./ver-solicitud?id='.$_POST['idSolicitud'].'";
                } 
                }
            );
        }
        </script>';

    }else{
        if(isset($_POST['motivo'])){
            $motivo = $_POST['motivo'];
            if(empty($motivo)){
                $return = array('status'=>0, 'msg'=>obtenerTraduccion('errorMotivo'));
                echo json_encode($return);
            }else{
                global $wpdb;
                $idSoftware = $_POST['idSoftware'];

                $nuevoEstado = 3;

                $table = $wpdb->prefix . 'softwareSolicitud_solicitudes';
                $data = array("estado"=>$nuevoEstado);
                $where = array("id"=>$idSoftware);
                $format = array('%d');
                $where_format = array('%d');

                $wpdb->update( $table, $data, $where, $format, $where_format);

                mandarPendienteDeValidacion($idSoftware, $_POST['email'], $motivo);

            }
        }

    }
}

?>