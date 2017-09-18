<?php 
//include class definition
include("classes/cat.php");
include("classes/gingercat.php");

//instantiate the class
$mycat = new Cat("fluffy");

//will create errors
//colour is a private property of Cat class
//$catcolour = $mycat -> colour;
//name is a protected property of Cat class
//$catname = $mycat -> name;

$catcolour = $mycat -> getColour();
echo "My cat's colour is " . $catcolour . ".<br>";

$catname = $mycat -> getName();
echo "My cat's name is " . $catname . ".<br>";

// initiatlise GingerCat class
$newcat = new GingerCat("Monsty");
//call GingerCat class's __toString() method
echo $newcat;
?>
