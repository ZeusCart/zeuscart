// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

var gInit								= false;
var gSearchFavoritesLabel				= "Favorite Searches";
var gSearchFavoritesLabelStyleMap		= new CMCDictionary();
var gEmptySearchFavoritesLabel			= "(there are no saved searches)";
var gEmptySearchFavoritesTooltip		= "No search favorites";
var gEmptySearchFavoritesStyleMap		= new CMCDictionary();
var gTopicFavoritesLabel				= "Favorite Topics";
var gTopicFavoritesLabelStyleMap		= new CMCDictionary();
var gEmptyTopicFavoritesLabel			= "(there are no saved topics)";
var gEmptyTopicFavoritesTooltip			= "No topic favorites";
var gEmptyTopicFavoritesStyleMap		= new CMCDictionary();
var gDeleteSearchFavoritesTooltip		= "Delete selected favorites";
var gDeleteSearchFavoritesIcon			= "Images/Delete.gif";
var gDeleteSearchFavoritesOverIcon		= "Images/Delete_over.gif";
var gDeleteSearchFavoritesSelectedIcon	= "Images/Delete_selected.gif";
var gDeleteSearchFavoritesIconWidth		= 23;
var gDeleteSearchFavoritesIconHeight	= 22;
var gDeleteTopicFavoritesTooltip		= "Delete selected favorites";
var gDeleteTopicFavoritesIcon			= "Images/Delete.gif";
var gDeleteTopicFavoritesOverIcon		= "Images/Delete_over.gif";
var gDeleteTopicFavoritesSelectedIcon	= "Images/Delete_selected.gif";
var gDeleteTopicFavoritesIconWidth		= 23;
var gDeleteTopicFavoritesIconHeight		= 22;

gEmptySearchFavoritesStyleMap.Add( "color", "#999999" );
gEmptySearchFavoritesStyleMap.Add( "fontSize", "10px" );
gEmptyTopicFavoritesStyleMap.Add( "color", "#999999" );
gEmptyTopicFavoritesStyleMap.Add( "fontSize", "10px" );

function Init( OnCompleteFunc )
{
    if ( gInit )
    {
		OnCompleteFunc();
        return;
    }
    
    //
    
    FMCLoadSearchFavorites();
    document.body.insertBefore( document.createElement( "br" ), document.getElementById( "searchFavorites" ).nextSibling );
    FMCLoadTopicsFavorites();
    
    //
    
    gInit = true;
    
    OnCompleteFunc();
}

function FMCSetSearchTabIndexes()
{
	gTabIndex = 1;
	
	//
	
	var searchTable	= document.getElementById( "searchFavorites" );
	
	searchTable.getElementsByTagName( "div" )[0].tabIndex = gTabIndex++;
	
	var trs	= searchTable.getElementsByTagName( "tr" );
	
	if ( trs[1].getElementsByTagName( "td" ).length == 1 )
	{
		return;
	}
	
	for ( var i = 1; i < trs.length; i++ )
	{
		var tr	= trs[i];
		
		tr.firstChild.firstChild.tabIndex = gTabIndex++;
		tr.lastChild.firstChild.tabIndex = gTabIndex++;
	}
	
	//
	
	FMCSetTopicsTabIndexes();
}

function FMCSetTopicsTabIndexes()
{
	var topicTable	= document.getElementById( "topicsFavorites" );
	
	if ( !topicTable )
	{
		return;
	}
	
	//
	
	var searchTable	= document.getElementById( "searchFavorites" );
	var trs			= searchTable.getElementsByTagName( "tr" );
	
	if ( trs.length > 0 )
	{
		gTabIndex = 1 + ((trs.length - 1) * 2) + 1;
	}
	else
	{
		gTabIndex = 2;
	}
	
	//
	
	topicTable.getElementsByTagName( "div" )[0].tabIndex = gTabIndex++;
	
	var trs	= topicTable.getElementsByTagName( "tr" );
	
	if ( trs[1].getElementsByTagName( "td" ).length == 1 )
	{
		return;
	}
	
	for ( var i = 1; i < trs.length; i++ )
	{
		var tr	= trs[i];
		
		tr.firstChild.firstChild.tabIndex = gTabIndex++;
		tr.lastChild.firstChild.tabIndex = gTabIndex++;
	}
}

