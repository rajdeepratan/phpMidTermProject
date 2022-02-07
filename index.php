<?php
    include_once "./phpFunction/functionProducts.php";

    pageTop("Index");
?>



<?php
    $myarray = array(COLLOCATION1,COLLOCATION2,COLLOCATION3,COLLOCATION4,COLLOCATION5);
    shuffle($myarray);
?>
    <div class="home-page">
        <div class="mt-5 d-flex justify-content-between align-items-center">
            <div class="me-3">
                <a href="#">
                    <img class="<?php echo $myarray[0] =='assets/images/collocation-1.jpeg'? "red-border" : "" ?>" alt="advertising" src="<?php echo $myarray[0]; ?>">
                </a>
            </div>
            <div class="text-center">
                <h2>Style Yard</h2>
                <p>
                    Style Yard, India’s no. 1 online fashion destination justifies its fashion relevance by bringing something new and chic to the table on the daily. Fashion trends seem to change at lightning speed, yet the Style Yard shopping app has managed to keep up without any hiccups. In addition, Style Yard has vowed to serve customers to the best of its ability by introducing its first-ever loyalty program, The Style Yard Insider. Gain access to priority delivery, early sales, lucrative deals and other special perks on all your shopping with the Style Yard app. Download the Style Yard app on your Android or IOS device today and experience shopping like never before!
                </p>
            </div>
        </div>
    </div>

<?php

    pageBottom();
?>
