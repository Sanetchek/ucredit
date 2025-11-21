<section id="how" class="how">
  <div class="how__container anim-items">
    <?php if (!wp_is_mobile()) : ?>
      <?php $bg = get_field('how_image') ?>

      <?php if ($bg) : ?>
        <?= get_image($bg, 'medium_large', ['class' => 'how__image']) ?>
      <?php else: ?>
        <img src="<?= assets('img/how_bg.svg') ?>" alt="" class="how__image">
      <?php endif; ?>
    <?php endif; ?>

    <div class="container how__wrap">
      <div class="how__content">
        <?php if (get_field('how_label')) : ?>
          <h5 class="green"><?= get_field('how_label') ?></h5>
        <?php endif; ?>

        <?php if (get_field('how_title')) : ?>
          <h2><?= get_field('how_title') ?></h2>
        <?php endif; ?>

        <?php if (get_field('how_description')) : ?>
          <p><?= get_field('how_description') ?></p>
        <?php endif; ?>

        <?php $steps = get_field('how_steps') ?>
        <?php if ($steps) : ?>
        <section class="row how__steps">

          <?php foreach ($steps as $step) : ?>
            <div class="col-2 step">
              <div class="step__wrap">
                <?php if ($step['image']) : ?>
                  <div class="step__img">
                    <?= get_image($step['image'], 'thumbnail') ?>
                  </div>
                <?php endif; ?>

                <?php if ($step['title']) : ?>
                  <h5><?= $step['title'] ?></h5>
                <?php endif; ?>
              </div>

              <?php if ($step['description']) : ?>
                <p><?= $step['description'] ?></p>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>


        </section>
        <?php endif; ?>

        <?php
          $link = get_field('how_link');
          $modal = get_field('how_popup') ? ' modal-show' : '';
        ?>
        <?php if ($link) : ?>
          <a href="<?= $link['url'] ?>" class="btn btn__blue<?= $modal ?>"><?= $link['title'] ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
