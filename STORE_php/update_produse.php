<?php
	require_once("functions.php"); //includ fisierul cu functii
	require("header.php"); //includ header-ul paginii
	if((isset($_SESSION['logat']) && ($_SESSION['logat']==1))){ // verific daca sunt logat
	require("meniu.php"); //includ meniul cu cele 2 link-uri
?>
	
		<h2>Editeaza un produs</h2>
		<?php
			detaliuProdus(); //apelez functia care imi extrage din BD toate informatiile stocate pt produsul curent (cel cu id-ul trimis in url)
			if(isset($_POST['submit'])){ //daca a fost apasat butonul de submit al formularului
				updateProduct(); //apelez functia de update a unui produs  - se gaseste in functions.php
			}
		?>
		<form action="update_produse.php?id=<?php echo $_GET['id']; ?>" method="post">
			<table>
				<tr>
					<td><label for="denumire">Denumire produs</label></td>
					<td><input type="text" name="denumire" id="denumire" value="<?php echo $prod['denumire']; ?>" /></td>
				</tr>
				<tr>
					<td><label for="pret">Pret produs</label></td>
					<td><input type="text" name="pret" id="pret" value="<?php echo $prod['pret']; ?>" /></td>
				</tr>
				<tr>
					<td><label for="cantitate">Cantitate produs</label></td>
					<td><input type="text" name="cantitate" id="cantitate" value="<?php echo $prod['cantitate']; ?>" /></td>
				</tr>
				<tr>
					<td><label for="denumire">Categorie</label></td>
					<td>
						<select name="categorie">
							<option value="-">Alege o categorie</option>
							<?php
								$query_cat = "SELECT * FROM subcategorii"; //query care extrage toate categoriile
								$res_cat= mysqli_query($conn,$query_cat); // mysqli_query este forma noua a functiei mysql_query - primeste 2 parametri - o variabila de conectare la baza de date si variabila in care am scris interogarea
								while($cat = mysqli_fetch_array($res_cat)){ 
							?>
								<option value="<?php echo $cat['id_subcategorie']; ?>" <?php if($cat['id_subcategorie'] == $prod['id_subcategorie']){ ?>selected="selected" <?php } ?>><?php echo $cat['den_subcateg']; ?></option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Update" />
					</td>
				</tr>
			</table>
		</form>

<?php
	}
	else{
		//daca nu sunt logat distrug sesiunea si fac redirect care index.php care contine formularul de login
			session_destroy();
			header("location:index.php");
		
	}
	require("footer.php"); //includ footer-ul paginii
?>