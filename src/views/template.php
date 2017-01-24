<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $styleSheetURL; ?>" />
    <title>Lettres latines</title>
  </head>

  <body>

   <div class="header">
      <h1><?php echo $title; ?></h1>
    </div>

    <div class="menu">
      <?php
        $nbItemsLeft = count($menu);
        foreach ($menu as $link => $text) {
          echo "<a href=\"" . $link . "\">" . $text . "</a>";
          $nbItemsLeft--;
          if ($nbItemsLeft != 0) // all items but last one
            echo " | ";
        }
        echo $logbox;
      ?>
    </div>

    <div class="content">
      <?php echo $content; ?>
    </div>

  </body>

</html>
