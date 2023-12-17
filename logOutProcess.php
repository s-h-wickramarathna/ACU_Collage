<?php
session_start();

if(isset($_SESSION["admin"])){
    $_SESSION["admin"]=null;
    session_destroy();

    echo("1");

}else if(isset($_SESSION["officer"])){
    $_SESSION["officer"]=null;
    session_destroy();

    echo("1");

}else if(isset($_SESSION["teacher"])){
    $_SESSION["teacher"]=null;
    session_destroy();

    echo("1");

}else if(isset($_SESSION["student"])){
    $_SESSION["student"]=null;
    session_destroy();

    echo("1");
}

?>