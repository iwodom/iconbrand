<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div class="error-page">
  <div>
    <h1 data-h1="404">404</h1>
    <p data-p="NOT FOUND">NOT FOUND</p>
  </div>
</div>
<style media="screen">
.error-page {
display: flex;
align-items: center;
justify-content: center;
text-align: center;
padding-top: 150px;
padding-bottom: 50px;
font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    border-bottom: 1px solid #ccc;
}
.error-page h1 {
font-size: 25vh;
font-weight: bold;
position: relative;
margin: -8vh 0 0;
padding: 0;
}
.error-page h1:after {
content: attr(data-h1);
position: absolute;
top: 0;
left: 0;
right: 0;
color: transparent;
/* webkit only for graceful degradation to IE */
background: -webkit-repeating-linear-gradient(-45deg, #71b7e6, #69a6ce, #b98acc, #ee8176, #b98acc, #69a6ce, #9b59b6);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
background-size: 400%;
text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.25);
animation: animateTextBackground 10s ease-in-out infinite;
}
.error-page h1 + p {
color: #d6d6d6;
font-size: 6vh;
font-weight: bold;
line-height: 10vh;
max-width: 600px;
position: relative;
}
.error-page h1 + p:after {
content: attr(data-p);
position: absolute;
top: 0;
left: 0;
right: 0;
color: transparent;
text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
-webkit-background-clip: text;
-moz-background-clip: text;
background-clip: text;
}


@keyframes animateTextBackground {
0% {
background-position: 0 0;
}
25% {
background-position: 100% 0;
}
50% {
background-position: 100% 100%;
}
75% {
background-position: 0 100%;
}
100% {
background-position: 0 0;
}
}
@media (max-width: 767px) {
.error-page h1 {
font-size: 32vw;
}
.error-page h1 + p {
font-size: 8vw;
line-height: 10vw;
max-width: 70vw;
}
}

</style>
<?php get_template_part( 'parts/form' ); ?>
<?php get_footer();
