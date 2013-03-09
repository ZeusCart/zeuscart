// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

var gEmptyIcon				= null;
var gHalfFullIcon			= null;
var gFullIcon				= null;
var gIconWidth				= 16;
var gTopicRatingIconsInit	= false;

function TopicRatingIconsInit()
{
	if ( gTopicRatingIconsInit )
	{
		return;
	}
	
	//
	
	var value	= CMCFlareStylesheet.LookupValue( "ToolbarItem", "TopicRatings", "EmptyIcon", null );

	if ( value == null )
	{
		gEmptyIcon = MCGlobals.RootFolder + MCGlobals.SkinTemplateFolder + "Images/Rating0.gif";
		gIconWidth = 16;
	}
	else
	{
		value = FMCStripCssUrl( value );
		value = decodeURIComponent( value );
		value = escape( value );
		gEmptyIcon = MCGlobals.RootFolder + FMCGetSkinFolder() + value;
	}

	value = CMCFlareStylesheet.LookupValue( "ToolbarItem", "TopicRatings", "HalfFullIcon", null );

	if ( value == null )
	{
		gHalfFullIcon = MCGlobals.RootFolder + MCGlobals.SkinTemplateFolder + "Images/RatingGold50.gif";
	}
	else
	{
		value = FMCStripCssUrl( value );
		value = decodeURIComponent( value );
		value = escape( value );
		gHalfFullIcon = MCGlobals.RootFolder + FMCGetSkinFolder() + value;
	}

	value = CMCFlareStylesheet.LookupValue( "ToolbarItem", "TopicRatings", "FullIcon", null );

	if ( value == null )
	{
		gFullIcon = MCGlobals.RootFolder + MCGlobals.SkinTemplateFolder + "Images/RatingGold100.gif";
	}
	else
	{
		value = FMCStripCssUrl( value );
		value = decodeURIComponent( value );
		value = escape( value );
		gFullIcon = MCGlobals.RootFolder + FMCGetSkinFolder() + value;
	}
	
	//
	
	gTopicRatingIconsInit = true;
}

function FMCRatingIconsOnmousemove( e, iconContainer )
{
	TopicRatingIconsInit();
	
	//
	
	if ( !e ) { e = window.event; }

	var x				= FMCGetMouseXRelativeTo( window, e, iconContainer );
	var imgNodes		= iconContainer.getElementsByTagName( "img" );
	var numImgNodes		= imgNodes.length;
	var iconWidth		= gIconWidth;
	var maxIconWidth	= numImgNodes * iconWidth;
	var rating			= x * 100 / maxIconWidth;
	
	FMCDrawRatingIcons( rating, iconContainer );
}

function FMCClearRatingIcons( rating, iconContainer )
{
	FMCDrawRatingIcons( rating, iconContainer );
}

function FMCDrawRatingIcons( rating, iconContainer )
{
	TopicRatingIconsInit();
	
	//
	
	var imgNodes			= iconContainer.getElementsByTagName( "img" );
	var numImgNodes			= imgNodes.length;
	var iconWidth			= 16;
	var maxIconWidth		= numImgNodes * iconWidth;
	var x					= rating * maxIconWidth / 100;
	var numFullIcons		= Math.floor( x / iconWidth );
	var partialIconAmount	= x % iconWidth / iconWidth;
	
	for ( var i = 0; i < numImgNodes; i++ )
	{
		var node	= imgNodes[i];
		
		if ( i < numFullIcons )
		{
			node.src = gFullIcon;
		}
		else if ( i == numFullIcons )
		{
			if ( partialIconAmount == 0.0 )
			{
				node.src = gEmptyIcon;
			}
			else if ( partialIconAmount < 0.5 )
			{
				node.src = gHalfFullIcon;
			}
			else
			{
				node.src = gFullIcon;
			}
		}
		else
		{
			node.src = gEmptyIcon;
		}
	}
}

//
//    Class CMCLiveHelpServiceClient
//

var gLiveHelpServerUrl	= null;	// Set by compiler
/*DEBUG*/ gLiveHelpServerUrl = "https://feedbackserver.madcapsoftware.com/";	// Removed by compiler
gLiveHelpServerUrl = FMCGetFeedbackServerUrl( gLiveHelpServerUrl );

