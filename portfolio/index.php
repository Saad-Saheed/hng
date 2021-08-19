<?php

require_once './connection.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && $_POST['submit']) {
	$feedback = [];
	// validations
	$data = [
		'name' => FILTER_SANITIZE_STRING,
		'email' => FILTER_SANITIZE_EMAIL,
		'message' => FILTER_SANITIZE_STRING,
	];

	$clean_data = filter_input_array(INPUT_POST, $data, false);
				
	// Testing each input
	foreach ($clean_data as $key => $input) {

		if (empty($input))
			$feedback[$key] = "Invalid input, Your $key is required";
	}

	// end validations

	if(empty($feedback)){

		$name = $clean_data['name'];
		$email = $clean_data['email'];
		$message = $clean_data['message'];
		
		$connection = new Connection();
		$conn = $connection->connect();

		$sql = "insert into messages (name, email, message) values (:n, :e, :m)";

		// prepare statement
		$stmt = $conn->prepare($sql);

		// bind values
		$stmt->bindValue(":n", $name, PDO::PARAM_STR);
		$stmt->bindValue(":e", $email, PDO::PARAM_STR);
		$stmt->bindValue(":m", $message, PDO::PARAM_STR);

		$res = $stmt->execute();

		$message .="\nfrom: $email";
		$message = wordwrap($message, 70);

		mail('janbaoda@gmail.com', 'Portfolio Message', $message);

		if($res)
			$feedback['success'] = "Message sent Successfully";
		else 
			$feedback['general'] = "Unable to send your message";
		
	}
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="saad saheed">
	<meta name="description" content="saad saheed portfolio, software developer, freelancer">
	<title>Portfolio</title>
	<link rel="icon" href="images/clipart999521.png">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/lightbox.css">
	<link rel="stylesheet" href="./css/utils.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-B8YHYY8T18"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'G-B8YHYY8T18');
	</script>

	<script src="js/script.js" defer></script>
	<script src="js/jquery.js" defer></script>
	<script src="js/lightbox.js" defer></script>
	<script src="js/cycle2.js" defer></script>

</head>

