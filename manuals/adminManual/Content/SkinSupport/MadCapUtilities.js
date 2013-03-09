// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

var gLoaded					= false;
var gOnloadFuncs			= new Array();
var gPreviousOnloadFunction	= window.onload;
var gReady					= false;

if ( gPreviousOnloadFunction != null )
{
	gOnloadFuncs.push( gPreviousOnloadFunction );
}

window.onload = function()
{
	gReady = true;
	
	MCGlobals.Init();
	
	FMCRegisterCallback( "MCGlobals", MCEventType.OnInit, OnMCGlobalsInit, null );
};

function OnMCGlobalsInit( args )
{
	gLoaded = true;
	
	for ( var i = 0; i < gOnloadFuncs.length; i++ )
	{
		gOnloadFuncs[i]();
	}
}

var MCGlobals	= new function()
{
	// Private member variables
	
	var mSelf	= this;
	
	// Public properties

	this.SubsystemFile		= "ZeusCart 2.xml";
	this.SkinFolder			= "Data/SkinZeusCart/";
	this.SkinTemplateFolder	= "Skin/";
	this.DefaultStartTopic	= "Welcome.htm";
	
	this.Initialized		= false;
	
	this.RootFolder			= null;
	this.RootFrame			= null;
	this.ToolbarFrame		= null;
	this.BodyFrame			= null;
	this.NavigationFrame	= null;
	this.TopicCommentsFrame	= null;
	this.BodyCommentsFrame	= null;
	this.PersistenceFrame	= null;
	
	// Private methods
	
	function InitRoot()
	{
		mSelf.RootFrame = window;
		mSelf.ToolbarFrame = frames["mctoolbar"];
		mSelf.BodyFrame = frames["body"];
		mSelf.NavigationFrame = frames["navigation"];
		mSelf.PersistenceFrame = null;
		
		//
		
		var bodyReady	= false;
		
		FMCRegisterCallback( "Navigation", MCEventType.OnReady, OnNavigationReady, null );
		
		function OnNavigationReady( args )
		{
			mSelf.TopicCommentsFrame = mSelf.NavigationFrame.frames["topiccomments"];
			
			//
			
			if ( bodyReady )
			{
				mSelf.Initialized = true;
			}
		}
		
		FMCRegisterCallback( "Body", MCEventType.OnReady, OnBodyReady, null );
			
		function OnBodyReady( args )
		{
			mSelf.BodyCommentsFrame = mSelf.BodyFrame.frames["topiccomments"];
			
			//
			
			bodyReady = true;
			
			if ( mSelf.TopicCommentsFrame != null )
			{
				mSelf.Initialized = true;
			}
		}
	}
	
	function InitTopicCHM()
	{
		mSelf.RootFrame = null;
		mSelf.ToolbarFrame = frames["mctoolbar"];
		mSelf.BodyFrame = window;
		mSelf.NavigationFrame = null;
		mSelf.TopicCommentsFrame = null;
		mSelf.BodyCommentsFrame = frames["topiccomments"];
		mSelf.PersistenceFrame = frames["persistence"];
		
		//
			
		mSelf.Initialized = true;
	}
	
	function InitNavigation()
	{
		mSelf.RootFrame = parent;
		mSelf.NavigationFrame = window;
		mSelf.TopicCommentsFrame = frames["topiccomments"];
		mSelf.PersistenceFrame = null;
		
		FMCRegisterCallback( "Root", MCEventType.OnReady, OnRootReady, null );
			
		function OnRootReady( args )
		{
			mSelf.ToolbarFrame = mSelf.RootFrame.frames["mctoolbar"];
			mSelf.BodyFrame = mSelf.RootFrame.frames["body"];
			
			FMCRegisterCallback( "Body", MCEventType.OnReady, OnBodyReady, null );
			
			function OnBodyReady( args )
			{
				mSelf.BodyCommentsFrame = mSelf.BodyFrame.frames["topiccomments"];
				
				//
				
				mSelf.Initialized = true;
			}
		}
	}
	
	function InitNavigationFramesWebHelp()
	{
		var bodyReady	= false;
		
		mSelf.RootFrame = parent.parent;
		mSelf.NavigationFrame = parent;
		mSelf.PersistenceFrame = null;
		
		FMCRegisterCallback( "Root", MCEventType.OnReady, OnRootReady, null );
			
		function OnRootReady( args )
		{
			mSelf.ToolbarFrame = mSelf.RootFrame.frames["mctoolbar"];
			mSelf.BodyFrame = mSelf.RootFrame.frames["body"];
			
			FMCRegisterCallback( "Body", MCEventType.OnReady, OnBodyReady, null );
			
			function OnBodyReady( args )
			{
				mSelf.BodyCommentsFrame = mSelf.BodyFrame.frames["topiccomments"];
				
				//
				
				bodyReady = true;
				
				if ( mSelf.TopicCommentsFrame != null )
				{
					mSelf.Initialized = true;
				}
			}
		}
		
		FMCRegisterCallback( "Navigation", MCEventType.OnReady, OnNavigationReady, null );
			
		function OnNavigationReady( args )
		{
			mSelf.TopicCommentsFrame = mSelf.NavigationFrame.frames["topiccomments"];
			
			//
			
			if ( bodyReady )
			{
				mSelf.Initialized = true;
			}
		}
	}
	
	function InitBodyCommentsFrameWebHelp()
	{
		mSelf.RootFrame = parent.parent;
		mSelf.NavigationFrame = parent.parent.frames["navigation"];
		mSelf.PersistenceFrame = null;
		mSelf.ToolbarFrame = parent.parent.frames["mctoolbar"];
		mSelf.BodyFrame = parent;
		mSelf.BodyCommentsFrame = window;
		
		FMCRegisterCallback( "Navigation", MCEventType.OnReady, OnNavigationReady, null );
			
		function OnNavigationReady( args )
		{
			mSelf.TopicCommentsFrame = mSelf.NavigationFrame.frames["topiccomments"];
			
			//
			
			mSelf.Initialized = true;
		}
	}
	
	function InitBodyCommentsFrameDotNetHelp()
	{
		mSelf.RootFrame = null;
		mSelf.ToolbarFrame = null;
		mSelf.BodyFrame = parent;
		mSelf.NavigationFrame = null;
		mSelf.TopicCommentsFrame = null;
		mSelf.BodyCommentsFrame = window;
		mSelf.PersistenceFrame = null;

		//

		mSelf.Initialized = true;
	}
	
	function InitToolbarWebHelp()
	{
		mSelf.RootFrame = parent;
		mSelf.ToolbarFrame = window;
		mSelf.PersistenceFrame = null;
		
		FMCRegisterCallback( "Root", MCEventType.OnReady, OnRootReady, null );
			
		function OnRootReady( args )
		{
			mSelf.BodyFrame = mSelf.RootFrame.frames["body"];
			mSelf.NavigationFrame = mSelf.RootFrame.frames["navigation"];
			
			//
			
			var bodyReady	= false;
			
			FMCRegisterCallback( "Navigation", MCEventType.OnReady, OnNavigationReady, null );
			
			function OnNavigationReady( args )
			{
				mSelf.TopicCommentsFrame = mSelf.NavigationFrame.frames["topiccomments"];
				
				//
				
				if ( bodyReady )
				{
					mSelf.Initialized = true;
				}
			}
			
			FMCRegisterCallback( "Body", MCEventType.OnReady, OnBodyReady, null );
			
			function OnBodyReady( args )
			{
				mSelf.BodyCommentsFrame = mSelf.BodyFrame.frames["topiccomments"];
				
				//
				
				bodyReady = true;
				
				if ( mSelf.TopicCommentsFrame != null )
				{
					mSelf.Initialized = true;
				}
			}
		}
	}
	
	function InitToolbarCHM()
	{
		mSelf.RootFrame = null;
		mSelf.ToolbarFrame = window;
		mSelf.BodyFrame = parent;
		mSelf.NavigationFrame = null;
		mSelf.TopicCommentsFrame = null;
		
		FMCRegisterCallback( "Body", MCEventType.OnReady, OnBodyReady, null );
			
		function OnBodyReady( args )
		{
			mSelf.BodyCommentsFrame = mSelf.BodyFrame.frames["topiccomments"];
			mSelf.PersistenceFrame = mSelf.BodyFrame.frames["persistence"];
			
			//
		
			mSelf.Initialized = true;
		}
	}
	
	function InitTopicWebHelp()
	{
		mSelf.RootFrame = parent;
		mSelf.BodyFrame = window;
		mSelf.BodyCommentsFrame = mSelf.BodyFrame.frames["topiccomments"];
		mSelf.PersistenceFrame = null;
		
		FMCRegisterCallback( "Root", MCEventType.OnReady, OnRootReady, null );
		
		function OnRootReady( args )
		{
			mSelf.ToolbarFrame = mSelf.RootFrame.frames["mctoolbar"];
			mSelf.NavigationFrame = mSelf.RootFrame.frames["navigation"];
			
			FMCRegisterCallback( "Navigation", MCEventType.OnReady, OnNavigationReady, null );
			
			function OnNavigationReady( args )
			{
				mSelf.TopicCommentsFrame = mSelf.NavigationFrame.frames["topiccomments"];
				
				//
			
				mSelf.Initialized = true;
			}
		}
	}
	
	function InitTopicDotNetHelp()
	{
		mSelf.RootFrame = null;
		mSelf.ToolbarFrame = null;
		mSelf.BodyFrame = window;
		mSelf.NavigationFrame = null;
		mSelf.TopicCommentsFrame = null;
		mSelf.BodyCommentsFrame = mSelf.BodyFrame.frames["topiccomments"];
		mSelf.PersistenceFrame = null;

		//

		mSelf.Initialized = true;
	}
	
	function InitNavigationFramesCHM()
	{
		mSelf.RootFrame = null;
		mSelf.BodyFrame = parent;
		mSelf.NavigationFrame = null;
		mSelf.TopicCommentsFrame = null;
		
		FMCRegisterCallback( "Body", MCEventType.OnReady, OnBodyReady, null );
			
		function OnBodyReady( args )
		{
			mSelf.ToolbarFrame = mSelf.BodyFrame.frames["mctoolbar"];
			mSelf.BodyCommentsFrame = mSelf.BodyFrame.frames["topiccomments"];
			mSelf.PersistenceFrame = mSelf.BodyFrame.frames["persistence"];
			
			//
		
			mSelf.Initialized = true;
		}
	}
	
	// Public methods
	
	this.Init	= function()
	{
		if ( FMCInPreviewMode() )
		{
			mSelf.Initialized = true;
			
			return;
		}
		
		if ( frames["mctoolbar"] != null )	// Root or topic in CHM
		{
			mSelf.ToolbarFrame = frames["mctoolbar"];
			
			if ( frames["body"] != null )	// Root
			{
				InitRoot();
			}
			else							// Topic in CHM
			{
				InitTopicCHM();
			}
		}
		else if ( window.name == "navigation" )	// Navigation
		{
			InitNavigation();
		}
		else if ( parent.name == "navigation" )	// Navigation frames in WebHelp
		{
			InitNavigationFramesWebHelp();
		}
		else if ( window.name == "mctoolbar" )	// Toolbar
		{
			mSelf.ToolbarFrame = window;
			
			if ( parent.frames["navigation"] != null )	// Toolbar in WebHelp
			{
				InitToolbarWebHelp();
			}
			else										// Toolbar in CHM
			{
				InitToolbarCHM();
			}
		}
		else if ( window.name == "body" )	// Topic in WebHelp
		{
			if ( FMCIsWebHelp() )
			{
				InitTopicWebHelp();
			}
			else if ( FMCIsDotNetHelp() )
			{
				InitTopicDotNetHelp();
			}
			else if ( FMCIsHtmlHelp() )
			{
				InitTopicCHM();
			}
		}
		else if ( window.name == "topiccomments" )
		{
			if ( parent.name != "body" )
			{
				mSelf.Initialized = true;
				
				return;
			}
			
			if ( FMCIsHtmlHelp() )
			{
				InitNavigationFramesCHM();	// Body comments frame in CHM
			}
			else if ( FMCIsWebHelp() )
			{
				InitBodyCommentsFrameWebHelp();	// Body comments frame in WebHelp body
			}
			else if ( FMCIsDotNetHelp() )
			{
				InitBodyCommentsFrameDotNetHelp();	// Body comments frame in DotNet Help body
			}
		}
		else if (	window.name == "toc" ||
					window.name == "index" ||
					window.name == "search" ||
					window.name == "glossary" ||
					window.name == "favorites" ||
					window.name == "browsesequences" ||
					window.name == "recentcomments" )	// Navigation frames in CHM
		{
			InitNavigationFramesCHM();
		}
		else if ( FMCIsDotNetHelp() )
		{
			mSelf.Initialized = true;
		}
		else
		{
			mSelf.Initialized = true;
			
			return;
		}
		
		if ( FMCIsWebHelp() )
		{
			var rootFolder	= mSelf.RootFrame.document.location.href.substring( 0, mSelf.RootFrame.document.location.href.lastIndexOf( "/" ) + 1 );
			var subFolder	= document.location.href.substring( 0, document.location.href.lastIndexOf( "/" ) + 1 );
			
			if ( subFolder.StartsWith( rootFolder + "Subsystems", false ) )
			{
				var href	= document.location.href;
				var subPart	= document.location.href.substring( (rootFolder + "Subsystems").length + 1 );
				
				subPart = subPart.substring( 0, subPart.indexOf( "/" ) + 1 );
				rootFolder = rootFolder + "Subsystems/" + subPart;
				
				rootFolder = rootFolder.replace( /\\/g, "/" );
				rootFolder = rootFolder.replace( /%20/g, " " );
				rootFolder = rootFolder.replace( /;/g, "%3B" );	// For Safari
				
				mSelf.RootFolder = rootFolder;
			}
			else if ( subFolder.StartsWith( rootFolder + "AutoMerge", false ) )
			{
				var href	= document.location.href;
				var subPart	= document.location.href.substring( (rootFolder + "AutoMerge").length + 1 );
				
				subPart = subPart.substring( 0, subPart.indexOf( "/" ) + 1 );
				rootFolder = rootFolder + "AutoMerge/" + subPart;
				
				rootFolder = rootFolder.replace( /\\/g, "/" );
				rootFolder = rootFolder.replace( /%20/g, " " );
				rootFolder = rootFolder.replace( /;/g, "%3B" );	// For Safari
				
				mSelf.RootFolder = rootFolder;
			}
			else
			{
				mSelf.RootFolder = FMCGetRootFolder( mSelf.RootFrame.document.location );
			}
		}
		else if ( FMCIsHtmlHelp() )
		{
			mSelf.RootFolder = "/";
		}
		else if ( FMCIsDotNetHelp() )
		{
			var rootFolder	= FMCGetRootFolder( mSelf.BodyFrame.document.location );
			
			mSelf.RootFolder = rootFolder.substring( 0, rootFolder.lastIndexOf( "/", rootFolder.length - 2 ) + 1 );
		}
	}
}

