<?php
function ver_laboratorios(){
    $idioma = get_locale();

    global $wpdb;

    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'aula_solicitudes');

    echo '<table><tr><th>'. obtenerTraduccion("imagenes") .'</th><th>'. obtenerTraduccion("laboratorios") .'</th><th>'. obtenerTraduccion("puestos") .'</th><th>'. obtenerTraduccion("ver") .'</th></tr>';

    foreach ($results as $result) {
        $results_hardware = $wpdb->get_results('SELECT count(imagen) AS puestos, imagen FROM ' . $wpdb->prefix . 'hardware_solicitudes WHERE id_aula='. $result->id .' ORDER BY imagen ASC');
        foreach ($results_hardware as $result_hardware) {
            echo '<tr><td style="text-align: center;">';
            echo $result_hardware->imagen;
            echo '</td><td style="text-align: center;"><a href="ver-hw-laboratorio?id='.$result->id.'">';
            if ($idioma == "eu") {
                echo $result->nombre_eus;
            } else {
                echo $result->nombre;
            }
            echo '</a></td>';
            echo '</td><td style="text-align: center;">';
            echo $result_hardware->puestos;
            echo '</td>
                <td>
                   <button id="botonHW" onclick="verHW('.$result->id.')">Hardware</button>
                   <button id="botonSW" onclick="verSW('.$result->id.')">Software</button>
                </td>
                </tr>';

        }
    }
    echo '</table>';

    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script type="text/javascript">

                function verHW(id_lab){
                    window.location.href = "ver-hw-laboratorio?id=" + id_lab;
                }
                
                function verSW(id_lab){
                    window.location.href = "ver-sw-laboratorio?id=" + id_lab;
                }
            </script>';
}
?>