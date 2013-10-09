<?php

hide($content['links']);

if (array_key_exists('field_link', $content)):
  hide($content['field_link']);
  $url = $content['field_link']['#items'][0]['url'];
  $read_more = $content['field_link']['#items'][0]['title'];

  if ($read_more == $url):
    $read_more = t('Read more');
  endif;

  if (array_key_exists('field_image', $content)):
    $content['field_image'][0]['#path'] = array('path' => $url);
  endif;
else:
  $url = $node_url;
  $read_more = t('Read more');
endif;

?>

<div class="campl-content-container <?php print $classes; ?>" <?php print $attributes; ?>>
  <div class="campl-horizontal-teaser campl-teaser clearfix">
    <div class="campl-column6">
      <div class="campl-content-container campl-horizontal-teaser-img">
        <?php print render($content['field_image']) ? : '&nbsp;'; ?>
      </div>
    </div>
    <div class="campl-column6">
      <div class="campl-content-container campl-horizontal-teaser-txt">
        <?php print render($title_prefix); ?>
        <h3 class='campl-teaser-title'><a href="<?php print $url; ?>"><?php print $title; ?></a></h3>
        <?php print render($title_suffix); ?>
        <?php if ($display_submitted): ?>
          <p class="campl-datestamp"><?php print $date; ?></p>
        <?php endif; ?>
        <?php print render($content); ?>
        <a href="<?php print $url; ?>" class="campl-primary-cta"><?php print $read_more; ?></a>
      </div>
    </div>
  </div>
</div>
