using System;
using System.Collections.Generic;

namespace PT13_ProductAndOrderManagementSystem
{
    public class OverallUserListing //Amalgamation of all products which can be seen by customers
    {
        private List<User> _alluserlist;
        private List<Merchant> _allmerchantlist;

        private List<Customer> _allcustomerlist;

        public OverallUserListing()
        {
            _alluserlist = new List<User>();
            _allmerchantlist = new List<Merchant>();
            _allcustomerlist = new List<Customer>();
        }

        public List<User> AllUserList
        {
            get {return _alluserlist;}
        }
        
        public List<Merchant> AllMerchantList
        {
            get {return _allmerchantlist;}
        }        

        public List<Customer> AllCustomerList
        {
            get {return _allcustomerlist;}
        }  
           
         

        public void AddToUserListing(User user)
        {
            _alluserlist.Add(user);
        }

        public void RemoveFromUserListing(User user)
        {
            _alluserlist.Remove(user);
        }

        public void AddToMerchantListing(Merchant merch)
        {
            _allmerchantlist.Add(merch);
        }

        public void RemoveFromMerchantListing(Merchant merch)
        {
            _allmerchantlist.Remove(merch);
        }

        public void AddToCustomerListing(Customer cust)
        {
            _allcustomerlist.Add(cust);
        }

        public void RemoveFromCustomerListing(Customer cust)
        {
            _allcustomerlist.Remove(cust);
        }
    }
}