//
//    Helper functions
//

var gImages	= new Array();

function FMCIsWebHelp()
{
	return FMCGetRootFrame() != null;
}

function FMCIsHtmlHelp()
{
	var href	= document.location.href;
	
	return href.indexOf( "mk:" ) == 0;
}

function FMCIsDotNetHelp()
{
	return FMCGetRootFrame() == null && !FMCIsHtmlHelp();
}

function FMCIsTopicPopup()
{
	return window.parent != window && window.parent.name == "body";
}

var gLiveHelpEnabled	= null;

function FMCIsLiveHelpEnabled()
{
	if ( gLiveHelpEnabled == null )
	{
		var xmlDoc		= CMCXmlParser.GetXmlDoc( MCGlobals.RootFolder + MCGlobals.SubsystemFile, false, null, null );
		
		if ( xmlDoc == null )
		{
			gLiveHelpEnabled = false;
		}
		else
		{
			var projectID	= xmlDoc.documentElement.getAttribute( "LiveHelpOutputId" );
			
			gLiveHelpEnabled = projectID != null;
		}
	}
	
	return gLiveHelpEnabled;
}

function FMCInPreviewMode()
{
	return FMCGetRootFrame() == null && !FMCIsHtmlHelp();
}

var gSkinPreviewMode	= null;

function FMCIsSkinPreviewMode()
{
	if ( gSkinPreviewMode == null )
	{
		var xmlDoc		= CMCXmlParser.GetXmlDoc( MCGlobals.RootFolder + MCGlobals.SubsystemFile, false, null, null );
		
		if ( xmlDoc == null )
		{
			gSkinPreviewMode = false;
		}
		else
		{
			gSkinPreviewMode = FMCGetAttributeBool( xmlDoc.documentElement, "SkinPreviewMode", false );
		}
	}
	
	return gSkinPreviewMode;
}

function FMCIsIE55()
{
	return navigator.appVersion.indexOf( "MSIE 5.5" ) != -1;
}

function FMCIsSafari()
{
	return typeof( document.clientHeight ) != "undefined";
}

function FMCGetSkinFolder()
{
	var skinFolder	= null;
	
	if ( MCGlobals.RootFrame != null )
	{
		skinFolder = MCGlobals.RootFrame.gSkinFolder;
	}
	else
	{
		skinFolder = MCGlobals.SkinFolder;
	}
	
	return skinFolder;
}

