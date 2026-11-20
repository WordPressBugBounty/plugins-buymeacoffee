<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.buymeacoffee.com
 * @since      1.0.0
 *
 * @package    Buy_Me_A_Coffee
 * @subpackage Buy_Me_A_Coffee/admin/partials
 */

/**
 *
 */
ob_start();
class Buy_Me_A_Coffee_Admin_View
{

    function __construct()
    {

        define('URL', 'https://www.buymeacoffee.com/');
        define('FIMG', URL . 'assets/img/');
        define('FCSS', URL . 'assets/css/');
        define('FJS', URL . 'assets/js/');
    }

    public function bmc_show_data($data = array())
    {
        global $wpdb;

        $table = $wpdb->prefix . 'bmc_plugin';

        $table_widget = $wpdb->prefix . 'bmc_widget_plugin';

        $data_user = $wpdb->get_row("SELECT * FROM $table", ARRAY_A);
        $data_user['widget'] = $wpdb->get_row("SELECT * FROM $table_widget", ARRAY_A);
        self::dashboard($data, $data_user);
        return;
        //die here
    }

    public function bmc_disconnect($api_key)
    {
        global $wpdb;

        $table = $wpdb->prefix . 'bmc_plugin';

        $where = array('api_key' => $api_key);

        $wpdb->delete($table, $where, $where_format = null);

        // die(exit( wp_redirect( admin_url( 'admin.php?page=buy-me-a-coffee' ) ) ));

    }


