// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

//

gOnloadFuncs.push( WindowOnload );

//

var gInit						= false;
var gSearchDBs					= new Array();
var gParser						= null;
var gFilters					= null;
var gFullSet					= null;
var gMergedSet					= null;
var gFilteredSet				= null;
var gHighlight					= "";
var gFavoritesEnabled			= true;
var gAddSearchLabel				= "Add search string to favorites";
var gAddSearchIcon				= "Images/AddSearchToFavorites.gif";
var gAddSearchOverIcon			= "Images/AddSearchToFavorites_over.gif";
var gAddSearchSelectedIcon		= "Images/AddSearchToFavorites_selected.gif";
var gAddSearchIconWidth			= 23;
var gAddSearchIconHeight		= 22;
var gFiltersLabel				= "Filters:";
var gFiltersLabelStyleMap		= new CMCDictionary();
var gRankLabel					= "Rank";
var gTitleLabel					= "Title";
var gUnfilteredLabel			= "(unfiltered)";
var gNoTopicsFoundLabel			= "No topics found";
var gInvalidTokenLabel			= "Invalid token.";
var gDownloadedSynonymXmlDoc	= null;

function WindowOnload()
{
	if ( FMCIsLiveHelpEnabled() )
	{
		var projectID	= parent.parent.GetMasterHelpSystem().LiveHelpOutputId;
	
		gServiceClient.GetSynonymsFile( projectID, null, GetSynonymsFileOnComplete, null );
	}
}

function GetSynonymsFileOnComplete( synonymsXmlDoc, onCompleteArgs )
{
	var xmlDoc	= CMCXmlParser.LoadXmlString( synonymsXmlDoc );
	
	gDownloadedSynonymXmlDoc = xmlDoc;
}

function FMCAddToFavorites()
{
    var favoritesFrame  = parent.frames["favorites"];
    
    favoritesFrame.FMCAddToFavorites( "search", document.forms["search"].searchField.value );
    favoritesFrame.FMCLoadSearchFavorites();
}

function Init( OnCompleteFunc )
{
    if ( gInit )
    {
        OnCompleteFunc();
        return;
    }
    
    //
    
    var inputs	= document.getElementsByTagName( "input" );
    
    inputs[0].tabIndex = gTabIndex++;
    inputs[1].tabIndex = gTabIndex++;
    
    //
    
	if ( gFavoritesEnabled )
	{
		var td	= document.createElement( "td" );

		document.getElementById( "SearchButton" ).parentNode.parentNode.appendChild( td );

		MakeButton( td, gAddSearchLabel, gAddSearchIcon, gAddSearchOverIcon, gAddSearchSelectedIcon, gAddSearchIconWidth, gAddSearchIconHeight, String.fromCharCode( 160 ) );
		td.getElementsByTagName( "div" )[0].onclick = function() { FMCAddToFavorites(); };
		td.getElementsByTagName( "div" )[0].onkeyup = ItemOnkeyup;
	}
    
    //
    
    var masterHS	= parent.parent.GetMasterHelpSystem();
    
    if ( !masterHS.IsWebHelpPlus )
    {
		gSearchDBs = masterHS.GetSearchDBs();
	}
	
	gFilters = new CMCFilters();
	gFilters.CreateFilterCombo();
    
    document.forms["search"].style.display = "";
    
    //
    
    gInit = true;
    
    OnCompleteFunc();
}

function ApplySearchFilter()
{
	var masterHS	= parent.parent.GetMasterHelpSystem();
    
    if ( !masterHS.IsWebHelpPlus )
    {
		var searchFilter	= document.getElementById( "SearchFilter" );
		var filterName		= searchFilter ? searchFilter.options[searchFilter.selectedIndex].text : gUnfilteredLabel;
	    
		gFilteredSet = gFilters.ApplyFilter( filterName );
		gFilteredSet.SetRankPositions();
		Sort( "rankPosition", false );
		GenerateResultsTable();
	}
}

var gOnSearchFinishedFunc	= null;
var gCallbackFuncArgs		= null;

function StartSearch( firstPick, OnSearchFinishedFunc, CallbackFuncArgs )
{
	var searchString	= document.forms["search"].searchField.value;
	
	if ( !searchString || FMCTrim( searchString ) == "" )
	{
		return;
	}
	
	var rootFrame	= parent.parent;
	
	StartLoading( window, document.getElementById( "SearchResults" ), rootFrame.gLoadingLabel, rootFrame.gLoadingAlternateText, null );
	
	//
	
	gOnSearchFinishedFunc = OnSearchFinishedFunc;
	gCallbackFuncArgs = CallbackFuncArgs;

	FMCRegisterCallback( "Search", MCEventType.OnInit, StartSearch2, firstPick );
}

