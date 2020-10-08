<?php

hide($content['links']);

if (array_key_exists('field_link', $content)):
  hide($content['field_link']);
  // Build link with querystring and fragment
  $options = array (
    'fragment' => $node->field_link[0]['fragment'],
    'query'    => $node->field_link[0]['query'],
  );
  $url = url($node->field_link[0]['url'], $options);
else:
  $url = $node_url;
endif;

?>

<div class="campl-content-container campl-side-padding">
  <div class="campl-listing-item campl-news-listing clearfix">

    <?php print render($title_prefix); ?>
    <p class="campl-listing-title"><a href="<?php print $url; ?>"><?php print $title; ?></a></p>
    <?php print render($title_suffix); ?>

    <p class="campl-datestamp"><?php print $date; ?></p>

    <?php print render($content); ?>

  </div>
</div>
