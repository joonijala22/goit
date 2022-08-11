<?php snippet('header'); ?>

<section class="padding-y-lg">
  <div class="container max-width-adaptive-lg">
    <div class="text-component">
      <h1 class="text-xxxl"><?= $page->heading() ?></h1>
    </div>
  </div>
</section>

<!-- breadcrumbs -->
  <section class=" margin-bottom-md">
    <div class="container max-width-adaptive-lg">
      <nav class="breadcrumbs" aria-label="Breadcrumbs">
        <ol class="flex flex-wrap gap-xxs">
          <li class="breadcrumbs__item">
            <a href="<?= $pages->find('news')->url() ?>" class="color-inherit">news</a>
            <span class="color-contrast-low margin-left-xxs" aria-hidden="true">/</span>
          </li>
          
          <li class="breadcrumbs__item color-primary" aria-current="page">Edu Tolk</li>
        </ol>
      </nav>
    </div>
  </section>
 
  <section class="padding-y-lg">
        <div class="articles">
          <div class="container max-width-adaptive-lg position-relative">
            <div class="padding-md bg-contrast-lower radius-sm">
              <div class="grid gap-lg">

              <?php

$p = page('news');
$p2 = page('news');         
  $filterBy = get('filter');
  $firstblogs = $p->children()->listed()->sortBy('date', 'asc')->filterBy('tags', 'edutolk', ',')->flip()->limit(3);
  $lblogs = $p2->children()->listed()->sortBy('date', 'asc')->filterBy('tags', 'edutolk', ',')->flip()->offset(3)->paginate(3);
?>
  
    <?php foreach ($firstblogs as $article): ?>

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

                

               

              </div>
            </div>
          </div>
        </div>
      </section>

 

<!-- articles -->
  <div class="container max-width-adaptive-lg margin-bottom-xxl">
    <ul>
    
    <?php foreach ($lblogs as $article): ?>
      <li>
        <a class="story-v3 padding-y-md js-story-v3" href="<?= $article->url() ?>" data-story-img-src="<?= $article->image()->url() ?>" data-story-img-align="right" data-story-img-offset-x="60px" data-story-img-width="30%" data-story-img-class="display@lg">
          <div class="grid gap-md">
            <div class="col-3@md col-2@lg">
              <p class="text-sm position-relative z-index-2"><time datetime=""><?= $article->published() ?></time></p>
            </div>
  
            <div class="text-component col-6@md position-relative z-index-2">
              <h1 class="story-v3__title text-xl"><?= $article->heading()->html() ?></h1>
              <p class="text-sm color-contrast-higher opacity-50%"><?= $article->text1()->excerpt(300) ?></p>
            </div>
  
            <div class="display@md col@md flex@md justify-end" aria-hidden="true">
              <svg class="story-v3__icon icon position-relative z-index-2" viewBox="0 0 48 48">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="37" y1="14" x2="47" y2="24" />
                  <line x1="47" y1="24" x2="37" y2="34" />
                  <line x1="47" y1="24" x2="1.5" y2="24" />
                </g>
              </svg>
            </div>
          </div>
        </a>
      </li>
  <?php endforeach ?>
  
     
  
     
    </ul>

    <div class="text-center margin-top-lg">
      <button class="btn btn--subtle">More Article</button>
    </div>
  </div>

  <?php snippet('footer'); ?>