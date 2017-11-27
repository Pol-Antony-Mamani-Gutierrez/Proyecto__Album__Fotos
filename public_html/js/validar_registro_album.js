function val_album() {
    var  pais;
    pais = document.getElementById("registro_album_pais").value;
    if (pais === "seleccion_pais") {
        swal('OOPSS!', 'Ocurrio un error. No seleccionaste tu País.', 'error');
        return false;
    }
}
