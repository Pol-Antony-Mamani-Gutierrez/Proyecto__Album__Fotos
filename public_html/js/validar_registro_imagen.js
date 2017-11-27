function val_imagen() {
    var  imagen;
    pais = document.getElementById("registro_imagen_fomulario_select").value;
    if (pais === "seleccion_album") {
        swal('OOPSS!', 'Ocurrio un error. No seleccionaste el Album al que va a pertenecer tu Fotografiá.', 'error');
        return false;
    }
}
