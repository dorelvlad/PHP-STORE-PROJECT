<?php
	require("functions.php");//includ functiile
	require("header.php");///includ header-ul paginii
	if((isset($_SESSION['logat']) && ($_SESSION['logat']==1))){ //verific daca sunt logat
	require("meniu.php"); //includ meniul
?>
	
		<h2>Categorii</h2>
	<a href="adaugare_categorie.php">Adauga o categorie</a>

		<table colspan="0" rowspan="0" width="80%" border="1">
			<tr>
				<th>Nr. crt.</th>
				<th>Denumire categorie</th>
				<th>Editare</th>
				<th>Stare</th>
				<th>Stergere</th>
			</tr>
			<?php
				$query_list = "SELECT * FROM categorii"; //extrag toate categoriile din BD pt a le afisa
				$res_list= mysqli_query($conn,$query_list); //apelez functia pt executia query-ului
				$contor = 0; //setez un contor 0, acesta va fi incrementat la fiecare parcurgere a rezultatului pentru afisarea numarului curent pt fiecare categorie
				while($rezultat = mysqli_fetch_array($res_list)){ //parcurg rezultatul si creez un array
					$contor++; //incrementez contorul
					//mai jos afisez la fiecare iteratie din while nr curent reprezentat de $contor si denumirea categoriei din BD
			?>
				<tr>
					<td><?php echo $contor; ?></td><!--pentru numarul curent-->
					<td><?php echo $rezultat['denumire_categorie']; ?></td>
					<td><a href="update_categorii.php?id=<?php echo $rezultat['id_categorie']; ?>">Editare</a></td><!--fac direct la click catre update_categorii.php?id=1 la primul, 2 la al doilea-->
					<td><?php if($rezultat['activ'] == 1){ ?><a href="listare_categorii.php?action=dezactivare&amp;id=<?php echo $rezultat['id_categorie']; ?>">Dezactiveaza</a><?php } else{ ?><a href="listare_categorii.php?action=activare&amp;id=<?php echo $rezultat['id_categorie']; ?>">Activeaza</a><?php } ?></td>
					<td><?php if($rezultat['activ'] == 0){ ?><a href="listare_categorii.php?action=sterge&amp;id=<?php echo $rezultat['id_categorie']; ?>">Sterge categoria</a><?php } ?></td>
				</tr>
			<?php
				}
			?>
		</table>
					<?php
			//daca a fost apasat link-ul de dezactivare categorie apelez functia care executa aceasta operatie
			if(isset($_GET['action']) && $_GET['action'] == 'dezactivare'){
				deactivateCat();
			}
			//daca a fost apasat link-ul de activare produs apelez functia care executa aceasta operatie
			if(isset($_GET['action']) && $_GET['action'] == 'activare'){
				activateCat();
			}
			//daca a fost apasat link-ul de stergere a unui produs dezactivat apelez functia care executa aceasta operatie
			if(isset($_GET['action']) && $_GET['action'] == 'sterge'){
				deleteCat();
			}
		?>
<?php
	}
	else{
		//daca nu sunt logat distrug sesiunea si fac redirect care index.php care contine formularul de login
			session_destroy();
			header("location:index.php");
	}
	require("footer.php");  //includ footer-ul paginii
?>