<header>
	<a href="view_enquiries.php"><img class="logo_disp_img" src="images/logo.png" alt="AniMerch"/></a>
	<span id="top_h1">Management Site.</span>
	<p>Authorized Personnels only.</p>
</header>

<nav>		
	<ul id="navmenu" class="dropdown">
		<li>
			<div class="dropdown">
				<a  onclick="dropNav('product_management')"><button class="navButton">PRODUCT MANAGEMENT</button></a>
				<div id="product_management" class="dropContent">
					<a href="create_product.php">Create Product</a>
					<a href="edit_product.php">Edit Product</a>
					<a href="delete_product.php">Delete Product</a>
					<a href="view_products.php">View Product</a>
				</div>
			</div>
		</li>
		<li>
			<div class="dropdown"> 
				<a onclick="dropNav('enquiry_management')"><button class="navButton">ENQUIRY MANAGEMENT</button></a>
				<div id="enquiry_management" class="dropContent">
					<a href="delete_enquiry.php">Delete Enquiry</a>
					<a href="view_enquiries.php">View Enquiry</a>
				</div>
			</div>
		</li>
		<li>
			<div class="dropdown"> 
				<a onclick="dropNav('user_management')"><button class="navButton">USER MANAGEMENT</button></a>
				<div id="user_management" class="dropContent">
					<a href="create_user.php">Create User</a>
					<a href="edit_user.php">Edit User</a>
					<a href="delete_user.php">Delete User</a>
					<a href="view_users.php">View User</a>
				</div>
			</div>
		</li>
		<li><a href="logout.php"><button class="navButton">LOG OUT</button></a> </li>
	</ul>
</nav>