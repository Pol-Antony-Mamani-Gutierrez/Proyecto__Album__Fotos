function java_pruebas() {
    var genero, pais;
    genero = document.getElementById("genero").value;
    pais = document.getElementById("pais").value;
    if (pais === "seleccion_pais") {
        swal('OOPSS!', 'Ocurrio un error. No seleccionaste tu País.', 'error');
        return false;
    }
    if (genero === "seleccion_genero") {
        swal('OOPSS!', 'Ocurrio un error. No seleccionaste tu Género.', 'error');
        return false;
    }
}
