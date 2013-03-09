// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

var gInit                       = false;
var gIndent						= 16;
var gIndexEntryCount			= 0;
var gIndexEntries				= new Array();
var gIndexDivs                  = new Array();
var gLinkMap                    = new CMCDictionary();
var gXMLDoc						= null;
var gChunks                     = null;
var gAlphaMap                   = new CMCDictionary();
var gSelectedItem               = null;
var gStylesMap                  = new CMCDictionary();
var gEntryHeight                = 15;
var gSelectionColor             = null;
var gSelectionBackgroundColor   = "#cccccc";
var gSearchFieldTitle			= "Index search text box";

function FindChunk( item )
{
	if ( gChunks.length == 0 )
	{
		return -1;
	}
	else
	{
		for ( var i = 0; i < gChunks.length; i++ )
		{
			var chunk   = gChunks[i];
			var start   = parseInt( chunk.getAttribute( "Start" ) );
			var count   = parseInt( chunk.getAttribute( "Count" ) );
	        
			if ( item >= start && item < start + count )
			{
				return i;
			}
		}
    }
}

function LoadChunk( index )
{
	var xmlDoc	= null;
	var start	= 0;
	
	if ( index == -1 )
	{
		xmlDoc = gXMLDoc;
	}
	else
	{
		var chunk		= gChunks[index];
		var link		= FMCGetAttribute( chunk, "Link" );
		var chunkPath	= null;
		
		if ( link.charAt( 0 ) == "/" )
		{
			chunkPath = MCGlobals.RootFolder + link.substring( 1 );
		}
		else
		{
			var masterHS	= parent.parent.GetMasterHelpSystem();

			if ( masterHS.IsWebHelpPlus )
			{
				chunkPath = MCGlobals.RootFolder + "AutoMergeCache/" + link;
			}
			else
			{
				chunkPath = MCGlobals.RootFolder + "Data/" + link;
			}
		}
		
		xmlDoc = CMCXmlParser.GetXmlDoc( chunkPath, false, null, null );
		
		start = parseInt( chunk.getAttribute( "Start" ) );
	}
	
    var	entries	= xmlDoc.getElementsByTagName( "IndexEntry" )[0].getElementsByTagName( "Entries" )[0];
    
    FillXmlItems( entries, start, 0 );
}

function FillXmlItems( entries, start, level )
{
	var numNodes	= entries.childNodes.length;
	
	for ( var i = 0; i < numNodes; i++ )
    {
		var currEntry	= entries.childNodes[i];
		
		if ( currEntry.nodeType != 1 ) { continue; }
		
		var indexEntry	= new CMCIndexEntry( currEntry, level );
		
		gIndexEntries[start] = indexEntry;
		
		SetLinkMap( (indexEntry.Level / gIndent) + "_" + indexEntry.Term.toLowerCase(), indexEntry.IndexLinks );
		
		var subNodeCount	= FillXmlItems( currEntry.getElementsByTagName( "Entries" )[0], start + 1, level + 1 );
		
		start = subNodeCount;
    }
    
    return start;
}

function LoadChunksForLetter( letter )
{
    var item	= gAlphaMap.GetItem( letter );
    var chunk	= FindChunk( item );
    
    while ( true )
    {
        LoadChunk( chunk );
        
        //
        
        if ( chunk == gChunks.length - 1 )
        {
            break;
        }
        
        var next	= gChunks[++chunk].getAttribute( "FirstTerm" ).charAt( 0 ).toLowerCase();
        
        if ( next > letter )
        {
            break;
        }
    }
}

//
//    Class CMCIndexEntry
//

function CMCIndexEntry( indexEntry, level )
{
    // Public properties
    
    var indexLinks	= FMCGetChildNodeByTagName( indexEntry, "Links", 0 ).childNodes;
    var numNodes	= indexLinks.length;
    var nodeCount	= 0;
    
    this.Term		= FMCGetAttribute( indexEntry, "Term" );
    this.IndexLinks	= new Array();
    this.Level		= level;
    
	for ( var i = 0; i < numNodes; i++ )
	{
		var indexLink	= indexLinks[i];
		
		if ( indexLink.nodeType != 1 ) { continue; }
		
		this.IndexLinks[nodeCount] = new CMCIndexLink( indexLink );
		
		nodeCount++;
	}
}

