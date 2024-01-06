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

  <div class="SumSorologinTitle">
    <h1 class="title">SumSoro</h1>
  </div>

  <div class="offcanvas-body">
    <p>Faça o seu registro ! </p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
         <label for = "email">Email</label>
         <input type = "email" name  = "email" placeholder="Digite o seu email">
         <label for = "password">Senha</label>
         <input type  = "password" name  = "password" placeholder  = "Registre a sua senha">
         
         <button type="submit" class="p-1 mb-1 bg-success text-white">Enviar</button>
    </form>

    <p>Já tem registro ? Entre <a href="login.php">aqui</a></p>

  </div>
  </div>
  </div>
  </nav>
  </header>

</body>

</html>