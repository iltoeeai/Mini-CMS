<?php

require_once "bootstrap.php";
include "head.html";

// $pages = $entityManager->getRepository('Page')->findAll();

?>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">Mini CMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <?php
        foreach ($pages as $p) {
          echo '<li class="nav-item active"> <a class="nav-link" href="page?content=' . $p->getId() . '"> '
            . $p->getTitle() . ' </a></li>';
        }
        if ($_SESSION['valid']) {
          echo '<li class="nav-item active"><a class="nav-link" href="cont_manager">Content Manager</a> </li>';
        }
        ?>
      </ul>
      <div class="d-flex">
        <?php
        if ($_SESSION['valid']) {
          echo '<button type="button" class="btn btn-light"> <a href="logout"> Logout </a></button></div>';
        } ?>
      </div>
  </nav>
</header>
<main class="container mt-5" style="position: relative">