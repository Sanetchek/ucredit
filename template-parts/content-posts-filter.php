<?php
/**
 * Template part for displaying posts with dynamic filtering
 *
 * @package ucredit
 */

?>

<div class="posts-filter-container">
	<!-- Filter Controls -->
	<div class="filter-controls">
		<div class="container">
			<div class="filter-row">
				<!-- Search Filter -->
				<div class="filter-group">
					<label for="search-filter"><?= __('חיפוש', 'ucredit') ?></label>
					<input type="text" id="search-filter" placeholder="<?= __('חפש במאמרים...', 'ucredit') ?>" class="filter-input">
				</div>

				<!-- Category Filter -->
				<div class="filter-group">
					<label for="category-filter"><?= __('קטגוריה', 'ucredit') ?></label>
					<select id="category-filter" class="filter-select">
						<option value=""><?= __('כל הקטגוריות', 'ucredit') ?></option>
						<?php
						$categories = get_categories(array(
							'orderby' => 'name',
							'order' => 'ASC',
							'hide_empty' => true,
						));
						foreach ($categories as $category) {
							echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
						}
						?>
					</select>
				</div>

				<!-- Sort Filter -->
				<div class="filter-group">
					<label for="sort-filter"><?= __('מיון', 'ucredit') ?></label>
					<select id="sort-filter" class="filter-select">
						<option value="date-desc"><?= __('תאריך - חדש ביותר', 'ucredit') ?></option>
						<option value="date-asc"><?= __('תאריך - ישן ביותר', 'ucredit') ?></option>
						<option value="title-asc"><?= __('כותרת - א-ת', 'ucredit') ?></option>
						<option value="title-desc"><?= __('כותרת - ת-א', 'ucredit') ?></option>
					</select>
				</div>

				<!-- Clear Filters -->
				<div class="filter-group">
					<button type="button" id="clear-filters" class="clear-filters-btn">
						<?= __('נקה סינון', 'ucredit') ?>
					</button>
				</div>
			</div>

			<!-- Active Filters Display -->
			<div class="active-filters" id="active-filters" style="display: none;">
				<span class="active-filters-label"><?= __('סינון פעיל:', 'ucredit') ?></span>
				<div class="active-filter-tags" id="active-filter-tags"></div>
			</div>
		</div>
	</div>

	<!-- Posts Container -->
	<div class="posts-container">
		<div class="container">
			<!-- Loading Indicator -->
			<div class="loading-indicator" id="loading-indicator" style="display: none;">
				<div class="spinner"></div>
				<span><?= __('טוען...', 'ucredit') ?></span>
			</div>

			<!-- Posts Grid -->
			<div class="posts-grid" id="posts-grid">
				<?php
				// Initial posts load
				$posts_query = new WP_Query(array(
					'post_type' => 'post',
					'posts_per_page' => 12,
					'post_status' => 'publish',
					'orderby' => 'date',
					'order' => 'DESC',
				));

				if ($posts_query->have_posts()) :
					while ($posts_query->have_posts()) : $posts_query->the_post();
						get_template_part('template-parts/content', 'archive');
					endwhile;
					wp_reset_postdata();
				else :
					echo '<div class="no-posts-found"><p>' . __('לא נמצאו מאמרים', 'ucredit') . '</p></div>';
				endif;
				?>
			</div>

			<!-- Load More Button -->
			<div class="load-more-container" id="load-more-container" style="display: none;">
				<button type="button" id="load-more-btn" class="load-more-btn">
					<?= __('טען עוד מאמרים', 'ucredit') ?>
					<span class="posts-count">(<span id="current-count">0</span> <?= __('מתוך', 'ucredit') ?> <span id="total-count">0</span>)</span>
				</button>
			</div>

			<!-- No Results Message -->
			<div class="no-results" id="no-results" style="display: none;">
				<div class="no-results-content">
					<h3><?= __('לא נמצאו תוצאות', 'ucredit') ?></h3>
					<p><?= __('נסה לשנות את הסינון או החיפוש שלך', 'ucredit') ?></p>
					<button type="button" id="reset-search" class="reset-search-btn"><?= __('אפס חיפוש', 'ucredit') ?></button>
				</div>
			</div>
		</div>
	</div>
</div>