<?php snippet('header') ?>


<article class="padding-y-lg">
  <header class="container max-width-xs margin-bottom-lg">
    <div class="text-component text-center line-height-lg v-space-md margin-bottom-md">
      <h1><?= $page->heading()->html() ?></h1>
      <p class="color-contrast-medium text-md"><?= $page->intro()->kirbytext() ?></p>
      <a href="#0" class="story__category">
        <svg class="icon margin-right-xxxs" aria-hidden="true" viewBox="0 0 16 16"><g stroke-width='1' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round'><rect x='0.5' y='1.5' width='15' height='13' rx='1' ry='1'></rect><polygon points='5.5 4.5 11 8 5.5 11.5 5.5 4.5'></polygon></g></svg>
        <i><?= $page->tags() ?>Video</i>
        </a>
    </div>          

    <div class="flex justify-center">
      <div class="author author--meta">
        <a href="#0" class="author__img-wrapper">
          <img src="assets/img/author/mihaela-iurascu.jpg" alt="Mihaela Iurascu">
        </a>

        <div class="author__content text-component v-space-xxs">
          <h4 class="text-base"><a href="#0" rel="author"><?= $page->author()->html() ?></a></h4>
          <p class="text-sm color-contrast-medium"><time><?= $page->time()->html() ?></p>
        </div>
      </div>
    </div>
  </header>

  <figure class="container max-width-lg margin-bottom-lg">
    <img src="assets/img/support-girlsgoit.jpg" alt="Image description">
  </figure>

  <div class="container max-width-adaptive-sm">
    <div class="text-component line-height-lg v-space-md">
    <?= $page->text1()->kirbytext() ?>
      
    
      
      <div class="text-component__block text-component__block--outset">
        <figure class="responsive-iframe">
          <iframe width="560" height="315" src="<?= $page->videolink() ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </figure>
      </div>

      <p> <?= $page->outro() ?></p>
    </div>
  </div>
</article>






<?php snippet('footer') ?>