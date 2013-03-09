// {{MadCap}} //////////////////////////////////////////////////////////////////
// Copyright: MadCap Software, Inc - www.madcapsoftware.com ////////////////////
////////////////////////////////////////////////////////////////////////////////
// <version>3.0.0.0</version>
////////////////////////////////////////////////////////////////////////////////

//
//    Class CMCTokenizer
//

function CMCTokenizer()
{
    // Private member variables
    
    var mOriginalString = "";
    var mPos            = -1;
    var mTokens         = new Array();
    
    // Public member functions
    
    this.Tokenize   = function( str )
    {
        var token   = null;
        
        mOriginalString = str;
        mPos = -1;
        
        for ( var i = 0; token = ReadNextToken(); i++ )
        {
            mTokens[i] = token;
        }
        
        return mTokens;
    }
    
    // Private member functions
    
    function IsNameChar( c )
    {
        if      ( !c )                { return false; }
        else if ( c == "\"" )         { return false; }
        else if ( c == "+"  )         { return false; }
        else if ( c == "^"  )         { return false; }
        else if ( c == "|"  )         { return false; }
        else if ( c == "&"  )         { return false; }
        else if ( c == "("  )         { return false; }
        else if ( c == ")"  )         { return false; }
        else if ( IsWhiteSpace( c ) ) { return false; }
        else                          { return true;  }
    }
    
    function IsWhiteSpace( c )
    {
        if ( !c )
        {
			return false;
		}
        else if ( c == " " )
        {
			return true;
		}
        else if ( c.charCodeAt( 0 ) == 12288 )
        {
			return true;
		}
        else
        {
			return false;
        }
    }
    
    function Peek()
    {
        return mOriginalString.charAt( mPos + 1 );
    }
    
    function Read()
    {
        mPos++;
    }
    
    function ReadString()
    {
        var str = "";
        
        for ( ; ; )
        {
            var c   = Peek();
            
            if ( !c )
            {
                return (str == "") ? null : str;
            }
            
            if ( c == "\\" )
            {
                Read();
                
                if ( !Peek() )
                {
                    return null;
                }
                
                Read();
                
                continue;
            }
            
            if ( c == "\"" )
            {
                Read();
                
                break;
            }
            else
            {
                Read();
                str += c;
            }
        }
        
        return str;
    }
    
    function ReadNextToken()
    {
        var c           = Peek();
        var token       = null;
        var tokenText   = "";
        
        if ( !c )
        {
            token = null;
        }
        else if ( IsWhiteSpace( c ) )
        {
            for ( c = Peek(); IsWhiteSpace( c ); c = Peek() )
            {
                Read();
                tokenText += c;
            }
            
            token = new CMCToken( tokenText, CMCToken.WhiteSpace );
        }
        else if ( c == "(" )
        {
            Read();
            token = new CMCToken( c, CMCToken.LeftParen );
        }
        else if ( c == ")" )
        {
            Read();
            token = new CMCToken( c, CMCToken.RightParen );
        }
        else if ( c == "^" )
        {
            Read();
            token = new CMCToken( c, CMCToken.Subtract );
        }
        else if ( c == "+" || c == "&" )
        {
            Read();
            token = new CMCToken( c, CMCToken.And );
        }
        else if ( c == "|" )
        {
            Read();
            token = new CMCToken( c, CMCToken.Or );
        }
        else if ( c == "!" )
        {
            Read();
            token = new CMCToken( c, CMCToken.Not );
        }
        else if ( c == "\"" )
        {
            Read();
            
            var str = ReadString();
            
            token = new CMCToken( str, (str == null) ? CMCToken.Error : CMCToken.Phrase );
        }
        else
        {
            for ( c = Peek(); IsNameChar( c ); c = Peek() )
            {
                Read();
                tokenText += c;
            }
            
            if ( tokenText == "and" || tokenText == "AND" )
            {
                token = new CMCToken( tokenText, CMCToken.And );
            }
            else if ( tokenText == "or" || tokenText == "OR" )
            {
                token = new CMCToken( tokenText, CMCToken.Or );
            }
            else if ( tokenText == "not" || tokenText == "NOT" )
            {
                token = new CMCToken( tokenText, CMCToken.Not );
            }
            else
            {
				var tokenType	= CMCToken.Word;
				
				if ( gSearchDBs[0].SearchType == "NGram" )
				{
					tokenType = CMCToken.Phrase;
				}
                
                token = new CMCToken( tokenText, tokenType );
            }
        }
        
        return token;
    }
}