//
//    End class CMCIndexEntry
//

//
//    Class CMCIndexLink
//

function CMCIndexLink( indexLink )
{
	this.Title	= FMCGetAttribute( indexLink, "Title" );
	this.Link	= FMCGetAttribute( indexLink, "Link" );
}

//
//    End class CMCIndexLink
//

function RefreshIndex()
{
    var div			= document.getElementById( "CatapultIndex" ).parentNode;
    var firstIndex	= Math.floor( div.scrollTop / gEntryHeight );
    var lastIndex	= Math.ceil( (div.scrollTop + parseInt( div.style.height )) / gEntryHeight );

    for ( var i = firstIndex; i < lastIndex && i < gIndexEntryCount; i++ )
    {
        if ( !gIndexDivs[i] )
        {
			if ( !gIndexEntries[i] )
			{
				LoadIndexEntry( i );
            }
            
            BuildIndex( i );
        }
    }

    // Debug
    //window.status = "items: " + gIndexDivs.length + " entries: " + gIndexEntries.length + " scrollTop: " + div.scrollTop + " firstIndex: " + firstIndex + " lastIndex: " + lastIndex;
}

function LoadIndexEntry( index )
{
	var chunk	= FindChunk( index );

    LoadChunk( chunk );
}

var gDivCached	= null;
var gACached	= null;

function BuildIndex( index )
{
    var entry	= gIndexEntries[index];
    var div		= null;
    
    if ( !gDivCached )
    {
		gDivCached = document.createElement( "div" );
		
		gDivCached.style.position = "absolute";
		gDivCached.style.whiteSpace = "nowrap";
    }

	div = gDivCached.cloneNode( false );
    div.style.top = (gEntryHeight * index) + "px";
    div.style.textIndent = (entry.Level * gIndent) + "px";
    document.getElementById( "CatapultIndex" ).appendChild( div );
    
    gIndexDivs[index] = div;
    
    var a			= null;
    var term		= entry.Term;
    var indexLinks	= entry.IndexLinks;
    
    if ( !gACached )
    {
		gACached = document.createElement( "a" );
		gACached.appendChild( document.createTextNode( "&#160;" ) );
		
		for ( var key in gStylesMap.GetKeys() )
		{
			gACached.style[key] = gStylesMap.GetItem( key );
		}
    }

	a = gACached.cloneNode( true );
	a.firstChild.nodeValue = term;
	a.onmouseover = IndexEntryOnmouseover;
    a.onmouseout = IndexEntryOnmouseout;
    
    if ( indexLinks.length <= 1 )
    {
        if ( indexLinks.length == 1 )
        {
            var link	= indexLinks[0].Link;
            
            link = (link.charAt( 0 ) == "/") ? ".." + link : link;
            
            a.setAttribute( "href", link );
            a.setAttribute( "target", "body" );
        }
        else
        {
            a.setAttribute( "href", "javascript:void( 0 );" );
        }
        
        a.onclick = IndexEntryOnclick;
    }
    else if ( indexLinks.length > 1 )
    {
        a = GenerateKLink( a, indexLinks );
    }
    
    div.appendChild( a );
}

function IndexEntryOnmouseover()
{
	this.style.color = "#ff0000";
}

function IndexEntryOnmouseout()
{
	var color	= gStylesMap.GetItem( "color" );

	this.style.color = color ? color : "#0055ff";
}

function IndexEntryOnclick()
{
	HighlightEntry( this.parentNode );
}

function SetLinkMap( term, indexLinks )
{
    var linkMap = new CMCDictionary();
    
    for ( var i = 0; i < indexLinks.length; i++ )
    {
		var indexLink	= indexLinks[i];
		
        linkMap.Add( indexLink.Title, indexLink.Link );
    }
    
    gLinkMap.Add( term, linkMap );
}

