<?php 
	include 'db.php';
	date_default_timezone_set("Africa/Lagos");
?>
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
<div class="nav-flex">
		<div class="header-flex">
			<!--Logo Area-->
			<div class="logo-area">
				<a href="/assignment/">
				<!--<img alt="Axioms Logo" src="/assignment/images/ANXIOM-LOGO.png" class="logo-img"/>
				<p class="logo-tagline">Project & Consulting</p>-->
				<h2 class="logo">THE <span>AXIOMS</span></h2>
				</a>
			</div>
			<!--Navigation Menu-->
			<nav class="nav-menu">
				<ul class="topnav" id="myTopnav">
					<?php
					if (isset($_SESSION['username'])) {
						if ($_SESSION['isadmin']) {?>
							<li><a href="/assignment/admin/" name="home">Home</a></li><?php
						}else {?>
							<li><a href="/assignment/dashboard" name="home">Home</a></li><?php
						}
					} else {?>
						<li><a href="/assignment/" name="home">Home</a></li><?php
					}
					if(!isset($_SESSION['username'])){?>
						<li><a href="/assignment/login">Login</a></li><?php
					}
					if(isset($_SESSION['username'])){ ?>
					<li><a href="/assignment/register.php">Register</a></li>
					<li><a href="/assignment/dashboard/entersalary.php">Enter Salary</a></li>
					<li><a href="/assignment/memberslist.php">Members' List</a></li>
					<li><a href="/assignment/dashboard/fetch.php">Commit Transaction</a></li>
					<li><a href="/assignment/dashboard/transaction-history.php">History</a></li><?php } ?>
					<li><a href="/assignment/contact.php">Contact Us</a></li>
					<li class="icon">
    					<a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">MENU☰</a>
  					</li>
					<?php if(isset($_SESSION['username']) || isset($_SESSION['employee'])){?>
					<li><a href="/assignment/login/signout.php">Log out</a></li><?php }?>
				</ul>
			</nav>
		</div>
	</div>
<!--Banner Area-->
<header class="banner">
	<div class="head-flex">
			<h2 class="heading">GREAT TECHNOLOGICAL SOLUTIONS FOR YOU</h2>
			<?php if(isset($_SESSION['username'])){
				$id=$_SESSION['username'];
				$ps=$_SESSION['sn'];
				$sql="SELECT firstName FROM employee WHERE Username='$id' AND Pswd='$ps'";
				$result=mysqli_query($dBase, $sql);
				$row=mysqli_fetch_array($result);?>
		</div>
		<h3 class="log-msg">Logged in as <?php echo $row['firstName'];?></h3><?php }?>
</header>