//
//    End class CMCTokenizer
//

//
//    Class CMCToken
//

function CMCToken( tokenText, type )
{
    // Private member variables
    
    var mTokenText  = tokenText;
    var mType       = type;
    
    // Public member functions
    
    this.GetTokenText   = function ()
    {
        return mTokenText;
    };
    
    this.GetType        = function ()
    {
        return mType;
    };
}

// Static properties

CMCToken.Eof        = 0;
CMCToken.Error      = 1;
CMCToken.WhiteSpace = 2;
CMCToken.Phrase     = 3;
CMCToken.Word       = 4;
CMCToken.RightParen = 5;
CMCToken.LeftParen  = 6;
CMCToken.Not        = 7;
CMCToken.Subtract   = 8;
CMCToken.And        = 9;
CMCToken.Or         = 10;
CMCToken.ImplicitOr = 11;

//
//    End class CMCToken
//

//
//    Class CMCParser
//

function CMCParser( str )
{
    // Private member variables
    
    var mSelf           = this;
    var mSearchString   = str;
    var mCurrentToken   = -1;
    var mTokenizer      = new CMCTokenizer();
    var mSearchTokens   = mTokenizer.Tokenize( mSearchString );
    
    // Public member functions
    
    this.GetStemMap = function()
    {
        var stemMap = new CMCDictionary();
        
        for ( var i = 0; i < mSearchTokens.length; i++ )
        {
            var token   = mSearchTokens[i];
            
            if ( token.GetType() == CMCToken.Word )
            {
                var term    = token.GetTokenText();
                var phrases = new CMCDictionary();
                
                stemMap.Add( term, phrases );
                
                for ( var j = 0; j < gSearchDBs.length; j++ )
                {
					var searchDB	= gSearchDBs[j];
					
					if ( searchDB.SearchType == "NGram" )
					{
						for ( var k = 0; k < term.length - searchDB.NGramSize + 1; k++ )
						{
							var subText	= term.substring( k, k + searchDB.NGramSize );
							
							searchDB.LookupPhrases( subText, phrases );
						}
					}
					else
					{
						searchDB.LookupPhrases( term, phrases );
					}
                }
            }
            else if ( token.GetType() == CMCToken.Phrase )
            {
                var term    = token.GetTokenText();
                var phrases = new CMCDictionary();
                
                phrases.Add( term, true );
                stemMap.Add( term, phrases );
            }
        }
        
        return stemMap;
    };
    
    this.ParseExpression    = function ()
    {
        var node = ParseUnary();
        
        SkipWhiteSpace();
        
        if ( Peek() == CMCToken.Eof )
        {
            return node;
        }
        else if ( Peek() == CMCToken.And || Peek() == CMCToken.Or || Peek() == CMCToken.Subtract )
        {
            EatToken();
            
            var binNode = new CMCNode( mSearchTokens[mCurrentToken],
                                       node,
                                       this.ParseExpression() );
                                    
            return binNode;
        }
        else if ( Peek() == CMCToken.Word || Peek() == CMCToken.Phrase || Peek() == CMCToken.Not || Peek() == CMCToken.LeftParen )
        {
            var binNode = new CMCNode( new CMCToken( node.GetToken().GetTokenText() + " " + mSearchTokens[mCurrentToken + 1].GetTokenText(), CMCToken.ImplicitOr ),
                                       node,
                                       this.ParseExpression() );
                                       
            return binNode;
        }
        else if ( Peek() == CMCToken.RightParen )
        {
            return node;
        }
        
        throw gInvalidTokenLabel;
    };
    
    // Private member functions
    
    function EatToken()
    {
        mCurrentToken++;
    }
    
    function ParseUnary()
    {
        SkipWhiteSpace();
        
        if ( Peek() == CMCToken.Word )
        {
            EatToken();
            
            return new CMCNode( mSearchTokens[mCurrentToken], null, null );
        }
        else if ( Peek() == CMCToken.Phrase )
        {
            EatToken();
            
            return new CMCNode( mSearchTokens[mCurrentToken], null, null );
        }
        else if ( Peek() == CMCToken.Not )
        {
            EatToken();
            
            return new CMCNode( mSearchTokens[mCurrentToken],
                                ParseUnary(),
                                null );
        }
        else if ( Peek() == CMCToken.LeftParen )
        {
            EatToken();
            
            var token   = mSearchTokens[mCurrentToken];
            var node    = new CMCNode( token, mSelf.ParseExpression(), null );
            
            if ( Peek() != CMCToken.RightParen )
            {
                throw "Missing right paren ')'.";
            }
            
            EatToken();
            
            return node;
        }
        
        throw gInvalidTokenLabel;
    }
    
    function Peek()
    {
        if ( mSearchTokens[mCurrentToken + 1] == null )
        {
            return CMCToken.Eof;
        }
        else
        {
            return mSearchTokens[mCurrentToken + 1].GetType();
        }
    }
    
    function SkipWhiteSpace()
    {
        for ( ; Peek() == CMCToken.WhiteSpace; )
        {
            EatToken();
        }
    }
}

