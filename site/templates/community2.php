<?php snippet('header2') ?>

<section class="padding-y-lg position-relative z-index-1">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md items-center">
      <div class="col-6@md order-2@md">
        <div class="text-component">
          <h1 class="text-xxxl">Blog</h1>
          <p>This is a space to share news, stories, insights and featured contents. If you have something you would like to contribute to our blog </p>
        </div>
  
        <div class="margin-top-sm">
          <div class="flex flex-wrap gap-sm items-center">
            <a href="mailto:girlsgoit@tekedu.org" class="btn btn--primary">Contact us</a>
            
          </div>
        </div>
      </div>
    
      <div class="col-6@md order-1@md">
        <figure class="media-wrapper">
          <iframe class="radius-sm" width="560" height="315" src="https://www.youtube.com/embed/HAsFI7q9GXo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </figure>
      </div>
    </div>
  </div>
</section>

<section class="padding-y-lg">
    <div class="article ">
      <div class="container max-width-adaptive-lg position-relative">
        <div class="padding-md bg-contrast-lower radius-sm ">
        <div class="filter-nav filter-nav--expanded js-filter-nav margin-y-lg">
     


    <?php

    $filterBy = get('filter');

    $articles = $page
    ->children()
    ->listed()
    ->when($filterBy, function($filterBy){
     return $this->filterBy('tags', $filterBy);
    })
    
    ->flip()
    ->paginate(6);

    $pagination = $articles->pagination();
    ?>

  <div class="filter-nav__wrapper js-filter-nav__wrapper" id="filter-nav">
        <nav class="filter-nav__nav justify-center js-filter-nav__nav">
          <ul class="filter-nav__list js-filter-nav__list" aria-controls="product-gallery">
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" aria-current="true" data-filter="*"><a href="<?= $page->url() ?>">All</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="article"><a href="<?= $page->url() ?>?filter=article">Article</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="edutolk"><a href="<?= $page->url() ?>?filter=edutolk">Edutolk</a></button>
            </li>
          
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="event"><a href="<?= $page->url() ?>?filter=event">Event</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="featured"><a href="<?= $page->url() ?>?filter=featured">Featured News</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="podcast"><a href="<?= $pages->find('podcast')->url() ?>">Podcast</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="workshop"><a href="<?= $page->url() ?>?filter=workshop">Workshop</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" data-filter="edutolk"><a href="<?= $page->url() ?>?filter=video">Video</a></button>
            </li>
          <li class="filter-nav__marker js-filter-nav__marker" aria-hidden="true"></li>
          </ul>

          <button class="reset filter-nav__close-btn is-hidden js-filter-nav__close-btn js-tab-focus" aria-label="Close navigation">
            <svg class="icon" viewBox="0 0 16 16" aria-hidden="true"><g stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"><line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line><line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line></g></svg>
          </button>
        </nav>
      </div>
  

      
  <?php foreach ($articles as $article): ?>

  <div class="grid gap-lg">
  <article class="story col-4@md">
        <a href="video.html" class="story__img">
          <figure class="media-wrapper media-wrapper--4:3">
            <img src="<?= $article->image()->url() ?>">
          </figure>
        </a>

        <div class="story__content">
          <div class="margin-bottom-xs">
            <a href="#0" class="story__category">
              <svg class="icon margin-right-xxxs" aria-hidden="true" viewBox="0 0 16 16"><g stroke-width='1' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round'><rect x='0.5' y='1.5' width='15' height='13' rx='1' ry='1'></rect><polygon points='5.5 4.5 11 8 5.5 11.5 5.5 4.5'></polygon></g></svg>
              <i><?= $article->tags() ?></i>
            </a>
          </div>
  
          <div class="text-component">
            <h2 class="story__title"><a href="<?= $article->url() ?>"><?= $article->heading()->html() ?></a></h2>
            
          </div>
  
          <div class="story__author margin-top-sm">
            <a href="<?= $article->url() ?>" class="block">
              <img src="assets/img/author/mihaela-iurascu.jpg" alt="Opportunities for you to start your career in IT - Mihaela Iurascu">
            </a>

            <div class="line-height-xs">
              <address class="story__author-name"><a href="#0" rel="author"><?= $article->author()->html() ?></a></address>
              <p class="story__meta"><time><?= $article->published() ?></time> </p>
            </div>
          </div>
        </div>
      </article>

<?php endforeach ?>

  
  
  <nav class="pagination margin-top-md " aria-label="Pagination">
      <ol class="pagination__list flex flex-wrap gap-xxxs justify-center">
  
      <?php if ($articles->pagination()->hasPrevPage()): ?>    
  <li>
  <a class="pagination__item " aria-label="Go to previous page" href="<?= $articles->pagination()->prevPageUrl(); ?>">
  <span>&larr; Previous</span>
  </a>
   </li>
  <?php else: ?>
    <li>
  <span>Prev</span>
  
  </li>
  <?php endif ?>
  
  <li>
  <?php if ($articles->pagination()->hasNextPage()): ?>
  <a class="pagination__item" aria-label="Go to next page" href="<?= $articles->pagination()->nextPageUrl() ?>">
  <span>Next &rarr;</span>
  </a>
  <?php else: ?>
  <span>Next</span>
  <?php endif ?>
  </li>
  </nav>



         

      </div>
      </div>
    </div>
    </div>
  </section>

 

<?php snippet('footer') ?>