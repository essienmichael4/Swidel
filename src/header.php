<!-- <?php
    session_start();
?> -->

<header <?php if(isset($_SESSION['userid'])) echo 'class="header-justify"' ?>>
    <nav>
    <a href="index.php"><img src="./assets/logo.png" alt="logo"></a>
    <!-- <h2><span>Swi</span>Del</h2> -->
        
        <?php
            if(isset($_SESSION['userid'])){
                echo '<form action="">
                    <input type="text" class="search" placeholder="Search" name="search">
                    <button type="submit" name="searchProductsUsers" class="search btn">Search</button>
                </form>';

                echo '<p>Welcome '.$_SESSION['username'].'</p>';
                echo '
                <form action="./includes/logout.inc.php" method="post"">
                    <button type="submit" class="btn" name="logout">logout</button>
                </form> 
                </nav>
                <div class="bringCart" onclick="bringCart()">
                    
                </div>';
            }elseif(isset($_SESSION['adminid'])){
                echo '<form method="post">
                    <input type="text" class="search" placeholder="Search" name="search">
                    <button type="submit" name="searchProductsAdmin" class="search btn">Search</button>
                </form>';

                echo '<p>Welcome '.$_SESSION['username'].'</p>
                <form class="change_btn">';
                if(isset($_GET['addProduct'])){
                    echo '<button type="submit" class="no-border" name="adduser">add new admin</button>';
                } elseif(isset($_GET['adduser'])){
                    echo '<button type="submit" class="no-border" name="addProduct">add new product</button>';
                }else{
                    echo '<button type="submit" class="no-border" name="adduser">add new admin</button>';
                }
                
                echo '</form>';

                echo '
                <form action="./includes/logout.inc.php"  method="post">
                    <button type="submit" class="btn" name="logout">logout</button>
                </form> 
                </nav>';
            } else {
                echo '
                <form class="loginForm" action="./includes/login.inc.php" method="post">
                    <input type="text" placeholder="username/email" name="userName" required>
                    <input type="password" placeholder="password" name="pwd" required>
                    <button type="submit" class="btn" name="login">login</button>
                    <div class="login-below">
                    <label> Admin</label><input type="checkbox" name="admin">
                    <a href="#" class="fpass">forgotten password</a> 
                    </div>
                </form> 
                </nav>';
            }
        ?>      
    
</header>