using System;

namespace PT13_ProductAndOrderManagementSystem
{
    public class Invoice
    {
        private CustomerOrder _transorder; //transacted order
        private string _getorderedprod;
        private string _invrefid;
        private CustomerOrderStatus _obtainorderstatus;
        private bool _isissued;
        private int _totalqty;
        private double _totalamt;
        private string _issuedfor;        

        public Invoice(CustomerOrder transorder, string invrefid)
        {
            _transorder = transorder;

            _getorderedprod = transorder.GetProductName;

            _obtainorderstatus = transorder.CustOrderStatus;

            _invrefid = invrefid;
            
            _isissued = false;

            _totalqty = transorder.OrderQty;
            _totalamt = transorder.AmountCharge;
            _issuedfor = transorder.OrderedFrom;
        }

        public string GetOrderedProd
        {
            get {return _getorderedprod;}
        }

        public CustomerOrderStatus ObtainStatus
        {
            get {return _obtainorderstatus;}
        }

        public string InvRefID
        {
            get {return _invrefid;}
            set {_invrefid = value;}
        }
        public bool IsIssued
        {
            get {return _isissued;}
            set {_isissued = value;}
        }

        public int InvQuantity
        {
            get {return _totalqty;}
        }

        public double InvAmt
        {
            get {return _totalamt;}
        }

        public string IssuedFor
        {
            get {return _issuedfor;}
        }

    }
}