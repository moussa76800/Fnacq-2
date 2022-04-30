
<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">Listing a computing's article</h1>

<br>
<br>

<div class="row">
    <div class="col-6"style="font-weight: bold">
    <img src="<?= URL ?>public/Assets/images/materielsInformatiques/<?= $info->getImage(); ?>">
    </div>
    <div class="col-6"style="font-weight: bold">
        <p>Article : <?= $info->getArticle(); ?></p>
        <p>Marque : <?= $info->getMarque(); ?></p>
        <p>Price : <?= $info->getPrice()." Euros"; ?></p>
    </div>
</div>

