<?php snippet('header') ?>


<!-- title -->
  <section class="padding-y-lg feature-v3 feature-v3--media-outset@md">
  <div class="container max-width-lg">
    <div class="feature-v3__grid grid gap-md items-center">
      <div class="col-6@md">
        <div class="padding-y-xxl@md">
          <div class="text-component">
            <h1 class="text-xxxl"><?= $page->head() ?></h1>
            <p><?= $page->text1() ?></p>
          </div>
        </div>
      </div>
    
      <div class="col-6@md">
        <div class="feature-v3__media">
          <img class="block width-100% radius-md" src="<?= image('Meet our people.PNG')->url() ?>" alt="GirlsGoIT community">
        </div>
      </div>
    </div>
  </div>
</section>


<?php snippet('footer') ?>

 



