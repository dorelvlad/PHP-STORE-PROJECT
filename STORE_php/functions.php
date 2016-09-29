<?php
	session_start();
	$conn = mysqli_connect("localhost","root","","coachleatherware"); //conectarea la baza de date denumita coachleatherware
	/** 
	* safe insert to DB
	**/
	function safe($str) {
		global $conn;
		$str = trim($str);
		$str = mysqli_real_escape_string($conn,$str);
		return $str;
	}
	
	function display_logo() {   
echo "<p><img src=coach.jpg width='' height='' hspace='' align='left' /></p>";
  // echo "<p style='font-size: x-large'>My Fine Company</p>";  
   //echo "<p style='font-style: italic'>quality products</p>";  
  // return;
   }
   display_logo();
   
   	/**
	 * inserare categorie
	**/
	
	function insertCat(){
			global $conn;//ma conectez la BD
			$errors = array(); //creez array de erori
			if($_POST['den_categ'] == ''){
				$errors[] = 'Completati campul Denumire categorie!';
			}
			//daca am erori le afisez
			if(!empty($errors)){ ?><!--daca nu am erori-parcurg array sa determin mesajul de completare-->
				<ul>
					<?php foreach ($errors as $key => $val){ ?>
						<li style="color:red;font-weight:bold;"><?php echo $errors[$key]; ?></li>	
					<?php } ?>
				</ul>
			<?php 
			} else{ //si tot daca nu am erori fac safe insert in tabela categorii
	
				$denumire = safe($_POST['den_categ']);								
				$query_insert = "INSERT INTO categorii SET denumire_categorie = '".$denumire."', activ = 1";
				//die($query_insert);
				mysqli_query($conn,$query_insert);
				header("Location: home.php?insertCat=1");
		}	
	}
	
		/**
	 * inserare subcategorie
	**/
	function insertSubcat(){
			global $conn;
			$errors = array(); //array de erori
			if($_POST['denumire'] == ''){
				$errors[] = 'Completati campul Denumire subcategorie!';
			}
			if($_POST['categorie'] == '-'){
				$errors[] = 'Alegeti o categorie pentru aceasta subcategorie!';
			}
			
			//daca am erori le afisez
			if(!empty($errors)){ ?><!--daca nu am erori-parcurg array sa determin mesajul de completare-->
				<ul>
					<?php foreach ($errors as $key => $val){ ?>
						<li style="color:red;font-weight:bold;"><?php echo $errors[$key]; ?></li>	
					<?php } ?>
				</ul>
			<?php 
			} else{  //si tot daca nu am erori fac safe insert in tabela categorii
	
				$denumire = safe($_POST['denumire']);
				$categorie = safe($_POST['categorie']);
								
				$query_insert = "INSERT INTO subcategorii SET den_subcateg = '".$denumire."', id_categorie =".$categorie;
				//die($query_insert);
				mysqli_query($conn,$query_insert);
				header("Location: home.php?insertSubcat=1");
		}
		
	}
		/**
	 * inserare produs
	**/
	function insertProduct(){
			global $conn;
			$errors = array(); //array de erori
			if($_POST['denumire'] == ''){
				$errors[] = 'Completati campul Denumire produs!';
			}
			if($_POST['pret'] == ''){
				$errors[] = 'Completati campul Pret produs!';
			}
			if(!is_numeric($_POST['pret'])){
				$errors[] = 'Campul Pret produs trebuie sa fie numeric!';
			}
			if($_POST['pret'] < 0){
				$errors[] = 'Campul Pret produs trebuie sa aiba valori pozitive!';
			}
			if($_POST['den_subcateg'] == '-'){
				$errors[] = 'Alegeti o subcategorie pentru produs!';
			}
			
			//daca am erori le afisez
			if(!empty($errors)){ ?><!--daca nu am erori-parcurg array sa determin mesajul de completare-->
				<ul>
					<?php foreach ($errors as $key => $val){ ?>
						<li style="color:red;font-weight:bold;"><?php echo $errors[$key]; ?></li>	
					<?php } ?>
				</ul>
			<?php 
			} else{ //si tot daca nu am erori fac insert in tabela produse
				$denumire = safe($_POST['denumire']);
				$pret = safe($_POST['pret']);
				$cantitate = safe($_POST['cantitate']);
				$subcategorie = safe($_POST['subcategorie']);
				$data_in = date('Y-m-d H:i:s');
								
				$query_insert = "INSERT INTO produse SET denumire = '".$denumire."', pret = ".$pret.", cantitate =".$cantitate.", id_subcategorie= ".$subcategorie.",data_in = '".$data_in."', activ = 1";
				//die($query_insert);
				mysqli_query($conn,$query_insert);
				header("Location: home.php?insertProdus=1");
		}
		
	}
	
	//editare-update Categorie	
		function updateCat(){	
		global $conn;
		$errors = array(); //array de erori
		if($_POST['denumire_categorie'] == ''){
			$errors[] = 'Completati campul Denumire categorie!';
		}//daca am erori le afisez
		if(!empty($errors)){ ?>
			<ul class="errors">
				<?php foreach ($errors as $key => $val){ ?>
					<li><?php echo $errors[$key]; ?></li>	
				<?php } ?>
			</ul>
		<?php 
		} else{ //daca nu am erori fac update pentru categoria cu id-ul trimis in url si preluat prin GET
		
		
		$dencateg = safe($_POST['denumire_categorie']);
		$idcateg = safe($_POST['id_categorie']);
		//$data_in = date('Y-m-d H:i:s');
		$query_update = "UPDATE categorii SET denumire_categorie = '".$dencateg."' WHERE id_categorie = ".$_GET['id'];
		//$query_update .= "data_in = '".safe($data_in)."' WHERE id_subcategorie = ".$_GET['id_subcategorie'];
		//die($query_update);
		mysqli_query($conn,$query_update);
		header("Location: home.php?updateCat=1");
		
		}
		
	}
	
	//editare-update Subcategorie
	
		function updateSubcategorie(){	
		global $conn;
		$errors = array(); //array de erori
	//	if($_POST['id_subcategorie'] == ''){
	//		$errors[] = 'Completati campul id_ subcategorie!';
	//	}
		if($_POST['sub_categ'] == ''){
			$errors[] = 'Completati campul Denumire subcategorie!';
		}
	//			if($_POST['id_categorie'] == ''){
	//		$errors[] = 'Completati campul id_categorie!';
	//	}
		if($_POST['categorie'] == '-'){
			$errors[] = 'Alegeti o categorie pentru produs!';
		}

		//daca am erori le afisez
		if(!empty($errors)){ ?>
			<ul class="errors">
				<?php foreach ($errors as $key => $val){ ?>
					<li><?php echo $errors[$key]; ?></li>	
				<?php } ?>
			</ul>
		<?php 
		} else{ //daca nu am erori fac update pentru produsul cu id-ul trimis in url si preluat prin GET
		
		
		$densbcateg = safe($_POST['sub_categ']);
		$idcateg = safe($_POST['categorie']);
		//$data_in = date('Y-m-d H:i:s');
		$query_update = "UPDATE subcategorii SET den_subcateg = '".$densbcateg."', id_categorie = ".$idcateg." WHERE id_subcategorie = ".$_GET['id'];
		//$query_update .= "data_in = '".safe($data_in)."' WHERE id_subcategorie = ".$_GET['id_subcategorie'];
		//die($query_update);
		mysqli_query($conn,$query_update);
		header("Location: home.php?updateSubcategorie=1");
		
		}
		
	}
	/**
	 * editare-update produs
	**/
	function updateProduct(){	
		global $conn;
		$errors = array(); //array de erori
		if($_POST['denumire'] == ''){
			$errors[] = 'Completati campul Denumire produs!';
		}
		if($_POST['pret'] == ''){
			$errors[] = 'Completati campul Pret produs!';
		}
		if(!is_numeric($_POST['pret'])){
			$errors[] = 'Campul Pret produs trebuie sa fie numeric!';
		}
		if($_POST['pret'] < 0){
			$errors[] = 'Campul Pret produs trebuie sa aiba valori pozitive!';
		}
		if($_POST['categorie'] == '-'){
			$errors[] = 'Alegeti o categorie pentru produs!';
		}
		//daca am erori le afisez
		if(!empty($errors)){ ?>
			<ul class="errors">
				<?php foreach ($errors as $key => $val){ ?>
					<li><?php echo $errors[$key]; ?></li>	
				<?php } ?>
			</ul>
		<?php 
		} else{ //daca nu am erori fac update pentru produsul cu id-ul trimis in url si preluat prin GET
		
		$denumire = safe($_POST['denumire']);
		$pret = safe($_POST['pret']);
		$cantitate = safe($_POST['cantitate']);
		$categorie = safe($_POST['categorie']);
		$data_in = date('Y-m-d H:i:s');
		
		$query_update = "UPDATE produse SET denumire = '".$denumire."', pret = ".$pret.", cantitate = ".$cantitate.", id_subcategorie = ".$categorie.", ";
		$query_update .= "data_in = '".safe($data_in)."' WHERE id_produs = ".$_GET['id'];
		//die($query_update);
		mysqli_query($conn,$query_update);
		header("Location: home.php?updateProdus=1");
		
		}
		
	}
	

	/**
	 * listare detaliu produs
	**/
	function detaliuProdus(){
		global $conn;
		$query_list = "SELECT * FROM produse WHERE id_produs = ".safe($_GET['id']); //caut informatiile pentru produsul cu id-ul trimis in url si preluat prin GET
		$res_list= mysqli_query($conn,$query_list);
		global $prod;
		$prod = mysqli_fetch_assoc($res_list); //in variabila de tip array $prod pastrez informatiile din BD pt acest produs
		
	}
	/**
	 * listare detaliu Subcategorie
	**/
	function detaliuSubcategorie(){
		global $conn;
		$query_list = "SELECT * FROM subcategorii WHERE id_subcategorie = ".safe($_GET['id']); //caut informatiile pentru subcateg cu id-ul trimis in url si preluat prin GET
		$res_list= mysqli_query($conn,$query_list);
		global $subcateg;
		$subcateg = mysqli_fetch_assoc($res_list); //in variabila de tip array $subcateg pastrez informatiile din BD pt acest produs
		
	}
		/**
	 * listare detaliu categorie
	**/
	function detaliuCat(){
		global $conn;
		$query_list = "SELECT * FROM categorii WHERE id_categorie = ".safe($_GET['id']); //caut informatiile pentru categ cu id-ul trimis in url si preluat prin GET
		$res_list= mysqli_query($conn,$query_list);
		global $categ;
		$categ = mysqli_fetch_assoc($res_list); //in variabila de tip array $subcateg pastrez informatiile din BD pt acest produs
		
	}
	
	/**
	 * dezactivare produse
	**/
	function deactivateProduct(){	
		global $conn;
		$query_update = "UPDATE produse SET activ = 0 WHERE id_produs = ".$_GET['id']; //update la valoarea 0 a campului activ din BD
		//die($query_update);
		mysqli_query($conn,$query_update);//activez aceasta interogare de update pt dezactivare prin functia mysqli_query($conn,$query_update)
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}
	
	/**
	 * activare produse
	**/
	function activateProduct(){	
		global $conn;
		$query_update = "UPDATE produse SET activ = 1 WHERE id_produs = ".$_GET['id']; //update la valoarea 1 a campului activ din BD
		//die($query_update); 
		mysqli_query($conn,$query_update);//activez aceasta interogare de update pt activare prin functia mysqli_query($conn,$query_update)
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}
	
	/**
	 * stergere produse
	**/
	function deleteProduct(){
		global $conn;
		$query_del = "DELETE FROM produse WHERE id_produs = ".$_GET['id']; 
		//die($query_update);
		mysqli_query($conn,$query_del);//activez aceasta interogare de stergere prin functia mysqli_query($conn,$query_del)
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}

		/**
	 * dezactivare subcategorii
	**/
	function deactivateSubcat(){	
		global $conn;
		$query_update = "UPDATE subcategorii SET activ = 0 WHERE id_subcategorie = ".$_GET['id']; //update la valoarea 0 a campului activ din BD
		//die($query_update);
		mysqli_query($conn,$query_update);
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}
	
	/**
	 * activare subcategorii
	**/
	function activateSubcat(){	
		global $conn;
		$query_update = "UPDATE subcategorii SET activ = 1 WHERE id_subcategorie = ".$_GET['id']; //update la valoarea 1 a campului activ din BD
		//die($query_update); 
		mysqli_query($conn,$query_update);
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}
	
			/**
	 * stergere subcategorie
	**/
	function deleteSubcategorie(){
		global $conn;
		$query_del = "DELETE FROM subcategorii WHERE id_subcategorie = ".$_GET['id']; 
		//die($query_update);
		mysqli_query($conn,$query_del);
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}
	
			/**
	 * stergere categorie
	**/
	function deleteCat(){
		global $conn;
		$query_del = "DELETE FROM categorii WHERE id_categorie = ".$_GET['id']; 
		//die($query_update);
		mysqli_query($conn,$query_del);
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}
		/**
	 * dezactivare subcategorii
	**/
	function deactivateCat(){	
		global $conn;
		$query_update = "UPDATE categorii SET activ = 0 WHERE id_categorie = ".$_GET['id']; //update la valoarea 0 a campului activ din BD
		//die($query_update);
		mysqli_query($conn,$query_update);
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}
	
	/**
	 * activare categorii
	**/
	function activateCat(){	
		global $conn;
		$query_update = "UPDATE categorii SET activ = 1 WHERE id_categorie = ".$_GET['id']; //update la valoarea 1 a campului activ din BD
		//die($query_update); 
		mysqli_query($conn,$query_update);
		header("Location: ".$_SERVER['PHP_SELF']."");
		
	}
	
?>