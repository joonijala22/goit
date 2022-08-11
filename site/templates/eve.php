<?php snippet('header2') ?>


<section class="events">

  <h1><?= $page->title()->html() ?></h1>

  <?php 
  $events = $page->children()->listed();
  if ($events->count() > 0): ?>
  <ul>
    <?php foreach ($events as $event): ?>
    <li class="event">
      <a href="<?= $event->link() ?>">
        <header>
          <h3><?= $event->title()->html() ?></h3>
          <time><?= $event->from()->toDate('d.m.Y') ?> - <?= $event->to()->toDate('d.m.Y') ?></time>
        </header>
        <main>
          <?= $event->text()->kirbytext() ?>
          <?php if ($image = $event->image()): ?>
          <figure><?= $event->image() ?></figure>
          <?php endif ?>
        </main>
        <footer><?= $event->location()->html() ?></footer>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
  <?php endif ?>
</section>

<?php snippet('footer') ?>