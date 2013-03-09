// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

function FMCSetClass(node, className)
{
    node.className = className;
    
   	for ( i = 0; i < node.childNodes.length; i++ )
    {
        var child = node.childNodes[i];
        FMCBroadcastNodeText(node, child);
	}
}

function FMCBroadcastNodeText(node, child)
{
    if( child.style == null) return;
        
         child.style.color = FMCGetComputedStyle( node, "color" );
        child.style.fontFamily = FMCGetComputedStyle( node, "fontFamily" );
        child.style.fontSize = FMCGetComputedStyle( node, "fontSize" );
        child.style.fontStyle = FMCGetComputedStyle( node, "fontStyle" );
        child.style.fontVariant = FMCGetComputedStyle( node, "fontVariant" );
        child.style.fontWeight = FMCGetComputedStyle( node, "fontWeight" );
        child.style.textDecoration = FMCGetComputedStyle( node, "textDecoration" );
        child.style.textTransform = FMCGetComputedStyle(node, "textTransform" );     

   	for ( i = 0; i < child.childNodes.length; i++ )
    {
        var grandchild = child.childNodes[i];
	
        FMCBroadcastNodeText(node, grandchild);
	}
}

function FMCSelectCell(node, select)
{
    var cell = FMCFindCell(node);
    var table = FMCFindTable(cell);
            
    if(cell == table.MCSelectedCell) 
    {
        if( !select)
        {
            FMCSetClass(table.MCSelectedCell, "MCKLinkBodyCell");
            table.MCSelectedCell = null;
            return;
       } 
       
       return;
    }

	if( !select)
	{
		return;
	}
    
    if(table.MCSelectedCell != null)
    {
        FMCSetClass(table.MCSelectedCell, "MCKLinkBodyCell");
        table.MCSelectedCell = null;
    }
    
    table.MCSelectedCell = cell;
    
    if(table.MCSelectedCell != null)
    {
        FMCSetClass(table.MCSelectedCell, "MCKLinkBodyCell_Highlighted");
    }
}

function FMCFindTable(node)
{
    if(node.nodeName == "TABLE") return node;
    
    return FMCFindTable(node.parentNode);
}

function FMCFindCell(node)
{
    if(node.nodeName == "TD" || node.nodeName == "TH") return node;
    
    return FMCFindCell(node.parentNode);
}

function FMCLinkControl( e, node )
{
    // Don't continue if something is already popped up
    
    if ( gPopupObj )
    {
        return;
    }
    
    if ( !e )
    {
        e = window.event;
    }

	var clientX	= FMCGetClientX( window, e );
	var clientY	= FMCGetClientY( window, e );
	var pageX	= FMCGetPageX( window, e );
	var pageY	= FMCGetPageY( window, e );
		
    var args	= { node: node, clientX: clientX, clientY: clientY, pageX: pageX, pageY: pageY };
    
    GetHelpControlLinks( node, OnGetHelpControlLinks, args );
}