function FMCGetHref( currLocation )
{
	var href	= currLocation.protocol + (!FMCIsHtmlHelp() ? "//" : "") + currLocation.host + currLocation.pathname;

	href = FMCEscapeHref( href );

	return href;
}

function FMCEscapeHref( href )
{
	var newHref	= href.replace( /\\/g, "/" );
	newHref = newHref.replace( /%20/g, " " );
	newHref = newHref.replace( /;/g, "%3B" );	// For Safari

	return newHref;
}

function FMCGetRootFolder( currLocation )
{
	var href		= FMCGetHref( currLocation );
	var rootFolder	= href.substring( 0, href.lastIndexOf( "/" ) + 1 );

	return rootFolder;
}

function FMCGetPathnameFolder( currLocation )
{
	var pathname	= currLocation.pathname;

	// This is for when viewing over a network. IE needs the path to be like this.

	if ( currLocation.protocol.StartsWith( "file" ) )
	{
		if ( !currLocation.host.IsNullOrEmpty() )
		{
			pathname = "/" + currLocation.host + currLocation.pathname;
		}
	}

	//

	pathname = pathname.replace( /\\/g, "/" );
	//pathname = pathname.replace( /%20/g, " " );
	pathname = pathname.replace( /;/g, "%3B" );	// For Safari
	pathname = pathname.substring( 0, pathname.lastIndexOf( "/" ) + 1 );

	return pathname;
}

function FMCGetRootFrame()
{
	var currWindow	= window;
	
	while ( currWindow )
	{
		if ( currWindow.gRootFolder )
		{
			break;
		}
		else if ( currWindow == top )
		{
			currWindow = null;
			
			break;
		}
		
		currWindow = currWindow.parent;
	}
	
	return currWindow;
}

function FMCPreloadImage( imgPath )
{
	if ( imgPath == null )
	{
		return;
	}
	
	if ( imgPath.StartsWith( "url", false ) && imgPath.EndsWith( ")", false ) )
	{
		imgPath = FMCStripCssUrl( imgPath );
	}
	
	var index	= gImages.length;
	
    gImages[index] = new Image();
    gImages[index].src = imgPath;
}

function FMCTrim( str )
{
    return FMCLTrim( FMCRTrim( str ) );
}

function FMCLTrim( str )
{
    for ( var i = 0; i < str.length && str.charAt( i ) == " "; i++ );
    
    return str.substring( i, str.length );
}

function FMCRTrim( str )
{
    for ( var i = str.length - 1; i >= 0 && str.charAt( i ) == " "; i-- );
    
    return str.substring( 0, i + 1 );
}

function FMCContainsClassRoot( className )
{
    var ret = null;
    
    for ( var i = 1; i < FMCContainsClassRoot.arguments.length; i++ )
    {
        var classRoot = arguments[i];
        
        if ( className && (className == classRoot || className.indexOf( classRoot + "_" ) == 0) )
        {
            ret = classRoot;
            
            break;
        }
    }
    
    return ret;
}

function FMCGetChildNodeByTagName( node, tagName, index )
{
    var foundNode   = null;
    var numFound    = -1;
    
    for ( var currNode = node.firstChild; currNode != null; currNode = currNode.nextSibling )
    {
        if ( currNode.nodeName == tagName )
        {
            numFound++;
            
            if ( numFound == index )
            {
                foundNode = currNode;
                
                break;
            }
        }
    }
    
    return foundNode;
}

function FMCGetChildNodesByTagName( node, tagName )
{
    var nodes   = new Array();
    
    for ( var i = 0; i < node.childNodes.length; i++ )
    {
        if ( node.childNodes[i].nodeName == tagName )
        {
            nodes[nodes.length] = node.childNodes[i];
        }
    }
    
    return nodes;
}

function FMCStringToBool( stringValue )
{
	var boolValue		= false;
	var stringValLower	= stringValue.toLowerCase();

	boolValue = stringValLower == "true" || stringValLower == "1" || stringValLower == "yes";

	return boolValue;
}

function FMCGetAttributeBool( node, attributeName, defaultValue )
{
	var boolValue	= defaultValue;
	var value		= FMCGetAttribute( node, attributeName );
	
	if ( value )
	{
		boolValue = FMCStringToBool( value );
	}
	
	return boolValue;
}

function FMCGetAttributeInt( node, attributeName, defaultValue )
{
	var intValue	= defaultValue;
	var value		= FMCGetAttribute( node, attributeName );
	
	if ( value != null )
	{
		intValue = parseInt( value );
	}
	
	return intValue;
}

function FMCGetAttribute( node, attribute )
{
    var value   = null;
    
    if ( node.getAttribute( attribute ) != null )
    {
        value = node.getAttribute( attribute );
    }
    else if ( node.getAttribute( attribute.toLowerCase() ) != null )
    {
        value = node.getAttribute( attribute.toLowerCase() );
    }
    else
    {
		var namespaceIndex	= attribute.indexOf( ":" );
		
		if ( namespaceIndex != -1 )
		{
			value = node.getAttribute( attribute.substring( namespaceIndex + 1, attribute.length ) );
		}
    }
    
    if ( typeof( value ) == "string" && value == "" )
    {
		value = null;
    }
    
    return value;
}

function FMCGetMCAttribute( node, attribute )
{
	var value	= null;
	
    if ( node.getAttribute( attribute ) != null )
    {
        value = node.getAttribute( attribute );
    }
    else if ( node.getAttribute( attribute.substring( "MadCap:".length, attribute.length ) ) )
    {
        value = node.getAttribute( attribute.substring( "MadCap:".length, attribute.length ) );
    }
    
    return value;
}

function FMCRemoveMCAttribute( node, attribute )
{
	var value	= null;
	
    if ( node.getAttribute( attribute ) != null )
    {
        value = node.removeAttribute( attribute );
    }
    else if ( node.getAttribute( attribute.substring( "MadCap:".length, attribute.length ) ) )
    {
        value = node.removeAttribute( attribute.substring( "MadCap:".length, attribute.length ) );
    }
    
    return value;
}

function FMCGetClientWidth( winNode, includeScrollbars )
{
    var clientWidth = null;
    
    if ( typeof( winNode.innerWidth ) != "undefined" )
    {
        clientWidth = winNode.innerWidth;
        
        if ( !includeScrollbars && FMCGetScrollHeight( winNode ) > winNode.innerHeight )
        {
            clientWidth -= 19;
        }
    }
    else if ( FMCIsIE55() || (winNode.document.compatMode && winNode.document.compatMode == "BackCompat") )
    {
        clientWidth = winNode.document.body.clientWidth;
    }
    else if ( winNode.document.documentElement )
    {
        clientWidth = winNode.document.documentElement.clientWidth;
    }
    
    return clientWidth;
}

function FMCGetClientHeight( winNode, includeScrollbars )
{
    var clientHeight    = null;
    
    if ( typeof( winNode.innerHeight ) != "undefined" )
    {
        clientHeight = winNode.innerHeight;
        
        if ( !includeScrollbars && FMCGetScrollWidth( winNode ) > winNode.innerWidth )
        {
            clientHeight -= 19;
        }
    }
    else if ( FMCIsIE55() || (winNode.document.compatMode && winNode.document.compatMode == "BackCompat") )
    {
        clientHeight = winNode.document.body.clientHeight;
    }
    else if ( winNode.document.documentElement )
    {
        clientHeight = winNode.document.documentElement.clientHeight;
    }
    
    return clientHeight;
}

function FMCGetClientCenter( winNode )
{
	var centerX	= FMCGetScrollLeft( winNode ) + (FMCGetClientWidth( winNode, false ) / 2);
	var centerY	= FMCGetScrollTop( winNode ) + (FMCGetClientHeight( winNode, false ) / 2);
	
	return [centerX, centerY];
}

function FMCGetScrollHeight( winNode )
{
    var scrollHeight    = null;
    
    if ( winNode.document.scrollHeight )
    {
        scrollHeight = winNode.document.scrollHeight;
    }
    else if ( FMCIsIE55() || (winNode.document.compatMode && winNode.document.compatMode == "BackCompat") )
    {
        scrollHeight = winNode.document.body.scrollHeight;
    }
    else if ( winNode.document.documentElement )
    {
        scrollHeight = winNode.document.documentElement.scrollHeight;
    }
    
    return scrollHeight;
}

function FMCGetScrollWidth( winNode )
{
    var scrollWidth = null;
    
    if ( winNode.document.scrollWidth )
    {
        scrollWidth = winNode.document.scrollWidth;
    }
    else if ( FMCIsIE55() || (winNode.document.compatMode && winNode.document.compatMode == "BackCompat") )
    {
        scrollWidth = winNode.document.body.scrollWidth;
    }
    else if ( winNode.document.documentElement )
    {
        scrollWidth = winNode.document.documentElement.scrollWidth;
    }
    
    return scrollWidth;
}

