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

<div class="campl-content-container campl-vertical-padding <?php print $classes; ?>" <?php print $attributes; ?>>
  <div class="campl-horizontal-teaser campl-teaser campl-teaser-border campl-content-container campl-side-padding clearfix">

    <?php if ($has_url): ?>
      <a href="<?php print $url; ?>">
        <div class="campl-primary-cta teaser-cta-button"><?php print $read_more; ?></div>
    <?php endif; ?>

    <?php if ($has_image): ?>
      <div class="campl-column6">
        <div class="campl-content-container campl-horizontal-teaser-img">
          <?php print render($content['field_image']); ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($has_url): ?>
      </a>
    <?php endif; ?>

    <div class="campl-column<?php if ($has_image): ?>6<?php else: ?>12<?php endif; ?>">
      <div class="campl-content-container <?php if (!$has_image): ?>campl-no-padding<?php endif; ?> campl-horizontal-teaser-txt">
        <?php print render($title_prefix); ?>
        <h3 class='campl-teaser-title'><?php print $title; ?></h3>
        <?php print render($title_suffix); ?>
        <?php if ($display_submitted): ?>
          <p class="campl-datestamp"><?php print $date; ?></p>
        <?php endif; ?>
        <?php print render($content); ?>
      </div>
    </div>
  </div>
</div>

<div class="campl-content-container campl-side-padding">
  <hr class="campl-teaser-divider">
</div>
