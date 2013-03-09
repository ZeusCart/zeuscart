// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

//

gOnloadFuncs.push( Init );

//

var gInit					= false;
var gVisibleItems			= 8;
var gcMaxVisibleItems		= 8;
var gcAccordionItemHeight	= 28;
var gActiveItem				= null;
var gActiveIcon				= null;
var gActiveIFrame			= null;
var gAccordionItems			= new Array();
var gAccordionIcons			= new Array();
var gIFrames				= new Array();
var gcDefaultID				= 0;
var gcDefaultTitle			= "Table of Contents";

window.onresize = BodyOnResize;

function BodyOnResize()
{
	// Firefox on Mac: might trigger this event before everything is finished being loaded.
	
	if ( !frames["index"].document.getElementById( "CatapultIndex" ) ||
		 !frames["search"].document.getElementById( "SearchResults" ) )
	{
		return;
	}
	
	//
	
	var accordionTitle	= parent.frames["mctoolbar"].document.getElementById( "AccordionTitle" );
	
	if ( accordionTitle != null )
	{
		accordionTitle.style.width = Math.max( FMCGetClientWidth( window, true ), 0 ) + "px";
	}
	
    SetIFrameHeight();
}

function CalcVisibleItems( y )
{
    var accordionTop  = (gVisibleItems + 1) * gcAccordionItemHeight;
    var itemOffset    = (y - accordionTop >= 0) ? Math.floor( (y - accordionTop) / gcAccordionItemHeight ) : Math.ceil( (y - accordionTop) / gcAccordionItemHeight );
    
    gVisibleItems = Math.max( Math.min( gVisibleItems + itemOffset, gcMaxVisibleItems ), 0 );
    
    // Debug
    //window.status = accordionTop + ", " + y + ", " + itemOffset + ", " + gVisibleItems;
}

function RefreshAccordion()
{
    SetIFrameHeight();
    
    for ( var i = 0; i < gAccordionItems.length; i++ )
    {
        gAccordionItems[i].style.display = (i < gVisibleItems) ? "block" : "none";
        gAccordionIcons[i].style.visibility = (i < gVisibleItems) ? "hidden" : "visible";
    }
}

function ExpandAccordionDrag( e )
{
    // Debug
    //window.status += "d";
    
    if ( !e ) { e = window.event; }
    
    var currY = FMCGetClientHeight( window, false ) - e.clientY;
    
    CalcVisibleItems( currY );
    RefreshAccordion();
}

function ExpandAccordionEnd( e )
{
    // Debug
    //window.status += "e";
    
    if ( document.body.releaseCapture )
    {
        document.body.releaseCapture();
        
        document.body.onmousemove = null;
        document.body.onmouseup = null;
    }
    else if ( document.removeEventListener )
    {
        document.removeEventListener( "mouseover", ExpandAccordionMouseover, true );
        document.removeEventListener( "mousemove", ExpandAccordionDrag, true );
        document.removeEventListener( "mouseup", ExpandAccordionEnd, true );
        frames[gActiveIFrame.id].document.removeEventListener( "mousemove", ExpandAccordionDrag, true );
        frames[gActiveIFrame.id].document.removeEventListener( "mouseup", ExpandAccordionEnd, true );
    }
    
    var accordionExpander	= document.getElementById( "AccordionExpander" );
    
    accordionExpander.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( accordionExpander, "MadCap:outImage" ) );
    
    for ( var i = 0; i < gAccordionItems.length; i++ )
    {
        gAccordionItems[i].style.cursor = (navigator.appVersion.indexOf( "MSIE 5.5" ) == -1) ? "pointer" : "hand" ;
    }
    
    SetupAccordion();
}

function ExpandAccordionMouseover( e )
{
    e.stopPropagation();
}

function ExpandAccordionStart()
{
    // Debug
    //window.status += "s";
    
    if ( document.body.setCapture )
    {
        document.body.setCapture();
        
        document.body.onmousemove = ExpandAccordionDrag;
        document.body.onmouseup = ExpandAccordionEnd;
    }
    else if ( document.addEventListener )
    {
        document.addEventListener( "mouseover", ExpandAccordionMouseover, true );
        document.addEventListener( "mousemove", ExpandAccordionDrag, true );
        document.addEventListener( "mouseup", ExpandAccordionEnd, true );
        frames[gActiveIFrame.id].document.addEventListener( "mousemove", ExpandAccordionDrag, true );
        frames[gActiveIFrame.id].document.addEventListener( "mouseup", ExpandAccordionEnd, true );
    }
    
    var accordionExpander	= document.getElementById( "AccordionExpander" );
    
    accordionExpander.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( accordionExpander, "MadCap:selectedImage" ) );
    
    for ( var i = 0; i < gAccordionItems.length; i++ )
    {
        gAccordionItems[i].style.cursor = "n-resize";
    }
    
    SetupAccordion();
}

function SetupAccordion()
{
    for ( var i = 0; i < gAccordionItems.length; i++ )
    {
        var accordionItem   = gAccordionItems[i];
        var accordionIcon   = gAccordionIcons[i];
        
        if ( accordionItem != gActiveItem )
        {
			accordionItem.onmouseover = function() { this.getElementsByTagName( "td" )[0].style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( this, "MadCap:overImage" ) ); };
			accordionItem.onmouseout = function() { this.getElementsByTagName( "td" )[0].style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( this, "MadCap:outImage" ) ); };
			accordionIcon.onmouseover = function() { this.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( this, "MadCap:overImage" ) ); };
			accordionIcon.onmouseout = function() { this.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( this, "MadCap:outImage" ) ); };
        }
    }
}

