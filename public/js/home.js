$(document).ready(function() {
    // Handler para enviar la pregunta al hacer Enter en el input
    $('#input-question').keypress(function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            var pregunta = $(this).val();
            if (validarCampos(pregunta)) {
                realizarPregunta(pregunta);
            }
        }
    });

    // Handler para enviar la pregunta al hacer clic en el botón
    $('#submit-button').click(function() {
        var pregunta = $('#input-question').val();
        if (validarCampos(pregunta)) {
            realizarPregunta(pregunta);
        }
    });
});

function validarCampos(pregunta) {
    if (pregunta === '') {
        alert('Ingresa una pregunta antes de enviarla.');
        return false;
    }
    return true;
}

function realizarPregunta(pregunta) {
    $("#barra").show();
    // Realizar la solicitud al servidor PHP
    $.ajax({
        type: "POST",
        url: "../api/chatAPI.php",
        data: {
            mensaje: pregunta
        },
        success: function(respuesta) {
            $("#barra").hide();
            // Agregar la pregunta y respuesta al contenedor de chat
            var preguntaHtml = `<strong>😎 Tu:</strong> ` + pregunta;
            var respuestaHtml = '<strong>🤖 Respuesta:</strong> ' + respuesta;
            // Obtén una referencia al elemento del div
            var chatContainer = $('#chat-container');
            chatContainer.append('<p>' + preguntaHtml + '</p>');
            chatContainer.append('<p>' + respuestaHtml + '</p>');

            // Limpiar el input y desplazarse al final del contenedor de chat
            $('#input-question').val('');
            chatContainer.scrollTop(chatContainer[0].scrollHeight);
        }
    });
}
