<?php 
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    $total=nb_vues($utilisateur['login']);
    $total7=nb_vues_sept($utilisateur['login']);
?>
<div class="rounded border border-dark p-2 m-2 text-center ">
    <h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">Profil : <?= $utilisateur['login'] ?></h1>

    <div>
        <div>
            <img src="<?= URL; ?>public/Assets/images/<?= $utilisateur['image'] ?>" width="100px" alt="photo de profil" />
        </div><br>
        <form method="POST" action="<?= URL ?>compte/validation_modificationImage" enctype="multipart/form-data">
            <label for="image">Changer l'image du profil :</label>
            <input type="file" class="form-control-file" id="image" name="image" onchange="submit();" />
        </form>
    </div>
    <br>
    <div id="email">
        Email : <?= $utilisateur['email'] ?>
        <button class="btn btn-primary" id="btnModifMail">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg>
        </button>
    </div>
    <div id="modificationMail" class="d-none">
        <form method="POST" action="<?= URL; ?>compte/validation_modificationMail/<?= $utilisateur['login'] ?>">
            <div class="row">
                <label for="email" class="col-2 col-form-label">Email :</label>
                <div class="col-8">
                    <input type="mail" class="form-control" name="email" value="<?= $utilisateur['email'] ?>" />
                </div>
                <div class="col-2">
                    <button class="btn btn-success" id="btnValidModifMail" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div>
        <a href="<?= URL ?>compte/modificationPostal/<?= $utilisateur['login'] ?>" class="btn btn-warning">Changer le code postal</a>
        <a href="<?= URL ?>compte/modificationPassword/<?= $utilisateur['login'] ?>" class="btn btn-warning">Changer le mot de passe</a>
        <a href="<?= URL ?>compte/validation_suppressionCompte/<?= $utilisateur['login'] ?>" class="btn btn-danger">Supprimer son compte</a>
    </div>
    <div>
        <p>Vous êtes inscrit depuis le <?php echo $utilisateur['date_creation'] ?></p>
    </div>
</div>
<?php if ($order!=null) { ?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <section class="text-center">
            <h1>COMMANDES</h1>
            </section>
            
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">N° commande</th>
                <th scope="col">Date</th>
                <th scope="col">Total €</th>
                <th scope="col">Détail</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($order)) {	
                    $i=1;
                        foreach ($order as $key => $value) { ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?= $value['date_order']; ?></td>
                                <td><?= $value['total_prix']; ?></td>
                                <?php if (Securite::estAdministrateur()) { ?>
                                    <td><a href="<?= URL ?>administration/showProfilUser/<?= $utilisateur['login'] ?>/<?php echo $value['id_order']; ?>">détails</td>
                                <?php } else { ?>
                                    <td><a href="<?= URL ?>compte/profil/<?php echo $value['id_order']; ?>">détails</td>
                                <?php } ?>
                                
                            </tr>
                        <?php $i++;
                        }
                    } ?>
            </tbody>
            </table>
        </div>
        <?php
        $id_order=(isset($url[2]))? $url[2] : null;
        if ($id_order!=null) {?>
            <div class="col-6">
            <section class="text-center">
                <h1>Détails</h1>
                </section>
                
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Picture</th>
                    <th scope="col">Titre de l'article</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix €</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; if (isset($details)) {
                            foreach ($details as $key => $value) { ?>
                                <tr>
                                    <th><img src="<?= URL ?>public/Assets/images/<?= $value['Valeur_Image']; ?>" width="60px;"></th>
                                    <td><?= $value['Valeur_Title']; ?></td>
                                    <td><?= $value['Valeur_Quantity']; ?></td>
                                    <td><?= $value['Valeur_Quantity']*$value['Valeur_Price']; ?></td>
                                </tr>
                                <?php 
								if (isset($value)) {
									$total = $total + ($value['Valeur_Quantity']*$value['Valeur_Price']);
								}
							}
						} ?>
                </tbody>
                <tfoot> 
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                        <td><?php echo $total." €" ?></td>
                    </tr>
                </tfoot>
                </table>
            </div>
        <?php } ?>

    </div>
    

</div>

<?php } if (Securite::estAdministrateur()) { ?>
<div class='row'>
    <div class='col-md-4'>
        <div class='card'>
            <div class="card-body">
                <strong style="font-size:3em;"><?= $total ?></strong><br>
                Visite<?= $total>1?'s':''?> aujourd'hui
            </div>
            <div class="card-body">
                <strong style="font-size:3em;"><?= $total7 ?></strong><br>
                Visite<?= $total>1?'s':''?> ces 7 derniers jours
            </div>
        </div>
    </div>
</div>
    <?php } ?>