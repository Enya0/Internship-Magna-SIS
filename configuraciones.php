<?php
function configuraciones(){
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $roles = ( array )$user->roles;
        $role = $roles[0];
        if ($role == 'administrator') {
            global $wpdb;

            $results = $wpdb->get_results('SELECT abierto FROM ' . $wpdb->prefix . 'abierto_solicitudes');


            echo '<table>
            <tr>
            <td>'.obtenerTraduccion('estadoSolicitudes').'</td>
            <td width="70%">';
            foreach ($results as $result) {
                if($result->abierto == 1){
                    echo obtenerTraduccion('abierta') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="cambiarSolicitudes()">'.obtenerTraduccion('cerrar').'</button>';
                }else{
                    echo obtenerTraduccion('cerrada') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="cambiarSolicitudes()">'.obtenerTraduccion('abrir').'</button>';
                }
            }
            echo '
            </td>
            </tr>
            <tr>
            <td>'.obtenerTraduccion('laboratorios').'</td>
            <td width="70%">';
            echo '<a href="/ver-hw-laboratorios">'.obtenerTraduccion('ver').'</a>';
            echo '
            </td>
            </tr>
            <tr>
            <td>'.obtenerTraduccion('verSolicitudes').'</td>
            <td width="70%">';
            echo '<a href="/ver-solicitudes">'.obtenerTraduccion('ver').'</a>';
            echo '
            </td>
            </tr>
            <tr>
            <td>'.obtenerTraduccion('verIncidencias').'</td>
            <td width="70%">';
            echo '<a href="/ver-incidencias">'.obtenerTraduccion('ver').'</a>';
            echo '
            </td>
            </tr>
            </table>';

            echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script type="text/javascript">
            function cambiarSolicitudes(){
                $.ajax({
                    url: "/wp-content/plugins/solicitudes/funciones/cambiarSolicitudes.php",
                    type: "POST",
                    data: new FormData(),
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
        }else{
            echo "arrrrrggfghhhh >:(";
        }
    }
}
?>