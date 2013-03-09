// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

var gRootFolder				= FMCGetRootFolder( document.location );
var gHelpSystem				= null;
var gStartTopic				= gDefaultStartTopic;
var gLoadingLabel			= "LOADING";
var gLoadingAlternateText	= "Loading";

CheckCSH();

gOnloadFuncs.push( Init );

window.onresize = WindowOnresize;

function WindowOnresize()
{
	// Firefox on Mac: might trigger this event before everything is finished being loaded.
	
	var indexFrame	= frames["navigation"].frames["index"];
	
	if ( indexFrame )
	{
		indexFrame.RefreshIndex();
	}
}

function CheckCSH()
{
	var hash	= document.location.hash.substring( 1 );
	
	if ( hash != "" )
	{
		if ( FMCIsSafari() )
		{
			hash = hash.replace( /%23/g, "#" );
		}

		var cshParts	= hash.split( "|" );
		
		for ( var i = 0; i < cshParts.length; i++ )
		{
			var pair	= cshParts[i].split( "=" );
			
			if ( pair[0] == "StartTopic" )
			{
				gStartTopic = pair[1];
			}
			else if ( pair[0] == "SkinName" )
			{
				gSkinFolder = "Data/Skin" + pair[1] + "/";
			}
		}
	}
}

function GetMasterHelpSystem()
{
	if ( !gHelpSystem )
	{
		gHelpSystem = new CMCHelpSystem( null, gRootFolder, gRootFolder + gSubsystemFile, null );
	}
	
	return gHelpSystem;
}

function Init()
{
	FMCPreloadImage( MCGlobals.SkinTemplateFolder + "Images/Loading.gif" );
	
	LoadSkin();
}

function LoadSkin()
{
    var xmlDoc		= CMCXmlParser.GetXmlDoc( gRootFolder + gSkinFolder + "Skin.xml", false, null, null );
    var xmlHead		= xmlDoc.getElementsByTagName( "CatapultSkin" )[0];
    var caption		= xmlHead.getAttribute( "Title" );
    
    if ( caption == null )
    {
		var masterHS	= GetMasterHelpSystem();

		if ( masterHS.IsWebHelpPlus )
		{
			caption = "WebHelp Plus";
		}
		else
		{
			caption = "WebHelp";
		}
    }
    
    document.title = caption;
    
    //
    
    LoadWebHelpOptions( xmlDoc );
    
    if ( document.location.hash == null || document.location.hash.indexOf( "OpenType=Javascript" ) == -1 )
    {
		LoadSize( xmlDoc );
    }
}

function LoadSize( xmlDoc )
{
    try
    {
        var doc = frames["body"].document;
    }
    catch ( err )
    {
        return;
    }
    
    var xmlHead			= xmlDoc.documentElement;
    var useDefaultSize	= FMCGetAttributeBool( xmlHead, "UseBrowserDefaultSize", false );
    
    if ( useDefaultSize )
    {
		return;
    }
    
    var topPx		= FMCConvertToPx( frames["body"].document, xmlHead.getAttribute( "Top" ), null, 0 );
    var leftPx		= FMCConvertToPx( frames["body"].document, xmlHead.getAttribute( "Left" ), null, 0 );
    var bottomPx	= FMCConvertToPx( frames["body"].document, xmlHead.getAttribute( "Bottom" ), null, 0 );
    var rightPx		= FMCConvertToPx( frames["body"].document, xmlHead.getAttribute( "Right" ), null, 0 );
    var widthPx		= FMCConvertToPx( frames["body"].document, xmlHead.getAttribute( "Width" ), "Width", 800 );
    var heightPx	= FMCConvertToPx( frames["body"].document, xmlHead.getAttribute( "Height" ), "Height", 600 );
    
    var anchors = xmlHead.getAttribute( "Anchors" );
    
    if ( anchors )
    {
        var aTop    = (anchors.indexOf( "Top" ) > -1)    ? true : false;
        var aLeft   = (anchors.indexOf( "Left" ) > -1)   ? true : false;
        var aBottom = (anchors.indexOf( "Bottom" ) > -1) ? true : false;
        var aRight  = (anchors.indexOf( "Right" ) > -1)  ? true : false;
        var aWidth  = (anchors.indexOf( "Width" ) > -1)  ? true : false;
        var aHeight = (anchors.indexOf( "Height" ) > -1) ? true : false;
    }
    
    if ( aLeft && aRight )
    {
        widthPx = screen.availWidth - (leftPx + rightPx);
    }
    else if ( !aLeft && aRight )
    {
        leftPx = screen.availWidth - (widthPx + rightPx);
    }
    else if ( aWidth )
    {
        leftPx = (screen.availWidth / 2) - (widthPx / 2);
    }
    
    if ( aTop && aBottom )
    {
        heightPx = screen.availHeight - (topPx + bottomPx);
    }
    else if ( !aTop && aBottom )
    {
        topPx = screen.availHeight - (heightPx + bottomPx);
    }
    else if ( aHeight )
    {
        topPx = (screen.availHeight / 2) - (heightPx / 2);
    }
    
	if ( window == top )
	{
		try
		{
			// This is in a try/catch block because there seems to be a bug in IE where if the window loses focus
			// immediately before these statements are executed, IE will produce an "Access is denied" error.
			
			window.resizeTo( widthPx, heightPx );
			window.moveTo( leftPx, topPx );
		}
		catch ( err )
		{
		}
	}
}

function LoadWebHelpOptions( xmlDoc )
{
    var webHelpOptions	= xmlDoc.getElementsByTagName( "WebHelpOptions" )[0];
    var navPosition		= "Left";
    
    if ( webHelpOptions )
    {
		if ( webHelpOptions.getAttribute( "NavigationPanePosition" ) )
		{
			navPosition = webHelpOptions.getAttribute( "NavigationPanePosition" );
		}
		
        if ( webHelpOptions.getAttribute( "NavigationPaneWidth" ) )
        {
            var navWidth    = webHelpOptions.getAttribute( "NavigationPaneWidth" );
            
            if ( navWidth != "0" )
            {
				var hideNavStartup	= FMCGetAttributeBool( webHelpOptions, "HideNavigationOnStartup", false );
				
				if ( !hideNavStartup )
				{
					if ( navPosition == "Left" )
					{
						document.getElementsByTagName( "frameset" )[1].cols = navWidth + ", *";
					}
					else if ( navPosition == "Right" )
					{
						document.getElementsByTagName( "frameset" )[1].cols = "*, " + navWidth;
					}
					else if ( navPosition == "Top" )
					{
						var resizeBarHeight = 7;
	                    
						document.getElementsByTagName( "frameset" )[0].rows = navWidth + ", " + resizeBarHeight + ", *";
					}
					else if ( navPosition == "Bottom" )
					{
						document.getElementsByTagName( "frameset" )[0].rows = "*, " + navWidth;
					}
                }
            }
        }
    }
    
    // Safari
    
    if ( FMCIsSafari() )
    {
		var frameNodes	= document.getElementsByTagName( "frame" );
		
		for ( var i = 0; i < frameNodes.length; i++ )
        {
            if ( frameNodes[i].name == "navigation" )
            {
				if ( navPosition == "Left" )
				{
					frameNodes[i].style.borderRight = "solid 1px #444444";
					
					break;
				}
				else if ( navPosition == "Right" )
				{
					frameNodes[i].style.borderLeft = "solid 1px #444444";
                    
                    break;
				}
            }
        }
    }
}
