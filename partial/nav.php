<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,300;1,600&display=swap");

@font-face {
  font-family: "Kaushanscript";
  src: url("Fonts/Kaushan_Script/KaushanScript-Regular.ttf");
}

* {
  margin: 0;
  padding: 0;
  text-decoration: none;
  list-style: none;
  box-sizing: border-box;
}

::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-thumb {
  background: rgba(0, 0, 0, 0.6);
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(0, 0, 0, 0.8);
}
body {
  overflow-x: hidden;
  /* background-image: linear-gradient(300deg, #10bbce, #42d7e7); */
  height: 100%;
  width: 100%;
  scroll-behavior: smooth;
}

nav.navigation {
  top: 0;
  width: 100%;
  display: grid;
  grid-template-columns: 5% 1fr 2fr 1fr;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.8);
}
nav.navigation span.logo {
  font-size: 3vw;
  grid-column: 2;
  padding-top: 0vh;
  font-family: "Kaushanscript";
  text-decoration: none;
  color: white;
  user-select: none;
}

nav.navigation ul {
  grid-column: 4;
  display: flex;
  flex-direction: row;
  list-style: none;
  text-decoration: none;
}
nav.navigation ul li {
  padding-right: 2vw;
  padding-top: 0vh;
}

nav.navigation ul li a {
  font-size: 1.1vw;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  /* font-family: "Josefin Sans", sans-serif; */
  color: white;
  user-select: none;
}

nav.navigation ul li a::after {
  content: "";
  display: block;
  background: white;
  width: 0px;
  height: 2px;
  transition: all 1s;
}
nav.navigation ul li a:hover::after {
  width: 100%;
  background: #009fdf;
  transition: all 1s;
}
    </style>
</head>
<body>
<header>
            <nav class="navigation">
            <span class="logo">PATMAN</span>
            <ul>
                <li>
                    <a href="../../PatMan/index.html">Home</a>
                </li>
                <li>
                    <a href="../map/about.php">About Us</a>
                </li>
                <li>
                    <a href="../map/contact.php">Contact Us</a>
                </li>
                <!-- <li>
                    <a href="#">Logout</a>
                </li> -->
            </ul>
        </nav>
</header>

</body>
</html>
