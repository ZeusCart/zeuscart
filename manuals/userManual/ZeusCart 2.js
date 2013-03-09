// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

//    Syntax:
//    function FMCOpenHelp( id, skinName )
//
//    id          - Identifier that was created in Flare. This can be either the identifier name or value. The topic and skin
//                  that is associated with the id will be used. If no skin is associated with the id, skinName will be used.
//                  Alternatively, id may contain a topic path. In this case, the specified topic will be loaded with the skin
//                  that is specified in skinName. Specify null to use the help system's default starting topic.
//    skinName    - This is a string indicating the name of the skin to use when opening the help system. Specify null to use
//                  the default skin or to use the skin that is associated with id. If a skin is associated with id AND a skin
//                  is specified in skinName, skinName will take precedence.
//    searchQuery - This is a string indicating the search query used when opening the help system. If a search query is specified,
//                  the help system will start with the search pane open and the search query executed. Specify null to open
//                  the help system without a search query.
//    firstPick   - This is a boolean indicating whether to automatically open the topic from the first search result that is
//                  returned by the search query (see searchQuery parameter). Use null if no search query was specified.
//
//    Examples:
//
//    In the following example, topic and skin associated with "FILE_NEW" will be used:
//    FMCOpenHelp( 'FILE_NEW', null, null, null );
//
//    In the following example, topic associated with "FILE_NEW" will be used. "BlueSkin" will override the skin associated with "FILE_NEW":
//    FMCOpenHelp( 'FILE_NEW', 'BlueSkin', null, null );
//
//    In the following example, topic and skin associated with identifier value 1 will be used:
//    FMCOpenHelp( 1, null, null, null );
//
//    In the following example, topic associated with identifier value 1 will be used. "BlueSkin" will override the skin associated with identifier value 1:
//    FMCOpenHelp( 1, 'BlueSkin', null, null );
//
//    In the following example, "Company/Employees.htm" will be used with the default skin:
//    FMCOpenHelp( 'Company/Employees.htm', null, null, null );
//
//    In the following example, both the default topic and skin will be used:
//    FMCOpenHelp( null, null, null, null );
//
//    In the following example, the default topic will be used with "BlueSkin":
//    FMCOpenHelp( null, 'BlueSkin', null, null );
//
//    In the following example, both the default topic and skin will be used. The help system will be started with the search pane
//    displaying the search results for the query 'quarterly report'. The topic from the first result will not be opened:
//    FMCOpenHelp( null, null, 'quarterly report', false );
//
//    In the following example, both the default topic and skin will be used. The help system will be started with the search pane
//    displaying the search results for the query 'quarterly report'. The topic from the first result will be opened:
//    FMCOpenHelp( null, null, 'quarterly report', true );

var gHelpSystemName = "ZeusCart 2.htm";

function FMCOpenHelp( id, skinName, searchQuery, firstPick )
{
	var cshFileName	= gHelpSystemName.substring( 0, gHelpSystemName.lastIndexOf( "." ) ) + ".js";
	var scriptNodes	= document.getElementsByTagName( "script" );
	var webHelpFile	= null;

	for ( var i = 0; i < scriptNodes.length; i++ )
	{
		var src	= scriptNodes[i].src;

		if ( src.substring( src.lastIndexOf( "/" ) + 1 ).toLowerCase() == cshFileName.toLowerCase() )
		{
			var cshScriptPath	= src.substring( 0, src.lastIndexOf( "/" ) + 1 );
			var pos				= gHelpSystemName.lastIndexOf( "." );
			var fileName		= gHelpSystemName.substring( 0, pos );
			var fileExt			= gHelpSystemName.substring( pos );

			webHelpFile = cshScriptPath + fileName + "_CSH" + fileExt;

			break;
		}
	}
	
	if ( webHelpFile == null )
	{
		throw "CSH failed: could not find MadCap CSH script in page.";
	}

	FMCOpenHelp2( webHelpFile, id, skinName, searchQuery, firstPick );
}

