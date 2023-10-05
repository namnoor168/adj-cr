<?php
add_action( 'widgets_init', 'create_crismaster_widget' );
function create_crismaster_widget() {
    register_widget('crismaster_Related_Products');
    register_widget('Crismaster_Recent_Posts');
}

/* Creat Widgets */

class crismaster_Related_Products extends WP_Widget {
    /**
     * widget init: name, base ID
     */
    function __construct() {
      $tpwidget_options = array(
            'classname' => 'related-products', // widget class
            'description' => 'Cris - Sản phẩm Nổi Bật'
        );
        parent::__construct('crismaster_Related_Products_widget_id', 'Cris - Sản phẩm Nổi Bật', $tpwidget_options);// ID, Name, .
    }
    /**
     * creat form option for widget
     */
    function form( $instance ) {

        //  Default Variables
      $default = array(
        'title' => '',
        'number' =>'',
        'ids_pro' =>'',
    );

      $instance = wp_parse_args( (array) $instance, $default);

        //Tạo biến riêng cho giá trị mặc định trong mảng $default
      $title = esc_attr( $instance['title'] );
      $number = esc_attr( $instance['number'] );
      $ids_pro = esc_attr( $instance['ids_pro'] );

        //Show form option in widget
      echo "<p>Tiêu đề cần được hiển thị<input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";
      echo "<p>Số bài viết muốn hiển thị<input type='text' class='widefat' name='".$this->get_field_name('number')."' value='".$number."' /></p>";
      echo "<p>Hoặc Nhập IDs các sản phẩm nổi bật (ví dụ 1,2,3,..)<input type='text' class='widefat' name='".$this->get_field_name('ids_pro')."' value='".$ids_pro."' /></p>";
  }

    /**
     * save widget form
     */

    function update( $new_instance, $old_instance ) {

      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['number'] = esc_attr( $new_instance['number'] );
      $instance['ids_pro'] = esc_attr( $new_instance['ids_pro'] );
      return $instance;
  }

    /**
     * Show widget
     */

    function widget( $args, $instance ) {

      extract( $args );
      $title = apply_filters( 'widget_title', $instance['title'] );
      $number = $instance['number'];
      $ids_pro = $instance['ids_pro'];
?>
        <div class="box-related">
            <div class="title-nav">
                <?php echo esc_attr($title); ?>
            </div>
            <?php
            if(isset($ids_pro) && $ids_pro != ''){
                $p_ids_pro = explode(',', $ids_pro);
                $query = new WP_Query(array(
                    'post_type'      => 'productt',
                    'status'      => 'approve',
                    'post_status'         => 'publish',
                    'post__in' => $p_ids_pro
                )  );
            }else{
                $query = new WP_Query(array(
                    'post_type'      => 'productt',
                    'posts_per_page'      => $number,
                    'status'      => 'approve',
                    'post_status'         => 'publish',
                    'order' => 'DESC',
                    'orderby' => 'date'
                )  );
            }

            if($query->have_posts()){
                while($query->have_posts()){
                    $query->the_post();
                    $popular_product = get_post_meta(get_the_ID(),'_cmb_popular_product',true);
                    $price_product = get_post_meta(get_the_ID(),'_cmb_price_product',true);
                    $price_product_km = get_post_meta(get_the_ID(),'_cmb_price_product_2',true);
                    $size_product = get_post_meta(get_the_ID(),'_cmb_size_product',true);
            ?>
                    <div class="item clearfix">
                    <?php if(isset($popular_product) && $popular_product != ''){ ?>
                        <div class="img">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($popular_product); ?>" alt=""></a>
                        </div>
                    <?php } ?>
                        <div class="info">
                            <div class="info-content">
                                <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                <p class="price"><?php if(isset($price_product_km) && $price_product_km !=''){echo $price_product_km; }else{echo $price_product;} ?></p>
                            </div>
                        </div>
                    </div>
            <?php } wp_reset_postdata(); }?>

        </div>
<?php
}
}
class Crismaster_Recent_Posts extends WP_Widget{
    function __construct() {
        $tpwidget_options = array(
            'classname' => 'recent-posts-entry', // widget class
            'description' => 'Cris - Tin tức mới nhất'
        );
        parent::__construct('Crismaster_Recent_Posts_widget_id', 'Cris - Tin tức mới nhất', $tpwidget_options);// ID, Name, .
    }
    /**
     * creat form option for widget
     */
    function form( $instance ) {
        //  Default Variables
        $default = array(
            'title' => '',
            'number' =>'',
        );
        $instance = wp_parse_args( (array) $instance, $default);
        $title = esc_attr( $instance['title'] );
        $number = esc_attr( $instance['number'] );
        //Show form option in widget
        echo "<p>Tiêu đề cần được hiển thị <input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";
        echo "<p>Số bài viết muốn hiển thị <input type='text' class='widefat' name='".$this->get_field_name('number')."' value='".$number."' /></p>";
    }
    /**
     * save widget form
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = esc_attr( $new_instance['number'] );
        return $instance;
    }
    /**
     * Show widget
     */
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        ?>
        <?php
        $query = new WP_Query(array(
            'posts_per_page'      => $instance['number'],
            'status'      => 'approve',
            'post_status'         => 'publish',
            'order' => 'DESC',
            'orderby' => 'date'
        )  );
        ?>
        <div class="box-related">
            <div class="title-nav">
                <?php echo esc_attr($title); ?>
            </div>
        <?php if($query->have_posts()){
            while($query->have_posts()){
                $query->the_post();
                $single_image = get_post_meta(get_the_ID(),'_cmb_single_image',true); ?>
                <div class="item clearfix">
                <?php if(isset($single_image) && $single_image != ''){ ?>
                    <div class="img">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($single_image); ?>" alt=""></a>
                    </div>
                <?php } ?>
                    <div class="info">
                        <div class="info-content">
                            <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                            <p class="time"><?php echo  get_the_date('M j, Y'); ?></p>
                        </div>
                    </div>
                </div>
            <?php } wp_reset_postdata(); }?>
        </div>
        <?php }
}