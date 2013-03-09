// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

var gInit				= false;
var gCurrSelection		= null;
var gStylesMap			= new CMCDictionary();
var gClassToANodeMap	= new CMCDictionary();
var gSyncTOC			= false;
var gSyncContinue		= false;
var gSyncTocPath		= null;

function SyncTOC( tocPath )
{
	if ( tocPath == null )
	{
		return;
	}
	
	//
	
	Init( OnInit );

	//

	function OnInit()
	{
		gSyncTocPath = tocPath;

		var href	= FMCGetHref( parent.parent.frames["body"].document.location );

		href = href.substring( 0, href.indexOf( "/Content/" ) + 1 );
		
		var master		= parent.parent.GetMasterHelpSystem();
		var subsystem	= master.GetHelpSystem( href );
		var fullTocPath	= new Object();

		fullTocPath.tocPath = null;
		subsystem.GetFullTocPath( fullTocPath );

		if ( fullTocPath.tocPath )
		{
			tocPath = tocPath ? fullTocPath.tocPath + "|" + tocPath : fullTocPath.tocPath;
		}

		//

		var tocNode	= document.getElementById( "CatapultToc" ).getElementsByTagName( "div" )[0];
		var steps	= (tocPath == "") ? new Array( 0 ) : tocPath.split( "|" );

		for ( var i = 0; tocNode && i < steps.length; i++ )
		{
			tocNode = FindBook( tocNode, steps[i] );
		}

		if ( tocNode == null )
		{
			return;
		}

		var aNode	= FMCGetChildNodeByTagName( tocNode, "A", 0 );

		if ( FMCGetMCAttribute( aNode, "MadCap:chunk" ) )
		{
			gSyncContinue = true;
			CreateToc( aNode, null );

			return;
		}

		var foundNode	= FindLink( tocNode, true );

		if ( !foundNode )
		{
			foundNode = FindLink( tocNode, false );
		}

		if ( foundNode )
		{
			SetSelection( FMCGetChildNodeByTagName( foundNode, "A", 0 ) );
			FMCScrollToVisible( window, foundNode );
		}
		
		//

		gSyncTocPath = null;
	}
}

function FindBook( tocNode, step )
{
	var foundNode	= null;
	var a			= FMCGetChildNodeByTagName( tocNode, "A", 0 );
	var div			= FMCGetChildNodeByTagName( tocNode, "DIV", 0 );

	if ( FMCGetMCAttribute( a, "MadCap:chunk" ) )
	{
		gSyncContinue = true;
		CreateToc( a, null );

		return null;
	}
	else if ( div && div.style.display == "none" )
	{
		TocExpand( a );
	}

	for ( var i = 0; i < tocNode.childNodes.length; i++ )
	{
		if ( tocNode.childNodes[i].nodeName == "DIV" &&
			 tocNode.childNodes[i].firstChild.lastChild.nodeValue == step )
		{
			foundNode = tocNode.childNodes[i];
			
			break;
		}
	}
	
	return foundNode;
}

function FindLink( node, exactMatch )
{
	var foundNode	= null;
	var bodyHref	= GetBodyHref( exactMatch ).toLowerCase();
    var aNode		= FMCGetChildNodeByTagName( node, "A", 0 );
    var bookHref	= aNode.href;

	bookHref = bookHref.replace( /%20/g, " " );
	bookHref = bookHref.substring( bookHref.indexOf( "/Content/" ) + "/Content/".length );
	bookHref = bookHref.toLowerCase();
    
	if ( bookHref == bodyHref )
	{
		foundNode = node;
	}
	else
	{
		if ( FMCGetChildNodeByTagName( node, "DIV", 0 ).style.display == "none" )
		{
			TocExpand( aNode );
		}
		
		for ( var k = 1; k < node.childNodes.length; k++ )
		{
			var currNode		= node.childNodes[k];
			
			if ( currNode.nodeType != 1 || currNode.nodeName != "DIV" ) { continue; }
			
			var currTopicHref	= currNode.firstChild.href;
			
			currTopicHref = currTopicHref.replace( /%20/g, " " );
			currTopicHref = currTopicHref.substring( currTopicHref.indexOf( "/Content/" ) + "/Content/".length );
			currTopicHref = currTopicHref.toLowerCase();
			
			if ( !exactMatch )
			{
				var hashPos	= currTopicHref.indexOf( "#" );

				if ( hashPos != -1 )
				{
					currTopicHref = currTopicHref.substring( 0, hashPos );
				}
				
				var searchPos	= currTopicHref.indexOf( "?" );
				
				if ( searchPos != -1 )
				{
					currTopicHref = currTopicHref.substring( 0, searchPos );
				}
			}
            
			if ( currTopicHref == bodyHref )
			{
				foundNode = currNode;
				
				break;
			}
		}
	}
	
	return foundNode;
}

