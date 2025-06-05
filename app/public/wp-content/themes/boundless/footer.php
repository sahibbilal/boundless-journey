<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package WordPress
 * @subpackage Boundless Journeys
 * @since Boundless Journeys 1.0
 */

?>

	<section id="questions" class="gray">
		<div class="center-align">
			<?php get_template_part( 'templates/footer/contact' ); ?>
		</div>
	</section>

	<?php if (!is_front_page()) { ?>
	<section id="accolades">
		<div>
			<div class="accolades-holder clearfix">
				<?php outputAccolades(true); // lib/custom.php ?>
			</div>
		</div>
	</section>
	<?php } ?>

	<footer>

		<section id="footer_nav">
			<div class="clearfix">

				<div class="col col-1">
					<?php get_template_part( 'templates/nav/discover' ); ?>
				</div>
				<div class="col col-2">
				  <h4>Start Planning</h4>
					<?php wp_nav_menu(array('theme_location' => 'planning')); ?>
				</div>
				<div class="col col-3">
					<?php get_template_part( 'templates/nav/booking' ); ?>
				</div>
				<div class="col col-4" id="connect">
					<?php get_template_part( 'templates/connect' ); ?>
				</div>

			</div> <!-- clearing div -->
		</section> <!-- end of #footer_nav -->


		<section id="email_optin" class="gray">
			<div>
				<div class='wrapper center-align'>
					<?php get_template_part( 'templates/footer/emailform' ); ?>
				</div>
			</div>
		</section> <!-- end of #email_optin -->


		<section id="signature">
			<div>
				<div class="wrapper">
					<?php get_template_part( 'templates/footer/copyrightarea' ); ?>
				</div>
			</div>
		</section>

	</footer>

</div>





<link rel='stylesheet' id='main-stylesheet-css' href='<?php echo site_url() ?>/wp-content/themes/boundless/css/verb-mobile-menu.css' type='text/css' media='all' />


<!--[if IE 8 ]>
<script src="/wp-content/themes/boundless/js/es5-shim.min.js"></script>
<script src="/wp-content/themes/boundless/js/placeholders.min.js"></script>
<script src="/wp-content/themes/boundless/js/selectivizr.js"></script>
<![endif]-->
<!--[if IE 9 ]>
<script src="/wp-content/themes/boundless/js/placeholders.min.js"></script>
<![endif]-->


</div>

<?php wp_footer(); ?>
<?php //doPopup(); ?>
<?php

if ($post->post_type == "vtc_trip") {
//	echo do_shortcode("[RICH_REVIEWS_SNIPPET category='page']");
}


?>

<script type="text/javascript">
    changeRRConfMessage();



</script>


<!-- begin olark code -->
<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
f[z]=function(){
(a.s=a.s||[]).push(arguments)};var a=f[z]._={
},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
0:+new Date};a.P=function(u){
a.p[u]=new Date-a.p[0]};function s(){
a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
b.contentWindow[g].open()}catch(w){
c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('4406-212-10-7043');/*]]>*/</script><noscript><a href="https://www.olark.com/site/4406-212-10-7043/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->


<!-- EU Cookie Policy Test -->
<div id="eucookiePopup" style="display: none;">
	<p>We've noticed your browsing from a country in the European Economic Area. Unfortunately, due to privacy guidelines in your area, our website cannot support traffic from your location. If you'd like to contact us directly, please call <strong>1-800-941-8010</strong>. Apologies for any inconvenience. <a href="https://www.google.com">Click here</a> to exit the site.</p>
</div>
<script>
	if(Cookies.get("restrictedAccessCountry")){
		document.getElementById('eucookiePopup').removeAttribute('style');
		$.magnificPopup.open({
			items: {
				src: '#eucookiePopup'
			},
			alignTop: false,
			type: 'inline',
			midClick: true,
			mainClass: 'mfp-fade euCookieModal',
			removalDelay: 300
		});
	}
</script>

<!-- Start of HubSpot Embed Code -->

<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/42633471.js"></script>

<!-- End of HubSpot Embed Code -->

</body>
</html>