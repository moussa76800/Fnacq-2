<?php 
require_once("./models/Livre/Livre.class.php");
require_once("./models/Hifi/Hifi.class.php");
require_once("./models/Informatique/Info.class.php");
require_once("./models/Livre/LivreManager.model.php");
require_once("./models/Hifi/HifiManager.model.php");
require_once("./models/Informatique/InformatiqueManager.model.php");


$livreManager=new LivreManager();

?>

<style>
	.img-cart {
		display: block;
		max-width: 50px;
		height: auto;
		margin-left: auto;
		margin-right: auto;
	}

	table tr td {
		border: 1px solid #FFFFFF;
	}

	table tr th {
		background: #eee;
	}

	.panel-shadow {
		box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
	}
</style>

<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<div class="container bootstrap snippets bootdey">
	<div class="col-md-9 col-sm-8 content">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info panel-shadow">
				<?php if(Securite::estUtilisateur()){ ?>
					<BR>
					<div class="panel-heading">
						<h3 class="text-center">
						BIENVENUE DANS TON PANIER, <?= $_SESSION['profil']['login'] ?>
							<!-- <img class="img-circle img-thumbnail" src="<?= URL; ?>public/Assets/images/profil/<?= $_SESSION['profil']['image'] ?>" width="100px" alt="photo de profil"><br>
							<?= $_SESSION['profil']['login'] ?> -->
						</h3>
					</div>
					<?php  }  ?>
					<BR>
					<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">LE PANIER</h1>
					<table class="table text-center">
						<tr class="table-dark">
							<th>IMAGE</th>
							<th>TITLE</th>
							<th>PRICE</th>
							<th>QUANTITY</th>
							<th>TOTAL PRICE</th>
							<th>Action</th>
						</tr>
						<?php $total = 0;
						if (isset($result)) {	
							foreach ($result as $key => $value) { ?>
								<tr>
									<td class="align-middle"><img src="public/Assets/images/<?= $value['Valeur_Image']; ?>" width="60px;"></td>
									<td class="align-middle"><?= $value['Valeur_Title']; ?></a></td>
									<td class="align-middle"><?= $value['Valeur_Price']; ?> Euros</td>
									<td class="align-middle"><?= $value['Valeur_Quantity']; ?> quantity</td>
									<td class="align-middle"><?= intval($value['Valeur_Quantity']) * intval($value['Valeur_Price']); ?> Euros</td>
									<td class="align-middle"><a class="btn btn-danger" href="<?= URL ?>panier/del/<?= $value['Valeur_Id']; ?>/<?= $value['Valeur_Category']; ?>"><img src="public/Assets/images/icons/trash.svg"></a></td>
								</tr>
							<?php 
								if (isset($value)) {
									$total = $total + ($value['Valeur_Quantity']*$value['Valeur_Price']);
								}
							}
						} ?>
							<tr>
								<td colspan="4" class="text-right"><strong>Total</strong></td>
								<td><?php echo $total." euros" ?></td>
							</tr>
						</table>
				</div><br>
				<a href="<?= URL ?>panier/achat/<?php echo $total; ?>" class="btn btn-success pull-right ">Finaliser achat</a>
			</div>
		</div>