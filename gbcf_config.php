<?php if(@$lock != "on"){echo('<h2>'.CONFIG_ACCCESS_NOT_ALLOWED.'</h2>');exit();} ?>

<?php 

include("config/connect.php");

// Enter your email address

    $gb_email_address=        "$adminemailadd"; 



// Enter your name or company

    $gb_contact_name=         "Support"; 



// Set site/form possession

    $gb_possession=           "org";                   // "pers"; or "org";



// Enter website name

    $gb_website_name=         "$SITE_NM";



// Enter time offset if needed

    $time_offset=             "0";                      // "+1"; "-1"; etc





################################################################################

// FORM AND CONTACT CONFIG PART 2 of 8 - "Contact Reason" menu        (OPTIONAL)

// Add as many pull-down menu options you want or need. Follow the pattern 

$gb_options = array( ###########################################################





    "Business Relations",

    "Support",

    "General Question",

    "Report a site problem",

    "Other (explain below)",





);##############################################################################

// RANDOM QUESTIONS CONFIG PART 3 of 8 - "Anti-Spam" q/a options      (OPTIONAL) 

// Change question/answer now and then, make your own or choose from the list

################################################################################





// Enter a simple to anser question and answer

    $gb_randomq=     "Is fire hot or cold?";

      $gb_randoma=   "hot";                     // Case insensitive





/*

    $gb_randomq=    "What color is the sky?";   // Example question

    $gb_randoma=    "blue";                     // Example answer

      $gb_randomq=    "What color is grass?";

      $gb_randoma=    "green"; 

    $gb_randomq=    "Two plus two equals?";

    $gb_randoma=    "four"; 

      $gb_randomq=    "What color is the mars?";

      $gb_randoma=    "red";                                         

    $gb_randomq=    "Spell SPAM backwards";

    $gb_randoma=    "maps"; 

      $gb_randomq=    "Is water wet or dry?";

      $gb_randoma=    "wet"; 

    $gb_randomq=    "Monkeys eat what?";

    $gb_randoma=    "bananas"; 

      $gb_randomq=    "Anteaters eat what?";

      $gb_randoma=    "ants"; 

    $gb_randomq=    "Spell team backwards";

    $gb_randoma=    "meat"; 

      $gb_randomq=    "Spell smart backwards";

      $gb_randoma=    "trams"; 

*/





################################################################################

// FORM AND CONTACT CONFIG PART 4 of 8 - Heading options              (OPTIONAL)

################################################################################





// Set heading size        

    $gb_heading=              "2";                // Use 1-6 (1 is largest)



// Enter your error heading

     $error_heading=          "Whoops! Error Made!"; 



// Enter your success heading

     $success_heading=        "Success! Mail Sent!";





################################################################################

// FORM AND CONTACT CONFIG PART 5 of 8 - Other config options         (OPTIONAL)

################################################################################



// Choose XHTML or HTML 

     $x_or_html=              "xhtml";            // or "html";



// Enter your button text

     $send_button=            "Submit Form";



// Enter credit link option

     $showcredit=             "no";              // or "no"; 



// Enter privacy link option

     $showprivacy=            "yes";              // or "no"; 



// Enter privacy link url

     $privacyurl=             "privacy.php";



// Choose to allow/disallow CC option

    $show_cc=                 "yes";                      // or "no";





################################################################################

// FORM AND CONTACT CONFIG PART 6 of 8 - Custom tabindex assignments  (OPTIONAL)

################################################################################





// Enter your preferred tabinxes

     $tab_privacy=            "0"; // Leave 0 if privacy link not enabled

     $tab_name=               "0";

     $tab_email=              "0";

     $tab_phone=              "0";

     $tab_url=                "0";

     $tab_reason=             "0";

     $tab_message=            "0";

     $tab_spam=               "0";

     $tab_why=                "0";

     $tab_cc=                 "0";  // Leave 0 if CC option is disallowed

     $tab_submit=             "0";





################################################################################

// FORM AND CONTACT CONFIG PART 7 of 8 - IP Blacklist                 (OPTIONAL)

// Block IPs ONLY if necessary - Enter between quotes - Example:  "00.00.00.00",

$ip_blacklist = array( #########################################################





     "",

     "",

     "",

     



); ##############################################################################

// FORM AND CONTACT CONFIG PART 8 of 8 - Form location specification  (OPTIONAL)

// IF you have a problem with the form giving referrer mismatch errors or spam 

// trap errors during testing, it may be due to its location. If so, enter your

// form URL below and comment out the string shown by putting // in front of it

################################################################################



$form_location= "http://".$_SERVER['HTTP_HOST']."".@$_SERVER['REQUEST_URI']."";



############################################################################# ?> 