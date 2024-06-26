<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();                                         // starts the session
    require_once('../database/connection.php'); 
    require_once('../database/items.php');  
    header('Content-Type: application/json');
    $db = getDatabaseConnection_folder();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['brand'])){
            $_SESSION['brands'][] = $_POST['brand'];
            addFilter($db, 'brd' . $_POST['brand'], getBrandName($db, $_POST['brand']));
            echo getBrandName($db, $_POST['brand']);
        }
        
        else if(isset($_POST['size'])) {
            $_SESSION['sizes'][] = $_POST['size'];
            addFilter($db, 'sz' . $_POST['size'], getSizeName($db, $_POST['size']));
            echo getSizeName($db, $_POST['size']);
        }

        else if(isset($_POST['condition'])) {
            $_SESSION['conditions'][] = $_POST['condition'];
            addFilter($db, 'cond' . $_POST['condition'], getConditionName($db, $_POST['condition']));
            echo getConditionName($db, $_POST['condition']);
        }

        else if(isset($_POST['price'])) {
            $_SESSION['price'] = $_POST['price'];
            addFilter($db, 'price', $_POST['price']);
            echo $_POST['price'];
        }

        else if(isset($_POST['search'])) {
            $_SESSION['search'] = $_POST['search'];
            addFilter($db, 'search', "'" . $_POST['search'] . "'");
            echo ("'" . $_POST['search'] . "'");
        }

        else if(isset($_POST['category'])) {
            $_SESSION['category'] = $_POST['category'];
            if(strpos($_POST['category'], 'sub') === 0) {
                addFilter($db, 'cats', getCategoryNameSub($db, substr($_POST['category'], 3)) . ' -> ' . getSubcategoryName($db, substr($_POST['category'], 3)));
                echo getCategoryNameSub($db, substr($_POST['category'], 3)) . ' -> ' . getSubcategoryName($db, substr($_POST['category'], 3));
            } else {
                addFilter($db, 'cats', getCategoryName($db, substr($_POST['category'], 3)));
                echo getCategoryName($db, substr($_POST['category'], 3));
            }
        }
    
        else if(isset($_POST['remove'])) {
            if(strpos($_POST['remove'], 'brd') === 0) {
                $id = substr($_POST['remove'], 3);
                $index = array_search($id, $_SESSION['brands']);
                if ($index !== false) {
                    unset($_SESSION['brands'][$index]);
                    $_SESSION['brands'] = array_values($_SESSION['brands']);
                    removeFilter($db, 'brd' . $id);
                }
            }
            else if(strpos($_POST['remove'], 'sz') === 0) {
                $id = substr($_POST['remove'], 2);
                $index = array_search($id, $_SESSION['sizes']);
                if ($index !== false) {
                    unset($_SESSION['sizes'][$index]);
                    // Re-index the array to maintain continuous indices
                    $_SESSION['sizes'] = array_values($_SESSION['sizes']);
                    removeFilter($db, 'sz' . $id);
                }
            }
            else if(strpos($_POST['remove'], 'cond') === 0) {
                $id = substr($_POST['remove'], 4);
                $index = array_search($id, $_SESSION['conditions']);
                if ($index !== false) {
                    unset($_SESSION['conditions'][$index]);
                    // Re-index the array to maintain continuous indices
                    $_SESSION['conditions'] = array_values($_SESSION['conditions']);
                    removeFilter($db, 'cond' . $id);
                }
            }
            else if($_POST['remove'] == 'price') {
                unset($_SESSION['price']);
                removeFilter($db, 'price');
            }
            else if($_POST['remove'] == 'search') {
                unset($_SESSION['search']);
                removeFilter($db, 'search');
            }
            else if($_POST['remove'] == 'cats') {
                unset($_SESSION['category']);
                removeFilter($db, 'cats');
            }
        }

        else if(isset($_POST['reset'])) {
            $_SESSION['brands'] = array();
            $_SESSION['sizes'] = array();
            $_SESSION['conditions'] = array();
            $_SESSION['price'] = '';
            $_SESSION['search'] = '';
            $_SESSION['category'] = '';
            foreach(getApplied($db) as $filter) {
                removeFilter($db, $filter['id']);
            }
        }
    }

