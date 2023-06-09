<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <title>Transactions</title>
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
        <h2 align="center">Transaction History</h2><br>
        <div class="table">
            <table class="tabling">
                <thead >
                    <tr>
                        <th>S.No.</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Amount</th>
                    </tr>
              </thead>
          <tbody>
          <?php
            include 'config.php';
            $sql ="select * from transaction";
            $query =mysqli_query($conn, $sql);
            while($rows = mysqli_fetch_assoc($query))
            {
          ?>
                    <tr>
                      <td><?php echo $rows['sno']; ?></td>
                      <td><?php echo $rows['sender']; ?></td>
                      <td><?php echo $rows['receiver']; ?></td>
                      <td><?php echo $rows['balance']; ?> </td>
                    </tr>           
            <?php
            }
            ?>
            </tbody>
        </table>
      </div>
    </div>
</body>
</html>