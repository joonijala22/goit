<!doctype html>
<html>
<head>



  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>document.getElementsByTagName("html")[0].className += " js";</script>

  <?= css([
  'https://use.typekit.net/jzh1pxu.css',
    'https://fonts.googleapis.com/css2?family=Grandstander:wght@200;300;400;700&display=swap',
  'assets/css/style.css',
  ]) ?>
  <!-- favicon -->
  <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
  <!-- browsers not supporting CSS variables -->
  <script>
    if(!('CSS' in window) || !CSS.supports('color', 'var(--color-var)')) {var cfStyle = document.getElementById('codyframe');if(cfStyle) {var href = cfStyle.getAttribute('href');href = href.replace('style.css', 'style-fallback.css');cfStyle.setAttribute('href', href);}}
  </script>
  

</head>



<body>
  
<!-- header -->
  <header class="f-header position-relative js-f-header">
      <div class="f-header__mobile-content container max-width-lg margin-top-md">
        <a href="index.html" class="f-header__logo">
          <img src="https://girlsgoit.org/girlsgoit-logo.svg">
        </a>
            <button class="reset anim-menu-btn js-anim-menu-btn f-header__nav-control js-tab-focus" aria-label="Toggle menu">
                <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
            </button>
      </div>

      <div class="f-header__nav margin-top-md" role="navigation">
        <div class="f-header__nav-grid justify-between@md container max-width-lg">
          <div class="f-header__nav-logo-wrapper flex-grow flex-basis-0">
            <a href="index.html" class="f-header__logo">
              <img src="https://girlsgoit.org/girlsgoit-logo.svg">
            </a>
          </div>
      
         <?php $items = $pages->listed(); if($items->count()): ?>
          <ul class="f-header__list flex-grow flex-basis-0 justify-center@md">
          
          
        <?php foreach($items as $item): ?>
        <li class="f-header__item"  >   
        
            <a href="<?= $item->url() ?>" <?php e($item->isOpen(), ' aria-current="page" ') ?> class="f-header__link"><?= $item->title()->html() ?></a>
          
        </li>
      <?php endforeach ?>

          </ul>
          <?php endif ?>

          <div class="f-header__list flex-grow flex-basis-0 justify-end language-picker js-language-picker" data-trigger-class="btn btn--subtle js-tab-focus">
              <form action="" class="language-picker__form">
                <label for="language-picker-select">Select your language</label>

                <select name="language-picker-select" id="language-picker-select">
                  <option lang="en" value="english" selected>English</option>
                  <option lang="ro" value="romania">Română</option>
                  <option lang="ru" value="russia">Русский</option>
                </select>
              </form>
            </div>

          
            

        </div>
      </div>
</header>