function FMCOpenHelp2( webHelpFile, id, skinName, searchQuery, firstPick )
{
	var webHelpPath = webHelpFile.substring( 0, webHelpFile.lastIndexOf( "/" ) + 1 );
	var xmlDoc      = CMCXmlParser.GetXmlDoc( webHelpPath + "Data/Alias.xml", false, null, null );
	var topic		= null;
	var skin		= null;

	if ( id )
	{
		if ( typeof( id ) == "string" && id.indexOf( "." ) != -1 )
		{
			topic = id;
		}
		else
		{
			if ( xmlDoc )
			{
				var maps    = xmlDoc.documentElement.getElementsByTagName( "Map" );

				for ( var i = 0; i < maps.length; i++ )
				{
					if ( (typeof( id ) == "string" && maps[i].getAttribute( "Name" ) == id) ||
						 (typeof( id ) == "number" && parseInt( maps[i].getAttribute( "ResolvedId" ) ) == id) )
					{
						topic = maps[i].getAttribute( "Link" );
						skin = maps[i].getAttribute( "Skin" );

						if ( skin )
						{
							skin = skin.substring( "Skin".length, skin.indexOf( "/" ) );
						}

						break;
					}
				}
			}
			else
			{
				alert( "Warning: A topic id was specified but the help system does not contain an alias file. The help system's default starting topic will be used." );
			}
		}
	}

	if ( skinName )
	{
		skin = skinName;
	}
	else if ( !skin )
	{
		if ( xmlDoc )
		{
			skin = xmlDoc.documentElement.getAttribute( "DefaultSkinName" );
		}
		else
		{
			alert( "Warning: A skin name was specified but the help system does not contain an alias file. The help system's default skin will be used." );
		}
	}

	// Browser setup options

	var browserOptions	= "";
	var size			= "";

	if ( skin )
	{
		xmlDoc = CMCXmlParser.GetXmlDoc( webHelpPath + "Data/Skin" + skin + "/Skin.xml", false, null, null );

		if ( xmlDoc )
		{
			var xmlHead		= xmlDoc.getElementsByTagName( "CatapultSkin" )[0];
			var useDefault	= FMCGetAttributeBool( xmlHead, "UseDefaultBrowserSetup", false );

			if ( !useDefault )
			{
				var toolbar		= "no";
				var menu		= "no";
				var locationBar	= "no";
				var statusBar	= "no";
				var resizable	= "no";
				var setup		= xmlHead.getAttribute( "BrowserSetup" );

				if ( setup )
				{
					toolbar     = (setup.indexOf( "Toolbar" ) > -1)     ? "yes" : "no";
					menu        = (setup.indexOf( "Menu" ) > -1)        ? "yes" : "no";
					locationBar = (setup.indexOf( "LocationBar" ) > -1) ? "yes" : "no";
					statusBar   = (setup.indexOf( "StatusBar" ) > -1)   ? "yes" : "no";
					resizable   = (setup.indexOf( "Resizable" ) > -1)   ? "yes" : "no";
				}

				browserOptions = "toolbar=" + toolbar + ", menubar=" + menu + ", location=" + locationBar + ", status=" + statusBar + ", resizable=" + resizable;
			}

			var windowSize	= FMCLoadSize( xmlDoc );

			if ( windowSize )
			{
				size = ", top=" + windowSize.topPx + ", left=" + windowSize.leftPx + ", width=" + windowSize.widthPx + ", height=" + windowSize.heightPx;
			}
		}
	}

	//
	
	if ( searchQuery )
	{
		webHelpFile += "?" + searchQuery;

		if ( firstPick )
		{
			webHelpFile += "|FirstPick";
		}
	}

	if ( topic )
	{
		webHelpFile += "#" + topic;
	}

	if ( skin )
	{
		if ( webHelpFile.indexOf( "#" ) != -1 )
		{
			webHelpFile += "|";
		}
		else
		{
			webHelpFile += "#";
		}

		webHelpFile += skin;
	}
	
	if ( webHelpFile.indexOf( "#" ) != -1 )
	{
		webHelpFile += "|";
	}
	else
	{
		webHelpFile += "#";
	}
	
	webHelpFile += "OpenType=Javascript";

	window.open( webHelpFile, "_MCWebHelpCSH", browserOptions + size );
}

