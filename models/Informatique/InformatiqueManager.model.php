<?php
require_once  "./models/MainManager.model.php";
require_once "Info.class.php";


class InformatiqueManager extends MainManager{

   

    private $infos; // TABLEAU DE Hifi
    
    
    public function ajoutInfo($info)
    {
        $this->infos[] = $info;
    }


    public function getInfos()
    {
        return $this->infos;
    }



    public function chargementInfo()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM informatique");
        $req->execute();
        $mesInfos = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();


        foreach ($mesInfos as $info) {
            $infos = new Info($info['id'], $info['category'], $info['article'], $info['marque'], $info['price'], $info['image']);
            $this->ajoutInfo($infos);
        }
    }


    public function getInfoById($id)
    {
        for ($i = 0; $i < count($this->infos); $i++) {
            if ($this->infos[$i]->getId() === intval($id)) {
                return $this->infos[$i];
            }
        }
    }

    public function ajoutInfosBd( $article, $marque, $price, $image)
    {
        $req = "INSERT INTO informatique (category,article,marque,price,image)
                values (:category,:article, :marque, :price, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":category", "informatique", PDO::PARAM_STR);
        $stmt->bindValue(":article", $article, PDO::PARAM_STR);
        $stmt->bindValue(":marque", $marque, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $hifi = new Info($this->getBdd()->lastInsertId(), "informatique",$article, $marque, $price, $image);
            $this->ajoutInfo($hifi);
        }
    }

    public function  suppressionInfoBD($id)
    {

        $req = " Delete from informatique where id = :idInfo ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idInfo", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $info = $this->getInfoById($id);
            unset($info);
        }
    }

    public function modificationInfoBD($id, $article, $marque, $price, $image)
    {
        $req = 'update informatique
    SET article = :article, marque = :marque, price = :price, image = :image 
    WHERE id = :id';

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":article", $article, PDO::PARAM_STR);
        $stmt->bindValue(":marque", $marque, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0) {
            $this->getInfoById($id)->setArticle($article);
            $this->getInfoById($id)->setMarque($marque);
            $this->getInfoById($id)->setPrice($price);
            $this->getInfoById($id)->setImage($image);
           
        }
    }
}