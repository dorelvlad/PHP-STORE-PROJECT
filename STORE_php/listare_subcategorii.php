<?php
	require("functions.php");//includ functiile
	require("header.php");///includ header-ul paginii
	if((isset($_SESSION['logat']) && ($_SESSION['logat']==1))){ //verific daca sunt logat
	require("meniu.php"); //includ meniul
?>
    <br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
		<h2>Subcategorii</h2>
		<a href="adaugare_subcategorie.php">Adauga o subcategorie</a>

		<table colspan="0" rowspan="0" width="80%" border="1">
			<tr>
				<th>Nr. crt.</th>
				<th>Denumire subcategorie</th>
				<th>Categorie</th>
				<th>Editare</th>
				<th>Stare</th>
				<th>Stergere</th>
			</tr>
			<?php
				$query_list = "SELECT * FROM subcategorii"; //extrag toate produsele din BD pt a le afisa
				$res_list= mysqli_query($conn,$query_list); //apelez functia pt executia query-ului
				$contor = 0; //setez un contor 0, acesta va fi incrementat la fiecare parcurgere a rezultatului pentru afisarea numarului curent pt fiecare produs
				while($rezultat = mysqli_fetch_array($res_list)){ //parcurg rezultatul si creez un array
					$contor++; //incrementez contorul
					//mai jos afisez la fiecare iteratie din while nr curent reprezentat de $contor, denumirea, pretul, cantitatea fiecarui produs din BD
			?>
				<tr>
					<td><?php echo $contor; ?></td>
					<td><?php echo $rezultat['den_subcateg']; ?></td>
					<?php
						$query_cat = "SELECT * FROM categorii WHERE id_categorie = '".$rezultat['id_categorie']."'"; //caut in BD datele pentru categoria in care se afla fiecare produs
						$res_cat= mysqli_query($conn,$query_cat); //apelez functia pt executia query-ului
						$cat = mysqli_fetch_array($res_cat); //parcurg rezultatul din $res_cat si creez array-ul $cat in care pun aceste rezultate, mysqli_fetch_array e forma noua a functiei mysql_fetch_array
						//apoi afisez denumirea categoriei pt fiecare produs in parte
					?>
					<td><?php echo $cat['denumire_categorie']; ?></td>
					<?php //urmeaza link-ul de editare produs care duce in pagina update_produs.php cu trimitere in url pentru a fi preluat prin GET a id-ului fiecarui produs ?>
					<td><a href="update_subcategorii.php?id=<?php echo $rezultat['id_subcategorie']; ?>">Editare</a></td>
					<td><?php if($rezultat['activ'] == 1){ ?><a href="listare_subcategorii.php?action=dezactivare&amp;id=<?php echo $rezultat['id_subcategorie']; ?>">Dezactiveaza</a><?php } else{ ?><a href="listare_subcategorii.php?action=activare&amp;id=<?php echo $rezultat['id_subcategorie']; ?>">Activeaza</a><?php } ?></td>
					<td><?php if($rezultat['activ'] == 0){ ?><a href="listare_subcategorii.php?action=sterge&amp;id=<?php echo $rezultat['id_subcategorie']; ?>">Sterge subcategoria</a><?php } ?></td>
				</tr>
			<?php
				}
			?>
		</table>
		
			<?php
			//daca a fost apasat link-ul de dezactivare produs apelez functia care executa aceasta operatie
			if(isset($_GET['action']) && $_GET['action'] == 'dezactivare'){
				deactivateSubcat();
			}
			//daca a fost apasat link-ul de activare produs apelez functia care executa aceasta operatie
			if(isset($_GET['action']) && $_GET['action'] == 'activare'){
				activateSubcat();
			}
			//daca a fost apasat link-ul de stergere a unui produs dezactivat apelez functia care executa aceasta operatie
			if(isset($_GET['action']) && $_GET['action'] == 'sterge'){
				deleteSubcategorie();
			}
		?>	
		
<?php
	}
	else{
		//daca nu sunt logat distrug sesiunea si fac redirect care index.php care contine formularul de login
			session_destroy();
			header("location:index.php");
	}
	require("footer.php"); //includ footer-ul paginii
?>