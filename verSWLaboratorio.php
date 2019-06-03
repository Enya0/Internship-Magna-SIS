<?php
function ver_sw_laboratorio(){
    $idioma = get_locale();

    global $wpdb;

    $id_lab = $_GET['id'];

    $results_aula = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'aula_solicitudes WHERE id='. $id_lab);

    foreach ($results_aula as $result_aula) {
        if($idioma == "eu"){
            echo '<h4>Software '. $result_aula->nombre_eus .'</h4>';
        }else{
            echo '<h4>Software '. $result_aula->nombre .'</h4>';
        }

    }

    $results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'so_solicitudes');


    echo obtenerTraduccion("sistemaOperativo") . ': &nbsp;&nbsp;&nbsp;';



    foreach ($results as $result) {
        echo '<button onclick="cargarSW('.$result->id .')">' . $result->nombre . '</button>&nbsp;&nbsp;';
    }

    echo '<br/><br/>
            <div id="sw"></div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script type="text/javascript">

                function cargarSW(id_so){
                    var formData = new FormData();

                    formData.append("lab", '.$id_lab.');
                    formData.append("so", id_so);
                    
                    
                    $.ajax({
                        url: "/wp-content/plugins/solicitudes/funciones/obtenerSWLaboratorio.php",
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        mimeType: "multipart/form-data",
                        processData: false,
                        contentType: false,
                    }).done(function (data) {
                            console.log(data);
                            $("#sw").html(data["responseText"]);
                        }
                    ).fail(function (data) {
                            console.log(data);
                            $("#sw").html(data["responseText"]);
                        }
                    );
                }
                cargarSW(1);
            </script>';

}
?>