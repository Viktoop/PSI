<?php $view->extend('PsiAdminBundle:layout:base.html.php') ?>

<?php $view['UI']->start('_content') ?>
<div id="anu-bckgrnd"></div>
<div class="anu-container">
<?php echo $view['form']->form($form) ?>
<?php $view['UI']->stop(); ?>
