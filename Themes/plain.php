<?php
    //error_reporting(E_ALL & ~E_NOTICE); # Notice: Use of undefined constant   - assumed ' ' in /home/theel0ja/dev/Themes/default.php on line 21 & 33
    # just for debug ^

    function FoodList($data) {
        foreach($data as $food) {
            echo $food . "<br />";
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo _("Week's School Meal"); ?> - <?php echo $data["name"]; ?></title>
        
        <style>
            /* W3.CSS 2.89 Jan 2017 by Jan Egil and Borge Refsnes */
            /* Modified for Viikon kouluruoka "Plain" theme by Elias Ojala (github.com/theel0ja) */
            html{box-sizing:border-box}*,*:before,*:after{box-sizing:inherit}
            html,body{font-family:Verdana,sans-serif;font-size:15px;line-height:1.5}html{overflow-x:hidden}
            h1,h2,h3,h4,h5,h6{font-family:"Segoe UI",Arial,sans-serif}
            h1{font-size:36px}h2{font-size:30px}h3{font-size:24px}h4{font-size:20px}h5{font-size:18px}h6{font-size:16px}
            h1,h2,h3,h4,h5,h6{font-weight:400;margin:10px 0}
            h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{font-weight:inherit}
        </style>
    </head>
    <body>
        <h1><?php echo $data["name"]; ?></h1>
        <?php
            if( count($data["menu"]) == 0 ) {
                echo _("No days to show.");
            } else {
                for($day = 0; $day <= count($data["menu"]) -1; $day++) {
                    
                    $dayOfWeek = $day + 1;
                    $dayOfWeekNow = date("N");
                        
                    echo "\n\n";
                    
                    if(isset($data["menu"]["$day"]["lunch"])) {
                ?>
                    <div class="day-<?php echo $dayOfWeek; if($dayOfWeek == $dayOfWeekNow) { echo " current-day"; } ?>">
                        <h3>
                            <?php $unixTime = strtotime($data["menu"]["$day"]["date"]); ?>
                            <?php echo strftime("%A", $unixTime) . " " . date("d.n.", $unixTime); ?>
                        </h3>
                        
                        <?php if(isset($data["menu"]["$day"]["lunch"]["food"])) { ?>
                            <h4><?php echo _("Lunch"); ?></h4>
                            <?php FoodList($data["menu"]["$day"]["lunch"]["food"]); ?>
                        <?php } ?>

                        <?php if(isset($data["menu"]["$day"]["vegetarian_lunch"]["food"])) { ?>
                            <h4><?php echo _("Vegetarian Lunch"); ?></h4>
                            <?php FoodList($data["menu"]["$day"]["vegetarian_lunch"]["food"]); ?>
                        <?php } ?>

                        <?php if(isset($data["menu"]["$day"]["after_school_activity"]["food"])) { ?>
                            <h4><?php echo _("After-school activity snack"); ?></h4>
                            <?php FoodList($data["menu"]["$day"]["after_school_activity"]["food"]); ?>
                        <?php } ?>
                    </div>
                <?php
                    }
                }
            }
            ?>
    </body>
</html>