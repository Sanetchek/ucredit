<form action="/" method="get" class="label-top search">
  <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
  <label for="search"><?= __('חיפוש ל', 'ucredit') ?></label>
  <button class="btn btn__green search__btn"><?= __('חיפוש', 'ucredit') ?></button>
</form>