//
//    End class CMCParser
//

//
//    Class CMCNode
//

function CMCNode( token, op1, op2 )
{
    // Private member variables
    
    var mToken      = token;
    var mOperand1   = op1;
    var mOperand2   = op2;
    
    // Public member functions
    
    this.Evaluate   = function ( buildWordMap, buildPhraseMap )
    {
        var tokenType   = mToken.GetType();
        
        if ( tokenType == CMCToken.Word )
        {
			var tokenText	= mToken.GetTokenText();
			
			//

			var stems		= new CMCDictionary();
			var startStem	= stemWord( tokenText );

			stems.Add( startStem, true );

			for ( var j = 0; j < gSearchDBs.length; j++ )
			{
				var searchDB	= gSearchDBs[j];

				if ( searchDB.SynonymFile != null )
				{
					searchDB.SynonymFile.AddSynonymStems( tokenText, startStem, stems );
				}
				
				if ( searchDB.DownloadedSynonymFile != null )
				{
					searchDB.DownloadedSynonymFile.AddSynonymStems( tokenText, startStem, stems );
				}
			}

			//
			
            var resultSet	= new CMCQueryResultSet();
            
            var stemk		= 0;
            var stemKeys	= stems.GetKeys();
            
            for ( var stem in stemKeys )
			{
				for ( var i = 0; i < gSearchDBs.length; i++ )
				{
					var searchDB	= gSearchDBs[i];
					
					if ( searchDB.SearchType == "NGram" )
					{
						for ( var j = 0; j < stem.length - searchDB.NGramSize + 1; j++ )
						{
							var subText	= stem.substring( j, j + searchDB.NGramSize );
							
							searchDB.LookupStem( resultSet, subText, i, buildWordMap, buildPhraseMap );
						}
					}
					else
					{
						searchDB.LookupStem( resultSet, stem, i, buildWordMap, buildPhraseMap );
					}
	                
					for ( var j = 0; j < resultSet.GetLength(); j++ )
					{
						var result  = resultSet.GetResult( j );
	                    
						if ( result.ParentPhraseName == tokenText )
						{
							result.Ranking = result.Ranking + 1000;
						}
						else if ( result.ParentPhraseName.toLowerCase() == tokenText.toLowerCase() )
						{
							result.Ranking = result.Ranking + 500;
						}
						
						//

						if ( stemKeys.length > 0 && stemk == 0 )
						{
							result.Ranking = result.Ranking + 50;	// If synonyms are used, give the original stem a little higher ranking
						}
					}
					
					stemk++;
				}
			}
            
            return resultSet;
        }
        else if ( tokenType == CMCToken.Phrase )
        {
			var tokenText	= mToken.GetTokenText();
			var terms		= SplitPhrase( tokenText );
            var resultSet	= null;
            
			for ( var i = 0; i < terms.length; i++ )
			{
				var term        = terms[i];
				var resultSet2  = new CMCQueryResultSet();

				//

				var stems		= new CMCDictionary();
				var startStem	= stemWord( term );

				stems.Add( startStem, true );

				for ( var j = 0; j < gSearchDBs.length; j++ )
				{
					var searchDB	= gSearchDBs[j];

					if ( searchDB.SynonymFile != null )
					{
						searchDB.SynonymFile.AddSynonymStems( tokenText, startStem, stems );
					}
					
					if ( searchDB.DownloadedSynonymFile != null )
					{
						searchDB.DownloadedSynonymFile.AddSynonymStems( tokenText, startStem, stems );
					}
				}

				//

				for ( var stem in stems.GetKeys() )
				{
					for ( var j = 0; j < gSearchDBs.length; j++ )
					{
						var searchDB	= gSearchDBs[j];
						
						if ( searchDB.SearchType == "NGram" )
						{
							for ( var k = 0; k < stem.length - searchDB.NGramSize + 1; k++ )
							{
								var subText	= stem.substring( k, k + searchDB.NGramSize );
								
								searchDB.LookupStem( resultSet2, subText, j, true, buildPhraseMap );
							}
						}
						else
						{
							searchDB.LookupStem( resultSet2, stem, j, true, buildPhraseMap );
						}
					}
				}
	            
				if ( !resultSet )
				{
					resultSet = resultSet2;
					continue;
				}
	            
				var newResultSet    = resultSet.ToPhrases( resultSet2, mToken, true, buildPhraseMap );
	            
				if ( newResultSet.GetLength() == 0 )
				{
					return newResultSet;
				}
	            
				resultSet = newResultSet;
			}
	    	
    		if ( !resultSet )
    		{
    			resultSet = new CMCQueryResultSet();
    		}
	    	
    		return resultSet;
		}
		else if ( tokenType == CMCToken.And ||
				  tokenType == CMCToken.ImplicitOr ||
				  tokenType == CMCToken.Or ||
				  tokenType == CMCToken.Subtract )
		{
			var needWordMap		= mToken.GetType() == CMCToken.ImplicitOr;
			var needPhraseMap	= mToken.GetType() == CMCToken.ImplicitOr || mToken.GetType() == CMCToken.Or;

			var leftResults     = mOperand1.Evaluate( needWordMap, needPhraseMap );
			var rightResults    = mOperand2.Evaluate( false, false );
	        
			if ( mToken.GetType() == CMCToken.And )
			{
				return leftResults.ToIntersection( rightResults, buildWordMap, buildPhraseMap );
			}
			else if ( mToken.GetType() == CMCToken.ImplicitOr )
			{
				rightResults.PromotePhrases( leftResults, mToken );
				leftResults.ToUnion( rightResults, buildWordMap, buildPhraseMap );
	        	
				return leftResults;
			}
			else if ( mToken.GetType() == CMCToken.Or )
			{
				leftResults.ToUnion( rightResults, buildWordMap, buildPhraseMap );
	            
				return leftResults;
			}
			else if ( mToken.GetType() == CMCToken.Subtract )
			{
				return leftResults.ToDifference( rightResults, buildWordMap, buildPhraseMap );
			}
		}
		else if ( tokenType == CMCToken.LeftParen )
		{
			if ( mOperand1 )
			{
				return mOperand1.Evaluate( buildWordMap, buildPhraseMap );
			}
	        
			return new CMCQueryResultSet();
		}
		else if ( tokenType == CMCToken.Not )
		{
			var val	= new CMCQueryResultSet();
			
			if ( mOperand1 )
			{
				val = mOperand1.Evaluate( buildWordMap, buildPhraseMap );
			}
	        
			var results	= new CMCQueryResultSet();
	        
			for ( var i = 0; i < gSearchDBs.length; i++ )
			{
				var searchDB	= gSearchDBs[i];
				
				for ( var j = 0; j < searchDB.URLSources.length; j++ )
				{
					var found		= false;
					var currResult	= null;
					
					for ( var k = 0; k < val.GetLength(); k++ )
					{
						currResult = val.GetResult( k );
						
						if ( currResult.Entry.TopicID == j && currResult.SearchDB == i )
						{
							found = true;
							break;
						}
					}
					
					if ( !found )
					{
						var entry	= new CMCEntry( 0, j, -1 );
						var result	= new CMCQueryResult( i, entry, 0, null );

						results.Add( result, buildWordMap, buildPhraseMap, false );
					}
				}
			}
	        
			return results;
		}
	};

	this.GetToken   = function ()
	{
		return mToken;
	};
}