function StartSearch2( firstPick )
{
	var searchString	= document.forms["search"].searchField.value;
	var masterHS		= parent.parent.GetMasterHelpSystem();

	if ( !masterHS.IsWebHelpPlus )
	{
		DoSearch( searchString );
	}
	else
	{
		var searchFilter	= document.getElementById( "SearchFilter" );
		var filterName		= null;
		
		if ( searchFilter != null )
		{
			filterName = searchFilter.options[searchFilter.selectedIndex].text;
			
			if ( filterName == gUnfilteredLabel )
			{
				filterName = null;
			}
		}
		
		//
		
		function OnSearchWebHelpPlusComplete()
		{
			if ( firstPick )
			{
				var firstResult	= document.getElementById( "searchResultsTable" ).firstChild.childNodes[1];
				
				if ( firstResult.onclick )
				{
					firstResult.onclick();
				}
			}
		}
		
		DoSearchWebHelpPlus( searchString, filterName, OnSearchWebHelpPlusComplete );
	}

	//

	EndLoading( window, null );

	//

	if ( !masterHS.IsWebHelpPlus )
	{
		if ( firstPick )
		{
			var firstResult	= document.getElementById( "searchResultsTable" ).firstChild.childNodes[1];
			
			if ( firstResult.onclick )
			{
				firstResult.onclick();
			}
		}
	}
}

//
//    Class CMCSearchResult
//

function CMCSearchResult( rank, rankPosition, title, link )
{
	// Public properties

	this.Rank			= rank;
	this.RankPosition	= rankPosition;
	this.Title			= title;
	this.Link			= link;
}

//
//    End class CMCSearchResult
//

//
//    Class CMCSearchResultSet
//

function CMCSearchResultSet()
{
	// Public properties

	this.mResults	= new Array();
	this.SortColumn	= null;
	this.Sortorder	= null;
}

CMCSearchResultSet.prototype.Add	= function( searchResult )
{
	this.mResults.push( searchResult );
};

CMCSearchResultSet.prototype.GetItem	= function( index )
{
	return this.mResults[index];
};

CMCSearchResultSet.prototype.GetLength	= function()
{
	return this.mResults.length;
};

CMCSearchResultSet.prototype.Sort	= function( sortColumn )
{
	if ( this.SortColumn == sortColumn )
	{
		if ( this.SortOrder == EMCSortOrder.Ascending )
		{
			this.SortOrder = EMCSortOrder.Descending;
		}
		else if ( this.SortOrder == EMCSortOrder.Descending )
		{
			this.SortOrder = EMCSortOrder.Ascending;
		}
	}
	else
	{
		if ( sortColumn == EMCSortColumn.Rank )
		{
			this.SortOrder = EMCSortOrder.Ascending;
		}
		else if ( sortColumn == EMCSortColumn.RankPosition )
		{
			this.SortOrder = EMCSortOrder.Descending;
		}
		else if ( sortColumn == EMCSortColumn.Title )
		{
			this.SortOrder = EMCSortOrder.Descending;
		}
	}
	
    this.SortColumn = sortColumn;

    this.mResults.sort( this.CompareResults );
};

CMCSearchResultSet.prototype.CompareResults	= function( a, b )
{
	var value1	= null;
	var value2	= null;
	var ret		= 0;
	
	if ( gSearchResultSet.SortColumn == EMCSortColumn.Rank )
	{
		value1 = a.Rank;
		value2 = b.Rank;
		
		ret = value1 - value2;
	}
	else if ( gSearchResultSet.SortColumn == EMCSortColumn.RankPosition )
	{
		value1 = a.RankPosition;
		value2 = b.RankPosition;
		
		ret = value1 - value2;
	}
	else if ( gSearchResultSet.SortColumn == EMCSortColumn.Title )
	{
		value1 = a.Title;
		value2 = b.Title;
		
		if ( value1 < value2 )
        {
            ret = -1;
        }
        else if ( value1 == value2 )
        {
            ret = 0;
        }
        else if ( value1 > value2 )
        {
            ret = 1;
        }
	}
	
	if ( gSearchResultSet.SortOrder == EMCSortOrder.Ascending )
	{
		ret *= -1;
	}
	
	return ret;
};

//
//    End class CMCSearchResultSet
//

var EMCSortColumn	= new function()
{
}

EMCSortColumn.Rank			= 0;
EMCSortColumn.RankPosition	= 1;
EMCSortColumn.Title			= 2;

//

var EMCSortOrder	= new function()
{
}

EMCSortOrder.Ascending	= 0;
EMCSortOrder.Descending = 1;

//
//    End class CMCSearchResultSet
//

var gSearchResultSet	= null;

function DoSearchWebHelpPlus( searchString, filterName, OnCompleteFunc )
{
	function OnGetSearchResultsComplete( xmlDoc, args )
	{
		gSearchResultSet = new CMCSearchResultSet();
		
		var results			= xmlDoc.getElementsByTagName( "Result" );
		var resultsLength	= results.length;
		
		for ( var i = 0; i < resultsLength; i++ )
        {
			var resultNode		= results[i];
			var rank			= FMCGetAttributeInt( resultNode, "Rank", -1 );
			var rankPosition	= i + 1;
			var title			= resultNode.getAttribute( "Title" );
			var link			= resultNode.getAttribute( "Link" );
			
			if ( title == null )
			{
				title = resultNode.getAttribute( "Filename" );
			}
			
			var searchResult	= new CMCSearchResult( rank, rankPosition, title, link );
			
			gSearchResultSet.Add( searchResult );
        }

		//
		
		gSearchResultSet.SortColumn = EMCSortColumn.RankPosition;
		gSearchResultSet.SortOrder = EMCSortOrder.Descending;

		GenerateResultsTableWebHelpPlus();
		
		OnCompleteFunc();
		
		if ( gOnSearchFinishedFunc )
		{
			var numResults	= 0;
			
			if ( gFullSet )
			{
				numResults = gFullSet.GetLength();
			}
			
			gOnSearchFinishedFunc( numResults, gCallbackFuncArgs );
			gOnSearchFinishedFunc = null;
			gCallbackFuncArgs = null;
		}
		
		//
		
		var projectID	= parent.parent.GetMasterHelpSystem().LiveHelpOutputId;
        var userGuid	= null;
        var language	= null;

        gServiceClient.LogSearch( projectID, userGuid, resultsLength, language, searchString );
	}

	var xmlDoc	= CMCXmlParser.CallWebService( MCGlobals.RootFolder + "Service/Service.asmx/GetSearchResults?SearchString=" + searchString + "&FilterName=" + filterName, true, OnGetSearchResultsComplete, null );
}

