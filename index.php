<?php
// importation de l'espace de nom du filtre
use littlesumolabs\timeago\RelativeTimerFilter as relativeTimer;

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('/');
$twig = new Twig_Environment($loader, [
    'debug' => true
]);

// On initialise le filtre de Twig
$twig->addExtension(new relativeTimer());

$titre          = "Relative Timer Extention for Twig";
$description    = "Extensions for Twig, giving a date in a more understandable format (a minute ago, one hour ago, Yesterday, etc...)";


$date   = date("d M Y H:i:s");
$timer  = date('d M Y H:i:s', strtotime('-1 hour', strtotime('now')));
$timer2 = date("d M Y H:i:s", strtotime('+1 day', strtotime('now')));

echo $twig->render('index.twig', [
    'title'         => $titre,
    'description'   => $description,
    'date'          => $date,
    'timer'         => $timer,
    'timer2'        => $timer2
]);