<?php 
session_start();
include('dbconnection.php');

//Code for Registration
if(isset($_POST['signup']))
{
	
	
	$Nom=$_POST['nom'];
	$Prénom=$_POST['prénom'];
	$Cycle=$_POST['cycle'];
	$Filière=$_POST['filière'];
	$Niveau=$_POST['niveau'];
	$Sexe=$_POST['sexe'];
	
	$Date_Naissance=$_POST['date_Naissance'];
	$Date_inscription=$_POST['date_inscription'];
	$Email=$_POST['email'];
	$Mot_passe=$_POST['mot_passe'];
	$enc_password=$Mot_passe;
	
	
   
$sql=mysqli_query($conn,"SELECT Matricule FROM table1 WHERE Email='$Email'");
$row=mysqli_num_rows($sql);
if($row>0)
{
	echo "<script>alert('Changez votre email svp!');</script>";
} else{
	$msg=mysqli_query($conn,"insert into table1 (Nom,Prenom,Cycle,Filiere,Niveau,Sexe,Date_Naissance,Date_inscription,Email,Mot_passe) values('$Nom','$Prénom','$Cycle','$Filière','$Niveau','$Sexe','$Date_Naissance','$Date_inscription','$Email','$Mot_passe')");

if($msg)
{
	echo "<script>alert('Vous etes inscrit');</script>";
}
}
}

				
// Code for login 
if(isset($_POST['login']))
{
$password=$_POST['password'];
$dec_password=$password;
$useremail=$_POST['uemail'];
$ret= mysqli_query($conn,"SELECT * FROM table1 WHERE Email='$useremail' and Mot_passe='$dec_password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="welcome.php";
$_SESSION['login']=$_POST['uemail'];
$_SESSION['id']=$num['Matricule'];
$_SESSION['name']=$num['Prénom'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
echo "<script>alert('Email ou mot de passe invalide');</script>";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//header("location:http://$host$uri/$extra");
exit();
}
}

//Code for Forgot Password

if(isset($_POST['send']))
{
$femail=$_POST['femail'];

$row1=mysqli_query($conn,"select Email,Mot_passe from table1 where Email='$femail'");
$row2=mysqli_fetch_array($row1);
if($row2>0)
{
$email = $row2['email'];
$subject = "Information about your password";
$password=$row2['password'];
$message = "Your password is ".$password;
mail($email, $subject, $message, "From: $email");
echo  "<script>alert('Votre mot de passe est changé');</script>";
}
else
{
echo "<script>alert('Votre email est non enegistré ');</script>";	
}
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Inscription à l'INSEA</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Elegent Tab Forms,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements"./>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</script>
<script src="js/jquery.min.js"></script>
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
				<script type="text/javascript">
					$(document).ready(function () {
						$('#horizontalTab').easyResponsiveTabs({
							type: 'default',       
							width: 'auto', 
							fit: true 
						});
					});
				   </script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700,200italic,300italic,400italic,600italic|Lora:400,700,400italic,700italic|Raleway:400,500,300,600,700,200,100' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="main">
		<h1>Inscription à l'INSEA </h1>
	 <div class="sap_tabs">	
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
			  <ul class="resp-tabs-list">
			  	  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><div class="top-img"><img src="images/top-note.png" alt=""/></div><span>S'inscrire</span>
			  	  	
				</li>
				  <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><div class="top-img"><img src="images/top-lock.png" alt=""/></div><span>S'identifier</span></li>
				  <li class="resp-tab-item lost" aria-controls="tab_item-2" role="tab"><div class="top-img"><img src="images/top-key.png" alt=""/></div><span>Mot de passe oublié</span></li>
				  <div class="clear"></div>
			  </ul>		

			  
			  	 
			<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
					<div class="facts">
					
						<div class="register">
							<form name="registration" method="post" action="index.php" enctype="multipart/form-data">
								<form name="registration" action="upload.php"  method="post"  enctype="multipart/form-data">
								<p>Photo: </p>
								<input type="file" name="fileToUpload" id="fileToUpload" required>
                                
								<p>Nom: </p>
								<input type="text" class="text" value=""  name="nom" required >
								<p>Prénom:</p>
								<input type="text" class="text" value="" name="prénom"  required >
								
								<p>Cycle:</p><SELECT name ="cycle" >
                                <OPTION> Ingénieurs d'état</OPTION>
                                <OPTION> Master</OPTION>
                                <OPTION>Doctorat</OPTION>
			                    </SELECT>
								
								<p>Filière:</p>
				                <SELECT name ="filière" >
                                <OPTION> Actuariat-Finance</OPTION>
                <OPTION>  Statistique-Economie Appliquée</OPTION>
                <OPTION>Statistique-Démographie</OPTION>
                <OPTION> Recherche Opérationnelle et Aide à la Décision </OPTION>
                <OPTION> Ingénierie des Données et des Logiciels</OPTION>
                <OPTION>Science des Données</OPTION>
				</SELECT>
				
				<p>Niveau:</p>
				<input type="radio" name="niveau" value="1A" required>1A 
                <input type="radio" name="niveau" value="2A" required>2A 
				<input type="radio" name="niveau" value="3A" required>3A 

				
				<p>Date de naissance:</p>
				<input type="date" id="date" name="date_Naissance" required placeholder="YYYY/MM/DD">
                
				<p>Date d'inscription:</p>
				<input type="date" id="date" name="date_inscription" required placeholder="YYYY/MM/DD">
				
				<p>Sexe:</p>
				<input type="radio" name="sexe" value="F" required >Feminin 
                <input type="radio" name="sexe" value="M" required>Masculin
				
								
				<form name="registration" action="up.php"  method="post"  enctype="multipart/form-data">
								<p>Copie de la CIN: </p>
								<input type="file" name="fileUpload" id="fileUpload" required>
                                
								
				<form name="registration" action="upl.php"  method="post"  enctype="multipart/form-data">
								<p>Copie du Baccalauréat: </p>
								<input type="file" name="fileToUp" id="fileToUp" required>
                               
								
				<form name="registration" action="uplo.php"  method="post"  enctype="multipart/form-data">
								<p>Attestation de réussite(CNC,DEUGS ou Licence): </p>
								<input type="file" name="fileUplo" id="fileUplo" required>
                               
								
								<p>Email: </p>
								<input type="text" class="text" value="" name="email" required  >
								<p>Mot de passe : </p>
								<input type="password" value="" name="mot_passe" required>
										
								<div class="sign-up">
									<input type="reset" value="Réinitialiser">
									<input type="submit" name="signup"  value="s'inscrire" >
									<form action="nextpage.php" method="POST">
 
									
									<div class="clear"> </div>
								</div>
							</form>

							<form action="list.php" method="POST">
                            <input type="submit" value="Afficher la liste"/>
                            </form>

						</div>
					</div>
				</div>		
			 <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
					 	<div class="facts">
							 <div class="login">
							<div class="buttons">
								
								
							</div>
							<form name="login" action="index.php" method="post">
								<input type="text" class="text" name="uemail" value="" placeholder="Entrez votre email"  ><a href="#" class=" icon email"></a>

								<input type="password" value="" name="password" placeholder="Entrez un mot de passe valide"><a href="#" class=" icon lock"></a>

								<div class="p-container">
								
									<div class="submit two">
									<input type="submit" name="login" value="S'identifier" >
									</div>
									<div class="clear"> </div>
								</div>

							</form>
					</div>
				</div> 
			</div> 			        					 
				 <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
					 	<div class="facts">
							 <div class="login">
							<div class="buttons">
								
								
							</div>
							<form name="login" action="index.php" method="post">
								<input type="text" class="text" name="femail" value="" placeholder="Entrez votre email" required  ><a href="#" class=" icon email"></a>
									
										<div class="submit three">
											<input type="submit" name="send" onClick="sendEmail()" value="Envoyer l'email" >
										</div>
									</form>
									</div>
				         	</div>           	      
				        </div>	
				     </div>	
		        </div>
	        </div>
	     </div>

</body>
</html>