<?php
/**
 * @file
 * page-header.tpl.php - Returns the HTML of the page header for mobile
 */
?>

<div class="mm-header">
    <img src="/<?php print path_to_theme(); ?>/images/abcc-logo.svg" class="abcc-logo" alt="Australian Government Australian Building and Construction Commission"/>

    <a href="#" class="search-btn" id="search-btn">
        <i class="far fa-search"></i>
    </a>

    <a href="#menu" class="mob-menu">
        <i class="fal fa-bars"></i>
    </a>

    <div class="search" id="mob-search-popup">
        <i class="fal fa-times" id="close-btn"></i>
        <form>
            <h3 class="h1 mb-3">Search</h3>
            <div class="form-group input-icon">
                <input class="form-control" type="search" placeholder="Find what you're looking for...">
                <button type="submit">
                    <i class="far fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>