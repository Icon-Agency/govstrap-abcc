<!-- Mobile menu -->
<nav id="menu">
  <?php if (!empty($page['mobile_nav'])): ?>
      <?php $mobile_nav = preg_replace(array('/ class=".*?"/','/<p>(.*?)<\/p>/s','/<h2>(.*?)<\/h2>/s','/<i>(.*?)<\/i>/s','/<h3>(.*?)<\/h3>/s'), '', render($page['mobile_nav']));?>
      <?php print $mobile_nav; ?>
  <?php endif; ?>
</nav>

