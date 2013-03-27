<?php
/**
 * This file is used to adjust the class name of yui grid.
 */
$yuiFile = '../www/theme/default/yui.css';
$classes = "
yui3-u-1   
yui3-u-1-2 
yui3-u-1-3 
yui3-u-2-3 
yui3-u-1-4 
yui3-u-3-4 
yui3-u-1-5 
yui3-u-2-5 
yui3-u-3-5 
yui3-u-4-5 
yui3-u-1-6 
yui3-u-5-6 
yui3-u-1-8 
yui3-u-3-8 
yui3-u-5-8 
yui3-u-7-8 
yui3-u-1-12 
yui3-u-5-12 
yui3-u-7-12 
yui3-u-11-12
yui3-u-1-24 
yui3-u-5-24 
yui3-u-7-24 
yui3-u-11-24
yui3-u-13-24
yui3-u-17-24
yui3-u-19-24
yui3-u-23-24
";
$classes = explode("\n", trim($classes));
$classes = array_reverse($classes);
array_pop($classes);

$content = file_get_contents($yuiFile);
foreach($classes as $class)
{
    $class = explode('-', trim($class));
    $search = $class[1] . '-' . $class[2] . '-' . $class[3];
    $replace = $class[1] . '-' . $class[3] . '-' . $class[2];
    $content = str_replace($search, $replace, $content);
}

file_put_contents($yuiFile, $content);
