<?php
/*******************************************************************************
 * Header template
 ******************************************************************************/
// Site title
$sitetitle = get_bloginfo('name');
// Path to template directory
$tplDir = get_template_directory_uri();
// Protocol relative home URL (dns prefetch)
$nohturl = preg_replace("(^https?://)", "//", site_url('/'));

?>
<!doctype html>
<!--[if IEMobile 7 ]><html class="no-js iem7"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<script>
	/*! Minified version of JS-Cookie */
	!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self,function(){var n=e.Cookies,o=e.Cookies=t();o.noConflict=function(){return e.Cookies=n,o}}())}(this,(function(){"use strict";function e(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)e[o]=n[o]}return e}return function t(n,o){function r(t,r,i){if("undefined"!=typeof document){"number"==typeof(i=e({},o,i)).expires&&(i.expires=new Date(Date.now()+864e5*i.expires)),i.expires&&(i.expires=i.expires.toUTCString()),t=encodeURIComponent(t).replace(/%(2[346B]|5E|60|7C)/g,decodeURIComponent).replace(/[()]/g,escape);var c="";for(var u in i)i[u]&&(c+="; "+u,!0!==i[u]&&(c+="="+i[u].split(";")[0]));return document.cookie=t+"="+n.write(r,t)+c}}return Object.create({set:r,get:function(e){if("undefined"!=typeof document&&(!arguments.length||e)){for(var t=document.cookie?document.cookie.split("; "):[],o={},r=0;r<t.length;r++){var i=t[r].split("="),c=i.slice(1).join("=");try{var u=decodeURIComponent(i[0]);if(o[u]=n.read(c,u),e===u)break}catch(e){}}return e?o[e]:o}},remove:function(t,n){r(t,"",e({},n,{expires:-1}))},withAttributes:function(n){return t(this.converter,e({},this.attributes,n))},withConverter:function(n){return t(e({},this.converter,n),this.attributes)}},{attributes:{value:Object.freeze(o)},converter:{value:Object.freeze(n)}})}({read:function(e){return'"'===e[0]&&(e=e.slice(1,-1)),e.replace(/(%[\dA-F]{2})+/gi,decodeURIComponent)},write:function(e){return encodeURIComponent(e).replace(/%(2[346BF]|3[AC-F]|40|5[BDE]|60|7[BCD])/g,decodeURIComponent)}},{path:"/"})}));

	let countryFromCookie = Cookies.get("countryCode") !== undefined ? Cookies.get("countryCode") : '';

	const excludedCountries = ["GB", "AT", "BE", "BG", "HR", "CY", "CZ", "DK", "EE", "FI", "FR", "FX", "DE", "GR", "HU", "IE", "IT", "LV", "LT", "LU", "MT", "NL", "PL", "PT", "RO", "SK", "SI", "ES", "SE"];

	if (countryFromCookie === '') {
		fetch('https://ipapi.co/json/')
			.then(response => response.json())
			.then((data) => {
				if ('' !== data.country) {
					Cookies.set('countryCode', data.country, {expires: 10});
					if (excludedCountries.includes(data.country)) {
						Cookies.set('restrictedAccessCountry', data.country, {expires: 10});
						if (window.location.pathname != "/region-restricted/") {
							window.location.href = "/region-restricted/";
						}
					}
				}
			});
	} else {
		if (excludedCountries.includes(countryFromCookie)) {
			if (window.location.pathname != "/region-restricted/") {
				window.location.href = "/region-restricted/";
			}
		}
	}
</script>

<head>

    <!-- Start cookieyes banner -->
    <script id="cookieyes" type="text/javascript" src=https://cdn-cookieyes.com/client_data/450a7ef0dc149934922a1101/script.js></script>
    <!-- End cookieyes banner -->

	<meta charset="utf-8">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
	<!--[if lte IE 8]>
	<link rel="stylesheet" href="/wp-content/themes/boundless/css/ie.css" />
	<![endif]-->
  <link rel="apple-touch-icon" href="<?php echo esc_url($tplDir); ?>/images/ios-icon.png">
  <!--[if IE]><link rel="shortcut icon" href="<?php echo esc_url($tplDir); ?>/images/favicon.ico"><![endif]-->
  <link rel="shortcut icon" type="image/png" href="<?php echo esc_url($tplDir); ?>/images/favicon.png">
  <link rel="dns-prefetch" href="<?php echo $nohturl; ?>" />
  <link rel="stylesheet" href="https://use.typekit.net/kep3vjd.css">