//
//    End class CMCNode
//

//
//    Class CMCEntry
//

function CMCEntry( rank, topicID, word )
{
    // Private member variables
    
    this.Rank		= rank;
    this.TopicID	= topicID;
    this.Word		= word;
}

//
//    End class CMCEntry
//

//
//    Class CMCQueryResult
//

function CMCQueryResult( dbIndex, entry, rank, parentPhraseName )
{
    // Public properties
    
    this.SearchDB			= dbIndex;
    this.Entry				= entry;
    this.Ranking			= rank;
    this.ParentPhraseName	= parentPhraseName;
    this.RankPosition		= 0;
}

//
//    End class CMCQueryResult
//

//
//    Class CMCQueryResultSet
//

function CMCQueryResultSet()
{
    // Public properties
    
    this.mResults	= new Array();
    this.mSortCol	= null;
    this.mSortOrder	= null;
    this.mWordMap	= new CMCDictionary();
    this.mPhraseMap	= new CMCDictionary();
    this.mTopicMap	= new CMCDictionary();
}

CMCQueryResultSet.prototype.Add	= function( result, buildWordMap, buildPhraseMap, buildTopicMap )
{
    this.mResults[this.mResults.length] = result;
    
    var searchDB	= result.SearchDB;
    var entry		= result.Entry;
    
    if ( buildWordMap )
    {
		var key	= searchDB + "_" + entry.TopicID + "_" + entry.Word;
		
		this.mWordMap.Add( key, result );
    }
    
    if ( buildPhraseMap )
    {
		var key	= result.ParentPhraseName + "_" + searchDB + "_" + entry.TopicID + "_" + entry.Word;
		
		this.mPhraseMap.Add( key, true );
    }
    
    if ( buildTopicMap )
    {
		var key			= searchDB + "_" + entry.TopicID;
		var indexList	= this.mTopicMap.GetItem( key );
		
		if ( !indexList )
		{
			indexList = new Array();
			this.mTopicMap.Add( key, indexList );
		}
		
		indexList[indexList.length] = this.mResults.length - 1;
    }
};

