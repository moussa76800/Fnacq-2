<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">AJOUT D'UN MATERIEL HIFI</h1>
<BR>
<BR>
<form method="POST" action="<?= URL ?>materielsHifi/validationAjout" enctype="multipart/form-data">
    <div class="form-group"style="font-weight: bold">
        <label for="article">Article : </label>
        <input type="text" class="form-control" id="article" name="article">
    </div>
    <div class="form-group"style="font-weight: bold">
        <label for="marque">Marque : </label>
        <input type="text" class="form-control" id="marque" name="marque">
    </div>
    <div class="form-group"style="font-weight: bold">
        <label for="price">Price: </label>
        <input type="float" class="form-control" id="price" name="price">
    </div>
    <br>
    <div class="form-group"style="font-weight: bold">
        <label for="image">Image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <br>  
    <button type="submit" class="btn btn-primary"style="font-weight: bold">Add hifi's article</button>
</form>

