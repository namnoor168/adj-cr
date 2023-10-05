<?php
add_action('widgets_init', 'ftc_recent_comments_load_widgets');

function ftc_recent_comments_load_widgets()
{
	register_widget('Ftc_Recent_Comments_Widget');
}

if( !class_exists('Ftc_Recent_Comments_Widget') ){
	class Ftc_Recent_Comments_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ftc-recent-comments-widget', 'description' => esc_html__('Display recent comments on site', 'ftc-element'));
			parent::__construct('ftc_recent_comments', esc_html__('FTC - Recent Comments', 'ftc-element'), $widgetOps);
		}

		function widget( $args, $instance ) {
			
			extract($args);
			$title 				= apply_filters('widget_title', $instance['title']);
			$limit 				= ($instance['limit'] != 0)?absint($instance['limit']):4;
			$post_type 			= $instance['post_type'];
			$show_date 			= empty($instance['show_date'])?0:$instance['show_date'];
			$show_avatar 		= empty($instance['show_avatar'])?0:$instance['show_avatar'];
			$show_author 		= empty($instance['show_author'])?0:$instance['show_author'];
			$show_comment 		= empty($instance['show_comment'])?0:$instance['show_comment'];
			$show_post_on 		= empty($instance['show_post_on '])?0:$instance['show_post_on '];
			$is_slider 			= empty($instance['is_slider'])?0:$instance['is_slider'];
			$row 				= ($instance['row'] != 0)?absint($instance['row']):2;
			$show_nav 			= empty($instance['show_nav'])?0:$instance['show_nav'];
			$auto_play 			= empty($instance['auto_play'])?0:$instance['auto_play'];
			
			print_r($before_widget);
			
			if( $title ){
				print_r($before_title); print_r($title); print_r($after_title);
			}
			
			$args = array( 
				'number' 		=> $limit
				,'status' 		=> 'approve'
				,'post_status'	=> 'publish'
				,'comment_type' => ''
				);
			if( $post_type != 'all' ){
				$args['post_type'] = $post_type;
			}
			$comments = get_comments( $args );
			
			if( $comments ):
				$count = 0;
			$num_posts = count($comments);
			if( $num_posts <= $row ){
				$is_slider = false;
			}
			if( !$is_slider ){
				$row = $num_posts;
			}

			$extra_class = '';
			$extra_class .= ($is_slider)?'ftc-slider loading':'';
			?>
			<div class="ftc_recent_comments<?php echo esc_attr($extra_class); ?>">
				<?php foreach( (array) $comments as $comment ): $GLOBALS['comment'] = $comment; ?>
					<?php if( $count % $row == 0 ): ?>
						
						<ul class="recent_comment">
						<?php endif; ?>
						<li>
							<div class="comment-meta">
								<?php if( $show_avatar ): ?>
									<div class="avatar">
										<a href="<?php comment_link() ; ?>"><?php echo get_avatar( $comment->comment_author_email ); ?></a>
									</div>
								<?php endif; ?>

								<div class="meta">
									<?php if( $show_author ): ?>
										<span class="author">

											<a href="<?php echo (get_comment_author_url() == '')?'javascript: void(0)':get_comment_author_url(); ?>" rel="external nofollow"><i class="fa fa-user"></i> <?php echo esc_html($comment->comment_author); ?></a>
										</span>
									<?php endif; ?>

									<?php if( $show_date ): ?>
										<div class="date">
											<i class="fa fa-calendar"></i>
											<?php comment_date('M d, Y'); ?>
										</div>
									<?php endif; ?>
									<?php if( $show_comment ): ?>
										<p class="comment-info"><?php echo ftc_string_limit_words(wp_strip_all_tags(get_comment_text()), 3); ?></p>
									<?php endif; ?>
								</div>
							</div>

						</li>
						<?php if( $count % $row == $row - 1 || $count == $num_posts - 1 ): ?>	
						</ul>
						
					<?php endif; ?>
					<?php $count++; endforeach; ?>
				</div>
				<?php
				endif;

				print_r($after_widget);
			}

			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;		
				$instance['title'] 				= strip_tags($new_instance['title']);		
				$instance['limit'] 				= absint($new_instance['limit']);		
				$instance['post_type'] 			= $new_instance['post_type'];		
				$instance['show_date'] 			= $new_instance['show_date'];
				$instance['show_avatar'] 		= $new_instance['show_avatar'];			
				$instance['show_author'] 		= $new_instance['show_author'];		
				$instance['show_comment'] 		= $new_instance['show_comment'];
				$instance['show_post_on'] 		= $new_instance['show_post_on'];
				$instance['is_slider'] 			= $new_instance['is_slider'];	
				$instance['row'] 				= absint($new_instance['row']);			
				$instance['show_nav'] 			= $new_instance['show_nav'];		
				$instance['auto_play'] 			= $new_instance['auto_play'];	

				if( $instance['row'] > $instance['limit'] ){
					$instance['row'] = $instance['limit'];
				}
				return $instance;
			}

			function form( $instance ) {

				$defaults = array(
					'title' 				=> 'Recent Comments'
					,'limit'				=> 4
					,'post_type'			=> 'all'
					,'show_avatar' 			=> 1
					,'show_date' 			=> 1
					,'show_author' 			=> 1
					,'show_comment'			=> 1
					,'show_post_on'			=> 1
					,'is_slider' 			=> 1
					,'row'					=> 2
					,'show_nav' 			=> 1
					,'auto_play' 			=> 1
					);

				$instance = wp_parse_args( (array) $instance, $defaults );

				$post_types = get_post_types();
				foreach( $post_types as $key => $post_type ){
					if( !post_type_supports($key, 'comments') ){
						unset( $post_types[$key] );
					}
				}
				$post_types = array_merge(array('all'=>esc_html__('All Posts', 'ftc-element')), $post_types);

				?>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter your title', 'ftc-element'); ?> </label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('post_type')); ?>"><?php echo esc_html_e('Post type', 'ftc-element'); ?> </label>
					<select class="widefat" name="<?php echo esc_attr($this->get_field_name('post_type')); ?>" id="<?php echo esc_attr($this->get_field_id('post_type')); ?>">
						<?php foreach( $post_types as $key => $post_type ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php selected($instance['post_type'], $key); ?>><?php echo esc_attr($post_type); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php esc_html_e('Number of comments to show', 'ftc-element'); ?> </label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="number" min="0" value="<?php echo esc_attr($instance['limit']); ?>" />
				</p>

				<p>
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_avatar')); ?>" name="<?php echo esc_attr($this->get_field_name('show_avatar')); ?>" value="1" <?php echo esc_attr(($instance['show_avatar'])?'checked':'') ?> />
					<label for="<?php echo esc_attr($this->get_field_id('show_avatar')); ?>"><?php esc_html_e('Show avatar', 'ftc-element'); ?></label>
				</p>

				<p>
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" value="1" <?php echo esc_attr(($instance['show_date'])?'checked':'') ?> />
					<label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e('Show comment date', 'ftc-element'); ?></label>
				</p>

				<p>
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_author')); ?>" name="<?php echo esc_attr($this->get_field_name('show_author')); ?>" value="1" <?php echo esc_attr(($instance['show_author'])?'checked':'') ?> />
					<label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>"><?php esc_html_e('Show comment author', 'ftc-element'); ?></label>
				</p>

				<p>
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_comment')); ?>" name="<?php echo esc_attr($this->get_field_name('show_comment')); ?>" value="1" <?php echo esc_attr(($instance['show_comment'])?'checked':'') ?> />
					<label for="<?php echo esc_attr($this->get_field_id('show_comment')); ?>"><?php esc_html_e('Show comment content', 'ftc-element'); ?></label>
				</p>

				<p>
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_post_on')); ?>" name="<?php echo esc_attr($this->get_field_name('show_post_on')); ?>" value="1" <?php echo esc_attr(($instance['show_post_on'])?'checked':'') ?> />
					<label for="<?php echo esc_attr($this->get_field_id('show_post_on')); ?>"><?php esc_html_e('Show post on', 'ftc-element'); ?></label>
				</p>

				<hr/>

				<p>
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('is_slider')); ?>" name="<?php echo esc_attr($this->get_field_name('is_slider')); ?>" value="1" <?php echo esc_attr(($instance['is_slider'])?'checked':'') ?> />
					<label for="<?php echo esc_attr($this->get_field_id('is_slider')); ?>"><?php esc_html_e('Show in a carousel slider', 'ftc-element'); ?></label>
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('row')); ?>"><?php esc_html_e('Number of rows - in carousel slider', 'ftc-element'); ?> </label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('row')); ?>" name="<?php echo esc_attr($this->get_field_name('row')); ?>" type="number" min="0" value="<?php echo esc_attr($instance['row']); ?>" />
				</p>

				<p>
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_nav')); ?>" name="<?php echo esc_attr($this->get_field_name('show_nav')); ?>" value="1" <?php echo esc_attr(($instance['show_nav'])?'checked':'') ?> />
					<label for="<?php echo esc_attr($this->get_field_id('show_nav')); ?>"><?php esc_html_e('Show navigation button', 'ftc-element'); ?></label>
				</p>

				<p>
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('auto_play')); ?>" name="<?php echo esc_attr($this->get_field_name('auto_play')); ?>" value="1" <?php echo esc_attr(($instance['auto_play'])?'checked':'') ?> />
					<label for="<?php echo esc_attr($this->get_field_id('auto_play')); ?>"><?php esc_html_e('Auto play', 'ftc-element'); ?></label>
				</p>

				<?php 
			}

		}
	}

