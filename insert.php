<?php
$con=mysqli_connect("localhost", "yipja", "messyboat88", "yipja_padlet");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
?>

<?php
include_once 'header.php';
?>

<?php
/*User Query* /
/*SELECT user_id, username FROM users*/
if (isset($_SESSION["user_id"])) {
    $this_username_query = "SELECT user_id, username FROM users 
                            WHERE user_id = '" . $_SESSION["user_id"] . "'";
    $this_username_result = mysqli_query($con, $this_username_query);
}

/*Tag Query*/
/*SELECT country_id, country FROM countries*/
$all_tag_query = "SELECT tag_id, tag FROM tags";
$all_tag_result = mysqli_query($con, $all_tag_query);
?>

<main>
    <h2> Add post </h2>
    <div class="insert-form">
        <!--- Add post form --->
        <form method='post' action='process_insert.php'>
            <!--- Show username --->
            <label> Username: </label><br>
            <select id="userid" name="UserId">
                <?php
                while($this_username_record=mysqli_fetch_assoc($this_username_result)){
                    echo"<option value='".$this_username_record['user_id']."'>";
                    echo $this_username_record['username'];
                    echo"</option>";
                }
                ?>
            </select>
            <br>

            <!--- Ask tag (drop-down) --->
            <label> Tag: </label><br>
            <select id='tag' name='Tag' class='choice'>
                <!--- tag options --->
                <?php
                while($all_tag_record=mysqli_fetch_assoc($all_tag_result)){
                    echo"<option value='".$all_tag_record['tag_id']."'>";
                    echo $all_tag_record['tag'];
                    echo"</option>";
                }
                ?>
            </select><br>

            <!--- Ask post title --->
            <label> Title: </label><br>
            <input type="text" name="Title"><br>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "longtitle") {
                    echo "<h4> Title can't exceed 100 characters. </h4>";
                }
            }
            ?>


            <!--- Ask post content --->
            <label> Content: </label><br>
            <div class="content-container">
                <textarea type="text" id="content" name="Content" rows="2" cols="25" placeholder = "Type something here.."></textarea>
                <h4 id="result"></h4>
            </div>

            <!--Script-->
            <!-- live character counter adapted from Youtube video -->
            <!-- title: Limit Character In Input Field | HTML, CSS And Javascript -->
            <!-- channel: Coding Artist -->
            <!-- link: https://youtu.be/Tfvlu1NSXek -->
            <script>
                var myText = document.getElementById("content");
                var result = document.getElementById("result");
                var limit = 2000;
                result.textContent = 0 + "/" + limit;

                myText.addEventListener("input", function(){
                    var textLength = myText.value.length;
                    result.textContent = textLength + "/" + limit;

                    if(textLength < limit){
                        myText.style.borderColor = "#b2b2b2";
                        result.style.color = "#737373";
                    } else {
                        myText.style.borderColor = "#AE2012";
                        result.style.color = "#AE2012";
                    }
                });
            </script>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "longcontent") {
                    echo "<h4> Content can't exceed 2000 characters. </h4>";
                }
            }
            ?>

            <input class="btn-1 var-1" type='submit' name="submit" id="submit" value='Insert'>
        </form>
        <!--- Add post form --->
    </div>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<h4> Fill in all fields! </h4>";
        }
        else if ($_GET["error"] == "none") {
            echo "<h4> Posted! </h4>";
        }
    }
    ?>
</main>