<?php

function form_incidencias(){
    global $wpdb;
    $euskera = 'eu';
    $results = $wpdb->get_results('SELECT id, nombre, nombre_eus FROM ' . $wpdb->prefix . 'aula_solicitudes');
    echo '<form id="fincidencias" name="fincidencias" action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                '.obtenerTraduccion("email").'*:  
            </td>
            <td width="70%">
                <input type="text" id="email" name="email" class="texto-form">
            </td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("nombre").'*:
            </td>
            <td>
                <input type="text" id="nombre" name="nombre" class="texto-form">
            </td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("nombreLabAula").'*: 
            </td>
            <td>
                <select name="aula">';

                foreach($results as $result) {
                    $idioma = get_locale();
                    if($idioma == $euskera){
                        echo '<option value="' . $result->id . '">' . $result->nombre_eus . '</option>';
                    }else{
                        echo '<option value="' . $result->id . '">' . $result->nombre . '</option>';
                    }
                }

                echo'</select>
            </td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("tipoProblema").'*:
            </td>
            <td>
                <select name="problema">
                    <option value="Hardware">Hardware</option>
                    <option value="Software">Software</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("descripcion").'*: 
            </td>
            <td>
                <textarea rows = "3" id="descrip" name="descrip" class="texto-form"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" id="send" name="send" value="'.obtenerTraduccion("enviar").'" onclick="enviarIncidencia()">
            </td>
            <td>
                <p id="mensaje"></p>
            </td>
        </tr>
    </table>
    </form>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function enviarIncidencia(){

            var incidencia = $("#fincidencias").get(0);
            $("#mensaje").html("<img src=\'/wp-content/plugins/solicitudes/loading.gif\' width=\'50px\'>");

            $.ajax({
                url: "/wp-content/plugins/solicitudes/enviarIncidencias.php",
                type: "POST",
                data: new FormData(incidencia),
                dataType: "json",
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
            }).done(function (data) {
                    $("#mensaje").html(data["responseText"]);
                    $("#fincidencias")[0].reset();
            }
            ).fail(function (data) {
                    $("#mensaje").html(data["responseText"]);
                    $("#fincidencias")[0].reset();
            }
            );
        }
    </script>';
}


function form_solicitud(){
    $idioma = get_locale();
    global $current_user;
    wp_get_current_user();
    $euskera = 'eu';
    global $wpdb;
    $results = $wpdb->get_results('SELECT id, nombre, nombre_eus FROM ' . $wpdb->prefix . 'asignatura_solicitudes');
    $resultsLab = $wpdb->get_results('SELECT id, nombre, nombre_eus FROM ' . $wpdb->prefix . 'aula_solicitudes');
    $resultsSO = $wpdb->get_results('SELECT id, nombre FROM ' . $wpdb->prefix . 'so_solicitudes');
    echo '<div id="formulario"><form id="fsolicitud" name="fsolicitud" action="" method="post" enctype="multipart/form-data">
    <input type="text" value="'.$current_user->user_email.'" name="email" style="visibility: hidden;"/>

    <table>
        <tr>
            <td>
                '.obtenerTraduccion("asignatura").'*:  
            </td>
            <td width="70%">
                <select name="asig">';

                foreach($results as $result) {
                    if($idioma == $euskera){
                        echo '<option value="' . $result->id . '">' . $result->nombre_eus . '</option>';
                    }else{
                        echo '<option value="' . $result->id . '">' . $result->nombre . '</option>';
                    }
                }

                echo'</select>
            </td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("nombreLabAula").'*:
            </td>
            <td>
                '; //<select name="aula">

                foreach($resultsLab as $resultLab) {
                    if($idioma == $euskera){
                        //echo '<option value="' . $resultLab->id . '">' . $resultLab->nombre_eus . '</option>';
                        echo '<input type="checkbox" name="aula[]" value="' . $resultLab->id . '">&nbsp;' . $resultLab->nombre_eus . '&nbsp;</input>' ;
                    }else{
                        //echo '<option value="' . $resultLab->id . '">' . $resultLab->nombre . '</option>';
                        echo '<input type="checkbox" name="aula[]" value="' . $resultLab->id . '">&nbsp;' . $resultLab->nombre. '&nbsp;</input>' ;
                    }
                }

                echo'
            </td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("sistemaOperativo").'*: 
            </td>
            <td>';

                foreach($resultsSO as $resultSO) {
                    echo '<input type="checkbox" name="sistOp[]" value="' . $resultSO->id . '">&nbsp;' . $resultSO->nombre . '</imput><br/>';
                }

                echo'</td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("nSoftware").'*: 
            </td>
            <td>
                <input type="number" id="nSoftware" name="nSoftware" class="texto-form">
            </td>
        </tr>

        <tr>
            <td>
                <input type="button" id="send" name="send" value="'.obtenerTraduccion("enviar").'" onclick="siguienteSolicitud()">
            </td>
            <td>
                <p id="mensaje"></p>
            </td>
        </tr>
    </table>
    </form></div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function siguienteSolicitud(){

            var solicitud = $("#fsolicitud").get(0);
            $("#mensaje").html("<img src=\'/wp-content/plugins/solicitudes/loading.gif\' width=\'50px\'>");
            
            $.ajax({
                url: "/wp-content/plugins/solicitudes/siguienteSolicitudes.php",
                type: "POST",
                data: new FormData(solicitud),
                dataType: "json",
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
            }).done(function (data) {
                console.log(data);
                if(data.status == "0"){
                    $("#mensaje").html(data.msg);
                    $("#fsolicitud")[0].reset();
                }else{
                    $("#formulario").html(data.msg);
                }
            }
            ).fail(function (data) {
                console.log(data);
                if(data.status == "0"){
                    $("#mensaje").html(data.msg);
                    $("#fsolicitud")[0].reset();
                }else{
                    $("#formulario").html(data.msg);
                }
            }
            );
        }
        
        function enviarSolicitud(){

            var solicitud = $("#fprogramas").get(0);
            $("#mensaje").html("<img src=\'/wp-content/plugins/solicitudes/loading.gif\' width=\'50px\'>");
            
            $.ajax({
                url: "/wp-content/plugins/solicitudes/enviarSolicitudes.php",
                type: "POST",
                data: new FormData(solicitud),
                dataType: "json",
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
            }).done(function (data) {
                console.log(data);
                if(data.status == "0"){
                    $("#mensaje").html(data.msg);
                    //$("#fsolicitud")[0].reset();
                }else{
                    $("#formulario").html(data.msg);
                }
            }
            ).fail(function (data) {
                console.log(data);
                if(data.status == "0"){
                    $("#mensaje").html(data.msg);
                    //$("#fsolicitud")[0].reset();
                }else{
                    $("#formulario").html(data.msg);
                }
            }
            );
        }
    </script>';
}


