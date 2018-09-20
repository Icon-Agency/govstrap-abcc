<?php
/**
 * @file
 * page.tpl.php - Returns the HTML for a single Drupal page.
 */
?>

<div class="container">

    <div class="row">
        <div class="col-sm-6">
            <img src="/<?php print path_to_theme(); ?>/images/abcc-logo.svg" class="abcc-logo" alt="Australian Government Australian Building and Construction Commission">
        </div>
        <div class="col-sm-6 text-right">
            <img src="/<?php print path_to_theme(); ?>/images/logo.svg" class="logo" alt="Australian Building and Construction Commission">
        </div>
    </div>

    <div style="width: 100%; line-height: 30px; height: 30px; display: block; float: left;">&nbsp;</div>

    <!-- Begin custom print content -->

    <div class="row">
        <?php print render($page['content']); ?>
    </div>
    <!-- End custom print content -->

    <div style="width: 100%; line-height: 15px; height: 15px; display: block; float: left;">&nbsp;</div>

    <div class="row">
        <div class="col-sm-12 text-right text-small gray">
            <table cellpadding="0" cellspacing="0" border="0" class="float-right">
                <tr>
                    <td>
                        Need language help?<br>
                        Contact the Translating and Interpreting Service (TIS) on 13 14 50
                    </td>
                    <td>
                        <img src="/<?php print path_to_theme(); ?>/images/interpreter.png" style="height: 40px; width: 40px; margin-left: 10px; display: inline-block;">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <hr style="display: block; width: 100%; border: 0 none; border-top: 1px solid gray; float: left; margin: 7px 0;">



    <div style="width: 100%; line-height: 5px; height: 5px; display: block; float: left;">&nbsp;</div>

    <div class="row">
        <div class="col-sm-6 text-mini">
            <span>ABN 68 003 725 098</span>
        </div>
        <div class="col-sm-6 text-right float-right text-mini">
            <span>© Commonwealth of Australia <?php print date('Y'); ?></span>
        </div>
    </div>
</div>

<div style="page-break-after: always; clear: both;"></div>