function FMCAddToFavorites( section, value )
{
    value = FMCTrim( value );
    
    if ( !value )
    {
        return;
    }
    
    var cookie  = FMCReadCookie( section );
    
    if ( cookie )
    {
        var favorites   = cookie.split( "||" );
        
        for ( var i = 0; i < favorites.length; i++ )
        {
            if ( favorites[i] == value )
            {
                return;
            }
        }
        
        value = cookie + "||" + value;
    }
    
    FMCSetCookie( section, value, 36500 );
}

function FMCDeleteFavorites( id )
{
    var checkBoxes  = document.getElementById( id ).getElementsByTagName( "input" );
    var deleteQueue = new Array();
    
    for ( var i = 0; i < checkBoxes.length; i++ )
    {
        var checkBox    = checkBoxes[i];
        
        if ( checkBox.checked )
        {
            var value   = checkBox.parentNode.parentNode.childNodes[0].childNodes[0].childNodes[1].nodeValue;
            
            if ( id == "topicsFavorites" )
            {
                value = value + "|" + FMCGetMCAttribute( checkBox.parentNode.parentNode.childNodes[0].childNodes[0], "MadCap:content" );
            }
            
            FMCRemoveFromFavorites( id, value );
            deleteQueue[deleteQueue.length] = checkBox.parentNode.parentNode;
        }
    }
    
    for ( var i = 0; i < deleteQueue.length; i++ )
    {
        deleteQueue[i].parentNode.removeChild( deleteQueue[i] );
    }
    
    var table   = document.getElementById( id );
    var tbody   = table.childNodes[0];
    
    if ( tbody.childNodes.length == 1 )
    {
        var tr      = document.createElement( "tr" );
        var td      = document.createElement( "td" );
        var img     = document.createElement( "img" );
        
        img.src = "Images/FavoritesBlank.gif";
        img.alt = gEmptySearchFavoritesTooltip;
        img.style.width = "12px";
        img.style.height = "12px";
        img.style.marginRight = "5px";
        
        td.colSpan = 2;
        td.style.textIndent = "15px";
        
        for ( var key in gEmptySearchFavoritesStyleMap.GetKeys() )
        {
			td.style[key] = gEmptySearchFavoritesStyleMap.GetItem( key );
        }
        
        td.appendChild( img );
        
        var label	= null;
        
        if ( id == "topicsFavorites" )
        {
            label = gEmptyTopicFavoritesLabel;
        }
        else if ( id == "searchFavorites" )
        {
			label = gEmptySearchFavoritesLabel;
        }

		td.appendChild( document.createTextNode( label ) );
        tr.appendChild( td );
        tbody.appendChild( tr );
    }
}

