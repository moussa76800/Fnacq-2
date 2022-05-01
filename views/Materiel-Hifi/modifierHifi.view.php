
<br>

<form method="POST" action="<?= URL ?>materielsHifi/validationModif" enctype="multipart/form-data">
    <div class="form-group"style="font-weight: bold">
        <label for="title">Article : </label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $hifi->getTitle() ?>">
    </div>

    <div class="form-group"style="font-weight: bold">
        <label for="marque">Marque : </label>
        <input type="text" class="form-control" id="marque" name="marque" value="<?= $hifi->getMarque() ?>">
    </div>

    <div class="form-group"style="font-weight: bold">
        <label for="price">Price: </label>
        <input type="float" class="form-control" id="price" name="price" value="<?= $hifi->getPrice() ?>">
    </div>

    <h3>Image : </h3><br>
    <img src="<?= URL ?>public/Assets/images/livres/<?= $hifi->getImage() ?> " width="130px;">
    <div class="form-group"style="font-weight: bold"><br>
        <label for="image">Changer image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>

    <input type="hidden" name="identifiant" value="<?= $hifi->getId(); ?>">
    <button type="submit" class="btn btn-primary"style="font-weight: bold">To validate</button>
</form>

