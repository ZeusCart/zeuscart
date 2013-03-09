// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

var gColorTable		= new Array( "#ffff66,#000000",
                                 "#a0ffff,#000000",
                                 "#99ff99,#000000",
                                 "#ff9999,#000000",
                                 "#ff66ff,#000000",
                                 "#880000,#ffffff",
                                 "#00aa00,#ffffff",
                                 "#886800,#ffffff",
                                 "#004699,#ffffff",
                                 "#990099,#ffffff" );
var gColorIndex		= 0;
var gFirstHighlight	= null;
var gSearchType		= null;

function FMCClearSearch( win )
{
    var highlights	= FMCGetElementsByClassRoot( win.document, "highlight" );
    
    for ( var i = 0; i < highlights.length; i++ )
    {
		var highlight	= highlights[i];
		var innerSpan	= FMCGetChildNodeByTagName( highlight, "SPAN", 0 );
        var text		= win.document.createTextNode( innerSpan.innerHTML );
        
        highlight.parentNode.replaceChild( text, highlight );
    }
    
    gColorIndex = 0;
    gFirstHighlight = null;
    
    // At this point, highlight nodes got replaced by text nodes. This causes nodes that were once single text nodes to
    // become divided into multiple text nodes. Future attempts to highlight multi-character strings may not work
    // because they may have been divided into multiple text nodes. To solve this, we merge adjacent text nodes.
    
    FMCMergeTextNodes( win.document.body );
}

function FMCMergeTextNodes( node )
{
    for ( var i = node.childNodes.length - 1; i >= 1; i-- )
    {
        var currNode	= node.childNodes[i];
        var prevNode	= currNode.previousSibling;
        
        if ( currNode.nodeType == 3 && prevNode.nodeType == 3 )
        {
            prevNode.nodeValue = prevNode.nodeValue + currNode.nodeValue;
            node.removeChild( currNode );
        }
    }
    
    for ( var i = 0; i < node.childNodes.length; i++ )
    {
        FMCMergeTextNodes( node.childNodes[i] );
    }
}

function FMCApplyHighlight( win, root, term, color, caseSensitive )
{
	var re	= null;
	
	if ( gSearchType == "NGram" )
	{
		re = new RegExp( term, "g" + (caseSensitive ? "" : "i") );
	}
	else
	{
		re = new RegExp( "(^|\\s|[.,;!#$/:?'\"()[\\]{}|=+*_\\-\\\\])" + term + "($|\\s|[.,;!#$/:?'\"()[\\]{}|=+*_\\-\\\\])", "g" + (caseSensitive ? "" : "i") );
	}

    for ( var i = root.childNodes.length - 1; i >= 0; i-- )
    {
        var node    = root.childNodes[i];
        
        FMCApplyHighlight( win, node, term, color, caseSensitive );
        
        if ( node.nodeType != 3 || node.parentNode.nodeName == "SCRIPT" )
        {
            continue;
        }
        
        var currNode    = node;
        var text        = currNode.nodeValue;
        
        for ( var match = re.exec( text ); match != null; match = re.exec( text ) )
        {
			var pos		= match.index + (gSearchType == "NGram" ? 0 : match[1].length);
			var posEnd	= pos + term.length;
            var span    = win.document.createElement( "span" );
            
            span.className = "highlight";
            span.style.fontWeight = "bold";
            span.style.backgroundColor = color.split( "," )[0];
            span.style.color = color.split( "," )[1];
            
            var span2	= win.document.createElement( "span" );

            span2.className = "SearchHighlight" + (gColorIndex + 1);
            span2.appendChild( win.document.createTextNode( text.substring( pos, posEnd ) ) );
            
            span.appendChild( span2 );
            
            currNode.nodeValue = text.substring( 0, pos );
            currNode.parentNode.insertBefore( span, currNode.nextSibling );
            currNode.parentNode.insertBefore( win.document.createTextNode( text.substring( posEnd, text.length ) ), span.nextSibling );
            
            currNode = currNode.nextSibling.nextSibling;
            text = currNode.nodeValue;
            
            //
            
            if ( !gFirstHighlight )
            {
                gFirstHighlight = span;
            }
            
            //
            
            FMCUnhide( win, span );
        }
    }
}

function FMCHighlight( win, term, color, caseSensitive )
{
    if ( term == "" )
    {
        return;
    }

    FMCApplyHighlight( win, win.document.body, term, color, caseSensitive );
    
    // Scroll to first highlighted term
    
    if ( gFirstHighlight && gFirstHighlight.offsetTop > win.document.documentElement.clientHeight )
    {
        win.document.documentElement.scrollTop = gFirstHighlight.offsetTop;
    }
}

function FMCHighlightUrl( win )
{
	gColorIndex = 0;
    gFirstHighlight = null;
	
    var url = win.document.location.search;
    
    if ( url.IsNullOrEmpty() )
    {
		return;
    }
    
    url = decodeURIComponent( url );

    var pos		= url.indexOf( "SearchType" );
    var ampPos	= -1;
    
    if ( pos >= 0 )
    {
		ampPos = url.indexOf( "&", pos );
		gSearchType = url.substring( 1 + pos + "SearchType".length, ampPos >= 0 ? ampPos : url.length );
    }
    
    pos = url.indexOf( "Highlight" );
    
    if ( pos >= 0 )
    {
		ampPos = url.indexOf( "&", pos );
		
        var highlight	= url.substring( 1 + pos + "Highlight".length, ampPos >= 0 ? ampPos : url.length );
        var stems		= highlight.split( "||" );
        
        for ( var i = 0; i < stems.length; i++ )
        {
            var phrases	= stems[i].split( "|" );
            
            for ( var j = 0; j < phrases.length; j++ )
            {
                FMCHighlight( win, phrases[j], gColorTable[gColorIndex], false );
            }
            
            gColorIndex = (++gColorIndex) % 10;
        }
    }
}
