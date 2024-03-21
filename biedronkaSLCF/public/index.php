<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biedronka Grocery Store - Home</title>
    <link rel="stylesheet" href="style.css">
    <style>
        

        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        .category-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .category {
            flex-basis: calc(33.333% - 20px);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            margin: 10px;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 4px;
        }

        .category:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,.2);
        }

        .main-content {
            padding: 20px;
        }

        
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    

    <div class="main-content">
    
        <div class="slideshow-container">
            
            <div class="mySlides fade">
                <img src="slide1.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="slide2.jpg" style="width:100%">
            </div>
            <div class="mySlides fade">
                <img src="slide3.jpg" style="width:100%">
            </div>
            
            <div style="text-align:center">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
        </div>

        
        <div class="category-container">
            
            <div class="category">Fruits & Vegetables</div>
            <div class="category">Dairy & Eggs</div>
            
        </div>
    </div>

    <?php include 'footer.php'; ?>
    
    <script src="js/script.js"></script>
</body>
</html>
