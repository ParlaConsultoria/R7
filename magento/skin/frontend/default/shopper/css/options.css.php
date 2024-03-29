<?php
define('MAGENTO_ROOT', (dirname(__FILE__).'../../../../../../'));
$mageFilename = MAGENTO_ROOT . '/app/Mage.php';
require_once $mageFilename;

umask(0);
Mage::app();

$config = Mage::getStoreConfig('shoppersettings');
$color_helper = Mage::helper('shoppersettings/color');

//check if category override theme options
if (!empty($_GET['cat'])) {

    $current_category = intval($_GET['cat']);

    $scheme = Mage::getModel('shoppercategories/shoppercategories')->getCollection()
        ->addStoreFilter(Mage::app()->getStore())
        ->addFieldToSelect('*')
        ->addFieldToFilter('status', 1);

    if ($scheme->count()) {

        //check if we have direct match
        $match = false;
        $current_scheme = null;
        foreach ($scheme as $_scheme) {
            if ( $_scheme['category_id'] == $current_category ) {
                $match = true;
                $current_scheme = $_scheme;
            }
        }

        // check if we have parent category
        if ( !$match ) {
            $_current_category = Mage::getModel('catalog/category')->load($current_category);
            if ( $_current_category->getId() ) {
                $path = $_current_category->getPath();
                $path = explode('/', $path);
                foreach ($scheme as $_scheme) {
                    if ( in_array($_scheme['category_id'], $path) ) {
                        $match = true;
                        $current_scheme = $_scheme;
                    }
                }
            }
        }

        if ($match) {
            foreach ($config['appearance'] as $config_option => $value) {
                if (!empty($current_scheme[$config_option])) {
                    $config['appearance'][$config_option] = $current_scheme[$config_option];
                }
            }
        }

    }
}

header("Content-type: text/css; charset: UTF-8");
?>
<?php if ( $config['appearance']['enable_font'] ) : ?>
/**~~ Theme Font ~~**/
.std h1, .std h2, .std h3, .std h4,
.page-title h1, .page-title h2,
.cart-top-container .details .cart-top-title,
.search-top-container .search-form .search-top-title,
.footer-info h4,
nav .nav-top-title, .nav-container .nav-top-title,
#queldoreiNav>li>a,
#queldoreiNav li.custom-block div.sub-wrapper strong,
#nav>li>a,
#nav li.custom-block ul li strong,
.homepage-banners a .content strong,
.slider-container h3,
.slider-container .jcarousel-list h3,
.category-description h1,
.category-description strong,
.products-grid h3,
.products-list .product-name a,
.cart .cart-collaterals h2,
#shopping-cart-totals-table strong,
#product-customer-reviews .review-title,
.add-review h3.title,
#customer-reviews dt a,
#customer-reviews .form-add h2,
.top-opc li .number,
.opc .step-title,
.opc h3,
.block .block-title strong,
.cms-index-index .block .block-title strong,
.block-poll .question,
.block-layered-nav dt,
.product-tabs a,
.product-category-title,
.product-view h1,
.product-view h2,
.product-view .box-tags h3,
.product-view .product-additional .block .block-title strong,
.box-up-sell2 h3,
.box-up-sell2 .jcarousel-list h3,
.flexslider .slides .content strong,
.data-table td.td-name h2,
.block-slider .slides > li strong,
.cms-index-index .block-slider .slides > li strong {font-family:"<?php echo $config['appearance']['font']; ?>"}
<?php endif; ?>
<?php if ( $config['appearance']['color'] ) : ?>
/**~~ Theme Color ~~**/
button.button span,
button.invert:hover span, button.btn-continue:hover span, .cart-shipping button:hover span, .cart-coupon button:hover span,
.btn-remove, .btn-edit,
.cart-top > a,
.cart-top-container .details-border,
.cart-top-container .details .cart-top-title a span.icon,
.search-top,
.search-form-border,
.search-top-container .search-form .search-top-title span.icon,
.footer-info ul.twitterList li span.tweet-icon,
.footer-info ul.social li a:hover,
.footer-info .block-control:hover,
.footer-info .block-control-hide:hover,
.products-grid .hover .price-box,
.products-grid .hover .button-container button.button span span em,
.products-list .button-container .btn-add-cart span,
.data-table .btn-remove2,
.data-table .btn-edit2,
.top-opc li.allow:hover .number,
.product-view .add-to-links li:hover span.icon,
.flex-control-paging li a:hover,
.flex-control-paging li a.flex-active,
#toTop,
.jcarousel-prev-horizontal:hover,
.jcarousel-next-horizontal:hover,
.product-view .box-up-sell .jcarousel-next-horizontal:hover,
.product-view .box-up-sell .jcarousel-prev-horizontal:hover
{background-color:<?php echo $config['appearance']['color']; ?>}