function FMCLoadSize( xmlDoc )
{
	var xmlHead			= xmlDoc.documentElement;
	var useDefaultSize	= FMCGetAttributeBool( xmlHead, "UseBrowserDefaultSize", false );

	if ( useDefaultSize )
	{
		return null;
	}

	var topPx		= FMCConvertToPx( document, xmlHead.getAttribute( "Top" ), null, 0 );
	var leftPx		= FMCConvertToPx( document, xmlHead.getAttribute( "Left" ), null, 0 );
	var bottomPx	= FMCConvertToPx( document, xmlHead.getAttribute( "Bottom" ), null, 0 );
	var rightPx		= FMCConvertToPx( document, xmlHead.getAttribute( "Right" ), null, 0 );
	var widthPx		= FMCConvertToPx( document, xmlHead.getAttribute( "Width" ), "Width", 800 );
	var heightPx	= FMCConvertToPx( document, xmlHead.getAttribute( "Height" ), "Height", 600 );

	var anchors = xmlHead.getAttribute( "Anchors" );

	if ( anchors )
	{
		var aTop	= (anchors.indexOf( "Top" ) > -1)    ? true : false;
		var aLeft	= (anchors.indexOf( "Left" ) > -1)   ? true : false;
		var aBottom	= (anchors.indexOf( "Bottom" ) > -1) ? true : false;
		var aRight	= (anchors.indexOf( "Right" ) > -1)  ? true : false;
		var aWidth	= (anchors.indexOf( "Width" ) > -1)  ? true : false;
		var aHeight	= (anchors.indexOf( "Height" ) > -1) ? true : false;
	}

	if ( aLeft && aRight )
	{
		widthPx = screen.width - (leftPx + rightPx);
	}
	else if ( !aLeft && aRight )
	{
		leftPx = screen.width - (widthPx + rightPx);
	}
	else if ( aWidth )
	{
		leftPx = (screen.width / 2) - (widthPx / 2);
	}

	if ( aTop && aBottom )
	{
		heightPx = screen.height - (topPx + bottomPx);
	}
	else if ( !aTop && aBottom )
	{
		topPx = screen.height - (heightPx + bottomPx);
	}
	else if ( aHeight )
	{
		topPx = (screen.height / 2) - (heightPx / 2);
	}

	//

	var windowSize	= new Object();

	windowSize.topPx = topPx;
	windowSize.leftPx = leftPx;
	windowSize.widthPx = widthPx;
	windowSize.heightPx = heightPx;

	return windowSize;
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

	return value;
}

function FMCStringToBool( stringValue )
{
	var boolValue		= false;
	var stringValLower	= stringValue.toLowerCase();

	boolValue = stringValLower == "true" || stringValLower == "1" || stringValLower == "yes";

	return boolValue;
}

//
//    Class CMCXmlParser
//

function CMCXmlParser( args )
{
	// Private member variables and functions

	var mXmlDoc		= null;
	var mXmlHttp	= null;
	var mArgs		= args;

	function LoadLocal( xmlFile, async, LoadFunc )
	{
		if ( window.ActiveXObject )
		{
			mXmlDoc = new ActiveXObject( "Microsoft.XMLDOM" );
			mXmlDoc.async = async;
	        
			if ( LoadFunc )
			{
				mXmlDoc.onreadystatechange = function () { if ( mXmlDoc.readyState == 4 ) { LoadFunc( mXmlDoc, mArgs ); } };
			}
	        
			try
			{
				if ( !mXmlDoc.load( xmlFile ) )
				{
					mXmlDoc = null;
				}
			}
			catch ( err )
			{
			}
		}
		else if ( window.XMLHttpRequest )
		{
			LoadRemote( xmlFile, async, LoadFunc ); // window.XMLHttpRequest also works on local files
		}

		return mXmlDoc;
	}

	function LoadRemote( xmlFile, async, LoadFunc )
	{
		if ( window.ActiveXObject )
		{
			mXmlHttp = new ActiveXObject( "Msxml2.XMLHTTP" );
		}
		else if ( window.XMLHttpRequest )
		{
			xmlFile = xmlFile.replace( /;/g, "%3B" );   // For Safari
			mXmlHttp = new XMLHttpRequest();
		}
	    
		if ( LoadFunc )
		{
			mXmlHttp.onreadystatechange = function () { if ( mXmlHttp.readyState == 4 ) { LoadFunc( mXmlHttp.responseXML, mArgs ); } };
		}
	    
		mXmlHttp.open( "GET", xmlFile, async );
	    
		try
		{
			mXmlHttp.send( null );
		}
		catch ( err )
		{
			mXmlHttp.abort();
		}
	    
		mXmlDoc = mXmlHttp.responseXML;
	    
		return mXmlDoc;
	}

	// Public member functions

	this.Load		= function( xmlFile, async, LoadFunc )
	{
		var xmlDoc			= null;
		var protocolType	= document.location.protocol;
		
		if ( protocolType == "file:" )
		{
			xmlDoc = LoadLocal( xmlFile, async, LoadFunc );
		}
		else if ( protocolType == "http:" || protocolType == "https:" )
		{
			xmlDoc = LoadRemote( xmlFile, async, LoadFunc );
		}
		
		return xmlDoc;
	};
}

CMCXmlParser.GetXmlDoc	= function( xmlFile, async, LoadFunc, args )
{
	var xmlParser	= new CMCXmlParser( args, LoadFunc );
	var xmlDoc		= xmlParser.Load( xmlFile, async );

	return xmlDoc;
}

//
//    End class CMCXmlParser
//
