<?php $view->extend('PsiAppBundle:layout:base.html.php') ?>

<?php $view['UI']->set('title', 'Login') ?>

<?php $view['UI']->start('_scripts'); ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.12.1.min.js"></script>
<?php $view['UI']->stop(); ?>

<?php $view['UI']->start('_content') ?>
<script type="text/javascript">
    
    window.toggleSection = function(section) {
        $(".section-tab").hide(0);
        var $section = $("." + section + "-container");
        $section.stop().show(0);
        $section.removeClass("hidden");
    }

</script>

<div id="lsp-bckgrnd"></div>
<div class="lsp-container">
    <div class="btn-group" data-toggle="buttons">
        <label onclick="toggleSection('login');" class="btn btn-primary active">
            <input  type="radio" name="options" id="option1" checked>Log In</input>
        </label>
        <label onclick="toggleSection('signup');" class="btn btn-primary">
            <input  type="radio" name="options" id="option2">Sign Up</input>
        </label>
        <label onclick="toggleSection('passchange');" class="btn btn-primary">
            <input  type="radio" name="options" id="option3">Password Change</input>
        </label>
    </div>
    <?php echo $view->render("PsiUserBundle:Account:_partial/register.html.php", ['action' => $router->generate('user_register_action')]); ?>
    <?php echo $view->render("PsiUserBundle:Account:_partial/login.html.php", ['action' => $router->generate('user_login_action')]); ?>
    <?php echo $view->render("PsiUserBundle:Account:_partial/forgot_password.html.php", ['action' => $router->generate('user_reset_action')]); ?>
    <?php $view['UI']->stop(); ?>
</div>