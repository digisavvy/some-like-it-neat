<?php

class Kirki_Customize_Sliderui_Control extends WP_Customize_Control {

	public $type = 'slider';

	public $description = '';

	public $subtitle = '';

	public $separator = false;

	public function enqueue() {

		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-slider' );

	}

	public function render_content() { ?>
		<label>

			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
				<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
					<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
				<?php } ?>
			</span>

			<?php if ( '' != $this->subtitle ) : ?>
				<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
			<?php endif; ?>

			<input type="text" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>

		</label>

		<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
		<?php if ( $this->separator ) echo '<hr class="customizer-separator">'; ?>
		<script>
		jQuery(document).ready(function($) {
			$( "#slider_<?php echo $this->id; ?>" ).slider({
					value : <?php echo $this->value(); ?>,
					min   : <?php echo $this->choices['min']; ?>,
					max   : <?php echo $this->choices['max']; ?>,
					step  : <?php echo $this->choices['step']; ?>,
					slide : function( event, ui ) { $( "#input_<?php echo $this->id; ?>" ).val(ui.value).keyup(); }
			});
			$( "#input_<?php echo $this->id; ?>" ).val( $( "#slider_<?php echo $this->id; ?>" ).slider( "value" ) );
		});
		</script>
		<?php

	}
}
