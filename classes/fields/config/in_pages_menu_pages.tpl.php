    <!-- Menu panel -->
    <div class="tea-menu-settings-column metabox-holder">
        <form action="admin.php?page=<?php echo $page ?>&updated=true" method="post" class="nav-menu-meta">
            <input type="hidden" name="tea_to_configs" id="tea_to_configs" value="1" />

            <div class="accordion-container">
                <ul class="outer-border">

                    <!-- Page listing section -->
                    <li class="control-section accordion-section<?php if ($count_page): ?> open<?php endif ?>">
                        <h3 class="accordion-section-title hndle" tabindex="0"><?php _e('Custom pages', TTO_I18N) ?></h3>
                        <div class="accordion-section-content">
                            <div class="inside">

                                <ul class="dashboard-page-listing">
                                    <?php if ($count_page): ?>
                                        <?php $num = 0 ?>
                                        <?php
                                            foreach ($pages as $item):
                                                $class = 0 == $num ? 'active' : '';
                                        ?>
                                            <li class="<?php echo $class ?>">
                                                <a href="#<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></a>
                                            </li>
                                            <?php $num++ ?>
                                        <?php endforeach ?>
                                    <?php else: ?>
                                        <li><?php _e('No page found.', TTO_I18N) ?></li>
                                    <?php endif ?>
                                </ul>

                            </div>
                        </div>
                    </li>
                    <!-- /Page listing section -->

                    <!-- Add page section -->
                    <li class="control-section accordion-section<?php if (!$count_page): ?> open<?php endif ?>">
                        <h3 class="accordion-section-title hndle" tabindex="0"><?php _e('Add custom page', TTO_I18N) ?></h3>
                        <div class="accordion-section-content">
                            <div class="inside">

                                <label for="tea_add_page_title" class="label-add-page">
                                    <span><?php _e('Page title', TTO_I18N) ?></span>
                                    <input type="text" name="tea_add_page_title" id="tea_add_page_title" value="" class="code menu-item-textbox" />
                                </label>

                                <label for="tea_add_page_description" class="label-add-page">
                                    <span><?php _e('Page description', TTO_I18N) ?></span>
                                    <textarea name="tea_add_page_description" id="tea_add_page_description" class="code menu-item-textbox"></textarea>
                                </label>

                                <label for="tea_add_page_submit" class="label-add-page">
                                    <span><?php _e('Display submit button?', TTO_I18N) ?></span>
                                    <select name="tea_add_page_submit" id="tea_add_page_submit" class="code menu-item-textbox">
                                        <option value="1"><?php _e('Yes', TTO_I18N) ?></option>
                                        <option value="0"><?php _e('No', TTO_I18N) ?></option>
                                    </select>
                                </label>

                                <input type="submit" name="add_page" id="add_page" class="button button-primary" value="<?php _e('Add', TTO_I18N) ?>" />
                            </div>
                        </div>
                    </li>
                    <!-- /Add page section -->

                </ul>
            </div>

        </form>
    </div>
    <!-- /Menu panel -->