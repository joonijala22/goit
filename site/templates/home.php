<?php snippet('header') ?>

<section class="padding-y-lg">
<div class="container max-width-adaptive-lg">
  <div class="grid">
    <div class="col-7@lg">
  <div class="text-component">
    <h1 class="text-xxxl"><?= $page->tophead() ?></h1>
  </div>
</div>
</div>
</section>




<section class="feature-v10">
<div class="padding-y-lg padding-bottom-0@md">
  <div class="container max-width-adaptive-lg">
    <div class="grid">
      <img class="block width-100% object-cover col-6@md" src="<?= image('apply-for-girlsgoit.jpg')->url() ?>" alt="Image description">

      <div class="bg-contrast-lower col-6@md">
        <div class="text-component v-space-md height-100% flex flex-column padding-md">
          <h2><?= $page->Headline1() ?></h2>
          <p><?= $page->text1() ?></p>
          <p class="margin-top-auto"><a href="<?= $pages->find('program')->url() ?>" class="feature-v10__link"><i>View program</i></a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="bg-contrast-higher padding-y-xl padding-bottom-xxl@md padding-top-0@md">
  <div class="container max-width-adaptive-lg">
    <div class="grid">
      <img class="block width-100% object-cover col-6@md order-2@md" src="<?= image('girlsgoit summer camp 2017.jpg')->url() ?>" alt="Image description">

      <div class="bg-contrast-high col-6@md order-1@md">
        <div class="text-component color-bg v-space-md height-100% flex flex-column padding-md">
          <h2 class="color-inherit"><?= $page->headline2() ?></h2>
          <p><?= $page->text2() ?></p>
          <p class="margin-top-auto"><a href="<?= $pages->find('news')->url() ?>" class="feature-v10__link"><i>View news</i></a></p>
        </div>
      </div>
    </div>
  </div>
</div>
</section>




<?php snippet('footer') ?>