CMCQueryResultSet.prototype.AddAllUnique	= function( results, buildWordMap, buildPhraseMap )
{
	var count	= results.GetLength();
	
    for ( var i = 0; i < count; i++ )
    {
        var result      = results.GetResult( i );
        var entry       = result.Entry;
        var searchDB    = result.SearchDB;
        var phrase      = result.ParentPhraseName;
        var rank        = entry.Rank;
        var topic       = entry.TopicID;
        var word        = entry.Word;
        var key         = phrase + "_" + searchDB + "_" + topic + "_" + word;
        
        if ( this.mPhraseMap.GetItem( key ) )
        {
            continue;
        }
        
        this.Add( result, buildWordMap, buildPhraseMap, false );
    }
};

CMCQueryResultSet.prototype.Compact	= function()
{
    var newResults  = new Array();
    
    for ( var i = 0; i < this.mResults.length; i++ )
    {
        if ( this.mResults[i] )
        {
            newResults[newResults.length] = this.mResults[i];
        }
    }
    
    this.mResults = newResults;
};

CMCQueryResultSet.prototype.GetLength	= function()
{
    return this.mResults.length;
};

CMCQueryResultSet.prototype.GetResult	= function( i )
{
    return this.mResults[i];
};

CMCQueryResultSet.prototype.GetSortCol	= function()
{
    return this.mSortCol;
};

CMCQueryResultSet.prototype.GetSortOrder	= function()
{
    return this.mSortOrder;
};

CMCQueryResultSet.prototype.GetWordMap	= function()
{
	return this.mWordMap;
};

CMCQueryResultSet.prototype.RemoveAt	= function( i )
{
    this.mResults[i] = null;
};

CMCQueryResultSet.prototype.RemoveTopicId	= function( result )
{
    var topic       = result.Entry.TopicID;
    var searchDB    = result.SearchDB;
    var topicKey	= searchDB + "_" + topic;
    var indexList	= this.mTopicMap.GetItem( topicKey );
    
    if ( indexList )
    {
		for ( var i = 0; i < indexList.length; i++ )
		{
			var currResult	= this.mResults[indexList[i]];
			var entry		= currResult.Entry;
			var wordKey		= searchDB + "_" + topic + "_" + entry.Word;
			var phraseKey	= currResult.ParentPhraseName + "_" + searchDB + "_" + topic + "_" + entry.Word;
			
			this.mWordMap.Remove( wordKey );
			this.mPhraseMap.Remove( phraseKey );
			this.mTopicMap.Remove( topicKey );
			
			//
			
			this.RemoveAt( indexList[i] );
		}
    }
};

