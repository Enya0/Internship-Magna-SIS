<?php
function ver_software()
{
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $roles = ( array )$user->roles;
        $role = $roles[0];
        if ($role == 'administrator') {
            global $wpdb;
            $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'software_solicitudes');
            echo '<table bgcolor="#FFFFFF">';
            echo '<tr><th>'.obtenerTraduccion('nombre').'</th>
                <th>'.obtenerTraduccion('version').'</th>
                <th>'.obtenerTraduccion('notas').'</th><th></th></tr>';

            foreach ($results as $result){
                echo '<tr><td>';
                echo $result->nombre;
                echo '</td>';
                echo '<td>';
                echo $result->version;
                echo '</td>';
                echo '<td>';
                echo $result->notas;
                echo '</td>';
                echo '<td>';
                echo '<button id="botonEditar" onclick="editar('.$result->id.')">'.obtenerTraduccion('editar').'</button>';
                echo '</td></tr>';
            }


            echo '</table>';

            echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script type="text/javascript">

                function editar(id_lab){
                    window.location.href = "editar-software?id=" + id_lab;
                }
                
                function eliminar(id_lab){
                    window.location.href = "eliminar-software?id=" + id_lab;
                }
                
            </script>';
        }
    }else{
        echo ":)";
    }
}
?>