function GenerateResultsTableWebHelpPlus()
{
	var tableOld    = document.getElementById( "searchResultsTable" );

	if ( tableOld )
	{
		tableOld.parentNode.removeChild( tableOld );
	}

	// Generate results table

	var table       = document.createElement( "table" );
	var tbody       = document.createElement( "tbody" );
	var trHeader    = document.createElement( "tr" );
	var thRankCol   = document.createElement( "th" );
	var thTitleCol  = document.createElement( "th" );
	var img         = document.createElement( "img" );
	var imgTarget   = null;

	table.id = "searchResultsTable";
	table.style.width = FMCGetClientWidth( window, false ) - 25 + "px";
	thRankCol.className = "columnHeading";
	thTitleCol.className = "columnHeading";
	thRankCol.style.width = "60px";
	thTitleCol.style.width = "auto";
	thRankCol.appendChild( document.createTextNode( gRankLabel ) );
	thTitleCol.appendChild( document.createTextNode( gTitleLabel ) );

	if ( gSearchResultSet.SortColumn == EMCSortColumn.RankPosition )
	{
		imgTarget = thRankCol;
	}
	else if ( gSearchResultSet.SortColumn == EMCSortColumn.Title )
	{
		imgTarget = thTitleCol;
	}

	img.src = (gSearchResultSet.SortOrder == EMCSortOrder.Descending) ? "Images/ArrowUp.gif" : "Images/ArrowDown.gif";
	img.alt = (gSearchResultSet.SortOrder == EMCSortOrder.Descending) ? "Descending" : "Ascending";
	img.style.width = "12px";
	img.style.height = "7px";
	img.style.paddingLeft = "10px";
	imgTarget.appendChild( img );

	thRankCol.onclick = THRankColOnclick;
	thTitleCol.onclick = THTitleColOnclick;
	thRankCol.onmouseover = ColOnmouseover;
	thTitleCol.onmouseover = ColOnmouseover;
	thRankCol.onmouseout = ColOnmouseout;
	thTitleCol.onmouseout = ColOnmouseout;
	thRankCol.onmousedown = ColOnmousedown;
	thTitleCol.onmousedown = ColOnmousedown;

	trHeader.appendChild( thRankCol );
	trHeader.appendChild( thTitleCol );
	tbody.appendChild( trHeader );
	table.appendChild( tbody );
	document.getElementById( "SearchResults" ).appendChild( table );

	//

	parent.SetIFrameHeight();

	//

	var trResult    = document.createElement( "tr" );
	var tdRank      = document.createElement( "td" );
	var tdTitle     = document.createElement( "td" );
	//var tdRanking	= document.createElement( "td" );	// Debug

	trResult.style.cursor = (navigator.appVersion.indexOf( "MSIE 5.5" ) == -1) ? "pointer" : "hand" ;

	tdRank.style.width = "60px";
	tdTitle.style.width = "auto";

	tdRank.appendChild( document.createTextNode( "(" + gNoTopicsFoundLabel + ")" ) );
	tdTitle.appendChild( document.createTextNode( " " ) );
	//tdRanking.appendChild( document.createTextNode( " " ) );	// Debug
	trResult.appendChild( tdRank );
	trResult.appendChild( tdTitle );
	//trResult.appendChild( tdRanking );	// Debug

	//
	
	var resultsLength	= gSearchResultSet.GetLength();

	if ( resultsLength == 0 )
	{
		var trCurr  = trResult.cloneNode( true );
	    
		tbody.appendChild( trCurr );
	    
		return;
	}

	gTabIndex = 4;	// Reset to 4 during every search (1-3 are used for the search field, search button, and add to favorites button).
	
	for ( var i = 0; i < resultsLength; i++ )
	{
		var trCurr	= trResult.cloneNode( true );
		var result	= gSearchResultSet.GetItem( i );
		var rank	= result.RankPosition;
		var title	= result.Title;

		//var ranking		= result.Rank;	// Debug
		var file        = result.Link;
		var firstStem   = true;
	    
		trCurr.onmouseover = ResultTROnmouseover;
		trCurr.onmouseout = ResultTROnmouseout;
		trCurr.onclick  = ResultTROnclick;
		trCurr.onfocus = trCurr.onmouseover;
		trCurr.onblur = trCurr.onmouseout;
		trCurr.onkeyup = ItemOnkeyup;
	    
		trCurr.setAttribute( "MadCap:href", file );
		trCurr.firstChild.firstChild.nodeValue = rank;
		trCurr.childNodes[1].firstChild.nodeValue = title;
		//trCurr.lastChild.firstChild.nodeValue = ranking;	// Debug
	    
		trCurr.tabIndex = gTabIndex++;
	    
		tbody.appendChild( trCurr );
	}

//	gHighlight = "?Highlight=";

//	var stemMap = gParser.GetStemMap();

//	for ( var stem in stemMap.GetKeys() )
//	{
//		if ( !firstStem )
//		{
//			gHighlight += "||";
//		}
//		else
//		{
//			firstStem = false;
//		}
//	    
//		var firstPhrase = true;
//	    
//		for ( var phrase in stemMap.GetItem( stem ).GetKeys() )
//		{
//			if ( !firstPhrase )
//			{
//				gHighlight += "|";
//			}
//			else
//			{
//				firstPhrase = false;
//			}
//	        
//			gHighlight += (phrase);
//		}
//	}
}