CMCQueryResultSet.prototype.ShallowClone	= function( buildWordMap, buildPhraseMap, buildTopicMap )
{
    var resultSet   = new CMCQueryResultSet();
    
    for ( var i = 0; i < this.mResults.length; i++ )
    {
        resultSet.Add( this.mResults[i], buildWordMap, buildPhraseMap, buildTopicMap );
    }
    
    return resultSet;
};

CMCQueryResultSet.prototype.Sort	= function( sortCol, sortOrder )
{
    this.mSortCol = sortCol;
    this.mSortOrder = sortOrder;
    
    gCompareSet = this;
    this.mResults.sort( this.CompareResults );
    gCompareSet = null;
};

CMCQueryResultSet.prototype.SetRankPositions	= function()
{
    var sortCol     = this.mSortCol;
    var sortOrder   = this.mSortOrder
    
    this.mSortCol = "rank";
    this.mSortOrder = -1;
    
    gCompareSet = this;
    this.mResults.sort( this.CompareResults );
    gCompareSet = null;
    
    for ( var i = 0; i < this.mResults.length; i++ )
    {
        this.mResults[i].RankPosition = i + 1;
    }
    
    this.mSortCol = sortCol;
    this.mSortOrder = sortOrder;
};

var gCompareSet	= null;

CMCQueryResultSet.prototype.ToDifference	= function( results, buildWordMap, buildPhraseMap )
{
    var newResults  = this.ShallowClone( buildWordMap, buildPhraseMap, true );
    
    for ( var i = 0; i < results.GetLength(); i++ )
    {
		newResults.RemoveTopicId( results.GetResult( i ) );
    }
    
    newResults.Compact();
    
    return newResults;
};

CMCQueryResultSet.prototype.ToIntersection	= function( results, buildWordMap, buildPhraseMap )
{
    var newResults  = new CMCQueryResultSet();
    var map1        = new CMCDictionary();
    var map2        = new CMCDictionary();
    
    for ( var i = 0; i < this.mResults.length; i++ )
    {
		var result	= this.mResults[i];
        var key		= result.SearchDB + "_" + result.Entry.TopicID;
        
        map1.Add( key, true );
    }
    
    for ( var i = 0; i < results.GetLength(); i++ )
    {
		var result	= results.GetResult( i );
        var key		= result.SearchDB + "_" + result.Entry.TopicID;
        
        map2.Add( key, true );
    }
    
    for ( var i = 0; i < this.mResults.length; i++ )
    {
        var result  = this.mResults[i];
        var key     = result.SearchDB + "_" + result.Entry.TopicID;
        
        if ( map2.GetItem( key ) )
        {
            newResults.Add( result, buildWordMap, buildPhraseMap, false );
        }
    }
    
    for ( var i = 0; i < results.GetLength(); i++ )
    {
        var key = results.GetResult( i ).SearchDB + "_" + results.GetResult( i ).Entry.TopicID;
        
        if ( map1.GetItem( key ) )
        {
            newResults.Add( results.GetResult( i ), buildWordMap, buildPhraseMap, false );
        }
    }
    
    return newResults;
};

CMCQueryResultSet.prototype.ToMerged	= function()
{
    var mergedSet   = new CMCQueryResultSet();
    var map         = new CMCDictionary();
    
    for ( var i = 0; i < this.mResults.length; i++ )
    {
        var result  = this.mResults[i];
        var key     = result.SearchDB + "_" + this.mResults[i].Entry.TopicID;
        var item	= map.GetItem( key );
        
        if ( item )
        {
            item.Ranking = item.Ranking + result.Ranking;
            continue;
        }
        
        map.Add( key, result );
        mergedSet.Add( result, false, false, false );
    }
    
    return mergedSet;
};

CMCQueryResultSet.prototype.ToPhrases	= function( results, token, buildWordMap, buildPhraseMap )
{
    if ( !results )
    {
		var set1	= new CMCQueryResultSet();
		
        return set1;
    }
    
    var adjacentEntries = this.FindAdjacentEntries( results, token, buildWordMap, buildPhraseMap );
    
    return adjacentEntries;
};

CMCQueryResultSet.prototype.ToUnion	= function( results, buildWordMap, buildPhraseMap )
{
    this.AddAllUnique( results, buildWordMap, buildPhraseMap );
};

// (Should be) Private member functions

