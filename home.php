<?php
require_once('settings.php');
require_once('template.php');
session_start();
Template::showHeader('View Your Favorite Team\'s Roster');
?>
  <body>
    <div class="list-group">
  <a href="index.php?id=1" class="list-group-item list-group-item-action">Cincinnati Bengals</a>
  <a href="index.php?id=2" class="list-group-item list-group-item-action">Arizona Cardinals</a>
</div>
</body>
<?php
Template::showFooter();
?>