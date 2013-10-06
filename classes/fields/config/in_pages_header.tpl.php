<?php if (!empty($linkstylesheet) || !empty($gfontstyle)): ?>
    <!-- Content font style -->
    <?php echo $linkstylesheet ?>
    <style>
        <?php echo $gfontstyle ?>
    </style>
    <!-- /Content font style -->
<?php endif ?>

<h2 class="tea-clear"><?php echo $title ?></h2>

<?php if (!empty($description)): ?><p><?php echo $description ?></p><?php endif ?>

<div class="inside-dashboard tea-nav-menus-frame nav-menus-php">
