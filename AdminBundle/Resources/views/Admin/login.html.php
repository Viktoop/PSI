<?php $view->extend('PsiAdminBundle:layout:base.html.php') ?>

<?php $view['UI']->start('_content') ?>
<div id="al-bckgrnd"></div>
<?php echo $view['form']->form($form) ?>
<?php $view['UI']->stop(); ?>
