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
    public class Admin: User
    {
        private List<Customer> _custrec; 
        private List<Merchant> _merchrec; 

        /// <summary>
        /// This is a pass-by-value base constructor for Admin object.
        /// All users have a name, email, id, password, year of birth (Y.O.B),
        /// and gender. All users are registered but not logged in by default.
        /// </summary>
        /// <param name="name"></param>
        /// <param name="email"></param>
        /// <param name="id"></param>
        /// <param name="password"></param>
        /// <param name="yob"></param>
        /// <param name="gender"></param>
        public Admin(string name, string id, string password, string email, int yob, UserGender gender):base(name, id, password, email, yob, gender)
        {
            _merchrec = new List<Merchant>(); 
            _custrec = new List<Customer>();

            IsRegistered = true;
            IsLoggedIn = false;
        }


        /// <summary>
        /// This is a default base contructor for Admin object.
        /// 
        /// </summary>
        public Admin():this("Admin", "A00000000", "adminpwd", "admin@email.com", 0000, UserGender.Male)
        {
            IsRegistered = true;
            //IsLoggedIn = false; //see if correct in unit test without this
        }

        public List<Merchant> MerchantRecord
        {
            get {return _merchrec;} //readonly
        }

        public List<Customer> CustomerRecord
        {
            get {return _custrec;} //readonly
        }

        public void ClearCurrentMerchRecord()
        {
            foreach (Merchant m in _merchrec)
            {
                _merchrec.Remove(m);
            }
        }

        public void ClearCurrentCustRecord()
        {
            foreach (Customer c in _custrec)
            {
                _custrec.Remove(c);
            }
        }

        public void ApproveMerchantReg(Merchant merch)
        {
            if (merch.MerchRegStatus == MerchantRegisterStatus.Pending)
            {
                merch.MerchRegStatus = MerchantRegisterStatus.Approved;
                Console.WriteLine("Merchant registration for " + merch.Name + " (ID: " + merch.ID + ") has been approved.");
            } 
        }

        public void RejectMerchantReg(Merchant merch)
        {
            if (merch.MerchRegStatus == MerchantRegisterStatus.Pending)
            {
                merch.MerchRegStatus = MerchantRegisterStatus.Declined;
                Console.WriteLine("Merchant registration for " + merch.Name + " (ID: " + merch.ID + ") has been declined.");
            }
        }

        public void BlackListMerchant(Merchant merch)
        {

            merch.MerchRegStatus = MerchantRegisterStatus.BlackListed;
            Console.WriteLine("Merchant " + merch.Name + " (ID: " + merch.ID + ") has been Blacklisted.");
        }

        public void ApproveProduct(Product prod)
        {
            if (prod.ProdApprovalStatus == ProductApprovalStatus.Pending)
            {
                prod.ProdApprovalStatus = ProductApprovalStatus.Approved;
                Console.WriteLine("Product " + prod.ProdName + " (ID: " + prod.ProdID + ") by " + prod.GetMerchantName + " has been approved.");
            }
        }

        public void RejectProduct(Product prod)
        {
            if (prod.ProdApprovalStatus == ProductApprovalStatus.Pending)
            {
                prod.ProdApprovalStatus = ProductApprovalStatus.Rejected;
                Console.WriteLine("Product " + prod.ProdName + " (ID: " + prod.ProdID + ") by " + prod.GetMerchantName + " has been rejected.");
            }
        }

        public void ReviewMerchProd(Merchant merch)
        {
            string output = "";
            int number = 0;

            if (merch.MerchRegStatus == MerchantRegisterStatus.Approved)
            {
                foreach (Product p in merch.MerchProdList)
                {
                    number++;
                    output = (output + number + ") Product ID: " + p.ProdID + "; "
                            + "Product Name: " + p.ProdName + "; "
                            + "Category: " + p.ProdCategory + "; "
                            + "Cost: " + p.ProdCostPerUnit + "; "
                            + "Rating: " + p.ProdRating + "; "
                            + "Product Approval Status: " + p.ProdApprovalStatus + "\n");
                }
            }

            Console.WriteLine("Showing all product details from: " + merch.Name + "(ID: " + merch.ID + ") Total number of results: " + number);
            Console.WriteLine(output);
        }

        public void IssueInvoice(Invoice inv, Merchant merch)
        {   
            if (inv.IsIssued == true)
            {
                Console.WriteLine("Invoice has already been issued.");
            }

            else
            {
                if ((inv.ObtainStatus == CustomerOrderStatus.Accepted) || (inv.ObtainStatus == CustomerOrderStatus.Pending))
                {
                    inv.IsIssued = true;

                    string output = ("Invoice Reference ID: " + inv.InvRefID + "\n"
                        + "Invoice has been successfully issued to: " + inv.IssuedFor + "\n"
                        + "For the successful transaction of " + inv.InvQuantity + " units of " + inv.GetOrderedProd + "\n"
                        + "Total amount: RM" + inv.InvAmt);
            
                    merch.InvoiceList.Add(inv);
                    Console.WriteLine(output);
                }
                
                else
                {
                    Console.WriteLine("This order has been rejected by Merchant. Invoice will no longer be issued.");
                }
            }
            
        }

        public void ReviewCompletedOrders(Merchant merch)
        { 
            string output ="";
            int number = 0;

            foreach (CustomerOrder o in merch.OrderFromCust)
            {
                if ((o.CustOrderStatus == CustomerOrderStatus.Accepted) | (o.CustOrderStatus == CustomerOrderStatus.Shipped))
                {
                    if (o.IsOrderTransacted == false)
                    {
                        number++;
                        output = (output + number + ") Customer name: " + o.GetCustName + "\n"
                                + "Customer ID: " + o.GetCustID + "\n"
                                + "Ordered " + o.GetProductName + ", " + o.OrderQty + " units"
                                + "Order Status:" + o.CustOrderStatus + "\n\n");
                    }
                }

            }
            
            Console.WriteLine("Here is a list of all approved orders without invoices issued yet.");
            Console.WriteLine(output);
        }

        public void ReviewCustomerBase(OverallUserListing listing)
        {
            string output = "";
            int number = 0;
            
            foreach (Customer c in listing.AllCustomerList)
            {
                number++;
                output = (output + number + ") Customer ID: " + c.ID + "; "
                        + "Customer Name: " + c.Name + "; "
                        + "Email: " + c.Email + "; "
                        + "Gender: " + c.Gender + "; "
                        + "Year of Birth: " + c.YearOfBirth + "\n");
            } 

            Console.WriteLine("Showing results of customer base. Total number of results: " + number);
            Console.WriteLine(output);
        }

        public void ReviewMerchantBase(OverallUserListing listing) //only approved merchants will be added and shown up
        {
            string output = "";
            int number = 0;

            foreach (Merchant m in listing.AllMerchantList)
            {
                if (m is Merchant)
                { number++;
                    output = (output + number + ") Merchant ID: " + m.ID + "; "
                        + "Merchant Name: " + m.Name + "; "
                        + "Email: " + m.Email + "; "
                        + "Gender: " + m.Gender + "; "
                        + "Year of Birth: " + m.YearOfBirth + "; "
                        + "Merchant Current Status: " + m.MerchRegStatus + "\n");
                }               

            } 

            Console.WriteLine("Showing results of approved merchant  users. Total number of results: " + number);
            Console.WriteLine(output);
        }
       
        
    }
}