.footer-info a,
.footer-info .information ul li:before,
.price-box .price,
.pager .pages li a:hover,
.pager .pages .current,
.toolbar-dropdown ul li a:hover, .toolbar-dropdown ul li.selected a,
.products-grid .add-to-links li span,
.opc h3, .opc h4,
.block-progress dt:before,
#checkout-step-login .block-checkout-register ul.ul li:before
{color:<?php echo $config['appearance']['color']; ?>}

.cart-top-container .details-border:before{border-color: transparent transparent <?php echo $config['appearance']['color']; ?> transparent;}
.search-form-border:before{border-color: transparent transparent <?php echo $config['appearance']['color']; ?> transparent;}
#queldoreiNav>li>a:hover>span,
#queldoreiNav>li.over>a>span,
#queldoreiNav>li.active>a>span,
#nav>li>a:hover>span,
#nav>li.over>a>span,
#nav>li.active>a>span,
.cart .cart-collaterals .cart-block,
.opc .step,
.block,
.cms-index-index .block,
.block-login,
.cart .cart-collaterals .cart-block,
.product-tabs li.active {border-top-color:<?php echo $config['appearance']['color']; ?>;}

/** links hover color **/
.header-container .links li a:hover,
.block .block-content a:hover, .block .block-content li a:hover, .block .block-content li.item a:hover,
.cms-index-index .block .block-content a:hover, .cms-index-index .block .block-content li a:hover, .cms-index-index .block .block-content li.item a:hover,
.block-layered-nav .block-content dd li a:hover,
.product-view .product-shop .no-rating a:hover, .product-view .product-shop .ratings a:hover,
.product-view .box-up-sell .product-name:hover,
.data-table td a:hover{color:<?php echo $config['appearance']['color']; ?>}
<?php endif; ?>

<?php if ( $config['appearance']['title_color'] ) : ?>
h1, h2, h3,
.std h1, .std h2, .std h3, .std h4,
.page-title h1, .page-title h2,
.page-head-alt h3,
.block .block-title,
.cms-index-index .block .block-title,
.block-login .block-title,
.product-view .product-additional .block .block-title,
.footer-info h4,
#checkout-review-table h3,
.product-category-title,
.product-view h1, .product-view h2,
#shopping-cart-totals-table strong
{color:<?php echo $config['appearance']['title_color']; ?>}
<?php endif; ?>

<?php if ( $config['appearance']['header_bg'] ) : ?>
.header-container {background-color:<?php echo $config['appearance']['header_bg']; ?>}
<?php endif; ?>

<?php if ( $config['appearance']['slideshow_bg'] ) : ?>
.slider {background-color:<?php echo $config['appearance']['slideshow_bg']; ?>}
<?php endif; ?>

<?php if ( $config['appearance']['content_bg'] ) : ?>
.main-container {background-color:<?php echo $config['appearance']['content_bg']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['content_link'] ) : ?>
.block .block-content a, .block .block-content li a, .block .block-content li.item a,
.cms-index-index .block .block-content a, .cms-index-index .block .block-content li a, .cms-index-index .block .block-content li.item a,
.block-layered-nav .block-content dd li a,
.product-view .product-shop .no-rating a, .product-view .product-shop .ratings a,
.product-view .box-up-sell .product-name,
.data-table td a{color:<?php echo $config['appearance']['content_link']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['content_link_hover'] ) : ?>
.block .block-content a:hover, .block .block-content li a:hover, .block .block-content li.item a:hover,
.cms-index-index .block .block-content a:hover, .cms-index-index .block .block-content li a:hover, .cms-index-index .block .block-content li.item a:hover,
.block-layered-nav .block-content dd li a:hover,
.product-view .product-shop .no-rating a:hover, .product-view .product-shop .ratings a:hover,
.product-view .box-up-sell .product-name:hover,
.data-table td a:hover {color:<?php echo $config['appearance']['content_link_hover']; ?>}
<?php endif; ?>


