using System;
using NUnit.Framework;
using System.Collections.Generic;

namespace PT13_ProductAndOrderManagementSystem
{
    [TestFixture()]
    public class TestOverallApprovedProductListing
    {
      [Test()]
      public void TestAddProduct()
      {
          OverallApprovedProductListing myAllProd = new OverallApprovedProductListing();

          Admin myTestAdmin = new Admin();

          Merchant myTestMerch01 = new Merchant("Joe", "j@gmail.com", "C0121256", "custpwd", 1988, UserGender.Male);
          Merchant myTestMerch02 = new Merchant("Jane", "j@gmail.com", "C0121257", "custpwd", 1990, UserGender.Female);

          Product myProduct01 = new Product(myTestMerch01, "P1234", "Three-Legged Zebra", ProductCategory.Toys, 15.00);
          Product myProduct02 = new Product(myTestMerch01, "P1235", "Two-Legged Zebra", ProductCategory.Toys, 12.00);
          Product myProduct03 = new Product(myTestMerch02, "P1237", "Extra Hot Corn Chips", ProductCategory.Food, 10.00);

          myTestAdmin.ApproveProduct(myProduct01);
          myTestAdmin.ApproveProduct(myProduct02);
          myTestAdmin.ApproveProduct(myProduct03);

          myAllProd.AddToProductsListing(myProduct01);
          myAllProd.AddToProductsListing(myProduct02);
          myAllProd.AddToProductsListing(myProduct03);

          CollectionAssert.Contains(myAllProd.AllProductsList, myProduct01);  
          CollectionAssert.Contains(myAllProd.AllProductsList, myProduct02);
          CollectionAssert.Contains(myAllProd.AllProductsList, myProduct03);  
      }      
          


      [Test()]
      public void TestRemoveProduct()
      {
          OverallApprovedProductListing myAllProd = new OverallApprovedProductListing();

          Admin myTestAdmin = new Admin();

          Merchant myTestMerch01 = new Merchant("Joe", "j@gmail.com", "C0121256", "custpwd", 1988, UserGender.Male);
          Merchant myTestMerch02 = new Merchant("Jane", "j@gmail.com", "C0121257", "custpwd", 1990, UserGender.Female);

          Product myProduct01 = new Product(myTestMerch01, "P1234", "Three-Legged Zebra", ProductCategory.Toys, 15.00);
          Product myProduct02 = new Product(myTestMerch01, "P1235", "Two-Legged Zebra", ProductCategory.Toys, 12.00);
          Product myProduct03 = new Product(myTestMerch02, "P1237", "Extra Hot Corn Chips", ProductCategory.Food, 10.00);

          myTestAdmin.ApproveProduct(myProduct01);
          myTestAdmin.ApproveProduct(myProduct02);
          myTestAdmin.ApproveProduct(myProduct03);

          myAllProd.AddToProductsListing(myProduct01);
          myAllProd.AddToProductsListing(myProduct02);
          myAllProd.AddToProductsListing(myProduct03);

          myAllProd.RemoveFromProductsListing(myProduct01);

          CollectionAssert.DoesNotContain(myAllProd.AllProductsList, myProduct01);  
          CollectionAssert.Contains(myAllProd.AllProductsList, myProduct02);
          CollectionAssert.Contains(myAllProd.AllProductsList, myProduct03);  
      }

      [Test()]
      public void TestTotalApprovedProducts()
      {
          OverallApprovedProductListing myAllProd = new OverallApprovedProductListing();

          Admin myTestAdmin = new Admin();

          Merchant myTestMerch01 = new Merchant("Joe", "j@gmail.com", "C0121256", "custpwd", 1988, UserGender.Male);
          Merchant myTestMerch02 = new Merchant("Jane", "j@gmail.com", "C0121257", "custpwd", 1990, UserGender.Female);

          Product myProduct01 = new Product(myTestMerch01, "P1234", "Three-Legged Zebra", ProductCategory.Toys, 15.00);
          Product myProduct02 = new Product(myTestMerch01, "P1235", "Two-Legged Zebra", ProductCategory.Toys, 12.00);
          Product myProduct03 = new Product(myTestMerch02, "P1237", "Extra Hot Corn Chips", ProductCategory.Food, 10.00);

          myTestAdmin.ApproveProduct(myProduct01);
          myTestAdmin.RejectProduct(myProduct02);
          myTestAdmin.RejectProduct(myProduct03);

          myAllProd.AddToProductsListing(myProduct01);
          myAllProd.AddToProductsListing(myProduct02);
          myAllProd.AddToProductsListing(myProduct03);

          Assert.AreEqual(1, myAllProd.TotalApprovedProducts);
      }

    }

    
}