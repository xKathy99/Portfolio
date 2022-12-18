using System;
using System.Collections.Generic;

namespace PT13_ProductAndOrderManagementSystem
{
    /// <summary>
    /// This is a Admin class.
    /// Each instance (object created) of User will know its own name, 
    /// email, ID, password, year of birth, and gender.
    /// It will also know whether it is already registered or logged in.
    /// 
    /// </summary>
    public class Customer: User
    {
        private List<CustomerOrder> _custorderlist;
        private List<Product> _browsed;

        public Customer(string name, string id, string password, string email, int yob, UserGender gender):base(name, id, password, email, yob, gender)
        {
            _custorderlist = new List<CustomerOrder>();
            _browsed = new List<Product>();

            IsRegistered = false;
            IsLoggedIn = false;
        }

        public Customer():this("Customer", "C00000000", "custpwd", "cust@email.com", 0000, UserGender.Male)
        {
            _custorderlist = new List<CustomerOrder>();
            _browsed = new List<Product>();
        }

        public List<CustomerOrder> CustOrderList
        {
            get {return _custorderlist;} //readonly
        }

        public List<Product> BrowsedList
        {
            get {return _browsed;} //readonly
        }

        public void ClearBrowseList()
        {
            foreach (Product p in _browsed)
            {
                _browsed.Remove(p);
            }
        }

        public void AddOrder(CustomerOrder custord)
        {
            _custorderlist.Add(custord);
            Console.WriteLine("Order has been added to Cart. Please confirm!");
        }

        public void ConfirmOrder(CustomerOrder custord)
        {
            custord.IsConfirmedByCustomer = true;

            if (custord.CustPaymentType == CustomerPaymentType.Cash)
            {
                Console.WriteLine("Thank you for confirming! Please await order acceptance by Merchant.");
            }
        }

        public void CheckOrderStatus(CustomerOrder custord)
        {
            if (custord.IsConfirmedByCustomer == true)
            {
                if (custord.CustOrderStatus == CustomerOrderStatus.Pending)
                {
                    Console.WriteLine("Order is pending for Merchant acceptance.");

                    if (custord.CustPaymentType == CustomerPaymentType.Cash)
                    {
                        Console.WriteLine("Note: Every purchase of RM10 will be entitled to 1 coupon for redemption!");
                    }
                    
                }

                else if (custord.CustOrderStatus == CustomerOrderStatus.Accepted)
                {
                    Console.WriteLine("Order has been accepted by Merchant! Kindly await Shipment");

                    if (custord.CustPaymentType == CustomerPaymentType.Cash)
                    {
                        int totalcoupons = Convert.ToInt32(custord.AmountCharge/10);

                        Console.WriteLine("Note: You are now entitled to redeem " + totalcoupons + " coupons!");
                    }
                    
                }

                else if (custord.CustOrderStatus == CustomerOrderStatus.Shipped)
                {
                    Console.WriteLine("Order has been shipped by Merchant!");                    
                }

                else
                {
                    Console.WriteLine("Deepest apologies. Your order has been rejected by Merchant.");
                }

            }

            else
            {
                Console.WriteLine("You have not confirmed this order.");
            }
        }

        public override void ViewProduct(Product prod)
        {
            if (prod.ProdApprovalStatus == ProductApprovalStatus.Approved)
            {
                string output = ("Product ID: " + prod.ProdID + "\n "
                        + "Product Name: " + prod.ProdName + "\n "
                        + "Category: " + prod.ProdCategory + "\n "
                        + "Description: " + prod.ProdDescr + "\n"
                        + "Cost: " + prod.ProdCostPerUnit + "\n "
                        + "Rating: " + prod.ProdRating + "\n "
                        + "Merchant: " + prod.GetMerchantName + "\n"
                        + "\tDescription: " + prod.ProdDescr + "\n");

                Console.WriteLine(output);
            }

            else
            {
                Console.WriteLine("Sorry! This product is not available for viewing!");
            }
            
        }

        public void Browse(OverallApprovedProductListing listing) //Browse all available made products
        {
            if (IsLoggedIn == false)
            {
                Console.WriteLine("Please log in to browse all products!");

            }

            else
            {
                string output = "";
                int number = 0;
                foreach(Product p in listing.AllProductsList)
                {
                    number ++;
                    output = (output + number + ") Product ID: " + p.ProdID + "; "
                            + "Product Name: " + p.ProdName + "; "
                            + "Category: " + p.ProdCategory + "; "
                            + "Cost: " + p.ProdCostPerUnit + "; "
                            + "Rating: " + p.ProdRating + "; "
                            + "Merchant: " + p.GetMerchantName + "\n"
                            + "\tDescription: " + p.ProdDescr + "\n");

                    _browsed.Add(p);
                }

                Console.WriteLine("Showing all product listings. Total number of results: " + _browsed.Count);
                Console.WriteLine(output);
            }

            
        }


