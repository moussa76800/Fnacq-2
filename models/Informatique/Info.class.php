<?php
class Info {

    private $id;
    private $article;
    private $marque;
    private $price;
    private $image;
    private $category;

   

    public function __construct($id, $category, $article, $marque,$price, $image){
    
        $this->id = $id;
        $this->category = $category;
        $this->article = $article;
        $this->marque = $marque;
        $this->price = $price;
        $this->image = $image;
        
    }

    public function getId() { return $this->id;}
    public function setId($id) { $this->id=$id;}

    public function getCategory(){return $this->category;}

    public function getArticle() { return $this->article;}
    public function setArticle($article) { $this->article=$article;}
     
    public function getMarque() { return $this->marque;}
    public function setMarque($marque) { $this->marque=$marque;}

    public function getPrice() { return $this->price;}
    public function setPrice($price) { $this->price=$price;}

    public function getImage() { return $this->image;}
    public function setImage($image) { $this->image=$image;}
}