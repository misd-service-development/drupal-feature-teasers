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
  
  // If the link has no title or is read more, set to read more with context for screen-readers
  $original_title = $node->field_link[0]['original_title'];
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

if ($has_image && isset($url)):
  if(isset($content['field_image'][0]['#item']) && empty($content['field_image'][0]['#item']['alt']) ):
    $content['field_image'][0]['#item']['alt'] = $read_more . t(' at: ') . $title;
  endif;
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