CMCQueryResultSet.prototype.CompareResults	= function( a, b )
{
    var ret;
    
    if ( gCompareSet.mSortCol == "rank" )
    {
        var rank1   = a.Ranking;
        var rank2   = b.Ranking;
        
        ret = rank1 - rank2;
    }
    else if ( gCompareSet.mSortCol == "rankPosition" )
    {
        var pos1    = a.RankPosition;
        var pos2    = b.RankPosition;
        
        ret = pos1 - pos2;
    }
    else if ( gCompareSet.mSortCol == "title" )
    {
        var searchDB    = a.SearchDB;
        var entry       = a.Entry;
        var topicID     = entry.TopicID;
        var title1      = gSearchDBs[searchDB].URLTitles[topicID] ? gSearchDBs[searchDB].URLTitles[topicID] : "";
        
        searchDB = b.SearchDB;
        entry = b.Entry;
        topicID = entry.TopicID;
        var title2  = gSearchDBs[searchDB].URLTitles[topicID] ? gSearchDBs[searchDB].URLTitles[topicID] : "";
        
        if ( title1 < title2 )
        {
            ret = -1;
        }
        else if ( title1 == title2 )
        {
            ret = 0;
        }
        else if ( title1 > title2 )
        {
            ret = 1;
        }
    }
    
    return (ret * gCompareSet.mSortOrder);
}

CMCQueryResultSet.prototype.FindAdjacentEntries	= function( results, token, buildWordMap, buildPhraseMap )
{
    var newResults	= new CMCQueryResultSet();
    var wordList	= SplitPhrase( token.GetTokenText() );
    var wordListMap	= new CMCDictionary();
    
    for ( var j = 0; j < wordList.length; j++ )
    {
        wordListMap.Add( wordList[j], true );
    }
    
    var wordMap	= results.GetWordMap();
    
    for ( var i = 0; i < this.mResults.length; i++ )
    {
        var result		= this.mResults[i];
        var entry		= result.Entry;
        var searchDB	= result.SearchDB;
        var rank		= entry.Rank;
        var topic		= entry.TopicID;
        var word		= entry.Word;
        var key			= searchDB + "_" + topic + "_" + (parseInt( word ) + 1);
        var nextResult	= wordMap.GetItem( key );
        
        if ( nextResult )
        {
            if ( wordListMap.GetItem( nextResult.ParentPhraseName ) && wordListMap.GetItem( result.ParentPhraseName ) )
            {
                nextResult.Ranking = result.Ranking + 10000;
            }
            else
            {
                nextResult.Ranking = result.Ranking + 1000;
            }
            
            newResults.Add( nextResult, buildWordMap, buildPhraseMap, false );
        }
    }
    
    return newResults;
}

CMCQueryResultSet.prototype.PromotePhrases	= function( results, token )
{
    var wordList	= SplitPhrase( token.GetTokenText() );
    var wordListMap	= new CMCDictionary();
    
    for ( var j = 0; j < wordList.length; j++ )
    {
        wordListMap.Add( wordList[j], true );
    }
    
    var wordMap	= results.GetWordMap();
    
    for ( var i = 0; i < this.mResults.length; i++ )
    {
        var result		= this.mResults[i];
        var entry		= result.Entry;
        var searchDB	= result.SearchDB;
        var rank		= entry.Rank;
        var topic		= entry.TopicID;
        var word		= entry.Word;
        var key			= searchDB + "_" + topic + "_" + (parseInt( word ) - 1);
        var nextResult	= wordMap.GetItem( key );
        
        if ( nextResult )
        {
            if ( wordListMap.GetItem( nextResult.ParentPhraseName ) && wordListMap.GetItem( result.ParentPhraseName ) )
            {
                nextResult.Ranking = result.Ranking + 10000;
            }
            else
            {
                nextResult.Ranking = result.Ranking + 1000;
            }
        }
    }
}

//
//    End class CMCQueryResultSet
//

function SplitPhrase( text )
{
	var terms		= null;
	var searchDB	= gSearchDBs[0];
	
	if ( searchDB.SearchType == "NGram" )
	{
		terms = new Array( Math.max( 0, text.length - (searchDB.NGramSize + 1) ) );
		
		for ( var i = 0; i < text.length - searchDB.NGramSize + 1; i++ )
		{
			terms[i] = text.substring( i, i + searchDB.NGramSize );
		}
	}
	else
	{
		terms = text.split( " " );
	}
	
	return terms;
}
