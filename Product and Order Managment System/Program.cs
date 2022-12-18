using System;

namespace PT13_ProductAndOrderManagementSystem
{
    class Program
    {
        static void Main(string[] args)
        {
            OverallApprovedProductListing allMyProducts = new OverallApprovedProductListing();
            OverallUserListing allMyUsers = new OverallUserListing();

            Admin dummyAdmin01 = new Admin("Hanna", "A0001", "adminpwd", "admin@admin.mail.com", 1988, UserGender.Female);
            allMyUsers.AddToUserListing(dummyAdmin01);

            //For Regustration
            Merchant myMerchant01 = new Merchant();
            allMyUsers.AddToMerchantListing(myMerchant01);
 
            Customer myCustomer01 = new Customer(); 
            allMyUsers.AddToCustomerListing(myCustomer01);

            Merchant dummyMerchant01 = new Merchant("Tom", "M3038", "merchpwd", "merchant@merchantmail.com", 1986, UserGender.Male);
            allMyUsers.AddToUserListing(dummyMerchant01);
            allMyUsers.AddToMerchantListing(dummyMerchant01);
            dummyMerchant01.Register();
            dummyAdmin01.ApproveMerchantReg(dummyMerchant01);
            Product[] dummyMProd01s = {
                new Product(dummyMerchant01, "P100000", "Striped Giraffe Plush", ProductCategory.Toys, 12.50),
                new Product(dummyMerchant01, "P100001", "Spotted Zebra Plush", ProductCategory.Toys, 18.50),
                new Product(dummyMerchant01, "P100002", "Three-Legged Zebra Plush", ProductCategory.Toys, 15.50),
                new Product(dummyMerchant01, "P100008", "Powdered Fish Oil", ProductCategory.Health, 85.50)};
            
            foreach (Product p in dummyMProd01s)
            {
                dummyAdmin01.ApproveProduct(p);
                dummyMerchant01.AddProduct(p);
                allMyProducts.AddToProductsListing(p);
            }

            Merchant dummyMerchant02 = new Merchant();
            allMyUsers.AddToUserListing(dummyMerchant02);
            allMyUsers.AddToMerchantListing(dummyMerchant02);
            dummyMerchant02.Register();
            dummyAdmin01.ApproveMerchantReg(dummyMerchant02);
            Product[] dummyMProd02s = {
                new Product(dummyMerchant02, "P100003", "Wireless Electronic Chainsaw", ProductCategory.Tools, 180.50),
                new Product(dummyMerchant02, "P100004", "Narrow-Screen TV", ProductCategory.Entertainment, 25.50),
                new Product(dummyMerchant02, "P100005", "Non-Wireless Roomba", ProductCategory.Electronics, 15.50),
                new Product(dummyMerchant02, "P100006", "Non-Spicy Ghost Pepper Chips", ProductCategory.Food, 10.50),
                new Product(dummyMerchant02, "P100007", "Premium Non-Salted Salted Egg", ProductCategory.Food, 20.50)};
            
            foreach (Product p in dummyMProd02s)
            {
                dummyAdmin01.ApproveProduct(p);
                dummyMerchant02.AddProduct(p);
                allMyProducts.AddToProductsListing(p);
            }

            Merchant dummyMerchant03 = new Merchant(); 
            allMyUsers.AddToUserListing(dummyMerchant03);
            allMyUsers.AddToMerchantListing(dummyMerchant03);
            dummyMerchant03.Register();
            dummyAdmin01.ApproveMerchantReg(dummyMerchant03);
            Product[] dummyMProd03s = {
                new Product(dummyMerchant03, "P100008", "Meth", ProductCategory.Health, 50.50),
                new Product(dummyMerchant03, "P100009", "Completely Non-Suspicious Diet Tea", ProductCategory.Health, 25.50)};
            
            foreach (Product p in dummyMProd03s) 
            {
                dummyMerchant03.AddProduct(p);
            }

            Merchant dummyMerchant04 = new Merchant(); 
            dummyMerchant04.Register();
            

            Customer dummyCustomer01 = new Customer("Kathy", "C0981", "mypassword", "101212259@students.swinburne.edu.my", 1999, UserGender.Female); 
            allMyUsers.AddToCustomerListing(dummyCustomer01);

            dummyCustomer01.Register(); //To Confirm
            CustomerOrder[] dummyCOrd01s = {
                new CustomerOrder(dummyCustomer01, dummyMerchant01.MerchProdList[0], 3, CustomerPaymentType.Cash),
                new CustomerOrder(dummyCustomer01, dummyMerchant01.MerchProdList[1], 1, CustomerPaymentType.Coupon),
                new CustomerOrder(dummyCustomer01, dummyMerchant01.MerchProdList[2], 5, CustomerPaymentType.Cash),
                new CustomerOrder(dummyCustomer01, dummyMerchant01.MerchProdList[3], 2, CustomerPaymentType.Cash)}; //to be accepted by Merchant Later
            
            foreach (CustomerOrder o in dummyCOrd01s)
            {
                dummyCustomer01.AddOrder(o);
                dummyCustomer01.ConfirmOrder(o);
                dummyMerchant01.AddCustomerOrderRecord(o);
            }
            dummyMerchant01.UpdateCustOrderStatus(dummyCustomer01.CustOrderList[0], CustomerOrderStatus.Accepted);
            dummyMerchant01.UpdateCustOrderStatus(dummyCustomer01.CustOrderList[1], CustomerOrderStatus.Accepted);
            Invoice dummyInvoive01 = new Invoice(dummyCustomer01.CustOrderList[0], "INV20407");
            Invoice dummyInvoive02 = new Invoice(dummyCustomer01.CustOrderList[1], "INV20408");
            dummyAdmin01.IssueInvoice(dummyInvoive01, dummyMerchant01);
            dummyAdmin01.IssueInvoice(dummyInvoive02, dummyMerchant01);
            dummyMerchant02.UpdateCustOrderStatus(dummyCustomer01.CustOrderList[2], CustomerOrderStatus.Rejected);


            Console.WriteLine("\n \n \n \n \n \n \n \n \n \n \n \n \n \n\n \n \n \n \n \n"); 
            Console.WriteLine("\n \n \n \n \n \n \n \n \n \n \n \n \n \n\n \n \n \n");
            Console.WriteLine("\n \n \n=================================================");



            int optionIntro;

            Console.WriteLine("\nWelcome to Offer Galore!");
            Console.WriteLine("Please enter the option number to proceed: ");
            Console.WriteLine("1) Login \t2) Register");

            optionIntro = int.Parse(Console.ReadLine());

            switch (optionIntro)
            {
                case 1: //Login Option
                {
                    string userID;
                    string userPwd;

                    int optionLogin;


                    Console.WriteLine("You have chosen Login! ");
                    Console.WriteLine("Are you a: ");

                    Console.WriteLine("1) Customer \t2) Merchant \t3) Admin");
                    optionLogin = int.Parse(Console.ReadLine());

                    Console.WriteLine("User ID: ");
                    userID = Console.ReadLine();

                    Console.WriteLine("Password: ");
                    userPwd = Console.ReadLine();

                    if (optionLogin == 1)
                    {
                        int browseChoice;
                        string makeOrd;
                        string toLogOut;

                        dummyCustomer01.LogIn(userID, userPwd);

                        Console.WriteLine("Browse our products by: ");
                        //Console.WriteLine("1) All Products \t2) Category \t3) Name \t4) Price \t5) Merchant");
                        Console.WriteLine("1) All Products \t2) Category \t3) Name \t4) Price");

                        browseChoice = int.Parse(Console.ReadLine());

                        if (browseChoice == 1)
                        {
                            Console.WriteLine("You have chosen to all products!");
                            dummyCustomer01.Browse(allMyProducts);
                        }

                        else if (browseChoice == 2)
                        {
                            int browseCat;

                            Console.WriteLine("You have chosen to browse by category!");
                            Console.WriteLine("1) Food \n2) Electronics \n3) Toys \n4) Entertainment \n5) Fashion \n6) Tools \n7) Health");
                            
                            browseCat = int.Parse(Console.ReadLine());

                            if (browseCat == 1)
                            {
                                dummyCustomer01.Browse(allMyProducts, ProductCategory.Food);
                            }

                            else if (browseCat == 2)
                            {
                                dummyCustomer01.Browse(allMyProducts, ProductCategory.Electronics);
                            }

                            else if (browseCat == 3)
                            {
                                dummyCustomer01.Browse(allMyProducts, ProductCategory.Toys);
                            }

                            else if (browseCat == 4)
                            {
                                dummyCustomer01.Browse(allMyProducts, ProductCategory.Entertainment);
                            }

                            else if (browseCat == 5)
                            {
                                dummyCustomer01.Browse(allMyProducts, ProductCategory.Fashion);
                            }

                            else if (browseCat == 6)
                            {
                                dummyCustomer01.Browse(allMyProducts, ProductCategory.Tools);
                            }

                            else
                            {
                                dummyCustomer01.Browse(allMyProducts, ProductCategory.Health);
                            }
                        }

                        else if (browseChoice == 3)
                        {
                            string browseName;

                            Console.WriteLine("You have chosen to browse by name!");
                            Console.WriteLine("Please key in the product name: ");
                            
                            browseName = Console.ReadLine();
                            dummyCustomer01.Browse(allMyProducts, browseName);
                        }

                        else // (browseChoice == 4)
                        {
                            double minPrice;
                            double maxPrice;

                            Console.WriteLine("You have chosen to browse by price!");

                            Console.WriteLine("Please key in your minimum price: ");
                            minPrice = double.Parse(Console.ReadLine());

                            Console.WriteLine("Please key in your maximum price: ");
                            maxPrice = double.Parse(Console.ReadLine());

                            dummyCustomer01.Browse(allMyProducts, minPrice, maxPrice);
                        }

                        /*else
                        {
                            string browseMerch;

                            Console.WriteLine("You have chosen to browse by Merchant!");

                            Console.WriteLine("Please key in Merchant Name: ");
                            browseMerch = Console.ReadLine();

                            foreach (Product p in dummyCustomer01.BrowsedList)
                            {
                                string merchName = p.GetMerchantName.ToUpper();

                                if (merchName == browseMerch.ToUpper())
                                {
                                    dummyCustomer01.Browse(allMyProducts, p.GetMerchantObj);
                                }
                            }

                        } */
                        
                        Console.WriteLine("Make product order? (Y/N) ");

                        makeOrd = Console.ReadLine(); 

                        if (makeOrd == "Y")
                        {
                            int selectOption;
                            Product chosenProd;
                            int orderQty;
                            int cashOrCoup;
                            CustomerPaymentType pType;
                            string toConfirm;
                            int toRate;

                            Console.WriteLine("Which order do you want to order? Please key in your selection option from the browsing list: ");
                            selectOption = int.Parse(Console.ReadLine());

                            chosenProd = dummyCustomer01.BrowsedList[selectOption - 1];
                            Console.WriteLine("Order quantity: ");
                            orderQty = int.Parse(Console.ReadLine());


                            Console.WriteLine("Make payment by: ");
                            Console.WriteLine("1) Cash \t2)Coupon ");
                            cashOrCoup = int.Parse(Console.ReadLine());

                            if (cashOrCoup == 1)
                            {
                               pType = CustomerPaymentType.Cash;
                            }

                            else
                            {
                                pType = CustomerPaymentType.Coupon;
                            }

                            CustomerOrder dummyOrder01 = new CustomerOrder(dummyCustomer01, chosenProd, orderQty, pType);

                            dummyCustomer01.AddOrder(dummyOrder01);
                            Console.WriteLine("Confirm this order? (Y/N)");
                            toConfirm = Console.ReadLine();

                            if (toConfirm == "Y")
                            {
                                foreach (CustomerOrder c in dummyCustomer01.CustOrderList)
                                {
                                    if (c == dummyOrder01)
                                    {
                                        dummyCustomer01.ConfirmOrder(c);
                                    }
                                }
                                
                                Console.WriteLine("\n Order status: ");
                                dummyCustomer01.CheckOrderStatus(dummyOrder01);
                                Console.WriteLine("Please rate this product! (1-5)");
                                toRate = int.Parse(Console.ReadLine());

                                dummyCustomer01.RateProduct(chosenProd, 5);

                            }

                            else
                            {
                                Console.WriteLine("Order has not been confirmed!");
                            }

                        }

                        else if (makeOrd == "N")
                        {
                            Console.WriteLine("No product order has been made.");
                            //dummyCustomer01.ClearBrowseList();
                        }

                        Console.WriteLine("Do you want to log out? (Y/N)");
                        toLogOut = Console.ReadLine();
                            
                        if (toLogOut == "Y")
                        {
                            dummyCustomer01.LogOut();
                        }

                    }

                    else if (optionLogin == 2)
                    {
                        string toViewAll;
                        string toUpdt;
                        string toLogOut;
                        string toInv;

                        dummyMerchant01.LogIn(userID, userPwd);

                        Console.WriteLine("Do you want to view and manage your products? (Y/N)");
                        toViewAll = Console.ReadLine();

                        if (toViewAll == "Y")
                        {
                            string giveName;
                            string giveID;
                            double givePrice;
                            int prodCat;
                            ProductCategory chosenCat;
                            string giveDescr;
                            string chgPrice;
                            double newPrice;
                            string toDel;
                            int selectedDel;


                            dummyMerchant01.ShowAllProduct();

                            Console.WriteLine("Manage products: \n");
                            Console.WriteLine("1) Add Product");
                            Console.WriteLine("\nPlease key in the following details: ");
                            Console.WriteLine("Product name: ");
                            giveName = Console.ReadLine();
                            Console.WriteLine("Price per unit: ");
                            givePrice = double.Parse(Console.ReadLine());
                            Console.WriteLine("Product ID: ");
                            giveID = Console.ReadLine();
                            Console.WriteLine("Category type (Please choose the category according to option number): ");
                            Console.WriteLine("1) Food \n2) Electronics \n3) Toys \n4) Entertainment \n5) Fashion \n6) Tools \n7) Health");
                            prodCat = int.Parse(Console.ReadLine());

                            if (prodCat == 1)
                            {
                                chosenCat = ProductCategory.Food;
                            }

                            else if (prodCat == 2)
                            {
                                chosenCat = ProductCategory.Electronics;
                            }

                            else if (prodCat == 3)
                            {
                                chosenCat = ProductCategory.Toys;
                            }

                            else if (prodCat == 4)
                            {
                                chosenCat = ProductCategory.Entertainment;
                            }

                            else if (prodCat == 5)
                            {
                                chosenCat = ProductCategory.Fashion;
                            }

                            else if (prodCat == 6)
                            {
                                chosenCat = ProductCategory.Tools;
                            }

                            else
                            {
                                chosenCat = ProductCategory.Health;
                            }

                            Product dummyProduct01 = new Product(dummyMerchant01, giveID, giveName, chosenCat, givePrice);
                            dummyMerchant01.AddProduct(dummyProduct01);

                            Console.WriteLine("Product successfully added! Below is your updated product list: ");
                            dummyMerchant01.ShowAllProduct();
                            
                            Console.WriteLine("2) Edit Description");
                            Console.WriteLine("Edit product description: ");
                            giveDescr = Console.ReadLine();
                            dummyMerchant01.EditProduct(dummyProduct01, giveDescr);

                            Console.WriteLine("3) Edit Price");
                            Console.WriteLine("Do you want to change this product price? (Y/N)");
                            chgPrice = Console.ReadLine();

                            if (chgPrice == "Y")
                            {
                                Console.WriteLine("Edit product price: ");
                                newPrice = double.Parse(Console.ReadLine());
                                dummyMerchant01.EditProduct(dummyProduct01, newPrice);
                            }                            

                            Console.WriteLine("4) Delete");
                            Console.WriteLine("Do you want to delete any products? (Y/N)");
                            toDel = Console.ReadLine();

                            if (toDel == "Y")
                            {
                                Console.WriteLine("Which product do you want to delete? Please key in your selection option from the product list: ");
                                selectedDel = int.Parse(Console.ReadLine());

                                dummyMerchant01.DeleteProduct(dummyMerchant01.MerchProdList[selectedDel - 1]);

                                Console.WriteLine("Product successfully deleted! Below is your updated product list: ");
                                dummyMerchant01.ShowAllProduct();

                            }
                            
                        }

                        int statSel;
                        CustomerOrderStatus ordStatus;

                        Console.WriteLine("Do you want to update your customer's order status? (Y/N)");
                        toUpdt = Console.ReadLine();

                        if (toUpdt == "Y")
                        {
                            int updtSel;
                            dummyMerchant01.ShowAllCustomerOrders();
                            Console.WriteLine("Order to update: (Please key in your selection option from the customer order list:)");
                            updtSel = int.Parse(Console.ReadLine());
                            
                            Console.WriteLine("Update status to:");
                            Console.WriteLine("1) Accepted \t2) Rejected \t3) Shipped");
                            statSel = int.Parse(Console.ReadLine());

                            if (statSel == 1)
                            {
                                ordStatus = CustomerOrderStatus.Accepted;
                            }

                            else if (statSel == 2)
                            {
                                ordStatus = CustomerOrderStatus.Rejected;
                            }

                            else
                            {
                                ordStatus = CustomerOrderStatus.Shipped;
                            }

                            dummyMerchant01.UpdateCustOrderStatus(dummyMerchant01.OrderFromCust[updtSel -1], ordStatus);
                        }
                        
                            
                        Console.WriteLine("Do you want to view your invoices? (Y/N)");
                        toInv = Console.ReadLine();

                        if (toInv == "Y")
                        {
                            dummyMerchant01.ViewInvoices();
                        }

                        Console.WriteLine("Do you want to log out? (Y/N)");
                        toLogOut = Console.ReadLine();
                        
                        if (toLogOut == "Y")
                        {
                            dummyMerchant01.LogOut();
                        }


                    }

                    else 
                    {
                        string toMngmt;
                        int selStat;
                        string toRev;
                        string toInv;
                        string toOversee;
                        string toLogOut;

                        dummyAdmin01.LogIn(userID, userPwd);

                        Console.WriteLine("Manage merchant Registration? (Y/N)");
                        toMngmt = Console.ReadLine();

                        if (toMngmt == "Y")
                        {
                            int whoMerch;
                            dummyAdmin01.ReviewMerchantBase(allMyUsers);
                            Console.WriteLine("Please select merchant to manage:");
                            whoMerch = int.Parse(Console.ReadLine());

                            Console.WriteLine("Update merchant's status/registration status:");
                            Console.WriteLine("1)Approved \t2)Rejected \t3)Blacklisted");
                            selStat = int.Parse(Console.ReadLine());

                            if (selStat == 1)
                            {
                                dummyAdmin01.ApproveMerchantReg(allMyUsers.AllMerchantList[(whoMerch - 1)]);
                            }

                            else if (selStat == 2)
                            {
                                dummyAdmin01.RejectMerchantReg(allMyUsers.AllMerchantList[(whoMerch - 1)]);
                            }

                            else
                            {
                                dummyAdmin01.BlackListMerchant(allMyUsers.AllMerchantList[(whoMerch - 1)]);
                            }

                            //dummyAdmin01.ClearCurrentMerchRecord();

                        }

                        Console.WriteLine("Review merchant products? (Y/N)");
                        toRev = Console.ReadLine();

                        if (toRev == "Y")
                        {
                            int whoMerch;
                            int whichProd;
                            string toApprove; 

                            dummyAdmin01.ReviewMerchantBase(allMyUsers);
                            Console.WriteLine("Please select merchant to review products:");
                            whoMerch = int.Parse(Console.ReadLine());

                            dummyAdmin01.ReviewMerchProd(allMyUsers.AllMerchantList[whoMerch-1]);
                            Console.WriteLine("Please select product to review: ");
                            whichProd = int.Parse(Console.ReadLine());

                            dummyAdmin01.ViewProduct(allMyUsers.AllMerchantList[whoMerch-1].MerchProdList[whichProd - 1]);

                            Console.WriteLine("Approve this product? (Y/N)");
                            toApprove = Console.ReadLine();

                            if (toApprove == "Y")
                            {
                                dummyAdmin01.ApproveProduct(allMyUsers.AllMerchantList[whoMerch-1].MerchProdList[whichProd - 1]);
                            }

                            else
                            {
                                dummyAdmin01.RejectProduct(allMyUsers.AllMerchantList[whoMerch-1].MerchProdList[whichProd - 1]);
                            }

                        }
                        
                        Console.WriteLine("View orders and generate invoice to merchant? (Y/N)");
                        toInv = Console.ReadLine();

                        if (toInv == "Y")
                        {
                            int whoMerch;
                            int whichOrd;

                            dummyAdmin01.ReviewMerchantBase(allMyUsers);
                            Console.WriteLine("Please select merchant to review products:");
                            whoMerch = int.Parse(Console.ReadLine());

                            dummyAdmin01.ReviewCompletedOrders(allMyUsers.AllMerchantList[whoMerch-1]);

                            Console.WriteLine("Please select order to generate invoice:");
                            whichOrd = int.Parse(Console.ReadLine());

                            Invoice dummyInvoice03 = new Invoice(allMyUsers.AllMerchantList[whoMerch-1].OrderFromCust[whichOrd - 1], "INV20410");
                            dummyAdmin01.IssueInvoice(dummyInvoice03, allMyUsers.AllMerchantList[whoMerch-1]);
                        }

                        Console.WriteLine("Oversee customer base? (Y/N)");
                        toOversee = Console.ReadLine();
                        
                        if (toOversee == "Y")
                        {
                            dummyAdmin01.ReviewCustomerBase(allMyUsers);
                        }

                        Console.WriteLine("Do you want to log out? (Y/N)");
                        toLogOut = Console.ReadLine();
                            
                        if (toLogOut == "Y")
                        {
                            dummyCustomer01.LogOut();
                        }
                    }

                    break;
                }

                case 2: //Register Option
                {   
                    string userName;
                    string userID;
                    string userPwd;
                    string userEmail;
                    int userYOB;
                    string userGender;
                    UserGender genderType;

                    int optionReg;

                    Console.WriteLine("\nYou have chosen Register!");
                    Console.WriteLine("Are you a: ");

                    Console.WriteLine("1) Customer \t2) Merchant");
                    optionReg = int.Parse(Console.ReadLine());

                    Console.WriteLine("Please key in the necessary details: ");
                    
                    Console.WriteLine("Name: ");
                    userName = Console.ReadLine();

                    Console.WriteLine("User ID: ");
                    userID = Console.ReadLine();

                    Console.WriteLine("Password: ");
                    userPwd = Console.ReadLine();

                    Console.WriteLine("Email: ");
                    userEmail = Console.ReadLine();

                    Console.WriteLine("Year of Birth (YYYY format): ");
                    userYOB = int.Parse(Console.ReadLine());

                    Console.WriteLine("Gender (M/F): ");
                    userGender = Console.ReadLine();

                    if (userGender == "M")
                    {
                        genderType = UserGender.Male;
                    }
                    else
                    {
                        genderType = UserGender.Female;
                    }


                    if (optionReg == 1)
                    {
                        myCustomer01.Name = userName;
                        myCustomer01.ID = userID;
                        myCustomer01.Password = userPwd;
                        myCustomer01.Email = userEmail;
                        myCustomer01.YearOfBirth = userYOB;
                        myCustomer01.Gender = genderType;

                        myCustomer01.Register();
                    }

                    else
                    {
                        myMerchant01.Name = userName;
                        myMerchant01.ID = userID;
                        myMerchant01.Password = userPwd;
                        myMerchant01.Email = userEmail;
                        myMerchant01.YearOfBirth = userYOB;
                        myMerchant01.Gender = genderType;

                        myMerchant01.Register();
                    }

                    break;
                }

                

            }

            
        }
    }
}
