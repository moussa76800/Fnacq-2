
<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">Listing a book</h1>

<br>
<br>

<div class="row">
    <div class="col-6"style="font-weight: bold">
    <img src="<?= URL ?>public/Assets/images/materielsHifi/<?= $hifi->getImage(); ?>">
    </div>
    
    <div class="col-6"style="font-weight: bold"><br><br>
        <p>Article : <?= $hifi->getTitle(); ?></p>
        <p>Marque : <?= $hifi->getMarque(); ?></p>
        <p>Price : <?= $hifi->getPrice()." Euros"; ?></p>
    </div>
</div>

