<?php

$ganador1 = false;
$ganador2 = false;
$turno1 = true;
$empate = false;

//Inicializar Tablero
$tablero = [
    0 => [" ", " ", " "],
    1 => [" ", " ", " "],
    2 => [" ", " ", " "]
];

//Game
do {
    $datos = pedirDatos($tablero, $turno1);
    $fila = $datos[0];
    $columna = $datos[1];
    if ($turno1) {
        $tablero[$fila][$columna] = "O";
        $turno1 = false;
    } else {
        $tablero[$fila][$columna] = "X";
        $turno1 = true;
    }
    $ganador = comprobarGanador($tablero);
    $empate = comprobarEmpate($tablero);
} while ($ganador == false && $empate == false);

pintarTablero($tablero);

/**
 * Esta función pide sobre el $tablero una posición al usuario donde poner una ficha.
 * Comprueba que la opcion dada sea valida y no haya una ficha en su lugar.
 * 
 * 
 * $turno1 indica si mueve el primer o segundo jugador.
 * 
 * Devuelve un array con dos posiciones: 
 * - En la primera está el número de fila dado por el usuario.
 * - En la segunda está el número de columna dado por el usuario.
 * 
 * Las posiciones devueltas están preparadas para indexar el array $tablero.
 */
function pedirDatos($tablero, $turno1)
{
    do {
        pintarTablero($tablero);
        if($turno1){
            echo "Jugador 1: \n";
        } else {
            echo "Jugador 2: \n";
        }
        echo "Fila *espacio* Columna:\n";
        $correcto = true;
        fscanf(STDIN, "%d %d", $fila, $columna);
        if ($fila < 1 || $fila > 3 || $columna < 1 || $columna > 3 || $tablero[$fila-1][$columna-1] == "O" || $tablero[$fila-1][$columna-1] == "X"){
            $correcto = false;
            echo "Formato erroneo, repita\n";
        }
        $fila--;
        $columna--;
    } while ($correcto == false);

    return [$fila, $columna];
}

/**
 * Dibuja el tablero por pantalla en formato ASCII con los movimientos de 
 * los usuarios.
 */
function pintarTablero($tablero)
{
    echo <<<_END

         1     2     3
      +-----+-----+-----+
    1 |  {$tablero[0][0]}  |  {$tablero[0][1]}  |  {$tablero[0][2]}  |
      +-----+-----+-----+
    2 |  {$tablero[1][0]}  |  {$tablero[1][1]}  |  {$tablero[1][2]}  |
      +-----+-----+-----+
    3 |  {$tablero[2][0]}  |  {$tablero[2][1]}  |  {$tablero[2][2]}  |
      +-----+-----+-----+
    \n
    _END;
}


/**
 * Comprueba si alguno de los dos jugadores ha ganado.
 * 
 * Recibe $t, que es el tablero de la partida.
 * 
 * Devuelve true si uno de los dos jugadores ha ganado.
 */
function comprobarGanador($t)
{
    if(($t[0][0] == $t[0][1] && $t[0][1] == $t[0][2] && $t[0][2] == "X")
    || ($t[1][0] == $t[1][1] && $t[1][1] == $t[1][2] && $t[1][2] == "X")
    || ($t[2][0] == $t[2][1] && $t[2][1] == $t[2][2] && $t[2][2] == "X")
    || ($t[0][0] == $t[1][0] && $t[1][0] == $t[2][0] && $t[2][0] == "X")
    || ($t[0][1] == $t[1][1] && $t[1][1] == $t[2][1] && $t[2][1] == "X")
    || ($t[0][2] == $t[1][2] && $t[1][2] == $t[2][2] && $t[2][2] == "X")
    || ($t[0][0] == $t[1][1] && $t[1][1] == $t[2][2] && $t[2][2] == "X")
    || ($t[0][2] == $t[1][1] && $t[1][1] == $t[2][0] && $t[2][0] == "X")){
        echo "Gana Jugador 2!!!!\n";
        return true;
    } else if(($t[0][0] == $t[0][1] && $t[0][1] == $t[0][2] && $t[0][2] == "O")
    || ($t[1][0] == $t[1][1] && $t[1][1] == $t[1][2] && $t[1][2] == "O")
    || ($t[2][0] == $t[2][1] && $t[2][1] == $t[2][2] && $t[2][2] == "O")
    || ($t[0][0] == $t[1][0] && $t[1][0] == $t[2][0] && $t[2][0] == "O")
    || ($t[0][1] == $t[1][1] && $t[1][1] == $t[2][1] && $t[2][1] == "O")
    || ($t[0][2] == $t[1][2] && $t[1][2] == $t[2][2] && $t[2][2] == "O")
    || ($t[0][0] == $t[1][1] && $t[1][1] == $t[2][2] && $t[2][2] == "O")
    || ($t[0][2] == $t[1][1] && $t[1][1] == $t[2][0] && $t[2][0] == "O")){
        echo "Gana Jugador 1!!!!\n";
        return true;
    }
    
}

function comprobarEmpate(array $t): bool
{
    foreach ($t as $fila) {
        if (count(array_filter($fila, fn($v) => $v == " ")) > 0) {
            return false;
        }
    }
    return true;
}

//ESTO ES UN GRAN CAMBIO PARA LA HUMANIDAD







