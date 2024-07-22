<?php
require_once 'config.php';
require_once 'components.php';
$_SESSION['url'] = $_SERVER['REQUEST_URI']; // used by process.php to send to last visited page
$query = "select value from admin where variable='mode'";
$judge = DB::findOneFromQuery($query);
if ($judge['value'] == 'Lockdown' && isset($_SESSION['loggedin']) && !isAdmin()) {
    session_destroy();
    session_regenerate_id(true);
    session_start();
    $_SESSION['msg'] = "Judge is in Lockdown mode and so you have been logged out.";
    redirectTo(SITE_URL);
}
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link type="text/css" rel="stylesheet" href="<?php echo CSS_URL; ?>/bootstrap.css" media="screen" />
        <link type="text/css" rel="stylesheet" href="<?php echo CSS_URL; ?>/style.css" media="screen" />
        <script type="text/javascript" src="<?php echo JS_URL; ?>/jquery.js"></script>
        <script type="text/javascript" src="<?php echo JS_URL; ?>/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo JS_URL; ?>/plugin.js"></script>
        <script type="text/javascript">
            $(window).load(function() {
                if ($('#sidebar').height() < $('#mainbar').height())
                    $('#sidebar').height($('#mainbar').height());
            });
        </script>

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-85636479-1', 'auto');
          ga('send', 'pageview');

        </script>




        <script type="text/javascript">
            $('#topnavbar').affix({
                offset: {
                    top: $('#banner').height()
                }
            });
        </script>

         <style type="text/css">
            #topnavbar {
                margin:0;
                }
            #topnavbar.affix {
                top: 0;
                }
             #banner{
                 background-color: #141224;
                 padding-top: 10px;
             }
             #custom_hover a:hover {
                background-color: #141224;
                 color:#FFFFFF;
            }
             #blue_background{
                 background-color:#141224;
                 color:gray;
                 font-weight: lighter;
             }
             footer {
                background: #141224;
                padding: 0px 0 0px 0; }
                footer p {
                    font-size: 14px;
                    color: rgba(255, 255, 255, 0.6); }
                footer a{
                    color: #3ac341;
                }
            footer a:hover{
                color: #3ac341;
            }
            footer .footer-title {
                position: relative;
                font-size: 18px;
                text-transform: uppercase;
                color: white;
            }
            footer .footer-title:after {
                content: '';
                display: block;
                width: 60px;
                height: 1px;
                background: #3ac341;
                margin-top: 8px;
            }
            footer .right-border {
                border-right: 1px solid rgba(255, 255, 255, 0.1);
            }
            footer .left-border {
                border-left: 1px solid rgba(255, 255, 255, 0.1);
            }
            @media (max-width: 991px) {
                footer .right-border {
                border-right: none;
                }
            }
            @media (max-width: 767px) {
                footer .right-border {
                border-right: none;
            }
            footer .left-border {
                border-left: none; }
            footer .navigation {
                margin-top: 40px;
                border-top: 1px solid white; } }
            footer .footer-about {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding-bottom: 0px; }
            footer .contact-info .single {
            margin: 15px 0; }
            footer .contact-info .single i {
            display: block;
            float: left;
            color: #3ac341;
            margin-right: 10px;
            line-height: 22px; }
            footer .contact-info .single p {
            margin: 0;
            padding: 0;
            display: block;
            overflow: hidden; }
            footer .social-icon {
            margin-top: 0px; }
            footer .social-icon li a {
            display: block;
            width: 32px;
            height: 32px;
            margin-right: 5px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);}
            footer .social-icon li a:hover {
            border-color: #3ac341;
            color: #3ac341; }
            footer .social-icon li a i {
            line-height: 32px;}

            </style>



        <title>Instacode</title>
        <link rel='shortcut icon' href='<?php echo SITE_URL; ?>/img/favicon.png'/>
    </head>



    <body>
        <?php if ($judge['value'] == 'Active' && isset($_SESSION['loggedin'])) { ?>
            <script type='text/javascript'>
                function settitle() {
                    var t = window.document.title;
                    var n = t.match(/(\d*)\)/gi);
                    console.log(n);
                    if (n != null) {
                        n = parseInt(n) + 1;
                    } else {
                        n = 1;
                    }
                    window.document.title = "(" + n + ") Instacode";
                }
                function resettile() {
                    $.ajax({
                        type: "GET",
                        url: "<?php echo SITE_URL; ?>/broadcast.php",
                        data: {updatetime: ""}
                    });
                    window.document.title = "Instacode";
                }
                window.setTimeout("bchk();", <?php echo rand(300000, 600000); ?>);
                $.ajax("<?php echo SITE_URL; ?>/broadcast.php").done(function(msg) {
                    var json = eval('(' + msg + ')');
                    console.log(msg);
                    if (json.broadcast.length != 0) {
                        var str, i;
                        str = "";
                        for (i = 0; i < json.broadcast.length; i++)
                            str += "<b>" + json.broadcast[i].title + ":</b><br/>" + json.broadcast[i].msg + "<br/><br/>";
                        $("#bmsg").html(str);
                        $('#myModal').on('hidden.bs.modal', function() {
                            resettile();
                        });
                        $("#myModal").modal('show');
                        settitle();
                    }
                });
                function bchk() {
                    $.ajax("<?php echo SITE_URL; ?>/broadcast.php").done(function(msg) {
                        var json = eval('(' + msg + ')');
                        console.log(msg);
                        if (json.broadcast.length != 0) {
                            var str, i;
                            str = "";
                            for (i = 0; i < json.broadcast.length; i++)
                                str += "<b>" + json.broadcast[i].title + ":</b><br/>" + json.broadcast[i].msg + "<br/><br/>";
                            $("#bmsg").html(str);
                            $('#myModal').on('hidden.bs.modal', function() {
                                resettile();
                            });
                            $("#myModal").modal('show');
                            settitle();
                        }
                    });
                    window.setTimeout("bchk();", 600000);
                }
            </script>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Alert</h4>
                        </div>
                        <div class="modal-body" id="bmsg">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        ?>

        <div class="container-fluid" style="background-color:#141224">
            <div class="container" id="banner">
                <a  href="<?php echo SITE_URL; ?>">
                    <img src = "http://instacode.xyz/img/icoj_banner_old.png"/>
                </a>
             </div>
        </div>

        <nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation" style="background-color:#141224" id="topnavbar">
            <div class="container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="container collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li id = "custom_hover"><a href="<?php echo SITE_URL; ?>/problems">Problems</a></li>
                        <li id = "custom_hover"><a href="<?php echo SITE_URL; ?>/contests">Contests</a></li>
                        <li id = "custom_hover"><a href="<?php echo SITE_URL; ?>/rankings">Rankings</a></li>
                        <li id = "custom_hover"><a href="<?php echo SITE_URL; ?>/submissions">Submissions</a></li>
                        <li id = "custom_hover"><a href="<?php echo SITE_URL; ?>/contact">Chat</a></li>
                        <li id = "custom_hover"><a href="http://codehour.online">Code Hour</a></li>
                        <li id = "custom_hover"><a href="<?php echo SITE_URL; ?>/notes">Instanotes</a></li>
                        <li id = "custom_hover"><a href="<?php echo SITE_URL; ?>/aboutus">About Us</a></li>
                    </ul>
                    <?php if (isset($_SESSION['loggedin'])) { ?>
                        <ul class="nav navbar-nav pull-right">
                            <?php if ($_SESSION['team']['status'] == 'Admin') { ?>
                                <li id = "custom_hover" class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Admin
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li id = "custom_hover"><a href='<?php echo SITE_URL; ?>/adminjudge'>Judge Settings</a></li>
                                        <li id = "custom_hover"><a href='<?php echo SITE_URL; ?>/adminproblem'>Problem Settings</a></li>
                                        <li id = "custom_hover"><a href='<?php echo SITE_URL; ?>/admincontest'>Contest Settings</a></li>
                                        <li id = "custom_hover"><a href='<?php echo SITE_URL; ?>/adminteam'>Team Settings</a></li>
                                        <li id = "custom_hover"><a href='<?php echo SITE_URL; ?>/admingroup'>Group Settings</a></li>
                                        <li id = "custom_hover"><a href='<?php echo SITE_URL; ?>/adminclar'>Clarifications</a></li>
                                        <li id = "custom_hover"><a href='<?php echo SITE_URL; ?>/adminbroadcast'>Broadcast</a></li>
                                        <li id = "custom_hover"><a href='<?php echo SITE_URL; ?>/adminlog'>Request Logs</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li id = "custom_hover" class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Account
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href='<?php echo SITE_URL; ?>/edit'>Account Settings</a></li>
                                    <li><a href='<?php echo SITE_URL; ?>/process.php?logout'>Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>



        <div class="container">
            <div class='row'>
                <div class='col-md-9' id='mainbar'>
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-danger" style="background-color:#141224; margin-top: 20px;">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <center><?php
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                                ?></center>
                        </div>
                        <?php
                    }
                    if (!isset($_GET['tab']) || $_GET['tab'] == 'home') {
                        $str = 'files/home.php';
                    } else {
                        $str = 'files/' . $_GET['tab'] . '.php';
                    }
                    if (file_exists($str))
                        require $str;
                    else
                        echo "<br/><br/><br/><div style='padding: 10px;'><h1>Page not Found :(</h1>The page you are searching for is not on this site.</div><br/><br/><br/>";
                    ?>
                </div>


                <div class='col-md-3'>
                    <div id='sidebar'>
                        <?php loginbox(); ?>
                        <hr/>
                        <h4>Contest Status</h4>
                        <?php contest_status(); ?>

                        <?php
	                        if ($judge['value'] == 'Active') {?>
	                        	<h4 align="center">Contest Ranking</h4>
                                <div id="live-ranking">
                                    <?php getCurrentContestRanking(); ?>
                                        <a style="float:right;" href="<?php echo SITE_URL.'/rank/'.getCurrentContest(); ?>">
                                            View all
                                        </a>
                                </div>
                                
                                
                <script>
		          var eventSource = new EventSource('<?php echo SITE_URL.'/files/LiveContestRanking.php'?>');
		          eventSource.addEventListener('message',function(e) {
		          document.getElementById('live-ranking').innerHTML = e.data;
		          }, false);
                </script> 
                    
                    
	                    <?php }
	                        else {
								//echo '<h4>Overall Rankings</h4>';
                        ?>
                            <h4>Overall Ranking</h4>
	                        	<?php rankings();
	                       	}
                        ?>

                        <hr />
                        <?php
                        if (isset($_SESSION['loggedin'])) {
                            mysubs();
                            echo "<hr/>";
                        }
                        ?>
                        <hr/>
                        <?php
                        if ($judge['value'] == 'Active') {
                            latestsubs();
                            echo "<hr/>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                   <div class="container" style = "background-color:#141224">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="footer-about">
                                <h2 class="footer-title">About Instacode</h2>
                                        <p>
                                            Instacode Online Judge is an online compiler and judge where students are given algorithmic problems to program under contrained value and time limit. This online judge is made by Instacode Club in Krishna Institute Of Engineering & Technology for holding college contests and for other educational purposes.
                                    </p>
                             <div class="list-inline">
                                <a style = "font-size:20px;font-weight:lighter; padding:0px" href="<?php echo SITE_URL; ?>/faq">
                                    <h2 class="footer-title">FAQ</h2>
                                </a>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="col-md-12 col-sm-6">
                            <div class="contact-info">
                                <h2 class="footer-title">Contact Info</h2>
                                <div class="single">
                                    <p><span class = "glyphicon glyphicon-envelope" style = "color:#08D671; font-size:1.2em"></span>&nbsp&nbsp admin@codehour.online</p>
                                </div>
                            </div>
                        </div>
                        <div class="social-icon">
	                           <ul class="list-inline">
		                          <li><a href="http://facebook.com/instacode.xyz" title=""><i class="fa fa-facebook-official"></i>f</a></li>
		                          <li><a href="http://instacode.xyz/" title=""><i class="fa fa-twitter"></i>t</a></li>
		                          <li><a href="http://instacode.xyz/" title=""><i class="fa fa-linkedin"></i>ln</a></li>
	                           </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </footer>





    </body>
</html>
