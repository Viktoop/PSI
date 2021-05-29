<?php $view->extend('PsiAdminBundle:layout:base.html.php') ?>

<?php $view['UI']->set('title', 'Configurations') ?>

<?php $view['UI']->start('_content') ?>

<div id="ac-bckgrnd"></div>
<?php $configurationData = $configurationRegistry->getConfigurationGroups(); ?>
<form action="<?php echo $action; ?>" method="POST" onSubmit="AdminUI.submitForm(this); return false;">
    <button class="btn btn-primary" type="submit">Update configuration</button>
    <div class="configuration-wrapper">
        <ul class="nav nav-tabs" role="tablist">

            <?php foreach (array_keys($configurationData) as $index => $group): ?>
                <li role="presentation" <?php echo (!$index) ? 'class="active"' : ''; ?>>
                    <a href="#<?php echo $group; ?>" aria-controls="<?php echo $group; ?>" role="tab" data-toggle="tab"><?php echo ucfirst($group); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content configuration-group-wrapper">
            <?php foreach (array_keys($configurationData) as $index => $group): ?>
                <div class="configuration-group tab-pane  <?php echo (!$index) ? 'active' : ''; ?>" role="tabpanel" id="<?php echo $group; ?>">
                    <?php foreach ($configurationData[$group] as $configuration): ?>
                        <div class="configuration-field">
                            <?php echo $view->render($configuration->getViewTemplate(), ['configuration' => $configuration]); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</form>
<?php $view['UI']->stop(); ?>
