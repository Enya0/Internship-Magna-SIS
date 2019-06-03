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

    $nombres = [];
    $versiones = [];
    $notas = [];

    foreach ($results as $result) {
        $id_software = $result->id_software;
        $results_so = $wpdb->get_results('SELECT id_software FROM ' . $wpdb->prefix . 'software_so_solicitudes WHERE id_software=' . $id_software .' AND id_so='. $id_so);

        foreach ($results_so as $result_so){
            $softwares = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'software_solicitudes WHERE id=' . $id_software);
            foreach ($softwares as $software) {
                array_push($nombres, $software->nombre);
                array_push($versiones, $software->version);
                array_push($notas, $software->notas);
            }
        }
    }

    // One by one move boundary of unsorted subarray
    for ($i = 0; $i < sizeof($nombres)-1; $i++)
    {
        // Find the minimum element in unsorted array
        $min_idx = $i;
        for ($j = $i+1; $j < sizeof($nombres); $j++) {
        if (strcasecmp($nombres[$j], $nombres[$min_idx]) < 0) {
            $min_idx = $j;
        }
    }
        // Swap the found minimum element with the first element
        $temp = $nombres[$min_idx];
        $nombres[$min_idx] = $nombres[$i];
        $nombres[$i] = $temp;

        $temp2 = $versiones[$min_idx];
        $versiones[$min_idx] = $versiones[$i];
        $versiones[$i] = $temp2;

        $temp3 = $notas[$min_idx];
        $notas[$min_idx] = $notas[$i];
        $notas[$i] = $temp3;
    }

    for($i = 0; $i<sizeof($nombres); $i++){
        echo '<tr>';
        echo '<td>';
        echo $nombres[$i];
        echo '</td>';
        echo '<td>';
        echo $versiones[$i];
        echo '</td>';
        echo '<td>';
        echo $notas[$i];
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
    return 0;
}else{
    echo ":)";
    return 0;
}
?>