<?php

function ver_solicitud()
{
    $email = "";
    if (isset($_GET['id'])) {
        $id_solicitud = $_GET['id'];

        global $wpdb;
        $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'solicitud_solicitudes WHERE id=' . $id_solicitud);
        echo '<div id="divSolicitud">';
        foreach ($results as $result) {

            $idioma = get_locale();
            echo '<table>
                        <tr>
                            <td>
                                ' . obtenerTraduccion("solicitud") . ':
                            </td>
                            <td width="70%">';

            echo $id_solicitud;

            echo '
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ' . obtenerTraduccion("registradaPor") . ':
                            </td>
                            <td>
                                ';
            $email = $result->email;
            echo $email;
            echo '</td>
                        </tr>
                    </table>';
            $results_asig = $wpdb->get_results('SELECT nombre,nombre_eus FROM ' . $wpdb->prefix . 'asignatura_solicitudes WHERE id=' . $result->id_asignatura);
            $nombre_asig = "";
            foreach ($results_asig as $result_asig) {
                if ($idioma == "eu_ES") {
                    $nombre_asig = $result_asig->nombre_eus;
                } else {
                    $nombre_asig = $result_asig->nombre;
                }
            }

            $results_aula = $wpdb->get_results('SELECT nombre,nombre_eus FROM ' . $wpdb->prefix . 'aula_solicitudes WHERE id IN (SELECT id_aula FROM ' . $wpdb->prefix . 'solicitud_aula_solicitudes WHERE id_solicitud=' . $id_solicitud . ')');

            $nombres_aulas = [];
            foreach ($results_aula as $result_aula) {
                if ($idioma == "eu_ES") {
                    array_push($nombres_aulas, $result_aula->nombre_eus);
                } else {
                    array_push($nombres_aulas, $result_aula->nombre);
                }
            }

            $results_so = $wpdb->get_results('SELECT nombre FROM ' . $wpdb->prefix . 'so_solicitudes WHERE id IN (SELECT id_so FROM ' . $wpdb->prefix . 'solicitud_so_solicitudes WHERE id_solicitud=' . $id_solicitud . ')');

            $nombres_so = [];

            foreach ($results_so as $result_so) {
                array_push($nombres_so, $result_so->nombre);
            }

            $results_software = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'softwareSolicitud_solicitudes WHERE id_solicitud=' . $id_solicitud);

            foreach ($results_software as $result_software) {
                echo '<table>
                        <tr>
                            <td>
                                ' . obtenerTraduccion("nombrePrograma") . ':
                            </td>
                            <td width="70%">';

                echo $result_software->nombre;

                echo '</td>
                            </tr>
                            <tr>
                                <td>
                                    ' . obtenerTraduccion("version") . ':
                                </td>
                                <td>';

                echo $result_software->version;

                echo '</td>
                            </tr>
                            <tr>
                                <td>
                                    ' . obtenerTraduccion("infoAdicional") . ':
                                </td>
                                <td>';

                echo $result_software->notas;

                echo '</td>
                            </tr>
                            <tr>
                                <td>
                                    ' . obtenerTraduccion("nombreLabAula") . ':
                                </td>
                                <td>';

                echo implode(", ", $nombres_aulas);

                echo '</td>
                            </tr>
                            <tr>
                                <td>
                                    ' . obtenerTraduccion("sistemaOperativo") . ':
                                </td>
                                <td>';

                echo implode(", ", $nombres_so);

                echo '</td>
                            </tr>
                            <tr>
                                <td>
                                    ' . obtenerTraduccion("asignatura") . ':
                                </td>
                                <td>';

                echo $nombre_asig;

                echo '</td>
                            </tr>
                            <tr>
                                <td>';
                switch ($result_software->estado) {
                    case '0':
                        echo '<button style="background-color:#DDA0DD" disabled>' . obtenerTraduccion("registrada") . '</button>';
                        break;
                    case '1':
                        echo '<button style="background-color:#A9A9A9" disabled>' . obtenerTraduccion("descartada") . '</button>';
                        break;
                    case '2':
                        echo '<button style="background-color:#DDA0DD" disabled>' . obtenerTraduccion("reabierta") . '</button>';
                        break;
                    case '3':
                        echo '<button style="background-color:#FF6347" disabled>' . obtenerTraduccion("pendiente") . '</button>';
                        break;
                    case '4':
                        echo '<button style="background-color:#99CCFF" disabled>' . obtenerTraduccion("validada") . '</button>';
                        break;
                    case '5':
                        echo '<button style="background-color:#90EE90" disabled>' . obtenerTraduccion("desplegada") . '</button>';
                        break;
                }
                echo '</td>
                        <td>';

                switch ($result_software->estado) {
                    case '0':
                        if (is_user_logged_in()) {
                            $user = wp_get_current_user();
                            $roles = ( array )$user->roles;
                            $role = $roles[0];
                            if ($role == 'administrator') {
                                echo '<button id="botonDescartar" onclick="cambiarEstado(1,'.$result_software->id.')">' . obtenerTraduccion("descartar") . '</button>&nbsp;&nbsp;';
                                echo '<button id="botonPendiente" onclick="cambiarEstado(3,'.$result_software->id.')">' . obtenerTraduccion("marcarPendiente") . '</button>';
                            }
                        }
                        break;
                    case '1':
                        if (is_user_logged_in()) {
                            $user = wp_get_current_user();
                            $roles = ( array )$user->roles;
                            $role = $roles[0];
                            if ($role == 'profesor') {
                                echo '<button id="botonReabrir" onclick="cambiarEstado(2,'.$result_software->id.')">' . obtenerTraduccion("reabrir") . '</button>';
                            }
                        }
                        break;
                    case '2':
                        if (is_user_logged_in()) {
                            $user = wp_get_current_user();
                            $roles = ( array )$user->roles;
                            $role = $roles[0];
                            if ($role == 'administrator') {
                                echo '<button id="botonDescartar" onclick="cambiarEstado(1,'.$result_software->id.')">' . obtenerTraduccion("descartar") . '</button>&nbsp;&nbsp;';
                                echo '<button id="botonPendiente" onclick="cambiarEstado(3,'.$result_software->id.')">' . obtenerTraduccion("marcarPendiente") . '</button>';
                            }
                        }
                        break;
                    case '3':
                        if (is_user_logged_in()) {
                            $user = wp_get_current_user();
                            $roles = ( array )$user->roles;
                            $role = $roles[0];
                            if ($role == 'profesor') {
                                echo '<button id="botonValidar" onclick="cambiarEstado(4,'.$result_software->id.')">' . obtenerTraduccion("validar") . '</button>';
                            }
                        }
                        break;
                    case '4':
                        if (is_user_logged_in()) {
                            $user = wp_get_current_user();
                            $roles = ( array )$user->roles;
                            $role = $roles[0];
                            if ($role == 'administrator') {
                                echo '<button id="botonDesplegar" onclick="cambiarEstado(5,'.$result_software->id.')">' . obtenerTraduccion("desplegar") . '</button>';
                            }
                        }
                        break;
                }
                echo '</td>
                    </tr>
                </table>';



            }
        }
        echo '</div><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript">

        function cambiarEstado(nuevoEstado, idSoftware){
            if(nuevoEstado == 1){
                var formData = new FormData();
                formData.append("pagina", 0);
                formData.append("email", "'.$email.'");
                formData.append("idSolicitud", '.$_GET['id'].');
                formData.append("idSoftware", idSoftware);
                $.ajax({
                    url: "/wp-content/plugins/solicitudes/descartarSolicitud.php",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    mimeType: "multipart/form-data",
                    processData: false,
                    contentType: false,
                }).done(function (data) {
                        $("#divSolicitud").html(data["responseText"]); 
                    }
                ).fail(function (data) {
                        $("#divSolicitud").html(data["responseText"]); 
                    }
                );
            }else{
                var formData = new FormData();
                formData.append("nuevoEstado", nuevoEstado);
                formData.append("idSoftware", idSoftware);
                $.ajax({
                    url: "/wp-content/plugins/solicitudes/cambiarEstadoSolicitud.php",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    mimeType: "multipart/form-data",
                    processData: false,
                    contentType: false,
                }).done(function (data) {
                        location.reload(); 
                    }
                ).fail(function (data) {
                         location.reload(); 
                    }
                );
            }
        }
    </script>';
    } else {
        echo obtenerTraduccion("verSolicitudError");
    }
}
?>