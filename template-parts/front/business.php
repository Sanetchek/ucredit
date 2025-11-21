<section id="business" class="business">
  <div class="anim-items">
    <?php if (!wp_is_mobile()) : ?>
      <?php $bg = get_field('bus_image') ?>

      <?php if ($bg) : ?>
        <?= get_image($bg, 'full', ['class' => 'buildings']) ?>
      <?php else: ?>
        <img src="<?= assets('img/buildings.svg') ?>" alt="" class="buildings">
      <?php endif; ?>
    <?php endif; ?>

    <div class="container">

      <div class="business__content">
        <?php if (get_field('bus_label')) : ?>
          <h5 class="green center"><?= get_field('bus_label') ?></h5>
        <?php endif; ?>

        <?php if (get_field('bus_title')) : ?>
          <h2 class="center"><?= get_field('bus_title') ?></h2>
        <?php endif; ?>

        <?php if (get_field('bus_description')) : ?>
          <p class="center"><?= get_field('bus_description') ?></p>
        <?php endif; ?>
      </div>


      <?php $sol = get_field('bus_solutions') ?>
      <?php if ($sol) : ?>
      <div class="row business__solution">
        <?php foreach ($sol as $item) : ?>
          <div class="col-3 business__solution_item">
            <?php if ($item['image']) : ?>
              <div class="business__solution_img">
                <?= get_image($item['image'], 'thumbnail') ?>
              </div>
            <?php endif; ?>

            <h5 class="center"><?= $item['title'] ?></h5>

            <p class="center"><?= $item['description'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>
