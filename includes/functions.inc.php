<?php
    //Check for empty Field
    function emptyField($data){
        $result;
        if(empty($data)){
            return $result = true;
        } else{
            return $result = false;
        }
    }

    //Check for empty fields
    function emptyFields($fname,$lname,$username,$email,$pwd,$pwdCheck,$gender,$location,$dob){
        $result;
        if(empty($fname)||empty($lname)||empty($username)||empty($email)||empty($pwd)||empty($pwdCheck)||empty($gender)||empty($location)||empty($dob)){
            return $result = true;
        } else{
            return $result = false;
        }
    }

    //Check for invalid username
    function invalidUsername($username){
        $result;
        if(!preg_match('/^[a-zA-Z0-9]*$/', $username )){
            return $result = true;
        } else{
            return $result = false;
        }
    }

    //Check for invalid email
    function invalidEmail($email){
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $result = true;
        } else{
            return $result = false;
        }
    }

    //Password Check
    function invalidPassword($pwd, $pwdCheck){
        $result;
        if($pwd !== $pwdCheck){
            return $result = true;
        } else{
            return $result = false;
        }
    }
    

    // image uppload Admin
    function uploadImgAdmin($conn, $data, $id){
        $sql = 'UPDATE admin SET profilePic = $data AND profilePicStatus = 1 WHERE id = $id';
        $conn->query($sql);
    }


    // image uppload Admin
    function uploadImgUser($conn, $data, $id){
        $sql = 'UPDATE users SET profilePic = $data AND profilePicStatus = 1 WHERE id = $id';
        $conn->query($sql);
    }


    //Check for taken email or username for User
    function takenMail($conn, $email, $username){
        $sql = 'SELECT * FROM users WHERE email = ? OR username = ?;';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=stmt-error");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $email, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($result)){
            return $row;
        }else{
            return $result = false;
        }

        mysqli_stmt_close($stmt);
    }

    //Check for taken email or username for Admin
    function takenMailAdmin($conn, $email, $username){
        $sql = 'SELECT * FROM `admin` WHERE email = ? OR username = ?;';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=stmt-error");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $email, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($result)){
            return $row;
        }else{
            return $result = false;
        }

        mysqli_stmt_close($stmt);
    }


    //Signup User

    function setUser($conn, $fname, $lname, $username, $email, $pwd, $gender, $location, $dob){
        $sql = 'INSERT INTO users(firstName, lastName, username, email, password, dateOfBirth, location, gender) VALUES(?,?,?,?,?,?,?,?);';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=stst-error");
            exit();
        }

        $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $username, $email, $hashedpwd, $dob, $location, $gender);
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);

        $userExists = takenMail($conn, $username, $username);

        if($userExists === false){
            header("Location: ../index.php?error=signupError");
            exit();
        }

        // $sql2 = 'SELECT `id, contact, profilePic, profilePicStatus` FROM users WHERE username = $username;';
        // $result = $conn->query($sql2);
        // $userExists = $result->fetch_assoc();


        session_start();
        $_SESSION['userid'] = $userExists['usersid'];
        $_SESSION['firstName'] = $userExists['fisrtName'];
        $_SESSION['lastName'] = $userExists['lastName'];
        $_SESSION['username'] = $userExists['username'];
        $_SESSION['email'] = $userExists['email'];
        $_SESSION['dateOfBirth'] = $userExists['dateOfBirth'];
        $_SESSION['location'] = $userExists['location'];
        $_SESSION['gender'] = $userExists['gender'];
        $_SESSION['contact'] = $userExists['contact'];
        $_SESSION['profilePic'] = $userExists['profilePic'];
        $_SESSION['profilePicStatus'] = $userExists['profilePicStatus'];
        header("Location: ../index.php?error=none");
        exit();
    }

    //Login Administrator
    function loginAdmin($conn, $username, $pwd){

        $userExists = takenMailAdmin($conn, $username, $username);

        if($userExists === false){
            header("Location: ../index.php?error=wrongLogin");
            exit();
        }

        $pwdVerify = $userExists['password'];

        if($pwdVerify !== $pwd){
            header("Location: ../index.php?error=wrongLogin");
            exit();
        }else{
            session_start();
            $_SESSION['adminid'] = $userExists['adminid'];
            $_SESSION['firstName'] = $userExists['firstName'];
            $_SESSION['lastName'] = $userExists['lastName'];
            $_SESSION['username'] = $userExists['username'];
            $_SESSION['email'] = $userExists['email'];
            $_SESSION['location'] = $userExists['location'];
            $_SESSION['contact'] = $userExists['contact'];
            $_SESSION['profilePic'] = $userExists['profilePic'];
            $_SESSION['profilePicStatus'] = $userExists['profilePicStatus'];            
            header("Location: ../index.php?error=loginSuccess");
            exit();
        
        }
    }

    //Login user
    function loginUser($conn, $username, $pwd){
        $userExists = takenMail($conn, $username, $username);

        if($userExists === false){
            header("Location: ../index.php?error=wrongLogin");
            exit();
        }

        $pwdhashed = $userExists['password'];

        $pwdVerify = password_verify($pwd, $pwdhashed);

        if($pwdVerify === false){
            header("Location: ../index.php?error=wrongLogin");
            exit();
        }else{
            session_start();
            $_SESSION['userid'] = $userExists['usersid'];
            $_SESSION['firstName'] = $userExists['firstName'];
            $_SESSION['lastName'] = $userExists['lastName'];
            $_SESSION['username'] = $userExists['username'];
            $_SESSION['email'] = $userExists['email'];
            $_SESSION['dateOfBirth'] = $userExists['dateOfBirth'];
            $_SESSION['location'] = $userExists['location'];
            $_SESSION['gender'] = $userExists['gender'];
            $_SESSION['contact'] = $userExists['contact'];
            $_SESSION['profilePic'] = $userExists['profilePic'];
            $_SESSION['profilePicStatus'] = $userExists['profilePicStatus'];
            
            header("Location: ../index.php?success=loginSuccess");
            exit();
        
        }
    }

    //Load Products
    function getProducts($conn){
        $sql = 'SELECT * FROM products;';

        $result = $conn->query($sql);
        
        while ($products = $result->fetch_assoc()) {
            echo '<div class="product-box">
                <img src="'.$products['productPic'].'" class="product-img">';
                echo '<div class="products-info">';
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
                echo '</div>';
            echo '<div>'; 
        }
    }

    //Check if product is taken
    function takenProduct($conn, $data){
        $sql = 'SELECT * FROM products WHERE productName = ?;';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=stmt-error");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $data);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($result)){
            return $row;
        }else{
            return $result = false;
        }

        mysqli_stmt_close($stmt);
    }

    // get product
    function getProduct($conn, $data){
        $sql = 'SELECT * FROM products WHERE productName = ?;';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=stmt-error");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $data);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($result)){
            return $row;
        }else{
            return $result = false;
        }

        mysqli_stmt_close($stmt);
    }
    

    //Add New Product
    function setProducts($conn, $productName, $price, $category, $stock, $pdate, $expdate, $ppic){

        $takenProduct = takenProduct($conn, $productName);

        if($takenProduct !== false){
            header("Location: ../index.php?error=productExists");
            exit();
        }

        $sql = 'INSERT INTO products(productName, productPrice, category, stock) VALUES(?,?,?,?);';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=stmt-error-P");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sisi", $productName, $price, $category, $stock);
        mysqli_stmt_execute($stmt);
            
        mysqli_stmt_close($stmt);

        $productExists = getProduct($conn, $productName);

        if($productExists === false){
            header("Location: ../index.php?error=somethingwentwrong");
            exit();
        }

        if(emptyField($pdate) === false && emptyField($expdate) === true && emptyField($ppic) === true){
            $picStatus = 0;

            $sql2 = 'UPDATE products SET pProduceDate = ?, pPicStatus = ? WHERE productid = ?;';
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=stmt-error-Pprod");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "sii", $pdate, $picStatus, $productExists['productid']);
            mysqli_stmt_execute($stmt);
            
            mysqli_stmt_close($stmt);
            header("Location: ../index.php?success=productAdded");
            exit();

        }elseif(emptyField($pdate) === true && emptyField($expdate) === false && emptyField($ppic) === true){
            $picStatus = 0;

            $sql2 = 'UPDATE products SET pExpiryDate = ?, pPicStatus = ? WHERE productid = ?;';
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=stmt-error-Pexp");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "sii", $expdate, $picStatus, $productExists['productid']);
            mysqli_stmt_execute($stmt);
            
            mysqli_stmt_close($stmt);
            header("Location: ../index.php?success=productAdded");
            exit();
        }elseif(emptyField($pdate) === true && emptyField($expdate) === true && emptyField($ppic) === false){
            $picStatus = 1;

            $ppicName = $ppic['name'];
            $ppicTempName = $ppic['tmp_name'];
            $ppicSize = $ppic['size'];
            $ppicError = $ppic['error'];

            $ppicExt = explode('.', $ppicName);
            $ppicActExt = strtolower(end($ppicExt));

            $allowedExt = array('jpg', 'jpeg', 'png');

            if(in_array($ppicActExt, $allowedExt)){
                if($ppicError === 0){
                    if($ppicSize < 5000000){
                        $ppicNewName = $productExists['productid'].".".$ppicActExt;
                        $fileDes = '../productProfile/'.$ppicNewName;
                        
                        $sql2 = 'UPDATE products SET pPicStatus = ?, productPic = ? where productid = ?;';
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../index.php?error=stmt-error-Pp");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt, "isi", $picStatus, $ppicNewName, $productExists['productid']);
                        mysqli_stmt_execute($stmt);
                        
                        mysqli_stmt_close($stmt);

                        move_uploaded_file($ppicTempName, $fileDes);
                    }
                }
            }
            

            header("Location: ../index.php?success=productAdded");
            exit();
        }elseif(emptyField($pdate) === false && emptyField($expdate) === false && emptyField($ppic) === true){
            $picStatus = 0;

            $sql2 = 'UPDATE products SET pProduceDate = ?, pExpiryDate = ?, pPicStatus = ? WHERE productid = ?;';
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=stmt-error");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ssii",$pdate, $expdate, $picStatus, $productExists['productid']);
            mysqli_stmt_execute($stmt);
            
            mysqli_stmt_close($stmt);
            header("Location: ../index.php?success=productAdded");
            exit();
        }elseif(emptyField($pdate) === false && emptyField($expdate) === true && emptyField($ppic) === false){
            $picStatus = 1;

            $ppicName = $ppic['name'];
            $ppicTempName = $ppic['tmp_name'];
            $ppicSize = $ppic['size'];
            $ppicError = $ppic['error'];

            $ppicExt = explode('.', $ppicName);
            $ppicActExt = strtolower(end($ppicExt));

            $allowedExt = array('jpg', 'jpeg', 'png');

            if(in_array($ppicActExt, $allowedExt)){
                if($ppicError === 0){
                    if($ppicSize < 5000000){
                        $ppicNewName = $productExists['productid'].".".$ppicActExt;
                        $fileDes = '../productProfile/'.$ppicNewName;

                        $sql2 = 'UPDATE products SET pProduceDate = ?, pPicStatus = ?, productPic = ? where productid = ?;';
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../index.php?error=stmt-error-Pprodpic");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt, "sisi", $pdate, $picStatus, $ppicNewName, $productExists['productid']);
                        mysqli_stmt_execute($stmt);
                        
                        mysqli_stmt_close($stmt);

                        move_uploaded_file($ppicTempName, $fileDes);
                    }
                }
            }

            
            header("Location: ../index.php?success=productAdded");
            exit();

        }elseif(emptyField($pdate) === true && emptyField($expdate) === false && emptyField($ppic) === false){
            $picStatus = 1;
            
            $ppicName = $ppic['name'];
            $ppicTempName = $ppic['tmp_name'];
            $ppicSize = $ppic['size'];
            $ppicError = $ppic['error'];

            $ppicExt = explode('.', $ppicName);
            $ppicActExt = strtolower(end($ppicExt));

            $allowedExt = array('jpg', 'jpeg', 'png');

            if(in_array($ppicActExt, $allowedExt)){
                if($ppicError === 0){
                    if($ppicSize < 5000000){
                        $ppicNewName = $productExists['productid'].".".$ppicActExt;
                        $fileDes = '../productProfile/'.$ppicNewName;

                        $sql2 = 'UPDATE products SET pExpiryDate = ?, pPicStatus = ?, productPic = ? where productid = ?;';
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../index.php?error=stmt-error-Pexppic");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt, "sisi",$expdate, $picStatus, $ppicNewName, $productExists['productid']);
                        mysqli_stmt_execute($stmt);
                        
                        mysqli_stmt_close($stmt);

                        move_uploaded_file($ppicTempName, $fileDes);
                    }
                }
            }
            header("Location: ../index.php?success=productAdded");
            exit();

        }elseif(emptyField($pdate) === false && emptyField($expdate) === false && emptyField($ppic) === false){
            $picStatus = 1;

            $ppicName = $ppic['name'];
            $ppicTempName = $ppic['tmp_name'];
            $ppicSize = $ppic['size'];
            $ppicError = $ppic['error'];

            $ppicExt = explode('.', $ppicName);
            $ppicActExt = strtolower(end($ppicExt));

            $allowedExt = array('jpg', 'jpeg', 'png');

            if(in_array($ppicActExt, $allowedExt)){
                if($ppicError === 0){
                    if($ppicSize < 5000000){
                        $ppicNewName = $productExists['productid'].".".$ppicActExt;
                        $fileDes = '../productProfile/'.$ppicNewName;

                        $sql2 = 'UPDATE products SET pProduceDate = ?, pExpiryDate = ?, pPicStatus = ?, productPic = ? where productid = ?;';
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../index.php?error=stmt-error");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt, "sssi",$pdate, $expdate, $picStatus, $ppicNewName, $productExists['productid']);
                        mysqli_stmt_execute($stmt);
                        
                        mysqli_stmt_close($stmt);

                        move_uploaded_file($ppicTempName, $fileDes);
                    }
                }
            }
            header("Location: ../index.php?success=productAdded");
            exit();
        }

        header("Location: ../index.php?success=productAdded");
        exit();
        
    }

    //Add New Administrator
    function setNewAdmin($conn, $fname, $lname, $username, $email, $pwd, $gender, $location, $ppic){
        $sql = 'INSERT INTO admin(firstName, lastName, username, email, password, location, gender) VALUES(?,?,?,?,?,?,?);';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=stst-error");
            exit();
        }

        $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $username, $email, $hashedpwd, $location, $gender);
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);

        if(emptyField($ppic) === false){
            $adminExists = takenMailAdmin($conn, $username, $email);

            if($adminExists === false){
                header("Location: ../index.php?error=somethingwentwrong");
                exit();
            }
            $picStatus = 1;

            $ppicName = $ppic['name'];
            $ppicTempName = $ppic['tmp_name'];
            $ppicSize = $ppic['size'];
            $ppicError = $ppic['error'];

            $ppicExt = explode('.', $ppicName);
            $ppicActExt = strtolower(end($ppicExt));

            $allowedExt = array('jpg', 'jpeg', 'png');

            if(in_array($ppicActExt, $allowedExt)){
                if($ppicError === 0){
                    if($ppicSize < 5000000){
                        $ppicNewName = $adminExists['adminid'].".".$ppicActExt;
                        $fileDes = '../adminProfile/'.$ppicNewName;

                        $sql2 = 'UPDATE admin SET profilePicStatus = ?, profilePic = ? WHERE adminid = ?;;';
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../index.php?error=stmt-error");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt, "isi", $picStatus, $ppicNewName, $adminExists['adminid']);
                        mysqli_stmt_execute($stmt);
                        
                        mysqli_stmt_close($stmt);

                        move_uploaded_file($ppicTempName, $fileDes);
                    }
                }
            }

            
            header("Location: ../index.php?success=adminAdded");
            exit();
        } else {
            $adminExists = takenMailAdmin($conn, $username, $email);

            if($adminExists === false){
                header("Location: ../index.php?error=somethingwentwrong");
                exit();
            }

            $picStatus = 0;

            $sql2 = 'UPDATE admin SET profilePicStatus = ? WHERE adminid = ?;';
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql2)){
                header("Location: ../index.php?error=stmt-error");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ii", $picStatus, $adminExists['adminid']);
            mysqli_stmt_execute($stmt);
            
            mysqli_stmt_close($stmt);
            
            header("Location: ../index.php?success=adminAdded");
            exit();   
        }        
    }

