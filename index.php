<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivinDream</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #9400D3;
            color: #333;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(25, 25, 112, 0.8);
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content {
            display: flex;
            align-items: center;
        }

        .logo {
            margin-right: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            position: relative;
        }

        nav ul li a:hover {
            color: #FFFF00;
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #FFFF00;
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out;
        }

        nav ul li a:hover::after {
            visibility: visible;
            transform: scaleX(1);
        }

        h1{
            font-family: 'Courier New', Courier, monospace;
        }

        main {
            padding: 20px;
        }

        section {
            background-color: rgb(255, 255, 255, 0.9);
            padding: 20px;
            margin-top: 80px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        footer {
            background-color: rgba(51, 51, 51, 0.4);
            color: #fff;
            padding: 20px;
            text-align: center;
            bottom: 0;
            width: 100%;
            position: fixed;
        }
    </style>
</head>

<body>
<header>
    <div class="header-content">
        <img src="Logo.jpeg" alt="Logo Toko" width="50" height="50" class="logo"> 
        <h1>LivinDream</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=products">Products</a></li>
            <li><a href="index.php?page=about">About</a></li>
        </ul>
    </nav>
</header>

<main>
<?php
class Page {
    protected $pageName;

    public function __construct() {
        $args = func_get_args();
        $numArgs = func_num_args();

        if ($numArgs == 1) {
            $this->pageName = $args[0];
        } else {
            echo "Invalid number of arguments for constructor!";
        }
    }

    public function display() {
        switch ($this->pageName) {
            case 'home':
                include 'home.php';
                break;
            case 'products':
                include 'products.php';
                break;
            case 'about':
                include 'about.php';
                break;
            default:
                include 'home.php';
                break;
        }
    }

    public function __destruct() {
        if ($this->pageName === 'products' && $this->isStaplerDisplayed()) {
            echo "Objek Page dengan nama {$this->pageName} telah dihancurkan.<br>";
        }
    }

    private function isStaplerDisplayed() {
        ob_start();
        include 'products.php';
        $output = ob_get_clean();
        return strpos($output, '<strong>Stapler:</strong>') !== false;
    }
}

class CustomPage extends Page {
    public function display() {
        switch ($this->pageName) {
            case 'home':
                echo '<section>';
                echo '<h2>Selamat datang di toko kami!</h2>';
                echo '<p>Temukan alat tulis impianmu.</p>';
                echo '</section>';
                break;
            case 'products':
                parent::display();
                echo '<section>';
                echo '<h2>New Arrivals</h2>';
                echo '<ul>';
                echo '<li><strong>Selotip</strong> Berbagai jenis dan warna</li>';
                echo '<li><strong>Buku </strong> Berbagai ukuran dan desain</li>';
                echo '</ul>';
                echo '</section>';
                break;
            default:
                parent::display();
                break;
        }
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $currentPage = new Page($page);
$currentPage = new Page($page);
$additionalContent = isset($_GET['additionalContent']) ? true : false;

$currentPage->display($additionalContent);
?>
</main>

<footer>
    <p>&copy; 2024 LivinDream Shop. All rights reserved.</p>
</footer>
</body>
</html>