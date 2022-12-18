using System;
using SplashKitSDK;

namespace DT01
{
    public class Vent: InteractableThing
    {
        private bool _traitorisnear;
        public Vent(Icon currentIcon):base(currentIcon)
        {            
            _traitorisnear = false;
        }

        public bool TraitorisNear
        {
            get {return _traitorisnear;}
            set {_traitorisnear = value;}
        }

    }
}