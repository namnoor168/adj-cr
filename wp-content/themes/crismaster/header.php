<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php $theme_option = get_option('theme_option');
$mobile = wp_is_mobile();
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>

</head>

<?php
$hotline_header = $theme_option['hotline_header'];

 ?>
<body <?php body_class(); ?> >
<main>
    <header id="header">
        <div class="header-banner">
        </div>
        <nav class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="hidden-md-up text-sm-center header_mobile_sticky mobile">
                        <div class="float-xs-left" id="home_mobile">
                            <a href="../index.html">
                                <i class="home_icon_svg">
                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M573.48 219.91L512 170.42V72a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v72.6L310.6 8a35.85 35.85 0 0 0-45.19 0L2.53 219.91a6.71 6.71 0 0 0-1 9.5l14.2 17.5a6.82 6.82 0 0 0 9.6 1L64 216.72V496a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V216.82l38.8 31.29a6.83 6.83 0 0 0 9.6-1l14.19-17.5a7.14 7.14 0 0 0-1.11-9.7zM336 480h-96V320h96zm144 0H368V304a16 16 0 0 0-16-16H224a16 16 0 0 0-16 16v176H96V190.92l187.71-151.4a6.63 6.63 0 0 1 8.4 0L480 191z" class=""></path>
                                    </svg>
                                </i>
                                <span class="label_mobile">Trang chủ</span>
                            </a>
                        </div>
                        <div class="float-xs-left closed" id="ets_menu-icon">
                            <i class="material-icons d-inline">&#xE5D2;</i>
                            <span class="label_mobile">Danh mục</span>
                        </div>
                        <div class="float-xs-right" id="_mobile_phone"></div>
                        <div class="float-xs-right" id="_mobile_store"></div>
                        <div class="float-xs-right" id="_mobile_user_info"></div>
                        <div class="top-logo" id="_mobile_contact_link"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="position-static">
                        <header id="header" >
                            <div class="section_header header-top" style=" ">
                                <div class="header-position hidden-xs col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="header-block ">
                                        <div class="block-content">
                                            <div id="_desktop_contact_link">
                                                <div id="contact-link">
                                                    <a href="#"><span class="icon_store"></span> <span class="label_title">Stores</span></a>
                                                    <?php if(isset($hotline_header) && !empty($hotline_header)){ ?>
                                                    <a href="tel:<?= $hotline_header ?>"><span class="icon_phone"></span> <span class="label_desktop"><?= $hotline_header ?></span><span class="label_mobile">Call</span> </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-position header_logo col-lg-4 col-sm-6 col-md-6 col-xs-3">
                                    <div class="header-block logo_center">
                                        <div class="block-content">
                                            <a class="header_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="ADJ Thế giới nhẫn cưới"><img class="logo" src="<?= get_template_directory_uri() ?>/assets/img/adj-wedding-rings-logo-1634052240.jpg" alt="ADJ Thế giới nhẫn cưới" />
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 841.9 595.3" xml:space="preserve" style="&#10;">
                                                <g>
                                                    <path class="st0" d="M480.1,408.8h-19.4l-79.5-179.9l6.9-11.2l79.5,179.8c0.5,1.1,2.1,3.3,6.8,6.9L480.1,408.8z"/>
                                                    <path class="st0" d="M437,408.8h18.8L378.1,233l-7.2,11.7l5.9,13.2L316,396.7c-0.8,2-2.6,3.9-5.1,5.5c-1.1,0.7-2.3,1.3-3.7,1.8   l-12.6,4.7h44.1l-9.3-4.6c-1.8-0.9-2.1-1.9-2.1-2.8c0-0.6,0.2-1.2,0.7-2.1l24.6-56.1h61.6l24.9,56.4c0.7,1.4,0.5,3.4-0.6,5.8   L437,408.8z M358,330.4l25.2-57.9l25.6,57.9H358z"/>
                                                    <path class="st0" d="M638,251c-17.9-16.1-39.5-24.6-64.3-25.2c30.7,8.4,84.3,31.9,84.3,92.9c0,58.7-49.8,81.5-80.2,89.9   c23.8-1.3,44.7-10.5,62.3-27.2c19.2-18.2,28.6-40.3,28-65.7C667.4,290.2,657.3,268.4,638,251"/>
                                                    <path class="st0" d="M581.7,231.9c-12.4-4.2-25.4-6.2-38.5-6.2h-59.1l3.4,4.1c3.1,3.6,3.5,5.6,3.5,6.5v162.3c0,0.8-0.5,2.7-3.5,6.2   l-3.6,4.1h62.8c13.2,0,26.3-2,38.7-6.3c29.3-10.1,68.2-33,68.2-83.8C653.8,266,611.8,242.2,581.7,231.9 M615.5,375.7   c-5.2,4.7-10.5,8.6-15.8,11.7c-14.3,7.7-43.8,8.6-43.8,8.6h-37.4l0.3-157.4h37.1c0,0,28.9,0.1,43.4,7.6c6.2,3.3,12.3,7.7,18.1,13.1   c16.5,15.5,24.7,34.7,24.3,57.1C641.5,340.3,632.7,360.2,615.5,375.7"/>
                                                    <path class="st0" d="M660,382.2l-0.4-0.5c0.9,0.5,15,8.2,32.7,11c0.6,0.1,1.2,0.2,1.9,0.3c0.5,0.1,0.9,0.1,1.4,0.2   c1.4,0.2,2.8,0.3,4.3,0.4c0.6,0,1.3,0.1,1.9,0.1c0.8,0,1.6,0,2.4,0c0.8,0,1.7,0,2.6-0.1c0.5,0,0.9-0.1,1.4-0.1   c0.6,0,1.1-0.1,1.7-0.1c34.4-3.1,60.3-31.5,60.3-66.1V236c0-0.9-0.5-2.8-3.5-6.1l-3.7-4.1H782c0.1,38.4,0.2,107.1,0,110.6v0.1   c-2,22.4-12.2,51.2-49.1,61.6C696.1,408.4,664.2,385.3,660,382.2"/>
                                                    <path class="st0" d="M805.9,225.7l-3.7,4.1c-3,3.3-3.4,5.3-3.4,6.1v92.4c0,15.4-3.4,30.3-9.9,43c-9.8,19.3-28.8,40.3-65,40.3   c-6.6,0-13.7-0.7-21.4-2.2l-0.6-0.1c-12.6-3.2-23.5-9.2-32.5-17.9c10.1,5.6,26.3,12.6,45.3,12.6c6.5,0,13.3-0.8,20.3-2.8   c40.8-11.5,49.5-45.4,51.2-64.5c0.5-4.2,0.5-22.7,0.3-110.9H805.9z"/>
                                                    <path class="st0" d="M262.4,540.5c12.6,8.1,25.7,14.9,39.4,20.4c-21.6-6.5-42.3-16-61.4-28.2c-54.5-35-92.1-89.1-105.9-152.4   c-13.8-63.3-2.1-128.1,32.9-182.6c35.1-54.6,89.7-89.3,148.3-103.4C215.1,128.9,148.4,219,148.4,327c0,36.1,7.8,70.5,21.7,101.4   c0,0.1,0.1,0.3,0.2,0.4C188.5,474.6,220.3,513.4,262.4,540.5"/>
                                                    <path class="st0" d="M557.3,171.3c-10.7-10.1-22.4-19.3-35-27.4c-110-70.6-257-38.6-327.6,71.4c-28.3,44.2-41,95.3-36.9,146.7   c-1.4-10.6-2.2-21.5-2.2-32.5c0-67.3,27.4-128.3,71.6-172.5c73.7-73.7,189.4-86.5,277.4-30.7c0.5,0.3,0.9,0.6,1.4,0.9   C525,139.3,542.4,154.3,557.3,171.3"/>
                                                    <path class="st0" d="M114.3,216.5c3.5,1.4-3.1,35-5.2,40.2c-2.1,5.2-8,7.7-13.2,5.6c-5.2-2.1-7.7-8-5.6-13.2   C92.2,243.9,111.4,215.3,114.3,216.5"/>
                                                    <path class="st0" d="M164.3,92.2c-3.5-1.4,3.1-35,5.2-40.2c2.1-5.2,8-7.7,13.2-5.6c5.2,2.1,7.7,8,5.6,13.2   C186.3,64.7,167.2,93.3,164.3,92.2"/>
                                                    <path class="st0" d="M112.7,191c2.1,1.6-8.5,22.8-10.9,25.9c-2.4,3.1-6.8,3.7-9.9,1.3c-3.1-2.4-3.7-6.8-1.3-9.9   C93,205.3,111,189.7,112.7,191"/>
                                                    <path class="st0" d="M103.5,126.4c1.6-2.1-14.5-19.6-17.7-21.9c-3.1-2.3-7.6-1.7-9.9,1.5c-2.3,3.1-1.7,7.6,1.5,9.9   C80.6,118.2,102.3,128.1,103.5,126.4"/>
                                                    <path class="st0" d="M112.7,191c2.1,1.6-8.5,22.8-10.9,25.9c-2.4,3.1-6.8,3.7-9.9,1.3c-3.1-2.4-3.7-6.8-1.3-9.9   C93,205.3,111,189.7,112.7,191"/>
                                                    <path class="st0" d="M94.7,148.7c0.3-2.6-22.4-9.7-26.2-10.1c-3.9-0.4-7.4,2.3-7.8,6.2c-0.4,3.9,2.3,7.4,6.2,7.8   C70.7,153.1,94.5,150.9,94.7,148.7"/>
                                                    <path class="st0" d="M146.7,108c-2.6-0.3-4-24-3.6-27.9c0.5-3.9,4-6.6,7.9-6.1c3.9,0.5,6.6,4,6.1,7.9   C156.7,85.7,148.9,108.3,146.7,108"/>
                                                    <path class="st0" d="M98.2,172.5c-1.1-2.4-24.2,2.8-27.8,4.3c-3.6,1.5-5.2,5.7-3.7,9.3c1.6,3.6,5.7,5.2,9.3,3.7   C79.6,188.3,99.1,174.5,98.2,172.5"/>
                                                    <path class="st0" d="M122.9,111.2c-2.4,1-15.5-18.8-17-22.4c-1.5-3.6,0.2-7.7,3.8-9.2c3.6-1.5,7.7,0.2,9.2,3.8   C120.4,87,124.9,110.4,122.9,111.2"/>
                                                    <path class="st0" d="M129.9,88c-3.8,0.5-14.8-31.9-15.6-37.5c-0.8-5.6,3.1-10.7,8.7-11.5c5.6-0.8,10.7,3.1,11.5,8.7   C135.2,53.2,132.9,87.5,129.9,88"/>
                                                    <path class="st0" d="M98,101.6c-3,2.4-28.8-20.2-32.2-24.6c-3.5-4.4-2.7-10.8,1.7-14.3c4.4-3.5,10.8-2.7,14.3,1.7   C85.2,68.8,100.4,99.7,98,101.6"/>
                                                    <path class="st0" d="M77.1,129.3c-1.4,3.5-35-3.1-40.2-5.2c-5.2-2.1-7.7-8-5.6-13.2c2.1-5.2,8-7.7,13.2-5.6   C49.7,107.3,78.3,126.4,77.1,129.3"/>
                                                    <path class="st0" d="M72.9,163.7c0.5,3.8-31.9,14.8-37.5,15.6c-5.6,0.8-10.7-3.1-11.5-8.7c-0.8-5.6,3.1-10.7,8.7-11.5   C38.2,158.4,72.5,160.7,72.9,163.7"/>
                                                    <path class="st0" d="M86.5,195.6c2.4,3-20.2,28.8-24.6,32.2c-4.4,3.5-10.8,2.7-14.3-1.7c-3.5-4.4-2.7-10.8,1.7-14.3   C53.7,208.4,84.6,193.2,86.5,195.6"/>
                                                    <path class="st0" d="M165.8,117.6c-2.1-1.6,8.5-22.8,10.9-25.9c2.4-3.1,6.8-3.7,9.9-1.3c3.1,2.4,3.7,6.8,1.3,9.9   C185.6,103.3,167.5,118.9,165.8,117.6"/>
                                                    <path class="st0" d="M192,113c-2.4-3,20.2-28.8,24.6-32.2c4.4-3.5,10.8-2.7,14.3,1.7c3.5,4.4,2.7,10.8-1.7,14.3   C224.8,100.3,193.9,115.4,192,113"/>
                                                    <path class="st0" d="M313.2,462.1v32.3c0,0.4,0.3,0.9,0.8,1.6h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-32.3H296c-0.8,0-1.3,0.4-1.4,1.2v-2.8   h32.6v2.8c-0.5-0.8-1-1.2-1.4-1.2H313.2z"/>
                                                    <path class="st0" d="M363.5,462.1v32.3c0,0.4,0.3,0.9,0.8,1.6h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-17.1h-23v17.1c0,0.4,0.3,0.9,0.8,1.6   h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-32.3c0-0.4-0.3-0.9-0.8-1.6h6.1c-0.5,0.6-0.8,1.1-0.8,1.6v13.5h23v-13.5c0-0.4-0.3-0.9-0.8-1.6h6.1   C363.8,461.1,363.5,461.6,363.5,462.1"/>
                                                    <path class="st0" d="M373,462.1V478h9.5c0.7,0,1.2-0.4,1.5-1.3l-0.1,4.2c-0.4-0.9-0.9-1.3-1.4-1.3H373v14.8h9.8   c0.7,0,1.5-0.4,2.2-1.3l-0.8,2.9h-16.5c0.5-0.6,0.8-1.1,0.8-1.6v-32.3c0-0.4-0.3-0.9-0.8-1.6H384v2.8c-0.3-0.8-0.8-1.2-1.5-1.2H373   z M368.8,457.6l7.4-7.5l7.5,7.5h-1.1l-6.3-4.4l-6.2,4.4H368.8z M381.6,451.9h-1.8l3.1-8.5h4.6L381.6,451.9z"/>
                                                    <path class="st0" d="M434.5,480.3v14.1c-5.5,1.5-9.7,2.2-12.5,2.2c-5.3,0-9.8-1.8-13.6-5.3c-3.7-3.5-5.7-7.8-5.8-12.9   c-0.1-5.1,1.6-9.4,5-13c3.7-3.7,8.3-5.6,13.9-5.6c4.1,0,7.5,0.5,10.1,1.4l2.5,0.4v3.4c-1.3-1.4-2.9-2.3-4.8-2.8   c-1.3-0.4-3.2-0.6-5.6-0.6c-5.2-0.1-9.4,1.5-12.6,4.8c-3,3.1-4.5,7.1-4.5,11.8c0,4.5,1.7,8.4,5,11.6c3.3,3.2,7.4,4.8,12.1,4.8   c2.3,0,4.4-0.3,6.1-0.9v-13.4c0-0.4-0.3-1-0.8-1.6h6.1C434.8,479.3,434.5,479.8,434.5,480.3"/>
                                                    <path class="st0" d="M444.1,462.1v32.3c0,0.4,0.3,0.9,0.8,1.6h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-32.3c0-0.4-0.3-0.9-0.8-1.6h6.1   C444.3,461.1,444.1,461.6,444.1,462.1"/>
                                                    <path class="st0" d="M479.8,464c0.5,0.4,0.9,0.8,1.4,1.2c3.7,3.6,5.6,7.9,5.6,13c0,5.1-1.9,9.4-5.6,12.9c-3.7,3.6-8.3,5.3-13.6,5.3   c-5.3,0-9.9-1.8-13.7-5.3c-3.8-3.6-5.7-7.9-5.7-12.9c0-5.1,1.9-9.4,5.7-12.9c3.8-3.6,8.3-5.3,13.7-5.3c4.3,0,8.1,1.2,11.4,3.5   l1.9-2c0.1-0.3,0.1-0.5,0-0.9l-2.2-2.3l3.2-3.5l3.3,3.5L479.8,464z M482.6,478.5c0-5.1-1.2-9.1-3.6-12.2c-2.7-3.2-6.5-4.8-11.4-5   c-4.6-0.1-8.3,1.5-11,4.8c-2.7,3.1-4.1,7.1-4.1,11.9c0,4.6,1.5,8.6,4.5,11.9c3,3.3,6.5,5,10.7,4.9c4.1,0,7.6-1.7,10.6-4.9   C481.1,486.8,482.6,483,482.6,478.5 M469.2,456.4h-1.8l3.1-8.5h4.6L469.2,456.4z"/>
                                                    <path class="st0" d="M495.8,462.1v32.3c0,0.4,0.3,0.9,0.8,1.6h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-32.3c0-0.4-0.3-0.9-0.8-1.6h6.1   C496,461.1,495.8,461.6,495.8,462.1"/>
                                                    <path class="st0" d="M549,496.4l-30.8-31.9v29.8c0,0.7,0.4,1.3,1.2,1.6h-4c0.9-0.3,1.3-0.9,1.3-1.7V463c-0.4-1.1-1-1.9-1.8-2.6h7.1   c-0.1,0.3-0.2,0.6-0.2,1c0,0.2,0,0.4,0.1,0.6l25.5,26.4V462c0-0.7-0.4-1.2-1.2-1.5h4.1c-0.9,0.3-1.3,0.9-1.3,1.7V496.4z"/>
                                                    <path class="st0" d="M586.5,462.1v32.3c0,0.4,0.3,0.9,0.8,1.6h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-17.1h-23v17.1c0,0.4,0.3,0.9,0.8,1.6   h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-32.3c0-0.4-0.3-0.9-0.8-1.6h6.1c-0.5,0.6-0.8,1.1-0.8,1.6v13.5h23v-13.5c0-0.4-0.3-0.9-0.8-1.6h6.1   C586.8,461.1,586.5,461.6,586.5,462.1"/>
                                                    <path class="st0" d="M599.2,482.8l-4.9,11.4c-0.1,0.2-0.2,0.4-0.2,0.6c0,0.4,0.2,0.8,0.6,1h-4c0.3-0.1,0.6-0.3,0.8-0.4   c0.6-0.4,1-0.9,1.2-1.4l12.2-27.7l-1.1-2.6l2.6-4.2l15.4,34.7c0.2,0.4,0.7,0.9,1.5,1.6H617c0.3-0.6,0.3-1.1,0.1-1.6l-5.1-11.5   H599.2z M599,457.6l7.4-7.5l7.4,7.5h-1.1l-6.3-4.4l-6.2,4.4H599z M611.4,481.3l-5.8-13.2l-5.7,13.2H611.4z M616.9,446   c-0.3,0.6-1,1.5-2.2,2.6c-1.3,0.7-2.4,1.1-3.5,1.1c-0.7,0-1.8-0.3-3.2-0.8c-1.4-0.5-2.6-0.8-3.7-0.8c-0.9,0-2,0.2-3.2,0.6   c1.4-2.1,3-3.1,4.6-3.1c0.8,0,2,0.3,3.5,0.8c1.5,0.5,2.7,0.8,3.5,0.8C613.6,447.2,615,446.8,616.9,446"/>
                                                    <path class="st0" d="M660.3,496.4l-30.8-31.9v29.8c0,0.7,0.4,1.3,1.2,1.6h-4c0.9-0.3,1.3-0.9,1.3-1.7V463c-0.4-1.1-1-1.9-1.8-2.6   h7.1c-0.1,0.3-0.2,0.6-0.2,1c0,0.2,0,0.4,0.1,0.6l25.5,26.4V462c0-0.7-0.4-1.2-1.2-1.5h4.1c-0.9,0.3-1.3,0.9-1.3,1.7V496.4z"/>
                                                    <path class="st0" d="M699.2,496.4c-5.3,0-9.8-1.8-13.5-5.3c-3.7-3.5-5.6-7.9-5.7-12.9c-0.1-5.1,1.6-9.4,5.1-13   c3.6-3.6,8.2-5.3,13.8-5.3c4.1,0,7.5,0.5,10.1,1.4l2.5,0.4v3.4c-2.3-2.4-5.8-3.6-10.3-3.6c-4.7,0-8.7,1.6-12.1,4.9   c-3.4,3.3-5,7.2-5,11.7c0,4.5,1.7,8.3,5,11.5c3.3,3.2,7.4,4.8,12.2,4.8c5.1,0,9-1.1,11.7-3.4l-1,3.7   C707.2,495.9,703,496.4,699.2,496.4"/>
                                                    <path class="st0" d="M747.5,462.1v32.3c0,0.4,0.3,0.9,0.8,1.6h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-2.9c-2.9,3.3-6.8,5-11.8,5   c-3.5,0-6.7-1.1-9.6-3.4c-3-2.4-4.6-5.4-4.6-8.8v-22.2c0-0.4-0.3-0.9-0.8-1.6h6.1c-0.5,0.6-0.8,1.1-0.8,1.6v22.2   c0,2.1,1.1,4.2,3.3,6.3c1.9,1.8,3.5,2.8,4.9,3.1c0.9,0.2,1.8,0.3,2.7,0.3c2.7,0,5.3-0.7,7.7-2c1.9-1.1,2.9-1.9,2.9-2.4v-27.4   c0-0.4-0.3-0.9-0.8-1.6h6.1C747.8,461.1,747.5,461.6,747.5,462.1 M748.8,460.5l-2.2-2.3l3.2-3.5l3.3,3.5l-6.3,6.8l-0.8-0.8l2.7-2.8   C748.9,461.1,748.9,460.8,748.8,460.5"/>
                                                    <path class="st0" d="M783.3,464c0.5,0.4,0.9,0.8,1.4,1.2c3.7,3.6,5.6,7.9,5.6,13c0,5.1-1.9,9.4-5.6,12.9c-3.7,3.6-8.3,5.3-13.6,5.3   c-5.3,0-9.9-1.8-13.7-5.3c-3.8-3.6-5.7-7.9-5.7-12.9c0-5.1,1.9-9.4,5.7-12.9c3.8-3.6,8.3-5.3,13.7-5.3c4.3,0,8.1,1.2,11.4,3.5   l1.9-2c0.1-0.3,0.1-0.5,0-0.9l-2.2-2.3l3.2-3.5l3.3,3.5L783.3,464z M786,478.5c0-5.1-1.2-9.1-3.6-12.2c-2.7-3.2-6.5-4.8-11.4-5   c-4.6-0.1-8.3,1.5-11,4.8c-2.7,3.1-4.1,7.1-4.1,11.9c0,4.6,1.5,8.6,4.5,11.9c3,3.3,6.5,5,10.7,4.9c4.1,0,7.6-1.7,10.6-4.9   C784.5,486.8,786,483,786,478.5 M772.7,456.4h-1.8l3.1-8.5h4.6L772.7,456.4z"/>
                                                    <path class="st0" d="M799.2,462.1v32.3c0,0.4,0.3,0.9,0.8,1.6h-6.1c0.5-0.6,0.8-1.1,0.8-1.6v-32.3c0-0.4-0.3-0.9-0.8-1.6h6.1   C799.5,461.1,799.2,461.6,799.2,462.1"/>
                                                    <path class="st1" d="M708.1,393.5c-0.5,0-0.9,0.1-1.4,0.1C707.2,393.5,707.7,393.5,708.1,393.5L708.1,393.5z"/>
                                                </g>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-position currency_language col-lg-4 col-sm-4 col-md-4 col-xs-2">
                                    <div class="header-block ">
                                        <div class="block-content">
                                            <div id="desktop_cart">
                                                <div class="blockcart cart-preview inactive" data-refresh-url="">
                                                    <div class="header">
                                                        <a class="" rel="nofollow" href="">
                                                            Giỏ hàng
                                                            <span class="icon_cart"><span class="cart-products-count">0</span></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section_header header_menu_search" style=" ">
                                <div class="header-position menu-center col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                    <div class="header-block ">
                                        <div class="block-content">
                                            <div class="ets_prmn_megamenu ets_transition_default ets_transition_mobile_floating prmn_no_sticky_mobile no_menu_bg_active  prmn_menu_width_auto">
                                                <div class="ets_prmn_megamenu_content">
                                                    <div class="container">
                                                        <div class="ets_prmn_megamenu_content_content">
                                                            <div class="ybc-menu-toggle ybc-menu-btn closed">
                                                                <span class="ybc-menu-button-toggle_icon">
                                                                    <i class="icon-bar"></i>
                                                                    <i class="icon-bar"></i>
                                                                    <i class="icon-bar"></i>
                                                                </span>
                                                                Menu
                                                            </div>
                                                            <ul class="prmn_menus_ul auto">
                                                                <li class="close_menu">
                                                                    <div class="pull-left">
                                                                        <span class="prmn_menus_back">
                                                                            <i class="icon-bar"></i>
                                                                            <i class="icon-bar"></i>
                                                                            <i class="icon-bar"></i>
                                                                        </span>
                                                                        Menu
                                                                    </div>
                                                                    <div class="pull-right">
                                                                        <i class="ets_svg icon_angle_left">
                                                                            <svg width="18" height="18" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                                                                        </i>
                                                                        Back
                                                                        <i class="ets_svg icon_angle_right">
                                                                            <svg width="18" height="18" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg>
                                                                        </i>
                                                                    </div>
                                                                </li>
                                                                <li class="prmn_menus_li prmn_sub_align_auto prmn_has_sub"
                                                                >
                                                                    <a href="#" style="">
                                                                        <span class="prmn_menu_content_title">Trang sức
                                                                            <span class="prmn_arrow">
                                                                                <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1408 704q0 26-19 45l-448 448q-19 19-45 19t-45-19l-448-448q-19-19-19-45t19-45 45-19h896q26 0 45 19t19 45z"/></svg>
                                                                            </span>                                            
                                                                        </span>
                                                                    </a>
                                                                    <span class="arrow closed">
                                                                        <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                                                                    </span>
                                                                    <ul class="prmn_columns_ul"
                                                                        style="width:100%;" >
                                                                        <li class="prmn_columns_li column_size_2  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="29" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">CHỦNG LOẠI</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../nhan-3.html">Nhẫn</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../bong-tai-4.html">Bông Tai</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../lac-tay-71.html">Lắc Tay</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../day-chuyen-72.html">Dây Chuyền</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../mat-day-chuyen-73.html">Mặt Dây Chuyền</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../nhan-nam-80.html">Nhẫn Nam</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../nhan-nu-82.html">Nhẫn Nữ</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../that-lung-vang-tay-106.html">Thắt Lưng Vàng Tây</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../trang-suc-me-va-be-107.html">Trang sức Mẹ và Bé</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../nhan-cuoi-platin-117.html">Nhẫn Cưới Platin</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="prmn_columns_li column_size_2  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="2" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">Chất liệu</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../vang-77.html">Vàng</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../platinum-79.html">Platinum</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../bac-78.html">Bạc</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="prmn_columns_li column_size_3  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="16" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">Bộ sưu tập</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../trang-suc-kim-cuong-30.html">TRANG SỨC KIM CƯƠNG</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../commited-duyen-vi-67.html">COMMITED (DUYÊN VỘI)</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../-endless-love-tinh-yeu-bat-tan-68.html">ENDLESS LOVE (TÌNH YÊU BẤT TẬN)</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../-the-theory-of-everything-thuyet-yeu-thong-69.html">THE THEORY OF EVERYTHING (THUYẾT YÊU THƯƠNG)</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../the-choice-la-chn-ca-trai-tim-70.html">THE CHOICE (LỰA CHỌN CỦA TRÁI TIM)</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="prmn_columns_li column_size_2  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="3" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_mnft ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">Thương hiệu</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul >
                                                                                                <li class="">
                                                                                                    <a href="../brand/1-adj.html">
                                                                                                        ADJ
                                                                                                    </a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="prmn_columns_li column_size_3  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="17" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">Trang sức phong thuỷ</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../menh-kim-33.html">Mệnh kim</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../menh-moc-34.html">Mệnh Mộc</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../menh-thuy-35.html">Mệnh Thuỷ</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../menh-hoa-36.html">Mệnh Hoả</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../menh-th-37.html">Mệnh Thổ</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li class="prmn_menus_li prmn_sub_align_auto prmn_has_sub">
                                                                    <a href="#" style="">
                                                                        <span class="prmn_menu_content_title">Trang Sức Cưới
                                                                            <span class="prmn_arrow">
                                                                                <svg width="14" height="14" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1408 704q0 26-19 45l-448 448q-19 19-45 19t-45-19l-448-448q-19-19-19-45t19-45 45-19h896q26 0 45 19t19 45z"/></svg>
                                                                            </span>                                            
                                                                        </span>
                                                                    </a>
                                                                    <span class="arrow closed">
                            <svg width="16" height="16" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>
                        </span>
                                                                    <ul class="prmn_columns_ul"
                                                                        style="
                                    width:100%;
                                                                        " >
                                                                        <li class="prmn_columns_li column_size_1  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="18" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">Theo Mục Đích</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../cau-hon-39.html">Cầu Hôn</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../ket-hon-40.html">Kết Hôn</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../k-niem-41.html">Kỷ Niệm</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="prmn_columns_li column_size_2  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="24" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">Chủng Loại</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../nhan-cuoi-49.html">Nhẫn Cưới</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../nhan-cuoi-platin-117.html">Nhẫn Cưới Platin</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../nhan-cuoi-kim-cuong-120.html">Nhẫn Cưới Kim Cương</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="prmn_columns_li column_size_4  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="25" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">Dòng Trang Sức</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../kim-cuong-55.html">Kim Cương</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../khong-dinh-da-56.html">Không Đính Đá</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../ecz-cz-57.html">ECZ-CZ</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                                <li data-id-block="26" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">Chất Liệu</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../vang-24k-vang-ta-58.html">Vàng 24K (Vàng Ta)</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../vang-18k-59.html">Vàng 18K</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../vang-14k-60.html">Vàng 14K</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../vang-10k-61.html">Vàng 10K</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../platinum-79.html">Platinum</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="prmn_columns_li column_size_4  prmn_has_sub">
                                                                            <ul class="prmn_blocks_ul">
                                                                                <li data-id-block="28" class="prmn_blocks_li">


                                                                                    <div class="ets_prmn_block prmn_block_type_category ">
                                                                                        <span class="h4" style="text-transform: uppercase; border-bottom: 1px solid #e7e7e7;">BỘ SƯU TẬP</span>
                                                                                        <div class="ets_prmn_block_content">

                                                                                            <ul class="ets_prmn_categories">
                                                                                                <li >
                                                                                                    <a href="../breathe-trong-tung-nhip-tho-62.html">BREATHE (TRONG TỪNG NHỊP THỞ)</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../me-before-you-trc-ngay-em-den-63.html">ME BEFORE YOU (TRƯỚC NGÀY EM ĐẾN)</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../beauty-and-the-beast-ngi-dep-va-quai-vat-64.html">BEAUTY AND THE BEAST (NGƯỜI ĐẸP VÀ QUÁI VẬT)</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../bo-su-tap-nhan-cuoi-2022-more-care-more-love-65.html">BỘ SƯU TẬP NHẪN CƯỚI 2022 &quot;MORE CARE - MORE LOVE&quot;</a>
                                                                                                </li>
                                                                                                <li >
                                                                                                    <a href="../the-age-of-adaline-sac-dep-vinh-cuu-66.html">THE AGE OF ADALINE (SẮC ĐẸP VĨNH CỬU)</a>
                                                                                                </li>
                                                                                            </ul>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>

                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li class="prmn_menus_li prmn_sub_align_left"
                                                                >
                                                                    <a                         href="#"
                                                                                               style="">
                    <span class="prmn_menu_content_title">
                                                Quà tặng
                                                                    </span>
                                                                    </a>
                                                                </li>
                                                                <li class="prmn_menus_li prmn_sub_align_auto"
                                                                >
                                                                    <a                         href="../blog.html"
                                                                                               style="">
                    <span class="prmn_menu_content_title">
                                                Blog
                                                                    </span>
                                                                    </a>
                                                                </li>
                                                                <li class="prmn_menus_li prmn_sub_align_auto"
                                                                >
                                                                    <a                         href="../content/6-khuyen-mai.html"
                                                                                               style="">
                    <span class="prmn_menu_content_title">
                                                    <i class="ets_svg">

<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1472 896q0-117-45.5-223.5t-123-184-184-123-223.5-45.5-223.5 45.5-184 123-123 184-45.5 223.5 45.5 223.5 123 184 184 123 223.5 45.5 223.5-45.5 184-123 123-184 45.5-223.5zm276 277q-4 15-20 20l-292 96v306q0 16-13 26-15 10-29 4l-292-94-180 248q-10 13-26 13t-26-13l-180-248-292 94q-14 6-29-4-13-10-13-26v-306l-292-96q-16-5-20-20-5-17 4-29l180-248-180-248q-9-13-4-29 4-15 20-20l292-96v-306q0-16 13-26 15-10 29-4l292 94 180-248q9-12 26-12t26 12l180 248 292-94q14-6 29 4 13 10 13 26v306l292 96q16 5 20 20 5 16-4 29l-180 248 180 248q9 12 4 29z"/></svg>
                            </i>
                                                Khuyến mại
                                                <span class="prmn_bubble_text"style="background: #cf0007; color: #ffffff;">Sale</span>                    </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <script type="text/javascript">
                                                                var Days_text = 'Day(s)';
                                                                var Hours_text = 'Hr(s)';
                                                                var Mins_text = 'Min(s)';
                                                                var Sec_text = 'Sec(s)';
                                                            </script>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-position header_search col-lg-1 col-sm-1 col-md-1 col-xs-8">
                                    <div class="header-block ">
                                        <div class="block-content">
                                            <!-- Block search module TOP -->
                                            <div id="search_widget" class="search-widget" data-search-controller-url="//www.adj.com.vn/tìm kiếm">
                                                <form method="get" action="http://www.adj.com.vn/tìm kiếm">
                                                    <input type="hidden" name="controller" value="search">
                                                    <input type="text" name="s" value="" placeholder="Tìm kiếm" aria-label="Tìm kiếm">
                                                    <button type="submit">
                                                        <i class="material-icons search">&#xE8B6;</i>
                                                        <span class="hidden-xl-down">Tìm kiếm</span>
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- /Block search module TOP -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">
                    <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
                    <div class="js-top-menu-bottom">
                        <div id="_mobile_currency_selector"></div>
                        <div id="_mobile_language_selector"></div>
                        <div id="_mobile_contact_link"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