    public function get_user_data($api_key)
    {

        $curl = curl_init(URL . 'wp-user');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTREDIR, 3);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'auth_key' => $api_key
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        // echo $response;
        return $response;
    }

    function bmc_register_plugin()
    {
        $widget = new BMC_Widget();
        register_widget($widget);
    }

    public function start_page()
    {   ?>


        <div class="bmc-body-start">
            <div class="bmc-common-header">
                <div class="bmc-width">
                    <a class="bmc-head-logo bmc-float-l" href="<?php echo admin_url('admin.php?page=buy-me-a-coffee'); ?>">
                        <!--               <img src="<?php //echo (FIMG).'bmc_plugin/logo-bmc.svg'
                        ?>" alt="Buy me a coffee"> -->
                        <img src="<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . 'img/bmc-header-logo.png'); ?>" alt="Buy Me a coffee">
                    </a>
                </div>
            </div>

            <div class="bmc-width">
                <h1 class="bmc-page-head bmc-m-tb-40">Welcome to <b>BuyMeaCoffee</b></h1>

                <div class="bmc-connect-wrapper">
                    <p class="bmc-connect-text bmc-connect-w">Please connect to or create a BuyMeACoffee.com account to add our widget to your site.</p>
                    <div class="bmc-flex bmc-flex-center bmc-m-t-30">
                        <img class="bmc-m-r-30" src="<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . 'img/wordpress-logo-grey.png'); ?>" alt="Wordpress logo">
                        <img class="bmc-m-r-30" src="<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . 'img/refresh_logo.svg'); ?>" alt="Refresh icon">
                        <img src="<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . 'img/bmc_logo.svg'); ?>" alt="BMC Logo">
                    </div>
                    <p class="bmc-text-center bmc-m-t-50">
                        <a class="bmc-button bmc-button-primary" href="<?php echo URL . 'wp-auth?referer=' . urlencode((isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>">Connect </a>
                    </p>
                    <p class="bmc-small-text bmc-m-t-25">No account? <a href="<?php echo URL . 'signup' ?>">Create one for free</a></p>
                    <p class="bmc-small-text bmc-m-t-35 bmc-small-text-w">By connecting your site you agree to our fascinating Terms of Service and to share details with BuyMeACoffee.com</p>
                </div>

                <p class="bmc-sub-head bmc-m-t-25">Join other creators using Buy Me a coffee</p>

                <img class="bmc-creators-img bmc-m-t-25 img-responsive" src="<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . 'img/creators-group.svg'); ?>" alt="Creators">
            </div>
            ?>
            <div class="bmc-footer">
                <div class="bmc-foot"></div>
                <p class="bmc-para">
                <center class="copyright1">© <?php echo date("Y");
                    ?> Buy Me a Coffee</center>
                </p>
                <div class="bmc-flex bmc-flex-center">

                    <a class="bmc-foot-links1" href="https://www.buymeacoffee.com/about">About</a>
                    <a class="bmc-foot-links1" href="https://www.buymeacoffee.com/brand">Brand</a>

                    <a class="bmc-foot-links1" href="https://help.buymeacoffee.com">Help</a>
                    <a class="bmc-foot-links1" href="https://www.buymeacoffee.com/terms">Terms</a>
                    <a class="bmc-foot-links1" href="https://www.buymeacoffee.com/library">Blog</a>
                </div>

                <ul class="f-links">
                    <li><a class="about-social" target="_blank" href="https://www.instagram.com/buymeacoffee/"><img alt="" src="https://www.buymeacoffee.com/assets/img/home/xinstagram-footer-logo.png.pagespeed.ic.bqgn0OsF37.webp" onerror="this.onerror=null;pagespeed.lazyLoadImages.loadIfVisibleAndMaybeBeacon(this);"></a></li>
                    <li><a class="about-social" target="_blank" href="https://twitter.com/BuyMeACoffee"><img alt="" src="https://www.buymeacoffee.com/assets/img/home/xtwitter-footer-logo.png.pagespeed.ic.YKCDVSPMav.webp" onerror="this.onerror=null;pagespeed.lazyLoadImages.loadIfVisibleAndMaybeBeacon(this);"></a></li>
                </ul>
            </div>



        </div>
        <?php
    }

    public function dashboard($data = array(), $data_user = array())
    {   ?>
        <link href="<?php echo (FCSS) ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo (FCSS) ?>wp_main.css" rel="stylesheet">

        <link href="<?php echo (FCSS) ?>font-awesome.min.css" rel="stylesheet" type="text/css" />

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Nunito:200,300,400,600,700,800,900|Open+Sans:300,400,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Comic+Neue" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">

        <style>
            @font-face {
                font-family: "Avenir Light";
                src:
                        url("<?php echo 'https://www.buymeacoffee.com/assets/fonts/' ?>edefe737-dc78-4aa3-ad03-3c6f908330ed.eot?#iefix");
                src:
                        url("<?php echo 'https://www.buymeacoffee.com/assets/fonts/' ?>edefe737-dc78-4aa3-ad03-3c6f908330ed.eot?#iefix") format("eot"), url("<?php echo 'https://www.buymeacoffee.com/assets/fonts/' ?>0078f486-8e52-42c0-ad81-3c8d3d43f48e.woff2") format("woff2"), url("<?php echo 'https://www.buymeacoffee.com/assets/fonts/' ?>908c4810-64db-4b46-bb8e-823eb41f68c0.woff") format("woff"), url("<?php echo 'https://www.buymeacoffee.com/assets/fonts/' ?>4577388c-510f-4366-addb-8b663bcc762a.ttf") format("truetype"), url("<?php echo 'https://www.buymeacoffee.com/assets/fonts/' ?>b0268c31-e450-4159-bfea-e0d20e2b5c0c.svg#b0268c31-e450-4159-bfea-e0d20e2b5c0c") format("svg");
            }

            .st0 {
                fill:
                        #fd0
            }

            .st1 {
                fill:
                        #ff9100
            }

            .st2 {
                fill:
                        #fff
            }

            .st3,
            .st4,
            .st5 {
                fill:
                        none;
                stroke:
                        #000;
                stroke-width: 4.3189
            }

            .st4,
            .st5 {
                stroke:
                        #050505
            }

            .st5 {
                stroke:
                        #eee;
                stroke-width: 6.9583
            }

            .st6 {
                fill:
                        #eee
            }

            .st7 {
                fill:
                        #ff813f
            }

            .logo-text-img img {
                width: 240px;
                height: 48px;
            }

            @media (max-width: 767px) {
                .logo-text-img img {
                    width: 168px;
                }
            }

            @media (max-width: 380px) {
                .logo-text img {
                    width: 154px !important;
                }
            }

            #wpfooter {
                position:
                        relative !important;
                bottom: 0;
            }
        </style>

        <div class="bmc-body-start">

            <div class="bmc-common-header">
                <div class="bmc-width">
                    <a class="bmc-head-logo bmc-float-l" href="<?php echo admin_url('admin.php?page=buy-me-a-coffee'); ?>">
                        <img src="<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . 'img/bmc-header-logo.png'); ?>" alt="Buy Me a coffee">
                    </a>

                    <div class="bmc-float-r bmc-flex">

                    </div>
                </div>
            </div>

            <div class="bmc-width bmc-m-b-footer bmc-p-relative">

                <!-- Widgets section -->

                <input id="popup-status" type="hidden" name="" value="<?php if (isset($_GET['status']) && $_GET['status'] == 'true') : echo 'true';
                else : echo 'false';
                endif; ?>">

                </form>
                <?php if (isset($_GET['name']) && $_GET['name'] == 'true') {
                    ?>
                    <div id="bmc-popup">Your Buy Me a Coffee account is linked. You can now add a button and widget to your site!</div>
                    <?php
                } else if ((isset($_GET['name']) && $_GET['name'] == 'false')) {
                    ?>
                    <div id="bmc-popup">Sorry, this is not a valid account!</div>
                    <?php
                } else if ((isset($_GET['widget']) && $_GET['widget'] == 'true')) {
                    ?>
                    <div id="bmc-popup">Done! Your Buy Me a Coffee widget is now live on your site.</div>
                    <?php
                } else if ((isset($_GET['widget']) && $_GET['widget'] == 'false')) {
                    ?>
                    <div id="bmc-popup">Widget disabled.</div>
                    <?php
                } else if ((isset($_GET['status']) && $_GET['status'] == 'true')) {
                    ?>
                    <div id="bmc-popup">Changes saved. Please add the button from your Widgets page.</div>
                    <?php
                } ?>
                <div class="bmc-dash-wrapper bmc-wrapper hide-on-widget" style="margin-bottom: 32px !important;">
                    <h2 class="bmc-title">Add your account</h2>
                    <form action="<?php echo get_admin_url('', 'admin-post.php') ?>" method="post">
                        <?php wp_nonce_field('bmc_name_post'); ?>
                        <input type="hidden" name="action" value="<?php echo 'bmc_name_post'; ?>">

                        <div class="input-container" style="margin-top: 32px;">
                            <span>Enter your Buy Me a Coffee Username</span>
                            <span class="placeholder">buymeacoffee.com/</span>
                            <input class="input place" id="bmc-user-name" required name="bmc-user-name" value="<?php echo !empty($data_user['name']) ? $data_user['name'] : ''; ?>" type="text">
                        </div>
                        <div class="inner">
                            <!-- <input class="button_bmc_widget" type="submit" name="save-btn" id="save-btn" value="Save"> -->
                            <button name="save-btn" id="save-btn" type="submit" class="button_bmc_widget">
                                <span id="save-btn-text">Save</span>
                                <svg id="save-btn-loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: none; shape-rendering: auto;" width="18px" height="18px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                    <circle cx="50" cy="50" fill="none" stroke="#ffffff" stroke-width="10" r="40" stroke-dasharray="188.49555921538757 64.83185307179586" transform="rotate(6.77628 50 50)">
                                        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                    </circle>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <p class="bmc-para">​​If you are not on Buy Me a Coffee yet, please <a target="_blank" class="bmc-link" href="https://www.buymeacoffee.com/signup">create a new account for free</a>. You will need it to receive payments, and to keep tab on your supporters.</p>
                </div>
                <?php if (!empty($data_user['name'])) {
                ?>
                <div class="bmc-dash-wrapper bmc-wrapper hide-on-widget" style="margin-bottom: 32px !important;">
                    <h2 class="bmc-title">Widget
                        <form id="widget_toggle_form" name="widget_toggle_form" action="<?php echo get_admin_url('', 'admin-post.php') ?>" method="post">
                            <?php wp_nonce_field('bmc_widget_post'); ?>
                            <input type="hidden" name="action" value="<?php echo 'bmc_widget_post' ?>">

                            <input type="checkbox" id="switch2" class="bmc-toggle" name="toogle_switch_widget" <?php if ($data_user['widget']['widget_isactive'] == "0" || $data_user['widget']['widget_isactive'] == "") {
                                ?> value="0" <?php
                            } else {
                                ?> value="1" checked="checked" <?php
                            } ?> onchange="valueChanged2()" /><label for="switch2" class="bmc-toggle">Toggle </label>
                        </form>
                    </h2>
                    <p class="bmc-para">Enable this feature to accept payments without leaving your website. You can also showcase your supporters and customize the widget to your style. We highly recommend enabling this feature.</p>
                    <p class="bmc-para">
                    <div class="answer2 button_bmc_widget trigger" <?php if ($data_user['widget']['widget_isactive'] == "1") { ?> onclick="toggleModal()" <?php } ?> style="<?php echo ($data_user['widget']['widget_isactive'] == "1") ? 'display: inline-flex;' : 'display: none;'; ?>">Customize Widget</div>
                    </p>

                </div>
                <div class="bmc-dash-wrapper bmc-wrapper hide-on-widget" style="margin-bottom: 32px !important;">
                    <h2 class="bmc-title">Button</h2>
                    <p class="bmc-para">Adding a Buy Me a Coffee button is a quick drag-and-drop from your Widgets page. You can use the customize feature below to fit match your style.</p>
                    <p class="bmc-para"><?php if (!empty($data_user['name'])) {
                        ?>
                    <div class="button_bmc_widget trigger2" onclick="toggleModal1()">Customize Button</div>
                    <?php
                    } ?>
                    </p>
                </div>
                <div class="bmc-dash-wrapper bmc-wrapper" id="modal-section">
                    <span onclick="closeButton()" class="close-button">✖</span>
                    <div class="flex">
                        <div class="left">
                            <!-- Widget  form-->
                            <input type="hidden" name="user_name" id="user_name" value="<?php echo $data_user['widget']['name'] ?>">
                            <h2 class="bmc-title">Customize Widget</h2>
                            <p class="prompt">Allow your fans to support directly from your website.</p>
                            <form id="widget_form" name="widget_form" action="<?php echo get_admin_url('', 'admin-post.php') ?>" method="post">
                                <?php wp_nonce_field('bmc_widget_post'); ?>
                                <input type="hidden" name="action" value="<?php echo 'bmc_widget_post' ?>">
                                <div class="input-container">
                                    <span>Description</span>
                                    <input class="input" type="text" id="descriptionText" name="description"
                                        <?php if ($data_user['widget']['description'] == "" || $data_user['widget']['description'] == " ") {
                                            ?> value="Reset Description"
                                        <?php } else {?>
                                            value="<?php echo wp_unslash($data_user['widget']['description']) ?>"
                                        <?php } ?>>
                                </div>
                                <div class="input-container">
                                    <span>Widget message</span>
                                    <input class="input" type="text" id="messageText" name="message" <?php if ($data_user['widget']['message'] == " " || $data_user['widget']['message'] == "") {
                                        ?> value="Reset message" <?php
                                    } else {
                                        ?> value="<?php echo wp_unslash($data_user['widget']['message']) ?>" <?php
                                    } ?>>
                                </div>
                                <div class="input-container" style="border: 1px solid #eee; padding: 0 16px">
                                    <span>Background color</span>
                                    <div class="bmc-flex bmc-flex-center bmc-choose-bmc-widget">

                                        <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="orange" data-color="#FF813F">
                                            <div class="custom-clr1 custom-orange"></div>
                                        </a>
                                        <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="blue" data-color="#5F7FFF">
                                            <div class="custom-clr1 custom-blue"></div>
                                        </a>
                                        <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="violet" data-color="#BD5FFF">
                                            <div class="custom-clr1 custom-violet"></div>
                                        </a>
                                        <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="red" data-color="#FF5F5F">
                                            <div class="custom-clr1 custom-red"></div>
                                        </a>
                                        <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="green" data-color="#79D6B5">
                                            <div class="custom-clr1 custom-green"></div>
                                        </a>
                                        <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="pink" data-color="#F471FF">
                                            <div class="custom-clr1 custom-pink"></div>
                                        </a>

                                        <input type="hidden" name="widget_color" id="widget_color" <?php if ($data_user['widget']['widget_color'] == "" || $data_user['widget']['widget_color'] == " ") { ?>
                                            value="#FF813F"
                                        <?php } else { ?> value="<?php echo $data_user['widget']['widget_color'] ?>" <?php } ?>>
                                    </div>
                                </div>
                                <!-- <div class="input-container">
                                                                     <span>Align</span>
                                                                     </div> -->
                                <span style="display: flex; width: 100%;">
                                        <div class="input-container">
                                            <span>Align</span>
                                            <select id="widgetPos" class="select_align" name="align" style="margin-left: 0 !important;">
                                                <option value="right" <?php if ($data_user['widget']['align'] == 'right' || $data_user['widget']['align'] == '') {
                                                ?>selected<?php
                                                } ?>>Right</option>
                                                <option value="left" <?php if ($data_user['widget']['align'] == 'left') {
                                                ?>selected<?php
                                                } ?>>Left</option>
                                            </select>
                                        </div>
                                        <div class="input-container" style="margin-right: 8px;">
                                            <span>Side spacing (px)</span>
                                            <input class="input" id="sideSpace" name="side_spacing" type="text" <?php if ($data_user['widget']['side_spacing'] == " " || $data_user['widget']['side_spacing'] == "") {
                                                ?> value="18" <?php
                                            } else {
                                                ?> value="<?php echo $data_user['widget']['side_spacing'] ?>" <?php
                                            } ?> style="width: 128px">
                                        </div>
                                        <div class="input-container">
                                            <span>Bottom spacing (px)</span>
                                            <input id="bottomSpace" class="input" name="bottom_spacing" type="text" <?php if ($data_user['widget']['bottom_spacing'] == " " || $data_user['widget']['bottom_spacing'] == "") {
                                                ?> value="18" <?php
                                            } else {
                                                ?> value="<?php echo $data_user['widget']['bottom_spacing'] ?>" <?php
                                            } ?> style="width: 132px">
                                        </div>
                                    </span>
                                <div style="margin-top: 16px;">
                                    <button id="customize-btn" type="submit" value="Save changes" name="save" onClick="Confirm(this.widget_form)" class="button_bmc_widget">
                                        <span id="customize-btn-text">Save changes</span>
                                        <svg id="customize-btn-loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: none; shape-rendering: auto;" width="18px" height="18px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="50" cy="50" fill="none" stroke="#ffffff" stroke-width="10" r="40" stroke-dasharray="188.49555921538757 64.83185307179586" transform="rotate(6.77628 50 50)">
                                                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                            </circle>
                                        </svg>
                                    </button>
                                    <!-- <input type="submit" value="Delete" name="reset" class="button_bmc_widget_delete"> -->
                                </div>
                        </div>
                        ​</form>
                        <div class="right">
                            <div id="widgetPreview">
                                <!-- <iframe class="col-xs-12 m-t-20 widget-frame" src="/buymeacoffee" frameborder="0"></iframe> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bmc-dash-wrapper bmc-wrapper" id="modal2-section">
                    <span onclick="closeButton2()" class="close-button2">✖</span>
                    <!-- <h1>Button generator</h1> -->
                    <div class="bmc-connect-wrapper bmc-tab" id="chosen-widget">
                        <div class="bmc-choose-wrapper">
                            <h2 class="bmc-title bmc-text-center">Customize Button</h2>
                            <p class="bmc-m-t-20 bmc-widget-sub1 bmc-text-center">Customize the Buy Me a Coffee button on your website.</p>
                            <!-- <p class="bmc-m-t-30 bmc-preview bmc-text-center">Preview</p> -->
                            <div class="button-preview">
                                <div class="html-preview flex flex-both-center">
                                    <div class="embed-each-sec" id="btn-without-sup-count">
                                        <button class="generate-btn-preview flex flex-vert-center selected-yellow" style="background-color: <?php echo $data_user['background_color'] ?>;color:<?php echo $data_user['text_color'] ?>">
                                            <div class="flex">
                                                    <span class="btn-icon">
                                                        <svg class="m-l-5" id="coffee-logo-border" width="20px" height="28px" viewBox="0 0 884 1279" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M791.109 297.518L790.231 297.002L788.201 296.383C789.018 297.072 790.04 297.472 791.109 297.518Z" fill="#0D0C22"></path>
                                                            <path d="M803.896 388.891L802.916 389.166L803.896 388.891Z" fill="#0D0C22"></path>
                                                            <path d="M791.484 297.377C791.359 297.361 791.237 297.332 791.118 297.29C791.111 297.371 791.111 297.453 791.118 297.534C791.252 297.516 791.379 297.462 791.484 297.377Z" fill="#0D0C22"></path>
                                                            <path d="M791.113 297.529H791.244V297.447L791.113 297.529Z" fill="#0D0C22"></path>
                                                            <path d="M793.669 299.515L792.223 298.138L791.243 297.605C791.77 298.535 792.641 299.221 793.669 299.515Z" fill="#0D0C22"></path>
                                                            <path d="M430.019 1186.18C428.864 1186.68 427.852 1187.46 427.076 1188.45L427.988 1187.87C428.608 1187.3 429.485 1186.63 430.019 1186.18Z" fill="#0D0C22"></path>
                                                            <path d="M641.187 1144.63C641.187 1143.33 640.551 1143.57 640.705 1148.21C640.705 1147.84 640.86 1147.46 640.929 1147.1C641.015 1146.27 641.084 1145.46 641.187 1144.63Z" fill="#0D0C22"></path>
                                                            <path d="M619.284 1186.18C618.129 1186.68 617.118 1187.46 616.342 1188.45L617.254 1187.87C617.873 1187.3 618.751 1186.63 619.284 1186.18Z" fill="#0D0C22"></path>
                                                            <path d="M281.304 1196.06C280.427 1195.3 279.354 1194.8 278.207 1194.61C279.136 1195.06 280.065 1195.51 280.684 1195.85L281.304 1196.06Z" fill="#0D0C22"></path>
                                                            <path d="M247.841 1164.01C247.704 1162.66 247.288 1161.35 246.619 1160.16C247.093 1161.39 247.489 1162.66 247.806 1163.94L247.841 1164.01Z" fill="#0D0C22"></path>
                                                            <path class="y-path" d="M472.623 590.836C426.682 610.503 374.546 632.802 306.976 632.802C278.71 632.746 250.58 628.868 223.353 621.274L270.086 1101.08C271.74 1121.13 280.876 1139.83 295.679 1153.46C310.482 1167.09 329.87 1174.65 349.992 1174.65C349.992 1174.65 416.254 1178.09 438.365 1178.09C462.161 1178.09 533.516 1174.65 533.516 1174.65C553.636 1174.65 573.019 1167.08 587.819 1153.45C602.619 1139.82 611.752 1121.13 613.406 1101.08L663.459 570.876C641.091 563.237 618.516 558.161 593.068 558.161C549.054 558.144 513.591 573.303 472.623 590.836Z" fill="#FFDD00"></path>
                                                            <path d="M78.6885 386.132L79.4799 386.872L79.9962 387.182C79.5987 386.787 79.1603 386.435 78.6885 386.132Z" fill="#0D0C22"></path>
                                                            <path d="M879.567 341.849L872.53 306.352C866.215 274.503 851.882 244.409 819.19 232.898C808.711 229.215 796.821 227.633 788.786 220.01C780.751 212.388 778.376 200.55 776.518 189.572C773.076 169.423 769.842 149.257 766.314 129.143C763.269 111.85 760.86 92.4243 752.928 76.56C742.604 55.2584 721.182 42.8009 699.88 34.559C688.965 30.4844 677.826 27.0375 666.517 24.2352C613.297 10.1947 557.342 5.03277 502.591 2.09047C436.875 -1.53577 370.983 -0.443234 305.422 5.35968C256.625 9.79894 205.229 15.1674 158.858 32.0469C141.91 38.224 124.445 45.6399 111.558 58.7341C95.7448 74.8221 90.5829 99.7026 102.128 119.765C110.336 134.012 124.239 144.078 138.985 150.737C158.192 159.317 178.251 165.846 198.829 170.215C256.126 182.879 315.471 187.851 374.007 189.968C438.887 192.586 503.87 190.464 568.44 183.618C584.408 181.863 600.347 179.758 616.257 177.304C634.995 174.43 647.022 149.928 641.499 132.859C634.891 112.453 617.134 104.538 597.055 107.618C594.095 108.082 591.153 108.512 588.193 108.942L586.06 109.252C579.257 110.113 572.455 110.915 565.653 111.661C551.601 113.175 537.515 114.414 523.394 115.378C491.768 117.58 460.057 118.595 428.363 118.647C397.219 118.647 366.058 117.769 334.983 115.722C320.805 114.793 306.661 113.611 292.552 112.177C286.134 111.506 279.733 110.801 273.333 110.009L267.241 109.235L265.917 109.046L259.602 108.134C246.697 106.189 233.792 103.953 221.025 101.251C219.737 100.965 218.584 100.249 217.758 99.2193C216.932 98.1901 216.482 96.9099 216.482 95.5903C216.482 94.2706 216.932 92.9904 217.758 91.9612C218.584 90.9319 219.737 90.2152 221.025 89.9293H221.266C232.33 87.5721 243.479 85.5589 254.663 83.8038C258.392 83.2188 262.131 82.6453 265.882 82.0832H265.985C272.988 81.6186 280.026 80.3625 286.994 79.5366C347.624 73.2301 408.614 71.0801 469.538 73.1014C499.115 73.9618 528.676 75.6996 558.116 78.6935C564.448 79.3474 570.746 80.0357 577.043 80.8099C579.452 81.1025 581.878 81.4465 584.305 81.7391L589.191 82.4445C603.438 84.5667 617.61 87.1419 631.708 90.1703C652.597 94.7128 679.422 96.1925 688.713 119.077C691.673 126.338 693.015 134.408 694.649 142.03L696.732 151.752C696.786 151.926 696.826 152.105 696.852 152.285C701.773 175.227 706.7 198.169 711.632 221.111C711.994 222.806 712.002 224.557 711.657 226.255C711.312 227.954 710.621 229.562 709.626 230.982C708.632 232.401 707.355 233.6 705.877 234.504C704.398 235.408 702.75 235.997 701.033 236.236H700.895L697.884 236.649L694.908 237.044C685.478 238.272 676.038 239.419 666.586 240.486C647.968 242.608 629.322 244.443 610.648 245.992C573.539 249.077 536.356 251.102 499.098 252.066C480.114 252.57 461.135 252.806 442.162 252.771C366.643 252.712 291.189 248.322 216.173 239.625C208.051 238.662 199.93 237.629 191.808 236.58C198.106 237.389 187.231 235.96 185.029 235.651C179.867 234.928 174.705 234.177 169.543 233.397C152.216 230.798 134.993 227.598 117.7 224.793C96.7944 221.352 76.8005 223.073 57.8906 233.397C42.3685 241.891 29.8055 254.916 21.8776 270.735C13.7217 287.597 11.2956 305.956 7.64786 324.075C4.00009 342.193 -1.67805 361.688 0.472751 380.288C5.10128 420.431 33.165 453.054 73.5313 460.35C111.506 467.232 149.687 472.807 187.971 477.556C338.361 495.975 490.294 498.178 641.155 484.129C653.44 482.982 665.708 481.732 677.959 480.378C681.786 479.958 685.658 480.398 689.292 481.668C692.926 482.938 696.23 485.005 698.962 487.717C701.694 490.429 703.784 493.718 705.08 497.342C706.377 500.967 706.846 504.836 706.453 508.665L702.633 545.797C694.936 620.828 687.239 695.854 679.542 770.874C671.513 849.657 663.431 928.434 655.298 1007.2C653.004 1029.39 650.71 1051.57 648.416 1073.74C646.213 1095.58 645.904 1118.1 641.757 1139.68C635.218 1173.61 612.248 1194.45 578.73 1202.07C548.022 1209.06 516.652 1212.73 485.161 1213.01C450.249 1213.2 415.355 1211.65 380.443 1211.84C343.173 1212.05 297.525 1208.61 268.756 1180.87C243.479 1156.51 239.986 1118.36 236.545 1085.37C231.957 1041.7 227.409 998.039 222.9 954.381L197.607 711.615L181.244 554.538C180.968 551.94 180.693 549.376 180.435 546.76C178.473 528.023 165.207 509.681 144.301 510.627C126.407 511.418 106.069 526.629 108.168 546.76L120.298 663.214L145.385 904.104C152.532 972.528 159.661 1040.96 166.773 1109.41C168.15 1122.52 169.44 1135.67 170.885 1148.78C178.749 1220.43 233.465 1259.04 301.224 1269.91C340.799 1276.28 381.337 1277.59 421.497 1278.24C472.979 1279.07 524.977 1281.05 575.615 1271.72C650.653 1257.95 706.952 1207.85 714.987 1130.13C717.282 1107.69 719.576 1085.25 721.87 1062.8C729.498 988.559 737.115 914.313 744.72 840.061L769.601 597.451L781.009 486.263C781.577 480.749 783.905 475.565 787.649 471.478C791.392 467.391 796.352 464.617 801.794 463.567C823.25 459.386 843.761 452.245 859.023 435.916C883.318 409.918 888.153 376.021 879.567 341.849ZM72.4301 365.835C72.757 365.68 72.1548 368.484 71.8967 369.792C71.8451 367.813 71.9483 366.058 72.4301 365.835ZM74.5121 381.94C74.6842 381.819 75.2003 382.508 75.7337 383.334C74.925 382.576 74.4089 382.009 74.4949 381.94H74.5121ZM76.5597 384.641C77.2996 385.897 77.6953 386.689 76.5597 384.641V384.641ZM80.672 387.979H80.7752C80.7752 388.1 80.9645 388.22 81.0333 388.341C80.9192 388.208 80.7925 388.087 80.6548 387.979H80.672ZM800.796 382.989C793.088 390.319 781.473 393.726 769.996 395.43C641.292 414.529 510.713 424.199 380.597 419.932C287.476 416.749 195.336 406.407 103.144 393.382C94.1102 392.109 84.3197 390.457 78.1082 383.798C66.4078 371.237 72.1548 345.944 75.2003 330.768C77.9878 316.865 83.3218 298.334 99.8572 296.355C125.667 293.327 155.64 304.218 181.175 308.09C211.917 312.781 242.774 316.538 273.745 319.36C405.925 331.405 540.325 329.529 671.92 311.91C695.906 308.686 719.805 304.941 743.619 300.674C764.835 296.871 788.356 289.731 801.175 311.703C809.967 326.673 811.137 346.701 809.778 363.615C809.359 370.984 806.139 377.915 800.779 382.989H800.796Z" fill="#0D0C22"></path>
                                                        </svg> </span>
                                                <span class="btn-custom-text" style="margin-left:10px"><?php echo $data_user['widget_text'] ?></span>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="embed-each-sec" id="btn-with-sup-count" style="display:none">
                                        <button class="generate-btn-preview btn-with-sup-count flex flex-vert-center selected-yellow p-relative" style="padding-right: 60px;">
                                            <div class="flex">
                                                    <span class="btn-icon">
                                                        <svg class="m-l-5" width="20px" height="28px" viewBox="0 0 884 1279" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M791.109 297.518L790.231 297.002L788.201 296.383C789.018 297.072 790.04 297.472 791.109 297.518Z" fill="#0D0C22"></path>
                                                            <path d="M803.896 388.891L802.916 389.166L803.896 388.891Z" fill="#0D0C22"></path>
                                                            <path d="M791.484 297.377C791.359 297.361 791.237 297.332 791.118 297.29C791.111 297.371 791.111 297.453 791.118 297.534C791.252 297.516 791.379 297.462 791.484 297.377Z" fill="#0D0C22"></path>
                                                            <path d="M791.113 297.529H791.244V297.447L791.113 297.529Z" fill="#0D0C22"></path>
                                                            <path d="M793.669 299.515L792.223 298.138L791.243 297.605C791.77 298.535 792.641 299.221 793.669 299.515Z" fill="#0D0C22"></path>
                                                            <path d="M430.019 1186.18C428.864 1186.68 427.852 1187.46 427.076 1188.45L427.988 1187.87C428.608 1187.3 429.485 1186.63 430.019 1186.18Z" fill="#0D0C22"></path>
                                                            <path d="M641.187 1144.63C641.187 1143.33 640.551 1143.57 640.705 1148.21C640.705 1147.84 640.86 1147.46 640.929 1147.1C641.015 1146.27 641.084 1145.46 641.187 1144.63Z" fill="#0D0C22"></path>
                                                            <path d="M619.284 1186.18C618.129 1186.68 617.118 1187.46 616.342 1188.45L617.254 1187.87C617.873 1187.3 618.751 1186.63 619.284 1186.18Z" fill="#0D0C22"></path>
                                                            <path d="M281.304 1196.06C280.427 1195.3 279.354 1194.8 278.207 1194.61C279.136 1195.06 280.065 1195.51 280.684 1195.85L281.304 1196.06Z" fill="#0D0C22"></path>
                                                            <path d="M247.841 1164.01C247.704 1162.66 247.288 1161.35 246.619 1160.16C247.093 1161.39 247.489 1162.66 247.806 1163.94L247.841 1164.01Z" fill="#0D0C22"></path>
                                                            <path class="y-path" d="M472.623 590.836C426.682 610.503 374.546 632.802 306.976 632.802C278.71 632.746 250.58 628.868 223.353 621.274L270.086 1101.08C271.74 1121.13 280.876 1139.83 295.679 1153.46C310.482 1167.09 329.87 1174.65 349.992 1174.65C349.992 1174.65 416.254 1178.09 438.365 1178.09C462.161 1178.09 533.516 1174.65 533.516 1174.65C553.636 1174.65 573.019 1167.08 587.819 1153.45C602.619 1139.82 611.752 1121.13 613.406 1101.08L663.459 570.876C641.091 563.237 618.516 558.161 593.068 558.161C549.054 558.144 513.591 573.303 472.623 590.836Z" fill="#FFDD00"></path>
                                                            <path d="M78.6885 386.132L79.4799 386.872L79.9962 387.182C79.5987 386.787 79.1603 386.435 78.6885 386.132Z" fill="#0D0C22"></path>
                                                            <path d="M879.567 341.849L872.53 306.352C866.215 274.503 851.882 244.409 819.19 232.898C808.711 229.215 796.821 227.633 788.786 220.01C780.751 212.388 778.376 200.55 776.518 189.572C773.076 169.423 769.842 149.257 766.314 129.143C763.269 111.85 760.86 92.4243 752.928 76.56C742.604 55.2584 721.182 42.8009 699.88 34.559C688.965 30.4844 677.826 27.0375 666.517 24.2352C613.297 10.1947 557.342 5.03277 502.591 2.09047C436.875 -1.53577 370.983 -0.443234 305.422 5.35968C256.625 9.79894 205.229 15.1674 158.858 32.0469C141.91 38.224 124.445 45.6399 111.558 58.7341C95.7448 74.8221 90.5829 99.7026 102.128 119.765C110.336 134.012 124.239 144.078 138.985 150.737C158.192 159.317 178.251 165.846 198.829 170.215C256.126 182.879 315.471 187.851 374.007 189.968C438.887 192.586 503.87 190.464 568.44 183.618C584.408 181.863 600.347 179.758 616.257 177.304C634.995 174.43 647.022 149.928 641.499 132.859C634.891 112.453 617.134 104.538 597.055 107.618C594.095 108.082 591.153 108.512 588.193 108.942L586.06 109.252C579.257 110.113 572.455 110.915 565.653 111.661C551.601 113.175 537.515 114.414 523.394 115.378C491.768 117.58 460.057 118.595 428.363 118.647C397.219 118.647 366.058 117.769 334.983 115.722C320.805 114.793 306.661 113.611 292.552 112.177C286.134 111.506 279.733 110.801 273.333 110.009L267.241 109.235L265.917 109.046L259.602 108.134C246.697 106.189 233.792 103.953 221.025 101.251C219.737 100.965 218.584 100.249 217.758 99.2193C216.932 98.1901 216.482 96.9099 216.482 95.5903C216.482 94.2706 216.932 92.9904 217.758 91.9612C218.584 90.9319 219.737 90.2152 221.025 89.9293H221.266C232.33 87.5721 243.479 85.5589 254.663 83.8038C258.392 83.2188 262.131 82.6453 265.882 82.0832H265.985C272.988 81.6186 280.026 80.3625 286.994 79.5366C347.624 73.2301 408.614 71.0801 469.538 73.1014C499.115 73.9618 528.676 75.6996 558.116 78.6935C564.448 79.3474 570.746 80.0357 577.043 80.8099C579.452 81.1025 581.878 81.4465 584.305 81.7391L589.191 82.4445C603.438 84.5667 617.61 87.1419 631.708 90.1703C652.597 94.7128 679.422 96.1925 688.713 119.077C691.673 126.338 693.015 134.408 694.649 142.03L696.732 151.752C696.786 151.926 696.826 152.105 696.852 152.285C701.773 175.227 706.7 198.169 711.632 221.111C711.994 222.806 712.002 224.557 711.657 226.255C711.312 227.954 710.621 229.562 709.626 230.982C708.632 232.401 707.355 233.6 705.877 234.504C704.398 235.408 702.75 235.997 701.033 236.236H700.895L697.884 236.649L694.908 237.044C685.478 238.272 676.038 239.419 666.586 240.486C647.968 242.608 629.322 244.443 610.648 245.992C573.539 249.077 536.356 251.102 499.098 252.066C480.114 252.57 461.135 252.806 442.162 252.771C366.643 252.712 291.189 248.322 216.173 239.625C208.051 238.662 199.93 237.629 191.808 236.58C198.106 237.389 187.231 235.96 185.029 235.651C179.867 234.928 174.705 234.177 169.543 233.397C152.216 230.798 134.993 227.598 117.7 224.793C96.7944 221.352 76.8005 223.073 57.8906 233.397C42.3685 241.891 29.8055 254.916 21.8776 270.735C13.7217 287.597 11.2956 305.956 7.64786 324.075C4.00009 342.193 -1.67805 361.688 0.472751 380.288C5.10128 420.431 33.165 453.054 73.5313 460.35C111.506 467.232 149.687 472.807 187.971 477.556C338.361 495.975 490.294 498.178 641.155 484.129C653.44 482.982 665.708 481.732 677.959 480.378C681.786 479.958 685.658 480.398 689.292 481.668C692.926 482.938 696.23 485.005 698.962 487.717C701.694 490.429 703.784 493.718 705.08 497.342C706.377 500.967 706.846 504.836 706.453 508.665L702.633 545.797C694.936 620.828 687.239 695.854 679.542 770.874C671.513 849.657 663.431 928.434 655.298 1007.2C653.004 1029.39 650.71 1051.57 648.416 1073.74C646.213 1095.58 645.904 1118.1 641.757 1139.68C635.218 1173.61 612.248 1194.45 578.73 1202.07C548.022 1209.06 516.652 1212.73 485.161 1213.01C450.249 1213.2 415.355 1211.65 380.443 1211.84C343.173 1212.05 297.525 1208.61 268.756 1180.87C243.479 1156.51 239.986 1118.36 236.545 1085.37C231.957 1041.7 227.409 998.039 222.9 954.381L197.607 711.615L181.244 554.538C180.968 551.94 180.693 549.376 180.435 546.76C178.473 528.023 165.207 509.681 144.301 510.627C126.407 511.418 106.069 526.629 108.168 546.76L120.298 663.214L145.385 904.104C152.532 972.528 159.661 1040.96 166.773 1109.41C168.15 1122.52 169.44 1135.67 170.885 1148.78C178.749 1220.43 233.465 1259.04 301.224 1269.91C340.799 1276.28 381.337 1277.59 421.497 1278.24C472.979 1279.07 524.977 1281.05 575.615 1271.72C650.653 1257.95 706.952 1207.85 714.987 1130.13C717.282 1107.69 719.576 1085.25 721.87 1062.8C729.498 988.559 737.115 914.313 744.72 840.061L769.601 597.451L781.009 486.263C781.577 480.749 783.905 475.565 787.649 471.478C791.392 467.391 796.352 464.617 801.794 463.567C823.25 459.386 843.761 452.245 859.023 435.916C883.318 409.918 888.153 376.021 879.567 341.849ZM72.4301 365.835C72.757 365.68 72.1548 368.484 71.8967 369.792C71.8451 367.813 71.9483 366.058 72.4301 365.835ZM74.5121 381.94C74.6842 381.819 75.2003 382.508 75.7337 383.334C74.925 382.576 74.4089 382.009 74.4949 381.94H74.5121ZM76.5597 384.641C77.2996 385.897 77.6953 386.689 76.5597 384.641V384.641ZM80.672 387.979H80.7752C80.7752 388.1 80.9645 388.22 81.0333 388.341C80.9192 388.208 80.7925 388.087 80.6548 387.979H80.672ZM800.796 382.989C793.088 390.319 781.473 393.726 769.996 395.43C641.292 414.529 510.713 424.199 380.597 419.932C287.476 416.749 195.336 406.407 103.144 393.382C94.1102 392.109 84.3197 390.457 78.1082 383.798C66.4078 371.237 72.1548 345.944 75.2003 330.768C77.9878 316.865 83.3218 298.334 99.8572 296.355C125.667 293.327 155.64 304.218 181.175 308.09C211.917 312.781 242.774 316.538 273.745 319.36C405.925 331.405 540.325 329.529 671.92 311.91C695.906 308.686 719.805 304.941 743.619 300.674C764.835 296.871 788.356 289.731 801.175 311.703C809.967 326.673 811.137 346.701 809.778 363.615C809.359 370.984 806.139 377.915 800.779 382.989H800.796Z" fill="#0D0C22"></path>
                                                        </svg> </span>
                                                <span class="btn-custom-text" style="margin-left:8px">Buy Me a coffee</span>
                                                <div class="sup-count-on-btn p-absolute">
                                                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.58649 13.4536C7.51629 13.4536 7.30561 13.3809 7.30561 13.3809C5.76066 12.581 2.10902 10.3267 0.844987 6.76361C0.634314 6.10918 0.142748 3.41863 1.68767 1.74613C2.60058 0.728092 3.44327 0.582657 4.00506 0.582657C5.33932 0.582657 6.74378 1.38255 7.58649 2.54602C8.42915 1.30983 9.69322 0.582657 11.1679 0.582657C11.7297 0.582657 12.5724 0.728092 13.5555 1.74613C15.1004 3.41863 14.6089 6.1819 14.3982 6.76361C13.1342 10.3995 9.41228 12.581 7.93758 13.3809C7.79717 13.4536 7.6567 13.4536 7.58649 13.4536Z" fill="white"></path>
                                                    </svg>
                                                    <div class="supp-count-on-btn" style="margin-top: -16px;">89</div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="bmc-preview bmc-text-center bmc-m-t-30">Enter your text</p> -->
                            <div class="bmc-flex bmc-flex-center" style="padding-top: 16px !important;">

                                <div class="input-container">
                                    <span>Custom Text</span>
                                    <input id="bmc-source" class="input" type="text" maxlength="30" value="<?php echo $data_user['widget_text']; ?>">
                                </div>
                                <div class="input-container">
                                    <span>Choose font</span>
                                    <select id="bmc_font" class="select_align" name="profile_country" style="width: 205px;">
                                        <span class="caret"></span>
                                        <?php if ($data_user['font_family'] == "Cookie") {
                                            ?>
                                            <option value="Default">Default</option>
                                            <option value="Lato">Lato</option>
                                            <option value="Arial">Arial</option>
                                            <option value="Comic+Neue">Comic</option>
                                            <option value="Inter">Inter</option>
                                            <option value="Bree+Serif">Bree</option>
                                            <option value="Poppins">Poppins</option>

                                            <?php
                                        } else if ($data_user['font_family'] == "Lato") {
                                            ?>
                                            <option value="Lato">Lato</option>
                                            <option value="Default">Default</option>
                                            <option value="Arial">Arial</option>
                                            <option value="Comic+Neue">Comic</option>
                                            <option value="Inter">Inter</option>
                                            <option value="Bree+Serif">Bree</option>
                                            <option value="Poppins">Poppins</option>

                                            <?php
                                        } else if ($data_user['font_family'] == "Arial") {
                                            ?>
                                            <option value="Arial">Arial</option>
                                            <option value="Default">Default</option>
                                            <option value="Lato">Lato</option>
                                            <option value="Comic+Neue">Comic</option>
                                            <option value="Inter">Inter</option>
                                            <option value="Bree+Serif">Bree</option>
                                            <option value="Poppins">Poppins</option>


                                            <?php
                                        } else if ($data_user['font_family'] == "Comic+Neue") {
                                            ?>
                                            <option value="Comic+Neue">Comic</option>
                                            <option value="Default">Default</option>
                                            <option value="Lato">Lato</option>
                                            <option value="Arial">Arial</option>
                                            <option value="Inter">Inter</option>
                                            <option value="Bree+Serif">Bree</option>
                                            <option value="Poppins">Poppins</option>

                                            <?php
                                        } else if ($data_user['font_family'] == "Inter") {
                                            ?>
                                            <option value="Inter">Inter</option>
                                            <option value="Default">Default</option>
                                            <option value="Lato">Lato</option>
                                            <option value="Arial">Arial</option>
                                            <option value="Comic+Neue">Comic</option>
                                            <option value="Bree+Serif">Bree</option>
                                            <option value="Poppins">Poppins</option>


                                            <?php
                                        } else if ($data_user['font_family'] == "Bree+Serif") {
                                            ?>
                                            <option value="Bree+Serif">Bree</option>
                                            <option value="Default">Default</option>
                                            <option value="Lato">Lato</option>
                                            <option value="Arial">Arial</option>
                                            <option value="Comic+Neue">Comic</option>
                                            <option value="Inter">Inter</option>
                                            <option value="Poppins">Poppins</option>

                                            <?php
                                        } else if ($data_user['font_family'] == "Poppins") {
                                            ?>
                                            <option value="Poppins">Poppins</option>
                                            <option value="Default">Default</option>
                                            <option value="Lato">Lato</option>
                                            <option value="Arial">Arial</option>
                                            <option value="Comic+Neue">Comic</option>
                                            <option value="Inter">Inter</option>
                                            <option value="Bree+Serif">Bree</option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <script type="text/javascript">
                                function Confirm(form) {
                                    // console.log('form');
                                    // form?.submit();
                                    jQuery( "#widget_form" ).submit(function( event ) {
                                        // use ajax call in here, this will now refer to your form
                                        var serialized = $(this).serialize();
                                    });
                                }
                                jQuery("#bmc_font").change(function() {

                                    // jQuery("#bmc-rect").css({"font-family": "monospace"});
                                    var text = jQuery("#bmc_font").val();
                                    // alert(text);

                                    if (text == "Lato") {
                                        jQuery(".btn-custom-text").css({
                                            "font-family": "Lato,sans-serif",
                                            "font-size": "20px",
                                            "font-weight":'normal'
                                        });
                                        jQuery('#bmc-btn-fontfamily').val("Lato");


                                    } else if (text == "Default") {
                                        jQuery(".btn-custom-text").css({
                                            "font-family": "Cookie",
                                            "font-size": "28px",
                                            "font-weight":'normal'
                                        });
                                        jQuery('#bmc-btn-fontfamily').val("Cookie");

                                    } else if (text == "Comic+Neue") {
                                        jQuery(".btn-custom-text").css({
                                            "font-family": "Comic Neue",
                                            "font-size": "20px",
                                            "font-weight":'normal'
                                        });
                                        jQuery('#bmc-btn-fontfamily').val("Comic+Neue");

                                    } else if (text == "Inter") {
                                        jQuery(".btn-custom-text").css({
                                            "font-family": "Inter",
                                            "font-size": "20px",
                                            "font-weight":'normal'
                                        });
                                        jQuery('#bmc-btn-fontfamily').val("Inter");

                                    } else if (text == "Arial") {
                                        jQuery(".btn-custom-text").css({
                                            "font-family": "Arial",
                                            "font-size": "20px",
                                            "font-weight":'normal'
                                        });
                                        jQuery('#bmc-btn-fontfamily').val("Arial");

                                    } else if (text == "Bree+Serif") {
                                        jQuery(".btn-custom-text").css({
                                            "font-family": "Bree Serif",
                                            "font-size": "20px",
                                            "font-weight":'normal'
                                        });
                                        jQuery('#bmc-btn-fontfamily').val("Bree+Serif");

                                    } else if (text == "Poppins") {
                                        jQuery(".btn-custom-text").css({
                                            "font-family": "Poppins",
                                            "font-size": "20px",
                                            "font-weight":'normal'
                                        });
                                        jQuery('#bmc-btn-fontfamily').val("Poppins");

                                    }
                                });
                            </script>
                            <div class="bmc-text-center bmc-m-t-50">
                                <div class="input-container" style="display: inline-flex !important;">
                                    <span style="width: 100%; left: 0 !important;">Background color</span>
                                    <div class="bmc-flex bmc-flex-center bmc-choose-bmc-widget">
                                        <div class="bmc-flex bmc-flex-center bmc-choose-bmc" style="margin-top: 8px; margin-bottom:16px;">

                                            <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="orange" data-color="#FF813F"
                                               style="width: 41px;height: 41px;border-radius: 50%;">
                                                <div class="custom-clr custom-orange"></div>
                                            </a>
                                            <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="blue" data-color="#5F7FFF"
                                               style="width: 41px;height: 41px;border-radius: 50%;">
                                                <div class="custom-clr custom-blue"></div>
                                            </a>
                                            <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="violet" data-color="#BD5FFF"
                                               style="width: 41px;height: 41px;border-radius: 50%;">
                                                <div class="custom-clr custom-violet"></div>
                                            </a>
                                            <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="red" data-color="#FF5F5F"
                                               style="width: 41px;height: 41px;border-radius: 50%;">
                                                <div class="custom-clr custom-red"></div>
                                            </a>
                                            <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="green" data-color="#40DCA5"
                                               style="width: 41px;height: 41px;border-radius: 50%;">
                                                <div class="custom-clr custom-green"></div>
                                            </a>
                                            <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="green" data-color="#F471FF"
                                               style="width: 41px;height: 41px;border-radius: 50%;">
                                                <div class="custom-clr custom-pink"></div>
                                            </a>
                                            <a class="jscolor bmc-custom-clr1" href="javascript:void(null)" data-img="yellow" data-color="#FFDD00" style="width: 41px;height: 41px;border-radius: 50%;">
                                                <div class="custom-clr custom-yellow"></div>
                                            </a>
                                            <div class="bmc-custom-clr1">
                                                <div id="custom-color" style="position: relative;display: flex;align-items: center;justify-content: center;background-color: rgb(0,0,0);border-radius: 50%;height: 41px;width: 41px;" class="jscolor" data-img="pink" data-color="#000000">
                                                    <svg class="color-plus-ion" style="position:absolute;" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path d="M12.4778 5.88733C11.9885 6.43667 12.0345 7.27867 12.5832 7.77067L11.6945 8.76467L6.7245 4.32L7.61384 3.32667C8.16184 3.81733 9.00517 3.77067 9.49517 3.22067L11.8305 0.666667C12.2258 0.224667 12.7732 0 13.3225 0C14.4332 0 15.3332 0.905333 15.3332 1.99733C15.3332 2.47933 15.1525 2.954 14.8138 3.334L12.4778 5.88733ZM6.99984 10H5.20584L7.8245 7.092L6.8305 6.20333L1.56384 12.066C0.712504 13.0147 1.44984 13.5733 0.797837 14.7673C0.707837 14.93 0.666504 15.0873 0.666504 15.2327C0.666504 15.6733 1.0265 16 1.42717 16C1.58784 16 1.75517 15.9473 1.90984 15.8293C3.06517 14.9413 3.6725 15.7067 4.54584 14.7313L9.81317 8.87L8.81917 7.98133L6.99984 10Z" fill="white" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0">
                                                                <rect width="16" height="16" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <input style="opacity:0" class="custom-clr custom-pink" type="color" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#FFFFFF">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button form-->
                                <form action="<?php echo get_admin_url('', 'admin-post.php') ?>" method="post">
                                    <?php wp_nonce_field('bmc_post_reception'); ?>
                                    <input type="hidden" name="action" value="<?php echo 'bmc_post_reception' ?>">
                                    <!-- <input id="bmc-code" type="hidden" name="data" value=""> -->
                                    <input id="bmc-btn-color" type="hidden" name="text_color" value="<?php echo $data_user['text_color']; ?>">
                                    <input id="bmc-btn-bcolor" type="hidden" name="background_color" value="<?php echo $data_user['background_color'] ?>">
                                    <input id="bmc-btn-fontfamily" type="hidden" name="font_family" value="<?php echo $data_user['font_family'] ?>">
                                    <input id="bmc-btn-text" type="hidden" name="text" value="<?php echo $data_user['widget_text']; ?>">
                                    <input name="bmc-user-name" type="hidden" value="<?php echo $data_user['name']; ?>">
                                    <div class="bmc-text-center bmc-m-t-50" style="padding-top: 8px;">

                                        <?php if (isset($_GET['status'])) {
                                            if ($_GET['status'] == 'true') {
                                                ?>
                                                <button id="widget-btn" type="submit" class="button_bmc_widget">
                                                    <span id="widget-btn-text">Save changes</span>
                                                    <svg id="widget-btn-loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: none; shape-rendering: auto;" width="18px" height="18px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                                        <circle cx="50" cy="50" fill="none" stroke="#ffffff" stroke-width="10" r="40" stroke-dasharray="188.49555921538757 64.83185307179586" transform="rotate(6.77628 50 50)">
                                                            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                                        </circle>
                                                    </svg>
                                                </button>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <button type="submit" class="bmc-button1 bmc-button-primary1">Add to widgets</button>
                                            <?php
                                        } ?>
                                        <!-- <button type="submit" class="bmc-code-copy-btn bmc-copy-code">ADD TO WIDGETS</button> -->
                                    </div>
                                </form>




                                <!-- <div class="bmc-text-center bmc-m-t-50"> -->
                                <!-- <a href="javascript:void(null)" class="bmc-code-copy-btn bmc-copy-code">ADD TO WIDGETS</a> -->
                                <!-- </div> -->

                            </div>
                        </div>
                    </div>
                    <?php
                    } ?>
                </div>
                <!-- <div id="modal" class="modal"> -->
                <!-- </div> -->
                <p class="bmc-m-t-30 bmc-widget-sub1 bmc-text-center">Visit your <a target="_blank" class="bmc-link" href="https://www.buymeacoffee.com/dashboard">Buy Me a Coffee dashboard</a> for complete payment history, payout requests and other settings.</p>
                <!-- /.. Widgets section -->


            </div> <!-- /..container-->

            <div class="bmc-footer">
                <div class="bmc-foot"></div>
                <p class="bmc-para">
                <center class="copyright1">© <?php echo date("Y");
                    ?> Buy Me a Coffee</center>
                </p>
                <div class="bmc-flex bmc-flex-center">

                    <a class="bmc-foot-links1" href="https://www.buymeacoffee.com/about">About</a>
                    <a class="bmc-foot-links1" href="https://www.buymeacoffee.com/brand">Brand</a>

                    <a class="bmc-foot-links1" href="https://help.buymeacoffee.com/">Help</a>
                    <a class="bmc-foot-links1" href="https://www.buymeacoffee.com/terms">Terms</a>
                    <a class="bmc-foot-links1" href="https://www.buymeacoffee.com/library">Blog</a>

                </div>

                <ul class="f-links">
                    <li><a class="about-social" target="_blank" href="https://www.instagram.com/buymeacoffee/"><img alt="" src="https://www.buymeacoffee.com/assets/img/home/xinstagram-footer-logo.png.pagespeed.ic.bqgn0OsF37.webp" onerror="this.onerror=null;pagespeed.lazyLoadImages.loadIfVisibleAndMaybeBeacon(this);"></a></li>
                    <li><a class="about-social" target="_blank" href="https://twitter.com/BuyMeACoffee"><img alt="" src="https://www.buymeacoffee.com/assets/img/home/xtwitter-footer-logo.png.pagespeed.ic.YKCDVSPMav.webp" onerror="this.onerror=null;pagespeed.lazyLoadImages.loadIfVisibleAndMaybeBeacon(this);"></a></li>
                </ul>
            </div>

        </div> <!-- BMC body color-->
        <script src="<?php echo (FJS) ?>jquery.min.js"></script>

        <script src="<?php echo (FJS) ?>bootstrap.min.js"></script>

        <script src="<?php echo (FJS) ?>jscolor.js"></script>

        <script>
            var $ = jQuery;
            jQuery('#save-btn').click(function() {
                jQuery('#save-btn-text').hide();
                jQuery('#save-btn-loader').show();
            });
            jQuery('#customize-btn').click(function() {
                jQuery('#customize-btn-text').hide();
                jQuery('#customize-btn-loader').show();
            });
            jQuery('#widget-btn').click(function() {
                jQuery('#widget-btn-text').hide();
                jQuery('#widget-btn-loader').show();
            });

            function valueChanged2() {

                jQuery('#switch2').attr('checked', !jQuery('#switch2').attr('checked'));
                if ($('#switch2').prop("checked") == true) {
                    // console.log("on valueChanged2");
                    $("#switch2").val('1');
                    $(".answer_tip2").text("Turn off widget");
                    $('#widget_toggle_form').submit();
                    document.querySelector('.trigger').style.display = "inline-flex";
                } else {
                    // console.log("off valueChanged2");
                    $("#switch2").val('0');
                    $('#widget_toggle_form').submit();
                    document.querySelector('.trigger').style.display = "none";
                }
            }


            function toggleModal() {
                $(window).scrollTop(0);
                $('.hide-on-widget').css('display', 'none');
                var modal = document.getElementById('modal-section');
                modal.classList.toggle('show-modal');
                modal.style.display = "block";

                var widgetFile = "https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js"
                var descriptionTextValue = $('#descriptionText').val();
                if ($('#messageText').val() == '') {
                    var messageTextValue = '';
                } else {
                    var messageTextValue = $('#messageText').val()
                }
                var userName = $('#user_name').val();
                var WcolorValue = $('#widget_color').val();
                var widgetPosValue = $('#widgetPos').val();
                var sideSpaceValue = $('#sideSpace').val();
                var bottomSpaceValue = $('#bottomSpace').val();
                // function updateWidget() {
                var posRule = (widgetPosValue.toLowerCase() === 'left')
                    ? 'left:' + sideSpaceValue + 'px!important;right:auto!important;'
                    : 'right:' + sideSpaceValue + 'px!important;left:auto!important;';
                var transformOriginRule = (widgetPosValue.toLowerCase() === 'left')
                    ? 'transform-origin:left bottom!important;'
                    : 'transform-origin:right bottom!important;';
                var previewStyle = '<style>#bmc-iframe{position:fixed!important;top:auto!important;bottom:' + (parseInt(bottomSpaceValue) + 72) + 'px!important;' + posRule + 'width:420px!important;max-width:420px!important;height:640px!important;min-height:0!important;max-height:640px!important;' + transformOriginRule + '}#bmc-close-btn{display:none!important;}</style>';
                $("#widgetPreview").append($("<iframe />").attr({
                    "srcdoc": '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge">' + previewStyle + '<script data-name="BMC-Widget" src="' + widgetFile + '" data-id="' + userName + '" data-description="' + descriptionTextValue + '" data-message="' + messageTextValue + '" data-color="' + WcolorValue + '" data-position="' + widgetPosValue + '" data-x_margin="' + sideSpaceValue + '" data-y_margin="' + bottomSpaceValue + '"><\/script></head><body></body></html>',
                    "id": "iframe",
                    "frameborder": "0",
                    'class': 'col-xs-12 m-t-20 widget-frame'
                }));

                $("#iframe").load(function() {
                    setTimeout(function() {
                        $("#iframe").contents().find('#bmc-wbtn').trigger("click");
                    }, 3000);
                });

                $('#descriptionText').keyup(debounce(function() {
                    descriptionTextValue = $('#descriptionText').val();
                    updateWidget();
                }, 1000));

                $('#messageText').keyup(debounce(function() {
                    messageTextValue = $('#messageText').val();
                    updateWidget();
                }, 1000));

                $('.bmc-choose-bmc-widget a').click(debounce(function(e) {
                    WcolorValue = $(this).data('color');
                    updateWidget();
                    document.getElementById('widget_color').value = $(this).data('color');
                    $(this).children().css("background-color", $(this).data('color'));
                }, 1000));

                $('#widgetPos').on('change', debounce(function(e) {
                    widgetPosValue = $(this).val();
                    updateWidget();
                }, 1000));

                $('#sideSpace').keyup(debounce(function() {
                    sideSpaceValue = $('#sideSpace').val();
                    updateWidget();
                }, 1000));

                $('#bottomSpace').keyup(debounce(function() {
                    bottomSpaceValue = $('#bottomSpace').val();
                    // console.log(bottomSpaceValue);
                    updateWidget();
                }, 1000));

                function debounce(func, wait, immediate) {
                    var timeout;
                    return function() {
                        var context = this,
                            args = arguments;
                        var later = function() {
                            timeout = null;
                            if (!immediate) func.apply(context, args);
                        };
                        var callNow = immediate && !timeout;
                        clearTimeout(timeout);
                        timeout = setTimeout(later, wait);
                        if (callNow) func.apply(context, args);
                    };
                };

                function updateWidget() {
                    var posRule = (widgetPosValue.toLowerCase() === 'left')
                        ? 'left:' + sideSpaceValue + 'px!important;right:auto!important;'
                        : 'right:' + sideSpaceValue + 'px!important;left:auto!important;';
                    var transformOriginRule = (widgetPosValue.toLowerCase() === 'left')
                        ? 'transform-origin:left bottom!important;'
                        : 'transform-origin:right bottom!important;';
                    var previewStyle = '<style>#bmc-iframe{position:fixed!important;top:auto!important;bottom:' + (parseInt(bottomSpaceValue) + 72) + 'px!important;' + posRule + 'width:420px!important;max-width:420px!important;height:640px!important;min-height:0!important;max-height:640px!important;' + transformOriginRule + '}#bmc-close-btn{display:none!important;}</style>';
                    $("#widgetPreview").html($("<iframe />").attr({
                        "srcdoc": '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge">' + previewStyle + '<script data-name="BMC-Widget" src="' + widgetFile + '" data-id="' + userName + '" data-description="' + descriptionTextValue + '" data-message="' + messageTextValue + '" data-color="' + WcolorValue + '" data-position="' + widgetPosValue + '" data-x_margin="' + sideSpaceValue + '" data-y_margin="' + bottomSpaceValue + '"><\/script></head><body></body></html>',
                        "id": "iframe",
                        "frameborder": "0",
                        'class': 'col-xs-12 m-t-20 widget-frame'
                    }));
                    $("#iframe").load(function() {
                        setTimeout(function() {
                            $("#iframe").contents().find('#bmc-wbtn').trigger("click");
                        }, 3000);
                    });
                }
            }

            function closeButton() {
                $('.hide-on-widget').css('display', 'block');
                var modal = document.getElementById('modal-section');
                $("#iframe").remove();
                modal.classList.toggle('show-modal');
                modal.style.display = "none";
            }

            function toggleModal1() {
                $(window).scrollTop(0);
                $('.hide-on-widget').css('display', 'none');
                var modal = document.getElementById('modal2-section');
                modal.style.display = "block";
                modal.classList.toggle('show-modal');
            }

            function closeButton2() {
                $('.hide-on-widget').css('display', 'block');
                var modal = document.getElementById('modal2-section');
                modal.classList.toggle('show-modal');
                modal.style.display = "none";
            }

        </script>
        <script>
            // modal 1 scripts
            const modal = document.querySelector('.modal');
            const trigger = document.querySelector('.trigger');
            const closeButton1 = document.querySelector('.close-button1');

            function toggleModal3() {
                modal.classList.toggle('show-modal');
            }

            closeButton1.addEventListener('click', toggleModal);
            // modal 2 scripts
            const modal2 = document.querySelector('.modal2')
            const trigger2 = document.querySelector('.trigger2')
            const closeButton21 = document.querySelector('.close-button2')
            const toggleModal2 = () => modal2.classList.toggle('show-modal')

            trigger2.addEventListener('click', toggleModal2)
            closeButton21.addEventListener('click', toggleModal2)
        </script>


        <script type="text/javascript">
            var $ = jQuery;
            popup_width();

            $(window).resize(function() {
                popup_width();
            });

            function popup_width() {
                var widthVal = jQuery('.bmc-width').css('width');
                if (!widthVal) return;
                var popup_width = widthVal.replace(/[^-\d\.]/g, '') - 80;
                $('#bmc-popup').width(popup_width);
            }

            $(document).ready(function() {
                $(window).scrollTop(0);
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        <script type="text/javascript">
            var $ = jQuery;
            var stat = jQuery('#popup-status').val();
            if (stat == 'true') {
                var x = document.getElementById("bmc-popup")
                x.className = "bmc-show";
                setTimeout(function() {
                    x.className = x.className.replace("bmc-show", "");
                }, 3250);
            }
            // else {
            //   alert("false");
            // }

            $('.bmc-dash-tabs').click(function() {
                $('.bmc-dash-tabs').removeClass('bmc-tab-active');
                $(this).addClass('bmc-tab-active');
                var section = $(this).attr('id');
                $('.bmc-tab').hide();
                $('#chosen-' + section).show();
            });
        </script>

        <script src="<?php echo (FJS) ?>Chart.bundle.js"></script>
        <script src="<?php echo (FJS) ?>utils.js"></script>

        <script type="text/javascript">
            var $ = jQuery;
            jQuery(".bmc-align-tab").click(function() {
                $(this).siblings(".bmc-align-tab").removeClass("bmc-tab-ac");
                $(this).addClass("bmc-tab-ac");
            });
        </script>


        <!-- BMC button choose (with text and color)-->
        <script type="text/javascript">
            var $ = jQuery;
            //basilEdit
            function update(jscolor) {
                // 'jscolor' instance can be used as a string
                $(".bmc-cus-btn").css("background-color", '#' + jscolor);
                $('#bmc-btn-bcolor').val('#' + jscolor);
            }

            function updateTextColor(jscolor) {
                // 'jscolor' instance can be used as a string
                $("#bmc-rect").css("color", '#' + jscolor);
                $('#bmc-btn-color').val('#' + jscolor);
            }


            $(document).ready(function() {
                var url = "<?php echo (FIMG) ?>";
                var slug = $("#bmc-slug").data('slug');
                var button_text = "<?php echo $data_user['widget_text']; ?>";
                var back_color = "<?php echo $data_user['background_color']; ?>";
                var color = "<?php echo $data_user['text_color']; ?>";
                var font_family = "<?php echo $data_user['font_family']; ?>";
                // alert(font_family);
                $('#coffee-logo-border path:nth-child(13)').css({
                    'fill': color
                });
                generate_code(color, back_color, button_text);

                if (back_color == "#FFDD00") {
                    $('#coffee-logo-border path:nth-child(11)').css({
                        'fill': '#ffffff'
                    });
                    // 			logo_coffeeColor='#ffffff';
                } else {
                    $('#coffee-logo-border path:nth-child(11)').css({
                        'fill': '#FFDD00'
                    });
                    // 			logo_coffeeColor='#ffdd00';
                }
                if (font_family == "Lato") {
                    jQuery(".btn-custom-text").css({
                        "font-family": "Lato,sans-serif",
                        "font-size": "20px",
                        "font-weight":'normal'
                    });



                } else if (font_family == "Arial") {
                    jQuery(".btn-custom-text").css({
                        "font-family": "Arial",
                        "font-size": "20px",
                        "font-weight":'normal'
                    });


                } else if (font_family == "Default") {
                    jQuery(".btn-custom-text").css({
                        "font-family": "Cookie",
                        "font-size": "23px",
                        "font-weight":'normal'
                    });


                } else if (font_family == "Comic+Neue") {
                    jQuery(".btn-custom-text").css({
                        "font-family": "Comic Neue",
                        "font-size": "20px",
                        "font-weight":'normal'
                    });

                } else if (font_family == "Inter") {
                    jQuery(".btn-custom-text").css({
                        "font-family": "Inter",
                        "font-size": "20px",
                        "font-weight":'normal'
                    });


                } else if (font_family == "Poppins") {
                    jQuery(".btn-custom-text").css({
                        "font-family": "Poppins",
                        "font-size": "20px",
                        "font-weight":'normal'
                    });


                } else if (font_family == "Bree+Serif") {
                    jQuery(".btn-custom-text").css({
                        "font-family": "Bree Serif",
                        "font-size": "20px",
                        "font-weight":'normal'
                    });


                }



                // choose color
                $(".bmc-choose-bmc a").click(function() {
                    $(".bmc-choose-bmc a .bmc-custom-clr").removeClass('bmc-clr-sel');
                    $(this).find('.bmc-custom-clr').addClass('bmc-clr-sel');
                    $('.bmc-add-btn').html('ADD TO WIDGETS');
                    back_color = $(this).data('color');

                    $('.generate-btn-preview').removeClass('selected-yellow');
                    if (back_color == '#FFDD00') {
                        $('.generate-btn-preview').addClass('selected-yellow');
                        $('.generate-btn-preview').css({
                            'background-color': '',
                            'color': ''
                        });
                        $('#coffee-logo-border path:nth-child(13)').css('fill', '#000000');
                        $('#coffee-logo-border path:nth-child(11)').css('fill', '#ffffff');
                        btn_fontColor = '#000000';
                    } else {
                        $('.generate-btn-preview').css({
                            'background-color': back_color,
                            'color': '#fff'
                        });
                        $('#coffee-logo-border path:nth-child(13)').css({
                            'fill': '#000000'
                        });
                        $('#coffee-logo-border path:nth-child(11)').css('fill', '#FFDD00');
                        btn_fontColor = '#ffffff';
                    }

                    $(".generate-btn-preview").css("background-color", back_color);

                    if (back_color == "#FFDD00" || back_color == "#FFFFFF") {
                        $(".generate-btn-preview").addClass("bmc-black-font");
                        generate_code("#000000", back_color, button_text);
                    } else {
                        $(".generate-btn-preview").removeClass("bmc-black-font");
                        $(".generate-btn-preview").css('color', '#ffffff');
                        generate_code("#FFFFFF", back_color, button_text);
                    }


                });





                $('#colorpicker').on('input', function() {
                    var bg_color = this.value;
                    $('#custom-color').css({
                        'background-color': bg_color
                    });
                    $('#custom-color').attr('data-color', bg_color);
                    $('.color-plus-ion path').css({
                        'stroke': '#fff'
                    });
                    $('.select-btn-color').removeClass('active');
                    lightOrDark(bg_color);
                });






                // choose text
                $('#bmc-source').keyup(function() {
                    var btn_txt = $(this).val();
                    $(".btn-custom-text").text(btn_txt);
                    $('.bmc-add-btn').html('ADD TO WIDGETS');
                    generate_code(color, back_color, btn_txt);
                    if (btn_txt == '' || !btn_txt.replace(/\s/g, '').length) {
                        $(".btn-custom-text").text("Buy Me a coffee");
                        generate_code(color, back_color, "Buy Me a coffee");
                    }
                });


                // generates code
                function generate_code(color, b_color, text) {
                    $('#bmc-btn-color').val(color);
                    $('#bmc-btn-bcolor').val(b_color);
                    $('#bmc-btn-fontfamily').val(font_family);

                    $('#bmc-btn-text').val(text);
                    button_text = text;

                    $('#bmc-code').val('<style>.bmc-button img{vertical-align: middle !important;}.bmc-button{display:inline-block !important;padding:0 10px !important;color:' + color + ' !important;background-color:' + b_color + ' !important;border-radius: 3px !important;border: 1px solid transparent !important;font-size: 26px !important;box-shadow: 0px 1px 2px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 1px 2px 2px rgba(190, 190, 190, 0.5) !important;-webkit-transition: 0.3s all linear !important;transition: 0.3s all linear !important;margin: 0 auto !important;font-family:"Cookie", cursive !important;}.bmc-button:hover, .bmc-button:active, .bmc-button:focus {-webkit-box-shadow: 0 4px 16px 0 rgba(190, 190, 190,.45) !important;box-shadow: 0 4px 16px 0 rgba(190, 190, 190,.45) !important;opacity: 0.85 !important;color:' + color + ' !important;}</style><link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet"><p style="text-align:center !important"><a class="bmc-button" href="' + slug + '"><img src="' + url + 'BMC-btn-logo.svg" alt="BMC logo"><span style="margin-left:5px">' + text + '</span></a></p>');
                }


                function lightOrDark(selected_color) {
                    back_color = selected_color;
                    var r, g, b, hsp;
                    if (selected_color.match(/^rgb/)) {
                        selected_color = selected_color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);
                        r = selected_color[1];
                        g = selected_color[2];
                        b = selected_color[3];
                    } else {
                        selected_color = +("0x" + selected_color.slice(1).replace(
                            selected_color.length < 5 && /./g, '$&$&'));

                        r = selected_color >> 16;
                        g = selected_color >> 8 & 255;
                        b = selected_color & 255;
                    }
                    hsp = Math.sqrt(
                        0.299 * (r * r) +
                        0.587 * (g * g) +
                        0.114 * (b * b)
                    );

                    $('.generate-btn-preview').removeClass('selected-yellow');
                    $('.generate-btn-preview').css({
                        'background-color': '',
                        'color': ''
                    });

                    if (back_color == 'rgb(255, 221, 0)' || back_color == '#ffdd00') {
                        $('.generate-btn-preview').addClass('selected-yellow');
                        $('.generate-btn-preview').css({
                            'background-color': '',
                            'color': ''
                        });
                        $('#coffee-logo-border path:nth-child(13)').css({
                            'fill': '#000000'
                        });
                        $('#coffee-logo-border path:nth-child(11)').css('fill', '#ffffff');
                        btn_fontColor = '#000000';
                    } else {
                        $('#coffee-logo-border path:nth-child(11)').css('fill', '#FFDD00');
                        if (hsp > 140.5) {
                            $(".generate-btn-preview").addClass("bmc-black-font");
                            $('.generate-btn-preview').css({
                                'background-color': back_color,
                                'color': '#000000'
                            });
                            $('.color-plus-ion path').css({
                                'fill': '#000000'
                            });
                            $('#coffee-logo-border path:nth-child(13)').css({
                                'fill': '#000000'
                            });
                            btn_fontColor = '#000000';
                            generate_code(btn_fontColor, back_color, button_text);
                        } else {
                            $(".generate-btn-preview").removeClass("bmc-black-font");
                            $('.generate-btn-preview').css({
                                'background-color': back_color,
                                'color': '#fff'
                            });
                            $('.color-plus-ion path').css({
                                'fill': '#ffffff'
                            });
                            btn_fontColor = '#ffffff';
                            $('#coffee-logo-border path:nth-child(13)').css({
                                'fill': '#ffffff'
                            });
                            generate_code(btn_fontColor, back_color, button_text);
                        }

                    }
                }

            });
        </script>
        <?php

    }
    public function getChar($name)
    {
        $string = $name;
        $expr = '/(?<=\s|^)[a-z]/i';
        preg_match_all($expr, $string, $matches);
        $result = implode('', $matches[0]);

        $short_name = strtoupper(substr($result, 0, 2));
        // $name_len = strlen($short_name);
        return $short_name;
    }
}
ob_end_clean();
?>