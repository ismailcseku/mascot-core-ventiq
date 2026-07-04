<section>
  <div class="<?php echo esc_attr( $container_type ); ?>">
  	<div class="main-content-area">
			<?php
				ventiq_get_project_layout();
			?>
			<div class="pagination-wrapper">
				<?php
					ventiq_get_pagination();
				?>
			</div>
		</div>
  </div>
</section>