function AccordionItemClick( node )
{
    SetActiveIFrame( parseInt( FMCGetMCAttribute( node, "MadCap:itemID" ) ), node.getElementsByTagName( "a" )[0].firstChild.nodeValue );
    SetIFrameHeight();
}

function AccordionIconClick( node )
{
    SetActiveIFrame( parseInt( FMCGetMCAttribute( node, "MadCap:itemID" ) ), node.title );
    SetIFrameHeight();
}

function ItemOnkeyup( e )
{
	var target	= null;
	
	if ( !e ) { e = window.event; }
	
	if ( e.srcElement ) { target = e.srcElement; }
	else if ( e.target ) { target = e.target; }
	
	if ( e.keyCode == 13 && target && target.onclick )
	{
		target.onclick();
	}
}

function Init()
{
	document.body.tabIndex = 1;
	
    frames["index"].document.getElementById( "searchField" ).value = "";
    frames["search"].document.forms["search"].searchField.value = "";
    
    LoadSkin();
    
    if ( !CheckCSHSearch() )
    {
		parent.frames["body"].document.location.replace( parent.gRootFolder + "Content/" + parent.gStartTopic );
		SetActiveIFrame( gcDefaultID, gcDefaultTitle );
    }

    SetIFrameHeight();
    SetupAccordion();
    
    // For Safari
    
    if ( FMCIsSafari() )
    {
        setTimeout( "BodyOnResize();", 10 );
    }
    
    //
    
    gInit = true;
}

function CheckCSHSearch()
{
	var searchString	= parent.document.location.search.substring( 1 ).replace( /%20/g, " " );

	if ( searchString == "" )
	{
		return false;
	}

	var firstPick	= false;

	if ( searchString.indexOf( "|FirstPick" ) == searchString.length - "|FirstPick".length )
	{
		firstPick = true;
		searchString = searchString.substring( 0, searchString.length - "|FirstPick".length );
	}

	SetActiveIFrameByName( "search" );
	
	var searchFrame	= frames["search"];
	
	searchFrame.document.forms["search"].searchField.value = searchString;
	searchFrame.StartSearch( firstPick, OnSearchFinished, firstPick );
	
	return true;
}

function OnSearchFinished( numResults, firstPick )
{
	if ( !firstPick || numResults == 0 )
	{
		parent.frames["body"].document.location.href = parent.gRootFolder + "Content/" + parent.gStartTopic;
	}
}

function SetupMouseEffectDefaults()
{
	var accordionExpander	= document.getElementById( "AccordionExpander" );
	
	accordionExpander.style.backgroundImage = FMCCreateCssUrl( "Images/NavigationBottomGradient.jpg" );
	accordionExpander.setAttribute( "MadCap:outImage", "Images/NavigationBottomGradient.jpg" );
    accordionExpander.setAttribute( "MadCap:selectedImage", "Images/NavigationBottomGradient_selected.jpg" );
    
    FMCPreloadImage( "Images/NavigationBottomGradient_selected.jpg" );
    
    for ( var i = 0; i < gAccordionItems.length; i++ )
    {
		var accordionItem	= gAccordionItems[i];
		var id				= accordionItem.id;
		var name			= id.charAt( 0 ).toUpperCase() + id.substring( 1 );
		
		accordionItem.getElementsByTagName( "td" )[0].style.backgroundImage = FMCCreateCssUrl( "Images/" + name + "Background.jpg" );
		accordionItem.setAttribute( "MadCap:outImage", "Images/" + name + "Background.jpg" );
		accordionItem.setAttribute( "MadCap:overImage", "Images/" + name + "Background_over.jpg" );
		
		FMCPreloadImage( "Images/" + name + "Background_over.jpg" );
    }
    
    for ( var i = 0; i < gAccordionIcons.length; i++ )
    {
		var accordionIcon	= gAccordionIcons[i];
		var id				= accordionIcon.id;
		var name			= id.charAt( 0 ).toUpperCase() + id.substring( 1, id.length - "Icon".length ) + "Accordion";
		
		accordionIcon.style.backgroundImage = FMCCreateCssUrl( "Images/" + name + "Background.jpg" );
		accordionIcon.setAttribute( "MadCap:outImage", "Images/" + name + "Background.jpg" );
		accordionIcon.setAttribute( "MadCap:overImage", "Images/" + name + "Background_over.jpg" );
		
		FMCPreloadImage( "Images/" + name + "Background_over.jpg" );
    }
}

