<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
include_once 'header.php';
?>

<main class="main-about">
    <!--Hero
    <section class="hero-about">
        <div class="about">
            <h1>What is YNot?</h1>
            <p>YNot is a platform for young people to share their stories, resources, advice, and opportunities
            regarding education, leadership, entrepreneurship, internship, and more.</p>
        </div>
    </section> -->

    <div class="about-banner">
        <div class="about-inner">
            <div class="about-img">
                <img class="graphics" src="assets/teens.png">
            </div>

            <div class="about-content">
                <h1>What is YNot?</h1>
                <p>The ideation of YNot was inspired by the mathematical symbol <i class="symbol">y<sub>0</sub> </i>.
                   'Y' also stands for youth, as YNot targets teenagers from 14-22 who are expected by the society
                   to work low-skills low-income jobs that are likely unrelated to their career. <br><br>Asking the question
                    "Why not?" allows us to think outside of the box. Founding a youth magazine at the age of thirteen?
                    Why Not? Getting involved in politics and petitioning for legal captioning standards as an 18-year-old? Why Not?
                    These examples are true stories of inspiring teens in Aotearoa.
                </p>
            </div>
        </div>
    </div>

    <div class="about-banner f">
        <div class="about-inner f">
            <div class="about-content f">
                <h1>The YNot Forum.</h1>
                <p>The YNot Forum is where you can connect with all the passionate young people across Aotearoa.
                    You can look for all sorts of volunteering and leadership opportunities here. We are currently
                    developing a comment and upvote feature where you can interact with other users.
                </p>
            </div>

            <div class="about-img f">
                <img class="compscreen" src="assets/stories.png">
            </div>
        </div>
    </div>

    <div class="about-banner">
        <div class="about-inner">
            <div class="about-img">
                <img class="phonescreen" src="assets/2phones.png">
            </div>

            <div class="about-content">
                <h1>Join YNot Today.</h1>
                <p>Sign up today to join the continuously  growing YNot tribe! We would love to have you on board
                    with us on our early journey of career exploration. <br><br>
                    The benefits of becoming a YNot member inlcudes
                    getting first hand information on leadership opportunities, getting exclusive tips on acing your next
                    interview, and take part in many thought-provoking discussions.
                </p>
            </div>
        </div>
    </div>
</main>