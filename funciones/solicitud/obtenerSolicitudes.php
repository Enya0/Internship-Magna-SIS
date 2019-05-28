<?php
include('../../traducciones.php');

$path = $_SERVER['DOCUMENT_ROOT']; 
include_once $path . '/wp-load.php';

if (isset($_POST['id_asignatura'])) {
    $id_asignatura = $_POST['id_asignatura'];

    global $wpdb;

    $results = $wpdb->get_results('SELECT id FROM ' . $wpdb->prefix . 'solicitud_solicitudes WHERE id_asignatura=' . $id_asignatura);
    echo '<br/><table bgcolor="#FFFFFF">
                <tr>
                    <th>' . obtenerTraduccion("solicitud") . '</th>
                    <th>' . obtenerTraduccion("nombre") . '</th>
                    <th>' . obtenerTraduccion("version") . '</th>
                    <th>' . obtenerTraduccion("notas") . '</th>';
                    if (is_user_logged_in()) {
                        $user = wp_get_current_user();
                        $roles = ( array )$user->roles;
                        $role = $roles[0];
                        if ($role == 'administrator') {
                            echo'<th>' . obtenerTraduccion("estado") . '</th>';

                        }
                    }
    echo'            </tr>';
    foreach ($results as $result) {
        $resultsSolicitud = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'softwareSolicitud_solicitudes WHERE id_solicitud=' . $result->id . ' ORDER BY (id) DESC');        
        foreach ($resultsSolicitud as $resultSolicitud) {

            echo '<tr>
                        <td>';

            echo $resultSolicitud->id_solicitud;

            echo '</td><td>';

            echo $resultSolicitud->nombre;

            echo '</td><td>';

            echo $resultSolicitud->version;

            echo '</td><td>';

            echo $resultSolicitud->notas;

            echo '</td>';

            if (is_user_logged_in()) {
                $user = wp_get_current_user();
                $roles = ( array )$user->roles;
                $role = $roles[0];
                if ($role == 'administrator') {
                    echo '<td><button id="botonSolicitud" onclick="verSolicitud(' . $resultSolicitud->id_solicitud . ')">' . obtenerTraduccion("verSolicitud") . '</button></td>';
                }
            }
            
            echo '</tr>';
        }
    }

    echo ' </table><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function verSolicitud(id_solicitud){
            window.location.href = "/ver-solicitud?id=" + id_solicitud;
        }
    </script>';

}

?>