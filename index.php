<?php
// Moussa Boulhout
// Monir Boutiebi
// Youssef Chennou
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));

require_once "./controllers/Toolbox.class.php";
require_once "./controllers/Securite.class.php";
require_once("./controllers/Visiteur/VisiteurController.controller.php");
require_once("./controllers/Utilisateur/UtilisateurController.controller.php");
require_once("./controllers/Livre/LivreController.controller.php");
require_once("./controllers/Informatique/InformatiqueController.controller.php");
require_once("./controllers/Hifi/HifiController.controller.php");
require_once("./controllers/Tchat/TchatsControllers.controller.php");
require_once("./controllers/Blog/blogController.controller.php");
require_once("./controllers/Administrateur/AdministrateurController.controller.php");
require_once("./controllers/Blog/CommentController.controller.php");
require_once("./controllers/Panier/PanierController.controllers.php");



$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();
$livreController = new LivreController();
$informatiqueController = new InformatiqueController();
$hifiController = new HifiController();
$tchatController = new TchatsControllers();
$blogController = new BlogController();
$administrateurController = new AdministrateurController();
$commentController = new CommentController();
$panierController = new PanierController();

try {
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($page) {
        case "accueil":
            $visiteurController->accueil();
            break;

        case "materielsHifi":
            if (empty($url[1])) {
                $hifiController->afficherHifi();
            } else if ($url[1] === "display") {
                $hifiController->afficherUnHifi($url[2]);
            } else if ($url[1] === "buy") {
                if (isset($_POST['addPanier'])) {
                    $panierController->addArticle($_POST['id'], $_POST['category'], $_POST['title'], $_POST['quantity']);
                    $hifiController->buyHifi($url[2]);
                    /* header('Location: ' . URL . "livres"); */
                } else {
                     $hifiController->buyHifi($url[2]);
                }
            } else if ($url[1] === "display") {
                $hifiController->afficherUnHifi($url[2]);
            } else if ($url[1] ===  "modify") {
                $hifiController->modificationHifi($url[2]);
            } else if ($url[1] ===  "validationModif") {
                $hifiController->modifHifiValidation();
                Toolbox::ajouterMessageAlerte("Article modifier avec succes", Toolbox::COULEUR_VERTE);
            } else if ($url[1] ===  "add") {
                $hifiController->ajoutHifi();
            } else if ($url[1] ===  "validationAjout") {
                $hifiController->ajoutHifiValidation();
                Toolbox::ajouterMessageAlerte("Article ajouter avec succes", Toolbox::COULEUR_VERTE);
            } else if ($url[1] === "delete") {
                $hifiController->suppressionLivre($url[2]);
                Toolbox::ajouterMessageAlerte("Article supprimer avec succes", Toolbox::COULEUR_VERTE);
            } else {
                Toolbox::ajouterMessageAlerte("Vous ne pouvez pas accéder à ces options car vous n'êtes pas l'administrateur !!", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "accueil");
            }
            break;

        case "materielsInformatiques":
            if (empty($url[1])) {
                $informatiqueController->afficherInformatique();
            } else if ($url[1] === "display") {
                $informatiqueController->afficherUnInfo($url[2]);
            } else if ($url[1] ===  "modify") {
                $informatiqueController->modificationInfo($url[2]);
            } else if ($url[1] ===  "validationModif") {
                $informatiqueController->modifInfoValidation();
                Toolbox::ajouterMessageAlerte("Article modifier avec succes", Toolbox::COULEUR_VERTE);
            } else if ($url[1] ===  "add") {
                $informatiqueController->ajoutInfo();
            } else if ($url[1] ===  "validationAjout") {
                $informatiqueController->ajoutInfoValidation();
                Toolbox::ajouterMessageAlerte("Article ajouter avec succes", Toolbox::COULEUR_VERTE);
            } else if ($url[1] === "delete") {
                $informatiqueController->suppressionInfo($url[2]);
                Toolbox::ajouterMessageAlerte("Article supprimer avec succes", Toolbox::COULEUR_VERTE);
            } else if ($url[1] === "buy") {
                if (isset($_POST['addPanier'])) {
                    $panierController->addArticle($_POST['id'], $_POST['category'], $_POST['title'], $_POST['quantity']);
                    $informatiqueController->buyInfo($url[2]);
                } else {
                    $informatiqueController->buyInfo($url[2]);
                }
            } else {
                Toolbox::ajouterMessageAlerte("Vous ne pouvez pas accéder à ces options car vous n'êtes pas l'administrateur !!", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "accueil");
            }
            break;

        case "livres":
            if (empty($url[1])) {
                $livreController->afficherLivres();
            } else if ($url[1] === "display") {
                $livreController->afficherUnLivre($url[2]);
            } else if ($url[1] ===  "modify") {
                $livreController->modificationLivre($url[2]);
            } else if ($url[1] ===  "validationModif") {
                $livreController->modifLivreValidation();
                Toolbox::ajouterMessageAlerte("Article modifier avec succes", Toolbox::COULEUR_VERTE);
            } else if ($url[1] ===  "add") {
                $livreController->ajoutLivre();
            } else if ($url[1] ===  "validationAjout") {
                $livreController->ajoutLivreValidation();
                Toolbox::ajouterMessageAlerte("Article ajouter avec succes", Toolbox::COULEUR_VERTE);
            } else if ($url[1] === "delete") {
                $livreController->suppressionLivre($url[2]);
                Toolbox::ajouterMessageAlerte("Article supprimer avec succes", Toolbox::COULEUR_VERTE);
            } else if ($url[1] === "buy") {
                if (isset($_POST['addPanier'])) {
                    $panierController->addArticle($_POST['id'], $_POST['category'], $_POST['title'], $_POST['quantity']);
                    $livreController->buyLivre($url[2]);
                    /* header('Location: ' . URL . "livres"); */
                } else {
                    $livreController->buyLivre($url[2]);
                }
            } else {
                Toolbox::ajouterMessageAlerte("Vous ne pouvez pas accéder à ces options car vous n'êtes pas l'administrateur !!", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "accueil");
            }
            break;

        case "panier":

            if (empty($url[1])) {
                $panierController->afficherPanier();
            } else if ($url[1] === "del") {
                $panierController->delArticle($url[2], $url[3]);
                Toolbox::ajouterMessageAlerte("L'article a bien été supprimé !!", Toolbox::COULEUR_VERTE);
                header('Location: ' . URL . "panier");
            } else if ($url[1] === "achat") {
                if (!Securite::estConnecte()) {
                    Toolbox::ajouterMessageAlerte("Veuillez vous s'authentifier ou vous inscrire  !!", Toolbox::COULEUR_ROUGE);
                    header('Location: ' . URL . "login");
                } else {
                    $panierController->achatPanier($url[2]);
                    Toolbox::ajouterMessageAlerte("Merci pour vos achat à bientôt !!", Toolbox::COULEUR_VERTE);
                    header('Location: ' . URL . "panier");
                }
                
            }

            break;

        case "login":
            $visiteurController->login();
            break;

        case "validation_login":
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = Securite::secureHTML($_POST['login']);
                $password = Securite::secureHTML($_POST['password']);
                $utilisateurController->validation_login($login, $password);
            } else {
                Toolbox::ajouterMessageAlerte("Login ou mot de passe non renseigné", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "login");
            }
            break;

        case "inscription":
            $visiteurController->inscription();
            break;

        case "validation_inscription":
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['code_postal']) && !empty($_POST['date_de_naissance'])) {
                $login = Securite::secureHTML($_POST['login']);
                $password = Securite::secureHTML($_POST['password']);
                $email = Securite::secureHTML($_POST['email']);
                $nom = Securite::secureHTML($_POST['nom']);
                $prenom = Securite::secureHTML($_POST['prenom']);
                $adresse = Securite::secureHTML($_POST['adresse']);
                $code_postal = Securite::secureHTML($_POST['code_postal']);
                $date_de_naissance = Securite::secureHTML($_POST['date_de_naissance']);
                $utilisateurController->validation_inscription($login, $password, $email, $nom, $prenom, $adresse, $code_postal, $date_de_naissance);
            } else {
                Toolbox::ajouterMessageAlerte("Veuillez insérer toutes les informations recquises !!", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "inscription");
            }
            break;

        case "renvoyerMailValidation":
            $utilisateurController->renvoyerMailValidation($url[1]);
            break;

        case "validationMail":
            $utilisateurController->validation_mailCompte($url[1], $url[2]);
            break;

        case "tchat":
            if (isset($_POST['submit'])) {
                if (!Securite::estConnecte()) {
                    Toolbox::ajouterMessageAlerte("Veuillez-vous connecter ou vous inscrire pour intéragir dans le chat !!!", Toolbox::COULEUR_ROUGE);
                    $tchatController->afficherTchat();
                } else {
                    $tchatController->ajoutTchat($_SESSION['profil']['login'], $_POST['message']);
                    Toolbox::ajouterMessageAlerte("votre message est enregistré.", Toolbox::COULEUR_VERTE);
                    $tchatController->afficherTchat();
                }
            } else {
                $tchatController->afficherTchat();
            }
            break;

        case "blog":
            if (empty($url[1])) {
                if (isset($_POST['findPost'])) {
                    $blogController->findTitle($_POST['findPost']);
                } else {
                    $blogController->afficherBlog();
                }
            } else if ($url[1] === "afficherUnPost") {
                $blogController->afficherUnPost($url[2]);
            } else if ($url[1] === "validationAjoutComment") {
                if (Securite::estConnecte()) {
                    if (!empty($_POST['comment'])) {
                        $comment = Securite::secureHTML($_POST['comment']);
                        $commentController->ajoutCommentValidation($_SESSION['profil']['login'], $comment, $_POST['idPost']);
                        Toolbox::ajouterMessageAlerte("Votre message est enregistré.", Toolbox::COULEUR_VERTE);
                        $commentController->afficherComment($id);
                        header("Location: " . URL . "blog/afficherUnPost/" . $_POST['idPost']);
                    } else {
                        Toolbox::ajouterMessageAlerte("Votre message n'est pas enregistré.", Toolbox::COULEUR_ROUGE);
                        header("Location: " . URL . "blog/afficherUnPost/" . $_POST['idPost']);
                    }
                } else {
                    Toolbox::ajouterMessageAlerte("Veuillez vous connectez ou vous inscrire pour intéragir dans le blog!! ", Toolbox::COULEUR_ROUGE);
                    header('Location: ' . URL . "accueil");
                }
            } else if (!Securite::estUtilisateur() && Securite::estAdministrateur()) {
                if ($url[1] === "modify") {
                    $blogController->modificationPost($url[2]);
                }
                if ($url[1] === "validationModif") {
                    $blogController->modifPostValidation();
                }
                if ($url[1] === "add") {
                    $blogController->ajoutPost();
                }
                if ($url[1] === "validationAjout") {
                    $blogController->ajoutPostValidation();
                    Toolbox::ajouterMessageAlerte("L'article à bien été ajouté !!", Toolbox::COULEUR_VERTE);
                }
                if ($url[1] === "delete") {
                    $blogController->suppressionPost($url[2]);
                    Toolbox::ajouterMessageAlerte("L'article à bien été supprimer !!", Toolbox::COULEUR_VERTE);
                }
            } else {
                Toolbox::ajouterMessageAlerte("Vous ne pouvez pas accéder à ces options car vous n'êtes pas l'administrateur !!", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "accueil");
            }
            break;

        case "compte":
            if (!Securite::estConnecte()) {
                Toolbox::ajouterMessageAlerte("Veuillez vous connecter !!", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "login");
            } else {
                switch ($url[1]) {
                    case "profil":
                        $id_order=(isset($url[2]))? $url[2] : null;
                        $utilisateurController->profil(null, $id_order);
                        break;

                    case "deconnection":
                        $utilisateurController->deconnexion();
                        break;

                    case "modificationPostal":
                        $utilisateurController->modifPostal($url[2]);

                        break;
                    case "validation_modificationCodePostal":
                        if (!empty($_POST['oldPostal']) && !empty($_POST['newPostal'])) {
                            $oldPostal = Securite::secureHTML($_POST['oldPostal']);
                            $newPostal = Securite::secureHTML($_POST['newPostal']);
                            $utilisateurController->validation_modificationPostal($oldPostal, $newPostal,$url[2]);
                        }
                        break;

                    case "validation_modificationMail":
                        $utilisateurController->validation_modificationMail(Securite::secureHTML($_POST['email']),$url[2]);
                        break;

                    case "modificationPassword":
                        $utilisateurController->modifPassword($url[2]);
                        break;

                    case "validation_modificationPassword":
                        if (!empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['confirmNewPassword'])) {
                            $oldPassword = Securite::secureHTML($_POST['oldPassword']);
                            $newPassword = Securite::secureHTML($_POST['newPassword']);
                            $confirmNewPassword = Securite::secureHTML($_POST['confirmNewPassword']);
                            $utilisateurController->validation_modificationPassword($oldPassword, $newPassword, $confirmNewPassword,$url[2]);
                        } else {
                            Toolbox::ajouterMessageAlerte("vous n'avez pas renseigné toutes les informations necessaires pour la modification du mot de passe !!!", Toolbox::COULEUR_ROUGE);
                            header("Location: " . URL . "compte/modificationPassword");
                        }
                        break;

                    case "validation_modificationImage":
                        if ($_FILES['image']['size'] > 0) {
                            $utilisateurController->validation_modificationImage($_FILES['image']);
                        } else {
                            Toolbox::ajouterMessageAlerte("Vous n'avez pas modifié l'image", Toolbox::COULEUR_ROUGE);
                            header("Location: " . URL . "compte/profil");
                        }
                        break;

                    case "validation_suppressionCompte":
                        $utilisateurController->validation_suppressionCompte($url[2]);
                        break;

                    default:
                        throw new Exception("Veuillez transmettre la bonne rubrique !!");
                }
            }
            break;

        case "administration":
            if (!Securite::estConnecte()) {
                Toolbox::ajouterMessageAlerte("Veuillez vous connecter !", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "Login");
            } else if (!Securite::estAdministrateur()) {
                Toolbox::ajouterMessageAlerte("Accès inaccessible pour les utilisateurs !!!", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "accueil");
            } else {
                switch ($url[1]) {
                    case "accueilDash":
                        $administrateurController->accueilDash();
                        break;
                    case "droits":
                        $administrateurController->droits();
                        break;
                    case "validation_modificationRole":
                        $administrateurController->validation_modificationRole($_POST['login'], $_POST['role']);
                        break;
                    case "showProfilUser":
                        $id_order=(isset($url[3]))? $url[3] : null;
                        $utilisateurController->profil($url[2],$id_order);
                        /* $administrateurController->showProfilUser($url[2]);
                        header("Location: " . URL . "showProfilUser.view.php"); */
                        break;
                    case "showCommentUser":
                        $administrateurController->showCommentUser($url[2]);
                        header("Location: " . URL . "showCommentUser.view.php");
                        break;
                    case "showConnectionUser":
                        $administrateurController->showConnexionUser($url[2]);
                        header("Location: " . URL . "showConnexionUser.view.php");
                        break;
                        /*  case "modify":
                        $administrateurController->modificationLivre($url[2]);
                        break;
                    case "validationModif":
                        $administrateurController->modifLivreValidation();
                        break;
                    case "add":
                        $administrateurController->ajoutLivre();
                        break;
                    case "validationAjout":
                        $administrateurController->ajoutLivreValidation();
                        break;
                    case "delete":
                        $administrateurController->suppressionLivre($url[2]);
                        break; */
                        /*  case "modify":
                        $blogController->modificationPost($url[2]);
                        break;
                    case "validationModif":
                        $blogController->modifPostValidation();
                        break;
                    case "add":
                        $blogController->modificationPost($url[2]);
                        break;
                    case "validationAjout":
                        $blogController->ajoutPostValidation();
                        Toolbox::ajouterMessageAlerte("L'article à bien été ajouté !!", Toolbox::COULEUR_VERTE);
                        break;
                    case "delete":
                        $blogController->suppressionPost($url[2]);
                        Toolbox::ajouterMessageAlerte("L'article à bien été supprimer !!", Toolbox::COULEUR_VERTE);
                        break; */

                    default:
                        throw new Exception("La page n'existe pas");
                }
            }
            break;
        default:
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $visiteurController->pageErreur($e->getMessage());
}
