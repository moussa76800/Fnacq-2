
Total Hits:
<?


$filename = "hit_counter.txt";
@$fptr = fopen($filename, "r+");

if ($fptr == NULL) {
    @$fptr = fopen($filename, "w+");
    fwrite($fptr, "1");
    fclose($fptr);
    echo "1";
}
else {
    $data = fread($fptr, filesize($filename));
    $dataInt = (int) $data;
    $dataInt++;
    rewind($fptr);
    fwrite($fptr, $dataInt);
    fclose($fptr);
    echo $dataInt;
}
?>
<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-success">PAGE DE CONNEXION</h1>
<br>
<br>


<form method="POST" action="<?=URL ?>validation_login">
    <div class="mb-3">
        <label for="login" class="form-label">LOGIN</label>
        <input type="text" class="form-control" id="login" name="login" required >

        <div class="mb-3">
            <label for="password" class="form-label">PASSWORD</label>
            <input type="password" class="form-control" id="password" name="password" required >
        </div>

        
        <button type="reset" class="btn btn-primary">REINITIALISER LE FORMULAIRE</button>
        <button type="submit" class="btn btn-primary">CONNEXION</button>
</form>