function CreateIndex( xmlDoc )
{
    var chunks		= xmlDoc.getElementsByTagName( "Chunk" );
    var xmlHead		= xmlDoc.getElementsByTagName( "CatapultTargetIndex" )[0];
    var attributes	= xmlHead.attributes;
    
    gIndexEntryCount = parseInt( FMCGetAttribute( xmlHead, "Count" ) );
    
    for ( var i = 0; i < attributes.length; i++ )
    {
        var name    = attributes[i].nodeName;
        var value   = parseInt( attributes[i].nodeValue );
        
        if ( name.substring( 0, 5 ) != "Char_" && name.substring( 0, 5 ) != "char_" )
        {
            continue;
        }
        
        var first   = String.fromCharCode( name.substring( 5, name.length )  ).toLowerCase();
        var start   = gAlphaMap.GetItem( first );
        
        if ( start != null )
        {
            value = Math.min( value, start );
        }
        
        gAlphaMap.Add( first, value );
    }
    
    if ( chunks.length == 0 )
    {
        var xmlNode	= xmlDoc.getElementsByTagName( "IndexEntry" )[0].getElementsByTagName( "Entries" )[0];
        
        gIndexEntryCount = 0;
        
        for ( var i = 0; i < xmlNode.childNodes.length; i++ )
        {
            var entry	= xmlNode.childNodes[i];
            
            if ( entry.nodeName == "IndexEntry" )
            {
                var term	= FMCGetAttribute( entry, "Term" );
                
                if ( !term )
                {
                    term = "";
                }
                
                var first	= term.charAt( 0 ).toLowerCase();
                
                if ( gAlphaMap.GetItem( first ) == null )
                {
                    gAlphaMap.Add( first, gIndexEntryCount );
                }
                
                // When incrementing, must include all sub-level index entries
                
                gIndexEntryCount += entry.getElementsByTagName( "IndexEntry" ).length + 1;
            }
        }
    }
    
    document.getElementById( "CatapultIndex" ).style.height = gIndexEntryCount * gEntryHeight + "px";
    gChunks = chunks;
}

function GenerateKLink( a, indexLinks )
{
    var topics	= "";
    
    for ( var i = 0; i < indexLinks.length; i++ )
    {
        if ( i > 0 )
        {
            topics += "||";
        }
        
        var indexLink	= indexLinks[i];
        var link		= indexLink.Link;
        
        link = (link.charAt( 0 ) == "/") ? ".." + link : link;
        
        topics += indexLink.Title + "|" + link;
    }
    
    a.href = "javascript:void( 0 );";
    a.className = "MCKLink";
    a.setAttribute( "MadCap:topics", topics );
    a.onclick = KLinkOnclick;
    a.onkeydown = KLinkOnkeydown;
    
    return a;
}

function KLinkOnclick( e )
{
	HighlightEntry( this.parentNode );
	FMCLinkControl( e, this );
	
	return false;
}

function KLinkOnkeydown()
{
	this.MCKeydown = true;
}

function Init( OnCompleteFunc )
{
    if ( gInit )
    {
		OnCompleteFunc();
        return;
    }
    
    //
	
	var fontSizePx	= 12;
	
    if ( gStylesMap.GetItem( "fontSize" ) )
    {
		fontSizePx = FMCConvertToPx( document, gStylesMap.GetItem( "fontSize" ), null, 12 );
    }
    
    gEntryHeight = fontSizePx + 3;
    
    document.getElementById( "searchField" ).title = gSearchFieldTitle;
    
    //
    
    function GetIndexOnComplete( xmlDoc, args )
	{
		gXMLDoc = xmlDoc;
		
		CreateIndex( gXMLDoc );

		RefreshIndex();
		
		//
		
		gInit = true;
		
		OnCompleteFunc();
	}

	parent.parent.GetMasterHelpSystem().GetIndex( GetIndexOnComplete, null );
}

function HighlightEntry( node )
{
    if ( gSelectedItem )
    {
        var color           = gStylesMap.GetItem( "color" );
        var backgroundColor = gStylesMap.GetItem( "backgroundColor" );
        
        gSelectedItem.firstChild.style.color = color ? color : "#0055ff";
        gSelectedItem.firstChild.style.backgroundColor = backgroundColor ? backgroundColor : "Transparent";
    }
    
    gSelectedItem = node;
    
    if ( gSelectedItem )
    {
        if ( gSelectionColor )
        {
            gSelectedItem.firstChild.style.color = gSelectionColor;
        }
        
        gSelectedItem.firstChild.style.backgroundColor = gSelectionBackgroundColor;
    }
}

