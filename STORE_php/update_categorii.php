<?php
	require_once("functions.php"); //includ fisierul cu functii
	require("header.php"); //includ header-ul paginii
	if((isset($_SESSION['logat']) && ($_SESSION['logat']==1))){ // verific daca sunt logat
	require("meniu.php"); //includ meniul cu cele 2 link-uri
?>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
		<h2>Editeaza o categorie</h2>
		<?php
			detaliuCat(); //apelez functia care imi extrage din BD toate informatiile stocate pt categoria curenta (cea cu id-ul trimis in url)
			if(isset($_POST['submit'])){ //daca a fost apasat butonul de submit al formularului
			updateCat(); //apelez functia de update a unei categorii  - se gaseste in functions.php
			}
		?>
			<form action="update_categorii.php?id=<?php echo $_GET['id']; ?>" method="post">
                <tr>
					<td><label for="denumire">Denumire categorie</label></td>
					<td><input type="text" name="denumire_categorie" id="denumire" value="<?php echo $categ['denumire_categorie'];?>" />
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