<?php
function software(){
    if( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $roles = ( array ) $user->roles;
        $role = $roles[0];
        if($role == 'administrator'){
            if (!(isset($_GET['nombre']) && isset($_GET['version']) && isset($_GET['notas']) && isset($_GET['sistOp']))) {
                echo 'No puedes continuar.';
            } else {
                $nombre = $_GET['nombre'];
                $version = $_GET['version'];
                $notas = $_GET['notas'];
                $sistOp = explode(",", $_GET['sistOp']);

                echo '<form id="fprogramas" name="fprogramas" action="" method="post" enctype="multipart/form-data">
                    <input type="text" value="'.$nombre.'" name="nombre" style="visibility: hidden;"/>
                    <input type="text" value="'.implode(",",$sistOp).'" name="sistOp" style="visibility: hidden;"/>
                    <input type="text" value="'.$version.'" name="version" style="visibility: hidden;"/>
                    <input type="text" value="'.$notas.'" name="notas" style="visibility: hidden;"/>';

                $idioma = get_locale();
                $euskera = 'eu';
                global $wpdb;

                $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'aula_solicitudes');
                echo '<table bgcolor="#FFFFFF"><tr><td>'. obtenerTraduccion('nombreLabAula') .'</td>';
                echo '<td width="70%">';
                echo '<input type="checkbox" name="aulas[]" value="0">&nbsp;' . obtenerTraduccion("todasLasAulas") . '</imput><br/>';

                foreach ($results as $result){
                    if ($idioma == $euskera) {
                        echo '<input type="checkbox" name="aulas[]" value="' . $result->id . '">&nbsp;' . $result->nombre . '</imput><br/>';
                    } else {
                        echo '<input type="checkbox" name="aulas[]" value="' . $result->id . '">&nbsp;' . $result->nombre_eus . '</imput><br/>';
                    }
                }
                echo '</td></tr>';
                echo '<tr><td> 
                    <input type="button" id="siguiente" name="siguiente" value="' . obtenerTraduccion("enviar") . '" onclick="insertarSoftware()">
                    </td><td><p id="mensaje"></p></td></tr></table></form>';

                echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                    <script type="text/javascript">
                
                        function insertarSoftware(){
                
                            var software = $("#fprogramas").get(0);
                            $("#mensaje").html("<img src=\'/wp-content/plugins/solicitudes/loading.gif\' width=\'50px\'>");
                            
                            $.ajax({
                                url: "/wp-content/plugins/solicitudes/funciones/insertarSoftware.php",
                                type: "POST",
                                data: new FormData(software),
                                dataType: "json",
                                mimeType: "multipart/form-data",
                                processData: false,
                                contentType: false,
                            }).done(function (data) {
                                if(data.status == "0"){
                                    $("#mensaje").html(data.msg);
                                    $("#fsolicitud")[0].reset();
                                }else{
                                    $("#mensaje").html(data.msg);
                                }
                            }
                            ).fail(function (data) {
                                if(data.status == "0"){
                                    $("#mensaje").html(data.msg);
                                    $("#fsolicitud")[0].reset();
                                }else{
                                    $("#mensaje").html(data.msg);
                                }
                            }
                            );
                        }
                        </script>';
            }
        }else{
            echo 'No puedes estar aquí.';
        }
    }
}