function SelectEntry( e )
{
    if ( !e )
    {
        e = window.event;
    }
    
    if ( e.keyCode == 116 )
    {
        return;
    }
    else if ( e.keyCode == 13 )
    {
        if ( gSelectedItem )
        {
            parent.parent.frames["body"].location.href = gSelectedItem.childNodes[0].href;
        }
        
        return;
    }

    var text            = document.getElementById( "searchField" ).value.toLowerCase();
	var textParts		= text.split( "," );
	var indexEntryIndex	= SelectIndexEntry( textParts );
	var item			= 0;
	var indexDiv		= null;
	
	if ( indexEntryIndex == -1 )
	{
		item = 0;
	}
	else
	{
		item = indexEntryIndex;
	}
	
	document.getElementById( "CatapultIndex" ).parentNode.scrollTop = item * gEntryHeight;
	RefreshIndex();
	
	if ( indexEntryIndex != -1 )
	{
		indexDiv = gIndexDivs[indexEntryIndex]
	}
	
	HighlightEntry( indexDiv );
}

function SelectIndexEntry( textParts )
{
	var text	= textParts[0];
	
	do
	{
		if ( text == "" )
		{
			break;
		}
		
		var first			= text.charAt( 0 );
		var item			= gAlphaMap.GetItem( first );
		var indexEntryIndex	= -1;

		if ( item == null )
		{
			item = 0;
		}
	} while ( false )

	return FindIndexEntry( textParts, 0, item );
}

function FindIndexEntry( textParts, partIndex, indexEntryIndex )
{
	var newIndexEntryIndex	= -1;
	var lastIndexEntryIndex	= indexEntryIndex;
	var text				= FMCTrim( textParts[partIndex].toLowerCase() );
	
	do
    {
		if ( text == "" )
		{
			break;
		}
		
		var currIndexEntry	= null;
        
        for ( var i = indexEntryIndex; ; i++ )
        {
			if ( i == gIndexEntryCount )
            {
				newIndexEntryIndex = lastIndexEntryIndex;
				break;
            }
            
            if ( !gIndexEntries[i] )
            {
                LoadChunksForLetter( text.charAt( 0 ) );
            }
            
            currIndexEntry = gIndexEntries[i];
            
            var term	= currIndexEntry.Term.toLowerCase();
            
            if ( currIndexEntry.Level > gIndexEntries[indexEntryIndex].Level )
            {
                continue;
            }
            else if ( currIndexEntry.Level < gIndexEntries[indexEntryIndex].Level )
            {
				newIndexEntryIndex = lastIndexEntryIndex;
                break;
            }
            else if ( term.substring( 0, text.length ) == text )
            {
				newIndexEntryIndex = i;
                break;
            }
            else if ( term > text )
            {
				newIndexEntryIndex = lastIndexEntryIndex;
				
				for ( var subText = text.substring( 0, text.length - 1 ); subText != ""; subText = subText.substring( 0, subText.length - 1 ) )
				{
					if ( term.substring( 0, subText.length ) == subText )
					{
						newIndexEntryIndex = i;
					}
				}
				
                break;
            }
            else
            {
				lastIndexEntryIndex = i;
            }
        }
    } while ( false )
    
    if ( partIndex + 1 < textParts.length )
    {
		var nextIndexEntryIndex	= newIndexEntryIndex + 1;
		
		if ( newIndexEntryIndex != -1 &&
			 nextIndexEntryIndex < gIndexEntryCount &&
			 gIndexEntries[nextIndexEntryIndex] && gIndexEntries[nextIndexEntryIndex].Level > gIndexEntries[newIndexEntryIndex].Level )
		{
			var subIndexEntryIndex	= FindIndexEntry( textParts, partIndex + 1, nextIndexEntryIndex );
			
			if ( subIndexEntryIndex != -1 )
			{
				newIndexEntryIndex = subIndexEntryIndex;
			}
		}
    }
    
    return newIndexEntryIndex;
}