function FMCGetScrollTop( winNode )
{
    var scrollTop   = null;
    
    if ( FMCIsSafari() )
    {
        scrollTop = winNode.document.body.scrollTop;
    }
    else if ( FMCIsIE55() || (winNode.document.compatMode && winNode.document.compatMode == "BackCompat") )
    {
        scrollTop = winNode.document.body.scrollTop;
    }
    else if ( winNode.document.documentElement )
    {
        scrollTop = winNode.document.documentElement.scrollTop;
    }
    
    return scrollTop;
}

function FMCSetScrollTop( winNode, value )
{
    if ( FMCIsSafari() )
    {
        winNode.document.body.scrollTop = value;
    }
    else if ( FMCIsIE55() || (winNode.document.compatMode && winNode.document.compatMode == "BackCompat") )
    {
        winNode.document.body.scrollTop = value;
    }
    else if ( winNode.document.documentElement )
    {
        winNode.document.documentElement.scrollTop = value;
    }
}

function FMCGetScrollLeft( winNode )
{
    var scrollLeft  = null;
    
    if ( FMCIsSafari() )
    {
        scrollLeft = winNode.document.body.scrollLeft;
    }
    else if ( FMCIsIE55() || (winNode.document.compatMode && winNode.document.compatMode == "BackCompat") )
    {
        scrollLeft = winNode.document.body.scrollLeft;
    }
    else if ( winNode.document.documentElement )
    {
        scrollLeft = winNode.document.documentElement.scrollLeft;
    }
    
    return scrollLeft;
}

function FMCSetScrollLeft( winNode, value )
{
    if ( FMCIsSafari() )
    {
        winNode.document.body.scrollLeft = value;
    }
    else if ( FMCIsIE55() || (winNode.document.compatMode && winNode.document.compatMode == "BackCompat") )
    {
        winNode.document.body.scrollLeft = value;
    }
    else if ( winNode.document.documentElement )
    {
        winNode.document.documentElement.scrollLeft = value;
    }
}

function FMCGetClientX( winNode, e )
{
    var clientX;
    
    if ( typeof( e.pageX ) != "undefined" )
    {
        clientX = e.pageX - FMCGetScrollLeft( winNode );
    }
    else if ( typeof( e.clientX ) != "undefined" )
    {
        clientX = e.clientX;
    }
    
    return clientX;
}

function FMCGetClientY( winNode, e )
{
    var clientY;
    
    if ( typeof( e.pageY ) != "undefined" )
    {
        clientY = e.pageY - FMCGetScrollTop( winNode );
    }
    else if ( typeof( e.clientY ) != "undefined" )
    {
        clientY = e.clientY;
    }
    
    return clientY;
}

function FMCGetPageX( winNode, e )
{
    var pageX;
    
    if ( typeof( e.pageX ) != "undefined" )
    {
        pageX = e.pageX;
    }
    else if ( typeof( e.clientX ) != "undefined" )
    {
        pageX = e.clientX + FMCGetScrollLeft( winNode );
    }
    
    return pageX;
}

function FMCGetPageY( winNode, e )
{
    var pageY;
    
    if ( typeof( e.pageY ) != "undefined" )
    {
        pageY = e.pageY;
    }
    else if ( typeof( e.clientY ) != "undefined" )
    {
        pageY = e.clientY + FMCGetScrollTop( winNode );
    }
    
    return pageY;
}

function FMCGetMouseXRelativeTo( winNode, e, el )
{
	var mouseX	= FMCGetPageX( winNode, e, el );
	var elX		= FMCGetPosition( el )[1];
	var x		= mouseX - elX;

	return x;
}

function FMCGetMouseYRelativeTo( winNode, e, el )
{
	var mouseY	= FMCGetPageY( winNode, e, el );
	var elY		= FMCGetPosition( el )[0];
	var y		= mouseY - elY;

	return y;
}

function FMCGetPosition( node )
{
	var topPos	= 0;
	var leftPos	= 0;
	
	if ( node.offsetParent )
	{
		topPos = node.offsetTop;
		leftPos = node.offsetLeft;
		
		while ( node = node.offsetParent )
		{
			topPos += node.offsetTop;
			leftPos += node.offsetLeft;
		}
	}
	
	return [topPos, leftPos];
}

function FMCScrollToVisible( win, node )
{
	var offset			= 0;
    
    if ( typeof( window.innerWidth ) != "undefined" && !FMCIsSafari() )
    {
		offset = 19;
    }
    
    var scrollTop		= FMCGetScrollTop( win );
    var scrollBottom	= scrollTop + FMCGetClientHeight( win, false ) - offset;
    var scrollLeft		= FMCGetScrollLeft( win );
    var scrollRight		= scrollLeft + FMCGetClientWidth( win, false ) - offset;
    
    var nodePos			= FMCGetPosition( node );
    var nodeTop			= nodePos[0];
    var nodeLeft		= parseInt( node.style.textIndent ) + nodePos[1];
    var nodeHeight		= node.offsetHeight;
    var nodeWidth		= node.getElementsByTagName( "a" )[0].offsetWidth;
    
    if ( nodeTop < scrollTop )
    {
        FMCSetScrollTop( win, nodeTop );
    }
    else if ( nodeTop + nodeHeight > scrollBottom )
    {
        FMCSetScrollTop( win, Math.min( nodeTop, nodeTop + nodeHeight - FMCGetClientHeight( win, false ) + offset ) );
    }
    
    if ( nodeLeft < scrollLeft )
    {
        FMCSetScrollLeft( win, nodeLeft );
    }
    else if ( nodeLeft + nodeWidth > scrollRight )
    {
		FMCSetScrollLeft( win, Math.min( nodeLeft, nodeLeft + nodeWidth - FMCGetClientWidth( win, false ) + offset ) );
    }
}

function FMCGetComputedStyle( node, style )
{
    var value   = null;
    
    if ( node.currentStyle )
    {
        value = node.currentStyle[style];
    }
    else if ( document.defaultView && document.defaultView.getComputedStyle )
    {
		var computedStyle	= document.defaultView.getComputedStyle( node, null );
		
		if ( computedStyle )
		{
			value = computedStyle[style];
		}
    }
    
    return value;
}

function FMCConvertToPx( doc, str, dimension, defaultValue )
{
    if ( !str || str.charAt( 0 ) == "-" )
    {
        return defaultValue;
    }
    
    if ( str.charAt( str.length - 1 ) == "\%" )
    {
        switch (dimension)
        {
            case "Width":
                return parseInt( str ) * screen.width / 100;
                
                break;
            case "Height":
                return parseInt( str ) * screen.height / 100;
                
                break;
        }
    }
    else
    {
		if ( parseInt( str ).toString() == str )
		{
			str += "px";
		}
    }
    
    try
    {
        var div	= doc.createElement( "div" );
    }
    catch ( err )
    {
        return defaultValue;
    }
    
    doc.body.appendChild( div );
    
    var value	= defaultValue;
    
    try
    {
        div.style.width = str;
        
        if ( div.currentStyle )
		{
			value = div.offsetWidth;
		}
		else if ( document.defaultView && document.defaultView.getComputedStyle )
		{
			value = parseInt( FMCGetComputedStyle( div, "width" ) );
		}
    }
    catch ( err )
    {
    }
    
    doc.body.removeChild( div );
    
    return value;
}

function FMCGetOpacity( el )
{
	var opacity	= 0;
	
	if ( el.filters )
	{
		opacity = parseInt( el.style.filter.substring( 17, el.style.filter.length - 2 ) );
	}
	else if ( el.style.MozOpacity != null )
	{
		opacity = parseFloat( el.style.MozOpacity ) * 100;
	}
	
	return opacity;
}

function FMCSetOpacity( el, opacityPercent )
{
	if ( el.filters )
	{
		el.style.filter = "alpha( opacity = " + opacityPercent + " )";
	}
	else if ( el.style.MozOpacity != null )
	{
		el.style.MozOpacity = opacityPercent / 100;
	}
}

function FMCToggleDisplay( el )
{
	if ( el.style.display == "none" )
	{
		el.style.display = "";
	}
	else
	{
		el.style.display = "none";
	}
}

function FMCIsChildNode( childNode, parentNode )
{
	var	doc	= parentNode.ownerDocument;
	
	if ( childNode == null )
	{
		return null;
	}
	
	for ( var currNode = childNode; ; currNode = currNode.parentNode )
	{
		if ( currNode == parentNode )
		{
			return true;
		}
		
		if ( currNode == doc.body )
		{
			return false;
		}
	}
}

