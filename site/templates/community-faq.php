<?php snippet('header') ?>


<!-- title -->
  <section class="padding-y-lg feature-v3 feature-v3--media-outset@md">
  <div class="container max-width-lg">
    <div class="feature-v3__grid grid gap-md items-center">
      <div class="col-6@md">
        <div class="padding-y-xxl@md">
          <div class="text-component">
            <h1 class="text-xxxl"><?= $page->heading() ?></h1>
            <p><?= $page->text1() ?></p>
          </div>
        </div>
      </div>
    
      <div class="col-6@md">
        <div class="feature-v3__media">
          <img class="block width-100% radius-md" src="assets/img/mentors/Meet our people.PNG" alt="GirlsGoIT community">
        </div>
      </div>
    </div>
  </div>
</section>

<div class="filter-nav filter-nav--expanded js-filter-nav">
      <button class="reset btn btn--subtle is-hidden js-filter-nav__control" aria-label="Select a filter option" aria-controls="filter-nav">
        <span class="js-filter-nav__placeholder" aria-hidden="true">All Products</span>

        <svg class="icon icon--xxs margin-left-xxs" aria-hidden="true" viewBox="0 0 12 12"><polyline points="0.5 3.5 6 9.5 11.5 3.5" fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></polyline></svg>
      </button>

      <div class="filter-nav__wrapper js-filter-nav__wrapper" id="filter-nav">
        <nav class="filter-nav__nav justify-center js-filter-nav__nav">
          <ul class="filter-nav__list js-filter-nav__list" aria-controls="product-gallery">
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" aria-current="true" data-filter="*">All Products</button>
            </li>
            
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="coffee-mug">Coffe mugs</button>
            </li>
          
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="tea-mug">Tea mugs</button>
            </li>
          
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="other">Others</button>
            </li>
          <li class="filter-nav__marker js-filter-nav__marker" aria-hidden="true"></li>
          </ul>

          <button class="reset filter-nav__close-btn is-hidden js-filter-nav__close-btn js-tab-focus" aria-label="Close navigation">
            <svg class="icon" viewBox="0 0 16 16" aria-hidden="true"><g stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"><line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line><line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line></g></svg>
          </button>
        </nav>
      </div>
    </div>



<?php snippet('footer') ?>