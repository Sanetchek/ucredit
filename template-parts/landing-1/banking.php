<section id="banking" class="banking no-header">
  <?php $image = get_field('banking_bg'); ?>

  <?php if ($image) : ?>
    <?= get_image($image, 'large', ['class' => 'banking__bg']); ?>
  <?php else : ?>
    <img src="<?= assets('img/bank_bg.svg') ?>" alt="background" class="banking__bg">
  <?php endif; ?>

  <div class="container">
    <div class="banking__wrap">
      <?php if (get_field('banking_label')) : ?>
        <h4 class="green"><?php the_field('banking_label') ?></h4>
      <?php endif; ?>

      <?php if (get_field('banking_title')) : ?>
        <h1><?php the_field('banking_title') ?></h1>
      <?php endif; ?>

      <?php if (get_field('banking_descrition')) : ?>
        <p class="large"><?php the_field('banking_descrition') ?></p>
      <?php endif; ?>

      <div class="banking__links separated">
        <?php
          $link1 = get_field('banking_link_1');
          $modal1 = get_field('banking_popup_1') ? ' modal-show' : '';
          $logo = get_field('banking_logo');
        ?>

        <?php if ($link1) : ?>
          <a href="<?= $link1['url'] ?>" class="btn btn__blue<?= $modal1 ?>"><?= $link1['title'] ?></a>
        <?php endif; ?>

        <?php if ($logo) :?>
          <?= wp_get_attachment_image($logo, 'medium') ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
