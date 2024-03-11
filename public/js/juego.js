var canvas = document.querySelector('canvas');
canvas.width  = 900;
canvas.height = 400;
var ctx = canvas.getContext('2d');

var dataMisMutantes= JSON.parse(canvas.getAttribute("data"));
console.log(dataMisMutantes);

var escenario = new Image();
var mutanteS = [];
for (var i = 0; i < 4; i++) {
    mutanteS[i] = new Image();
}

var mutanteN = new Image();

var impacto    = new Image();
var selec      = new Image();
var retirar    = new Image();

escenario.src = "/img/mundo/arena-bosque-v1-2.jpg";

for (var i = 0; i < dataMisMutantes.length; i++) {
    mutanteS[i].src = "/img/mutante/mut"+dataMisMutantes[i].apariencia+"/mutante1-v1-s.png";
}
mutanteN.src = "/img/mutante/mut1/mutante1-v1-s.png";

impacto.src     = "/img/micel/impacto-v1.png";
selec.src       = "/img/micel/seleccion-v2.png";
retirar.src     = "/img/micel/retirar-v1.png";

//imagenes para deterinar si el usuario gano o perdio
var escenarioP = new Image();
var escenarioG = new Image();
escenarioP.src = "/img/mundo/prueba2-perdiste.jpg";
escenarioG.src = "/img/mundo/prueba2-ganaste.jpg";

var selectMutante = [80, 0, 0];

//variables de recepcion de terreno logico del juego
var pisoX = crearPisoX();
var pisoY = crearPisoY();

//mostrar las variables de recepcion de terreno logico del juego
console.log(pisoX);
console.log(pisoY);

//varias de intervalo de tiempo
var mostrarAtaque   = 0;
var mostrarDano     = 0;
var mostrarRetiro   = 0;
var tiempo          = 1;

//variables de control de juego
var idCntrl = '';
var turno = 0;
var mutantesTurnoCont = 4;

//intervalo donde ocurre toda la animacion del juego
var intervaloAnimar = setInterval(animacion, 6);

//variables de recepcion y monitorizacion del juego con la pagina
var btnDerecha      = document.getElementById('btnDerecha');
var btnIzquierda    = document.getElementById('btnIzquierda');
var btnArriba       = document.getElementById('btnArriba');
var btnAbajo        = document.getElementById('btnAbajo');
var btnRcargar      = document.getElementById('btnRcargar');
var mut1            = document.getElementById('id1');
var mut2            = document.getElementById('id2');
var mut3            = document.getElementById('id3');
var mut4            = document.getElementById('id4');
var energia         = document.getElementById('energia');
var vida            = document.getElementById('vida');
var btnAtaque1      = document.getElementById('btnAtaque1');
var btnAtaque2      = document.getElementById('btnAtaque2');

//mostrar todo lo que va a aparecer en el juego
function animacion(){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    tiempo++;
    if (tiempo >= 100) tiempo = 0;
    dibujarFondo();
    mostrarMutantes(misMutantes);
    mostrarMutantes(enemigos);
    ctx.drawImage(selec, 0, selectMutante[0], 40, 20, selectMutante[1]+20, selectMutante[2]-30,  40, 20);
    enemigoIA(enemigos, misMutantes);
}

