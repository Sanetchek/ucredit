<section id="plan" class="plan">
  <div class="container plan__wrap anim-items">
    <?php $fin = get_field('fin_plan') ?>
    <?php if ($fin) : ?>
    <div class="plan__side">
      <div class="row plan__fin">

        <?php foreach ($fin as $plan) : ?>
        <div class="col-2 plan__fin_item">
          <?php $image = $plan['image'] ?>

          <div class="plan__fin_wrap">
            <?php if ($image) : ?>
              <div class="plan__fin_picture">
                <?= get_image($image, 'thumbnail', ['class' => 'plan__fin_img']) ?>
              </div>
            <?php endif; ?>

            <?php if ($plan['title']) : ?>
              <h5><?= $plan['title'] ?></h5>
            <?php endif; ?>
          </div>

          <?php if ($plan['description']) : ?>
            <p><?= $plan['description'] ?></p>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
    <?php endif; ?>

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
