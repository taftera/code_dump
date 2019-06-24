<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="jquery.fancybox-1.3.4.css" type="text/css">
	<script type='text/javascript' src='jquery.min.js'></script>
	<script type='text/javascript' src='jquery.fancybox-1.3.4.pack.js'></script>
	<script type="text/javascript">
		$(function() {
			$("a.group").fancybox({
				'nextEffect'	:	'fade',
				'prevEffect'	:	'fade',
				'overlayOpacity' :  0.8,
				'overlayColor' : '#000000',
				'arrows' : false,
			});			
		});
	</script>

	<?php
		// Supply a user id and an access token
		$userid = "193206190";
		$accessToken = "193206190.1677ed0.839fdafe05914091bfa0f62e262dd4b2";

		// Gets our data
		function fetchData($url){
		     $ch = curl_init();
		     curl_setopt($ch, CURLOPT_URL, $url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

		// Pulls and parses data.
		$result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
		$result = json_decode($result);
	
	//https://blueprintinteractive.com/blog/how-instagram-api-fancybox-simplified
	?>


	<?php foreach ($result->data as $post): ?>
		<!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->
		<a class="group" rel="group1" href="<?= $post->images->standard_resolution->url ?>"><img src="<?= $post->images->thumbnail->url ?>"></a>
	<?php endforeach ?>
</html>


<!--

{% assign onboarding = true %}

{% if section.settings.access_token != blank %}
  {% assign onboarding = false %}
{% endif %}

{% assign photo_count = 5 %}

<script
  type="application/json"
  data-section-id="{{ section.id }}"
  data-section-type="dynamic-instagram-feed"
  data-section-data>
  {
    "onboarding": {{ onboarding | json }},
    "photo_count": {{ photo_count }},
    "access_token": {{ section.settings.access_token | escape | json }}
  }
</script>

<section class="instagram--container">
  {% if section.settings.title != blank %}
    <h2 class="home-section--title">
      {{ section.settings.title | escape }}
    </h2>
  {% endif %}

  <div
    class="home-section--content instagram--inner"
    data-instagram-content
  >
    {% for i in (1..photo_count) %}
      <figure
        class="instagram--photo"
        data-instagram-photo
        data-instagram-photo-placeholder>
        {% if onboarding %}
          {{ 'image' | placeholder_svg_tag: 'placeholder--image' }}
        {% else %}
          {{ 'image' | placeholder_svg_tag: 'placeholder--image placeholder--content-image' }}
        {% endif %}
      </figure>
    {% endfor %}
  </div>
</section>

<style>
  #shopify-section-{{section.id}} {
    background-color: {{ section.settings.background_color }};
  }
  #shopify-section-{{section.id}} .instagram--container .home-section--title {
    color: {{ section.settings.heading_color }};
  }
</style>

{% schema %}
{
  "name": "Instagram feed",
  "class": "instagram--section",
  "settings": [
    {
      "type": "text",
      "id": "title",
      "label": "Heading",
      "default": "Instagram feed"
    },
    {
      "type": "color",
      "id": "heading_color",
      "label": "Section heading color",
      "default": "#4D4D4D"
    },
    {
      "type": "color",
      "id": "background_color",
      "label": "Section background color"
    },
    {
      "type": "header",
      "content": "Instagram settings"
    },
    {
      "type": "text",
      "id": "access_token",
      "label": "Instagram access token",
      "info": "[Instagram access token generator](http://instagram.pixelunion.net/)"
    }
  ],
  "presets": [
    {
      "name": "Instagram feed",
      "category": "Social media"
    }
  ]
}

{% endschema %}

-->