function LoadSkin()
{
    var xmlDoc          = CMCXmlParser.GetXmlDoc( parent.gRootFolder + parent.gSkinFolder + "Skin.xml", false, null, null );
    var xmlHead         = xmlDoc.documentElement;
    var tabsAttribute	= xmlHead.getAttribute( "Tabs" );
    var tabs			= null;
    
    if ( tabsAttribute.indexOf( "Favorites" ) == -1 )
    {
		frames["search"].gFavoritesEnabled = false;
    }
    
    if ( tabsAttribute && tabsAttribute != "" )
    {
		tabs = xmlHead.getAttribute( "Tabs" ).split( "," );
    }
    else
    {
		return;
    }
    
    var defaultTab	= (xmlHead.getAttribute( "Tabs" ).indexOf( xmlHead.getAttribute( "DefaultTab" ) ) == -1) ? tabs[0] : xmlHead.getAttribute( "DefaultTab" );
    var accordionID	= null;
    var iconID		= null;
    var iframeID	= null;
    
    gcMaxVisibleItems = tabs.length;
    
    LoadWebHelpOptions( xmlDoc );
    
    //
    
    gTabIndex = 3;
    
    //
    
	for ( var i = 0; i < tabs.length; i++ )
	{
		var id		= null;
		var title	= null;

		switch ( tabs[i] )
		{
			case "TOC":
				id = "toc";
				title = "Table of Contents";

				break;
			case "Index":
				id = "index";
				title = "Index";

				break;
			case "Search":
				id = "search";
				title = "Search";

				break;
			case "Glossary":
				id = "glossary";
				title = "Glossary";

				break;
			case "Favorites":
				id = "favorites";
				title = "Favorites";

				break;
			case "BrowseSequences":
				id = "browsesequences";
				title = "Browse Sequences";

				break;
			case "TopicComments":
				id = "topiccomments";
				title = "Topic Comments";

				break;
			case "RecentComments":
				id = "recentcomments";
				title = "Recent Comments";

				break;
		}
        
        gAccordionItems[i] = document.getElementById( id + "Accordion" );
        gAccordionItems[i].setAttribute( "MadCap:itemID", i );
        gAccordionItems[i].getElementsByTagName( "a" )[0].tabIndex = gTabIndex++;
        
        var currIcon			= document.getElementById( id + "Icon" );
        var trAccordionIcons	= currIcon.parentNode;
        var currIconClone		= currIcon.cloneNode( true );
        
        currIconClone.setAttribute( "MadCap:itemID", i );
        gAccordionIcons[i] = currIconClone;
        trAccordionIcons.removeChild( currIcon );
        trAccordionIcons.appendChild( currIconClone );
        gAccordionIcons[i].tabIndex = 0;
        
        gIFrames[i] = document.getElementById( id );
        
        if ( i < gVisibleItems )
        {
            gAccordionItems[i].style.display = "block";
        }
        else
        {
            gAccordionIcons[i].style.visibility = "visible";
        }
        
        gAccordionIcons[i].style.display = (document.defaultView && document.defaultView.getComputedStyle) ? "table-cell" : "block";
        
        if ( !defaultTab )
        {
            defaultTab = tabs[i];
        }
        
        if ( tabs[i] == defaultTab )
        {
            accordionID = id + "Accordion";
            iconID = id + "Icon";
            iframeID = id;
            
            gcDefaultID = i;
            gcDefaultTitle = title;
            
            document.getElementById( id ).style.zIndex = "2";
        }
    }
    
    gActiveItem = document.getElementById( accordionID );
    gActiveIcon = document.getElementById( iconID );
    gActiveIFrame = document.getElementById( iframeID );
    
    //
    
    SetupMouseEffectDefaults();
    LoadStyles( xmlDoc );
}

function LoadWebHelpOptions( xmlDoc )
{
    var webHelpOptions  = xmlDoc.getElementsByTagName( "WebHelpOptions" )[0];
    
    if ( webHelpOptions )
    {
        var visibleItems    = webHelpOptions.getAttribute( "VisibleAccordionItemCount" );
        
        if ( visibleItems )
        {
            gVisibleItems = parseInt( visibleItems );
        }
    }
}

function LoadStyles( xmlDoc )
{
    var styleSheet	= xmlDoc.getElementsByTagName( "Stylesheet" )[0];
    
    if ( !styleSheet )
    {
		return;
	}
	
    var styleSheetLink	= styleSheet.getAttribute( "Link" );
    
    if ( !styleSheetLink )
    {
		return;
	}
	
    var styleDoc	= CMCXmlParser.GetXmlDoc( parent.gRootFolder + parent.gSkinFolder + styleSheetLink, false, null, null );
    var styles		= styleDoc.getElementsByTagName( "Style" );
    
    for ( var i = 0; i < styles.length; i++ )
    {
        var styleName	= styles[i].getAttribute( "Name" );
        
        if ( styleName == "AccordionItem" )
        {
            LoadAccordionItemStyle( styles[i] );
        }
        else if ( styleName == "Frame" )
        {
            LoadFrameStyle( styles[i] );
        }
        else if ( styleName == "IndexEntry" )
        {
            LoadIndexEntryStyle( styles[i] );
        }
        else if ( styleName == "Control" )
        {
            LoadControlStyle( styles[i] );
        }
    }
}

