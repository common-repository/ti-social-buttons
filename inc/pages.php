<?php
class Pages
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'ti_menu_pages']);
    }

    public function ti_menu_pages(){
        add_menu_page('TI Social Buttons Settings', 'TI Social Buttons', 'manage_options', 'ti-buttons-page', [$this, 'buttons_page_callback']);
    }

    public function buttons_page_callback(){
        if ( isset($_POST, $_POST['user-submit']) &&  $_POST['user-submit'] === 'Y' ){
            $show_on_pages = filter_var($_POST['show_on_pages'], FILTER_SANITIZE_STRING);
            $show_on_posts = filter_var($_POST['show_on_posts'], FILTER_SANITIZE_STRING);
            $show_on_front = filter_var($_POST['show_on_front'], FILTER_SANITIZE_STRING);
            update_option('ti_show_on_pages', $show_on_pages);
            update_option('ti_show_on_posts', $show_on_posts);
            update_option('ti_show_on_front', $show_on_front);
        }else{
            $show_on_pages = get_option('ti_show_on_pages');
            $show_on_posts = get_option('ti_show_on_posts');
            $show_on_front = get_option('ti_show_on_front');
        }
        ?>
<div class="wrap">
    <h1>TI Social Buttons Settings</h1>
    <form action="" method="post">
    <input type="hidden" name="user-submit" value="Y">
    <table class="form-table">
        <tr>
            <th scope="row">Show buttons on</th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text"><span>Show buttons on</span></legend><label><input
                            type="checkbox" name="show_on_pages" value="1" <?php echo $show_on_pages ? 'checked':'';?> />Pages</label><br/>
                    <label><input type="checkbox" name="show_on_posts" value="1" <?php echo $show_on_posts ? 'checked' : '';?>/>Posts</label><br/>
                    <label><input type="checkbox" name="show_on_front" value="1" <?php echo $show_on_front ? 'checked' : '';?>/>Front page</label>
                </fieldset>
            </td>
        </tr>
        </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
    </form>
</div>
<?php
    }
}

new Pages();