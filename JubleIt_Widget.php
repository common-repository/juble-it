<?php
class JubleIt_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'jubleit_widget',
			'description' => 'This widget enables creators to add the J! button to some content.',
		);
		parent::__construct( 'jubleit_widget_1', 'Juble it! Button', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args      Display arguments including 'before_title', 'after_title',
         *                        'before_widget', and 'after_widget'.
	 * @param array $instance  The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget (boilerplate)
		$api_key = $instance['api'];

                echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo "<script>(function () {
	var s = document.createElement('script');
	s.type = 'text/javascript';
	s.async = true;
	s.src = 'http://button.jubleit.com/jubleit.js';
	var t = document.getElementsByTagName('script')[0];
	t.parentNode.insertBefore(s, t);
})()</script>";


echo "<div id='jubleit'>
	<jubleit-button api='".$api_key."' version='default'></jubleit-button>
</div><p> </p>";
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin (API key form)
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );

		    ?>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Add a Message:</label>
        <input type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>">
    </p>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'api' ) ); ?>">Your API key:</label>
        <input type="text" value="<?php echo esc_attr( $instance['api'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'api' ) ); ?>">
    </p>
    <?php

	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved (save API key)
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['api'] = ( ! empty( $new_instance['api'] ) ) ? strip_tags( $new_instance['api'] ) : '';

		return $instance;
	}
}

add_action('widgets_init',
	create_function('', 'return register_widget("JubleIt_Widget");')
);
?>