function form_so(){
    echo '<form id="fso" name="fso" action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                '.obtenerTraduccion("nombre").'*:
            </td>
            <td>
                <input type="text" id="nombre" name="nombre" class="texto-form">
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" id="send" name="send" value="'.obtenerTraduccion("enviar").'" onclick="insertaSO()">
            </td>
            <td>
                <p id="mensaje"></p>
            </td>
        </tr>
    </table>
    </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function insertaSO(){

            var nombre = $("#fso").get(0);
            $("#mensaje").html("<img src=\'/wp-content/plugins/solicitudes/loading.gif\' width=\'50px\'>");

            $.ajax({
                url: "/wp-content/plugins/solicitudes/insertarSO.php",
                type: "POST",
                data: new FormData(nombre),
                dataType: "json",
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
            }).done(function (data) {
                    $("#mensaje").html(data["responseText"]);
                    $("#fso")[0].reset();
                }
            ).fail(function (data) {
                    $("#mensaje").html(data["responseText"]);
                    $("#fso")[0].reset();
                }
            );
        }
    </script>';
}


function form_asignatura(){
    echo '<form id="fasig" name="fasig" action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                '.obtenerTraduccion("nombreCastellano").'*:
            </td>
            <td>
                <input type="text" id="nombre" name="nombre" class="texto-form">
            </td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("nombreEuskara").'*:
            </td>
            <td>
                <input type="text" id="nombre_eus" name="nombre_eus" class="texto-form">
            </td>
        </tr>
        <tr>
            <td>
                '.obtenerTraduccion("curso").'*:
            </td>
            <td>
                <select name="curso">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" id="send" name="send" value="'.obtenerTraduccion("enviar").'" onclick="insertaAsignatura()">
            </td>
            <td>
                <p id="mensaje"></p>
            </td>
        </tr>
    </table>
    </form>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function insertaAsignatura(){

            var nombre = $("#fasig").get(0);
            $("#mensaje").html("<img src=\'/wp-content/plugins/solicitudes/loading.gif\' width=\'50px\'>");

            $.ajax({
                url: "/wp-content/plugins/solicitudes/insertarAsignatura.php",
                type: "POST",
                data: new FormData(nombre),
                dataType: "json",
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
            }).done(function (data) {
                    $("#mensaje").html(data["responseText"]);
                    $("#fasig")[0].reset();
                }
            ).fail(function (data) {
                    $("#mensaje").html(data["responseText"]);
                    $("#fasig")[0].reset();
                }
            );
        }
    </script>';
    }
?>