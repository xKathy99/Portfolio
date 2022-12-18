using System;
using System.Collections.Generic;

namespace PT13_ProductAndOrderManagementSystem
{
    public class OverallApprovedProductListing //Amalgamation of all products which can be seen by customers
    {
        private List<Product> _overallallproductslist;

        public OverallApprovedProductListing()
        {
            _overallallproductslist = new List<Product>();
        }

        public List<Product> AllProductsList
        {
            get {return _overallallproductslist;}
        } 

        public int TotalApprovedProducts
        {
            get {return _overallallproductslist.Count;}
        }

        public void AddToProductsListing(Product prod) //Will only contain all approved products
        {
            if ((prod.GetMerchantStatus == MerchantRegisterStatus.Approved) & (prod.ProdApprovalStatus == ProductApprovalStatus.Approved))
            {
                _overallallproductslist.Add(prod);
            }          
        }

        public void RemoveFromProductsListing(Product prod)
        {
            _overallallproductslist.Remove(prod);
        }


    }
}