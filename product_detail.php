<?php 
session_start();
include("includes/database.php");
$productid = $_GET["id"];
//create query from the product id to get product details and images
$query = "SELECT products.id AS id,
        products.name AS name,
        products.description AS description,
        products.price AS price,
        images.image_file AS image
        FROM products
        INNER JOIN products_images ON products.id = products_images.product_id
        INNER JOIN images ON images.image_id = products_images.image_id
        WHERE products.id = ?";
//prepare query
$statement = $connection -> prepare($query);
//send parameter
$statement -> bind_param("i",$productid);
//execute query
$statement -> execute();
//get result
$result = $statement -> get_result();
//get result as an associative array
if($result -> num_rows > 0) {
    $product = array();
    while($row = $result -> fetch_assoc() ) {
        array_push($product,$row);
    }
}
?>

<html>
<?php
$page_title = "Home Page";
include("includes/head.php");
?>
    <body>
        <?php include("includes/navigation.php"); ?>    
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="product-detail-images" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php 
                                $counter = 0;
                                foreach($product as $item) {
                                    if($counter == 0) {
                                        $active = "class=\"active\"";
                                    }
                                    else {
                                        $active = "";
                                    }
                                    echo "<li data-target=\"#product-detail-images\"
                                    data-slide-to=\"$counter\" $active></i>";
                                    $counter++;
                                }
                            ?>
                          
                        </ol>
                            
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php 
                            //output images as slides
                            $counter = 0;
                            foreach($product as $item) {
                                $image = $item["image"];
                                if( $counter == 0 ) {
                                    $active = "active";
                                }
                                else {
                                    $active = "";
                                }
                                echo "<div class=\"item $active\">
                                <img src=\"products/$image\"></div>";
                                $counter++;
                            }
                            ?>
                        </div>
                            
                        <!-- Controls -->
                        <a class="left carousel-control" href="#product-detail-images" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#product-detail-images" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <h3 class="product-name cap"><?php echo $product[0]["name"]; ?></h3>
                    <p><?php echo $product[0]["description"]; ?></p>
                    <h4 class="price"><?php echo $product[0]["price"]; ?></h4>
                    <form id="cart-form" class="form-inline" action="product_detail.php" method="post">
                        <input name="id" type="hidden" value="<?php echo $product[0]["id"] ?>">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input class="form-control product-quantity" type="number" step="1" min="1" value="1">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info" type="submit" name="target" value="cart">
                              <span class="glyphicon glyphicon-shopping-cart"></span>
                              Add to Cart
                            </button>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info" type="submit" name="target" value="wish">
                              <span class="glyphicon glyphicon-heart"></span>
                              Add to Wishlist
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>