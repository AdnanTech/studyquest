<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style/normalize.css">
<style>

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

/* Add a black background color to the top navigation */
#navbar {
  background-color: #020c1b;
  overflow: hidden;
  font-family: Bahnschrift;
  font-weight: bold;
}

/* Style the links inside the navigation bar */
#navbar a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 25px;
  text-decoration: none;
  font-size: 17px;
  margin-right: 50px;
}


#navbar a:hover {color: cornflowerblue;}

.spacer
{
    width: 100%;
    height: 49px;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden; 
}
  
nav ul li{
    display: inline;
    font-weight: bold;
}
  
nav ul li a {
    margin: 1em 4em;
    text-decoration: none;
}
  

</style>
</head>

<body>
    <div id="navbar">
        <a href="/studyquest.php">Play Now!</a>  
        <a href="/blog.php">Developer Blog</a>
        <a href="/forum/index.php">Forum</a>
        <a href="/index.php">Home</a>
    </div> 
    <div class="spacer">
        &nbsp;
    </div>

<script>
    window.onscroll = function() {stickyFunction()};
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function stickyFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        }
    } 
</script>
</body>
</html> 
