<?php
// get detail segments.
  global $post;
  $header  = get_sub_field('detail_header');
  $summary = get_sub_field('detail_summary');
  $items   = get_sub_field('detaillist');


?>


<section>
	<div>
		<div class="content-subnav clearfix">
			<div class="col-main-content col">
				<?php if (isset($header)) : ?>
					<h2><?php echo $header; ?></h2>
				<?php endif; ?>
				<?php if (isset($summary)) : ?>
					<p><?php echo $summary; ?></p>
				<?php endif; ?>

				<?php if (!empty($items)) { ?>
				<div class="accordion-extension responsible-travel">
					<?php foreach ($items as $item) { ?>
					<div class="accordion-item">
						<div class="wrap">
							<div class="lead clearfix">
							<?php if (isset($item['detail_header'])) : ?>
								<h3><?php echo $item['detail_header']; ?></h3>
							<?php endif; ?>
							<?php if (isset($item['detail_intro'])) : ?>
								<p><?php echo $item['detail_intro']; ?></p>
							<?php endif; ?>

							</div>
						<?php if (isset($item['detail_main'])) : ?>
							<div class="extend">
							<?php echo $item['detail_main']; ?>
							</div>
						<?php endif; ?>
						</div>
					</div>
					<?php } // end of foreach ?>
				</div>
				<?php } // end of if ?>
			</div>
			<div class="col col-main-sidebar subnav cats">
				<?php get_template_part( 'templates/nav/base' ); ?>
			</div>
		</div>
	</div>
</section>