function LoadAccordionIconsStyle( properties )
{
	var accordionIcons				= document.getElementById( "AccordionIcons" );
	var accordionIconsOuterTable	= FMCGetChildNodeByTagName( accordionIcons, "TABLE", 0 );
	var accordionIconsInnerTable	= accordionIconsOuterTable.getElementsByTagName( "table" )[0];

	for ( var j = 0; j < properties.length; j++ )
	{
		var cssName		= properties[j].getAttribute( "Name" );
		var cssValue	= FMCGetPropertyValue( properties[j], null );

		cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );

		if ( cssName == "itemHeight" )
		{
			accordionIcons.style.height = FMCConvertToPx( document, cssValue, null, 28 ) + "px";
		}
        else if ( cssName == "backgroundGradient" )
        {
			accordionIcons.getElementsByTagName( "td" )[0].style.backgroundImage = FMCCreateCssUrl( parent.gRootFolder + parent.gSkinFolder + "AccordionIconsBackground.jpg" );
        }
        else if ( cssName.substring( 0, "border".length ) == "border" )
        {
			accordionIconsOuterTable.style[cssName] = FMCConvertBorderToPx( document, cssValue );
        }
        else
        {
            accordionIcons.style[cssName] = cssValue;
        }
	}

	var borderTopWidth		= FMCParseInt( FMCGetComputedStyle( accordionIconsOuterTable, "borderTopWidth" ), 0 );
	var borderBottomWidth	= FMCParseInt( FMCGetComputedStyle( accordionIconsOuterTable, "borderBottomWidth" ), 0 );
	var currHeight			= parseInt( FMCGetComputedStyle( accordionIcons, "height" ) );

	accordionIconsOuterTable.style.height = currHeight + "px";
	accordionIconsInnerTable.style.height = (currHeight - borderTopWidth - borderBottomWidth) + "px";
}

function LoadAccordionItemStyle( accordionItemStyle )
{
    var styleClasses	= accordionItemStyle.getElementsByTagName( "StyleClass" );
    
    for ( var i = 0; i < styleClasses.length; i++ )
    {
        var styleName	= styleClasses[i].getAttribute( "Name" );
        var properties	= styleClasses[i].getElementsByTagName( "Property" );
        
        if ( styleName == "IconTray" )
        {
			LoadAccordionIconsStyle( properties );
			
			continue;
        }
        else if ( styleName == "BrowseSequence" )
        {
			styleName = "BrowseSequences";
        }
        
        var accordionItem			= document.getElementById( styleName.toLowerCase() + "Accordion" );
        var accordionItemOuterTable	= FMCGetChildNodeByTagName( accordionItem, "TABLE", 0 );
        var accordionItemInnerTable	= accordionItemOuterTable.getElementsByTagName( "table" )[0];
        var accordionANode			= accordionItem.getElementsByTagName( "a" )[0];
        var accordionIcon			= document.getElementById( styleName.toLowerCase() + "Icon" );
        
        for ( var j = 0; j < properties.length; j++ )
        {
            var cssName		= properties[j].getAttribute( "Name" );
            var cssValue	= FMCGetPropertyValue( properties[j], null );
            
            cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );
            
            if ( cssName == "label" )
            {
                accordionANode.firstChild.nodeValue = cssValue;
                accordionIcon.title = cssValue;
                accordionIcon.firstChild.alt = cssValue;
                frames[styleName.toLowerCase()].document.title = cssValue;
                
                if ( FMCGetMCAttribute( accordionItem, "MadCap:itemID" ) == gcDefaultID )
                {
                    gcDefaultTitle = cssValue;
                }
            }
            else if ( cssName == "icon" )
            {
                var accordionItemImg    = accordionItem.getElementsByTagName( "img" )[0];
                var iconImg             = document.getElementById( styleName.toLowerCase() + "Icon" ).getElementsByTagName( "img" )[0];
                
                if ( cssValue == "none" )
                {
					if ( accordionItemImg )
					{
						accordionItemImg.parentNode.removeChild( accordionItemImg );
                    }
                }
                else
                {
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );
					
					var width	= CMCFlareStylesheet.GetResourceProperty( cssValue, "Width", "auto" );
					var height	= CMCFlareStylesheet.GetResourceProperty( cssValue, "Height", "auto" );
					
					if ( width != "auto" )
					{
						width += "px";
					}
					
					if ( height != "auto" )
					{
						height += "px";
					}
					
                    accordionItemImg.src = parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
                    accordionItemImg.style.width = width;
                    accordionItemImg.style.height = height;
                    
                    iconImg.src = parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
                    iconImg.style.width = width;
                    iconImg.style.height = height;
                }
            }
            else if ( cssName == "itemHeight" )
            {
                accordionItem.style.height = FMCConvertToPx( document, cssValue, null, 28 ) + "px";
            }
            else if ( cssName == "backgroundGradient" )
            {
				var id		= accordionItem.id;
				var name	= id.charAt( 0 ).toUpperCase() + id.substring( 1 );
				
				accordionItem.getElementsByTagName( "td" )[0].style.backgroundImage = FMCCreateCssUrl( parent.gRootFolder + parent.gSkinFolder + name + "Background.jpg" );
                accordionItem.setAttribute( "MadCap:outImage", parent.gRootFolder + parent.gSkinFolder + name + "Background.jpg" );
                accordionIcon.style.backgroundImage = FMCCreateCssUrl( parent.gRootFolder + parent.gSkinFolder + name + "Background.jpg" );
                accordionIcon.setAttribute( "MadCap:outImage", parent.gRootFolder + parent.gSkinFolder + name + "Background.jpg" );
            }
            else if ( cssName == "backgroundGradientHover" )
            {
				var id		= accordionItem.id;
				var name	= id.charAt( 0 ).toUpperCase() + id.substring( 1 );
				
				accordionItem.setAttribute( "MadCap:overImage", parent.gRootFolder + parent.gSkinFolder + name + "Background_over.jpg" );
                accordionIcon.setAttribute( "MadCap:overImage", parent.gRootFolder + parent.gSkinFolder + name + "Background_over.jpg" );
                
                FMCPreloadImage( parent.gRootFolder + parent.gSkinFolder + name + "Background_over.jpg" );
            }
            else if ( cssName == "color" || cssName == "fontSize" )
            {
                accordionANode.style[cssName] = cssValue;
            }
            else if ( cssName.substring( 0, "border".length ) == "border" )
            {
				accordionItemOuterTable.style[cssName] = FMCConvertBorderToPx( document, cssValue );
            }
            else
            {
                accordionItem.style[cssName] = cssValue;
            }
        }
        
		var borderTopWidth		= FMCParseInt( FMCGetComputedStyle( accordionItemOuterTable, "borderTopWidth" ), 0 );
		var borderBottomWidth	= FMCParseInt( FMCGetComputedStyle( accordionItemOuterTable, "borderBottomWidth" ), 0 );
		var currHeight			= parseInt( FMCGetComputedStyle( accordionItem, "height" ) );

		accordionItemOuterTable.style.height = currHeight + "px";
		accordionItemInnerTable.style.height = (currHeight - borderTopWidth - borderBottomWidth) + "px";
    }
}

