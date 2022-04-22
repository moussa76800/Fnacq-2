<?php

function add_connection(){
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . $_SESSION['profil']['login'];
    $fichier_journalier=$fichier.'-'. date('y-m-d');
    incrementer_compteur($fichier_journalier);
}

function incrementer_compteur($fichier){
    $compteur = 1;
    if (file_exists($fichier)) {
        $compteur = (int)file_get_contents($fichier);
        $compteur++;
    }
    file_put_contents($fichier,$compteur);
} 

function nb_vues($login) {
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . $login.'-'. date('y-m-d');
    if (file_exists($fichier)) {
        return file_get_contents($fichier);
    }else {
        return 0;
    }
    
}

function nb_vues_sept($login){
    $total=0;
    for ($i=0; $i < 7 ; $i++) {
        $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . $login.'-'. date('y-m-d',strtotime("-{$i} days"));
        if (file_exists($fichier)) {
            $total = $total + file_get_contents($fichier);
        }
    }
    return $total;
}