function FMCRemoveFromFavorites( section, value )
{
    section = section.substring( 0, section.indexOf( "Favorites" ) );
    
    var cookie  = FMCReadCookie( section );
    
    if ( cookie )
    {
        var valuePosition   = cookie.indexOf( value );
        
        if ( valuePosition != -1 )
        {
            var backOffset      = 0;
            var forwardOffset   = 0;
            
            if ( cookie.substring( valuePosition - 2, valuePosition ) == "||" )
            {
                backOffset = 2;
            }
            if ( cookie.substring( valuePosition + value.length, valuePosition + value.length + 2 ) == "||" )
            {
                forwardOffset = 2;
            }
            
            if ( backOffset == 2 && forwardOffset == 2 )
            {
                backOffset = 0;
            }
            
            cookie = cookie.substring( 0, valuePosition - backOffset ) +
                     cookie.substring( valuePosition + value.length + forwardOffset, cookie.length );
        }
        
        FMCSetCookie( section, cookie, 36500 );
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

function FMCLoadSearchFavorites()
{
    var search  = FMCReadCookie( "search" );
    var searchFavorites;
    
    if ( !search )
    {
        searchFavorites = new Array();
    }
    else
    {
        searchFavorites = search.split( "||" );
    }
    
    var table   = document.getElementById( "searchFavorites" );
    
    if ( !table )
    {
        table = document.createElement( "table" );
        document.body.insertBefore( table, document.body.firstChild );
    }
    else
    {
        table.removeChild( table.childNodes[0] )
    }
    
    var tbody	= document.createElement( "tbody" );
    var tr		= document.createElement( "tr" );
    var td		= document.createElement( "td" );
    
    td.appendChild( document.createTextNode( gSearchFavoritesLabel ) );
    
    for ( var key in gSearchFavoritesLabelStyleMap.GetKeys() )
    {
		td.style[key] = gSearchFavoritesLabelStyleMap.GetItem( key );
    }
    
    tr.appendChild( td );
    
    td = document.createElement( "td" );
    
    tr.appendChild( td );
    tbody.appendChild( tr );
    
    MakeButton( td, gDeleteSearchFavoritesTooltip, gDeleteSearchFavoritesIcon, gDeleteSearchFavoritesOverIcon, gDeleteSearchFavoritesSelectedIcon, gDeleteSearchFavoritesIconWidth, gDeleteSearchFavoritesIconHeight, String.fromCharCode( 160 ) );
    td.firstChild.onclick = function() { FMCDeleteFavorites( "searchFavorites" ); };
    td.firstChild.onkeyup = ItemOnkeyup;
    
    if ( searchFavorites.length == 0 )
    {
        tr = document.createElement( "tr" );
        td = document.createElement( "td" );
        
        var img	= document.createElement( "img" );
        
        img.src = "Images/FavoritesBlank.gif";
        img.alt = gEmptySearchFavoritesTooltip;
        img.style.width = "12px";
        img.style.height = "12px";
        img.style.marginRight = "5px";
        
        td.colSpan = 2;
        td.style.textIndent = "15px";
        
        for ( var key in gEmptySearchFavoritesStyleMap.GetKeys() )
        {
			td.style[key] = gEmptySearchFavoritesStyleMap.GetItem( key );
        }
        
        td.appendChild( img );
        td.appendChild( document.createTextNode( gEmptySearchFavoritesLabel ) );
        tr.appendChild( td );
        tbody.appendChild( tr );
    }
    
    for ( var i = 0; i < searchFavorites.length; i++ )
    {
        var span    = document.createElement( "span" );
        
        tr = document.createElement( "tr" );
        td = document.createElement( "td" );
        
        var img	= document.createElement( "img" );
        
        img.src = "Images/FavoritesSearch.gif";
        img.alt = "Search favorite";
        img.style.width = "16px";
        img.style.height = "16px";
        img.style.marginRight = "5px";
        
        span.style.cursor = (navigator.appVersion.indexOf( "MSIE 5.5" ) == -1) ? "pointer" : "hand" ;
        span.onclick = function()
        {
            var navigationFrame = parent;
            var query           = this.childNodes[1].nodeValue;
            
            navigationFrame.SetActiveIFrameByName( "search" );
            navigationFrame.SetIFrameHeight();
            navigationFrame.frames["search"].document.forms["search"].searchField.value = query;
            navigationFrame.frames["search"].document.forms["search"].onsubmit();
        };
        span.onkeyup = ItemOnkeyup;
        
        td.style.textIndent = "15px";
        
        span.appendChild( img );
        span.appendChild( document.createTextNode( searchFavorites[i] ) );
        td.appendChild( span );
        tr.appendChild( td );
        
        td = document.createElement( "td" );
        
        var checkBox    = document.createElement( "input" );
        
        checkBox.type = "checkbox";
        
        td.style.width = "16px";
        
        td.appendChild( checkBox );
        tr.appendChild( td );
        tbody.appendChild( tr );
    }
    
    table.id = "searchFavorites";
    
    table.appendChild( tbody );
    
    //
    
    FMCSetSearchTabIndexes();
}

function FMCLoadTopicsFavorites()
{
    var topics  = FMCReadCookie( "topics" );
    var topicsFavorites;
    
    if ( !topics )
    {
        topicsFavorites = new Array();
    }
    else
    {
        topicsFavorites = topics.split( "||" );
    }
    
    var table   = document.getElementById( "topicsFavorites" );
    
    if ( !table )
    {
        table = document.createElement( "table" );
        document.body.appendChild( table );
    }
    else
    {
        table.removeChild( table.childNodes[0] )
    }
    
    var tbody	= document.createElement( "tbody" );
    var tr		= document.createElement( "tr" );
    var td		= document.createElement( "td" );
    
    td.appendChild( document.createTextNode( gTopicFavoritesLabel ) );
    
    for ( var key in gTopicFavoritesLabelStyleMap.GetKeys() )
    {
		td.style[key] = gTopicFavoritesLabelStyleMap.GetItem( key );
    }
    
    tr.appendChild( td );
    
    td = document.createElement( "td" );
    
    tr.appendChild( td );
    tbody.appendChild( tr );
    
    MakeButton( td, gDeleteTopicFavoritesTooltip, gDeleteTopicFavoritesIcon, gDeleteTopicFavoritesOverIcon, gDeleteTopicFavoritesSelectedIcon, gDeleteTopicFavoritesIconWidth, gDeleteTopicFavoritesIconHeight, String.fromCharCode( 160 ) );
    td.firstChild.onclick = function() { FMCDeleteFavorites( "topicsFavorites" ); };
    td.firstChild.onkeyup = ItemOnkeyup;
    
    if ( topicsFavorites.length == 0 )
    {
        tr = document.createElement( "tr" );
        td = document.createElement( "td" );
        
        var img	= document.createElement( "img" );
        
        img.src = "Images/FavoritesBlank.gif";
        img.alt = gEmptyTopicFavoritesTooltip;
        img.style.width = "12px";
        img.style.height = "12px";
        img.style.marginRight = "5px";
        
        td.colSpan = 2;
        td.style.textIndent = "15px";
        
        for ( var key in gEmptyTopicFavoritesStyleMap.GetKeys() )
        {
			td.style[key] = gEmptyTopicFavoritesStyleMap.GetItem( key );
        }
        
        td.appendChild( img );
        td.appendChild( document.createTextNode( gEmptyTopicFavoritesLabel ) );
        tr.appendChild( td );
        tbody.appendChild( tr );
    }
    
    for ( var i = 0; i < topicsFavorites.length; i++ )
    {
        var span    = document.createElement( "span" );
        
        tr = document.createElement( "tr" );
        td = document.createElement( "td" );
        
        var img	= document.createElement( "img" );
        
        img.src = "Images/FavoritesTopic.gif";
        img.alt = "Topic favorite";
        img.style.width = "12px";
        img.style.height = "14px";
        img.style.marginRight = "5px";
        
        var title   = topicsFavorites[i].split( "|" )[0];
        var content = topicsFavorites[i].split( "|" )[1];
        
        span.style.cursor = (navigator.appVersion.indexOf( "MSIE 5.5" ) == -1) ? "pointer" : "hand" ;
        span.setAttribute( "MadCap:content", content );
        span.onclick = function( e )
        {
            var topicURL    = FMCGetMCAttribute( this, "MadCap:content" );
            
            parent.parent.frames["body"].document.location.href = topicURL;
        };
        span.onkeyup = ItemOnkeyup;
        
        td.style.textIndent = "15px";
        
        span.appendChild( img );
        span.appendChild( document.createTextNode( title ) );
        td.appendChild( span );
        tr.appendChild( td );
        
        td = document.createElement( "td" );
        
        var checkBox    = document.createElement( "input" );
        
        checkBox.type = "checkbox";
        
        td.style.width = "16px";
        
        td.appendChild( checkBox );
        tr.appendChild( td );
        tbody.appendChild( tr );
    }
    
    table.id = "topicsFavorites";
    
    table.appendChild( tbody );
    
    //
    
    FMCSetTopicsTabIndexes();
}