//inicializar el objeto mutante
var mutante = function(mutante){
    return {
        id      :   mutante.id          || '',
        cx      :   mutante.cx          || 0,
        cy      :   mutante.cy          || 0,
        x       :   pisoX[mutante.cx]   || 0,
        y       :   pisoY[mutante.cy]   || 0,
        enrgia  :   mutante.enrgia      || 0,
        crga    :   mutante.crga        || 3,
        vida    :   mutante.vida        || 3,
        img     :   mutante.img         || mutanteN,
        mir     :   mutante.mir         || 'd',
        dccion  :   mutante.dccion      || '',
        ataque1 :   mutante.ataque1     || [], //daño - consumo de energia - alcance - casillas que afecta
        ataque2 :   mutante.ataque2     || [],
        ataque3 :   mutante.ataque3     || [],
        ataque4 :   mutante.ataque4     || [],
        objet   :   mutante.objet       || [],
    }
}
var posInicion = [];
if (dataMisMutantes.length == 1) posInicion = [2,2];
if (dataMisMutantes.length == 2) posInicion = [2,1,2,3];
if (dataMisMutantes.length == 3) posInicion = [0,0,2,2,0,4];
if (dataMisMutantes.length == 4) posInicion = [0,0,2,1,2,3,0,4];
//crear un arreglo con todos los mutantes del jugador

var misMutantes = [];
for (var i = 0; i < dataMisMutantes.length; i++) {
    var pilaMutantes = new mutante({
        id      : ""+(i+1),
        cx      : posInicion[i*2],
        cy      : posInicion[i*2+1],
        crga    : 5,
        enrgia  : 10,
        vida    : dataMisMutantes[i].saludMax,
        mir     : 'd',
        img     : mutanteS[i],
        ataque1 : [
            parseFloat(dataMisMutantes[i].at1dano),
            parseFloat(dataMisMutantes[i].at1energia),
            parseFloat(dataMisMutantes[i].at1alcance),
            parseFloat(dataMisMutantes[i].at1casillas)
        ],
        ataque1 : [2,3,1,1],
        ataque2 : [4,6,1,1]
    });
    misMutantes.push(pilaMutantes);
}

//crear un arreglo con todos los mutantes enemigos
var enemigos = [
    new mutante({
        id      : "4",
        cx      : 9,
        cy      : 0,
        crga    : 5,
        enrgia  : 10,
        vida    : 6,
        mir     : 'a',
        ataque1 : [2,3,1,1],
        ataque2 : [4,6,1,1],
        objet   : [-1,-1]
    }),
    new mutante({
        id      : "5",
        cx      : 7,
        cy      : 2,
        crga    : 5,
        enrgia  : 10,
        vida    : 6,
        mir     : 'a',
        ataque1 : [2,3,1,1],
        ataque2 : [4,6,1,1],
        objet   : [-1,-1]
    }),
    new mutante({
        id      : "6",
        cx      : 9,
        cy      : 4,
        crga    : 5,
        enrgia  : 10,
        vida    : 6,
        mir     : 'a',
        ataque1 : [2,3,1,1],
        ataque2 : [4,6,1,1],
        objet   : [-1,-1]
    }),
    new mutante({
        id      : "7",
        cx      : 9,
        cy      : 2,
        crga    : 5,
        enrgia  : 10,
        vida    : 6,
        mir     : 'a',
        ataque1 : [2,3,1,1],
        ataque2 : [4,6,1,1],
        objet   : [-1,-1]
    })
];

