<center><h1>Frequently Asked Questions</h1></center>
<center><h3>InstaCode version <strong>Helium</strong></h3></center>

<table class='faq'><tr class="info"><th>Bugs Fixed</th></tr><tr><td>
	<ul>
	    <li>Problem Page logo fixed.</li>
	    <li>Account tab is now accessible from About Us page.</li>
	    <li>Contest Leaderboard now displays correct information.</li>
	    <li>Glyphicons are now working.</li>
	</ul>
</td></tr></table><br/>

<table class='faq'><tr class="info"><th>What are the limitations of this version?</th></tr><tr><td>
	<p>Java programmers need to define their main function inside class named 'Main' (like other online judges) or they will get compilation error.
        </p>
</td></tr></table><br/>
<center><h3>InstaCode version <strong>Hydrogen</strong></h3></center>
<br><table class='faq'><tr class="info"><th>What is the InstaCode Online Judge?</th></tr><tr><td>
	<p>The InstaCode Online Judge is a Programming Contest Control System. It acts as an interface between the judges and the participants of a Computer Programming Contest.</p>
	<p>A Computer Programming Contest is a competition where teams/individuals submit (computer program) solutions to judges. The teams are given a set of computer problems to solve in a limited amount of time (for example 3 hours). The judges then give a pass/fail judgement to the submitted solution which is sent back to the teams. The team rankings are computed based on the solutions, when the solutions were submitted and how many attempts were made to solve the problem. The judges testing is a Black box testing where the teams do not have access to the judges' test data.</p>
</td></tr></table>
<br><table class='faq'><tr class="info"><th>How does this website actually work?</th></tr><tr><td>
	<p>The InstaCode Online Judge System has three main parts : the SQL Database (which stores all information), the User Interface (the website that you are currently using) and the Execution Protocol (the scripts that actually run the programs you submit). The website essentially just takes information from the Database, formats it to make it look nice, add options to manipulate it, and presents it to the user.</p>
	<p>The data displayed on both sides of the webpage is refreshed a few times per minute (using Ajax) in order to provide you with the latest information conveniently. The User Account system is implemented by Cookies (which are used to save information about whether or not you are currently logged in, and if so, more details about your team).</p>
</td></tr></table>


<br><table class='faq'><tr class="info"><th>What type of platform shall my codes be run on?</th></tr><tr><td>
	<p>To prevent malicious codes from harming the Execution Environment or the Server itself, submitted programs are executed on Virtual Machines. The configuration of the Virtual Machine being used right now is given below :</p>
	<ul>
		<li>Operating System : Debian ; Harddisk : 20GB SSD; RAM : 512MB</li>
		<li>Brainf**k Interpreter : bf (version 20041219)</li>
		<li>C Compiler : gcc 4.4.5</li>
		<li>C++ Compiler : g++ 4.4.5</li>
		<li>C# Compiler : Mono Compiler Version 2.6.7 (gmcs)</li>
		<li>Java Compiler : javac 1.8.0_66, java 1.8.0_66</li>
		<li>JavaScript Interpreter : rhino 1.7</li>
		<li>Pascal Interpreter : gpc version 20070904</li>
		<li>Perl Interpreter : perl v5.10.1</li>
		<li>PHP Interpreter : PHP 5.3.3</li>
		<li>Python Interpreter : python 2.6.6</li>
		<li>Ruby Interpreter : ruby 1.8.7</li>
	</ul>
	<p>Please contact an Administrator to request support for additional languages.</p>
</td></tr></table>

<br><table class='faq'><tr class="info"><th>Why is my program not being Accepted?</th></tr><tr><td>
	<p>The programs are judged by the Execution Protocol as described above. However, there exist cases that havent been dealt with, and some of which are mentioned below along with some common errors :</p>
	<ul>
		<li>No provision has been made to detect Run Time Errors in case of languages which need to be compiled. Consequently, if one occurs, it may cause the process to hang (returning TLE, Time Limit Exceeded) or to abort (returning WA, Wrong Answer).</li>
		<li>Java code files must have the same name as the class which contains the main function. If you are uploading *.java files, this should not be a concern, but in case you are submitting text, please ensure that you specify the class name correctly when asked for it.</li>
		<li>Ensure that your program is not printing anything other that what is asked. Ensure that the print operations that you used for debugging your code are removed or commented out. Also ensure that your program is reading from the Standard Input only, and not a file as during debugging.</li>
	</ul>
	<p>If you are sure that none of the reasons described above are applicable in your case, please reconsider the virtual impossibity that logic of your program is flawed, and reexamine your code. If you are absolutely sure that your program is correct in every way, but is still not being Accepted, you may contact an Administrator (via the Clarifications feature) to rejudge or manually run your program (if it does come to that, please quote the Run ID). Note that a particular clarification can only be deleted by the team that requested them provided it not been replied to by an Administrator.</p>
</td></tr></table>

<br><table class='faq'><tr class="info"><th>How is the ranking done here?</th></tr><tr><td>
	<p>The primary basis for ranking teams is their score. In case the score of two teams are equal, then the team whose solution got accepted first is ranked higher. Note that every incorrect submission (submitted before the first correct solution) results in a <?php global $admin; echo $admin["penalty"]; ?> minute penalty on the time of your submission. Therefore, please avoid submiting programs unless you are reasonably sure they will work.</p>
	<!--
		<p>An important point that must be explained is that there are two separate ranklists available on this site. The <a href='?display=rankings' target='new'>Current Rankings</a> are updated every 10 seconds and reflect the current ranks of the various teams, independent of their past performance. In contrast, the <a href='?display=scoreboard' target='new'>Main Scoreboard</a> (updated far more infrequently) contains the results of the various competitions conducted till now, and uses them to generate long term rankings.</p>
	-->
</td></tr></table>

<br><table class='faq'><tr class="info"><th>What are the different Contest modes you mentioned before?</th></tr><tr><td>
	<p>The different Contest Modes mentioned earlier are described below :</p>
	<ul>
		<li>Active Mode : Submissions are allowed, problem types are hidden, and the Timer is On.</li>
		<li>Passive Mode : Submissions are allowed, problem types are visible, and the Timer is Off.</li>
		<li>Disabled Mode : Submissions are not allowed, problem types are visible, and the Timer is Off.</li>
		<li>Lockdown Mode : All features (except FAQ, Main Scoreboard & Clarifications) are disabled for normal users.</li>
	</ul>
	<p>The Lockdown Mode is used immediately prior to (Active Mode) contests, during which Administrators (who arent affected by the Lockdown Mode once they log in) are uploading and testing new problems.</p>
</td></tr></table>

<br><table class='faq'><tr class="info"><th>Why was Instacode made?</th></tr><tr><td>
	<p>
	    A website like this was needed for a long time, up until now students had to code in TurboC which we all know is an absolute pain. We need to get familiar with the technologies used in current software industry which was never going to happen if students were to code on outdated editors and technologies. This website will replace old methods with newer, faster and more convenient methods of coding.<br>
	    This website will also help students to prepare for company coding rounds and interview. Nearly all companies now select students through a coding round, students with knowledge of Data Structures, Algorithms and Competitve programming will get an upper hand in those interviews and coding rounds.<br>
	    The aim of this website is to establish a coding culture in our college.
	</p>
</td></tr></table>