function GetBodyHref( fullHref )
{
	var bodyFrame		= parent.parent.frames["body"];
	var bodyLocation	= bodyFrame.document.location;
	var bodyHref		= bodyLocation.protocol + "//" + bodyLocation.host + bodyLocation.pathname + (fullHref ? bodyLocation.hash : "");
	
	bodyHref = bodyHref.replace( /\\/g, "/" );
	bodyHref = bodyHref.replace( /%20/g, " " );
    bodyHref = bodyHref.substring( bodyHref.indexOf( "/Content/" ) + "/Content/".length );
	
	return bodyHref;
}

function SetSelection( aNode )
{
    if ( gCurrSelection )
    {
        var oldBGColor  = FMCGetMCAttribute( gCurrSelection, "MadCap:oldBGColor" );
        
        if ( !oldBGColor )
        {
            oldBGColor = "Transparent";
        }
        
        gCurrSelection.style.backgroundColor = oldBGColor;
    }
    
    gCurrSelection = aNode;
    gCurrSelection.setAttribute( "MadCap:oldBGColor", FMCGetComputedStyle( gCurrSelection, "backgroundColor" ) );
    gCurrSelection.style.backgroundColor = "#dddddd";
}

function BookOnClick( e )
{
	var node	= this;

    SetSelection( node );
    
    TocExpand( node );
    
    if ( node.href.indexOf( "javascript:" ) == -1 )
    {
        var frameName   = FMCGetMCAttribute( node, "MadCap:frameName" );
        
        if ( !frameName )
        {
            frameName = "body";
        }
        
        window.open( node.href, frameName );
    }
    
    return false;
}

function ChunkOnClick( e )
{
    var node	= this;

	SetSelection( node );
    
    CreateToc( node, null );
    
    if ( node.href.indexOf( "javascript:" ) == -1 )
    {
        parent.parent.frames["body"].document.location.href = node.href;
    }
    
    return false;
}

function TopicOnClick( e )
{
    var node	= this;

    SetSelection( node );
    
    if ( node.href.indexOf( "javascript:" ) == -1 )
    {
        var frameName   = FMCGetMCAttribute( node, "MadCap:frameName" );
        
        if ( !frameName )
        {
            frameName = "body";
        }
        
        window.open( node.href, frameName );
    }
    
    return false;
}

function GetOwnerHelpSystem( node )
{
    var currNode        = node;
    var ownerHelpSystem = null;
    
    while ( true )
    {
        if ( currNode.parentNode.id == "CatapultToc" )
        {
            ownerHelpSystem = parent.parent.GetMasterHelpSystem();
            
            break;
        }
        
        var a   = FMCGetChildNodeByTagName( currNode, "A", 0 );
        
        ownerHelpSystem = a["MadCap:helpSystem"];
        
        if ( !ownerHelpSystem && currNode.parentNode.id != "CatapultToc" )
        {
            currNode = currNode.parentNode;
        }
        else
        {
            break;
        }
    }
    
    return ownerHelpSystem;
}

