using System;
using NUnit.Framework;
using System.Collections.Generic;

namespace PT13_ProductAndOrderManagementSystem
{
    [TestFixture()]
    public class TestUser
    {
      [Test()]
      public void TestMerchRegAndLogin()
      {
        Merchant myTestMerch = new Merchant();
        Admin myTestAdmin = new Admin();
        
        myTestMerch.Register();
        Assert.AreEqual(true, myTestMerch.IsRegistered);

        myTestMerch.LogIn("idYYYYYYYY", "merchantpwd");
        Assert.AreEqual(false, myTestMerch.IsLoggedIn);

        myTestAdmin.ApproveMerchantReg(myTestMerch);
        myTestMerch.LogIn("idYYYYYYYY", "merchantpwd");
        Assert.AreEqual(true, myTestMerch.IsLoggedIn);
      }  

      [Test()]
      public void TestMerchUpdateOrder()
      {
          Admin myTestAdmin = new Admin();
          Merchant myTestMerch = new Merchant();
          Customer myTestCustomer = new Customer();

          Product myProduct01 = new Product(myTestMerch, "P1234", "Three-Legged Zebra", ProductCategory.Toys, 15.00);
          Product myProduct02 = new Product(myTestMerch, "P1232", "Striped Giraffe", ProductCategory.Toys, 12.00);

          myTestAdmin.ApproveProduct(myProduct01);
          myTestAdmin.ApproveProduct(myProduct02);

          CustomerOrder myTestOrder01 = new CustomerOrder(myTestCustomer, myProduct01, 10, CustomerPaymentType.Cash);
          CustomerOrder myTestOrder02 = new CustomerOrder(myTestCustomer, myProduct02, 18, CustomerPaymentType.Cash);

          myTestCustomer.ConfirmOrder(myTestOrder01);
          myTestCustomer.ConfirmOrder(myTestOrder02);

          Assert.AreEqual(CustomerOrderStatus.Pending, myTestOrder01.CustOrderStatus);
          Assert.AreEqual(CustomerOrderStatus.Pending, myTestOrder02.CustOrderStatus);


          myTestMerch.UpdateCustOrderStatus(myTestOrder01, CustomerOrderStatus.Accepted);
          myTestMerch.UpdateCustOrderStatus(myTestOrder02, CustomerOrderStatus.Rejected);

          Assert.AreEqual(CustomerOrderStatus.Accepted, myTestOrder01.CustOrderStatus);
          Assert.AreEqual(CustomerOrderStatus.Rejected, myTestOrder02.CustOrderStatus);

          myTestMerch.UpdateCustOrderStatus(myTestOrder01, CustomerOrderStatus.Shipped);
          Assert.AreEqual(CustomerOrderStatus.Shipped, myTestOrder01.CustOrderStatus);
      }

      [Test()]
      public void TestAdminIssueInv()
      {  
        Admin myTestAdmin = new Admin();
        Merchant myTestMerch = new Merchant();
        Customer myTestCustomer = new Customer();

        Product myProduct01 = new Product(myTestMerch, "P1234", "Three-Legged Zebra", ProductCategory.Toys, 15.00);

        myTestAdmin.ApproveProduct(myProduct01);

        CustomerOrder myTestOrder = new CustomerOrder(myTestCustomer, myProduct01, 10, CustomerPaymentType.Cash);
        myTestCustomer.ConfirmOrder(myTestOrder);

        Assert.AreEqual(true, myTestOrder.IsConfirmedByCustomer);
        Assert.AreEqual(CustomerOrderStatus.Pending, myTestOrder.CustOrderStatus);

        myTestMerch.UpdateCustOrderStatus(myTestOrder, CustomerOrderStatus.Accepted);
        Assert.AreEqual(CustomerOrderStatus.Accepted, myTestOrder.CustOrderStatus);

        Invoice myTestInv = new Invoice(myTestOrder, "INV2001");
        myTestAdmin.IssueInvoice(myTestInv, myTestMerch);

        Assert.AreEqual(true, myTestInv.IsIssued);
      }

    }
}