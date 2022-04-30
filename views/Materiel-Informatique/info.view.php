
<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">LISTE DU MATERIELS INFORMATIQUES</h1>


<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Article</th>
        <th>Marque</th>
        <th>Prix</th>
        <th colspan="3">Actions</th>
    </tr>
    <?php
         for ($i=0; $i< count($info); $i++) : ?>
        <tr>
            <td class="align-middle"><img src="public/Assets/images/materielsInformatiques/<?= $info[$i]->getImage();?>" width="60px;"></td>
            <td class="align-middle"><a href="<?= URL ?>materielsInformatiques/display/<?= $info[$i]->getId(); ?>"><?= $info[$i]->getArticle(); ?></a></td>
            <td class="align-middle"><?=$info[$i]->getMarque();?></td>
            <td class="align-middle"><?=$info[$i]->getPrice();?> Euros</td>
            <?php 
            if (Securite::estUtilisateur() || !Securite::estConnecte()) { ?>
                <form> 
             <td class="align-middle"><a href="<?= URL ?>materielsInformatique/buy/<?= $info[$i]->getId(); ?>" class="btn btn-info">Buy</a></td>
        </td></form>
        <?php    } else { ?>
        <td class="align-middle"><a href="<?= URL ?>materielsInformatiques/modify/<?= $info[$i]->getId(); ?>" class="btn btn-warning">Edit</a></td>
                <td class="align-middle">
            <!-- TO DO  URL delete -->
                <form method="POST" action="<?= URL ?>materielsInformatiques/delete/<?= $info[$i]->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer le livre ?');">
                    <button class = "btn btn-danger" type="submit">Delete</button>
                </form></td>
            <?php   } ?>
        </tr>
        <?php endfor; ?>
 </table>
 <a href="<?= URL ?>materielsInformatiques/add" class="btn btn-success d-block">Add computing's article</a>

 
