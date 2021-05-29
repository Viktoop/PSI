<?php $view->extend('PsiAppBundle:layout:base.html.php') ?>

<?php $view['UI']->start('_content') ?>

<div class="success-message-wrapper">
    <span><?php echo $message; ?></span>
    <span>You will be redirected to the home page in 5 seconds.</span>
    <script type="text/javascript">
        setTimeout(function() {
            window.location = "<?php echo $router->generate('app_index_action'); ?>";
        }, 5000);
    </script>
</div>

<?php $view['UI']->stop(); ?>