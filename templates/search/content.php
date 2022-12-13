<?php
if (isset($_SESSION["search_input"])) {
    $user_rows = $_SESSION["SResult_U"];
    $user_count = $_SESSION["SResult_U_rowcount"];

    $post_rows = $_SESSION["SResult_P"];
    $post_count = $_SESSION["SResult_P_rowcount"];

    //output the title
    $search_input = $_SESSION["search_input"];
    $str = "Result for Searching: ";
    foreach ($search_input as $input) {
        $str .= "'$input'+";
    }
    ?>
<section id="search-content" class="container py-3 px-5">
    <?php
    $str = rtrim($str, "+");
    echo "<h1>$str</h1><br>";
    //display search result from user table
    if ($user_count>0) {
        echo"<h2><b>Your Searching Result From User...</b></h2><br>";
        foreach ($user_rows as $user_row) {
            if ($user_row["icon"] == "") {
                $icon = "../static/images/icon/person-circle-dark.svg";
            } else {
                $icon = "../static/images/user/icon/".$user_row["icon"];
            }
            if (strlen($user_row["about"])>60) {
                $about = substr($user_row["about"], 0, 60);
                $about .="...";
            } else {
                $about=$user_row["about"];
            }
            $about = filter_var($about, FILTER_SANITIZE_STRING);
            $user_link = "./search/searchconnection.php?user=".$user_row["id"];
            //echo "<a href='./search/searchconnection.php?user=$Prow[id]'>$Prow[name]</a><br>";
            ?>
    <a href=<?=$user_link?>>
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center pb-1">
                        <img src="<?=$icon?>" alt="avatar" width="25" height="25" />
                        <p class="card-title m-2"><b><?=$user_row["name"]?></b></p>
                    </div>
                </div>
                <p class="p-2"><?=$about?></p>
            </div>
        </div>
    </a>
    <?php
        }
    }
    echo"<br>";
    if ($post_count>0) {
        echo"<h2><b>Your Searching Result From Post...</b></h2><br>";
        foreach ($post_rows as $Prow) {
            //echo "<a href='./search/searchconnection.php?post=$Prow[id]'>$Prow[title]</a><br>";
            if ($Prow["picture"] == "") {
                $icon = "../static/images/icon/person-circle-dark.svg";
            } else {
                $icon = "../static/images/blog_post/post/".$Prow["picture"];
            }
            if (strlen($Prow["description"])>60) {
                $about = substr($Prow["description"], 0, 60);
                $about .="...";
            } else {
                $about=$Prow["description"];
            }
            $about = filter_var($about, FILTER_SANITIZE_STRING);
            $post_link = './search/searchconnection.php?post='.$Prow["id"];
            //echo "<a href='./search/searchconnection.php?user=$Prow[id]'>$Prow[name]</a><br>";
            ?>
    <a href=<?=$post_link?>>
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center pb-1">
                        <img src="<?=$icon?>" alt="picture" width="60" />
                        <div>
                            <p class="card-title m-2"><b><?=$Prow["title"]?></b></p>
                            <p class="p-2"><?=$about?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <?php
        }
    }
    if ($post_count==0&&$user_count==0) {
        echo"<h1><b>Sorry, there is no result for your keyword...</b></h1><br>";
    }
} else {
    ?>
    <script>
    window.location.href = "./index.php";
    </script>
    <?php
}
?>
</section>