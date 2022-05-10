<?php 
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
</div>

<?php if (Securite::estAdministrateur()) { ?>
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