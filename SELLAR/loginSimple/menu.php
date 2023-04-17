

<?php

session_start();

$nav = [['label' => 'Home', 'href' => 'index.php'], 
        ['label' => 'Connexion', 'href' => 'login.php'],
        ['label' => 'Réservé', 'href' => 'reserve.php'],
        ['label' => 'Déconnexion', 'href' => 'logout.php']];
    ;



        ?>

<ul>
<?php
foreach($nav as $link){
    

    ?>  <li><a href="<?php echo $link['href'] ?>"><?php echo $link['label'] ?></a></li>  <?php
}





?> 
</ul>

