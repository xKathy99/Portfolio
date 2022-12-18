using System;
using System.Collections.Generic;

namespace PT13_ProductAndOrderManagementSystem
{
    public abstract class User
    {

        private string _name;
        private string _email;
        private string _id;
        private string _password;
        private int _yob;
        private UserGender _gender;
        private bool _isregistered;
        private bool _isloggedin;

        public User(string name, string id, string password, string email, int yob, UserGender gender)
        {

            _name = name;
            _id = id;
            _password = password;
            _email = email;
            _yob = yob;
            _gender = gender;

            _isregistered = false;
            _isloggedin = false;
        }

        public User():this("nameofuser", "email@email.com", "idXXXXXXXX", "userpwd", 0000, UserGender.Male)
        {
            _isregistered = false;
            _isloggedin = false;
        }



        public string Name
        {
            get {return _name;}
            set {_name = value;}
        }

        public string Email
        {
            get {return _email;}
            set {_email = value;}
        }

        public string ID
        {
            get {return _id;}
            set {_id = value;}
        }

        public string Password
        {
            get {return _password;}
            set {_password = value;}
        }

        public int YearOfBirth
        {
            get {return _yob;}
            set {_yob = value;}
        }

        public UserGender Gender
        {
            get {return _gender;}
            set {_gender = value;}
        }

        public bool IsRegistered 
        {
            get {return _isregistered;}
            set {_isregistered = value;}
        }

        public bool IsLoggedIn
        {
            get {return _isloggedin;}
            set {_isloggedin = value;}
        }

        
        public virtual void Register()
        {
            if (_isregistered == false)
            {
                _isregistered = true;

                Console.WriteLine("Register is successful! Please proceed to login.");
            }

            else 
            {
                Console.WriteLine("User is already registered! Please proceed to login.");
            }
        }

        public virtual void LogIn(string id, string password)
        {
            if ((id == _id) & (password == _password))
            {

                if (_isregistered == true)
                {

                    if (_isloggedin == false)
                    {
                        _isloggedin = true;

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

        public void LogOut()
        {
            _isloggedin = false;
    
            Console.WriteLine("Log out successful!");
        }

        public virtual void ViewProduct(Product prod)
        {
            if (IsLoggedIn == false)
            {
                Console.WriteLine("Please log in to view product!");

            }

            else
            {
                string output = ("Product ID: " + prod.ProdID + "\n "
                            + "Product Name: " + prod.ProdName + "\n "
                            + "Category: " + prod.ProdCategory + "\n "
                            + "Description: " + prod.ProdDescr + "\n"
                            + "Cost: " + prod.ProdCostPerUnit + "\n "
                            + "Rating: " + prod.ProdRating + "\n "
                            + "Merchant: " + prod.GetMerchantName + "\n "
                            + "Product Approval Status: " + prod.ProdApprovalStatus + "\n");

                Console.WriteLine(output);
            }
        }
    }
}