<section id="faq" class="faq">
  <div class="faq__content anim-items">
    <?php if (get_field('faq_label')) : ?>
      <h5 class="green center"><?= get_field('faq_label') ?></h5>
    <?php endif; ?>

    <?php if (get_field('faq_title')) : ?>
      <h2 class="center"><?= get_field('faq_title') ?></h2>
    <?php endif; ?>

    <?php if (get_field('faq_description')) : ?>
      <p class="center"><?= get_field('faq_description') ?></p>
    <?php endif; ?>

    <?php $faq = get_field('faq_questions') ?>
    <?php if ($faq) : ?>
      <div class="faq__tabs">
        <?php foreach ($faq as $item) : ?>
          <div class="faq__tab">
            <div class="faq__open">
              <div class="faq__open_dash"></div>
              <div class="faq__open_dash"></div>
            </div>
            <h5 class="faq__tab_question"><?= $item['question'] ?></h5>
            <p class="faq__tab_answer"><?= $item['answer'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
