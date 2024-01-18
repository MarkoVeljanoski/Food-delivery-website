<?php
error_reporting(0); // hide undefine index
session_start(); // temp sessions

Class Actions {
    private $db;

    public function __construct() {
        include 'connect.php';
        $this->db = $db;
    }

    function sqlQuery(){
        $result = mysqli_query($this->db, "SELECT * FROM items where not deleted;");
        while($row = mysqli_fetch_array($result))
        {
            echo '<tr><td>'.$row["name"].'</td><td>'.$row["price"].'</td>';                      
            echo '<td><div class="input-field col s12"><label for='.$row["id"].' class="">Quantity</label>';
            echo '<input id="'.$row["id"].'" name="'.$row['id'].'" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td></tr>';
        }
        return $result;
    }

    public function status(){
        return mysqli_query($this->db, "SELECT DISTINCT status FROM orders");
    }
    
    public function items(){
        return mysqli_query($this->db, "SELECT * FROM items");
    }

    public function likeStatus(){
        return mysqli_query($this->db, "SELECT * FROM orders WHERE status LIKE '$status';");
    }

    public function matchOrders($param){
        return mysqli_query($this->db, "SELECT * FROM order_details WHERE order_id = $param;");
    }

    public function matchCostumer($param){
        return mysqli_query($this->db, "SELECT * FROM users WHERE id = $param;");
    }

    public function matchItem($param){
        return mysqli_query($this->db, "SELECT * FROM items WHERE id = $param;");
    }

    public function checkWalletDetails($param){
        if($_SESSION['customer_sid']==session_id())
        {
            if($_POST['payment_type'] == 'Wallet'){
            $_POST['cc_number'] = str_replace('-', '', $_POST['cc_number']);
            $_POST['cc_number'] = str_replace(' ', '', $_POST['cc_number']); 
            $_POST['cvv_number'] = (int)str_replace('-', '', $_POST['cvv_number']);
            $sql1 = mysqli_query($db, "SELECT * FROM wallet_details where wallet_id = $param");
                while($row1 = mysqli_fetch_array($sql1)){
                    $card = $row1['number'];
                    $cvv = $row1['cvv'];
                    if($card == $_POST['cc_number'] && $cvv==$_POST['cvv_number'])
                    $continue=1;
                    else
                        header("location:index.php");
                }
            return $continue;
            }
        else
            return $continue=1;
        }
    }

    public function matchUser($param){
        return mysqli_query($this->db, "SELECT * FROM users where id = $param");
    }

    public function costumerStatus($param){
        return mysqli_query($this->db, "SELECT DISTINCT status FROM orders WHERE customer_id = $param;");
    }

    function notDeletedItems(){
        return mysqli_query($this->db, "SELECT * FROM items where not deleted");
    }

    public function statusOfCostumer($user_id,$status){
        return mysqli_query($this->db, "SELECT * FROM orders WHERE customer_id = $user_id AND status LIKE '$status';");
    }

    public function allUsers(){
        return mysqli_query($this->db, "SELECT * FROM users");
    }

    public function costumerWallet($param){
        return mysqli_query($this->db, "SELECT * from wallet WHERE customer_id = $param;");
    }

    public function costumerWalletDetails($param){
        return mysqli_query($this->db, "SELECT * from wallet_details WHERE wallet_id = $param;");
    }

}
?>