<main>
<?php
            if(isset($_SESSION['userid'])){
                ?>
                <section class="container">
                    <aside class="user-profile">
                        <div class="profile-items">
                            <div class="img-item">
                    
                                <?php
                                if($_SESSION['profilePicStatus'] === 1){
                                    echo '<img src="./usersProfile/'.$_SESSION['profilePic'].'" class="profileIMG">';
                                }else{
                                    echo '<img src="./usersProfile/general.png" class="profileIMG">';
                                }
                                ?>
                    
                            </div>
                            <div class="add-profile-form">
                                <form method="POST" entype="multipart/form-data">
                                    <input type="file" hidden>
                                    <button class="add-profile">add profile image</button>
                                </form>
                            </div>
                            <div class="user-info"><?php
                                echo '<p>Name: '.$_SESSION['firstName'].' '.$_SESSION['lastName'].'</p>
                                <p>Username: '.$_SESSION['username'].'</p>
                                <p class="email">Email: '.$_SESSION['email'].'</p>
                                <p>Age: '.$_SESSION['dateOfBirth'].'</p>
                                <p>Gender: '.$_SESSION['gender'].'</p>
                                <p>Location: '.$_SESSION['location'].'</p>';?>
                            </div>
                        </div>
                    </aside>
                    <section class="display-products-user">
                        <h1 class="section-text">Items in inventory</h1>
                            <?php if(isset($_POST['searchProductsUsers'])){
                                // echo '<div class="inventory-products">';
                                //     echo searchProductsAdmin($conn, $_POST['search']); 
                                // echo '</div>';
                            }else{?>
                                <div class="inventory-products">
                                    <?php
                                        $sql = 'SELECT * FROM products;';
                                        $result = $conn->query($sql);
                                        while($products = $result->fetch_assoc()){
                                    ?>
                                    
                                    <div class="product-box">
                                        <div class="relative-box">
                                            <p class="stock-text"><?php echo $products['stock'];?></p>
                                            <div class="products-img">
                                                <?php
                                                if($products['pPicStatus'] != 1){?>
                                                    <img src="./productProfile/general.png" class="product-img"><?php
                                                }else {?>
                                                    <img src="./productProfile/<?php echo $products['productPic']?>" class="product-img">
                                                <?php
                                                }?>
                                            </div>
                                            
                                        </div>
                                        <div class="products-info">
                                                <p><?php echo $products['productName']; ?></p>
                                                <p> Price: GH¢ <?php echo $products['productPrice']; ?></p>
                                        </div>

                                        <div class="products-info-dates"><?php
                                                    if($products['pProduceDate'] == 'Null'){
                                                        echo '<p>'.$products['pProduceDate'].'</p>';
                                                    }else {
                                                        echo '<p class="block"></p>';
                                                    }
                                                    if($products['pExpiryDate'] == 'Null'){
                                                        echo '<p>'.$products['pExpiryDate'].'</p>';
                                                    }else {
                                                        echo '<p class="block"></p>';
                                                    }?>
                                        </div>
                                        <div class="addCart">
                                            <h3>Add to Cart</h3>
                                            <img src="./assets/cart.png" class="cart-img" alt="cart image">
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            
                    <?php
                        }?>
                    </section>
                    <aside class="addedCartOverlay">
                        <div class="cartDisplay">
                            <h2>Your Cart</h2>
                            <div class="cartProduct">
                                <div class="cartPImg"><img src="./assets/cart.png" alt="product image"></div>
                                
                                <div class="cartPInfo">
                                    <h4>product name</h4>
                                    <h4>product price</h4>
                                    <button>remove</button>
                                </div>
                                <div class="cartPStock">
                                    <button><</button>
                                    <h4>stock</h4>
                                    <button><</button>
                                </div>

                            </div>
                            <div class="cartfooter">
                                <div class="cartTotal">
                                    <h3>Total: GH¢ </h3>
                                </div>
                                <button class="cartBuy">
                                    Make Order
                                </button>   
                            </div>
                        </div>
                    </aside>
                </section><?php
            }elseif(isset($_SESSION['adminid'])){?>
                <section class="container">
                    <aside class="user-profile">
                    <div class="profile-items">
                    <div class="img-item">
                    
                    <?php
                    if($_SESSION['profilePicStatus'] === 1){
                        echo '<img src="./usersProfile/'.$_SESSION['profilePic'].'" class="profileIMG">';
                    }else{
                        echo '<img src="./adminProfile/general.png" class="profileIMG">';
                    }
                    ?>
                    
                    </div>
                    <div class="add-profile-form">
                        <form method="POST" entype="multipart/form-data">
                            <input type="file" name="ppic" hidden>
                            <button class="add-profile">add profile image</button>
                        </form>
                    </div>
                        <div class="user-info"><?php
                            echo '<p>Name: '.$_SESSION['firstName'].' '.$_SESSION['lastName'].'</p>
                            <p>Username: '.$_SESSION['username'].'</p>
                            <p class="email">Email: '.$_SESSION['email'].'</p>
                            <p>Location: '.$_SESSION['location'].'</p>';?>
                        </div>
                    </div>
                    </aside>
                    <section class="display-products">
                        <div class="titles">
                            <h1>Items in inventory</h1>
                            <h1>Users</h1>
                            <h1>Orders</h1>
                        </div>
                        <?php
                        if(isset($_GET['searchProductsUsers'])){
                            echo '<div class="inventory-products">';
                                echo searchProductsAdmin($conn, $_POST['search'], $_POST['search']); 
                            echo '</div>';
                        }else{?>
                           <div class="inventory-products">
                           
                            <?php
                                //Get products for Admin
                                $sql = 'SELECT * FROM products;';
                                $result = $conn->query($sql);
                                while($products = $result->fetch_assoc()){
                            ?> 
                                <div class="product-box" id="parent">
                                    <div class="relative-box">
                                    <div class="products-img"><?php
                                        if($products['pPicStatus'] != 1){?>
                                            <img src="./productProfile/general.png" class="product-img"><?php
                                         }else {?>
                                            <img src="./productProfile/<?php echo $products['productPic']?>" class="product-img"><?php
                                        }?>
                                        <div class="edit"> 
                                            <form action="./includes/utilities.inc.php" method="POST" enctype="multipart/form-data">
                                                <input name="pid" value="<?php echo $products['productid']?>" hidden>
                                                <input id="product-pic-change<?php echo $products['productid']?>" type="file" name="ppic" hidden>
                                                
                                                <button type="submit" class="edit-btn-save" id="save<?php echo $products['productid']?>" name="edit-product-pic">save image</button>
                                            </form>
                                            <button class="edit-btn" id="edit<?php echo $products['productid']?>" onclick="changePic()">edit image</button>
                                        </div>
                                        </div>
                                    </div>
                
                                    <div class="products-info"><?php
                                    echo '<p>'.$products['productName'].'</p>';
                                    echo '<p> Price: GH¢'.$products['productPrice'].'</p>';
                                    echo '</div>';
                    
                                    echo '<div class="products-info-dates">';
                                        if($products['pProduceDate'] !== 'Null'){
                                            echo '<p>'.$products['pProduceDate'].'</p>';
                                        }
                                        if($products['pExpiryDate'] !== 'Null'){
                                            echo '<p>'.$products['pExpiryDate'].'</p>';
                                        }
                                    echo '</div>';?>
                                    <form>
                                        <button>edit</button>
                                        <button>delete</button>
                                    </form>
                                </div>
                            <?php
                                }
                            ?>

                                
                            
                            </div><?php
                        }?>
                    </section>
                    <aside class="products-form"><?php
                        if(isset($_GET['addProduct'])){?>
                            <h3>Add product to inventory</h3>
                            <form action="./includes/product.inc.php" method="POST" enctype="multipart/form-data">
                                <input type="text" name="pName" placeholder="Product name">
                                <input type="number" name="price" placeholder="price">
                                <input type="text" name="category" placeholder="Category">
                                <input type="number" name="stock" class="stock" placeholder="number of goods">
                                <label>Production Date</label>
                                <input type="date" name="pdate">
                                <label>Expiry Date</label>
                                <input type="date" name="expdate">
                                <label>Add picture of product</label>
                                <input type="file" name="ppic">
                                <button type="submit" name="add-product">add item</button>

                            </form><?php
                        } elseif(isset($_GET['adduser'])){?>
                            <h3>Add new admin</h3>
                            <form action="./includes/addAdmin.inc.php" method="POST" enctype="multipart/form-data">

                                <input type="text" name="pName" placeholder="First name">
                                <input type="text" name="lName" placeholder="Last name">

                                <input type="text" name="username" placeholder="Username">
                                <input type="email" name="email" placeholder="Email">

                                <input type="text" name="location" placeholder="Location">
                                <input type="text" name="contact" placeholder="Contact">

                                <input type="password" name="pwd" placeholder="Password">
                                <input type="password" name="pwdRepeat" class="pwdr" placeholder="Repeat password">

                                <label>Add profile picture</label>
                                <input type="file" name="ppic">

                                <button type="submit" name="addAdmin">Add Administrator</button>
    
                            </form><?php
                        }else {?>
                            <h3>Add product to inventory</h3>
                            <form action="./includes/product.inc.php" method="POST">

                                <input type="text" name="pName" placeholder="Product name">
                                <input type="number" name="price" placeholder="Price">

                                <input type="text" name="category" placeholder="Category">

                                <input type="number" name="stock" class="stock" placeholder="Number of Goods">
                                
                                <label>Production Date</label>
                                <input type="date" name="pdate">

                                <label>Expiry Date</label>
                                <input type="date" name="expdate">

                                <label>Add picture of product</label>
                                <input type="file" name="ppic">

                                <button type="submit" name="addProduct">add item</button>
    
                            </form><?php
                        }?>

                    </aside>
                </section>
                <?php
            } else {?>
                <section class="image">
                    <!-- <img src="../assets/a.jpg" alt=""> -->
                    <aside class="signup_form">
                        
                        <form action="includes/signup.inc.php" class="signup_content" method="POST">
                        <label class="txt-signup">Sign Up</label>
                            <input type="text" name="fName" placeholder="first name" required>
                            <input type="text" name="lName" placeholder="last name" required> 
                            <input type="text" name="username" placeholder="username" required>
                            <input type="email" name="email" placeholder="email" required>
                            <input type="password" name="pwd" placeholder="password" required>
                            <input type="password" name="pwdCheck" placeholder="repeat password" required>
            
                            <div class="content" ><label>Male </label><input type="radio" name="gender" value="male"></div>
                            <div class="content"><label>Female</label><input type="radio" name="gender" value="female" ></div>
                            <label>date of birth</label>
                            <input type="date" name="dob">
                            <div class="content">
                                <label for="">Location</label>
                                <select name="location" >
                                    <option value="getfund">Getfund</option>
                                    <option value="hostel">Hostel</option>
                                    <option value="apartment">Apartment</option>
                                </select>
                            </div>
                            <button type="submit" name="signupUser">Sign up</button>
                        </form>
                    </aside>
                </section>
                <?php
            }
        ?>     

    
    <?php include("footer.php") ?>
</main>

