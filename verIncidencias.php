<?php

function ver_incidencias()
{
    $idioma = get_locale();

    global $wpdb;
    $resultsLab = $wpdb->get_results('SELECT id, nombre, nombre_eus FROM ' . $wpdb->prefix . 'aula_solicitudes');

    echo obtenerTraduccion("nombreLabAula") . ': &nbsp;&nbsp;&nbsp;';

    echo ' <select id="id_aula" onchange="cargarIncidencias()">';

    foreach ($resultsLab as $result) {
        if ($idioma == "eu_ES") {
            echo '<option value="' . $result->id . '">' . $result->nombre_eus . '</option>';
        } else {
            echo '<option value="' . $result->id . '">' . $result->nombre . '</option>';
        }
    }

    echo '</select>

    <div id="incidencias"></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function cargarIncidencias(){
            var formData = new FormData();
            var selectedId = $("#id_aula").children("option:selected").val();

            formData.append("id_aula", selectedId);
            
            $.ajax({
                url: "/wp-content/plugins/solicitudes/obtenerIncidenciasLaboratorio.php",
                type: "POST",
                data: formData,
                dataType: "json",
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
            }).done(function (data) {
                console.log(data);
                    $("#incidencias").html(data["responseText"]);
                }
            ).fail(function (data) {
                console.log(data);
                     $("#incidencias").html(data["responseText"]);
                }
            );
        }
    </script>';
}

?>