function DoSearch( searchString )
{
    gParser		= new CMCParser( searchString );
    var root	= null;
    
    try
    {
        root = gParser.ParseExpression();
    }
    catch ( err )
    {
        alert( err );
    }
    
    if ( !root )
    {
		EndLoading( window, null );
		
        return;
    }
    
    if ( gDownloadedSynonymXmlDoc != null && gSearchDBs[0].DownloadedSynonymFile == null )
    {
		gSearchDBs[0].DownloadedSynonymFile = new CMCSynonymFile( gDownloadedSynonymXmlDoc );
    }
    
    gFullSet = root.Evaluate( false, false );
    
    //
    
    if ( gOnSearchFinishedFunc )
    {
		var numResults	= 0;
		
		if ( gFullSet )
		{
			numResults = gFullSet.GetLength();
		}
		
		gOnSearchFinishedFunc( numResults, gCallbackFuncArgs );
		gOnSearchFinishedFunc = null;
		gCallbackFuncArgs = null;
    }
    
    //
    
    if ( gFullSet )
    {
        gMergedSet = gFullSet.ToMerged();
        ApplySearchFilter();
        
        //

        var projectID	= parent.parent.GetMasterHelpSystem().LiveHelpOutputId;
        var userGuid	= null;
        var language	= null;
        
        gServiceClient.LogSearch( projectID, userGuid, gMergedSet.GetLength(), language, searchString );
    }
}

function Sort( col, change )
{
    if ( !gFilteredSet )
    {
        return;
    }
    
    var sortCol     = gFilteredSet.GetSortCol();
    var sortOrder   = gFilteredSet.GetSortOrder();
    
    if ( !sortCol )
    {
        if ( col )
        {
            sortCol = col;
        }
        else
        {
            sortCol = "rankPosition";
        }
        
        sortOrder = 1;
    }
    else if ( sortCol == col )
    {
        sortOrder *= (change ? -1 : 1);
    }
    else
    {
        sortCol = col;
        sortOrder = 1;
    }
    
    gFilteredSet.Sort( sortCol, sortOrder );
}

