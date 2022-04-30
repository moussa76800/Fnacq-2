<?php

require_once "./controllers/MainController.controller.php";
require_once "./models/Informatique/InformatiqueManager.model.php";


class InformatiqueController extends MainController
{

    private $informatiqueManager;


    public function __construct()
    {
        $this->informatiqueManager = new InformatiqueManager();
        $this->informatiqueManager ->chargementInfo();
    }


    
    public function afficherInformatique()
    {
        
        $info = $this->informatiqueManager->getInfos();
        if (Securite::estUtilisateur() || !Securite::estConnecte()) {
            $data_page = [
                "page_description" => "La liste des articles informatiques",
                "page_title" => "La liste des articles informatiques",
                "info"=>$info,
                "view" => "views/Materiel-Informatique/info.view.php",
                "template" => "views/common/template.php"
            ];
        } else {
            $data_page = [
                "page_description" => "La liste des articles informatiques",
                "page_title" => "La liste des articles informatiques",
                "info"=>$info,
                "view" => "views/Materiel-Informatique/info.view.php",
                "template" => "views/common.dashboard/templateDash.php"
            ];
        }
        $this->genererPage($data_page);
    }
    
    // panier
    public function addPanierInfo($id)
    {
        return $this->informatiqueManager->getInfoById($id);
    }
    // panier

    public function afficherUnInfo($id)
    {
        $info = $this->informatiqueManager->getInfoById($id);
        $data_page = [
            "page_description" => "Affichage d'un article informatique",
            "page_title" => "Affichage d'un article informatique",
            "info"=>$info,
            "view" => "views/Materiel-Informatique/afficherUninfo.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
    
    public function buyInfo($id){
        $infoe = $this->informatiqueManager->getInfoById($id);
        $data_page = [
            "page_description" => "Panier",
            "page_title" => "Panier",
            "infoe"=>$infoe,
            "view" => "views/Materiel-Informatique/addPanierInfo.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    

    public function ajoutInfo()
    {
        $data_page = [
            "page_description" => "Ajout d'un article informatique",
            "page_title" => "Ajout d'un article informatique",
            "view" => "views/Materiel-Informatique/ajoutInfo.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
       
    


    public function ajoutInfoValidation()
    {

        $file = $_FILES['image'];
        $repertoire = "public/Assets/images/materielsInformatiques/";
        $nomImageAjoute = $this->ajoutImage($file, $repertoire);
        $this->informatiqueManager->ajoutInfosBd($_POST['article'], $_POST['marque'], $_POST['price'], $nomImageAjoute);
        header('Location: ' . URL . "materielsInformatiques");
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


    
    public function suppressionInfo($id)
    {
        $nomImage = $this->informatiqueManager->getInfoById($id)->getImage();
        unlink("public/Assets/images/materielsInformatiques/" . $nomImage);
        $this->informatiqueManager->suppressionInfoBD($id);

        
        header('Location: ' . URL . "materielsInformatiques");
    }



    public function modificationInfo($id)
    {
        $info = $this->informatiqueManager->getInfoById($id);
        $data_page = [
            "page_description" => "Ajout d'un article informatique",
            "page_title" => "Ajout d'un article informatique",
            "info"=>$info,
            "view" => "views/Materiel-Informatique/modifierInfo.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    

    public function modifInfoValidation()
    {
        $imageActuelle = $this->informatiqueManager->getInfoById($_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if ($file['size'] > 0) {

            unlink("public/Assets/images/materielsInformatiques/".$imageActuelle);
            $repertoire = "public/Assets/images/materielsInformatiques/";
            $nomImageAjoute = $this->ajoutImage($file, $repertoire);
        } else {
            $nomImageAjoute = $imageActuelle;
        }
        $this->informatiqueManager->modificationInfoBD($_POST['identifiant'],$_POST['article'],$_POST['marque'],$_POST['price'],$nomImageAjoute);
        
        header('Location: '. URL . "materielsInformatiques");
    }
}