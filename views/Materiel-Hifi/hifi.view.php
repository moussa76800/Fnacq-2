
<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">LISTE DU MATERIELS HIFI</h1>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Article</th>
        <th>Marque</th>
        <th>Prix</th>
        <th colspan="3">Actions</th>
    </tr>
    <?php
         for ($i=0; $i< count($hifi); $i++) : ?>
        <tr>
            <td class="align-middle"><img src="public/Assets/images/materielsHifi/<?= $hifi[$i]->getImage();?>" width="60px;"></td>
            <td class="align-middle"><a href="<?= URL ?>materielsHifi/display/<?= $hifi[$i]->getId(); ?>"><?= $hifi[$i]->getTitle(); ?></a></td>
            <td class="align-middle"><?=$hifi[$i]->getMarque();?></td>
            <td class="align-middle"><?=$hifi[$i]->getPrice();?> Euros</td>
<<<<<<< HEAD
                <form> 
             <td class="align-middle"><a href="<?= URL ?>materielsHifi/buy/<?= $hifi[$i]->getId(); ?>" class="btn btn-info">Buy</a></td>
        </td></form>
=======
            <?php 
            if (Securite::estUtilisateur() || !Securite::estConnecte()) { ?>
                <form> 
             <td class="align-middle"><a href="<?= URL ?>materielsHifi/buy/<?= $hifi[$i]->getId(); ?>" class="btn btn-info">Buy</a></td>
        </td></form>
        <?php    } else { ?>
        <td class="align-middle"><a href="<?= URL ?>livres/modify/<?= $hifi[$i]->getId(); ?>" class="btn btn-warning">Edit</a></td>
                <td class="align-middle">
            <!-- TO DO  URL delete -->
                <form method="POST" action="<?= URL ?>livres/delete/<?= $hifi[$i]->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer le livre ?');">
                    <button class = "btn btn-danger" type="submit">Delete</button>
                </form></td>
            <?php   } ?>
>>>>>>> 4d65249edc33d6edd29dd486da4d442fc79a20fa
        </tr>
        <?php endfor; ?>
 </table>

 
