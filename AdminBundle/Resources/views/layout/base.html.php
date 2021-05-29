<?php $view->extend('PsiAdminBundle:layout:default.html.php') ?>

<?php $view['UI']->start('_styles'); ?>
<link href="<?php echo $view['assets']->getUrl('css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo $view['assets']->getUrl('css/bootstrap-theme.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo $view['assets']->getUrl('css/pace.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo $view['assets']->getUrl('css/app.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo $view['assets']->getUrl('css/admin.css') ?>" rel="stylesheet" type="text/css" />
<?php $view['UI']->stop(); ?>

<?php $view['UI']->start('_scripts'); ?>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/jquery-3.2.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('js/app.js') ?>"></script>
<?php echo $view->render('PsiUIBundle:component:loader/js.html.php', []) ?>
<?php $view['UI']->stop(); ?>

<?php $view['UI']->start('_header') ?>
<div class="header">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#adminNav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="nav navbar-nav">
                    <?php if ($view['security']->isGranted('ROLE_ADMIN')): ?>
                        <?php
                        $links = [
                            'dashboard' => $router->generate('admin_dashboard_action'),
                            'system configuration' => $router->generate('configuration_index_action'),
                            'display users' => $router->generate('admin_user_list_action'),
                            'new user' => $router->generate('admin_user_new_action')
                        ];

                        ?>
                        <?php foreach ($links as $label => $href): ?>
                            <li>
                                <a href="#" onclick="AdminUI.loadContent('<?php echo $href; ?>')"><?php echo $label; ?></a>
                            </li>                    
                        <?php endforeach; ?>
                        <li>
                            <a href="<?php echo $view['router']->path('logout'); ?>">Logout</a>
                        </li>                    
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<?php $view['UI']->stop(); ?>

<?php $view['UI']->start('_content'); ?>
<script type="text/javascript">
    window.adminLoader = new loader($("#main-content"));
    adminLoader.start();
</script>
<?php $view['UI']->stop(); ?>

<?php $view['UI']->start('_footer_scripts'); ?>

<script type="text/javascript">
    window.AdminUI = {
        loadContent: function (url) {
            adminLoader.start();
            $.ajax(url, {

            }).done(function (data) {
                var newContent = $(data).filter('#main-content');
                $("#main-content").html(newContent.html());
            });
            return false;
        },
        submitForm: function (form) {
            adminLoader.start();
            var url = $(form).attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: $(form).serialize(),
                success: function (data)
                {
                    var newContent = $(data).filter('#main-content');
                    $("#main-content").html(newContent.html());
                }
            });
            return false;
        },
        editUser: function (id) {
            var baseUrl = "<?php echo $view['router']->path('admin_user_edit_action'); ?>";
            window.location = baseUrl + "/" + id;
        }
    };

    $(document).ajaxComplete(function () {
        adminLoader.stop();
        $elem = $(".messages");
        setTimeout(function () {
            $elem.fadeOut(250).queue(function (nxt) {
                $(this).remove();
                nxt();
            });
        }, 6000);
    });

    $(window).on("load", function () {
        adminLoader.stop();
    });

    $(document).ready(function () {
        $elem = $(".messages");
        setTimeout(function () {
            $elem.fadeOut(250).queue(function (nxt) {
                $(this).remove();
                nxt();
            });
        }, 6000);
    });

</script>
<?php $view['UI']->stop(); ?>
