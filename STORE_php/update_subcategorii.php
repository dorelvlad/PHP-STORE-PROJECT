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
		<h2>Editeaza o subcategorie</h2>
		<?php
			detaliuSubcategorie(); //apelez functia care imi extrage din BD toate informatiile stocate pt subcategoria curenta (cea cu id-ul trimis in url)
			if(isset($_POST['submit'])){ //daca a fost apasat butonul de submit al formularului
			updateSubcategorie(); //apelez functia de update a unei subcategorii  - se gaseste in functions.php
			}
		?>
			<form action="update_subcategorii.php?id=<?php echo $_GET['id']; ?>" method="post">
                <tr>
					<td><label for="denumire">Denumire subcategorie</label></td>
					<td><input type="text" name="sub_categ" id="denumire" value="<?php echo $subcateg['den_subcateg'];?>" />
					</td>
				</tr>					
				<tr>
					<td><label for="denumire">Categorie</label></td>
					<td>
						<select name="categorie">
							<option value="-">Alege o categorie</option>
							<?php
								$query_cat = "SELECT * FROM categorii"; //query care extrage toate categoriile
								$res_cat= mysqli_query($conn,$query_cat); // mysqli_query este forma noua a functiei mysql_query - primeste 2 parametri - o variabila de conectare la baza de date si variabila in care am scris interogarea
								while($cat = mysqli_fetch_array($res_cat)){ 
							?>
								<option value="<?php echo $cat['id_categorie']; ?>" <?php if($cat['id_categorie'] == $subcateg['id_categorie']){ 
								?>selected="selected" <?php 
								} ?>><?php 
								echo $cat['denumire_categorie']; ?>
								</option>
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