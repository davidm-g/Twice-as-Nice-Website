<?php
    session_start();                                         // starts the session
    require_once('database/connection.php'); 
    require_once('database/items.php');  
    header('Content-Type: application/json');
    $db = getDatabaseConnection();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['brand'])){
            $_SESSION['brands'][] = $_POST['brand'];
            echo getBrandName($db, $_POST['brand']);
        }
        
        else if(isset($_POST['size'])) {
            $_SESSION['sizes'][] = $_POST['size'];
            echo getSizeName($db, $_POST['size']);
        }

        else if(isset($_POST['condition'])) {
            $_SESSION['conditions'][] = $_POST['condition'];
            echo getConditionName($db, $_POST['condition']);
        }

        else if(isset($_POST['price'])) {
            $_SESSION['price'] = $_POST['price'];
            echo $_POST['price'];
        }

        else if(isset($_POST['remove'])) {
            if(strpos($_POST['remove'], 'brd') === 0) {
                $id = substr($_POST['remove'], 3);
                $index = array_search($id, $_SESSION['brands']);
                if ($index !== false) {
                    unset($_SESSION['brands'][$index]);
                    $_SESSION['brands'] = array_values($_SESSION['brands']);
                }
            }
            else if(strpos($_POST['remove'], 'sz') === 0) {
                $id = substr($_POST['remove'], 2);
                $index = array_search($id, $_SESSION['sizes']);
                if ($index !== false) {
                    unset($_SESSION['sizes'][$index]);
                    // Re-index the array to maintain continuous indices
                    $_SESSION['sizes'] = array_values($_SESSION['sizes']);
                }
            }
            else if(strpos($_POST['remove'], 'cond') === 0) {
                $id = substr($_POST['remove'], 4);
                $index = array_search($id, $_SESSION['conditions']);
                if ($index !== false) {
                    unset($_SESSION['conditions'][$index]);
                    // Re-index the array to maintain continuous indices
                    $_SESSION['conditions'] = array_values($_SESSION['conditions']);
                }
            }
            else if($_POST['remove'] == 'price') {
                unset($_SESSION['price']);
            }
        }

        else if(isset($_POST['reset'])) {
            $_SESSION['brands'] = array();
            $_SESSION['sizes'] = array();
            $_SESSION['conditions'] = array();
            $_SESSION['price'] = '';
        }
    }