function FMCGetFeedbackServerUrl( serverUrl )
{
	var url			= serverUrl;
	var pos			= url.indexOf( ":" );
	var urlProtocol	= url.substring( 0, pos + 1 );
	var docProtocol	= document.location.protocol;
	
	if ( (!docProtocol.Equals( "https:", false ) || !urlProtocol.Equals( "https:", false )) && !urlProtocol.Equals( "http:", false ) )
	{
		url = url.substring( pos + 1 );
		url = "http:" + url;
	}
	
	if ( url.Contains( "madcapsoftware.com", false ) )
	{
		url = url + "LiveHelp/Service.LiveHelp/LiveHelpService.asmx/";
	}
	else
	{
		url = url + "Service.FeedbackExplorer/FeedbackJsonService.asmx/";
	}
	
	return url;
}

var gServiceClient	= new function()
{
	// Private member variables and functions
	
	var mLiveHelpScriptIndex				= 0;
	var mLiveHelpService					= gLiveHelpServerUrl;
	var mGetAverageRatingOnCompleteFunc		= null;
	var mGetAverageRatingOnCompleteArgs		= null;
	var mGetTopicCommentsOnCompleteFunc		= null;
	var mGetTopicCommentsOnCompleteArgs		= null;
	var mGetRecentCommentsOnCompleteFunc	= null;
	var mGetRecentCommentsOnCompleteArgs	= null;
	var mGetAnonymousEnabledOnCompleteFunc	= null;
	var mGetAnonymousEnabledOnCompleteArgs	= null;
	var mStartActivateUserOnCompleteFunc	= null;
	var mStartActivateUserOnCompleteArgs	= null;
	var mCheckUserStatusOnCompleteFunc		= null;
	var mCheckUserStatusOnCompleteArgs		= null;
	var mGetSynonymsFileOnCompleteFunc		= null;
	var mGetSynonymsFileOnCompleteArgs		= null;
	
	function AddScriptTag( src, onCompleteFunc )
	{
		var script		= document.createElement( "script" );
		var head		= document.getElementsByTagName( "head" )[0];
		var scriptID	= "MCLiveHelpScript_" + mLiveHelpScriptIndex++;

		src += "&OnComplete=" + onCompleteFunc + "&ScriptID=" + scriptID + "&UniqueID=" + (new Date()).getTime();

		script.id = scriptID;
		script.setAttribute( "type", "text/javascript" );
		script.setAttribute( "src", src );

		head.appendChild( script );
	}

    // Public member functions

	this.RemoveScriptTag	= function( scriptID )
	{
//		var	script	= document.getElementById( scriptID );
//		
//		script.parentNode.removeChild( script );

		// IE bug: Need this setTimeout() or else IE will crash. This happens when removing the <script> tag after re-navigating to the same page.
		
		window.setTimeout( "gServiceClient.RemoveScriptTag2( \"" + scriptID + "\" );", 10 );
	}
	
	this.RemoveScriptTag2	= function( scriptID )
	{
		var	script	= document.getElementById( scriptID );

		script.parentNode.removeChild( script );
	}
	
	this.LogTopic	= function( topicID )
	{
		var src	= mLiveHelpService +	"LogTopic?TopicID=" + encodeURIComponent( topicID );
		
		AddScriptTag( src, "gServiceClient.LogTopicOnComplete" );
	}
	
	this.LogTopicOnComplete	= function( scriptID )
	{
		this.RemoveScriptTag( scriptID );
	}
	
	this.LogSearch	= function( projectID, userGuid, resultCount, language, query )
	{
		var src	= mLiveHelpService +	"LogSearch?ProjectID=" + encodeURIComponent( projectID ) +
										"&UserGuid=" + encodeURIComponent( userGuid ) +
										"&ResultCount=" + encodeURIComponent( resultCount ) +
										"&Language=" + encodeURIComponent( language ) +
										"&Query=" + encodeURIComponent( query );
		
		AddScriptTag( src, "gServiceClient.LogSearchOnComplete" );
	}
	
	this.LogSearchOnComplete	= function( scriptID )
	{
		this.RemoveScriptTag( scriptID );
	}
	
	this.AddComment	= function( topicID, userGuid, userName, subject, comment, parentCommentID )
	{
		var src	= mLiveHelpService + "AddComment?" +	"TopicID=" + encodeURIComponent( topicID ) +
														"&UserGuid=" + encodeURIComponent( userGuid ) +
														"&Username=" + encodeURIComponent( userName ) +
														"&Subject=" + encodeURIComponent( subject ) +
														"&Comment=" + encodeURIComponent( comment );

		if ( parentCommentID != null )
		{
			src = src + "&ParentCommentID=" + parentCommentID;
		}
		
		AddScriptTag( src, "gServiceClient.AddCommentOnComplete" );
	}
	
	this.AddCommentOnComplete	= function( scriptID )
	{
		this.RemoveScriptTag( scriptID );
	}
	
	this.GetAverageRating	= function( topicID, onCompleteFunc, onCompleteArgs )
	{
		mGetAverageRatingOnCompleteFunc = onCompleteFunc;
		mGetAverageRatingOnCompleteArgs = onCompleteArgs;

		var src	= mLiveHelpService + "GetAverageRating?TopicID=" + encodeURIComponent( topicID );
		
		AddScriptTag( src, "gServiceClient.GetAverageRatingOnComplete" );
	}

	this.GetAverageRatingOnComplete	= function( scriptID, averageRating, ratingCount )
	{
		if ( mGetAverageRatingOnCompleteFunc != null )
		{
			mGetAverageRatingOnCompleteFunc( averageRating, ratingCount, mGetAverageRatingOnCompleteArgs );
			mGetAverageRatingOnCompleteFunc = null;
			mGetAverageRatingOnCompleteArgs = null;
		}
		
		//
		
		this.RemoveScriptTag( scriptID );
	}
	
	this.SubmitRating	= function( topicID, rating, comment )
	{
		var src	= mLiveHelpService +	"SubmitRating?TopicID=" + encodeURIComponent( topicID ) +
										"&Rating=" + encodeURIComponent( rating ) +
										"&Comment=" + encodeURIComponent( comment );
		
		AddScriptTag( src, "gServiceClient.SubmitRatingOnComplete" );
	}
	
	this.SubmitRatingOnComplete	= function( scriptID )
	{
		this.RemoveScriptTag( scriptID );
	}
	
	this.GetTopicComments	= function( topicID, userGuid, userName, onCompleteFunc, onCompleteArgs )
	{
		mGetTopicCommentsOnCompleteFunc = onCompleteFunc;
		mGetTopicCommentsOnCompleteArgs = onCompleteArgs;
		
		var src	= mLiveHelpService +	"GetTopicComments?TopicID=" + encodeURIComponent( topicID ) +
										"&UserGuid=" + encodeURIComponent( userGuid ) +
										"&Username=" + encodeURIComponent( userName );
		
		AddScriptTag( src, "gServiceClient.GetTopicCommentsOnComplete" );
	}

	this.GetTopicCommentsOnComplete	= function( scriptID, commentsXml )
	{
		if ( mGetTopicCommentsOnCompleteFunc != null )
		{
			mGetTopicCommentsOnCompleteFunc( commentsXml, mGetTopicCommentsOnCompleteArgs );
			mGetTopicCommentsOnCompleteFunc = null;
			mGetTopicCommentsOnCompleteArgs = null;
		}
		
		//
		
		this.RemoveScriptTag( scriptID );
	}
	
	this.GetRecentComments	= function( projectID, userGuid, userName, oldestComment, onCompleteFunc, onCompleteArgs )
	{
		mGetRecentCommentsOnCompleteFunc = onCompleteFunc;
		mGetRecentCommentsOnCompleteArgs = onCompleteArgs;

		var src	= mLiveHelpService +	"GetRecentComments?ProjectID=" + encodeURIComponent( projectID ) +
										"&UserGuid=" + encodeURIComponent( userGuid ) +
										"&Username=" + encodeURIComponent( userName ) +
										"&Oldest=" + encodeURIComponent( oldestComment );
		
		AddScriptTag( src, "gServiceClient.GetRecentCommentsOnComplete" );
	}

	this.GetRecentCommentsOnComplete	= function( scriptID, commentsXml )
	{
		if ( mGetRecentCommentsOnCompleteFunc != null )
		{
			mGetRecentCommentsOnCompleteFunc( commentsXml, mGetRecentCommentsOnCompleteArgs );
			mGetRecentCommentsOnCompleteFunc = null;
			mGetRecentCommentsOnCompleteArgs = null;
		}
		
		//
		
		this.RemoveScriptTag( scriptID );
	}
	
	this.GetAnonymousEnabled	= function( projectID, onCompleteFunc, onCompleteArgs )
	{
		mGetAnonymousEnabledOnCompleteFunc = onCompleteFunc;
		mGetAnonymousEnabledOnCompleteArgs = onCompleteArgs;
		
		var src	= mLiveHelpService +	"GetAnonymousEnabled?ProjectID=" + encodeURIComponent( projectID );
		
		AddScriptTag( src, "gServiceClient.GetAnonymousEnabledOnComplete" );
	}

	this.GetAnonymousEnabledOnComplete	= function( scriptID, enabled )
	{
		if ( mGetAnonymousEnabledOnCompleteFunc != null )
		{
			mGetAnonymousEnabledOnCompleteFunc( enabled, mGetAnonymousEnabledOnCompleteArgs );
			mGetAnonymousEnabledOnCompleteFunc = null;
			mGetAnonymousEnabledOnCompleteArgs = null;
		}
		
		//
		
		this.RemoveScriptTag( scriptID );
	}
	
	this.StartActivateUser	= function( username, emailAddress, firstName, lastName, country, zip, gender, uiLanguageOrder, onCompleteFunc, onCompleteArgs )
	{
		mStartActivateUserOnCompleteFunc = onCompleteFunc;
		mStartActivateUserOnCompleteArgs = onCompleteArgs;
		
		var src	= mLiveHelpService +	"StartActivateUser?Username=" + encodeURIComponent( username ) +
										"&EmailAddress=" + encodeURIComponent( emailAddress ) +
										"&FirstName=" + encodeURIComponent( firstName ) +
										"&LastName=" + encodeURIComponent( lastName ) +
										"&Country=" + encodeURIComponent( country ) +
										"&Zip=" + encodeURIComponent( zip ) +
										"&Gender=" + encodeURIComponent( gender ) +
										"&UILanguageOrder=" + encodeURIComponent( uiLanguageOrder );
		
		AddScriptTag( src, "gServiceClient.StartActivateUserOnComplete" );
	}

	this.StartActivateUserOnComplete	= function( scriptID, pendingGuid )
	{
		if ( mStartActivateUserOnCompleteFunc != null )
		{
			mStartActivateUserOnCompleteFunc( pendingGuid, mStartActivateUserOnCompleteArgs );
			mStartActivateUserOnCompleteFunc = null;
			mStartActivateUserOnCompleteArgs = null;
		}
		
		//
		
		this.RemoveScriptTag( scriptID );
	}
	
	this.CheckUserStatus	= function( pendingGuid, onCompleteFunc, onCompleteArgs )
	{
		mCheckUserStatusOnCompleteFunc = onCompleteFunc;
		mCheckUserStatusOnCompleteArgs = onCompleteArgs;
		
		var src	= mLiveHelpService +	"CheckUserStatus?PendingGuid=" + encodeURIComponent( pendingGuid );
		
		AddScriptTag( src, "gServiceClient.CheckUserStatusOnComplete" );
	}

	this.CheckUserStatusOnComplete	= function( scriptID, status )
	{
		if ( mCheckUserStatusOnCompleteFunc != null )
		{
			var func	= mCheckUserStatusOnCompleteFunc;
			var args	= mCheckUserStatusOnCompleteArgs;
			mCheckUserStatusOnCompleteFunc = null;
			mCheckUserStatusOnCompleteArgs = null;
			
			func( status, args );
		}
		
		//
		
		this.RemoveScriptTag( scriptID );
	}
	
	this.GetSynonymsFile	= function( projectID, updatedSince, onCompleteFunc, onCompleteArgs )
	{
		mGetSynonymsFileOnCompleteFunc = onCompleteFunc;
		mGetSynonymsFileOnCompleteArgs = onCompleteArgs;
		
		var src	= mLiveHelpService +	"GetSynonymsFile?ProjectID=" + encodeURIComponent( projectID ) +
										"&UpdatedSince=" + encodeURIComponent( updatedSince );
		
		AddScriptTag( src, "gServiceClient.GetSynonymsFileOnComplete" );
	}

	this.GetSynonymsFileOnComplete	= function( scriptID, synonymsXml )
	{
		if ( mGetSynonymsFileOnCompleteFunc != null )
		{
			mGetSynonymsFileOnCompleteFunc( synonymsXml, mGetSynonymsFileOnCompleteArgs );
			mGetSynonymsFileOnCompleteFunc = null;
			mGetSynonymsFileOnCompleteArgs = null;
		}
		
		//
		
		this.RemoveScriptTag( scriptID );
	}
}

//
//    End class CMCLiveHelpServiceClient
//
