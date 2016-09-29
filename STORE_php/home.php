<?php
	require_once("functions.php"); //includ fisierul de functii
	require("header.php"); //includ header-ul paginii
	if((isset($_SESSION['logat']) && ($_SESSION['logat']==1))){ //mai verific o data daca sunt logat si execut instructiuni de inserare, updatare>(Validari pe Formulare)
	require("meniu.php"); //si daca da-includ meniu
?>
	
		<?php
			//daca inserarea unui produs s-a facut cu succes, in functie am facut redirect catre home.php?insertProdus=1
			//deci, daca insertProdus este in url si e 1 afisez un mesaj de insert cu succes
			if(isset($_GET['insertProdus']) && $_GET['insertProdus'] == 1){ 
				echo "<p style='color:red;font-weight:bold;'>Produsul a fost inserat cu succes!</p>";
			}
			//daca updatarea unui produs s-a facut cu succes, in functie am facut redirect catre home.php?updateProdus=1
			//deci, daca updateProdus este in url si e 1 afisez un mesaj de update cu succes
			if(isset($_GET['updateProdus']) && $_GET['updateProdus'] == 1){
				echo "<p style='color:red;font-weight:bold;'>Modificarea a fost efectuata cu succes!</p>";
			}			
						//daca inserarea unei subcategorii s-a facut cu succes, in functie am facut redirect catre home.php?insertSubcat=1
			//deci, daca insertSubcat este in url si e 1 afisez un mesaj de insert cu succes			
			if(isset($_GET['insertSubcat']) && $_GET['insertSubcat'] == 1){ 
				echo "<p style='color:red;font-weight:bold;'>Subcategoria a fost inserata cu succes!</p>";
			}
						//daca updatarea unei subcategorii s-a facut cu succes, in functie am facut redirect catre home.php?updateSubcategorie=1
			//deci, daca updateSubcategorie este in url si e 1 afisez un mesaj de update cu succes
			if(isset($_GET['updateSubcategorie']) && $_GET['updateSubcategorie'] == 1){
				echo "<p style='color:red;font-weight:bold;'>Modificarea a fost efectuata cu succes!</p>";
			}

			//daca inserarea unei categorii s-a facut cu succes, in functie am facut redirect catre home.php?insertCat=1
			//deci, daca insertCat este in url si e 1 afisez un mesaj de insert cu succes	
			if(isset($_GET['insertCat']) && $_GET['insertCat'] == 1){ 
				echo "<p style='color:red;font-weight:bold;'>Categoria a fost inserata cu succes!</p>";
			}
			//daca updatarea unei categorii s-a facut cu succes, in functie am facut redirect catre home.php?updateCat=1
			//deci, daca updateCat este in url si e 1 afisez un mesaj de update cu succes
						if(isset($_GET['updateCat']) && $_GET['updateCat'] == 1){
				echo "<p style='color:red;font-weight:bold;'>Modificarea a fost efectuata cu succes!</p>";
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