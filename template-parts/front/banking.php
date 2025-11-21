<section id="banking" class="banking">
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

      <div class="banking__links">
        <?php
          $link1 = get_field('banking_link_1');
          $link2 = get_field('banking_link_2');
          $modal1 = get_field('banking_popup_1') ? ' modal-show' : '';
          $modal2 = get_field('banking_popup_2') ? ' modal-show' : '';
        ?>

        <?php if ($link1) : ?>
          <a href="<?= $link1['url'] ?>" class="btn btn__blue<?= $modal1 ?>"><?= $link1['title'] ?></a>
        <?php endif; ?>

        <?php if ($link2) : ?>
          <a href="<?= $link2['url'] ?>" class="btn<?= $modal2 ?>"><?= $link2['title'] ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
