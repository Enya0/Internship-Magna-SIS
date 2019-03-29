<?php
include('wp-content/plugins/solicitudes/traducciones.php');

$path = $_SERVER['DOCUMENT_ROOT']; 
include_once $path . '/wp-load.php';

if (isset($_POST['id_aula'])) {
    $id_aula = $_POST['id_aula'];

    global $wpdb;

    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'incidencia_solicitudes WHERE id_aula=' . $id_aula);

    echo '<table>
            <tr>
                <th>' . obtenerTraduccion("incidencia") . '</th>
                <th>' . obtenerTraduccion("registradaPor") . '</th>
                <th>' . obtenerTraduccion("tipoProblema") . '</th>
                <th>' . obtenerTraduccion("mensaje") . '</th>
                <th>' . obtenerTraduccion("estado") . '</th>
            </tr>';
    foreach ($results as $result) {

        echo '<tr>
                    <td>';

        echo $result->id;

        echo '</td><td>';

        echo $result->nombre . ' &lt;' . $result->email . '&gt;';

        echo '</td><td>';

        echo $result->tipo;

        echo '</td><td>';

        echo $result->notas;

        echo '</td><td>';
        if ($result->estado == 1) {
            echo '<button style="background-color:#90EE90" disabled>' . obtenerTraduccion("abierta") . '</button>';
        } else {
            echo '<button style="background-color:#FF6347" disabled>' . obtenerTraduccion("cerrada") . '</button>';
        }
        echo '</td><td>';

        if ($result->estado == 1) {
            if (is_user_logged_in()) {
                $user = wp_get_current_user();
                $roles = ( array )$user->roles;
                $role = $roles[0];
                if ($role == 'administrator') {
                    echo '<button id="botonCerrar" onclick="cerrarIncidencia(' . $result->id . ')">' . obtenerTraduccion("cerrar") . '</button>';
                }
            }
        }
        echo '</td></tr>';
    }

    echo ' </table><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function cerrarIncidencia(id_incidencia){
            $("#botonCerrar").attr("disabled", true);
            var formData = new FormData();
            formData.append("id_incidencia", id_incidencia);
            
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

} else {
    echo obtenerTraduccion("verIncidenciaError");
}

?>