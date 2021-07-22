<?php
session_start();
session_unset();
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="styleab.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="video.js"></script>
</head>
<body>
    <?php require '../partial/nav.php';?>
    <section class="about">
        <div class="content">
            <h2 style="margin-bottom: 5%; font-size: 50px; color: aliceblue;">About Us</h2>
            <p style=" color: aliceblue;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est, ut quis nobis sed asperiores ex sequi <br> reprehenderit velit tempora. Doloribus est eum consequuntur quam consectetur repellendus possimus rerum odit voluptatum.</p>
        </div>
        <div class="container">
            <div class="video">
                <video id="vid" width="520" height="340">
                    <source src="./movie.mp4" type="video/mp4">
                    <source src="./movie.mp4" type="video/ogg">
                    Your browser does not support HTML5 video.
                    </video>

                    <button onclick="playVid()" id="pla" type="button"><i class="fa fa-play" aria-hidden="true"></i></button>
                    <button onclick="pauseVid()" id="paus"><i class="fa fa-pause" aria-hidden="true"></i></button>
                    <button onclick="fullscreen()" id="fullscreen"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>
            </div>
            <div class="content">
                <p >Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est, ut quis nobis sed asperiores ex sequi <br> reprehenderit velit tempora. Doloribus est eum consequuntur quam consectetur repellendus possimus rerum odit voluptatum.</p>
            </div>
        </div>
    </section>

    <section class="team" >
        <h2 class="te">Our Team</h2>
        <div class="container1" >
            <div class="box">
                <img src="./sourabh.PNG" alt="" srcset="">
                <p>Sourabh Kshirsagar</p>
                <p>Web devloper</p>
            </div>
            <div class="box">
                <img src="./Shubham_crop.jpg" alt="" srcset="">
                <p>Shubham Verma</p>
                <p>Web devloper</p>
            </div>
            <div class="box">
                <img src="./geeta.jpg" alt="" srcset="">
                <p>Geeta Kolte</p>
                <p>Web Devloper</p>
            </div>
            <div class="box">
                <img src="./shreya.jpg" alt="" srcset="">
                <p>Shreya Vishwakarma</p>
                <p>Web devloper</p>
            </div>

        </div>
    </section>
    <div id="mapid">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3772.669319342292!2d73.12548141523102!3d18.99020605959763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7e866de88667f%3A0xc1c5d5badc610f5f!2sPillai%20College%20of%20Engineering%2C%20New%20Panvel!5e0!3m2!1sen!2sin!4v1604594607554!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <p class="foot">© Copyright 2020</p>
</body>
</html>