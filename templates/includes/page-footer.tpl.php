<footer class="footer bg-footer text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="text-white mb-4">Need assistance?</h3>
                <div class="row">
                    <div class="col-md-6">


                            <a href="tel:1800003338" class="item">
                            <img src="/<?php print path_to_theme(); ?>/images/icon-call.svg">

                            <span class="text-uppercase">
                                                Call ABCC hotline

                                                    <strong class="text-green">
                                                        1800 003 338
                                                        <i class="fal fa-arrow-circle-right"></i>
                                                    </strong>
                                            </span></a>


                    </div>
                    <div class="col-md-6">
                        <a href="/contact#wizard-form" class="item">
                            <img src="/<?php print path_to_theme(); ?>/images/icon-contact-form.svg">
                            <span class="text-uppercase">
                                                Use our
                                                <strong class="text-green">
                                                    contact form
                                                    <i class="fal fa-arrow-circle-right"></i>
                                                </strong>
                                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h3 class="text-white mb-4 hide-xs-down">Stay up to date</h3>
                <a href="/news-and-media/industry-update" class="item">
                    <img src="/<?php print path_to_theme(); ?>/images/icon-email.svg">
                    <span class="text-uppercase">
                                        E-alerts &amp; industry updates
                                        <strong class="text-blue">
                                            Subscribe
                                            <i class="fal fa-arrow-circle-right"></i>
                                        </strong>
                                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-footer-alt py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                  <?php if (!empty($page['footer'])): ?>
                    <?php print render($page['footer']); ?>
                  <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="btn alt btn-outline-primary" id="footer-explore-menu-toggle">
                        Explore the website
                        <i class="fal fa-bars ml-4"></i>
                    </a>
                </div>
            </div>
              <?php if (!empty($page['footer_explore'])): ?>
                <div class="row pt-5">
                    <div class="col-lg-12">
                        <?php print render($page['footer_explore']); ?>
                    </div>
                </div>
              <?php endif; ?>
        </div>
    </div>
    <div class="sr-only">Designed and built by <a
                href="https://iconagency.com.au" target="_blank">Icon Agency</a>.
    </div>
</footer>