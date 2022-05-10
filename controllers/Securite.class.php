<?php


class Securite
{

    public static function secureHTML($chaine)
    {
        return htmlentities($chaine);
    }



    public static function estConnecte()
    {
        if (isset($_SESSION['profil'])) {
            return (!empty($_SESSION['profil']));
        } else {
            return null;
        }
    }



    public static function estUtilisateur()
    {
        if (isset($_SESSION['profil'])) {
            return (!empty($_SESSION['profil']['role']==="utilisateur"));
        } else {
            return null;
        }
    }

    public static function estAdministrateur()
    {
        if (isset($_SESSION['profil'])) {
            return (!empty($_SESSION['profil']['role']==="administrateur"));
        } else {
            return null;
        }
    }

    public static function utilisateurIndesirable()
    {
        return ($_SESSION['profil']['role']==="utilisateur_Indesirable");
        
    }

}
