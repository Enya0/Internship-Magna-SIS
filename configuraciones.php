<?php
function configuraciones(){
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $roles = ( array )$user->roles;
        $role = $roles[0];
        if ($role == 'administrator') {
            global $wpdb;

            $results = $wpdb->get_results('SELECT abierto FROM ' . $wpdb->prefix . 'abierto_solicitudes');


            echo '<table bgcolor="#FFFFFF">
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
            echo '<button id="botonLab" onclick="verLab()">'.obtenerTraduccion('ver').'</button>';
            echo '
            </td>
            </tr>
            <tr>
            <td>'.obtenerTraduccion('verSolicitudes').'</td>
            <td width="70%">';
            echo '<button id="botonSolicitudes" onclick="verSolicitudes()">'.obtenerTraduccion('ver').'</button>';
            echo '
            </td>
            </tr>
            <tr>
            <td>'.obtenerTraduccion('verIncidencias').'</td>
            <td width="70%">';
            echo '<button id="botonIncidencias" onclick="verIncidencias()">'.obtenerTraduccion('ver').'</button>';
            echo '
            </td>
            </tr>
            <tr>
            <td>'.obtenerTraduccion('editarSoftware').'</td>
            <td width="70%">';
            echo '<button id="botonSoftware" onclick="verSoftware()">'.obtenerTraduccion('editar').'</button>';
            echo '
            </td>
            </tr>
            </table>';

            echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script type="text/javascript">
            function verLab(){
                window.location.href = "/ver-hw-laboratorios";
            }
            function verSolicitudes(){
                window.location.href = "/ver-solicitudes";
            }
            function verIncidencias(){
                window.location.href = "/ver-incidencias";
            }
            function verSoftware(){
                window.location.href = "/ver-software";
            }
            
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