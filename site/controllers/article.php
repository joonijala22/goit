<?php

return function ($page, $kirby, $site) {

  // Meta
  $seo = $kirby->controller('seo' , compact('page', 'site', 'kirby'));

  // Override Meta Title
  $metatitle = $page->seotitle().' | '.$site->title();

  $data = compact('metatitle');

  return a::merge($seo, $data);

};
?>



<?php

return function ($page) {

    $gallery = $page->images()->filterBy("template", "image")->sortBy("sort");

    return [
        'gallery' => $gallery
    ];

};

?>