<?php
if((isset($_COOKIE['ab-exp-1'])&&$_COOKIE['ab-exp-1']==1) || (isset($_GET['ab']) && $_GET['ab']==1)){
?>
<style>
    header .primary_support li#li_request a {background:#af2824;}
    header .primary_support li#li_request a:hover {background:#000;}
</style>
<?php
}
?>
<meta name="p:domain_verify" content="6ec9e897f458bc5abc2e31dce3512609"/>
<script>window.dataLayer = window.dataLayer || [];
<?php
// tracking
if ($post->post_type == "vtc_trip") { ?>
	dataLayer.push({
		'product_id' : '<?php echo $post->post_name; ?>'
	});
	dataLayer.push({'event': 'criterio_show_page'});
<?php } ?>
</script>


</head>
<body <?php body_class(); ?>>
	<?php get_template_part( 'templates/special' ); ?>
    <header class="header">
        <div>
            <div id="mobile-menu-button-main-nav" class="verb-mobile-menu-button">
                <span class="menu-text">Menu</span>
                <span class="menu-icon icon"></span>
                <span class="menu-close icon"><!-- ✕ --></span>
            </div>
			<script>
				window.addEventListener('DOMContentLoaded', () => {
					const mobileMenuButton = document.getElementById('mobile-menu-button-main-nav');
					const mobileMenuFromMainNav = document.querySelector('nav div.push');
					const mobileMenuOpenIcon = document.querySelector('#mobile-menu-button-main-nav span.menu-icon');
					const mobileMenuCloseIcon = document.querySelector('#mobile-menu-button-main-nav span.menu-close');
					
					mobileMenuFromMainNav.style.left = '-240px';
					mobileMenuButton.addEventListener('click', () => {
						if ('-240px' !== mobileMenuFromMainNav.style.left) {
							mobileMenuFromMainNav.style.left = '-240px';
							mobileMenuOpenIcon.style.opacity = '1';
							mobileMenuCloseIcon.style.display = 'none';
							mobileMenuCloseIcon.style.opacity = '0';
						} else {
							mobileMenuFromMainNav.style.left = '0';
							mobileMenuOpenIcon.style.opacity = '0';
							mobileMenuCloseIcon.style.display = 'block';
							mobileMenuCloseIcon.style.opacity = '1';
						}
					});

					const megamenuHdr = document.querySelectorAll('.megamenu-hdr');
					megamenuHdr.forEach((el) => {
						const megamenuA = el.querySelector('a');
						megamenuA.addEventListener('click', (event) => {
							if (el.classList.contains('active')) {
								el.classList.remove('active');
							} else {
								event.preventDefault();
								el.classList.add('active');
								megamenuHdr.forEach((el2) => {
									if (el2 !== el) {
										el2.classList.remove('active');
									}
								});
							}
						});
					});

					const destinationList = document.querySelectorAll('.destination-list');
					destinationList.forEach((el) => {
						const listA = el.querySelector('a');
						listA.addEventListener('click', (event) => {
							if (el.classList.contains('active')) {
								el.classList.remove('active');
							} else {
								event.preventDefault();
								el.classList.add('active');
								destinationList.forEach((el2) => {
									if (el2 !== el) {
										el2.classList.remove('active');
									}
								});
							}
						});
					});
				});
			</script>
            <div class="logo-background"> </div>
            <a href="/" id="site_logo" title="<?php echo $sitetitle; ?>"><?php echo $sitetitle; ?></a>


            <nav>
                <ul class='primary_support'>
                    <?php $phone = get_post_meta(SEGID, 'contact_phone', true); ?>
                    <li id="li_email"><a href="<?php echo site_url() ?>/email-an-expert" title="Email an Expert"><span>Email an Expert</span></a></li>
                    <li id="li_request"><a href="<?php echo site_url() ?>/request-information/" title="Request More Information"><span>Request Info</span></a></li>
                    <li id="li_call"><a href="tel:<?php echo str_replace(array('-', '.'), '', $phone); ?>" title=""><span><?php echo $phone; ?></span></a></li>
                </ul>
                <div class="push">
                    <?php get_template_part( 'templates/nav/primary' ); ?>
                    <ul class="secondary_support">
                        <?php get_template_part( 'templates/nav/support' ); ?>
                    </ul>

                </div>
            </nav>
        </div>
    </header>




	<div id="page">
	<?php get_template_part( 'templates/search' ); ?>

	<div class="site-wrapper">

