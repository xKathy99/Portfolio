using System;
using SplashKitSDK;

namespace DT01 //Use DrawObject for outline
{
    public class Tool: InteractableThing
    {
        private ToolType _tooltype;

        public Tool(Icon currentIcon, ToolType type):base(currentIcon)
        {
            _tooltype = type;
        }
        
        public ToolType TypeOfTool
        {
            get {return _tooltype;}
            set {_tooltype = value;}
        }

    }
}