function GenerateResultsTable()
{
    if ( !gFullSet )
    {
        return;
    }
    
    //
    
    var tableOld    = document.getElementById( "searchResultsTable" );
    
    if ( tableOld )
    {
        tableOld.parentNode.removeChild( tableOld );
    }
    
    // Generate results table
    
    var table       = document.createElement( "table" );
    var tbody       = document.createElement( "tbody" );
    var trHeader    = document.createElement( "tr" );
    var thRankCol   = document.createElement( "th" );
    var thTitleCol  = document.createElement( "th" );
    var img         = document.createElement( "img" );
    var imgTarget   = null;
    
    table.id = "searchResultsTable";
    table.style.width = FMCGetClientWidth( window, false ) - 25 + "px";
    thRankCol.className = "columnHeading";
    thTitleCol.className = "columnHeading";
    thRankCol.style.width = "60px";
    thTitleCol.style.width = "auto";
    thRankCol.appendChild( document.createTextNode( gRankLabel ) );
    thTitleCol.appendChild( document.createTextNode( gTitleLabel ) );
    
    if ( gFilteredSet.GetSortCol() == "rankPosition" )
    {
        imgTarget = thRankCol;
    }
    else if ( gFilteredSet.GetSortCol() == "title" )
    {
        imgTarget = thTitleCol;
    }
    
    img.src = (gFilteredSet.GetSortOrder() == 1) ? "Images/ArrowUp.gif" : "Images/ArrowDown.gif";
    img.alt = (gFilteredSet.GetSortOrder() == 1) ? "Descending" : "Ascending";
    img.style.width = "12px";
    img.style.height = "7px";
    img.style.paddingLeft = "10px";
    imgTarget.appendChild( img );
    
	thRankCol.onclick = THRankColOnclick;
	thTitleCol.onclick = THTitleColOnclick;
	thRankCol.onmouseover = ColOnmouseover;
	thTitleCol.onmouseover = ColOnmouseover;
	thRankCol.onmouseout = ColOnmouseout;
	thTitleCol.onmouseout = ColOnmouseout;
	thRankCol.onmousedown = ColOnmousedown;
	thTitleCol.onmousedown = ColOnmousedown;
    
    trHeader.appendChild( thRankCol );
    trHeader.appendChild( thTitleCol );
    tbody.appendChild( trHeader );
    table.appendChild( tbody );
    document.getElementById( "SearchResults" ).appendChild( table );
    
    //
    
    parent.SetIFrameHeight();
    
    //
    
    var trResult    = document.createElement( "tr" );
    var tdRank      = document.createElement( "td" );
    var tdTitle     = document.createElement( "td" );
    //var tdRanking	= document.createElement( "td" );	// Debug
    
    trResult.style.cursor = (navigator.appVersion.indexOf( "MSIE 5.5" ) == -1) ? "pointer" : "hand" ;
    
    tdRank.style.width = "60px";
    tdTitle.style.width = "auto";
    
    tdRank.appendChild( document.createTextNode( "(" + gNoTopicsFoundLabel + ")" ) );
    tdTitle.appendChild( document.createTextNode( " " ) );
    //tdRanking.appendChild( document.createTextNode( " " ) );	// Debug
    trResult.appendChild( tdRank );
    trResult.appendChild( tdTitle );
    //trResult.appendChild( tdRanking );	// Debug
    
    //
    
    if ( gFilteredSet.GetLength() == 0 )
    {
        var trCurr  = trResult.cloneNode( true );
        
        tbody.appendChild( trCurr );
        
        return;
    }
    
    gTabIndex = 4;	// Reset to 4 during every search (1-3 are used for the search field, search button, and add to favorites button).
    
    for ( var i = 0; i < gFilteredSet.GetLength(); i++ )
    {
        var trCurr      = trResult.cloneNode( true );
        var result      = gFilteredSet.GetResult( i );
        var searchDBID  = result.SearchDB;
        var entry       = result.Entry;
        var topicID     = entry.TopicID;
        var searchDB    = gSearchDBs[searchDBID];
        var title       = searchDB.URLTitles[topicID] ? searchDB.URLTitles[topicID] : "";
        var rank        = result.RankPosition;
        //var ranking		= result.Ranking;	// Debug
        var path        = searchDB.HelpSystem.GetPath() + "Data/";
        var file        = searchDB.URLSources[topicID];
        var firstStem   = true;
        
        trCurr.onmouseover = ResultTROnmouseover;
		trCurr.onmouseout = ResultTROnmouseout;
		trCurr.onclick  = ResultTROnclick;
        trCurr.onfocus = trCurr.onmouseover;
        trCurr.onblur = trCurr.onmouseout;
        trCurr.onkeyup = ItemOnkeyup;
        
        trCurr.setAttribute( "MadCap:href", path + file );
        trCurr.firstChild.firstChild.nodeValue = rank;
        trCurr.childNodes[1].firstChild.nodeValue = title;
        //trCurr.lastChild.firstChild.nodeValue = ranking;	// Debug
        
        trCurr.tabIndex = gTabIndex++;
        
        tbody.appendChild( trCurr );
    }
    
    gHighlight = "?SearchType=" + gSearchDBs[0].SearchType + "&Highlight=";
    
    var stemMap = gParser.GetStemMap();
    
    for ( var stem in stemMap.GetKeys() )
    {
        if ( !firstStem )
        {
            gHighlight += "||";
        }
        else
        {
            firstStem = false;
        }
        
        var firstPhrase = true;
        
        for ( var phrase in stemMap.GetItem( stem ).GetKeys() )
        {
            if ( !firstPhrase )
            {
                gHighlight += "|";
            }
            else
            {
                firstPhrase = false;
            }
            
            gHighlight += (phrase);
        }
    }
}

function THRankColOnclick()
{
	ColOnclick( "rankPosition" );
}

function THTitleColOnclick()
{
	ColOnclick( "title" );
}

function ColOnclick( colName )
{
	var masterHS	= parent.parent.GetMasterHelpSystem();
	
	if ( !masterHS.IsWebHelpPlus )
	{
		Sort( colName, true );
		GenerateResultsTable();
	}
	else
	{
		if ( colName == "rankPosition" )
		{
			gSearchResultSet.Sort( EMCSortColumn.RankPosition );
			GenerateResultsTableWebHelpPlus();
		}
		else if ( colName == "title" )
		{
			gSearchResultSet.Sort( EMCSortColumn.Title );
			GenerateResultsTableWebHelpPlus();
		}
	}
}

function ColOnmouseover()
{
	this.style.backgroundImage = FMCCreateCssUrl( "Images/SearchGradient_over.jpg" );
}

function ColOnmouseout()
{
	this.style.backgroundImage = FMCCreateCssUrl( "Images/SearchGradient.jpg" );
}

function ColOnmousedown()
{
	this.style.backgroundImage = FMCCreateCssUrl( "Images/SearchGradient_selected.jpg" );
}

function ResultTROnmouseover()
{
	this.style.backgroundColor = "#dddddd";
}

function ResultTROnmouseout()
{
	this.style.backgroundColor = "Transparent";
}

