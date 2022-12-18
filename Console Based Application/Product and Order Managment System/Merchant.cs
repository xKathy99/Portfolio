using System;
using System.Collections.Generic;

namespace PT13_ProductAndOrderManagementSystem
{
    /// <summary>
    /// This is a Merchant class.
    /// Each instance (object created) of User will know its own name, 
    /// email, ID, password, D.O.B (date of birth), and gender.
    /// It will also know whether it is already registered or logged in.
    /// 
    /// </summary>
    public class Merchant: User
    {
        private MerchantRegisterStatus _merchregstatus;

        private List<Product> _merchproducts;
        private List<CustomerOrder> _ordersfromcust;

        private List<Invoice> _invreceived;

        
        public Merchant(string name, string id, string password, string email, int yob, UserGender gender):base(name, id, password, email, yob, gender)
        {   
            _merchproducts = new List<Product>();
            _ordersfromcust = new List<CustomerOrder>();
            _invreceived = new List<Invoice>();

            IsRegistered = false;
            IsLoggedIn = false;

            _merchregstatus = MerchantRegisterStatus.Pending;
        }


        public Merchant():this("Merchant", "M00000000", "merchantpwd", "merch@email.com", 0000, UserGender.Male)
        {
            _merchproducts = new List<Product>();
            _merchregstatus = MerchantRegisterStatus.Pending;
        }

        public List<Product> MerchProdList
        {
            get {return _merchproducts;} //readonly
        }

        public List<CustomerOrder> OrderFromCust
        {
            get {return _ordersfromcust;} //readonly
        }

        public List<Invoice> InvoiceList
        {
            get {return _invreceived;}
            set {_invreceived = value;}
        }

        public MerchantRegisterStatus MerchRegStatus
        {
            get {return _merchregstatus;}
            set {_merchregstatus = value;}
        }

        public override void Register()
        {
            if (IsRegistered == false)
            {
                IsRegistered = true;

                Console.WriteLine("Merchant account registration is received! Kindly await for Admin approval.");
            } //does it go through the loop twice?

            else 
            {
                if (MerchRegStatus == MerchantRegisterStatus.Pending)
                {
                    Console.WriteLine("Kindly await for Admin approval.");
                }

                else if (MerchRegStatus == MerchantRegisterStatus.Approved)
                {
                    Console.WriteLine("Merchant account is registered and approved! Please proceed to login.");
                }

                else
                {
                    Console.WriteLine("Merchant account registration has been denied. Please contact Offer Galore for more info.");
                }
            }

        }


        public override void LogIn(string id, string password)
        {
            if (MerchRegStatus == MerchantRegisterStatus.Pending)
            {
                Console.WriteLine("Account is still pending. Kindly await for Admin approval before log in.");

            }

            else if (MerchRegStatus == MerchantRegisterStatus.Declined)
            {
               Console.WriteLine("Merchant account registration has been denied. User cannot log in. Please contact Offer Galore for more info.");

            }
                
            else
            {
                if ((id == ID) & (password == Password))
                {

                    if (IsRegistered == true)
                    {

                        if (IsLoggedIn == false)
                        {
                            IsLoggedIn = true;

                            Console.WriteLine("Log in successful!");
                        }

                        else 
                        {
                            Console.WriteLine("User is already logged in.");
                        }

                    }

                    else
                    {
                        Console.WriteLine("Please register before logging in!");
                    }
                }

                else
                {
                    Console.WriteLine("User ID or password is incorrect. Please try again.");
                }
            }
            
        }

        public void ShowAllCustomerOrders()
        {
            string output ="";
            int number = 0;
            foreach (CustomerOrder o in _ordersfromcust)
            {
                number++;

                output = (output + number + ") Customer name: " + o.GetCustName + "; "
                        + "Customer ID: " + o.GetCustID + ", "
                        + "Ordered " + o.GetProductName + ", " + o.OrderQty + " units; "
                        + "Order Status: " + o.CustOrderStatus + "\n");
            }
            
            Console.WriteLine("Here is a list of all received customer orders:");
            Console.WriteLine(output);
        }

