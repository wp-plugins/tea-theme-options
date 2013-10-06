    <!-- Content panel -->
    <div class="tea-menu-management-liquid nav-menu-meta">
        <?php if ($count_page): ?>
            <!-- Pages -->
            <?php $num = 0 ?>
            <?php
                foreach ($pages as $key => $item):
                    $class = 0 == $num ? 'open' : '';
            ?>
                <form action="admin.php?page=<?php echo $page ?>&updated=true" method="post" class="tea-dashoard-content <?php echo $item['slug'] . ' ' . $class ?>">
                    <input type="hidden" name="tea_to_configs" id="tea_to_configs" value="1" />
                    <input type="hidden" name="tea_add_pagecontent" id="tea_add_pagecontent" value="1" />
                    <input type="hidden" name="tea_page" id="tea_page" value="<?php echo $item['slug'] ?>" />

                    <div class="menu-edit tea-menu-edit">
                        <!-- Header -->
                        <div class="tea-nav-menu-header">
                            <div class="major-publishing-actions howto">
                                <span><?php echo $item['title'] ?></span>
                            </div>
                        </div>
                        <!-- /Header -->

                        <!-- Aside -->
                        <div class="tea-nav-aside">
                            <div class="tea-edit-screen">
                                <label class="label-add-content">
                                    <span><?php _e('Page title', TTO_I18N) ?></span>
                                    <input type="text" name="tea_edit_page_title" value="<?php echo $item['title'] ?>" class="code menu-item-textbox" />
                                </label>
                                <label class="label-add-content">
                                    <span><?php _e('Page description', TTO_I18N) ?></span>
                                    <textarea name="tea_edit_page_description" class="code menu-item-textbox"><?php echo $item['description'] ?></textarea>
                                </label>
                                <label class="label-add-content">
                                    <span><?php _e('Display submit button?', TTO_I18N) ?></span>
                                    <select name="tea_edit_page_submit" class="code menu-item-textbox">
                                        <option value="1" <?php echo $item['submit'] ? 'selected="selected"' : '' ?>><?php _e('Yes', TTO_I18N) ?></option>
                                        <option value="0" <?php echo !$item['submit'] ? 'selected="selected"' : '' ?>><?php _e('No', TTO_I18N) ?></option>
                                    </select>
                                </label>
                                <input type="submit" name="edit_page" class="button button-primary" value="<?php _e('Edit', TTO_I18N) ?>" />
                            </div>
                            <div class="tea-edit-screen-link">
                                <div class="tea-contextual-help-link-wrap hide-if-no-js screen-meta-toggle">
                                    <a href="#" class="show-settings" data-target=".tea-edit-screen"><?php _e('Edit', TTO_I18N) ?></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- /Aside -->

                        <!-- Body -->
                        <div class="tea-post-body">
                            <div class="tea-post-body-content">

                                <!-- Content list -->
                                <div class="dashboard-contents-all">
                                    <?php if (isset($item['contents']) && !empty($item['contents'])): ?>
                                        <?php
                                            $num = 0;
                                            foreach ($item['contents'] as $cont):
                                        ?>
                                            <div class="dashboard-content">
                                                <?php
                                                    //Build class
                                                    $class = 'Tea_Fields_' . ucfirst($cont['type']);
                                                    $field = new $class();
                                                    $field->templateDashboard($num, $cont);
                                                ?>
                                                <a href="#" class="delete"><?php _e('Delete', TTO_I18N) ?></a>
                                            </div>
                                            <?php $num++ ?>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                                <!-- /Content list -->

                                <!-- Add content form -->
                                <div class="dashboard-add-content" data-ajax="<?php echo $ajax ?>" data-delete="<?php _e('Delete', TTO_I18N) ?>">
                                    <label for="tea_add_content_type" class="label-add-content">
                                        <span><?php _e('Choose content type:', TTO_I18N) ?></span>
                                        <input type="hidden" name="tea_action" class="tea_add_action" value="<?php echo $action ?>" />
                                        <input type="hidden" name="tea_nonce" class="tea_add_nonce" value="<?php echo $nonce ?>" />
                                        <select name="tea_add_content_type" class="tea_add_content_type">
                                            <option value="">---</option>
                                            <?php foreach ($typesgood as $key => $typ): ?>
                                                <optgroup label="<?php echo $key ?>">
                                                    <?php foreach ($typ as $k => $v): ?>
                                                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                                    <?php endforeach ?>
                                                </optgroup>
                                            <?php endforeach ?>
                                        </select>
                                    </label>

                                    <input type="submit" name="add_content" class="button-secondary" value="<?php _e('Add', TTO_I18N) ?>" />
                                    <div class="clearfix"></div>
                                </div>
                                <!-- /Add content form -->

                            </div>
                        </div>
                        <!-- /Body -->

                        <!-- Footer -->
                        <div class="tea-nav-menu-footer">
                            <div class="major-publishing-actions">
                                <span class="delete-action">
                                    <input type="submit" name="delete_page" class="button-secondary" value="<?php _e('Delete', TTO_I18N) ?>" />
                                </span>

                                <div class="publishing-action">
                                    <input type="submit" name="save_page" class="button button-primary" value="<?php _e('Save Changes') ?>" />
                                </div>
                            </div>
                        </div>
                        <!-- /Footer -->
                    </div>

                </form>
                <?php $num++ ?>
            <?php endforeach ?>
            <!-- /Pages -->
        <?php else: ?>
            <h3><?php _e('Use this menu to create your page settings.', TTO_I18N) ?></h3>
            <p><?php _e('As you can see, create a page is quite simple. The only thing you have to do is to follow the instructions and have fun :)', TTO_I18N) ?></p>
        <?php endif ?>
    </div>
    <!-- /Content panel -->