function ResultTROnclick()
{
	parent.parent.frames["body"].location.href = FMCGetMCAttribute( this, "MadCap:href" ) + gHighlight;
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

//
//    Class CMCFilters
//

function CMCFilters()
{
    // Private member variables
    
    var mXMLDoc     = null;
    var mFilterMap  = new CMCDictionary();
    var mConceptMap = new CMCDictionary();
    
    {
        var rootFrame	= FMCGetRootFrame();
        
        mXMLDoc = CMCXmlParser.GetXmlDoc( rootFrame.gRootFolder + "Data/Filters.xml", false, null, null );
        
        if ( mXMLDoc )
        {
            LoadFilters();
            
            mXMLDoc = CMCXmlParser.GetXmlDoc( rootFrame.gRootFolder + "Data/Concepts.xml", false, null, null );
            LoadConcepts();
        }
    }
    
    // Public member functions
    
    this.ApplyFilter            = function( filterName )
    {
        if ( !gFullSet )
        {
            return null;
        }
        
        var filteredSet = new CMCQueryResultSet();
        
        if ( filterName == gUnfilteredLabel )
        {
            for ( var i = 0; i < gMergedSet.GetLength(); i++ )
            {
                filteredSet.Add( gMergedSet.GetResult( i ), false, false, false );
            }
        }
        else
        {
            var concepts    = mFilterMap.GetItem( filterName );
            
            for ( var i = 0; i < gMergedSet.GetLength(); i++ )
            {
                var result      = gMergedSet.GetResult( i );
                var searchDB    = result.SearchDB;
                var topicID     = parseInt( result.Entry.TopicID );
                var topicPath   = gSearchDBs[searchDB].URLSources[topicID];
                var topicFile   = topicPath.substring( "..".length, topicPath.length );
                
                for ( var term in concepts.GetKeys() )
                {
                    var conceptLinkMap  = mConceptMap.GetItem( term );
                    
                    if ( conceptLinkMap && conceptLinkMap.GetItem( topicFile ) )
                    {
                        filteredSet.Add( result, false, false, false );
                        
                        break;
                    }
                }
            }
        }
        
        return filteredSet;
    };
    
    this.CreateFilterCombo    = function()
    {
		var filterNames	= new Array();
		var filterCount	= 0;
		
        for ( var filterName in mFilterMap.GetKeys() )
        {
			filterNames[filterCount++] = filterName;
        }
        
        if ( filterCount == 0 )
		{
			return;
		}
        
        FMCSortStringArray( filterNames );
        
        //
        
        var tbody	= document.getElementById( "SearchFormTable" ).getElementsByTagName( "tbody" )[0];
        var tr		= document.createElement( "tr" );
        var td		= document.createElement( "td" );
        var select	= document.createElement( "select" );
        
        td.id = "SearchFilterCell";
        td.colSpan = 3;
        
        for ( var key in gFiltersLabelStyleMap.GetKeys() )
		{
			td.style[key] = gFiltersLabelStyleMap.GetItem( key );
		}

        td.appendChild( document.createTextNode( gFiltersLabel ) );
        
        select.id = "SearchFilter";
        select.onchange = ApplySearchFilter;
        
        var option	= document.createElement( "option" );

		option.appendChild( document.createTextNode( gUnfilteredLabel ) );
		select.appendChild( option );
        
        for ( var i = 0; i < filterCount; i++ )
        {
            option = document.createElement( "option" );
            option.appendChild( document.createTextNode( filterNames[i] ) );
            select.appendChild( option );
        }

		select.tabIndex = gTabIndex++;
		
		td.appendChild( select );
        tr.appendChild( td );
        tbody.appendChild( tr );
    };
    
    // Private member functions
    
    function LoadFilters()
    {
        var filters = mXMLDoc.getElementsByTagName( "SearchFilter" );
        
        for ( var i = 0; i < filters.length; i++ )
        {
            var filter      = filters[i];
            var name        = filter.getAttribute( "Name" );
            
            if ( !filter.getAttribute( "Concepts" ) )
            {
                continue;
            }
            
            var concepts    = filter.getAttribute( "Concepts" ).split( ";" );
            
            mFilterMap.Add( name, new CMCDictionary() );
            
            for ( var j = 0; j < concepts.length; j++ )
            {
                var concept = FMCTrim( concepts[j] );
                
                mFilterMap.GetItem( name ).Add( concept, true );
            }
        }
    }
    
    function LoadConcepts()
    {
        var concepts    = mXMLDoc.getElementsByTagName( "ConceptEntry" );
        
        for ( var i = 0; i < concepts.length; i++ )
        {
            var concept = concepts[i];
            var term    = concept.getAttribute( "Term" );
            var topics  = concept.getElementsByTagName( "ConceptLink" );
            var linkMap = new CMCDictionary();
            
            mConceptMap.Add( term, linkMap );
            
            for ( var j = 0; j < topics.length; j++ )
            {
                var topic       = topics[j];
                var link        = topic.getAttribute( "Link" );
                var linkPlain   = link.substring( 0, link.lastIndexOf( "#" ) );
                
                linkMap.Add( linkPlain, true );
            }
        }
    }
}

//
//    End class CMCFilters
//

//
//    Class CMCSynonymFile
//

function CMCSynonymFile( xmlDoc )
{
	// Public properties

	this.WordToStem				= new CMCDictionary();
	this.Directionals			= new CMCDictionary();
	this.DirectionalStems		= new CMCDictionary();
	this.DirectionalStemSources	= new CMCDictionary();
	this.Groups					= new CMCDictionary();
	this.GroupStems				= new CMCDictionary();
	this.GroupStemSources		= new CMCDictionary();
	
	this.LoadSynonymFile( xmlDoc );
}

CMCSynonymFile.prototype.LoadSynonymFile	= function( xmlDoc )
{
	var groups	= FMCGetChildNodeByTagName( xmlDoc.documentElement, "Groups", 0 );
	var syns	= FMCGetChildNodeByTagName( xmlDoc.documentElement, "Directional", 0 );
	
	if ( syns != null )
	{
		var childNodesLength	= syns.childNodes.length;
		
		for ( var i = 0; i < childNodesLength; i++ )
		{
			var child	= syns.childNodes[i];
			
			if ( child.nodeName == "DirectionalSynonym" )
			{
				var from		= FMCGetAttribute( child, "From" );
				var to			= FMCGetAttribute( child, "To" );
				var stem		= FMCGetAttributeBool( child, "Stem", false );
				var fromStem	= FMCGetAttribute( child, "FromStem" );
				var toStem		= FMCGetAttribute( child, "ToStem" );
				
				if ( stem )
				{
					if ( fromStem == null )
					{
						fromStem = stemWord( from );
					}
				}

				if ( toStem == null )
				{
					toStem = stemWord( to );
				}

				if ( from != null && to != null )
				{
					if ( stem )
					{
						this.DirectionalStemSources.Add( from, toStem );
						this.DirectionalStems.Add( fromStem, toStem );

						this.WordToStem.Add( from, fromStem );
						this.WordToStem.Add( to, toStem );
					}
					else
					{
						this.Directionals.Add( from, toStem );

						this.WordToStem.Add( to, toStem );
					}
				}
			}
		}
	}

	if ( groups != null )
	{
		var childNodesLength	= groups.childNodes.length;

		for ( var i = 0; i < childNodesLength; i++ )
		{
			var child	= groups.childNodes[i];

			if ( child.nodeName == "SynonymGroup" )
			{
				var words			= new Array();
				var stemmedWords	= new Array();
				var stem			= FMCGetAttributeBool( child, "Stem", false );

				var synGroupChildNodesLength	= child.childNodes.length;
				
				for ( var j = 0; j < synGroupChildNodesLength; j++ )
				{
					var wordNode	= child.childNodes[j];
					
					if ( wordNode.nodeType != 1 )
					{
						continue;
					}
					
					words.push( wordNode.firstChild.nodeValue );
				}

				for ( var j = 0; j < synGroupChildNodesLength; j++ )
				{
					var wordNode	= child.childNodes[j];
					
					if ( wordNode.nodeType != 1 )
					{
						continue;
					}
					
					var stemmed		= FMCGetAttribute( wordNode, "Stem" );

					if ( stemmed == null )
					{
						stemmed = stemWord( wordNode.firstChild.nodeValue );
					}

					this.WordToStem.Add( wordNode.firstChild.nodeValue, stemmed );
	                
					stemmedWords.push( stemmed );
				}
	            

				//

				var wordsLength	= words.length;
				
				for ( var j = 0; j < wordsLength; j++ )
				{
					var word		= words[j];
					var stemmedWord	= stemmedWords[j];
					
					for ( var k = 0; k < wordsLength; k++ )
					{
						var word1	= words[k];
						
						if ( stem )
						{
							var group	= this.GroupStemSources.GetItem( word );
							
							if ( group == null )
							{
								group = new CMCDictionary();
								this.GroupStemSources.Add( word, group );
							}

							group.Add( word1, stemmedWord );
						}
						else
						{
							var group	= this.GroupStemSources.GetItem( word );
							
							if ( group == null )
							{
								group = new CMCDictionary();
								this.Groups.Add( word, group );
							}

							group.Add( word1, stemmedWord );
						}
					}
				}

				//
				
				var stemmedWordsLength	= stemmedWords.length;
				
				for ( var j = 0; j < stemmedWordsLength; j++ )
				{
					var stemmedWord	= stemmedWords[j];
					
					for ( var k = 0; k < stemmedWordsLength; k++ )
					{
						var stemmedWord1	= stemmedWords[k];
						var group			= this.GroupStems.GetItem( stemmedWord );

						if ( group == null )
						{
							group = new CMCDictionary();
							this.GroupStems.Add( stemmedWord, group );
						}

						group.Add( stemmedWord1, stemmedWord );
					}
				}
			}
		}
	}
}

CMCSynonymFile.prototype.AddSynonymStems	= function( term, termStem, stems )
{
	var synonym	= this.Directionals.GetItem( term );

	if ( synonym != null )
	{
		stems.AddUnique( synonym );
	}

	//

	synonym = this.DirectionalStems.GetItem( termStem );

	if ( synonym != null )
	{
		stems.AddUnique( synonym );
	}

	var group	= this.Groups.GetItem( term );

	if ( group != null )
	{
		for ( var key in group.GetKeys() )
		{
			stems.AddUnique( key );
		}
	}

	//

	group = this.GroupStems.GetItem( termStem );

	if ( group != null )
	{
		for ( var key in group.GetKeys() )
		{
			stems.AddUnique( key );
		}
	}
}

//
//    End class CMCSynonymFile
//

//
//    Class CMCSearchDB
//

function CMCSearchDB( dbFile, helpSystem )
{
	// Public properties

	this.URLSources				= new Array();
	this.URLTitles				= new Array();
	this.SearchDB				= new CMCDictionary();
	this.HelpSystem				= helpSystem;
	this.SearchType				= null;
	this.NGramSize				= 0;
	this.SynonymFile			= null;
	this.DownloadedSynonymFile	= null;
	
	//
	
	var xmlDoc	= CMCXmlParser.GetXmlDoc( this.HelpSystem.GetPath() + "Data/Synonyms.xml", false, null, null );
	
	if ( xmlDoc != null )
	{
		this.SynonymFile = new CMCSynonymFile( xmlDoc );
	}

	this.LoadSearchDB( this.HelpSystem.GetPath() + dbFile );
}

CMCSearchDB.prototype.LookupPhrases	= function( term, phrases )
{
    var stem	= stemWord( term );
    
    if ( typeof this.SearchDB.GetItem( stem ) == "string" )
    {
        this.LoadChunk( stem );
    }
    
    var stemMap	= this.SearchDB.GetItem( stem );
    
    if ( stemMap )
    {
        for ( var phrase in stemMap.GetKeys() )
        {
            phrases.Add( phrase, true );
        }
    }
}

CMCSearchDB.prototype.LookupStem	= function( resultSet, stem, dbIndex, buildWordMap, buildPhraseMap )
{
    if ( typeof this.SearchDB.GetItem( stem ) == "string" )
    {
        this.LoadChunk( stem );
    }
    
    var stemMap	= this.SearchDB.GetItem( stem );
    
    if ( stemMap )
    {
        for ( var phrase in stemMap.GetKeys() )
        {
            var phraseXMLNode = stemMap.GetItem( phrase );
            
            for ( var i = 0; i < phraseXMLNode.length; i++ )
            {
                var entry		= phraseXMLNode[i];
                var result		= new CMCQueryResult( dbIndex, entry, entry.Rank, phrase );
                
                resultSet.Add( result, buildWordMap, buildPhraseMap, false );
            }
        }
    }
}

// (Should be) Private member functions

CMCSearchDB.prototype.LoadSearchDB	= function( dbFile )
{
	var xmlDoc	= CMCXmlParser.GetXmlDoc( dbFile, false, null, null );
    var urls    = xmlDoc.getElementsByTagName( "Url" );
    var stems   = xmlDoc.getElementsByTagName( "stem" );
    var root	= xmlDoc.documentElement;
    
    this.SearchType = root.getAttribute( "SearchType" );
    this.NGramSize = FMCGetAttributeInt( root, "NGramSize", 0 );
    
    // Load URLs
    // Due to a bug in Safari, we can't store the whole URL node. When we try to access it in the future, Safari crashes.
    // Instead, we store the URL sources and titles individually rather than storing the entire URL node.
    
    for ( var i = 0; i < urls.length; i++ )
    {
        this.URLSources[i] = urls[i].getAttribute( "Source" );
        this.URLTitles[i] = urls[i].getAttribute( "Title" );
    }
    
    // Load stems
    
    for ( var i = 0; i < stems.length; i++ )
    {
        var stem        = stems[i];
        var stemName    = stem.getAttribute( "n" );
        var chunk       = stem.getAttribute( "chunk" );
        
        if ( chunk )
        {
            this.SearchDB.Add( stemName, chunk );
        }
        else
        {
            var phrases		= stem.getElementsByTagName( "phr" );
            var phraseMap	= new CMCDictionary();
            
            this.SearchDB.Add( stemName, phraseMap );
            
            // Load phrases
            
            for ( var j = 0; j < phrases.length; j++ )
            {
                var phrase			= phrases[j];
                var phraseName		= phrase.getAttribute( "n" );
                var entries			= phrase.getElementsByTagName( "ent" );
                var entriesArray	= new Array( entries.length );
                
                phraseMap.Add( phraseName, entriesArray );
                
                // Load entries
                
                for ( var k = 0; k < entries.length; k++ )
				{
					var phraseNode	= entries[k];
					var r			= parseInt( phraseNode.getAttribute( "r" ) );
					var t			= parseInt( phraseNode.getAttribute( "t" ) );
					var w			= parseInt( phraseNode.getAttribute( "w" ) );
					var entry		= new CMCEntry( r, t, w );
                    
					entriesArray[k] = entry;
				}
            }
        }
    }
}

CMCSearchDB.prototype.LoadChunk	= function( stem )
{
    var xmlDoc	= CMCXmlParser.GetXmlDoc( this.HelpSystem.GetPath() + "Data/" + this.SearchDB.GetItem( stem ), false, null, null );
    var stems   = xmlDoc.getElementsByTagName( "stem" );
    
    // Load stems
    
    for ( var i = 0; i < stems.length; i++ )
    {
        var stem        = stems[i];
        var stemName    = stem.getAttribute( "n" );
        var phrases     = stem.getElementsByTagName( "phr" );
        var phraseMap	= new CMCDictionary();
        
        this.SearchDB.Add( stemName, phraseMap );
        
        // Load phrases
        
        for ( var j = 0; j < phrases.length; j++ )
        {
            var phrase			= phrases[j];
            var phraseName		= phrase.getAttribute( "n" );
            var entries			= phrase.getElementsByTagName( "ent" );
            var entriesArray	= new Array( entries.length );
            
            phraseMap.Add( phraseName, entriesArray );
            
            // Load entries
            
            for ( var k = 0; k < entries.length; k++ )
            {
                var phraseNode	= entries[k];
                var r			= parseInt( phraseNode.getAttribute( "r" ) );
                var t			= parseInt( phraseNode.getAttribute( "t" ) );
                var w			= parseInt( phraseNode.getAttribute( "w" ) );
                var entry		= new CMCEntry( r, t, w );
                
                entriesArray[k] = entry;
            }
        }
    }
}

//
//    End class CMCSearchDB
//
