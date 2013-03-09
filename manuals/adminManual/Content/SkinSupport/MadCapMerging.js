// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

//
//    Class CMCHelpSystem
//

function CMCHelpSystem( parentSubsystem, parentPath, xmlFile, tocPath )
{
	// Private member variables

	var mSelf				= this;
	var mParentSubsystem	= parentSubsystem;
	var mPath				= parentPath;
	var mXmlFile			= xmlFile;
	var mSubsystems			= new Array();
	var mTocPath			= tocPath;
	var mConceptMap			= null;
	var mViewedConceptMap	= new CMCDictionary();
	var mExists				= false;

	// Public properties

	this.TargetType			= null;
	this.LiveHelpOutputId	= null;
	this.LiveHelpServer		= null;
	this.IsWebHelpPlus		= null;

	// Constructor

	Constructor();

	function Constructor()
	{
		var xmlDoc	= CMCXmlParser.GetXmlDoc( xmlFile, false, null, null );
	    
		mExists = xmlDoc ? true : false;
	    
		if ( mExists )
		{
			if ( xmlDoc.getElementsByTagName( "Subsystems" ).length > 0 )
			{
				var urlNodes    = xmlDoc.getElementsByTagName( "Subsystems" )[0].getElementsByTagName( "Url" );
		        
				for ( var i = 0; i < urlNodes.length; i++ )
				{
					var urlNode	= urlNodes[i];
					var url		= urlNode.getAttribute( "Source" );
					var subPath	= url.substring( 0, url.lastIndexOf( "/" ) + 1 );
					var tocPath	= urlNode.getAttribute( "TocPath" );
		            
					mSubsystems.push( new CMCHelpSystem( mSelf, mPath + subPath, mPath + url.substring( 0, url.lastIndexOf( "." ) ) + ".xml", tocPath ) );
				}
			}
			
			mSelf.TargetType = xmlDoc.documentElement.getAttribute( "TargetType" );
			mSelf.LiveHelpOutputId = xmlDoc.documentElement.getAttribute( "LiveHelpOutputId" );
			mSelf.LiveHelpServer = xmlDoc.documentElement.getAttribute( "LiveHelpServer" );
			mSelf.IsWebHelpPlus = mSelf.TargetType == "WebHelpPlus" && document.location.protocol.StartsWith( "http", false );
		}
	}

    // Public member functions
    
    this.GetExists      = function()
    {
        return mExists;
    };
    
    this.GetParentSubsystem = function()
    {
        return mParentSubsystem;
    };
    
    this.GetPath        = function()
    {
        return mPath;
    };
    
    this.GetTocPath     = function()
    {
        return mTocPath;
    };
    
    this.GetFullTocPath = function( tocPath )
    {
        if ( mParentSubsystem )
        {
            tocPath.tocPath = tocPath.tocPath ? mTocPath + "|" + tocPath.tocPath : mTocPath;
            mParentSubsystem.GetFullTocPath( tocPath );
        }
    };
    
    this.GetHelpSystem  = function( path )
    {
		var helpSystem	= null;
		
        if ( mPath == path )
        {
            return this;
        }
        
        for ( var i = 0; i < mSubsystems.length; i++ )
        {
            helpSystem = mSubsystems[i].GetHelpSystem( path );
            
            if ( helpSystem != null )
            {
				break;
            }
        }
        
        return helpSystem;
    };
    
    this.GetSubsystem   = function( id )
    {
        return mSubsystems[id];
    };
    
    this.GetIndex       = function( onCompleteFunc, onCompleteArgs )
    {
		if ( !this.IsWebHelpPlus )
		{
			var xmlDoc		= LoadFirstIndex();
			var preMerged	= FMCGetAttributeBool( xmlDoc.documentElement, "PreMerged", false );
	        
			if ( !preMerged && mSubsystems.length != 0 )
			{
				xmlDoc = LoadEntireIndex();
	            
				for ( var i = 0; i < mSubsystems.length; i++ )
				{
					var subsystem	= mSubsystems[i];
	                
					if ( !subsystem.GetExists() )
					{
						continue;
					}
	                
					var xmlDoc2	= subsystem.GetMergedIndex();
	                
					MergeIndexEntries( xmlDoc.getElementsByTagName( "IndexEntry" )[0], xmlDoc2.getElementsByTagName( "IndexEntry" )[0] );
				}
			}
	        
	        onCompleteFunc( xmlDoc, onCompleteArgs );
		}
		else
		{
			function OnGetIndexComplete( xmlDoc, args )
			{
				onCompleteFunc( xmlDoc, onCompleteArgs );
			}

			var xmlDoc	= CMCXmlParser.CallWebService( MCGlobals.RootFolder + "Service/Service.asmx/GetIndex", true, OnGetIndexComplete, null );
		}
    };
    
    this.GetMergedIndex = function()
    {
        var xmlDoc  = LoadEntireIndex();
        
        for ( var i = 0; i < mSubsystems.length; i++ )
        {
            var subsystem   = mSubsystems[i];
            
            if ( !subsystem.GetExists() )
            {
                continue;
            }
            
            var xmlDoc2 = subsystem.GetMergedIndex();
            
            MergeIndexEntries( xmlDoc.getElementsByTagName( "IndexEntry" )[0], xmlDoc2.getElementsByTagName( "IndexEntry" )[0] );
        }
        
        return xmlDoc;
    };
    
    this.HasBrowseSequences	= function()
    {
		var xmlFile	= mXmlFile.substring( 0, mXmlFile.lastIndexOf( "." ) ) + ".xml";
		var xmlDoc	= CMCXmlParser.GetXmlDoc( xmlFile, false, null, null );
		
		return xmlDoc.documentElement.getAttribute( "BrowseSequence" ) != null;
    };
    
    this.HasToc				= function()
    {
		var xmlFile	= mXmlFile.substring( 0, mXmlFile.lastIndexOf( "." ) ) + ".xml";
		var xmlDoc	= CMCXmlParser.GetXmlDoc( xmlFile, false, null, null );
		
		return xmlDoc.documentElement.getAttribute( "Toc" ) != null;
    };
    
    this.IsMerged       = function()
    {
        return (mSubsystems.length > 0);
    };
    
    this.GetConceptsLinks	= function( conceptTerms, callbackFunc, callbackArgs )
    {
		if ( this.IsWebHelpPlus )
		{
			function OnGetTopicsForConceptsComplete( xmlDoc, args )
			{
				var links		= new Array();
				var nodes		= xmlDoc.documentElement.getElementsByTagName( "Url" );
				var nodeLength	= nodes.length;
				
				for ( var i = 0; i < nodeLength; i++ )
				{
					var node	= nodes[i];
					var title	= node.getAttribute( "Title" );
					var url		= node.getAttribute( "Source" );
	                
					url = mPath + ((url.charAt( 0 ) == "/") ? url.substring( 1, url.length ) : url);
	                
					links[links.length] = title + "|" + url;
				}
				
				callbackFunc( links, callbackArgs );
			}
			
			var xmlDoc	= CMCXmlParser.CallWebService( MCGlobals.RootFolder + "Service/Service.asmx/GetTopicsForConcepts?Concepts=" + conceptTerms, true, OnGetTopicsForConceptsComplete, null );
		}
		else
		{
			var links	= null;

			conceptTerms = conceptTerms.replace( "\\;", "%%%%%" );
			
			if ( conceptTerms == "" )
			{
				links = new Array();
				callbackFunc( links, callbackArgs );
			}
			
			var concepts	= conceptTerms.split( ";" );
			
			links = this.GetConceptsLinksLocal( concepts );
			
			callbackFunc( links, callbackArgs );
		}
	};
		
	this.GetConceptsLinksLocal	= function( concepts )
	{
		var links	= new Array();
		
		for ( var i = 0; i < concepts.length; i++ )
		{
			var concept	= concepts[i];
			
			concept = concept.replace( "%%%%%", ";" );
			concept = concept.toLowerCase();
			
			var currLinks	= this.GetConceptLinksLocal( concept );
	        
			for ( var j = 0; j < currLinks.length; j++ )
			{
				links[links.length] = currLinks[j];
			}
		}
		
		return links;
    };
    
    this.GetConceptLinksLocal	= function( concept )
	{
		LoadConcepts();
		
		var links	= mViewedConceptMap.GetItem( concept );
	        
		if ( !links )
		{
			links = mConceptMap.GetItem( concept );
            
			if ( !links )
			{
				links = new Array( 0 );
			}
			
			for ( var i = 0; i < mSubsystems.length; i++ )
			{
				var subsystem   = mSubsystems[i];
	            
				if ( !subsystem.GetExists() )
				{
					continue;
				}
	            
				MergeConceptLinks( links, subsystem.GetConceptLinksLocal( concept ) );
			}

			mViewedConceptMap.Add( concept, links );
		}
		
		return links;
	};
    
    this.LoadGlossary   = function( onCompleteFunc, onCompleteArgs )
    {
		if ( !this.IsWebHelpPlus )
		{
			if ( !this.IsMerged() )
			{
				return;
			}
	        
			var xmlDoc	= this.GetGlossary();
			
			onCompleteFunc( xmlDoc, onCompleteArgs );
		}
		else
		{
			function OnGetGlossaryComplete( xmlDoc, args )
			{
				onCompleteFunc( xmlDoc, onCompleteArgs );
			}

			var xmlDoc	= CMCXmlParser.CallWebService( MCGlobals.RootFolder + "Service/Service.asmx/GetGlossary", true, OnGetGlossaryComplete, null );
		}
    }
    
    this.GetGlossary    = function()
    {
        var xmlDoc	= CMCXmlParser.GetXmlDoc( mPath + "Content/Glossary.xml", false, null, null );
        
        for ( var i = 0; i < mSubsystems.length; i++ )
        {
            var subsystem   = mSubsystems[i];
            
            if ( !subsystem.GetExists() )
            {
                continue;
            }
            
            MergeGlossaries( xmlDoc, subsystem );
        }
        
        return xmlDoc;
    };
    
    this.GetSearchDBs   = function()
    {
        var searchDBs	= new Array();
        var rootFrame	= FMCGetRootFrame();
        var xmlDoc      = CMCXmlParser.GetXmlDoc( mPath + "Data/Search.xml", false, null, null );
        var preMerged	= FMCGetAttributeBool( xmlDoc.documentElement, "PreMerged", false );

        searchDBs[searchDBs.length] = new rootFrame.frames["navigation"].frames["search"].CMCSearchDB( "Data/Search.xml", this );
        
        if ( !preMerged )
        {
			for ( var i = 0; i < mSubsystems.length; i++ )
			{
				var subsystem   = mSubsystems[i];
	            
				if ( !subsystem.GetExists() )
				{
					continue;
				}
	            
				var searchDBs2  = subsystem.GetSearchDBs();
	            
				for ( var j = 0; j < searchDBs2.length; j++ )
				{
					searchDBs[searchDBs.length] = searchDBs2[j];
				}
			}
        }
        
        return searchDBs;
    };
    
    // Private member functions
    
    function LoadFirstIndex()
    {
        var xmlDoc	= CMCXmlParser.GetXmlDoc( mPath + "Data/Index.xml", false, null, null );
        
        return xmlDoc;
    }
    
    function LoadEntireIndex()
    {
        var xmlDoc      = LoadFirstIndex();
        var head        = xmlDoc.documentElement;
        var chunkNodes  = xmlDoc.getElementsByTagName( "Chunk" );
        
        if ( chunkNodes.length > 0 )
        {
            // Remove all attributes except "Count"
            
            var attributesClone = head.cloneNode( false ).attributes;
            
            for ( var i = 0; i < attributesClone.length; i++ )
            {
                if ( attributesClone[i].nodeName != "Count" && attributesClone[i].nodeName != "count" )
                {
                    head.removeAttribute( attributesClone[i].nodeName );
                }
            }
            
            // Merge all chunks
            
            for ( var i = 0; i < chunkNodes.length; i++ )
            {
                var xmlDoc2 = CMCXmlParser.GetXmlDoc( mPath + "Data/" + FMCGetAttribute( chunkNodes[i], "Link" ), false, null, null );
                
                MergeIndexEntries( xmlDoc.getElementsByTagName( "IndexEntry" )[0], xmlDoc2.getElementsByTagName( "IndexEntry" )[0] );
            }
            
            head.removeChild( chunkNodes[0].parentNode );
        }
        
        // Make links absolute
        
        for ( var i = 0; i < xmlDoc.documentElement.childNodes.length; i++ )
        {
            if ( xmlDoc.documentElement.childNodes[i].nodeName == "IndexEntry" )
            {
                ConvertIndexLinksToAbsolute( xmlDoc.documentElement.childNodes[i] );
                
                break;
            }
        }
        
        //
        
        return xmlDoc;
    }
    
    function MergeIndexEntries( indexEntry1, indexEntry2 )
    {
        var xmlDoc1     = indexEntry1.ownerDocument;
        var entries1    = indexEntry1.getElementsByTagName( "Entries" )[0];
        var entries2    = indexEntry2.getElementsByTagName( "Entries" )[0];
        var entries     = xmlDoc1.createElement( "IndexEntry" ).appendChild( xmlDoc1.createElement( "Entries" ) );
        
        if ( entries1.getElementsByTagName( "IndexEntry" ).length == 0 )
        {
            if ( xmlDoc1.importNode )
            {
                entries = xmlDoc1.importNode( entries2, true );
            }
            else
            {
                entries = entries2.cloneNode( true );
            }
        }
        else if ( entries2.getElementsByTagName( "IndexEntry" ).length == 0 )
        {
            entries = entries1.cloneNode( true );
        }
        else
        {
            for ( var i = 0, j = 0; i < entries1.childNodes.length && j < entries2.childNodes.length; )
            {
                var currIndexEntry1 = entries1.childNodes[i];
                var currIndexEntry2 = entries2.childNodes[j];
                
                if ( currIndexEntry1.nodeType != 1 )
                {
                    i++;
                    continue;
                }
                else if ( currIndexEntry2.nodeType != 1 )
                {
                    j++;
                    continue;
                }
                
                if ( FMCGetAttribute( currIndexEntry1, "Term" ).toLowerCase() == FMCGetAttribute( currIndexEntry2, "Term" ).toLowerCase() )
                {
                    MergeIndexEntries( currIndexEntry1, currIndexEntry2 );
                    
                    var links1      = FMCGetChildNodesByTagName( currIndexEntry1, "Links" )[0];
                    var indexLinks2 = FMCGetChildNodesByTagName( currIndexEntry2, "Links" )[0].getElementsByTagName( "IndexLink" );
                    
                    for ( var k = 0; k < indexLinks2.length; k++ )
                    {
                        if ( xmlDoc1.importNode )
                        {
                            links1.appendChild( xmlDoc1.importNode( indexLinks2[k], true ) );
                        }
                        else
                        {
                            links1.appendChild( indexLinks2[k].cloneNode( true ) );
                        }
                    }
                    
                    entries.appendChild( currIndexEntry1.cloneNode( true ) );
                    i++;
                    j++;
                }
                else if ( FMCGetAttribute( currIndexEntry1, "Term" ).toLowerCase() > FMCGetAttribute( currIndexEntry2, "Term" ).toLowerCase() )
                {
                    if ( xmlDoc1.importNode )
                    {
                        entries.appendChild( xmlDoc1.importNode( currIndexEntry2, true ) );
                    }
                    else
                    {
                        entries.appendChild( currIndexEntry2.cloneNode( true ) );
                    }
                    
                    j++;
                }
                else
                {
                    entries.appendChild( currIndexEntry1.cloneNode( true ) );
                    i++;
                }
            }
            
            // Append remaining nodes. There should never be a case where BOTH entries1 AND entries2 have remaining nodes.
            
            for ( ; i < entries1.childNodes.length; i++ )
            {
                entries.appendChild( entries1.childNodes[i].cloneNode( true ) );
            }
            
            for ( ; j < entries2.childNodes.length; j++ )
            {
                if ( xmlDoc1.importNode )
                {
                    entries.appendChild( xmlDoc1.importNode( entries2.childNodes[j], true ) );
                }
                else
                {
                    entries.appendChild( entries2.childNodes[j].cloneNode( true ) );
                }
            }
        }
        
        indexEntry1.replaceChild( entries, entries1 );
    }
    
	function ConvertGlossaryPageEntryToAbsolute( glossaryPageEntry, path )
	{
		var entryNode	= glossaryPageEntry.getElementsByTagName( "a" )[0];
		var href		= FMCGetAttribute( entryNode, "href" );

		entryNode.setAttribute( "href", path + "Content/" + href );
	}
    
    function ConvertIndexLinksToAbsolute( indexEntry )
    {
        for ( var i = 0; i < indexEntry.childNodes.length; i++ )
        {
            var currNode    = indexEntry.childNodes[i];
            
            if ( currNode.nodeName == "Entries" )
            {
                for ( var j = 0; j < currNode.childNodes.length; j++ )
                {
                    ConvertIndexLinksToAbsolute( currNode.childNodes[j] );
                }
            }
            else if ( currNode.nodeName == "Links" )
            {
                for ( var j = 0; j < currNode.childNodes.length; j++ )
                {
                    if ( currNode.childNodes[j].nodeType == 1 )
                    {
                        var link    = FMCGetAttribute( currNode.childNodes[j], "Link" );
                        
                        link = mPath + ((link.charAt( 0 ) == "/") ? link.substring( 1, link.length ) : link);
                        currNode.childNodes[j].setAttribute( "Link", link );
                    }
                }
            }
        }
    }
    
    function LoadConcepts()
    {
        if ( mConceptMap )
        {
            return;
        }
        
        mConceptMap = new CMCDictionary();
        
        var xmlDoc	= CMCXmlParser.GetXmlDoc( mPath + "Data/Concepts.xml", false, null, null );
        var xmlHead	= xmlDoc.documentElement;
        
        for ( var i = 0; i < xmlHead.childNodes.length; i++ )
        {
            var entry   = xmlHead.childNodes[i];
            
            if ( entry.nodeType != 1 ) { continue; }
            
            var term    = entry.getAttribute( "Term" ).toLowerCase();
            var links   = new Array();
            
            for ( var j = 0; j < entry.childNodes.length; j++ )
            {
                var link    = entry.childNodes[j];
                
                if ( link.nodeType != 1 ) { continue; }
                
                var title   = link.getAttribute( "Title" );
                var url     = link.getAttribute( "Link" );
                
                url = mPath + ((url.charAt( 0 ) == "/") ? url.substring( 1, url.length ) : url);
                
                links[links.length] = title + "|" + url;
            }
            
            mConceptMap.Add( term, links );
        }
    }
    
    function MergeConceptLinks( links1, links2 )
    {
        if ( !links2 )
        {
            return;
        }
        
        for ( var i = 0; i < links2.length; i++ )
        {
            links1[links1.length] = links2[i];
        }
    }
    
    function MergeGlossaries( xmlDoc1, subsystem )
    {
		var xmlDoc2	= subsystem.GetGlossary();
        var divs1   = xmlDoc1.getElementsByTagName( "div" );
        var divs2   = xmlDoc2.getElementsByTagName( "div" );
        var body1   = null;
        var body2   = null;
        var body    = xmlDoc1.createElement( "div" );
        
        body.setAttribute( "id", "GlossaryBody" );
        
        for ( var i = 0; i < divs1.length; i++ )
        {
            if ( divs1[i].getAttribute( "id" ) == "GlossaryBody" )
            {
                body1 = divs1[i];
                break;
            }
        }
        
        for ( var i = 0; i < divs2.length; i++ )
        {
            if ( divs2[i].getAttribute( "id" ) == "GlossaryBody" )
            {
                body2 = divs2[i];
                break;
            }
        }
        
        if ( body1.getElementsByTagName( "div" ).length == 0 )
        {
            if ( xmlDoc1.importNode )
            {
                body = xmlDoc1.importNode( body2, true );
            }
            else
            {
                body = body2.cloneNode( true );
            }
            
            for ( var i = 0; i < body.childNodes.length; i++ )
            {
				var currNode	= body.childNodes[i];
				
				if ( currNode.nodeType != 1 || currNode.nodeName != "div" )
				{
					continue;
				}
				
				ConvertGlossaryPageEntryToAbsolute( currNode, subsystem.GetPath() );
            }
        }
        else if ( body2.getElementsByTagName( "div" ).length == 0 )
        {
            body = body1.cloneNode( true );
        }
        else
        {
            for ( var i = 0, j = 0; i < body1.childNodes.length && j < body2.childNodes.length; )
            {
                var currGlossaryPageEntry1  = body1.childNodes[i];
                var currGlossaryPageEntry2  = body2.childNodes[j];
                
                if ( currGlossaryPageEntry1.nodeType != 1 )
                {
                    i++;
                    continue;
                }
                else if ( currGlossaryPageEntry2.nodeType != 1 )
                {
                    j++;
                    continue;
                }
                
                var term1   = currGlossaryPageEntry1.getElementsByTagName( "div" )[0].getElementsByTagName( "a" )[0].firstChild.nodeValue;
                var term2   = currGlossaryPageEntry2.getElementsByTagName( "div" )[0].getElementsByTagName( "a" )[0].firstChild.nodeValue;
                
                if ( term1.toLowerCase() == term2.toLowerCase() )
                {
                    body.appendChild( currGlossaryPageEntry1.cloneNode( true ) );
                    i++;
                    j++;
                }
                else if ( term1.toLowerCase() > term2.toLowerCase() )
                {
					var newGlossaryPageEntry	= null;
					
                    if ( xmlDoc1.importNode )
                    {
						newGlossaryPageEntry = xmlDoc1.importNode( currGlossaryPageEntry2, true );
                    }
                    else
                    {
						newGlossaryPageEntry = currGlossaryPageEntry2.cloneNode( true );
                    }
                    
                    ConvertGlossaryPageEntryToAbsolute( newGlossaryPageEntry, subsystem.GetPath() );
                    body.appendChild( newGlossaryPageEntry )
                    
                    j++;
                }
                else
                {
                    body.appendChild( currGlossaryPageEntry1.cloneNode( true ) );
                    i++;
                }
            }
            
            // Append remaining nodes. There should never be a case where BOTH entries1 AND entries2 have remaining nodes.
            
            for ( ; i < body1.childNodes.length; i++ )
            {
                body.appendChild( body1.childNodes[i].cloneNode( true ) );
            }
            
            for ( ; j < body2.childNodes.length; j++ )
            {
				var currNode	= body2.childNodes[j];
				
				if ( currNode.nodeType != 1 )
				{
					continue;
				}
				
				var newNode		= null;
				
                if ( xmlDoc1.importNode )
                {
                    newNode = xmlDoc1.importNode( body2.childNodes[j], true );
                }
                else
                {
                    newNode = body2.childNodes[j].cloneNode( true );
                }
                
                ConvertGlossaryPageEntryToAbsolute( newNode, subsystem.GetPath() );
                body.appendChild( newNode );
            }
        }
        
        body1.parentNode.replaceChild( body, body1 );
    }
}

//
//    End class CMCHelpSystem
//
