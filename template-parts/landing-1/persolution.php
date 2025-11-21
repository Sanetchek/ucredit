<section id="solution" class="solution">
  <div class="container solution__content anim-items active">
    <?php $image = get_field('sol_image'); ?>

    <?php if ($image) : ?>
      <?= get_image($image, 'medium', ['class' => 'solution__image']) ?>
    <?php else: ?>
      <img src="<?= assets('img/solution_bg.svg') ?>" alt="solution_bg" class="solution__image">
    <?php endif; ?>

    <div class="solution__info">
      <?php if (get_field('sol_title')) : ?>
        <h3><?= get_field('sol_title') ?></h3>
      <?php endif; ?>

      <?php if (get_field('sol_description')) : ?>
        <p><?= get_field('sol_description') ?></p>
      <?php endif; ?>

      <?php
        $link = get_field('sol_link');
        $modal = get_field('sol_popup') ? ' modal-show' : '';
      ?>

      <?php if ($link) : ?>
        <a href="<?= $link['url'] ?>" class="btn btn__bluelight<?= $modal ?>"><?= $link['title'] ?></a>
      <?php endif; ?>
    </div>
  </div>
</section>
