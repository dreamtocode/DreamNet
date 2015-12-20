<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 11/1/2015
 * Time: 7:31 AM
 */

require_once 'user.php';
require_once 'dictionary.php';
mb_internal_encoding('UTF-8');


$dictionary = new dictionary();

if(isset($_POST['registration_submit'])){

    $mobile = $_POST['mobile_prefix'].$_POST['mobile_sufix'];
    $DOB = $_POST['day']."-".$_POST['month']."-".$_POST['year'];

    $user = new user();

    $user->userRegistration($mobile, $_POST['user_name'], $_POST['lastname'], $_POST['personal_id'], $_POST['gender'], $DOB, $_POST['city'], $_POST['address'], $_POST['region'], $_POST['home_phone'], $_POST['email'], $_POST['password'], $_POST['secret_question'], $_POST['secret_answer']);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>gebuy.net</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <script type="text/javascript" src="JavaScript/main.js"></script>
</head>
<body>
<div class="header">
    <div class="main_wrapper">
        <div class="social_networks"><ul><a href="https://www.facebook.com/Gebuynet-119425195068511" target="_blank"><li class="facebook_logo"></li></a><a href="https://www.youtube.com/channel/UCH1xdbfyAxuF_cHqSB8jD1g" target="_blank"><li class="youtube_logo"></li></a><a><li class="instagram_logo"></li></a><a><li class="twitter_logo"></li></a></ul></div>

        <div class='user' id="user_block">
            <form method='post' action='index.php'>
                <?php

                require_once 'user.php';

                $userOB = new user();

                if(isset($_POST['login'])){

                    $userOB->userLogin($_POST['mobile'], $_POST['password']);
                }

                if(isset($_POST['logout'])){

                    $userOB->userLogout();
                }

                if(isset($_SESSION['id'])){

                    $id = $_SESSION['id'];
                    $user = $userOB->select('user_name, balance', 'users', "id = '$id'")->fetch_row();

                    echo "<input class='log_in_out' type='submit' name='logout' value='გამოსვლა'/><div class='balance'>ბალანსი: <b>$user[1] GEL</b></div><div class='name'>$user[0]</div><div class='cart'><img src='Images/Icons/cart.png'></div>";
                }

                else{

                    echo "<a href='registration.php'><div id='registration_button'>რეგისტრაცია</div></a><img class='registration_img' src='Images/Icons/registration.png'/><div id='autentication_button' onclick='autenticationBlock()'>შესვლა</div><img class='autentication_img' src='Images/Icons/login.png'>";

                }


                ?>
                <div class='autentication_block' id="autentication_block">
                    <img src='Images/Icons/pointer_top.png'/>
                    <div>
                        <input type='text' name='mobile' placeholder='Mobile'/>
                        <input type='password' name='password'/>
                        <a href=''>პაროლის აღდგენა</a>
                        <input type='submit' name='login' value='შესვლა'/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="main_wrapper" onmouseover="closeMenu()">
    <div class="logo_div">
        <a href="index.php"><img class="logo" src="Images/LOGO%20OLD.png"></a>
    </div>

    <?php

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    echo "<form method='post' action='$actual_link'><div class='search_div'>";

    ?>

    <input class="language_flag" id="language_flag" type="button" name="language_flag" onclick="changeLanguage()"/>
    <input class="search" id="search" type="text" name="search" placeholder="საძიებო სიტყვა" value="" onfocus="convertText()"/>
    <input class="search_button" type="submit" name="search_button" value=""/>
    <a href="catalogue.php"><input class="expanded_search" type="button" name="expanded_search" value="გაფართოებული ძიება"/></a>
    </form>
</div>
</div>


<?php $menu = file_get_contents('menu.txt'); echo $menu; ?>

<div class="registration" onmouseover="closeMenu()">
    <div class="main_wrapper">
        <form method="post" action="registration.php">

                <div class="block" style="background-color: #3aabee;">
                    <div class="form_wrapper">

                        <div class="registration_form_heading">
                            <img src="Images/Icons/personal_info.png"/>
                            <b>პირადი ინფორმაცია</b>
                        </div>
                        <div class="field_names">
                            <b>მობილურის ნომერი</b>
                            <b>სახელი ლათინურად</b>
                            <b>გვარი ლათინურად</b>
                            <b>პირადი ნომერი</b>
                            <b>სქესი</b>
                            <b>დაბადების თარიღი</b>
                        </div>

                        <div class="fields">

                            <div>
                                <select name="mobile_prefix" required="required" style="margin-right: 30px">
                                    <option value="599">599</option>
                                    <option value="598">598</option>
                                    <option value="597">597</option>
                                    <option value="596">596</option>
                                    <option value="595">595</option>
                                    <option value="593">593</option>
                                    <option value="592">592</option>
                                    <option value="591">591</option>
                                    <option value="577">577</option>
                                    <option value="574">574</option>
                                    <option value="571">571</option>
                                    <option value="570">570</option>
                                    <option value="568">568</option>
                                    <option value="559">559</option>
                                    <option value="558">558</option>
                                    <option value="557">557</option>
                                    <option value="555">555</option>
                                    <option value="551">551</option>
                                    <option value="514">514</option>
                                </select>
                                <input type="text" name="mobile_sufix" required="required" style="width: 190px"/>
                            </div>

                            <div>
                                <input type="text" name="user_name" required="required"/>
                            </div>

                            <div>
                                <input type="text" name="lastname" required="required"/>
                            </div>

                            <div>
                                <input type="text" name="personal_id" required="required"/>
                            </div>

                            <div>
                                <select name="gender" required="required" style="width: 120px">
                                    <option value="male">მამრობითი</option>
                                    <option value="female">მდედრობითი</option>
                                </select>
                            </div>

                            <div>
                                <select name="day" required="required">
                                    <option>დღე</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>

                                <select name="month" required="required" style="width: 100px">
                                    <option>თვე</option>
                                    <option value="01">იანვარი</option>
                                    <option value="02">თებერვალი</option>
                                    <option value="03">მარტი</option>
                                    <option value="04">აპრილი</option>
                                    <option value="05">მაისი</option>
                                    <option value="06">ივნისი</option>
                                    <option value="07">ივლისი</option>
                                    <option value="08">აგვისტო</option>
                                    <option value="09">სექტემბერი</option>
                                    <option value="10">ოქტომბერი</option>
                                    <option value="11">ნოემბერი</option>
                                    <option value="12">დეკემბერი</option>
                                </select>

                                <select name="year" required="required">
                                    <option>წელი</option>
                                    <option value="1997">1997</option>
                                    <option value="1996">1996</option>
                                    <option value="1995">1995</option>
                                    <option value="1994">1994</option>
                                    <option value="1993">1993</option>
                                    <option value="1992">1992</option>
                                    <option value="1991">1991</option>
                                    <option value="1990">1990</option>
                                    <option value="1989">1989</option>
                                    <option value="1988">1988</option>
                                    <option value="1987">1987</option>
                                    <option value="1986">1986</option>
                                    <option value="1985">1985</option>
                                    <option value="1984">1984</option>
                                    <option value="1983">1983</option>
                                    <option value="1982">1982</option>
                                    <option value="1981">1981</option>
                                    <option value="1980">1980</option>
                                    <option value="1979">1979</option>
                                    <option value="1978">1978</option>
                                    <option value="1977">1977</option>
                                    <option value="1976">1976</option>
                                    <option value="1975">1975</option>
                                    <option value="1974">1974</option>
                                    <option value="1973">1973</option>
                                    <option value="1972">1972</option>
                                    <option value="1971">1971</option>
                                    <option value="1970">1970</option>
                                    <option value="1969">1969</option>
                                    <option value="1968">1968</option>
                                    <option value="1967">1967</option>
                                    <option value="1966">1966</option>
                                    <option value="1965">1965</option>
                                    <option value="1964">1964</option>
                                    <option value="1963">1963</option>
                                    <option value="1962">1962</option>
                                    <option value="1961">1961</option>
                                    <option value="1960">1960</option>
                                    <option value="1959">1959</option>
                                    <option value="1958">1958</option>
                                    <option value="1957">1957</option>
                                    <option value="1956">1956</option>
                                    <option value="1955">1955</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="form_wrapper">

                        <div class="registration_form_heading">
                            <img src="Images/Icons/contact_info.png"/>
                            <b>საკონტაქტო ინფორმაცია</b>
                        </div>

                        <div class="field_names">
                            <b>ქალაქი</b>
                            <b>მისამართი</b>
                            <b>რაიონი თბილიში</b>
                            <b>ტელეფონის ნომერი</b>
                            <b>ელ-ფოსტა</b>
                        </div>

                        <div class="fields">

                            <div>
                                <select name="city" required="required" style="width: 310px">
                                    <option value="თბილისი">თბილისი</option>
                                    <option value="ბათუმი">ბათუმი</option>
                                    <option value="ქუთაისი">ქუთაისი</option>
                                </select>
                            </div>

                            <div>
                                <input type="text" name="address" required="required"/>
                            </div>

                            <div>
                                <input type="text" name="region" required="required"/>
                            </div>

                            <div>
                                <input type="text" name="home_phone" required="required"/>
                            </div>

                            <div>
                                <input type="email" name="email" required="required"/>
                            </div>


                        </div>

                    </div>

                    <div class="form_wrapper">

                        <div class="registration_form_heading">
                            <img src="Images/Icons/security.png"/>
                            <b>დამცავი ინფორმაცია</b>
                        </div>

                        <div class="field_names">
                            <b>პაროლი</b>
                            <b>გაიმეორეთ პაროლი</b>
                            <b>საიდუმლო კითხვა</b>
                            <b>საიდუმლო პასუხი</b>
                        </div>

                        <div class="fields">

                            <div>
                                <input type="password" name="password" required="required"/>
                            </div>

                            <div>
                                <input type="password" name="confirm_password" required="required"/>
                            </div>

                            <div>
                                <select name="secret_question" required="required" style="width: 310px">
                                    <option></option>
                                    <option value="pet">რა ერქვა თქვენ საყვარელ შინაურ ცხოველს?</option>
                                    <option value="book">რა ქვია თქვენ საყვარელ წიგნს?</option>
                                </select>
                            </div>

                            <div>
                                <input type="text" name="secret_answer" required="required"/>
                            </div>

                        </div>

                    </div>

                    <!--<div class="form_wrapper">

                        <div class="registration_form_heading">
                            <img src="Images/LOGO%20OLD.png"/>
                            <b>დამატებითი ინფორმაცია</b>
                        </div>

                        <div class="field_names" style="float: left">
                            <b style="font-size: 13px;">სად შეიტყვეთ ჩვენ შესახებ?</b>
                            <b>კომენტარი</b>
                        </div>

                        <div class="fields">

                            <div>
                                <input type="text" name="from_where"/>
                            </div>

                            <div style="height: auto;">
                                <textarea name="comment"></textarea>
                            </div>

                        </div>

                    </div>-->


                </div>


                <div class="block" style="height:1250px;">

                        <div class="form_rules" style="height:1250px;">
                            <p style="text-align: center;"><strong><em>საჯარო ოფერტი</em></strong></p>
                            <p><strong><em>&nbsp;</em></strong></p>
                            <p style="text-align: justify;"><strong><em>საჯარო ოფერტი არის შეთავაზება გამყიდველის საქონლის შეძენის შესახებ, რომელიც განთავსებულია შუამავლის ვებ-გვერდზე და წარმოადგენს შეთავაზებას ვებ-გვერდის მომხმარებლებისადმი.</em></strong></p>
                            <p style="text-align: justify;"><strong><em>ხელშეკრულების დადების სრულ და უპირობო თანხმობად (შემდგომში &Prime;აქცეპტი&Prime;) ითვლება შუამავლის ვებ-გვერდზე </em></strong><a href="http://www.gebuy.net" target="_blank">www.gebuy.net</a><strong><em> რეგისტრაცია. ხელშეკრულების აქცეპტი ნიშნავს, რომ მომხმარებელი/მყიდველი ეთანხმება შემოთავაზების ყველა პირობასა და განსაზღვრებას. აქცეპტი ხელშეკრულების (თავისი დანართებით)&nbsp; დადების ტოლფასია.&nbsp;თუ თქვენ არ ეთანხმებით ამ პირობებს, უნდა შეწყვიტოთ ვებ-გვერდითა და ჩვენი მომსახურებით სარგებლობა.</em></strong></p>
                            <p style="text-align: justify;">&nbsp;</p>
                            <p style="text-align: justify;">წინამდებარე ხელშეკრულება იდება ფიზიკურ ან იურიდიულ პირს (შემდგომში &Prime;მომხმარებელი&Prime;/&Prime;მყიდველი&Prime;), რომელიც რეგისტრირდება ვებ-გვერდზე&nbsp;<a href="http://www.gebuy.net" target="_blank">www.gebuy.net</a>&nbsp;(შემდგომში &Prime;ვებ-გვერდი&Prime;)&nbsp;და შპს &Prime;ჯიბაი&Prime;-ს (შემდგომში &Prime;შუამავალი&Prime;) შორის, რომელიც&nbsp; არის იმ პირის (შემდგომში &Prime;გამყიდველი&Prime;) შუამავალი, რომელიც მითითებულია ამ ხელშეკრულების დანართში.&nbsp; შუამავალი მოქმედებს&nbsp;გამყიდველის სახელით. ხელშეკრულება იდება შემდეგზე:</p>
                            <p style="text-align: center;"><strong><em>მომხმარებლის ანგარიში და პროფილი</em></strong></p>
                            <p style="text-align: justify;">ვებ-გვერდით&nbsp;<a href="http://www.gebuy.net" target="_blank">www.gebuy.net</a>&nbsp;სარგებლობისათვის მომხმარებელი ვალდებულია დარეგისტრირდეს შუამავალთან ანგარიშის გახსნის მეშვეობით. მომხმარებელი იღებს ვალდებულებას ვებ-გვერდზე რეგისტრაციისას წარადგინოს მხოლოდ ზუსტი და სრული სარეგისტრაციო ინფორმაცია და მოახდინოს ამ ინფორმაციის განახლება მისი ცვლილების შემთხვვაში. დარეგისტირებისას მომხმარებელი იღებს ინდივიდუალურ მანდატს სისტემაში ავტორიცაზიისათვის (მომხმარებლის სახელი და პაროლი), რომელიც განკუთვნილია მხოლოდ შესაბამისი მომხმარებლისთვის და&nbsp;&nbsp; აკრძალულია მისი ნებისმიერი სხვა ფიზიკური ან იურიდიული პირისათვის გადაცემა. მომხმარებელი პასუხისმგებელია ვებ-გვერდზე ავტორიზაციისათვის მისთვის გადაცემული სახელისა და პაროლის დაცვაზე, ასევე მესამე პირების მიერ მისით უნებართვო სარგებლობის აღკვეთაზე.</p>
                            <p style="text-align: justify;">ვებ-გვერდზე ავტორიზაციისას და მისით სარგებლობისას შუამავალი ვალდებულია ივარაუდოს, რომ ვებ-გვერდით სარგებლობას ახორციელებს ის პირი, რომლის სახელითა და პაროლითაც ხორციელდება ავტორიზაცია.</p>
                            <p style="text-align: justify;">მომხმარებელი ვალდებულია დაუყოვნებლივ შატყობინოს შუამავალს, თუ მისთვის ცნობილი გახდება, რომ მისი ანგარიშის გამოყენება ხორციელდება მისი ნებართვის გარეშე.&nbsp;</p>
                            <p style="text-align: justify;">ამ მუხლით გათვალისწინებული მოთხოვნების დარღვევის შემთხვევაში შუამავალი თავისუფლდება წინამდებარე ხელშეკრულებით ნაკისრი ვალდებულების შესრულებისგან და ენიჭება უფლება გააუქმოს მომხმარებლის რეგისტრაცია.</p>
                            <p style="text-align: justify;">&nbsp;</p>
                            <p style="text-align: center;"><strong><em>საჯაროობა, უსაფრთხოება, ინფორმაციის დაცვა&nbsp;&nbsp;და გადამოწმება</em></strong></p>
                            <p style="text-align: justify;">მომხმარებელი თანახმაა, რომ ინფორმაცია, რომელსაც ის აწვდის შუამავალს პროდუქციის შეძენასთან დაკავშირებით, გამჟღავნებულ იქნეს შუამავლის მიერ მისი პარტნიორების წინაშე მათი კომერციული მიზნებისათვის, მათ შორის იმისათვის, რომ უზრუნველყოფილ იქნეს შეთავაზების განხორციელება.</p>
                            <p style="text-align: justify;">რაც შეეხება მომხმარებლის კუთვნილ საკრედიტო ბარათთან დაკავშირებული ინფორმაციას, ის ინახება გამყიდველისა და შუამავლის პარტნიორი ბანკების მონაცემთა ბაზაში, რომლებსაც აკისრიათ სრული პასუხისმგებელობა მის დაცვაზე.</p>
                            <p style="text-align: justify;">მომხმარებელი ადასტურებს, რომ მის მიერ შპს &Prime;ჯიბაი&Prime;-სთვის მიწოდებული ინფორმაცია წარმოადგენს ზუსტ და უტყუარ მონაცემებს. ინფორმაციის მიწოდება განახორციელდა საკუთარი სურვილით და ამისათვის მას გაგაჩნიათ კანონმდებლობით გათვალისწინებული ყველა უფლება და ნებართვა.</p>
                            <p style="text-align: justify;">მომხმარებელი შუამავალს ანიჭებს უფლებამოსილებას, რომ მან საკუთარი შეხედულებისამებრ ნებისმიერ დროს და ნებისმიერი რაოდენობით, ნებისმიერი წყაროდან გამოითხოვოს და მიიღოს ინფორმაცია მომხმარებლის შესახებ, მათ შორის პერსონალური მონაცემები, მისი გაცნობის, გადამოწმების, შედარების, საბანკო და სხვა საქმიანობისათვის გამოყენების, ანალიზის, შენახვის და საკანონმდებლო ან/და სახელშეკრულებო ვალდებულებ(ებ)ის შესრულების მიზნებისთვის.</p>
                            <p style="text-align: justify;">მომხმარებლისთვის ცნობილია და აცხადებს თანხმობას, შპს &Prime;ჯიბაი&Prime;-მ განახორციელოს მომხმარებლის შესახებ არსებული კონფიდენციალური ინფორმაციის (მათ შორის პერსონალური მონაცემების) დამუშავება. მონაცემთა დამუშავება, ყოველგვარი შეზღუდვის გარეშე, მოიცავს ავტომატური, ნახევრად ავტომატური ან არაავტომატური საშუალებების გამოყენებით მონაცემთა მიმართ&nbsp;შესრულებულ ნებისმიერ მოქმედებას, კერძოდ, მათ შეგროვებას, ჩაწერას, ფოტოზე აღბეჭდვას, აუდიოჩაწერას, ვიდეოჩაწერას, ორგანიზებას, შენახვას, შეცვლას, აღდგენას, გამოთხოვას, გამოყენებას ან გამჟღავნებას მონაცემთა გადაცემის, გავრცელების ან სხვაგვარად ხელმისაწვდომად გახდომის გზით, დაჯგუფებას ან კომბინაციას,&nbsp;დაბლოკვას, წაშლას ან განადგურებას.</p>
                            <p style="text-align: center;"><strong><em>ნასყიდობის საგანი და გარიგების დადება ნასყიდობის შესახებ</em></strong></p>
                            <p style="text-align: justify;">ვებ-გვერდის&nbsp;<a href="http://www.gebuy.net" target="_blank">www.gebuy.net</a>&nbsp;საშუალებით ხორციელდება ნასყიდობის შესახებ გარიგების დადება გამყიდველსა და მომხმარებელს შორის.</p>
                            <p style="text-align: justify;">ნასყიდობის შესახებ გარიგება ითვლება დადებულად მომხმარებლის მიერ შუამავლის ვებ-გვერდზე მისთვის სასრველი პროდუქციის საიტის ფუნქციონირების აღმწერ დოკუმენტში მოცემული ინფორმაციის შესაბამისად მონიშვნისა და მისი ღირებულების გადახდის შემდეგ.</p>
                            <p style="text-align: justify;">პროდუქციის მახასიათებლები მითითებულია ვებ-გვერდზე&nbsp;<a href="http://www.gebuy.net" target="_blank">www.gebuy.net</a>.</p>
                            <p style="text-align: justify;">შუამავლის უფლებამოსილება შემოიფარგლება საიტზე გამყიდველის სახელით გარიგების საგნისა და პირობების საიტზე გამოქვეყნებით, გარიგების გაფორმებითა და ნასყიდობის საგნის მომხმარებლის მიერ მითითებულ ადგილას მიტანით.</p>
                            <p style="text-align: justify;">მომხმარებლის წინაშე პროდუქციის ვებ-გვერდზე განთავსებულ ინფორმაციასთან შესაბამისობისათვის, ასევე მისი ნივთობრივი და უფლებრივი ნაკლისათვის პასუხს აგებს გამყიდველი და შუამავალს არ შეიძლება წაეყენოს პრეტენზია ან/და დაეკისროს პასუხისმგებლობა აღნიშნულის გამო.</p>
                            <p style="text-align: justify;">ყველა&nbsp; პრეტენზია ნასყიდობის საგანზე წარედგინება გამყიდველს. შუამავალი გამყიდველის მიერ ნასყიდობის ხელშეკრულების შესრულებაზე პასუხისმგებელი არ არის.</p>
                            <p style="text-align: center;"><strong><em>ნასყიდობის ფასი და მისი გადახდის წესი</em></strong></p>
                            <p style="text-align: justify;">ნასყიდობის ფასი მითითებულია ვებ-გვერდის&nbsp;<a href="http://www.gebuy.net">www.gebuy.net</a> შესაბამისი პროდუქციის ფანჯარაზე და მოიცავს როგორც უშუალოდ პროდუქციის ღირებულებას, ასევე ნასყიდობის საგნის შპს &Prime;ჯიბაი&Prime;-ს საწყობამდე (მდებარე მისამართზე: Butzstrasse 14 86199 Augsburg, Deutschland) ტრანსპორტირების საფასურს.</p>
                            <p style="text-align: justify;">ნასყიდობის ფასი არ მოიცავს ნასყიდობის საგნის განბაჟების ღირებულებას. განბაჟების პროცედურებზე პასუხისმგებელია მომხმარებელი, თუმცა შუამავალი გამოთქვამს მზადყოფნას დამატებითი შეთანხმების საფუძველზე და დამატებითი გასამრჯელოს სანაცვლოდ გაუწიოს მომხმარებელს დახმარება გამარტივებული საბაჟო პროცედურებით სარგებლობაში.</p>
                            <p style="text-align: justify;">იმ შემთხვევაში, თუ საბაჟო სამსახური ან ფინანსთა სამინისტრო შპს &Prime;ჯიბაი&Prime;-ს დააკისრებს საჯარიმო სანქციას, მომხმარებლის მიერ მომსახურების პირობების მთლიანად ან ნაწილობრივ შეუსრულებლობის გამო (მაგ.: პროდუქციის არასრული ან არაზუსტი დეკლარირება), შპს &Prime;ჯიბაი&Prime; უფლებას იტოვებს აღნიშნული ჯარიმის გადახდა დააკისროს მომხმარებელს.</p>
                            <p style="text-align: justify;">ნასყიდობის ფასის გადახდა ხორციელდება უნაღდო ანგარიშსწორების ფორმით, მომხმარებელის მიერ შპს &Prime;ჯიბაი&Prime;-ს&nbsp; საანგარიშსწორებო ანგარიშზე ვებ-გვერდზე მითითებული შესაბამისი საშუალებებით ნასყიდობის ფასის ოდენობით თანხის ჩარიცხვის გზით.</p>
                            <p style="text-align: justify;">თანხის გადახდის ყველა ხარჯს ანაზღაურებს მომხმარებელი.</p>
                            <p>&nbsp;</p>
                            <p style="text-align: center;"><strong><em>შეძენილი პროდუქციის მიღება.</em></strong></p>
                            <p style="text-align: justify;">შუამავალი ვალდებულია განახორციელოს მომხმარებლის მიერ შეძენილი პროდუქციის ტრანსპორტირება გამყიდველის მიერ მისთვის პროდუქციის გადაცემის ადგილიდან შპს &Prime;ჯიბაი&Prime;-ს საწყობამდე არაუმეტეს 30 (ოცდაათი) კალენდარული დღის ვადაში.</p>
                            <p style="text-align: justify;">ტრანსპორტირების დასრულების შესახებ მომხმარებელს ეცნობება ვებ-გვერდზე მის მიერ მითითებული საკომუნიკაციო საშუალებათაგან ერთ-ერთის მეშვეობით.</p>
                            <p style="text-align: justify;">მომხმარებელი ვალდებულია მისთვის ტრანსპორტირების დასრულების შესახებ ინფორმაციის მიღებიდან არაუგვიანებს 30 (ოცდაათი) კალენდაული დღისა მიიღოს ნაყიდი პროდუქცია.</p>
                            <p style="text-align: justify;">შეძენილი პროდუქციის მისაღებად საჭიროა მომხმარებელმა თან იქონიოს პირადობის დამადასტურებელი მოწმობა ან პასპორტი (ქსეროასლი არ მიიღება). იმ შემთხვევაში თუ პროდუქციას იბარებს მესამე პირი, რომელიც არ არის შემძენი, მაშინ საჭირო იქნება როგორც შემძენის, ასევე იმ პიროვნების პირადობის დამადასტურებელი მოწმობა ან პასპორტი ვინც უშუალოდ ჩაიბარებს მას, ასევე შესაძლებელია ნოტარიულად დამოწმებული მინდობილობის გამოყენება.</p>
                            <p style="text-align: justify;">მომხმარებლის მიერ საკომუნიკაიო ინფორმაციის არასწორად მითითების ან ამ მუხლით ნაკისრი ვალდებულების შეუსრულებლობის შემთხვევაში შუამავალი თავისუფლდება პროდუქციის მომხმარებლისათვის გადაცემის ვალდებულებისაგან და უფლებამოსილია თავისი შეხედულებისამებს მოახდინოს მისი რეალიზაცია მისი შენახვის ხარჯების დაფარვის მიზნით.</p>
                            <p>&nbsp;</p>
                            <p style="text-align: center;"><strong><em>საკურიერო მომსახურება</em></strong></p>
                            <p style="text-align: justify;">შპს &Prime;ჯიბაი&Prime; მომხმარებელს დამატებით სთავაზობს საკურიერო მომსახურებას თბილისის მაშტაბით. ამ სერვისით სარგებლობისათვის მომხმარებელმა უნდა გააკეთოს შესაბამისი მონიშვნა ვებ-გვერდზე, ან აცნობოს შუამავალს ამისთვის დადგენილი წესით.</p>
                            <p style="text-align: justify;">საკურიერო მომსახურება გულისხმობს, პროდუქციის ტრანსპორტირების დასრულებიდან არაუგვიანეს 2 (ორი) სამუშაო დღისა 5 კგ-მდე ნებისმიერი რაოდენობის ამანათების მიტანას მომხმარებლის მიერ მითითებულ მისამართზე.</p>
                            <p style="text-align: justify;">კურიერს ამანათი მიაქვს მომხმარებლის მიერ სისტემაში დაფიქსირებულ მისამართზე და მხოლოდ ერთხელ.</p>
                            <p style="text-align: justify;">ვებ&ndash;გვერდიდან მისამართის შეცვლა შესაძლებელია მხოლოდ პროდუქციის ჩამოსვლამდე, სხვა შემთხვევაში ამანათის გატანა შეცვლილ მისამართზე არ მოხდება.</p>
                            <p style="text-align: justify;">შეზღუდულია მისამართის შეცვლა და გადამისამართება ოფისში დარეკვით ან ზეპირი შეთანხმების საფუძველზე.</p>
                            <p style="text-align: justify;">კურიერი არ აიტანს ამანათს სართულებზე.</p>
                            <p style="text-align: justify;">მისამართზე მოსვლამდე კურიერი დარეკავს მომხმარებლის ვებ-გვერდზე დაფიქსირებულ მობილურის ნომერზე, რათა გადასცეს მომხმარებელს ამანათი. თუ დაკავშირება რამოდენიმე წუთის განმავლობაში ვერ მოხდა მომხმარებლის ან სატელეკომუნიკაციო კომპანიის მიზეზით, კურიერი წაიღებს ამანათს საწყობში, საიდანაც მომხმარებელი ვალდებულია თვითონ გაიტანოს ამანათი.</p>
                            <p style="text-align: justify;">ამანათის მისაღებად საჭიროა მომხმარებელმა თან იქონიოს მიმღების (პიროვნება, რომლის სახელი და გვარი აწერია უშუალოდ ამანათს) პირადობის დამადასტურებელი მოწმობა ან პასპორტი. ქსეროასლი არ მიიღება. იმ შემთხვევაში თუ ამანათს იბარებს სხვა, მესამე პირი, რომელიც არ არის ამანათის მიმღები, მაშინ საჭირო იქნება ასევე იმ პიროვნების პირადობის დამადასტურებელი მოწმობა ან პასპორტი ვინც უშუალოდ ჩაიბარებს ამანათს.</p>
                            <p style="text-align: justify;">ამანათის გადაცემის დამოწმება ხდება მომხმარებლის მიერ პირადობის ან პასპორტის წარდგენით და ხელმოწერით ქაღალდის ბლანკზე ან ხელმოწერის გასაკეთებელ სპეციალურ ელექტრონულ მოწყობილობაზე.</p>
                            <p><strong><em>&nbsp;</em></strong></p>
                            <p style="text-align: center;"><strong><em>პრეტენზიები და დავები</em></strong></p>
                            <p style="text-align: justify;">ყველა პრეტენზია შპს &Prime;ჯიბაი&Prime;-სთან მიმართებაში უნდა გაცხადდეს წერილობითი ფორმით, მომხმარებლის მიერ პროდუქციის მიღების დღესვე, თუ საქმე ეხება გარეგნულად შესამჩნევ დანაკარგებსა და დაზიანებებს, ხოლო გარეგნულად შეუმჩნეველი დანაკარგებისა და დაზიანებების შემთხვევაში &ndash; მომხმარებლის მიერ პროდუქციის მიღებიდან არა უგვიანეს 7 (შვიდი) სამუშაო დღისა. წინააღმდეგ შემთხვევაში შუამავალი თავისუფლდება პასუხისმგებლობისაგან.</p>
                            <p style="text-align: justify;">წინამდებარე ხელშეკრულების ირგვლივ წამოჭრილი ნებისმიერი დავა (მათ შორის, ხელშეკრულების არსე&shy;ბობასთან, ინტერპრეტაციასთან, შესრულებასთან და აღსრულებასთან დაკავშირებით) წყდება მოლაპარა&shy;კებით.</p>
                            <p style="text-align: justify;">დავის მოუგვარებლობის შემთხვევაში, მხარე უფლებამოსილია, დავის გადასაწყვეტად მიმართოს მუდმივმოქმედ არბიტრაჟს &ldquo;დავების განმხილველ ცენტრს&rdquo; (DRC-ს, რომლის სარეგისტრაციო კოდია 204547348; იურიდიული მისამართი ქ. თბილისი, ვაჟა-ფშაველას 71, მე-4 ბლოკი, 1-ელი სართული; ვებ გვერდი: www.drc-arbitration.ge). მხარეები სრულად და უპირობოდ ეთანხმებიან ამ მუხლით გათვალისწინებულ საარბიტრაჟო დათქმას და გამოთქვამენ თანხმობას დავის განხილვა მოხდეს არბიტრაჟში. საარბიტრაჟო განხილვა ჩატარდება ქ. თბილისში, ქართულ ენაზე, ქართული სამართლის მატერიალური ნორმების შესაბამისად და მუდმივმოქმედი არბიტრაჟის რეგლამენტის/დებულების იმ რედაქციის შესაბამისად, რომელიც იქნება მოქმედი საარბიტრაჟო სარჩელის მიღების თარიღისათვის. ამასთან, იმის გათვალისწინებით, რომ DRC-ის &ldquo;საარბიტრაჟო წარმოების წესები&rdquo; (დებულება) წარმოადგენს მხარეთა შორის წინამდებარე საარბიტ&shy;რაჟო შეთანხმების ნაწილს, აღნიშნული დებულებით განისაზღვრება ყველა ის საკითხი, რომელთა სხვაგვარად განსაზღვრის უფლებაც მხარეებს მიანიჭა კანონმა &ldquo;არბიტრაჟის შესახებ&rdquo;, მათ შორის &ndash; ისე&shy;თი საკითხები, როგორებიცაა არბიტრების რაოდენობა, მათი დანიშვნისა და აცილების წესი, სასარჩელო მოთხოვნის უზრუნველყოფის და საარბიტრაჟო განხილვის წესები.</p>


                        </div>
                    </div>



                    <div class="registration_submit">
                        <input type="checkbox" name="i_agree" />
                        <b>გავეცანი <a href="">წესებს</a> და ვეთანხმები</b>
                        <input class="button_1" type="submit" name="registration_submit" value="რეგისტრაცია"/>
                    </div>
        </form>
    </div>
</div>

</body>
<footer>
    <div class="main_wrapper">
        <ul class="about_us">
            <li><a href="about_us.php">ჩვენს შესახებ</a></li>
            <li><a href="about_brands.php">ბრენდების შესახებ</a></li>
            <li><a href="service.php">სერვისი</a></li>
            <li><a href="">ბალანსის შევსება</a></li>
            <li><a href="">კონტაქტი</a></li>
            <li><a href="howitworks.php">როგორ შევიძინო პროდუქცია</a></li>
            <li><a href="">ხშირად დასმული კითხვები</a></li>
        </ul>

        <ul class="paying_methods">
            <li><img src="Images/Icons/visa.png"></li>
            <li><img src="Images/Icons/mastercard.png"></li>
            <li><img src="Images/Icons/amex.png"></li>
            <li><img src="Images/Icons/paypal.png"></li>
            <li><img src="Images/Icons/paybox.png"></li>
            <li><img src="Images/Icons/OSMP.png"></li>
        </ul>
        <h4 class="rights">GEBUY @ALL RIGHTS RESERVED</h4>
        <h4 class="year">@2015</h4>
    </div>
</footer>
</html>
