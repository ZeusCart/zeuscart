// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

//

gOnloadFuncs.push( Init );

//

var gInit						= false;
var gAboutBoxURL				= null;
var gAboutBoxWidth				= 319;
var gAboutBoxHeight				= 317;
var gAboutBoxAlternateText		= "About";
var gHideNavStartup				= false;
var gTocTitle					= "Table of Contents";
var gIndexTitle					= "Index";
var gSearchTitle				= "Search";
var gGlossaryTitle				= "Glossary";
var gFavoritesTitle				= "Favorites";
var gBrowseSequencesTitle		= "Browse Sequences";
var gTopicCommentsTitle			= "Topic Comments";
var gRecentCommentsTitle		= "Recent Comments";
var gQuickSearchExternalLabel	= "Quick search is disabled in external topics.";
var gQuickSearchIE55			= "Quick search is disabled in Internet Explorer 5.5.";
var gRemoveHighlightIE55Label	= "Remove highlighting is disabled in Internet Explorer 5.5.";

function Init()
{
	if ( gInit )
    {
        return;
    }
    
    //
    
	document.body.tabIndex = gTabIndex++;

	LoadSkin();
	
	//
    
    gInit = true;
}

function LoadSkin()
{
	var xmlDoc		= CMCXmlParser.GetXmlDoc( MCGlobals.RootFolder + FMCGetSkinFolder() + "Skin.xml", false, null, null );
    var buttons		= new Array();
    
    if ( FMCIsLiveHelpEnabled() )
    {
		buttons.push( "TopicRatings" );
		buttons.push( "Separator" );
    }
    
    if ( MCGlobals.NavigationFrame != null )
    {
		buttons.push( "AddTopicToFavorites" );
		buttons.push( "ToggleNavigationPane" );
		buttons.push( "ExpandAll" );
		buttons.push( "CollapseAll" );
		buttons.push( "Print" );
		buttons.push( "Separator" );
		buttons.push( "QuickSearch" );
		buttons.push( "RemoveHighlight" );
		buttons.push( "Separator" );
		buttons.push( "Back" );
		buttons.push( "Forward" );
		buttons.push( "Stop" );
		buttons.push( "Refresh" );
		buttons.push( "Home" );
		buttons.push( "Separator" );
		buttons.push( "SelectTOC" );
		buttons.push( "SelectIndex" );
		buttons.push( "SelectSearch" );
		buttons.push( "SelectGlossary" );
		buttons.push( "SelectFavorites" );
		buttons.push( "SelectBrowseSequence" );
		buttons.push( "SelectTopicComments" );
		buttons.push( "SelectRecentComments" );
    }
    else
    {
		buttons.push( "ExpandAll" );
		buttons.push( "CollapseAll" );
		buttons.push( "Print" );
		buttons.push( "Separator" );
		buttons.push( "QuickSearch" );
		buttons.push( "RemoveHighlight" );
		buttons.push( "Separator" );
		buttons.push( "Back" );
		buttons.push( "Forward" );
		buttons.push( "Stop" );
		buttons.push( "Refresh" );
		buttons.push( "Home" );
    }
    
    if ( FMCIsHtmlHelp() && FMCIsLiveHelpEnabled() )
    {
		buttons.push( "Separator" );
		buttons.push( "SelectRecentComments" );
    }
    
    var toolbarNode	= xmlDoc.getElementsByTagName( "Toolbar" )[0];
    var tabs		= xmlDoc.documentElement.getAttribute( "Tabs" ).toLowerCase();
    var tabsSplit	= xmlDoc.documentElement.getAttribute( "Tabs" ).split( "," );
    
    //
    
    var defaultTab	= xmlDoc.documentElement.getAttribute( "DefaultTab" );
    
    defaultTab = (xmlDoc.documentElement.getAttribute( "Tabs" ).indexOf( defaultTab ) == -1) ? tabsSplit[0] : defaultTab;
    
    if ( MCGlobals.NavigationFrame != null )
    {
		if ( toolbarNode == null || !FMCGetAttributeBool( toolbarNode, "ExcludeAccordionTitle", false ) )
		{
			var buttonsTD			= document.getElementById( "ToolbarButtons" );
			var accordionTitleTD	= document.createElement( "td" );
			
			accordionTitleTD.appendChild( document.createTextNode( defaultTab ) );
			
			buttonsTD.parentNode.insertBefore( accordionTitleTD, buttonsTD );
			
			accordionTitleTD.id = "AccordionTitle";
		}
    }
    
    //
    
    var hsXmlDoc		= CMCXmlParser.GetXmlDoc( MCGlobals.RootFolder + MCGlobals.SubsystemFile, false, null, null );
	var isWebHelpPlus	= hsXmlDoc.documentElement.getAttribute( "TargetType" ) == "WebHelpPlus" && document.location.protocol.StartsWith( "http", false );
	var logoName		= isWebHelpPlus ? "LogoPlus.gif" : FMCIsHtmlHelp() ? "LogoHtmlHelp.gif" : "Logo.gif";
    
    gAboutBoxURL = document.location.href.substring( 0, document.location.href.lastIndexOf( "/" ) ) + "/Images/" + logoName;
    
    //
    
    LoadWebHelpOptions( xmlDoc );
    FMCPreloadImage( gAboutBoxURL );
    LoadStyles( xmlDoc, defaultTab );
    
    //
    
    if ( toolbarNode )
    {
        var enableCustomLayout  = FMCGetAttributeBool( toolbarNode, "EnableCustomLayout", false );
        
        if ( enableCustomLayout )
        {
            var buttonsAttribute    = toolbarNode.getAttribute( "Buttons" );
            
            if ( buttonsAttribute )
            {
                buttons = buttonsAttribute.split( "|" );
            }
            else
            {
                buttons = new Array( 0 );
            }
        }
        
        var scriptNode  = toolbarNode.getElementsByTagName( "Script" )[0];
        
        if ( scriptNode )
        {
            var scriptHtmlNode  = document.createElement( "script" );
            
            scriptHtmlNode.type = "text/javascript";
            scriptHtmlNode.src = "../" + FMCGetSkinFolder() + "Skin.js";
            
            document.getElementsByTagName( "head" )[0].appendChild( scriptHtmlNode );
        }
    }
    
    // Cache toolbar styles
    
    var styleDoc        = CMCXmlParser.GetXmlDoc( "../" + FMCGetSkinFolder() + "Stylesheet.xml", false, null, null );
    var styles          = styleDoc.getElementsByTagName( "Style" );
    var toolbarStyleMap = new CMCDictionary();
    
    for ( var i = 0; i < styles.length; i++ )
    {
        if ( styles[i].getAttribute( "Name" ) == "ToolbarItem" )
        {
            var styleClasses    = styles[i].getElementsByTagName( "StyleClass" );
            
            for ( var j = 0; j < styleClasses.length; j++ )
            {
                var styleClass  = styleClasses[j];
                
                toolbarStyleMap.Add( styleClass.getAttribute( "Name" ), styleClass.getElementsByTagName( "Property" ) );
            }
        }
    }

    //

	var tdButtons	= document.getElementById( "ToolbarButtons" );
	var table		= document.createElement( "table" );
	var tbody		= document.createElement( "tbody" );
	var tr			= document.createElement( "tr" );

    //

	if ( !tabs )
	{
		ShowHideNavigation( false );
	}

    //

    for ( var i = 0; i < buttons.length; i++ )
    {
		var isToggle	= false;
        var button		= buttons[i];
        var td			= document.createElement( "td" );
        var controlType	= null;
        var props		= toolbarStyleMap.GetItem( button );
        
        for ( var j = 0; props && j < props.length; j++ )
        {
            if ( props[j].getAttribute( "Name" ) == "ControlType" )
            {
                controlType = FMCGetPropertyValue( props[j], null );
            }
        }
        
        tr.appendChild( td );
        
        switch ( controlType )
        {
			case "TopicRatings":
				if ( !FMCIsLiveHelpEnabled() && !FMCIsSkinPreviewMode() )
				{
					tr.removeChild( td );
					continue;
				}
				
                var span	= document.createElement( "span" );
                
                span.id = "RatingIcons";
                span.title = "Topic Rating";
                span.onclick = FMCIsSkinPreviewMode() ? null : FMCTopicRatingIconsOnclick;
                span.onmousemove = FMCTopicRatingIconsOnmousemove;
                span.onmouseout = FMCTopicClearRatingIcons;
                span.style.fontSize = "1px";
                
                var img	= document.createElement( "img" );
                
                CMCFlareStylesheet.SetImageFromStylesheet( img, "ToolbarItem", "TopicRatings", "EmptyIcon", "Images/Rating0.gif", 16, 16 );
				
				span.appendChild( img );
				span.appendChild( img.cloneNode( true ) );
				span.appendChild( img.cloneNode( true ) );
				span.appendChild( img.cloneNode( true ) );
				span.appendChild( img.cloneNode( true ) );
				
				span.tabIndex = gTabIndex++;
				
				td.style.width = "80px";
				td.appendChild( span );
                
                break;
            case "AddTopicToFavorites":
                if ( tabs.indexOf( "favorites" ) == -1 ) { tr.removeChild( td ); continue; };
                
                MakeButton( td, "Add topic to favorites", "Images/AddTopicToFavorites.gif", "Images/AddTopicToFavorites_over.gif", "Images/AddTopicToFavorites_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = function() { AddToFavorites(); };
                
                break;
            case "ToggleNavigationPane":
                if ( !tabs ) { tr.removeChild( td ); continue; }

                var title			= gHideNavigationTitle;
                var outImage		= "Images/HideNavigation.gif";
                var checkedImage	= "Images/HideNavigation_checked.gif";
                
                if ( gHideNavStartup )
                {
					title = gShowNavigationTitle;
					outImage = "Images/HideNavigation_checked.gif";
					checkedImage = "Images/HideNavigation.gif";
                }
                
                MakeButton( td, title, outImage, "Images/HideNavigation_over.gif", "Images/HideNavigation_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                var div	= td.getElementsByTagName( "div" )[0];
                
                FMCPreloadImage( checkedImage );
                div.setAttribute( "MadCap:checkedImage", checkedImage );
                div.onclick = function() { ShowHideNavigation( true ); };
                div.id = "ToggleNavigationButton";
                
                isToggle = true;
                
                break;
            case "ExpandAll":
                MakeButton( td, "Expand all", "Images/Expand.gif", "Images/Expand_over.gif", "Images/Expand_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = function( e ) { ExpandAll( "open" ); };
                
                break;
            case "CollapseAll":
                MakeButton( td, "Collapse all", "Images/Collapse.gif", "Images/Collapse_over.gif", "Images/Collapse_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = function( e ) { ExpandAll( "close" ); };
                
                break;
            case "Print":
                MakeButton( td, "Print topic", "Images/Print.gif", "Images/Print_over.gif", "Images/Print_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = PrintTopic;
                
                break;
            case "QuickSearch":
                var tdQS    = document.createElement( "td" );
                var form    = document.createElement( "form" );
                var input   = document.createElement( "input" );
                
                tdQS.style.width = "150px";
                form.onsubmit = function() { QuickSearch(); return false; };
                input.id = "quickSearchField";
                input.type = "text";
                input.tabIndex = gTabIndex++;
                input.title = "Quick search text box";
                
                form.appendChild( input );
                tdQS.appendChild( form );
                tr.insertBefore( tdQS, td );
                
                MakeButton( td, "Quick search", "Images/QuickSearch.gif", "Images/QuickSearch_over.gif", "Images/QuickSearch_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = function() { QuickSearch(); };
                
                break;
            case "RemoveHighlight":
                MakeButton( td, "Remove search highlighting", "Images/Highlight.gif", "Images/Highlight_over.gif", "Images/Highlight_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = RemoveHighlight;
                
                break;
            case "Back":
                MakeButton( td, "Back", "Images/Back.gif", "Images/Back_over.gif", "Images/Back_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = function() { MCGlobals.BodyFrame.window.history.go( -1 ); };
                
                break;
            case "Forward":
                MakeButton( td, "Forward", "Images/Forward.gif", "Images/Forward_over.gif", "Images/Forward_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = function() { MCGlobals.BodyFrame.window.history.go( 1 ); };
                
                break;
            case "Stop":
                MakeButton( td, "Stop", "Images/Stop.gif", "Images/Stop_over.gif", "Images/Stop_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = function()
                {
                    if ( window.stop )
                    {
                        MCGlobals.BodyFrame.window.stop();
                    }
                    else if ( document.execCommand )
                    {
                        MCGlobals.BodyFrame.window.document.execCommand( "Stop" );
                    }
                };
                
                break;
            case "Refresh":
                MakeButton( td, "Refresh", "Images/Refresh.gif", "Images/Refresh_over.gif", "Images/Refresh_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = function() { MCGlobals.BodyFrame.window.history.go( 0 ); };
                
                break;
            case "Home":
                MakeButton( td, "Home", "Images/Home.gif", "Images/Home_over.gif", "Images/Home_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                td.getElementsByTagName( "div" )[0].onclick = NavigateHome;
                
                break;
            case "SelectTOC":
				var pos	= tabs.indexOf( "toc" );
				
                if ( pos == -1 ) { tr.removeChild( td ); continue; };
                
                MakeButton( td, gTocTitle, "Images/SelectToc.gif", "Images/SelectToc_over.gif", "Images/SelectToc_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                var div	= td.getElementsByTagName( "div" )[0];
                
                div.onclick = function() { SelectIconClick( this ); };
                div.id = "tocSelect";
                div.setAttribute( "MadCap:itemID", tabs.substring( 0, pos ).split( "," ).length - 1 );
                div.setAttribute( "MadCap:title", gTocTitle );
                
                break;
            case "SelectIndex":
				var pos	= tabs.indexOf( "index" );
				
                if ( pos == -1 ) { tr.removeChild( td ); continue; };
                
                MakeButton( td, gIndexTitle, "Images/SelectIndex.gif", "Images/SelectIndex_over.gif", "Images/SelectIndex_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                var div	= td.getElementsByTagName( "div" )[0];
                
                div.onclick = function() { SelectIconClick( this ); };
                div.id = "indexSelect";
                div.setAttribute( "MadCap:itemID", tabs.substring( 0, pos ).split( "," ).length - 1 );
                div.setAttribute( "MadCap:title", gIndexTitle );
                
                break;
            case "SelectSearch":
                var pos	= tabs.indexOf( "search" );
				
                if ( pos == -1 ) { tr.removeChild( td ); continue; };
                
                MakeButton( td, gSearchTitle, "Images/SelectSearch.gif", "Images/SelectSearch_over.gif", "Images/SelectSearch_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                var div	= td.getElementsByTagName( "div" )[0];
                
                div.onclick = function() { SelectIconClick( this ); };
                div.id = "searchSelect";
                div.setAttribute( "MadCap:itemID", tabs.substring( 0, pos ).split( "," ).length - 1 );
                div.setAttribute( "MadCap:title", gSearchTitle );
                
                break;
            case "SelectGlossary":
                var pos	= tabs.indexOf( "glossary" );
				
                if ( pos == -1 ) { tr.removeChild( td ); continue; };
                
                MakeButton( td, gGlossaryTitle, "Images/SelectGlossary.gif", "Images/SelectGlossary_over.gif", "Images/SelectGlossary_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                var div	= td.getElementsByTagName( "div" )[0];
                
                div.onclick = function() { SelectIconClick( this ); };
                div.id = "glossarySelect";
                div.setAttribute( "MadCap:itemID", tabs.substring( 0, pos ).split( "," ).length - 1 );
                div.setAttribute( "MadCap:title", gGlossaryTitle );
                
                break;
            case "SelectFavorites":
                var pos	= tabs.indexOf( "favorites" );
				
                if ( pos == -1 ) { tr.removeChild( td ); continue; };
                
                MakeButton( td, gFavoritesTitle, "Images/SelectFavorites.gif", "Images/SelectFavorites_over.gif", "Images/SelectFavorites_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                var div	= td.getElementsByTagName( "div" )[0];
                
                div.onclick = function() { SelectIconClick( this ); };
                div.id = "favoritesSelect";
                div.setAttribute( "MadCap:itemID", tabs.substring( 0, pos ).split( "," ).length - 1 );
                div.setAttribute( "MadCap:title", gFavoritesTitle );
                
                break;
            case "SelectBrowseSequence":
                var pos	= tabs.indexOf( "browsesequences" );
				
                if ( pos == -1 ) { tr.removeChild( td ); continue; };
                
                MakeButton( td, gBrowseSequencesTitle, "Images/SelectBrowsesequences.gif", "Images/SelectBrowsesequences_over.gif", "Images/SelectBrowsesequences_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                var div	= td.getElementsByTagName( "div" )[0];
                
                div.onclick = function() { SelectIconClick( this ); };
                div.id = "browsesequencesSelect";
                div.setAttribute( "MadCap:itemID", tabs.substring( 0, pos ).split( "," ).length - 1 );
                div.setAttribute( "MadCap:title", gBrowseSequencesTitle );
                
                break;
            case "SelectTopicComments":
                var pos	= tabs.indexOf( "topiccomments" );
				
                if ( pos == -1 ) { tr.removeChild( td ); continue; };
                
                MakeButton( td, gTopicCommentsTitle, "Images/SelectTopiccomments.gif", "Images/SelectTopiccomments_over.gif", "Images/SelectTopiccomments_selected.gif", 23, 22, String.fromCharCode( 160 ) );
                
                var div	= td.getElementsByTagName( "div" )[0];
                
                div.onclick = function() { SelectIconClick( this ); };
                div.id = "topiccommentsSelect";
                div.setAttribute( "MadCap:itemID", tabs.substring( 0, pos ).split( "," ).length - 1 );
                div.setAttribute( "MadCap:title", gTopicCommentsTitle );
                
                break;
            case "SelectRecentComments":
				if ( FMCIsHtmlHelp() )
				{
					MakeButton( td, "Go to Recent Comments", "Images/SelectRecentcomments.gif", "Images/SelectRecentcomments_over.gif", "Images/SelectRecentcomments_selected.gif", 23, 22, String.fromCharCode( 160 ) );

					td.getElementsByTagName( "div" )[0].onclick = RecentCommentsOnclick;
				}
				else
				{
					var pos	= tabs.indexOf( "recentcomments" );
					
					if ( pos == -1 ) { tr.removeChild( td ); continue; };
	                
					MakeButton( td, gRecentCommentsTitle, "Images/SelectRecentcomments.gif", "Images/SelectRecentcomments_over.gif", "Images/SelectRecentcomments_selected.gif", 23, 22, String.fromCharCode( 160 ) );
	                
					var div	= td.getElementsByTagName( "div" )[0];
	                
					div.onclick = function() { SelectIconClick( this ); };
					div.id = "recentcommentsSelect";
					div.setAttribute( "MadCap:itemID", tabs.substring( 0, pos ).split( "," ).length - 1 );
					div.setAttribute( "MadCap:title", gRecentCommentsTitle );
				}
                
                break;
            case "Separator":
                var div	= document.createElement( "div" );
                var img	= document.createElement( "img" );
                
                img.src = "Images/Separator.gif";
                img.alt = "Separator";
                img.style.width = "2px";
                img.style.height = "22px";
                
                div.appendChild( img );
                td.appendChild( div );
                
                td.style.width = "2px";
                td.style.height = "22px";
                
                break;
            case "Button":
                MakeButton( td, button, null, null, null, 0, 0, String.fromCharCode( 160 ) );
                
                break;
            case "Text":
                var tempSpan    = document.createElement( "span" );
                
                tempSpan.appendChild( document.createTextNode( button ) );
                document.body.appendChild( tempSpan );
                
                var tempSpanWidth   = tempSpan.offsetWidth;
                var tempSpanHeight  = tempSpan.offsetHeight;
                
                document.body.removeChild( tempSpan );
                
                MakeButton( td, null, null, null, null, tempSpanWidth, tempSpanHeight, button );
                
                break;
            default: // Default to text control type
				var tempSpan    = document.createElement( "span" );
                
                tempSpan.appendChild( document.createTextNode( button ) );
                document.body.appendChild( tempSpan );
                
                var tempSpanWidth   = tempSpan.offsetWidth;
                var tempSpanHeight  = tempSpan.offsetHeight;
                
                document.body.removeChild( tempSpan );
                
                MakeButton( td, null, null, null, null, tempSpanWidth, tempSpanHeight, button );
                
                break;
        }
        
        var div	= td.getElementsByTagName( "div" )[0];
        
        if ( !div )
        {
			div = td.getElementsByTagName( "span" )[0];
        }
        
        div.onkeyup = ItemOnkeyup;
        ApplyStyleToControl( div, button, toolbarStyleMap, isToggle );
    }
    
    tbody.appendChild( tr );
    table.appendChild( tbody );
    tdButtons.appendChild( table );
    
    // Apply style to accordion title and logo
    
    if ( MCGlobals.NavigationFrame != null )
    {
		var accordionTitle  = document.getElementById( "AccordionTitle" );
		
		if ( accordionTitle != null )
		{
			var titleProps  = toolbarStyleMap.GetItem( "AccordionTitle" );
		    
			if ( titleProps )
			{
				for ( var i = 0; i < titleProps.length; i++ )
				{
					var propName    = titleProps[i].getAttribute( "Name" );
					var propValue   = FMCGetPropertyValue( titleProps[i], null );
		            
					propName = propName.charAt( 0 ).toLowerCase() + propName.substring( 1, propName.length );
		            
					if ( propName == "onClick" )
					{
						accordionTitle.onclick = new Function( propValue );
					}
					else
					{
						accordionTitle.style[propName] = propValue;
					}
				}
			}
		}
	}
    
    //
    
    var td			= document.createElement( "td" );
    var tdFiller	= document.createElement( "td" );
    var img			= document.createElement( "img" );
    
    td.id = "logoIcon";
    td.style.width = "111px";
    td.style.textAlign = "right";
    
    img.src = "Images/LogoIcon.gif";
    img.alt = "Logo icon";
    img.style.width = "111px";
    img.style.height = "24px";
    img.onclick = DisplayAbout;
    
    td.appendChild( img );
    tr.appendChild( tdFiller );
    tr.appendChild( td );
    
    var logoProps   = toolbarStyleMap.GetItem( "Logo" );
    
    if ( logoProps )
    {
        for ( var i = 0; i < logoProps.length; i++ )
        {
            var propName    = logoProps[i].getAttribute( "Name" );
            var propValue   = FMCGetPropertyValue( logoProps[i], null );
            
            propName = propName.charAt( 0 ).toLowerCase() + propName.substring( 1, propName.length );
            
            if ( propName == "icon" )
            {
                if ( propValue == "none" )
                {
                    td.parentNode.removeChild( td );
                }
                else
                {
					propValue = FMCStripCssUrl( propValue );
					propValue = decodeURIComponent( propValue );
					
                    var width	= CMCFlareStylesheet.GetResourceProperty( propValue, "Width", null );
					var height	= CMCFlareStylesheet.GetResourceProperty( propValue, "Height", null );
					
					if ( width )
					{
						img.style.width = width + "px";
						img.parentNode.style.width = width + "px";
					}
					
					if ( height )
					{
						img.style.height = height + "px";
					}
                    
                    img.src = "../" + FMCGetSkinFolder() + escape( propValue );
                }
            }
            else if ( propName == "onClick" )
            {
                img.onclick = new Function( propValue );
            }
            else if ( propName == "logoAlternateText" )
            {
                img.alt = propValue;
            }
            else if ( propName == "aboutBoxAlternateText" )
            {
                gAboutBoxAlternateText = propValue;
            }
        }
    }
}

function ApplyStyleToControl( div, button, toolbarStyleMap, isToggle )
{
	// Apply style to control

	var props		= toolbarStyleMap.GetItem( button );
	var width		= 0;
	var height		= 0;
	var isButton	= false;

	for ( var j = 0; props && j < props.length; j++ )
	{
		var prop        = props[j];
		var propName    = prop.getAttribute( "Name" );
		var propValue   = FMCGetPropertyValue( prop, null );

		if ( propName == "Label" )
		{
			if ( propValue )
			{
				div.firstChild.nodeValue = propValue;
			}
		}
		else if ( propName == "Tooltip" )
		{
			if ( propValue.toLowerCase() == "none" )
			{
				propValue = "";
			}

			if ( isToggle )
			{
				gHideNavigationTitle = propValue;

				if ( !gHideNavStartup )
				{
					div.title = propValue;
				}
            }
            else
            {
				div.title = propValue;
            }
		}
		else if ( propName == "Icon" )
		{
			propValue = FMCStripCssUrl( propValue );
			propValue = decodeURIComponent( propValue );

            var width	= CMCFlareStylesheet.GetResourceProperty( propValue, "Width", null );
			var height	= CMCFlareStylesheet.GetResourceProperty( propValue, "Height", null );
			
			if ( width )
			{
				div.setAttribute( "MadCap:width", width );
			}
			
			if ( height )
			{
				div.setAttribute( "MadCap:height", height );
			}

			var imgPath	= "../" + FMCGetSkinFolder() + escape( propValue );
			
			div.setAttribute( "MadCap:outImage", imgPath );
			FMCPreloadImage( imgPath );

			isButton = true;
		}
		else if ( propName == "PressedIcon" )
		{
			propValue = FMCStripCssUrl( propValue );
			propValue = decodeURIComponent( propValue );
			
			var imgPath	= "../" + FMCGetSkinFolder() + escape( propValue );
			
			div.setAttribute( "MadCap:selectedImage", imgPath );
			FMCPreloadImage( imgPath );
		}
		else if ( propName == "HoverIcon" )
		{
			propValue = FMCStripCssUrl( propValue );
			propValue = decodeURIComponent( propValue );
			
			var imgPath	= "../" + FMCGetSkinFolder() + escape( propValue );
			
			div.setAttribute( "MadCap:overImage", imgPath );
			FMCPreloadImage( imgPath );
		}
		else if ( propName == "CheckedIcon" )
		{
			propValue = FMCStripCssUrl( propValue );
			propValue = decodeURIComponent( propValue );
			
			var imgPath	= "../" + FMCGetSkinFolder() + escape( propValue );
			
			div.setAttribute( "MadCap:checkedImage", imgPath );
			FMCPreloadImage( imgPath );
		}
		else if ( propName == "OnClick" )
		{
			div.onclick = new Function( propValue );
		}
		else if ( propName == "SearchBoxTooltip" )
		{
			if ( propValue.toLowerCase() == "none" )
			{
				propValue = "";
			}
			
			div.parentNode.previousSibling.firstChild.firstChild.title = propValue;
		}
		else if ( propName == "ShowTooltip" )
		{
			if ( propValue.toLowerCase() == "none" )
			{
				propValue = "";
			}
			
			gShowNavigationTitle = propValue;

			if ( gHideNavStartup )
            {
				div.title = propValue;
            }
		}
		else if ( propName == "SeparatorAlternateText" )
		{
			div.getElementsByTagName( "img" )[0].alt = propValue;
		}
		else
		{
			var cssName = propName.charAt( 0 ).toLowerCase() + propName.substring( 1 );
	        
			div.style[cssName] = propValue;
		}
	}

	if ( isButton )
	{
		InitButton( div );
	}
}

function LoadStyles( xmlDoc, defaultTab )
{
    var styleSheet	= xmlDoc.getElementsByTagName( "Stylesheet" )[0];
    
    if ( styleSheet )
    {
        var styleSheetLink	= styleSheet.getAttribute( "Link" );
        
        if ( styleSheetLink )
        {
            xmlDoc = CMCXmlParser.GetXmlDoc( "../" + FMCGetSkinFolder() + styleSheetLink, false, null, null );
            
            var styles	= xmlDoc.getElementsByTagName( "Style" );
            
            for ( var i = 0; i < styles.length; i++ )
            {
                var styleName   = styles[i].getAttribute( "Name" );
                
                if ( MCGlobals.NavigationFrame != null && styleName == "AccordionItem" )
                {
                    LoadAccordionItemStyle( styles[i], defaultTab );
                }
                else if ( styleName == "Frame" )
                {
                    LoadFrameStyle( styles[i] );
                }
                else if ( styleName == "Control" )
				{
					LoadControlStyle( styles[i] );
				}
            }
        }
    }
}

function LoadAccordionItemStyle( accordionItemStyle, defaultTab )
{
    var styleClasses	= accordionItemStyle.getElementsByTagName( "StyleClass" );
    
    for ( var i = 0; i < styleClasses.length; i++ )
    {
        var styleName	= styleClasses[i].getAttribute( "Name" );
        var properties	= styleClasses[i].getElementsByTagName( "Property" );
        var title		= null;
        
        if ( styleName == "BrowseSequence" )
        {
			styleName = "BrowseSequences";
        }
        
        for ( var j = 0; j < properties.length; j++ )
        {
            var cssName		= properties[j].getAttribute( "Name" );
            var cssValue	= FMCGetPropertyValue( properties[j], null );
            
            if ( cssName == "Label" )
            {
				title = cssValue;
				
				switch ( styleName.toLowerCase() )
				{
					case "toc":
						gTocTitle = title;
						break;
					case "index":
						gIndexTitle = title;
						break;
					case "search":
						gSearchTitle = title;
						break;
					case "glossary":
						gGlossaryTitle = title;
						break;
					case "favorites":
						gFavoritesTitle = title;
						break;
					case "browsesequences":
						gBrowseSequencesTitle = title;
						break;
					case "topiccomments":
						gTopicCommentsTitle = title;
						break;
					case "recentcomments":
						gRecentCommentsTitle = title;
						break;
				}
            }
        }
        
        if ( styleName == defaultTab && title != null )
        {
			var accordionTitle	= document.getElementById( "AccordionTitle" );
			
			if ( accordionTitle != null )
			{
				accordionTitle.firstChild.nodeValue = title;
			}
        }
    }
}

function LoadFrameStyle( frameStyle )
{
    var styleClasses    = frameStyle.getElementsByTagName( "StyleClass" );
    
    for ( var i = 0; i < styleClasses.length; i++ )
    {
        var name    = styleClasses[i].getAttribute( "Name" );
        
        if ( name == "Toolbar" )
        {
			var properties	= styleClasses[i].getElementsByTagName( "Property" );
			
			for ( var j = 0; j < properties.length; j++ )
			{
				var propName	= properties[j].getAttribute( "Name" );
				
				if ( propName == "BackgroundGradient" )
				{
					document.body.style.backgroundImage = FMCCreateCssUrl( "../" + FMCGetSkinFolder() + "ToolbarBackground.jpg" );
				}
				else if ( propName == "Height" )
				{
					var height		= FMCGetPropertyValue( properties[j], null );
					var heightPx	= FMCConvertToPx( document, height, "Height", 28 );

					if ( FMCIsHtmlHelp() )
					{
						var iframe	= parent.document.getElementById( "mctoolbar" );
						
						iframe.style.height = heightPx + "px";
					}
					else
					{
						var frameset	= null;
						
						if ( gNavPosition == "Left" || gNavPosition == "Right" )
						{
							frameset = gOuterFrameset;
						}
						else if ( gNavPosition == "Top" || gNavPosition == "Bottom" )
						{
							frameset = gInnerFrameset;
						}
						
						frameset.rows = heightPx + ", *";
					}
					
					document.getElementsByTagName( "table" )[0].style.height = heightPx + "px";
				}
			}
        }
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
        
		if ( styleName == "Messages" )
        {
			for ( var j = 0; j < properties.length; j++ )
			{
				var property	= properties[j];
				var cssName		= property.getAttribute( "Name" );
				var cssValue	= FMCGetPropertyValue( property, null );

				if ( cssName == "QuickSearchExternal" )
				{
					gQuickSearchExternalLabel = cssValue;
				}
				else if ( cssName == "QuickSearchIE5.5" )
				{
					gQuickSearchIE55 = cssValue;
				}
				else if ( cssName == "RemoveHighlightIE5.5" )
				{
					gRemoveHighlightIE55Label = cssValue;
				}
			}
		}
	}
}

function LoadWebHelpOptions( xmlDoc )
{
    var webHelpOptions  = xmlDoc.getElementsByTagName( "WebHelpOptions" )[0];
    
    if ( webHelpOptions )
    {
        var aboutBox    = webHelpOptions.getAttribute( "AboutBox" );
        
        if ( aboutBox )
        {
            gAboutBoxURL = MCGlobals.RootFolder + FMCGetSkinFolder() + aboutBox;
            gAboutBoxWidth = parseInt( webHelpOptions.getAttribute( "AboutBoxWidth" ) );
            gAboutBoxHeight = parseInt( webHelpOptions.getAttribute( "AboutBoxHeight" ) );
        }
        
        if ( MCGlobals.NavigationFrame != null )
        {
			var navWidth	= 200;
	        
			if ( webHelpOptions.getAttribute( "NavigationPaneWidth" ) )
			{
				navWidth = parseInt( webHelpOptions.getAttribute( "NavigationPaneWidth" ) );
				
				if ( navWidth == 0 )
				{
					navWidth = 200;
				}
			}
			
			if ( webHelpOptions.getAttribute( "NavigationPanePosition" ) )
			{
				gNavPosition = webHelpOptions.getAttribute( "NavigationPanePosition" );
			}
	        
			var accordionTitle	= document.getElementById( "AccordionTitle" );
	        
	        if ( accordionTitle != null )
	        {
				accordionTitle.style.width = Math.max( navWidth, 0 ) + "px";
	        
				if ( gNavPosition == "Top" || gNavPosition == "Bottom" )
				{
					accordionTitle.style.display = "none";
				}
				else if ( gNavPosition == "Right" )
				{
					var tr	= accordionTitle.parentNode;
		            
					tr.removeChild( accordionTitle );
					tr.appendChild( accordionTitle );
				}
			}
			
			gHideNavStartup = FMCGetAttributeBool( webHelpOptions, "HideNavigationOnStartup", false );
			
			if ( gHideNavStartup )
			{
				ShowHideNavigation( false );
			}
		}
    }
}

function SelectIconClick( node )
{
	var navFrame    = MCGlobals.NavigationFrame;

	navFrame.SetActiveIFrame( parseInt( FMCGetMCAttribute( node, "MadCap:itemID" ) ), FMCGetMCAttribute( node, "MadCap:title" ) );
	navFrame.SetIFrameHeight();

	if ( gNavigationState > 0 )
	{
		ShowHideNavigation( true );
	}

	var toggleButton	= document.getElementById( "ToggleNavigationButton" );

	if ( toggleButton != null )
	{
		toggleButton.onmouseout();	// Force onmouseout() to fire so that image gets flipped back to "hide" state
	}
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

function AddToFavorites()
{
    var favoritesFrame  = MCGlobals.NavigationFrame.frames["favorites"];
    var bodyFrame       = MCGlobals.BodyFrame;
    var title           = bodyFrame.document.title;
    var value;
    var href            = bodyFrame.location.href;
    
    if ( href.indexOf( "?" ) != -1 )
    {
        href = href.substring( 0, href.indexOf( "?" ) );
    }
    
    if ( !title )
    {
        value = href.substring( href.lastIndexOf( "/" ) + 1, href.length ) + "|" + href;
    }
    else
    {
        value = title + "|" + href;
    }

    function OnInit()
    {
		favoritesFrame.FMCAddToFavorites( "topics", value );
		favoritesFrame.FMCLoadTopicsFavorites();
    }
    
    favoritesFrame.Init( OnInit );
}

function DisplayAbout()
{
    var bodyFrame = MCGlobals.BodyFrame;
    
    if ( !bodyFrame.document.getElementById( "About" ) )
    {
        var imgAbout    = bodyFrame.document.createElement( "img" );
        
        bodyFrame.document.body.appendChild( imgAbout );
        
        var clientCenter	= FMCGetClientCenter( bodyFrame );
        
        imgAbout.id = "About";
        imgAbout.src = gAboutBoxURL;
        imgAbout.alt = gAboutBoxAlternateText;
        imgAbout.style.display = "none";
        imgAbout.style.width = gAboutBoxWidth;
        imgAbout.style.height = gAboutBoxHeight;
        imgAbout.style.position = "absolute";
        imgAbout.style.left = (clientCenter[0] - (gAboutBoxWidth / 2)) + "px";
        imgAbout.style.top = (clientCenter[1] - (gAboutBoxHeight / 2)) + "px";
        imgAbout.style.zIndex = "5";
        imgAbout.style.border = "none";
        imgAbout.style.background = "none";
        imgAbout.style.display = "";
        
        //
        
        gPopupObj = imgAbout;
        gPopupBGObj = null;
        
        if ( gPopupObj.filters )
        {
            gPopupObj.style.filter = "alpha( opacity = 0 )";
        }
        else if ( gPopupObj.style.MozOpacity != null )
        {
            gPopupObj.style.MozOpacity = "0.0";
        }
        
        gFadeID = setInterval( "FMCFade()", 10 );
        
        //
        
        if ( document.body.setCapture )
        {
            document.body.setCapture();
            
            document.body.onmousedown = RemoveAbout;
        }
        else if ( document.addEventListener )
        {
            var navFrame    = MCGlobals.NavigationFrame;
            
            document.addEventListener( "mousedown", RemoveAbout, true );
            navFrame.document.addEventListener( "mousedown", RemoveAbout, true );
            navFrame.frames[navFrame.gActiveIFrame.id].document.addEventListener( "mousedown", RemoveAbout, true );
            MCGlobals.BodyFrame.document.addEventListener( "mousedown", RemoveAbout, true );
        }
    }
}

function RemoveAbout()
{
    var imgAbout    = MCGlobals.BodyFrame.document.getElementById( "About" );
    
    imgAbout.parentNode.removeChild( imgAbout );
    
    if ( document.body.releaseCapture )
    {
        document.body.releaseCapture();
        
        document.body.onmousedown = null;
    }
    else if ( document.removeEventListener )
    {
        var navFrame    = MCGlobals.NavigationFrame;
        
        document.removeEventListener( "mousedown", RemoveAbout, true );
        navFrame.document.removeEventListener( "mousedown", RemoveAbout, true );
        navFrame.frames[navFrame.gActiveIFrame.id].document.removeEventListener( "mousedown", RemoveAbout, true );
        MCGlobals.BodyFrame.document.removeEventListener( "mousedown", RemoveAbout, true );
    }
}

function ExpandAll( swapType )
{
    if ( MCGlobals.BodyFrame.FMCExpandAll )
    {
        MCGlobals.BodyFrame.FMCExpandAll( swapType );
    }
}

function QuickSearch()
{
	if ( FMCIsIE55() )
	{
		alert( gQuickSearchIE55 );
		
		return;
	}
	
    var bodyFrame	= MCGlobals.BodyFrame;

    try
    {
        parent.FMCClearSearch( bodyFrame );
        parent.FMCHighlight( bodyFrame, document.getElementById( "quickSearchField" ).value, parent.gColorTable[0], false );
    }
    catch ( err )
    {
        alert( gQuickSearchExternalLabel );
    }
}

function RemoveHighlight()
{
	if ( FMCIsIE55() )
	{
		alert( gRemoveHighlightIE55Label );
		
		return;
	}
	
	try
	{
		parent.FMCClearSearch( MCGlobals.BodyFrame );
	}
	catch ( err )
	{
		alert( gQuickSearchExternalLabel );
	}
}

function PrintTopic()
{
	var bodyFrame	= MCGlobals.BodyFrame;
	
	bodyFrame.focus();
	bodyFrame.print();
}

function NavigateHome()
{
	var baseFolder	= "../Content/";
	
	if ( FMCIsHtmlHelp() )
	{
		baseFolder = "/";
	}
	
	MCGlobals.BodyFrame.document.location.href = baseFolder + MCGlobals.DefaultStartTopic;
}

var gIntervalID             = null;
var gNavigationState        = -30;
var gNavigationWidth;
var gNavPosition            = "Left";
var gSlide                  = true;
var gChanging               = false;
var gOuterFrameset          = parent.document.getElementsByTagName( "frameset" )[0];
var gInnerFrameset          = parent.document.getElementsByTagName( "frameset" )[1];
var gToolbarFrameNode       = null;
var gNavigationFrameNode    = null;
var gBodyFrameNode          = null;
var gHideNavigationTitle	= "Hide navigation";
var gShowNavigationTitle	= "Show navigation";

{
    var frameNodes  = parent.document.getElementsByTagName( "frame" );
    
    for ( var i = 0; i < frameNodes.length; i++ )
    {
        var currName    = frameNodes[i].name;
        
        switch ( currName )
        {
            case "mctoolbar":
                gToolbarFrameNode = frameNodes[i];
                break;
            case "navigation":
                gNavigationFrameNode = frameNodes[i];
                break;
            case "body":
                gBodyFrameNode = frameNodes[i];
                break;
        }
    }
}

function RecentCommentsOnclick()
{
	MCGlobals.BodyFrame.document.location.href = "RecentComments.htm";
}

function ShowHideNavigation( slide )
{
	if ( gInnerFrameset == null || gOuterFrameset == null || gBodyFrameNode == null )
	{
		return;
	}
	
    if ( gChanging )
    {
        return;
    }
    
    gChanging = true;
    gSlide = slide;
    
    var navButton   = document.getElementById( "ToggleNavigationButton" );
    
    if ( navButton )
    {
        if ( gNavigationState < 0 )  // Hiding
        {
            navButton.title = gShowNavigationTitle;
            
            var checkedImage	= FMCGetMCAttribute( navButton, "MadCap:checkedImage" );
            
            navButton.setAttribute( "MadCap:checkedImage", FMCGetMCAttribute( navButton, "MadCap:outImage" ) );
            navButton.setAttribute( "MadCap:outImage", checkedImage );
            
            gNavigationFrameNode.tabIndex = "-1";
        }
        else                         // Showing
        {
            navButton.title = gHideNavigationTitle;
            
            var checkedImage	= FMCGetMCAttribute( navButton, "MadCap:checkedImage" );
            
            navButton.setAttribute( "MadCap:checkedImage", FMCGetMCAttribute( navButton, "MadCap:outImage" ) );
            navButton.setAttribute( "MadCap:outImage", checkedImage );
            
            gNavigationFrameNode.tabIndex = "0";
        }
    }
    
    if ( gNavPosition == "Left" || gNavPosition == "Right" )
    {
        ShowHideNavigationHorizontal();
    }
    else
    {
        ShowHideNavigationVertical();
    }
}

function ShowHideNavigationHorizontal()
{
    if ( gNavigationState < 0 )  // Hiding
    {
        var cols    = gInnerFrameset.cols;
        
        if ( gNavPosition == "Left" )
        {
            gNavigationWidth = parseInt( cols );
        }
        else if ( gNavPosition == "Right" )
        {
            gNavigationWidth = parseInt( cols.substring( cols.indexOf( "," ) + 1 ) );
        }
    }
    else                         // Showing
    {
        gInnerFrameset.setAttribute( "border", 4 );
        gInnerFrameset.setAttribute( "frameSpacing", 2 )
        gBodyFrameNode.setAttribute( "frameBorder", 1 );
        
        var accordionTitle	= document.getElementById( "AccordionTitle" );
        
        if ( accordionTitle != null )
        {
			accordionTitle.style.display = (document.defaultView && document.defaultView.getComputedStyle) ? "table-cell" : "block";
        }
    }
    
    gIntervalID = setInterval( "ChangeNavigationHorizontal();", 10 );
}

function ShowHideNavigationVertical()
{
    if ( gNavigationState < 0 )  // Hiding
    {
        var rows    = gOuterFrameset.rows;
        
        if ( gNavPosition == "Top" )
        {
            gNavigationWidth = parseInt( rows );
        }
        else if ( gNavPosition == "Bottom" )
        {
            gNavigationWidth = parseInt( rows.substring( rows.indexOf( "," ) + 1 ) );
        }
    }
    else                         // Showing
    {
        if ( gNavPosition == "Bottom" )
        {
            gOuterFrameset.setAttribute( "border", 4 );
            gOuterFrameset.setAttribute( "frameSpacing", 2 )
        }
    }
    
    gIntervalID = setInterval( "ChangeNavigationVertical();", 10 );
}

function ChangeNavigationHorizontal()
{
    var cols    = gInnerFrameset.cols;
    
    if ( gNavPosition == "Left" )
    {
        var currWidth   = parseInt( cols );
    }
    else if ( gNavPosition == "Right" )
    {
        var currWidth   = parseInt( cols.substring( cols.indexOf( "," ) + 1 ) );
    }
    
    var newWidth    = gSlide ? currWidth + gNavigationState : 0;
    
    if ( newWidth <= 0 || newWidth >= gNavigationWidth )
    {
        clearInterval( gIntervalID );
        
        if ( gNavigationState < 0 )  // Hiding
        {
			var accordionTitle	= document.getElementById( "AccordionTitle" );
        
			if ( accordionTitle != null )
			{
				accordionTitle.style.display = "none";
			}
			
            newWidth = 0;
            
            gInnerFrameset.setAttribute( "border", 0 );
            gInnerFrameset.setAttribute( "frameSpacing", 0 )
        }
        else                         // Showing
        {
            newWidth = gNavigationWidth;
        }
        
        gNavigationState *= -1;
        gChanging = false;
    }
    
    var accordionTitle	= document.getElementById( "AccordionTitle" );
        
	if ( accordionTitle != null )
	{
		accordionTitle.style.width = newWidth + "px";
    }
    
    if ( gNavPosition == "Left" )
    {
        gInnerFrameset.cols = newWidth + ", *";
    }
    else if ( gNavPosition == "Right" )
    {
        gInnerFrameset.cols = "*, " + newWidth;
    }
}

function ChangeNavigationVertical()
{
    var rows    = gOuterFrameset.rows;
    
    if ( gNavPosition == "Top" )
    {
        var currHeight  = parseInt( rows );
    }
    else if ( gNavPosition == "Bottom" )
    {
        var currHeight  = parseInt( rows.substring( rows.indexOf( "," ) + 1 ) );
    }
    
    var newHeight       = gSlide ? currHeight + gNavigationState : 0;
    var resizeBarHeight = 7;
    
    if ( newHeight <= 0 || newHeight >= gNavigationWidth )
    {
        clearInterval( gIntervalID );
        
        if ( gNavigationState < 0 )  // Hiding
        {
            newHeight = 0;
            resizeBarHeight = 0;
            
            if ( gNavPosition == "Bottom" )
            {
                gOuterFrameset.setAttribute( "border", 0 );
                gOuterFrameset.setAttribute( "frameSpacing", 0 )
            }
        }
        else                         // Showing
        {
            newHeight = gNavigationWidth;
            resizeBarHeight = 7;
        }
        
        gNavigationState *= -1;
        gChanging = false;
    }
    
    if ( gNavPosition == "Top" )
    {
        gOuterFrameset.rows = newHeight + ", " + resizeBarHeight + ", *";
    }
    else if ( gNavPosition == "Bottom" )
    {
        gOuterFrameset.rows = "*, " + newHeight;
    }
}
