<style>
    .card-img-top{
        width: 100%;
        height: 50%;
    }
</style>
<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">PAGE D'ACCUEIL</h1>

<br>
<br>
<!-- <div id="myCarousel" class="carousel slide " data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div> 
    <div class="carousel-inner">
        <div class="carousel-item active">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#777" />
            </svg>

            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Example headline.</h1>
                    <p>Some representative placeholder content for the first slide of the carousel.</p>
                    <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                </div>
            </div>
        </div>-->

<div class="card-group">
    <div class="card">
        <img src="public/Assets/images/image.accueil/book.jpg " class="card-img-top" alt="..." >
        <div class="card-body">
            <h5 class="card-title">LIVRES</h5>

            <p class="card-text"><small class="text-muted">Voir tout les livres disponibles dans le e-shop.</small></p>
            <p><a class="btn btn-dark" href="<?= URL ?>livres">View details &raquo;</a></p>
        </div>
    </div>
    <div class="card">
        <img src="public/Assets/images/image.accueil/hifi.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">HIFIS</h5>
            <p class="card-text"><small class="text-muted">Voir tout les produits hifis disponibles dans le e-shop.</small></p>
            <p><a class="btn btn-dark" href="<?= URL ?>materielsHifi">View details &raquo;</a></p>
        </div>
    </div>
    <div class="card">
        <img src="public/Assets/images/image.accueil/info.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">INFORMATIQUES</h5>
            <p class="card-text"><small class="text-muted">Voir tout les produits informatiques disponibles dans le e-shop.</small></p>
            <p><a class="btn btn-dark" href="<?= URL ?>materielsInformatiques">View details &raquo;</a></p>
        </div>
    </div>
</div>
<br>
<br>

<!-- START THE FEATURETTES -->

<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading"><a href="<?= URL ?>blog">Visiter notre blog. </a></h2>
        <p class="lead">Intéragissez sur le blog sur différents sujets intéressants.</p>
    </div>
    <div class="col-md-5">
        <img src="public/Assets/images/image.accueil/blog.jpg" alt="website template image" class="img-fluid tm-gallery-img" featurette-image img-fluid mx-auto width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em" 500x500></text>
    </div>
</div>
<BR>
<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading"><a href="<?= URL ?>tchat">Echanger vos avis dans notre chat.</a> </h2>
        <p class="lead">Participer dans le chat tout en respectant les réglementations .</p>
    </div>
    <div class="col-md-5 order-md-1">
        <img src="public/Assets/images/image.accueil/tchat.jpg" alt="website template image" class="img-fluid tm-gallery-img" featurette-image img-fluid mx-auto width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em" 500x500></text>
        </svg>
    </div>
</div>

<BR>
<BR>

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="public/Assets/images/livres/virus.png" class="d-block w-30" alt="..."><br>
      <h1><bold> Title : Le virus informatique d'Asie</bold> </h1>
      <h3>Author : Lee Chao</h3><br>
       <h4> Price : 35 Euros </h4>    
    </div>
    <div class="carousel-item">
      <img src="public/Assets/images/materielsHifi/casque.jpg" class="d-block w-30" alt="..."><br>
      <h1><bold> Article : Casque bluetooth </bold> </h1>
      <h3>Marque : Yamaha</h3><br>
      <h4> Price : 49 Euros </h4>    
    </div>
    <div class="carousel-item">
      <img src="public/Assets/images/materielsInformatiques/pc.jpg" class="d-block w-30" alt="..."><br>
      <h1><bold> Article : PC</bold> </h1>
      <h3>Marque : Sony</h3><br>
      <h4> Price : 399 Euros </h4>  
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br>
<br>








<!-- /END THE FEATURETTES -->

</div><!-- /.container -->