//mostrar todos los mutantes y sus interacciones
var mostrarMutantes = function(lista){
    lista.sort((b, a) => b.cy - a.cy);
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        //mutante.img = mutanteS[i];
        //console.log(mutanteS[i]);
        if (mutante.mir == 'd' && mutante.dccion == '') {
            if (tiempo < 50)    ctx.drawImage(mutante.img, 96*2,96*0,  96, 80, mutante.x, mutante.y, 96, 80);
            else                ctx.drawImage(mutante.img, 96*3,96*0,  96, 80, mutante.x, mutante.y, 96, 80);
        }
        else if (mutante.mir == 'a' && mutante.dccion == '') {
            if (tiempo < 50)    ctx.drawImage(mutante.img, 96*0,96*0,  96, 80, mutante.x, mutante.y, 96, 80);
            else                ctx.drawImage(mutante.img, 96*1,96*0,  96, 80, mutante.x, mutante.y, 96, 80);
        }
        if(mutante.vida < 1)  {
            var mutx = mutante.x, muty = mutante.y-50;
            if (mostrarRetiro <= 100) mostrarRetiro++;
            if      (mostrarRetiro < 25)   ctx.drawImage(retirar, 96*0,0,  96, 80, mutx, muty, 96, 80);
            else if (mostrarRetiro < 50)   ctx.drawImage(retirar, 96*1,0,  96, 80, mutx, muty, 96, 80);
            else if (mostrarRetiro < 75)   ctx.drawImage(retirar, 96*2,0,  96, 80, mutx, muty, 96, 80);
            else if (mostrarRetiro < 100)  ctx.drawImage(retirar, 96*3,0,  96, 80, mutx, muty, 96, 80);
            else if (mostrarRetiro == 100) {
                mostrarRetiro = 0;
                matarEnemigo(mutante.id);
                matarMutante(mutante.id);
            }
        }
        if (mutante.enrgia > 0) {
            if(mutante.dccion === 'a'){
                if (mutante.cx > 0) {
                    if      (tiempo < 16)   ctx.drawImage(mutante.img, 96*1,96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 32)   ctx.drawImage(mutante.img, 96*2,96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 48)   ctx.drawImage(mutante.img, 96*3,96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 64)   ctx.drawImage(mutante.img, 96*4,96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 80)   ctx.drawImage(mutante.img, 96*5,96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 92)   ctx.drawImage(mutante.img, 96*6,96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    else                    ctx.drawImage(mutante.img, 96*7,96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    mutante.mir = 'a';
                    mutante.x -= 3;
                    if (mutante.x <= pisoX[mutante.cx - 1]) {
                        mutante.dccion = '';
                        mutante.cx--;
                        mutante.enrgia--;
                    }
                }
                else mutante.dccion = '';
            }
            else if (mutante.dccion === 'd'){
                if (mutante.cx < 9) {
                    if      (tiempo < 16)   ctx.drawImage(mutante.img, 96*1,96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 32)   ctx.drawImage(mutante.img, 96*2,96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 48)   ctx.drawImage(mutante.img, 96*3,96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 64)   ctx.drawImage(mutante.img, 96*4,96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 80)   ctx.drawImage(mutante.img, 96*5,96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (tiempo < 92)   ctx.drawImage(mutante.img, 96*6,96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    else                    ctx.drawImage(mutante.img, 96*7,96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    mutante.mir = 'd';
                    mutante.x += 3;
                    if (mutante.x >= pisoX[mutante.cx + 1]){
                        mutante.dccion = '';
                        mutante.cx++;
                        mutante.enrgia--;
                    }
                }
                else mutante.dccion = '';
            }
            else if (mutante.dccion === 'w'){
                if (mutante.cy > 0) {
                    if      (mutante.mir == 'd') ctx.drawImage(mutante.img, 96*4,96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (mutante.mir == 'a') ctx.drawImage(mutante.img, 96*4,96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    mutante.y -= 3;
                    if (mutante.y <= pisoY[mutante.cy - 1]){
                        mutante.dccion = '';
                        mutante.cy--;
                        mutante.enrgia--;
                    }
                }
                else mutante.dccion = '';
            }
            else if (mutante.dccion === 's') {
                if (mutante.cy < 4) {
                    if      (mutante.mir == 'd') ctx.drawImage(mutante.img, 96*4, 96*1,  96, 80, mutante.x, mutante.y, 96, 80);
                    else if (mutante.mir == 'a') ctx.drawImage(mutante.img, 96*4, 96*2,  96, 80, mutante.x, mutante.y, 96, 80);
                    mutante.y += 3;
                    if (mutante.y > pisoY[mutante.cy + 1]){
                        mutante.dccion = '';
                        mutante.cy ++;
                        mutante.enrgia --;
                    }
                }
                else mutante.dccion = '';
            }
        }
        //mutante reciviendo daño
        if (mutante.dccion === 'g'){
            if (mostrarDano <= 100) mostrarDano++;
            if (mutante.mir == 'a') {
                if      (mostrarDano < 25)   ctx.drawImage(mutante.img, 96*1,96*5,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarDano < 50)   ctx.drawImage(mutante.img, 96*2,96*5,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarDano < 75)   ctx.drawImage(mutante.img, 96*3,96*5,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarDano < 100)  ctx.drawImage(mutante.img, 96*4,96*5,  96, 80, mutante.x, mutante.y, 96, 80);
            }
            else if (mutante.mir == 'd') {
                if      (mostrarDano < 25)   ctx.drawImage(mutante.img, 96*1,96*3,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarDano < 50)   ctx.drawImage(mutante.img, 96*2,96*3,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarDano < 75)   ctx.drawImage(mutante.img, 96*3,96*3,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarDano < 100)  ctx.drawImage(mutante.img, 96*4,96*3,  96, 80, mutante.x, mutante.y, 96, 80);
            }

            if      (mostrarDano < 33) ctx.drawImage(impacto, 0, 0, 40, 28,   mutante.x, mutante.y,   40, 28);
            else if (mostrarDano < 66) ctx.drawImage(impacto, 40, 0, 40, 28,   mutante.x-10, mutante.y-10,   40, 28);
            else if (mostrarDano < 99) ctx.drawImage(impacto, 80, 0, 40, 28,   mutante.x-20, mutante.y-20,   40, 28);
            else if (mostrarDano == 100) {
                mostrarDano = 0;
                mutante.dccion = '';
            }
        }
        //mutante atacando
        else if (mutante.dccion === 't') {
            if (mostrarAtaque <= 100) mostrarAtaque++;
            if (mutante.mir == 'a') {
                if      (mostrarAtaque < 25)   ctx.drawImage(mutante.img, 96*1,96*6,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarAtaque < 50)   ctx.drawImage(mutante.img, 96*2,96*6,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarAtaque < 75)   ctx.drawImage(mutante.img, 96*3,96*6,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarAtaque < 100)  ctx.drawImage(mutante.img, 96*4,96*6,  96, 80, mutante.x, mutante.y, 96, 80);
            }
            else if (mutante.mir == 'd') {
                if      (mostrarAtaque < 25)   ctx.drawImage(mutante.img, 96*1,96*4,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarAtaque < 50)   ctx.drawImage(mutante.img, 96*2,96*4,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarAtaque < 75)   ctx.drawImage(mutante.img, 96*3,96*4,  96, 80, mutante.x, mutante.y, 96, 80);
                else if (mostrarAtaque < 100)  ctx.drawImage(mutante.img, 96*4,96*4,  96, 80, mutante.x, mutante.y, 96, 80);
            }
            if (mostrarAtaque == 100) {
                mostrarAtaque = 0;
                mutante.dccion = '';
            }
        }
    }
}

//inteligencia artificial para controlar los mutantes enemigos
var enemigoIA = function(lista, atacar){
    var mutante;
    if (turno == 1){
        for (var i = 0; i < lista.length; i++) {
            mutante = lista[i];
            if (mutante.id == mutantesTurnoCont) {
                if (mutante.cy == mutante.objet[1]) {
                    if (mutante.cx-1 == mutante.objet[0]) {
                        if (mutante.mir == 'a') {
                            mutante.dccion = '';
                            console.log(mutante.id + ' - energia : ' + mutante.enrgia + ':: turno : ' +mutantesTurnoCont + ' llego');
                            mutantesTurnoCont++;

                            if (mutante.enrgia >= mutante.ataque1[1]) { //hacer el ataque aqui
                                for (var i = 0; i < atacar.length; i++) {
                                    objetivoMisMutantes = atacar[i];

                                    if (mutante.objet[1] == objetivoMisMutantes.cy && mutante.objet[0] == objetivoMisMutantes.cx) {
                                        if (mutante.mir == 'a') {
                                            ataqueMutante(mutante, objetivoMisMutantes, 1);
                                            ataqueMutante(mutante, objetivoMisMutantes, 1);
                                            ataqueMutante(mutante, objetivoMisMutantes, 1);
                                            //console.log('ataqueee a : '+ objetivoMisMutantes.vida);
                                        }
                                    }
                                }
                            }
                        }
                        else if (mutante.mir == 'd') mutante.dccion = 'd';
                    }
                    else if (mutante.cx+1 == mutante.objet[0]) {
                        if (mutante.mir == 'd') {
                            mutante.dccion = '';
                            console.log(mutante.id + ' - energia : ' + mutante.enrgia + ':: turno : ' +mutantesTurnoCont + ' llego');
                            mutantesTurnoCont++;

                            if (mutante.enrgia >= mutante.ataque1[1]) { //hacer el ataque aqui
                                for (var i = 0; i < atacar.length; i++) {
                                    objetivoMisMutantes = atacar[i];

                                    if (mutante.objet[1] == objetivoMisMutantes.cy && mutante.objet[0] == objetivoMisMutantes.cx) {
                                        if (mutante.mir == 'd') {
                                            ataqueMutante(mutante, objetivoMisMutantes, 1);
                                            ataqueMutante(mutante, objetivoMisMutantes, 1);
                                            ataqueMutante(mutante, objetivoMisMutantes, 1);
                                            console.log('ataqueee a : '+ objetivoMisMutantes.vida);
                                        }
                                    }
                                }
                            }
                        }
                        else if (mutante.mir == 'a' && mutante.cx != 0) mutante.dccion = 'a';
                    }
                    else if (mutante.cx == mutante.objet[0]) {
                        mutante.dccion = 'a';
                    }
                    else {
                        if (mutante.enrgia == 0){
                            mutante.dccion = '';
                            console.log(mutante.id + ' - energia : ' + mutante.enrgia + ':: turno : ' +mutantesTurnoCont + ' sin energia');
                            mutantesTurnoCont++;
                        }
                        else {
                            if      (mutante.objet[0] < mutante.cx-1) mutante.dccion = 'a';
                            else if (mutante.objet[0] > mutante.cx+1) mutante.dccion = 'd';
                        }
                    }
                }
                else {
                    if      (mutante.objet[1] < mutante.cy) mutante.dccion = 'w';
                    else if (mutante.objet[1] > mutante.cy) mutante.dccion = 's';
                }
            }
            if (mutantesTurnoCont-4 >= lista.length) {turno = -1;}
        }
    }
    else if(turno == -1){
        for (var i = 0; i < lista.length; i++) {
            mutante = lista[i];
            mutante.enrgia += mutante.crga;
        }
        turno = 0;
    }
}

//otorgar un obejetivo a los mutantes enemigos
function localizarEnemigo(lista, atacar){
    var mutante;
    //var objetivo = [];
    lista.sort((b, a) => b.id - a.id);
    for (var i = 0; i < lista.length; i++) {
        mutante = atacar[Math.floor(Math.random() * atacar.length)];
        var objetivo = mutante;
        mutante = lista[i];
        mutante.objet[0] = objetivo.cx;
        mutante.objet[1] = objetivo.cy;
        console.log(mutante.id + ' objet :  ( '+ objetivo.cx+' , '+ objetivo.cy+' )');
    }
    return objetivo;
}

//elimina a un enemigo de la lista de enemigos por la id
function matarEnemigo(id) {
    enemigos = enemigos.filter(function(enemigo) {
        return enemigo.id !== id;
    });
    for (var i = 0; i < enemigos.length; i++) {
        enemigos[i].id = ''+(i+4);

    }
}

//elimina a un mutante de la lista de enemigos por la id
function matarMutante(id) {
    misMutantes = misMutantes.filter(function(miMutante) {
        return miMutante.id !== id;
    });
}

//agrega un escenario de fondo dentro del area
function dibujarFondo(){
    if (enemigos[0] == null) {
        ctx.drawImage(escenarioG, 0, 0);
        ganar();
    }
    else if (misMutantes[0] == null)  ctx.drawImage(escenarioP, 0, 0);
    else ctx.drawImage(escenario, 0, 0); // Dibuja la imagen en la posición (0, 0) del canvas
}

//agrega monedas al usuario cuando gana un combate
function ganar(){
    const datoEnInterfaz = document.getElementById('datoEnInterfaz');
    datoEnInterfaz.textContent = 'ganaste';

    var formData = $('#miFormulario').serialize();

    // Realizar una solicitud POST al servidor
    /*
    $.ajax({
        type: 'POST',
        url: $('#miFormulario').attr('action'),
        data: formData,
        success: function(response) {
            // Manejar la respuesta del servidor
            console.log('Respuesta del servidor:', response);
            // Puedes realizar acciones adicionales en función de la respuesta
        },
        error: function(error) {
            // Manejar errores en la solicitud
            console.error('Error al enviar el formulario:', error);
        }
    });*/
}

//crea el arreglo en x para conrtolar los espacios
function crearPisoX(){
    var pisoX = [];
    var aux = 50;
    for (var i = 0; i < 10; i++) {
        pisoX[i] = aux;
        aux += 80;
    }
    return pisoX;
}

//crea el arreglo en y para conrtolar los espacios
function crearPisoY(){
    var pisoY = [];
    var aux = 200;
    for (var i = 0; i < 5; i++) {
        pisoY[i] = aux;
        aux += 25;
    }
    return pisoY;
}

//hacer que un mutante ataque a otro
function ataqueMutante(mutante, objetivo, numAtaque){
    if (objetivo != null) {
        var ataque = [];

        if      (numAtaque == 1) ataque = mutante.ataque1;
        else if (numAtaque == 2) ataque = mutante.ataque2;
        else if (numAtaque == 3) ataque = mutante.ataque3;
        else if (numAtaque == 4) ataque = mutante.ataque4;

        if (mutante.enrgia >= ataque[1]) {
            mutante.dccion = 't';
            mutante.enrgia -= ataque[1];
            if(objetivo.cy == mutante.cy){
                if (mutante.mir == 'd' && objetivo.cx >= mutante.cx+ataque[2]){
                    objetivo.vida -= ataque[0];
                    objetivo.dccion = 'g';
                }
                else if (mutante.mir == 'a' && objetivo.cx <= mutante.cx-ataque[2]){
                    objetivo.vida -= ataque[0];
                    objetivo.dccion = 'g';
                }
            }
        }
    }
}

//eventos de boton
//eventos de boton para mover al mutante hacia la derecha
btnDerecha.addEventListener('mouseup', function(){ //evento de boton derecha
    var lista = misMutantes;
    selectMutante[0] = 80;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if (mutante.id == idCntrl) {
            if (mutante.enrgia > 0) mutante.dccion = 'd';
            if (mutante.enrgia > 0 && mutante.cx != 9) energia.textContent = mutante.enrgia-1;
            else energia.textContent = mutante.enrgia;
        }
    }
});
//eventos de boton para mover al mutante hacia la izquierda
btnIzquierda.addEventListener('mouseup', function(){ //evento de boton izquierda
    var lista = misMutantes;
    selectMutante[0] = 80;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if (mutante.id == idCntrl) {
            if (mutante.enrgia > 0) mutante.dccion = 'a';
            if (mutante.enrgia > 0 && mutante.cx != 0) energia.textContent = mutante.enrgia-1;
            else energia.textContent = mutante.enrgia;
        }
    }
});
//eventos de boton para mover al mutante hacia arriba
btnArriba.addEventListener('mouseup', function(){ //evento de boton arriba
    var lista = misMutantes;
    selectMutante[0] = 80;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if (mutante.id == idCntrl) {
            if (mutante.enrgia > 0) mutante.dccion = 'w';
            if (mutante.enrgia > 0 && mutante.cy != 0) energia.textContent = mutante.enrgia-1;
            else energia.textContent = mutante.enrgia;
        }
    }
});
//eventos de boton para mover al mutante hacia abajo
btnAbajo.addEventListener('mouseup', function(){ //evento de boton abajo
    var lista = misMutantes;
    selectMutante[0] = 80;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if (mutante.id == idCntrl) {
            if (mutante.enrgia > 0) mutante.dccion = 's';
            if (mutante.enrgia > 0 && mutante.cy != 4)  energia.textContent = mutante.enrgia-1;
            else energia.textContent = mutante.enrgia;
        }
    }
});

//eventos para controlar mis mutantes atravez de la id
//id 1
mut1.addEventListener('mouseup', function(){
    idCntrl = '1';
    var lista = misMutantes;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if(mutante.id == idCntrl) {
            energia.textContent = mutante.enrgia;
            vida.textContent = mutante.vida;
            selectMutante = [0, mutante.x, mutante.y];
        }
    }
    mut1.classList.add('active');
    mut2.classList.remove('active');
    mut3.classList.remove('active');
    mut4.classList.remove('active');
});
//id 2
mut2.addEventListener('mouseup', function(){
    idCntrl = '2';
    var lista = misMutantes;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if(mutante.id == idCntrl) {
            energia.textContent = mutante.enrgia;
            vida.textContent = mutante.vida;
            selectMutante = [0, mutante.x, mutante.y];
        }
    }
    mut1.classList.remove('active');
    mut2.classList.add('active');
    mut3.classList.remove('active');
    mut4.classList.remove('active');
});
//id 3
mut3.addEventListener('mouseup', function(){
    idCntrl = '3';
    var lista = misMutantes;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if(mutante.id == idCntrl) {
            energia.textContent = mutante.enrgia;
            vida.textContent = mutante.vida;
            selectMutante = [0, mutante.x, mutante.y];
        }
    }
    mut1.classList.remove('active');
    mut2.classList.remove('active');
    mut3.classList.add('active');
    mut4.classList.remove('active');
});
//id 4
mut4.addEventListener('mouseup', function(){
    idCntrl = '4';
    var lista = misMutantes;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if(mutante.id == idCntrl) {
            energia.textContent = mutante.enrgia;
            vida.textContent = mutante.vida;
            selectMutante = [0, mutante.x, mutante.y];
        }
    }
    mut1.classList.remove('active');
    mut2.classList.remove('active');
    mut3.classList.remove('active');
    mut4.classList.add('active');
});

//evento para pasaar turno y recargar
btnRcargar.addEventListener('mouseup', function(){
    var lista = misMutantes;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        mutante.enrgia += mutante.crga;
        if(mutante.id == idCntrl) energia.textContent = mutante.enrgia;
    }
    localizarEnemigo(enemigos, misMutantes);
    turno = 1;
    mutantesTurnoCont = 4;
});

//eventos de atauqe
btnAtaque1.addEventListener('mouseup', function(){
    var lista = misMutantes;
    var ataque = [];
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if(mutante.id == idCntrl) {
            var mutanteSelec = mutante;
            ataque = mutante.ataque1;
        }
    }
    var lista = enemigos;
    for (var i = 0; i < lista.length; i++) {
        var mutante = lista[i];
        if(mutante.cx == mutanteSelec.cx+ataque[2] || mutante.cx == mutanteSelec.cx-ataque[2]) if(mutante.cy == mutanteSelec.cy) var objetivo = mutante;
    }
    ataqueMutante(mutanteSelec, objetivo, 1);
    energia.textContent = mutanteSelec.enrgia;
});
