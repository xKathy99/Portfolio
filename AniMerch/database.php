<?php
	function createDB()
	{
		require_once "settings.php";
		// Create connection
		$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
	
		if ($conn)
		{
			// Create databse
			$query = "CREATE DATABASE IF NOT EXISTS AniMerchDB";
			$result = mysqli_query($conn, $query);
			
			/*if ($result)
			{
				echo "Database created successfully";
			}	
			else
			{
				echo "Error creating database.";
			}*/
			
			mysqli_close($conn);
		}
		else
		{
			echo "Unable to connect to the database.";
		}
	}
	
	function createUserTable()
	{
		require_once "settings.php";
		
		// Create connection
		$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
		if ($conn)
		{
			// Create databse
			$query = "CREATE TABLE IF NOT EXISTS userTable (
			id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			username VARCHAR(255) NOT NULL UNIQUE,
			password VARCHAR(255) NOT NULL,
			privilege INT NOT NULL
			)";
			$result = mysqli_query($conn, $query);
			/*if ($result)
			{
				echo "Database created successfully";
			}	
			else
			{
				echo "Error creating table.";
			}*/
			
			mysqli_close($conn);
		}
		else
		{
			createDB();
		}
	}
	
	function createProductTable()
	{
		require_once "settings.php";
	
		// Create connection
		$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
		if ($conn)
		{
			// Create databse
			$query = "CREATE TABLE IF NOT EXISTS productTable (
			id VARCHAR(30) PRIMARY KEY NOT NULL,
			productname VARCHAR(255) NOT NULL,
			source VARCHAR(255) NOT NULL,
			sourcelink VARCHAR(255) NOT NULL,
			description VARCHAR(700) NOT NULL,
			status VARCHAR (15) NOT NULL,
			price VARCHAR(20) NOT NULL,
			category INT NOT NULL,
			imagelink VARCHAR(255) NOT NULL 
			)";
			$result = mysqli_query($conn, $query);
			
			/*if ($result)
			{
				echo "Table created successfully";
			}	
			else
			{
				echo "Error creating table.";
			}*/
			
			mysqli_close($conn);
		}
		else
		{
			createDB();
		}
	}
	
	function createEnquiryTable()
	{
		require_once "settings.php";
	
		// Create connection
		$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
		if ($conn)
		{
			// Create databse
			$query = "CREATE TABLE IF NOT EXISTS enquiryTable (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			firstname VARCHAR(25) NOT NULL, 
			lastname VARCHAR(25) NOT NULL,
			email VARCHAR(255) NOT NULL,
			subject VARCHAR(255) NOT NULL,
			address VARCHAR(40) NOT NULL,
			city VARCHAR(20) NOT NULL,
			state VARCHAR(20) NOT NULL,
			postcode INT(5) NOT NULL,
			phonenum INT(10) NOT NULL,
			product VARCHAR(255) NOT NULL,
			comment VARCHAR(255)
			)";
			$result = mysqli_query($conn, $query);
			
			/*if ($result)
			{
				echo "Table created successfully";
			}	
			else
			{
				echo "Error creating table.";
			}*/
			
			mysqli_close($conn);
		}
		else
		{
			createDB();
		}
	}
	
	function masterUser()
	{
		require_once "settings.php";
	
		// Create connection
		$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
		$hashed_password = password_hash("cwaphpsql", PASSWORD_DEFAULT);
		if ($conn)
		{
			// Create databse
			$query = "INSERT IGNORE INTO userTable 
			(username, password, privilege)
			VALUES ('owner', '$hashed_password', '1')";
			$result = mysqli_query($conn, $query);
			/*if ($result)
			{
				echo "Master user has been added";
			}	
			else
			{
				createUserTable();
			}*/
			
			mysqli_close($conn);
		}
		else
		{
			echo "Unable to connect to the database.";
		}
	}
	
	function defaultProductTable()
	{
		require_once "settings.php";
		
		// Create connection
		$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		
		if ($conn)
		{
			$query = "INSERT IGNORE INTO productTable (
				id, productname, source, sourcelink,
				description, status,
				price, category, imagelink
			)
			VALUES 
			(
				'Saber15',
				'Saber ~15th Anniversary Version~',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/9216/Saber+15th+Celebration+Dress+Ver.html',
				'Celebrating 15 years since the released of Fate/Stay Night, 
				it is only right for Saber to dress up for the occassion.
				The sword she has is also replaced with a bouquet for at this moment,
				she is not a knight, but a maiden.',
				'Preorder',
				'RM 550',
				'1',
				'images/Saber_zoom1.jpg'
			),
			(
				'Rin15',
				'Rin Tohsaka ~15th Anniversary Version~',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/9217/Rin+Tohsaka+15th+Celebration+Dress+Ver.html',
				'Celebrating 15 years since the released of Fate/Stay Night, 
				our favourite tsundere, Rin wears her elegant red dress as she is prepared
				to be the most splendid among the other Fate Stay Night female protagonists. 
				Her red dress also matches her servant, Archer.',
				'Preorder',
				'RM 520',
				'1',
				'images/Rin_zoom1.jpg'
			),
			(
				'Sakura15',
				'Sakura Matou ~15th Anniversary Version~',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/9218/Sakura+Matou+15th+Celebration+Dress+Ver.html',
				'Celebrating 15 years since the released of Fate/Stay Night, 
				our lovely kouhai, Sakura dressed up in the violet blue dress. 
				The purple roses she holds signifies her pride as a kouhai to 
				always support her senpai, as they symbolise pride, esteem and 
				dignity in the language of flower.',
				'Preorder',
				'RM 520',
				'1',
				'images/Sakura_zoom1.jpg'
			),
			(
				'SalterKimono',
				'Saber Alter: Kimono Version',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/9361/Saber+Alter+Kimono+Ver.html',
				'From the anime movie series \"Fate/Stay Night: Heaven\'s Feel\", 
				Saber has been cursed to become Saber Alter. This figure of Saber Alter
				is based on Takeshi Takeuchi\'s illustration in the magazine.',
				'Preorder',
				'RM 895',
				'1',
				'images/SalterKimono.jpg'
			),
			(
				'ShinjiSakura',
				'Shinji Matou and Sakura Matou',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/8608/figma+Shinji+Matou+Sakura+Matou.html',
				'From the anime movie series \"Fate/Stay Night: Heaven\'s Feel\", 
				the Matou family has sworn to do anyting to make the family great again. 
				Shinji and Sakura are the heirs to the family, one with the purer bloodline, 
				the other with a mysterious book.',
				'Preorder',
				'RM 450',
				'1',
				'images/ShinjiSakura.jpg'
			)";
			
			$result = mysqli_query($conn, $query);
			
			/*if ($result)
			{
				echo "Product data created successfully";
			}	
			else
			{
				echo "Product data not created.";
			}*/
			
			$query = "INSERT IGNORE INTO productTable (
				id, productname, source, sourcelink,
				description, status,
				price, category, imagelink
			)
			VALUES
			(
				'nendo_miku',
				'Nendoroid Hatsune Miku',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/9355/Nendoroid+Hatsune+Miku+V4X.html',
				'Presenting to you: Hatsune Miku, the world-renowned Japanese virtual singer! 
				She is well known for the songs \"Ievan Polka\", \"Romeo and Cinderella\",
				and so much more, in so many different genres! Now you can get to have her in 
				the form of a Nendoroid, with just the right amount of loving adorable-ness for any other Miku fan!',
				'Available',
				'RM 80',
				'2',
				'images/mikumain.jpg'
			),
			(
				'nendo_inu',
				'Nendoroid Inuyasha',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/9339/Nendoroid+Inuyasha.html',
				'Meet the titular protagonist of the popular 90s manga and anime series, \"Inuyasha\"-- Inuyasha himself! 
				Born of a dog demon father and a human mother, except for his ears, he has both the physical appearance and conscience of a human.
				However, one should not forget he is of a supernatural descent- indeed, he is what the Japanese would call a <em>yokai</em>.
				Today, he is available in Nendoroid form, which can fully showcase his unique ears and character!',
				'Available',
				'RM 80',
				'2',
				'images/inumain.jpg'
			),
			(
				'nendo_jojo',
				'Nendoroid Josuke Higashikata',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/9193/Nendoroid+Josuke+Higashikata.html',
				'Make way for the mild-mannered protagonist of \"JoJo\'s Bizarre Adventure: Diamond is Unbreakable\"- Josuke \"JoJo\" Higashikata!
				With well-styled purple hair and expressive blue eyes, all of this character\'s attributes are finely noted down, to the very last details, on our proudly
				displayed figure of the Josuke Higashikata Nendoroid.',
				'Available',
				'RM 80',
				'2',
				'images/jojomain.jpg'
			),
			(
				'nendo_kagu',
				'Nendoroid Kaguya-sama',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/9248/Nendoroid+Kaguya+Shinomiya.html',
				'Kaguya Shinomiya: the well-admired student council vice president from Shuchiin Academy!
				She is the protagonist from the romantic comedy manga and anime series: \"Kaguya-sama: Love is War\".
				Even as a fictional character, she can now exist in the form of a Nendoroid figure, in all her refined glory!',
				'Available',
				'RM 80',
				'2',
				'images/kagumain.jpg'
			),
			(
				'nendo_pchan',
				'Nendoroid Platelet',
				'GoodSmile Company',
				'https://www.goodsmile.info/en/product/7831/Nendoroid+Platelet.html',
				'Last but not least, we present to you, the <strong>super <em>kawaii</em></strong> character: PLATELET-CHAN!
				Surely everyone would know of the amazingly educational manga and anime series \"Cells at Work!\",
				which depicts how the cells of the human body carry out their function to protect the body.
				As her name suggests, Platelet-chan is a very vital component of the human blood to protect wounds by clotting them!
				Platelet-chan is now available in Nendoroid form, in half the size but twice the cuteness!',
				'Available',
				'RM 80',
				'2',
				'images/pchanmain.jpg'
			)";
			
			$result = mysqli_query($conn, $query);
			
			/*if ($result)
			{
				echo "Product data created successfully";
			}	
			else
			{
				echo "Product data not created.";
			}*/
			
			$query = "INSERT IGNORE INTO productTable (
				id, productname, source, sourcelink,
				description, status,
				price, category, imagelink
			)
			VALUES
			(
				'stormtrooper',
				'Bandai Star Wars The Rise of Skywalker: First Order Stormtrooper',
				'JapanToys',
				'https://www.japantoys.com.au/model-kits/bandai-star-wars-the-rise-of-skywalker-first-order-stormtrooper.html',
				'As the latest symbol of power of the First Order in the Star Wars\' final trilogy, 
				they are the enforcers of the ruling by Surpreme Leader Kylo Ren.
				Their designs were based on the clone troopers from the Galatic Empire.',
				'Preorder',
				'RM 260',
				'3',
				'images/mk2.jpg'
			),
			(
				'BB8D0',
				'Bandai Star Wars: The Rise of Skywalker BB-8 &#169; D-0 Diorama Set',
				'JapanToys',
				'https://www.japantoys.com.au/model-kits/bandai-star-wars-the-rise-of-skywalker-bb8-d0-diorama-set.html',
				'From the final trilogy of the Star Wars franchise, BB-8 and D-0 are the few cutest mascot that were seen. 
				Outside of their really cute appearance,
				they also had important roles in the movies such as piloting and showing the way. 
				Now, you can have the both of them in one go with this model kit set.',
				'Preorder',
				'RM 250',
				'3',
				'images/mk1.jpg'
			),
			(
				'Nu-Zeon',
				'Bandai Gundam Build Divers Re:RISE HGBD:R 1/144 Nu-Zeon Gundam',
				'JapanToys',
				'https://www.japantoys.com.au/model-kits/bandai-gundam-build-divers-rerise-nu-zeon-gundam.html',
				'Built and piloted by Caption Zion in Gundam Build Drivers Re:RISE, the RX-93N04 v-Zeon Gundam is known for
				its merciless one-hit kil attacks. The set includes its iconic Zeonic Sword.',
				'Preorder',
				'RM 250',
				'3',
				'images/mk3.jpg'
			),
			(
				'SonGoku',
				'Bandai Dragon Ball Z Son Goku Plastic Model',
				'JapanToys',
				'https://www.japantoys.com.au/model-kits/bandai-dragon-ball-z-son-goku.html',
				'Dragon ball as one of the longest running anime series all started from a single man, Son Goku. 
				From when he still had a tail, until he challenges many strong opponents, 
				we were all there watching and growing with him. This model features flexibility, 
				whether to have the goofy Goku or the fighting Goku,
				all up to how you build him.',
				'Preorder',
				'RM 220',
				'3',
				'images/mk4.jpg'
			),
			(
				'DeathArmy',
				'Bandai Mobile Fighter G Gundam HGFC 1/144 Death Army',
				'JapanToys',
				'https://www.japantoys.com.au/model-kits/bandai-mobile-fighter-g-gundam-death-army.html',
				'Appearing in Mobile Fighter G Gundam, the JDG-009X Death Army can be said to be backbone of the Devil Gundam\'s Legion. 
				These machines are piloted by zombie soldiers who have been corrupted by the Devil Gundam cells.',
				'Preorder',
				'RM 110',
				'3',
				'images/mk5.jpg'
			)";
			
			$result = mysqli_query($conn, $query);
			
			/*if ($result)
			{
				echo "Product data created successfully";
			}	
			else
			{
				echo "Product data not created.";
			}*/
			
			$query = "INSERT IGNORE INTO productTable (
				id, productname, source, sourcelink,
				description, status,
				price, category, imagelink
			)
			VALUES
			(
				'earring',
				'Sailor Moon Cuff Earring Set',
				'Hot Topic',
				'https://www.hottopic.com/product/sailor-moon-cuff-earring-set/11538845.html?cgid=pop-culture-shop-by-license-sailor-moon#start=13',
				'3 pair of Sailor Moon earrings, comes in silver, gold and rose gold-plated Alloy. Cuff chain in measurement of 2 1/2inch.',
				'Available',
				'RM 40',
				'4',
				'images/earring1.png'
			),
			(
				'tshirt',
				'Sailor Moon Artemis Girls Crop T-Shirt',
				'Hot Topic',
				'https://www.hottopic.com/product/sailor-moon-artemis-girls-crop-t-shirt/11767995.html?cgid=pop-culture-shop-by-license-sailor-moon#start=58',
				'A super soft crop top which is comfortable for daily use. Printed with Artemis figure from Sailor Moon, you\'ll be amazed with the cuteness! Made of 95% rayon and 5% spandex.',
				'Available',
				'RM 87',
				'4',
				'images/tshirt1.png'
			),
			(
				'giftset',
				'Sailor Moon Gift Set',
				'Box Lunch',
				'https://www.boxlunch.com/product/sailor-moon-gift-set/12032853.html?cgid=pop-culture-shop-by-license-sailor-moon#start=10',
				'Get this set for your friends who are the fans of Sailor Moon now! This gift set includes a notebook, ceramic mug and a cute pink bow keychain.',
				'Available',
				'RM 86',
				'4',
				'images/giftset2.png'
			),
			(
				'canvaspaint',
				'One Piece Canvas Smiling Straw Hat Pirates',
				'Luffy Shop',
				'https://luffy-shop.com/collections/one-piece-products/products/one-piece-wall-decor',
				'Straw Hat Pirates on canvas! This 5-piece canvas is one of the bestseller items we have! With high-definition printing, 
				Straw Hat Pirates will have your eyes glued to it.',
				'Available',
				'RM 100',
				'4',
				'images/canvaspaint.png'
			),
			(
				'totoro',
				'DIY Totoro Figure Classic Kids Toys',
				'Ghibli Shop',
				'https://ghibli-shop.com/shop/my-neighbor-totoro/figurines-toys/diy-totoro-figure-classic-kids-toys',
				'A Studio Ghibli animated series, Totoro figurines comes in set. Made of PVC which comes with 5 different figurines!',
				'Available',
				'RM 40',
				'4',
				'images/totoro1.png'
			)";
			
			$result = mysqli_query($conn, $query);
			/*if ($result)
			{
				echo "Product data created successfully";
			}	
			else
			{
				echo "Product data not created.";
			}*/
			
			mysqli_close($conn);
		}
		else
		{
			echo "Unable to connect to the database.";
		}
	}
	
?>