function LoadFrameStyle( frameStyle )
{
    var styleClasses	= frameStyle.getElementsByTagName( "StyleClass" );
    
    for ( var i = 0; i < styleClasses.length; i++ )
    {
        var styleName	= styleClasses[i].getAttribute( "Name" );
        
        if ( styleName == "NavigationTopDivider" )
        {
			var navigationTop	= document.getElementById( "NavigationTop" );
			var properties		= styleClasses[i].getElementsByTagName( "Property" );
			
            for ( var j = 0; j < properties.length; j++ )
			{
				var cssName     = properties[j].getAttribute( "Name" );
				var cssValue    = FMCGetPropertyValue( properties[j], null );
	            
				if ( cssName == "Height" )
				{
					navigationTop.style.height = cssValue;
				}
				else if ( cssName == "BackgroundGradient" )
				{
					navigationTop.style.backgroundImage = FMCCreateCssUrl( parent.gRootFolder + parent.gSkinFolder + "NavigationTopGradient.jpg" );
				}
			}
        }
        else if ( styleName == "NavigationDragHandle" )
        {
			var accordionExpander	= document.getElementById( "AccordionExpander" );
			var properties			= styleClasses[i].getElementsByTagName( "Property" );
			
            for ( var j = 0; j < properties.length; j++ )
			{
				var cssName     = properties[j].getAttribute( "Name" );
				var cssValue    = FMCGetPropertyValue( properties[j], null );
	            
				if ( cssName == "Height" )
				{
					accordionExpander.style.height = cssValue;
				}
				else if ( cssName == "BackgroundGradient" )
				{
					accordionExpander.style.backgroundImage = FMCCreateCssUrl( parent.gRootFolder + parent.gSkinFolder + "NavigationBottomGradient.jpg" );
					accordionExpander.setAttribute( "MadCap:outImage", parent.gRootFolder + parent.gSkinFolder + "NavigationBottomGradient.jpg" );
				}
				else if ( cssName == "BackgroundGradientPressed" )
				{
					accordionExpander.setAttribute( "MadCap:selectedImage", parent.gRootFolder + parent.gSkinFolder + "NavigationBottomGradient_selected.jpg" );
					
					FMCPreloadImage( parent.gRootFolder + parent.gSkinFolder + "NavigationBottomGradient_selected.jpg" );
				}
			}
        }
        else if ( styleName.substring( 0, "Accordion".length ) == "Accordion" )
        {
			var name		= styleName.substring( "Accordion".length ).toLowerCase();
			
			if ( name == "browsesequence" )
			{
				name = "browsesequences";
			}
			
			var properties	= styleClasses[i].getElementsByTagName( "Property" );
			
            for ( var j = 0; j < properties.length; j++ )
			{
				var cssName		= properties[j].getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( properties[j], null );
	            
				if ( cssName == "BackgroundColor" )
				{
					var accordionFrame	= frames[name];
					
					accordionFrame.document.body.style.backgroundColor = cssValue;
				}
			}
        }
    }
}

function LoadIndexEntryStyle( indexEntryStyle )
{
    var indexFrame  = frames["index"];
    var properties  = indexEntryStyle.getElementsByTagName( "Property" );
    
    for ( var j = 0; j < properties.length; j++ )
    {
        var cssName     = properties[j].getAttribute( "Name" );
        var cssValue    = FMCGetPropertyValue( properties[j], null );
        
        cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );
        
        if ( cssName == "selectionColor" )
        {
            indexFrame.gSelectionColor = cssValue;
        }
        else if ( cssName == "selectionBackgroundColor" )
        {
            indexFrame.gSelectionBackgroundColor = cssValue;
        }
        
        indexFrame.gStylesMap.Add( cssName, cssValue );
    }
}

