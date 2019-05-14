<?php

function obtenerTraduccion($str)
{

    $idioma = get_locale();

    $euskera = 'eu';

    switch ($str) {
        case 'nombre':
            if ($idioma == $euskera) {
                return "Izena";
            } else {
                return "Nombre";
            }
            break;
        case 'email':
            if ($idioma == $euskera) {
                return "Email-a";
            } else {
                return "Email";
            }
            break;

        case 'nombreLabAula':
            if ($idioma == $euskera) {
                return "Laborategiaren/Gelaren izena";
            } else {
                return "Nombre del Laboratorio/Aula";
            }
            break;

        case 'tipoProblema':
            if ($idioma == $euskera) {
                return "Arazoaren mota";
            } else {
                return "Tipo de problema";
            }
            break;
        case 'descripcion':
            if ($idioma == $euskera) {
                return "Deskribapena";
            } else {
                return "Descripción";
            }
            break;

        case 'enviar':
            if ($idioma == $euskera) {
                return "Bidali";
            } else {
                return "Enviar";
            }
            break;

        case 'incidencia':
            if ($idioma == $euskera) {
                return "Intzidentzia";
            } else {
                return "Incidencia";
            }
            break;

        case 'solicitud':
            if ($idioma == $euskera) {
                return "Eskaera";
            } else {
                return "Solicitud";
            }
            break;

        case 'asignatura':
            if ($idioma == $euskera) {
                return "Irakasgaia";
            } else {
                return "Asignatura";
            }
            break;

        case 'sistemaOperativo':
            if ($idioma == $euskera) {
                return "Sistema eragilea";
            } else {
                return "Sistema operativo";
            }
            break;

        case 'nombrePrograma':
            if ($idioma == $euskera) {
                return "Programaren izena";
            } else {
                return "Nombre del programa";
            }
            break;

        case 'version':
            if ($idioma == $euskera) {
                return "Bertsioa";
            } else {
                return "Versión";
            }
            break;

        case 'infoAdicional':
            if ($idioma == $euskera) {
                return "Informazio gehigarria (url-a, oharrak, lizentzia, pluginak...)";
            } else {
                return "Información adicional (url, notas, licencia, plugins...)";
            }
            break;

        case 'insertarAsignatura':
            if ($idioma == $euskera) {
                return "Irakasgaia sartu";
            } else {
                return "Insertar asignatura";
            }
            break;

        case 'nombreCastellano':
            if ($idioma == $euskera) {
                return "Izena gaztelaniaz";
            } else {
                return "Nombre en castellano";
            }
            break;

        case 'nombreEuskara':
            if ($idioma == $euskera) {
                return "Izena euskaraz";
            } else {
                return "Nombre en euskera";
            }
            break;

        case 'curso':
            if ($idioma == $euskera) {
                return "Maila";
            } else {
                return "Curso";
            }
            break;

        case 'nSoftware':
            if ($idioma == $euskera) {
                return "Zenbat programa nahi dituzu eskatu?";
            } else {
                return "¿Cuántos programas quieres pedir?";
            }
            break;

        case 'insertarSistOp':
            if ($idioma == $euskera) {
                return "Sistema eragilea sartu.";
            } else {
                return "Insertar sistema operativo.";
            }
            break;

        case 'erEmailIncorrecto':
            if ($idioma == $euskera) {
                return "Sartutako email-a ez da zuzena.";
            } else {
                return "El email introducido no es válido.";
            }
            break;

        case 'erNombreValido':
            if ($idioma == $euskera) {
                return "Mesedez, izena sartu.";
            } else {
                return "Por favor, introduzca un nombre.";
            }
            break;

        case 'erProgramaValido':
            if ($idioma == $euskera) {
                return "Mesedez, programa sartu.";
            } else {
                return "Por favor, introduzca un programa.";
            }
            break;

        case 'eVersionValida':
            if ($idioma == $euskera) {
                return "Mesedez, bertsioa sartu.";
            } else {
                return "Por favor, introduzca una versión.";
            }
            break;

        case 'erDescripValida':
            if ($idioma == $euskera) {
                return "Mesedez, deskribapena sartu.";
            } else {
                return "Por favor, introduzca una descripción.";
            }
            break;

        case 'erAulaValida':
            if ($idioma == $euskera) {
                return "Mesedez, gutxienez gela bat aukeratu.";
            } else {
                return "Por favor, elija al menos un aula.";
            }
            break;

        case 'erSistemaOperativoValido':
            if ($idioma == $euskera) {
                return "Mesedez, gutxienez sistema eragile bat aukeratu.";
            } else {
                return "Por favor, elija al menos un sistema operativo.";
            }
            break;

        case 'erNSoftwareValido':
            if ($idioma == $euskera) {
                return "Mesedez, programa zenbaki balido bat sartu.";
            } else {
                return "Por favor, introduzca un número de programas válido.";
            }
            break;

        case 'incidenciaOK':
            if ($idioma == $euskera) {
                return "Arrakastarekin erregistratutako intzidentzia.";
            } else {
                return "Incidencia registrada con éxito.";
            }
            break;

        case 'incidenciaNoOK':
            if ($idioma == $euskera) {
                return "Intzidentzia ezin izan da erregistratu. Egiazta itzazu eremuak.";
            } else {
                return "La incidencia no ha podido registrarse. Comprueba los campos.";
            }
            break;

        case 'asignaturaOK':
            if ($idioma == $euskera) {
                return "Arrakastarekin erregistratutako irakasgaia.";
            } else {
                return "Asignatura registrada con éxito.";
            }
            break;

        case 'asignaturaNoOK':
            if ($idioma == $euskera) {
                return "Irakasgaia ezin izan da erregistratu. Egiazta itzazu eremuak.";
            } else {
                return "La asignatura no ha podido registrarse. Comprueba los campos.";
            }
            break;

        case 'sistemaOperativoOK':
            if ($idioma == $euskera) {
                return "Arrakastarekin erregistratutako sistema eragilea.";
            } else {
                return "Sistema operativo registrado con éxito.";
            }
            break;

        case 'sistemaOperativoNoOK':
            if ($idioma == $euskera) {
                return "Sistema eragilea ezin izan da erregistratu. Egiazta itzazu eremuak.";
            } else {
                return "El sistema operativo no ha podido registrarse. Comprueba los campos.";
            }
            break;

        case 'solicitudOK':
            if ($idioma == $euskera) {
                return "Arrakastarekin erregistratutako eskaera.";
            } else {
                return "Solicitud registrada con éxito.";
            }
            break;

        case 'solicitudNoOK':
            if ($idioma == $euskera) {
                return "Eskaera ezin izan da erregistratu. Egiazta itzazu eremuak.";
            } else {
                return "La solicitud no ha podido registrarse. Comprueba los campos.";
            }
            break;

        case 'registradaPor':
            if ($idioma == $euskera) {
                return "Erregistraria";
            } else {
                return "Registrada por";
            }
            break;

        case 'mensaje':
            if ($idioma == $euskera) {
                return "Mezua";
            } else {
                return "Mensaje";
            }
            break;

        case 'abierta':
            if ($idioma == $euskera) {
                return "Irekia";
            } else {
                return "Abierta";
            }
            break;

        case 'cerrada':
            if ($idioma == $euskera) {
                return "Itxia";
            } else {
                return "Cerrada";
            }
            break;

        case 'cerrar':
            if ($idioma == $euskera) {
                return "Itxi";
            } else {
                return "Cerrar";
            }
            break;

        case 'verIncidenciaError':
            if ($idioma == $euskera) {
                return "Intzidentziaren identifikatzailea ez da sartu.";
            } else {
                return "No se ha introducido un identificador de incidencia.";
            }
            break;

        case 'estado':
            if ($idioma == $euskera) {
                return "Egoera";
            } else {
                return "Estado";
            }
            break;

        case 'registrada':
            if ($idioma == $euskera) {
                return "Erregistratua";
            } else {
                return "Registrada";
            }
            break;

        case 'descartada':
            if ($idioma == $euskera) {
                return "Ezeztatuta";
            } else {
                return "Descartada";
            }
            break;

        case 'reabierta':
            if ($idioma == $euskera) {
                return "Berrirekia";
            } else {
                return "Reabierta";
            }
            break;

        case 'pendiente':
            if ($idioma == $euskera) {
                return "Balioztatze zain";
            } else {
                return "Pendiente de validación";
            }
            break;

        case 'validada':
            if ($idioma == $euskera) {
                return "Balioztatuta";
            } else {
                return "Validada";
            }
            break;

        case 'desplegada':
            if ($idioma == $euskera) {
                return "Zabalduta";
            } else {
                return "Desplegada";
            }
            break;

        case 'verSolicitudError':
            if ($idioma == $euskera) {
                return "Eskaeraren identifikatzailea ez da sartu.";
            } else {
                return "No se ha introducido un identificador de solicitud.";
            }
            break;

        case 'descartar':
            if ($idioma == $euskera) {
                return "Ezeztatu";
            } else {
                return "Descartar";
            }
            break;

        case 'marcarPendiente':
            if ($idioma == $euskera) {
                return "Balioztatze bezala jarri";
            } else {
                return "Marcar pendiente de validación";
            }
            break;

        case 'reabrir':
            if ($idioma == $euskera) {
                return "Berrireki";
            } else {
                return "Reabrir";
            }
            break;

        case 'validar':
            if ($idioma == $euskera) {
                return "Balioztatu";
            } else {
                return "Validar";
            }
            break;

        case 'desplegar':
            if ($idioma == $euskera) {
                return "Zabaldu";
            } else {
                return "Desplegar";
            }
            break;

        case 'motivo':
            if ($idioma == $euskera) {
                return "Arrazoia";
            } else {
                return "Motivo";
            }
            break;

        case 'errorMotivo':
            if ($idioma == $euskera) {
                return "Ez da arrazoia bete.";
            } else {
                return "No se ha introducido el motivo.";
            }
            break;

        case 'csvCargar':
            if ($idioma == $euskera) {
                return "Kargatzeko CSV-a";
            } else {
                return "CSV a cargar";
            }
            break;

        case 'avisoCargarCsv':
            if ($idioma == $euskera) {
                return "Kontuz: CSV bat kargatzerakoan aurreko datu guztiak ezabatuko dira.";
            } else {
                return "Aviso: al cargar un CSV se borrarán todos los datos anteriores.";
            }
            break;

        case 'cargar':
            if ($idioma == $euskera) {
                return "Kargatu";
            } else {
                return "Cargar";
            }
            break;

        case 'imagenes':
            if ($idioma == $euskera) {
                return "Irudiak";
            } else {
                return "Imágenes";
            }
            break;

        case 'laboratorios':
            if ($idioma == $euskera) {
                return "Laborategiak";
            } else {
                return "Laboratorios";
            }
            break;

        case 'puestos':
            if ($idioma == $euskera) {
                return "Postuak";
            } else {
                return "Puestos";
            }
            break;

        case 'volver':
            if ($idioma == $euskera) {
                return "Atzera";
            } else {
                return "Volver";
            }
            break;

        case 'solicitudAnterior':
            if ($idioma == $euskera) {
                return "Iazko eskaera";
            } else {
                return "Solicitud anterior";
            }
            break;

        case 'repetirSolicitudAnterior':
            if ($idioma == $euskera) {
                return "Iazko eskaera errepikatu";
            } else {
                return "Repetir solicitud anterior";
            }
            break;

        case 'procesador':
            if ($idioma == $euskera) {
                return "Prozesadorea";
            } else {
                return "Procesador";
            }
            break;

        case 'grafica':
            if ($idioma == $euskera) {
                return "Txartel grafikoa";
            } else {
                return "Tarjeta gráfica";
            }
            break;

        case 'idioma':
            if ($idioma == $euskera) {
                return "Hizkuntza";
            } else {
                return "Idioma";
            }
            break;

        case 'antiguedad':
            if ($idioma == $euskera) {
                return "Antzinatea";
            } else {
                return "Antigüedad";
            }
            break;
    }
}

?>