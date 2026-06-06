<?php
session_start();
include("../db.php");
?>
<!DOCTYPE HTML>
<html>
<head>
 <style type="text/css">
 <!--
	article.tabs
	{
		position: relative;
		display: block;
		width: 40em;
		height: 15em;
		margin: 2em auto;
	}
	article.tabs section
	{
		position: absolute;
		display: block;
		top: 1.8em;
		left: 0;
		height: 12em;
		padding: 10px 20px;
		background-color: #ddd;
		border-radius: 5px;
		box-shadow: 0 3px 3px rgba(0,0,0,0.1);
		z-index: 0;
	}
	article.tabs section:first-child
	{
		z-index: 1;
	}
	article.tabs section h2
	{
		position: absolute;
		font-size: 1em;
		font-weight: normal;
		width: 120px;
		height: 1.8em;
		top: -1.8em;
		left: 10px;
		padding: 0;
		margin: 0;
		color: #999;
		background-color: #ddd;
		border-radius: 5px 5px 0 0;
	}
	article.tabs section:nth-child(2) h2
	{
		left: 132px;
	}
	article.tabs section:nth-child(3) h2
	{
		left: 254px;
	}
	article.tabs section h2 a
	{
		display: block;
		width: 100%;
		line-height: 1.8em;
		text-align: center;
		text-decoration: none;
		color: inherit;
		outline: 0 none;
	}
	article.tabs section:target,
	article.tabs section:target h2
	{
		color: #333;
		background-color: #fff;
		z-index: 2;
	}
	article.tabs section,
	article.tabs section h2
	{
		-webkit-transition: all 500ms ease;
		-moz-transition: all 500ms ease;
		-ms-transition: all 500ms ease;
		-o-transition: all 500ms ease;
		transition: all 500ms ease;
	}
 -->
 </style>
  <title>CSS3 TAB EXAMPLE </title>
 </head>
 <body>
 <article class="tabs">
	<section id="tab1">
		<h2><a href="#tab1">Tab 1</a></h2>
		<p>This content appears on tab 1.This content appears on tab 1.This content appears on tab 1.</p>
	</section>
	<section id="tab2">
		<h2><a href="#tab2">Tab 2</a></h2>
		<p>This content appears on tab 2.This content appears on tab 2.This content appears on tab 2.</p>
	</section>
	<section id="tab3">
		<h2><a href="#tab3">Tab 3</a></h2>
		<p>This content appears on tab 3.This content appears on tab 3.This content appears on tab 3.</p>
	</section>
    	<section id="tab4">
		<h2><a href="#tab4">Tab 4</a></h2>
		<p>This content appears on tab 4.This content appears on tab 3.This content appears on tab 3.</p>
	</section>
    	<section id="tab5">
		<h2><a href="#tab5">Tab 5</a></h2>
		<p>This content appears on tab 5.This content appears on tab 3.This content appears on tab 3.</p>
	</section>
    	<section id="tab6">
		<h2><a href="#tab6">Tab 6</a></h2>
		<p>This content appears on tab 6.This content appears on tab 3.This content appears on tab 3.</p>
	</section>
    	<section id="tab7">
		<h2><a href="#tab7">Tab 7</a></h2>
		<p>This content appears on tab 7.This content appears on tab 3.This content appears on tab 3.</p>
	</section>
    	<section id="tab8">
		<h2><a href="#tab8">Tab 8</a></h2>
		<p>This content appears on tab 8.This content appears on tab 3.This content appears on tab 3.</p>
	</section>
    	<section id="tab9">
		<h2><a href="#tab9">Tab 9</a></h2>
		<p>This content appears on tab 9.This content appears on tab 3.This content appears on tab 3.</p>
	</section>
    	<section id="tab10">
		<h2><a href="#tab10">Tab 10</a></h2>
		<p>This content appears on tab 10.This content appears on tab 3.This content appears on tab 3.</p>
	</section>
</article>
 </body>
</html>
