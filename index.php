<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">
    
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>  
  <body>
    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">
      <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
      ?>
    </div>
    <?php endif ?>

    <div class="container mt-3">
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $resultado = $mysqli->query("SELECT * FROM dados") or die($mysqli->error);
        //pre_r($resultado);
    ?>

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cidade</th>
                    <th colspan="2">Ação</th>
                </tr>
            </thead>
            <?php while ($linha_banco = $resultado->fetch_assoc()): ?>
                  <tr>
                      <td><?php echo $linha_banco['nome']; ?></td>
                      <td><?php echo $linha_banco['cidade']; ?></td>
                      <td>
                          <a href="index.php?edit=<?php echo $linha_banco['id']; ?>" class="btn btn-info">Editar</a>
                          <a href="process.php?delete=<?php echo $linha_banco['id']; ?>" class="btn btn-danger">Excluir</a>
                      </td>
                  </tr>
                  <?php endwhile; ?>
          </table>
    </div>

    <?php
        function pre_r( $array ) {
          echo '<pre>';
          print_r($array);
          echo '</pre>';
        }
    ?>

    <div class="row justify-content-center">
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
        <label for="address" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>" placeholder="Digite seu nome">
        </div>
        <div class="form-group">
        <label for="address" class="form-label">Cidade</label>
        <input type="text" name="cidade" class="form-control" value="<?php echo $cidade; ?>" placeholder="Digite sua cidade">
        </div>
        <div class="form-group">
        <?php
        if ($atualizar == true): 
        ?>
          <button type="submit" class="btn btn-info" name="atualizar">Atualizar</button>
        <?php else: ?>
          <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
        <?php endif; ?>
        </div>
     </form>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017–2021 Company Name</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
  </footer>
          
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  </body>
</html>