function BuildToc( xmlNode, htmlNode, indent, fullPath )
{
    for ( var i = 0; i < xmlNode.childNodes.length; i++ )
    {
        var entry = xmlNode.childNodes[i];
        
        if ( entry.nodeName != "TocEntry" )
        {
            continue;
        }
        
        var div             	= document.createElement( "div" );
        var a               	= null;
        var img             	= document.createElement( "img" );
        var title           	= entry.getAttribute( "Title" );
        var link            	= entry.getAttribute( "Link" );
        var frameName       	= entry.getAttribute( "FrameName" );
        var chunk           	= entry.getAttribute( "Chunk" );
        var mergeHint       	= entry.getAttribute( "MergeHint" );
        var isBook          	= (entry.childNodes.length > 0 || chunk || mergeHint);
        var bookIcon        	= null;
        var bookOpenIcon    	= null;
        var topicIcon       	= null;
        var markAsNew       	= null;
        var topicIconAlt		= "Topic";
        var bookIconAlt			= "Book";
        var markAsNewIconAlt	= "New";
        
        // Create "div" tag
        
        div.style.textIndent = indent + "px";
        div.style.position = "relative";
        div.style.display = "none";
        
        // Apply style
        
        var entryClass		= entry.getAttribute( "Class" );
        var className		= "TocEntry_" + ((entryClass == null) ? "TocEntry" : entryClass);
        var aCached			= gClassToANodeMap.GetItem( className );
        var nameToValueMap	= gStylesMap.GetItem( className );
        
        if ( !aCached )
        {
            aCached = document.createElement( "a" );
            
            if ( nameToValueMap )
            {
				for ( var key in nameToValueMap.GetKeys() )
				{
					var value	= nameToValueMap.GetItem( key );
					var style	= ConvertToCSS( key );
	                
					aCached.style[style] = value;
				}
            }
            
            gClassToANodeMap.Add( className, aCached );
        }
        
        // Create "a" tag
        
		a = aCached.cloneNode( false );
		a.setAttribute( "MadCap:className", className );
		a.onmouseover = TocEntryOnmouseover;
		a.onmouseout = TocEntryOnmouseout;

        if ( nameToValueMap )
        {
            bookIcon = nameToValueMap.GetItem( "BookIcon" );
            bookOpenIcon = nameToValueMap.GetItem( "BookOpenIcon" );
            topicIcon = nameToValueMap.GetItem( "TopicIcon" );
            
            var value	= nameToValueMap.GetItem( "TopicIconAlternateText" );
            
            if ( value ) { topicIconAlt = value; }
            
            value = nameToValueMap.GetItem( "BookIconAlternateText" );
            
            if ( value ) { bookIconAlt = value; }
            
            value = nameToValueMap.GetItem( "MarkAsNewIconAlternateText" );
            
            if ( value ) { markAsNewIconAlt = value; }
            
            var markAsNewValue	= nameToValueMap.GetItem( "MarkAsNew" );
            
            if ( markAsNewValue )
            {
				markAsNew = FMCStringToBool( markAsNewValue );
            }
        }
        
        if ( link && !mergeHint )
        {
            if ( link.charAt( 0 ) == "/" )
            {
                link = fullPath + link.substring( 1 );
            }
            
            a.setAttribute( "href", link );
            
            if ( !frameName )
            {
                frameName = "body";
            }
            
            a.setAttribute( "MadCap:frameName", frameName );
        }
        else
        {
            a.setAttribute( "href", "javascript:void( 0 );" );
        }
        
        //
        
        var ownerHelpSystem = GetOwnerHelpSystem( htmlNode );
        var subPath         = null;
        
        if ( mergeHint )
        {
            var subsystem   = ownerHelpSystem.GetSubsystem( parseInt( mergeHint ) );
            
            if ( !subsystem.GetExists() )
            {
                continue;
            }
            
            subPath = subsystem.GetPath();
            
            var fileName	= null;
            
            if ( window.name == "toc" )
            {
				if ( !subsystem.HasToc() )
				{
					continue;
				}
				
				fileName = "Toc.xml";
            }
            else if ( window.name == "browsesequences" )
            {
				if ( !subsystem.HasBrowseSequences() )
				{
					continue;
				}
				
				fileName = "BrowseSequences.xml";
            }
            
            chunk = subPath + "Data/" + fileName;
            
            a["MadCap:helpSystem"] = subsystem;
        }
        
        //
        
        a.title = title;
        
        if ( isBook )
        {
            if ( chunk )
            {
                if ( !mergeHint )
                {
					var masterHS	= MCGlobals.RootFrame.GetMasterHelpSystem();

					if ( ownerHelpSystem == masterHS && masterHS.IsWebHelpPlus )
					{
						chunk = masterHS.GetPath() + "AutoMergeCache/" + chunk;
					}
					else
					{
						chunk = ownerHelpSystem.GetPath() + "Data/" + chunk;
                    }
                }
                
                a.onclick = ChunkOnClick;
                a.setAttribute( "MadCap:chunk", chunk );
            }
            else if ( entry.childNodes.length > 0 )
            {
                a.onclick = BookOnClick;
            }
            
            // Create "img" tag. Append to "a" tag.
            
            if ( bookIcon == "none" )
            {
                img = null;
            }
            else
            {
				var src		= "Images/Book.gif";
				var width	= 16;
				var height	= 16;
				
				if ( bookIcon )
				{
					bookIcon = FMCStripCssUrl( bookIcon );
					bookIcon = decodeURIComponent( bookIcon );
					
					src = "../" + parent.parent.gSkinFolder + escape( bookIcon );
					width = CMCFlareStylesheet.GetResourceProperty( bookIcon, "Width", 16 );
					height = CMCFlareStylesheet.GetResourceProperty( bookIcon, "Height", 16 );
				}
				
                img.src = src;
                img.alt = bookIconAlt;
                
                if ( !bookOpenIcon || bookOpenIcon == "none" )
                {
					img.setAttribute( "MadCap:altsrc", "Images/BookOpen.gif" );
                }
                else
                {
					bookOpenIcon = FMCStripCssUrl( bookOpenIcon );
					bookOpenIcon = "../" + parent.parent.gSkinFolder + escape( bookOpenIcon );
					img.setAttribute( "MadCap:altsrc", bookOpenIcon );
					
					FMCPreloadImage( bookOpenIcon );
                }
                
				img.style.width = width + "px";
				img.style.height = height + "px";
				img.style.verticalAlign = "middle";
            }
        }
        else
        {
            a.onclick = TopicOnClick;
            
            if ( topicIcon == "none" )
            {
                img = null;
            }
            else
            {
				var src		= "Images/Topic.gif";
				var width	= 16;
				var height	= 16;
				
				if ( topicIcon )
				{
					topicIcon = FMCStripCssUrl( topicIcon );
					topicIcon = decodeURIComponent( topicIcon );
					
					src = "../" + parent.parent.gSkinFolder + escape( topicIcon );
					width = CMCFlareStylesheet.GetResourceProperty( topicIcon, "Width", 16 );
					height = CMCFlareStylesheet.GetResourceProperty( topicIcon, "Height", 16 );
				}
				
                img.src = src;
                img.alt = topicIconAlt;
				img.style.width = width + "px";
				img.style.height = height + "px";
				img.style.verticalAlign = "middle";
            }
        }

        var markAsNewEntry		= entry.getAttribute( "MarkAsNew" );
        var markAsNewComputed	= markAsNewEntry ? FMCStringToBool( markAsNewEntry ) : markAsNew;
        
        if ( markAsNewComputed )
        {
            var newImg  = document.createElement( "img" );
            
            newImg.src = "Images/NewItemIndicator.bmp";
            newImg.alt = markAsNewIconAlt;
            newImg.style.width = "7px";
            newImg.style.height = "7px";
            newImg.style.position = "absolute";
            
            a.appendChild( newImg );
        }
        
        img ? a.appendChild( img ) : false;
        
        // Create "text" node
        
        var text = document.createTextNode( title );
        
        a.appendChild( text );
        div.appendChild( a );
        htmlNode.appendChild( div );
        
        // Build TOC for child nodes
        
        BuildToc( entry, div, indent + 16, mergeHint ? subPath : fullPath );
    }
}

