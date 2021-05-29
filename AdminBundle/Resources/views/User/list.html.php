<?php $view->extend('PsiAdminBundle:layout:base.html.php') ?>

<?php //renderTable($heading, $data, $cssId, $cssClass, $actions) ?>

<?php $view['UI']->start('_content') ?>
<div id="adu-bckgrnd"></div>
<?php

$heading = ["Id",'Email', 'SummonerName', 'Firstname', 'Lastname', 'Status'];

echo $view['datatable']->renderTable(
    $heading, $userData, 'userListTable', 'data-table', [
        'edit' => [
            'name' => "edit",
            'jsMethod' => "AdminUI.editUser",
            'label' => "Edit",
            'data' => "id"
        ]
    ]
);

?>
<?php $view['UI']->stop(); ?>
