<?php
add_action('widgets_init', 'ftc_product_categories_load_widgets');

function ftc_product_categories_load_widgets()
{
	register_widget('Ftc_Product_Categories_Widget');
}

if(!class_exists('Ftc_Product_Categories_Widget')){
	class Ftc_Product_Categories_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ftc-product-categories-widget', 'description' => esc_html__('Display Your Product Categories', 'ftc-element'));
			parent::__construct('ftc_product_categories', esc_html__('FTC - Product Categories', 'ftc-element'), $widgetOps);
		}

		function widget( $args, $instance ) {

			if ( !ftc_has_woocommerce() ) {
				return;
			}
			
			extract($args);
			$title 				= apply_filters( 'widget_title', $instance['title'] );		
			$show_post_count 	= $instance['show_post_count'];
			$show_icon 	        = ! empty($instance['show_icon']) ? $instance['show_icon'] : 0;	
			$show_sub_cat 		= $instance['show_sub_cat'];		
			$hide_empty 		= $instance['hide_empty'];		
			$orderby 			= $instance['orderby'];		
			$order 				= $instance['order'];
			if( !is_array($instance['include_cat']) ){
				$instance['include_cat'] = array();
			}
			$include_cat 		= $instance['include_cat'];	
			
			$current_cat = (isset($_GET['product_cat']) && $_GET['product_cat']!='')?$_GET['product_cat']:get_query_var('product_cat', '');
			?>
			<?php print_r($before_widget);?>
			<?php print_r($before_title); print_r($title); print_r($after_title);?>
			<div class="ftc-product-categories-list">
				<?php 
				$args = array(
					'taxonomy'     	=> 'product_cat'
					,'orderby'      => $orderby
					,'order'        => $order
					,'hierarchical' => 0
					,'parent'       => 0
					,'title_li'     => ''
					,'hide_empty'   => $hide_empty
					,'include'		=> implode(',', $include_cat)
				);
				$all_categories = get_categories( $args );
				if( $all_categories ){
					if( $orderby == 'rand' ){
						shuffle($all_categories);
					}
					echo '<ul class="product-categories">';
					foreach ($all_categories as $cat) {
						$current_class = ($current_cat==$cat->slug)?'current':''; 
						echo '<li class="cat-item '.esc_attr($current_class).'">';
						$category_id = $cat->term_id;
						echo '<span class="icon-toggle"></span>';
						$term = get_term_by($category_id, $cat, 'product_cat');
						$icon_id = get_term_meta($category_id, 'shortcode_icon_id', true);
						if( !empty($icon_id) && $show_icon ){
							?>
							<span class="image-icon"><?php echo wp_get_attachment_image($icon_id); ?></span>
							<?php
						}
						echo '<a href="'. esc_url(get_term_link($cat->slug, 'product_cat')) .'">'. esc_html($cat->name);
						if($show_post_count){
							echo ' ('. $cat->count .')';
						}
						echo '</a>';
						if($show_sub_cat){
							$this->get_sub_categories($category_id, $instance, $current_cat);
						}
						echo '</li>';
					}
					echo '</ul>';
				}

				?>
				<div class="clear"></div>
			</div>

			<?php
			print_r($after_widget);
		}
		

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] 				= strip_tags($new_instance['title']);
			$instance['show_post_count'] 	= $new_instance['show_post_count'];
			$instance['show_icon'] 	        = $new_instance['show_icon'];
			$instance['show_sub_cat'] 		= $new_instance['show_sub_cat'];
			$instance['hide_empty'] 		= $new_instance['hide_empty'];
			$instance['orderby'] 			= $new_instance['orderby'];
			$instance['order'] 				= $new_instance['order'];	
			$instance['include_cat'] 		= $new_instance['include_cat'];
			
			return $instance;
		}

		function form( $instance ) { 
			$defaults = array( 
				'title' 			=> 'Categories'
				,'show_post_count'	=> 1
				,'show_icon'       => 0
				,'show_sub_cat'		=> 1
				,'hide_empty'		=> 0
				,'orderby'			=> 'name'
				,'order'			=> 'asc'
				,'include_cat'		=> array()
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			$instance['title'] 	= esc_attr($instance['title']);
			$categories = $this->get_list_categories(0);
			if( !is_array($instance['include_cat']) ){
				$instance['include_cat'] = array();
			}
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter your title','ftc-element'); ?> </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			<p>
				<input type="checkbox" value="1" id="<?php echo esc_attr($this->get_field_id('show_post_count')); ?>" name="<?php echo esc_attr($this->get_field_name('show_post_count')); ?>" <?php checked($instance['show_post_count'], 1); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_post_count')); ?>"><?php esc_html_e('Show post count', 'ftc-element'); ?></label>
			</p>
			<p>
				<input type="checkbox" value="1" id="<?php echo esc_attr($this->get_field_id('show_icon')); ?>" name="<?php echo esc_attr($this->get_field_name('show_icon')); ?>" <?php checked($instance['show_icon'], 1); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_icon')); ?>"><?php esc_html_e('Show icon', 'ftc-element'); ?></label>
			</p>
			<p>
				<input type="checkbox" value="1" id="<?php echo esc_attr($this->get_field_id('show_sub_cat')); ?>" name="<?php echo esc_attr($this->get_field_name('show_sub_cat')); ?>" <?php checked($instance['show_sub_cat'], 1); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_sub_cat')); ?>"><?php esc_html_e('Show sub categories', 'ftc-element'); ?></label>
			</p>
			<p>
				<input type="checkbox" value="1" id="<?php echo esc_attr($this->get_field_id('hide_empty')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_empty')); ?>" <?php checked($instance['hide_empty'], 1); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('hide_empty')); ?>"><?php esc_html_e('Hide empty categories', 'ftc-element'); ?></label>
			</p>
			<p>
				<label><?php esc_html_e('Select categories', 'ftc-element'); ?></label>
				<div class="categorydiv">
					<div class="tabs-panel">
						<ul class="categorychecklist">
							<?php foreach($categories as $cat){ ?>
								<li>
									<label>
										<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('include_cat')); ?>[<?php $cat->term_id; ?>]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id,$instance['include_cat']))?'checked':''; ?> />
										<?php echo esc_html($cat->name); ?>
									</label>
									<?php $this->get_list_sub_categories($cat->term_id, $instance); ?>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<span class="description"><?php esc_html_e("Don't select to show all", "ftc-element"); ?></span>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order by', 'ftc-element'); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" >
					<option value="name" <?php selected($instance['orderby'], 'name'); ?> ><?php esc_html_e('Name', 'ftc-element'); ?></option>
					<option value="slug" <?php selected($instance['orderby'], 'slug'); ?> ><?php esc_html_e('Slug', 'ftc-element'); ?></option>
					<option value="count" <?php selected($instance['orderby'], 'count'); ?> ><?php esc_html_e('Number product', 'ftc-element'); ?></option>
					<option value="rand" <?php selected($instance['orderby'], 'rand'); ?> ><?php esc_html_e('Random', 'ftc-element'); ?></option>
					<option value="none" <?php selected($instance['orderby'], 'none'); ?> ><?php esc_html_e('None', 'ftc-element'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Order', 'ftc-element'); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('order')); ?>" name="<?php echo esc_attr($this->get_field_name('order')); ?>" >
					<option value="asc" <?php selected($instance['order'], 'asc'); ?> ><?php esc_html_e('Ascending', 'ftc-element'); ?></option>
					<option value="desc" <?php selected($instance['order'], 'desc'); ?> ><?php esc_html_e('Descending', 'ftc-element'); ?></option>
				</select>
			</p>
			
			<?php 
		}
		
		function get_sub_categories( $category_id, $instance, $current_cat ){
			$args = array(
				'taxonomy'      => 'product_cat'
				,'child_of'     => 0
				,'parent'       => $category_id
				,'orderby'      => $instance['orderby']
				,'order'        => $instance['order']
				,'hierarchical' => 0
				,'title_li'     => ''
				,'hide_empty'   => $instance['hide_empty']
				,'include'	   => implode(',', $instance['include_cat'])
			);
			$sub_cats = get_categories( $args );
			if( $sub_cats ) {
				if( $instance['orderby'] == 'rand' ){
					shuffle($sub_cats);
				}
				echo '<ul class="children" style="display: none">';
				foreach($sub_cats as $sub_category) {
					$current_class = ($current_cat == $sub_category->slug)?'current':'';
					echo '<li class="cat-item '.esc_attr($current_class).'">';
					echo '<span class="icon-toggle"></span>';
					echo '<a href="'. esc_url(get_term_link($sub_category, 'product_cat')) .'">'. esc_html($sub_category->name);
					if( $instance['show_post_count'] ){
						echo ' (' . $sub_category->count . ')';
					}
					echo '</a>';
					$this->get_sub_categories($sub_category->term_id, $instance, $current_cat);
					echo '</li>';
				}
				echo '</ul>';

			}
		}
		
		function get_list_categories( $cat_parent_id ){
			if ( !ftc_has_woocommerce() ) {
				return array();
			}
			$args = array(
				'taxonomy' 			=> 'product_cat'
				,'hierarchical'		=> 1
				,'parent'			=> $cat_parent_id
				,'title_li'			=> ''
				,'child_of'			=> 0
			);
			$cats = get_categories($args);
			return $cats;
		}
		
		function get_list_sub_categories( $cat_parent_id, $instance ){
			$sub_categories = $this->get_list_categories($cat_parent_id); 
			if( count($sub_categories) > 0){
				?>
				<ul class="children">
					<?php foreach( $sub_categories as $sub_cat ){ ?>
						<li>
							<label>
								<input type="checkbox" name="<?php echo esc_attr($this->get_field_name('include_cat')); ?>[<?php esc_attr($sub_cat->term_id); ?>]" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id,$instance['include_cat']))?'checked':''; ?> />
								<?php echo esc_html($sub_cat->name); ?>
							</label>
							<?php $this->get_list_sub_categories($sub_cat->term_id, $instance); ?>
						</li>
					<?php } ?>
				</ul>
			<?php }
		}
		
	}
}

