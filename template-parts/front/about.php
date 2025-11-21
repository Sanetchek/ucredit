<section id="about" class="about">
  <div class="about__circle"></div>

  <div class="container about__content anim-items">

    <div class="about__info">
      <?php if (get_field('about_label')) : ?>
        <h5 class="green"><?= get_field('about_label') ?></h5>
      <?php endif; ?>

      <?php if (get_field('about_title')) : ?>
        <h2><?= get_field('about_title') ?></h2>
      <?php endif; ?>

      <?php if (get_field('about_description')) : ?>
        <p><?= get_field('about_description') ?></p>
      <?php endif; ?>

      <?php $adv = get_field('about_advantages') ?>

      <?php if ($adv) : ?>
        <div class="about__advs">
          <?php foreach ($adv as $item) : ?>
            <div class="about__advs_item">
              <h4 class="about__advs_wrap" dir="ltr">
                <span class="about__advs_num"><?= $item['number'] ?></span>
                <span class="about__advs_symb"><?= $item['symbol'] ?></span>
              </h4>

              <p><?= $item['label'] ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="about__bank-logos">
        <?php get_template_part('template-parts/bank-logos') ?>
      </div>
    </div>

    <?php if (!wp_is_mobile()) : ?>
      <div class="about__images">
        <?php $images = get_field('about_images'); ?>

        <?php if ($images) : ?>
          <?php
            $image1 = $images[0]['image'];
            $image2 = $images[1]['image'];
            $image3 = $images[2]['image'];
          ?>

          <?php if ($image1) : ?>
            <?= get_image($image1, 'about', ['class' => 'about__image about__image_1']) ?>
          <?php endif; ?>

          <?php if ($image2) : ?>
            <?= get_image($image2, 'about', ['class' => 'about__image about__image_2']) ?>
          <?php endif; ?>

          <?php if ($image3) : ?>
            <?= get_image($image3, 'about', ['class' => 'about__image about__image_3']) ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