function LoadControlStyle( style )
{
	var styleClasses	= style.getElementsByTagName( "StyleClass" );
	
	for ( var i = 0; i < styleClasses.length; i++ )
    {
		var styleClass	= styleClasses[i];
        var styleName	= styleClass.getAttribute( "Name" );
        var properties	= styleClass.getElementsByTagName( "Property" );
        
        if ( styleName == "EmptySearchFavoritesLabel" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property		= properties[j];
				var cssName			= property.getAttribute( "Name" );
				var cssValue		= FMCGetPropertyValue( property, null );
				var favoritesFrame	= frames["favorites"];
		        
				if ( cssName == "Label" )
				{
					favoritesFrame.gEmptySearchFavoritesLabel = cssValue;
				}
				else if ( cssName == "Tooltip" )
				{
					if ( cssValue.toLowerCase() == "none" )
					{
						cssValue = "";
					}
					
					favoritesFrame.gEmptySearchFavoritesTooltip = cssValue;
				}
				else
				{
					cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );

					favoritesFrame.gEmptySearchFavoritesStyleMap.Add( cssName, cssValue );
				}
			}
		}
		else if ( styleName == "EmptyTopicFavoritesLabel" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property		= properties[j];
				var cssName			= property.getAttribute( "Name" );
				var cssValue		= FMCGetPropertyValue( property, null );
				var favoritesFrame	= frames["favorites"];
		        
				if ( cssName == "Label" )
				{
					favoritesFrame.gEmptyTopicFavoritesLabel = cssValue;
				}
				else if ( cssName == "Tooltip" )
				{
					if ( cssValue.toLowerCase() == "none" )
					{
						cssValue = "";
					}
					
					favoritesFrame.gEmptyTopicFavoritesTooltip = cssValue;
				}
				else
				{
					cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );

					favoritesFrame.gEmptyTopicFavoritesStyleMap.Add( cssName, cssValue );
				}
			}
        }
        else if ( styleName == "SearchButton" )
        {
			var button	= frames["search"].document.getElementById( "SearchButton" );
		    
			for ( var j = 0; j < properties.length; j++ )
			{
				var property		= properties[j];
				var cssName			= property.getAttribute( "Name" );
				var cssValue		= FMCGetPropertyValue( property, null );
		        
				if ( cssName == "Label" )
				{
					button.value = cssValue;
				}
				else
				{
					cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );

					button.style[cssName] = cssValue;
				}
			}
        }
        else if ( styleName == "SearchBox" )
        {
			var searchBox	= frames["search"].document.forms["search"].searchField;
		    
			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );
		        
				if ( cssName == "Tooltip" )
				{
					if ( cssValue.toLowerCase() == "none" )
					{
						cssValue = "";
					}
					
					searchBox.title = cssValue;
				}
			}
        }
        else if ( styleName == "SearchFavoritesDeleteButton" )
        {
			var favoritesFrame	= frames["favorites"];
			
			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );

		        if ( cssName == "Tooltip" )
				{
					if ( cssValue.toLowerCase() == "none" )
					{
						cssValue = "";
					}
					
					favoritesFrame.gDeleteSearchFavoritesTooltip = cssValue;
				}
				else if ( cssName == "Icon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );

					var width	= CMCFlareStylesheet.GetResourceProperty( cssValue, "Width", null );
					var height	= CMCFlareStylesheet.GetResourceProperty( cssValue, "Height", null );
					
					if ( width )
					{
						favoritesFrame.gDeleteSearchFavoritesIconWidth = width;
					}
					
					if ( height )
					{
						favoritesFrame.gDeleteSearchFavoritesIconHeight = height;
					}

					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					favoritesFrame.gDeleteSearchFavoritesIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
				else if ( cssName == "PressedIcon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );
					
					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					favoritesFrame.gDeleteSearchFavoritesSelectedIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
				else if ( cssName == "HoverIcon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );
					
					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					favoritesFrame.gDeleteSearchFavoritesOverIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
			}
        }
        else if ( styleName == "SearchFavoritesLabel" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property		= properties[j];
				var cssName			= property.getAttribute( "Name" );
				var cssValue		= FMCGetPropertyValue( property, null );
				var favoritesFrame	= frames["favorites"];
		        
				if ( cssName == "Label" )
				{
					favoritesFrame.gSearchFavoritesLabel = cssValue;
				}
				else
				{
					cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );

					favoritesFrame.gSearchFavoritesLabelStyleMap.Add( cssName, cssValue );
				}
			}
        }
        else if ( styleName == "SearchFiltersLabel" )
        {
			var searchFrame	= frames["search"];
			
			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );

				if ( cssName == "Label" )
				{
					searchFrame.gFiltersLabel = cssValue;
				}
				else
				{
					cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );

					searchFrame.gFiltersLabelStyleMap.Add( cssName, cssValue );
				}
			}
        }
        else if ( styleName == "TopicFavoritesDeleteButton" )
        {
			var favoritesFrame	= frames["favorites"];

			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );

		        if ( cssName == "Tooltip" )
				{
					if ( cssValue.toLowerCase() == "none" )
					{
						cssValue = "";
					}
					
					favoritesFrame.gDeleteTopicFavoritesTooltip = cssValue;
				}
				else if ( cssName == "Icon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );

					var width	= CMCFlareStylesheet.GetResourceProperty( cssValue, "Width", null );
					var height	= CMCFlareStylesheet.GetResourceProperty( cssValue, "Height", null );
					
					if ( width )
					{
						favoritesFrame.gDeleteTopicFavoritesIconWidth = width;
					}
					
					if ( height )
					{
						favoritesFrame.gDeleteTopicFavoritesIconHeight = height;
					}

					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					favoritesFrame.gDeleteTopicFavoritesIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
				else if ( cssName == "PressedIcon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );
					
					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					favoritesFrame.gDeleteTopicFavoritesSelectedIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
				else if ( cssName == "HoverIcon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );
					
					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					favoritesFrame.gDeleteTopicFavoritesOverIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
			}
        }
        else if ( styleName == "TopicFavoritesLabel" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property		= properties[j];
				var cssName			= property.getAttribute( "Name" );
				var cssValue		= FMCGetPropertyValue( property, null );
				var favoritesFrame	= frames["favorites"];
		        
				if ( cssName == "Label" )
				{
					favoritesFrame.gTopicFavoritesLabel = cssValue;
				}
				else
				{
					cssName = cssName.charAt( 0 ).toLowerCase() + cssName.substring( 1, cssName.length );

					favoritesFrame.gTopicFavoritesLabelStyleMap.Add( cssName, cssValue );
				}
			}
        }
        else if ( styleName == "AddSearchToFavoritesButton" )
        {
			var searchFrame	= frames["search"];

			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );

		        if ( cssName == "Tooltip" )
				{
					if ( cssValue.toLowerCase() == "none" )
					{
						cssValue = "";
					}
					
					searchFrame.gAddSearchLabel = cssValue;
				}
				else if ( cssName == "Icon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );

					var width	= CMCFlareStylesheet.GetResourceProperty( cssValue, "Width", null );
					var height	= CMCFlareStylesheet.GetResourceProperty( cssValue, "Height", null );
					
					if ( width )
					{
						searchFrame.gAddSearchIconWidth = width;
					}
					
					if ( height )
					{
						searchFrame.gAddSearchIconHeight = height;
					}

					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					searchFrame.gAddSearchIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
				else if ( cssName == "PressedIcon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );
					
					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					searchFrame.gAddSearchSelectedIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
				else if ( cssName == "HoverIcon" )
				{
					cssValue = FMCStripCssUrl( cssValue );
					cssValue = decodeURIComponent( cssValue );
					
					var imgPath	= parent.gRootFolder + parent.gSkinFolder + escape( cssValue );
					
					searchFrame.gAddSearchOverIcon = imgPath;
					FMCPreloadImage( imgPath );
				}
			}
        }
        else if ( styleName == "IndexSearchBox" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );
				var indexFrame	= frames["index"];

				if ( cssName == "Tooltip" )
				{
					if ( cssValue.toLowerCase() == "none" )
					{
						cssValue = "";
					}
					
					indexFrame.gSearchFieldTitle = cssValue;
				}
			}
		}
		else if ( styleName == "SearchResults" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );
				var searchFrame	= frames["search"];

				if ( cssName == "RankLabel" )
				{
					searchFrame.gRankLabel = cssValue;
				}
				else if ( cssName == "TitleLabel" )
				{
					searchFrame.gTitleLabel = cssValue;
				}
			}
		}
		else if ( styleName == "SearchUnfilteredLabel" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );
				var searchFrame	= frames["search"];

				if ( cssName == "Label" )
				{
					searchFrame.gUnfilteredLabel = cssValue;
				}
			}
		}
		else if ( styleName == "Messages" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );

				if ( cssName == "Loading" )
				{
					parent.parent.gLoadingLabel = cssValue;
				}
				else if ( cssName == "LoadingAlternateText" )
				{
					parent.parent.gLoadingAlternateText = cssValue;
				}
				else if ( cssName == "NoTopicsFound" )
				{
					frames["search"].gNoTopicsFoundLabel = cssValue;
				}
				else if ( cssName == "InvalidToken" )
				{
					frames["search"].gInvalidTokenLabel = cssValue;
				}
			}
		}
	}
}

