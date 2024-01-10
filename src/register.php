<?php
require_once("connection.php");

$useremail = $password = $confirm_password = "";
$useremail_err = $password_err = $confirm_password_err = "";



if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim(isset($POST["email"])))){
    $useremail_err = "Por favor, insira um email válido.";

  }else{
    $sql = "SELECT id_user FROM users WHERE emailverification = :emailverification";

    if ($stmt =  $pdo->prepare($sql)){
      $stmt->bindParam(":emailverification", $param_email, PDO::PARAM_STR);

      $param_email = trim($POST["email"]);


      if ($stmt-> execute()){
        if ($stmt->rowCount()==1){
          $useremail_err  = "Este email já se encontra em uso";
        }else{
          $useremail = trim($POST['email']);
        }
      }else{
        echo "Algo deu errado. Tente novamente mais tarde.";
      }

      unset($stmt);
    }
  }

  if(empty(trim(isset($POST["password"])))){
    $password_err = "Por favor insira uma senha.";

  }elseif(strlen(trim($POST["password"])) < 6){
    $password_err = "A senha deve ter pelo menos 6 caracteres !";
  }else{
    $password = trim($POST["password"]);
  }

  if (empty(trim(isset($POST["confirm_password"])))){
    $confirm_password_err = "Por favor, confirme sua senha.";

  }else{
    $confirm_password = trim($POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password)){
      $confirm_password_err = "A senha não está conferindo.";
    }
  }


  if(empty($useremail_err) && empty($password_err) && empty($confirm_password_err)){
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";


    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
      $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

      $option_cost = [
        'cost' => 12,
      ];

      $param_email = $useremail;
      $param_password = $password_hash($password, PASSWORD_BCRYPT, $option_cost);


      if($stmt->execute()){
        header("location:login.php");
      }else{
        echo "Opa ! Algo deu errado. Por favor, tente novamente.";
      }
      unset($stmt);

    }
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SumSoro Register</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link href="./variables.scss">
  <link rel="icon" href="SumSoroIcons/sumsoroicon.jpg">
  <link rel="manifest" href="manifest.json">
</head>

<body>


  <h2 class="col-md-3 mx-auto">Área de registro: </h2>
  <div class="col-md-3 container d-flex align-items-center" style="min-height: 50vh;">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <label for="email">Email</label>
      <input class = "<?php echo (!empty($useremail_err)) ? 'is-invalid' : ''; ?>"type="email" name="useremail" placeholder="Digite o seu email">
      <br>
      <br>
      <label for="password">Senha</label>
      <input type="password" name="password" placeholder="Registre a sua senha">
      <br>
      <label for = "confirm_password">Confirmar Senha</label>
      <input type  = "password" name = "confirm_password">
      <br>
      <button type="submit" class="p-1 mb-1 bg-success text-white">Registrar-se</button>
    </form>
    <p>Já tem registro ? Entre <a href="login.php">aqui</a></p>

  </div>
 



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
  </script>
</body>

</html>