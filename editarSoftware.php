<?php
function editar_software(){
    if( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $roles = ( array ) $user->roles;
        $role = $roles[0];
        if($role == 'administrator'){
            $id_software = $_GET['id'];
            $idioma = get_locale();
            global $current_user;
            wp_get_current_user();
            $euskera = 'eu';
            global $wpdb;

            $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'software_solicitudes WHERE id='. $id_software);

            foreach($results as $result) {


                echo '<div id="formulario"><form id="fsoftware" name="fsoftware" action="" method="post" enctype="multipart/form-data">
                <input type="text" value="'.$id_software.'" name="id_software" style="visibility: hidden;"/>
                <table bgcolor="#FFFFFF">
                    <tr>
                        <td>
                            ' . obtenerTraduccion("nombre") . '*:  
                        </td>
                        <td width="70%">';

                echo '<input type="text" id="nombre" name="nombre" class="texto-form" value="'.$result->nombre.'">';
                echo '</td></tr><tr><td>' . obtenerTraduccion("version") . '*:  
                        </td>
                        <td width="70%">';
                echo '<input type="text" id="version" name="version" class="texto-form" value="'.$result->version.'">';
                echo '</td></tr><tr><td>' . obtenerTraduccion("notas") . '*:  
                        </td>
                        <td width="70%">';
                echo '<input type="text" id="notas" name="notas" class="texto-form" value="'.$result->notas.'">';
                echo '</td>
                    </tr>
                    <tr>
                        <td>
                            ' . obtenerTraduccion("sistemaOperativo") . '*: 
                        </td>
                        <td>';
                $resultsSO_SW = $wpdb->get_results('SELECT id_so FROM ' . $wpdb->prefix . 'software_so_solicitudes WHERE id_software=' . $id_software);
                $sistemasOperativos = [];
                foreach ($resultsSO_SW as $resultSO_SW) {
                    array_push($sistemasOperativos, $resultSO_SW->id_so);
                }
                $resultsSO = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'so_solicitudes');

                foreach ($resultsSO as $resultSO) {
                    if(in_array($resultSO->id, $sistemasOperativos)){
                        echo '<input type="checkbox" name="sistOp[]" value="' . $resultSO->id . '" checked>&nbsp;' . $resultSO->nombre . '</imput><br/>';
                    }else{
                        echo '<input type="checkbox" name="sistOp[]" value="' . $resultSO->id . '">&nbsp;' . $resultSO->nombre . '</imput><br/>';
                    }
                }

                echo '</td>
                    </tr>
                    <tr>
                        <td>
                            ' . obtenerTraduccion("nombreLabAula") . '*: 
                        </td>
                        <td>';
                $resultsAU_SW = $wpdb->get_results('SELECT id_aula FROM ' . $wpdb->prefix . 'software_aula_solicitudes WHERE id_software=' . $id_software);
                $aulas = [];
                foreach ($resultsAU_SW as $resultAU_SW) {
                    array_push($aulas, $resultAU_SW->id_aula);
                }
                $resultsAU = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'aula_solicitudes');

                foreach ($resultsAU as $resultAU) {
                    if(in_array($resultAU->id, $aulas)){
                        echo '<input type="checkbox" name="aulas[]" value="' . $resultAU->id . '" checked>&nbsp;' . $resultAU->nombre . '</imput><br/>';
                    }else{
                        echo '<input type="checkbox" name="aulas[]" value="' . $resultAU->id . '">&nbsp;' . $resultAU->nombre . '</imput><br/>';
                    }
                }

                echo '</td>
                    </tr>';
            
                    echo '<tr>
                        <td>
                            <input type="button" id="send" name="send" value="' . obtenerTraduccion("editar") . '" onclick="editarSoftware()">
                        </td>
                        <td>
                            <p id="mensaje"></p>
                        </td>
                    </tr>
                </table>
                </form>';

                echo '</div>
            
            
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                <script type="text/javascript">
            
                    function editarSoftware(){
            
                        var solicitud = $("#fsoftware").get(0);
                        $("#mensaje").html("<img src=\'/wp-content/plugins/solicitudes/loading.gif\' width=\'50px\'>");
                        
                        $.ajax({
                            url: "/wp-content/plugins/solicitudes/funciones/editarSoftware.php",
                            type: "POST",
                            data: new FormData(solicitud),
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
        }
    }
}
?>