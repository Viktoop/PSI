<?php $view->extend('PsiAdminBundle:layout:base.html.php') ?>

<?php $view['UI']->start('_content') ?>

<div id="ad-bckgrnd"></div>
<h2>Welcome <?php echo $user->getEmail(); ?></h2>
<div id="ad-menu">
  <div id="ad-sysconfig">
    <a href="#" onclick='AdminUI.loadContent("<?php echo $router->generate('configuration_index_action'); ?>")'>
      <span></span>
    </a>
    system <br>configuration
  </div>
  <div id="ad-displayusers">
    <a href="#" onclick='AdminUI.loadContent("<?php echo $router->generate('admin_user_list_action'); ?>")'>
      <span></span>
    </a>
    display <br>users
  </div>
  <div id="ad-newuser">
    <a href="#" onclick='AdminUI.loadContent("<?php echo $router->generate('admin_user_new_action'); ?>");'>
      <span></span>
    </a>
    new <br>user
  </div>
</div>

<?php $view['UI']->stop(); ?>
