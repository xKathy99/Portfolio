<nav>		
		<ul id="navmenu" class="dropdown">
			<li> <a href="index.php"><button class="navButton">HOME</button></a> </li>
			<li>
				<div class="dropdown">
				<a onclick="dropNav('prodDropdown')"><button class="navButton">PRODUCTS</button></a>
				<div id="prodDropdown" class="dropContent">
				<a href="product1.php">Fate/Stay Night: Heaven's Feel</a>
				<a href="product2.php">Nendoroids</a>
				<a href="product3.php">Model Kits</a>
				<a href="product4.php">Seasonal Limited</a>
				</div>
				</div>
			</li>
			<li>
				<div class="dropdown"> 
				<a onclick="dropNav('membDropdown')"><button class="navButton">MEMBERS</button></a>
				<div id="membDropdown" class="dropContent">
				<a href="aboutme1.php">Jake</a>
				<a href="aboutme2.php">Natasya</a>
				<a href="aboutme3.php">Raymond</a>
				<a href="aboutme4.php">Kathy</a>
				</div>
				</div>
			</li>
			<li> <a href="enquiry.php"><button class="navButton">CONTACT US</button></a> </li>
			<li><a href="login.php"><button class="navButton">LOGIN</button></a></li>
		</ul>
	
			<script language="javascript">highlightCurrentPage()</script>
			<script language="javascript">hide()</script>
</nav>
