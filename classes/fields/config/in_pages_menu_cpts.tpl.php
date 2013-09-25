    <!-- Menu panel -->
    <div class="tea-menu-settings-column metabox-holder">
        <form action="admin.php?page=<?php echo $page ?>&updated=true" method="post" class="nav-menu-meta">
            <input type="hidden" name="tea_to_configs" id="tea_to_configs" value="1" />

            <div class="accordion-container">
                <ul class="outer-border">

                    <!-- CPT listing section -->
                    <li class="control-section accordion-section<?php if ($count_cpt): ?> open<?php endif ?>">
                        <h3 class="accordion-section-title hndle" tabindex="0"><?php _e('Custom post types', TTO_I18N) ?></h3>
                        <div class="accordion-section-content">
                            <div class="inside">

                                <ul class="dashboard-page-listing">
                                    <?php if ($count_cpt): ?>
                                        <?php $num = 0 ?>
                                        <?php
                                            foreach ($cpts as $item):
                                                $class = 0 == $num ? 'active' : '';
                                        ?>
                                            <li class="<?php echo $class ?>">
                                                <a href="#<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></a>
                                            </li>
                                            <?php $num++ ?>
                                        <?php endforeach ?>
                                    <?php else: ?>
                                        <li><?php _e('No custom post type found.', TTO_I18N) ?></li>
                                    <?php endif ?>
                                </ul>

                            </div>
                        </div>
                    </li>
                    <!-- /CPT listing section -->

                    <!-- Add custom post type section -->
                    <li class="control-section accordion-section<?php if (!$count_cpt): ?> open<?php endif ?>">
                        <h3 class="accordion-section-title hndle" tabindex="0"><?php _e('Add custom post type', TTO_I18N) ?></h3>
                        <div class="accordion-section-content">
                            <div class="inside">

                                <label for="tea_add_cpt_title" class="label-add-page">
                                    <span><?php _e('Plural title', TTO_I18N) ?></span>
                                    <input type="text" name="tea_add_cpt_title" id="tea_add_cpt_title" value="" class="code menu-item-textbox" />
                                </label>

                                <input type="submit" name="add_cpt" id="add_cpt" class="button button-primary" value="<?php _e('Add', TTO_I18N) ?>" />
                            </div>
                        </div>
                    </li>
                    <!-- /Add custom post type section -->

                </ul>
            </div>

        </form>
    </div>
    <!-- /Menu panel -->