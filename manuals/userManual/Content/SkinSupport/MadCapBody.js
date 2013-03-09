// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

//

if ( FMCIsDotNetHelp() || FMCIsHtmlHelp() )
{
	window.name = "body";
}

//

gOnloadFuncs.push( FMCInit );

//

var gInit	= false;

function FMCInit()
{
	if ( gInit )
	{
		return;
	}

	//

	FMCCheckForBookmark();

	if ( FMCIsWebHelp() && window.name == "body" )
	{
		FMCRegisterCallback( "TOC", MCEventType.OnInit, FMCOnTocInitialized, null );
	}
	
	if ( MCGlobals.ToolbarFrame != null )
	{
		FMCRegisterCallback( "Toolbar", MCEventType.OnInit, FMCOnToolbarLoaded, null );
	}
	
	if ( MCGlobals.BodyCommentsFrame != null )
	{
		FMCRegisterCallback( "BodyComments", MCEventType.OnLoad, FMCOnBodyCommentsLoaded, null );
	}
	
	if ( MCGlobals.TopicCommentsFrame != null )
	{
		FMCRegisterCallback( "TopicComments", MCEventType.OnInit, FMCOnTopicCommentsInit, null );
	}
	
	var rootFrame	= FMCGetRootFrame();

	if ( rootFrame )
	{
		rootFrame.FMCHighlightUrl( window );
	}
	else if ( typeof( FMCHighlightUrl ) != "undefined" )
	{
		FMCHighlightUrl( window );
	}
	
	//

	if ( MCGlobals.RootFrame == null && !FMCIsTopicPopup() )
	{
		var framesetLinks	= FMCGetElementsByClassRoot( document, "MCWebHelpFramesetLink" );
		
		for ( var i = 0; i < framesetLinks.length; i++ )
		{
			var framesetLink	= framesetLinks[i];
			framesetLink.style.display = "";
		}
	}

	//

	if ( typeof( gServiceClient ) != "undefined" && typeof( gServiceClient.LogTopic ) == "function" && !FMCIsSkinPreviewMode() )
	{
		var topicID	= FMCGetMCAttribute( document.documentElement, "MadCap:liveHelp" );

		gServiceClient.LogTopic( topicID );
	}

	//

	gInit = true;
}

function FMCOnTocInitialized()
{
	if ( MCGlobals.NavigationFrame.frames["toc"].gSyncTOC )
    {
        FMCSyncTOC();
    }
}

function FMCOnToolbarLoaded()
{
	if ( FMCIsLiveHelpEnabled() && MCGlobals.ToolbarFrame.document.getElementById( "RatingIcons" ) != null )
	{
		MCGlobals.ToolbarFrame.SetRating( 0 );
		
		FMCUpdateToolbarRating();
	}
}

function FMCUpdateToolbarRating()
{
	var topicID	= FMCGetMCAttribute( document.documentElement, "MadCap:liveHelp" );

	gServiceClient.GetAverageRating( topicID, FMCBodyGetRatingOnComplete, null );
}

function FMCOnBodyCommentsLoaded()
{
	MCGlobals.BodyCommentsFrame.Init( OnInit );
	
	function OnInit()
	{
		MCGlobals.BodyCommentsFrame.RefreshComments();
	}
}

function FMCOnTopicCommentsInit()
{
	var topicCommentsFrame	= MCGlobals.TopicCommentsFrame;

	topicCommentsFrame.RefreshComments();
}

function FMCBodyGetRatingOnComplete( averageRating, ratingCount, onCompleteArgs )
{
	var toolbarFrame	= MCGlobals.ToolbarFrame;
	
	toolbarFrame.SetRating( averageRating );
}

function FMCCheckForBookmark()
{
    var hash	= document.location.hash;
    
    if ( !hash )
    {
        return;
    }
    
    var bookmark	= null;
    
    if ( hash.charAt( 0 ) == "#" )
    {
        hash = hash.substring( 1 );
    }
    
    var currAnchor  = null;
    
    for ( var i = 0; i < document.anchors.length; i++ )
    {
        currAnchor = document.anchors[i];
        
        if ( currAnchor.name == hash )
        {
            bookmark = currAnchor;
            
            break;
        }
    }
    
    if ( currAnchor )
    {
        FMCUnhide( window, currAnchor );
        
        // Mozilla didn't navigate to the bookmark on load since it was inside a hidden node. So, after we ensure it's visible, navigate to the bookmark again.
        
        if ( !document.body.currentStyle )
        {
            document.location.href = document.location.href;
        }
    }
}

function FMCSyncTOC()
{
    if ( !MCGlobals.NavigationFrame.frames["toc"] || MCGlobals.BodyFrame.document != document )
    {
        return;
    }
    
    var tocPath = FMCGetMCAttribute( document.documentElement, "MadCap:tocPath" );
    
    MCGlobals.NavigationFrame.frames["toc"].SyncTOC( tocPath );
}

function FMCGlossaryTermHyperlinkOnClick( node )
{
    var navFrame	= MCGlobals.NavigationFrame;
    var anchorName	= FMCGetMCAttribute( node, "MadCap:anchor" );
    
    navFrame.SetActiveIFrameByName( "glossary" );
    navFrame.frames["glossary"].DropDownTerm( anchorName );
}
