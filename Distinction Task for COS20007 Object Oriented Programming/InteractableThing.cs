using System;
using SplashKitSDK;

namespace DT01
{
    public abstract class InteractableThing
    {
        protected Icon _currenticon;
        protected bool _playerisnear;

        public InteractableThing(Icon currentIcon)
        { 
            _currenticon = currentIcon;
            _playerisnear = false;
        }

        public double XPlacement
        {
            get {return _currenticon.AtX;}
        }

        public double YPlacement
        {
            get {return _currenticon.AtY;}
        }

        public bool PlayerisNear
        {
            get {return _playerisnear;}
            set {_playerisnear = value;}
        }

        public virtual void CheckCallIconHighlight()
        {
            if (_playerisnear == true)
            {
                _currenticon.Highlight();
            }
            
            else
            {
                _currenticon.Unhighlight();
            }
            
        }

    }
}