function FMCStripCssUrl( url )
{
	if ( !url )
	{
		return null;
	}
	
	var regex	= /url\(\s*(['\"]?)([^'\"\s]*)\1\s*\)/;
	var match	= regex.exec( url );
	
	if ( match )
	{
		return match[2];
	}
	
	return null;
}

function FMCCreateCssUrl( path )
{
	return "url(\"" + path + "\")";
}

function FMCGetPropertyValue( propertyNode, defaultValue )
{
	var propValue	= defaultValue;
	var valueNode	= propertyNode.firstChild;
	
	if ( valueNode )
	{
		propValue = valueNode.nodeValue;
	}
	
	return propValue;
}

function FMCParseInt( str, defaultValue )
{
	var num	= parseInt( str );

	if ( num.toString() == "NaN" )
	{
		num = defaultValue;
	}
	
	return num;
}

function FMCConvertBorderToPx( doc, value )
{
	var newValue	= "";
	var valueParts	= value.split( " " );

	for ( var i = 0; i < valueParts.length; i++ )
	{
		var currPart	= valueParts[i];
		
		if ( i == 1 )
		{
			currPart = FMCConvertToPx( doc, currPart, null, currPart );
			
			if ( parseInt( currPart ).toString() == currPart )
			{
				currPart += "px";
			}
		}

		newValue += (((i > 0) ? " " : "") + currPart);
	}
	
	return newValue;
}

function FMCUnhide( win, node )
{
    for ( var currNode = node.parentNode; currNode.nodeName != "BODY"; currNode = currNode.parentNode )
    {
        if ( currNode.style.display == "none" )
        {
            var classRoot   = FMCContainsClassRoot( currNode.className, "MCExpandingBody", "MCDropDownBody", "MCTextPopupBody" );
            
            if ( classRoot == "MCExpandingBody" )
            {
                win.FMCExpand( currNode.parentNode.getElementsByTagName("a")[0] );
            }
            else if ( classRoot == "MCDropDownBody" )
            {
                var dropDownBodyID  = currNode.id.substring( "MCDropDownBody".length + 1, currNode.id.length );
                var aNodes          = currNode.parentNode.getElementsByTagName( "a" );
                
                for ( var i = 0; i < aNodes.length; i++ )
                {
                    var aNode   = aNodes[i];
                    
                    if ( aNode.id.substring( "MCDropDownHotSpot".length + 1, aNode.id.length ) == dropDownBodyID )
                    {
                        win.FMCDropDown( aNode );
                    }
                }
            }
            else if ( FMCGetMCAttribute( currNode, "MadCap:targetName" ) )
            {
                var targetName      = FMCGetMCAttribute( currNode, "MadCap:targetName" );
                var togglerNodes    = FMCGetElementsByClassRoot( win.document.body, "MCToggler" );
                
                for ( var i = 0; i < togglerNodes.length; i++ )
                {
                    var targets = FMCGetMCAttribute( togglerNodes[i], "MadCap:targets" ).split( ";" );
                    var found   = false;
                    
                    for ( var j = 0; j < targets.length; j++ )
                    {
                        if ( targets[j] == targetName )
                        {
                            found = true;
                            
                            break;
                        }
                    }
                    
                    if ( !found )
                    {
                        continue;
                    }
                    
                    win.FMCToggler( togglerNodes[i] );
                    
                    break;
                }
            }
            else if ( classRoot == "MCTextPopupBody" )
            {
                continue;
            }
            else
            {
                currNode.style.display = "";
            }
        }
    }
}

function StartLoading( win, parentElement, loadingLabel, loadingAltText, fadeElement )
{
	if ( !win.MCLoadingCount )
	{
		win.MCLoadingCount = 0;
	}
	
	win.MCLoadingCount++;
	
	if ( win.MCLoadingCount > 1 )
	{
		return;
	}
	
	//
	
	if ( fadeElement )
	{
		// IE bug: This causes the tab outline not to show and also causes the TOC entry fonts to look bold.
		//	if ( fadeElement.filters )
		//	{
		//		fadeElement.style.filter = "alpha( opacity = 10 )";
		//	}
		/*else*/ if ( fadeElement.style.MozOpacity != null )
		{
			fadeElement.style.MozOpacity = "0.1";
		}
	}

	var span		= win.document.createElement( "span" );
	var img			= win.document.createElement( "img" );
	var midPointX	= FMCGetScrollLeft( win ) + FMCGetClientWidth( win, false ) / 2;
	var spacing		= 3;

	parentElement.appendChild( span );

	span.id = "LoadingText";
	span.appendChild( win.document.createTextNode( loadingLabel ) );
	span.style.fontFamily = "Tahoma, Sans-Serif";
	span.style.fontSize = "9px";
	span.style.fontWeight = "bold";
	span.style.position = "absolute";
	span.style.left = (midPointX - (span.offsetWidth / 2)) + "px";

	var rootFrame	= FMCGetRootFrame();
	
	img.id = "LoadingImage";
	img.src = rootFrame.gRootFolder + MCGlobals.SkinTemplateFolder + "Images/Loading.gif";
	img.alt = loadingAltText;
	img.style.width = "70px";
	img.style.height = "13px";
	img.style.position = "absolute";
	img.style.left = (midPointX - (70/2)) + "px";

	var totalHeight	= span.offsetHeight + spacing + parseInt( img.style.height );
	var spanTop		= (FMCGetScrollTop( win ) + (FMCGetClientHeight( win, false ) - totalHeight)) / 2;

	span.style.top = spanTop + "px";
	img.style.top = spanTop + span.offsetHeight + spacing + "px";

	parentElement.appendChild( img );
}

function EndLoading( win, fadeElement )
{
	win.MCLoadingCount--;
	
	if ( win.MCLoadingCount > 0 )
	{
		return;
	}
	
	//
	
	var span	= win.document.getElementById( "LoadingText" );
	var img		= win.document.getElementById( "LoadingImage" );

	span.parentNode.removeChild( span );
	img.parentNode.removeChild( img );

	if ( fadeElement )
	{
		// IE bug: This causes the tab outline not to show and also causes the TOC entry fonts to look bold.
		//	if ( fadeElement.filters )
		//	{
		//		fadeElement.style.filter = "alpha( opacity = 100 )";
		//	}
		/*else*/ if ( fadeElement.style.MozOpacity != null )
		{
			fadeElement.style.MozOpacity = "1.0";
		}
	}
}

var gCallbacks		= new Array();
var gCallbackArgs	= new Array();

var MCEventType	= new Object();

MCEventType.OnLoad	= 0;
MCEventType.OnInit	= 1;
MCEventType.OnReady	= 2;

function FMCRegisterCallback( frameName, eventType, CallbackFunc, callbackArgs )
{
	var numCallbacks	= gCallbacks.length;
	var funcName		= "FMCCheck" + frameName;
	
	switch ( eventType )
	{
		case MCEventType.OnLoad:
			funcName = funcName + "Loaded";
			
			break;
		
		case MCEventType.OnInit:
			funcName = funcName + "Initialized";
			
			break;
			
		case MCEventType.OnReady:
			funcName = funcName + "Ready";
			
			break;
	}

	gCallbacks[numCallbacks] = CallbackFunc;
	gCallbackArgs[numCallbacks] = callbackArgs;
	
	setTimeout( funcName + "( " + numCallbacks + " );", 1 );
}

function FMCCheckMCGlobalsInitialized( index )
{
	if ( MCGlobals.Initialized )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckMCGlobalsInitialized( " + index + " );", 1 );
	}
}

function FMCCheckRootReady( index )
{
	if ( MCGlobals.RootFrame.gReady )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckRootReady( " + index + " );", 1 );
	}
}

function FMCCheckRootLoaded( index )
{
	if ( MCGlobals.RootFrame.gLoaded )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckRootLoaded( " + index + " );", 1 );
	}
}

function FMCCheckTOCInitialized( index )
{
	if ( MCGlobals.NavigationFrame.frames["toc"].gInit )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckTOCInitialized( " + index + " );", 1 );
	}
}

function FMCCheckSearchInitialized( index )
{
	if ( MCGlobals.NavigationFrame.frames["search"].gInit )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckSearchInitialized( " + index + " );", 1 );
	}
}

function FMCCheckTopicCommentsLoaded( index )
{
	if ( MCGlobals.TopicCommentsFrame.gLoaded )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckTopicCommentsLoaded( " + index + " );", 1 );
	}
}

function FMCCheckTopicCommentsInitialized( index )
{
	if ( MCGlobals.TopicCommentsFrame.gInit )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckTopicCommentsInitialized( " + index + " );", 1 );
	}
}

