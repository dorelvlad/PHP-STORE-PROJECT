<?php
	require_once("functions.php"); //includ fisierul cu functii
	require("header.php"); //includ header-ul paginii
	if((isset($_SESSION['logat']) && ($_SESSION['logat']==1))){ // verific daca sunt logat
	require("meniu.php"); //includ meniul cu cele 2 link-uri
?>
		<h2>Adauga o categorie</h2>
		<?php
			if(isset($_POST['submit'])){ //daca a fost apasat butonul de submit al formularului
				insertCat(); //apelez functia de inserare produs - se gaseste in functions.php
			}
		?>
		<form action="adaugare_categorie.php" method="post"> 
			<table>
				<tr>
					<td><label for="denumire">Denumire categorie</label></td>
					<td><input type="text" name="den_categ" id="denumire" value="" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Adauga" />
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