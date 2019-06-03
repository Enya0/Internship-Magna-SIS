<?php
include('../traducciones.php');

if(isset($_POST['lab']) && isset($_POST['so'])){
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';
    global $wpdb;
    $id_lab = $_POST['lab'];
    $id_so = $_POST['so'];
    $results = $wpdb->get_results('SELECT id_software FROM ' . $wpdb->prefix . 'software_aula_solicitudes WHERE id_aula='. $id_lab);



    echo '<table bgcolor="#FFFFFF"><tr><th>'.obtenerTraduccion('nombre').'</th>
        <th>'.obtenerTraduccion('version').'</th>
        <th>'.obtenerTraduccion('notas').'</th></tr>';

    foreach ($results as $result) {
        $id_software = $result->id_software;
        $results_so = $wpdb->get_results('SELECT id_software FROM ' . $wpdb->prefix . 'software_so_solicitudes WHERE id_software=' . $id_software .' AND id_so='. $id_so);

        foreach ($results_so as $result_so){
            $softwares = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'software_solicitudes WHERE id=' . $id_software .' ORDER BY nombre ASC');
            foreach ($softwares as $software) {
                echo '<tr>';
                echo '<td>';
                echo $software->nombre;
                echo '</td>';
                echo '<td>';
                echo $software->version;
                echo '</td>';
                echo '<td>';
                echo $software->notas;
                echo '</td>';
                echo '</tr>';
            }
        }

    }
    echo '</table>';
    return 0;
}else{
    echo ":)";
    return 0;
}
?>