function CacheStyles()
{
    var stylesDoc		= CMCXmlParser.GetXmlDoc( parent.parent.gRootFolder + parent.parent.gSkinFolder + "Stylesheet.xml", false, null, null );
    var styles			= stylesDoc.getElementsByTagName( "Style" );
    var tocEntryStyle	= null;
    
    for ( var i = 0; i < styles.length; i++ )
    {
        if ( styles[i].getAttribute( "Name" ) == "TocEntry" )
        {
            tocEntryStyle = styles[i];
            
            break;
        }
    }
    
    if ( tocEntryStyle )
    {
        var properties  = FMCGetChildNodesByTagName( tocEntryStyle, "Properties" );
        
        if ( properties.length > 0 )
        {
            var nameToValueMap  = new CMCDictionary();
            var props           = properties[0].childNodes;
            
            for ( var i = 0; i < props.length; i++ )
            {
                var prop    = props[i];
                
                if ( prop.nodeType != 1 ) { continue; }
                
                nameToValueMap.Add( prop.getAttribute( "Name" ), FMCGetPropertyValue( prop, null ) );
            }
            
            gStylesMap.Add( "TocEntry_" + tocEntryStyle.getAttribute( "Name" ), nameToValueMap );
        }
        
        //
        
        var styleClasses    = tocEntryStyle.getElementsByTagName( "StyleClass" );
        
        for ( var i = 0; i < styleClasses.length; i++ )
        {
            var properties  = FMCGetChildNodesByTagName( styleClasses[i], "Properties" );
            
            if ( properties.length > 0 )
            {
                var nameToValueMap  = new CMCDictionary();
                var props           = properties[0].childNodes;
                
                for ( var j = 0; j < props.length; j++ )
                {
                    var prop    = props[j];
                    
                    if ( prop.nodeType != 1 ) { continue; }
                    
                    nameToValueMap.Add( prop.getAttribute( "Name" ), FMCGetPropertyValue( prop, null ) );
                }
                
                gStylesMap.Add( "TocEntry_" + styleClasses[i].getAttribute( "Name" ), nameToValueMap );
            }
        }
    }
}

