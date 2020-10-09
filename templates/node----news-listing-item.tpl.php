<?php
hide($content['links']);

if (array_key_exists('field_link', $content)):
  hide($content['field_link']);

  // get field data
  $field = field_get_items('node', $node, 'field_link');
  $link_value = field_view_value('node', $node, 'field_link', $field[0]);

  // Build link with querystring and fragment
  $options = array (
    'fragment' => $link_value['#element']['fragment'],
    'query'    => $link_value['#element']['query'],
  );
  $url = url($link_value['#element']['url'], $options);
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
