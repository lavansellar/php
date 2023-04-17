<div class="blue">
        <h1>Mini Twitter</h1>
    </div>

<ul class="nav">
        <li><a href="index.php">Accueil</a></li>
        <?php if(!isset($_SESSION['connected'])){ ?>
        <li><a href="login.php">Se connecter</a></li>
        <li><a href="register.php">S'inscrire</a></li>
        <?php } ?>
        <?php if(isset($_SESSION['connected'])){ ?>
        <li><a href="logout.php">Se déconnecter</a></li>
        <?php } ?>
      </ul>