function SetActiveIFrameByName( name )
{
    for ( var i = 0; i < gAccordionItems.length; i++ )
    {
        var accordionItem   = gAccordionItems[i];
        var id              = accordionItem.id;
        
        if ( id.substring( 0, id.lastIndexOf( "Accordion" ) ) == name )
        {
            var itemID  = parseInt( FMCGetMCAttribute( accordionItem, "MadCap:itemID" ) );
            var title   = accordionItem.getElementsByTagName( "a" )[0].firstChild.nodeValue;
            
            SetActiveIFrame( itemID, title );
            SetIFrameHeight();
            
            break;
        }
    }
}

function SetActiveIFrame( id, title )
{
	if ( !gActiveItem )
	{
		return;
	}
	
	if ( gInit )
	{
		var accordionTitle	= parent.frames["mctoolbar"].document.getElementById( "AccordionTitle" );
		
		if ( accordionTitle != null )
		{
			accordionTitle.firstChild.nodeValue = title;
		}
	}
    
    gActiveItem.getElementsByTagName( "td" )[0].style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( gActiveItem, "MadCap:outImage" ) );
    gActiveItem.onmouseout = function () { this.getElementsByTagName( "td" )[0].style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( this, "MadCap:outImage" ) ); };
    gActiveIcon.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( gActiveIcon, "MadCap:outImage" ) );
    gActiveIcon.onmouseout = function () { this.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( this, "MadCap:outImage" ) ); };
    gActiveIFrame.style.zIndex = "1";
    gActiveIFrame.scrolling = "no";
    
    gActiveItem = gAccordionItems[id];
    gActiveItem.onmouseout = null;
    gActiveItem.getElementsByTagName( "td" )[0].style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( gActiveItem, "MadCap:overImage" ) );
    gActiveIcon = gAccordionIcons[id];
    gActiveIcon.onmouseout = null;
    gActiveIcon.style.backgroundImage = FMCCreateCssUrl( FMCGetMCAttribute( gActiveIcon, "MadCap:overImage" ) );
    gActiveIFrame = gIFrames[id];
    gActiveIFrame.style.zIndex = "2";
    gActiveIFrame.scrolling = "auto";
    
    //
    
    // Do this to work around issue with setting focus to text fields in Firefox 1.5. This breaks IE so don't do it there.
    
    if ( gActiveIFrame.focus && !gActiveIFrame.currentStyle )
    {
        gActiveIFrame.focus();
    }
    
    var searchForm		= frames["search"].document.forms["search"];
    var searchFilter	= document.getElementById( "SearchFilter" );
    
    if ( gActiveIFrame.id == "index" )
    {
        frames["index"].document.getElementById( "searchField" ).focus();
    }
    else if ( gActiveIFrame.id == "search" )
    {
		// If focus() is called on searchField when its display is set to "none", IE throws an exception, so put it in a try block
		
		try
		{
			searchForm.searchField.focus();
		}
		catch ( err )
		{
		}
        
        if ( searchFilter )
        {
			searchFilter.style.display = "inline";
        }
    }
    
    //
    
    if ( gActiveIFrame.id != "search" )
    {
		if ( searchFilter )
        {
			searchFilter.style.display = "none";
		}
    }
    
    SetupAccordion();
}

