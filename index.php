<?php
/**
 * TXT V1.2
 *
 * This script prints the specified full screen text
 * 
 *
 * GET Parameters: 
 *  - txt  : the text to show, use "\n" to change line
 *  - ratio: default 1
 *
 * Examples:
 * - /?txt=hello😂                => this will show the big text "hello😂"
 * - /?txt=hello\nworld&ratio=.8  => this will show the big text "hello\word" with a ratio of 0.8
 *  
 *  
 * All copy right reserved.
 * https://github.com/qinst64/html-big-text/
 */
if (!isset($_GET['txt'])) {
  $doc = preg_grep('/^ \*($| [^@])/', explode("\n", file_get_contents(__FILE__)));
  $doc = preg_replace("/\n? \* ?/", "\n", implode("\n", $doc));
  header('Content-type: text/plain');
  echo $doc;
  exit;
}
$ratio=isset($_GET['ratio'])?$_GET['ratio']:1;
$txt=$_GET['txt'];
?>
<html>
   <head>
      <meta charset="UTF-8">
      <title><?php echo $txt ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="theme-color" content="#3F51B5">
      <link href="//cdn.bootcss.com/material-design-lite/1.2.0/material.min.css" rel="stylesheet">
      <script src="//cdn.bootcss.com/material-design-lite/1.2.0/material.min.js"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <script src="//cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
      <style>
         body {
         margin: 0 !important;
         padding: 0 !important;
         background-color: #ecf0f1;
         overflow: hidden;
         /*no select*/
         -webkit-touch-callout: none;
         -webkit-user-select: none;
         -moz-user-select: -moz-none;
         -ms-user-select: none;
         -o-user-select: none;
         user-select: none;
         }
         #text {
         white-space: nowrap;
         line-height: 100%;
         text-align: justify;
         }
      </style>
   </head>
   <body>
      <div id="text">
         <?php echo str_replace( '\n', '<br>',$txt); ?>
      </div>
      <script>
         (center = function() {
             var ratio = <?php echo $ratio; ?>;
             var font_size_a = 1;
             var font_size_b = $(window).width() * ratio;
             while (font_size_b - font_size_a > 1) {
                 font_size_ab = (font_size_a + font_size_b) / 2;
                 $("#text").css("font-size", font_size_ab + "px");
                 $("#text").css("position", "absolute");
                 $("#text").css("top", Math.max(0, (($(window).height() - $("#text").outerHeight()) / 2) + $(window).scrollTop()) + "px");
                 $("#text").css("left", Math.max(0, (($(window).width() - $("#text").outerWidth()) / 2) + $(window).scrollLeft()) + "px");
         
                 if ($("#text").outerWidth(true) < $(window).width() * ratio && $("#text").outerHeight(true) < $(window).height() * ratio) {
                     font_size_a = font_size_ab;
                 } else {
                     font_size_b = font_size_ab;
                 }
                 console.log($("#text").outerWidth(true) + "，" + $("#text").outerHeight(true));
             }
             console.log('OK!')
         })();
         
         $(window).resize(function() {
             center();
         });
         
         $("#text").click(function(){
             //full_screen();
         });
      </script>
   </body>
</html>
