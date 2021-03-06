<?php
require_once  "./models/MainManager.model.php";


class UtilisateurManager extends MainManager
{


    private function getPasswordUser($login)
    {
        $req = "SELECT password FROM utilisateur WHERE login= :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['password'];
    }

    private function getPostalUser($login)
    {
        $req = "SELECT code_postal FROM utilisateur WHERE login= :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['code_postal'];
    }


    
    public function estCompteActive($login)
    {
        $req = "SELECT est_valide FROM utilisateur WHERE login= :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ((int)$resultat['est_valide'] === 1) ? true : false;
    }

    public function userBloque($login)
    {
        $req = "SELECT role FROM utilisateur WHERE login= :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['role'] === 'utilisateur_Indesirable' ? true : false;
    }



    public function isCombinaisonValide($login, $password)
    {
        $passwordBD = $this->getPasswordUser($login);
        return password_verify($password, $passwordBD);
    }


    public function isCombinaisonPostalValide($login, $code_postal)
    {
        $postalBD = $this->getPostalUser($login);
        return ($code_postal=== $postalBD);
    }
    
    public function getUserInformation($login)
    {
        $req = "SELECT *, DATE_FORMAT(`date_creation`, '%d/%m/%Y') as `date_creation` FROM utilisateur WHERE login=:login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function InscriptionBD($login, $passwordCrypte, $email, $role, $image, $clef, $nom, $prenom, $adresse, $code_postal, $date_de_naissance)
    {

        $req = "INSERT INTO utilisateur (login,password,email,role,image,est_valide,clef,nom,prenom,adresse,code_postal,date_de_naissance,date_creation)
 VALUES (:login,:password,:email,:role,:image,1,:clef,:nom,:prenom,:adresse,:code_postal,:date_de_naissance, now())";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $passwordCrypte, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $stmt->bindValue(":code_postal", $code_postal, PDO::PARAM_INT);
        $stmt->bindValue(":date_de_naissance", $date_de_naissance, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }


    public function verifLoginDisponible($login){
        $req = "SELECT * FROM utilisateur WHERE login=:login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return empty($resultat);
    }


    public function modificationPasswordDB($login, $password)
    {
        $req = "UPDATE utilisateur set password = :password WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
    public function bdAjoutImage($login,$image){
        $req = "UPDATE utilisateur set image = :image WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
    public function bdmodifPostal($login,$code_postal){
        $req = "UPDATE utilisateur set code_postal = :code_postal WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":code_postal",$code_postal,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function getImageUtilisateur($login){
        $req = "SELECT image FROM utilisateur WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['image'];
    }


    /* public function bdValidationMailCompte($login,$clef){
        $req = "UPDATE utilisateur set est_valide = 1 WHERE login = :login and clef = :clef";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":clef",$clef,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationMailUser($login,$email){
        $req = "UPDATE utilisateur set email = :email WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":email",$email,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    } */

    public function validation_suppressionCompteDB($login)
    {
        $req = "DELETE FROM utilisateur WHERE login=:login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function getInfoOrder($login){
        $req = "SELECT `id_order`,DATE_FORMAT(`date_order`, '%d/%m/%Y') as `date_order`,`total_prix` FROM `order` WHERE `login` = :login ORDER BY `date_order` ASC";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function getDetailOrder($detail){
        $alldetails= array();
        $req = "SELECT * FROM `detail_order` WHERE `order_id`= :detail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":detail", $detail, PDO::PARAM_INT);
        $stmt->execute();
        $resultatAll = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($resultatAll as $key => $value) {
            if ($value['category'] === 'livre') {
                $req = "SELECT * FROM `livres` WHERE `id`=:id ";
                $stmt = $this->getBdd()->prepare($req);
                $stmt->bindValue(":id", $value['id_article'], PDO::PARAM_INT);
                $stmt->execute();
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                
                $article = array(
                    'Valeur_Title' => $resultat['title'],
                    'Valeur_Image' => "livres/{$resultat['image']}",     
                    'Valeur_Price' => $resultat['price'],              
                    'Valeur_Quantity' => $value['quantity_article'],
                );
                $alldetails[] = $article;


            } elseif ($value['category'] === 'hifi') {
                $req = "SELECT * FROM `hifi` WHERE `id`=:id ";
                $stmt = $this->getBdd()->prepare($req);
                $stmt->bindValue(":id", $value['id_article'], PDO::PARAM_INT);
                $stmt->execute();
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                $article = array(
                    'Valeur_Title' => $resultat['article'],
                    'Valeur_Image' => "materielsHifi/{$resultat['image']}",     
                    'Valeur_Price' => $resultat['price'],              
                    'Valeur_Quantity' => $value['quantity_article'],
                );
                $alldetails[] = $article;

            } elseif ($value['category'] === 'informatique') {
                $req = "SELECT * FROM `informatique` WHERE `id`=:id ";
                $stmt = $this->getBdd()->prepare($req);
                $stmt->bindValue(":id", $value['id_article'], PDO::PARAM_INT);
                $stmt->execute();
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                $article = array(
                    'Valeur_Title' => $resultat['article'],
                    'Valeur_Image' => "materielsInformatiques/{$resultat['image']}",     
                    'Valeur_Price' => $resultat['price'],              
                    'Valeur_Quantity' => $value['quantity_article'],
                );
                $alldetails[] = $article;
            }
            
        }
        return $alldetails;
    }
}
