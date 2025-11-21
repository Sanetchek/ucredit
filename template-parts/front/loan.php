<section id="loan" class="loan">
  <div class="anim-items">
    <?php if (!wp_is_mobile()) : ?>
      <?php $bg = get_field('loan_image') ?>

      <?php if ($bg) : ?>
        <?= get_image($bg, 'medium_large', ['class' => 'loan__image']) ?>
      <?php else: ?>
        <img src="<?= assets('img/loan_bg.svg') ?>" alt="" class="loan__image">
      <?php endif; ?>
    <?php endif; ?>

    <div class="container">
      <div class="loan__content">
        <?php if (get_field('loan_label')) : ?>
          <h5 class="green"><?= get_field('loan_label') ?></h5>
        <?php endif; ?>

        <?php if (get_field('loan_title')) : ?>
          <h2><?= get_field('loan_title') ?></h2>
        <?php endif; ?>

        <?php if (get_field('loan_description')) : ?>
          <p><?= get_field('loan_description') ?></p>
        <?php endif; ?>

        <?php $list = get_field('loan_list'); ?>
        <?php if ($list) : ?>
        <ul>
          <?php foreach ($list as $item) : ?>
            <li class="check"><?= $item['item'] ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <?php
          $link = get_field('loan_link');
          $modal = get_field('loan_popup') ? ' modal-show' : '';
        ?>
        <?php if ($link) : ?>
          <a href="<?= $link['url'] ?>" class="btn btn__blue<?= $modal ?>"><?= $link['title'] ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