        public void Browse(OverallApprovedProductListing listing, Merchant merchant) //Browse by merchant
        {
            if (IsLoggedIn == false)
            {
                Console.WriteLine("Please log in to browse all products!");

            }

            else
            {
                string output = "";
                int number = 0;
                foreach(Product p in listing.AllProductsList)
                {
                    if (p.GetMerchantName == merchant.Name)
                    {
                        number++;
                        output = (output + number + ") " + "Product ID: "  + p.ProdID + "; " 
                                + "Product Name: " + p.ProdName + "; "
                                + "Category: " + p.ProdCategory + "; "
                                + "Cost: " + p.ProdCostPerUnit + "; "
                                + "Rating: " + p.ProdRating + "\n"
                                + "\tDescription: " + p.ProdDescr + "\n");

                        _browsed.Add(p);
                    }
                }
                Console.WriteLine("Showing list of products by: " + merchant + ". Total number of results: " + _browsed.Count);
                Console.WriteLine(output);

            }
        }


        public void Browse(OverallApprovedProductListing listing, ProductCategory category) //Browse by merchant
        {
            if (IsLoggedIn == false)
            {
                Console.WriteLine("Please log in to browse all products!");

            }

            else
            {
                string output = "";
                int number = 0;
                foreach(Product p in listing.AllProductsList)
                {    
                    if (p.ProdCategory == category)
                    {
                        number++;
                        output = (output + number + ") " + "Product ID: "  + p.ProdID + "; " 
                                + "Product Name: " + p.ProdName + "; "
                                + "Cost: " + p.ProdCostPerUnit + "; "
                                + "Rating: " + p.ProdRating + "; "
                                + "Merchant: " + p.GetMerchantName + "\n"
                                + "\tDescription: " + p.ProdDescr + "\n");

                        _browsed.Add(p);
                    }
                
                }
                Console.WriteLine("Showing list of products by: " + category + ". Total number of results: " + _browsed.Count);
                Console.WriteLine(output);

            }
        }


        public void Browse(OverallApprovedProductListing listing, double minbudget, double maxbudget) //Browse by merchant
        {
            if (IsLoggedIn == false)
            {
                Console.WriteLine("Please log in to browse all products!");

            }

            else
            {
            
                string output = "";
                int number = 0;
                foreach(Product p in listing.AllProductsList)
                {
                    if ((p.ProdCostPerUnit >= minbudget) & (p.ProdCostPerUnit <= maxbudget))
                    {
                        number++;
                        output = (output + number + ") " + "Product ID: "  + p.ProdID + "; " 
                                + "Product Name: " + p.ProdName + "; "
                                + "Category: " + p.ProdCategory + "; "
                                + "Cost: " + p.ProdCostPerUnit + "; "
                                + "Rating: " + p.ProdRating + "; "
                                + "Merchant: " + p.GetMerchantName +"\n"
                                + "\tDescription: " + p.ProdDescr + "\n");

                        _browsed.Add(p);
                    }
                }

                Console.WriteLine("Showing list of products with price range : " + minbudget + "-" + maxbudget + ". Total number of results: " + _browsed.Count);
                Console.WriteLine(output);

            }
        }

        public void Browse(OverallApprovedProductListing listing, string name) //Browse by name, non-case sensitive by converting to uppercase
        {
            if (IsLoggedIn == false)
            {
                Console.WriteLine("Please log in to browse all products!");

            }

            else
            {
                string output = "";
                int number = 0;
                foreach(Product p in listing.AllProductsList)
                {
                    string productname = p.ProdName.ToUpper();

                    if (productname.Contains(name.ToUpper()))
                    {
                        number++;
                        output = (output + number + ") " + "Product ID: "  + p.ProdID + "; " 
                                + "Product Name: " + p.ProdName + "; "
                                + "Category: " + p.ProdCategory + "; "
                                + "Cost: " + p.ProdCostPerUnit + "; "
                                + "Rating: " + p.ProdRating + "; "
                                + "Merchant: " + p.GetMerchantName +"\n"
                                + "\tDescription: " + p.ProdDescr + "\n");

                        _browsed.Add(p);
                    }
                }

                Console.WriteLine("Showing list of products with names matching : " + name + ". Total number of results: " + _browsed.Count);
                Console.WriteLine(output);
            }
        }

        public void RateProduct(Product product, int givenrating)
        {
            product.ProdRating = ((product.ProdRating + givenrating)/2);
            Console.WriteLine("You have rated " + product.ProdName + " with " + givenrating + "/5. Thank you!");
        }

    }
}