function FMCCheckBodyCommentsLoaded( index )
{
	if ( MCGlobals.BodyCommentsFrame.gLoaded )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckBodyCommentsLoaded( " + index + " );", 1 );
	}
}

function FMCCheckBodyCommentsInitialized( index )
{
	if ( MCGlobals.BodyCommentsFrame.gInit )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckBodyCommentsInitialized( " + index + " );", 1 );
	}
}

function FMCCheckToolbarInitialized( index )
{
	if ( MCGlobals.ToolbarFrame.gInit )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckToolbarInitialized( " + index + " );", 1 );
	}
}

function FMCCheckNavigationReady( index )
{
	if ( MCGlobals.NavigationFrame.gReady )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckNavigationReady( " + index + " );", 1 );
	}
}

function FMCCheckNavigationLoaded( index )
{
	if ( MCGlobals.NavigationFrame.gLoaded )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckNavigationLoaded( " + index + " );", 1 );
	}
}

function FMCCheckBodyReady( index )
{
	if ( typeof( MCGlobals.BodyFrame.gReady ) == "undefined" || MCGlobals.BodyFrame.gReady )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckBodyReady( " + index + " );", 1 );
	}
}

function FMCCheckBodyLoaded( index )
{
	if ( MCGlobals.BodyFrame.gLoaded )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckBodyLoaded( " + index + " );", 1 );
	}
}

function FMCCheckPersistenceInitialized( index )
{
	if ( MCGlobals.PersistenceFrame.gInit )
	{
		gCallbacks[index]( gCallbackArgs[index] );
	}
	else
	{
		setTimeout( "FMCCheckPersistenceInitialized( " + index + " );", 1 );
	}
}

function FMCSortStringArray( stringArray )
{
	stringArray.sort( FMCCompareStrings );
}

function FMCCompareStrings( a, b )
{
	var ret;

	if ( a.toLowerCase() < b.toLowerCase() )
	{
		ret = -1;
	}
	else if ( a.toLowerCase() == b.toLowerCase() )
	{
		ret = 0;
	}
	else if ( a.toLowerCase() > b.toLowerCase() )
	{
		ret = 1;
	}

	return ret;
}

function FMCSetCookie( name, value, days )
{
	if ( window != MCGlobals.NavigationFrame )
	{
		MCGlobals.NavigationFrame.FMCSetCookie( name, value, days );
		
		return;
	}
	
	value = encodeURI( value );
	
	if ( days )
	{
		var date	= new Date();
	    
		date.setTime( date.getTime() + (1000 * 60 * 60 * 24 * days) );
	    
		var expires	= "; expires=" + date.toGMTString();
	}
	else
	{
		var expires	= "";
	}

	var rootFrame	= FMCGetRootFrame();
	var navFrame	= rootFrame.frames["navigation"];
	var path		= FMCGetPathnameFolder( navFrame.document.location );

	//navFrame.document.cookie = name + "=" + value + expires + ";" + " path=" + path + ";";
	navFrame.document.cookie = name + "=" + value + expires + ";";
}

function FMCReadCookie( name )
{
	var value		= null;
	var nameEq		= name + "=";
	var rootFrame	= FMCGetRootFrame();
	var navFrame	= rootFrame.frames["navigation"];
	var cookies		= navFrame.document.cookie.split( ";" );

	for ( var i = 0; i < cookies.length; i++ )
	{
		var cookie	= cookies[i];
	    
		cookie = FMCTrim( cookie );
	    
		if ( cookie.indexOf( nameEq ) == 0 )
		{
			value = cookie.substring( nameEq.length, cookie.length );
			value = decodeURI( value );
			
			break;
		}
	}

	return value;
}

function FMCRemoveCookie( name )
{
	FMCSetCookie( name, "", -1 );
}

function FMCLoadUserData( name )
{
	var persistFrame	= MCGlobals.PersistenceFrame;
	var persistDiv		= persistFrame.document.getElementById( "Persist" );
	
	persistDiv.load( "MCXMLStore" );
	
	var value	= persistDiv.getAttribute( name );
	
	return value;
}

function FMCSaveUserData( name, value )
{
	var persistFrame	= MCGlobals.PersistenceFrame;
	var persistDiv		= persistFrame.document.getElementById( "Persist" );
	
	persistDiv.setAttribute( name, value );
	persistDiv.save( "MCXMLStore" );
}

function FMCRemoveUserData( name )
{
	var persistFrame	= MCGlobals.PersistenceFrame;
	var persistDiv		= persistFrame.document.getElementById( "Persist" );
	
	persistDiv.removeAttribute( name );
	persistDiv.save( "MCXMLStore" );
}

function FMCInsertOpacitySheet( winNode, color )
{
	var div		= winNode.document.createElement( "div" );
	var style	= div.style;
	
	div.id = "MCOpacitySheet";
	style.position = "absolute";
	style.top = FMCGetScrollTop( winNode ) + "px";
	style.left = FMCGetScrollLeft( winNode ) + "px";
	style.width = FMCGetClientWidth( winNode, false ) + "px";
	style.height = FMCGetClientHeight( winNode, false ) + "px";
	style.backgroundColor = color;
	style.zIndex = "100";
	
	winNode.document.body.appendChild( div );
	
	FMCSetOpacity( div, 75 );
}

function FMCRemoveOpacitySheet( winNode )
{
	var div	= winNode.document.getElementById( "MCOpacitySheet" );
	
	if ( !div )
	{
		return;
	}
	
	div.parentNode.removeChild( div );
}

function FMCSetupButtonFromStylesheet( tr, styleName, styleClassName, defaultOutPath, defaultOverPath, defaultSelectedPath, defaultWidth, defaultHeight, defaultTooltip, defaultLabel, OnClickHandler )
{
	var td					= document.createElement( "td" );
	var outImagePath		= CMCFlareStylesheet.LookupValue( styleName, styleClassName, "Icon", null );
	var overImagePath		= CMCFlareStylesheet.LookupValue( styleName, styleClassName, "HoverIcon", null );
	var selectedImagePath	= CMCFlareStylesheet.LookupValue( styleName, styleClassName, "PressedIcon", null );
	
	if ( outImagePath == null )
	{
		outImagePath = defaultOutPath;
	}
	else
	{
		outImagePath = FMCStripCssUrl( outImagePath );
		outImagePath = MCGlobals.RootFolder + FMCGetSkinFolder() + outImagePath;
	}
	
	if ( overImagePath == null )
	{
		overImagePath = defaultOverPath;
	}
	else
	{
		overImagePath = FMCStripCssUrl( overImagePath );
		overImagePath = MCGlobals.RootFolder + FMCGetSkinFolder() + overImagePath;
	}
	
	if ( selectedImagePath == null )
	{
		selectedImagePath = defaultSelectedPath;
	}
	else
	{
		selectedImagePath = FMCStripCssUrl( selectedImagePath );
		selectedImagePath = MCGlobals.RootFolder + FMCGetSkinFolder() + selectedImagePath;
	}

	tr.appendChild( td );
	
	var title	= CMCFlareStylesheet.LookupValue( styleName, styleClassName, "Tooltip", defaultTooltip );
	var label	= CMCFlareStylesheet.LookupValue( styleName, styleClassName, "Label", defaultLabel );
	var width	= CMCFlareStylesheet.GetResourceProperty( outImagePath, "Width", defaultWidth );
	var height	= CMCFlareStylesheet.GetResourceProperty( outImagePath, "Height", defaultHeight );
	
	MakeButton( td, title, outImagePath, overImagePath, selectedImagePath, width, height, label );
	td.firstChild.onclick = OnClickHandler;
}

//
//    End helper functions
//

//
//    Class CMCXmlParser
//

function CMCXmlParser( args, LoadFunc )
{
	// Private member variables and functions
	
	var mSelf		= this;
    this.mXmlDoc	= null;
    this.mXmlHttp	= null;
    this.mArgs		= args;
    this.mLoadFunc	= LoadFunc;
    
    this.OnreadystatechangeLocal	= function()
	{
		if ( mSelf.mXmlDoc.readyState == 4 )
		{
			mSelf.mLoadFunc( mSelf.mXmlDoc, mSelf.mArgs );
		}
	};
	
	this.OnreadystatechangeRemote	= function()
	{
		if ( mSelf.mXmlHttp.readyState == 4 )
		{
			mSelf.mLoadFunc( mSelf.mXmlHttp.responseXML, mSelf.mArgs );
		}
	};
}

