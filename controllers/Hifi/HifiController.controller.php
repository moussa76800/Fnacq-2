<?php

require_once "./controllers/MainController.controller.php";
require_once "./models/Hifi/HifiManager.model.php";


class HifiController extends MainController
{

    private $hifiManager;


    public function __construct()
    {
        $this->hifiManager = new HifiManager();
        $this->hifiManager ->chargementHifi();
    }
    
    public function afficherHifi()
    {
        $hifi = $this->hifiManager->getHifi();
        if (Securite::estUtilisateur() || !Securite::estConnecte()) {
        $data_page = [
            "page_description" => "La page du materiels hifi",
            "page_title" => "La page du materiels hifi",
            "hifi"=>$hifi,
            "view" => "views/Materiel-Hifi/hifi.view.php",
            "template" => "views/common/template.php"
        ];
        
    } else {
        $data_page = [
            "page_description" => "La liste des livres",
            "page_title" => "La liste des livres",
            "hifi"=>$hifi,
            "view" => "views/Materiel-Hifi/hifi.view.php",
            "template" => "views/common.dashboard/templateDash.php"
        ];
    }
    $this->genererPage($data_page);
}

   

    public function afficherUnHifi($id)
    {
        $hifi = $this->hifiManager->getHifiById($id);
        $data_page = [
            "page_description" => "Affichage d'article hifi",
            "page_title" => "Affichage d'article hifi",
            "hifi"=>$hifi,
            "view" => "views/materiel-Hifi/afficherUnHifi.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
    
    public function buyHifi($id){
        $hifie = $this->hifiManager->getHifiById($id);
        $data_page = [
            "page_description" => "Panier",
            "page_title" => "Panier",
            "hifie"=>$hifie,
            "view" => "views/materiel-Hifi/addPanierHifi.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
     // panier
     public function addPanierHifi($id)
     {
         return $this->hifiManager->getHifiById($id);
     }
     public function ajoutHifi()
    {
        $data_page = [
            "page_description" => "Ajout d'un article hifi",
            "page_title" => "Ajout d'un article hifi",
            "view" => "views/Materiel-Hifi/ajoutHifi.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
       
    


    public function ajoutHifiValidation()
    {

        $file = $_FILES['image'];
        $repertoire = "public/Assets/images/materielsHifi/";
        $nomImageAjoute = $this->ajoutImage($file, $repertoire);
        $this->hifiManager->ajoutHifiBd($_POST['article'], $_POST['marque'], $_POST['price'], $nomImageAjoute);
        header('Location: ' . URL . "materielsHifi");
    }


    private function ajoutImage($file, $dir)
    {
        if (!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");

        if (!file_exists($dir)) mkdir($dir, 0777);

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $random = rand(0, 99999);
        $target_file = $dir . $random . "_" . $file['name'];

        if (!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if (file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        if ($file['size'] > 500000)
            throw new Exception("Le fichier est trop gros");
        if (!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random . "_" . $file['name']);
    }

 public function suppressionLivre($id)
    {
        $nomImage = $this->hifiManager->getHifiById($id)->getImage();
        unlink("public/Assets/images/materilesHifi/" . $nomImage);
        $this->hifiManager->suppressionHifiBD($id);

        
        header('Location: ' . URL . "materielsHifi");
    }



    public function modificationHifi($id)
    {
        $hifi = $this->hifiManager->getHifiById($id);
        $data_page = [
            "page_description" => "Modif d'un article hifi",
            "page_title" => "Modif d'un article hifi",
            "hifi"=>$hifi,
            "view" => "views/Materiel-Hifi/modifierHifi.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    

    public function modifHifiValidation()
    {
        $imageActuelle = $this->hifiManager->getHifiById($_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if ($file['size'] > 0) {

            unlink("public/Assets/images/materielsHifi/".$imageActuelle);
            $repertoire = "public/Assets/images/materielsHifi/";
            $nomImageAjoute = $this->ajoutImage($file, $repertoire);
        } else {
            $nomImageAjoute = $imageActuelle;
        }
        $this->hifiManager->modificationHifiBD($_POST['identifiant'],$_POST['article'],$_POST['marque'],$_POST['price'],$nomImageAjoute);
        
        header('Location: '. URL . "materielsHifi");
    }
}