        public void AddCustomerOrderRecord(CustomerOrder ord)
        {
            if (ord.IsConfirmedByCustomer == true)
            {
                _ordersfromcust.Add(ord);
            }
        }

        public void DeleteCustomerOrderRecord(CustomerOrder ord)
        {
            if ((ord.CustOrderStatus == CustomerOrderStatus.Rejected) | (ord.CustOrderStatus == CustomerOrderStatus.Shipped))
            {
                _ordersfromcust.Remove(ord);
            }

            else
            {
                Console.WriteLine("Order record cannot be deleted unless it has already been rejected/shipped!");
            }
        }

        public void ViewInvoices()
        {
            string output = "";
            int total = 0;

            foreach (Invoice i in _invreceived)
            {
                total++;
                output = (output + "Invoice Reference ID: " + i.InvRefID + "\n"
                        + "Issued to: " + i.IssuedFor + "\n"
                        + "For the successful transaction for " + i.InvQuantity + " units of " + i.GetOrderedProd + "\n"
                        + "Total amount: RM" + i.InvAmt + "\n\n");
            }
            Console.WriteLine("Here is a list of all received invoices:");
            Console.WriteLine(output);
        }

        public void ShowAllProduct()
        {
            string output = "";
            int number = 0;

            foreach (Product p in MerchProdList)
            {
                number++;
                output = (output + number + ") Product ID: " + p.ProdID + "; "
                        + "Product Name: " + p.ProdName + "; "
                        + "Category: " + p.ProdCategory + "; "
                        + "Cost: " + p.ProdCostPerUnit + "; "
                        + "Rating: " + p.ProdRating + "; "
                        + "Product Approval Status: " + p.ProdApprovalStatus + "\n"
                        + "\tProduct Description: " + p.ProdDescr + "\n");
            }

            Console.WriteLine("Here is a list of all your products.");
            Console.WriteLine(output);
        }

        public void AddProduct(Product prod)
        {
            _merchproducts.Add(prod);
        }

        public void DeleteProduct(Product prod)
        {
            _merchproducts.Remove(prod);
        }

        //Merchant can only edit product descr, cost 

        public void EditProduct(Product prod, string updatedescr)
        {
            prod.ProdDescr = updatedescr;
            
            Console.WriteLine("Product Description for " + prod.ProdName
                    + " (ID:" + prod.ProdID + ") has been updated to: "
                    + prod.ProdDescr);
        }

        public void EditProduct(Product prod, double updateprodcost)
        {
            prod.ProdCostPerUnit = updateprodcost;

            Console.WriteLine("Product cost per unit for " + prod.ProdName
                    + " (ID:" + prod.ProdID + ") has been updated to: "
                    + prod.ProdCostPerUnit);

        }
        public void UpdateCustOrderStatus(CustomerOrder cust, CustomerOrderStatus status)
        {
            if (cust.IsConfirmedByCustomer == true)
            {
                if (status == CustomerOrderStatus.Pending)
                {
                    cust.CustOrderStatus = CustomerOrderStatus.Pending;
                }

                else if (status == CustomerOrderStatus.Accepted)
                {
                    cust.CustOrderStatus = CustomerOrderStatus.Accepted;
                    Console.WriteLine("Customer Order for " + cust.OrderQty + " units of " +cust.GetProductName + " is accepted.");
                }

                else if (status == CustomerOrderStatus.Shipped)
                {
                    cust.CustOrderStatus = CustomerOrderStatus.Shipped;
                    Console.WriteLine("Customer Order for " + cust.OrderQty + " units of " + cust.GetProductName + " is now shipped out.");
                }

                else
                {
                    cust.CustOrderStatus = CustomerOrderStatus.Rejected;
                    Console.WriteLine("Customer Order for " + cust.OrderQty + " units of " + cust.GetProductName + " has been rejected.");
                }
            }

            else
            {
                Console.WriteLine("Customer has not confirmed this order.");
                Console.WriteLine("You should not be able to receive this order. Please inform System Administrator of this issue immediately.");
            }
        }  
        
    }
}