CMCXmlParser.prototype.LoadLocal	= function( xmlFile, async )
{
	if ( window.ActiveXObject )
    {
        this.mXmlDoc = new ActiveXObject( "Microsoft.XMLDOM" );
        this.mXmlDoc.async = async;
        
        if ( this.mLoadFunc )
        {
			this.mXmlDoc.onreadystatechange = this.OnreadystatechangeLocal;
        }
        
        try
        {
            if ( !this.mXmlDoc.load( xmlFile ) )
            {
                this.mXmlDoc = null;
            }
        }
        catch ( err )
        {
			this.mXmlDoc = null;
        }
    }
    else if ( window.XMLHttpRequest )
    {
        this.LoadRemote( xmlFile, async ); // window.XMLHttpRequest also works on local files
    }

    return this.mXmlDoc;
};

CMCXmlParser.prototype.LoadRemote	= function( xmlFile, async )
{
	if ( window.ActiveXObject )
    {
        this.mXmlHttp = new ActiveXObject( "Msxml2.XMLHTTP" );
    }
    else if ( window.XMLHttpRequest )
    {
        xmlFile = xmlFile.replace( /;/g, "%3B" );   // For Safari
        this.mXmlHttp = new XMLHttpRequest();
    }
    
    if ( this.mLoadFunc )
    {
		this.mXmlHttp.onreadystatechange = this.OnreadystatechangeRemote;
    }
    
    this.mXmlHttp.open( "GET", xmlFile, async );
    
    try
    {
        this.mXmlHttp.send( null );
    }
    catch ( err )
    {
		this.mXmlHttp.abort();
    }
    
    if ( !async && (this.mXmlHttp.status == 0 || this.mXmlHttp.status == 200) )
    {
		this.mXmlDoc = this.mXmlHttp.responseXML;
    }
    
    return this.mXmlDoc;
};

// Public member functions

CMCXmlParser.prototype.Load	= function( xmlFile, async )
{
	var xmlDoc			= null;
	var protocolType	= document.location.protocol;
	
	if ( protocolType == "file:" || protocolType == "mk:" )
	{
		xmlDoc = this.LoadLocal( xmlFile, async );
	}
	else if ( protocolType == "http:" || protocolType == "https:" )
	{
		xmlDoc = this.LoadRemote( xmlFile, async );
	}
	
	return xmlDoc;
};

// Static member functions

CMCXmlParser.GetXmlDoc	= function( xmlFile, async, LoadFunc, args )
{
	var xmlParser	= new CMCXmlParser( args, LoadFunc );
    var xmlDoc		= xmlParser.Load( xmlFile, async );
    
    return xmlDoc;
}

CMCXmlParser.LoadXmlString	= function( xmlString )
{
	var xmlDoc	= null;
	
	if ( window.ActiveXObject )
	{
		xmlDoc = new ActiveXObject( "Microsoft.XMLDOM" );
		xmlDoc.async = false;
		xmlDoc.loadXML( xmlString );
	}
	else if ( DOMParser )
	{
		var parser	= new DOMParser();
		
		xmlDoc = parser.parseFromString( xmlString, "text/xml" );
	}
    
    return xmlDoc;
}

CMCXmlParser.CallWebService	= function( webServiceUrl, async, onCompleteFunc, onCompleteArgs )
{
	var xmlParser	= new CMCXmlParser( onCompleteArgs, onCompleteFunc );
	var xmlDoc		= xmlParser.LoadRemote( webServiceUrl, async );
    
    return xmlDoc;
}

//
//    End class CMCXmlParser
//

//
//    Class CMCFlareStylesheet
//

var CMCFlareStylesheet	= new function()
{
	// Private member variables

	var mInitialized			= false;
	var mXmlDoc					= null;
	var mInitializedResources	= false;
	var mResourceMap			= null;
	
	// Private methods
	
	function Init()
	{
		mXmlDoc = CMCXmlParser.GetXmlDoc( MCGlobals.RootFolder + FMCGetSkinFolder() + "Stylesheet.xml", false, null, null );
		
		mInitialized = true;
	}
	
	function InitializeResources()
    {
		mInitializedResources = true;
		mResourceMap = new CMCDictionary();
		
		var styleDoc		= CMCXmlParser.GetXmlDoc( MCGlobals.RootFolder + FMCGetSkinFolder() + "Stylesheet.xml", false, null, null );
		var resourcesInfos	= styleDoc.getElementsByTagName( "ResourcesInfo" );

		if ( resourcesInfos.length > 0 )
		{
			var resources	= resourcesInfos[0].getElementsByTagName( "Resource" );

			for ( var i = 0; i < resources.length; i++ )
			{
				var resource	= resources[i];
				var properties	= new CMCDictionary();
				var name		= resource.getAttribute( "Name" );
				
				if ( !name ) { continue; }

				for ( var j = 0; j < resource.attributes.length; j++ )
				{
					var attribute	= resource.attributes[j];
					
					properties.Add( attribute.nodeName.toLowerCase(), attribute.nodeValue.toLowerCase() );
				}

				mResourceMap.Add( name, properties );
			}
		}
    }
	
	// Public methods
	
	this.LookupValue	= function( styleName, styleClassName, propertyName, defaultValue )
	{
		if ( !mInitialized )
		{
			Init();
			
			if ( mXmlDoc == null )
			{
				return defaultValue;
			}
		}
		
		var value				= defaultValue;
		var styleNodes			= mXmlDoc.getElementsByTagName( "Style" );
		var styleNodesLength	= styleNodes.length;
		var styleNode			= null;
		
		for ( var i = 0; i < styleNodesLength; i++ )
		{
			if ( styleNodes[i].getAttribute( "Name" ) == styleName )
			{
				styleNode = styleNodes[i];
				break;
			}
		}
		
		if ( styleNode == null )
		{
			return value;
		}
		
		var styleClassNodes			= styleNode.getElementsByTagName( "StyleClass" );
		var styleClassNodesLength	= styleClassNodes.length;
		var styleClassNode			= null;
		
		for ( var i = 0; i < styleClassNodesLength; i++ )
		{
			if ( styleClassNodes[i].getAttribute( "Name" ) == styleClassName )
			{
				styleClassNode = styleClassNodes[i];
				break;
			}
		}
		
		if ( styleClassNode == null )
		{
			return value;
		}
		
		var propertyNodes		= styleClassNode.getElementsByTagName( "Property" );
		var propertyNodesLength	= propertyNodes.length;
		var propertyNode		= null;
		
		for ( var i = 0; i < propertyNodesLength; i++ )
		{
			if ( propertyNodes[i].getAttribute( "Name" ) == propertyName )
			{
				propertyNode = propertyNodes[i];
				break;
			}
		}
		
		if ( propertyNode == null )
		{
			return value;
		}
		
		value = propertyNode.firstChild.nodeValue;
		value = FMCTrim( value );
		
		return value;
	};
	
	this.GetResourceProperty	= function( name, property, defaultValue )
	{
		if ( !mInitialized )
		{
			Init();
			
			if ( mXmlDoc == null )
			{
				return defaultValue;
			}
		}
		
		if ( !mInitializedResources )
		{
			InitializeResources();
		}
		
		var properties	= mResourceMap.GetItem( name );

		if ( !properties )
		{
			return defaultValue;
		}

		var propValue	= properties.GetItem( property.toLowerCase() );

		if ( !propValue )
		{
			return defaultValue;
		}

		return propValue;
	};
	
	this.SetImageFromStylesheet	= function( img, styleName, styleClassName, propertyName, defaultValue, defaultWidth, defaultHeight )
	{
		var value	= this.LookupValue( styleName, styleClassName, propertyName, null );
		var imgSrc	= null;
		
		if ( value == null )
		{
			value = defaultValue;
			imgSrc = value;
		}
		else
		{
			value = FMCStripCssUrl( value );
			value = decodeURIComponent( value );
			value = escape( value );
			imgSrc = MCGlobals.RootFolder + FMCGetSkinFolder() + value;
		}
		
		img.src = imgSrc;
		img.style.width = this.GetResourceProperty( value, "Width", defaultWidth ) + "px";
		img.style.height = this.GetResourceProperty( value, "Height", defaultHeight ) + "px";
	};
}

//
//    End class CMCFlareStylesheet
//

//
//    Class CMCDictionary
//

function CMCDictionary()
{
    // Public properties
    
    this.mMap	= new Array();
    this.mKeys	= new Array();
}

CMCDictionary.prototype.GetItem	= function( key )
{
	var item	= this.mMap["_" + key];

	if ( typeof( item ) == "undefined" )
	{
		item = null;
	}

    return item;
};

CMCDictionary.prototype.GetKeys	= function()
{
	return this.mKeys;
};

CMCDictionary.prototype.Remove	= function( key )
{
	delete( this.mMap["_" + key] );
	delete( this.mKeys[key] );
};

CMCDictionary.prototype.Add	= function( key, value )
{
    this.mMap["_" + key] = value;
    this.mKeys[key] = true;
};

