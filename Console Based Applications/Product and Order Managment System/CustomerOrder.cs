using System;

namespace PT13_ProductAndOrderManagementSystem
{
    public class CustomerOrder
    {   
        private Customer _customer;
        private string _getcustname;
        private string _getcustID;
        private Product _product;
        private string _getprodname;
        private int _orderqty;
        private CustomerPaymentType _paymenttype;
        private double _amtcharged;
        private string _orderedfrom;
        private CustomerOrderStatus _orderstatus;
        private bool _isconfirmedbycustomer;
        private bool _istransacted;

        public CustomerOrder(Customer customer, Product product, int orderqty, CustomerPaymentType paymenttype)
        {
            _customer = customer;
            _getcustname = customer.Name;
            _getcustID = customer.ID;

            _product = product;
            
            _getprodname = product.ProdName;

            _orderqty = orderqty;
            _paymenttype = paymenttype;

            _amtcharged = (product.ProdCostPerUnit * _orderqty);
            _orderedfrom = product.GetMerchantName;

            _isconfirmedbycustomer = false;
            _orderstatus = CustomerOrderStatus.Pending;

            _istransacted = false; // only becomes true when invoice is sent to Merchant by admin
        }
        public string GetCustName
        {
            get {return _getcustname;}
        }
        public string GetCustID
        {
            get {return _getcustID;}
        }
        public string GetProductName
        {
            get {return _getprodname;}
        }
        

        public int OrderQty
        {
            get {return _orderqty;}
            set {_orderqty = value;}
        }

        public CustomerPaymentType CustPaymentType
        {
            get {return _paymenttype;}
            set {_paymenttype = value;}
        }

        public double AmountCharge
        {
            get {return _amtcharged;}
        }

        public string OrderedFrom
        {
            get {return _orderedfrom;}
        }

        public bool IsConfirmedByCustomer
        {
            get {return _isconfirmedbycustomer;}
            set {_isconfirmedbycustomer = value;}
        }
        
        public CustomerOrderStatus CustOrderStatus
        {
            get {return _orderstatus;}
            set {_orderstatus = value;}
        }
        public bool IsOrderTransacted
        {
            get {return _istransacted;}
            set {_istransacted = value;}
        }

    }
}