using System;

namespace PT13_ProductAndOrderManagementSystem
{
    public class Product
    {
        private Merchant _merchant;
        private string _getmerchname;
        private MerchantRegisterStatus _getmerchstatus;
        private string _prodid;
        private string _prodname;
        private ProductCategory _prodcategory;
        private string _proddescr;
        private double _prodcostperunit;
        private ProductApprovalStatus _prodapprovalstatus;
        private double _prodrating;

        public Product(Merchant merchant, string prodid, string prodname, ProductCategory prodcategory, double prodcostperunit)
        {
            _merchant = merchant;

            _getmerchname = merchant.Name;
            _getmerchstatus = merchant.MerchRegStatus;


            _prodid = prodid;
            _prodname = prodname;
            _prodcategory = prodcategory;
            _prodcostperunit = prodcostperunit;

            _proddescr = ("No description was provided by Merchant.");

            _prodapprovalstatus = ProductApprovalStatus.Pending;
            _prodrating = 0;
        }

        public Merchant GetMerchantObj
        {
            get {return _merchant;} //Read only property
        }
        
        
        public string GetMerchantName
        {
            get {return _getmerchname;} //Read only property
        }

        public MerchantRegisterStatus GetMerchantStatus
        {
            get {return _getmerchstatus;} //Read only property
        }

        public string ProdID
        {
            get {return _prodid;}
            set {_prodid = value;}
        }
        
        public string ProdName
        {
            get {return _prodname;}
            set {_prodname = value;}
        }

        public ProductCategory ProdCategory
        {
            get {return _prodcategory;}
            set {_prodcategory = value;}
        }

        public string ProdDescr
        {
            get {return _proddescr;}
            set {_proddescr = value;}
        }
        

        public double ProdCostPerUnit
        {
            get {return _prodcostperunit;}
            set {_prodcostperunit = value;}
        }

        public ProductApprovalStatus ProdApprovalStatus
        {
            get {return _prodapprovalstatus;}
            set {_prodapprovalstatus = value;}
        }
        
        public double ProdRating
        {
            get {return _prodrating;}
            set {_prodrating = value;}
        }

    }
}