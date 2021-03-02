<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Projekat</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel ="stylesheet" href ="style.css">
    </head>
    <body>
        <div class="container">
            <header class="row">
                <div id="demo" class="carousel slide col-12" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ul>
                    <div class="carousel-inner">
                        <?php
                            $slike=scandir("images/");  
                            unset($slike[0]);
                            unset($slike[1]);
                            shuffle($slike);
                            echo"<div class='img-fluid carousel-item active'><img src='images/$slike[0]'></div>";
                            echo"<div class='img-fluid carousel-item'><img src='images/$slike[1]'></div>";
                            echo"<div class='img-fluid carousel-item'><img src='images/$slike[2]'></div>";
                        ?>
                    </div><!--end of carusel-inner -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div><!--end of demo -->
            </header>
                <nav class="mt-2">
                    <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                        <li class="nav-item d-inline-block col-12 col-sm-auto p-1">
                            <a class="nav-link active text-dark font-italic font-weight-bolder text-center p-0" data-toggle="tab" href="#home">Home</a>
                        </li>
                        <li class="nav-item d-inline-block col-12 col-sm-auto p-1">
                            <a class="nav-link text-dark font-italic font-weight-bolder text-center p-0" data-toggle="tab" href="#posao">Posao</a>
                        </li>
                        <li class="nav-item d-inline-block col-12 col-sm-auto p-1">
                            <a class="nav-link text-dark font-italic font-weight-bolder text-center p-0" data-toggle="tab" href="#zdravlje">Zdravlje</a>
                        </li>
                        <li class="nav-item d-inline-block col-12 col-sm-auto p-1">
                            <a class="nav-link text-dark font-italic font-weight-bolder text-center p-0" data-toggle="tab" href="#ljubav">Ljubav</a>
                        </li>
                        <li class="nav-item d-inline-block col-12 col-sm-auto p-1">
                            <a class="nav-link text-dark font-italic font-weight-bolder text-center p-0" data-toggle="tab" href="#motivacija">Motivacija</a>
                        </li>
                    </ul>
                </nav>
            <section class=" row tab-content">
                <div id="home" class="col-12 container tab-pane active"><br>
                    <h3 class="font-weight-bolder text-center text-sm-left">HOME</h3>
                    <?php
                        $posao =file("citati/posao.txt");
                        $zdravlje = file("citati/zdravlje.txt");
                        $ljubav = file("citati/ljubav.txt");
                        $motivacija = file("citati/motivacija.txt");
                        $lines = array_merge($posao,$zdravlje,$ljubav,$motivacija);
                        $random = rand(0,count($lines)-1);
                        $citat ="";
                        $autor ="";
                        $error ="";
                        if($random > count($lines)-1){
                            $error = "Doslo je do greske";
                        }
                        if($random % 2 != 0){
                            $citat = $lines[$random -1];
                            $autor = $lines[$random];
                        }
                        if($random % 2 == 0){
                            $citat = $lines[$random];
                            $autor = $lines[$random+1];
                        }
                        echo "<p id='first-p' class=' text-center font-italic font-weight-bold lead'>$citat</p>";
                        echo "<p id='second-p' class='text-center mb-5'>$autor</p>";
                        echo "<p class='text-center mb-5'>$error</p>"; 
                    ?>
                </div>
                <div id="posao" class="col-12 container tab-pane fade"><br>
                    <h3 class="font-weight-bolder text-center text-sm-left">Posao</h3>
                    <?php
                        $linesP = file("citati/posao.txt");
                        $random = rand(0,count($linesP)-1);
                        $citat = "";
                        $autor = "";
                        $error = "";
                        if($random > count($linesP)-1){
                            $error = "Doslo je do greske";
                        }
                        if($random % 2 != 0){
                            $citat = $linesP[$random -1];
                            $autor = $linesP[$random];
                        }
                        if($random % 2 == 0){
                            $citat = $linesP[$random];
                            $autor = $linesP[$random+1];
                        }
                        echo "<p id='first-p' class=' text-center font-italic font-weight-bold lead'>$citat</p>";
                        echo "<p id='second-p' class='text-center mb-5'>$autor</p>";
                        echo "<p class='text-center mb-5'>$error</p>";
                    ?>
                </div>
                <div id="zdravlje" class="col-12 container tab-pane fade"><br>
                    <h3 class="font-weight-bolder text-center text-sm-left">Zdravlje</h3>
                    <?php
                        $linesZ = file("citati/zdravlje.txt");
                        $random = rand(0,count($linesZ)-1);
                        $citat ="";
                        $autor ="";
                        $error ="";
                        if($random > count($linesZ)-1){
                            $error = "Doslo je do greske";
                        }
                        if($random % 2 != 0){
                            $citat = $linesZ[$random -1];
                            $autor = $linesZ[$random];
                        }
                        if($random % 2 == 0){
                            $citat = $linesZ[$random];
                            $autor = $linesZ[$random+1];
                        }
                        echo "<p id='first-p' class=' text-center font-italic font-weight-bold lead'>$citat</p>";
                        echo "<p id='second-p' class='text-center mb-5'>$autor</p>";
                        echo "<p class='text-center mb-5'>$error</p>";
                    ?>
                </div>
                <div id="ljubav" class="col-12 container tab-pane fade"><br>
                    <h3 class="font-weight-bolder text-center text-sm-left">Ljubav</h3>
                    <?php
                        $linesL = file("citati/ljubav.txt");
                        $random = rand(0,count($linesL)-1);
                        $citat ="";
                        $autor ="";
                        $error ="";
                        if($random > count($linesL)-1){
                            $error = "Doslo je do greske";
                        }
                        if($random % 2 != 0){
                            $citat = $linesL[$random -1];
                            $autor = $linesL[$random];
                        }
                        if($random % 2 == 0){
                            $citat = $linesL[$random];
                            $autor = $linesL[$random+1];
                        }
                        echo "<p id='first-p' class=' text-center mt-5 font-italic font-weight-bold lead'>$citat</p>";
                        echo "<p id='second-p' class='text-center mb-5'>$autor</p>";
                        echo "<p class='text-center mb-5'>$error</p>";
                    ?>
                </div>
                <div id="motivacija" class="col-12 container tab-pane fade"><br>
                    <h3 class="font-weight-bolder text-center text-sm-left">Motivacija</h3>
                    <?php
                        $linesM = file("citati/motivacija.txt");
                        $random = rand(0,count($linesM)-1);
                        $citat ="";
                        $autor ="";
                        $error ="";
                        if($random > count($linesM)-1){
                            $error = "Doslo je do greske";
                        }
                        if($random % 2 != 0){
                            $citat = $linesM[$random -1];
                            $autor = $linesM[$random];
                        }
                        if($random % 2 == 0){
                            $citat = $linesM[$random];
                            $autor = $linesM[$random+1];
                        }
                        echo "<p id='first-p' class=' text-center font-italic font-weight-bold lead'>$citat</p>";
                        echo "<p id='second-p' class='text-center mb-5'>$autor</p>";
                        echo "<p class='text-center mb-5'>$error</p>";
                    ?>
                </div>
            </section>
            <footer class="row mt-5 w-100">
                <div class="fixed-bottom text-center cel-12">
                <?php
                setlocale(LC_TIME, 'SR');
                $dan = strftime('%A');
                $datum = date("d,m,Y, h:i");
                echo"<p id='footer-p'class='col-sm-12 col-12'> $dan, $datum</p>";
                ?>
                </div>
        </div>
    </body>
</html>