function OnGetHelpControlLinks( topics, args )
{
	var node		= args.node;
    var klinkBody	= document.createElement( "div" );
    var table		= document.createElement( "table" );
    var tbody		= document.createElement( "tbody" );
    
    klinkBody.className = "MCKLinkBody";
    klinkBody.style.overflow = "auto";
    klinkBody.MCOwner = node;
    klinkBody.onkeyup = FMCKLinkBodyOnkeyup;
    
    table.style.border = "none";
    table.style.margin = "0px";
    table.style.padding = "0px";
    table.style.borderCollapse = "collapse";
    
    //
    
    if ( topics.length == 0 )
    {
        topics = new Array( 1 );
        topics[0] = "(No topics)|javascript:void( 0 );";
    }
    
    FMCSortStringArray( topics );
    
    table.appendChild( tbody );
    klinkBody.appendChild( table );
    document.body.appendChild( klinkBody );
    
    for ( var i = 0; i < topics.length; i++ )
    {
        var topic	= topics[i].split( "|" );
        var tr		= document.createElement( "tr" );
        var td		= document.createElement( "td" );
        var a		= document.createElement( "a" );

        td.onmouseover = function() { FMCSelectCell( this, true ); };    
        
        td.onclick = function()
        {
            FMCSelectCell( this, false );
            
            var inPreviewMode	= FMCInPreviewMode();
            
            if ( !inPreviewMode )
            {
				var rootFrame	= FMCGetRootFrame();
				
                rootFrame.frames["body"].document.location.href = this.getElementsByTagName( "a" )[0].href;
            }
            else
            {
                return false;
            }
        };
        
        a.appendChild( document.createTextNode( topic[0] ) );
        a.href = topic[1];
        a.target = "body";
        
        td.appendChild( a );
        tr.appendChild( td );
        tbody.appendChild( tr );

	    FMCSetClass( td, "MCKLinkBodyCell" );
    }
    
    // "+ 5" is to account for width of popup shadow.
    
    var clientHeight	= FMCGetClientHeight( window, false );
    var clientWidth		= FMCGetClientWidth( window, false );
    
    if ( klinkBody.offsetHeight + 5 > clientHeight )
    {
		klinkBody.style.height = (clientHeight - 5 - 2) + "px";	// "- 3" is to account for klinkBody borders.
		klinkBody.style.width = klinkBody.offsetWidth + 19 + "px";	// "+ 19" is to account for scrollbar.
    }
    
    if ( klinkBody.offsetWidth + 5 > clientWidth )
    {
		klinkBody.style.width = (clientWidth - 5 - 2) + "px";	// "- 3" is to account for klinkBody borders.
		klinkBody.style.height = klinkBody.offsetHeight + 19 + "px";	// "+ 19" is to account for scrollbar.
    }
    
    //
    
    var clientX	= 0;
    var clientY	= 0;
    var pageX	= 0;
    var pageY	= 0;
    
    if ( node.MCKeydown )
    {
		if ( node.parentNode.style.position == "absolute" )
		{
			topOffset = document.getElementById( "searchField" ).offsetHeight;
			
			clientX = node.parentNode.offsetLeft - node.parentNode.parentNode.parentNode.scrollLeft;
			clientY = node.parentNode.offsetTop - node.parentNode.parentNode.parentNode.scrollTop + topOffset;
			pageX = node.parentNode.offsetLeft - node.parentNode.parentNode.parentNode.scrollLeft;
			pageY = node.parentNode.offsetTop - node.parentNode.parentNode.parentNode.scrollTop + topOffset;
		}
		else
		{
			clientX = node.offsetLeft - FMCGetScrollLeft( window );
			clientY = node.offsetTop - FMCGetScrollTop( window );
			pageX = node.offsetLeft;
			pageY = node.offsetTop;
		}
    }
    else
    {
		clientX = args.clientX;
		clientY = args.clientY;
		pageX = args.pageX;
		pageY = args.pageY;
    }
    
    // "+ 5" is to account for width of popup shadow.
    
    if ( clientY + klinkBody.offsetHeight + 5 > FMCGetClientHeight( window, false ) )
    {
        klinkBody.style.top = FMCGetScrollTop( window ) + clientHeight - klinkBody.offsetHeight - 5 + "px";
    }
    else
    {
        klinkBody.style.top = pageY + "px";
    }
    
    if ( clientX + klinkBody.offsetWidth + 5 > FMCGetClientWidth( window, false ) )
    {
        klinkBody.style.left = FMCGetScrollLeft( window ) + clientWidth - klinkBody.offsetWidth - 5 + "px";
    }
    else
    {
        klinkBody.style.left = pageX + "px";
    }
    
    if ( node.MCKeydown )
    {
		klinkBody.getElementsByTagName( "a" )[0].focus();
		node.MCKeydown = false;
    }
    
    // Set up background
    
    var klinkBodyBG = document.createElement( "span" );
    
    klinkBodyBG.className = "MCKLinkBodyBG";
    klinkBodyBG.style.top = parseInt( klinkBody.style.top ) + 5 + "px";
    klinkBodyBG.style.left = parseInt( klinkBody.style.left ) + 5 + "px";
    klinkBodyBG.style.width = klinkBody.offsetWidth + "px";
    klinkBodyBG.style.height = klinkBody.offsetHeight + "px";
    
    klinkBody.parentNode.appendChild( klinkBodyBG );
    
    //

    MCFader.FadeIn( klinkBody, klinkBodyBG );
}

function FMCKLinkBodyOnkeyup( e )
{
	if ( !e ) { e = window.event; }
	
	if ( e.keyCode == 27 )
	{
		FMCClickHandler( e );
		this.MCOwner.focus();
	}
}
