<?php snippet('header') ?>


<section class="padding-y-lg feature-v4 ">
  <div class="container max-width-adaptive-lg">
    <div class="feature-v4__grid grid gap-md items-center">
      <div class="col-5@md position-relative z-index-1">
        <div class="text-component">
          <h1 class="text-xxxl@lg feature-v4__text-offset@md"><?= $page->Tophead() ?></h1>
          
        </div>
      </div>

      <div class="col-7@md">
        <figure>
          <img class="block width-100% radius-md" src="<?= image('girlsgoit-building-future-engineers.jpg')->url() ?>" alt="GirlsGoIT Ambassadors">
        </figure>
      </div>
    </div>
  </div>
</section>

<!-- What we do -->
  <section class="padding-y-lg">
    <div class="container max-width-lg">
      <div class="text-component margin-bottom-md">
        <h2 class="text-xxxl@lg"><?= $page->WhatWeDo() ?></h2>
      </div>
      <div class="grid gap-md">
        <div class="col-4@md">
          <img class="icon--xxxl" src="<?= image('education and events in IT and STEM-01.svg')->url() ?>">
          <div class="text-component margin-top-sm">
            <h2 class="text-lg@lg font-medium"><?= $page->Subheading1() ?></h2>
            <p><?= $page->Parag1() ?> </p>
          </div>
        </div>

        <div class=" col-4@md">
          <img class="icon--xxxl" src="<?= image('campaigns and inspiring girls in IT-01.svg')->url() ?>">
          <div class="text-component margin-top-sm">
            <h2 class="text-lg@lg font-medium"><?= $page->Subheading2() ?></h2>
            <p><?= $page->Parag2() ?> </p>
          </div>
        </div>

        <div class=" col-4@md">
          <img class="icon--xxxl" src="<?= image('preparing young women for career in IT-01.svg')->url() ?>">
          <div class="text-component margin-top-sm">
          <h2 class="text-lg@lg font-medium"><?= $page->Subheading3() ?></h2>
            <p><?= $page->Parag3() ?> </p>
          </div>
        </div>

      </div>
    </div>
  </section>

<!-- Why girls in IT -->
  <section class="padding-y-lg bg-contrast-lower">
    <div class="container max-width-lg">
      <div class="text-component margin-bottom-md">
        <h2 class="text-xxxl@lg font-bold"><?= $page->WhyGirls() ?></h2>
      </div>
      <div class="grid gap-lg">
        <div class="col-6@lg position-relative">
          <div class="text-component line-height-xl">
            <h2 class="text-lg@lg font-medium"><?= $page->Subheading4() ?></h2>
            
          </div>
        </div>
        <div class="col-6@lg">
          <img class="radius-md" src="<?= image('Flag_of_Moldova.svg')->url() ?>">
      </div>

      <div class="grid gap-md">
        <div class="col-4@lg">
          <img class="icon--xxxl" src="<?= image('education and events in IT and STEM-01.svg')->url() ?>">
          <div class="text-component line-height-xl margin-top-md">
          <h2 class="text-lg@lg font-medium"><?= $page->Subheading5() ?></h2>
          </div>
        </div>

        <div class="col-4@lg">
          <img class="icon--xxxl" src="<?= image('education and events in IT and STEM-01.svg')->url() ?>">
          <div class="text-component line-height-xl margin-top-md">
          <h2 class="text-lg@lg font-medium"><?= $page->Subheading6() ?></h2>
          </div>
        </div>

        <div class="col-4@lg">
          <img class="icon--xxxl" src="<?= image('education and events in IT and STEM-01.svg')->url() ?>">
          <div class="text-component line-height-xl margin-top-md">
            <h2 class="text-md@lg font-medium line-height-sm"><?= $page->Subheading7() ?></h2>
          </div>
        </div>

      </div>

      <div class="margin-top-sm">
          <div class="flex flex-wrap gap-sm items-center">
            <a href="research.html" class="btn btn--primary">View study</a>
          </div>
        </div>

    </div>
  </section>

<!-- What we have done -->
  <section class="padding-y-lg">
    <div class="container max-width-lg">
      <div class="text-component margin-bottom-md">
        <h2 class="text-xxxl@lg"><?= $page->WhatWeDone() ?></h2>
      </div>
      <div class="grid gap-md">
          <div class="col-3@md">
            <span class="countup text-xxxxl"><span class="js-countup color-primary font-bold"><?= $page->DoneCount1() ?></span></span>
            <p><?= $page->DoneText1() ?></p>
          </div>
          <div class="col-3@md">
            <span class="countup text-xxxxl"><span class="js-countup color-primary font-bold"><?= $page->DoneCount2() ?></span></span>
            <p><?= $page->DoneText2() ?></p>
          </div>
          <div class="col-3@md">
            <span class="countup text-xxxxl"><span class="js-countup color-primary font-bold"><?= $page->DoneCount3() ?></span></span>
            <p><?= $page->DoneText3() ?></p>
          </div>
          <div class="col-3@md">
            <span class="countup text-xxxxl"><span class="js-countup color-primary font-bold"><?= $page->DoneCount4() ?></span></span>
            <p><?= $page->DoneText4() ?></p>
          </div>
      </div>
    </div>
  </section>

<!-- Our history -->


<?php snippet('footer') ?>