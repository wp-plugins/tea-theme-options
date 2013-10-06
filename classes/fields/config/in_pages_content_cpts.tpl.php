    <!-- Content panel -->
    <div class="tea-menu-management-liquid nav-menu-meta">
        <?php if ($count_cpt): ?>
            <!-- Custom post types -->
            <?php $num = 0 ?>
            <?php
                foreach ($cpts as $key => $item):
                    $class = 0 == $num ? 'open' : '';
            ?>
                <form action="admin.php?page=<?php echo $page ?>&updated=true&section=cpt" method="post" class="tea-dashoard-content <?php echo $item['slug'] . ' ' . $class ?>">
                    <input type="hidden" name="tea_to_configs" id="tea_to_configs" value="1" />
                    <input type="hidden" name="tea_cpt" id="tea_cpt" value="<?php echo $item['slug'] ?>" />

                    <div class="menu-edit tea-menu-edit">
                        <!-- Header -->
                        <div class="tea-nav-menu-header">
                            <div class="major-publishing-actions howto">
                                <span>
                                    <?php if (isset($item['menu_icon']) && !empty($item['menu_icon'])): ?>
                                        <img src="<?php echo $item['menu_icon'] ?>" alt="" height="16" style="vertical-align:middle" />
                                    <?php endif ?>
                                    <?php echo $item['title'] ?>
                                </span>
                            </div>
                        </div>
                        <!-- /Header -->

                        <?php if (!in_array($item['slug'], array('post', 'page'))): ?>
                            <!-- Aside -->
                            <div class="tea-nav-aside">
                                <div class="tea-edit-screen">

                                    <!-- Configurations -->
                                    <div class="dashboard-content">
                                        <h4><?php _e('Configurations', TTO_I18N) ?></h4>

                                        <label class="label-edit-content">
                                            <span><?php _e('Plural title', TTO_I18N) ?></span>
                                            <input type="text" name="tea_add_cptcontent[title]" value="<?php echo $item['title'] ?>" class="code" placeholder="<?php _e('Items', TTO_I18N) ?>" />
                                        </label>

                                        <label class="label-edit-content">
                                            <?php $cptval = isset($item['singular']) ? $item['singular'] : '' ?>
                                            <span><?php _e('Singular title', TTO_I18N) ?></span>
                                            <input type="text" name="tea_add_cptcontent[singular]" value="<?php echo $cptval ?>" class="code" placeholder="<?php _e('Item', TTO_I18N) ?>" />
                                        </label>
                                    </div>
                                    <!-- /Configurations -->

                                    <!-- Icons -->
                                    <div class="dashboard-content">
                                        <h4><?php _e('Icons', TTO_I18N) ?></h4>

                                        <label class="label-edit-content">
                                            <?php $cptval = isset($item['menu_icon']) ? $item['menu_icon'] : '' ?>
                                            <span><?php _e('Small icon', TTO_I18N) ?></span>
                                            <input type="text" name="tea_add_cptcontent[menu_icon]" value="<?php echo $cptval ?>" class="code" />
                                        </label>
                                    </div>
                                    <!-- /Icons -->

                                    <!-- Labels -->
                                    <div class="dashboard-content">
                                        <h4><?php _e('Labels', TTO_I18N) ?></h4>
                                        <?php
                                            $labs = array(
                                                'menu_name' => array(__('The menu name on the administration panel', TTO_I18N), ''),
                                                'all_items' => array(__('The text used to list all items', TTO_I18N), __('All items', TTO_I18N)),
                                                'add_new' => array(__('The menu item for adding a new post', TTO_I18N), __('Add new', TTO_I18N)),
                                                'add_new_item' => array(__('The header shown when creating a new post', TTO_I18N), __('Add new item', TTO_I18N)),
                                                'edit' => array(__('The menu item for editing posts', TTO_I18N), __('Edit', TTO_I18N)),
                                                'edit_item' => array(__('The header shown when editing a post', TTO_I18N), __('Edit item', TTO_I18N)),
                                                'new_item' => array(__('Shown in the favorites menu in the admin header', TTO_I18N), __('New item', TTO_I18N)),
                                                'view' => array(__('Used as text in a link to view the post', TTO_I18N), __('View', TTO_I18N)),
                                                'view_item' => array(__('Shown alongside the permalink on the edit post screen', TTO_I18N), __('View item', TTO_I18N)),
                                                'search_items' => array(__('Button text for the search box on the edit posts screen', TTO_I18N), __('Search item', TTO_I18N)),
                                                'not_found' => array(__('Text to display when no posts are found through search in the admin', TTO_I18N), __('No item found', TTO_I18N)),
                                                'not_found_in_trash' => array(__('Text to display when no posts are in the trash', TTO_I18N), __('No item found in Trash', TTO_I18N)),
                                                'parent_item_colon' => array(__('Used as a label for a parent post on the edit posts screen. Only useful for hierarchical post types', TTO_I18N), __('Parent item', TTO_I18N))
                                            );
                                        ?>
                                        <?php foreach ($labs as $key => $lab): ?>
                                            <label class="label-edit-content">
                                                <?php $cptval = isset($item[$key]) ? $item[$key] : '' ?>
                                                <span><?php echo $lab[0] ?></span>
                                                <input type="text" name="tea_add_cptcontent[<?php echo $key ?>]" value="<?php echo $cptval ?>" class="code" placeholder="<?php echo $lab[1] ?>" />
                                            </label>
                                        <?php endforeach ?>
                                    </div>
                                    <!-- /Labels -->

                                    <!-- Taxonomies -->
                                    <div class="dashboard-content">
                                        <h4><?php _e('Taxonomies', TTO_I18N) ?></h4>
                                        <p><?php _e('If you have some preexisting taxonomies, you can allow posts of this type to also use those taxonomies. You just have to set an array of taxonomy names that you’d like for it to use. WordPress will handle all the administration features for you.', TTO_I18N) ?></p>

                                        <?php
                                            $cptval = isset($item['taxonomies']) ? $item['taxonomies'] : array();
                                            $taxs = array(
                                                'post_tag' => __('Tag', TTO_I18N),
                                                'category' => __('Category', TTO_I18N)
                                            );

                                            foreach ($taxs as $key => $tax):
                                                $checked = in_array($key, $cptval) ? 'checked="checked"' : '';
                                        ?>
                                            <label class="label-edit-content">
                                                <input type="checkbox" name="tea_add_cptcontent[taxonomies][<?php echo $key ?>]" value="1" <?php echo $checked ?> />
                                                <?php echo $tax ?>
                                            </label>
                                        <?php endforeach ?>

                                    </div>
                                    <!-- /Taxonomies -->

                                    <!-- Supports -->
                                    <div class="dashboard-content">
                                        <h4><?php _e('Supports', TTO_I18N) ?></h4>

                                        <p><?php _e('The <code>supports</code> argument allows you to define what meta boxes and other fields will appear on the screen when editing or creating a new post. This defaults to <code>title</code> and <code>editor</code>. There are several available options:', TTO_I18N) ?></p>
                                        <?php
                                            $cptval = isset($item['supports']) ? $item['supports'] : array();
                                            $sups = array(
                                                'title' => __('Text input field to create a post title', TTO_I18N),
                                                'editor' => __('Content input box for writing', TTO_I18N),
                                                'comments' => __('Ability to turn comments on/off', TTO_I18N),
                                                'trackbacks' => __('Ability to turn trackbacks and pingbacks on/off', TTO_I18N),
                                                'revisions' => __('Allows revisions to be made of your post', TTO_I18N),
                                                'author' => __('Displays a select box for changing the post author', TTO_I18N),
                                                'excerpt' => __('A textarea for writing a custom excerpt', TTO_I18N),
                                                'thumbnail' => __('The thumbnail (featured image in 3.0) uploading box', TTO_I18N),
                                                'custom-fields' => __('Custom fields input area', TTO_I18N),
                                                'page-attributes' => __('The attributes box shown for pages. This is important for hierarchical post types, so you can select the parent post', TTO_I18N)
                                            );

                                            foreach ($sups as $key => $sup):
                                                $checked = in_array($key, $cptval) ? 'checked="checked"' : '';
                                        ?>
                                            <label class="label-edit-content">
                                                <input type="checkbox" name="tea_add_cptcontent[supports][<?php echo $key ?>]" value="1" <?php echo $checked ?> />
                                                <?php echo $sup ?>
                                            </label>
                                        <?php endforeach ?>
                                    </div>
                                    <!-- /Supports -->

                                    <!-- Options -->
                                    <div class="dashboard-content">
                                        <h4><?php _e('Options', TTO_I18N) ?></h4>

                                        <?php
                                            $cptval = isset($item['options']) ? $item['options'] : array();
                                            $opts = array(
                                                'hierarchical' => __('The <code>hierarchical</code> argument allows you to choose whether you want your post type to be hierarchical', TTO_I18N),
                                                'query_var' => __('The <code>query_var</code> argument allows you to control the query variable used to get posts of this type', TTO_I18N),
                                                'can_export' => __('The <code>can_export</code> argument allows you to decide whether posts of your post type can be exportable via the WordPress export tool', TTO_I18N)
                                            );

                                            foreach ($opts as $key => $opt):
                                                $checked = isset($cptval[$key]) && $cptval[$key] ? 'checked="checked"' : '';
                                        ?>
                                            <label class="label-edit-content">
                                                <input type="checkbox" name="tea_add_cptcontent[options][<?php echo $key ?>]" value="1" <?php echo $checked ?> />
                                                <?php echo $opt ?>
                                            </label>
                                        <?php endforeach ?>
                                    </div>
                                    <!-- /Options -->

                                    <input type="submit" name="edit_cpt" class="button button-primary" value="<?php _e('Edit', TTO_I18N) ?>" />
                                </div>
                                <div class="tea-edit-screen-link">
                                    <div class="tea-contextual-help-link-wrap hide-if-no-js screen-meta-toggle">
                                        <a href="#" class="show-settings" data-target=".tea-edit-screen"><?php _e('Edit', TTO_I18N) ?></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- /Aside -->
                        <?php endif ?>

                        <!-- Body -->
                        <div class="tea-post-body">
                            <div class="tea-post-body-content">

                                <?php if (!in_array($item['slug'], array('post', 'page'))): ?>
                                    <!-- Options -->
                                    <div class="dashboard-content">
                                        <?php $ispublic = isset($item['options']['public']) ? $item['options']['public'] : false ?>
                                        <label>
                                            <input type="checkbox" name="tea_add_cptcontent[options][public]" value="1" <?php echo $ispublic ? 'checked="checked"' : '' ?> />
                                            <?php _e('Enable your post type?', TTO_I18N) ?>
                                        </label>
                                    </div>
                                    <!-- /Options -->
                                <?php endif ?>

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
                                <?php if (!in_array($item['slug'], array('post', 'page'))): ?>
                                    <span class="delete-action">
                                        <input type="submit" name="delete_cpt" class="button-secondary" value="<?php _e('Delete', TTO_I18N) ?>" />
                                    </span>
                                <?php endif ?>

                                <div class="publishing-action">
                                    <input type="submit" name="save_cpt" class="button button-primary" value="<?php _e('Save Changes') ?>" />
                                </div>
                            </div>
                        </div>
                        <!-- /Footer -->
                    </div>

                </form>
                <?php $num++ ?>
            <?php endforeach ?>
            <!-- Custom post types -->
        <?php else: ?>
            <h3><?php _e('Use this menu to create your custom post types.', TTO_I18N) ?></h3>
            <p><?php _e('As you can see, create a custom post type is quite simple. The only thing you have to do is to follow the instructions and have fun :)', TTO_I18N) ?></p>
        <?php endif ?>
    </div>
    <!-- /Content panel -->