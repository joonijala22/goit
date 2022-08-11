<?php snippet('header2') ?>
<section class="padding-y-lg position-relative z-index-1">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md items-center">
      <div class="col-6@md order-2@md">
        <div class="text-component">
          <h1 class="text-xxxl"><?= $page->heading() ?></h1>
          <p><?= $page->text1() ?></p>
        </div>
  
        <div class="margin-top-sm">
          <div class="flex flex-wrap gap-sm items-center">
            <a href="mailto:girlsgoit@tekedu.org" class="btn btn--primary">Contact us</a>
            
          </div>
        </div>
      </div>
    
      <div class="col-6@md order-1@md">
        <figure class="media-wrapper">
          <?= $page->videolink() ?>
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
      <button class="reset btn btn--subtle is-hidden js-filter-nav__control" aria-label="Select a filter option" aria-controls="filter-nav">
        <span class="js-filter-nav__placeholder" aria-hidden="true">All</span>

        <svg class="icon icon--xxs margin-left-xxs" aria-hidden="true" viewBox="0 0 12 12"><polyline points="0.5 3.5 6 9.5 11.5 3.5" fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></polyline></svg>
      </button>
<style>
.filter-parent{
  list-style: none;
  display: flex;
  justify-content: space-between;
}
.filter-parent li{
  margin-right: 5px;
}
.filter-parent li button{
border-radius: 5px;
text-align: center;
text-decoration: none;
display: inline-block;
border: none;
padding: 8px 10px;
}
.filter-parent li button a{
  text-decoration: none;
  color: #fff;
}
.filter-parent li button a:hover{
  text-decoration: none;
  color: #6ac8af;
}

.filter-parent li button:hover{
background-color: #fff;
border-radius: 5px;
text-align: center;
text-decoration: none;
display: inline-block;
border: none;
padding: 8px 10px;
box-shadow: 5px 5px 3px #888888;
}
</style>
      <div class="filter-nav__wrapper js-filter-nav__wrapper" id="filter-nav">
        <nav class="filter-nav__nav justify-center js-filter-nav__nav">
        <ul class="filter-parent" aria-controls="product-gallery">
            <li class="filter-nav__item">
              <button class="" aria-current="true" data-filter="*"><a href="<?= $page->url() ?>">All</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="" data-filter="article"><a href="<?= $pages->find('article')->url() ?>">Article</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="" data-filter="edutolk"><a href="<?= $pages->find('edutolk')->url() ?>">Edutolk</a></button>
            </li> 
            <li class="filter-nav__item">
              <button class="" data-filter="featured"><a href="<?= $pages->find('featured')->url() ?>">Featured News</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="" data-filter="podcast"><a href="<?= $pages->find('podcast')->url() ?>">Podcast</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="" data-filter="workshop"><a href="<?= $pages->find('workshop')->url() ?>">Workshop</a></button>
            </li>
            <li class="filter-nav__item">
              <button class="" data-filter="video"><a href="<?= $pages->find('video')->url() ?>">Video</a></button>
            </li>
          <li class="filter-nav__marker js-filter-nav__marker" aria-hidden="true"></li>
          </ul>

          <button class="reset filter-nav__close-btn is-hidden js-filter-nav__close-btn js-tab-focus" aria-label="Close navigation">
            <svg class="icon" viewBox="0 0 16 16" aria-hidden="true"><g stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"><line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line><line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line></g></svg>
          </button>
        </nav>
      </div>
    </div>

            <div class="grid gap-lg">
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
 <?php foreach ($articles as $article): ?>
    <article class="story col-4@md">
    
    <a href="<?= $article->url() ?>" class="story__img">
                  <figure class="media-wrapper media-wrapper--4:3">
                    <img src="<?= $article->image()->url() ?>" alt="GGIT summer camp">
                  </figure>
                </a>

                
                <div class="story__content">
                  <div class="margin-bottom-xs">
                    <a href="<a href="" class="story__category">
                      <svg class="icon margin-right-xxxs" aria-hidden="true" viewBox="0 0 16 16"><g stroke-width='1' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round'><rect x='0.5' y='1.5' width='15' height='13' rx='1' ry='1'></rect><polygon points='5.5 4.5 11 8 5.5 11.5 5.5 4.5'></polygon></g></svg>
                      <?php $tag = $article->tags(); ?>
                        <?php if ( $p = page($tag) ) : ?>
                            <a href="<?= $p->url() ?>"><i><?= $tag ?></i></a>
                        <?php else : ?>
                            <?= $tag ?>
                        <?php endif ?>
                                              
                    </a>
                  </div>
          
                  <div class="text-component">
                    <h2 class="story__title"><a href="<?= $article->url() ?>"><?= $article->heading()->html() ?></a></h2>
                    
                  </div>
          
                  <div class="story__author margin-top-sm">
                  <?php if ($author = $article->author()->toUser()) : ?>
                      <?php if($avatar = $author->avatar()): ?>
                        <a href="<?= $article->url() ?>" class="block">
                      <img src="<?= $avatar->url() ?>" alt="">
                                          </a>
                    <?php endif ?>
                    

                    <div class="line-height-xs">
                      <address class="story__author-name"><a href="#0" rel="author"><?= $author->name() ?></a></address>
                      <p class="story__meta"><time><?= $article->published() ?></time> &mdash; 5 min read</p>
                      <?php endif ?>
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
  
  <svg class="icon margin-right-xxxs" aria-hidden="true" viewBox="0 0 16 16"><title>Previous</title><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="9.5,3.5 5,8 9.5,12.5 "></polyline></g></svg>
  <span>Prev</span>
  </a>
   </li>
  <?php else: ?>
    <li class="disabled-link">
    <a class="pagination__item disabled-link"" aria-label="Go to previous page" href="">
  <svg class="icon margin-right-xxxs" aria-hidden="true" viewBox="0 0 16 16"><title>Previous</title><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="9.5,3.5 5,8 9.5,12.5 "></polyline></g></svg>
  <span>Prev</span>
  </a>
  </li>
  <?php endif ?>

             
    <?php foreach ($pagination->range(10) as $r): ?>
    <li >
      <a class="pagination__item " aria-label="Go to page"  <?= $pagination->page() === $r ? ' aria-current="page"' : '' ?> href="<?= $pagination->pageURL($r) ?>">
        <?= $r ?>
      </a>
    </li>
    <?php endforeach ?>

    <?php if ($articles->pagination()->hasNextPage()): ?>
    <li>
        <a href="<?= $articles->pagination()->nextPageUrl() ?>" class="pagination__item" aria-label="Go to next page">
        <span>Next</span>
          <svg class="icon margin-left-xxxs" aria-hidden="true" viewBox="0 0 16 16"><title>Next</title><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></g></svg>
        
      </a>
    </li>
    <?php else: ?>
    <li class="disabled-link">
    <a href="" class="pagination__item disabled-link"" aria-label="Go to next page">
        <span>Next</span>
        <svg class="icon margin-left-xxxs" aria-hidden="true" viewBox="0 0 16 16"><title>Next</title><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></g></svg>
    </a>
      </li>
    <?php endif ?>
  </ol>
  </nav>
       
  <style>
.disabled-link {
  pointer-events: none;
  color: #ccc;
}
</style>

            </div>
          </div>
        </div>
        </div>
      </section>





<?php snippet('footer') ?>