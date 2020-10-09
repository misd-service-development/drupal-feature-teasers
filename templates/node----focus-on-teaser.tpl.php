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
  $url = $node_url;
  $read_more = t('Read more') . '<span class="element-invisible"> at: ' . $title . '</span>';
endif;

$has_image = isset($content['field_image']);

// We will have a single link for the teaser so ensure the image itself isn't linked
if ($has_image):
  unset($content['field_image'][0]['#path']);
endif;

?>

<div class="campl-content-container campl-side-padding <?php print $classes; ?>" <?php print $attributes; ?>>
  <div class="campl-horizontal-teaser campl-teaser clearfix campl-focus-teaser">
    <div class="campl-focus-teaser-img">
      <div class="campl-content-container campl-horizontal-teaser-img">
        <?php if ($has_image): ?>
          <?php print render($content['field_image']); ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="campl-focus-teaser-txt">
      <div class="campl-content-container campl-horizontal-teaser-txt">
        <?php print render($title_prefix); ?>
        <h3 class="campl-teaser-title"><a href="<?php print $url; ?>"><?php print $title; ?></a></h3>
        <?php print render($title_suffix); ?>
        <a href="<?php print $url; ?>" class="ir campl-focus-link"><?php print $read_more; ?></a>
      </div>
    </div>
  </div>
</div>
