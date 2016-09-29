<?php
	require_once("functions.php"); //includ fisierul cu functii
	require("header.php"); //includ header-ul paginii
	if((isset($_SESSION['logat']) && ($_SESSION['logat']==1))){ // verific daca sunt logat
	require("meniu.php"); //includ meniul cu cele 2 link-uri
?>
		<h2>Adauga un produs</h2>
		<?php
			if(isset($_POST['submit'])){ //daca a fost apasat butonul de submit al formularului
				insertProduct(); //apelez functia de inserare produs - se gaseste in functions.php
			}
		?>
		<form action="adaugare_produs.php" method="post"> 
			<table>
				<tr>
					<td><label for="denumire">Denumire produs</label></td>
					<td><input type="text" name="denumire" id="denumire" value="" /></td>
				</tr>
				<tr>
					<td><label for="pret">Pret produs</label></td>
					<td><input type="text" name="pret" id="pret" value="" /></td>
				</tr>
				<tr>
					<td><label for="cantitate">Cantitate produs</label></td>
					<td><input type="text" name="cantitate" id="cantitate" value="" /></td>
				</tr>
				<tr>
					<td><label for="denumire">Subcategorie</label></td>
					<td>
						<select name="subcategorie">
							<option value="-" name="subcategorie">Alege o subcategorie</option>
							<?php
								$query_cat = "SELECT * FROM subcategorii"; //query care extrage toate subcategoriile
								$res_cat= mysqli_query($conn,$query_cat);// mysqli_query este forma noua a functiei mysql_query - primeste 2 parametri - o variabila de conectare la baza de date si variabila in care am scris interogarea
								while($cat = mysqli_fetch_array($res_cat)){ //parcurg rezultatul din $res_cat si creez array-ul $cat in care pun aceste rezultate, mysqli_fetch_array e forma noua a functiei mysql_fetch_array
								//in drop down-ul de afisare a subcategoriilor, la option pe value tin id-ul subcategoriei pe care il inserez in tabela produse iar ca afisare in pagina denumirea subcategoriei
							?>
								<option value="<?php echo $cat['id_subcategorie']; ?>"><?php echo $cat['den_subcateg']; ?></option>
							<?php
							}
							?>
						</select>
					</td>
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