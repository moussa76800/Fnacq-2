 <?php

require_once "./controllers/MainController.controller.php";
require_once "./models/Utilisateur/UtilisateurModel.model.php";
require_once "./functions/compteur.php";

class UtilisateurController extends MainController
{
    private $utilisateurManager;

    public function __construct()
    {

        $this->utilisateurManager = new UtilisateurManager();
    }

    // VALIDATION LOGIN
    public function validation_login($login, $password)
    {
        if ($this->utilisateurManager->isCombinaisonValide($login, $password)) {
            if  ($this->utilisateurManager->userBloque($login)) {
                Toolbox::ajouterMessageAlerte("Vous êtes un membre indésirable !! fouteur de merde", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "login");
            }else {
                if ($this->utilisateurManager->estCompteActive($login)) {
                    Toolbox::ajouterMessageAlerte("Bon retour sur le site " . $login . " !", Toolbox::COULEUR_VERTE);
                    $_SESSION['profil'] = ["login" => $login];
                    add_connection();
                    header("Location: " . URL . "compte/profil");
                } else {
                    $msg = "Le compte " . $login . " n'a pas été activé par mail !!";
                    $msg .= "<a href='renvoyerMailValidation/" . $login . "'>Renvoyez le mail de validation</a>";
                    Toolbox::ajouterMessageAlerte($msg, Toolbox::COULEUR_ROUGE);
                    header("Location: " . URL . "login");
                }
            }
        } else {
            Toolbox::ajouterMessageAlerte("Combinaison Login / Mot de passe non valide", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "login");
        }
        
    }
    // VALIDATION DE L'INSCRIPTION 
    public function validation_inscription($login, $password, $email, $nom, $prenom, $adresse, $code_postal, $date_de_naissance)
    {
        if ($this->utilisateurManager->verifLoginDisponible($login)) {
            $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
            $clef = rand(0, 9999);
            if ($this->utilisateurManager->InscriptionBD($login, $passwordCrypte, $email, "utilisateur", "profil/homme.jpg", $clef, $nom, $prenom, $adresse, $code_postal, $date_de_naissance)) {
                Toolbox::ajouterMessageAlerte("Le compte a bien été crée", Toolbox::COULEUR_VERTE);
                $this->sendMailValidation($login, $email, $clef);
                header("Location: " . URL . "login");
            } else {
                Toolbox::ajouterMessageAlerte("Une erreur est intervenue lors de la création du compte,veuillez recommencez l'inscription", Toolbox::COULEUR_ROUGE);
                header('location: ' . URL . "inscription");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Le login est déja utilisé !!", Toolbox::COULEUR_ROUGE);
            header('Location: ' . URL . "inscription");
        }
    }

    // ENVOIE DU MAIL DE VALIDATION 
    private function sendMailValidation($login, $mail, $clef)
    {
        $urlVerification = URL . "validationMail/" . $login . "/" . $clef;
        $sujet = "Création du compte sur le site xxx";
        $message = "Pour valider votre compte veuillez cliquer sur le lien suivant " . $urlVerification;
        Toolbox::sendMail($mail, $sujet, $message);
    }

    // RENVOYER MAIL DE VALIDATION 
    public function renvoyerMailValidation($login)
    {
        $utilisateur = $this->utilisateurManager->getUserInformation($login);
        $this->sendMailValidation($login, $utilisateur['mail'], $utilisateur['clef']);
        header("Location: " . URL . "login");
    }

    // VALIDATION DU MAIL 
    public function validation_mailCompte($login, $clef)
    {
        if ($this->utilisateurManager->bdValidationMailCompte($login, $clef)) {
            Toolbox::ajouterMessageAlerte("Le compte a été activé !", Toolbox::COULEUR_VERTE);
            $_SESSION['profil'] = [
                "login" => $login,
            ];
            header('Location: ' . URL . 'compte/profil');
        } else {
            Toolbox::ajouterMessageAlerte("Le compte n'a pas été activé !", Toolbox::COULEUR_ROUGE);
            header('Location: ' . URL . 'creerCompte');
        }
    }
    // VALIDATION DE LA MODIFICATION DU MAIL 
    public function validation_modificationMail($email,$login)
    {
        if ($this->utilisateurManager->bdModificationMailUser($login, $email)) {
            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        if (Securite::estAdministrateur()) {
            header("Location:".URL."administration/showProfilUser/".$login);
        } else {
            header("Location: " . URL . "compte/profil");
        }
    }

    // AFFICHAGE DU PROFIL DE L'UTILISATEUR 
    public function profil($login)
    {
        if (!isset($login)) {
            $datas = $this->utilisateurManager->getUserInformation($_SESSION['profil']['login']);
            $_SESSION['profil']['role'] = $datas['role'];
        } else {
            $datas = $this->utilisateurManager->getUserInformation($login);
        }
        
        if ($_SESSION['profil']['role'] == 'administrateur') {
            $data_page = [
                "page_description" => "Page du Profil",
                "page_title" => "Page du Profil",
                "utilisateur" => $datas,
                "page_javascript" => ["profil.js"],
                "view" => "views/Utilisateur/profil.view.php",
                "template" => "views/common.dashboard/templateDash.php"
            ];
        } else {
            $data_page = [
                "page_description" => "Page du Profil",
                "page_title" => "Page du Profil",
                "utilisateur" => $datas,
                "page_javascript" => ["profil.js"],
                "view" => "views/Utilisateur/profil.view.php",
                "template" => "views/common/template.php"
            ];
        }
        $this->genererPage($data_page);
    }

    // VALIDATION MODIFICATION DE L'IMAGE
    public function validation_modificationImage($file)
    {
        try {
            $repertoire = "public/Assets/images/profil/" . $_SESSION['profil']['login'] . "/";
            $nomImage = Toolbox::ajoutImage($file, $repertoire); //ajout image dans le répertoire
            //Supression de l'ancienne image
            $this->dossierSuprresionImageUtilisateur($_SESSION['profil']['login']);
            //Ajout de la nouvelle image dans la BD
            $nomImageBD = "profil/" . $_SESSION['profil']['login'] . "/" . $nomImage;
            if ($this->utilisateurManager->bdAjoutImage($_SESSION['profil']['login'], $nomImageBD)) {
                Toolbox::ajouterMessageAlerte("La modification de l'image est effectuée", Toolbox::COULEUR_VERTE);
            } else {
                Toolbox::ajouterMessageAlerte("La modification de l'image n'a pas été effectuée", Toolbox::COULEUR_ROUGE);
            }
        } catch (Exception $e) {
            Toolbox::ajouterMessageAlerte($e->getMessage(), Toolbox::COULEUR_ROUGE);
        }

        header("Location: " . URL . "compte/profil");
    }

    // SUPPRESION DE L'IMAGE DANS LE DOSSIER
    private function dossierSuprresionImageUtilisateur($login)
    {
        $ancienneImage = $this->utilisateurManager->getImageUtilisateur($_SESSION['profil']['login']);
        if ($ancienneImage !== "profil/profil.png") {
            unlink("public/Assets/images/" . $ancienneImage);
        }
    }

    // DECONNEXION DE L'UTILISATEUR
    public function deconnexion()
    {
        Toolbox::ajouterMessageAlerte("La déconnexion a été établie avec succès", Toolbox::COULEUR_VERTE);
        unset($_SESSION['profil']);
        header('Location: ' . URL . "accueil");
    }

    // MODIFICATION DU MOT DE PASSE 
    public function modifPassword($login)
    {
        if (!isset($login)) {
            $datas = $this->utilisateurManager->getUserInformation($_SESSION['profil']['login']);
            $_SESSION['profil']['role'] = $datas['role'];
        } else {
            $datas = $this->utilisateurManager->getUserInformation($login);
        }

        if ($_SESSION['profil']['role'] == 'administrateur') {
            $data_page = [
                "page_description" => "Page de modification du mot de passe",
                "page_title" => "Page de modification du mot de passe",
                "utilisateur" => $datas,
                "page_javascript" => ["modificationPassword.js"],
                "view" => "views/Utilisateur/modificationPassword.view.php",
                "template" => "views/common.dashboard/templateDash.php"
            ];
        } else {
            $data_page = [
                "page_description" => "Page de modification du mot de passe",
                "page_title" => "Page de modification du mot de passe",
                "utilisateur" => $datas,
                "page_javascript" => ["modificationPassword.js"],
                "view" => "views/Utilisateur/modificationPassword.view.php",
                "template" => "views/common/template.php"
            ];
        }
        $this->genererPage($data_page);
    }
    // VALIDATION DE LA MODIFICATION DU MOT DE PASSE 
    public function validation_modificationPassword($oldPassword, $newPassword, $confirmNewPassword,$login)
    {
        if ($newPassword === $confirmNewPassword) {
            if ($this->utilisateurManager->isCombinaisonValide($login, $oldPassword)) {
                $passwordCrypte = password_hash($newPassword, PASSWORD_DEFAULT);
                if ($this->utilisateurManager->modificationPasswordDB($login, $passwordCrypte)) {
                    Toolbox::ajouterMessageAlerte("La modification du mot de passe à été effectuée avec succes !!", Toolbox::COULEUR_VERTE);
                    if (Securite::estAdministrateur()) {
                        header("Location:".URL."administration/showProfilUser/".$login);
                    } else {
                        header("Location: " . URL . "compte/profil");
                    }
                } else {
                    Toolbox::ajouterMessageAlerte("La modification a échouée!!!", Toolbox::COULEUR_ROUGE);
                    header("Location: " . URL . "compte/modificationPassword/".$login);
                }
            } else {
                Toolbox::ajouterMessageAlerte("La combinaison login et du mot de passe d'origine ne correspondent pas  !!!", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "compte/modificationPassword/".$login);
            }
        } else {
            Toolbox::ajouterMessageAlerte("Les mots de passes ne correspondent pas !!!", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "compte/modificationPassword/".$login);
        }
    }

    // MODIFICATION DU CODE POSTAL 
    public function modifPostal($login)
    {
        if (!isset($login)) {
            $datas = $this->utilisateurManager->getUserInformation($_SESSION['profil']['login']);
            $_SESSION['profil']['role'] = $datas['role'];
        } else {
            $datas = $this->utilisateurManager->getUserInformation($login);
        }

        if ($_SESSION['profil']['role'] == 'administrateur') {
            $data_page = [
                "page_description" => "Page de modification du code postal",
                "page_title" => "Page de modification  du code postal",
                "utilisateur" => $datas,
                "page_javascript" => ["modificationPostal.js"],
                "view" => "views/Utilisateur/modificationPostal.view.php",
                "template" => "views/common.dashboard/templateDash.php"
            ];
        } else {
            $data_page = [
                "page_description" => "Page de modification du code postal",
                "page_title" => "Page de modification  du code postal",
                "utilisateur" => $datas,
                "page_javascript" => ["modificationPostal.js"],
                "view" => "views/Utilisateur/modificationPostal.view.php",
                "template" => "views/common/template.php"
            ];
        }
        $this->genererPage($data_page);

    }

    // VALIDATION MODIFICATION DU CODE POSTAL 
    public function validation_modificationPostal($oldPostal, $newPostal, $login)
    {
        
        if ($this->utilisateurManager->isCombinaisonPostalValide($login, $oldPostal)) {
            if ($this->utilisateurManager->bdmodifPostal($login, $newPostal)) {
                toolbox::ajouterMessageAlerte("La modification du code postal à été effectuée avec succes !!", Toolbox::COULEUR_VERTE);
                if (Securite::estAdministrateur()) {
                    header("Location:".URL."administration/showProfilUser/".$login);
                } else {
                    header("Location: " . URL . "compte/profil");
                }
            } else {

                toolbox::ajouterMessageAlerte("La modification du code postal n'a pas été effectuée !!", Toolbox::COULEUR_ROUGE);
                if (Securite::estAdministrateur()) {
                    header("Location:".URL."administration/showProfilUser/".$login);
                } else {
                    header("Location: " . URL . "compte/profil");
                }
            }
        } else {
            toolbox::ajouterMessageAlerte("L'ancien code postal ne correspond pas à celui indiqué dans le formulaire !!", Toolbox::COULEUR_ROUGE);
            if (Securite::estAdministrateur()) {
                header("Location:".URL."administration/showProfilUser/".$login);
            } else {
                header("Location: " . URL . "compte/profil");
            }
        }
    }

    // SUPPRESSION DU COMPTE DE L'UTILISATEUR
    public function validation_suppressionCompte($login)
    {

        $this->dossierSuprresionImageUtilisateur($login);
        rmdir("public/Assets/images/profil/" . $login);
        if ($this->utilisateurManager->validation_suppressionCompteDB($login)) {
            Toolbox::ajouterMessageAlerte("La suppression a été effectuée avec succes", Toolbox::COULEUR_VERTE);
            $this->deconnexion();
        } else {
            Toolbox::ajouterMessageAlerte("La suppression n'a pas aboutie,contactez l'administrateur", Toolbox::COULEUR_ROUGE);
            if (Securite::estAdministrateur()) {
                header("Location:".URL."administration/showProfilUser/".$login);
            } else {
                header("Location: " . URL . "compte/profil");
            }
        }
    }

    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}
