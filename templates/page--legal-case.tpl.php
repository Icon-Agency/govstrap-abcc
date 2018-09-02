<?php
/**
 * @file
 * page.tpl.php - Returns the HTML for a single Drupal page.
 */
?>
<?php $decision = trim(strtolower(render($node_content['field_case_decision']))); ?>
<div class="page">
    <!-- page mobile header -->
  <?php include 'includes/page-header--mobile.tpl.php'; ?>
    <!-- /page mobile header -->
    <div class="mm-content">
        <!-- page header -->
      <?php include 'includes/page-header.tpl.php'; ?>
        <!-- /page header -->

        <!-- page banner -->
        <div class="banner slim-line bg-dark-blue text-white theme-color-gradient-after">
            <div class="bg-img" style="background-size: contain; background-position-x: 100%; background-image: url(/<?php print path_to_theme(); ?>/images/banners/ABCC-Banner-0<?php print rand(1, 8);?>.png)">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 py-md-5 py-sm-0">
                          <?php if (!empty($breadcrumb)): ?>
                              <nav aria-label="breadcrumb" class="breadcrumbs">
                                <?php print $breadcrumb; ?>
                              </nav>
                          <?php endif ?>
                            <div class="text">
                                <div class="accent text-white">
                                  <?php print render($title_prefix); ?>
                                    <?php if ($decision == 'decision made'): ?>
                                    <span class="h5 font-family3 bold block pb-1 text-uppercase text-green"><?php print render($node_content['field_case_decision']); ?></span>
                                    <?php endif; ?>
                                  <?php if ($decision == 'no decision'): ?>
                                      <span class="h5 font-family3 bold block pb-1 text-uppercase text-blue"><?php print render($node_content['field_case_decision']); ?></span>
                                  <?php endif; ?>
                                    <h1><?php print render($node_content['field_known_as']); ?></h1>
                                    <?php print $title; ?>
                                  <?php print render($title_suffix); ?>
                                </div>
                            </div>

                            <div class="btn-wrap hidden-sm-down">
                              <?php if ($active_page_parent): ?>
                                  <a href="/<?php print $active_page_parent['link_path'];?>"><i class="fal fa-arrow-left"></i>Back to <?php print $active_page_parent['link_title'];?></a>
                              <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page banner -->
        <div class="bg-white">
          <?php if (!empty($page['highlighted'])): ?>
              <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
          <?php endif; ?>
          <?php if ($messages): ?>
              <div class="system-alert">
                <?php print $messages; ?>
              </div>
          <?php endif; ?>
            <div class="container py-5">
                <div class="row">
                    <!-- main page content -->
                    <div class="<?php print $content_column_class; ?> pb-5">

                        <section id="main-content-section" role="main">
                            <a id="main-content"></a>
                          <?php if (!empty($tabs)): ?>
                            <?php print render($tabs); ?>
                          <?php endif; ?>
                          <?php if (!empty($page['help'])): ?>
                            <?php print render($page['help']); ?>
                          <?php endif; ?>
                          <?php if (!empty($action_links)): ?>
                              <ul class="action-links"><?php print render($action_links); ?></ul>
                          <?php endif; ?>
                            <div id="page-content" class="content node-page-content">

                                <!-- Legal case fields -->

                                <?php if ($title): ?>
                                <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                    Case name
                                </div>
                              <?php print $title; ?>
                                <?php endif; ?>

                                <?php if ($node_content['field_known_as']): ?>
                                <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                    Known as
                                </div>
                              <?php print render($node_content['field_known_as']); ?>
                                <?php endif; ?>




                              <?php print render($node_content['field_commonwealth_courts_ref']); ?>

                              <?php print render($node_content['field_applicant']); ?>

                              <?php print render($node_content['field_respondents']); ?>

                              <?php print render($node_content['field_date_filed']); ?>

                              <?php print render($node_content['field_state_no_permit']); ?>

                              <?php if ($node_content['field_breaches']): ?>
                                <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                <?php if($decision == 'decision made'): ?>
                                    Breach(es) found
                                <?php endif; ?>
                                <?php if($decision == 'no decision'): ?>
                                    Alleged breach(es) at time of filing
                                <?php endif; ?>
                                </div>
                                <?php print render($node_content['field_breaches']); ?>
                              <?php endif; ?>

                              <?php print render($node_content['field_case_status']); ?>


                              <!-- Various links to judgement -->
                              <?php if($decision == 'decision made'): ?>
                                <?php
                                    $field_liability_judgement = render($node_content['field_liability_judgement']);
                                    $field_penalty_judgement = render($node_content['field_penalty_judgement']);
                                    $field_liability_and_penalty = render($node_content['field_liability_and_penalty']);
                                    $field_full_court_appeal_ref = render($node_content['field_full_court_appeal_ref']);
                                    $field_high_court_appeal_ref = render($node_content['field_high_court_appeal_ref']);
                                    $field_federal_court_appeal_judge = render($node_content['field_federal_court_appeal_judge']);
                                    $field_high_court_appeal_judgemenrender = render($node_content['field_high_court_appeal_judgemen']);
                                ?>
                                  <?php if ($field_liability_judgement): ?>
                                      <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                          Link to liability judgement
                                      </div>
                                    <?php print $field_liability_judgement; ?>
                                  <?php endif; ?>
                                  <?php if ($field_penalty_judgement): ?>
                                      <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                          Link to penalty judgement
                                      </div>
                                    <?php print $field_penalty_judgement; ?>
                                  <?php endif; ?>
                                  <?php if ($field_liability_and_penalty): ?>
                                      <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                          Link to liability and penalty judgement
                                      </div>
                                    <?php print $field_liability_and_penalty; ?>
                                  <?php endif; ?>
                                  <?php if ($field_full_court_appeal_ref): ?>
                                      <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                          Full Court appeal Commonwealth Courts Portal reference and link
                                      </div>
                                    <?php print $field_full_court_appeal_ref; ?>
                                  <?php endif; ?>
                                  <?php if ($field_high_court_appeal_ref): ?>
                                      <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                          High Court appeal Commonwealth Courts Portal reference and link
                                      </div>
                                    <?php print $field_high_court_appeal_ref; ?>
                                  <?php endif; ?>
                                  <?php if ($field_federal_court_appeal_judge): ?>
                                      <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                          Link to Federal Court appeal judgement
                                      </div>
                                    <?php print $field_federal_court_appeal_judge; ?>
                                  <?php endif; ?>
                                  <?php if ($field_high_court_appeal_judgemenrender): ?>
                                      <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                          Link to High Court appeal judgement
                                      </div>
                                    <?php print $field_high_court_appeal_judgemenrender; ?>
                                  <?php endif; ?>
                              <?php endif; ?>


                              <?php if ($node_content['body']): ?>
                                  <div class="theme-color safe font-family3 text-uppercase bold block my-2">
                                    <?php if($decision == 'decision made'): ?>
                                        Summary of court decision
                                    <?php endif; ?>
                                    <?php if($decision == 'no decision'): ?>
                                        Summary at time of filing
                                    <?php endif; ?>
                                  </div>
                                <?php print render($node_content['body']); ?>
                              <?php endif; ?>

                              <?php if($decision == 'decision made'): ?>
                                <?php print render($node_content['field_penalties']); ?>
                                <?php print render($node_content['field_total_penalties']); ?>
                              <?php endif; ?>

                              <?php print render($node_content['field_related_content']); ?>

                              <?php if($decision == 'decision made'): ?>
                                <?php print render($node_content['field_current_abcc_case_url']); ?>
                              <?php endif; ?>
                                <!-- /Legal case fileds -->


                            </div>
                          <?php if (!empty($page['wizard'])): ?>
                            <?php print render($page['wizard']); ?>
                          <?php endif;?>
                        </section>
                    </div>
                    <!-- /main page content -->
                    <!-- sidebar right -->
                  <?php if (!empty($page['sidebar_right'])): ?>
                      <div class="col-lg-3 offset-lg-1">
                        <?php if ($active_page_parent): ?>
                            <div class="text-uppercase font-family3 block safe theme-color pb-2">
                                <i class="fal fa-arrow-left float-left line-height-inherit theme-color"></i>&nbsp;Back to
                            </div>
                            <h3 class="font-family2 mb-4 h4">
                                <a href="/<?php print $active_page_parent['link_path'];?>" class="theme-color theme-color-hover">
                                  <?php print $active_page_parent['link_title'];?>
                                </a>
                            </h3>
                        <?php endif; ?>
                        <?php print render($page['sidebar_right']); ?>
                      </div>
                  <?php endif; ?>
                    <!-- /sidebar right -->

                </div>
            </div>
        </div>

        <!-- page footer -->
      <?php include 'includes/page-footer.tpl.php'; ?>

    </div>
</div>


<nav id="navigation" class="<?php print $container_class; ?>">
  <?php print render($page['navigation']); ?>
</nav><!-- /#navigation -->

<main>
    <div id="main" class="main-container <?php print $container_class; ?>">

        <div id="content" class="row">
          <?php if (!empty($page['sidebar_first'])): ?>
              <aside class="col-sm-3" role="complementary">
                <?php print render($page['sidebar_first']); ?>
              </aside>  <!-- /#sidebar-first -->
          <?php endif; ?>

          <?php if (!empty($page['sidebar_second'])): ?>
              <aside class="col-sm-3" role="complementary">
                <?php print render($page['sidebar_second']); ?>
              </aside>  <!-- /#sidebar-second -->
          <?php endif; ?>
        </div>
    </div>
</main>

<!-- page mobile menu -->
<?php include 'includes/page-menu--mobile.tpl.php'; ?>

