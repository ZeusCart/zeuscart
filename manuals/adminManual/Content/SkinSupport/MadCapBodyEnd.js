// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

var gDocumentOnclickFunction    = document.onclick;
var gDocumentOnclickFuncs		= new Array();

gDocumentOnclickFuncs.push( FMCClickHandler );

document.onclick = function( e )
{
    gDocumentOnclickFunction ? gDocumentOnclickFunction() : false;
    
    for ( var i = 0; i < gDocumentOnclickFuncs.length; i++ )
    {
		gDocumentOnclickFuncs[i]( e );
    }
};

function FMCCheckForBookmarkInternal( a )
{
    var hrefPrefix  = FMCGetHref( document.location );
    var href        = FMCEscapeHref( a.href );
    
    if ( href.substring( 0, hrefPrefix.length ) != hrefPrefix )
    {
        return;
    }
    
    var hash        = a.href.substring( a.href.lastIndexOf( "#" ) + 1 );
    var bookmark    = null;
    
    for ( var i = 0; i < document.anchors.length; i++ )
    {
        var currAnchor  = document.anchors[i];
        
        if ( currAnchor.name == hash )
        {
            bookmark = currAnchor;
            
            break;
        }
    }
    
    if ( bookmark && typeof( FMCUnhide ) == "function" )
    {
        FMCUnhide( window, bookmark );
    }
}

function FMCClickHandler( e )
{
    var target  = null;
    
    if ( !e )
    {
        e = window.event;
    }
    
    if ( e.srcElement )
    {
        target = e.srcElement;
    }
    else if ( e.target )
    {
        target = e.target;
    }
    
    (target.nodeName == "A") ? FMCCheckForBookmarkInternal( target ) : false;
    
    //
    
    if ( typeof( gJustPopped ) == "undefined" )
    {
        return;
    }
    
    if ( !gJustPopped && gPopupObj && gPopupObj.style.display != "none" )
    {
        if ( typeof( FMCContainsClassRoot ) == "function" && FMCContainsClassRoot( gPopupObj.className, "MCKLinkBody" ) )
        {
            gPopupObj.parentNode.removeChild( gPopupObj );
            gPopupBGObj.parentNode.removeChild( gPopupBGObj );
        }
        else
        {
            if ( gImgNode && typeof( FMCImageSwap ) == "function"  )
            {
                FMCImageSwap( gImgNode, "swap" );
                gImgNode = null;
            }
            
            // Reset fading
            
			if ( gPopupObj.filters )
			{
				gPopupObj.style.filter = "alpha( opacity = 0 )";
				gPopupBGObj.style.filter = "alpha( opacity = 0 )";
			}
			else if ( gPopupObj.style.MozOpacity != null )
			{
				gPopupObj.style.MozOpacity = "0.0";
				gPopupBGObj.style.MozOpacity = "0.0";
			}
			
			//

            gPopupObj.style.display = "none";
            gPopupBGObj.parentNode.removeChild( gPopupBGObj );
        }
        
        if ( gFadeID != 0 )
        {
            clearInterval( gFadeID );
        }
        
        gPopupObj = null;
        gPopupBGObj = null;
        gFadeID = 0;
        
        if ( gTextPopupBody )
        {
            gTextPopupBody = null;
            gTextPopupBodyBG = null;
            window.onresize = null;
        }
    }
    
    gJustPopped = false;
}