<body>
	<header class="top-header container-fluid clearfix">
		<!-- <div class="row"> -->
		<div class="logo">
			<img src="images/clipart999521.png" alt="abc" class="">
			<span
				style="font-weight: 300; font-family: cursive; font-size: large; display: inline-block; position: relative; margin-left: 5px; top: -20px;">SOFTWARE</span>
			<span class="toggle-btn" onclick="showhide()">≡</span>
		</div>
		<!-- col-lg-10 col-md-12 col-xl-10 col-sm-12 -->
		<nav class="nav clearfix">
			<ul>
				<li><a href="#profile">Profile</a></li>
				<li><a href="#previous-work">Previous Works</a></li>
				<li><a href="#experience">Experience</a></li>
				<li><a href="#skill">Skills</a></li>
				<li><a href="#contact">Contact me</a></li>
			</ul>
		</nav>

		<!-- </div> -->
	</header>


	<main class="container">
		<h1>JSS Software Portfolio</h1>
		<section class="image-banner row">
			<!-- <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12"> -->

			<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">

				<span class="cycle-prev">&laquo;</span>
				<span class="cycle-next">&raquo;</span>

				<div class="cycle-pager"></div>

				<div class="slide">
					<img src="images/inotedashboard.png" alt="gallery1">
					<!-- <div class="slide-text">
							<h2>Slide Title</h2>
							<p>This is a slide text</p>
						</div> -->
				</div>

				<div class="slide">
					<img src="images/inoteprofile.png" alt="gallery2">

				</div>

				<div class="slide">
					<img src="images/inoteprofile2.png" alt="gallery3">

				</div>

				<div class="slide">
					<img src="images/inotequiz.png" alt="gallery4">

				</div>

				<div class="slide">
					<img src="images/inoteposts1.png" alt="gallery5">

				</div>
			</div>

			<!-- </div> -->
		</section>
		<section class="profile row" id="profile">

			<article class="col-sm-12 col-md-12 col-xl-12 col-lg-12">

				<div class="profile-box clearfix">
					<h2 class="">Personal Profile</h2>
					<div class="p-img-box">
						<img src="images/businessman.ico" alt="user logo">
					</div>
					<div class="description">
						<div class="summary clearfix">
							<!-- <span>
							<img src="images/pencil-icon.png" alt="use info">
						</span> -->
							<p>
								<span>Surname: </span> Saad
							</p>

							<p>
								<span>First Name: </span> Saheed
							</p>

							<p>
								<span>Gender: </span> Male
							</p>

							<p>
								<span>Nationality: </span> Nigeria
							</p>

							<p>
								<span>Email Address: </span>janbaoda@gmail.com
							</p>

							<a href="resume.docx" download
								style="display: block; margin: 15px 0; padding: 10px 15px; text-decoration: none; float: right; background:  #ff9800; color: #0A3B76; font-size: 1rem; border-radius: 4px;">Download
								My CV</a>
						</div>
						<hr>

						<div class="detail">
							Hello dear visitor,<br>
							my name is saad saheed.<br>
							A web developer from Nigeria, my preferred language and coding tools are C#, PHP(LARAVEL),
							HTML 5, CSS 3, and JavaScript. Which I have been using to develop many web and desktop
							applications. such as warehouse management system(web), student training activities
							tracker(web inote.com.ng), project grading system(desktop), tourism information system(web),
							Online Result computation system(desktop), and so on.
						</div>
					</div>
				</div>
			</article>
		</section>

		<section class="previous-work row" id="previous-work">
			<h2 class="">Previous Works</h2>

			<article class="work1 clearfix">

				<aside class="col-sm-12 col-md-12 col-xl-5 col-lg-5 work-image-banner">
					<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">

						<span class="cycle-prev">&laquo;</span>
						<span class="cycle-next">&raquo;</span>

						<div class="slide">
							<a href="images/inotedashboard.png" data-lightbox="roadtrip">
								<img src="images/inotedashboard.png" alt="inotedashboard">
							</a>
						</div>

						<div class="slide">
							<a href="images/inoteprofile.png" data-lightbox="roadtrip">
								<img src="images/inoteprofile.png" alt="inoteprofile">
							</a>
						</div>

						<div class="slide">
							<a href="images/inoteprofile2.png" data-lightbox="roadtrip">
								<img src="images/inoteprofile2.png" alt="inoteprofile2">
							</a>
						</div>

						<div class="slide">
							<a href="images/inotequiz.png" data-lightbox="roadtrip">
								<img src="images/inotequiz.png" alt="inotequiz">
							</a>
						</div>

						<div class="slide">
							<a href="images/inoteposts1.png" data-lightbox="roadtrip">
								<img src="images/inoteposts1.png" alt="inoteposts1">
							</a>
						</div>

						<div class="slide">
							<a href="images/inoteposts2.png" data-lightbox="roadtrip">
								<img src="images/inoteposts2.png" alt="inoteposts2">
							</a>
						</div>

						<div class="slide">
							<a href="images/inoteposts3.png" data-lightbox="roadtrip">
								<img src="images/inoteposts3.png" alt="inoteposts3">
							</a>
						</div>

						<div class="slide">
							<a href="images/inotestudentreport.png" data-lightbox="roadtrip">
								<img src="images/inotestudentreport.png" alt="inotestudentreport">
							</a>
						</div>

						<div class="slide">
							<a href="images/inotesingle1.png" data-lightbox="roadtrip">
								<img src="images/inotesingle1.png" alt="inotesingle1">
							</a>
						</div>

						<div class="slide">
							<a href="images/inotesingle2.png" data-lightbox="roadtrip">
								<img src="images/inotesingle2.png" alt="inotesingle2">
							</a>
						</div>

						<div class="slide">
							<a href="images/inotecreatepost.png" data-lightbox="roadtrip">
								<img src="images/inotecreatepost.png" alt="inotecreatepost">
							</a>
						</div>

					</div>

				</aside>
				<section class="col-sm-12 col-md-12 col-xl-7 col-lg-7">
					<h3>Student Activities Tracker</h3>
					<p>
						This project was developed early february 2021, for IT student at <b>probity Hub.</b> All the
						Science and Engineering student in Nigeria must go for IT training, once or twice if its
						polytechnic student.
						I also took my training at probity hub in year 2018. but now i am one of the instructor who
						guide the student on their field of study, particularly (WEB technology), so we decide to design
						a website where we can easily
						manage their Information, Then the job was assigned to me. In this site student who wish to do
						their siwes/IT training at probity can register through the registration code generated by one
						of the administrators, then they proceed with
						their registration, in the student dashboard student can edit their profile, view the available
						quiz and response to the quiz, create daily report on what we thought them, manage all their
						quiz and report
						history, create a blog, view their performance level and so on. While an administrators can
						register new student, modify their profile, generate and view registration code, manage student
						quiz response and
						report, and they can also create and modify blog post. you visit the site here <a
							href="https://inote.com.ng" target="_blank"
							style="color: #ff9800; font-size: 1rem;">inote</a>
					</p>
				</section>
			</article>

			<article class="work2 clearfix">
				<aside class="col-sm-12 col-md-12 col-xl-5 col-lg-5 work-image-banner">
					<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">

						<span class="cycle-prev">&laquo;</span>
						<span class="cycle-next">&raquo;</span>

						<!-- <div class="cycle-pager"></div> -->

						<div class="slide">
							<a href="images/projectscalelanding.png" data-lightbox="roadtrip1">
								<img src="images/projectscalelanding.png" alt="projectscalelanding">
							</a>
						</div>

						<div class="slide">
							<a href="images/projectscalelogin.png" data-lightbox="roadtrip1">
								<img src="images/projectscalelogin.png" alt="projectscalelogin">
							</a>
						</div>

						<div class="slide">
							<a href="images/projectscalemng.png" data-lightbox="roadtrip1">
								<img src="images/projectscalemng.png" alt="projectscalemng">
							</a>
						</div>

						<div class="slide">
							<a href="images/projectscaleregistr.png" data-lightbox="roadtrip1">
								<img src="images/projectscaleregistr.png" alt="projectscaleregistr">
							</a>
						</div>

						<div class="slide">
							<a href="images/projectscaleresult.png" data-lightbox="roadtrip1">
								<img src="images/projectscaleresult.png" alt="projectscaleresult">
							</a>
						</div>

						<div class="slide">
							<a href="images/projectscaleupld.png" data-lightbox="roadtrip1">
								<img src="images/projectscaleupld.png" alt="projectscaleupld">
							</a>
						</div>

						<div class="slide">
							<a href="images/projectscaleusrreg.png" data-lightbox="roadtrip1">
								<img src="images/projectscaleusrreg.png" alt="projectscaleusrreg">
							</a>
						</div>

					</div>
				</aside>
				<section class="col-sm-12 col-md-12 col-xl-7 col-lg-7">
					<h3>Project Scaling System</h3>
					<p>
						This project is developed to collect,
						process, and return the grades produced by juries(external and internal supervisor) using a
						series
						of rubrics in a final year project of kwara state polytechnic, ilorin. It discusses the design
						requirements, features, and implementation of the online grading system, as well as reactions
						from
						course institute and staff members of the kwara state polytechnic. It is shown that this system
						has
						a number of advantages over analog grading methods, including scalability, real-time feedback on
						the status of grading, the reduced potential for human error in compiling grades, the ability
						for
						jury members to grade remotely and to revise their grades after submission, the ability for
						course
						administrators to easily review grading results and remove statistical outliers from the score
						set,
						the ability to return both provisional and final grades to the course institute, staff, and
						students
						in a timely manner, and the ability to archive and export grading data for future use.This
						Software is a desktop based software and it was developed
						using C# .NET and MySql as its database software.
					</p>
				</section>
			</article>

			<article class="work3 clearfix">
				<aside class="col-sm-12 col-md-12 col-xl-5 col-lg-5 work-image-banner">
					<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">

						<span class="cycle-prev">&laquo;</span>
						<span class="cycle-next">&raquo;</span>

						<!-- <div class="cycle-pager"></div> -->

						<div class="slide">
							<a href="images/tourland.png" data-lightbox="roadtrip2">
								<img src="images/tourland.png" alt="tourland">
							</a>
						</div>

						<div class="slide">
							<a href="images/tourusercreate.png" data-lightbox="roadtrip2">
								<img src="images/tourusercreate.png" alt="tourusercreate">
							</a>
						</div>

						<div class="slide">
							<a href="images/touruseredit.png" data-lightbox="roadtrip2">
								<img src="images/touruseredit.png" alt="touruseredit">
							</a>
						</div>

						<div class="slide">
							<a href="images/tourdetails.png" data-lightbox="roadtrip2">
								<img src="images/tourdetails.png" alt="tourdetails">
							</a>
						</div>

						<div class="slide">
							<a href="images/tourhome.png" data-lightbox="roadtrip2">
								<img src="images/tourhome.png" alt="tourhome">
							</a>
						</div>

					</div>
				</aside>
				<section class="col-sm-12 col-md-12 col-xl-7 col-lg-7">
					<h3>Tourism Information System</h3>
					<p>
						The main objective of this study is to develop
						a system that will document and record the names and activities of the of tourism destination in
						Kwara state. This system computerizes tourism into a database that is stored permanently and
						updated
						through stored procedures. The main things that motivated us to design this system was the
						cumbersomeness
						of the manual method used by the tourism board. It could enhance feedback at the tourism board
						and also
						reduces the time needed to prepare the tourism destinations. In this system everyone will be
						able to view
						all the available tourism center in kwara state and the numerous number of things available in
						that tourism
						center. The database was designed using PHP PDO and access to the server was designed using PHP
						(LARAVEL)
						programming language.
					</p>
				</section>
			</article>

			<article class="work4 clearfix">
				<aside class="col-sm-12 col-md-12 col-xl-5 col-lg-5 work-image-banner">
					<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">

						<span class="cycle-prev">&laquo;</span>
						<span class="cycle-next">&raquo;</span>


						<div class="slide">
							<a href="images/warehouseland.png" data-lightbox="roadtrip3">
								<img src="images/warehouseland.png" alt="warehouseland">
							</a>
						</div>

						<div class="slide">
							<a href="images/warehouseland2.png" data-lightbox="roadtrip3">
								<img src="images/warehouseland2.png" alt="warehouseland2">
							</a>
						</div>

						<div class="slide">
							<a href="images/warehousetransactionin.png" data-lightbox="roadtrip3">
								<img src="images/warehousetransactionin.png" alt="warehouse transaction In">
							</a>
						</div>

						<div class="slide">
							<a href="images/warehousetransactionreport.png" data-lightbox="roadtrip3">
								<img src="images/warehousetransactionreport.png" alt="monthly transaction report">
							</a>
						</div>

						<div class="slide">
							<a href="images/warehouseviewmanager.png" data-lightbox="roadtrip3">
								<img src="images/warehouseviewmanager.png" alt="view Managements">
							</a>
						</div>

						<div class="slide">
							<a href="images/warehouseaddcustomer.png" data-lightbox="roadtrip3">
								<img src="images/warehouseaddcustomer.png" alt="add customer">
							</a>
						</div>

						<div class="slide">
							<a href="images/warehousehitrate.png" data-lightbox="roadtrip3">
								<img src="images/warehousehitrate.png" alt="hit reate">
							</a>
						</div>

					</div>
				</aside>
				<section class="col-sm-12 col-md-12 col-xl-7 col-lg-7">
					<h3>Warehouse Management System</h3>
					<p>
						This project was developed using a vanilla PHP, the main purpose of this web based application
						was to allow administrators, warehouse manager and sales manager to carry out some task such as
						add and modify customer deatils, add and modify supplier details, <b>Accept goods In
							(transaction IN)</b>
						and <b>sell Out the goods (transaction OUT)</b>. With this web application they can also view
						the site
						hit rate i.e keeping track the access log of each user, view monthly report, create new product
						as well as
						modifying the existing product.
					</p>
				</section>
			</article>

			<article class="work5 clearfix">
				<aside class="col-sm-12 col-md-12 col-xl-5 col-lg-5 work-image-banner">
					<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">

						<span class="cycle-prev">&laquo;</span>
						<span class="cycle-next">&raquo;</span>

						<!-- <div class="cycle-pager"></div> -->

						<div class="slide">
							<a href="images/reswelcome.png" data-lightbox="roadtrip4">
								<img src="images/reswelcome.png" alt="reswelcome">
							</a>
						</div>

						<div class="slide">
							<a href="images/reslogin.png" data-lightbox="roadtrip4">
								<img src="images/reslogin.png" alt="reslogin">
							</a>
						</div>

						<div class="slide">
							<a href="images/resultupload.png" data-lightbox="roadtrip4">
								<img src="images/resultupload.png" alt="resultupload">
							</a>
						</div>

						<div class="slide">
							<a href="images/resmanagecourse.png" data-lightbox="roadtrip4">
								<img src="images/resmanagecourse.png" alt="resmanagecourse">
							</a>
						</div>

						<div class="slide">
							<a href="images/reschangepass.png" data-lightbox="roadtrip4">
								<img src="images/reschangepass.png" alt="reschangepass">
							</a>
						</div>

					</div>
				</aside>
				<section class="col-sm-12 col-md-12 col-xl-7 col-lg-7">
					<h3>Result Computation System</h3>
					<p>
						This study was carried out to verify all the manual process involved in generating Students
						Examination Result and to seek a way of automating the system for effective operations. Since
						there is continuous moves towards technological advances that enhanced productivity of labor and
						free human beings of task more economically by machines. Computer and its appreciations Have
						become vital tools in economic, industrial and social development of advanced countries Of the
						world .This system is designed to efficiently handle processes like inputting scores, Storing
						results, classifying the grade points automatically calculated, and interpreting data of
						Students overall result. The usual manual process now reached a level where it is difficult for
						The available manpower to cope with the magnitude of examination work, in the given time Span;
						The imbalance between the manpower availability and the magnitude of the examination Work result
						in the delay in the declaration of results.
						This Software is a desktop based software and it was developed using C# .NET and MySql as its
						database software.
					</p>
				</section>
			</article>


			<article class="work5 clearfix">

				<aside class="col-sm-12 col-md-12 col-xl-5 col-lg-5 work-image-banner">
					<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">

						<span class="cycle-prev">&laquo;</span>
						<span class="cycle-next">&raquo;</span>


						<div class="slide">
							<a href="images/zuri1.png" data-lightbox="roadtrip5">
								<img src="images/zuri1.png" alt="header and box">
							</a>
						</div>

						<div class="slide">
							<a href="images/zuri2.png" data-lightbox="roadtrip5">
								<img src="images/zuri2.png" alt="programs">
							</a>
						</div>

						<div class="slide">
							<a href="images/zuri3.png" data-lightbox="roadtrip5">
								<img src="images/zuri3.png" alt="programmdetail">
							</a>
						</div>

						<div class="slide">
							<a href="images/zuri4.png" data-lightbox="roadtrip5">
								<img src="images/zuri4.png" alt="black banner">
							</a>
						</div>

						<div class="slide">
							<a href="images/zuri5.png" data-lightbox="roadtrip5">
								<img src="images/zuri5.png" alt="zuriform1">
							</a>
						</div>

						<div class="slide">
							<a href="images/zuri6.png" data-lightbox="roadtrip5">
								<img src="images/zuri6.png" alt="zuriform2">
							</a>
						</div>

						<div class="slide">
							<a href="images/zuri7.png" data-lightbox="roadtrip5">
								<img src="images/zuri7.png" alt="zurifooter">
							</a>
						</div>

					</div>

				</aside>
				<section class="col-sm-12 col-md-12 col-xl-7 col-lg-7">
					<h3>Zuri Training Page</h3>
					<p>
						This project was developed on April 13 2021, As a solution to the code competition held at zuri
						training internship program, which is power by Ingressive For Good <strong>I4G</strong>. I
						designed this page using ordinary html, css, and small JavaScript, font-awesome was use for the
						icons.<br>
						you can visit the cloned site here <a href="https://saad-saheed.github.io/zuri_clone/"
							target="_blank" style="color: #ff9800; font-size: 1rem;">zuri clone</a><br>

						you can also visit the original site here <a href="https://training.zuri.team/" target="_blank"
							style="color: #ff9800; font-size: 1rem;">zuri Training</a>
					</p>
				</section>
			</article>



			<article class="work6 clearfix">
				<aside class="col-sm-12 col-md-12 col-xl-5 col-lg-5 work-image-banner">
					<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">
							
						<span class="cycle-prev">&laquo;</span>
						<span class="cycle-next">&raquo;</span>

						
						<div class="slide">
							<a href="images/market1.png" data-lightbox="roadtrip6">
								<img src="images/market1.png" alt="all product">
							</a>
						</div>
	
						<div class="slide">
							<a href="images/market2.png" data-lightbox="roadtrip6">
								<img src="images/market2.png" alt="single product">
							</a>							
						</div>
	
						<div class="slide">
							<a href="images/market3.png" data-lightbox="roadtrip6">
								<img src="images/market3.png" alt="register">
							</a>						
						</div>

						<div class="slide">
							<a href="images/market4.png" data-lightbox="roadtrip6">
								<img src="images/market4.png" alt="market login">
							</a>
						</div>
	
						<div class="slide">
							<a href="images/market5.png" data-lightbox="roadtrip6">
								<img src="images/market5.png" alt="reset password">
							</a>							
						</div>
							
						<div class="slide">
							<a href="images/market6.png" data-lightbox="roadtrip6">
								<img src="images/market6.png" alt="my products">
							</a>
						</div>

						<div class="slide">
							<a href="images/market7.png" data-lightbox="roadtrip6">
								<img src="images/market7.png" alt="edit products">
							</a>
						</div>

					</div>
				</aside>
				<section class="col-sm-12 col-md-12 col-xl-7 col-lg-7">
					<h3>Market web App</h3>
					<p>
						This project was developed using a vanilla PHP, the main purpose of this web based application
						was to allow people to register, upload and manage their products  <b>This project was done as a solution to side hustel 3.0 training (backend track) final task.</b>
						link to website: <a href="https://saadsaheed.com.ng/market" target="_blank" style="color: #ff9800; font-size: 1rem;">Markify</a>
					</p>
				</section>
			</article>


		</section>

		<section class="experience row" id="experience">
			<div class="absolute clearfix">
				<h2 class="">Experiences And Certifications</h2>

				<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
					<!-- <h2 style="margin: 0;">Education</h2> -->
					<p>
						<span>Name: </span>National Diploma in Computer Science
					</p>
					<p>
						<span>Duration: </span> 2017-2019
					</p>

					<p>
						<span>Institution: </span> Kwara State Polytechnic
					</p>

					<p>
						<span>Country: </span> Nigeria
					</p>
				</div>

				<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
					<p>
						<span>Name: </span>Advanced Styling with Responsive Design
					</p>
					<p>
						<span>Duration: </span>2020-2021
					</p>
					<p>
						<span>Organisation: </span>Cousera
					</p>

					<p>
						<span>Certificate URL: </span>
						<a href="https://www.coursera.org/account/accomplishments/certificate/V9TC92PN3AWZ">view
							certificate</a>
					</p>
				</div>

				<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
					<p>
						<span>Name: </span>Interactivity with JavaScript
					</p>

					<p>
						<span>Duration: </span>2020-2021
					</p>

					<p>
						<span>Organisation: </span>Cousera
					</p>

					<p>
						<span>Certificate URL: </span>
						<a href="https://www.coursera.org/account/accomplishments/certificate/4PYQR99L68XL">view
							certificate</a>
					</p>
				</div>

				<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
					<p>
						<span>Name: </span>Introduction to CSS3
					</p>

					<p>
						<span>Duration: </span>2020-2021
					</p>

					<p>
						<span>Organisation: </span>Cousera
					</p>

					<p>
						<span>Certificate URL: </span>
						<a href="https://www.coursera.org/account/accomplishments/certificate/CNGHGYSJMR2C">view
							certificate</a>
					</p>
				</div>

				<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
					<p>
						<span>Name: </span>Introduction to HTML5
					</p>

					<p>
						<span>Duration: </span>2020-2021
					</p>

					<p>
						<span>Organisation: </span>Cousera
					</p>

					<p>
						<span>Certificate URL: </span>
						<a href="https://www.coursera.org/account/accomplishments/certificate/URLJ3AM9B9GL">view
							certificate</a>
					</p>
				</div>

				<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
					<p>
						<span>Name: </span>PHP course
					</p>

					<p>
						<span>Duration: </span>2020
					</p>

					<p>
						<span>Organisation: </span>Sololearn
					</p>

					<p>
						<span>Certificate URL: </span>
						<a href="https://www.sololearn.com/Certificate/1059-7013722/jpg/">view certificate</a>
					</p>
				</div>

				<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
					<p>
						<span>Name: </span>C# course
					</p>

					<p>
						<span>Duration: </span>2019
					</p>

					<p>
						<span>Organisation: </span>Sololearn
					</p>

					<p>
						<span>Certificate URL: </span>
						<a href="https://www.sololearn.com/Certificate/1080-7013722/jpg/">view certificate</a>
					</p>
				</div>

				<div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
					<p>
						<span>Name: </span>HTML course for beginer
					</p>

					<p>
						<span>Duration: </span>2020
					</p>

					<p>
						<span>Organisation: </span>Udemy
					</p>

					<p>
						<span>Certificate URL: </span>
						<a href="https://www.udemy.com/certificate/UC-4cb3616f-cbec-42e4-b19f-db7c3beec5b5/">view
							certificate</a>
					</p>
				</div>
			</div>
		</section>

		<section class="skill row" id="skill">
			<div class="skill-container clearfix">
				<h2>Skills</h2>
				<article class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
					<ul>
						<li><i class="fa fa-code fa-lg"></i> PHP(LARAVEL)</li>
						<li><i class="fa fa-code fa-lg"></i> C# (See Sharp)</li>
						<li><i class="fa fa-code fa-lg"></i> JAVASCRIPT</li>
					</ul>

					<ul>
						<li><i class="fa fa-html5 fa-lg"></i> HTML 5</li>
						<li><i class="fa fa-css3 fa-lg"></i> CSS 3</li>
						<li><i class="fa fa-css3 fa-lg"></i> BOOTSTRAP</li>
					</ul>

				</article>
			</div>
		</section>

		<section class="contact row" id="contact">
			<div class="contact-container clearfix">
				
				<!-- <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12 clearfix"> -->
					
					<ul class="col-sm-12 col-md-12 col-xl-5 col-lg-5">
						<h2>Contact me</h2>
						<p>For more information you can quickly reach out to me through the following channels.</p>
						<li>
							<a href="https://www.facebook.com/saheed.saad.7" target="_blank"> <i
									class="fa fa-facebook fa-lg"></i> Facebook</a>
						</li>

						<li>
							<a href="https://wa.me/2348161150559?text=hello+saheed" target="_blank"><i
									class="fa fa-whatsapp fa-lg"></i> WhatsApp</a>
						</li>

						<li>
							<a href="mailto:janbaoda@gmail.com" target="_blank"><i class="fa fa-envelope"></i> Send
								Email</a>
						</li>

						<li>
							<a href="tel:+2348161150559" target="_blank"><i class="fa fa-phone fa-lg fa-spin"></i> Call
								me on </a>+2348161150559
						</li>
					</ul>

					
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="clearfix col-sm-12 col-md-12 col-xl-7 col-lg-7">
						<h2 class="">Leave a message</h2>

						<?php
							if (isset($feedback) and isset($feedback['general'])) {?>
						<h4 class="error">
							<?php
								echo (isset($feedback['general']) ? $feedback['general'] : "");
							?>
						</h4>
						<?php
							}
						
							if (isset($feedback) and isset($feedback['success'])) {?>
						<h4 class="success">
							<?php
								echo (isset($feedback['success']) ? $feedback['success'] : "");
						
							?>
						</h4>
						<?php
							}
							?>

						
						<div class="form-group name col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<label for="name">Full Name</label>
							<input type="text" name="name" placeholder="Name" value="" id="name">
							<?php //echo isset($clean_data['name']) ? $clean_data['name'] : "" ?>
							<h4 class="error"><?php
                                echo (isset($feedback['name']) ? $feedback['name'] : "");
                                ?></h4>
						</div>

						<div class="form-group email col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<label for="email">Email Address</label>
							<input type="email" name="email" value="" placeholder="Email Address" id="email">
							<?php //echo isset($clean_data['email']) ? $clean_data['email'] : "" ?>
							<h4 class="error"><?php
                                echo (isset($feedback['email']) ? $feedback['email'] : "");
                                ?></h4>
						</div>

						<div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<label for="message">Message</label>
							<textarea name="message" id="message" rows="8" placeholder="leave a message"></textarea>
							<?php //echo isset($clean_data['message']) ? $clean_data['message'] : "" ?>
							<h4 class="error"><?php
                                echo (isset($feedback['message']) ? $feedback['message'] : "");
                                ?></h4>
						</div>

						<div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="submit" value="Send">
						</div>

					</form>
				
							<?php
								$feedback = [];
								unset($feedback);

							?>
				<!-- </div> -->



				



			</div>

		</section>
	</main>


	<footer class="footer container-fluid">
		<div class="row">
			<p class="col-xl-12 col-lg-12 col-sm-12">&copy;
				<script>document.write(new Date().getFullYear());</script> All Right Reserved | @Saad Saheed
			</p>
		</div>
	</footer>
</body>

</html>