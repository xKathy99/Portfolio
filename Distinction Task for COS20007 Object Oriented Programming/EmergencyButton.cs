using System;
using SplashKitSDK;

namespace DT01
{
    public class EmergencyButton: InteractableThing
    {
        
        private bool _isbuttonselectbutton;
        private bool _canbeselected;


        public EmergencyButton(Icon currentIcon):base(currentIcon)
        {
            _isbuttonselectbutton = false;
            _canbeselected = true;
        }

        public bool IsEButtonSelected
        {
            get {return _isbuttonselectbutton;}
            set {_isbuttonselectbutton = value;}
        }

        public bool CanBeSelected
        {
            get {return _canbeselected;}
            set {_canbeselected = value;}
        }

        public void EButtonCooldown()
        {
            //unable to select the button at this time
        }
    }
}