function ConvertToCSS( prop )
{
    if ( prop == "TopicIcon" || prop == "BookIcon" || prop == "BookOpenIcon" || prop == "HtmlHelpIconIndex" || prop == "MarkAsNew" )
    {
        return prop;
    }
    else
    {
        return prop.charAt( 0 ).toLowerCase() + prop.substring( 1, prop.length );
    }
}

function CreateToc( a, OnCompleteFunc )
{
	var rootFrame	= parent.parent;
	
	StartLoading( window, document.body, rootFrame.gLoadingLabel, rootFrame.gLoadingAlternateText, document.getElementsByTagName( "div" )[1] );
	
	//
	
	var headNode	= a.parentNode;
    var xmlFile		= FMCGetMCAttribute( headNode.getElementsByTagName( "a" )[0], "MadCap:chunk" );

    FMCRemoveMCAttribute( a, "MadCap:chunk" );
    
    a.onclick = BookOnClick;
    
    var masterHS	= parent.parent.GetMasterHelpSystem();
    var xmlDoc		= null;
    var args		= { a: a, OnCompleteFunc: OnCompleteFunc };
    
    if ( xmlFile == "Toc.xml" && masterHS.IsWebHelpPlus )
    {
		xmlDoc = CMCXmlParser.CallWebService( MCGlobals.RootFolder + "Service/Service.asmx/GetToc", true, OnTocXmlLoaded, args );
    }
    else if ( xmlFile == "BrowseSequences.xml" && masterHS.IsWebHelpPlus )
    {
		xmlDoc = CMCXmlParser.CallWebService( MCGlobals.RootFolder + "Service/Service.asmx/GetBrowseSequences", true, OnTocXmlLoaded, args );
    }
    else
    {
		var xmlPath	= (xmlFile.indexOf( "/" ) == -1) ? parent.parent.gRootFolder + "Data/" + xmlFile : xmlFile;
		
		xmlDoc = CMCXmlParser.GetXmlDoc( xmlPath, true, OnTocXmlLoaded, args );
    }
}