function SetIFrameHeight()
{
    var height  = FMCGetClientHeight( window, true );
    var currTop = height;
    
    var accordionIcons	= document.getElementById( "AccordionIcons" );
    
    currTop -= parseInt( FMCGetComputedStyle( accordionIcons, "height" ) );
    accordionIcons.style.top = currTop + "px";
    
    for ( var i = gAccordionItems.length - 1; i >= 0; i-- )
    {
        if ( i > gVisibleItems - 1 )
        {
            continue;
        }
        
        var accordionItem	= gAccordionItems[i];
        
        currTop -= (accordionItem.style.height ? parseInt( accordionItem.style.height ) : gcAccordionItemHeight);
        accordionItem.style.top = currTop + "px";
    }
    
    var accordionExpander	= document.getElementById( "AccordionExpander" );
    
    currTop -= parseInt( FMCGetComputedStyle( accordionExpander, "height" ) );
    accordionExpander.style.top = currTop + "px";
    
    var navigationTop	= document.getElementById( "NavigationTop" );
    
    currTop -= parseInt( FMCGetComputedStyle( navigationTop, "height" ) );
    
    for ( var i = 0; i < gIFrames.length; i++ )
    {
        var iframe	= gIFrames[i];
        
        if ( iframe == gActiveIFrame )
        {
            iframe.style.height = Math.max( currTop, 0 ) + "px";
            iframe.tabIndex = "2";
        }
        else
        {
            iframe.style.height = "1px";
            iframe.tabIndex = "-1";
        }
    }
    
    var indexFrame	= frames["index"];
    
    indexFrame.document.getElementById( "CatapultIndex" ).parentNode.style.height = Math.max( currTop - 20, 0 ) + "px";
    indexFrame.RefreshIndex();
    
    var searchFrame				= frames["search"];
    var searchResultsTable		= searchFrame.document.getElementById( "searchResultsTable" );
    var searchResultsContainer	= searchFrame.document.getElementById( "SearchResults" ).parentNode;
    
    searchResultsContainer.style.height = Math.max( currTop - searchResultsContainer.offsetTop - 2, 0 ) + "px";
    
    if ( searchResultsTable )
    {
        searchResultsTable.style.width = Math.max( FMCGetClientWidth( window, false ) - 25, 0 ) + "px";
    }
    
    //
    
    if ( gActiveItem )
    {
		var itemID	= parseInt( FMCGetMCAttribute( gActiveItem, "MadCap:itemID" ) );
		var name	= gIFrames[itemID].id;
		var iframe	= frames[name];
		
		if ( !iframe.gInit )
		{
			var fadeElement		= null;
			var parentElement	= iframe.document.body;
			
			switch ( iframe.name )
			{
				case "toc":
					fadeElement = iframe.document.getElementsByTagName( "div" )[1];
					break;
				case "search":
					parentElement = iframe.document.getElementById( "SearchResults" );
					break;
			}
			

			StartLoading( iframe, parentElement, parent.gLoadingLabel, parent.gLoadingAlternateText, fadeElement );
			
			function SetIFrameHeight2()
			{
				iframe.Init( OnInit );
				
				function OnInit()
				{
					if ( name == "search" )
					{
						iframe.document.forms["search"].searchField.focus();
					}

					if ( name != "glossary" || !parent.GetMasterHelpSystem().IsMerged() )
					{
						EndLoading( iframe, fadeElement );
					}
				}
			}

			setTimeout( SetIFrameHeight2, 0 );
		}
    }
}
