<?php

//n linkyw l base lel form
define("SERVEUR","localhost");
define("USER","root");
define("MDP","");
define("NOMBASE","bet");

$conn=mysqli_connect(SERVEUR,USER,MDP,NOMBASE);
if(mysqli_connect_errno())
{
   echo"echec de la connexion";
   exit();
}


//bech net2akdou li ken l method li tebaath byha l form hya post, bech les dns yebdew mab3outhin mel form mech men another source
if($_SERVER["REQUEST_METHOD"]=="POST"){
  //ken jawha behy nlancyw array bech n stockyw fyh el eerrors lkool
  $errors=[];

  //n verifyw e champ mtaa name
  if(isset($_POST["name"])){
  $name=$_POST["name"];}else{
    $name="";
  }
  if (strlen($name)<2 || strlen($name)>20)
  {
    $errors[]="le nom doit etre entre 2 et 20 caractères";
  }

  //tawika nvaldou champ mtaa l age
  if (isset($_POST["age"])){
    $age=intval($_POST["age"]);// t recuperyha o tconvertyha ll numberzzz
  }else{
    $age=0;
  }
  if($age<12||$age>120){
    $errors[]="l'age doit etre en 12 et 120";
  }

  //el maill
  if (isset($_POST["email"])) {
    $email = trim($_POST["email"]); // e trim chetnahy l spaces l mawjoudin bin les caracteres
} else {
    $email = ""; 
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //filter_var +  FILTER_VALIDATE_EMAILt verifier ken l e-mail andou un format valide
    $errors[] = "Adresse email non valide"; 
}

//el mdp, akthe rhaja sécuriséeeee
$password = isset($_POST["Password"]) ? $_POST["Password"] : "";
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
    }

//nimrou e telifoun dyelna
if (isset($_POST["phone"])) {
  $phone = trim($_POST["phone"]); 
} else {
  $phone = ""; 
}
if (strlen($phone) != 8 || !is_numeric($phone)) { 
  $errors[] = "Le numéro de téléphone doit contenir exactement 8 chiffres"; 
}

// Récupérer et valider la latitude et la longitude
if (isset($_POST["latitude"])) {
  $latitude = floatval($_POST["latitude"]);
} else {
  $latitude = 0;
}

if (isset($_POST["longitude"])) {
  $longitude = floatval($_POST["longitude"]);
} else {
  $longitude = 0;
}

// Vérifier la validité de la latitude et de la longitude (optionnel)
if ($latitude < -90 || $latitude > 90) {
  $errors[] = "La latitude doit être entre -90 et 90.";
}
if ($longitude < -180 || $longitude > 180) {
  $errors[] = "La longitude doit être entre -180 et 180.";
}

if (empty($errors)) {
  echo "<h2>Données reçues :</h2>";
  echo "<p><strong>Nom :</strong> $name</p>";
  echo "<p><strong>Âge :</strong> $age</p>";
  echo "<p><strong>Email :</strong> $email</p>";
  echo "<p><strong>Mot de passe :</strong> (sécurisé)</p>";
  echo "<p><strong>Téléphone :</strong> $phone</p>";
  
  echo "<p><strong>Latitude :</strong> $latitude</p>";
  echo "<p><strong>Longitude :</strong> $longitude</p>";
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // nhotou les donnees fl bd
  $req = "INSERT INTO users (name, age, email, password, phone, latitude, longitude) 
        VALUES ('$name', $age, '$email', '$hashed_password', '$phone', '$latitude', '$longitude')";
  
  if (mysqli_query($conn, $req)) {
      echo "Données enregistrées avec succès !";
  } else {
      echo "Erreur lors de l'enregistrement des données : " . mysqli_error($conn);
  }
} else {
  echo "<h2>Erreurs de validation :</h2><ul>";
  foreach ($errors as $error) {
      echo "<li>$error</li>";
  }
  echo "</ul>";
}

}


mysqli_close($conn);

?>