function OnTocXmlLoaded( xmlDoc, args )
{
	var a				= args.a;
    var onCompleteFunc	= args.OnCompleteFunc;
    
    if ( !xmlDoc || !xmlDoc.documentElement )
    {
        EndLoading( window, document.getElementsByTagName( "div" )[1] );
        
        if ( onCompleteFunc != null )
        {
			onCompleteFunc();
        }
        
        return;
    }
    
    var headNode	= a.parentNode;
    var indent      = parseInt( headNode.style.textIndent );
    var helpSystem  = GetOwnerHelpSystem( headNode );
    var path        = helpSystem.GetPath();
    
    indent += (headNode.parentNode.id == "CatapultToc") ? 0 : 16;
    
    BuildToc( xmlDoc.documentElement, headNode, indent, path );
    
    //
    
    TocExpand( a );
    
    //
    
    EndLoading( window, document.getElementsByTagName( "div" )[1] );
    
    //
    
    if ( gSyncContinue )
    {
		gSyncContinue = false;
		SyncTOC( gSyncTocPath );
    }
    
    if ( onCompleteFunc != null )
    {
		onCompleteFunc();
    }
}

var gInitializing			= false;
var gInitOnCompleteFuncs	= new Array();

function InitOnComplete()
{
	for ( var i = 0; i < gInitOnCompleteFuncs.length; i++ )
	{
		gInitOnCompleteFuncs[i]();
	}
}

function Init( OnCompleteFunc )
{
    if ( gInit )
    {
		OnCompleteFunc();
		
        return;
    }
    
    gInitOnCompleteFuncs.push( OnCompleteFunc );
    
    if ( gInitializing )
    {
		return;
    }
    
    gInitializing = true;
    
    //
    
    FMCPreloadImage( "Images/BookOpen.gif" );
    CacheStyles();
    
    //
    
    var xmlDoc	= CMCXmlParser.GetXmlDoc( parent.parent.gRootFolder + parent.parent.gSkinFolder + "Skin.xml", false, null, null );

	gSyncTOC = FMCGetAttributeBool( xmlDoc.documentElement, "AutoSyncTOC", false );
    
    //
    
    var a	= document.getElementById( "CatapultToc" ).getElementsByTagName( "div" )[0].getElementsByTagName( "a" )[0];
    
    function OnCreateTocComplete()
    {
		gInit = true;
	
		InitOnComplete();
    }
    
    CreateToc( a, OnCreateTocComplete );
}

function TocExpand( node )
{
    var tocEntries  = node.parentNode.childNodes;
    
    for ( var i = 0; i < tocEntries.length; i++ )
    {
        var tocEntry = tocEntries[i];
        
        if ( tocEntry.nodeName != "DIV" )
        {
            continue;
        }
        
        tocEntry.style.display = (tocEntry.style.display == "none") ? "block" : "none";
    }
    
    var imgs    = node.getElementsByTagName( "img" );
    
    if ( imgs.length == 2 )
    {
        FMCImageSwap( node.getElementsByTagName( "img" )[1], "swap" );
    }
    else if ( imgs.length == 1 )
    {
        FMCImageSwap( node.getElementsByTagName( "img" )[0], "swap" );
    }
    
    FMCScrollToVisible( window, node.parentNode );
}

function TocEntryOnmouseover()
{
	this.style.color = "#ff0000";
}

function TocEntryOnmouseout()
{
	var color			= "#0055ff";
	var className		= FMCGetMCAttribute( this, "MadCap:className" );
	var nameToValueMap	= gStylesMap.GetItem( className );

	if ( nameToValueMap )
	{
		var classColor	= nameToValueMap.GetItem( "Color" );
		
		if ( classColor )
		{
			color = classColor;
		}
	}

	this.style.color = color;
}
