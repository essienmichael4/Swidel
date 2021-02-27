<main>
<?php
            if(isset($_SESSION['userid'])){
                echo '<section class="container">';
                echo '<aside class="user-profile">
                    <div class="profile-items">
                    <div class="img-item">';
                    
                    
                    if($_SESSION['profilePicStatus'] === 1){
                        echo '<img src="./usersProfile/'.$_SESSION['profilePic'].'" class="profileIMG">';
                    }else{
                        echo '<img src="./usersProfile/general.png" class="profileIMG">';
                    }
                    echo '
                    </div>
                    <div class="add-profile-form">
                        <form method="POST" entype="multipart/form-data">
                            <input type="file" hidden>
                            <button class="add-profile">add profile image</button>
                        </form>
                    </div>
                        <div class="user-info">
                            <p>Name: '.$_SESSION['firstName'].' '.$_SESSION['lastName'].'</p>
                            <p>Username: '.$_SESSION['username'].'</p>
                            <p class="email">Email: '.$_SESSION['email'].'</p>
                            <p>Age: '.$_SESSION['dateOfBirth'].'</p>
                            <p>Gender: '.$_SESSION['gender'].'</p>
                            <p>Location: '.$_SESSION['location'].'</p>
                        </div>
                    </div>
                </aside>';
                echo '<section class="display-products-user">';
                    echo '<h1 class="section-text">Items in inventory</h1>';
                        if(isset($_POST['searchProductsUsers'])){
                            // echo '<div class="inventory-products">';
                            //     echo searchProductsAdmin($conn, $_POST['search']); 
                            // echo '</div>';
                        }else{
                        echo '<div class="inventory-products">';
                                echo getProducts($conn); 
                            echo '</div>';
                        }
                    echo '</section>';
                // echo '<aside class="user-products"></aside>
                echo '</section>';
            }elseif(isset($_SESSION['adminid'])){
                echo '<section class="container">
                    <aside class="user-profile">
                    <div class="profile-items">
                    <div class="img-item">';
                    
                    
                    if($_SESSION['profilePicStatus'] === 1){
                        echo '<img src="./usersProfile/'.$_SESSION['profilePic'].'" class="profileIMG">';
                    }else{
                        echo '<img src="./adminProfile/general.png" class="profileIMG">';
                    }
                    echo '
                    </div>
                    <div class="add-profile-form">
                        <form method="POST" entype="multipart/form-data">
                            <input type="file" name="ppic" hidden>
                            <button class="add-profile">add profile image</button>
                        </form>
                    </div>
                        <div class="user-info">
                            <p>Name: '.$_SESSION['firstName'].' '.$_SESSION['lastName'].'</p>
                            <p>Username: '.$_SESSION['username'].'</p>
                            <p class="email">Email: '.$_SESSION['email'].'</p>
                            <p>Location: '.$_SESSION['location'].'</p>
                        </div>
                    </div>
                    </aside>';
                    echo '<section class="display-products">';
                        echo '<div class="titles">
                            <h1>Items in inventory</h1>
                            <h1>Users</h1>
                            <h1>Orders</h1>
                        </div>';
                        if(isset($_GET['searchProductsUsers'])){
                            echo '<div class="inventory-products">';
                                echo searchProductsAdmin($conn, $_POST['search'], $_POST['search']); 
                            echo '</div>';
                        }else{
                           echo '<div class="inventory-products">
                           <h1>Items in inventory</h1>
                            <h1>Users</h1>
                            <h1>Orders</h1>';
                                echo getProductsForAdmin($conn); 
                            echo '</div>';
                        }
                    echo '</section>';
                    echo '<aside class="products-form">';
                        if(isset($_GET['addProduct'])){
                            echo '<h3>Add product to inventory</h3>
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

                            </form>';
                        } elseif(isset($_GET['adduser'])){
                            echo '<h3>Add new admin</h3>
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
    
                            </form>';
                        }else {
                            echo '<h3>Add product to inventory</h3>
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
    
                            </form>';
                        }

                    echo '</aside>
                </section>';

            } else {
                echo '<section class="image">
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
                ';
            }
        ?>     

    
        
</main>

