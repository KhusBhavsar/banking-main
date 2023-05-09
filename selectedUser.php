<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")'; 
        echo '</script>';
    }

    else if($amount > $sql1['balance']) 
    {
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  
        echo '</script>';
    }
    
    else if($amount == 0){
         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }

    else {
        $newBalance = $sql1['balance'] - $amount;
        $sql = "UPDATE users set balance=$newBalance where id=$from";
        mysqli_query($conn,$sql);
             
        $newBalance = $sql2['balance'] + $amount;
        $sql = "UPDATE users set balance=$newBalance where id=$to";
        mysqli_query($conn,$sql);
                
        $sender = $sql1['name'];
        $receiver = $sql2['name'];
        $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
        $query=mysqli_query($conn,$sql);

        if($query){
            echo "<script> alert('Transaction is Successful');
            window.location='transactions.php';
            </script>";
        }
            $newBalance= 0;
            $amount =0;
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Easy Money Transfer</title>
</head>
<body>

<nav class="navbar">
    <div class="left" style="display: flex;">
      <img src="images/rupee.jpg" alt="rupee" width="37px" height="37px" style="border-radius: 50%; margin-right: 5px;">
      <a href="index.html">BANK OF SPARKS</a>
    </div>
    <div class="right">
      <ul>
        <li><a href="customers.php">Transfer Money</a></li>
        <li><a href="transactions.php">Transaction History</a></li>
        <li><a href="https://internship.thesparksfoundation.info/">About</a></li>
      </ul>
    </div>
  </nav>

  <marquee class="css2" direction="left">
    <ul style="display: flex; justify-content: space-around;">
      <li style="list-style: none;">Introducing our new mobile banking app! Download it today and enjoy convenient banking on-the-go. Features
        include account management, bill pay, mobile check deposit, and more.</li>
      <li style="list-style: none;">Fraud alert: We have received reports of fraudulent activity targeting our customers. Please be cautious of
        any suspicious emails, phone calls, or texts claiming to be from our bank. Remember, we will never ask for your
        personal information or login credentials.</li>
      <li style="list-style: none;">Save for your future with our high-yield savings accounts. With competitive interest rates and no monthly
        fees, you can grow your savings and achieve your financial goals.</li>
      <li style="list-style: none;">Attention business owners: Our merchant services offer seamless payment processing for your customers.
        Accept credit cards, debit cards, and mobile payments with ease. Contact us today to learn more.</li>
      <li style="list-style: none;">Protect your identity and finances with our identity theft protection services. Get 24/7 monitoring, alerts,
        and support to help you detect and resolve identity theft quickly.</li>
    </ul>
  </marquee>

  <div class="container">
        <h2 align="center">Transfer Money</h2>
        <?php
            include 'config.php';
            $sid=$_GET['id'];
            $sql = "SELECT * FROM  users where id=$sid";
            $result=mysqli_query($conn,$sql);
            if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
        ?>
        <form method="post"><br>
            <div>
                <table class="tabling2">
                    <tr>
                        <th>Account No.</th>
                        <th>Account Holder Name</th>
                        <th>Email</th>
                        <th>Balance(in Rs.)</th>
                    </tr>
                    <tr>
                        <td><?php echo $rows['id'] ?></td>
                        <td><?php echo $rows['name'] ?></td>
                        <td><?php echo $rows['email'] ?></td>
                        <td><?php echo $rows['balance'] ?></td>
                    </tr>
                </table>
            </div>
            <br>

        <div class="transfer">
            <label>Transfer To:</label>
            <select name="to" required>
                <option value="" disabled selected>Choose account</option>
                <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>">
                    <?php echo $rows['name'] ;?> (Balance:
                    <?php echo $rows['balance'] ;?> )
                </option>
                <?php 
                } 
            ?>
        <div>
        </select><br>
        <label>Amount:</label>
        <input type="number"  name="amount" required><br>
        <button name="submit" type="submit" id="myBtn">Transfer Amount</button>
    </div>
</form>
</div>


  
</body>
</html>