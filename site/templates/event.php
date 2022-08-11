
<?php snippet('header') ?>


<section class="padding-y-lg position-relative z-index-1">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md items-center">
      <div class="col-6@md order-2@md">
        <div class="text-component">
          <h1 class="text-xxxl"><?= $page->heading() ?></h1>
          <p> <?= $page->text1() ?></p>
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


<!-- Event -->


      <!-- Event Category -->

      <section class="padding-y-lg">
        <div class="article ">
          <div class="container max-width-adaptive-lg position-relative">
            <div class="padding-md bg-contrast-lower radius-sm ">
            <div class="grid gap-lg">
              <div class="text-component">
                <h2 class="text-xxxl"><?= $page->heading2() ?></h2>
                <p><?= $page->text1() ?></p>
              </div>

              <?php $items = $page->events()->toStructure(); ?>
               <?php foreach ($items as $item): ?>
              <article class="story col-4@md">
                <a href="" class="story__img">
                  <figure class="media-wrapper media-wrapper--4:3">
                  <?php if ($image = $item->image()->toFile()): ?>
                    <img src="<?php echo $image->url() ?>" alt="GGIT summer camp">
                    <?php endif ?>
                  </figure>
                </a>

                <div class="story__content">
                  <div class="text-component margin-bottom-sm">
                    <h2 class="story__title"><?= $item->eventtitle() ?></h2>
                  </div>
  
                  <div class="margin-bottom-xs">
                    <span class="story__category">
                      <svg class="icon margin-right-xxxs"   viewBox="0 0 32 32"><title>calendar-60</title><g fill="#111111"><path fill="#111111" d="M31,3h-5V1c0-0.553-0.448-1-1-1h-3c-0.552,0-1,0.447-1,1v2H11V1c0-0.553-0.448-1-1-1H7C6.448,0,6,0.447,6,1 v2H1C0.448,3,0,3.447,0,4v27c0,0.553,0.448,1,1,1h30c0.552,0,1-0.447,1-1V4C32,3.447,31.552,3,31,3z M21,5h5v2h-5V5z M6,5h5v2H6V5z M30,30H2V12h28V30z"></path></g></svg>
                      <i><?= $item->eventdate() ?></i>
                    </span>
                    <span class="story__category">
                      <svg class="icon margin-right-xxxs"  viewBox="0 0 48 48"><g fill="#111111">
                              <path d="M30 2H18v4h12V2zm-8 26h4V16h-4v12zm16.05-13.23l2.85-2.85c-.86-1.03-1.8-1.97-2.83-2.83l-2.85 2.85C32.15 9.48 28.24 8 23.99 8 14.04 8 6 16.06 6 26s8.04 18 17.99 18S42 35.94 42 26c0-4.25-1.48-8.15-3.95-11.23zM24 40c-7.73 0-14-6.27-14-14s6.27-14 14-14 14 6.27 14 14-6.27 14-14 14z"></path>
                          </g>
                      </svg>
                      <i><?= $item->eventtime() ?></i>
                    </span>
                    <span href="#0" class="story__category">
                      <svg class="icon margin-right-xxxs" viewBox="0 0 48 48">
                          <g fill="#111111">
                              <path d="M36 16c0-6.63-5.37-12-12-12S12 9.37 12 16c0 9 12 22 12 22s12-13 12-22zm-16 0c0-2.21 1.79-4 4-4s4 1.79 4 4-1.79 4-4 4-4-1.79-4-4zM10 40v4h28v-4H10z"></path>
                          </g>
                      </svg>
                      <i><?= $item->eventlocation() ?></i>
                    </span>
                  </div>
                  
                  <div class="text-component">
                    <p><?= $item->eventdesc() ?> </p>
                  </div>
  
                  <div class="margin-top-sm">
                    <div class="flex flex-wrap gap-sm">
                      <a class="link-fx-2" data-link-fx-clone="REGISTER" href="<?= $item->reglink() ?>">REGISTER</a> 
                    </div>
                  </div>

                  
                </div>
              </article>
              <?php endforeach ?>
              

              
              
              <div class="margin-top-sm">
                <div class="flex flex-wrap gap-sm items-center justify-between">
                  <a href="<?= $page->eventlogolink() ?>">
                  <img src="<?php $eventlogo = $page->eventlogo()->toFile();
            echo $eventlogo->url() ?>"  width="130" height="130" />
           </a>
                  <a class="link-fx-2" data-link-fx-clone="Learn with Crunchyroll" href="<?= $page->eventlink() ?>"><?= $page->eventlinktext() ?></a> 
                </div>
              </div>

            </div>
          </div>
        </div>
        </div>
      </section>


      <section class="padding-y-lg">
        <div class="article ">
          <div class="container max-width-adaptive-lg position-relative">
            <div class="padding-md bg-contrast-lower radius-sm ">
            <div class="grid gap-lg">
              <div class="text-component">
                <h2 class="text-xxxl"><?= $page->heading3() ?></h2>
              </div>
              <article class="story col-4@md">
                <div class="text-component">
                <h2 class="text-lg color-contrast-medium"><?= $page->text3() ?></h2>
                <div class="responsive-iframe margin-top-md margin-bottom-md">
                  <?= $page->videolink2() ?>
                  </div>
                  <?= $page->text4() ?>
                  
                </div>
              </article>
              <?php $items = $page->workshop()->toStructure(); ?>
               <?php foreach ($items as $item2): ?>
              <article class="story col-4@md">
                <a href="post.html" class="story__img">
                  <figure class="media-wrapper media-wrapper--4:3">
                  <?php if ($image = $item2->image()->toFile()): ?>
                    <img src="<?php echo $image->url() ?>" alt="GGIT summer camp">
                    <?php endif ?>
                  </figure>
                </a>

                <div class="story__content">
                  <div class="text-component margin-bottom-sm">
                    <h2 class="story__title"><?= $item2->eventtitle() ?></h2>
                  </div>
  
                  <div class="margin-bottom-xs">
                    <span class="story__category">
                      <svg class="icon margin-right-xxxs"   viewBox="0 0 32 32"><title>calendar-60</title><g fill="#111111"><path fill="#111111" d="M31,3h-5V1c0-0.553-0.448-1-1-1h-3c-0.552,0-1,0.447-1,1v2H11V1c0-0.553-0.448-1-1-1H7C6.448,0,6,0.447,6,1 v2H1C0.448,3,0,3.447,0,4v27c0,0.553,0.448,1,1,1h30c0.552,0,1-0.447,1-1V4C32,3.447,31.552,3,31,3z M21,5h5v2h-5V5z M6,5h5v2H6V5z M30,30H2V12h28V30z"></path></g></svg>
                      <i><?= $item2->eventdate() ?></i>
                    </span>
                    <span class="story__category">
                      <svg class="icon margin-right-xxxs"  viewBox="0 0 48 48"><g fill="#111111">
                              <path d="M30 2H18v4h12V2zm-8 26h4V16h-4v12zm16.05-13.23l2.85-2.85c-.86-1.03-1.8-1.97-2.83-2.83l-2.85 2.85C32.15 9.48 28.24 8 23.99 8 14.04 8 6 16.06 6 26s8.04 18 17.99 18S42 35.94 42 26c0-4.25-1.48-8.15-3.95-11.23zM24 40c-7.73 0-14-6.27-14-14s6.27-14 14-14 14 6.27 14 14-6.27 14-14 14z"></path>
                          </g>
                      </svg>
                      <i><?= $item2->eventtime() ?></i>
                    </span>
                    <span href="#0" class="story__category">
                      <svg class="icon margin-right-xxxs" viewBox="0 0 48 48">
                          <g fill="#111111">
                              <path d="M36 16c0-6.63-5.37-12-12-12S12 9.37 12 16c0 9 12 22 12 22s12-13 12-22zm-16 0c0-2.21 1.79-4 4-4s4 1.79 4 4-1.79 4-4 4-4-1.79-4-4zM10 40v4h28v-4H10z"></path>
                          </g>
                      </svg>
                      <i> <?= $item2->eventlocation() ?></i>
                    </span>
                  </div>
                  
                  <div class="text-component">
                    <p><?= $item2->eventdesc() ?></p>
                  </div>
  
                  <div class="margin-top-sm">
                    <div class="flex flex-wrap gap-sm">
                      <a class="link-fx-2" data-link-fx-clone="REGISTER" href="<?= $page->registerlink() ?>">REGISTER</a> 
                    </div>
                  </div>

                  
                </div>
              </article>
              <?php endforeach ?>                                                                                                     

             

              
              
              <div class="margin-top-sm">
              
              
                <div class="flex flex-wrap gap-sm items-center justify-between">
                
                <a href="<?= $page->workshoplogolink() ?>">
                 
              
            <img src="<?php $workshoplogo = $page->workshoplogo()->toFile();
            echo $workshoplogo->url() ?>"  width="130" height="130" />
           
           </a>
                  <a class="link-fx-2" data-link-fx-clone="Learn with goparrot" href="<?= $page->workshoplink() ?>"><?= $page->workshoplinktext() ?></a> 
                </div>
              </div>

            </div>
          </div>
        </div>
        </div>
      </section>




      <?php snippet('footer') ?>