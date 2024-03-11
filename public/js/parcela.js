var canvas = document.querySelector('canvas');
//canvas.focus();
canvas.width  = 900;
canvas.height = 400;
var ctx = canvas.getContext('2d');

var escenario   = new Image();
var parcela     = new Image();
var personaje   = new Image();
personaje.src = 'img/personajes/personaje-v1.png';

var dataUsuario = JSON.parse(canvas.getAttribute("data"));

definirParcela(dataUsuario.parcelas);

var perX = 50;
var perY = -56;
var imagenX = 100;
var imagenY = 100;
var auxX = 0;
var auxY = 0;
var spriteX = 0, spriteY = 0;
var tiempo = 0;
var mousePresionado = false;

//intervalo donde ocurre toda la animacion del juego
var intervaloAnimar = setInterval(animacion, 6);

//mostrar todo lo que va a aparecer en el juego
function animacion(){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    //tiempo = (tiempo + 1) % 100;
    /*
    spriteY = 0;
    spriteX ++;
    if (spriteX > 1) spriteX = 0;
    */
    dibujarFondo();
    dibujarParecela();
}
//dibujar el fondo dependiendo de la hora
function dibujarFondo(){
    var fechaActual = new Date();
    var hora = fechaActual.getHours();
    var minutos = fechaActual.getMinutes();

    if      (hora > 5  && hora <= 14)   escenario.src = 'img/mundo/escenario-dia-t.jpg';
    else if (hora > 14 && hora <= 18)   escenario.src = 'img/mundo/escenario-tarde-t.jpg';
    else if (hora > 18 || hora <= 5 )   escenario.src = 'img/mundo/escenario-noche-t.jpg';
    ctx.drawImage(escenario, 0, 0);
    //console.log(hora);
}
function definirParcela(numeroParcela) {
    switch (numeroParcela) {
        case '1':  parcela.src = 'img/parcela/parcela-i1.png'; break;
        case '2':  parcela.src = 'img/parcela/parcela-i2.png'; break;
        case '3':  parcela.src = 'img/parcela/parcela-i3.png'; break;
        case '4':  parcela.src = 'img/parcela/parcela-i4.png'; break;
        case '5':  parcela.src = 'img/parcela/parcela-i5.png'; break;
        case '6':  parcela.src = 'img/parcela/parcela-d2.png'; break;
        case '7':  parcela.src = 'img/parcela/parcela-d3.png'; break;
        case '8':  parcela.src = 'img/parcela/parcela-d4.png'; break;
        case '9':  parcela.src = 'img/parcela/parcela-d5.png'; break;
        case '10': parcela.src = 'img/parcela/parcela-b2.png'; break;
        case '11': parcela.src = 'img/parcela/parcela-b3.png'; break;
        case '12': parcela.src = 'img/parcela/parcela-b4.png'; break;
        case '14': parcela.src = 'img/parcela/parcela-b5.png'; break;
        case '15': parcela.src = 'img/parcela/parcela-q3.png'; break;
        case '16': parcela.src = 'img/parcela/parcela-q4.png'; break;
        case '17': parcela.src = 'img/parcela/parcela-q5.png'; break;
        case '18': parcela.src = 'img/parcela/parcela-p3.png'; break;
        case '19': parcela.src = 'img/parcela/parcela-p4.png'; break;
        case '20': parcela.src = 'img/parcela/parcela-p5.png'; break;
        default:   parcela.src = 'img/parcela/parcela-i1.png';
    }
}
function dibujarParecela() {
    ctx.drawImage(parcela, imagenX, imagenY);
    ctx.drawImage(personaje, spriteX*48, spriteY*64, 46, 62, imagenX+perX, imagenY+perY, 46, 62);
}

// Agregar eventos de mouse para el movimiento de la imagen
canvas.addEventListener('mousedown', function(e) {
    auxX = e.clientX-imagenX;
    auxY = e.clientY-imagenY;
    mousePresionado = true;
});

canvas.addEventListener('mousemove', function(e) {
    if (mousePresionado) {
        // Actualiza la posición de la imagen con la posición del mouse
        imagenX = e.clientX-auxX;
        imagenY = e.clientY-auxY;
        dibujarParecela(); // Dibuja la imagen en su nueva posición
    }
});

canvas.addEventListener('mouseup', function(e) {
    mousePresionado = false;
});

canvas.addEventListener('keydown', function (e) {
    mousePresionado = false;
    if (e.key === 'ArrowRight' || e.key === 'd') {
        perX+=5;
        spriteY = 1;
        spriteX ++;
        if (spriteX > 5) spriteX = 1;
        dibujarParecela();
    }
    else if (e.key === 'ArrowLeft' || e.key === 'a') {
        perX-=5;
        spriteY = 2;
        spriteX ++;
        if (spriteX > 5) spriteX = 1;
        dibujarParecela();
    }
});
