<?php

function ver_incidencia()
{
    if (isset($_GET['id'])) {
        $id_incidencia = $_GET['id'];

        global $wpdb;

        $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'incidencia_solicitudes WHERE id=' . $id_incidencia);

        foreach ($results as $result) {

            $idioma = get_locale();
            echo '<table>
                        <tr>
                            <td>
                                ' . obtenerTraduccion("incidencia") . ':
                            </td>
                            <td width="70%">';

            echo $id_incidencia;

            echo '
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ' . obtenerTraduccion("registradaPor") . ':
                            </td>
                            <td>
                                ';

            echo $result->nombre . ' &lt;' . $result->email . '&gt;';

            echo '
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ' . obtenerTraduccion("nombreLabAula") . ':
                            </td>
                            <td>';

            $results_aula = $wpdb->get_results('SELECT nombre,nombre_eus FROM ' . $wpdb->prefix . 'aula_solicitudes WHERE id=' . $result->id_aula);

            foreach ($results_aula as $result_aula) {
                if ($idioma == "eu_ES") {
                    echo $result_aula->nombre_eus;
                } else {
                    echo $result_aula->nombre;
                }
            }

            echo '</td>
                        </tr>
                        <tr>
                            <td>
                                ' . obtenerTraduccion("tipoProblema") . ':
                            </td>
                            <td>';

            echo $result->tipo;

            echo '</td>
                        </tr>
                        <tr>
                            <td>
                                ' . obtenerTraduccion("mensaje") . ':
                            </td>
                            <td>';

            echo $result->notas;

            echo '</td>
                        </tr>
                        <tr>
                            <td>';
            if ($result->estado == 1) {
                echo '<button style="background-color:#90EE90" disabled>' . obtenerTraduccion("abierta") . '</button>';
            } else {
                echo '<button style="background-color:#FF6347" disabled>' . obtenerTraduccion("cerrada") . '</button>';
            }
            echo '</td>
                            <td>';

            if($result->estado == 1){
                if( is_user_logged_in() ) {
                    $user = wp_get_current_user();
                    $roles = ( array ) $user->roles;
                    $role = $roles[0];
                    if($role == 'administrator'){
                        echo '<button id="botonCerrar" onclick="cerrarIncidencia()">' . obtenerTraduccion("cerrar") . '</button>';
                    }
                }
            }
            echo '</td>
                        </tr>
                    </table>
                    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function cerrarIncidencia(){
            $("#botonCerrar").attr("disabled", true);
            var formData = new FormData();
            formData.append("id_incidencia", '.$result->id.')
            $.ajax({
                url: "/wp-content/plugins/solicitudes/cerrarIncidencia.php",
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
    </script>';
        }

    } else {
        echo obtenerTraduccion("verIncidenciaError");
    }
}
?>