<?php if ( $config['appearance']['page_title_bg'] ) : ?>
.page-title-bg {background-color:<?php echo $config['appearance']['page_title_bg']; ?>}
<?php endif; ?>

<?php if ( $config['appearance']['slider_bg'] ) : ?>
.slider-container {background-color:<?php echo $config['appearance']['slider_bg']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['slider_border'] ) : ?>
.slider-container {border-top-color:<?php echo $config['appearance']['slider_border']; ?>}
<?php endif; ?>

<?php if ( $config['appearance']['toolbar_bg'] ) : ?>
.top-switch-bg {background-color:<?php echo $config['appearance']['toolbar_bg']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['toolbar_color'] ) : ?>
.header-switch span.current {color:<?php echo $config['appearance']['toolbar_color']; ?>}
.header-container .links li a, .header-switch span {color:rgba(<?php echo $color_helper->hex2RGB($config['appearance']['toolbar_color'], 1); ?>, 0.65)}
<?php endif; ?>
<?php if ( $config['appearance']['toolbar_hover_color'] ) : ?>
.header-container .links li a:hover {color:<?php echo $config['appearance']['toolbar_hover_color'] ?>}
<?php endif; ?>

<?php if ( $config['appearance']['footer_bg'] ) : ?>
.footer-container {background-color:<?php echo $config['appearance']['footer_bg']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['footer_color'] ) : ?>
.footer-container, footer a, footer ul.links li a {color:<?php echo $config['appearance']['footer_color']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['footer_hover_color'] ) : ?>
footer a:hover, footer ul.links li a:hover {color:<?php echo $config['appearance']['footer_hover_color'] ?>}
<?php endif; ?>
<?php if ( $config['appearance']['footer_banners_bg'] ) : ?>
.footer-banners {background-color:<?php echo $config['appearance']['footer_banners_bg']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['footer_info_bg'] ) : ?>
.footer-info {background-color:<?php echo $config['appearance']['footer_info_bg']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['footer_info_border'] ) : ?>
.footer-info {border-top-color:<?php echo $config['appearance']['footer_info_border']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['footer_info_title_color'] ) : ?>
.footer-info h4 {color:<?php echo $config['appearance']['footer_info_title_color']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['footer_info_color'] ) : ?>
.footer-info, .footer-info ul.twitterList li {color:<?php echo $config['appearance']['footer_info_color']; ?>}
.footer-info ul.twitterList li span.time-ago {color:rgba(<?php echo $color_helper->hex2RGB($config['appearance']['footer_info_color'], 1); ?>, 0.85)}
<?php endif; ?>
<?php if ( $config['appearance']['footer_info_link_color'] ) : ?>
.footer-info a {color:<?php echo $config['appearance']['footer_info_link_color']; ?>}
<?php endif; ?>
<?php if ( $config['appearance']['footer_info_link_hover_color'] ) : ?>
.footer-info a:hover {color:<?php echo $config['appearance']['footer_info_link_hover_color']; ?>}
<?php endif; ?>

<?php if ( $config['appearance']['enable_font'] && $config['appearance']['price_font'] ) : ?>
.price-box .price {font-family:"<?php echo $config['appearance']['price_font']; ?>"}
<?php endif; ?>

<?php if ( $config['appearance']['price_color'] ) : ?>
.price-box .price {color:<?php echo $config['appearance']['price_color']; ?>}
.products-grid .hover .price-box {background-color:<?php echo $config['appearance']['price_color']; ?>}
<?php endif; ?>

<?php if ( $config['appearance']['price_circle_color'] ) : ?>
.products-grid .hover .price-box {background-color:<?php echo $config['appearance']['price_circle_color']; ?>}
<?php endif; ?>

button.invert span, button.btn-continue span, .cart-shipping button span, .cart-coupon button span {background-color:#393431;}