<?php

require_once  "./models/MainManager.model.php";
require_once  "./controllers/Livre/Livrecontroller.controller.php";
require_once "./models/Livre/Livre.class.php";
require_once  "./controllers/Hifi/Hificontroller.controller.php";
require_once "./models/Hifi/Hifi.class.php";
require_once  "./controllers/Informatique/Informatiquecontroller.controller.php";
require_once "./models/Informatique/Info.class.php";

class PanierManager extends  MainManager
{
    private $livres;
    private $hifis;
    private $infos;
    private $UserPanier;

    public function __construct()
    {
        $this->livres = new LivreController();
        $this->hifis = new HifiController();
        $this->infos = new InformatiqueController();

        if (isset($_SESSION['profil'])) {
            $this->UserPanier = $_SESSION['profil']['login'];
        }else{
            $this->UserPanier = 'visiteur';
        }
        $this->panier = array();
    }

    public function panier_data()
    {
        if (isset($_COOKIE[$this->UserPanier])) {
            $result = json_decode($_COOKIE[$this->UserPanier], true);
        } else {
            $result = null;
        }
        return $result;
    }

    public function delArticle($id,$category){
        $panier = json_decode($_COOKIE[$this->UserPanier], true);
        foreach ($panier as $key => $value) {
            if ($panier[$key]['Valeur_Id'] == $id && $panier[$key]['Valeur_Category'] == $category) {
                unset($panier[$key]);
                $chaine = json_encode($panier);
                setcookie($this->UserPanier, $chaine, time() + 365 * 24 * 3600, '/');
            }
        }
    }
    
    public function addArticle($id, $category,$title, $quantity)
    {
        if ($category == 'livre') {
            $article = $this->livres->addPanierLivre($id);
            $route = "livres";
        } elseif ($category == 'hifi') {
            $article = $this->hifis->addPanierHifi($id);
            $route = "MaterielsHifi";
        } elseif ($category == 'informatique') {
            $article = $this->infos->addPanierInfo($id);
            $route = "MaterielsInformatiques";
        }

        if ($quantity > 10) {
            $quantity = 10;
        }
        if (isset($_COOKIE[$this->UserPanier])) {
            $panier = json_decode($_COOKIE[$this->UserPanier], true);
        } else {
            $panier = array();
        }
         // si ce $livre existe déja dans le $panier
         $item_id_list = array_column($panier, 'Valeur_Id');
         if (in_array($id, $item_id_list)) {
             $item_title_list = array_column($panier,'Valeur_Title');
             foreach ($panier as $key => $valeur) {
                 if ($panier[$key]['Valeur_Id'] == $id && $panier[$key]['Valeur_Category'] == $category ) {
                     if (($panier[$key]['Valeur_Quantity']+$quantity) < 10) {
                         $panier[$key]['Valeur_Quantity'] = $panier[$key]['Valeur_Quantity'] + $quantity;
                     }else {
                         $panier[$key]['Valeur_Quantity'] = 10;
                         Toolbox::ajouterMessageAlerte("Le maximum est de 10 articles !!", Toolbox::COULEUR_ROUGE);
                     }
                 }
             }
             if (!in_array($title,$item_title_list)) {
                $valeur = array(
                    'Valeur_Id' => $article->getId(),
                    'Valeur_Category' => $article->getCategory(),
                    'Valeur_Title' => $article->getTitle(),
                    'Valeur_Image' => "{$route}/{$article->getImage()}",
                    'Valeur_Price' => $article->getPrice(),
                    'Valeur_Quantity' => $quantity
                );
                $panier[] = $valeur;
             }
         } else {
            $valeur = array(
                'Valeur_Id' => $article->getId(),
                'Valeur_Category' => $article->getCategory(),
                'Valeur_Title' => $article->getTitle(),
                'Valeur_Image' => "{$route}/{$article->getImage()}",
                'Valeur_Price' => $article->getPrice(),
                'Valeur_Quantity' => $quantity
            );
            $panier[] = $valeur;
        }
        $chaine = json_encode($panier);
        setcookie($this->UserPanier, $chaine, time() + 365 * 24 * 3600, '/');
    }

    public function achatPanier($total){
        if (isset($_COOKIE[$this->UserPanier])) {
            $panier = json_decode($_COOKIE[$this->UserPanier], true);
        } else {
            $panier = array();
        }

        $req="INSERT INTO `order`(`date_order`, `login`, `total_prix`) VALUES (now(),:login,:total_prix)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $this->UserPanier, PDO::PARAM_STR);
        $stmt->bindValue(":total_prix", $total, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();

        $req = "SELECT * FROM utilisateur WHERE login=:login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;

        foreach ($panier as $key => $valeur) {
            $req="INSERT INTO `detail_order`(`id_article`, `category`, `order_id`, `quantity_article`) VALUES (:id_article,:category, :order_id, :quantity_article)";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(":id_article", $panier[$key]['Valeur_Id'], PDO::PARAM_INT);
            $stmt->bindValue(":category", $panier[$key]['Valeur_Category'], PDO::PARAM_STR);
            $stmt->bindValue(":order_id", $total, PDO::PARAM_INT);
            $stmt->bindValue(":quantity_article", $panier[$key]['Valeur_Quantity'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        }
             

        setcookie($this->UserPanier,"",time() - (365 * 24 * 3600), '/');
    }
    
}