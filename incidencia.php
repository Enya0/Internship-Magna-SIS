<?php

	include('wp-content/plugins/solicitudes/traducciones.php');

	function verIncidencia(){

		if (isset($_POST['id'])){
			$id_incidencia = $_POST['id'];

			global $wpdb;

			$results = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'incidencia_solicitudes WHERE id = $id_incidencia');
			foreach($results as $result) {
			$idioma = get_locale();
			echo '<table>
			        <tr>
			            <td>
			                '.obtenerTraduccion("incidencia").':  
			            </td>
			            <td width="70%">';

                			echo $id_incidencia;

			                echo'
			            </td>
			        </tr>
			        <tr>
			            <td>
			                '.obtenerTraduccion("registradaPor").':
			            </td>
			            <td>
			                '; 

			                echo $result->nombre . ' [' . $result->email . ']'; 

			                echo'
			            </td>
			        </tr>
			        <tr>
			            <td>
			                '.obtenerTraduccion("aula").': 
			            </td>
			            <td>';

			            	$results_aula = $wpdb->get_results('SELECT nombre,nombre_eus FROM ' . $wpdb->prefix . 'aula_solicitudes WHERE id = $result->id_aula');
			            	foreach($results_aula as $result_aula) {
				            	if($idioma == "eu_ES"){
				            		$result_aula->nombre_eus;
				            	}else{
				            		$result_aula->nombre;
				            	}
				            }

			                echo '</td>
			        </tr>
			        <tr>
			            <td>
			                '.obtenerTraduccion("tipoProblema").': 
			            </td>
			            <td>';

			            	$result->tipo;
			            	
			            echo '</td>
			        </tr>
			        <tr>
			            <td>
			                '.obtenerTraduccion("mensaje").': 
			            </td>
			            <td>';

			                $result->notas;

			            echo'</td>
			        </tr>
			        <tr>
			            <td>';
			                if ($result->estado == 1){
			                	echo '<button style="background-color:#90EE90" disabled>' . obtenerTraduccion("abierta") . '</button>';
			                }else{
			                	echo '<button style="background-color:#FF6347" disabled>' . obtenerTraduccion("cerrada") . '</button>';
			                }
			            echo'</td>
			            <td>';
			                
			            echo'</td>
			        </tr>
			    </table>';
			}

		}
		else{
			echo "No se ha introducido un identificador de incidencia.";
		}
	}

?>