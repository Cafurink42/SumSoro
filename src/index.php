<?php
// Inicialize a sessão
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daniel Guth">
    <meta name="description" content="SumSoro é uma ferramenta que ajuda operadores e analistas a fazerem calculos de producação e relatórios">
    <meta name="keywords" content="SumSoro, sumsoro, ferramenta, calculos, produção, soro">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" href="SumSoroIcons/sumsoroicon.jpg">
    <link rel="manifest" href="manifest.json">
    <style>
        #buttonLogout{
            border: none;
            background-color: transparent;
            color: red;
        }
    </style>

    <title>SumSoro</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-expand-lg">
        <a class="navbar-brand" href="#">Navbar</a>

        <a class="navbar-toggler" href = "logout.php" id  = "buttonLogout">
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
               <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
               <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
             </svg>
         </a>
   
  

        </div>
    </nav>

    <div class="Initial-Front">
        <h1 class="title">SumSoro</h1>
        <br>
        <br>
        <p class="text_form">Entrada de soro</p>
        <input type="number" placeholder="Digite o volume de soro" class="input" min=0 title="Digite a quantidade de soro desejada" id="input_area">
        <br>
        <br>
        <button id="button-done" class="custom-buttonDone" alt="botão salva valor">
            <span class="material-symbols-outlined" id="button_done">check</span>
        </button>
        <button id="button-doneAll" class="custom-buttonDoneAll" title="Salvar volume">
            <span class="material-symbols-outlined" id="button_done_all">done_all</span>
        </button>

        <a href="logout.php">logout</a>

    </div>
    <div class="output-qtd" id="qtd">


    </div>

    <!--  <footer class = "footer">
      <img class  = "icon-sumsoro" src = "SumSoroIcons/sumsoroicon.jpg"  title  ="SumSoroIcone"> 
        <p>Versão 1.0</p>
    </footer>
  -->
    <script src="./script.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</body>

</html>