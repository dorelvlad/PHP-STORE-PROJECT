<?php
	require("functions.php");//includ functiile
	require("header.php");///includ header-ul paginii
	//login utilizator
	if(isset($_POST['submit'])){ //daca a fost apasat butonul de submit al formularului
		$email = mysqli_real_escape_string($conn,$_POST['email_app']); //preiau ce s-a introdus in campul email si curat cu functia mysqli_real_escape_string
		$parola = mysqli_real_escape_string($conn,$_POST['pass_app']); //preiau ce s-a introdus in campul parola si curat cu functia mysqli_real_escape_string
		$query_useri = "SELECT * FROM users WHERE email = '".$email."'"; //caut din tabela users daca exista un user cu emailul introdus in formularul de login
		$res_useri = mysqli_query($conn,$query_useri);///fac o interogare in BD pentru e-mailul cautat -obtin un rezultat de tip resursa
		if($rand = mysqli_fetch_assoc($res_useri)){ //creez array-ul in urma inteorgarii tabelei users (doar daca am gasit o inregistrare - boolean true)
			$email = $rand['email']; //in variabila $email avem acum valoarea din baza de date
			$query_useri2 = "SELECT * FROM users WHERE email = '".$email."'"; //mai fac un query pe users, unde email = emailul gasit in BD -de aceasta data obtin un rezultat sigurr pt ca stiu deja ca acest email e in BD
			$res_query2 = mysqli_query($conn,$query_useri2);//obtin rezultat de tip resursa
			$rand2 = mysqli_fetch_array($res_query2); // in $rand2 am array-ul asociativ cu rezultatele interogarii din users
			if(md5($parola) == $rand2['parola']) { //verific daca criptarea md5 a parolei introduse in formular este egala cu parola din baza de date care este introdusa md5
				$_SESSION['logat']=1; //setez o variabila pe sesiune ca sa stiu pe fiecare pagina daca sunt logat
				$_SESSION['email'] = $rand2['email']; //pastrez emailul intr-o variabila pe sesiune
				$_SESSION['nume'] = $rand2['nume']; //pastrez numele userului din baza de date pe sesiune
				//$_SESSION['start'] = time(); 
				//$_SESSION['expire'] = $_SESSION['start'] + (30 * 60) ; //sesiunea expira in 30 de minute
				header("Location: home.php"); //daca a fost login cu succes, am setat variabilele pe sesiune si fac redirectionare catre pagina home.php
			}
			else {echo "<p style='color:red;font-weight:bold;'> Parola incorecta!</p>"; $_SESSION['logat']=0;} //daca parola introdusa nu e corecta afisez un mesaj de eroare si setez superglobala de $_session ['logat']=0
			
		}
		else echo "<p style='color:red;font-weight:bold;'>E-mail neidentificat!</p>"; //daca emailul nu este in BD afisez un mesaj de eroare
	}

	//urmeaza formularul de login cu action chiar in pagina aceasta pentru ca aici se fac prelucrarile informatiilor din formular
?>
	
		<form action="index.php" method="post">
			<table>
				<tr>
					<td><label for="email">Email</label></td>
					<td><input type="text" name="email_app" id="email" value="" /></td>
				</tr>
				<tr>
					<td><label for="pass">Parola</label></td>
					<td><input type="password" name="pass_app" id="pass" value="" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Login" />
					</td>
				</tr>
			</table>
		</form>
	
<?php
	
	
	require("footer.php"); //includ footer-ul paginii
?>