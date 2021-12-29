<?php
function getString(){
    if(isset($_SESSION['username'])){
        return $_SESSION['username'];
    }else{
        return "Login";
    }
}
?>