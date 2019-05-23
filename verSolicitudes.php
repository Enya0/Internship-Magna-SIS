<?php

function ver_solicitudes()
{
    if( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $roles = ( array ) $user->roles;
        $role = $roles[0];
        if($role == 'administrator'){
                
            $idioma = get_locale();

            global $wpdb;
            $results = $wpdb->get_results('SELECT id, nombre, nombre_eus FROM ' . $wpdb->prefix . 'asignatura_solicitudes');

            echo obtenerTraduccion("asignatura") . ': &nbsp;&nbsp;&nbsp;';

            echo ' <select id="id_asignatura" onchange="cargarSolicitudes()"><option value="0"></option>';


            foreach ($results as $result) {
                if ($idioma == "eu_ES") {
                    echo '<option value="' . $result->id . '">' . $result->nombre_eus . '</option>';
                } else {
                    echo '<option value="' . $result->id . '">' . $result->nombre . '</option>';
                }
            }

            echo '</select>

            <div id="solicitudes"></div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script type="text/javascript">

                function cargarSolicitudes(){
                    var formData = new FormData();
                    var selectedId = $("#id_asignatura").children("option:selected").val();

                    formData.append("id_asignatura", selectedId);
                    
                    $.ajax({
                        url: "/wp-content/plugins/solicitudes/funciones/solicitud/obtenerSolicitudes.php",
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        mimeType: "multipart/form-data",
                        processData: false,
                        contentType: false,
                    }).done(function (data) {
                            console.log(data);
                            $("#solicitudes").html(data["responseText"]);
                        }
                    ).fail(function (data) {
                            console.log(data);
                            $("#solicitudes").html(data["responseText"]);
                        }
                    );
                }
            </script>';
            }
    }
}

?>