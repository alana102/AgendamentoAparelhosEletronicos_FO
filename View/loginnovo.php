<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tela de Login</title>
    <link rel="stylesheet" href="estilonovo.css"/>
    <link rel="icon" type="image/png" href="Assets/IMG/login.ico">
  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form action="../Controller/loginprof.php" method="POST" autocomplete="off" class="sign-in-form">
              <div class="logo">
                <img src="images/logo3.png" alt="easyclass" />
                <h4>Agendamentos</h4>
              </div>

              

              <div class="heading">
              
                <h2>Login Professor
                </h2>
                <?php
                        if (isset($_SESSION['nao_autenticado'])) :
                        ?>
                            <div class="notification is-danger">

                                <SCRIPT LANGUAGE='JavaScript'>
                                     window.alert('Usuário ou senha inválidos! Tente novamente!')
                                     window.location.href = '#';
                                   
                                </SCRIPT>



                            </div>
                        <?php
                        endif;
                        unset($_SESSION['nao_autenticado']);
                        ?>
                <h6>Deseja logar como Admin?</h6>
                <a href="#" class="toggle">Clique aqui</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    
                    class="input-field"
                    autocomplete="off"
                    required
                    name="loginprof"
                  />
                  <label>Login</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    
                    class="input-field"
                    autocomplete="off"
                    required
                    name="senhaprof"
                  />
                  <label>Senha</label>
                </div>

                <input type="submit" value="Entrar" class="sign-btn" />

               
              </div>
            </form>

            <form action="../Controller/login.php" method="POST" autocomplete="off" class="sign-up-form">
              <div class="logo">
                <img src="images/logo3.png" alt="easyclass">
                <h4>Agendamentos</h4>
              </div>

              <div class="heading">
                <h2>Login Administrador</h2>
                <?php
                        if (isset($_SESSION['nao_autenticado'])) :
                        ?>
                            <div class="notification is-danger">

                                <SCRIPT LANGUAGE='JavaScript'>
                                     window.alert('Usuário ou senha inválidos! Tente novamente!')
                                     window.location.href = '../View/login.php';
                                  
                                </SCRIPT>



                            </div>
                        <?php
                        endif;
                        unset($_SESSION['nao_autenticado']);
                        ?>
                <h6>Deseja logar como Professor?</h6>
                <a href="#" class="toggle">Clique aqui</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                   
                    class="input-field"
                    autocomplete="off"
                    required
                    name="login"
                  />
                  <label>Login</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    
                    class="input-field"
                    autocomplete="off"
                    required
                    name="senha"
                  />
                  <label>Senha</label>
                </div>

                <input type="submit" value="Entrar" class="sign-btn" />
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="images/1.png" class="image img-1 show" alt="" />
              <img src="images/2.png" class="image img-2" alt="" />
              <img src="images/3.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Organização</h2>
                  <h2>Cuidado</h2>
                  <h2>Praticidade</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->

    <script src="app.js"></script>
   

  </body>
</html>