CMCDictionary.prototype.AddUnique	= function( key, value )
{
	var savedValue	= this.mKeys[key];
	
	if ( typeof( savedValue ) == "undefined" || !savedValue )
	{
		this.Add( key, value );
	}
};

//
//    End class CMCDictionary
//

//
//    DOM traversal functions
//

function FMCGetElementsByClassRoot( node, classRoot )
{
    var nodes   = new Array();
    var args    = new Array();
    
    args[0] = nodes;
    args[1] = classRoot;
    
    FMCTraverseDOM( "post", node, FMCGetByClassRoot, args );
                         
    return nodes;
}

function FMCGetByClassRoot( node, args )
{
    var nodes       = args[0];
    var classRoot   = args[1];
    
    if ( node.nodeType == 1 && FMCContainsClassRoot( node.className, classRoot ) )
    {
        nodes[nodes.length] = node;
    }
}

function FMCGetElementsByAttribute( node, attribute, value )
{
    var nodes   = new Array();
    var args    = new Array();
    
    args[0] = nodes;
    args[1] = attribute;
    args[2] = value;
    
    FMCTraverseDOM( "post", node, FMCGetByAttribute, args );
                         
    return nodes;
}

function FMCGetByAttribute( node, args )
{
    var nodes       = args[0];
    var attribute   = args[1];
    var value       = args[2];
    
    try
    {
        if ( node.nodeType == 1 && (FMCGetMCAttribute( node, attribute ) == value || (value == "*" && FMCGetMCAttribute( node, attribute ))) )
        {
            nodes[nodes.length] = node;
        }
    }
    catch( err )
    {
        node.setAttribute( attribute, null );
    }
}

function FMCTraverseDOM( type, root, Func, args )
{
    if ( type == "pre" )
    {
        Func( root, args );
    }
    
    if ( root.childNodes.length != 0 )
    {
        for ( var i = 0; i < root.childNodes.length; i++ )
        {
            FMCTraverseDOM( type, root.childNodes[i], Func, args );
        }
    }
    
    if ( type == "post" )
    {
        Func( root, args );
    }
}

//
//    End DOM traversal functions
//

//
//    Button effects
//

var gButton		= null;
var gTabIndex	= 1;

function MakeButton( td, title, outImagePath, overImagePath, selectedImagePath, width, height, text )
{
	var div	= document.createElement( "div" );
	
	div.tabIndex = gTabIndex++;
	
    title ? div.title = title : false;
    div.setAttribute( "MadCap:outImage", outImagePath );
    div.setAttribute( "MadCap:overImage", overImagePath );
    div.setAttribute( "MadCap:selectedImage", selectedImagePath );
    div.setAttribute( "MadCap:width", width );
    div.setAttribute( "MadCap:height", height );
    
    FMCPreloadImage( outImagePath );
    FMCPreloadImage( overImagePath );
    FMCPreloadImage( selectedImagePath );
    
    div.appendChild( document.createTextNode( text ) );
    td.appendChild( div );
    
    InitButton( div );
}

function InitButton( button )
{
	var width	= parseInt( FMCGetMCAttribute( button, "MadCap:width" ) ) + "px";
	var height	= parseInt( FMCGetMCAttribute( button, "MadCap:height" ) ) + "px";
	var image	= FMCGetMCAttribute( button, "MadCap:outImage" );
	
	if ( image != null )
	{
		if ( !image.StartsWith( "url", false ) || !image.EndsWith( ")", false ) )
		{
			image = FMCCreateCssUrl( image );
		}

		button.style.backgroundImage = image;
	}
	
	button.style.cursor = "default";
	button.style.width = width;
	button.style.height = height;
	button.onmouseover = ButtonOnOver;
	button.onmouseout = ButtonOnOut;
	button.onmousedown = ButtonOnDown;

	button.parentNode.style.width = width;
	button.parentNode.style.height = height;
}

function ButtonOnOver()
{
	var image	= FMCGetMCAttribute( this, "MadCap:overImage" );
	
	if ( !image.StartsWith( "url", false ) || !image.EndsWith( ")", false ) )
	{
		image = FMCCreateCssUrl( image );
	}
	
	this.style.backgroundImage = image;
}

function ButtonOnOut()
{
	var image	= FMCGetMCAttribute( this, "MadCap:outImage" );
	
	if ( !image.StartsWith( "url", false ) || !image.EndsWith( ")", false ) )
	{
		image = FMCCreateCssUrl( image );
	}
	
	this.style.backgroundImage = image;
}

function ButtonOnDown()
{
	StartPress( this ); return false;
}

function StartPress( node )
{
    // Debug
    //window.status += "s";
    
    gButton = node;
    
    if ( document.body.setCapture )
    {
        document.body.setCapture();
        
        document.body.onmousemove = Press;
        document.body.onmouseup = EndPress;
    }
    else if ( document.addEventListener )
    {
        document.addEventListener( "mousemove", Press, true );
        document.addEventListener( "mouseup", EndPress, true );
    }
    
    gButton.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( gButton, "MadCap:selectedImage" ) );
    gButton.onmouseover = function() { this.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( this, "MadCap:selectedImage" ) ); };
}

function Press( e )
{
    // Debug
    //window.status += "p";
    
    if ( !e )
    {
        e = window.event;
        target = e.srcElement;
    }
    else if ( e.target )
    {
        target = e.target;
    }
    
    if ( target == gButton )
    {
        gButton.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( gButton, "MadCap:selectedImage" ) );
    }
    else
    {
        gButton.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( gButton, "MadCap:outImage" ) );
    }
}

function EndPress( e )
{
    // Debug
    //window.status += "e";
    
    var target  = null;
    
    if ( !e )
    {
        e = window.event;
        target = e.srcElement;
    }
    else if ( e.target )
    {
        target = e.target;
    }
    
    if ( target == gButton )
    {
        // Debug
        //window.status += "c";
        
        gButton.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( gButton, "MadCap:overImage" ) );
    }
    
    gButton.onmouseover = function() { this.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( this, "MadCap:overImage" ) ); };
    
    if ( document.body.releaseCapture )
    {
        document.body.releaseCapture();
        
        document.body.onmousemove = null;
        document.body.onmouseup = null;
    }
    else if ( document.removeEventListener )
    {
        document.removeEventListener( "mousemove", Press, true );
        document.removeEventListener( "mouseup", EndPress, true );
    }
    
    gButton = null;
}

//
//    End button effects
//

//
//    String helpers
//

String.prototype.IsNullOrEmpty = function()
{
	if ( this == null )
	{
		return true;
	}
	
	if ( this.length == 0 )
	{
		return true;
	}
	
	return false;
}

String.prototype.StartsWith = function( str, caseSensitive )
{
	if ( str == null )
	{
		return false;
	}
	
	if ( this.length < str.length )
	{
		return false;
	}
	
	var value1	= this;
	var value2	= str;
	
	if ( !caseSensitive )
	{
		value1 = value1.toLowerCase();
		value2 = value2.toLowerCase();
	}
	
	if ( value1.substring( 0, value2.length ) == value2 )
	{
		return true;
	}
	else
	{
		return false;
	}
}

String.prototype.EndsWith = function( str, caseSensitive )
{
	if ( str == null )
	{
		return false;
	}
	
	if ( this.length < str.length )
	{
		return false;
	}
	
	var value1	= this;
	var value2	= str;
	
	if ( !caseSensitive )
	{
		value1 = value1.toLowerCase();
		value2 = value2.toLowerCase();
	}
	
	if ( value1.substring( value1.length - value2.length ) == value2 )
	{
		return true;
	}
	else
	{
		return false;
	}
}

String.prototype.Contains = function( str, caseSensitive )
{
	var value1	= this;
	var value2	= str;
	
	if ( !caseSensitive )
	{
		value1 = value1.toLowerCase();
		value2 = value2.toLowerCase();
	}
	
	return value1.indexOf( value2 ) != -1;
}

String.prototype.Equals = function( str, caseSensitive )
{
	var value1	= this;
	var value2	= str;
	
	if ( !caseSensitive )
	{
		value1 = value1.toLowerCase();
		value2 = value2.toLowerCase();
	}
	
	return value1 == value2;
}

String.prototype.CountOf = function( str, caseSensitive )
{
	var count	= 0;
	var value1	= this;
	var value2	= str;
	
	if ( !caseSensitive )
	{
		value1 = value1.toLowerCase();
		value2 = value2.toLowerCase();
	}
	
	var lastIndex	= -1;
	
	while ( true )
	{
		lastIndex = this.indexOf( str, lastIndex + 1 );
		
		if ( lastIndex == -1 )
		{
			break;
		}
		
		count++;
	}
	
	return count;
}

//
//    End String helpers
//
