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
  
  // If the link has no title or is read more, set to read more with context for screen-readers
  $original_title = $link_value['#element']['original_title'];
  if(empty(trim($original_title)) || strcasecmp(trim($original_title), "Read more") == 0):
    $read_more = t('Read more') . '<span class="element-invisible"> at: ' . $title . '</span>';
  else:
    $read_more = $original_title;
  endif;

  if (array_key_exists('field_image', $content)):
    $content['field_image'][0]['#path'] = array('path' => $url);
  endif;
else:
  if ($type == 'link'):
    $url = NULL;
  else:
  $url = $node_url;
  $read_more = t('Read more') . '<span class="element-invisible"> at: ' . $title . '</span>';
  endif;
endif;

$has_image = isset($content['field_image']);
$has_url = isset($url);

// We will have a single link for the teaser so ensure the image itself isn't linked
if ($has_image):
  unset($content['field_image'][0]['#path']);
endif;

?>

<div class="campl-content-container <?php print $classes; ?>" <?php print $attributes; ?>>
  <div class="campl-vertical-teaser campl-teaser campl-promo-teaser">
    <div class="campl-content-container campl-vertical-teaser-txt">
      <?php print render($title_prefix); ?>
      <h2 class='campl-teaser-title'><?php print $title; ?></h2>
      <?php print render($title_suffix); ?>
    </div>

    <?php if ($has_url): ?>
      <a href="<?php print $url; ?>">
      <span class="campl-secondary-cta teaser-cta-button campl-float-right"><?php print $read_more; ?></span>
    <?php endif; ?>

    <?php if ($has_image): ?>
      <div class="campl-content-container campl-vertical-teaser-img">
        <?php print render($content['field_image']); ?>
      </div>
    <?php endif; ?>

    <?php if ($has_url): ?>
      </a>
    <?php endif; ?>

    <div class="campl-content-container<?php if (!$has_image): print ' campl-no-top-padding'; endif; ?> campl-vertical-teaser-txt clearfix">
      <?php if ($display_submitted): ?>
        <p class="campl-datestamp"><?php print $date; ?></p>
      <?php endif; ?>
      <?php print render($content); ?>

    </div>
  </div>
</div>
