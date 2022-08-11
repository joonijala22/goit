<?php snippet('header'); ?>

<!-- title -->
  <section class="padding-y-lg">
  <div class="container max-width-lg">
    <div class="text-component">
      <h1 class="text-xxl"><?= $page->TopHeading() ?></h1>
    </div>

  </div>
</section>



<!-- gallery -->
  <section class="padding-y-lg bg-contrast-lower">
    <div class="container max-width-lg">
      <div class="grid gap-md">
        <div class="text-component">
          <h2><?= $page->SubHeading1() ?></h2>
          <p ><?= $page->Parag1() ?></p>
        </div>
        <div class="responsive-iframe">
        <?= $page->YoutubeVid() ?>
    </div>
      <div class="bg-contrast-lower col-4@md radius-md   flex@md flex-column@md">
        <h2 class="margin-bottom-xs"><?= $page->SubHeading2() ?></h2>
        <span class="line-height-sm"><?= $page->Parag2() ?></span>
            
      </div>
      <div class="bg-contrast-lower col-4@md radius-md flex@md flex-column@md">
      <h2 class="margin-bottom-xs"><?= $page->SubHeading3() ?></h2>
        <span class="line-height-sm"><?= $page->Parag3() ?></span>
      </div>
      <div class="bg-contrast-lower col-4@md radius-md flex@md flex-column@md">
      <h2 class="margin-bottom-xs"><?= $page->SubHeading4() ?></h2>
        <span class="line-height-sm"><?= $page->Parag4() ?></span>
      </div>

      <div class="margin-top-lg">
        <div class="flex flex-wrap gap-sm">
          <a class="link-fx-2" data-link-fx-clone="Visit our education page" href="education.html">Visit our education page</a> 
        </div>
      </div>

      <div class="margin-bottom-lg">
        <div class="margin-top-lg  padding-xs col-5@md">
        <p class="text-lg font-medium color-primary"><?= $page->PhotoHeading() ?></p>
      </div>
    </div>
      <div class="adv-gallery-v2">

        <ul class="grid gap-lg padding-bottom-lg">
          <li class="col-4@md col-3@lg">
            <img class="block width-100% radius-md" src="<?= image('girlsgoit summer camp 2019.jpg')->url() ?>" alt="Presentation of 3D printing project at GirlsGoIT Summer STEM camp in 2019">

            <div class="margin-top-xxs">
              <p class="text-sm"><?= $page->PhotoText1() ?></p>
            </div>
          </li>

          <li class="col-6@md col-7@lg">
            <img class="block width-100% radius-md" src="<?= image('girlsgoit summer camp 2018.jpg')->url() ?>" alt="How Web Works Workshop at GirlsGoIT Summer STEM camp in 2018">

            <div class="margin-top-xxs">
              <p class="text-sm"><?= $page->PhotoText2() ?></p>
            </div>
          </li>
        </ul>

        <ul class="grid gap-lg">
          <li class="col-4@md order-2@md order-1@lg offset-1@lg">
            <img class="block width-100% radius-md" src="<?= image('girlsgoit summer camp 2017.jpg')->url() ?>" alt="Closing ceremony at GirlsGoIT summer STEM camp in 2017">

            <div class="margin-top-xxs">
              <p class="text-sm"><?= $page->PhotoText3() ?></p>
            </div>
          </li>

          <li class="col-8@md order-1@md col-7@lg order-2@lg">
            <img class="block width-100% radius-md" src="<?= image('girlsgoit summer camp 2016.jpg')->url() ?>" alt="GirlsGoIT summer STEM camp 2016">

            <div class="margin-top-xxs">
              <p class="text-sm"><?= $page->PhotoText4() ?></p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </section>

  <?php snippet('footer'); ?>