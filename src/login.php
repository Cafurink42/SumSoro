<?php
session_start();


if (isset($_SESSION["loggdin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.html");
  exit;
}

require_once("connection.php");



$useremail = $password = "";

$username_err = $password_err = $login_err = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {



  if (empty(trim($_POST["email"]))) {
    $useremail_err = "Por favor, inisira o seu email.";
  } else {
    $useremail = trim($_POST["email"]); //trim remove espaço em branco

  }

  if (empty(trim($_POST["password"]))) {
    $password_err  = "Por favor, insira a sua senha.";
  } else {
    $password = trim($_POST["password"]);
  }

  //validação das credenciais


  if (empty($useremail_err) && empty($password_err)) {


    $sql = "SELECT id_user, emailverification, password FROM users WHERE emailverification = :emailverification";


    if ($stmt = $pdo->prepare($sql)) {

      $stmt->bindParam(":emailverification", $param_email, PDO::PARAM_STR); //vinculação de variaveis para serem tratas com sql


      $param_email = trim($_POST["email"]);


      if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
          if ($row = $stmt->fetch()) {
            $id = $row["id_user"];
            $useremail = isset($row["email"]);
            $password_hash = $row["password"];

            if (password_verify($password, $password_hash)) {


              session_start();
              //armazenando variaveis da sessão

              $_SESSION["loggedin"] = true;
              $_SESSION["id_user"] = $id;
              $_SESSION["email"] = $useremail;


              header("location:index.html");
            } else {
              $login_error = "Email ou senha incorretas";
            }
          }
        } else {
          echo "Ops ! Algo deu errado. Por favor, tente novamente mais tarde.";
        }

        //deixamos indefinida a variavel stmt
        unset($stmt);
      }
    }
  }
  //deixamos indefinida a pdo
  unset($pdo);
}


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Daniel Guth">
  <meta name="description" content="SumSoro é uma ferramenta que ajuda operadores e analistas a fazerem calculos de producação e relatórios">
  <meta name="keywords" content="SumSoro, sumsoro, ferramenta, calculos, produção, soro">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link href="./variables.scss">
  <link rel="icon" href="SumSoroIcons/sumsoroicon.jpg">
  <link rel="manifest" href="manifest.json">
  <style>
    body {
      background-color: gainsboro;
    }
  </style>
</head>

<body>
  <header>

    <nav class="navbar fixed-top card text-bg-light p-3">
      <div class="container-fluid">
        <a class="navbar-brand"></a>
        <span class="SumSorologinTitle">
          <h1 class="title">SumSoro</h1>
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8m-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5" />
          </svg>
          Login
        </button>
        <div class="offcanvas offcanvas-end bg-body-secondary" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
            <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <p>Faça o seu login</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="form-group">
                <label for="exampleInputEmail1">Enderço de email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">Seu email nunca será compartilhado com ninguém.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="password">
              </div>
              <br>
              <p>Registre-se: <a href="register.php">aqui</a></p>
              <br>
              <button type="submit" class="p-1 mb-1 bg-success text-white">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </nav>
  </header>


  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.silocc.com.au%2Fwp-content%2Fuploads%2F2019%2F03%2FIMG_1454.jpg&f=1&nofb=1&ipt=228874f321bad5ee3dfb169c1a029f16c5f3fc0e95c7d8947c73a1c371f7694d&ipo=images" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.silocc.com.au%2Fwp-content%2Fuploads%2F2019%2F03%2FIMG_1454.jpg&f=1&nofb=1&ipt=228874f321bad5ee3dfb169c1a029f16c5f3fc0e95c7d8947c73a1c371f7694d&ipo=images" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.silocc.com.au%2Fwp-content%2Fuploads%2F2019%2F03%2FIMG_1454.jpg&f=1&nofb=1&ipt=228874f321bad5ee3dfb169c1a029f16c5f3fc0e95c7d8947c73a1c371f7694d&ipo=images" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div class="card text-center">
    <div class="card-header">
      Featured
    </div>
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer text-body-secondary">
      2 days ago
    </div>
  </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</html>