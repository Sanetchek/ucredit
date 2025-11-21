<section id="plan" class="plan">
  <div class="container plan__wrap anim-items">
    <div class="plan__side">
      <div class="row plan__fin">

      <?php if (!wp_is_mobile()) : ?>
        <?php $bg = get_field('how_image') ?>

        <?php if ($bg) : ?>
          <?= get_image($bg, 'medium_large') ?>
        <?php else: ?>
          <img src="<?= assets('img/how_bg.svg') ?>" alt="" class="">
        <?php endif; ?>
      <?php endif; ?>

      </div>
    </div>

    <div class="plan__side plan__info">
      <?php if (get_field('plan_label')) : ?>
        <h5 class="green"><?= get_field('plan_label') ?></h5>
      <?php endif; ?>

      <?php if (get_field('plan_title')) : ?>
        <h2><?= get_field('plan_title') ?></h2>
      <?php endif; ?>

      <?php $desc = explode(PHP_EOL, get_field('plan_description')) ?>
      <?php if (get_field('plan_description')) : ?>
        <div>
          <?php foreach ($desc as $p) : ?>
            <p><?= $p ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php $list = get_field('plan_list') ?>
      <?php if ($list) : ?>
        <ul>
          <?php foreach ($list as $item) : ?>
            <li class="check"><?= $item['item'] ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <?php
        $link = get_field('plan_link');
        $modal = get_field('plan_popup') ? ' modal-show' : '';
      ?>
      <?php if ($link) : ?>
        <a href="<?= $link['url'] ?>" class="btn btn__blue<?= $modal ?>"><?= $link['title'] ?></a>
      <?php endif; ?>
    </div>
  </div>
</section>
