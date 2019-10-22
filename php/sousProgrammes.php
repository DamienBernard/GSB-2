,ol<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Reformulation du format de la date d'embauche (ex: 23-01-1991 -> 23-jan-1991)
function modulerDateEmbauche($date){
   $listeMois= ["jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec"];
   
   //Récupération de la partie concernant le jour
   $jour="";
   $jour.=$date[0];
   $jour.=$date[1];
   $jour.="-";
   
   //Récupération de la partie concernant le mois
   $mois="";
   $mois.=$date[3];
   $mois.=$date[4];
   
   //Récupération de la partie concernant l'année
   $annee="";
   $annee.="-";
   $annee.=$date[6];
   $annee.=$date[7];
   $annee.=$date[8];
   $annee.=$date[9];
   
   //Remplacement du mois en chiffre par le mois en lettre (ex: "01" remplacé par "jan")
   switch ($mois) {
       case '01':
            $nouvelleDate = $jour . $listeMois[0] . $annee;
            break;
        case '02':
            $nouvelleDate = $jour . $listeMois[1] . $annee;
            break;
        case '03':
            $nouvelleDate = $jour . $listeMois[2] . $annee;
            break;
        case '04':
            $nouvelleDate = $jour . $listeMois[3] . $annee;
            break;
        case '05':
            $nouvelleDate = $jour . $listeMois[4] . $annee;
            break;
        case '06':
            $nouvelleDate = $jour . $listeMois[5] . $annee;
            break;
        case '07':
            $nouvelleDate = $jour . $listeMois[6] . $annee;
            break;
        case '08':
            $nouvelleDate = $jour . $listeMois[7] . $annee;
            break;
        case '09':
            $nouvelleDate = $jour . $listeMois[8] . $annee;
            break;
        case '10':
            $nouvelleDate = $jour . $listeMois[9] . $annee;
            break;
        case '11':
            $nouvelleDate = $jour . $listeMois[10] . $annee;
            break;
        case '12':
            $nouvelleDate = $jour . $listeMois[11] . $annee;
            break;
    }

    return $nouvelleDate;
}