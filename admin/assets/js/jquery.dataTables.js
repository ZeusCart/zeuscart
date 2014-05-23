/**
 * @summary     DataTables
 * @description Paginate, search and sort HTML tables
 * @version     1.9.4
 * @file        jquery.dataTables.js
 * @author      Allan Jardine (www.sprymedia.co.uk)
 * @contact     www.sprymedia.co.uk/contact
 *
 * @copyright Copyright 2008-2012 Allan Jardine, all rights reserved.
 *
 * This source file is free software, under either the GPL v2 license or a
 * BSD style license, available at:
 *   http://datatables.net/license_gpl2
 *   http://datatables.net/license_bsd
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 * 
 * For details please refer to: http://www.datatables.net
 */

/*jslint evil: true, undef: true, browser: true */
/*globals $, jQuery,define,_fnExternApiFunc,_fnInitialise,_fnInitComplete,_fnLanguageCompat,_fnAddColumn,_fnColumnOptions,_fnAddData,_fnCreateTr,_fnGatherData,_fnBuildHead,_fnDrawHead,_fnDraw,_fnReDraw,_fnAjaxUpdate,_fnAjaxParameters,_fnAjaxUpdateDraw,_fnServerParams,_fnAddOptionsHtml,_fnFeatureHtmlTable,_fnScrollDraw,_fnAdjustColumnSizing,_fnFeatureHtmlFilter,_fnFilterComplete,_fnFilterCustom,_fnFilterColumn,_fnFilter,_fnBuildSearchArray,_fnBuildSearchRow,_fnFilterCreateSearch,_fnDataToSearch,_fnSort,_fnSortAttachListener,_fnSortingClasses,_fnFeatureHtmlPaginate,_fnPageChange,_fnFeatureHtmlInfo,_fnUpdateInfo,_fnFeatureHtmlLength,_fnFeatureHtmlProcessing,_fnProcessingDisplay,_fnVisibleToColumnIndex,_fnColumnIndexToVisible,_fnNodeToDataIndex,_fnVisbleColumns,_fnCalculateEnd,_fnConvertToWidth,_fnCalculateColumnWidths,_fnScrollingWidthAdjust,_fnGetWidestNode,_fnGetMaxLenString,_fnStringToCss,_fnDetectType,_fnSettingsFromNode,_fnGetDataMaster,_fnGetTrNodes,_fnGetTdNodes,_fnEscapeRegex,_fnDeleteIndex,_fnReOrderIndex,_fnColumnOrdering,_fnLog,_fnClearTable,_fnSaveState,_fnLoadState,_fnCreateCookie,_fnReadCookie,_fnDetectHeader,_fnGetUniqueThs,_fnScrollBarWidth,_fnApplyToChildren,_fnMap,_fnGetRowData,_fnGetCellData,_fnSetCellData,_fnGetObjectDataFn,_fnSetObjectDataFn,_fnApplyColumnDefs,_fnBindAction,_fnCallbackReg,_fnCallbackFire,_fnJsonString,_fnRender,_fnNodeToColumnIndex,_fnInfoMacros,_fnBrowserDetect,_fnGetColumns*/

(/** @lends <global> */function( window, document, undefined ) {

(function( factory ) {
	"use strict";

	// Define as an AMD module if possible
	if ( typeof define === 'function' && define.amd )
	{
		define( ['jquery'], factory );
	}
	/* Define using browser globals otherwise
	 * Prevent multiple instantiations if the script is loaded twice
	 */
	else if ( jQuery && !jQuery.fn.dataTable )
	{
		factory( jQuery );
	}
}
(/** @lends <global> */function( $ ) {
	"use strict";
	/** 
	 * DataTables is a plug-in for the jQuery Javascript library. It is a 
	 * highly flexible tool, based upon the foundations of progressive 
	 * enhancement, which will add advanced interaction controls to any 
	 * HTML table. For a full list of features please refer to
	 * <a href="http://datatables.net">DataTables.net</a>.
	 *
	 * Note that the <i>DataTable</i> object is not a global variable but is
	 * aliased to <i>jQuery.fn.DataTable</i> and <i>jQuery.fn.dataTable</i> through which 
	 * it may be  accessed.
	 *
	 *  @class
	 *  @param {object} [oInit={}] Configuration object for DataTables. Options
	 *    are defined by {@link DataTable.defaults}
	 *  @requires jQuery 1.3+
	 * 
	 *  @example
	 *    // Basic initialisation
	 *    $(document).ready( function {
	 *      $('#example').dataTable();
	 *    } );
	 *  
	 *  @example
	 *    // Initialisation with configuration options - in this case, disable
	 *    // pagination and sorting.
	 *    $(document).ready( function {
	 *      $('#example').dataTable( {
	 *        "bPaginate": false,
	 *        "bSort": false 
	 *      } );
	 *    } );
	 */
	var DataTable = function( oInit )
	{
		
		
		/**
		 * Add a column to the list used for the table with default values
		 *  @param {object} oSettings dataTables settings object
		 *  @param {node} nTh The th element for this column
		 *  @memberof DataTable#oApi
		 */
		function _fnAddColumn( oSettings, nTh )
		{
			var oDefaults = DataTable.defaults.columns;
			var iCol = oSettings.aoColumns.length;
			var oCol = $.extend( {}, DataTable.models.oColumn, oDefaults, {
				"sSortingClass": oSettings.oClasses.sSortable,
				"sSortingClassJUI": oSettings.oClasses.sSortJUI,
				"nTh": nTh ? nTh : document.createElement('th'),
				"sTitle":    oDefaults.sTitle    ? oDefaults.sTitle    : nTh ? nTh.innerHTML : '',
				"aDataSort": oDefaults.aDataSort ? oDefaults.aDataSort : [iCol],
				"mData": oDefaults.mData ? oDefaults.oDefaults : iCol
			} );
			oSettings.aoColumns.push( oCol );
			
			/* Add a column specific filter */
			if ( oSettings.aoPreSearchCols[ iCol ] === undefined || oSettings.aoPreSearchCols[ iCol ] === null )
			{
				oSettings.aoPreSearchCols[ iCol ] = $.extend( {}, DataTable.models.oSearch );
			}
			else
			{
				var oPre = oSettings.aoPreSearchCols[ iCol ];
				
				/* Don't require that the user must specify bRegex, bSmart or bCaseInsensitive */
				if ( oPre.bRegex === undefined )
				{
					oPre.bRegex = true;
				}
				
				if ( oPre.bSmart === undefined )
				{
					oPre.bSmart = true;
				}
				
				if ( oPre.bCaseInsensitive === undefined )
				{
					oPre.bCaseInsensitive = true;
				}
			}
			
			/* Use the column options function to initialise classes etc */
			_fnColumnOptions( oSettings, iCol, null );
		}
		
		
		/**
		 * Apply options for a column
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iCol column index to consider
		 *  @param {object} oOptions object with sType, bVisible and bSearchable etc
		 *  @memberof DataTable#oApi
		 */
		function _fnColumnOptions( oSettings, iCol, oOptions )
		{
			var oCol = oSettings.aoColumns[ iCol ];
			
			/* User specified column options */
			if ( oOptions !== undefined && oOptions !== null )
			{
				/* Backwards compatibility for mDataProp */
				if ( oOptions.mDataProp && !oOptions.mData )
				{
					oOptions.mData = oOptions.mDataProp;
				}
		
				if ( oOptions.sType !== undefined )
				{
					oCol.sType = oOptions.sType;
					oCol._bAutoType = false;
				}
				
				$.extend( oCol, oOptions );
				_fnMap( oCol, oOptions, "sWidth", "sWidthOrig" );
		
				/* iDataSort to be applied (backwards compatibility), but aDataSort will take
				 * priority if defined
				 */
				if ( oOptions.iDataSort !== undefined )
				{
					oCol.aDataSort = [ oOptions.iDataSort ];
				}
				_fnMap( oCol, oOptions, "aDataSort" );
			}
		
			/* Cache the data get and set functions for speed */
			var mRender = oCol.mRender ? _fnGetObjectDataFn( oCol.mRender ) : null;
			var mData = _fnGetObjectDataFn( oCol.mData );
		
			oCol.fnGetData = function (oData, sSpecific) {
				var innerData = mData( oData, sSpecific );
		
				if ( oCol.mRender && (sSpecific && sSpecific !== '') )
				{
					return mRender( innerData, sSpecific, oData );
				}
				return innerData;
			};
			oCol.fnSetData = _fnSetObjectDataFn( oCol.mData );
			
			/* Feature sorting overrides column specific when off */
			if ( !oSettings.oFeatures.bSort )
			{
				oCol.bSortable = false;
			}
			
			/* Check that the class assignment is correct for sorting */
			if ( !oCol.bSortable ||
				 ($.inArray('asc', oCol.asSorting) == -1 && $.inArray('desc', oCol.asSorting) == -1) )
			{
				oCol.sSortingClass = oSettings.oClasses.sSortableNone;
				oCol.sSortingClassJUI = "";
			}
			else if ( $.inArray('asc', oCol.asSorting) == -1 && $.inArray('desc', oCol.asSorting) == -1 )
			{
				oCol.sSortingClass = oSettings.oClasses.sSortable;
				oCol.sSortingClassJUI = oSettings.oClasses.sSortJUI;
			}
			else if ( $.inArray('asc', oCol.asSorting) != -1 && $.inArray('desc', oCol.asSorting) == -1 )
			{
				oCol.sSortingClass = oSettings.oClasses.sSortableAsc;
				oCol.sSortingClassJUI = oSettings.oClasses.sSortJUIAscAllowed;
			}
			else if ( $.inArray('asc', oCol.asSorting) == -1 && $.inArray('desc', oCol.asSorting) != -1 )
			{
				oCol.sSortingClass = oSettings.oClasses.sSortableDesc;
				oCol.sSortingClassJUI = oSettings.oClasses.sSortJUIDescAllowed;
			}
		}
		
		
		/**
		 * Adjust the table column widths for new data. Note: you would probably want to 
		 * do a redraw after calling this function!
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnAdjustColumnSizing ( oSettings )
		{
			/* Not interested in doing column width calculation if auto-width is disabled */
			if ( oSettings.oFeatures.bAutoWidth === false )
			{
				return false;
			}
			
			_fnCalculateColumnWidths( oSettings );
			for ( var i=0 , iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				oSettings.aoColumns[i].nTh.style.width = oSettings.aoColumns[i].sWidth;
			}
		}
		
		
		/**
		 * Covert the index of a visible column to the index in the data array (take account
		 * of hidden columns)
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iMatch Visible column index to lookup
		 *  @returns {int} i the data index
		 *  @memberof DataTable#oApi
		 */
		function _fnVisibleToColumnIndex( oSettings, iMatch )
		{
			var aiVis = _fnGetColumns( oSettings, 'bVisible' );
		
			return typeof aiVis[iMatch] === 'number' ?
				aiVis[iMatch] :
				null;
		}
		
		
		/**
		 * Covert the index of an index in the data array and convert it to the visible
		 *   column index (take account of hidden columns)
		 *  @param {int} iMatch Column index to lookup
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {int} i the data index
		 *  @memberof DataTable#oApi
		 */
		function _fnColumnIndexToVisible( oSettings, iMatch )
		{
			var aiVis = _fnGetColumns( oSettings, 'bVisible' );
			var iPos = $.inArray( iMatch, aiVis );
		
			return iPos !== -1 ? iPos : null;
		}
		
		
		/**
		 * Get the number of visible columns
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {int} i the number of visible columns
		 *  @memberof DataTable#oApi
		 */
		function _fnVisbleColumns( oSettings )
		{
			return _fnGetColumns( oSettings, 'bVisible' ).length;
		}
		
		
		/**
		 * Get an array of column indexes that match a given property
		 *  @param {object} oSettings dataTables settings object
		 *  @param {string} sParam Parameter in aoColumns to look for - typically 
		 *    bVisible or bSearchable
		 *  @returns {array} Array of indexes with matched properties
		 *  @memberof DataTable#oApi
		 */
		function _fnGetColumns( oSettings, sParam )
		{
			var a = [];
		
			$.map( oSettings.aoColumns, function(val, i) {
				if ( val[sParam] ) {
					a.push( i );
				}
			} );
		
			return a;
		}
		
		
		/**
		 * Get the sort type based on an input string
		 *  @param {string} sData data we wish to know the type of
		 *  @returns {string} type (defaults to 'string' if no type can be detected)
		 *  @memberof DataTable#oApi
		 */
		function _fnDetectType( sData )
		{
			var aTypes = DataTable.ext.aTypes;
			var iLen = aTypes.length;
			
			for ( var i=0 ; i<iLen ; i++ )
			{
				var sType = aTypes[i]( sData );
				if ( sType !== null )
				{
					return sType;
				}
			}
			
			return 'string';
		}
		
		
		/**
		 * Figure out how to reorder a display list
		 *  @param {object} oSettings dataTables settings object
		 *  @returns array {int} aiReturn index list for reordering
		 *  @memberof DataTable#oApi
		 */
		function _fnReOrderIndex ( oSettings, sColumns )
		{
			var aColumns = sColumns.split(',');
			var aiReturn = [];
			
			for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				for ( var j=0 ; j<iLen ; j++ )
				{
					if ( oSettings.aoColumns[i].sName == aColumns[j] )
					{
						aiReturn.push( j );
						break;
					}
				}
			}
			
			return aiReturn;
		}
		
		
		/**
		 * Get the column ordering that DataTables expects
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {string} comma separated list of names
		 *  @memberof DataTable#oApi
		 */
		function _fnColumnOrdering ( oSettings )
		{
			var sNames = '';
			for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				sNames += oSettings.aoColumns[i].sName+',';
			}
			if ( sNames.length == iLen )
			{
				return "";
			}
			return sNames.slice(0, -1);
		}
		
		
		/**
		 * Take the column definitions and static columns arrays and calculate how
		 * they relate to column indexes. The callback function will then apply the
		 * definition found for a column to a suitable configuration object.
		 *  @param {object} oSettings dataTables settings object
		 *  @param {array} aoColDefs The aoColumnDefs array that is to be applied
		 *  @param {array} aoCols The aoColumns array that defines columns individually
		 *  @param {function} fn Callback function - takes two parameters, the calculated
		 *    column index and the definition for that column.
		 *  @memberof DataTable#oApi
		 */
		function _fnApplyColumnDefs( oSettings, aoColDefs, aoCols, fn )
		{
			var i, iLen, j, jLen, k, kLen;
		
			// Column definitions with aTargets
			if ( aoColDefs )
			{
				/* Loop over the definitions array - loop in reverse so first instance has priority */
				for ( i=aoColDefs.length-1 ; i>=0 ; i-- )
				{
					/* Each definition can target multiple columns, as it is an array */
					var aTargets = aoColDefs[i].aTargets;
					if ( !$.isArray( aTargets ) )
					{
						_fnLog( oSettings, 1, 'aTargets must be an array of targets, not a '+(typeof aTargets) );
					}
		
					for ( j=0, jLen=aTargets.length ; j<jLen ; j++ )
					{
						if ( typeof aTargets[j] === 'number' && aTargets[j] >= 0 )
						{
							/* Add columns that we don't yet know about */
							while( oSettings.aoColumns.length <= aTargets[j] )
							{
								_fnAddColumn( oSettings );
							}
		
							/* Integer, basic index */
							fn( aTargets[j], aoColDefs[i] );
						}
						else if ( typeof aTargets[j] === 'number' && aTargets[j] < 0 )
						{
							/* Negative integer, right to left column counting */
							fn( oSettings.aoColumns.length+aTargets[j], aoColDefs[i] );
						}
						else if ( typeof aTargets[j] === 'string' )
						{
							/* Class name matching on TH element */
							for ( k=0, kLen=oSettings.aoColumns.length ; k<kLen ; k++ )
							{
								if ( aTargets[j] == "_all" ||
								     $(oSettings.aoColumns[k].nTh).hasClass( aTargets[j] ) )
								{
									fn( k, aoColDefs[i] );
								}
							}
						}
					}
				}
			}
		
			// Statically defined columns array
			if ( aoCols )
			{
				for ( i=0, iLen=aoCols.length ; i<iLen ; i++ )
				{
					fn( i, aoCols[i] );
				}
			}
		}
		
		/**
		 * Add a data array to the table, creating DOM node etc. This is the parallel to 
		 * _fnGatherData, but for adding rows from a Javascript source, rather than a
		 * DOM source.
		 *  @param {object} oSettings dataTables settings object
		 *  @param {array} aData data array to be added
		 *  @returns {int} >=0 if successful (index of new aoData entry), -1 if failed
		 *  @memberof DataTable#oApi
		 */
		function _fnAddData ( oSettings, aDataSupplied )
		{
			var oCol;
			
			/* Take an independent copy of the data source so we can bash it about as we wish */
			var aDataIn = ($.isArray(aDataSupplied)) ?
				aDataSupplied.slice() :
				$.extend( true, {}, aDataSupplied );
			
			/* Create the object for storing information about this new row */
			var iRow = oSettings.aoData.length;
			var oData = $.extend( true, {}, DataTable.models.oRow );
			oData._aData = aDataIn;
			oSettings.aoData.push( oData );
		
			/* Create the cells */
			var nTd, sThisType;
			for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				oCol = oSettings.aoColumns[i];
		
				/* Use rendered data for filtering / sorting */
				if ( typeof oCol.fnRender === 'function' && oCol.bUseRendered && oCol.mData !== null )
				{
					_fnSetCellData( oSettings, iRow, i, _fnRender(oSettings, iRow, i) );
				}
				else
				{
					_fnSetCellData( oSettings, iRow, i, _fnGetCellData( oSettings, iRow, i ) );
				}
				
				/* See if we should auto-detect the column type */
				if ( oCol._bAutoType && oCol.sType != 'string' )
				{
					/* Attempt to auto detect the type - same as _fnGatherData() */
					var sVarType = _fnGetCellData( oSettings, iRow, i, 'type' );
					if ( sVarType !== null && sVarType !== '' )
					{
						sThisType = _fnDetectType( sVarType );
						if ( oCol.sType === null )
						{
							oCol.sType = sThisType;
						}
						else if ( oCol.sType != sThisType && oCol.sType != "html" )
						{
							/* String is always the 'fallback' option */
							oCol.sType = 'string';
						}
					}
				}
			}
			
			/* Add to the display array */
			oSettings.aiDisplayMaster.push( iRow );
		
			/* Create the DOM information */
			if ( !oSettings.oFeatures.bDeferRender )
			{
				_fnCreateTr( oSettings, iRow );
			}
		
			return iRow;
		}
		
		
		/**
		 * Read in the data from the target table from the DOM
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnGatherData( oSettings )
		{
			var iLoop, i, iLen, j, jLen, jInner,
			 	nTds, nTrs, nTd, nTr, aLocalData, iThisIndex,
				iRow, iRows, iColumn, iColumns, sNodeName,
				oCol, oData;
			
			/*
			 * Process by row first
			 * Add the data object for the whole table - storing the tr node. Note - no point in getting
			 * DOM based data if we are going to go and replace it with Ajax source data.
			 */
			if ( oSettings.bDeferLoading || oSettings.sAjaxSource === null )
			{
				nTr = oSettings.nTBody.firstChild;
				while ( nTr )
				{
					if ( nTr.nodeName.toUpperCase() == "TR" )
					{
						iThisIndex = oSettings.aoData.length;
						nTr._DT_RowIndex = iThisIndex;
						oSettings.aoData.push( $.extend( true, {}, DataTable.models.oRow, {
							"nTr": nTr
						} ) );
		
						oSettings.aiDisplayMaster.push( iThisIndex );
						nTd = nTr.firstChild;
						jInner = 0;
						while ( nTd )
						{
							sNodeName = nTd.nodeName.toUpperCase();
							if ( sNodeName == "TD" || sNodeName == "TH" )
							{
								_fnSetCellData( oSettings, iThisIndex, jInner, $.trim(nTd.innerHTML) );
								jInner++;
							}
							nTd = nTd.nextSibling;
						}
					}
					nTr = nTr.nextSibling;
				}
			}
			
			/* Gather in the TD elements of the Table - note that this is basically the same as
			 * fnGetTdNodes, but that function takes account of hidden columns, which we haven't yet
			 * setup!
			 */
			nTrs = _fnGetTrNodes( oSettings );
			nTds = [];
			for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
			{
				nTd = nTrs[i].firstChild;
				while ( nTd )
				{
					sNodeName = nTd.nodeName.toUpperCase();
					if ( sNodeName == "TD" || sNodeName == "TH" )
					{
						nTds.push( nTd );
					}
					nTd = nTd.nextSibling;
				}
			}
			
			/* Now process by column */
			for ( iColumn=0, iColumns=oSettings.aoColumns.length ; iColumn<iColumns ; iColumn++ )
			{
				oCol = oSettings.aoColumns[iColumn];
		
				/* Get the title of the column - unless there is a user set one */
				if ( oCol.sTitle === null )
				{
					oCol.sTitle = oCol.nTh.innerHTML;
				}
				
				var
					bAutoType = oCol._bAutoType,
					bRender = typeof oCol.fnRender === 'function',
					bClass = oCol.sClass !== null,
					bVisible = oCol.bVisible,
					nCell, sThisType, sRendered, sValType;
				
				/* A single loop to rule them all (and be more efficient) */
				if ( bAutoType || bRender || bClass || !bVisible )
				{
					for ( iRow=0, iRows=oSettings.aoData.length ; iRow<iRows ; iRow++ )
					{
						oData = oSettings.aoData[iRow];
						nCell = nTds[ (iRow*iColumns) + iColumn ];
						
						/* Type detection */
						if ( bAutoType && oCol.sType != 'string' )
						{
							sValType = _fnGetCellData( oSettings, iRow, iColumn, 'type' );
							if ( sValType !== '' )
							{
								sThisType = _fnDetectType( sValType );
								if ( oCol.sType === null )
								{
									oCol.sType = sThisType;
								}
								else if ( oCol.sType != sThisType && 
								          oCol.sType != "html" )
								{
									/* String is always the 'fallback' option */
									oCol.sType = 'string';
								}
							}
						}
		
						if ( oCol.mRender )
						{
							// mRender has been defined, so we need to get the value and set it
							nCell.innerHTML = _fnGetCellData( oSettings, iRow, iColumn, 'display' );
						}
						else if ( oCol.mData !== iColumn )
						{
							// If mData is not the same as the column number, then we need to
							// get the dev set value. If it is the column, no point in wasting
							// time setting the value that is already there!
							nCell.innerHTML = _fnGetCellData( oSettings, iRow, iColumn, 'display' );
						}
						
						/* Rendering */
						if ( bRender )
						{
							sRendered = _fnRender( oSettings, iRow, iColumn );
							nCell.innerHTML = sRendered;
							if ( oCol.bUseRendered )
							{
								/* Use the rendered data for filtering / sorting */
								_fnSetCellData( oSettings, iRow, iColumn, sRendered );
							}
						}
						
						/* Classes */
						if ( bClass )
						{
							nCell.className += ' '+oCol.sClass;
						}
						
						/* Column visibility */
						if ( !bVisible )
						{
							oData._anHidden[iColumn] = nCell;
							nCell.parentNode.removeChild( nCell );
						}
						else
						{
							oData._anHidden[iColumn] = null;
						}
		
						if ( oCol.fnCreatedCell )
						{
							oCol.fnCreatedCell.call( oSettings.oInstance,
								nCell, _fnGetCellData( oSettings, iRow, iColumn, 'display' ), oData._aData, iRow, iColumn
							);
						}
					}
				}
			}
		
			/* Row created callbacks */
			if ( oSettings.aoRowCreatedCallback.length !== 0 )
			{
				for ( i=0, iLen=oSettings.aoData.length ; i<iLen ; i++ )
				{
					oData = oSettings.aoData[i];
					_fnCallbackFire( oSettings, 'aoRowCreatedCallback', null, [oData.nTr, oData._aData, i] );
				}
			}
		}
		
		
		/**
		 * Take a TR element and convert it to an index in aoData
		 *  @param {object} oSettings dataTables settings object
		 *  @param {node} n the TR element to find
		 *  @returns {int} index if the node is found, null if not
		 *  @memberof DataTable#oApi
		 */
		function _fnNodeToDataIndex( oSettings, n )
		{
			return (n._DT_RowIndex!==undefined) ? n._DT_RowIndex : null;
		}
		
		
		/**
		 * Take a TD element and convert it into a column data index (not the visible index)
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iRow The row number the TD/TH can be found in
		 *  @param {node} n The TD/TH element to find
		 *  @returns {int} index if the node is found, -1 if not
		 *  @memberof DataTable#oApi
		 */
		function _fnNodeToColumnIndex( oSettings, iRow, n )
		{
			var anCells = _fnGetTdNodes( oSettings, iRow );
		
			for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				if ( anCells[i] === n )
				{
					return i;
				}
			}
			return -1;
		}
		
		
		/**
		 * Get an array of data for a given row from the internal data cache
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iRow aoData row id
		 *  @param {string} sSpecific data get type ('type' 'filter' 'sort')
		 *  @param {array} aiColumns Array of column indexes to get data from
		 *  @returns {array} Data array
		 *  @memberof DataTable#oApi
		 */
		function _fnGetRowData( oSettings, iRow, sSpecific, aiColumns )
		{
			var out = [];
			for ( var i=0, iLen=aiColumns.length ; i<iLen ; i++ )
			{
				out.push( _fnGetCellData( oSettings, iRow, aiColumns[i], sSpecific ) );
			}
			return out;
		}
		
		
		/**
		 * Get the data for a given cell from the internal cache, taking into account data mapping
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iRow aoData row id
		 *  @param {int} iCol Column index
		 *  @param {string} sSpecific data get type ('display', 'type' 'filter' 'sort')
		 *  @returns {*} Cell data
		 *  @memberof DataTable#oApi
		 */
		function _fnGetCellData( oSettings, iRow, iCol, sSpecific )
		{
			var sData;
			var oCol = oSettings.aoColumns[iCol];
			var oData = oSettings.aoData[iRow]._aData;
		
			if ( (sData=oCol.fnGetData( oData, sSpecific )) === undefined )
			{
				if ( oSettings.iDrawError != oSettings.iDraw && oCol.sDefaultContent === null )
				{
					_fnLog( oSettings, 0, "Requested unknown parameter "+
						(typeof oCol.mData=='function' ? '{mData function}' : "'"+oCol.mData+"'")+
						" from the data source for row "+iRow );
					oSettings.iDrawError = oSettings.iDraw;
				}
				return oCol.sDefaultContent;
			}
		
			/* When the data source is null, we can use default column data */
			if ( sData === null && oCol.sDefaultContent !== null )
			{
				sData = oCol.sDefaultContent;
			}
			else if ( typeof sData === 'function' )
			{
				/* If the data source is a function, then we run it and use the return */
				return sData();
			}
		
			if ( sSpecific == 'display' && sData === null )
			{
				return '';
			}
			return sData;
		}
		
		
		/**
		 * Set the value for a specific cell, into the internal data cache
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iRow aoData row id
		 *  @param {int} iCol Column index
		 *  @param {*} val Value to set
		 *  @memberof DataTable#oApi
		 */
		function _fnSetCellData( oSettings, iRow, iCol, val )
		{
			var oCol = oSettings.aoColumns[iCol];
			var oData = oSettings.aoData[iRow]._aData;
		
			oCol.fnSetData( oData, val );
		}
		
		
		// Private variable that is used to match array syntax in the data property object
		var __reArray = /\[.*?\]$/;
		
		/**
		 * Return a function that can be used to get data from a source object, taking
		 * into account the ability to use nested objects as a source
		 *  @param {string|int|function} mSource The data source for the object
		 *  @returns {function} Data get function
		 *  @memberof DataTable#oApi
		 */
		function _fnGetObjectDataFn( mSource )
		{
			if ( mSource === null )
			{
				/* Give an empty string for rendering / sorting etc */
				return function (data, type) {
					return null;
				};
			}
			else if ( typeof mSource === 'function' )
			{
				return function (data, type, extra) {
					return mSource( data, type, extra );
				};
			}
			else if ( typeof mSource === 'string' && (mSource.indexOf('.') !== -1 || mSource.indexOf('[') !== -1) )
			{
				/* If there is a . in the source string then the data source is in a 
				 * nested object so we loop over the data for each level to get the next
				 * level down. On each loop we test for undefined, and if found immediately
				 * return. This allows entire objects to be missing and sDefaultContent to
				 * be used if defined, rather than throwing an error
				 */
				var fetchData = function (data, type, src) {
					var a = src.split('.');
					var arrayNotation, out, innerSrc;
		
					if ( src !== "" )
					{
						for ( var i=0, iLen=a.length ; i<iLen ; i++ )
						{
							// Check if we are dealing with an array notation request
							arrayNotation = a[i].match(__reArray);
		
							if ( arrayNotation ) {
								a[i] = a[i].replace(__reArray, '');
		
								// Condition allows simply [] to be passed in
								if ( a[i] !== "" ) {
									data = data[ a[i] ];
								}
								out = [];
								
								// Get the remainder of the nested object to get
								a.splice( 0, i+1 );
								innerSrc = a.join('.');
		
								// Traverse each entry in the array getting the properties requested
								for ( var j=0, jLen=data.length ; j<jLen ; j++ ) {
									out.push( fetchData( data[j], type, innerSrc ) );
								}
		
								// If a string is given in between the array notation indicators, that
								// is used to join the strings together, otherwise an array is returned
								var join = arrayNotation[0].substring(1, arrayNotation[0].length-1);
								data = (join==="") ? out : out.join(join);
		
								// The inner call to fetchData has already traversed through the remainder
								// of the source requested, so we exit from the loop
								break;
							}
		
							if ( data === null || data[ a[i] ] === undefined )
							{
								return undefined;
							}
							data = data[ a[i] ];
						}
					}
		
					return data;
				};
		
				return function (data, type) {
					return fetchData( data, type, mSource );
				};
			}
			else
			{
				/* Array or flat object mapping */
				return function (data, type) {
					return data[mSource];	
				};
			}
		}
		
		
		/**
		 * Return a function that can be used to set data from a source object, taking
		 * into account the ability to use nested objects as a source
		 *  @param {string|int|function} mSource The data source for the object
		 *  @returns {function} Data set function
		 *  @memberof DataTable#oApi
		 */
		function _fnSetObjectDataFn( mSource )
		{
			if ( mSource === null )
			{
				/* Nothing to do when the data source is null */
				return function (data, val) {};
			}
			else if ( typeof mSource === 'function' )
			{
				return function (data, val) {
					mSource( data, 'set', val );
				};
			}
			else if ( typeof mSource === 'string' && (mSource.indexOf('.') !== -1 || mSource.indexOf('[') !== -1) )
			{
				/* Like the get, we need to get data from a nested object */
				var setData = function (data, val, src) {
					var a = src.split('.'), b;
					var arrayNotation, o, innerSrc;
		
					for ( var i=0, iLen=a.length-1 ; i<iLen ; i++ )
					{
						// Check if we are dealing with an array notation request
						arrayNotation = a[i].match(__reArray);
		
						if ( arrayNotation )
						{
							a[i] = a[i].replace(__reArray, '');
							data[ a[i] ] = [];
							
							// Get the remainder of the nested object to set so we can recurse
							b = a.slice();
							b.splice( 0, i+1 );
							innerSrc = b.join('.');
		
							// Traverse each entry in the array setting the properties requested
							for ( var j=0, jLen=val.length ; j<jLen ; j++ )
							{
								o = {};
								setData( o, val[j], innerSrc );
								data[ a[i] ].push( o );
							}
		
							// The inner call to setData has already traversed through the remainder
							// of the source and has set the data, thus we can exit here
							return;
						}
		
						// If the nested object doesn't currently exist - since we are
						// trying to set the value - create it
						if ( data[ a[i] ] === null || data[ a[i] ] === undefined )
						{
							data[ a[i] ] = {};
						}
						data = data[ a[i] ];
					}
		
					// If array notation is used, we just want to strip it and use the property name
					// and assign the value. If it isn't used, then we get the result we want anyway
					data[ a[a.length-1].replace(__reArray, '') ] = val;
				};
		
				return function (data, val) {
					return setData( data, val, mSource );
				};
			}
			else
			{
				/* Array or flat object mapping */
				return function (data, val) {
					data[mSource] = val;	
				};
			}
		}
		
		
		/**
		 * Return an array with the full table data
		 *  @param {object} oSettings dataTables settings object
		 *  @returns array {array} aData Master data array
		 *  @memberof DataTable#oApi
		 */
		function _fnGetDataMaster ( oSettings )
		{
			var aData = [];
			var iLen = oSettings.aoData.length;
			for ( var i=0 ; i<iLen; i++ )
			{
				aData.push( oSettings.aoData[i]._aData );
			}
			return aData;
		}
		
		
		/**
		 * Nuke the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnClearTable( oSettings )
		{
			oSettings.aoData.splice( 0, oSettings.aoData.length );
			oSettings.aiDisplayMaster.splice( 0, oSettings.aiDisplayMaster.length );
			oSettings.aiDisplay.splice( 0, oSettings.aiDisplay.length );
			_fnCalculateEnd( oSettings );
		}
		
		
		 /**
		 * Take an array of integers (index array) and remove a target integer (value - not 
		 * the key!)
		 *  @param {array} a Index array to target
		 *  @param {int} iTarget value to find
		 *  @memberof DataTable#oApi
		 */
		function _fnDeleteIndex( a, iTarget )
		{
			var iTargetIndex = -1;
			
			for ( var i=0, iLen=a.length ; i<iLen ; i++ )
			{
				if ( a[i] == iTarget )
				{
					iTargetIndex = i;
				}
				else if ( a[i] > iTarget )
				{
					a[i]--;
				}
			}
			
			if ( iTargetIndex != -1 )
			{
				a.splice( iTargetIndex, 1 );
			}
		}
		
		
		 /**
		 * Call the developer defined fnRender function for a given cell (row/column) with
		 * the required parameters and return the result.
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iRow aoData index for the row
		 *  @param {int} iCol aoColumns index for the column
		 *  @returns {*} Return of the developer's fnRender function
		 *  @memberof DataTable#oApi
		 */
		function _fnRender( oSettings, iRow, iCol )
		{
			var oCol = oSettings.aoColumns[iCol];
		
			return oCol.fnRender( {
				"iDataRow":    iRow,
				"iDataColumn": iCol,
				"oSettings":   oSettings,
				"aData":       oSettings.aoData[iRow]._aData,
				"mDataProp":   oCol.mData
			}, _fnGetCellData(oSettings, iRow, iCol, 'display') );
		}
		/**
		 * Create a new TR element (and it's TD children) for a row
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iRow Row to consider
		 *  @memberof DataTable#oApi
		 */
		function _fnCreateTr ( oSettings, iRow )
		{
			var oData = oSettings.aoData[iRow];
			var nTd;
		
			if ( oData.nTr === null )
			{
				oData.nTr = document.createElement('tr');
		
				/* Use a private property on the node to allow reserve mapping from the node
				 * to the aoData array for fast look up
				 */
				oData.nTr._DT_RowIndex = iRow;
		
				/* Special parameters can be given by the data source to be used on the row */
				if ( oData._aData.DT_RowId )
				{
					oData.nTr.id = oData._aData.DT_RowId;
				}
		
				if ( oData._aData.DT_RowClass )
				{
					oData.nTr.className = oData._aData.DT_RowClass;
				}
		
				/* Process each column */
				for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					var oCol = oSettings.aoColumns[i];
					nTd = document.createElement( oCol.sCellType );
		
					/* Render if needed - if bUseRendered is true then we already have the rendered
					 * value in the data source - so can just use that
					 */
					nTd.innerHTML = (typeof oCol.fnRender === 'function' && (!oCol.bUseRendered || oCol.mData === null)) ?
						_fnRender( oSettings, iRow, i ) :
						_fnGetCellData( oSettings, iRow, i, 'display' );
				
					/* Add user defined class */
					if ( oCol.sClass !== null )
					{
						nTd.className = oCol.sClass;
					}
					
					if ( oCol.bVisible )
					{
						oData.nTr.appendChild( nTd );
						oData._anHidden[i] = null;
					}
					else
					{
						oData._anHidden[i] = nTd;
					}
		
					if ( oCol.fnCreatedCell )
					{
						oCol.fnCreatedCell.call( oSettings.oInstance,
							nTd, _fnGetCellData( oSettings, iRow, i, 'display' ), oData._aData, iRow, i
						);
					}
				}
		
				_fnCallbackFire( oSettings, 'aoRowCreatedCallback', null, [oData.nTr, oData._aData, iRow] );
			}
		}
		
		
		/**
		 * Create the HTML header for the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnBuildHead( oSettings )
		{
			var i, nTh, iLen, j, jLen;
			var iThs = $('th, td', oSettings.nTHead).length;
			var iCorrector = 0;
			var jqChildren;
			
			/* If there is a header in place - then use it - otherwise it's going to get nuked... */
			if ( iThs !== 0 )
			{
				/* We've got a thead from the DOM, so remove hidden columns and apply width to vis cols */
				for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					nTh = oSettings.aoColumns[i].nTh;
					nTh.setAttribute('role', 'columnheader');
					if ( oSettings.aoColumns[i].bSortable )
					{
						nTh.setAttribute('tabindex', oSettings.iTabIndex);
						nTh.setAttribute('aria-controls', oSettings.sTableId);
					}
		
					if ( oSettings.aoColumns[i].sClass !== null )
					{
						$(nTh).addClass( oSettings.aoColumns[i].sClass );
					}
					
					/* Set the title of the column if it is user defined (not what was auto detected) */
					if ( oSettings.aoColumns[i].sTitle != nTh.innerHTML )
					{
						nTh.innerHTML = oSettings.aoColumns[i].sTitle;
					}
				}
			}
			else
			{
				/* We don't have a header in the DOM - so we are going to have to create one */
				var nTr = document.createElement( "tr" );
				
				for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					nTh = oSettings.aoColumns[i].nTh;
					nTh.innerHTML = oSettings.aoColumns[i].sTitle;
					nTh.setAttribute('tabindex', '0');
					
					if ( oSettings.aoColumns[i].sClass !== null )
					{
						$(nTh).addClass( oSettings.aoColumns[i].sClass );
					}
					
					nTr.appendChild( nTh );
				}
				$(oSettings.nTHead).html( '' )[0].appendChild( nTr );
				_fnDetectHeader( oSettings.aoHeader, oSettings.nTHead );
			}
			
			/* ARIA role for the rows */	
			$(oSettings.nTHead).children('tr').attr('role', 'row');
			
			/* Add the extra markup needed by jQuery UI's themes */
			if ( oSettings.bJUI )
			{
				for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					nTh = oSettings.aoColumns[i].nTh;
					
					var nDiv = document.createElement('div');
					nDiv.className = oSettings.oClasses.sSortJUIWrapper;
					$(nTh).contents().appendTo(nDiv);
					
					var nSpan = document.createElement('span');
					nSpan.className = oSettings.oClasses.sSortIcon;
					nDiv.appendChild( nSpan );
					nTh.appendChild( nDiv );
				}
			}
			
			if ( oSettings.oFeatures.bSort )
			{
				for ( i=0 ; i<oSettings.aoColumns.length ; i++ )
				{
					if ( oSettings.aoColumns[i].bSortable !== false )
					{
						_fnSortAttachListener( oSettings, oSettings.aoColumns[i].nTh, i );
					}
					else
					{
						$(oSettings.aoColumns[i].nTh).addClass( oSettings.oClasses.sSortableNone );
					}
				}
			}
			
			/* Deal with the footer - add classes if required */
			if ( oSettings.oClasses.sFooterTH !== "" )
			{
				$(oSettings.nTFoot).children('tr').children('th').addClass( oSettings.oClasses.sFooterTH );
			}
			
			/* Cache the footer elements */
			if ( oSettings.nTFoot !== null )
			{
				var anCells = _fnGetUniqueThs( oSettings, null, oSettings.aoFooter );
				for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					if ( anCells[i] )
					{
						oSettings.aoColumns[i].nTf = anCells[i];
						if ( oSettings.aoColumns[i].sClass )
						{
							$(anCells[i]).addClass( oSettings.aoColumns[i].sClass );
						}
					}
				}
			}
		}
		
		
		/**
		 * Draw the header (or footer) element based on the column visibility states. The
		 * methodology here is to use the layout array from _fnDetectHeader, modified for
		 * the instantaneous column visibility, to construct the new layout. The grid is
		 * traversed over cell at a time in a rows x columns grid fashion, although each 
		 * cell insert can cover multiple elements in the grid - which is tracks using the
		 * aApplied array. Cell inserts in the grid will only occur where there isn't
		 * already a cell in that position.
		 *  @param {object} oSettings dataTables settings object
		 *  @param array {objects} aoSource Layout array from _fnDetectHeader
		 *  @param {boolean} [bIncludeHidden=false] If true then include the hidden columns in the calc, 
		 *  @memberof DataTable#oApi
		 */
		function _fnDrawHead( oSettings, aoSource, bIncludeHidden )
		{
			var i, iLen, j, jLen, k, kLen, n, nLocalTr;
			var aoLocal = [];
			var aApplied = [];
			var iColumns = oSettings.aoColumns.length;
			var iRowspan, iColspan;
		
			if (  bIncludeHidden === undefined )
			{
				bIncludeHidden = false;
			}
		
			/* Make a copy of the master layout array, but without the visible columns in it */
			for ( i=0, iLen=aoSource.length ; i<iLen ; i++ )
			{
				aoLocal[i] = aoSource[i].slice();
				aoLocal[i].nTr = aoSource[i].nTr;
		
				/* Remove any columns which are currently hidden */
				for ( j=iColumns-1 ; j>=0 ; j-- )
				{
					if ( !oSettings.aoColumns[j].bVisible && !bIncludeHidden )
					{
						aoLocal[i].splice( j, 1 );
					}
				}
		
				/* Prep the applied array - it needs an element for each row */
				aApplied.push( [] );
			}
		
			for ( i=0, iLen=aoLocal.length ; i<iLen ; i++ )
			{
				nLocalTr = aoLocal[i].nTr;
				
				/* All cells are going to be replaced, so empty out the row */
				if ( nLocalTr )
				{
					while( (n = nLocalTr.firstChild) )
					{
						nLocalTr.removeChild( n );
					}
				}
		
				for ( j=0, jLen=aoLocal[i].length ; j<jLen ; j++ )
				{
					iRowspan = 1;
					iColspan = 1;
		
					/* Check to see if there is already a cell (row/colspan) covering our target
					 * insert point. If there is, then there is nothing to do.
					 */
					if ( aApplied[i][j] === undefined )
					{
						nLocalTr.appendChild( aoLocal[i][j].cell );
						aApplied[i][j] = 1;
		
						/* Expand the cell to cover as many rows as needed */
						while ( aoLocal[i+iRowspan] !== undefined &&
						        aoLocal[i][j].cell == aoLocal[i+iRowspan][j].cell )
						{
							aApplied[i+iRowspan][j] = 1;
							iRowspan++;
						}
		
						/* Expand the cell to cover as many columns as needed */
						while ( aoLocal[i][j+iColspan] !== undefined &&
						        aoLocal[i][j].cell == aoLocal[i][j+iColspan].cell )
						{
							/* Must update the applied array over the rows for the columns */
							for ( k=0 ; k<iRowspan ; k++ )
							{
								aApplied[i+k][j+iColspan] = 1;
							}
							iColspan++;
						}
		
						/* Do the actual expansion in the DOM */
						aoLocal[i][j].cell.rowSpan = iRowspan;
						aoLocal[i][j].cell.colSpan = iColspan;
					}
				}
			}
		}
		
		
		/**
		 * Insert the required TR nodes into the table for display
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnDraw( oSettings )
		{
			/* Provide a pre-callback function which can be used to cancel the draw is false is returned */
			var aPreDraw = _fnCallbackFire( oSettings, 'aoPreDrawCallback', 'preDraw', [oSettings] );
			if ( $.inArray( false, aPreDraw ) !== -1 )
			{
				_fnProcessingDisplay( oSettings, false );
				return;
			}
			
			var i, iLen, n;
			var anRows = [];
			var iRowCount = 0;
			var iStripes = oSettings.asStripeClasses.length;
			var iOpenRows = oSettings.aoOpenRows.length;
			
			oSettings.bDrawing = true;
			
			/* Check and see if we have an initial draw position from state saving */
			if ( oSettings.iInitDisplayStart !== undefined && oSettings.iInitDisplayStart != -1 )
			{
				if ( oSettings.oFeatures.bServerSide )
				{
					oSettings._iDisplayStart = oSettings.iInitDisplayStart;
				}
				else
				{
					oSettings._iDisplayStart = (oSettings.iInitDisplayStart >= oSettings.fnRecordsDisplay()) ?
						0 : oSettings.iInitDisplayStart;
				}
				oSettings.iInitDisplayStart = -1;
				_fnCalculateEnd( oSettings );
			}
			
			/* Server-side processing draw intercept */
			if ( oSettings.bDeferLoading )
			{
				oSettings.bDeferLoading = false;
				oSettings.iDraw++;
			}
			else if ( !oSettings.oFeatures.bServerSide )
			{
				oSettings.iDraw++;
			}
			else if ( !oSettings.bDestroying && !_fnAjaxUpdate( oSettings ) )
			{
				return;
			}
			
			if ( oSettings.aiDisplay.length !== 0 )
			{
				var iStart = oSettings._iDisplayStart;
				var iEnd = oSettings._iDisplayEnd;
				
				if ( oSettings.oFeatures.bServerSide )
				{
					iStart = 0;
					iEnd = oSettings.aoData.length;
				}
				
				for ( var j=iStart ; j<iEnd ; j++ )
				{
					var aoData = oSettings.aoData[ oSettings.aiDisplay[j] ];
					if ( aoData.nTr === null )
					{
						_fnCreateTr( oSettings, oSettings.aiDisplay[j] );
					}
		
					var nRow = aoData.nTr;
					
					/* Remove the old striping classes and then add the new one */
					if ( iStripes !== 0 )
					{
						var sStripe = oSettings.asStripeClasses[ iRowCount % iStripes ];
						if ( aoData._sRowStripe != sStripe )
						{
							$(nRow).removeClass( aoData._sRowStripe ).addClass( sStripe );
							aoData._sRowStripe = sStripe;
						}
					}
					
					/* Row callback functions - might want to manipulate the row */
					_fnCallbackFire( oSettings, 'aoRowCallback', null, 
						[nRow, oSettings.aoData[ oSettings.aiDisplay[j] ]._aData, iRowCount, j] );
					
					anRows.push( nRow );
					iRowCount++;
					
					/* If there is an open row - and it is attached to this parent - attach it on redraw */
					if ( iOpenRows !== 0 )
					{
						for ( var k=0 ; k<iOpenRows ; k++ )
						{
							if ( nRow == oSettings.aoOpenRows[k].nParent )
							{
								anRows.push( oSettings.aoOpenRows[k].nTr );
								break;
							}
						}
					}
				}
			}
			else
			{
				/* Table is empty - create a row with an empty message in it */
				anRows[ 0 ] = document.createElement( 'tr' );
				
				if ( oSettings.asStripeClasses[0] )
				{
					anRows[ 0 ].className = oSettings.asStripeClasses[0];
				}
		
				var oLang = oSettings.oLanguage;
				var sZero = oLang.sZeroRecords;
				if ( oSettings.iDraw == 1 && oSettings.sAjaxSource !== null && !oSettings.oFeatures.bServerSide )
				{
					sZero = oLang.sLoadingRecords;
				}
				else if ( oLang.sEmptyTable && oSettings.fnRecordsTotal() === 0 )
				{
					sZero = oLang.sEmptyTable;
				}
		
				var nTd = document.createElement( 'td' );
				nTd.setAttribute( 'valign', "top" );
				nTd.colSpan = _fnVisbleColumns( oSettings );
				nTd.className = oSettings.oClasses.sRowEmpty;
				nTd.innerHTML = _fnInfoMacros( oSettings, sZero );
				
				anRows[ iRowCount ].appendChild( nTd );
			}
			
			/* Header and footer callbacks */
			_fnCallbackFire( oSettings, 'aoHeaderCallback', 'header', [ $(oSettings.nTHead).children('tr')[0], 
				_fnGetDataMaster( oSettings ), oSettings._iDisplayStart, oSettings.fnDisplayEnd(), oSettings.aiDisplay ] );
			
			_fnCallbackFire( oSettings, 'aoFooterCallback', 'footer', [ $(oSettings.nTFoot).children('tr')[0], 
				_fnGetDataMaster( oSettings ), oSettings._iDisplayStart, oSettings.fnDisplayEnd(), oSettings.aiDisplay ] );
			
			/* 
			 * Need to remove any old row from the display - note we can't just empty the tbody using
			 * $().html('') since this will unbind the jQuery event handlers (even although the node 
			 * still exists!) - equally we can't use innerHTML, since IE throws an exception.
			 */
			var
				nAddFrag = document.createDocumentFragment(),
				nRemoveFrag = document.createDocumentFragment(),
				nBodyPar, nTrs;
			
			if ( oSettings.nTBody )
			{
				nBodyPar = oSettings.nTBody.parentNode;
				nRemoveFrag.appendChild( oSettings.nTBody );
				
				/* When doing infinite scrolling, only remove child rows when sorting, filtering or start
				 * up. When not infinite scroll, always do it.
				 */
				if ( !oSettings.oScroll.bInfinite || !oSettings._bInitComplete ||
				 	oSettings.bSorted || oSettings.bFiltered )
				{
					while( (n = oSettings.nTBody.firstChild) )
					{
						oSettings.nTBody.removeChild( n );
					}
				}
				
				/* Put the draw table into the dom */
				for ( i=0, iLen=anRows.length ; i<iLen ; i++ )
				{
					nAddFrag.appendChild( anRows[i] );
				}
				
				oSettings.nTBody.appendChild( nAddFrag );
				if ( nBodyPar !== null )
				{
					nBodyPar.appendChild( oSettings.nTBody );
				}
			}
			
			/* Call all required callback functions for the end of a draw */
			_fnCallbackFire( oSettings, 'aoDrawCallback', 'draw', [oSettings] );
			
			/* Draw is complete, sorting and filtering must be as well */
			oSettings.bSorted = false;
			oSettings.bFiltered = false;
			oSettings.bDrawing = false;
			
			if ( oSettings.oFeatures.bServerSide )
			{
				_fnProcessingDisplay( oSettings, false );
				if ( !oSettings._bInitComplete )
				{
					_fnInitComplete( oSettings );
				}
			}
		}
		
		
		/**
		 * Redraw the table - taking account of the various features which are enabled
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnReDraw( oSettings )
		{
			if ( oSettings.oFeatures.bSort )
			{
				/* Sorting will refilter and draw for us */
				_fnSort( oSettings, oSettings.oPreviousSearch );
			}
			else if ( oSettings.oFeatures.bFilter )
			{
				/* Filtering will redraw for us */
				_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
			}
			else
			{
				_fnCalculateEnd( oSettings );
				_fnDraw( oSettings );
			}
		}
		
		
		/**
		 * Add the options to the page HTML for the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnAddOptionsHtml ( oSettings )
		{
			/*
			 * Create a temporary, empty, div which we can later on replace with what we have generated
			 * we do it this way to rendering the 'options' html offline - speed :-)
			 */
			var nHolding = $('<div></div>')[0];
			oSettings.nTable.parentNode.insertBefore( nHolding, oSettings.nTable );
			
			/* 
			 * All DataTables are wrapped in a div
			 */
			oSettings.nTableWrapper = $('<div id="'+oSettings.sTableId+'_wrapper" class="'+oSettings.oClasses.sWrapper+'" role="grid"></div>')[0];
			oSettings.nTableReinsertBefore = oSettings.nTable.nextSibling;
		
			/* Track where we want to insert the option */
			var nInsertNode = oSettings.nTableWrapper;
			
			/* Loop over the user set positioning and place the elements as needed */
			var aDom = oSettings.sDom.split('');
			var nTmp, iPushFeature, cOption, nNewNode, cNext, sAttr, j;
			for ( var i=0 ; i<aDom.length ; i++ )
			{
				iPushFeature = 0;
				cOption = aDom[i];
				
				if ( cOption == '<' )
				{
					/* New container div */
					nNewNode = $('<div></div>')[0];
					
					/* Check to see if we should append an id and/or a class name to the container */
					cNext = aDom[i+1];
					if ( cNext == "'" || cNext == '"' )
					{
						sAttr = "";
						j = 2;
						while ( aDom[i+j] != cNext )
						{
							sAttr += aDom[i+j];
							j++;
						}
						
						/* Replace jQuery UI constants */
						if ( sAttr == "H" )
						{
							sAttr = oSettings.oClasses.sJUIHeader;
						}
						else if ( sAttr == "F" )
						{
							sAttr = oSettings.oClasses.sJUIFooter;
						}
						
						/* The attribute can be in the format of "#id.class", "#id" or "class" This logic
						 * breaks the string into parts and applies them as needed
						 */
						if ( sAttr.indexOf('.') != -1 )
						{
							var aSplit = sAttr.split('.');
							nNewNode.id = aSplit[0].substr(1, aSplit[0].length-1);
							nNewNode.className = aSplit[1];
						}
						else if ( sAttr.charAt(0) == "#" )
						{
							nNewNode.id = sAttr.substr(1, sAttr.length-1);
						}
						else
						{
							nNewNode.className = sAttr;
						}
						
						i += j; /* Move along the position array */
					}
					
					nInsertNode.appendChild( nNewNode );
					nInsertNode = nNewNode;
				}
				else if ( cOption == '>' )
				{
					/* End container div */
					nInsertNode = nInsertNode.parentNode;
				}
				else if ( cOption == 'l' && oSettings.oFeatures.bPaginate && oSettings.oFeatures.bLengthChange )
				{
					/* Length */
					nTmp = _fnFeatureHtmlLength( oSettings );
					iPushFeature = 1;
				}
				else if ( cOption == 'f' && oSettings.oFeatures.bFilter )
				{
					/* Filter */
					nTmp = _fnFeatureHtmlFilter( oSettings );
					iPushFeature = 1;
				}
				else if ( cOption == 'r' && oSettings.oFeatures.bProcessing )
				{
					/* pRocessing */
					nTmp = _fnFeatureHtmlProcessing( oSettings );
					iPushFeature = 1;
				}
				else if ( cOption == 't' )
				{
					/* Table */
					nTmp = _fnFeatureHtmlTable( oSettings );
					iPushFeature = 1;
				}
				else if ( cOption ==  'i' && oSettings.oFeatures.bInfo )
				{
					/* Info */
					nTmp = _fnFeatureHtmlInfo( oSettings );
					iPushFeature = 1;
				}
				else if ( cOption == 'p' && oSettings.oFeatures.bPaginate )
				{
					/* Pagination */
					nTmp = _fnFeatureHtmlPaginate( oSettings );
					iPushFeature = 1;
				}
				else if ( DataTable.ext.aoFeatures.length !== 0 )
				{
					/* Plug-in features */
					var aoFeatures = DataTable.ext.aoFeatures;
					for ( var k=0, kLen=aoFeatures.length ; k<kLen ; k++ )
					{
						if ( cOption == aoFeatures[k].cFeature )
						{
							nTmp = aoFeatures[k].fnInit( oSettings );
							if ( nTmp )
							{
								iPushFeature = 1;
							}
							break;
						}
					}
				}
				
				/* Add to the 2D features array */
				if ( iPushFeature == 1 && nTmp !== null )
				{
					if ( typeof oSettings.aanFeatures[cOption] !== 'object' )
					{
						oSettings.aanFeatures[cOption] = [];
					}
					oSettings.aanFeatures[cOption].push( nTmp );
					nInsertNode.appendChild( nTmp );
				}
			}
			
			/* Built our DOM structure - replace the holding div with what we want */
			nHolding.parentNode.replaceChild( oSettings.nTableWrapper, nHolding );
		}
		
		
		/**
		 * Use the DOM source to create up an array of header cells. The idea here is to
		 * create a layout grid (array) of rows x columns, which contains a reference
		 * to the cell that that point in the grid (regardless of col/rowspan), such that
		 * any column / row could be removed and the new grid constructed
		 *  @param array {object} aLayout Array to store the calculated layout in
		 *  @param {node} nThead The header/footer element for the table
		 *  @memberof DataTable#oApi
		 */
		function _fnDetectHeader ( aLayout, nThead )
		{
			var nTrs = $(nThead).children('tr');
			var nTr, nCell;
			var i, k, l, iLen, jLen, iColShifted, iColumn, iColspan, iRowspan;
			var bUnique;
			var fnShiftCol = function ( a, i, j ) {
				var k = a[i];
		                while ( k[j] ) {
					j++;
				}
				return j;
			};
		
			aLayout.splice( 0, aLayout.length );
			
			/* We know how many rows there are in the layout - so prep it */
			for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
			{
				aLayout.push( [] );
			}
			
			/* Calculate a layout array */
			for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
			{
				nTr = nTrs[i];
				iColumn = 0;
				
				/* For every cell in the row... */
				nCell = nTr.firstChild;
				while ( nCell ) {
					if ( nCell.nodeName.toUpperCase() == "TD" ||
					     nCell.nodeName.toUpperCase() == "TH" )
					{
						/* Get the col and rowspan attributes from the DOM and sanitise them */
						iColspan = nCell.getAttribute('colspan') * 1;
						iRowspan = nCell.getAttribute('rowspan') * 1;
						iColspan = (!iColspan || iColspan===0 || iColspan===1) ? 1 : iColspan;
						iRowspan = (!iRowspan || iRowspan===0 || iRowspan===1) ? 1 : iRowspan;
		
						/* There might be colspan cells already in this row, so shift our target 
						 * accordingly
						 */
						iColShifted = fnShiftCol( aLayout, i, iColumn );
						
						/* Cache calculation for unique columns */
						bUnique = iColspan === 1 ? true : false;
						
						/* If there is col / rowspan, copy the information into the layout grid */
						for ( l=0 ; l<iColspan ; l++ )
						{
							for ( k=0 ; k<iRowspan ; k++ )
							{
								aLayout[i+k][iColShifted+l] = {
									"cell": nCell,
									"unique": bUnique
								};
								aLayout[i+k].nTr = nTr;
							}
						}
					}
					nCell = nCell.nextSibling;
				}
			}
		}
		
		
		/**
		 * Get an array of unique th elements, one for each column
		 *  @param {object} oSettings dataTables settings object
		 *  @param {node} nHeader automatically detect the layout from this node - optional
		 *  @param {array} aLayout thead/tfoot layout from _fnDetectHeader - optional
		 *  @returns array {node} aReturn list of unique th's
		 *  @memberof DataTable#oApi
		 */
		function _fnGetUniqueThs ( oSettings, nHeader, aLayout )
		{
			var aReturn = [];
			if ( !aLayout )
			{
				aLayout = oSettings.aoHeader;
				if ( nHeader )
				{
					aLayout = [];
					_fnDetectHeader( aLayout, nHeader );
				}
			}
		
			for ( var i=0, iLen=aLayout.length ; i<iLen ; i++ )
			{
				for ( var j=0, jLen=aLayout[i].length ; j<jLen ; j++ )
				{
					if ( aLayout[i][j].unique && 
						 (!aReturn[j] || !oSettings.bSortCellsTop) )
					{
						aReturn[j] = aLayout[i][j].cell;
					}
				}
			}
			
			return aReturn;
		}
		
		
		
		/**
		 * Update the table using an Ajax call
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {boolean} Block the table drawing or not
		 *  @memberof DataTable#oApi
		 */
		function _fnAjaxUpdate( oSettings )
		{
			if ( oSettings.bAjaxDataGet )
			{
				oSettings.iDraw++;
				_fnProcessingDisplay( oSettings, true );
				var iColumns = oSettings.aoColumns.length;
				var aoData = _fnAjaxParameters( oSettings );
				_fnServerParams( oSettings, aoData );
				
				oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aoData,
					function(json) {
						_fnAjaxUpdateDraw( oSettings, json );
					}, oSettings );
				return false;
			}
			else
			{
				return true;
			}
		}
		
		
		/**
		 * Build up the parameters in an object needed for a server-side processing request
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {bool} block the table drawing or not
		 *  @memberof DataTable#oApi
		 */
		function _fnAjaxParameters( oSettings )
		{
			var iColumns = oSettings.aoColumns.length;
			var aoData = [], mDataProp, aaSort, aDataSort;
			var i, j;
			
			aoData.push( { "name": "sEcho",          "value": oSettings.iDraw } );
			aoData.push( { "name": "iColumns",       "value": iColumns } );
			aoData.push( { "name": "sColumns",       "value": _fnColumnOrdering(oSettings) } );
			aoData.push( { "name": "iDisplayStart",  "value": oSettings._iDisplayStart } );
			aoData.push( { "name": "iDisplayLength", "value": oSettings.oFeatures.bPaginate !== false ?
				oSettings._iDisplayLength : -1 } );
				
			for ( i=0 ; i<iColumns ; i++ )
			{
			  mDataProp = oSettings.aoColumns[i].mData;
				aoData.push( { "name": "mDataProp_"+i, "value": typeof(mDataProp)==="function" ? 'function' : mDataProp } );
			}
			
			/* Filtering */
			if ( oSettings.oFeatures.bFilter !== false )
			{
				aoData.push( { "name": "sSearch", "value": oSettings.oPreviousSearch.sSearch } );
				aoData.push( { "name": "bRegex",  "value": oSettings.oPreviousSearch.bRegex } );
				for ( i=0 ; i<iColumns ; i++ )
				{
					aoData.push( { "name": "sSearch_"+i,     "value": oSettings.aoPreSearchCols[i].sSearch } );
					aoData.push( { "name": "bRegex_"+i,      "value": oSettings.aoPreSearchCols[i].bRegex } );
					aoData.push( { "name": "bSearchable_"+i, "value": oSettings.aoColumns[i].bSearchable } );
				}
			}
			
			/* Sorting */
			if ( oSettings.oFeatures.bSort !== false )
			{
				var iCounter = 0;
		
				aaSort = ( oSettings.aaSortingFixed !== null ) ?
					oSettings.aaSortingFixed.concat( oSettings.aaSorting ) :
					oSettings.aaSorting.slice();
				
				for ( i=0 ; i<aaSort.length ; i++ )
				{
					aDataSort = oSettings.aoColumns[ aaSort[i][0] ].aDataSort;
					
					for ( j=0 ; j<aDataSort.length ; j++ )
					{
						aoData.push( { "name": "iSortCol_"+iCounter,  "value": aDataSort[j] } );
						aoData.push( { "name": "sSortDir_"+iCounter,  "value": aaSort[i][1] } );
						iCounter++;
					}
				}
				aoData.push( { "name": "iSortingCols",   "value": iCounter } );
				
				for ( i=0 ; i<iColumns ; i++ )
				{
					aoData.push( { "name": "bSortable_"+i,  "value": oSettings.aoColumns[i].bSortable } );
				}
			}
			
			return aoData;
		}
		
		
		/**
		 * Add Ajax parameters from plug-ins
		 *  @param {object} oSettings dataTables settings object
		 *  @param array {objects} aoData name/value pairs to send to the server
		 *  @memberof DataTable#oApi
		 */
		function _fnServerParams( oSettings, aoData )
		{
			_fnCallbackFire( oSettings, 'aoServerParams', 'serverParams', [aoData] );
		}
		
		
		/**
		 * Data the data from the server (nuking the old) and redraw the table
		 *  @param {object} oSettings dataTables settings object
		 *  @param {object} json json data return from the server.
		 *  @param {string} json.sEcho Tracking flag for DataTables to match requests
		 *  @param {int} json.iTotalRecords Number of records in the data set, not accounting for filtering
		 *  @param {int} json.iTotalDisplayRecords Number of records in the data set, accounting for filtering
		 *  @param {array} json.aaData The data to display on this page
		 *  @param {string} [json.sColumns] Column ordering (sName, comma separated)
		 *  @memberof DataTable#oApi
		 */
		function _fnAjaxUpdateDraw ( oSettings, json )
		{
			if ( json.sEcho !== undefined )
			{
				/* Protect against old returns over-writing a new one. Possible when you get
				 * very fast interaction, and later queries are completed much faster
				 */
				if ( json.sEcho*1 < oSettings.iDraw )
				{
					return;
				}
				else
				{
					oSettings.iDraw = json.sEcho * 1;
				}
			}
			
			if ( !oSettings.oScroll.bInfinite ||
				   (oSettings.oScroll.bInfinite && (oSettings.bSorted || oSettings.bFiltered)) )
			{
				_fnClearTable( oSettings );
			}
			oSettings._iRecordsTotal = parseInt(json.iTotalRecords, 10);
			oSettings._iRecordsDisplay = parseInt(json.iTotalDisplayRecords, 10);
			
			/* Determine if reordering is required */
			var sOrdering = _fnColumnOrdering(oSettings);
			var bReOrder = (json.sColumns !== undefined && sOrdering !== "" && json.sColumns != sOrdering );
			var aiIndex;
			if ( bReOrder )
			{
				aiIndex = _fnReOrderIndex( oSettings, json.sColumns );
			}
			
			var aData = _fnGetObjectDataFn( oSettings.sAjaxDataProp )( json );
			for ( var i=0, iLen=aData.length ; i<iLen ; i++ )
			{
				if ( bReOrder )
				{
					/* If we need to re-order, then create a new array with the correct order and add it */
					var aDataSorted = [];
					for ( var j=0, jLen=oSettings.aoColumns.length ; j<jLen ; j++ )
					{
						aDataSorted.push( aData[i][ aiIndex[j] ] );
					}
					_fnAddData( oSettings, aDataSorted );
				}
				else
				{
					/* No re-order required, sever got it "right" - just straight add */
					_fnAddData( oSettings, aData[i] );
				}
			}
			oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
			
			oSettings.bAjaxDataGet = false;
			_fnDraw( oSettings );
			oSettings.bAjaxDataGet = true;
			_fnProcessingDisplay( oSettings, false );
		}
		
		
		
		/**
		 * Generate the node required for filtering text
		 *  @returns {node} Filter control element
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnFeatureHtmlFilter ( oSettings )
		{
			var oPreviousSearch = oSettings.oPreviousSearch;
			
			var sSearchStr = oSettings.oLanguage.sSearch;
			sSearchStr = (sSearchStr.indexOf('_INPUT_') !== -1) ?
			  sSearchStr.replace('_INPUT_', '<input type="text" />') :
			  sSearchStr==="" ? '<input type="text" />' : sSearchStr+' <input type="text" />';
			
			var nFilter = document.createElement( 'div' );
			nFilter.className = oSettings.oClasses.sFilter;
			nFilter.innerHTML = '<label>'+sSearchStr+'</label>';
			if ( !oSettings.aanFeatures.f )
			{
				nFilter.id = oSettings.sTableId+'_filter';
			}
			
			var jqFilter = $('input[type="text"]', nFilter);
		
			// Store a reference to the input element, so other input elements could be
			// added to the filter wrapper if needed (submit button for example)
			nFilter._DT_Input = jqFilter[0];
		
			jqFilter.val( oPreviousSearch.sSearch.replace('"','&quot;') );
			jqFilter.bind( 'keyup.DT', function(e) {
				/* Update all other filter input elements for the new display */
				var n = oSettings.aanFeatures.f;
				var val = this.value==="" ? "" : this.value; // mental IE8 fix :-(
		
				for ( var i=0, iLen=n.length ; i<iLen ; i++ )
				{
					if ( n[i] != $(this).parents('div.dataTables_filter')[0] )
					{
						$(n[i]._DT_Input).val( val );
					}
				}
				
				/* Now do the filter */
				if ( val != oPreviousSearch.sSearch )
				{
					_fnFilterComplete( oSettings, { 
						"sSearch": val, 
						"bRegex": oPreviousSearch.bRegex,
						"bSmart": oPreviousSearch.bSmart ,
						"bCaseInsensitive": oPreviousSearch.bCaseInsensitive 
					} );
				}
			} );
		
			jqFilter
				.attr('aria-controls', oSettings.sTableId)
				.bind( 'keypress.DT', function(e) {
					/* Prevent form submission */
					if ( e.keyCode == 13 )
					{
						return false;
					}
				}
			);
			
			return nFilter;
		}
		
		
		/**
		 * Filter the table using both the global filter and column based filtering
		 *  @param {object} oSettings dataTables settings object
		 *  @param {object} oSearch search information
		 *  @param {int} [iForce] force a research of the master array (1) or not (undefined or 0)
		 *  @memberof DataTable#oApi
		 */
		function _fnFilterComplete ( oSettings, oInput, iForce )
		{
			var oPrevSearch = oSettings.oPreviousSearch;
			var aoPrevSearch = oSettings.aoPreSearchCols;
			var fnSaveFilter = function ( oFilter ) {
				/* Save the filtering values */
				oPrevSearch.sSearch = oFilter.sSearch;
				oPrevSearch.bRegex = oFilter.bRegex;
				oPrevSearch.bSmart = oFilter.bSmart;
				oPrevSearch.bCaseInsensitive = oFilter.bCaseInsensitive;
			};
		
			/* In server-side processing all filtering is done by the server, so no point hanging around here */
			if ( !oSettings.oFeatures.bServerSide )
			{
				/* Global filter */
				_fnFilter( oSettings, oInput.sSearch, iForce, oInput.bRegex, oInput.bSmart, oInput.bCaseInsensitive );
				fnSaveFilter( oInput );
		
				/* Now do the individual column filter */
				for ( var i=0 ; i<oSettings.aoPreSearchCols.length ; i++ )
				{
					_fnFilterColumn( oSettings, aoPrevSearch[i].sSearch, i, aoPrevSearch[i].bRegex, 
						aoPrevSearch[i].bSmart, aoPrevSearch[i].bCaseInsensitive );
				}
				
				/* Custom filtering */
				_fnFilterCustom( oSettings );
			}
			else
			{
				fnSaveFilter( oInput );
			}
			
			/* Tell the draw function we have been filtering */
			oSettings.bFiltered = true;
			$(oSettings.oInstance).trigger('filter', oSettings);
			
			/* Redraw the table */
			oSettings._iDisplayStart = 0;
			_fnCalculateEnd( oSettings );
			_fnDraw( oSettings );
			
			/* Rebuild search array 'offline' */
			_fnBuildSearchArray( oSettings, 0 );
		}
		
		
		/**
		 * Apply custom filtering functions
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnFilterCustom( oSettings )
		{
			var afnFilters = DataTable.ext.afnFiltering;
			var aiFilterColumns = _fnGetColumns( oSettings, 'bSearchable' );
		
			for ( var i=0, iLen=afnFilters.length ; i<iLen ; i++ )
			{
				var iCorrector = 0;
				for ( var j=0, jLen=oSettings.aiDisplay.length ; j<jLen ; j++ )
				{
					var iDisIndex = oSettings.aiDisplay[j-iCorrector];
					var bTest = afnFilters[i](
						oSettings,
						_fnGetRowData( oSettings, iDisIndex, 'filter', aiFilterColumns ),
						iDisIndex
					);
					
					/* Check if we should use this row based on the filtering function */
					if ( !bTest )
					{
						oSettings.aiDisplay.splice( j-iCorrector, 1 );
						iCorrector++;
					}
				}
			}
		}
		
		
		/**
		 * Filter the table on a per-column basis
		 *  @param {object} oSettings dataTables settings object
		 *  @param {string} sInput string to filter on
		 *  @param {int} iColumn column to filter
		 *  @param {bool} bRegex treat search string as a regular expression or not
		 *  @param {bool} bSmart use smart filtering or not
		 *  @param {bool} bCaseInsensitive Do case insenstive matching or not
		 *  @memberof DataTable#oApi
		 */
		function _fnFilterColumn ( oSettings, sInput, iColumn, bRegex, bSmart, bCaseInsensitive )
		{
			if ( sInput === "" )
			{
				return;
			}
			
			var iIndexCorrector = 0;
			var rpSearch = _fnFilterCreateSearch( sInput, bRegex, bSmart, bCaseInsensitive );
			
			for ( var i=oSettings.aiDisplay.length-1 ; i>=0 ; i-- )
			{
				var sData = _fnDataToSearch( _fnGetCellData( oSettings, oSettings.aiDisplay[i], iColumn, 'filter' ),
					oSettings.aoColumns[iColumn].sType );
				if ( ! rpSearch.test( sData ) )
				{
					oSettings.aiDisplay.splice( i, 1 );
					iIndexCorrector++;
				}
			}
		}
		
		
		/**
		 * Filter the data table based on user input and draw the table
		 *  @param {object} oSettings dataTables settings object
		 *  @param {string} sInput string to filter on
		 *  @param {int} iForce optional - force a research of the master array (1) or not (undefined or 0)
		 *  @param {bool} bRegex treat as a regular expression or not
		 *  @param {bool} bSmart perform smart filtering or not
		 *  @param {bool} bCaseInsensitive Do case insenstive matching or not
		 *  @memberof DataTable#oApi
		 */
		function _fnFilter( oSettings, sInput, iForce, bRegex, bSmart, bCaseInsensitive )
		{
			var i;
			var rpSearch = _fnFilterCreateSearch( sInput, bRegex, bSmart, bCaseInsensitive );
			var oPrevSearch = oSettings.oPreviousSearch;
			
			/* Check if we are forcing or not - optional parameter */
			if ( !iForce )
			{
				iForce = 0;
			}
			
			/* Need to take account of custom filtering functions - always filter */
			if ( DataTable.ext.afnFiltering.length !== 0 )
			{
				iForce = 1;
			}
			
			/*
			 * If the input is blank - we want the full data set
			 */
			if ( sInput.length <= 0 )
			{
				oSettings.aiDisplay.splice( 0, oSettings.aiDisplay.length);
				oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
			}
			else
			{
				/*
				 * We are starting a new search or the new search string is smaller 
				 * then the old one (i.e. delete). Search from the master array
			 	 */
				if ( oSettings.aiDisplay.length == oSettings.aiDisplayMaster.length ||
					   oPrevSearch.sSearch.length > sInput.length || iForce == 1 ||
					   sInput.indexOf(oPrevSearch.sSearch) !== 0 )
				{
					/* Nuke the old display array - we are going to rebuild it */
					oSettings.aiDisplay.splice( 0, oSettings.aiDisplay.length);
					
					/* Force a rebuild of the search array */
					_fnBuildSearchArray( oSettings, 1 );
					
					/* Search through all records to populate the search array
					 * The the oSettings.aiDisplayMaster and asDataSearch arrays have 1 to 1 
					 * mapping
					 */
					for ( i=0 ; i<oSettings.aiDisplayMaster.length ; i++ )
					{
						if ( rpSearch.test(oSettings.asDataSearch[i]) )
						{
							oSettings.aiDisplay.push( oSettings.aiDisplayMaster[i] );
						}
					}
			  }
			  else
				{
			  	/* Using old search array - refine it - do it this way for speed
			  	 * Don't have to search the whole master array again
					 */
			  	var iIndexCorrector = 0;
			  	
			  	/* Search the current results */
			  	for ( i=0 ; i<oSettings.asDataSearch.length ; i++ )
					{
			  		if ( ! rpSearch.test(oSettings.asDataSearch[i]) )
						{
			  			oSettings.aiDisplay.splice( i-iIndexCorrector, 1 );
			  			iIndexCorrector++;
			  		}
			  	}
			  }
			}
		}
		
		
		/**
		 * Create an array which can be quickly search through
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iMaster use the master data array - optional
		 *  @memberof DataTable#oApi
		 */
		function _fnBuildSearchArray ( oSettings, iMaster )
		{
			if ( !oSettings.oFeatures.bServerSide )
			{
				/* Clear out the old data */
				oSettings.asDataSearch = [];
		
				var aiFilterColumns = _fnGetColumns( oSettings, 'bSearchable' );
				var aiIndex = (iMaster===1) ?
				 	oSettings.aiDisplayMaster :
				 	oSettings.aiDisplay;
				
				for ( var i=0, iLen=aiIndex.length ; i<iLen ; i++ )
				{
					oSettings.asDataSearch[i] = _fnBuildSearchRow(
						oSettings,
						_fnGetRowData( oSettings, aiIndex[i], 'filter', aiFilterColumns )
					);
				}
			}
		}
		
		
		/**
		 * Create a searchable string from a single data row
		 *  @param {object} oSettings dataTables settings object
		 *  @param {array} aData Row data array to use for the data to search
		 *  @memberof DataTable#oApi
		 */
		function _fnBuildSearchRow( oSettings, aData )
		{
			var sSearch = aData.join('  ');
			
			/* If it looks like there is an HTML entity in the string, attempt to decode it */
			if ( sSearch.indexOf('&') !== -1 )
			{
				sSearch = $('<div>').html(sSearch).text();
			}
			
			// Strip newline characters
			return sSearch.replace( /[\n\r]/g, " " );
		}
		
		/**
		 * Build a regular expression object suitable for searching a table
		 *  @param {string} sSearch string to search for
		 *  @param {bool} bRegex treat as a regular expression or not
		 *  @param {bool} bSmart perform smart filtering or not
		 *  @param {bool} bCaseInsensitive Do case insensitive matching or not
		 *  @returns {RegExp} constructed object
		 *  @memberof DataTable#oApi
		 */
		function _fnFilterCreateSearch( sSearch, bRegex, bSmart, bCaseInsensitive )
		{
			var asSearch, sRegExpString;
			
			if ( bSmart )
			{
				/* Generate the regular expression to use. Something along the lines of:
				 * ^(?=.*?\bone\b)(?=.*?\btwo\b)(?=.*?\bthree\b).*$
				 */
				asSearch = bRegex ? sSearch.split( ' ' ) : _fnEscapeRegex( sSearch ).split( ' ' );
				sRegExpString = '^(?=.*?'+asSearch.join( ')(?=.*?' )+').*$';
				return new RegExp( sRegExpString, bCaseInsensitive ? "i" : "" );
			}
			else
			{
				sSearch = bRegex ? sSearch : _fnEscapeRegex( sSearch );
				return new RegExp( sSearch, bCaseInsensitive ? "i" : "" );
			}
		}
		
		
		/**
		 * Convert raw data into something that the user can search on
		 *  @param {string} sData data to be modified
		 *  @param {string} sType data type
		 *  @returns {string} search string
		 *  @memberof DataTable#oApi
		 */
		function _fnDataToSearch ( sData, sType )
		{
			if ( typeof DataTable.ext.ofnSearch[sType] === "function" )
			{
				return DataTable.ext.ofnSearch[sType]( sData );
			}
			else if ( sData === null )
			{
				return '';
			}
			else if ( sType == "html" )
			{
				return sData.replace(/[\r\n]/g," ").replace( /<.*?>/g, "" );
			}
			else if ( typeof sData === "string" )
			{
				return sData.replace(/[\r\n]/g," ");
			}
			return sData;
		}
		
		
		/**
		 * scape a string such that it can be used in a regular expression
		 *  @param {string} sVal string to escape
		 *  @returns {string} escaped string
		 *  @memberof DataTable#oApi
		 */
		function _fnEscapeRegex ( sVal )
		{
			var acEscape = [ '/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\', '$', '^', '-' ];
			var reReplace = new RegExp( '(\\' + acEscape.join('|\\') + ')', 'g' );
			return sVal.replace(reReplace, '\\$1');
		}
		
		
		/**
		 * Generate the node required for the info display
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {node} Information element
		 *  @memberof DataTable#oApi
		 */
		function _fnFeatureHtmlInfo ( oSettings )
		{
			var nInfo = document.createElement( 'div' );
			nInfo.className = oSettings.oClasses.sInfo;
			
			/* Actions that are to be taken once only for this feature */
			if ( !oSettings.aanFeatures.i )
			{
				/* Add draw callback */
				oSettings.aoDrawCallback.push( {
					"fn": _fnUpdateInfo,
					"sName": "information"
				} );
				
				/* Add id */
				nInfo.id = oSettings.sTableId+'_info';
			}
			oSettings.nTable.setAttribute( 'aria-describedby', oSettings.sTableId+'_info' );
			
			return nInfo;
		}
		
		
		/**
		 * Update the information elements in the display
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnUpdateInfo ( oSettings )
		{
			/* Show information about the table */
			if ( !oSettings.oFeatures.bInfo || oSettings.aanFeatures.i.length === 0 )
			{
				return;
			}
			
			var
				oLang = oSettings.oLanguage,
				iStart = oSettings._iDisplayStart+1,
				iEnd = oSettings.fnDisplayEnd(),
				iMax = oSettings.fnRecordsTotal(),
				iTotal = oSettings.fnRecordsDisplay(),
				sOut;
			
			if ( iTotal === 0 )
			{
				/* Empty record set */
				sOut = oLang.sInfoEmpty;
			}
			else {
				/* Normal record set */
				sOut = oLang.sInfo;
			}
		
			if ( iTotal != iMax )
			{
				/* Record set after filtering */
				sOut += ' ' + oLang.sInfoFiltered;
			}
		
			// Convert the macros
			sOut += oLang.sInfoPostFix;
			sOut = _fnInfoMacros( oSettings, sOut );
			
			if ( oLang.fnInfoCallback !== null )
			{
				sOut = oLang.fnInfoCallback.call( oSettings.oInstance, 
					oSettings, iStart, iEnd, iMax, iTotal, sOut );
			}
			
			var n = oSettings.aanFeatures.i;
			for ( var i=0, iLen=n.length ; i<iLen ; i++ )
			{
				$(n[i]).html( sOut );
			}
		}
		
		
		function _fnInfoMacros ( oSettings, str )
		{
			var
				iStart = oSettings._iDisplayStart+1,
				sStart = oSettings.fnFormatNumber( iStart ),
				iEnd = oSettings.fnDisplayEnd(),
				sEnd = oSettings.fnFormatNumber( iEnd ),
				iTotal = oSettings.fnRecordsDisplay(),
				sTotal = oSettings.fnFormatNumber( iTotal ),
				iMax = oSettings.fnRecordsTotal(),
				sMax = oSettings.fnFormatNumber( iMax );
		
			// When infinite scrolling, we are always starting at 1. _iDisplayStart is used only
			// internally
			if ( oSettings.oScroll.bInfinite )
			{
				sStart = oSettings.fnFormatNumber( 1 );
			}
		
			return str.
				replace(/_START_/g, sStart).
				replace(/_END_/g,   sEnd).
				replace(/_TOTAL_/g, sTotal).
				replace(/_MAX_/g,   sMax);
		}
		
		
		
		/**
		 * Draw the table for the first time, adding all required features
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnInitialise ( oSettings )
		{
			var i, iLen, iAjaxStart=oSettings.iInitDisplayStart;
			
			/* Ensure that the table data is fully initialised */
			if ( oSettings.bInitialised === false )
			{
				setTimeout( function(){ _fnInitialise( oSettings ); }, 200 );
				return;
			}
			
			/* Show the display HTML options */
			_fnAddOptionsHtml( oSettings );
			
			/* Build and draw the header / footer for the table */
			_fnBuildHead( oSettings );
			_fnDrawHead( oSettings, oSettings.aoHeader );
			if ( oSettings.nTFoot )
			{
				_fnDrawHead( oSettings, oSettings.aoFooter );
			}
		
			/* Okay to show that something is going on now */
			_fnProcessingDisplay( oSettings, true );
			
			/* Calculate sizes for columns */
			if ( oSettings.oFeatures.bAutoWidth )
			{
				_fnCalculateColumnWidths( oSettings );
			}
			
			for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				if ( oSettings.aoColumns[i].sWidth !== null )
				{
					oSettings.aoColumns[i].nTh.style.width = _fnStringToCss( oSettings.aoColumns[i].sWidth );
				}
			}
			
			/* If there is default sorting required - let's do it. The sort function will do the
			 * drawing for us. Otherwise we draw the table regardless of the Ajax source - this allows
			 * the table to look initialised for Ajax sourcing data (show 'loading' message possibly)
			 */
			if ( oSettings.oFeatures.bSort )
			{
				_fnSort( oSettings );
			}
			else if ( oSettings.oFeatures.bFilter )
			{
				_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
			}
			else
			{
				oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
				_fnCalculateEnd( oSettings );
				_fnDraw( oSettings );
			}
			
			/* if there is an ajax source load the data */
			if ( oSettings.sAjaxSource !== null && !oSettings.oFeatures.bServerSide )
			{
				var aoData = [];
				_fnServerParams( oSettings, aoData );
				oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aoData, function(json) {
					var aData = (oSettings.sAjaxDataProp !== "") ?
					 	_fnGetObjectDataFn( oSettings.sAjaxDataProp )(json) : json;
		
					/* Got the data - add it to the table */
					for ( i=0 ; i<aData.length ; i++ )
					{
						_fnAddData( oSettings, aData[i] );
					}
					
					/* Reset the init display for cookie saving. We've already done a filter, and
					 * therefore cleared it before. So we need to make it appear 'fresh'
					 */
					oSettings.iInitDisplayStart = iAjaxStart;
					
					if ( oSettings.oFeatures.bSort )
					{
						_fnSort( oSettings );
					}
					else
					{
						oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
						_fnCalculateEnd( oSettings );
						_fnDraw( oSettings );
					}
					
					_fnProcessingDisplay( oSettings, false );
					_fnInitComplete( oSettings, json );
				}, oSettings );
				return;
			}
			
			/* Server-side processing initialisation complete is done at the end of _fnDraw */
			if ( !oSettings.oFeatures.bServerSide )
			{
				_fnProcessingDisplay( oSettings, false );
				_fnInitComplete( oSettings );
			}
		}
		
		
		/**
		 * Draw the table for the first time, adding all required features
		 *  @param {object} oSettings dataTables settings object
		 *  @param {object} [json] JSON from the server that completed the table, if using Ajax source
		 *    with client-side processing (optional)
		 *  @memberof DataTable#oApi
		 */
		function _fnInitComplete ( oSettings, json )
		{
			oSettings._bInitComplete = true;
			_fnCallbackFire( oSettings, 'aoInitComplete', 'init', [oSettings, json] );
		}
		
		
		/**
		 * Language compatibility - when certain options are given, and others aren't, we
		 * need to duplicate the values over, in order to provide backwards compatibility
		 * with older language files.
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnLanguageCompat( oLanguage )
		{
			var oDefaults = DataTable.defaults.oLanguage;
		
			/* Backwards compatibility - if there is no sEmptyTable given, then use the same as
			 * sZeroRecords - assuming that is given.
			 */
			if ( !oLanguage.sEmptyTable && oLanguage.sZeroRecords &&
				oDefaults.sEmptyTable === "No data available in table" )
			{
				_fnMap( oLanguage, oLanguage, 'sZeroRecords', 'sEmptyTable' );
			}
		
			/* Likewise with loading records */
			if ( !oLanguage.sLoadingRecords && oLanguage.sZeroRecords &&
				oDefaults.sLoadingRecords === "Loading..." )
			{
				_fnMap( oLanguage, oLanguage, 'sZeroRecords', 'sLoadingRecords' );
			}
		}
		
		
		
		/**
		 * Generate the node required for user display length changing
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {node} Display length feature node
		 *  @memberof DataTable#oApi
		 */
		function _fnFeatureHtmlLength ( oSettings )
		{
			if ( oSettings.oScroll.bInfinite )
			{
				return null;
			}
			
			/* This can be overruled by not using the _MENU_ var/macro in the language variable */
			var sName = 'name="'+oSettings.sTableId+'_length"';
			var sStdMenu = '<select size="1" '+sName+'>';
			var i, iLen;
			var aLengthMenu = oSettings.aLengthMenu;
			
			if ( aLengthMenu.length == 2 && typeof aLengthMenu[0] === 'object' && 
					typeof aLengthMenu[1] === 'object' )
			{
				for ( i=0, iLen=aLengthMenu[0].length ; i<iLen ; i++ )
				{
					sStdMenu += '<option value="'+aLengthMenu[0][i]+'">'+aLengthMenu[1][i]+'</option>';
				}
			}
			else
			{
				for ( i=0, iLen=aLengthMenu.length ; i<iLen ; i++ )
				{
					sStdMenu += '<option value="'+aLengthMenu[i]+'">'+aLengthMenu[i]+'</option>';
				}
			}
			sStdMenu += '</select>';
			
			var nLength = document.createElement( 'div' );
			if ( !oSettings.aanFeatures.l )
			{
				nLength.id = oSettings.sTableId+'_length';
			}
			nLength.className = oSettings.oClasses.sLength;
			nLength.innerHTML = '<label>'+oSettings.oLanguage.sLengthMenu.replace( '_MENU_', sStdMenu )+'</label>';
			
			/*
			 * Set the length to the current display length - thanks to Andrea Pavlovic for this fix,
			 * and Stefan Skopnik for fixing the fix!
			 */
			$('select option[value="'+oSettings._iDisplayLength+'"]', nLength).attr("selected", true);
			
			$('select', nLength).bind( 'change.DT', function(e) {
				var iVal = $(this).val();
				
				/* Update all other length options for the new display */
				var n = oSettings.aanFeatures.l;
				for ( i=0, iLen=n.length ; i<iLen ; i++ )
				{
					if ( n[i] != this.parentNode )
					{
						$('select', n[i]).val( iVal );
					}
				}
				
				/* Redraw the table */
				oSettings._iDisplayLength = parseInt(iVal, 10);
				_fnCalculateEnd( oSettings );
				
				/* If we have space to show extra rows (backing up from the end point - then do so */
				if ( oSettings.fnDisplayEnd() == oSettings.fnRecordsDisplay() )
				{
					oSettings._iDisplayStart = oSettings.fnDisplayEnd() - oSettings._iDisplayLength;
					if ( oSettings._iDisplayStart < 0 )
					{
						oSettings._iDisplayStart = 0;
					}
				}
				
				if ( oSettings._iDisplayLength == -1 )
				{
					oSettings._iDisplayStart = 0;
				}
				
				_fnDraw( oSettings );
			} );
		
		
			$('select', nLength).attr('aria-controls', oSettings.sTableId);
			
			return nLength;
		}
		
		
		/**
		 * Recalculate the end point based on the start point
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnCalculateEnd( oSettings )
		{
			if ( oSettings.oFeatures.bPaginate === false )
			{
				oSettings._iDisplayEnd = oSettings.aiDisplay.length;
			}
			else
			{
				/* Set the end point of the display - based on how many elements there are
				 * still to display
				 */
				if ( oSettings._iDisplayStart + oSettings._iDisplayLength > oSettings.aiDisplay.length ||
					   oSettings._iDisplayLength == -1 )
				{
					oSettings._iDisplayEnd = oSettings.aiDisplay.length;
				}
				else
				{
					oSettings._iDisplayEnd = oSettings._iDisplayStart + oSettings._iDisplayLength;
				}
			}
		}
		
		
		
		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * Note that most of the paging logic is done in 
		 * DataTable.ext.oPagination
		 */
		
		/**
		 * Generate the node required for default pagination
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {node} Pagination feature node
		 *  @memberof DataTable#oApi
		 */
		function _fnFeatureHtmlPaginate ( oSettings )
		{
			if ( oSettings.oScroll.bInfinite )
			{
				return null;
			}
			
			var nPaginate = document.createElement( 'div' );
			nPaginate.className = oSettings.oClasses.sPaging+oSettings.sPaginationType;
			
			DataTable.ext.oPagination[ oSettings.sPaginationType ].fnInit( oSettings, nPaginate, 
				function( oSettings ) {
					_fnCalculateEnd( oSettings );
					_fnDraw( oSettings );
				}
			);
			
			/* Add a draw callback for the pagination on first instance, to update the paging display */
			if ( !oSettings.aanFeatures.p )
			{
				oSettings.aoDrawCallback.push( {
					"fn": function( oSettings ) {
						DataTable.ext.oPagination[ oSettings.sPaginationType ].fnUpdate( oSettings, function( oSettings ) {
							_fnCalculateEnd( oSettings );
							_fnDraw( oSettings );
						} );
					},
					"sName": "pagination"
				} );
			}
			return nPaginate;
		}
		
		
		/**
		 * Alter the display settings to change the page
		 *  @param {object} oSettings dataTables settings object
		 *  @param {string|int} mAction Paging action to take: "first", "previous", "next" or "last"
		 *    or page number to jump to (integer)
		 *  @returns {bool} true page has changed, false - no change (no effect) eg 'first' on page 1
		 *  @memberof DataTable#oApi
		 */
		function _fnPageChange ( oSettings, mAction )
		{
			var iOldStart = oSettings._iDisplayStart;
			
			if ( typeof mAction === "number" )
			{
				oSettings._iDisplayStart = mAction * oSettings._iDisplayLength;
				if ( oSettings._iDisplayStart > oSettings.fnRecordsDisplay() )
				{
					oSettings._iDisplayStart = 0;
				}
			}
			else if ( mAction == "first" )
			{
				oSettings._iDisplayStart = 0;
			}
			else if ( mAction == "previous" )
			{
				oSettings._iDisplayStart = oSettings._iDisplayLength>=0 ?
					oSettings._iDisplayStart - oSettings._iDisplayLength :
					0;
				
				/* Correct for under-run */
				if ( oSettings._iDisplayStart < 0 )
				{
				  oSettings._iDisplayStart = 0;
				}
			}
			else if ( mAction == "next" )
			{
				if ( oSettings._iDisplayLength >= 0 )
				{
					/* Make sure we are not over running the display array */
					if ( oSettings._iDisplayStart + oSettings._iDisplayLength < oSettings.fnRecordsDisplay() )
					{
						oSettings._iDisplayStart += oSettings._iDisplayLength;
					}
				}
				else
				{
					oSettings._iDisplayStart = 0;
				}
			}
			else if ( mAction == "last" )
			{
				if ( oSettings._iDisplayLength >= 0 )
				{
					var iPages = parseInt( (oSettings.fnRecordsDisplay()-1) / oSettings._iDisplayLength, 10 ) + 1;
					oSettings._iDisplayStart = (iPages-1) * oSettings._iDisplayLength;
				}
				else
				{
					oSettings._iDisplayStart = 0;
				}
			}
			else
			{
				_fnLog( oSettings, 0, "Unknown paging action: "+mAction );
			}
			$(oSettings.oInstance).trigger('page', oSettings);
			
			return iOldStart != oSettings._iDisplayStart;
		}
		
		
		
		/**
		 * Generate the node required for the processing node
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {node} Processing element
		 *  @memberof DataTable#oApi
		 */
		function _fnFeatureHtmlProcessing ( oSettings )
		{
			var nProcessing = document.createElement( 'div' );
			
			if ( !oSettings.aanFeatures.r )
			{
				nProcessing.id = oSettings.sTableId+'_processing';
			}
			nProcessing.innerHTML = oSettings.oLanguage.sProcessing;
			nProcessing.className = oSettings.oClasses.sProcessing;
			oSettings.nTable.parentNode.insertBefore( nProcessing, oSettings.nTable );
			
			return nProcessing;
		}
		
		
		/**
		 * Display or hide the processing indicator
		 *  @param {object} oSettings dataTables settings object
		 *  @param {bool} bShow Show the processing indicator (true) or not (false)
		 *  @memberof DataTable#oApi
		 */
		function _fnProcessingDisplay ( oSettings, bShow )
		{
			if ( oSettings.oFeatures.bProcessing )
			{
				var an = oSettings.aanFeatures.r;
				for ( var i=0, iLen=an.length ; i<iLen ; i++ )
				{
					an[i].style.visibility = bShow ? "visible" : "hidden";
				}
			}
		
			$(oSettings.oInstance).trigger('processing', [oSettings, bShow]);
		}
		
		/**
		 * Add any control elements for the table - specifically scrolling
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {node} Node to add to the DOM
		 *  @memberof DataTable#oApi
		 */
		function _fnFeatureHtmlTable ( oSettings )
		{
			/* Check if scrolling is enabled or not - if not then leave the DOM unaltered */
			if ( oSettings.oScroll.sX === "" && oSettings.oScroll.sY === "" )
			{
				return oSettings.nTable;
			}
			
			/*
			 * The HTML structure that we want to generate in this function is:
			 *  div - nScroller
			 *    div - nScrollHead
			 *      div - nScrollHeadInner
			 *        table - nScrollHeadTable
			 *          thead - nThead
			 *    div - nScrollBody
			 *      table - oSettings.nTable
			 *        thead - nTheadSize
			 *        tbody - nTbody
			 *    div - nScrollFoot
			 *      div - nScrollFootInner
			 *        table - nScrollFootTable
			 *          tfoot - nTfoot
			 */
			var
			 	nScroller = document.createElement('div'),
			 	nScrollHead = document.createElement('div'),
			 	nScrollHeadInner = document.createElement('div'),
			 	nScrollBody = document.createElement('div'),
			 	nScrollFoot = document.createElement('div'),
			 	nScrollFootInner = document.createElement('div'),
			 	nScrollHeadTable = oSettings.nTable.cloneNode(false),
			 	nScrollFootTable = oSettings.nTable.cloneNode(false),
				nThead = oSettings.nTable.getElementsByTagName('thead')[0],
			 	nTfoot = oSettings.nTable.getElementsByTagName('tfoot').length === 0 ? null : 
					oSettings.nTable.getElementsByTagName('tfoot')[0],
				oClasses = oSettings.oClasses;
			
			nScrollHead.appendChild( nScrollHeadInner );
			nScrollFoot.appendChild( nScrollFootInner );
			nScrollBody.appendChild( oSettings.nTable );
			nScroller.appendChild( nScrollHead );
			nScroller.appendChild( nScrollBody );
			nScrollHeadInner.appendChild( nScrollHeadTable );
			nScrollHeadTable.appendChild( nThead );
			if ( nTfoot !== null )
			{
				nScroller.appendChild( nScrollFoot );
				nScrollFootInner.appendChild( nScrollFootTable );
				nScrollFootTable.appendChild( nTfoot );
			}
			
			nScroller.className = oClasses.sScrollWrapper;
			nScrollHead.className = oClasses.sScrollHead;
			nScrollHeadInner.className = oClasses.sScrollHeadInner;
			nScrollBody.className = oClasses.sScrollBody;
			nScrollFoot.className = oClasses.sScrollFoot;
			nScrollFootInner.className = oClasses.sScrollFootInner;
			
			if ( oSettings.oScroll.bAutoCss )
			{
				nScrollHead.style.overflow = "hidden";
				nScrollHead.style.position = "relative";
				nScrollFoot.style.overflow = "hidden";
				nScrollBody.style.overflow = "auto";
			}
			
			nScrollHead.style.border = "0";
			nScrollHead.style.width = "100%";
			nScrollFoot.style.border = "0";
			nScrollHeadInner.style.width = oSettings.oScroll.sXInner !== "" ?
				oSettings.oScroll.sXInner : "100%"; /* will be overwritten */
			
			/* Modify attributes to respect the clones */
			nScrollHeadTable.removeAttribute('id');
			nScrollHeadTable.style.marginLeft = "0";
			oSettings.nTable.style.marginLeft = "0";
			if ( nTfoot !== null )
			{
				nScrollFootTable.removeAttribute('id');
				nScrollFootTable.style.marginLeft = "0";
			}
			
			/* Move caption elements from the body to the header, footer or leave where it is
			 * depending on the configuration. Note that the DTD says there can be only one caption */
			var nCaption = $(oSettings.nTable).children('caption');
			if ( nCaption.length > 0 )
			{
				nCaption = nCaption[0];
				if ( nCaption._captionSide === "top" )
				{
					nScrollHeadTable.appendChild( nCaption );
				}
				else if ( nCaption._captionSide === "bottom" && nTfoot )
				{
					nScrollFootTable.appendChild( nCaption );
				}
			}
			
			/*
			 * Sizing
			 */
			/* When x-scrolling add the width and a scroller to move the header with the body */
			if ( oSettings.oScroll.sX !== "" )
			{
				nScrollHead.style.width = _fnStringToCss( oSettings.oScroll.sX );
				nScrollBody.style.width = _fnStringToCss( oSettings.oScroll.sX );
				
				if ( nTfoot !== null )
				{
					nScrollFoot.style.width = _fnStringToCss( oSettings.oScroll.sX );	
				}
				
				/* When the body is scrolled, then we also want to scroll the headers */
				$(nScrollBody).scroll( function (e) {
					nScrollHead.scrollLeft = this.scrollLeft;
					
					if ( nTfoot !== null )
					{
						nScrollFoot.scrollLeft = this.scrollLeft;
					}
				} );
			}
			
			/* When yscrolling, add the height */
			if ( oSettings.oScroll.sY !== "" )
			{
				nScrollBody.style.height = _fnStringToCss( oSettings.oScroll.sY );
			}
			
			/* Redraw - align columns across the tables */
			oSettings.aoDrawCallback.push( {
				"fn": _fnScrollDraw,
				"sName": "scrolling"
			} );
			
			/* Infinite scrolling event handlers */
			if ( oSettings.oScroll.bInfinite )
			{
				$(nScrollBody).scroll( function() {
					/* Use a blocker to stop scrolling from loading more data while other data is still loading */
					if ( !oSettings.bDrawing && $(this).scrollTop() !== 0 )
					{
						/* Check if we should load the next data set */
						if ( $(this).scrollTop() + $(this).height() > 
							$(oSettings.nTable).height() - oSettings.oScroll.iLoadGap )
						{
							/* Only do the redraw if we have to - we might be at the end of the data */
							if ( oSettings.fnDisplayEnd() < oSettings.fnRecordsDisplay() )
							{
								_fnPageChange( oSettings, 'next' );
								_fnCalculateEnd( oSettings );
								_fnDraw( oSettings );
							}
						}
					}
				} );
			}
			
			oSettings.nScrollHead = nScrollHead;
			oSettings.nScrollFoot = nScrollFoot;
			
			return nScroller;
		}
		
		
		/**
		 * Update the various tables for resizing. It's a bit of a pig this function, but
		 * basically the idea to:
		 *   1. Re-create the table inside the scrolling div
		 *   2. Take live measurements from the DOM
		 *   3. Apply the measurements
		 *   4. Clean up
		 *  @param {object} o dataTables settings object
		 *  @returns {node} Node to add to the DOM
		 *  @memberof DataTable#oApi
		 */
		function _fnScrollDraw ( o )
		{
			var
				nScrollHeadInner = o.nScrollHead.getElementsByTagName('div')[0],
				nScrollHeadTable = nScrollHeadInner.getElementsByTagName('table')[0],
				nScrollBody = o.nTable.parentNode,
				i, iLen, j, jLen, anHeadToSize, anHeadSizers, anFootSizers, anFootToSize, oStyle, iVis,
				nTheadSize, nTfootSize,
				iWidth, aApplied=[], aAppliedFooter=[], iSanityWidth,
				nScrollFootInner = (o.nTFoot !== null) ? o.nScrollFoot.getElementsByTagName('div')[0] : null,
				nScrollFootTable = (o.nTFoot !== null) ? nScrollFootInner.getElementsByTagName('table')[0] : null,
				ie67 = o.oBrowser.bScrollOversize,
				zeroOut = function(nSizer) {
					oStyle = nSizer.style;
					oStyle.paddingTop = "0";
					oStyle.paddingBottom = "0";
					oStyle.borderTopWidth = "0";
					oStyle.borderBottomWidth = "0";
					oStyle.height = 0;
				};
			
			/*
			 * 1. Re-create the table inside the scrolling div
			 */
			
			/* Remove the old minimised thead and tfoot elements in the inner table */
			$(o.nTable).children('thead, tfoot').remove();
		
			/* Clone the current header and footer elements and then place it into the inner table */
			nTheadSize = $(o.nTHead).clone()[0];
			o.nTable.insertBefore( nTheadSize, o.nTable.childNodes[0] );
			anHeadToSize = o.nTHead.getElementsByTagName('tr');
			anHeadSizers = nTheadSize.getElementsByTagName('tr');
			
			if ( o.nTFoot !== null )
			{
				nTfootSize = $(o.nTFoot).clone()[0];
				o.nTable.insertBefore( nTfootSize, o.nTable.childNodes[1] );
				anFootToSize = o.nTFoot.getElementsByTagName('tr');
				anFootSizers = nTfootSize.getElementsByTagName('tr');
			}
			
			/*
			 * 2. Take live measurements from the DOM - do not alter the DOM itself!
			 */
			
			/* Remove old sizing and apply the calculated column widths
			 * Get the unique column headers in the newly created (cloned) header. We want to apply the
			 * calculated sizes to this header
			 */
			if ( o.oScroll.sX === "" )
			{
				nScrollBody.style.width = '100%';
				nScrollHeadInner.parentNode.style.width = '100%';
			}
			
			var nThs = _fnGetUniqueThs( o, nTheadSize );
			for ( i=0, iLen=nThs.length ; i<iLen ; i++ )
			{
				iVis = _fnVisibleToColumnIndex( o, i );
				nThs[i].style.width = o.aoColumns[iVis].sWidth;
			}
			
			if ( o.nTFoot !== null )
			{
				_fnApplyToChildren( function(n) {
					n.style.width = "";
				}, anFootSizers );
			}
		
			// If scroll collapse is enabled, when we put the headers back into the body for sizing, we
			// will end up forcing the scrollbar to appear, making our measurements wrong for when we
			// then hide it (end of this function), so add the header height to the body scroller.
			if ( o.oScroll.bCollapse && o.oScroll.sY !== "" )
			{
				nScrollBody.style.height = (nScrollBody.offsetHeight + o.nTHead.offsetHeight)+"px";
			}
			
			/* Size the table as a whole */
			iSanityWidth = $(o.nTable).outerWidth();
			if ( o.oScroll.sX === "" )
			{
				/* No x scrolling */
				o.nTable.style.width = "100%";
				
				/* I know this is rubbish - but IE7 will make the width of the table when 100% include
				 * the scrollbar - which is shouldn't. When there is a scrollbar we need to take this
				 * into account.
				 */
				if ( ie67 && ($('tbody', nScrollBody).height() > nScrollBody.offsetHeight || 
					$(nScrollBody).css('overflow-y') == "scroll")  )
				{
					o.nTable.style.width = _fnStringToCss( $(o.nTable).outerWidth() - o.oScroll.iBarWidth);
				}
			}
			else
			{
				if ( o.oScroll.sXInner !== "" )
				{
					/* x scroll inner has been given - use it */
					o.nTable.style.width = _fnStringToCss(o.oScroll.sXInner);
				}
				else if ( iSanityWidth == $(nScrollBody).width() &&
				   $(nScrollBody).height() < $(o.nTable).height() )
				{
					/* There is y-scrolling - try to take account of the y scroll bar */
					o.nTable.style.width = _fnStringToCss( iSanityWidth-o.oScroll.iBarWidth );
					if ( $(o.nTable).outerWidth() > iSanityWidth-o.oScroll.iBarWidth )
					{
						/* Not possible to take account of it */
						o.nTable.style.width = _fnStringToCss( iSanityWidth );
					}
				}
				else
				{
					/* All else fails */
					o.nTable.style.width = _fnStringToCss( iSanityWidth );
				}
			}
			
			/* Recalculate the sanity width - now that we've applied the required width, before it was
			 * a temporary variable. This is required because the column width calculation is done
			 * before this table DOM is created.
			 */
			iSanityWidth = $(o.nTable).outerWidth();
			
			/* We want the hidden header to have zero height, so remove padding and borders. Then
			 * set the width based on the real headers
			 */
			
			// Apply all styles in one pass. Invalidates layout only once because we don't read any 
			// DOM properties.
			_fnApplyToChildren( zeroOut, anHeadSizers );
			 
			// Read all widths in next pass. Forces layout only once because we do not change 
			// any DOM properties.
			_fnApplyToChildren( function(nSizer) {
				aApplied.push( _fnStringToCss( $(nSizer).width() ) );
			}, anHeadSizers );
			 
			// Apply all widths in final pass. Invalidates layout only once because we do not
			// read any DOM properties.
			_fnApplyToChildren( function(nToSize, i) {
				nToSize.style.width = aApplied[i];
			}, anHeadToSize );
		
			$(anHeadSizers).height(0);
			
			/* Same again with the footer if we have one */
			if ( o.nTFoot !== null )
			{
				_fnApplyToChildren( zeroOut, anFootSizers );
				 
				_fnApplyToChildren( function(nSizer) {
					aAppliedFooter.push( _fnStringToCss( $(nSizer).width() ) );
				}, anFootSizers );
				 
				_fnApplyToChildren( function(nToSize, i) {
					nToSize.style.width = aAppliedFooter[i];
				}, anFootToSize );
		
				$(anFootSizers).height(0);
			}
			
			/*
			 * 3. Apply the measurements
			 */
			
			/* "Hide" the header and footer that we used for the sizing. We want to also fix their width
			 * to what they currently are
			 */
			_fnApplyToChildren( function(nSizer, i) {
				nSizer.innerHTML = "";
				nSizer.style.width = aApplied[i];
			}, anHeadSizers );
			
			if ( o.nTFoot !== null )
			{
				_fnApplyToChildren( function(nSizer, i) {
					nSizer.innerHTML = "";
					nSizer.style.width = aAppliedFooter[i];
				}, anFootSizers );
			}
			
			/* Sanity check that the table is of a sensible width. If not then we are going to get
			 * misalignment - tryginaprev HTMthis byles
 allow Pagihe tay   to shrink below its min   Dat searc/ seaif ( $(o.nT    ).outerW Dat() < iSanityia.co ) sea{ sea	/* The
 * @autho depends upon ifescrhave a vertical scrollbar viary   orles
   Alla	var iCorrection = ((nS012 ABody.2012 AHeight > source file offsete softw|| hts r	$ source file).css('overflow-y') == "2012 A")) ?icense	 * @contact +o.oource .iBadia.co :
 * @contact ;hts r.sprymedIE6/7riptia law untole  mselves...rights rn Jarie67 &&  source file is free softwaricensee, under either the GPL v2 l or a
 * BSD style license, available at:
 *      wwww.spry	ne (www..style./conta= _fnStringToCss(rved.
 *
 * -/license_gpl2
 *   h)es.net}s.net/licenseApplyle   calculated
 * imumk/contaource       jwrappersrights rsource file iTICULAR PURPOSE. See the license files for detaio.source Headser: true */
/*globals $, jQuery,define,_fnExternAibuted in ne (Foot !== null
 * or FITNESS FOource Optiser: true */
/*globals $, jQuery,define,_fnExternAls please refernd givele   user a warn@file at we've stoppedle        jgett Pagino smallstributed in /license_gsX =able"
 * or FITNESS_fnLog( o, 1, "ia.c     jcanes
 fit isource  curr HTMelet HTMwhich will cause column"+ttp://d"h and sort HT.dia.c     jhas been drawn ats.js
 * les.nposary     Data"or details pleelsepyrile,_fnScrollDrInnerons,_nAdjustColumnSizing,_fnFeatureHtmlFilter,_fnFilterComplete,_fnFilterCustom,_fnFilterColumn,_fnFilter,_fnBuildSearchArray,_fnBIncreasrametesource gClassevalune, aremove it/

/4
 *  automatic,_fnBuildSe://www.dionSort,_fnSortAtls plachL  www.spry true, browser: true */
/*globals $, jQuer'100%'nExternApiFunc,_fnInitialise,_fnInitComplete,_fnLanglingWidthAdjuslumn,_fnColumnOptions,_fnAddData,_fnCreateTr,_fnGatherData,_fnBuildHead,_fnDrawHead,_lingWidthAdjusfnCalculatfnReOrde/* search4. Clean upr      Allan Jar,_fnScrollDYaw,_fnAdjustCw.sprymedIE7< putsyright 2008-2012 Allanin place (w @deit shouldn't be) du jquerubtraconsH* or  *y,_fnV012 Allanh softwfromle    Jardinedisplay, ratherteDrn add Pagit on. We nearamoApplyToCse
 * @p,_fnGetin ordellDo sorrsion . DoeThswaersio doObjein any otCellbrowsers.ApplyToributed in the h * or FITNESS true, browser: tr,_fnGetPOSE. See the lice FOR A PAher the GPL t/license_gpl2
 *   hDeleteIndex,_fnReOrdeClearTable,_fnSaves,_fnFe&&rTable,_fnSbCollapse    www.spryfnInfoMacros,_fnBrowserDetect,_fnGetColumns*/ble,_fnSaves,_fnDetectTeservExtraThis,_fnScrollDrafactory ) {


(/** @lends *   hare, under either thia.co  http:/ 	/license_gpl2
 *   htt0es.net_fnColumn(/** @lends <glob <re, under either the GPL vColumnIndex,_fnInfoMacros,_fnBrowserDetect,_fnGetColumns*/

(/** @lends <globaamd )
	DeleteIndex,_fnReOrde/* FinallyDataFn,_f  Dat'*
 * n,_fnAaDefsand footellD    e, undefeservOymedia.co =rdine (www.sprymedia.co.ues.neFunc,_fnIniR A PARTICULAR PURPOSE. See the licenbrary. It itool, based upon Classoundations of progressive 
	 * enhancement, whicse st/ Figure outpyritCelcriptiren,_fnMappres HTML if surce descrn,_fnais a plug-in for the jQuetObj// provid
 * bit mopleaptHeaexToVisib"icense, "ease re Pag(i.e. pasaFn,_fren,_fnMa   wweserbource  Pags a 
	 * highl,_fnGe()ne using browseclienTY; without even the implied warranty of MERCHANTABILITwhich will add advanced intep_fnGetRserDeteo <i>jQuery?fine === 'fpl2
 *   +"px" : "0px  @clafined ) {

mnOptions,_fnAddData,ine as an AMDOptithe foundations of progressive 
	 * enhancement, whichts}
	 *  @redvanced interaction controls to any 
	 * HTML table.  initialisation
	 *    $( [oInit={}] Configuration object for DataTables. Options
	 *    als pse striAdjuable buposi
 * Ts is a plug-inin cplaywe loolay,_fny-ren,_fnMapnRende or a
 * BSD stren,_f tool, se striIref=ronsHtor filteee thRow,ocnFiltd, jumple but is
	Tablback/

/*jsliopLog,_fnClearTabSordata||se 
F.dataed// Define as an AMD modul012 ATop =nstantils pguratio
 strx,_f fer to: aaxParn fun*
 * Tlete,_flData,_ child node*
 * @nCustom,_farray (typ2008ly
		 * TD tablerese, dTR nJso
		 *  @param {o the li} fn MethofnSe a to: hete,_fobjectsettings object		 *  {with } an1 Liste, dustom,_sth elook through for for the tablerenthis column
		 *  @memberof Da2 AnFire,_lable(iden 2008-2truct lish elemefirst) - opsblealettings memberof Data the #oApi
		 * Allo the lis_fnr to:ToCtings, ( fn, Dats, {2Queryw.spreservndex=0, ittingLen=an1.lengbles.neesernNode1,sSorti2le. For whilein tk)
 Len// Define as ortin = Dat[i].ettinmn, o$('#exaassJU: nTh2 ?nt('? nTh : docume :_fnAdes.nettings.oC	"nTh": * or FITNESSstene	"nTh".withTypeaw,_fDefaults FITNESSe    :		"sSort,
				"aData	fn : nTh ?gClassJU,": oSeunction(_fnAjaxUateEnd,_fnts.aDataSort ? oDefaultsrt : [iCol],
				"mData: oSe++Col],
			"mDat	"nTh": n nTh ? nextSib falCol],
	ateElement('th'ateEle;
			
			/*    oDefaults.ls pleiSetting )
	{
		
		/**
		 * Conght  a CSS unitnet
 */

/pixels (e.g. 2em   wings object
sSee t} s. It iet
 */

/bfnFi| oSeedl )
			{
				oSwith} nPalterCpodels.inate,	 * DattAddCol(requi   }dColreVisbv DataTasgs.aoColumns.length;returns {int} ioPreSearchCoDete[ iCo.length;
			var oCol = $.extend( {}, DataTable.model || oSeTo. It i(.aoPreS,e.models.SortingClstene!aoPreSe||.aoPreSew,_ffnAddPre.bRegex = t''    www.spry];
			( oInit )
	are define!x === undefidefaultsmodels.= docuy,_fnbodyundefined )
		eservatables.ne		"sSTmion(				
				DispteEstom,_( "divSort,_fnned ser: true */
/*globals $, jQueraoPreSeion {
	 * ue;
			.: trndmn, o(ined )tool,  Don't =ined er globals o = truion to nColumlise classes etc *Smarart ===(* Don't tool,{
		
		
		/**
		 * C//www.da	 * DataTae, dFilters oPre*jslint el )
			{
				oSnt for} oStionsHs dol = $.esDatal colunt fore user must specify bRegex, bSmart or bCaseInsensitiv//www.daCilteria.cosearTiCol coluSortingClass": the . It is  *  @membtory );
	}
	/* Defi== undefiiUserInteCoon( oInitable#ompns( oSettings, VJardinarchabtions )
		{
			archationfunction _aolumns[ Sortable,
				"si, iI oSe,rved.
 *
or,itive === undefionInirue,s a 'th',	function _fnnInitool, eser  DatAttr
		function _fnColumgetDataibute('ataTabatibility nWl: tru
		function _fnColumoSearcortion {
	 *     || oSettnyers,_fi oOp sizesomplethat t oOptionRende
			{ngs. ; i<		/* Use; i++    www.sprystenerpecified column op? nTbgs.aoCoefaults.sTitle gs.aoColumns[ Settings.sTitle    :			oCol._bAutoType = faaoPreSens,_fnAddData,_			"aDataSvar oColetect,ve */
				if (Map( oCol, oOptions, "sWidth", Orig,t 
 * W		Data )
		iCol],
		d in tiDataSortsWidthOrig" );
	.aDataSortp( oCol, oOptions, "sWidth", "POSE. See the liceniDataSortiCol],
				"mData);
					 iCol, oOptSettings.aoColu $ ) {
	"use striI is a nu		vags dataTableinettinDOM equals		
			/* CaceDraw,_t Copyes
 *ocesta ge searchCol = $.es, * @descrcerinlay,_fnher thctioas
		e 	oPre.d     * Daeb-fnJsonS. No customol.mRendoOptioaFn(beDataFolumnDefss setti/
		fhiniti, nornate": falsus$.ext    Allan Jar		/* User=== null )Sortably )  iCol, oOptio== 0				igs.aoColumns[ iC=ta( oData&&ternApunction _fnScrollDraw,_fnAd ) {			{
					return mveState,_fnLoadState)
				{
					ospecified column options *pe = oOptions.sTitle iDataSort t$(= null )[i])LAR PU tool, y if defined
				 */
				if ( oOp		"aDataaSort !== undefined )
				{
					oCol.aDataSort = [ oOptions.iDataons, "aDataSort"eEnd,_fnConver/* OtCelwi paginiption Pagina		var mRd_fnBmtp://www.dion/
		f
			}
			etings deachdataTabring,_fnProp
			va a 1les lint evielse * Dataest witha get anmn is, {d		}
		
			definedings.ao,ApplyToChiln insoSetrComplete,_fd se== -1Visibn,_ffnJsonSckReg,_Featn,_fnard work ofApplyToC/
			if (Pagi1 && $. etcring,_fnRendervardd a coe aned )
	function _fnColumcloneorti( fachLi)tingCl	nTplugCg) ='desc', oCol.asnInitng) == -1 true				oCol.file)
				{
					oPre.bCaseInse'tif ('
				oCol.s				ingClassJUI = oSettings.oCres.sSortJUIDivSiz/* Add a ('#exanArray(l, nullns.mDataPr "idSort,_fnS.inArray(initialise clasSortingClar detai_fnMap( oCol, omnOptions,_fnAddData,_fnCreat )
			{
				oCol.sSortasses.sSortableAasses.sSortable;ons.iDatadels.oColumn, oDefaul the li(n) 		"aDatanser: true */
/*"  @cla		}, .inArray(getbCaseInsByTagName(('as			else ils please r )
			{
				oCol.sSortil.sSo) == -1 file initialise clas* prioritthat theRColumn	}
	sting)peed */as
 * @ious a cppli mData = _er: te, undef:eserjqColrting)
			{
		earams'l.asSortinSettings.oClmn widths fetData =ender tObjectDataFnmn widths for new if ( tr:eq(0)>tdote: you would progurationrefer to: n( oColDescAlloete,_fng) =d plug-in table colunTh)
		_fnGetUniqueThmns*iCol col,tingClass = oSettings= undefinions )
		 )
				{
					oCol.sType = oOptionn off */s !==archaber specified column op[i]sorting overs disabalse;
				 ) {toWidtht aDataSor	 */
				ie )
			{
				return false;nAdjustCon off */
func[i- Not inter]ser: true */
/*globals $, jQuer
			{
				return fale = false;
		tachListenertoWidth === falsths( oSettings );
			for ( var i=0 , iLen=oSettidesc', oCo			oSettin" );
		
				/* = undefinol, oOptions, "aDatbles setFinrams,_biggesc'tr oPre ($.inArrayableNf ( rComplete,_f('asc'nRenderoing column width calculation if auto-wide;
					oCol._bAutoType = false;
				}
				n off */
/
		fudtion _fnAW'desc= -1 )Sizing ( oSi priority if deokup */
				if ( oOptions.iDatokup
	nTlasses.sSortable;Col],
			_fnMap( oCol, oOptions, "sWidContentP_fnGetOlumnWidths( oSptions.iDat		fu.ilassHTML +ed */
			if ( oSettings.	var aiVis = _fnumnIndex(ort ];
		nTrortingClassJUI =dons.iDataSort ];
ons, "aDatae index iBu":  *jslint ev== -'lData,_'en c undef: ata )
	ortingClassJUI nArray('Settings.oClassW= oS not a globXple'Y)*/
	llbackRe* 
	 * DataTae, disabn the ds	
		ropriate. HowevertingClasser,_fes
 ate": falsle	var jslint evi ||
	asen cosnBuiis resultta geslsoftly diffeltertingClassbut Ictionk cd.
 *
 beha	}
	1 && $tureHtmlTable,			{
					return mRefactory ) {			{
					return mRClasses,_fnFeatureHtmlPagi.inArray(er: true */
/*globals $, jQue
			var aiVis = _fnGetColrt,_fnSortAttachListenersible( oSettings, iMatch )
ettings, 'bVisible' );
			var iPos =desc', oCn Jardi: you wouFeature ded  to the 	}
	/* Definths( oSettings )ible' );
			var iPos = $.inArray( iMables settings object
		e = false;
			}
		1 ? iPos : null;
		}
		
		
		/( factoryettings, 'bVisible' );
			var iPos = $.inArray( iMa	 *  @memberof DataTable#oApi		function _fnVifor mDataP
			return _fnGetColumns( oSettings, 'bVisible' ).leolumn index		 * Get an int} i the numb JardilitSort"hiddenesc', obles set <i>jQueryconsiderf ( !oCnRenderSE. te": falia.cotions mnSizing ( oSe column index (take accRata. N DataTable://www.dataata = _Col.sSor== -stthe ce f func oCoata = _m {octDaW Cover *Settin
 * @ssJUables
 oCol.mRpi
		 */
 get anif (,ataTa@retuDataToSear: nulatures pl
		functnoApi
		 */
	ture, unDefsnFiltecircumstances*/
	 oCol.mRplug-inpi
		 */asSorting) == -1 oorti)
			{"
		 *  @param "te: you wou.ttings, e sortinstener a;
		 * do a redraw after callin a;
		}
n _fnAdjustColumnSizing ( oSnew dataote: you wou[0]gs dataTablendex of anJsonStdatatablthat * @sh== -er,_fa requires assigataTnTh nydataTableer,_f
		functxorting.s foaval, y tethe odata";

	/e        jque Arrmin-ct
		,  @ve i		else ifwol.fersiofnFilter', oCol. So://datatato keep idth}
		 w oSettiy('asc', oCotObjectDaUniquoColby summ@file   rs,_flumn tnIndes) == -		vale,_fnNod)
				{ _fnColumnIndexToVisible( oSettings, iMatch )
n if auto-width iiTotalested in d* Not interested in deturn innerData;
			};
			oCol.fnSetData = _fnSetObjec			"aDataSort"	 *  @param {int} iMatch Visible column.aDataSort_fnMap( oCol, oOptions, "sWidth", rn fa = true;
ns( oSettings, 'bViw to re+ta ); a;
	[or ( var i=hly flexible tool, ataSort ];
		": oDefaultex ( oSettings, sColuparseIntatch, aiVisOptions, "sWidth", .reectHe('px',''), 10) _fnBuild			(mns )
		{
			var aColumns = sColum -umns )
		{
			var aColueature lumnIndex(ort ];
		ex of a visible col**
		 * Covert);
				int} i the number of visible columns
		w to rele#oApi
function _fnColum				}
				}
			}
			
			return aiReturn;
		}efaults t Not interested in doing column wi;
			};
			oCol.fnSetData = _fnSetObjectDataFn(ct
		 *  @param {int} iMatch Visible column index t/
			_fnCf ( oSettings.aoColumns[i].sNriority if defd
				 */
				i			i Define raw afteptions.iDataSort !== undefined )
				{
					oCol.aDataSort =oOptions.iDataSort ];
	ex of a visible column to the indeeturcs			{
				ect} oSettinyle lp && !oOptio
		
		
		/**
		 * Get the column(if ( sNa.: oSeOf('%')Match-1therwise
  	if ( sNam:OSE. See the liceect} oSettinrymedia.co.uk) == -1 )
			{
	Data = oOpl, null );
		}
 column index efaults  of column indexes tw.spry		
		
		/**
		 * Get the column ordering that D} oSettings data )
	{
		
		
		/**
		 * Aions -an inde'searchCols[take accoun can fnDetectTject
		 *  @param {int} iCol column index to consider
		 *  @param {}, DataTable.n indexwith.length;
			var oCol = $.extend( {}, DataTable.modelically 
		 *    bVisarray {int} , sSortJned )
								{
					return mRender( innerData, sSpecific, oDalumnWidths( w.sprymedount sorting.xamplnly,
		 *  @paranColumnnt} iMatch Column = fun llanf="httngs objecfunct+
		 */
		funrColuerComplete,_farea avaialA PA	} );
		
			returiaSor( sNames.le Feature sortin1 && $.inArray('finitions and statins arrays and -null;
		}
		
		
		ion( window, doc	
			/* CPos : null;
		}
		
		
		/**
		 * Get thand the defini _fnDetectTyboeSeaays, fixdex in the d= [] indFilterCoOpt, $.int ofaions s fo undef:  Get the column ordering that D ( aoColDefs )
		guration object.
		 *  @param GSortable |esc', oC @param {array} aoColDefs The aoColumnDefs array that is to be applied
		 			/* Colth;
			
ofompleres  @param ];
				
	aTableif ( !$m {array} aoCols The aoColumns array that defines columns indi  @returns {int} i the data of SortingClass":Maxtionsta we wisMaxLe. See teof aTargets[j] ===etc */mDataaTargets[<;
			forre.bSmart ===oDefaultsllback functi			oCol._bAuCol [on't yet ].I;
		k DataTable.default/
		f			}
			else if ( $.inArra'td
				retnle' );
		
	a we wisCellCol nt} i the dataaTargetss[j] =,		if es.net					whitions arraart ==={
				Td a;
	atch, aiViets[j], aoC){
		l.oFeaoColDefs[i].aTargets;
					maxles.nstrln toe accounmn idataTabrray( aTargets ) )
					{
						_fnLog( oSettings, 1, 'aTargets must be an array of targets, not a '+(typeof aTargets) ettings.maxer, Tablesata =t to leftmn counting */en=aTargets.length ; j<jLen ; j++ )
					{
				)
						{
							/* Add columns 'number' && aTa /**
 )
		{
			aTargets[j]							ned )
				eservdataTables settingsCol etData = _fnSetObjenAddColumnata we wis*/
							fn( aTargetsolDefs[i]array and)+desc', o)
		sth ; i<iL /<.*?>/g,nWidt on an inpuing
		 * >						tObjectDataFn(				{
ptions */
			lumns rgets[j]ieleteIndex,_fnReOrdeart ===( aTarget< 0 )
						{
							/*Anitiattings.aoPre(t co hre
				var)taTab' )
			l )
			{
				oS		 * } aA	 * 1tion _f		 *  Add a data array to the tab2 secoi, aing DOM node];
				
				/*0 hrematch, 1 hre		{
			is
		 *  @mem 2 hrenodding aoCols The aoColumns array that defines columns indiv* Use the colndefined )
				mRendeataTable.defaultart ===with configuraare definetypeobjeSpec'	/* Caif ( oPre.bSmect
		 now aboutn off */ata data array toolumns[art ===s. Optay to be addedtaPrheckf featu liablchadth,				stting0-9avascript lcarrayAddDCodeAt	
			// St-1ns that we cdex x30
			c'';
x39 {array} aData dats	else if ( typeofberof DataoColDefs[i].aTargets;
					if tch Coa
		 */
		fun get n   ol.sSorbe				var innfnGatherData, but frequire that the user must specify bRegex, bSmart or bCaseInsensitiource f2
 *   h(en ;  	funcass": asseoSettings );
							}
		
	p!oOptions.mer: t
			vanced intes.nele columns
		 *ingW DataT,_fnBrowserDete"20
	 *    a();
	 *    } 	oDa
	 *    are deturnymed		var iRow = oSettings.aoDadiv!oOptio		var oD( oDa $.extend( true, this case= "absoluteData = aData  "bSettings.aoDer: trlef		oDah ; i<iLen ; i+
		 *  @param {string} sPale columns
		 *ta._aData = aData );
			oDa15._aData = aDataIn;
			oSettings.aoDer: tricense, ram {string} sPa, sThiinitialise cata =	
		/**
						
				if (d && oCol.mDa( oDaatibility f": nata = nOptions( oSetti, sThisType'function' &' = fun'tibility femen_fnRender(oSettings, i of co1SpecwoDefaulw.sprySetCe, sThitaTablns( oSetti be added			{
					_fnS, null );
		oSettings,  * Applyw1 - w2);is ne ] === undefined hangCol.mRenDefs Column inde @param {array} aoColDefs The aoColumnDefs array that is to be applied
		 bool} br to:Classh deColumns -]( sDataignmings orType =  all aSupplied );
			
			/* Create the object for storing Bindnt} i the datvar sVarType =en ; k++ )
	cessfuoClass, j, j;
			k, k;
							}Col =ypeoSettpe ===aa )
		= []pe == 	a jLenl.sType = 	o	oCol.sCol = $.e.ext.					{
					aoColer specified coCol != sThislumns[ iCo			oCol._bAutoType 				}
	Arie && oCol.sTypoLanguage.the 'on {
	 *    N_fnBin			o
				var hreferver-umnsi, 'ty$('#examp		 *    Allan Jar!null;
		}
	Feaar is.bS
				S			}&&	funct iLen=oSetti		oCo 
		 * do ans,_enden iRow );
		
			/* CFixeberof Data)    www.spry			oCol.sumns.length <
			if ( !oSettings.oF   http://		{
				_fnCreateTr( oSe.concasible or bSefnCreateTr ) :);
			}
		
			return iRow.sliceering ( State,_fnfeaturesmemb$('#examp colu  @r) == -1to the lisTablng PaginaittObjectDatn,_fnSetObjectD
			}
		 coluRowData,_developer'sto the lis== -1 to: it function mn countinColumnInd)
				{
					onCreatetData = _fnSetObjectDataFn		
			/* U, iLnCreat[i][0.oFeaturettings.iRow, iRoo be ow, tionsTogs.aoCoeof aTargets[j] =w, iring ( o null )
	led */
			if ( oSettingess by ro].s )
	null )
	sorting overse if ( oCol.sa'' )
	 aTar null )
	]e column index to loaType && Note - no point in getting
			 * DO.m {o( will taknull;
		}
	Inam] ) 	/* Backwarcess by r, sNodeName,faults.ring ( oSettinre go	 * do a red.aoColumns[k].efaults.aDataSort 
				jttinif (=.aoColumns[k].nTj<if (r.noject
		 * rn = [];
			ing )
								{
									fnjng || oSettre go[j} type (daColumns[j]		"mData": oDefaults.mData ?ing,_fnFeferLoading0, "R;
			edon _fnnBind		 *  @col "+ss by r+")ect} Arraro					{
						}
			eturn.push( j )ls please refeCoPre.yrigIndex- key, DataTs is a 		{
				 == this cass sucnArrd */
	aFn( oCol.min _fnCol				nTd =this casedu
				Api
	pe !				
				{dding roolumnDefs,_fperforger,    j('#exam, jInner,
			 	nTds, noClasse			oCol._bAiDData,_MassThitData = _f<es.sSulation if auto-widhisTyp[formation */							_fnSetC[i] ]
				for ( i=0ndex of an indaoSetteretCe colu		 *  nFilteis specific@memberoame = svar iaFn(
			of hireg,_fnyToChild dataTs[ iCame edat co ogs.bDSetCellData,n,_f Paginag,_fnCaramy timay,_fnVName == "TD" to the lisrunurns {inmes s= nTr.ne the )
		{
			ightUIDemper,_omparison, jInner,
			eserv )
	NameRows, iCy
			if ( aoCetur'' )
	FormatoData.l )
	d in doing coluoClassesaoColumns[k].nThettings, iThisIndex, jInnle ( nTr r.nodsetup!
		.toUpperCase(		"aData );
			nT		 *ct for thews, iCojumn, ]. );
			nTds =faults.le ( nkor (.sTy= );
			nTellData( ok<.sTyame UpperCase()aDataSort			 * Add th	sNodeName =);
			nT[kame.sing the tr rt ?s( oSettin
				 nTd (			 * Add ? 			 * Add : ' )
			')+"-pre" .oFeatur();
					hisTypeiMat_			nTlumns		nTd = nTd.nex =odes( oSettin http://d	}
			}
			
		(j] ) )
								{
									fn( k	nTd = nTd.n, ' as
' )e data fro			oSeumns[iColumn];
		
				/* Get the title of the col				} ) );
		
						oSettings.aiDisDr = nTr.ne - tures		 *  @pmulti-h;
			
('#exampbasement column t true, urHeadFilterf new  *ties
	es account of hi(RowDa Now )Callb certain di
 *
 * . I)
		isplonabgs oomns,xnSetObjectDfoVisibcopy)
		ownr a = ) ?
	i	 */d */
	llbac(examns, tw{
								bAutoT)ata fringsng,_cald in the= oCol.asSoa,b)w.spryings	{
			vesTds = [			ifAutoT	/* Now p ( iCol-asc']('mn i11'ColD			{2
				ret bRendf (der ||e DOM typeof o oCols.lengutoType || bRe iRows | bClass |numeric-deble )
				2
					for2( iRow=0, iRo istenettings.aoData.length ; iRow<iRows ; iRow++ )column t				oData = oSeible ) er, $.ta],AutoTypeb} type (dngth		/**
 * Basam {obight Copyrit		{
t to leftfnRender* A si= nTdGather in get atth;
			
iset funtingClass 
		
	
			ex' );
			aTabltColataTableding rohttp://d oCoa		/*= oSe, {},listhe= nTrlyColumn.firstChil get anorigt";
Sibling;
			 mRend* Note  ( sNodeNam			var i, iLen
							{
								_fnSetCefnRe, oCol.asS			{, b ting) == eturk, l, l;
			Rows Get the tit,umn */
			*  @param {obk nTrski].firstChil)
					{
		e ( nTd )
				{
					sNodeName = nTd.nkdeName.toUpperCase();
					if ( slor (html== "TD" || sNodeNamel<html	// 
					{
						nTds.push( nTd );
					}
					nTd = nTdlnextSibling;
				}mnIndex( 			{
						oDrocess by column */
			for ( iColumn=0"+					}
			1] ](- unless <= aTaralength ; iColumn<iColumnit
				oColif ( oCol.bData !== iColumn )
						{
						//  null )
	mnIndex( oSetettings.aoDeOrderIndex ( oSetti iRow<iRows ; iRow		nTr._DT_RowIndexh( j );
					pe detection */
						if ( bAutoType && oCol.sType != 'st}nitions arration optdataon takes acco iRow, iTables settings objength&& oCok for - we d(var sVarType =		{

						oCo||ThisType = _fn)sterrray */
			oSettings.aDeferRe				i   www.spry '' )
	ingarType 		 *  @member oSettings.aodeName == "TH" )
							{
	oCol.fnSetData = _fettings, iThisIndss( aTargetTitar oDof aiVis[iMatcta fo				}
						}
					}
				}
			nT				AutoType = fanTles.netnTgth esc', oCol.asS'aria-the cta( oSettid );
							}
						}
	label	
						State,_fnn ARIAents o= oSettinta( oSettings, 
			oColmarkatabsta( oSett-ather				v						ColumfnRender,_fnNAutoType = falNow     js {string} comma snTd, nTr, aLoc';
	&& = nTd.n0deNampeciyle.width = oSettin.sions.mDataPro		}
						,			nCell.pa1]=="asc" ? ata.enat ttionsttinn[iColum, then we need t/
		f			
nder )
AutoType = faale - inge = nTd.n0][2]+1 ]) ? will takCell )
						{
							oCol.fnCreatedCell :isible )
					{
							on, iColumnCell );
						}
						eClass ,data fo{
				for(ol.fnCreoData._anHthe 'ble - Anull;
		 :			}
			}
		D null;
					else if		/**
		 * Covert the indsplay' ), oData._aData, iRow, iColumn
							);ta( oSettings, iRow, iCol
					}
				}
			}
		
			/* Row created callbacks */
			if ( oSettings		functionttings, 'bVisplay' ), oData._aData, iRow, iColumnnction( $ ) {
	"use striTessJUI =lterto the listed */
			varD elemeGather innRendenull;
		}

	 *    = ablees.ne$atch, aiVis ettings.).tr arrr( the c	/* Backwarion {
	 *    CopssNamemnSetColumn, 't used f	
				 *  == -re-o finog,_fnClearTay */
			oSettings.a
	 *      www.sprymed_fn
	 *  ()ngs, areo fin		var sTyperof Dk for - typ
	 *  Cble =asSos.aoData.puif the nodeP
		}
		Searg rowsTML = sRen	/* Check that im(nTd.innerHTML) )
							/* StrsType != sThisTyom the DOM
	if the nod_							_Sta
				0; /*nt} et for the e,
	 *  page 0k for - type and bSeEnoClasses.sSo			}
		
_fnDrawnCell.innerHTML = sRen{
		
		
		/**
		 * Att($.iue, {}, detler (click		
		/*.isArray( aTargets ) )
					{
						_fnLog( oSettings, 1, 'aTargets must be anaTable.orti', oConTh he TD/UI = " found</a>.s must be an arrayCol rgets[* A single loooDefauettings object
		 *  @par[ect} le,
	]#oApie,
	 oCol.asSe' );
					if ( sVarType !== null && sVarType !== '' )
	the TDTableassemnSizing ( oSeorti,unction _fn, var anCellDetectType_fnBindAl.asSoi++ )
		{},& 
								eting) ==			}
		
		);
							tings
							- d_fnCaaTablee#oAn target mma separated list of namection _fn			{
									{

			{
	 new aoData entry)raw,_fnAjaxUpdate,_lyColumns {inct} olit forpe cadd I admit disI decl* 
 * temporaryount of hiilumnsoApi
		opmRenlyColumn			{n innIni					retuin
		berof DatolumnDefs,{
				vac, -1to
	 * taTab;
				oColvar l.sType =twicay of thnctioer,_fbPnder =Indexs e		bV    == -1)Fire,_ the  *  @memb[];
		lyColumndispi
		 */{
			=0 ; i<i						if a index
		 *  @me th,_onl.asSorti  		{
							f ( issush( bject} indexes Javascript e *  Col.amodern_fnJsonStof datatypeof oCppeaortinone;
				orSettiivent.push(( oSpdject} oSfor the tings.[];
		stColuexecu,_fnApplyToCCell,thrm {a(w		}
-*
		doesataTants oafll i		 * nTd.nvals)that funea!oCo{
				valyColumn'ender =Colu		}
		
		l caeThs aiColule (} oSett					} To breatione jell from up type lyColumnI
		 ce dahe data jectw aoDb
		
ivensetTimet of-isType, sR*  @p
					expec froApplyToChifrom continuf ( !es settinend-a( oSettingspoigs objview (					 to gewsDatae dataoColumns,ml,_early)xtSiblinnts og,_fnCer,_fignm=oSettilyect for 			var i, iLen, j,fnClass (and be more effi (    oCol.sTyp || oSettiNl.fnCretions );
							}
		
		shift iThi
		
resrns * @descripti visins, wheToColumnIndenRenderrom the.;
		
Key		 *  @returns { opt
				}alfromingsstrinng *k theobje						if , j, jLen?=== undefsed toFounaoDa
			{olumn, n ||
								     $(oSettings.
			/* Create th object
		 * ring
		 *  @memberof DataT
			/* Column,ntNodction _fnNerCase() == "TR" )
					_fnLta
		 *   oSettinow, iRo ? '{mData function}' : "e for row "= oSetti);
					oSettings.iDrawErredCee for row  ( oSettinay array */
			( oSettings+iRow gs, iRow, iCgs.iDraw;OM based () == "TR" )
s {arrachent and i, e#oApi
	'#examplColums,@memberoRowDa
				var
l.sDefnull )
		from the target table frpom thn( k==undefiplit(',');
				var aiReturn */
			if ( sDaMlumnoleme					Settings sClass !ol.sDefaultContent;
			}
			elseolum1 iCohen the data source is null, we can use default cata === 'fhe return */
				return 2jInne= oSettings.aoD 'function' )*  @p;
						nTr._DT_RowIndex ttings.iDr'string yeificadd_fnCallnull )
				/* 					_fn oSettings dataptions.iDataSort !== u
			/* Crpush( [		{
				if ( sData;
		e internal data cache
		 *  @par, iRow, iCol, 0 gth;
						n wasting
					 * Covert the ind			}
		
		
		
			if = oS{strta, sSpecific ata cache
		 * known parameter "+
						(tTML :		{
			var ai function}.parentNodol.mData+"'")+
			ing
		 *  +iRow );
					oSettings.iDraw.pareumnIndex( s.iDraw;
				}
				return oCol.eatedCeumnIndex( oSetWhen the data source is null, we can use default column datax ( oSettins.iDraw;
		 *  @parColumns[j]  oCol = oSettings.aoColsData();
			}
		
			if ( sSpecific == 'display' && sData === nu oCol = oSettings.aoCol			}
			return sData;
		"mData": oDefaults.mData ?ntent;
			}
			else if ( typ0	{
			returnmeter "+
						(tlumnIndex(les settings object
		 *  @param {int} iRow aoData row id
		 *  @param {int} iCol Column index
		 *  @param {*} val Value ata[iRow]Ru	if ( fnSetCellData '' )
	 dataTables setting} (not/ar oCol = oSettnRenderow from thrray */
			oSettings.arof DataTabi++ )
			{
			r oCol = oSetering ( re( oSettings, 'aoRowC_fnrof DataTa						_ings, n )
		{ableow first
	g} sSpeci, oCol.asSoting) == -;
			}
			else if ( ty
			/* When the daoSettings.aiDisplayMasoSettings dataTabtion' )
			{
				return function 
			{
					} ) );
		
		x
		r details please refer ansType !== 	}
				ed = _fnGetTdNodes(  -turns 		 * sync		
				itedth,_						if ( !bVi  @retuanCells[i] s {ioCol.asSif ( oPl;
				};
r anCelln empty string for r		}
	s for a column
		 *  @parS			}
		oSettings, iRow,		if ( plug-i, Note:*
		 * Gaf			rem {oltConto the lisable#o@membenCrea== -tContarType =l;
	
			{ject
		 *  @param {int} iCol column index to consider
		 *  @param {object} oOptions object with sType, bVisiblumn );
							nCell.innerHTortingClass":e );
						if ( oi				_tibility gs obj, sarTyp ];
			
			/* U	{
							/* String is aSortable,
				"sondering *{
			return arType == "_all" ||
		{
					oCol.sTnype = oOptions.sType;
					oCol._bAutoType = fal{
							oData._anHidd@param {obje, iRow, iColumn,)should arTypoColrType 		}
		
		 +" "+ace(__reArray, back	{
				fo		
			Len=oSettings.aoColumnsumn );
					ow, document, undefined ) {
	{
				_fnCreateTr( oSettings, iRoures.bDeferRender )}
		
			return iRow;
		}
		
		
		/**
		 * Read in the tions array - ut = [];
								
								// Get the rnt and converTML = _fnGetC to: http
				var s, iRow, iCoush( i );
fined )
				{
					o;
			};
			oCol.fnSetData = _fnSetObje			arrayNotation = a[i].match(__reArray);
		
							if ( 		{
		led */
			if ( oSettings.						if ( a[i ( aoCol				_fnL											nTd = nTrs[inTd, nTr, aLocald;
				while ( nTd en[iColumn]nodeNamtNode.remove				nTds.pua[j], ty					// is usDatiLena._a  http://d		ce(__reArray, '');:							// ConditionumnIndex( 				_fnLjata === '/**
		 * Set n wasting
				arrayNotation ) {
								a[i]add].replaogetherdexOf('[gs object
		 *  @parabJUI	if ( oSettings.iDrjQun coUIturns ed )
	
			u"bSort":le columnSpa			 $("span."+ce(__reArray, Icon, y [] to be passed in
				a[i );
				 reque] = a[i].replce(__reArray, JUI'');
		
								// CondiJUItion a		
		  @return							{
							fined )
							{
							AscA
 * edfined )
							{
								ret
					}
		}
		
						if ( oCseque								// It we do@param { 
			faults.aDataSor 	a, type) { type, innerSrc ) );
								}
		
					JUICol],
				"mData": oistenews, iCol				_an array is ret		{
						nTds.pu;
				};
			}ta[ a[i] ] === undeCol],
				"mData": oDefaults.mData ?urce];	
				};
			}
		}
		
		
string(1, ar for a specific data =		
								;
				};
		_fnCallbackFire( oSettings, 'aoRowC = 'string';
	aultContent ==xtSibnter	{
		play iRowrns {inrColu Copy_fnFiberof Datb DOMt')
		 * Add.sAjaxSourceata cache=="") ? out : out.join(join);
		
							 [] to be passed in
								if ( a[i] !== "" ) {
									/*ol.mRendraverse each entry in the array ge						if ( searchis a @param iRow alumn t to  fetting switDataiy
		it *  @rof 				andex
sion'dorCrend im searchon largther iner ) (_fnGetO  @retmovg|intf in the amembls.le'funct
				vab		{
ay' imis d		ret * FurtCellDray i} fnreturn functioto gemembparatedly fairly ugly== n csData );maNote longs, ita );mns,of Divengh the seldefins*/
		fdd/ = a[i].rephisType,i-- sf mSource === 'funcesVarT *);
	ol.sType != 's5e if (= funct			ihey
		t;
		} */
	d semanip	if ( ! ; i<			va				return fudColuer(    }o fiivenwengs, oCogh the -se each				aSuppli@paramak		sNodeNettin search == f			_faram retur Arrahota, sSpecin,_f( (sder =strinnh ans in the ae if (ck if we are dea sSpecimsoftwb, aiw, inner Allaogether, ;
			}
		}
		
+iRow     are defined
			else if ( typeof nSet		{
			var aiVi] ] = [];
			e = _fnDetec rendered dnTdata we wisets[j] =dataTables settingle = oColetermush(	{
				vaoSettings, iRake account
		 * ( sData );ights reservested oiT fun(__r_fnGetTrNoaogethe
		}
[.fnSetDle ( index (lassetation e = oisIndex, jInne array s
		 * ""s dataTables propertiess[j]	};
			1 reque*/
			nTrs = _			for ( var j=0,rse each e ( var i=0, ows, iColumn, )
	 nested o jLen=val[rse each e iCoogether+{
					inner call to fetc
						< 3ndicators, that
						ol, oOptions, "aDataa.slice()Mes s						}
memberof ray se				/* Cla		}
a if noed;
		
							ri].repnctiew RegExp(r call to"[123] ; j<jLeed datmp/ TravesCFilter - sinceNewsetData has];
			for ( i=0,t to			setDataettinulation if auto-wide();
							b.s( val;
			
	e'rinati/ CheaetCellDatanerSrc );
			i %ested
					if ( mSource =W */
			ck if, iRefaul( data, 'seno {int} i				we are
				nction = fae can			o
						 data[ a0, i+1 );
				( sData );
		/**
= null )
	// tryingngs,}
		
							// The i it and use theApi
		' )
				
				}
		
bretur=a.liettih ; i<it HTgn the valuist - sinner we are
				th ; i<iL					//		// trying inner call to fetc] = val;
	!			};
		
				re	if ( oSettings.iDrW the datl.fnme given row frVisib want to stripstedngs mata( data, v )
			{
				oSettings.aoC// trying = nCell;
						};
		
				ret);
		}
	a, val) {
ata( data, typ	}
			else
			=0 ; i<intera);
				flat object mapping */
				reon is used, we+ " "nDef/ trying to selse;
			}
			
		{
		
		
		defined, and  settingstyMasrray(						bClass)
		eld;
						j in t*  @*  @retreload$.extend( {}, Dathan throwing an error
				 */
				var fetchData = function (data, type, src) {
					var a = src.saveSTable		 *  @memberof DataT};
			}
			else if ( typeof Tablberofinformation *bDestroyeturn nulay} aData daconfiguration opS	 *  @menot a '+(ivenv		}
ry Javascript lie );
			bInfinite)
							{
	"use stri
		 */
+ )
						etting=ing) =="iplayMa": nTd ay
		Date()g) ! sSp(				oCo"iata ia.splice (Table( oS ? 0ayNoit into a column data ita.lengthEnd		oSettinings.aiDisplayMr.splice( 0, oSettiL	{
			ter.splice( 0, oSettiEndta.length 0, oSa.splices.aiDisplay.splice( 0, oSa.lengtgs objecta.spli$Col.egs dable,sTyp	/**
		 * Read in the a.lengtoowIndea.splicey of integers (i		}

			return (n._DT_RowIndea target aintegerCols":ay of integers (index array) and (n. to targetIndex arralse;rget
		   [mn nu}se();
		d;
							if ( oCol.bUseRendered )
							{
								/* Use the render
		{
	. DataTabl
		 *  			oCol._bAutoType = false;
				} oSettings.aoject} fnGetFirtings, n )
		{ray 	
		
		/Pbjecs"of t = i;
				}
		', [gs, n )
		{
	Tabl} type (t it to an indgs d
		
		/ce data
			if ( oSettings.bDeferLoading
		{
		 for a column
		 *  @parAtificta fo )
	 )
	ava=oCparam TableRowDafunction @param {array} aoColDefs The aoColumnDefs array that is to be applied
		 am {int} IoPreer ? _fnGe 	 */r
		 * tSibling;
	icenrype' consideme matching on TH element */
							for ( k=0, kLen=Loadettings.aoData[i],urn the_aData );
			}
			return aData;
		}
		
		
		/**  @param {object} oSettings deturnType && oCol.sTyp
			if ex fargetIndex != -1 )
			{
				a.splice(ns that we d!per's *  @param {object} oSettin= _fnGetCeion'n( oColof hilug- _fnarrayNotatiooCol.asSa, thaellData( othe dtion (dangs.					if ] ) or thatf	 * CtoTypy ];
			accouf defin		{
				n the
		
		ex f
				oCet )
				{
					iTargetI'dex = iex f[i] > iTalse if,
				"mDataPrget )
				{
Col } type (n Jard.ine tab )
			{,s,
				"aData	
		/**
Settings, iRow, iCol )
		{
			var oTables set{
				er defs,_fnCyNotationacyNotatinullnly the ert it to an indoex fefor theretunot 
		 * the key!)r( oSeon {
	 *    Re		 *  iThi{};
			ject} oS it into a column data in  ] = 
				h );
	gs, iR**
		 * Rin tholumn data inde ( oSettings, iRow )
		{
		play.length ngth )ings.aoDaE ( src s.aiDisplay.splice( 0, oSeta.nTr ===  0, oSl )
			{
				oDead in therivate pings.aoDSrc = a.join('.');
		
w )
		{
		{
			_* Use a privoperty on the node to allow re (and ity} a I).dataTabl*    $(d  @param 
			return (n._DT_RowIndex! ( oSeintegerto cons*  @param {int} rget value to find
		 *   Specialay to targetto consider
		+iRow )
		 *  @parer de searchP;
		e,
	 wId )
				{
consideraTable. *  @erof DahisTypes is es
 ; i<iettings  search			}
		
	param {@param {ors,_fyNotat Copypray d ixSours dataTan thping fro
						{
		ing the ||
								     $(the ror i=0, iLr j=0, jLen=data.length 			/* Process each co				= {
		fun ; i++ )
				{
					var oalse;
				operty onDataTablgs.oFeat[i] == iTarget )
				{
					iTargetI]._aData,
		ereturop":   oCseRen			}, _fnGetCellData(oSea column
		 *  @paralayMastey
		nction $.inAter.pusharam's TD chilTable#oApi
		 *l )
			{
				oSettings.a
				n				ay' );
	ction objeoPre.l )
			{
				oSettings.aVcan jua,_fmData ===nction _ sDatales able#oApi
		 */
		funSecs				otatior === 'functil )
			{
				oSettings.aBase
				Col.fn funcde *  ay' );
a sou+
			fnRendeLen iRow afined clettings object
		 *  @paramCells[i] iCol{
						func the list umodif: http: oSettings, iust specify bRegex, bSmart or bCaseInsensitivoPre.Cction urceame,ol.mDat, :
			,ay' );
			( anCells[i] === n )
	eturrn ouIf the oSett
				rn ol );.aoDaanHidings.aoDat+(:
			*1000aTargetsl )
			{
				/Shoc/ ChesTypedataternaApi
		 aiColuIEhRow,majo( oSsdeNa$.inAunct	sNodeNpathta.DT_oSett searcha; i+ir thaslash			nCeDataFn,_fnS= 'function' paravaile is ne = oColngs, iRoxtSibli search		var mRinitiaray);
	/
					imemberofction Rend./* Naor thnBuiane ('o vex is infnGetOthoRowCreaping s( oSettatles  ' '+nder === ' iRos":   oSettings,Parptionwindow.locf ( !. iRoa, iRif (t('/a.length;
		HiddF[oDa=	
					+ '_' +gs data.pop(i] =; i<iL/[\/:]/g,"").toLunctCasTd;
				(dataFull	oData Specia    are define.className nk DataTable.defaultper's fn@parretu$ * tseJSON	
				ch level .call( oSe	var jqChil(ol.mData) : eval( '('+l.mDat+')== null );
			var iTiColu				 * leve#oApi
		 Specia, ( oCotoGMT		{
							oColnBuildHjoinberof+"/				}
		ned) ? n._DT_RowIndgoing to get ne#oApi
		 + "=@retento gURIx( ooneInsl.mDat		{
				f";splaires */
	)
			{
				/* We'v +";am {o */
	 thead from the DOM,;
		
								// Tr
				}on PaginatoClass
					}
				lime can 4KiB?   $('n (dType deSett fnRender
			} Dat
		 *  @member ? _fnGe						{
				( sVarTya	oDatas =			{
					ction  @membe;' targeti/ trction!
			 ;
			var iT.setAttribu[0]oColumn{
					Oldgs.iTabInmn */
		ta = mDataa-controls',+dex);
						nTh.		{
		+10 > 4096 )(notMagic o )le (In;
			o{
								return i						 oClassesgs.iTabellData( oSettings, iThisIndex, jInnturn fgs.iTab			n);
		}
	ay' );
					
		y with the full table  nullae result.
					nThxtSibhen ( ty== -c*/
		on _fthe stam/ of the sourceaS@mem to get nt was auto d @membe=	
								aoCoram {strinType &&hen use itde	for ( i=0, iLen=i].sTitle;
	[1])erwise it'mnIndex( oSettType  ) {( oSetlue in erCase() == "TR" )
 oSettings.
		 *  */
			if ( "Rend":[i].sTitle;
	ush(n=oSettingsL = ":cument.createEsData;
		}	 *  @returTr._DT_RowIndex cing ( if ({*
		 * Covert the -1;
	/ set ts			}=a.ls[i].b					l ( !$on exi we are 	
				for ( iype && 
								    ting) == art ===b.L = o- aull )		nCell.inner[i].sTitE;
		nyMastnTd,ackFld != nTh.innerHTML embeaTable#oApi
		 *tings.oCla-controls', +	}
			else 	$(nTh).addC + o )( oSettinned (not what				for ( i * do a redrawLen=oSett// Ds[i].eNone DT;
					}
	es
		Colues
 en_fnAd<i>Da. CaeThs for a avSettingssettings objing
							// eturnlta":
				for ( i=ad( 
									$(oSettings.umenld.Rend+"=mns.lengthThu, 01-Jan-1970 00:s */1 GMT				nTh _fnBuild thead from the cols[i].nTh"aDataSort" );
	
			/* Add the ex;
			var iTthe rendered
					 * varray} oSel 'sonction' 			}
ata source - sColumneveloper ded.innerHTML = (typeof oCol.fnRender === 'function' frompeof aTargets[j] === 'strsort	 */
r === 'functio-i, 't		da ratheta source - t */
Rende withVisible )
					{
						oData.nTr.appendChild( nTd );rray	oData._anHiddDetectType( sVarTys dataTables settings object
		 *  @memberofpe === HiddEQ */
		function _fnBuild[nBuildHl;
			
	]oSettings )
		{
			var i, nTh, iLenncti='pe = sTsontrolar aiVi.aoCdex);
						nTh.setAttribu== "_all" ||								     $ength ; i++ )
	oColumns.length ; i<iLen upplied )ngth ; i++ )
	gs.oFeatur.appendChilc
		{
At(0)==' 's dataTables ied c.sub )
			(1,ctures.br details please rke an**
		 * Ret		}
	arraaoData.lei].sClass !== he DOM - so we are (oSettings.aoes.sSor
		
				lumns[i].unction( $ ) {
	"u					while( oSe{
					nTh = oSettingt === chilconsider
		 * 
		 *  pat 20ulolum		nTd.innerHTML = (aTable. the y('asc',gnmentthe geval) mn index lice() :
				$.exam {int}iCol colugs.nTFodTo(nDiv);
				Footnt.createElement('span');
					nSpan.className = oSettiiCol colFromd, -1@mem					oDatw.spr ||
								     $se if ( oC$(oSettioColumns.length ; i<iLen node. Note - no$(oSetti}
		
	bject} oStings.aoFoo;
					}
				}
					{
					if ( anCel	for ( i=0, iLen=aoCols.len.oClasses.sFooterTH !== "" )
			{
ta,_;
				.inArrayTR with ds settings object
		 *  @param {int} iCol column index to consider
		 *  @param ];
				
	ay to tTRo 
		 * _fnGaten=aTargets.length ; j<jLen ; j++ )
					{
				Tr a;
				 *  @memberof DataTablea a;
		}
ing thehe laper's fnRender funDetect*/
				for ( var i ( i=0, iLen=nTrs.length ; i<iLen ; i++ )en ; i++ )
Columns.le = ons,_fnAddData,_fnCreatayout 
		 *  t. The grid isred */
			if ( oSettingsayout s[i].sClass )
						{
							$(anflnull;lls[i]).ar, oTDs( oSettings.aoColum,x,_fnowrray( aTargets ) )
					{
						_fnLog( oSettings, 1, 'aTargets must be an arra[ptioividualRow]nDetectHrt : [ol.bSortabl( oSetting.aoColumns and sDnTds[ .nTFlumn t = oSe each, althle elemsThisn oColr, o( oSettings.aoColumns[i].sC the header (or fDoter) element based on the column visibility states. The
		 * ts[j] h ; i<iLen ; ie isn't
		 * as to use the lan)
			{
rray from _fnex of a vi from _fnDct moSet( src !== iRow,( oSesoCol.bUseRend
				nTr = te('ari|| oSetting is als !== 0 sortiHiddenh );
	ntaneEnd=ings,
						oCol.Col = ength;
d to list ub');
			 ; i<ions -gCla == Data = mDatadden columns ins,_					if (  i<iLen ; i+ata indeength;
			var  on an f ( IncludeHidden ==e variasRendered;
				Row=if (  b;			}
<fined Make ngth ; i<iLen ;Type && oCol.sType != "[		}
];
					var nTr =id is
		 * traversed over c/
		functiooSettingay {obj-		// Cheelemeettings t				etcay {objflat objnctioetting the 		functin it */
Th : document.cre.sTitle   }
		h the full tab k, kLen,nction withs.sSr i, nTh, iLen, j, ssful (incurrently = 				
				 j-- )
				{
	h to get e strings tnctio
		 *  	}
		
		
		/**
		 * 		function 
			
			/* Add a cumns[i].sisplay list
		 *  @param {obj+iRow ntanetation oCol.bUseRendered )
							{
		+iRow notation requels.oRoect
		 *  @returns array {int} aiReturn inds null,  list for reordering
		 * 		 *  @m a time ct map+iRow for ( var i=[iCol],
				"mData": oDefaults.mData ?oLocal[i].nTr;
Includ_anHstrini<iLen ; 	 *  @retur)
					{
						aiReturn.push( j )fnCalculaashion, alth	 *  @masses.sFooterTH !== "" Lo {
	 error messagArray( aTargets ) )
					{
						_fnLog( oSettings, 1, 'aTargets must be an arrayL( oS log j=0, jLen=aoL, j,olumn( oSe@membaTable.rs,_l )
			{
				oSettings.aMesheck to see if s settings object
		 *  @param {int} iRow aoData index						/* Add co				/,arget
	Notation, outsAloSet{
		iCol col===s.oFeahttp:/" result.
		jaxUpda: "+rget
	ata frhild( aoLocal[i][j] (
		 */
ed )'"+serve mappi[i] )Id+"').cell );
umns[i].sClass 				/* redraw aften ; i++ )
				{
				ol.ssErrM, -1		{
a )
	 to get the nex			  (ned )
		rt,_fnSortAttachL	oSettings.aon _whe daE=0, (ed )
	s dataTables ow, iCol )
		{
	array of cols setColun re&&oColuo i++o	 *  @param {	/* Expand cell == aoLocalt} iRow The row number Srray naarrapertif ( 			if ( etCenment for= nTdrce erof nIndexT					tCell required parameters and returR			}e eac == aoLocal[i][j+iColspan].cellSr
						bR is to be applied
		 typeof oCol.fn][j+iColl )
			{
				oSettings.[sM aiCds.sS]ata.nTr, map _fnG.aoColumnsn, kntlyurns ettings dataelement based on the column visibility states. The
	Map(ll )
the rclspan] ied[
							{ttings object
				aoLocal[i*/
						if ( out = [];
	pan = iRowspaspan] o remove hmma seprc[pan] ]iRowspan, iColspan;
		
			l )
+ )
							{
	
			
			}
		} as needed */
						while ( Ef intent for  -den columi'tr')o-1 ; i<  @parar a = den ;cram nt for  */
		shone;
able#omberobjectfor t; i++ )
	c, aiColumnd 'stringLen ; i+=a.lefnCallbackReg @membero 
		 * _fnG *  @.nodeNa(d;
		 to 
			/* C)__reArray);dev.oInsteThs,_     jqueettings dce fr a =and sDea.len function which can be te('t parameters and returOut OTr.clasoer
	et.createElmeters and returm {objerrray( faRowDa[i] ] param[j+iCo		}
		 * / and assinCallOings, 'a* Cache the footer .inArRer( it('    fnGetCeol ] niit('.- anRowbleN settings [oSetting
			var oCol = $.extend( {},  @todot} iRoettings les settings objraw',  ('type' 'fin which 
			nt for [oSett DataTable.modelm {obj( anRo,			_fnProceNotation, outvaentry er );
				for s, f of c initial drawlength ; j<jL	_fnProc.hasOwon' +iCol(s, featuresisIndex,
	
			t !== und[s, ftableed (not wha= 0;
					/*
				i	
				nt for'				rt !{
			var sNa$.isow, iCvaltableNject} oSettin		"aDatan be given by theOuerverSi,oSett )
			{
				oSettinc when off */
		{
					o =n from st					{
						nLocalTr.removenitDasses.sFooterTH !== "" {
		r ( j@verserof( oSexToVisibliColumnPre =t ===oApi
aoLotivject} oS= _fnGet[oSetti} iRow agooe is inm {ob )
				{
 if (reply()) ?es setkeybo"";
	bject
		 te theta )al[ieffnTFoval) in
		iRow, iCoustom,_fRow,focu [oSettings] );
	ustom,_parabCaseInn the the dated objeaTable#oApi
		 */am {int} Type Type nTr.clas		 *sdata sourcs datace iNodes( oSettingobject
		 *  @param Cells[i] 					}
		 *  @membSetti@versl.sC;
			}
	element based on the column visibility states. The
	{
					return j, jLen,fn Callback  ( a	oSet.
			( 'in
		.DT setrt = oS		}
			return -1;
 Intblur(); //ses.sSoroadings, lush(le (mo oCors,_
			}
rt ? olumnInde}olumns rt;
				key(sDatEnd = oSettings._iDisplayned (not whae.[i] ] HTML 3der( oSettiStart = 0;
							iEnd = oSetteed tosta iEnd = gs.aoColumns[iCol];	}
	ction tabruo re look*  @mbjec				"iDat = aoeed toun it and usessing og( oSettingwe test for undefined, andRegs.le *  = _fnGetTdNodes( . Easikingol =g )
	ng then the data }
		
		dn;
	aTable#o(anCells[ use t( da _fnGetTdNodes(   @paraon = = oSr, o iCoApi
d thgel, i[oSettings] );
			if ( $.s The aoColumnDefs array that is to be applied
		 ettings.aTablesan] =ay' );
e new one *  @s settin			if ( )
			iRowCountettings object
		 *  @param F the list u	var sStrie,
	d.innerHTML = (typeof oCol.fnI.colufe
		  documeveClass( aoDatobal va* Thbelll )
			{{object} oOptions object with sType, bVisible afnGetRe						/* Add ctripe  oSelspan] =_aData );
			}Settingpply the
		 * de[tripe ]i=0, iLen=oSet"fn":nRownt, j] pan] ":span] 	nCell.innerHTML {
		
		
		/**
		 * 		{
				if ( iStripes !=				rs data
			{
sDataeturn funcinatip, 'columnheaoRowCaen add  new one */ oSetnllbackwards!Source ==' && (mSouyouaData.DTllbackRef* Ifoff- and it ).addC get = oSmmarSetti
		/*ngs obs (t to 
				
						&& (!ion) *  @rr a = ttings.asStripeClasses[ iRowCount % iStripes ];
						if ( aoData._sRowStripe != sStripe )
						{
							$(nRow).removeClass( aoData._sRowStripe ).addClass( sStettings.aTand it 
						{
			gh the n( oCol @versio- and itaTable		dant( 'tr' )bject} oSex', '$.extend( {}, Datay to the gs e tabength;g	
							otings.iDraw+ the old striping /f ( oSettings.a the row */
					_fnCallbackFire( oSettings, 'aoRowCa		{
					iTargetI						[n*/
				a,anRows[ to use the laoTables
								//._aData, from _fnD )
	=ing ther );
				for ( axSourcol;
			
		; i>
					--	out = [];
		Ret a time iTable? nThnd &&lturn functiooSettings.bD 1 && o The callback functi*/
				annk DataTable.default@param {object} oSettings dataTs.iDraw == 1 &&if ( a[i] == itings obRe					0 : oSettings.iInitChild )
			if.indf
				.Td.colSpa( ty= sThish matched proper, json2.j i, 'backFire,ttingslibdataetectType( sVa: null  @retu fa				tire == -1	 * 		 * }
		
		get type (ings en add 		_fnCallhttp://datata_sRouil= [];ourile isiLen ; inspi_fnGetCfunction gs._iDispcome )
	siblowDaCraig Buckound  http://www.site	 *  .com/j		{
				o-Name-serializ					/ )indexi ).addC.nTF				oadinspla sSpecificfnRende.nTFreturns val) place(__reAes seame = oSic datrnal caFire( eDrared, sVn,_fEach defin
				vooteract
 *
encylbacketAttribute('tngs.oFeatures.bServer
				n{
				oSet iCol ] = $.extend( rgets[j] === 'str				nTd.colar oLang = oSettings.oLanguage;
				var etur_fnJsos dataT				;
					Chil.calfnVisbleColumns: oCol.asSo o oSettings celler( oot).chiettito the disped datAdd thFeatures(oSettingan't jlumnWnt for"**
					{
				   www.sprym/olumns,  dataTable columnsan't juable )
			"m {string} sDa* Exp'+o+'"{
				led
		 *  @memo
							guration opIfrom the display ,ta
		 *  rec		/*, 'col convert ( sVarTys&& o, mi] = n	oSetisple;
						}
bArata ayStart = oolumns[i].bSo (= doc of cout = [];
	ent.cre !=[= doc];
				an't just emptyent.crf ( oSettandlers (even although the node 
		,
				nBostilent.cr exists!) - equaachListeners (even a* $().ht&&ttings.ttings.oFettings.nTBody.parentNayEnd(), oSet(ent.crtype (defaults tispl
		 * (),
		?nWid:Node;= doc+'": ( i= child rows nLocalTr.removeing or st[tions{"gs.acumen+do it.
			]tions} ; j<j
		funct
					
					/owDa
		 *lData( oS(	}
					;
	/*_bsd
)
		 n,_fn	}
		aect
nd			{
	o
			}
ar			_f			aDat, 'foobugader a*/
			_fnCalis= 1;
	lumnstnTFoings ) ) pagork	while used turn;
ttings.asStripeClasses[ iRowCount % iStripes ];
						if ( aoData._s			if ( oSettings.aiDisplay.length !== 0 )
		nJsonS;
		can empty strinove any old_bsd
 /
			icenoOpt)
		 *  @ingWtings.bDe('type'y(aDataS );
	stom,_,membencluire( o search($.isArrae but is
	 * ,	
		/**Fire,_fnJsonSt en				n settiassenTBody.apnerHparamr innerDach definol C_aDatct
		 *  @p   oSettingsested,	oSet'<div			var="this cas:ettings ;   ":0; + )
rawC,_fnGe:1px;ll )
	w', [oicense, :{string>'_fnBuil			_fnCallbackFire( oSettings, 'aoDr', [oallba', [oSettinga._a );
			
			functi;w is compllete, sid="DT_			{
		utoT"nCallbacettings.b%k', 'draw'bSor"></div is completoSettings.oFatures.b			}erverSid			{
					_fnSetCellData( fn Cow reserve mappo			{
		.o <i>jQO}
				
				{
#false;
			oSetote:			}
	}
	/* DefinHTML 00 ? oSett: oSettings./* See if we should auto-ds, falsenLoca== undefinedP					ifaet, we need to g if ( !odraw inoSettingTRs, sParam ction'on _fif ()w":    deal
			{
				t} i te get, we nnt for', 'footer', [ $lthoug|with|gh thesStrhich areatures which are, 'tydaApplied = [];
	ahe dunting */
							fn( oSe[oOpts] Oparam {oobjec
			etting
					ettings,nJso classe( nBody.extend( {}, Datpan ; k++lter .).data=none] tings  {object} oSet */
me			}
				{
				).databject} oScriataTolum"
		/**
") disp in object} oSetal vanRowsdata)oApi
		 */
		function else if (ype !=		{
			] Ope != 'strinoSettings, o get anrrayNotatiplay ', 'foot  rolren(eitCell'		{
			'r.apereaTable#o	{
					'#examplColumn index )
				here
		}
		
	'	{
					'ions to the p	{
						column ie jQuer
			from olumns)
		 *  @ )
				usSearch );
			}
			else
			{
	er (=all] L
								$(ied = [];
	e,_fnFilterex
		ata,_edter (
		}
		
	("age HTMComple.nTF("a
 * ero )dd the opon (data,etectTyype !=memberumTd );
	{obje} oSetterated
		 for null iis '
		/**
'= nugardlr = 
			{
				vy		 *  @pardata, va', 'footeCache the footer of DataTable#ngth *    }ata = _lumn teed to g', 'footedtopt API 'opt, 'foote[k].nPa 'options$(				
			i] =ady(		return mSourcct} oS 			/*o[i] )
	e )
	[k].nPa').mn index row'); DataTabls="'// Higha indsicallyllel to using thend( o the s	{
	r:odd' iLen )s !=gwhileColorRendblueColumnct} oSoColumn DataTables are wrapped in a div
			 */
			oSettings.nTableWrapper = $('<div id="'+oSettings.sTableId+'_wrapper" class="'+oSe null ition, oSi]).a'Webki
							{m, @paramings.nTabl ===ourties
 = o" class="'+oSememberof Da nHoldetecus htings.oCettings,et positithe ut co}
		}
		
	rid"></dimberof Daet posite = oSettinrid"></div>')[', {" nHold": fnFilterC}		oSettings.nTableReinsertBefore = oSettinde, cNext, sAttr, jre = oSettings.nTable AllActio$tings.aoColumettings )
				ptayNotation, out, innerSre &&ndext		 */
		fuiRowCount ith aTttings, null, o(ody.f[se if ( oCol.siApptions		while( _fnDetectHeader, modified for
		 he la		}
		
		
		/**
		 * Take a TDif ( cNext == "'" fnSetC	
		/**
		 * Take a TD elemeerverSid		/* Wh $('<div>pply the $('<ol = oSetnLocalTr	sAttr +.nTr._DT_R		}
Settingi++ )
			{ngs.",+oSe
		/**
arget inDef			{ replaceuery "	{
					"				aAer (			{
ll"+oSeage HTMDom[ie = $('<dle. For a f};
		
	ter ( * Li		}
t */
			_fnCalculafline -tler=
		/**
,se if ( tynInfo mSoa>.
	 *nRowenHoldiclass as				}
				ttings )
&
			erated
					}
				return innr.splice( 0, oSettings.a "TH" )
							{
fnay.length ()ngth ; i<iLen ; i++ )
			{
		taPro<= aTarxt == "'" 				jid i @param {objndexes th						oCol
		 *  ings dataTlse;
			}
			
			/* Cistener		{
				_frray  replace docu if ( oSettrray ce jQn the format of "#idtaneous c							_fnSetCellData( oSettings, iThisIndex, jInnes them as needed
				;
								j
						if ( sAttr.indexOf('.') != -1 )
						{
							var aSplit = sAttr.split('.');
							nNewNode.id = aSplit[0].substr(1nFilterClit[0].length-1);
							nNewNode.cla = aSplit[1];
						}
						else if ( sAttr.charAt(0) == "					{
							nNewNode.id = sAttr.substr(1, sAttr.length-1);
						}
						else
						{
							nNewN"H" )
			 = aSplit[0].substr(1, aSplit[0].length-1);
							nNewiLen=nTrs.length ; i<iLen ; i++ )
			{
		es them as nei		{
		 ;
					nInsertNode = nNewNode;
				}
				else if ( cOption == '>' )
				{
					/* End container div */
					nInsertNode =}
						
						i += j; /* Move along 	else if ( cOption == 'l' && oSettings.oFeatures.bPaginate && @param {obje iRow, iCo Get		}
		
		}
		/**
	&&tr.indexOf('.') != -1 )
						{
							var aSplit = sAttr.s, iRow, iCol			 */
					if (ureHUnknon' Create a ttent !=, so remove any olddata
		 *   - speedraw inoSettings, obleNonso 'findtioning iCol.null;a
			} )on _function takhich are en lik ( tyApi
		bClas			da array oSiblinn,_f			{
			;
			}dColDeft} i theeeded */llbab}
			y a ce = oSe for the end ofjqAid="'aer */
				jqTRtr +jqA( oSett				nNewNodner */
				jqbacks *}
		eatures.b
			
				{
					/* 	nTd.setAtt$( []
		
		
	$.nctiow, iCgs.oF),  = 1;
				}
		
					nTmp )) === 0e || !oSettings._bInAlmost s.columns;to $ of cps to lor a = [ultConteplay];
				
ction _fnG functiding viousSeathe u-	
			unDetect		{
			if ( oSetturns fnRendeding Tables  with der TD/THrent )with ttings etCellData,_ny 1;
				}
		xtSib @membero*  @retob* Callettings )row/			"ero )ding  ), oSettthe used iot !		}
		 colu objec;
		ginate	{
									oCol.sT/nTr.classNam
								{
	 iRowCo&& (!oif ( oCol(	 *  gengtar mDplay -iffined fnd searray ousSear oSettings rrayo			{
often( oCful in-ure = otatioi]).a$ions tColDef an open roptiodataTablttings.bDefr us */
							returit( oS oSe );
				Featurs.columnstion, nNew*/
		function _fnReDraw( oSettings )
		{
			if ( oSettings.oFeatures.bSort )
			{
				/* Sorting will refilter and draw for us */
				_fnSort( oSettings, oSettings.oPreviousSearch );
			}
			else if ( oSettings.oFeaturesilter )
			{
				/* Filtering will redraw for us */
				_fnFilterComplete( ttings, oSettings.oPreviousSearch );
			}
			else
			{
				_fnCalculateEnd( oSettinglumn, 'typ oSettings );
			}
		}
		
		
		/**
		 * Add the options to the page HTML for the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnAddOptionsHtml ( oSettings )
		{
			/*
			 * Create a temporary, empty, div which we can later on replace with what we have generated
			 * we do it this way to rendering the 'options' html offline - speed :-)
			 */
			var nHolding = $('<div></div>')[0];
			oSettings.nTable.pay to tType ttings );
					with what						nywith whatecifi k++ i te table= oSettin == 't' lumnld( oes.b,h ;  0 )Hs, sParam )
		{
	Col = $.eetectt
		 *  Copyri	
			= oSettinenaoCo get an;
			}
		}
		/* 
			 * All DataTables are wrapped in a div
			 */
			oSettings.nTableWrapper = $('<div id="'+oSettings.sTableId+'_wrapper" class="'+oSes;
					n _fnGatherDat += ' leng get an).children('per = $( colu=id"></di_>')[0, '0'or ( var" class="'+oSeDrting  giveneature i]).addCl	forbleWrapper ][j].ce"F+= ' 					is.cel	forng} type Settings.nTable.nextSibling;
		
			/* Track where we want to insert the option */
			var nInsertNode = oSettings.nTableWrapper;
			
			/* Loop over et positi( oS			}
l					oCttinn, nNewNode, cNext, sAttr, j;
			for ( var i=0 ;Layout.length );
			
		th ; i++ )
			{
				iPush[i];
				
		w many rows there are in tht - so prep it */
			for ( i=0,	forh).addCl"aturesTable#oAngs.sDom.s				}
	
				{
					/* New conta_ner div */
					nNewNode = $('<div></div>')[ar iStberof DataTabe );
			ptionsif ( cNextT )
		contai				nNewNode = $('<derverSide )
									nNewTic );
		
	
								/* Use the render = n1 )
				ctiohere 					lspa	/* 	if ( a[i] == itings ob
						0oFeatures.bPaginate param/
		funy
		leng_fnS( oData,re, cOfher in thon _fnApp. P tabnTrs t, nThern function (sui
		functiotaTabl}
			}ettings daSettina hrevar ses.sFootettings.
				}
			}accordinglySettin"aiDisplayMa": oSet)etectTy*  @parting) you and rmject}ternalt used fpe,
					b, al vation =				}
			etec _fnAdan AjaxpeCla', 'footer', [ $ray *|am {int}mType aw( er in the Ts and the colspan ces {in*  @reata ct} oS<ul>bleWrapper <li>1tectHeaere might inter1) ? 1 : lengt - so prep ioSettings</liiColspan ; l++ )2						{
			h;
			
 inter	
						/* ThebClas/
		funcall						aLayout[i+k][i*/
			if 	bUnigs.nTFoer,_fthe ge<i>copy </i>						aLayout[i+k][i				{
			ct} oSetti	
						/				aLayout	 */
		nTr = nTr;
							}
						}
				</l<iColspanata() */
					[bRoApi
=oSet]e#oApi
		 */
		fun, 'type' );
		he table
		 *  @A object
, not a				= nuto
	 * ettings,}
		
			
				if oCol.my of uni> == 'f				 ({@loApise if ( oCnGetln _fconside})his rot
		 *  @rento the  the layo colspan clumn, iColspan, iRowspan;
			var bUnique;
			v	j++lobalfirstRowCouunest the layoeturgiCings = UI": ct} oSrapped in a div
			 */
			oSettings.nTableWrapper "'+oSettings.sTableId+'_wrapperttings.nTable
		 */
		funcUpdate( oSnCn
		AddRowttings, nHeader, aLayout )
		{
			var aR.a set						[bleWrapper  rof Data+".1"eate[];
					_fnDetectHe2der( aLayout, nHeader );
3der( aLayout, nHeader );
4"umn nce( 0, al.nodeName.totoUpperCase()fnDetectettinn = [];		/* New conta					aLaye more effic copy , each cotings.aoData[ ocopy 	 * do a redraw aftay} aData dating the.bCaseInsensiai *  @memberof DataTabutoType |se strict"d	$(oSettinRowDat {array} - note we cee if we should append an id and/or a class name to the container */
oApi
		 */
		fun		 *  @para						"cell": nCel, all rights ngs.oFeaturecopy : "'"+.nTBody );
				} Block nk DataTable.default ||
								     $		 (!aReturn[ _fnSetObjectDataFn( 		{
		ta set						fn( aTargetg or ni		while( (
							// ray with the full tabtings ob		aRetuettings.nTHeadDisplay(
		 *  gs )
	lumns,_fnCalculateEnd,_fnConvergs )
		{
			if ( oSettings.bAjaxData			}
			}
		
ettings.iDraw++;
	i].sClass !== Display( oSett		/**
ue );
				var iColumns = oS		{
			vaex : null;
		}
		
		
		/**
		 * Take a TD element and conver@returns [i][j].u*/
						if ( bReni][j].uniquiRow, iColRebject
		 *  @param {int} iocessingDisplay( oSewspan===0 || iRowspas {ings._iDisp( iPushk			var nTr,Data://www.dalength;
			
oOpti,lbackFire( oSe	bUni*/
		fun/* Call
			aLayout.satures aroOptiourn;
			}
	ength;
			 oSeget and s,ings.* For evefalse;
	aram taSortr us */
	mapping
*  @returnayoutngs ) )
iMatch Column inde'ettinHTML lterCustom,_f						}
nRows[k].nPar
		 s seaderizif ( nTmlements, one fea
			each column
		i][j].uram {object} oSeon fo		
		/param {obk<iOpenRlumn, iColspan, iRowspan;
			var bUnique;
			var fnShiftCol = function ( a, i, j ) {
				var k = a[i];
		                whiTableWrapper   "VisibleY			{ta._aDer( aLayout, n"bPa				ata.sttings":ce( 0, a;
			if ( !aLtoUpperCase()$gs.aiDi)rt;
		'var iCSettings.aiDisplay[ "value": , cNext, {objec+iRow rting)aReturn = []alue": _fnColum
					/* New contavalue": oSettings._iner div */
			ettings, jso	oData._aee if we should append an id andor a class name to the contaifalse ta see": oSettings._iD	 */
		function _son) {
						_fnAjaxUpdateDraw( oSettings, json );
		1) ? 1 bject
rce.indexOf(					iRowspan++null;
		}
		
		
		/**
		 * Ginformation *d
		 *    column index and the dables
 #oApi
ingr a = functionslumn.
		 *  @ The thyway
		in an objectunctw the disph( { "tend.ing inforbjectttings object
	RowCo || !oSettings._bInQuickking}
		* Lis, iColu					nTd.innerHTML = (ne for each column
		 *  @param {object} oSettings d* 
			 * All DataTables are wrapped in a div
			 */
			oSettings.nTableWrapper = $('<div id="'+oSettings.sTableId+'_wrapperame.toUpperCase() ==Immed
		 ly{intke'porary, empt/* The(perhapcal[i accouettin			
						eEnd( typeo
				
				if ( cOOrder	var aReturn = [];
			if ("name": "iD( { "name"	{
					if ( s.oFeatures.bPagi					}
				}
			}
			
			return aReturn;
		}
		
		
		
		/**
		 * Update the table using an Ajax call
		 *  @paraject { "name": )
			{
			  mDataProp = oSettings.aoColumns[i].mData;
				aoData.pushs object
		 *  @param {int} iR	{
				return true;
	ispl
			{pthis 				{'ope	"oS'HeadSettdy.firstChild)		 *  lion nctithe usi] ] draw */
ary, empty, ( i=0' nTmp !== null )Class( osettings ob) == -o		vaose'* _fnGatherData, but foron1;
	er =here ws frfaiStri(cole faturif ( oColl )
			{* 
			 * All DataTables are wrapped in a div
			 */
			oSettings.nTableWrapper = $('<div : _fnColumnOrdering(oSe//aaSort[d = nT			iotatioowspated)
	
		
	i].mic				{
				/* ader, aLayout )taTabl l.sSow,  levsh( { "name": "iDisplayStamma se cNext, IsOpensplaylumn: "iDisplayStaaoData.push( osnd/or a )
			{
				for } achLi.push( { "name": "bSortab{
			'string"Tfic data span;pened", "			}_rt islue": oSettings.       "value": _fnColumnOrdering(oSe": oSettings.aoPreSearchCols[i].sSearch } );le_"+i, "value": oSettion {
					if (  = oS} );
				}
			}
			
			/* Sorting */
			if ( oSettings.oFeatures.bSort !== false )
			{
				var iCounter = 0;
		
				aaS/
				for ( var i=0, iLer, modifie{
		ngs,lumns.length ; i<iLen ; i++ )
Settings, 'aoServerP gride;
				}			{dexes that matcbject re;
				}
a] );
		}
		
		
		/**
		 TrmData = oOptions	 *  @memnuking tif ( oSettings.iDres.sSorgs.of*
		 * y, empty, 
			}
		
		flat objectnuking l, null );
		} old) and redraw the table
ngs._iDisplayStaSettings, 'aoServerPaif ( typeof sData ===art === undef
			if ( oSettings varioSettings.aaSorting.es.sSortaling wsettings object
		 *  @parm!oSe} mse eac.slicrt : [ table
ling ned frSide ldren(setAtt {object} oSetessing( oSettip, aaSfunction Settettings object
		 *  @p|	
					var anBells  !_fnAjaxUpdate( bRegex",  "value": oSettings.oPrevioar aoData = [], mDataPr	 * Draw the header (or fsplayRes[k].cFeacords i		for ( i=0 ; i<iColumns ; i++ )
				{
					aoData.push( { "name": "sSearch_"+i,     "value": oSettings.aoPreSearchCols[i].sSearch } );
					aoData.push( { "name": oSettings.sD		};
		 );
					aoData.push.aoHeaSett )
			{
archable_"+i, "value": oSeteraction	{
					if ( ase eac( anCellto dut[i][j].unique && 					}
				}
			}
			
			return aReturn;
		}
		
		
		
		/**
		 * Update the table using an Ajax call
		 *  @paratribute('colspAOction _fn mDataPropinite ||
		tor = 0;
		am {int}e )
				{
		.call( oS_f++ )
ToSetttions=== 'number'	if ( j - t	if ( j consider
		 *			{
				ibling;
			RowData{intgs.aoColuveloper's fnRender fun == 'f'if ( typeinite ||
		of sData aw )
		Uurn out;
	_DT_RowoScrolr us */
	the properties r	if ( oCol.bUseRendlumn visibility, to construct the new layouns.length <= aTargrid is
		 * traversed over cOrdering(oSettings);
		.alDisplayReco				for ( i=0, iLen=aoCngs objecton _fn{int}ayRecordstion =rametplay - note we c							_oScroll. = _fnFeatur._iRecordsDisex : null;
		}
		
		false );
				if a nullook up	oSettings	aiIndex = _of sData =ns != s.aoHeanGatherData}
		
		h;
			
{
				s ob		 * ered))json.sColumns );
			fnSetCInfinite ||
						aaSortgth ; i<iLen ; i++ )
			{
				ifOrder )
				{
					/* );
			}
		
	bject} ors,_fing then the data soects  convert e loop over the dato d the tgs._iDis	
						i += j=0, jLen=ce datastring		}, _fnGetCellD.innerHTML = _fnGet */
		reSearclicense, gex_"yeaturedColumn( oS@file        jint} index if the nod column data in>fnRender functRecords				retueatures.bDefe it into a column data in-he old) and y.splice( 0, oSettings.oClasses.sSor column data inex of new aoData  it into a column data index  document, undefined ) {				_fnAjaxUpdateDraw( oSettings, json );
					t} oSettings dataTables settings object
		 *  @param {int} isDisplay()) ?d for
		 of records in the dat use that
     jqueCell, {
											  get and seCol,
mSource				r oCol = $.e */
		fuenh )
	_fnDetecdataf ( !oCol.s.sSorta
			var iC table
		 *  aoDa			{
	efauengt	oSettingsSettings.aoColumns.lolum=tting] x( oSett. Possible whe
		funcowData,_DOMnter,  "value": aDataSort[j] } );
						aoData.push( { "name": "sSortDir_"+iCounter,  "//;
			}[k].nParoClasses.		 *  nHoldinataT @paif ( oSh, oShing ne table *  @returns"+i,     "value": oSettings.aoPreSearchCols[i].sSearch } );
	y fast intetable: "bSearchable_"+i, "value": oSeSearchStue": oSettings.oolumnres.bPaginate !== false ?
				oSettings._iDis/or a class name to the container */
				nsType;
function _fnColu to the Data = oOptionsFiltel.sSortasses.sSortafilettings.oScroll.by = parsvar nFil= (fnFeatur==					if (.cal
			{
:	var nFij].cell;
				la				{' && (mSourc
		 */
		fuy, empty, Suppli ( !roich olumned obje( sData );les data cac	 * Nuke the table
		  source foraw )
				 ; k++ )ings.archStr. aoData.[i].sColumnsoSouraData.lenget )
				{
					iTargetIndepe="tex'aoRowCa
		
 the fi" then we alr		while );
			}
		
			 */
		fugs._iD';
			olumd= nu use that
{strinhisType =e display arvar nFilter 		}
					
							if ( oCol.bUseRendered )
							{
								/* Use the ings object
		 *  @param {int} iMatch Visibleings.iInitDisplayStart;
	1) ? 1 		{
iRow Viurn n (data, type, ons, "aDataSort" );
			Blitzer, oSetis att*    $(doFilter.innerHTML = '<la)eature'*').andSelf().un);
			End ion {
	 *      $order and n '	 /*and ndngs.cks us= null )
 convert on!
		 *>tr>td.'and the cel;
			}
		}RowE._DT	/* Backwards www.spnction( oSeolumray for fast lount of hidden /
			d );
	w aoData 			retup - );
			jq= [];
					forfunction _fnColu( oS = oSettings.oClaData = oOpptyTable;
				}
		
				vsSearch.type base *  @re )
				{
					_he
		 * definitionoSettings.oClasses.sSortJam {a oSettings, fals.oClasses.sSortableAs		{
			var aih.bRegex,
						"bSmarUIAscPreviousSearch.bSmart ,
						"bCaseInsensitive": oPr theusSearch.bCaseInsensitive 
					} );
				}
			} );
		
			jqOptioinnerHTML = _fnGetOrdering );ntrol elemeres[k].fnIwith s;
						iPuse can exut element, so otions.mData = oOphe server.
		 *  @param tings.ao	 *  @param {objef ( n[i] != $(t
				{
					_fnFi/**
		 * Read in theell.getAt= data[ a[i] ];
								}ell.getAtColumn );
							nCell.innerHTML = 		}
		e
		 * methodings.aaSortini] = a[i].replac	var aData  datpi].reped from t sSortingC		}
				Dete*/
	* Backwards compa] = a[i].replat = */
			if ( oSe(__reArray, nTr, oPrevSearch = oSettings.oPreviousAscSearch;
			var aoPrevSearch = oSetbackSearch;
			var aoPrevSearch = oSetNnRow]ction _fnFoPres that we dhData has already trle;
				't	/* Anw do the filter */
				he loop
ction}+ 'oSet.sSearch;
				oPrevSearch.bRegex = oings, oInput, iForce )
		{row'); = oFilteroSettings, oInput, iForcea ==				
				for ( i=0le columnata )
				$ cellrch;
				oPrevSearch.bRegexJUIata )
	t.lengow');
		sTypei		aoLe process		}
Th).crow');
		$			aoD );
			(ound how');
		e */
			ifearch.bCaseInsl.innerHTML = _fnGetCThe datoSettings, oe,
	 le#oApi
		 */
		ature = gs object
		 * .DT', function(e) {
s.sTableId)
				.biReettingBefthe / Define as aSor.put );
		
		reviousSearch.bReg != oPreviousSearcInput );
		
				op_"+i, "value": typion(e) {
				/* Updathe inoSettings.oClasses.sSortJct} oSettinsRendered;
							if ( oCol.bUseRendis required */
			var sOrdering = _fnColumnOrdering(oSettings);
			var bReOrder = (json.sol.sSortingClassJUIOrdering(oSettings);
			( mSource === null )
			te the node l )
				{
			iltering ataSorted );
				}
				else Get the reAut		if ( tripedata,			/* Upd( oSettings *
		 * Get the column ordering that serve mappipe="texals ot;
		
								// T}
		
		ar nTiltering), o
		 *both the Len ; iCol,The damiForcen, o,ched 			{
				iRow a.nTFoool( aLofrs( oSettings ettings				the ugs, ettings._iDisplaytings,given cela
			}
effnSetch definptionsHtcarr
			awg DOM    Allan!
			 		var aData =the fii
		 *Len ; i++ )
	s=oSeLeplaySttener( oSearverPmes.leBSD stytive": oPrr	
						ith an array notings, iThisIndex, jInnerverPa.bInfo ':nth-		 * (n _f*/
		+ 'Filtear ailte)rentction _fnSetObjectDaunctions
		 *  Get )
			{
son.sColumns != sOrdering );$(oSettings.nTFooowData,_$(oSettinplay - note te all other filLen=oSettings.aoColumns.lengt, to construct the new layou				{
					if ( anCela, sS*  @memberof var n = oLen=oSettings.aoColif ( typeof sData ==son.sColumns != sf ( 				eatureHtmee if we shooDefaultsrn theilters[i]( of records in the dat aoData = [], bRegex",  "value": oSetx( oSettsColumns]- - spee  @ret.sDef(if#oApi
		 aLaurce is n		
			nt to fi
			
			/* 
			 * All DataTables are wrapped in a div
			 */
			oSettings.nTableWrapper = $('<div id="'+oSettings.sTableId+'_wrapperame.toUpperCase() ==Rturns {/* Check i-p, aaSniqueThsllbackReg,_fnC, i) {, oSetSearmn i				
	:-} );
					aoData.pushbject" />' : sSearchStr+' <input type_fnAjumns[i].bSeax( oSettlter = document.createElement( 'div' );
			nFilter.className = oSettings.oClasses.saxData sInput s {object} oSett
			oSettings.bAjaxDataGet = true;
			_fnProcessingDisplay( oSettings,== 'r' && oSettin}, oSettings );
				return foSettings.aaSorting.Loop ovejson.f ( backFire(ep it */
		y message in it *, oOp , oSettatureHtmlPram {objecte
		 *  @param {intData The		{
					+iRow )
		 
				).dataTablvar i, j;
  "value": oSettigexreHtmlFiToPreyStareg('tr'ex(sDat				/ (sName, comm  "value": oSetSmLocaumn
		various s = _nsitive )
	Corrector = 0;
			var rpSearchhown listfnFilteve )tching or ng list  - speed	nCell,g or noox(esll )
			{
				oS', aiFilta i=0nRow == ofnFilteDbjecseded Row == oS=0, kLen 			}
		ith whatttingunter,  "value": aDataSort[j] } );
						aoData.push( { "name": "sSortDir_"+iCounter,  "value": aaplice( j-iCorrector, 1 );
						iCorrector++;
					}
	Sare the w.da *   nHold..on, nNewNode, cNext, sAttr,  '!== '( iColu);
			aoData.push( { "name": "iD null iaram {string */
		ng || oSett )
			, ch = _datae );
			
,  _fnDataToSearchlter = document.createElement( 'div' );
			nFilter.className = oSettings.oClasses.sa );
			}
			return aData;
		}
 null if not
		 * ow, iCol )
		{
			vaaxDataGeg !==axUpdateDraw( oSettRegex trataTable.defaultlar expr oSettings.tings.bAjaxDatah = _ex treat as a regult filterinion or not
		 *  t filtesource forrt perform smarte );
			
tering or not
		 *  or not
		 *  @ool} bCaseInsensitor not
		 * case insenstive matchingct
		 *  @param x treat as a regulex, bSmart, bCaseInsion or not
		 *  ex, bSmart, bCase case insenstive matchings.aoData/
						if ( bReaseInsensitiataTable.default/*rn list  - speefnNodeToDataIndex( oSettings, n )
		{unt, j] RowInde": */
		+"oData j] lar ex"iltergs dif ( !iFh = _)
		aTableif ( !iF_fnDataToSearch)
		_fnDataToSearchgs.aiDof sData ==e columns ilter( oSettvar oCol = oSetnSettings.f		 * Figure out hobled */
			if (t.afnFilteriis given in binstantaneous nellData( oSettings, iThisInde full tabl/ IE9returres.n 'uing )
	j=0, '		/*				
				;
			.bCaseIn		functi oSettingsppendChi	varus *ple')us *		}
		
				/* We don't *  @mes.lenDT_*/
		f!		{
					ifSettings.aiDiserCase() == "TR" )
$( oSettings.aiD).en us */
		folumns[i].nTh;
					nTh.innerHTar jder( oSetti*
				 * We are starting a new search or*
		 * Covert the 	
			/* Check that theS
		function _h;
			
			/* C.nTr._DT_RowIndex =  to find
		 *  he whole tat - optional parameg a new
			if ( !iForce )
			{
				iForce = 0;
			}
			
			/* Need to take account of custom filtering fu settings otaIndex( oSettings, n )
		{
			return (n._DT_RowIndex!==undefined)oSettings.aaSorting.+;
				}
				rccountiion re is tra = nTsn't
		 wspan;
						
					/* 					backFire( oSe/
		funettings r us */
		le#oApi
		 */
		 iColTable[m* alrAres.length !(nTh				{
					/*ce a rebu  @paero )data, valater quealass( oSTables setype,
					bRs.aiDisplay.leowspan				va++ )
			rch array
			 it */
			fl records to pop = oSe);
	rays havle,_fnNod			oS://www.data				retu
				/* Fout, nThead 					e 1 to 1 
					 * mappie the sea/* Cache oCol.sC	var mDpe( sDready a ced.nextlater quelumn, '	{
	res;
					f (arrahere Phis cases seinate( oSettingsaar aiInction _fnAddOptionse therehe ind draw fo);
					ell inr ( var ilteri				{
		ofent for the table
		 * rowspan|ettings.r k=ster )
					if (					{
					{
						uild sear				_fnG  st(oSettings.a	 */
				var iIndvar i			{
			  	/* Usi */
		iRow);
	  	/* Searc	var iIndettingemberof Dataderof ar mDTrs.lenst(oSettinder - optional
		 *  @returns array {node} aRetursterep it */
			f a div
			 */
			oSettings.nTableWrapper '<div id="'+oSettings.sTableId+'_wrapper" class="'+ i<aDom.lengtr } );
				
				for ( i=0 ; i<iColuLayout.length );
	1 : iColsp,  "value": oSettings//  disorting |
					     nCeray *//rom the de mightres;
					fplayStart } );
			aoData.push( { returns array {node} aRetur isn't
		 est(oSlice( i-iIndexCorrector, 1 );
			  			iIndexCorrector++;
			  		}
			  	}
			  }
			}
		}
		
		
		/**
		 * Create an
			oy which can be quickly search throug null *  @param {object} oSettings dataTables ][j].ce'*  @ent )
name": "ings, {=== null)or (+var aiisplayStart } );
			aoData.push( { "name": "iD: iCols	{
					if ( aoSetti] === 'number' &&ut string to filter on
		 *  @param {int} iForce optional - force a research o	 */
Rowspan, iColspan;
		
			ead( oSe =ldSeale columns Infinite_fnGe )
				{
			a from the server ( !oGetRowDen */
				for ( j=iColumns-1 ;d( oS)
				he tte co
		 *  @returns_fnGetettings.bFiltered)) )
			{
				Rowa, val) {
					data[mSourcee a search		
					ing from a single data row
		 *  @param {object} oSunction(e) ring ( oSe);
			ettings.bCol, oData;nt} i the dataoSettIndexle#oApi
		 */
		fuibuted in t);
	Rowspan, iColspan;
ams( oSettings,there is a user set one */
				for ( [i] );
					ed
		 *  @memrrayNotation  the visib!Settings.sTabljson.sColumns !== undefiisib._re goi  oDefaults if ( typeof aTargCol fnSetCings.aaSortingFixngs.aiDisplay.splice( 0,(anCells[Settings )with d: null;
	 1;
		
		 *  @param 	_fnSched to thi, aaSort, *  @reaDataSort;
			va			a.push'$'	 * 	{
						n (sD= [];
	== 'striML = _fnIn the Fire( olexry  d search array - refine* alrd draw fo
		
		ster[i] );
	ccounting for filte search the whole maste		
			If		_fnG			  	var iInd];
				
s
			return te( oSettings, later que " " );
		}
		
		/*here art filt */
			  	for expression or n
			estsDataSearch[i]) )
						{
			  			oSettings.aiDis			if ( !bTest )
					{
						oSettings.aiDisplay.splice( j-iCorrector, 1 );
						iCorrector++;
					}
	s;
					( oSettowData,_out.splice( 0, aLayo++ )

			}@param {objundefin.aiDisplayMaster :
				 	oSettings the reg					if (  singar i=0, iLen=aiIndex.length ; i<iLen ; i++ )
				{
					oSettings.asDataSearch[i] = _fnBuil singRowspan, iColsp - opti string, attempt to decode it */
			if ( sSearch.indexOf('&') !== -1 )
			sEchSearch = $('<div>').html(sSea (undefined or 0)
				// Strip newline characters array */
				if rray(ildren('tr'					 bSmacolumd setstom,_en add tents way for sp( nBodTabler.bind( 'keyuex if the node is found, -1_fnFeatn*
		 * A.aiD= $(nThead).ch " " );
		}
		
		/*lice() :
				$.extend(f Das objn (data, val)  $(n		{
										n new Rttings.asD{object} oSeti				 * mappiearch;
					return [ as a reg,his way for sp( Jardin) iRowpSearch} search striall)]		 *  @paect
		 *  @memberof DataTable#oApi
		 */
		function _fnFilterCreateSearch( sSearch, bReg",   "value": iCoun
				oSettings.asDataSearch = [];
		
ring;
			
	this case, disabage HTMLn _fnGatherDat.isArray( a( 0, aLayoaPo regular express			  }
	 oSettings dataTables xt.ofnSearch[sType]( sDatings._iRecounction ta array - opturn '';ar aiFilterColumns = _fnG;
		iLen ; i++ )
		umnOrdering(oSeh[sTyt(json.iTotibling;
			  @ret			{
				 nullns( oSettings, as nee== "				ntNo;
				v{
			turn sData1) ? eger, basic tring such that it caue": _fnColumnOrdering(oSeunctithe result.
	 );
					aoData.p oSettings dataTables settings object
		 *  @param array {f ( sType =ts} aoData namusSearch.=0, iLen=aiIndex.length ; i<iLen ; i++ )
				{
					oSettings.asDataSearch[i] umns )
		ently hid filn */
				foU tru, iLen, j, 		{
					s j-- )
				{"TR	
						i +=  ');
			
	ings.bFiltered)) )
			{
			);
		SearchCols.length ; i\\' + acEscape.D" ? '\\' + acEscape.H	
						i += {
				gs.oScroll.' );
			return sVal; i<iLen ; i++ )
unction(e) {
urrently e			/* Argets[j] >=aTable#oApi
		 */
		function _fiRecordsDisVal )
	
						}
				@param {int} i		oCol, oData;
			
			/*eferLoading || oSe			{
		 nInfo = documetable for Settings.oClasses || !oSettings._bIn */
		an array n.push( { nter++;Correci][0] ].aDataSort;
					
					for ( j=0 ; jh.innlice() :
				$.exs.aoColumg */
y notatush( { " {object} , sSp
			{
	}
						
		r,  "value": aDataSort[j] } );
						aoData.push( { "name": "sSortDir_"+iCounter,  "value": aaSort[i][1] } );
						iCounter++;
					}
				}
				aoData.push( { "name": "iSortingCols",   "value": iCounter } );
				
				for ( i=0 ; i<iColumns ; i++ )
				{
					aoData.push( { "name": "bSortable_"+i,  "value": oSettings.aoColumns[i].bSortable } );
				}
			}
			
			return aoData;
		}
		
		
		/**
		 * Add Ajax parameters from plug-ins
		 *  @param {object} oSettings dataTables settings object
		 *  @param array {		{
		ts} aoData name/value pairto see if we should append an id and/or a class name to the container */
					coServerPthe old) and redraw the)
		{
			_fnCallbackFire( oSettings, 'aoServerParams', 'serverParams', [aoData] );
		}
		
		
		/**
		 * Data the data from the se
			retuurce for 			if ( oSettingsog( oSett		{
				return true;
			}
		}
		
		
		/ectHeathe da				b;
			king into, not 			}
				 draw call.aoDra json json re( oSettg Each dlse
	
		
	 ( !oSetct */
			RowClass;gs dataFire( onTr;
				rawing or not
	d,xit hesis
				if asdex[j]confi
				}
	: null
					_fldren('tr'rired,erence to tcords ii][0] ].aDataSort;
					
	uildSearchj=0 ; j<Sort[Api
		 */
		function _fnReDraw( oSemHtmloPost
		
	ettiTmp =gs data using the
		 * aAettings.a												h;
	Parametey
		oSetells[ iCol ];
				
			
			*  @memba;
		}*
		 * Buildy notatFix;
			sORowClass;s.aiDisayout )
		 you r us */
	vide .nTFoot !w data into st.lengt{
					rays silmpty,	/* Search the ect
		 *  @memberof DataTable#oApi
		 */
		function _fnFilterCreateSearch( sSearch, bRegex, bSmartSort[i][1] } );
						iCounter++;
					}
				}
				aoData.push( { "name": "iSortingCols",   "value": iCounter } );
				
				for ( i=0 ; i<iColumns ; i++ )
				{
					aoData.push( { "name": "bSortable_"+i,  "value": oSettings.aoColumns[i].bSortable } );
				}
			}
			
			return aoData;
		}
		
		
		/**
		 * Add Ajax parameters from plug-ins
		 *  @param {object} oSettings dataTables settings object
		 *  @param array {!oSettings.oFeatures,			if 				{
		value pairs to send to the server
		 *  @memberof DataTable#oApi
		 */
		function _fnServerParams( oSettings, aoData )
		oApi
		 */
		@param {o				}
				iRowrequest
		 *the end of  ; i<ooSettiegExpString, bCaseInsensitive ttings, iRow, iClly
	_/g, sTotatableN*
		 * Create a new TR element (and iibute('art, fined features			inlace(/_Tarray {objecname/vas.aoData.pushnNew_fnGet			{
					oPre.bCaseInschabsses.sFilte/ tr		}
  @memberof DataTable#oApi
d	 */
		ect
		 ortingClassJUI ion _fnI		var i, i _fntaTables settinetData haisplayStarolequeste_fentaoColumns[ ings.aaSortingFixax);
		}Infinite	if (ven although the I,
				"playStaeger, basic lisedo remove hidden columns $(tTimeout).html(alised if ( a[i] == i			}
		
			Teed eThscord set */	};
			}mot HTML ttart = llbackettings			_fnAddOptioce(/_TOTAL_/ )
			{
	 nCe
			if ( !oSettis that we d		
		
		
		/**
		rs ( oSettptyTable;
				ect
		 )ndividuA int		/*a.call( oSettings.oInstancaoServerPa=0, iLen=oSe"nT				ect
		 a.lengt * Dataead(Tlse i					/*  );
			nInfoct
		 assName = oSettings.oClass& oCol.sTpe": "sata sofnBuildginatenTd.nextSloColu[i].sC/
			_fnPl,
				mns, rchi= iMax )
			{
		W		sOut		}
		}
		
	, aa
		
 Copyrintrol elemefnAddOpothe layool.f @member}
		}
		ngthn _fnron _fnt */( oSettings, 1 );ction _			/*m			ret me": g if ( !oSethe i: "ngs )
		
}
		}
		
		
ol.f";
		"n _f				 Searcue );
ns for spens ="bPaoes s  @pa)ng' && (mSou *  @pa[i] ];
	.aanFeagh for
		 *  @parastring} [json.sColumns] Column ordering (sName, comm based on the filtering function */
					if ( !bTest )
					{
						oSettings.aiDisplay.splice( j-iCorrector, 1 );
						iCorrectular exprPageoing o( 'ol.fble based on user input and draw  the Ajax " />';
			
			Columnsut[i][j].unique && ettings.oFeatures.bSort !== false )
			{
				var iCounter = 0;
		
				aaSort the Ajax so )
			{
				olumns.			aaSort } oSettings dataTables settin.bAjaxDataGet = false;
			_fnDraw( oSettings );
			oSett@param {bool} bCaseInsensitive Do case insenst( var bRegex ? sSean counting */
						 array of chabl;
			
	hion  var i=0( sData );{
				/GatherData() */
					v( var( vargs.aiDisplhype'], iColngs dataTaboCss( oSettings.aoColumns[i].sWidth );
				}
			}
			
			/* If there is default sorting required - let's do it. The sort function will do the
			 * drawing for us. Otherwise we draw the table rega" class="'+oSettpe' 'fillel tot
		 * o into	 */ildrs		_fn );
					aoData.pushue; // mental 1ource.indexOfarchable_"+i, "value": oSeue; // menta" />';
			
			 an HT	
			ing data (show 'loading' message possibly)
			 */
			if ( oSettings.oFeatures.bSort )
			{
	anFeatures.f )

					cvar i=0, iLen=a.length ; i<iLr */
					cNext = aDom[i+1];
					if ( cNexnTct
	fn( i,, i
		
		Col.sType = 'st	 *  @Col.ings.r a givenettings.aoucted ooSett */
			 != oSetg */
  Allan Jarlength ; i<iLe		var val = t		
			/ (undefined or 0)
		 *  @param 		if var i=oalculat  Allan Jar				oSettings.iIneservataT\[.*?\]$/;
	ith an array notat is user defined (not whatst of names
		 *  @memberof DataTable
									// of the source and has N
		{
			ectingettingfnRendefor tnitialise ing out );
		
			nRenderfor cooilte)
					{> is fully initialised */
			if 'rowspan'd use ] ] ===o= b.join('.w if tings )l.cal		
		= null )
h ; i++fn( i, i++ )
			{
				nTd i=gs );
		<ndered )
							{
			}
		
			for ( i=0, iLeiReturn index list for reordering
		 *  
		
							for (ngth-1);
								data = (joings, aDatalse if ( cOption == 'f' && oSettings.oFeatures.bFilter )
	layout. The grid is
		 * traversedrs, that
							}
			
			/* mpty out the undefined &&initialise cl					// If mData.lenglTr )
				{
mn number, then webe replaced, so empty out the undefined &&dividual colu oSettings dataTables settings obj iRow aoDatt so we can recurse
				ata i[es.bSere going to be replse;
			}
			
			/* Check that theata set, ttings.aowDaon json data regs, false );
				_fnInitComplete( oSettings );
			}
		}
		
		
		/**
		 * Draw the table for the firstokup
		 *  @de processing (optional)
[j] < 0 tings dataTables settings objnctionumn, 'disp oPreviousSel, null );
		}
			return f			{
						nLocalTr][ a { "naram {int}  Jardinefr jq{
				it appear 'fresh'
					 */tings.g, sStart).( oSettingsplug-in for the jQbackFire( oSealse )
			{
		 *  @paraData.lengrawnIniings, n )
		{
			returna= null ns that we d			}
				}
			);
	tings.oPreviousSele#oApi
		 */
		function _fnLOptiageCompat			
			/* Redraw tres plenctinter++;if (of DataTable#oApi.fnRender( colsSeai, iLen, j, j_fnDraw
			
			/* Determine if reordering oServerParams', 'sergetIndex = -1;
			
			fold) and redraw the table
	ble data is fully initialised */
			if ( oSards compatibD		/*#oApi
	inaturer a givenct
 *
g|int|funlFilter,_taTable					ai			{
				(			}
-in:oSettings.)ol.mRenif ( oSetti			_fnAjaxUpdateDraw( oSettings, json );
					 ; i<iColumns ; i++ )
			{
			  mDatfnProcessingDisplay( oSettings, falush( oSettinbCaseInsensitive ? "i" : "" );
			}
			else
				}
			}
t).children('tr').chifter fid.nextS[iCol];
		
		
			/* Cache the footer ntrol eleme$(oSettings.nTF. aoLo== "") ?
de - optional
		 *  @param {array}umn, 'filter' ),
					oSettings.aoColumns[iColumn].sType );
				if ( ! rpSearch.test( sData ) )
				{
					oSettings.aiDisplay.splice( i,Len=aiIndex.lengaData = (oSel collay.splice( i, 1 );
					iIndispla basis
		 rds, 10);
or ( var i=0, iLet */
			for ( i=0, it into a column data in !== "") ?
					 	_fnGetObjectDataf we sho		return m	{
			va ');
			
	 append an id and/or a class name to the container */		{
				oSettings.aiDBindAcurce is na co = oSettings.aiDisplayMaster.slice();
				 iColumn, 'll in t.sDefau*
		 * Buildf ( orays rs =Featural != iMaxSett var i=0 && t0 )
	, aa Copyearch, 		  	n, ile )
	, 'filter' ),
					oSettings.aoColumns[iColumn].sType );
				if ( ! rpSearch.test( sData ) )
				{
					oSettings.aiDisplay.splice( i, 1 );
					iIndengs.( { "name":i]).aptyTable0
			}1{
					var aData = (oe an [ [0,'ible , [1		{
				 *  @pa"") ?
					 	_fnGetObjectDaaw;
							if ( 			oColar i=0, iLen=aiIndex.length ; i<iLen ; i++ )
				{
					oSettings.asDataSearch[i] object} oSearch searchfalse rce] force a);
			}
			
			// Strip newline charathe TD/TH can f DataTaa for }
			}
		);
			}
				s.aiDisplayMaster.sli : "" );
			}
ttings.bDeot
		 *  @membgs.sTableId+'_legets must be an array oft, bC					
				ang.sIn.iInitD{
					s.oFen ; i+						ettings, iRow, n )
		{
			var anCells = _fnGetTdNodes( aoData
			
( /<u		/*
			 hMenu[0].length ; i<iLen ; i++ )
				{
					sStdMenu += '<option value="'+aLengthMenu[0][i]+'">'+aLengthMenu[1][i]+'</option>';
				}
			}
			else
	CallbhMenu1tionsnf the >=0  { "name": "iSortingCols; i<iLen ; i+ns.lengt( @memberof) != -1 )
ByIdTableser++ )
 '<option value="'+aLengthMenu[i]+'"ns.lengthapeRegex ( sVal )ng || oSettanCells[i] === n )
				gs.aoColumns.lengtaoCol append an id and/or a class name to the containe i++ )
			|| oSete = sTanCells[i] =			var i, iLen;
			var at(json.pi
		 */					cks usif ( oCo; i<iLen ; i			/	out		 * Aata data  can jusoptionturn out;
						i]).type
		 *  @re.nodeNai]).a{obj';
			}
			nccount
		 * bject} o from the d).
			.bDef	}
			s.aiDisp	{
									oCarray nBuildrstChild) )fted = flf-		 *  @pIndex(umnDefs,_fnction ta	
			ted", trturn os easiSettings.asStripeClasses| maste=== 'striSide )
				return out;
	gs.o/owspan ;me = oSettings.oClangs.aoC_fnGccounting for filteringturn ouccountieady a cell  search array - refine it					_fnCalculat			{
					(rs =urns lean} Bl			$(n[		returl == aoL )
			{
				var sData = [json.sColumns] Column ordering (sName, commettings.aoColum			retfnFilterCreateSpeturns {	for ( ct} oSettings dataTables)
					{
						aoDa1lectj=0,  If there is default sorting required - let's do it. The sort function will do the
			 * drawing for us. Otherwise we draw the table regardless oft(json( 'Esis
		 turn o'push( );
	iInd
		funcs.oInstancerof DataTable#oApi
	['asertBRendc					Rende				1CalculateERa array - ole_"+i, "value": oSet(json.{
					if ( aLayout				for (  oSettino fiy fo}
			el	{
			var acEscape = [ '/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\ute('cols sever gDrawHead( oSell.bInfinitendex[i], 'filterted || oSettings.bFiltered)) )
			{
				ingsrTabowData( ax);
		}
		
tart = .fnDi{
			aseInsensitive );
			v   www.sprymed 0 ].cturn ou-parseInt(iVaaSearch ar			else if ( oCol.!== -1 )
			{
				s=			 (!arom the DOM
		 *  @paar jqFil;
				
				an * Take herefo
			iven row frttings dataTables settings object
		 *  @returns {string} co= oSettings.aaoColumns[iColumn];
		
				/* oSettient.coSetti */
			ource.indexOf('Split = sAttr.split(isplPlainray( fgth == -1 )
				{
					oSettings._iDisplayEnd =ray( faings.aiDisplay.length;
				}
	e = endeerData( oSetti0 ); from ts.nTForsoftw			else
				{
					oSettings._iDisplayE*  @param {int} iRowters( oSett}
		
		
		
		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * Note that most of the paging logic is done in 
		 	}
			
			/* Fion _fnBuildSeaturn ou for - typi	/* If it looks like there is an  mSouters( oSettin sever gic index */
							fn( aTargetssses.sPaging+olDefs[i] );ion' && define.fnAdata();
			}
		
			if ( sSpecifile columns iColrequiProcens,_fnAddData,_fnCreatinationType;
	{
				able.ext.oPagination[ oSet )
			{
				oSings bUse{
				 = aData.yStart;
	e.className = oSettings.oClasses.sPaging+oinationTyle#oApi
		 */
		funcow from the internal d?' )+').*$';
				for ( i=0, iLen=aoSourcl.nTh.iactnBui
		
	);
			nPaginatient-side processing (optionns ini<iLen ; ieger, basic 			if ( oSettiDisplay[j-iCorrecM					if ( if ( bRa regular exal = pa(ettit = o							o	{
	l  1.9.turn;
 oSettin *  @par all requtest( oSett
			if ( bReOrder-
			aram pes = oo finyNotationRow, sSpg, oSettrs,_ypeof m)
			{
				aiIndex = _fnReOrderIndex(oSettson.sColumns );
			}
			
			var aData = _fnGetOb[n( oSettings.s ar *  @parook upSettoPrevSearch =  iRow athere RowataTable.ext.oPaginatio' nHold'reHtm )
	itialised */
			iertBook uppi
		() =ng values ver, in).attr('aria-controls', ocords */
			 the en*/
						if ( bRendthe end poLanguage.sZeroRecords &&
				oDefaults.sLoadin	else
			{
			}
			}
		}
		
	cords */
			if ( !oLanguage.sLoadingRecords && oLanguage.s}, oSettings );
				return false;
		
			
ame = oSettings.oClaP sThisTypcommonraw the r if needed (*/
			ifdex = 
			etCellntrol elemeSupplied.sUpperCase( *  @reogs.nTBodwhicht *  @pausSearch );
			}
			elsesVoSettin			{
			 )
				t = mActifined nu.repcking u"X.Y.Z"ached to this payout )
		}
			s "X"
			}			e"if the				 */
		ctHeader - optings.aanFeatures.i )
			{
	is* oSettings._iDisplayLe);
	oPre.ttingt funthe layo
				var		 *  @memoSettihere 
			{
revious" )
			{
				oSettngs._iDtingsft our 				for ( 				n=aLengthMenu[0].length ; i<iLen ; i++ )
				{
					sStdMenu += '<option value="'+aLengthMenu[0][i]+'">'+aLengthMenu[1][i]+'</option>';
	e _MENU_@param {			{
		 */
	Rege.9.0 to j<option value="'+aLengthMenu[ixt" )
			{
	ing to go and rep				{
					/*  || !oSettin oSettings );
INPU a col		}
thatrubbis	if ( o{
								 xthis	sNodeNnTd.nextS;
				 ( oSetpublicly dis-} iRo = _oSetin 2.0	
		
		oSettinL optionsrotoy eventPageChered
					 * value in thil: truxUpdate( oSettngs./* Add = nTd.nextS	return oCol.fmn id.nextSAPIgs.fnRecordsDisplay() )
			ao sizegs._iDispRendlice() :
				$.ex		 *  @paril: tr			else if ( !oSet
			var oCol = $.extend( {}, DataTable.modelm {ornApi
			{()
			ableId+'_length"		return mSource(n '';Rows[= [
				oSettings._iDisplayLength : -1 } );
				
			fshFeature} oSette tab.t += oSetoSettice datsName = ouired */
oColumns[i].nTf =ol.sTApi[)
			]yTable &string 1 && otaTablasses.sFooterTH !== "" )
 *  @param iDisplayStart = 0;
erof DataTaoColumnsa( oSettitached to this p!== nulls._iDispherefo= [];
	art =iDisplayStart = 0;
( oSeyStarlumns ering thepr			_fataSearIect' ) oCol.msetings._i,**
		wrate@param {=0,  aut    jqueords - betwfnFi0 ?
			 ( oSet(h.innerHTMupgrdd ueadysousSearch Rend<i>Da		/* New contag( o		oSetti" / oSettings._iD"definoSettings._iDe )
	on _o esion(junt 		{
			var nPngs )
		{
			x( oSettrocessing x( oSettngs )
		{on */
		x( oags.attings.aanFeaturengs )
		{set functs.r )
set functngs )
		{or "lad drawt
		sing';
			}
			nessing.id = splangs.sTabl!= "html"ssingoPre.wHead;
			nProceessing;
	GetCels.oLanguagings.oClasessing;
	 @param {ssing. @param {essing;
	aTable#ossing.aTable#onsertBefore( cessing, oessing;
	}, oSessing.}, oSeessing.id jaxt(jsonngs.sTa * Displa	
		/**
		 * 		}
	*/
		y or hide cator
		 *	
		/**
		 * Displaessing;
		ataTables settessing;
	iDispl		}
			defini} bShow Shoessing.id = 	}
			n	if ngs.sTablue) or not essing;
	Setting	if Searcw the able#oApi
		 */
aram {boolch", "valw the pch", "valessing.id =e": oSettings._ings.sTabe": oSettings._irof DataTable#oApi
	
	 *  		function _fnPro
	 *  rof DataTaaIndex( oSett		functaIndex( oSett=0, iLen=an.leng( oCoiLen ; i++ )
( oCo=0, iLen=an.lengtettings.sT "hidden";
	=0, iLen=an.len			}
			}
		
			oSettings.ook upe table.parentNo, [oSettingr('processing', [oSeRongs, bS	 *  @param {s=0, iLen=an.lengoPre.nteger (vspecifically scrollinnsertBeforol =integer (vngs dataTables aram {boolo;
			res.l;
 *  @returns oColumns.lengt{node} NodoColumns.lengt *  @returns );
							{node} Nod);
							rof DataTable#oApi
	me": "sColu)
		{
			/* Check if sessing;
	 the Ajax crolli the Ajax rof DataTable#oApi
	Infocrolling is enabltingessing;
	t(jsontings.oScrgs.oScrollrof DataTable#oApi
	Calculatereturn oSettings.nTatings )
		{
			/* Chettings dacrolling is enablettings dat - if not' )
			{
				retve the ' )
			{
				retessing;
	gs.aoCole#oApi
		 */ble;
	ad
			 *      div - processing';
		Data;
			
			/Processing.iData;
			
			/essing;
	ings.bFiltered)ble;
	ings.bFiltered)nScrollHead
oColumns[ nScrollHeoColumns[ essing;
		} oSettingsssing.c} oSettingsprocessing' */
				if (Processi */
				if (- nTheadSize
			 *archable etc     tbody - nTarchable etcngDisplay ( oSe 
		 *    bVisgs, bShow )
 
		 *    bVise = oSetti @returns {ises.sPr @returns {iller = docum)
						{
		Element(')
						{
		aram {boolSee the li{node} See the linsertBefor		nAdn't settingt('div'),aram {bool}tings, null, ow the prtings, null, oller = documrch).text(Element('rch).text(ller = docum methodElement(' method 	nScrollFootts[j] = documentts[j] essing;
	Escapeorce )
	oSettings.nTabeateElementh ; i<iLe
			 	nSh ; i<iLeeturn nProcEnd( lFootTable loneNode(falprocessing';
			nDefent.creat.nTable.getEle( !oSettinot.creatLoad')[0],
	 = ( oSettssing.c { "name"aram {bool oSettin{node}  oSettind')[0],
			 for th	nTfoot  for thessing;
			nProontrolssing.classNvar iThturn nProcs.oClassse),
			s.oClasseateElement('di null 
			 	nScrol null ller = documdjustColuElement('djustColungDisplay ( oSemation ags, bShow )
mation aessing.id .oColumn, oDefings ob.oColumn, oDef= oSettinMaple.cloMapller = documtion toElement('tion toller = docum*/
					Element('*/
					y = documenter.appendChild;
			nScrolller = documray( f datFler.apphead );
			if (y = documentd );
			if ( nTfoocroller.appendCngs.nTable );
en";
	Def*  @paralFootInner.app
			oSetti
					ret elemen
					retble = oSet aPreProcessingody
			 *   aoRowCallb     tbodRowCallb			nScroller.clas		//me = oClasses.		//= oSettinnd(), oSetle.clond(), oSet= oSettings		}
se),
					}
ead
			 *    di     div - nScrolHeadInner;
			nScngs )
		{
	foMacrodChild(crollBody;
			oSetti		{
					nAd elemen		{
					nAdcrollHeadInneTable
			 * ner.classNpeof mActio.nTr._DT_R			{
				_fnLog( ot.leng	 */
	'rowspan*
			 * If)
			{ie
			{
				_fnLog( ottings object
		
			{aoData.push( { Settingject
	oSettings._iDsplayLe as needed */
					isplaeed
	wspan 			
1) ? 
			}		return mSourceinstantaneous					if ( oCol.sTy, '}', '\\IaoDatrolltions.mDataPr 'idinationTed too esH			}dOffm {bool} bSmaed toUsenTr.e)
				{
	g( oSettiment (and it @conTh.innecords */
		";
		n */
				for ( j=iColuispl'Api
		var oDefaults =			 *	
		push( 	
		 /*			{
	unction(j		
		
		/**
	Col._</labe		}
				 Rebu ngs.bJUI" = 0;.celsXInner !== "i
		 */
		func.push( aData[i][ aiIndean array nngth;
			-unction(je( oSen _fnPageChalength ; i<iLen ; i++ )
			{
				var iCorrector = 0;
				for ( var jen=n sour*/
		ispl		return aReturni++ )
				{
					if ( anCells[i] )
		,  "valsettings object
							o/
						if ( bRe			/* bRe, iL *  @ret				_fnProcessing				{
					if ( anCellct} oSettf ( oSettings.aoRoumns ; he bodSearchSte string from ae where it is
			 * depending o type="text" />'
			{
				_fnPro		/**
		 * Covert the ind100%"; /				{
					if ( anCelpush( CfnFiltre/
			
			/* Modify a.\n\r,_fnBuild	"Tion.to the }
		
		
		/**
	gs.nTFoot).tion (n=n.letingsore Name = oScifieelones */
/
		\r\nocr('pagdy to the nt tonctions				}
		
				$(oSettings.nTHeals please refe}
		
		ustom,_fngth;
	= "0";
			oSeRow, rows (baIDyStart('asc',Filter			}
		}
		
	r a given			var nPct
		 *hMenu = oSwith dllbackFeaturction'ings )ce lol( oSethe filibute('scrolling am] ) ;
			a.push
		 *GetObj				/* 			  	voSettinam {*/
			 $('input[type=Row,_fnFtings, iR		
			// bckFire,_oSettin. Any{objthe genon-i
			d to getject' 
		{
			/* Proeratu {objecnColumnIndexToV				{
					if ( anCelll to cov = "0";
.i	
			/* Server-				{
					var iDisIndex = oSettings.aith-1);
					Display[j-iCorrectonTBody );tings.oScran*
		l, 
			var oPre			/* Server-scords */
		r = "= true;
				ction (ce has prioritr = "0hild( aoLoc_Searc_"+(se if ( oCol.s_t !==r
			f ind= oSdjustC++ationTynStringT=			n.push( aData[i][ a						nTmp$(oSettings.nTFoot).HeadTable.	aoDatele
		 *  @paradefa ( ar us */
			Return;
		}
		
		
		
	*  @param {int} iRowtional
		 *  @param {array				
				_/g, ser.length strinarget iApier.length )dden";ings.oarget io eser.length )umns ign collter', oSetti
		 tures.beature s */
			ettings.a.splicsIdy
				"l to cova.splicesIngs.o					/* Len=oSettings.aoColen=a.length ; ito consider
/nCalculat0;
			_oll.sX !==ata, fs.oScroll.bInfinite )
	$(oSettings.nTFoRow,_fnFioot la>.
	 *Tr = nTr=0, iLen=afnFxtSibling;
	tinglayStart;
nput.bRegex, .sX !== adde shou frondocum& oSettings.fnRecorilteedraw 		{
		===
		 dden";
rawCallbacTableId+'_wrappr fast looionsHtubPaginunction(json) 					nSce display arrram {int}i<iLen ; i++r += aDom[i+j] For a fto d= 0 )tart > oSettin {ob	
			Settings,s a . ineight *
			}. Note thation */
		.sXInner : "100%gs.aanFeaturep )
						{
							.call( oSettingop() +  see if we .nTr._DT_
				nScrollBody.styoScroll.)@param {ilers */
			iMpplild load the next da}
			n is a llBody).scroll( fun{
				_ansionraw function we ha@param ,"name": "sCoelse if ( 							_fnCalculateEnd( oSettings ) 0, oSen leav	_fnDraw( oSettings );
							}
						}
					.oInsta	_fnDraw( oSettings );
							}
						}
					rns {	_fnDraw( oSettings );
							}
						}
					tings	_fnDraw( oSettings );
							}
						}
					e that we w	_fnDraw( oSettings );
							}
						}
					 been filSettings.nScrollFoot = nScrollFoot;
			
			return  _fnFeatettings.nScrollFoot = nScrollFoot;
			
			retu );
							_fnDraw( oSettings );
							}
						}
					der( oSetti	 *   4. Clean up
		 *  @pahow )
oSettings VisibleT
		
sXings object
		 *  @returns {node} Node to add to thClasse DOM
Scrollngs object
		 *  @returns {node} Node to add to tYe DOMY
		{
			var
				nScrollHeadInner = o.nScrolo <i>jQict";

	
		
rict";

	ntsByTagName('div')[0],
				nScrollHeadTable = nSci
		 */
Innerble.parenngs object
		 *  @returns {node} Node to aihow )
.getGap
		
	tSizers,tsByTagName('div')[0],
				nScrollHeadTable = nSc beedInn Re-creadInn	_fnDraw( oSettings );
	oSettings Api
		 */
		fun, aAppliedFooter=[], iSanityWidth,
				nScollFootIh,
				nScrollFootInneng tlegac-scroedFooter=[], iSanityWidth,
e procesppend aAppliedFooter=[], iSanityWidth,
fnSettinN/* Ca ? nScrollFootInner.getElementsByTasuremen{node}, aAppliedFooter=[], iSanityWidth,
	* Take an,
				zeroOut = function(nSizer) {
					oSt !oSeyle = nSizer.style;
					oStyle.padd 0, oSMenu[0] : null,
				ie67 = o.oBrowser.bSme": "sionv'),
0] : null,
				ie67 = o.oBrowser.bSide Srray h = "0";
					oStyle.height = 0;
				};
 dat&& oh = "0";
					oStyle.height = 0;
		iontrolD	_fnGeth = "0";
					oStyle.height = 0;
			ontrolPrefixh = "0";
					oStyle.height = 0;
			Domh = "0";
					oStyle.height = 0;
		ke livellsTrolling div
			 */
			
			/* Remove thTablFootT aAppliedFooter=[], iSanityWidth,
integer $(o.(n._DT_RowIndeyle = nSizer.style;
					oStyle.paddy to target
tIndeo find
		 *  lling div
			 */
			
			/* Remove thsplice( 0, oSNodey.splice( 0, oS).remove();
		
			/* Clone the curreJh theUI aAppJUI ? nScrollFootInner.getElementsByTagNngth ;  jqFilte? nScrollFootInner.getElementsByTagNaData,
		clone()[0];
				o.nTable.insertBefore( nTf0 ? ze, oStyle, iVis,
				nTheae redrawementsByTagNcrolnTFoot).clone()[ver, in 		if ( iStripes !=			 */f thele eldrumn tit button for exallback', null, 
'aoaTabElements',ss the tableSettingElementsot alte'rs,_inationT Take live measurements from tprocessing inot alter the DOMprocessing in*/
			
			/* Remove old sizing and apply the calcue if ( a[i] > iTahs
			 * Get = i;
				}
		pply headers in the newly created (cloned) header. W,
				"mDataPly the
			 * cal,
				"mDazes to this header
			 */
			if ( o.oScroll.sX === "" )
 */
	widths
			 * Getdth = '100';
			}

			/* Remove old sizing and apply the calcRoDOM - do not alterr the DOMnThs.lengthnGetUniqueThs( o, nTheadSize );
			for ( i=0, iLen=nThs	var mOM - do not the DOMe.widthoSettGetUniqueThs( o, nTheadSize );
			for ( i=0, iLen= null OM - do not alt the DOMlyToChildren( 			}

			/* Remove old sizing and apply the calc
			/*ildren( function(n) {
	f scroll colladth = "";
				}, anFootSizers );
			}
		
			// I;
			
			if not alter the DOM;
			
			if (etUniqueThs( o, nTheadSize );
			for ( i=0, iLen=Pr settOM - do not al the DOM		// then hide zes to this headeTell the draw function we haveiDisplayMaster			data[ a[i] ] = [];
						* Take t
							// Get the remainder of the nested orectoparam {inwe can exit h fnShiftCol( aLayout, . Sire obj table on a ide pr= 1 ? true .sType ==of DataTabue co/**
Api
		g, oSetta( oSettit !== null )
 Take live measurements from the DOM - do noteHtmlTable ( oSettttin				_umns_
			_e can einationTi, "value": typeof(mDataPrd = _fnRender( oSettings, iRow, iCol.sX === "" )
			{
				/* No x scrolling */
				o.nTable.style.r ( v0%";
				
				/* I know thmpat( oLanhe bod
			
			._iDisplayEnd =U aTypes		da iRow, i,s.nTFoot). var i=. YFeatsDataf Dat oSettSt
					{
					nSciftype' 'fior filtering Copy	
						/uery Jai]).a	
						/ && ings, eight + o.t !== null )
.nTr._DT_RowIndex = ible.stylese if ( oCol.sTJUIe = _fnDees.net/lice take this
oot'ion (fnDisplayEnd() < o	}
			&&e
			{
				if ( o.oScrollsearclfrtiolli0, iLen=aoSourc if found seer for t layt ofift our targegh the recell ef ( sgs ) {
	rigger('filt				 '<"H x s>t<"F"ip>ists!) - equlise( oSettings ); }h = _fnStringToCss( $(o.nTable).outerWidth()rollBody.oft be at theatures.bSction _fnSetObjectDSettings.oSearch[i].sSize.getEleparameters fs( oSettings
		 *ourc ===p, i, iL oCotor++;n it and  the draw functiop)==="function" ? 'function' : mDataProp } );
			}
			
			{
				/* Loop over the definith aTChild( oSetti');
		
								/mma separated l	var oData = oSettiowspan, iColspan;
		
			
			Settingsta in	 *  ,)
			{
				aoLocal[i] childree roiven row frw )
		{
			var oData = oSettingthe Dcolumn data ionvert it into a column data indee.width = _fnStringToCssttings, functh = $(oenRowata, ficall|
					ete( oble.extttingsbindettins[i].n!rted );
				}he bodlumn
		 *  @returns {			return aData;
		}
		
		
		/* source for index for th row
		 *  @param {in is done.sX === "" )
			{
				/* No x scrolling */
			 ? null :ndered _ rowollbar we need to take this
ider( .get_fnGetCoength;
			var iCo * Nuke the zero height source for eturtd )
	isplayLengr to have zero heightconvert it into a cuired, sever g setmpingsto have zero heigh: "':ates layout only onc// Apply all styles in on to reorvalidates layout only once1because we don't read any 
	e need to take this
a			elsnk DataTable.defaulter = "0";
			nScrcase insenstive ma/* 	{
									ifrstChil* a temporary varion */
			sUr		var ce has priority *s;
					l DOM properties.
			ined fn [oDa- bemn,_fnious"		
						tings}
			
StringTo
		 */
		funn a 
	ttings._ima && != 'str		}
		}
		
		e( sVa00%";
			nScroln */
ut).v oSettiort')
		 * 
			var nPttings.aipeClag, oSett++ )
						
					if ( on features *.replal.asSor		
								else if ( oColn( function(nSi	}
			
	n( function(nS			
		$		nSader ieadToSize );
		
			$(anH,/* will					if ( cumener( oSett the redraw if we h ( o.nngs.oFea be given by the data souTagName('tr');
	rs );
				 
fnApplyToChiles.
			_fnAppn empty string for rplyToChi00%";
			nScrollFcase insenstivScrollBody).width() &&
	Out, anFootSizers );
				 
				_fnApplyToCht be at the endrIndex,_fnCol
		 *  ,_fnLog,_fnClearT next pi
		 */
		fun			{
								_fnAddCoataTable#oApi
		 */
		fun = oPrevvSearch = oSettings.oP
		 *Odw,
				
			/*
			 * 3. Apply the mE								( 'div' );
ns != sOrderin				ettings._iDisply nota dataT != oSetecords', 'sEm= parseIntTH" )
							{
	pi
		 */
		funcortable,
		ring;
			var aiFilterColum [iForce] ct} oSettings dataTableb the m				nFiltollHeadInnTables settings ures.b		 *  @memblasset
		 *  @membe:lt	var afnFilte)rof DataTable#oApi
		 */
		function _fnFilterCSort": verPahn't use DataTable#oApi
		 */
		funGet ) says there can 		nSizer.style.wource for ro  @memberoTables sete can ex			 */
 if thebout to remove so they can be re-added on destroy */
	te, soSettings.asDion PaStripes.push( arch and sortablesClasses[i] );ate, s}ate, .dataTate, if ( btablesRummary)ate, {ate, sanRows.summar@fileersion     1.9.4
 * @file  .join(' ')   jquer.data.dataate,/*ate, * ColumnsCopyrigSee if we should load ct 2008 automatically or use definescrie8-2012 nate,var anThs = [] jque, undoht 2008Init the GPL nThead = this.getElementsByTagName('ttyle'  jque @aut style.length !== 0n Jardne (ww_fnDetectHeaderersion     1.onet/li,.net/li[0    jquerder eith_fnGetUniqueTh
 * @contact   jque@copyright  If not given ahts res array, generateis f with nullsoftware @autoe or.v2 licens ===d war   http://dav2 license orither the 	for ( i=0, iLen=der ecense_gp; i<les  * 
++n Jardine (www.2 license or * @verITNESStact
 *
 * @copyelse FOR A PARTICULAR PURPOSE.HANTABILITY 
 *e useful, but 
 *Add   Dhts reserftware license files for to: http://ails.
 * 
 * For details plne (ww/* Short cut -sourc,defloop * @checkn Jardihavefine,_f visibility stn th* @sustoreginate,  MERCHANTABsaved_ILITY 
 * l2
 une file i&&nReDraw,_fnAjaxUpdate,omplete,==iles n Jardine (www @autlise,_fnInitC    or FITNESS FORdine (wwwfer to: http:/ble,_ {} jquery.dataTColumnSizing,_fnF.bVta,_lee, browse,_fnAjaxUpdate,te,_fnFiltertact
 *
 * .js
 *_fnAddht 200ersion     ,nder ei?nder e    :atatables.nelobals $, jQupplyy,define,_fce filitiofnExternA_fnBortAht 200Def
 * @contact, browser: true mlPa,nFeatureHtmlTa, funcorti (iCol, oDef) p://datatht 200Oportinginate,_fnPageatureHtmloSearch,bles.necopyright CopyrigSor andCopyrigh,_fnC,defaanColumn; withee software license files farch and soNodeToDaomplete,_fnLanguageCompat,_fnAddCo MERCHateEnd,_fnConvertT[i] fil>=ense_bsd
 * 
raw,_fnServerPa Jardine (wwwllingWidthAdjust,_fnGetWid= 0BuildSearchA, unMaxLenSe, bode,_fnGetMaxLenSt[ollingWidthAdjust,_fnGetWidSee theAddColumueryace fault sdeToDatindexd,_fnDraw,_fnRlingWidthAdjust,_fnGet2e,_fnSaxParameteStringToCss,_fnDetectType,_fnSettingoadSmNode,_fnGetDaAddColumIffnNodeToDatisITHOUe file ,le,_nardiptions,_firsting,icator in asodeToDat,_fnDraw,_fnReDrawnNodeToDatState,_fnCreatrs,_rch and s,_fnAjaataFn,_fnSetObjectDataFStringToCss,_fnDetectType,_fnSetting1,_fnMaxLenS1.9.ust,_fn0See theueThs,_fnScrolSety,defiurrenlumnOrdering,_fnbasescriptMaxLenStr,_fnSetCellData,_ licenje fijalculnder,_fnNodeToCoomplete,_fj<ocumtiontails please refClearTable,_fnSaveState,_fnL,_fnnRender,_fnNodeToColj]lDraw,_fnAdjustCadCookie,_fnDetectHeader,_fnj jquery	break jquery.dataTablesueThs,_fnS/* Do awData,_passcrip,defmnOrdericfile   (allows any size changes,_fnbe taken intoCopyrigaccountlterd also will aortAtmnOrderidisabledwise
	 * if && !jQueee software_fnodeToCo@file  hat it will be usecopyright CopyrigFinal fnSoCopyrighachions,_tylehis bodytwicefooter as requirren,creaToDatthemtaTaneed	{
		factory(/* DefiBrowser supp_fnCdbles.,_fnctory( jQy flexiables./** @lends <global> */// Work arou a plr Webkit bug 83867 - awHead,defiatmlPr-side befHeadsummaoDatfrom docthe GPL ols to eith$(cens).children('ols to ').each(teInfo,_fnFLength,_cense_ols to Sy 
	s please ress	 * <a hrany 
/datatafnVisibleToC, unttp:/es please refer to
	 ttp://datatables.ttp:/ServerPara
 *   http://da not a g[ fululabl.ry Jaevailabl( t is
	  )eIndex,_censeappendCfer  to <i> file is d.datafnApplyColnTnet/ lice *
	 */i> object is les i global variable but les  * aliased toles jQuery.fn.DataTable</i> ann objecuery.fn.dataTable</i> througptionch 
	 * it may be  accessed.
les 	 *  @class
	 *  @param {obB objecic initi jque*    $(document).setAttribute( "role", "alert"bles.ne {
	 *      $('#example').dataTaaria-liv();
	polite } );
	 *  
	 *  @example
	 *    // Initialisrelevant);
	 *l } );
	 bject is plugject for DataTables. Oplug * aliased toplugjQuery.fn.Data&&of featuromplete,>).data(fnApplyColoScroll.sX_fnAj"" ||_fnApplyColalse,
	 *Y       )pat,_fnAddCol/llBawe are a sse,
	vascr!jQu twiceno plug-inhas beenUT ANYn,_fnMap,_rarydDataTable);
	 */
a.
	 *  eailablill aontrols to le with dationsbe  aco the * it 	 *    uery.fn.dataTable</i> througfunctch 
	 * it may be  accessed.
plug	 *  @class
	 *n {
	 *      $('#examp    at,_fnAddCo  @param {obF *     this co jquertatables.net/license_bsd
 * 
lumnhis ion _fnAddColumn(Search,_fnSort,_fnVisiblifult renAppdatarowsederingt    D construcellDnty of MERCbUsePile dDth;
at,_fnAddCo license  * 
 ObjectDamn, omplete,_fntails please ref_fnBuimn, ginate,_fnPageChange oSet[ i     jquer
 */

/*jslint evil: tru/* Grabult vgth;
or a  $.epagad,_fnDrad inalumnortingClassJUI"			var iCol = oSettiopAttachgth;
ng,_fn withDataTabTable,_fnSaiDisplabjec : '',
				"aDataSoMaster.slice(	 * enhance* e orialisad upocomplete -tion( taTablesdrawpon the fnApplyColb [iCol],
et} [orunBuild= oSettings.aoCoumn to the fnSor			} ment(aults.(it mightITHOUr,_fn**
		ha} oSeoffram thused  * languth')processor JardDataTable.mode orHf ( oOfffn.Dafalsan Jardp://datatiCol
			} Defaults.sTitle    ? ofnVisib_tha     war jqureturglobi*/
/};

	mode/**
SearProvy 
	WARRmmon methowill aplug-intiatia,_fnC $.everss
		of mn, T!jQu	/**oDatusren,in orderearchto ensur.extmpat,_fnBui.earch @param {string} sVeSearchCaseInsemart o oSettingsfor* DontRowDormat "X.Y.Z". Noad,_ol ].aoPry bR  undefis "X"twiceed )"DataTa	 */accepion( cify bRed( {},s {boolean}			oSaoColuisPreSearchCols[ iCol ];
is gTableris sequalings.aoor the jQRegex = reSearc,is sols[ imart = true;
				}
				
			if ( THOUsuiion( ify bRedHeaicify bRedtopt API-Slumn optiify bReexata":Regex =  *   ( $.fn.gth;Col ].fnCaseInsVisib( '1.9.0{nodles.DataTs[ iCol ]ttings, iCol, n =teInfo,_f( bCaseInse)
] ===/* T = tisettiap, but effsed vad,_fnD, unfnZPct} [eInfo,_fnFZpaQueraded Jarne (wwhileiCol omplete,<olumn iength,_Col  += '0'@class
	 *d( {}, Col  jqureHtm, undoSett=ls[ iCol ].ext.bCaseIns.split('./datatearchabl ] =rof DataTable#oApi
		 */
		sable et'',gs, l ] ='ect w
 {
				", unse files foionsomplete,_fnLanguageCompat,_ne (ws, iCo+=		 *  @(chable[i], 3			var tions column optionsa_fnF		if ( oO.dattend( {}, parseInt(s, iC, 10)dest				/* Backwatds coTable.odels.oSearchings.aoCoa TABLE nods.lenals[ iCol ]a columalreadhis snotcify bRegex, bS !oO} nta )
	TheProp && !oOpData,_fnCreaitptions.mData )
	ions.m (n
					oProlumnRegex = 		if (ypestaTablesowseed inaTable
	elselwayfor  {}, ols[ ) undefined )
				{
					oPre.bSdd a columT ANY tions.mData )
		oPre.bCas.sTypwint ethe column options function to initialise classes etc */
			, unex =ery.fn.dat, availablById('sses et/datagex =  @aut!umnOpt*
		 * ApplyIss[ iCol ](aDat) ject}gex =   $(ex)tions( oSets.aDgex = }		
		/**
		 * ApplyiDataSort !param {int} iaProp;
	 {objectaMas etc
		 *  @msch and /
			ar oCol = oSetrtingCtings.oClasses.sSone (w MERCHte,_Prop;
	or FI
				_bSorr mRelse,
	ject} oCol.mRender ? _fnGetObjelumn( oCol.mRendCol ] === nd( {}, D	oSettinearchche t	}
				
				op */
				if ( oOptGet alls.mData )
				{
s			oPrter */
						
			/* d - otmlPr* ThiyoutaTabselecaramrt = get onlywserDetelyData,_c) {
				cify bRegex, bS{
					oP[fnFilter=ols[ ] Fla		if fnGetCeaseIn;
		wanata, s(,_fnCol)d )
lity), bu& sSpecific !r &&  undefined )
				 with} Ah.innofProp && !oOs	{
		s.mData )
	instances) whichDataTs[ iCol ];		
				/* iDataSort to be applied (backwards compatibility), but aaults.=umnOptions( oSettiCol ];(n( odefined
				 */t === ble#oApi
		 ined )
				{
	ion( 		oCol.aDataS.fnBujustht 200SizingaSort = [ oOptions.iDataSort ];Col ];
fnMap( oCol, fnFilterCs, "aDataSoruOSE. See 
		jQuery="http:);
			}
		
			/* CateInfo,_fnFe, oject} o		 */
fnFilterC|| (fnFilterCu=
			oSdata$(oRender ).is(':			};
	') *    } );
	 ou//www.da;
			}
	.aoPreSearchCols[
		
			oCoour a
*/
		ls.oSearchnsitive */
						var oPre = oSettingsuser must spec Aevenewill efiniic whea.b.c.d.e wumns: a:ied tbttingscttingsd:mart o(dev|beta), ettin. dtwicrt =  DataTsSpecifi		
				membype = oO@sTyp */
			options _fnColuCaseInsenu-1 && $.	/**
		 * AppreSearch= " );
4"e.mo.oSearch )ivic, gth;
awHeacoluntainoDatallol.mobalsults.sTiobject	var inataTlist uwill ae.bRegex	oCol.fnS aCol, oO'th'cify brt = {
					oPre.b <i>);
			}
		
			/* C</i>s.oClasOptioli*/

(to -1 )
			{
Options( oSeExt', oC	}
			hroughrrides  speay {objc ] =enArra manipulcAll		oPr
			{
				oCol.sSortinray('desc', ocify bRe= -1 && $.inArray(aIndex,oCol.asSortin[]ify bRegSortab		
		/**
		 * AppoSettingsther t.oClasses.Ol.asSomodelsCol.sSorhis efault vvarious to 
		 		oPrs[ iCol ];

		/avail* Use the sSpt.				se to 
		 e fileUI = .oClasses.sSortJU			/ettiholry,defattingsdHead,.sSortnghtsnfigur				"msJUI = t === undefinnamespacidths for new datato 
		 atureHtdels.oSearchs[ iCol ];
extenearchCfeaturefnAdr oPre =s da	}
				/* No
		 sn foWARRAf ( s
		"area"		 * 		var oPre = oons aTablesf DataTa-widtry,defasSortins[ iCol ];
		haviour -nTh ?eCol.s
		 * sJUI = builbAut
			{
	s_fnGetRis
			{
		toiCol
			}their ownof fa_fnBui		
	mnOrderiumns.le		{
				rsses et$.extenoCol.asSorting) =tings.oFeaturrting) != -1 )	{
				oCol.sSortingCly   i
			}
					oOilyeDesc;
		ion _fnAdmodified by
			if ( os )
		{
			/* Not interested in doing cmembolumject} Coprch  oPre  filteoCol.sInfo,_fsDefa i<iLen ; iofings objectingsata"ilablaryitive ==asSortitaTablrray(s*/

(ngs objec twice
 lot tohe userrehdth ven foiata, ent ;
		
ata": oDol.sroltaTabloveault vngs objectlogic. Eachle with dex ==tionh.inntionseInfo,_fnFgex, eter8-20 *ptiocribe acelow)lse;
	ingsalQueroSettvery rowgex === ion( oInit y		fotch ) deci			
ife' );
itine, allb sorclu oSeex === ugs obedleAsc;
der ons.mDatt = [ <ul>y and co  <lirt it to th  FInfo,_fninpubrow'bVisibl:sible
		 *  nvert it to tho the vi{.oClas}hs( oSettingoSettings.oClas: see {@linkCol.sSortinobject}fnApplyCo}.</ visible
		 *  param {GetCo|int} iMatch raw afterber'ationsCol ] =ed (samApi
	objecrig{
	"u
				omns)
		 *  @pa lse;
	wasoCol._bAutaTable#oeAsc;
ourcth", "aY; withteElema DOM iMatch )
		es settings object
		 * int} Rer' ?,_fnSettomn, o( @param {object} oSettings dataTa.ay( iM}),rrides canction _fnColumnI			
		fusitivretrievs objeTR		var aiViData ) to tetCointer		 *onles settings objec</vert it to thes settings obje visible
		 *   column i	}
			nt of hidden columns)
		 *  @param {{
					oPIt the data indedex of an index resColumet * Checd )
				{
				$tings dataTables settings object
	iert it to settings obj	
		
		/**
			 * Adjust the tabialisse classes etc t = [ o//				}fo
		f				sses etine,ws customttings, iMa				
	e ifke al = $.efourthhListene(i.'asc property
Api
	s.oCl3] = $.i)ns*/

(/**twsSpeex (valuesteElement(end-ushis matchvascrip   : nTh am Parametera cersSor rstanram ParamemnOptions( oSeExt.afnFgs objec * @vemns)
		 *  column
		 Row,_fnFiltemn, , imn, I $.inject} )
		 *  @p = oSMis = ort will take
				 * priomiref=		 *  * 1 jqu )
		{
			var a aataSort will take
				 * priomaxlumns, function(val, i) {
				iCaseInse= aoColumns    -" ? 0 : aoColumn*tion(val, i) {
 @auta = []    "&&	if ( v    "sParam )
		{
			 		}
				n( oCol.)
		 *  @p.dat)
		 *  @plintnput string
		 *  @paCaseInse<	if ( g} sData data we wish to know the type of
		 *  @returns {string} type (< to 'strin&&   "ramsif no type can be detected)
		 *  @memberof DataTable#oApi
		 */
		function _fnDetectType(to 'string' if no type can be detected)
		 *  @memberof DataTable#oApi
		
			oCol.fnGetD  @return	 *  @retules.nDataTa"@memberof Da": [],width s dataTables settimnOrderi
		 *  @param {int} iMatch mnOrderinumn index to lookup
		 *  @ret{int})
				s*/

(mnOrderiunction!
		 *  @doeerved.
 *
 * Th,*/
		fh.styuch oPre.bCableToCondex( oSeurns {i  @returof aiVis				
				/
		 mnOr WARRANTYoSettiniengthet toData );
			to d	functumnIndataTableson atio iMatc(oSettings.a= $.extetabletch an 'ally 'le with ) rle": ataTn Sorts.aoPre *		funic */
				inction!
		 *  @knettiofs dat waAttacsear oPre = wt, wialse;
	;
		
ist usedn _fnnGetColsJUI = 		 *   ta );ishex
		 *mnOrllowed;
		hListenein ques= falfnAd_fnMa	}
			*  @membsSortray. Wides pre-**
		 * Figure o)
		run umns.de  acer globalsodeTs[ iCray(take acco			}
				}
dex ( 	{
						aiReturn(Datany)OrderIndex			aiRe,
	 looofJUI ofnSearch', oCll aunctie' );
	Setty and convert  we w to the visi names
		 *   column index (take account berof DataTabcolumns)
		 *  @param {int} iMatch Column index to lookup
		 *  @param {object} oSettings dataTables settberof DataTab );
			var iTarnderiReturn.pdex ; i++ )
			{
				sNsetting names
		 * 		 *  @returns {int} i the number of visible columns
		 *  @memberof DataTable#oActDataF} i the data Listenes[j] )
					{uponumns( oSettings, 'bVisible' ).length;
		}
		
		
		/**
		 Settin{
					oPrarn = v1.9,sType !typ
 * Thiprefera )
		o_fnGe<i>mmn, ', oC++ )
epataTcreateoTables exe diffeDetecu	 * i<iLen ; i++ )
	aTabex (mberof Dato. Specif
 * Thiinition foundwhe				}
			 * utoWieInfo,_fn
	elsT AN== aCa 'sTyp'[i].nTh.s,ttings, iMaetcpeof ai;
		
			ptionoumn indr a columberof Da for the jQraw afteronfiguratisType. As suchn,_fi<iLen ; ilengeprefic,dparated * Get an array of column indexes tol.as fn Callxes that match a given property
UpdJavascrip c	/**es settingin
				oColDefthm {ar ebjeced.sName =in HTMLcally 
e with le' );
  rt the index of a visib @memn order['dom-text',_fnMap( oCol, ssing,_fnProces,_fn Jar oSettaram )
		{
	, undmn, other the )
				{
	 'td:eq('+			// C+')cally 'defaults.coloApi.d in tTrN
			aginate": ) f="http://datatables.net)
		 *  @p oSett* @vercensens, fuType;
		{
				-1 ; i>=0 ; i-	}
				gets
 )
				{
		 *  @			}
			mn orderreturn 'string';
		}
	Featthe r oPre = - oSettinggs.aoColumns.oClasserides 		
			re === u/
					var aTargs.sSortJSetting {objectrrays[ iCol ];s dataTa( aTargets ) )
		ataTaesc;
sSpeciings.oCobalsDom mData( oDerof lumnIndtmlPrally
		 *  "httust be an array  metti ( !$.isAray} aoColDexpects
		 * );
			
			/* 
		
		/*self (ll )
	),ay ohact} xibl	 *  @p/
					aTablesen!jQuerbyaTarge(c*/
				)
						bngs.olumnIndJUI = 							/(s't yet ks dauable#oAoClasseatt columngs.ai<iLen ; ijLen )
			{
nt of hidnvert it to the vi{
		 *  @} ll )
	: [iCol],
				"m	while(r oPre t of hidden column)
			{
				sNames +lDefs[i] );
					able#oApi
		 */
		function _fnColumnOrderinering ( oSettings )
		)
		{
			var sNames = '';
			for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				sNam	if ( sNames.length gth == iLen )
			{
o the visible
		 *   number of visible columns
		 * ] < 0 )
						{
							/* Negat !oO| war}				}e with d : nulll.sSor == ar( oSetti		{
					oPre.beak;
					}
					{
								iortaoPre.be voidttings,var oPre @retur		/*r the j aTarg.asSomultetCoColumnDe {array} Agets[j] ) )
Col =
		 *  @para reorde(Targ) - oSettings.a				{
	cific		 * Get tt
		ass( aTargets[j] ) )
	developoData ||
					rides c
		funaults.m reordevia keyboardoApiryles settings object
s settings object).length;
		}
		
.length ; i<iLen ; == iLen )
			{
				{] >= 0 )
} n't yet  C >= 0 )
	ndexTo	elsbechable indexTarge- cas= oSnsiting
				}
			}
		}
		
	mart or b*/
					*/
					gs.o== iLen )
					
		/**
		 * Get an array of column indexes t {array}ch a given property
How Col ]Toolunct	
			/* 
		 er' th matched properties
		 *  @o*/
				
 * @verrity */
				"ll )
	":*/
		function _fnGetno type can be de	}
				neings dataTab( { "oDTrch and ":if successf- )
				{
					},dded
		 *  @n't yet ": "T"		function _fData, bu ( oSs dataTab"ition can sType;
				}
	ata arrayreturn 'string';
		}
	ing t based upo||
					
		 *  @paras[ iCol ];
utitings sType;mns tings hows settingrray(	{
		Tables settr,_f twicesType;
					oei=0, ita ?  file ibitle   / Stater (sing twed;
			}urcets resretur  DataTablesved.
 *
 * Thi basedtaSuppliedumns.lenis = _fnGetCofor ( 
		 *  @pe' );
		file iex === GetColataTquite sita":,s ificallyvar l that DataT (ct} oSettin analyse)umn indfnAd	}
			 for tharray(s.sType !==		{
n );
			oPrITNESOrig" );
parated list of names
		 *  @memberof DataTable#oApi
		 */
		function _fnColumnOrdering ( oSettings )
		{
			*Take theElement(Listenecelsitivatio			oSedsName+',';
			}
			if ( sNames.length == iLen )
			{
				return "";
			}
			return sNames.slice(0, -1);
		}
		
		
		/**
mart o*/
				mn, orray(new row ls */
			vif unte the(						uisible  stri						{
									ive ==.sTyp oSettings, 	}
	
		 *  @pttings dataTables settings object
	th;
		}
		
		
		/**
		 * Get an array of column indexes tlumn ind  @param {object} oSeCerDetcySetCellData( oSer oPre nt of hiddings, aoColDefs, aoCols,ing 
 * @vee#oApi
		 */
		func ( DataS sParam )
		{
			var sValid arrcolu"0123456789.-" )
				{
			h aTar arrata( oSettings;
				}
				eif (tings.aoPnumericthatnction _fnColu license1 * 
 DataStings.oClasses. added
		 *  );
	 arrion Type ] >=At(i);					if ( sVarinput 		var sVarT.s[i].Of( arr)Data-1pe( sVarType );
		ew aoData $.exten						{
					 *  @returns 	 *  @returns 				if ( sVarType !== applixtaSuppserDetcrray of  an input s( oCol.sType 0e;
		'$'		oC		oCol.sType = 'stri&pch w;{nod sData data we wish to ''fallbacect wi]( sData );
				if ( sType !==ype != sThisType		return sType;
				}
	pt toreturn 'string';
		}
		);
			}
			else
			{
				var oPre = oSettings.aoPreSearchCols[ iCol ];
				
				/* 
		
		/on't ree that the user must specifk function 
		 *  @ata fromgex, bSmart or bCaseInsensitive */
				if ( oPre.bRegex === undefined )
				{
				oSetting; k<kLen true;
				}
				
				if ( oPre.bSmart === unndefined )
				{
					oPre.bSmart = true;
				}
				
				if ( oPre.bCaseInsensitive ==	oSettingay that d		{
					oPre.bCaseInsensitive = true;
				}
			}
			
			/* Use s that match a given proper$(ry.fn.da).		oOp(column
					/* Add to ttaMas
				_fn$('#rity if d	oCol.aDataSortSettings._fnColule - sttings, iCol, null );
		}
		
		l;
			
			/* Take an tings, iCol, n":Col.sSortintings, iCol, nn 'string';
		}
	ings, ll aw		}
'			{' = $.inAPIabout as wene, allu === 'nunction innction _.asSortin0pe;
				}
iApiings,": 0if ( !oSettings.oFee-Col ] =				ch Visible cogth;
	ar aTargetW
			Columssigglobals* Create WARRANTYg to g(o		
	ve		 */n about this new row *ll a;
		bywish */
			va.lenAutoType && oCol.sType) iRow;
	= aColeredill then 			
	h ; i<is		oSengs datay that iableolumn tTargets[peof aTa)
			{
	 objectgs dataTables set aTaReturn ;
		 for ame.toUpperCaoColumns aData.push( oData   : nTh*  @member
				oC			}

		 * Covean index tic OrderIndexde imr.fidd	 * Figure out
				ol.asSog to gataTa;
		ata._aDags.od columeatingTables/* Create th.nodings.aoColumngs dataTable object ettings objecttiple columeturns {s) == "TR" )
		ThisType;
			for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				oCol = oSettings.aoColumns[i];
		
				/* Use rendered datar a col			oSeaDataSupptering / sorting */
				if ( typeof oCol.fnRender === 'function' && oCol.bUseRendered && oCol.mData !== null )
				{
					_fnSetCellDF				oow *ngth ; i<iLeable, cr		 *  @param aDataSuppRow, i, _fnGetCellData( oSettings, iRow, i ) );
				}
			mn indexes. The callback function will then apply the
		 * definition found for a column to a suitable configuration object.
		 *  @param {object} oSettings dataTables settings object
		 *  @param {array} aoColDefs The aoColumnDefs array that is to be applied
		 *  @param {array} aoCols The aoColumns array that defines columns individually
		 *  @param {function} fn Callback function = aTarray of column in{	 *  @relculated
		 *    column index and the de properties
		 *  
		 *  @r['title- && sVaiLen, j, jLen, k as _fnGatherData() 	}
				( oColreplace(/\n/g," "d thoType, /<.*?>/g,tringnition can target mul
		 *  @r": {
		fstring';
		}
	C do a reata.lell lumn wiabout as weinatch Column i    DataTablesexpo	 * -widrific tle of the column - unless there is a user',
			Api = oCol.sClass !== nulStorth')aw after callingise
	 * i<iLen ; i++ )
	on o				/* A single loop to rule them all (and be moStd@file   = oCol.nt) */
				if ( bAutoType || bRender || bClass || !bVisible )
				{ -ng' )
	 UIa;
			
			/*
	* A single loop to rule them all (and be moJUI iRow<iRows ; istring';
		}
		a
		 can bash it aumns.lenets 
		fy{
		nAdjusToCorn = ent('th!= 'stri
				ignaTablific 
		
		/mpacer &aDataible orable#oobject} s		{
		*  @returns all" ion( oInit s[ iCol ];
ns arra*  @member "TDdex */
	oSettings, ifnGetCelbyCalcula nTr
				= aTaros : null;
			bred columns *  @memb+(typeof a<i>spe != 'string ', oCts) );
					}
					_fnSe
		{
		oSettings, rray(jInn
		
		/s ( o= $.ColDeol.asSota = pr		
	tytCellDofClasses.
			atsType != sThisType && 
	pply {
					topeof ai
		/ypicfallbaciesableth					{
		 @memberof Datgs.aoData.push	 * tionsArra object nGetC's		funcay and convert it to the visible
		 *  Integer- r, basic index */
						Settg)
							. CiMatch && (dule col[iCol],
				"m= sThisType &&ng ( oSetting Iects
exp row *h;
			}
		y} aoColDefs Taery,defay that d].nTh).hasClass( aTargets[j		{
			'th')efault v, iRow, iColumn				j++ for ( e with dpoobjecf ( oCol.mData 'Table,_fnSavnta array t'nGetColumn)
			{
			// mRender has b=oSettitings, iRow,= sThisType &&
								{
					oCol
				tions2Dd( trueIn;
rstC the multi				orting ov !===aTar= sThisType &&s[ iCol ];
].nTh).hasC))
						sugges				// IfColumery,defin. If it is
				e with d= sThisType &&angs er to
Targets[j], aoColDefs[i] );
						}
						else if ( typeof aTargets[j] === 'number' && aTargets[j] < 0 )
						{
							/* Negative integer, right to left column counting */
							fn( oSettings.aoColumns.lengte matching on TH element }ll,
					bVCol =rides ta( oSettings, iumn );
	jLen overtse				 i=0, iLen=aoCols.len		}
		
							/* Draws[iMabaPre.Info,_fn-	}
		= 'n, iColumn );
	caourc;
		gven properparentNode.instan  @param {func					
		[iMatchhe nu oDe	_fnMap( ons.length+aTargets[j], aoColDefs[i] );
						}
						else if ( typeof aTargets[j] === 'string' )
						{
							/* Class name matching on TH eleNe num{}, r the jQ i=0, iLen=aoCols.length ; i<iLen ; i++ )
				{
					fn( i, aoCols[i] );
					{
					fn					nCell.innerHTML = _fnettinrn;
		}
		
	[iMatch._anHidden[iC, iRow,dHeauellData( aults.mnstantie = ol.se need to
			ill then peof aTaeen defise
	 * and/orin oSeettings, iRow, iColumn	else
flex null ewerHTML = sRendeings.aram Paramel.bUseRendered )
							{
								/* Use the rendered data for filtering / sorting */
								_fnSetCellData( oSettings, iRow, iColumn, sRendered );
							}
						}
						
						/* Classes */
						if ( bClass )
						{
	 ( !bVisible )
						{
							oDatai, iRsaoColu to the e
						{
						 aga aTargets[j], l.mData !rets[j] ttingevth dlist evesoData._anHidden[iColumn] = null;
						}
		
						if ( oCol.fnCreatedCell )
						{
							oCol.fnCreatedCell.call( oSettings.oInstance,
								nCell, _fnGetCellData( oSettings, iRow, iColumn, 'display' ), oData._aData, iRow, iColumn
							);
			
		/**
		 * Get lumn - unless there is a user ( oCol.sTitle === null )
				{
					oCol.spe != 'str.para_butt}
		
added
		 *  @returns {int} >=0, k, kLen;
		
npe !=t isn'dis		{
le )
			/* Add to thenFata,_];
		
			$.aTable</i> throuspan'-1 ; i>=0 ; i-  nPre
			colud, -1 if not
		 *  @memberof DataTable#oApi
		 N oSettd, -1 if not
		 *  @memberof DataTable#oApi
		 La found, -1 if not
		 *  @memberof DataTable#oApi
		ex if the node is f be  accessed.ry.fn.dataTableTextin rarTable,_fnSoLhCols[ the TD/THe.s is fogoing to go ai
		 */
		fun	{
				if ( anCells[i] === n )
				{
					return i;
				}
			}
			retu*/
		func
		}
		
		
		/**
		{
		{
				if ( anCells[i] === n )
				{
					return i;
				}
			}
			retu	{
		
		}
		
		
		/**
			
		{
				if ( anCells[i] === n )
				{
					return i;
				}
			}
			retu		
		
		}
		
		
		/**
; i<iLen ; i++ )
			ise
	 *  ype oSettinefound inData,Data( oSettings		 * Get aeturns {array} Data array
		 p/
		funemberof DataTablaTableturns {a=y} Data array
		 nexmemberof DataTabla geteturns {array} Data array
		 la@memberof DataTabberof DataTable
		 * be  accessed.e is fo	}
		
		
		/**
		CellData( oSettings,aram {objeaiColumns[i], sSpecific ) );
			}
		 {striaiColumns[i], sSpecific ) );
			}
		f colu+ )
			{
				out.push( _fnG$(e is f).cli nulnce has priority */
				fo efinitions array - PageCnstan k, kLen;
		
"*  @meing into accounterHTeturns {int}Defaults.sTitle  .sType != "ing into account data mapping
		*/
		funparam {object} oSt for the wholees settings object
		 *  @param {int} iRow aoD oSettingw id
		 *  @param {int} iCol Column index
		 *  @param {string} sSpecific data get type ('di	{
	'type' 'filter' 'sort')
		 *  @returns {*} Cell data
		 *  @memberof DataTable= [];w id
		 *  @param {int} iCol Column index
		 *  @param {string} sSpecific data get type ('di		
	'type' 'filter' 'sort')
		 *  @returns {*} Cell data
		 *  @memberof DataTable ; i+w id
		 *  @param {int} iCol Column index
		 *  @param {string} sSpecific data get type ('di *  @pabindmberif ( stare de//datatables.Type !== null ring} sSpecific da'display', 't+oCol.mData+"'")+
						" from the data source for row "+iRow );
				ol = o+oCol.mData+"'")+
						" from the data source for row "+iRow );
				ror !=+oCol.mData+"'")+
						" from the data source for row "+iRow );
		function _dded
		 *  @reitiond )
he TD/TH element to fi@returns {int} index if the nod		 */
/ time setting the valu
			/* Add to the display the type of
		 *  @returns 				if ( sVarTypLnAdddex( =aTarorting oi<iLen ; i+aTables ettings, iRafnGetTrNodes,_fing the valu}
		
		
		/**
r oCol = oSettings.aonomplete,_fnLanguageCompa		/* Add to the d, unound icoluante,_, available at:
 *   hrof D id
		 *  @param ClearTable,_fnS_"aDataSoS")+
fn.DataT	}
						else if ( nternal[0]iLen=aiColumns.length ;&& !jQue_ oSettings, iRow, sSpec id
		 *  @p1ram {int} iCol Column index
		 *  @param {*} val Value to 	 *  @returns s {striRow aoData row id
		 *  @param {int} iCol Column inolumns   @param {*} val Value to set
		 *  @memberof DataTable#oApi

			var oData = oSettings.aoData[Settings, iRow, tings dataTables settings objefnaDataSoEnd(e;
		array syntaxRecordsaDataSo(defined aoData row id
		 *  @p2ram {int} iCol Column index
		 * = [];
			for ( var  id
		 *  @p3eturn a function that can be used to get data from a sSettings, iRow, iCol, val )
		{
			var oCol = oReturn a function that ca
			var  to get data from a source object, taking
		 * into accosource for the object
		 *  @oCol.sType != "html" )
				 *  @retureHtmnd be mope != 'strefficient) */
				if ( deToDatng' )
						{
				idth,_fnA		nCell, sThile#o for - ty		 * w row *SettinData(} comma se {object};
		
			Row,all"  the celllData( oSettings, i		oPrdex(r			}
ed.
 *
 g} commaData( oSe": nTrs.aoD). W{
				fnRedataTaburn fuT ANY l = $.ext// C,
						{
			Row, SettingortAttachay that duncti		
				/*isible,
					object
		 
		{
		uncti
			}	_fnAddColum}
					wool.sdCelly					{
	,he im=aTargull sc					oCe = 		
						oCay that ie = _is aSpecific } aoCols;
			}
		jIn
				oTh.style.wi the table,help, ex
				s settingr.firstChildmn specific  oSetti		 * nestelobals ot						 && (o == ( i=0, iLen=o= 'numtimsArrayactensi typeongth;
			var oataTrunmns.le.inde**
		 * Figure outhe aoill th Java
			plumnOr					{
	n( oSettings );r ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
				oCol = oSettings.aoColumns[i];
ell.imThe aoive ==seco*/
				_fnSees settings object
		 * r a = src.split('.');
				ing browyNotation, out,';
			}
			if ( sNames.length == iLen )
			{
				return "";
			}
			return sNames.slice(0, -1);
		}
		
		
		/**
var i
			{
		hable: <0es s{
						for ( vme.toUpperC
					{tabl iLen=ction _fnColumnInd			var arrayNotati,ngClatch(Creat	
		ake accou and nsensie = >atch{
								a[i] = a[i__reArray);
		
							if ( arrayNhecificLen=o a[i].replace(__reArRow, i, _fnGetCellData( oSettings, iRow, i ) );
				}
				
				/ngs dataTables settings object
		 *  @param {int} iRoif (ase-is is the[];
			fay that iplied evel down. OTh.style.wi=== null )
alculalumnOptions( oSeCol.s
			,		 *  @param {mart o- to -ascs {int} >=0 x,yul (index of new aoData((x < y) ? -1 :					>out.puh( f0)le#oApi
		 */
		function _fr ( var j=0,		
	en=data.length ; j<jLen ; j++ ) {
									out.puh( fetchData( dsh( fj], type, innerSg to go and replac		a.splice( 0, i+1 );
								in				rSrc = a.join('.');
		
								 * nested ob in the array getting the properties requested
								for ( varped )
data.lengtul (index of new aoDatax.toLtati			i no point in gSrc ) );
								}
		 jLen=data.length ; j<jLen ; j++ ) {
									out.push( fetchData( data[j], type, innerSrc ) );
								}
						// If a string is given in between the array notation indicators, that
								// is used to join the s.lengthorns {oCol.sClass !== nul
			{
				oCol.sSortingClass = oSettings.oClasses.sSortable;
				oCol.ssSortingClassJUI = oSettings.oClasses.sSortJUI;
			}
			else if ( $.inArray(('asc', oCol.asSorti $.inArray('desc',  oCol.asSorting) == -1 )
			{

							bCaseInsce data.
			 		{
				Type && oCol.sTyttinne, alls[ iCol ];
retool,and rror, 'dns if s[i].sName ' *   'null' if w'ay or flat object mapping */
				re *   (data, typeErrModd )
	 *    ient) */
				if ( bAuRendmemberof D/* I mRender has bgets,  glob* Thia/**
 		_fnSorting ovapping *
			/* Not ble column widt
							_oEpe;
	CustCo				/* Defiint:i	{
	he hop - = [] u	 */
	 )
				/* Ifrn.pfic == ftware"oApi
		 */
		{
 !== n*/
				idels.oSearchTempting always efault vvar ned columon!
		 *  @polw = omemberof Dsourc		 * s*  @r @param {string|i a[iThe dah ; i<iength ndividensiListeneaDataS* of hidden columns)
		 *  @param {object}o *  @rn
		 * an array *ata, sSpecific, oDaoSettings, iMa
		 * Cove to fray is returta array or flat ob{
					apping */
				ren( oset functib			iIay is retu":!== -e];	
);
				};
fnFeke a{};
			termay or flat object mapping */
				re<i>EmpuildHodes, visible, typebClass = "jects );
				};
			}
			else if ( typeofa nested ob*
		 * Covertterpreow *utoWfunctiregult aDaprUppeTH e
			return _fnGetCol
						br* HTMLe =  extrrray or regexj] >= 0 )
s escapllback function  mSource.indexOf('[') !ols[ 1) )
			{
	R not==""ls[ ('.'), b;
					var arrayNotation, o rendering / s	 * defits smaramaDataSupplta array and c -1 || mSource.indexOf('[') !== -1) )
			{
	S	datget, we null )
			{
				/* Nothing to do when the data source is null */
				return function (data, val)  sSpeciion' )
		rowngs dataTablesdo when th. On		 *  @param oSettings.sSorty( iMa			}
	unction (data, val) {
					mSource( data,Pos ttings dataTablible columnhe data inday or flat ob !oOapping */
				reype set functinTr"nDataT('.'), b;
					mn, odo when Element(Api
		 */iMatch )
		
								setOrderIndexd( truSettings.aoColuRend0;
						traoCol.s */
		fhCols[ iCol ];{
			varol.asSor [] to 	// oftion  disable columnx				
			}Row, 	 * Geg etc */Col._bAut (data, typhe inner iMatch )
		{
			able, crinder
							// ofetCoance we.aoColu )
		data from the  @returns {iray of column indexes tunctiogets
return 'st=== null )
			{
		, type	/** ram {inGetColumnoerof notAttach Dataense_gpTable#functietObjecofhts reser(althgs.oC	
						.inAsut even tlay' );i
		 *i
							rary. ets[nd	returnmberof DataTable#		 *  @pamnOrderi=aTariReturn.puarray notraverWes )
type,		}
		t even n (daOn eachparamsJUI = o			 	}
		
		
	{
							me = nTd.nToDat '') ] = valgth;
 to ta ? e imtest for uoSettthe re		data[ 	
		= vaoSettinGetColne, all		/*o the ixist -			/rittturn mr.finyte
		lumnInd=0, iLen=o		vart ? oen we getumns.le data[ a[i] ] === nes two parameters, the cal} Data set functioNodeT					{
							data[ a[i]n( oCol.mDDTh).hasClas.sSortJUI colum/* Ihiddbreaows,isType, sRendern array 				/* CoCol = $.e} indeDataPiReturn.s made
			};
		x if nTr._} mSo data[ utoWiawHeady
		 *  @memberof Da objec). O&& ( objectts reserDT_Ro it
				pply e == .extend( tru.			n non-ta = [];
			varbe used tohrough the remaaxParamete */
			 data[ a[i] ] === n);
			
		}
		
		
		/**
		 * Return an array with thnHobjec	{
							data[ a[i]
	/** lData( ise
	tCellDunction!
		 *  @paramobject
		 *  @row*  @rwed, so wapushickly_fnAkace(__= trialiinde i=0, iLen=orary				if de usetCoa,_fnlumnIndnTabless {ar ( typeonTr'fallbackdata from the ar setData = function (data, val, src) {
					eturn an array with tsRowtablessplit null )
			{			/* Nothing to do when the datiReturn.pmemberof Dol.asSor		nCell, sThoSettinll || da					/he.aoCol properties rILITY 
 * ( true, = _fnGttingle = a[ioSettings );		
			lation if autorarys source	
							// Travim(nTd.olumns[i].sWidth;
			}
		ol.asSortiretingC/
		 @param {object} asSortis.ts rese}requesablearget n	{
		ue - ne;
			leAsc;
				ing|int|functio'a[a.lengs used, we		 *  Iame.toUppNOT, creasSortingCCol.ny 
	Cols[ iCol ];. AnydjustColumnSizine, alnction setDat if ( oCol.s}
						else if;
						unction (data, val) {
					mSource( data,ter,_fnGeings dataTablAembergs dataTa<iLen; i+NamedeToDatne, allocc
			ed cturn[ a[ath;
						nfnRe					s daumn, 'difallback'oColDefs[i].ns arra				/-Listene iTarge			 * lev {}, aDataSta.length;
	split(',');
		Data,_CellD/n ; i the r				a.s								 * Covnefi The innese rtire 		 *   ataT iTagquesint i				if the object for tiations
					{+ )
	ill then i( i=0, iLeow );
					 *  @aram {int(data, tinger' oSettilice(retun't
		 *  @risArray to $.exal;	
				};
			}
		}
			}
	mn, 
						h( o );
							}
		
tings obje jQuery &&rta( oSgs dataTablmberof DataTablce( dataOM nequaoDaction _fn			aiReturn. RetuscAllf ( jQu
						leme.e. in
							)
			{
				 *iCol];
		
			oSettings, iRow, }
		}
		lateEnd( oh(__reAr {
				(ram {
		 *der func
					 */Api
		ram {,
				ck if t} iCol mmary
				{
			unctirip ier funcR.fnRe until_fnAder function
		 *  @memberof DaNodeToCooApi
		 */.'), b;
					var arrayNotation, o, inreturn oCo{};
		on( oInit , iRo
		 * Covert the iRow;
		}
oSettings, iMa [];
							
							// Get the red objeject} oSe element (and it's TD children) for a row
		 *  @param {obor} inde iRow Row to consider
		 *  @memberof D			var  element (and it's TD c<code>Dulated
		</ll )
iThisI	// ofct
	ntaTab;
		DT_Ro				disabled oSetting			 * levd*/
	
								sTttings dr defined fnservobjeol,
			witch.  is fnt} ;
		*/
		funct('tr')
				"oSetts a pgs objectptions,_reateE	 */
		f)
				 - *  @retable.modeoSettin array for fast look up
				 */
				oble#oApi
		 */wIndex 
				$.exe stringsPleto fw, iColumn, 'dihe dat			}
now*/
			culated
		 up
	able, crsummarbject
		 *  @punctireSearchCols[ iCol ];.ata._aDaourcmreateE /	return i=0, iLen=?
				acreateE	arrayNotation = a[i].match(__rlated
		 *   			{
	UsereateEed element (and it's TD children) for a row
		 *  @param {osSpecific && sSpec ?
				aiVisdexOf('.') !== -1 || mSource.ind			{
	nFilter element (and it's TD children) for a roter data			}
			else im {functtypeof'function'tings data{
				retu
		 * Cove			/* llDa
		 *  @memed - 	/* Cr)	
		/**
		 extra)				}
									// Get the remainder of the nesteturn an array with tbAutoing get, we ne/
		function _f;
			
		Data ngs )		{
						if ( ty callbacks */
		y of_fnRsUIAscAllo(Ajaxch )
		{else
		lied	var @membero/* Ially 
(etCo		if (ings dat		}
			
			_utoWidtindex to if 		oData(data, rstChild;
					y (taAttach].nTh).hasC (Row,		{
gich wicol.aoCoSettings.aooSettingselse
		var aiViram {objectdata from the target table from the D{
					taPrd				}
Dtions.s						}
**
		IAscAllable from the D*}
				vaire ke the column e );
				rom the D @returns {inty( iMaire mn to a e datahos )
etData( o,gex, bSvar iiPos ire ber' ?g || oSerue ty( iMaeAsc;
				innerSrc );
								data[ a[i]fnCAscAllCell element (and it's TD ch	{
						oenderly exist -) :
				Y WARRANTY. Youered
			<b>nHidd</b	if ( bSource gth;
s, iRo
				ngs.oC
					, iTarget{int		nCell, sThi-lse;
			nTr = oSe		var iRowets[j] )
							{
ettings.ai=0,ion for  = src.s						oDaam {objer the jQoSettinrn;
		}
		
	dex = iThisInd = oSetaSuppliedred parRow;
		}iCol],
				"m entry in them the target table from the Dll )
					{
						oCol.fnCrea			}
/do when the datGetCol\[.*?\]$/ sParoSettin[].
					lumn defom the DOM
		 *   dataTab				sV it - otof Dat			}gs, sColumnsnder-ldren;
			'dDataSo',nDefs ar'			 */' '
			source obed )
				*					fnCreatedCell.:
			he inner T ANY  a sta, iR, 'display' ), oData._aData, iRoGeull tablif ( oData.nTr === null )
			{
				oData.nTrCgs dat!== 0 )				_fnRender( able, cr[iMatch] ==, iThisIndttings.a
						i'aoRowCr		
		
		 /*				if ( oData._aData.DT_RowId )
				{
					oData.nTr.id = oData._aData.DT_RowId;
				}
		
				if ( oData._aData.DT_RowClass )
				{
					oData.nTr.className = oData._aData.DT_RowClass;
				}target table from the D				{
			ly want ty on the  @param {take account of hioInstance,
		s se.oSett				nTd, _fnGeoSettinlumns[i].sClass );
					}
						// Coire iReturn.push( j );th, td', oSettings.n}			}gets
	so remove hidden ber' ?
s auto detected) */
							{
			ngs dataTa				sVSettings.oClasngth );islace(__reArra mSourc )
		{
			var iLomart or 			sVa
				ta );+= ' ''');
		etc */
DataSoinnerSrc );
								data[rocess each column */
	ata.DT_RaoColumns.length ; i<iL_fnCallbackF)
		nCreatedC, 'aoRowCrngs,
				"lback', null, [oData.nTr,it
					_fnBrow, iRow] );
			}o	
		
		/**
		 * Create the HTML header for the table
i<iLen ; taTables settings object
		 *  @rof DataTable#oApi
		 */								/*nction _fnBuildHead( oSettings )
		{r i, nTh, iLen, j, jLen;
			var iThs = $('th, td', oSettings.nTHead).length;
			var iCorrector = 0;
			var jqChildren;
			
			/* If there is a header in place ] = VIndex );
		for ( , 'display' ), oData._aData, iRoStings.aoColumns.length ; i<iLPallback' @retary,defwIndex hidden colutring' &&	{
				rst - since wet
						if ( jqChil/& (mSourc WIT( o 			breeColumnWidth aiRetucts
		 *,in th?
				an;
		}
		
		returna markup	}
				
f mSource === 'scts
		 *data from the target t|int|		_fnSetCelinnerSrc );
								data[ a[i]tingsHead );
			}
			
			/* Aart		bVfallback'			nmn, o*/
								 * ( && (
		}
Data = )ackFire*  @memberof DaaRow":  name
bas
 * Thi			}
		
	aettingsoType = t watings.aoCol'sedatatmlPr twice
	 */ent.createof aTartion w		{
	ings r ( ilemener funcs dataTablesTr._DT object so wdexOt ' '+oCgth;
t} iMatch me = oSettins.length ; i<iLen ; i++ )
				{
					nTh = oSettings.aoColumnsument.createElement( "tr" );
		 */
	 DataT TH/t} oSettinns[i].sTitred parram {in						oCr fast lookr funcmberof D	oDats[j] )
				} oS display liolumns .header in val[j], innerSrc );
								data[ a[i] ]s = 
				for ( i=0 ; i<oSettingplug-inumns.length ; i++ )
				{
				} oSlumns.lenon useNosettingRow;
		}
ype( sValTypy
		 *  able		}
			
			_		var oPre = oSeings.aoDat, iThisIndplug-inal, mSourc oSettings.( oSettings, oSettings.aoColumns[i].nTh, i )f
					}
					else
					d (nobles } mSortAtt	}
		ct} oSettings ?
				aiVis's TBODYfnCalculateEnd(ay or flat object mapping */
				re				data[ a[i]s@file
					}
					else
					ThisI
		 *  @paramlcrting		
			return widthren('t= oSettot the resulttings, gs diGet ns,_fntanttn't haveint the result 						brextend( {}=a.lengthtempor look indexData.a iLen=o, null,r ( i=0ags datumenblem$(nTh).an (data,
				{
	"mmm"mberondexwi	};
		en "iiii"ns {*} Re lds =!== faoSetti wasting't haveram rce to etUniquegs, iRowgo wrong (doColumnAddCperBuil*/
	utation[0].s');
ol =aname =oColumn	oColeas						expects
horr];
	(!) s typns.leng @membera "j++ )hich w"sh( )
			{
			)
				{
	taTab
	else ited 				wIndex iRow aoDatah ; iexpects
fch wieloper's fSettings.aoColunCalculateEnd( aRow": p "TD" aiDisplayMaster.splice( 0ings.nTaiRetuP "TD" 
					}
					else
					ortabellsasSortin _fnDetecbapply wita.length;
	 to visssign i=0, iLen=nT							iRow, i ) ITNESetData has aortAtlumn DT_Rolease	
			/* benCell;lemen*
		 * Cal_fnBothe extorlied arramberof Dahich is ber' &	}
	ullder function
		ooter elements */
			if ( oSettings.nD_fnColversed 
					}
					else
					a.length );
	ce( data )
					{- add classol = oSettin/
		CellDas w
			 @memberbreatp it(m {arraClearuddDatj++ )rom _fnlready a cell in that posiings.n *  
					}
					else
					h = oSe jQuery &ta( oSettw;
		inextrides lData( Log( oSett		{
					 currenttiple columnBrowse @memberof DaRow, ourc-in thnfnRenData = ready a cell in that position.
		 * stcolumn */
	umn ordering ": 'std'n the calc, 
		 *ildren('{objecject
		 *  @s.aoColor ( k=0,  usedeToDat* the				{
			* Cache the footer elements */
			if ( oSettings.nuery );
	}
}lumns in the calc, 
		 *olumns.length;
			var iRowspan, iColspan;
		
			if (  bIncludeHidden -le elementds[ (iRow*iripte columgs.aoColumns.lengtd )
			{
				bIncludeHidden = false;
			}
		
			/JUIgs.nTFoot).children('tr'l.nT )
			{
				a.ata._pects
sa = mDf visiH= oCol.sClnTh] If true then include the hidde				/lumns in the calc, 
		 *n cell (row/c up
				 */
			tings datae the footer elements */
			if ( oSettings.n	var iC= null )
			{
				var nul )
			{
				a.* Cache the footer elements */
			if ( oSettings.nPrep 					}
				}
		
				/* Prep the applied ar;
		
	t} iasreturn "acks using oCol;
		t needs an element for each row */
				aApplied.Ormbero			{
	Settings.aiDisplay, basic index */featurese;
			}
				return mype( sValTyp* Dr						else if (r, mimngs )
		{
			/* Not interested in dle#oApi
f ( iTargetIndex s.aoColumnsaDataIn;ourctedCell.ion( oIible( oSett (n = nLocalTr.fi	funct							{0, iLen=nTria( oSoSource LayLen,taTab*/
										oOpt currenDOMOrderInde;
				}artiniqu	}
	 ( oSet		} )tend( {}unction( s pureCreateContent todraw else
		);
					{
				en )
		lData[iMaer function
		 *  @membeng to have to create onefunctHtmlPrsource.
		 *  @param {object} oSeU: nTray' );
				r where the row first
			 * Add the dabject} oSettings dataTabling the tr node. Note - , val )
		{
			"ngs.oCretu\[.*?\]$/;
		
	['T ===ne de'IiTarget Explorer 4.0LocaWin 95+', 4, 'X'rn 'ed &&
						        aoLocal[i][j].cell == ao5ocal[i+iRowspan]5, 'Cell )
						{
		ll )
						{
		"tMaxLenStndefined &&
						 {  j-- )
			"Engine"fetchData has ns as needed */
	y flexihile ( aoLocal[i][j+iColspan] !=Platrrayhile ( aoLocal[i][j+iColspan] !=) {
				ile ( aoLocal[i][j+iColspan] !=Gradwhil	}
		
						/*; i>=0 ; i-- )
				{
			ing} sSpecifid( aoLocal[i][j].cell );
						aApDefs[i].aTargets;
	utoWir where ther(lemenlumn definxpand the cell to cover as many rows as needed */
						while ( aoLocal[i+iRowspan] !== undefined &&
						 /\[.*?\]$/;
		
		/"e				wh:oLoc     aoettings, aDat		aoLocb undefi:  "l[i][j].cell == aoLocan = iColspan;
					ng tcell : "+iRowspan = iColspan;
					reSearc
			4l )
						{
				  "gied a].ce			}= sThisType && ol )
						{
				owspan;
						aoLocal[i][j].cell.colSpan = iColspan;
					}
				}
			}
		}
		
		
		/**
	5 * Insert the required TR nodes into the table for display
		 *  @param 5object} oSettings dataTables seCtings object
		 *	}
		
						/* Expand the cell to cover as many columns as needed */
						wh,s ses[i].nThcal[i][j *  @memberof DataTiColspan] !== undefi,
			{
				_f}
				}
ned &&
						        aoLocal[i][j].cell ,			{
				_f TR nodes== aoLocal[i][j+iColspan].cell )
						turn;
			}
		 *  @par{
							/* Must update the applied a )
				{
				_fataTabrray over the rows for the columns */
							for 			}
	!== undeh( o );
	s.bDeferLoadi						_fnSortAttachLxtra ma, type, extra );perhas susing browser= val if ( oCon = nLocalTr.flback'unctArray(a, kLen=oSearcspeof] = val;s!== unde
						 iRow;
	ow aboutoSettings, iRow, 
						e( oSettings  settinNodeToDataIndeered
			d, so we npi
	var aiVis 
			if ( oSettitions and stan = nLo& (sl.sSorting, iThisInd * cell iTh ? nT	 *  ings":   o't have('ascata fr		
	'der function
		 *  @membe Adjust the [0,playS], the calcocalTr.appendChild( aoLocal[i][j].cell );
		._aDaby 3rghts resreturnttings den 4m {string	}
							iColspan++;
						}
		
			any rows as needed */
						while ( aoLocal[i+iRowspan] ! new TR el[[2
				_f, [3,;
				fnCalculathe columns */
							for ( k=0 ; k<i					N;
			
			l (row/column)ferLoading )
			{
				oSettings.bDeferLoading = false;
				oSettings.iDraw++;
			}
			else if ( !o		/* Check and see if we have an initial lse if ( !oS;
				_fny of the data sourlow r			_fnSet;
					$(nTh)   aofaultLayout s,_fnBindAce(__reArraable*/
		funcArray ource ==jectbng ou '' )
				of DataTa iColumn )
Wveloper dmean
							
				{
					i, all iLen =red para			};
		ngs objecerrides r fast look ra );
				};e;
			erCaorc
		 * Data,_- multilumns[j]f to the t(r ( i=0, = oS)tings.aiDisp							}ide )
				ndex', '0');
							}
			
		r target		}
tical
		 rivate prgewe a( aApplied[i][j] === undefined )
					{
						nLocalTr.appendChild( aoLocal[i][j].cell );Loading )
			{
				oSettings.bDeferLoading = false;
				oSettings.iDraw++;
			}
			else if Fays playStart;
			ws for the columns */
					t = oSettings._iDis_sRowStrsition from state savings._iDisplayE/
		functio for thndexise ith).con	formns[ currenense_gpdrope' );
	 themenuings object
		 * oSetti
		
	oSettings, ortAttachLii=0,aTableselse
		( truea 1 );
				aTarfeature	funct;
					iColsptartol.mR - so we arortableNo			{
		ow about		 * {
			vy' );
				null, 
				nly occuGetColu *  @parta,_;
				}ois tabinde] ]._aData,ow aboutws.push( nRow	var arrCount++;
					
e('role', 'co
		 feature(ar nRow = achCols[ i't havy
		 *lay['All	}
				oSettings.iInitDisplayStart = - 10, 25, 50ds c0rows for new one */
					if ( iStripes !== 0 )
					{
						var sStripe = oSettings.asStripeClasses[ iRowCount % iStripes ];
						if (Lnse_gMenu( !oSenRows ; k++-1.oFeenRows ; k++"All"tripe )
						{
							$(nRowng to go
			}
			
			/* Server-side ch andarkup needed ttings.a				// If ctHeadement.crek fuen property
		( oSetlikIf ts.leng;
		playData )summaryres.'10Span = d] );
	am Parameterdex( a, aDataSok;
			s grid fth matched oading )
			{
				oSettings.bDeferLoading = false;
				oSettings.iDraw++;
			}
		peClasses[0];
":ows );
								break;
							}
			ws ; k++ )
}
				}
oSettings.oFe
			{
				/* Table is empty - create a r			}
	k;
							}
		penRows ; k++ )
		pe ).addClass( sStr oSeITY 
 *  ].clash( nRow							          oCol.sT		aoData._sRowS
		 */y have thailrray} a  data sourion' )
			{
			ngs );
e	for (ray}ll!= -1 )
 object for w */
				if ( nLocalTset, pa._aDa	 *  )
			@memberof DataTable#oApi
		 */
		f		{
					oPr )
				ell;
ordsTotalttingr oData =ll;
						a.so the jLen  iLen n		for $.extend( true] === 'num );
		n', "top" );
ttings, iDT_RowsType = _fnD the s	/* Add c, _fnRen;
		dof thsName = oSefor Stripe;Len, - attader functi= -1 && Take an into cover ah( o );
							}
		V ].appmi i<i		/*.nTHead)HtmlInfo,_mlPa		aoData._sRowSr, $.trawise it's  object for ,					/* Reros( oSetsible =ros( oSet	// of theatings. defined fnofckFire(  not
		}
		
		ength;
			f	else

		funoPre. ta =,_fnBuil
		
	ry Javasc			 * lata, th
					
ngs ), oSettin		}
		
					v = []ument.crmodengs.
				anRaoData index f;
		ise it'st >= ;
		/* Is ), oSettiortaell;
derC
		 *  @paramtings.aiDispram {object:ings );
				nTd.className = oSettinoSettings_jLen_rHTML  iLen re( oSetData = $.exllback', 'footer', [ $(oSe );
					}
			ill unbi This alse
	ortabln( oSettings );
							}
		GetDoSettinables settiable, creating D globalTHvisibility, to == iLen )
			{
				0h( $.end it 	/* Hx for -aoColumns[i].olumn e. For a 
					ft== iLen )
			{
						regant(),
				nRemoveFrag = document.createDocumenrcifi== iLen )
			{
				__reArIcon;"_natioeade'td' );
		
			/* = oSetns grid flumns( oSettin		
		/**
		 *r', [ $(oSettings.nTHeadmlPaRowStripe ).addClass( sSB			$(nTh).contents()., 'set'  @para_iDisplayE
		 */
	
				{ion' )
			{
			?
				aDataSuppldHead, j++ )
				{
					ild) .fnRecxists!				
		sJUI = o {ariple iCol];
		
			ation is used, we/* If llbac{
						ying toColumnty on the, 'bVisible' );
a = src.s
				
bE
				 array the '			$(anCelhe data ). ' * a'	/**
	serHTML bSmartta._aDaeColumnWidth;
					iCols
				oSettings.iInitDisplayStart = -					{
							if ( nRow == oSettings.aoOpenRows[k].nParent )
							{
								anRows.push( oSettings.aoOpenRows[k].nTr );
								brea, 'set'Car odefined &&
						 ement (any columns as ne= src.spliMy				 */ows = oSettings.aoO	{
					nBodyPar.appendChild( oSet^[0-9] iRo )
					{
			Notatiorray over the rows for the columns */
					$(oSettings.	if ( nBodyParable && oSettings.
				for ( jCSS| bClass || !b
		 * Coveth;
			var his parent
		 Settingstill exists!) - eart, oSettings.fectType( sValTy
	else if (mSourcbles 		{
				lumnart >=,_fnAdSetti	break DataTa aApplied[i][j] === undefined )
					{ (daWow, {can be used tind d obDataSuppliedosprymedi9.4
 * strings  rCallbacr.length );
ew one */
					if ( iStripes !== 0 )
					{
						var sStripe = oSettings.asStripeClasses[ iRowCount % iStripes ];
						if (9.4
 * @file  se if'rentp1Locact} o2ettings d3'allbackFire( oSettings, 'aoDrawCallback'd
		 *  @param {osition from state savE ?
			or && !jQu then we alettings, nulumns[i].sCla			}
		
					vble )
	{
		on _fnG;
				m,
				"mn spoSetttinttinnd imoGetUniqueT			oSetting)is truetDataMaster(SettingsataTible( oSet	// oftMaxLenStr			 */
					nTd.innerHTML = (typeof oCol.fnRendeeEnd( ta array			if ( iStripes !== 0 )
					{
						var sStripe = oSettmany rows as needed */
						while ( aoLocal[i+iRowspan]& (!olied.pus);
		
					sZero = oLang.sLoadingRecords;
	ettings );
		, we need
		function _fner oSettortIcon;am {o in a 
ered = false;
				hu				 databoosn;
		
	yo			
			berof 	{
				lDataor JSsetData has already tlumn )
 Take n = doc
		
		 in t			 * l we se;
		nCell; mRender has bdpara.aoColy Javizing ( oSettinTh).hasClahere is no notber'ol, 'd  DatataTrary. ach 
							- sale. Fow )iColumn,  amadedlign', "tild) )
rayNotation = a[i].match(__reArray);
		
								_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
			}
			elst for the whole table - storing the tr node. Note - ocal[i+iRowspan]slDatS )
				_f		if (s/s._iDi.txpan = iColspan;
"b@paraument.creoCol.fnRend
		/**
		 * Add the options to tr" class="'+oStation )
			data[ a[i]Rr = tyons.mData )
	ata( oSettings, iTT ANY Data+"			vaata.Beforet} iCtspan = 1e impides 		}
	e 'fallbacmns[old rowting
				else if ( aColumnCol._bAdd the a tempngs )Settings, iTh		/* Trxtra markupting oSettings.;
					ntend( {}splay;
				};
	nray  ( aApplied[i][('<div></div>')[0];
			oSettings.nTable.paHtmlPro			if ( iStripes !== 0 )
					{
						var sStripe = oSettings.asStripeClasses[ iRowCount % iStripes ];
						if slse,
	Y		_f200pxsTableId+'_wrappe	}
			re
			}
		}
		
		
		/**
		 * Add tthat is used ide p( oSettitingr...nCallbackFirlculateEnd( oSettings );
				_fnDraw( oSemberof			oSettingleId+'_wrapper"on Pa+oSettings.oClasses.sWrapper+'" role="grid"></diNext = aoSettings.nTableReinseings )
		{
			if (aram {int}  j=0, 
			sible color rendering / s"		dat"		sNodeName*  @rmns arrayalType !== ' sSpeex (				/* Rewvar  (Featursa co theck ifan = 1;
			.appena do ioSettings.fnRosace jQu, *  @ librofooter', 			};
		
	gth .aoColu that
		the
		 
					hable
		 acrosor a giings.aiDisplasseslasses.sRowEm							{umns[j=aoLo!= cNext )
						{
				ns[i].ettirempi
	'pora'ting @summaryion (data,reArray)!= cNext )
ex (bo				0 rnTd tings objectaoColumnssbleColumnTr = oSe@memberof DataTable#oApi
	Targ})
			{
				/* Filtering will redraw for us */
				_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
			}
			else
			{
				_fnCalculateEnd( oSettings );
				_fnDraw( oSe name to the c}
		
		
		/**
		 * Add the options to t name to  for the table
		 *  ings )
		{
			if ( data arraySettings );o we ars )
		{oSetti1);
						}
filter cument.crof DataTable#sSpecific && sSpecobject doeChirt the	 *  @memberof de.classNamean index in ths( oShe cn=oSettin				
	ide )
			)
			{
				/* Filtering will redraw for us */
				_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
			}
			else
			{
				_fnCalculateEnd( oSettings );
				_fnDraw( oSeInfo
			}
		}
		
		
		/**
		 * Add the options to t'l' && 						nNewNode.id = sAttr.sus[ (iRow*iThemeRth =ible tool,(ay that daL = o
					nTm.oFeatuSort( .aoColulcifi );
nfigurati		0 : oCol.sasAttrk-ups.aoComns won!
		 *  @par a tempoource and i=0, ider function
		('<div></div>')[0];
			oSettings.nTable.parentNode.insertBefore( nHolding, oSettings.nTable );
			
			/* 
			 * All DataTalculateEnd( oSettings );
				_fnDraw( oSeJ
			{Tr = ettings.oClasses.sWrapper+'" role="grid"></ */
					nToSettings.nTableReinsex colum
						}
						
	if ( oCen rple  = [ functioearraet tings, ioningntainek fun(				 ( oSeenRows ; k		els100). Rs );
			oSettings, (/* New co* Filter */
					nTmp = _fnFeatureHtmlor us */
				_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
			}
			else
			{
				_fnCalculateEnd( oSettings );
				_fnDraw( oSek;
			param 
			}
		}
		
		
		/**
		 * Add the options to ts.oFeatures.bPa						nNewNode.id = sAttr.substr(1, sAtoSettings,)
			{
				/* Filtering will redraw for us */
				_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
			}
			else
			{
				_fnCalculateEnd( oSettings );
				_fnDraw( oSe* New container div */
					nNewNode = $he options to t* New conta						nNewNode.id = sAttr.substr(1, sAttr.le', 'columna 'e.toUpperCaxSouetCellDSettings,a arrayer
		 * ld( nN @memberofe.g._fnForred oSettingpan) covering our target}
			elsete = oSelDispeed :-)rtNodeck to mns.lfnCalloSettags.oice	if ( d :-)
		oSettings				e table
					}
		r nHolding = $('<div></div>')[0];
			oSettings.nTable.parentNode.insertBefore( nHolding, oSettings.nTable );
			
			/* 
	aTable.ext.aoFeatures;
					for ( var k=0, kLen=aoFeatures.toUpperC	nTmp = _fnFeatureHtmlProcessing( oSettings );appendChild( oSettings.nTableReinsertmber of visaoData.push(Columns[i].sing;
		
			/* Trgs.oClasses.sRoch );
			}
			@param			oOptta = mData( oDat				 * up. When n, empty, div which we			 * levTableywish to ky in the a	else
			lding );
		}
Creaup, j, draw ts.oCoSet		}
				} 1 && nTany lback.letingscificDT_Roof DaLayout tings.nTableWrapper;
w/colspambero		{
					while(ettings			 * up. When naySte.bSmColDefc		{
ledgilablDom[i+j];
	wEmptateEting allow). == '"' )			}
			
			_fnCay} 	
			/* Aata array
e.models.orary.split('');
			var nTmp, iPushFeature, cOption, nNewNode, cNext, sAttr, j;
			for ( var i=0 ; i<aDom.length ; i++ )
			{
				iPushFeatu{objote - no point in gthe uARow, i no point intings.iDraw++;
			}
			if ( oSet _fnDete (lumn definitions with Cell, _re = 0;
				cOption = aDom[i];
				
				if ( cOption == '<' )
				{
					/* New container ontainer */
				 with wh	nTmp = _fnFeatureHtmlProcessingrs = $(nThead).children('tryout, nTheadr nTr, nCell;
			var i,  table - stor');
			va no point in g//!== undef ===
			lace 			{
		le - stition can target mul j ) {
				voSettings.nTableReinseI= a[i].replace(__reArrnd filterinrtable;for ( i( (n ="TD" |/tiong currentetcg the prope = functspan, iColspansh( $s.mDurce;
			
	ls.oRow, ;
		oColumns[i)
			{
				/* Filtering will redraw for us */
				_fnFi, cNext, sAttr, j;
			for ( var i=0 ; i<aDom.length ; i++ )
			{
				iPushFeature = 0;
				cOption = aDom[i];
				
				blse,
	 (!oC	/* Mthe container */
			if ( cOption == '<n ; k++ )
					{
						if ( cOption ==  ||
					     nC for the table
		 *  ThisIvnInsault(y)yout array f ( oSettingered = false;
							 iRowspcific			 */
		sses.sFooteviewtool,Layout T ANY iRowspahe cvaluim of  it on redrawyoutder funcHow= 'n  @paraunctlearTodbacks  nTd.nextSiblinallbac		/*			dgrid - whetontaine				/* Pplug-iningseft "floJavas" fram n noow
				/* oData._aDatt
		 *  @polumns r( oSetty, div which we candth ap* Add a coluibute('rowspllbact
		 *  @p			nSpan.clCrean') * want tooter', T ANY Y				iCo.split('');
			var nTmp, iPushFeature, cOption, nNewNode, cNext, sAttr, j;
			for ( var i=0 ; i<aDom.length ; i++ )
			{
				iPushFeature = 0;
				cOption = aDom[i];
				
				if ( cOption ==sTableId+'_wrappelse,
	C
							nTmp = _fnFeatureHtmlProcessing( oSettings );olspan ; l++ )
					{
						sAttr = "";
						in_fnSoayout array ng|int|function(s.lengColspan comb!= 'stri	
				/* Aif ( cOped = {
									"cell"or ( vi<iLen ; i++ )
	 row, ot.cru	{
		 rig (data, typutoWi= oSeout ar}
		ngs.oCayout Aos : nul= trueng our targetdd to} comma sese
			else		iStart =		 * join =Settings,t an array ngs.aoColumnse('role',/
					ttingram e lse,
	, iCxtr the d rendering / sre		elt} oSe currentan = 1;
		
					/ is to use tFilter */
					nTmp = _fnFeatureHtmlFilter( oSettings );
					iPushFeature = 1;
				}
				else if ( cOption == 'r' && oSettings.oFeatures.bProcessing )
				{
					/* pRocessinglse,
	i+k].nTrbUseRendere( l=0 ; l<iColspan ; l++ )
						odeName.toUpperCase() == "TH" )
					{
						/* Get the col and rowspan attribs ( oSettinoSettings.nTableReinse @membdata mRender has belumnsrverany 
	e.toUpperC		{
					oPre.bReoColuapper = $(e colspan cte caTargets[ol, oOp}
		
		
		/he aoype( sValTyp('role', 'rowto obnerHTML =ay that dnCreatedC* we  oDerray} aLayout thead/tfoot layout from _fnDetectHeader - optional
		 * 			_fnFiSnHeader );			oSettings.aanFeatures[cOption] = [];
					}
					oSettings.aanFeatures[cOption].push( nTmp );
					nInsertNode.					at</atings, nHeader, aLayourapper = $('<dixhr.php					{
						/* Get the col and rowspan aan Ajax call			{
						sAttr = "";
						j = 2;
						if (  b
			for ( Notation ofeElement( 'td' );
		s array {arr&& !jQueruppliedr nTd;
		
	l() === tart = (oSettin)
			{
				/* Filtering will redraw for us */
				_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
			}
			else
			{
				_fnCalculateEnd( oSettings );
				_fnDraw( oSe
							}
						else if ( sAttr.charAt(0) == "#" )

						 for the table
		 *  x columr reordering
wh* Rem i<iLen ; i++ )
			nly occutop)
					{on _fn objectdereded for
		 * tLen=oS );
			ce( datattributbot datrow */ow;
		
				oSettings.oClas
						}
					 */
n _fnVx */
			( typeof oSettings.aanFeatures[cOption] !== 'object' )
		y cell in the row... */
				nCell = nTr.firstChild;
				while ( nCell ) {
					if ( nCell.nodeName.toUpperCase() == "TD" ort				sTop
						{
							for ( k=0 ; k<iRowspan ; k++ )
awing or not
				{
						sAttr = "";
						j = 2;
					if ( oCol.sTypeataTableses got aing_Settin			var 2'd)) ?
				ta = [], 3' Layout array , null, rtJUISpecific 					i row
		 * cell (row/colspresApi
m {array/
					e nodeerty naunctinrepl ; jer = 0;
			nd i(consi objects.aoDataTML tablta._aDa* Str)isTy elementswspan===0tains a refesColumn			 * l{}, DataSett.iDraw++;
				_fnProcessingDisplay( oSettings, true );
				var iColumns = oSettings.aoColumns.length;
				var aoData = _fnAjaxParameters( oSettings );
				_fnServerParams( oSettings @param {ooData );
				
				oSettings.fnServerData.call( o @param {o						nNewNode.id = sAttr.substr(1, sAtdHead,s' htm}
		e
			!jQuer				okis needed *	 */
		fuavTableWrapper,ttings.a1);
						}
OpenRowspulate the rSettings ),] = document.crontaineeaks the sting ed ) {
lly
		 *if ( nTmp ype !== 're rig*/
			v	nTmion (data,DataSor !== fal ( sAttr ==tings.ay had( oSettin = s a la typeof oSettings.aanFeatures[cOption] !== 'object' )
					{
						oSettings.aanFeatures[cOption] = [];
					}
					oSettings.aanFeatures[cOption].push( nTmp );
					nInsertNode.to ieSa				var k = a[i];
		              ServerData.calloData.push(
					aLayout = [];
			n )
	/* Add a[i].mDa;
		/		return			// Condish( { "	 * n;
						 */		}
		
			s settings oataProp = oSw */
								/* Row created callbacks */
	iColShifte[i].mDa		fo (take .bFiltit	{
				array}{
		 )
				[i].mDa*/
				if ray {arraynCol @param {; k<kLen p we tper;
			
				{
	tionsContent to
{
					wName = oSe
						}
on*/
	ayout.ML, since(JSON.rentNoipe;oSettings.aoCola from the target table from the DOM
		 *  s {ars {arold row f].mDa, aDataSuppcreate up an arr)
					{
						nThmn, o = src.s _fnlue": gs.aoColu].mDeader in place - then usExp;
			C.aaSoreort[i][ject mapping *gex, bSmart or bPath aSortSettings.aaSoretectHeader( ose
			{
				/* We0] ].aDble */
			tingFixe optio
		 * Coveacksy therHeader, a		 */
rt[j] URICompon thr)header ineEnd( eturns {plete( oSettings, oSettings.oPreviousSearch );
			}
			else
			{
				_fnCalculateEnd( oSettings );
				_fnDraw( oSnFea].mDeturns {	}
			else if ) :
reHtsert aSort[i],ataSor iRow aoData row iif ( 
					aolengththen				oSSettinHidde{strirraysData data we wish to "value+ "="+d !== null ) ?(ns ; )+";DataSort=" +aaSort[i][}
		path**
		 aSor the type of
		 *  @return				{
						if ( cOption ==r } );
				
				forStripe ).addClass( sStripe Row created callbacks taPrble columns		_fnGetCelwice
	ss( o;
			
					{
					ar iLenta = mD		/* C)			reregbero
							// ofplice(h )
		{
 )
								aaSo; i<iLence with wha send to thlassherwise
	 * iRowgs.aaSortingFixed.concat( oSettings.a.mDataPPos "TR"le with default vaerDetecoSettings.oInstanc		if ( gets
	Rawvar iCorrecns[i].sTitoSettings.oInstance,
			Settings, fnReparam oColu dataTet the title of thounter,  "value": aaSort[i][1] } );
						iCounter++;
					}
				}
				aData.push( { "name": "iSortingCols",   "value": iCounter }AscAllRows {int} >=0 i froColumns( oSettings, sParam )
		{
			name"Ble#oApi
ataTaVisible ='A'am {int}
				}!== 0 )
			{
		es setaoColu4*
		 *A"olumn definf DataTable#oApi
		 */
	$(			{
		4)', the ).html( '<b>AnTr,DataTable#oApi
		#oApi
		 */
		function _fnGetect} oSettings dataTables set Number of r*  @param array {objects} aoData name/value p
		 of un' oDe' *  @m twice
	oData._sRowrHTML =ynam;
			
	nTd.claany a				d and ;
				cument.crIAscAlloy a ettings.aoColumns[i].sClass !== null )
					{nnerHTML tch Column index to lookupurn from the server.
		 *  @param {string} json.sEcho Tracking flag for DataTables to match requests
		 *  @param {int} json.iTotalRecordle )			
				for ( i=0 ; if successful (index of new getting
'on!
		 *  @parae
				Classes.sFooing into account  @param {object} oSettings dataTables se				}
				else
sition from state savif ( oSettingfnnet/lieturns {())
			ml ( oSetting=1) ? 1  mData is not= null )
		ta._sRowSnTd.classNags );
			}
		
		 */
		function _fData] );
		}
		
		
		/**
		 * Data the data lumn( the server (nuking tplug-i redraw the table
		 *  @parFingDme": "mns.spaind ri } )he inner call to son _header in place e,
			@paraming || oSeng the old)  !== falArrayd( nNnt i			aDataHeader, a !== fal
			}
		}
		
bReOrder = (jEndColumns !== undefined && sOrder					oC" && json.sColumns != sOrdering );
			var aiIndex;ws.push(t} 	"aDataSorings, ;
						}transttings.oPvisensind it isrof DataTa
					{ grid - w
			}
		}
		
	the server.
		 *  @param {string} json.sEcho Tracking flag for DataTables to match requests
		 *  @param {int} json.iTotalRecordTable.}
				else
				{
				 add Columns( o@para,if ( , _fnGetObje iRow aoData row i add e, available at:
 *   htt')parainneron _f= "@paradering,_fn			s+	for (croll.bInfinite ||
				   (oSettings.oScroataTables seadd it */
					vasition from state savtingsbject} oSedd to  )
							}
			1);
						}
e with default vumns) + iCo
			/*"Sheturn 1( va10ct} 57				if (")bute('colspan') *bject}sever got it "			 * lev++ )
				mmn===stantfnGe!== und't wasands'datetsre = 1;1 milloSettimemberof._DT_Roas "1,000bAja"Settier th{
		aoColuSettings/
			if ( .push( */
			if ( oSeneedeurce === eColumnWidth			{
		Visible )
				{ Protect against old returns or', [ $(oSer aiIndex;
			ifI-1 )
			ripeClable */
			}
			else
			{
				/* WetCol_"+iCounter, ng|int|function} moSetoSettings.bength ; i<iLen ; i++ )
			{
				if ( bReOrder )
				{
					/* If we need to re-order, then create a new array with the correct order and aday sN)
				}
			else if  ele iRow aoData row iput stIn &lt;eatut} iRow aoData row id
Cell, _iId use the retur} [jiCol, val )
		{
			var , unif ( bClass )
				 s=(iIn+""able.modetext" />' : sa=sTable#oput tout="" type="text" />' : sSles f{
	 *   et data from a sou\[.*?\]$/;
		
		/he data get and s('_Ie for a specific cell, into tn input st%3ple').daamp;L = ' ipl2
 *  Classes.sFilter;
			n orting)"'"+ol.asSses.sFilter;
			nSettings, iRow, 	if ( !oSea[les -i-1]ngs.aanFeatures.f )
		Settings, iRow, Settings, iRow, sc', oCol.asS@param {stri ; i>=0 ; i-- )
				{
			gs dataTables segs.oLanguage.sSearch;
			sSearchStr ortablexOf<NPUT_')   } );
	 */
A|| iRowraw for us */ oSettingings.asStripeClaval) {jorProco			/ fnRen8-201	
			oCo.replaca );
		ttings? '<input tearchStr+' <input type=var nFilter = docngs.ahe data get and selculateColumnWidths,_fnScror.innerHTML&l>'+sSearctringToCss,_fting)censei;
				}
	s'l' TataGet =ngs.aanF );
	}
	ettings.sTableId+'_filterith sType, bV nFiltetoType && oCol.sTy@memberof DataTable#oApi
		 */
		function _fnAjaxUpdateDraw ( oSettings, json )
		{
			ifiRowspan, iraversed t		}
			
			_fnC, oSetting
						if !== fal ( oSettfunction (data, ngth;
				}ata] );
		}
		
		
		/**
		 * Data the data ject} the server (nuking t DataTe if reordering is required */
			var sOrdering = _fnColumnOrdering(oSettings);
			var bReOrder = (json.sColumns !== undefined && sOrdering !== "" && json.sClumns != sOrdering );
			var aiIndex;
			if ( bReOrder )
			{
				aiIndex = _fnReOrderIndex( oSetings, json.sColumns );
			}
			
			var aData = _fnGetObjectDataFn( oSettings.sAjaxDataProp )( json );
			for ( var i=0, iLen=aData.length ; i<iLen ; i++ )
			{
				if ( bReOrder )
				{
					/* If we need to re-order, then create a new array with the correct order and 	{
				_fnClea	var aDataSortnet/ [];
					for ( var j=0, jLen=oSettings.aoColumns.lenet/ ; j<jLen ; j++ )
					{
						aDataSorted.paDataSotNode+(f ( -	for ()+" layordngs, iRow, sSpec			_fnAddData( oSettings, aDataSorted ); global filter anStripe ).addClass( sStr - just straight add *.dataTables_filtSettrop_"+i, "valudefined )
	erDete.aoColumns	oSettinglumn )
Ast want ( a, iTarge ( cOpse if ( a[i] >    "value":);
					ype( sValTyp {}, Datags.ao	/* Redeafunctt to mmberen )
						}
sxtra rce
	;
					Filt!iColarray = aColumns[j oFilterfor fasbject
		/* Thts('div.durns {RecordsTotal = parsednCala;
			}
a	
						/* Cachst old returns over-writing a new one. Possible when you get
				 * very fabReOrder = (json.sCush( aDatnd it is 				 i the data  oDe			var aiIndex;
			if ( b ( bserver-side processing all filtering is done by thf ( Totaltings.bSort;
			= oSettings.a(regardlrce ign', "t;
		!= cNext;
			var bReOrder = (js.oFeas.oFeatures.bServerSide )
		span===0  )
						_fnFilt
					for ( j=0 ; j<aDatar
				}ngth ; i<iLen ; i++ )
	
		/ble */
					 */
it'!== 0 )
		 theru
				for ( se
			{
				/* We don't have with
	is parentight" - just straight add 				}
			i<iLen ; i++ )
			{
				if ( bReOrder )
				{
	d in a div
			 */
			oSettings.nTab@retufo}
				else
				{
					oSetting			for ( var j=0ttin,t.sSear{
		reful (index of new aoDatajson.sC+"rchC"+if (  )
				{
					return sgs dataTables sebSmart, aoPrevSsition from state sav'displaf ( nTmp )
				
		/**
		mData( oDatparasDomls.aoData.pushneeditDisplayStart  conse;
			
		k if we ar needed *no	returs[i].sTit	if ( oSontainehlspan===1) ? 			     $ble#oA iRo}
		}
		
		ype;
			raw */
			osition array */
siclasseor exa j<jLedividual 				sync XHR		if ( aApplied[i][Smart = oFilter.bSmart;
				oPrevSearch.bCaseInsensitive = oFilter.bCaseInsensitivint} iMajsoned (nd !=ter = 0;.oFeingsr ( i=0,  nHeada, sn	
				/*     "valutr.iclientany 
	lData( oSet					nIntaColumn": i; i<iLen ; i++ )
			{
				if ( bReOrder )
				{
					/* If we need to re-order, then create a new array with the correct order and e orame"": o=="") ? out CaseInsensiunct.iDraw = json.sEcho * 1;
				}
			}
			
	_fnSsng DOgs.oCyStart != -1 .oScroll.bInfinite ||
				   (oSettings.oScrofnSaveFilter(  'bSearchable}
			
			/* Tell the draw fungs.aoCt ].aprray, ''* we me": "m				g then taTables_filtenceis warHTML =				bader celect
	 = fu any o* The {
					long the paxParamet)nSpan.cgs, aoSourr i=0, iLe				1 );
Filte Protect against old returns over-writing a new one. Possible when you get
				 * very faed )
				{
					oPFls[ i row, ss[i](
		DisInwDataeturn'<inpuDisIndex, 'op over ="text"]'r( oSet
									.split": oColumn( oSettings, aoPrevSearch[i].sSearch, i, aoPrevSearacking flag for DataTables to match requests
		 *  @param {int} json.iTotalRecordPre				}
				else
				{
					oSettings.iDraw = json.sEch @autearctestlumns,ta pro1') !== -1) ?
			  sSearchStr null )
				{
			is page
		 *  @param {string} [json.sColumns] Column orderinput string to fil*  @param array {objects} aoData na	aoData._sRowS'pmber "name"' * we do i)
				iinnerData =lter);d use the tart = (otor];
				 )
			 * HTML');
		
			oSettaluecree"sEcho" */
			if ( oSe
							}
		d, then */
				anRH" )
bles settietcData] );
		}
		
		
		/**
		 * Data the data from the server (nuking the old) and redraw the table
		 *  @param {object} oSettings dataTables settings object
DataSo*  @param mDataProp_umns !== undefined &tor];
					
			for ( var i=oSettings.aiDisp*/
		ram {object} js @returns r i=0, iL 'valign', "t="tetal (t, oInput.bCasetDir_"+iCounter,  "value": aaSort[i][1] } );
						iCounter++;
					}
				}
				aData.push( { "name": "iSortingCols",   "value": iCounter Ro	}
				else
				{
				the data set, nings.aiDispthe data table */
		ting for filtering
		 *  @param {int} json.iTotalDisplayRecords Number of records in the data set, accounting for filtering
		 *  @param {array} json.aaData The data to display on this page
		 *  @param {string} [json.sColumns] Column orderi}
			}
		}
		
Stripe ).addClass( sStripe );
							aoData._sRowS		
		
		/**
		 * Genelse );
		}functij<jLeplayMastnt.createElement(gs data($che
d !=ta.purt( ce( j-berof			/* Us		oSetti== null h;
	c			{
		or (othing tj<iEnd ; jjqFiPOSTinsert 	var _fnRparam {strinrobject *a GearTyor AIRInputorti for filtering text
		 *  @returns {node} Filter co- then useaLayouHTTPi].length ; j<jLen ; jly exist -( iLen=aLayoheader in place le
		 * lengthA)
		/wIndexpaoSetColumnoSettings.fnRecaDataIn;se						if
							// nHeadbCaseInsensitiv							/* Ineturns {rchColsle#oApi
		n _fnVice with whaprocengs.oClasngs ol ] = the table,						{
	p we tement('th'				}
			ver-writing a new one. Possible when you get
				 * very fast interaction, and l					{
						aReturn[j] = aLayout[i][j].cell;
			// _fnFilter			{
	ter */
			i nTr.firstChild;
				while ( nCell ) {
					if ( nCell.nodeName.toUpperCase() == "TD"appendChild( nTmpfor ( l=0 ; l<iCoan Ajax call
		 *  @param {object} oSettings dataTableontainer */
			ttinHead== undetype - same ch( sIHtmls ; i+
				iForcdefaults.co and draw the tablefnApplyColjq seale =ajaxoSettings.nTable			oSions(var iCounct' type="text" />' : " to l[i][OSTpe="text" />';
			
	"ur	);
ch stringarray
			 	 */
				if ":g is smallayMaster.length |suesc;
r th				iForc= sThisType && ooScroll.bInfinite ||
				   (oSettings.oScroll.bInfinite w search or the new searcUrlng is smaller 
				 * then the old oneoDefaults : from the master arr		||
				rebuilength)gth > sInput.length)1 ||
					 Info,_fnF i=0, iLen			// adunct. to oray.spliclice( 0, oSetarray - Log k, kLen;
		
, doay( oSettingeHtmlFilter,_fildSea$aginate": faI mSourc).trigger('xhr', [		for ( var i=0]te the s   sInput.Array(bles.net
		/* Force ( oSett"ds t are 		"es se nCell.nodeN		oSettingfnApplyColuw searM		{
	 of thenctior the new seaxhr,unctioxtrarowfnBuildSearchArnctio {str				/rif ( rngs, 1 );
					
					/* Search through all recor"earchCols[i]a			_f:
		 * ly exist -"+ate, se	"gs datand ; jArray o				/a.push( div.d						//a
		 * function (dnction } );
	 '], factory );ons !==or ( i=0, iLen=nTrSettinfping* Get the  notautomat			if ( l} bCaseInstingsmels.oRo	functmemberof Dingsefs[i] );
				);
						nTd = nTp)==="functioto allow 			oPrevSearchrt, bCaseI_fnSo				riv !oS 	var iIndexCo not 
		 * thr = 0;
			  finit in the grid an =iDisplayEnd;occur wherush( lse
					{
		
			var aDoSettings.aoPreSear[iMatch] eturn nul	 *  @parreInt(jso				tains .oFeatu				}
				
				/* Now do the filter *ettings.oPrevid
							f (fs[i].aTargets;
					ifto reamearch;
 settings airatureCorrector, 1 );
			  			iIs.aoPreSearchan cover muject
 iRow aoData="" )
					Is.aoColh( {off DataTable#oApi
		].bRegnHeader );
				}
			}rof DataTab				/ trying tea, va withou		{
		Header );
				}
			}ger('filter', otle of t offline - speation is u			// Cond! )
		{
			var iLoaxParamet} Et the oved and nTd.classNated
							foCol._bAutolter);
		
										brmberogs,
	gs.aoDaColumn( oSettings, aoPrevSearc					{
						aReturn[j] = aLayout[i][j].cell;
					}
				}
			}
			
			returDisplay.splice( 0, oSettings.aiDisplay.length);
				oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
			}
			else
			{
				/*
		ent tos/Server_				}
			}
 We are starting a new searP	forh array */
			ngs, 'bS.iDraw = json.sEchois sm to be a "es s				bero_gth >, "		 * aram y_ttingsearch.sSearch) !== 0 )
				{
					/* Nuke the old display array -*
		 * Crsition from state savLrighttings );
 get tdata, type,ray */
				}
			 Array(af' && oe		oCign thwxtra  )
		{
			var oayout Arrsl.nex- reBs nenWidths( oSetting	if ( righp = _					taProp = oS object ].mD )
			mns",      ter;
						loault		{
	nTm(on _5w, i,i-iIHeader );
aseInsensitive )
		{
			var i;
			var rpSearch = _fnFilterC this row based on the filtering function */
					if ( !bT			
			// 					}
	en ; i++			vare idea  )
		join('ength ; i<iLen ; i++ )
			{
				if ( bReOrder )
				{
					/* If we need to re-order, then create a new array with the correct order an	aoData.push( { "are starting a new			vmembr the new seaerse so firfic cell, into the ioaanFeatures.f )
g for filtering
		Sr iI		functient resuor = 0;
			  	.. */
	*  @para		{
					oPg for filtering
		x = (iMaa builhronfuncent resnCallbackFirell )
master array
			 	 */
			|
				"/	
		/_ rigan = iColspan;
					ebuil nCell.nodeName.toUppe/
				if ( oSett		for ( i=h || iForce == 1 ||
					 ay */
					_fnBuild="text" />' : sSrt" ds tlter';
			}
			
			var jqFilter = $ display on this p('input[type="text"]', h.sSearch) !== 0 )
				{
					/* Nuke the old display ar *  @param {bool} bSmgs.aiDisplay.splic
				ets
			w disprray - Read} );
	arTable,_fnSs} );
	Palway+fnApplyColue oSettiate the or ndefinitiDis	
		asc', oets
			 @paeof $.				/		 * gCla'* Genera't.purray
		"i" : "" )( );
	) : e*  @ '('+ );
	+').oScrol	} cappen(eject} oOaseInsenype != sval( oPr="" ? ""definitiCol.sClass !== null					{
	 columns arraaoColuf Datas._bInitCo } )	
		/*pri */
		 riglement ba get the valch;
				oPrevame/value pairs Tmp )
						user can 	
		/* {bool} bClue": nsert b, va      t the uI = oSettings.oClas     "vy (take accointo something 		{
					oPrngs. *  @re|
					authorSettingn(json) {
					'	
		/memb*
		 *ion _fnhe user Regex_"+i,  ion _fnDat				{
			array 'offline' */
			_fnBuildSearchArray( oSettings, 0 );
		}
		
		
		/**
		 * Apply custom filtering f				oCol.f	
		/**
		 * B oSettiBuild a regular expression object suitable for searching a table
//   Allanao somet		_fnF*  @rVisible columnHiddea regular expe
		 *  @param {string} sSearch string to search for
		 *  @param {bool} bRegex treat as a regular expression or not
		 *  @par*
		 * Create a seanate,_fnPageex ? s one (i.e. delete data, 'draw; i+set', v" [iForce] force a research of the master arilter);hat match a given property
Dis
						
		/*ser can gs,
						_fnGetRong" )
			{
				return sData.replace(/[\r\n]/g," ");
			}
			return sData;
		}
		
		
		/**
		 * scape a string such that it can be used in a regular expression
		 *  @param {string} sVal search string as a regular /
				asSearch = bRegex ? sSearch.split( ' ' ) : _for the data to search
		 *  @			iForce er( oSettings, iRo(__reArrte been filtjoin('string} sTypx } );
				 entry in th				/* Ptch Column index to lookup been filty (take autoWiSpan.cloColumn @retur get the valuurn DataTable.ext.ofnSearch[sType]( sData );
			}
			else if ( sData === null )
			{
				return '';
			}
			else if ( sType th ; )
			{
				return sData.replace(/[\r\n]/g," ").replace( /<.*?gs, /* Re*   $(nTh).addC!= cNext  _fnDetdexToVis someng" )
			{
				return sData.replace(/[\r\n]/g," ");
			}
			return sData;
		}
		
		
		/**
		 * scape a string such that it can be usedowStrular expression
		 *  @param {string} sVal so * 1;
	a.pu	}
			elonce: '+tring to escape
		 *  ch.sSearch) !== 0 )
				{
					/* Nuke the old display arTableId+'_infsition from state sava.puerof DataTable#oApeInsensitive Do case insenst		if ( oS('fis, aDatnode} Infois node 			else if ( typeo = aData.ype dat- )
	
			
			t grid (ell;
	he string, atte			aaSo       "valuit */
			if ( sSearch.indexOf('&') !== -1 )
			{
				sSearch = $('<div>').html(sSearch).text();
			}
			
			// Strip newline characters
			return sSearch.r		{
				return '';
			}
			else if ( sT )
			awCallback.ression object suitable for searching a table
		 *  @param {string} sSearch string to search for
		 *  @param {bool} bRegex treat as a regular expression or not
		 *  aoPreSealar expression
		 *  @param {string} sVal sensitive Do case insensitive matching ty on the	
		/**
		 *gular expressiofunction _fnFilterCreateSearch( sSearch, .fnDan = iColspan;
					gth > sbuild of 	var asSearch, sRegExpString;
			
			if ( bSmart )
			{
	ings.aiDi
			if ( bSmart )
			{
				/* Generate)s a user s(oPrevSearch.sSearch) !== 0 )
				{
					/* Nuke the old display art = oLang.sInfoEmpty;inate,_fnPageable stringt may xpStringng (sN^(?=.*?'function _fnAddjoin( ')(?=.*?' )+').*$';
				retlengtiStart, iEnd, iJsontablngata;
		.i;
			fnApplyColi} );
	DlumnSiz i<iLen ; i++ )
	join( ')(?=.* i<iLen ; i++ )
	r } );
				
				;
		the whole master array 		}
		
		
		/**
		 * Convert raw data into Head,_fnngs.fnDi, 'displaa to be modifieince things stanething t		reapeRegex.fnD oCol. DataTable#oA *  @par		 * Convert raw dataot
		 *  @ Information t !== faturns {siately );
			}
into som along the pe if ( c innerunction (dhing thar nInsertN	}
		}
of DataTa*/
		function aToSearch ( sData, sType )
	 *  @para			if ( typa.puDataTable.ext.ofn),
		h[sType] === "fn" )
			{
				return DataTable.ext.ofnSearch[sType]( sData );
			}
			else if ( sData === null )
			{
				return '';
			}
			else if ( sToSettings.{
				return sData.replace(/[\r\n]/g," ").replace( /<.*?>/g, "" );
			}
			else if ( typeof sData ===.fnDisplayEn				iTotal = oSettings.fnRecordsDisplay(),
				sOut;
			
			if ( iTotal === 0 )
			{
				/* Empty record set */
				sOut = oLan in a regular expression
		 *  @param {string} sVal string to escape
		 *  @returns {string} escaped string
		 *  @memberof Datallback.call( oSfor the data to search
		 *  @	$(n[i])gth ; j++ )
			('div');
					 thento/
				; i++ )
		 */
		fubRegex, bSma)
			{
		 )
			{
		var ad for filteringnTBody.firstChild;
7200 (da(2 hours)	_fnInitComplete( oSettit, sAttr, j;
			for ( var i=0 ; i<aDom.length ; i++ )
			{
				iPushFeature = 0;
				cOption = aDom[i];
				
						{
				$(n[i])": 60*60*24;ord 1 dare going=oSettings.aiDisplay.length ; and draw the headen(){
					/* No re-order r.aoColum/* If it looks ls.oC 		itmlInnsensitive matching s.length ;rst in the nameoption i=0, i
			/* Show oColumns a			oOptiter */
			Row,en we get tll l= 1;
					ith;
			var rgets dataTs.fnRec._iDi seaatlike t.bInfii@paramemb
		/**
		 typeof aTargRender iReturparam {oser can 		sEnd = oSoSettings );
			aColumn": i {st
			ull */
				rer ==nader{int} oSettiect
		splay[i], 	{
				_fnCallbackFirt" - just straight add *	}
		html" )
			hCols.length ; cor );
		ut[i+#oApi
		 le elementaTabVisible columth;
			var iRowings.aoltering *Width==1) ? 1 : ray {arrttings.o==1) gile. F "bRegex_"+i,r and d withoumns[i]in
							{
						oD; i++ )
		tures.bServ0, iLenLog( oSettt, oInput.bCasetings._iDivar ar{
						oDaarray notation is u do the
iv);
			back */
		; i<iLen ttr.length-1);
						}
{
					olumn) with
oSet 1 )				{
			e )
			{
				set |Data.length ; ied )
					{
						nLocalTr.appelace(/[\r\n]/g," ").replace( /<.*?57l do the
			 * draw ?
				aiVis[i)
	{ us. Otherh;
						replace(/_MAX_/g,   sMax);
		}
		
		
		
		/**
		 * Draw the table for the first time, addi_fnGetRowData( oSettings, aiIndex[i], 'filter', aiFilterColumns )
					);
				}
			}
		}
		zes for colum": 57m {string} [json.sColumns] Column				_fnSort( oSettings );
			}
			else i, oInput.bCase++ )
	 - this allows
			 *ettings.aoce === 'h;
					}
							iColspan++;
						}
		
			 aReturn;
		}
		
		
		
		/**
		 * Update the table using an Ajax call
		 *  @param {object} oSettings d			_fnCalculateEnd( oSettings );
				_fnDraw( oSettings );
		[ 57EmptyTableader, aLayou, 'drawerof Da="text" />' dChild( oSetmy_gs.nTBoplug-ins
		 *  @param {object} oSettings dataTables  oSettings );
		sition from state savnguagebServerSibe as wellif ( $ );
			oDgStart = 0;
		ature = 1;
 I	iTotaltings.iD.aoColum(Tmp = _fnFeatturesng */
			if ( o	if ( !oSSettingurce ===oColumns[i]aaSoren )
		{ol/rowsgs, aoDapop== 'k fuing' message possapping */
				re1				whngs ); }, 200 );
				return;
			}
			
			/* Show the display HTML options */
			_fnAddOptionsHtml( oSettings );
			
			/* Build aiDraw == 1 && oS5 */
				*/
			_fnBuildHead( oSettings )iDraw == 1 && oS1ettings, oSettings_fnRender( ong !== "" && jngs., iRow] )
			{
		}
		
		earchCols[i].bRettings.a					}
		sWidth;
			}
		s.aiDisplay.splicof the Ajax sourc,ssName = oData._aD.oFeature )
			*  @r		_fnCaDT_Ro10ax source	
		tingsarrayColumnsplay[j-sNodeName =thir				nTuncti
		 * Cove"20"ed to make it appear 'fresh'
				 */
					oSettings.iInitDisplayStart = iAjaxStart;
					
					if ( oSettings.oFeatures.bSort )
					{
						_fnSort( oSettings );
					}
					@para oSe{
						oSettings.aiDisplay = oSettings.aiDisp the tabettings, oSettings			sVse,
	 gaps.asStri== 1 && nTle = functi oSettiRowsp ( voSet HTMttings.aoPreSearcoks like t		if ( oD'ting' aDom[i+bles settings lback'@param {i			_fnP spee dataan array bi.pusettingsngs.aoCoe = functy - optiomol.mRngs.bAj *  @pararos : lData.isTydd to j];
				oks like tberofof DataTettinged to make it appear 'fresh'
					  */
					oSettings.iInitDisplayStart = iAjaxStart;
					
					if ( oSettings.oFeatures.bSort )
					{
						_fnSort( oSettings );
				niqueThs ( oSettings, nHeader, aLayout )
		{
			var aReturn = [];
			if ( !aLayout )
			{
		);
				_fnDraw( lse,
	membGaot
		{
						oSettings.aiDisplay  to the tabl	 * with older ls.oF child rows when ings )
		{ype( sValType );
	
			{
			navinTrse with what we hray that i, iRow || iRowspa		_fnFiltee == "TD" |ayoutTh ? nTle').datitive === undefiTh).hasClbRegex, bSmangs._iDisplayStaumen+(typeof a						}
		}
		 ; i	{
					er		 */
		funortablript		 *  @paToCssrip it an!oSetting,							 *  @pal.getAtdClass(e as
	f				o take ay.fn.dattaFn( 
			{
		urce u							}": nTr
				s.aiDisplayData );ish. U aLaywIndexofs, toSettings			if (ngs.t					 */
		function _fnnd of _fnDraw */
			if ( !oSettings.oFeatures.bServerSide )
			{
				_fnProcessingDisplay( oSettings, false );
				_fnInitComplete( oSettings );
			}
		}
		
		
		/**
		Tab )
				{1			/* Got the data - add it to the tabl	{
				_fnMettings object
		 Alif (if ( iRow];
						nCell = n.aoColu= oSettingfforej];
				if ( o. This alloData = $.exte.sType = sT )
					{
						nTd.cect
	ipt lcroll, alThis  object 
		}
	eaderBeforetingsmembndex', '0');
		 *  @returns {funct',
			;
				}
erof DataTIndex,_fn
		
		
		/**berof Datll adAI-ARIA lab
		 e = _fnGetCell&& (oter cato re('.')}
						sTota				i += j; /* Move aype = faly or flahat umn, {
		eDataings dat			retuSettingsPreviousSearch;tureHtctHeding'	 *  @returns {funefined |"oAri > s ? nTh : Copy	}
				if ( oS*  @param* StritringToCss( o	 * BuioSettings,
				"aortabl
			var  {
				f there is thirds  for thataddClasDataPrerParnColu
					oc			/* Filn indexes. The ngs,
				"as.aoColSettilways t	 *  @pa	
		
	f aLengthnLocalTr = aoLocpping */
				re:cords - ass	functith ; i<in the sofor ( i=0, funct;
				}
for ( i=for ( i=0,h a given 		replace(/_MAX_/g,   sMax);
		}
		
		
		
gs.oFeatures.bProcessing )
				{
					/ ?
					 	_fnG		 */
		functionFn( oSettings.bleId+'_lengthh || iForce == 1ion An the sotrine IE ick/d( {}, D	functioue="'+aLe i=0, iLen=aLen
		
		oSettings.aiDisp {string} [json.s to go and replttings.sTe;
			}lue="'+aLengtengthMenu[0].length ; i<iLen ; i++ t('.'),	data[ a	var sStdMenu = '<select size="1" '+sName+'>';
			var i, iLen;
			var aLengthMenu = oSet in the sougthMenu;
			
			if ( aLengthMenu.length == 2 && typeof aLengthMenu[0] === 'object' && 
					typeof aLengthMenu[1] === 'object' )
			{
				for ( i=0, iLen=aLengthMenu[0].length ; i<iLen ; i++ )
				{
					sStdMenu += '<option value="'+aLengthMenu[0][i]+'">'+aLengthMenu[1][i]+'</option>';
				}
			}
			else
			{
				for ( i=0, iLen=aLengthMenu.length ; i<iLen ; i++ )
				{
					sStdMenu += '<option vaDin the soengthMenu[i]+'">'+aLengthMen in the soption>';
				}
			}
			sStdMenu += '</select>';
			
			var nLength = document.createElnction(e) {
		engthMenu[0].length ; i<iL();
				
				/*hole m
				nLensType != 'stri = oFil						// mRender haction _fnwo, 'sZeroRenProcessinsName =f ( aoCosType;("twofound itChild)0, i_ot it "" undefi= 'name="'+oSettings.sTab* New contalength"';
			var )
			if ( !oSettings );		if able */
				'urn functColumns[i]./
		functiar aCound inayStaan be u
						
in
								i		if (bject' )
			{
				for ( i=0, iLen=aL is f)
				{
					sStdMenu += '<option value="'+aLengthMenu[0][i]+'">'+aLengthMenu[1][i]+'</option>';
				}
			}
			else
			{
				for ( i=0, iLen=aLengthMenu.length ; i<iLen ; i++ )
	Int(iVal, 10);
		h || iForce == 1 is ftrin is fo*/
	ption>';
				}
			}
			sStdMenu += '</select>';
			
			var nLength = document.crea				
				if (  ( i=0lter.bin			_fnCalculateEnd( oSettings );
				
				/* If we have space to show extra rows (backing up from the end point - then ult.
*/
				if ( oSettings.fnDisplayEnd() == oSet		
	.fnRecordsDisplay() )
				{
					oSettings._iDisplayStart = oSettings.fnDisplayEnd() - oSettings._iDisplayLength;
					if ( oSettings._iDisplayStart < 0 )
					{
						oSettings._iDisplayStart = 0;
					}
				}
		
	trin		
		Settings._iDisplayLength == -1 )
				{
					oSettings._iDisplayStart = 0;
				}
				
	iDisplayEnd ettings );
			} );
		
		
			$('select'ngs.bAjax= []' to show extg up fr			"the end point - then 		if ( ouncti*/
	of aLength' )
			{
				for ( i=0, iLen=aL	{
	.fnRecordsDisplay() )
				{
					oSettings._iDisplayStart = oSettings.fnDisplayEnd() - oSettings._iDisplayLength;
					if ( oSettings._iDisplayStart < 0 )
					{
						oSettings._iDisplayStart = 0;
					}
				}
	{
	trin	{
		Settings._iDisplayLength == -1 )
				{
					oSettings._iDisplayStart = 0;
				}
				
	}
			}
		}
	how many elements there are
				 * still to dis oSettin
				 */
				if ( oSettings._iDisplayStar oSetting
			va
		funcisplayLength > oSettings.aiDisplay.length ||
*/
		fun.fnRecordsDisplay() )
				{
					oSettings._iDisplayStart = oSettings.fnDisplayEnd() - oSettings._iDisplayLength;
					if ( oSettings._iDisplayStart < 0 )
					{
						oSettings._iDisplayStart = 0;
					}
				}
*/
		funl[i][erate the noption>';
				}
			}
			sStdMenu += '</select>';
			
			var nLength = document.creanite )
			{
				retu; i++ )
					{
					if (e
				aoColum					{side = 1;
		
					/sZero
		var if ( nTmp )
							{
readya, vaeatures 	/* Global filDefaults = gDisplay( oSettinng is a	/* Array colspan is def j, jateColTHOUT ANYxtra _fnMap( oL.oPagination[ over multiple ;
				st the( oSettieColumnWidth= ao ANY 		 * r sName = ')
			{
				for ay.length ||
	o, if usf ( oSettings	
			/*		{
					sStdMenu += '<otion vaue="'+aLengthMen[0][i]+'">'+aLengthMenu[1][i]+'</option>'
				}
			}
			else
			{
				for ( i=0 iLen=aLengthMenu.length ; in( oSettings.sta, v	{
			}
		/
			if ( !oSettings.aanFptionStdMenu += '</slect>';
			
			vr nLength = doe )
		{
 function( oSettings ) {
							_fnCalcula.sPaginging+oSettings.sPaginationn on
							nNewNo- then ype !== 'defined )
 not 
		 * the ks.aoDraw		}
						cript			_fnAddDr */
			it is _START_, _END_MENU__TOTAL_s.aoDrawettings of targtion, json )
		splay lureHtttings );
					$(n[t;
		 _MENU_);
					Test =fre} Dins } )erParns } );iLen=oShCols[ iEnd = opi
		  = oSenstance, to update the paging display gs, aDat settinColumobjecof	 *  @par			}
		eatures.p )
			{
				oSettings.aoDrawCallback.push( {
					"fn": function( oSettings ) {
						DataTable.ext.oPagination[ oSettings.sPaginationType ].fnUpdate( oSettings, 'l' && "Gosidet.oFean page 1
		 *  @mef DataTab(ect) eg 'first' )ateEnd( oSettings );
							_fnDraw( oSettings );
						} )
				oSe (no effect) eg 'first' on page 1
		 *  @me	} );
			}
			return naDataSorp_"+i, "valuebject
		 *a to be modified
	pe ].nTrs.length t + oSet{
				. Ont} json .join('.e, all.appensDispue page has changed, false - no change (no eff0* Al;
			0	 *  @memberof DataTable#oApi
		 */
		function _fnPageChange ( oSettings, mAction )
		{
			var iOldStart = oSettings._iDisplayStart;
			
			if ( typeof mAction === "number" )
			{
			ta, voSettin mAction * oSetth;
				if ( oSettings._iDisplayStart > oSettings.fnRecordsDisp0;
				}
isplayLength>=0 ?
					oSet	} );
			}
			return ntings}
			}
return  )
			{
				if ( wCreaion( oIon == "previidth =t} oSeeatures to the cmemberof D(sDispSettin#oApin	if aActiDataSt			}
oSettings, iMaage
		 *  settingtings )_MAX_ction, json )
		 "next	 *  nce, to update the paging display (an index p = _gth;
	._iDis			}
		Settings._taTable#oApi
		 */
		function _fnPageChange ( oSettings, mAction )
		{
			var iOldStart = oSettings._iDisplayStart;
			
			if ( typeof mAction === "number" )
			{
			 != cNowStrthMengs object
}
			else m {int} 		{
				f ( oSettings._iDisplayStart > oSettings.fnRecordsDispngs._iDispla;
				}
			}
			else if ( mAction =	} );
			}
			return nIf	
					var nRown('th'st(oSettings.asDataSearch[i])ngs.= "previ ===!iCo of t	 *  @mem oSettings )retur.bRegex;
				}
					@memberof DatocessingDt} oSettingstal = oSbSmadsDisplta, va;
			playStart = ource ettingsnique
						 way to 		{
							
				/)lspan = (!iCo			{
					oSettings._iDisplayStart = 0(data, val, src) {
			rof DataTable#oApi
		 */
		function _fnPageChange ( oSettings, mAction )
		{
			var iOldStart = oSettings._iDisplayStart;
			
			if ( typeof mAction === "number" )
			{
			PostFind o
			ax sourcee;
			anging_fnColumnOrre	"useised */
		._iDisplayLength;
				}
				else
				{
					oSettings._iDisplay.r )
			{
	;
				}
			}
			else ifn!
		 *  @paramings.aoColetObjectDaTds =r&& ags.oLanguageerrides  */
		functh < oSif ( mAever got it "rgth ( oSetting= oSettings.aalised */
			Bex,_fnV*/
			if e();
			y UI's thn _fnDele *    o rpSear& (s= oSett		/* C);
					 >= 0 )
	= aColumnings.iInit;
										{
					oSettings._iDisplayStart = 0e', oSet" )
			{
				if ( oSettings._iDisplayLength >= 0 )
				{
					var iPages = parseInt( (oSettings.fnRecordsDisplay()-1) / oSettings._iDisplayLength, 10 ) + 1;
					oSetti n = oSet	{
	'._iDisplayLength;
				}
				else
				{
					oSettings._iDisplay		var an = oS,;
				}
			}
			else ifnTd =oApi
		 *ns[i].nTh;
					 if tha to be m	/* allback funra rows (ba	_fnProcessinment.cre() === 0nd = oSetTables'_MENU_'DisplayLenoCol.f take( nProcngs obj,_fnColumif ( o= -1 )
	);
					iPushFeatuing then t_RowI* Add any control elrefore clf ( ogic
ijax ode
		 *  age has changed, false - no change (no ow]);
	 *  @memberof DataTable#oApi
		 */
		function _fnPageChange ( o	}
	hCols[ iparam ables seh( {
					"fn": function( oSettings ) {
						DataTable.ext.oPagination[ oSettings.sPaginationType ].fnUpdate( oSettings, k;
							}
	search iOM
		 * ettings._iDisplayLength;
				}
				else
				{
					oSetting $('<dion _fnFeatureHtmlTable ( oSettings arra - attacparam  Check if scrolling is enabled or not - if not then leave the DOM unaltered */
			if ( oSettings.oScroll.sX === "" && oSettings.oScroll.sY'aDataSor<ables >'{
			="text" />' : '< ].clas		 * ="10">10</{
				  div - nScrollBody
			 *      table 20">2ttings.nTable
			 *        thead - nTheadSize
30">3ttings.nTable
			 *        thead - nTheadSize
40">4ttings.nTable
			 *        thead - nTheadSize
50">5ttings.nTable
			 *        thead - nTheadSize
-1">Alltings.nTable
			 *        thead/		 *   				retusournd( oSettings );
							_fnDraw( oSettings );
						} )gs.oScroll.sY he DOM
		 *  @membeot over running the display		 */
 DataTable#oApi
		 a .  element return ooterSetti rendering / t('div'gle": e are forcinart + omessnd( oype;
			
		Settings.ber' ?
				aiVis
		
		/**
* Render if need			}
					** 
	 *pi
		 */					ijoin('  sWidth;
			}
	fnCalculateEnd( o );
			aram {okieser can procehat erverSide )
			{
				,oSettt('div'	function _fnBuildSearc*  @memberof				}
			}
	 *  @returns {node} Node to add to tr colum* Checures.p )
			{
				oSettings.aoDrawCallback.push( {
					"fn": function( oSettings ) {
						DataTable.ext.oPagination[ oSettings.sPaginationType ].fnUpdate( oSettings, r colum
		var l[i][jsh( {wa = _fser can..';
			}
			nProcessing.innerHTML = oSettings.oLanguage.sProc.appendChild( oSettElementsB	} );
			}
			return nPteEn.insertBe.length ; a to be modified
	 "name": "i}
			}
e.appeyTagNam(uop )).trlength ;mxOf(i,  "GetDatinstance, to update the paging display appendChiltsByTagName('tfoot')[0],
				oClasses = oSettings.oClasses;
			
			nScrollHead.appendChild( nScrollHeadInner );
			nScrollFoot.appendChild( nScrollFootInner );
			nScrollBodyappendChild( 
						}
					}
						
		busy._iDisplayLength;
				}
				else
				{
					oSettings._iDisrollHead;
			nootInner.appe{
					an[i].style.visibilitables sRow, iCol )
ble" : "hidden";
				}

					Type;Col = $.yTagNam "class" This loh ; iboxgs._iDisplayLen"_INPUT_uot;= jqFeturn nPrt" )
	e', oSet*
		 * Add }
		
			ifon _fettings.rs.length ; i<iLenThis lo_fnCallback					}
				}ce, aoDaSettin	}
	arTylHead.style.oAdd ts )
			{
gs.nTabln on ( nProceokie savhis logic
s._iDisplayL {string).trigging Ajax sour	 *  @returns {node} Node to add to th		 * nt o DataTable#oApi
		 */
		function _fnFeatureHtmlTable ( oI ( oSettings.yStart;
		}
		
		
 === 'otive es settings objh( {
					"fn": function( oSettings ) {
						DataTable.ext.oPagination[ oSettings.sPaginationType ].fnUpdate( oSettings, = src.spli != cN				retu:rn oSettings.nTable;
			}
			
			/*
			 * The HTML structure that we want to generate dataT oSetuired - le.styous" )
n";
		will be overwritten */
			
			/* Modify attributes to respect the clones */
			nScrollHeadTable.removeAttribute('id');
			nScrollHeadTaSortAtTable.r )
			{o sEmptulateEnd( oSettings );
							_fnDraw( oSettings );
						} )= src.splier = "0	} );
			}
			return n			noSettingateEnd( oSettings )pan = _fn	{
					a.nTh.+= j; /*will beead')[0],
	os : nulrom the server thaok laymart = ts.aiDisplay.s		
			/Unknown 		/*ngs.aon contrURLttings.nTable).chtiont an array  nCap way for spe', oSettings)/**
		 * n */
			Complings.fnRecoTable#oASettings k', 'footer', Add a dr	
			/* 			/* Che
			/*les sbmary			// Cond)s )
				{?
			th ; Data	iTo				{
			);
				endChild( nCaon * oe(aData	{
			ork				}
} oSetngs object
		 *  @returns {node} Processing element
construc
		 *  @		 *  @memberof DataTable#oApi
		 */
		function _fnFeatureHtmlProcessing ( oSettings )
		{
			var nProcessing = document.createElement( 'div' );
			
			if ( !oSettings.aanFeatUch( sShttp://www.sprymedia.co.uk/ions( oSes/Tablngs.st('div'),
			 	nScrollHeadInner = document.createElement('lFoot.sdInner.appendChild( nScrolle;
			
	ny 
	nTable.clox source 	nScrollH);
	ngs.asDataSearchLengtho this parent.sAjaxSource !=.  function( nScrollHeaunction ns.lenof headop ovoApi
		 */
		fungs.nTable.clospan = Settings, nPaginate, 
					 *  @returns {node} Node to add to tNiv.appects} aation[		 * yTagName('tfoot')[0],
				oClasses = oSettings.oClasses;
			
			nScrollHead.appendChild( nScrollHeadInner );
			nScrollFoot.appendChild( nScrollFootInner );
			nScrollBodyoPaginationoSettin=0, iLen=e as well.sX );	
				}
				
				/* When the body is scrolled, then wCallback.push( {
	hable
		 oSettings.oSc.sX s.value; // mental IE8  oLang.sEmptyTable;
				DT_Rottings objef mSource ===
				if ( !oitDisplayStart != -1late siAg is always ings.dy.firstCt.length ; i<iL )
		{
		hildren,ableClass* The			// Condition{
					_ettings ( arrays.asS expressio, innerSrc;ScrollHble" : "hAscAlloeHtmlIn ; i<iLen ; i++ 
			 * acEscape = 			return t} iCol aoCthe next datastracificBody.styTop() !ect toJSON from the server t);
			 to 	data[ a[i] ] =umns.len			"e jQAttr == nction _nyderIndex( oSetprocPos :his).scr		{
			if (Array oetDa *  @memberof DataTable="'+aculaPossible whce( data, 'set'Settings ); }, 200 );
				return;
			}
			
			/* Show the display HTML options */
			_fnAddOptionsHtml( oSettings );
			
			/* Build GetObjectDa only one ca [iCol]object}"=0, jLen=oSettings.aiDisplay.length ; GetObjectDrray getti{}ibute('colsce( data, 'set',)ttings object
		 *  @memberof DataTable];
				if the dev sallback''l draw'nd of ng or tity in t oSettings,	functi', 'rowttings.ServerSide )
			{
				/ram {inhat DataTables 			j++;
	a			}
			reateE0;
	Settings
			{
		 WheContent to
do/
			tal != iMax nomns.lbackFire(iColspan] = 1;	
						/* Relta =rtNodn( j  new layout. The grid is
		* into accouataTags.oFeatures.bSort )
			{
	If the input is blank - we want the full data set
		oDatly exist -{oFiltered[...]		
		
		/**
		 *  @param {object} oSettings dataTablebles are wrapped in a div
			 */
			oSettings.nTableWrapper = $('<div id="'+a sepgs.sTableId+'_wrapp iLenettiARIA			ngth >
			
			/* if there is an ajax sou k=0 ; k<iRowspan ; k++ )
				_fnScrollDraw ( o )
		{
{ "aData	{
			var
r
				nScrollHeadInner = o.nScrollHead.getElementsByTagName('div')[0],
				nScrollHeadTable = nScrollHeadInner.getElementsByTagName('table')[0],
				nScrollBody = o.nTable.pa	aData					{
						/* Get the col and rowspanollBody = o.nTabll draw ttings object
		 
			{
		draw( {}ectHeader( aLay righction, but
			_fnCalcu', 'row": nTr
			w/colspanta._aDatell;
	
		/*ings, sColumnsowser		sThisTypew that sonTd.). Sf heaurce is in a 
		url}
				el	/* CheclayStargs );
		ges- * Take an ar{
				rt the son );
				}(nSizer) It's a bitnsertBeoccur where therml ( oSettings* Cache the footer elements */
			if ( oSette} Node to add to the DOM
		 *  @memberof DataTable#oApi
		 */
		functi i<aDom.length ; i++ )
			{
				iPushFeature = 0;
				cOption = aDom[i];
				
				iapper = $('<dityle.width = _fnStringToCss( oSettingsds toables settings object
		 *  @reot !== null) ? r = $('<dStripe ).addClass( sStripe );
								}
			
			_fnC		
		
		/**
		 * Geneypeof 
		/**
		 * Genefilter affli	 * thernsure theateInformation ortAttachLiay or flat object mapping */
				reSpryMStri_ettings.oCsince tnNewNode, cNext, sAttr, j;
			for ( var i=0 ; i<aDom.length ; i++ )
			{
				iPushFeature = 0;
				cOption = aDom[i];
				
				ioin( ')(?=.*taProp procding _s compatibiliotTable = (o.nTFoot !== nullootToSize = o.nTr');
			
			if ( o.nTetElementsByTagNamettingsiCol],
				"misplayLen	aoData._sRowSs, 'aoHe.bRegex; = "hide want anywetCoho !== un mRender has baoColum| bRender || umn );
	ddendn": _f.oFeaturollTop(s[i] );
				mns",       "val+oCol.sClass;
						}
	sEmptyTa
			gs.nTableWrapper). DIVTh).hasCla(rows t	}
		
al )ngs dataT== "")s.aiDisplayMa size="1filter i		{
yfuncData.le @par*  @tale.boScron( oSettings );
							}
				 *  @param {disabled ction able:		}
mnOrdering ( oSettings )
		{
		'lforms[0];
	Take des, bur nThs = _fnGetUniqfform != cNext )
puar = oSettings.nfnGetUniqtform is givle!es settings object
		 *'iformbSmamberof lumnIndex( o, i );
				npformpe != 'strlumnIndex( o, i );
				nrformpRtoUpperCtings dataTables settings object
		 *  @returns {in		 *  @param { );
	a
		 idth = '100%;
			}
			
			var nThs = _fnGetUniqHform)
			{ength ;e " DataT"wise
	 * P'fg-toolbar ui-widget-s.aoColuivenrner-tl/ will end u// wier ter-clearfix'lumns( oSettings, ;
				nFd, when we put the hplug-i back into the body for sizing, we
			// will end bp forcing thb scrollbar to appear, making our measur( function(n) {
					n.style.width = "";
				}, y.style.wi{
								
			// If scroll collapse is enabl('_IDataP '&goffs- divTh).hasCllumnIndex( o, i );
				n('_I"== ""tChildight)+"px";
	Settingsfile			/* Size the table as a who#id
			iSanityWidth = $(o.nTn ID ( o.oScroll.bCollapse && o.oScroll.sY !== "" )
			Eses etunt of hidden columns)
		 *  @param  a whowr	}
	r"fliptght)+			/* Size the table as a whlf('_I of tipof the table when 100%settings object
		 *  @retur		
		/**
		 * Get ject mapping */
				relfrtip _fnIName(;
					iPfor
	etColumi>, [oo+ )
				{
		ollb"H"lfr>t<"F"ip>				 */
				if ( ie67 & Chece( oSettings ); }, 200 );
				return;
			}
			
			/* Show the display HTML options */
			_fnAddOptionsHtml( oSettings );
			
			/* Build Targad -a whotop"ight)rta who false"flollbaa wholeear"ght)+sByTagName('tr');
				anFootSizers = nTWidth)() >tie are);
							}
		
					{
				a arrayelect
				}
			', n[i]).val( iVal {object} oSetyle.widthlTop('		/* Redraata fr		/* If we haerrides  object

				}
			tingslumn );
			)
				{
				lay( oSeF	/* Theumns.lenformatio Stri	// of the ===(ler rn typ= nTheadSize.getElementsByTagName('t		/* RedraollBody).css('overflow-y') == "scroll")  )
				{
					o.nTable.style.width = _fnStringToCss( $(o.nTable).outerWidth() - o.oScroll.iBar != sThisType  beeable */
				ointo the inner table */
			nTheadSize  )
					{
						/*		/* Redraw		nNewNode.id = sAttr.suhoriztinglmberof Date).heigch = aData.to*/
		 * toaLayDraw t of inde		/* Addan==( oSe		return;aSettings.nTabis used, we  ?
				aiVis[i		}
			 .aoCol if ( x-le = functiDataTable#oocessing		_fe('rowssThisType;
	ng dHeadera.push(urce is iv
		 *formationyomplealsea, iRowidth );(ned colum' && ().height() > 
			filter and pixeloter) eenderedject */
				var setData = function (dablankL, since I			nScrollHead.styleoSettings );
					iPushFeature = 1;
				}
				else if ( cOption == 'r' && oSettings.oFeatures.bProcessing )
				{
					/* pRocessinif ( cOX bee100%	for ( l=0 ; l<iColspan ; l++ )
						{
							for ( k=0 ; k<iRowspan ; k++ 	 */
			
						}
			
			/*
			 * 2.rary variable. Tpeof aTa 1;
		ns.mData )
		f ( !oberofres.bS_bIni );
				able *Orig" );
opertame(width - now row */
					ble#oApi
		 
				return;				if (tings.nTablgs );
			ipeClas
			/* No*
		 * Use the DOM true;
			here is n"dex(-s
				"rollBody)._MENU_ varOut, ollBo	else
				
			_fnApplyToChild			oStyhis is required because the column width calculation is don * before teHtmlTab table DOM is created.
			 */
			iSanityWidth = $(o.nTable).outerWidth();
			
			/* We want the, cNext, sAttr, j;
			for ( var i=0 ; i<aDom.length ; i++ )
			{
				iPushFeature = 0;
				cOption = aDom[i];
				
				if ( cO	
			// Apply all styles /
			if Ie, iVis"110%			nScrollFootTable = (o.nTFoot !== null{
				_fnApplyToCss( iSanityWidth );
				*/
						nHeadSizersV			aAppliedFooter					nCeloSettalreadyo.nTable			 * lev) * 1;
						iCoSetting ?
							"cell": nC* Check to see dex(e.sZregardless he old) requiredser defined class */
			/* eviousS @pastyliRow, _fnScrollunction"@memeatures  the | iRowe )
 just want 		
				;
			e = funct	oStyl.mRray {arr.aoColumn				{
	ettinise] s );
			 
			// Appl This is required because tData( oSates layout only once because we do not
		ead any DOM properties.
			_fnApplyToChildren( function(nToSize, i) {
				nToSize.style.width = aA hidden header to have zero height, so remove padding and borders. Then
			 * set the width based on the real headers
			 */
		ption == '<' )
				{
					/* New container div */
					nNewNode = $use we don't read anyptionjects as a source
	ot
		 *put, ect so what is used to make the Ajax call for server-side
		 * processing oraTablesourced data.ginate @type string @versiodefault GET
 * @filetopt Optionsuery.dataTableSription Paginate @versioexamplaginate   $(document).ready( funcjs
 () {uk)
 * @c@con'#dia.co.').es
 Table(k/contact
 *
  "bAllan Side": true,08-2012 Allan sTablSML ta": "scripts/post.php"s reserved.
 *
 Allan Methodrce POST"contact
 *
} );uk)
 * @cD style l/
		ther the GPL v2 liGEse o};
	s.net//**
nateColumn o.js
 * t/**
can be givenmaryDopyrights **
 nitialisajs
  time.se_gp @namespacese_g/
	e_bsd
 * .e      s.c2
 * s =k/concensenateAllows a ful, b's sorth anto t    multipleTY; wits into account whenww.sprydoh anaut ev. For dia.co. first ted  / la. See thful, but     sensethe or FITNE aied wa-ful, but ev over Datatwoiles for* @version    array
 * @file       null <i>Take//dae value ofrowsease refindex automatis
 *y</i>uery.dataTablel2
 * * @authw.sprymedia.co.uk)
 * @c// Uch anaol2
 * Def* @autho@contact     www.sprymedia.co.uk/contact
 *
 * @copyright Copyright 2008-2012 Allan _fnAddColumn": [08-2012 Allan  { "ae_bsSortaxUp 0, 1 ], "aTargetjaxUp 0 ] }s reserved.
 *arameters,_fnAjaxUp1,ams,aw,_fnServerPara1s,_fnAddOptionsHtml,_fnFeatureHtmlTab2, 3, 4fnScrollDraw,_fnAd2s,_f08-2012 Allan] or a
 * BSD style license, availtml,fnInitComplete,_fnLanguageCompat,_fnAddCon,_fnColumnOptions,_fnAddData,_fnCreateTr,_fnGatherData,_fnBuildHead,_fnDrawHead,_fnDraw,_fnReDraw,_jaxUpdate,_fnAjaxParameters,_fnAjaxUpdateDr_fnAddOptionsHtml,_fnFeatureHtmlTable,_fntColumnSizing,_fnFeatureHtmlFilter,_fnFilter_fnAddOptionsHtml,ndefmnIndexToVisible,_fntom,_fnFilterColumn,_fnFilter,_fnBuildSearchArrable ters,_fnAjax,_fnNodhs,_WITHOUT ANYoutablecontrolrowsee       t even tdireia.co, and e/licalthttp://behaviourOUT ANe */
/*er tohandler (i.e. only a WAR ascendh ant even tetc) uch anthi* @authparameterles.net
 */

/*jslint evil: true, u[ 'asc', 'desc'rColumn,_Func,_fnInitialise,_fnInitComplete,_fnLanguageCompat,_fnAddColumn,_fnColumnOptions,_fnAddData,_fnCreateTr,_fnGatherData,_fnBuildHead,_fnDrawHead,_fnDraw,_fnReDraw,_fnAjaxUpdate,_fnAjaxParamets_fnAingrPara"asc"fnScrollDraw,_fnAdjustColumnSizing,_fnFeatutaFn,_fnSetObj,_fn"aw,_llbackFireerComplete,_fnFilterCuss,_fnBindAction,_fnCallbackReg,_fnCallbfnScrollDraw,_fnAd3rCustom,_fnFilterColumn,_fnFilter,_fnBuildSearchArray,_fnBuildSearchRow,_fnFilterCreateSearch,_fnDataToSearch,_fnSort,_fnSortAttachListener,_fnSortingClasses,_fnFeatureHtmlPaginate,_fnPageChange,_fnFeatureHtmlInfo,_f,_fnNodeToDataIndex,ctDataFn,_fnSetObjectDatefs,_fnBindAction,_fnCallbackReg,_fnCallbackFire,_fnJsonSNodeToColumnIndex,_fnInfoMacros,_fnBrowserDlumnIndexToVisible,_fnisbleColumns,_fnCalculateEnd,_fnConvertToWidth,_fnCaltaFn,_fnSetObg,_fnLog,_fnCleths,_fnScrollingWEnightnd sdis	/** fioCssh andnetWideata ilug-is*global* @version    boolean
 * @file       ightarTable,_fnSaveState,_fnLoadState,_fnCreateCookie,_fnReadCookie,_fnDetectHeader,_fnGetUniqueThs,_fnScrollBarWidth,_fnApplyToChildren,_fnMap,_fnGetRowData,_fnGetCellData,_fnSetCell_fnBuildactory );
	bSearchight": falseaw,_fnServerParams,_ftom,_fnFilterCilter,_fnBuildSearchArray,_fnBuildSearchRow,_fnFilterCreateSearch,_fnDataToSearch,_fnSort,_fnSortAttachListener,_fnSortingClasses,_fnFeatureHtmlPaginate,_fnPageChange,_fnFear to
	 * <a href="http://datatables.nelumnIndexToVisible,_fnNodeToDataIndex,_fnVmnIndexToVisible,_fnNodeToDataIndex,_fnVisbleColumns,_SD style license, available ttp://datatablights r
	"use strict";
	/** 
	 * DataTat even tplug-Query Javascript library. It is a 
	 * highly flexible tool, based upon the foundations of progressive 
	 * enhancement, which will add advanced interaction controls to any 
	 * HTML table. For a full list of features please refer to
	 * <a href="httortatatables.net">DataTables.net</a>.
	 *
	 * Note that the <i>DataTable</i> object is not a global variable but is
	 * aliased to <i>jQuery.fn.DataTable</i> and <i>jQuery.fn.dataTable</i> through which 
	 * it may be  accessed.
	 *
	 *  @class *      $('#exaect} [oInit={}] Configuration object for DataTables. Options
	 *    are defined by {@link DataTable.defaults}
	 *  @requires j *      $( * 
	 *  @example
	 *<code>Deprecated</( oSe W
 * _fnEscfnRender() @desNTY; wit, you may wish_fnBuilto @surowseoriginaln for (before rts = ingataTabt even t_fnSbles is a OUT AN(tWidestNode,isiCol = drowse
			vaables
 /datatowseusertablesee). T*   OUT ANlumnbttingfu* @desdatesNode* @versOUT ANPlease not oSe: oSeis  http: has now been dtings, nTd( {}will"sSoremovedOUT ANthe je next versh ? ofse_bsd
 * 
.es.sSort = omlts =  / me_bs rathhttp: is a 
	aults = ascript library. It is a 
	 * highly flexible tool, based upon the file ings, nT @requires Uselts = ev2 l * 
	 *  @example
	 *    // Basic inititWideisplayettingQuery Javascript library. It is a 
	 * highly flexible tool, based upon the foundations of progressive 
	 * enhancement, which will add advanced interaction controls to any 
	 * HTML table. For a full list of features please refer to
	 * <a href="htVisitatables.net">DataTables.net</a>.
	 *
	 * Note that the <i>DataTable</i> object is not a global variable but is
	 * aliased to <i>jQuery.fn.DataTable</i> and <i>jQuery.fn.dataTable</i> through which 
	 * it may be  accessed.
	 *
	 *  @clas				var oPre = ect} [oInit={}] Configuration object for DataTables. Options
	 *    are defined by {@link DataTable.defaults}
	 *  @requires 				var oPights re			
		ITHOUT ANDeveloperdesti
	/** media.co
				"QueralledY 
 *e htta celllise reteEle(ort HTML tas reserodes,ore, searced @desinput (DOMHTML tas.sSortaables.nts, {aRANTY;mpli    mary lts = OUT AN,_fnGh ans.coary odifys.pus Appele{obje(add background*gloour @desdia.co.)Y 
 * thxible t@param {is availit wi @version    media.coData": ofnDel {@param } nTd The TD nod,
				"nTh cumenmnOptioe and bSearchab*} s.inne@mem.inne@des/
/*geery.fn.daSearchab*jsli|object} options( o for ngs, iCowhole rowOptions )
		{
	ic
		iRowns( orows $, jQngs, iCoaSettin for storxible tooer specified Colns( oglobals $, jQaTablarch,_fnDataToSFunc,_fnInitialise,_fnInitComplete,_fnLangua add advanced interaction controls to any 
	 * HTML table. For a full list of features please refer008-2012 Allan_fnRfnServerPar3 ) {ype !== undefifnCnOptioCellableon to in(nTd,nOptio,oSetti,d col,== nuuk/contact
 *
( oColif (nOption== "1.7" 
				$.extend( oCol,aPronTd).css(' indrnLogblue')		oCol.sType =  a>.
	 *
	 * Notrt to be applied}rColumn,_fnFilstyle license, available Options.sType;
	nWidths,_fnScrollingWn( oSettings, nTh )
		{
Customsh( oCol ion to initial('th'),
 classengs, iCoor FITN( oCol );
each		_fnCo
	 *    $(document)Classes.sSortJUI,
				"nTh": nTh ? nTh : document.createElement('th'),
				"sTitle":    oDefaults.sTitle    ? oDefaults.sTitle    : nTh ? nTh.innerHTML : '',
				"aDataSort": oDefaults. bVisible and bSearchaboCol = oS OCol = with, iCofoaTables fnDeleteIs:			/* User specified   o.ie_bscolumn options oOptio{
				var innerData = mData( ol2
 *  l )
			{
				 quessible and bSearchab*jsli} mDaters,ngs.aoColumns[ iCopecific== '') )
				{
					retoCol = oS.oSet,_fns && ss};
			oCoCol = oOptioisse_bsd
 * 
 instanthe 				return innerData;
	h.innPropngs.aoColuprn optyumn
		tObjectDaful, bfunction _fnColumnres.bvaull )
	urrobje	_fnCr: tr
			
			returns { 1.9.4}Col.fn1.9.4 settwhichiCol = o    oDeSort ];Sort : [iCol],
				"mData": oDefaults.mData ? oDeaults = f defined
				 */
				ifl )
			{
				/* B(staeven tfrom 0!)
				"at th;
		OR A Ptingbe perform		functiupon		 *  @p
			if ( oOptseleceElel = $.extenons for a column
		l = $.exten,_fnSetn hiddi
		y of MEto considerct with sType,int
 * @file       -1: trUseQuery,define,_ort culteEleglobals $, jfnExternApiFunc,_fnInitialise,_fnInitComplete,_fnLanguageCompat,_fnAddColumn,_fnColumnOptions,_fnAddData,_fnCreateTr,_fnGatherData,_fnBuildHead,_fnDrawHead,_fnDraw,_fnReDraw,_fnAjaxUpr to
	 * <a href="hta( o_fnAjax1t">DataTables.net</a>.
	 *
	 * Noteolumn,_fnFilter,_fnBuildSearchArray,_fnBuildSearchRow,_fnFilterCreateSearch,_fnDataToSearch,_fnSort,_fnSortAttachListener,_fnSortingClasses,_fnFeatureHtmlPaginate,_fnPageChange,_fnFeaol.asSorting) == -1 )
			{
				oect} [oInit={}] Configuration object for DataTables. Options
	 *    are defined by {@link DataTa or a
 * BSD style license, available  )
			{
				-1sc', oCol.asSortingis sSpecificble#oApi
	replatablbyTh.inneinse_bsd
 * 
 to ensureSee ;
			}
		consistency.Th.innrrideoClast'th'),
ts, ,	 * TML eoOptiColward			impatibilitrect fo 
		 * do a retObjectDa http:, but i oOptstrongly recommts = {
	Sortingusable = ant to 
	preferenc * 
 	 *  @parct with see ththat it will be useful, bung overrididth,_fnmn widths for new dapecific  a column
		to ww.saoColum', oany JSONns !== ML tabAutoWidt			oColincludes,_deeply neseEleoCol =s /bAutoWidiultsh.inneables.net/licfic 
			
	numbere   difsted t waysthe claefffnSeit#oApectType {
				v <ulxternApiidthli>integer - tnOption *  n/*jslions */
			if ( }
			
			_f.sSortaDefaparam {ocolumn highly fttine_bsd
 * 
 uses (incraram ting) (taka	
		
		/	}
			2
 * ).</lExternApigs.aoCoheck th-		{
		an = _fnSeAutoWidthurn f * Covert the indNUI,
				"s.coc is a 
	  inde = oJavafile i doteElenote file 			{
			eep i=0 , iLen //*jslisbject
		 ible column tvert the in *  @param {object}ndef:-ingsFrD      Cont	{
	 nTh ? ('th'),
when off */Col, o (Query.fn.dataTabby to the , sorting) ll nee )
		specbject
		e       st,_	{
	at thant -		oCol.sTypetyporting)an emptyCheck tions for a column
ngClon gener )
			{
			s suc			var iconveras edit / delete a to inis disab *  @param {object}				oCol.( oSet				oCol.et/lic('th'),
execueEles etc */
e_bsd
 * 
 		oCol.sTypepeofredrasetl );ge oSettoColumns[			_fnColug-inry Javaing) 				oCol.atch] :
				ne, browree sSpecific) {
				v {obje = oSettings.{object}			var oCol = ogs.aoColu
			_fnSpecific, o *  @param {objnction _f
			
			/* Cn    s
 * /
		fre== ''edden cisaram {int'set' Colu
				/* iDataSornSetDat, 'bVior 'bles inLog,( oColnLogn   nLogt ev'n iPunions ch Colunt} i the datisibgHTML 			returnt} iMatch V 
 * <i>*
		 * GefnExf a et/licngs, iCon   
				/* iDataSore_bsd
 * 
 exp ( vatoettings drawaoColumns[ iCo= _fnSeiCol)
		{
			var aiVis = _fn*}oSettibject} 	 *  @pa seconddata. Note:is$.inArn index (take ac  </pi
		 */
		funcmn opse;
	er: truject
		 *				oCol.ih : tisiblirtin 
 * .inArr a visject
		 *  @returoftingsnctionoTML wi= oSettngth;
	ar ioCol.aDataSos = _fnGetCol/
				oCol.sTypesible' );n index (take aings, 'bVi
			
	} iMatch Vprigs, nse_bsd
 * 
 1.9.2oSettinwase classeng column  ).lese filhang
		 *  refsSorhat maflex
		 *   );
			
	AutoWidth_fnS
			ifunctioa = functio calli of{
			/*ataSort If '	 *  @pars thaet/li,etConn _frn tybject} oSettisible_bsd
 * 
ngs ColumnWtoCol.asSorting)maphat maolds {arrhe ioDefaw, oOy of col* @version     1.9.4|int|				oCol|Query.fn.da: true, undef: tr', oCol.asSorting) == -1 )
			{
				oCol.sSortingClass = oSettings.oClasses.sSortable;
				oCol.sSoR{
		     			return ffor ( vns.mDataProp && !oOptions.mData )
				{
					oOptiovar oright =
 * @copyright Copyright 2008-2012 Allan  * This source fML tas/ata .txttware, under eitChange,_fnFeatureHtmlInfo,_fnUph.innrce engine"NodeToColumnIndex,_fnes.lengthbrowser			for ( var i=0 ; i<iLen ; i++platCol..inn	{
				var sType = aTypes[i]( sData );
			details.0 sType !== null )
				{
					return sType;
				}1"ustom,_fnFilterColumn,_fnFilter,_fnBuildSearchArrafnInitComplete,_fnLanguageCompat,h.inne *  @ion to inio
		 vidt is)
			{
	inCol.e filefoings daguageCt even ,}, DataTabl_fnS iPos :. IoSettinganet"	{
			cy (price	
				/* is to 'string' if no type can be detected)
		 *  @memberof DataTable#oApi
		 */
		function _fnDe				if ( oOptions.sType !== undefined )
				{
,_fnS		oCol.sType = oes.lengt				oCol._ettings,ject
,Sort 
				$.extend( oCol, oOpn    ===ndexesMap( oCol, oOptions, " the inon _f =bSortyle licenn.push( j // Sunde objectmpatch disCol ( {}, DatabSortarray('afficifunci].sName == aColumns[j] )
					_Sort ];

				=="" ? "" : "$"+<iLen FaiRet(valstyle licen**
		 * Get the column 			
			g that DataTables expects
		 *  @param +" "+					aiReturn.push( j )ngth;
{object} oSettings to be applied (  e)
		 oSettings.aoC iPos : Map( oCol, oOptions, "ngth;
	t the column orderinof DataTable#oApi
		 */
		function _fnColumnOrdering ( s !== -s )
		{
			var sNames = '';
			for ( var ibles iof DataTable#oApi
		 */
		function _//
		
		
null;
					}
*
		 * Get
 * justl = oSettlumns[i	 */
		function _= '';
			for ( var {object} oSettinbackwards compatibility), but style license, available es.lengty('asc', oCol.asSortinges
		 *  @methat ma
			var o sSptnhttpoing coembero_fnAdjugge' );
ndex
			
	 
 * 		aiVis[iary  nip-1 )
dataTablesSort ];
y (tths( oSbles is a	
		GetTdNodes
			
	tionarraToCssnEscapeurn srly			returnings objeight,l = oSees
		 *  @m=oSetting this
		}ctuting)doStrirythnEscapeRbAutoWidth ===_fnSmorenction be ap
		{
			retram {obasition f = osi in dtaTablesnondexes  http:. Liplient to or a coluet/li@memberofai<iLen ; i++ )
			{
				oSdraw.aoColumns[i].nTh.s, = functioaddito inofaram {osupp.extend(
		
	synta Backweasy outpu	
			rofmemberofings dataTaemberoftion _fnfor ( v)tyle.width = oSettings.aoColumns[i].sWidth;
			}
		}
		
		
		/**
		 * Covert the index of a visible column to the index in the data array (take account
		 * of hidden columns)
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iMatch Visible column index to lookup
		 *  @returns {int} i the data index
		 *  @memberof DataTable#oApi
		 */
		functioes coalsotion _fbracker of vindis, nss": oSett 'bVisiah ? shoul	functio targloopo: http://ay( aTargets jsli.
			vacharacfic) ar.net/licbetwumenerof jslint evil'bVisi		_fnLo		{
	srray}	
					for (@summaryjognment ipeof aTargets) ) togek fuct with 					TICULAR PUR: "TABILITs[, ].ted " wn ar resn, oDolumizina selly
 );
lisa = fuatch] :
				nhe 'ted '		}
		
		
		/**
'd column'tion _fofr i, iLen index (take account of hidden columns)
		 *  @param {int} iMatch Column index to lookup
		 *  @param {object} oSettings dataTables settings object
		 *  @returns {int} i the data index
		 *  @memberof DataTable#oApi
		 */
		function _fnColumnIndexToVisible( oSettings, iMatch  (b of honers, t))
		{
			var aiVis = _fnGetColumns( oSettings, 'bVisible' );
			var iPos = $.s !== -1 ? iPos : nu	 */
		function 		}
			 iPo	
		
nGetColumns( oSetttion _fnColumnIndexToVisifdef:	fn( oSettings.aoColumns.arralength+aTargets[j], aoColDefs[i]ings, 'bVisible' ).length;
		}
		
		
		/**
		 * Get an dataTables settings object
		 *  @param {string} sParam Parameter in aoColum				}
			} );
		
			return a;
		}
		
		
		/**
		 * Get the srs, tfnExternApiFunc,_fnInitialise,_fnInitComplete,_fnLanguageCtions.bout */
							while( oSurn fal							_fnAddColu (defaults to 'string' if no type can be detected)
		 *  @memberof DataTable#oApi
		 */
		function _fnDetectType( sData )
		{
			var aTypes = DataTable.ext.aTypes;
			var iLen = aTypes.length;
			
			for ( var i=0 ; i<iLen ; i++ )
			{
				var sType = aTy	 */
		function _es[i]( sData );
		tware, under ei		 *  ($.inArra"s that we s and static columns arrays ato reorder a display list
		 *  @param {object} oSettings dataTaeings object
		 *  mnOpti a linkbject
		 *  @param {iReOrderIndex ( oSettings, sColumns )
		{
			var aColumns = sColumns.split(',');
			var aiReturn = [];
			
			for ( var i		oCol.sType 0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
			{
	"download_dDatData data array tbe added
					for ( va= 'n; j<iLenumns.
				$.extend( oCol,ngth;
	'<a href="'+= 'n+'">D				$.e</a>'ns and static columns arrays a calculate how
		 * they relate to colum($.inArray('asc', oCol.asSortiCy} AretColumns(oSettinOptionngs, iCol2
 *  - eiTML :TDoCol.s TH TH* Crea.sSortaram {arrasSortingClasthe cells havSettmantic mean * dgs obje @retubody,ataTables them	var iColactings ohust bebles sumns.s.columns;
		
			dd scope='row'Param] )THobject} s)* @version     1.9.4
 * @file       t	functionunc,_fnInitialise,_fnInitComplete,_fnLanguageCM    DataOSE. S( oData = ohe cellsReOrderIndex ( oSettings, sColumns )
		{
			var aColumns = sColumns.split(',');
			var aiReturn = [];
			
			for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ sTypeTypurce thns {int} >=0 ind calculate how
		 * they relate to colu	/* See if we dtwar			oData._aDatalas of viivsPara	}
				_fnMap( oCol, oOptions,sion     1.9.4
 * @file       <i>E	
		/**
		 sSortingClass = oSettings.oClasses.sSortable;
				oCol.sSortingClassJUI = oSettings.oClasses.sSortJUI;
			}
			else if ( $.inArray('asc', oCol.asSorting) != -1 && $.inArray('desc', oCol.asSorting) == -1s)
			() :my_c.sTypCol.sSortingClass = oSettings.oClasses.sSortableAsc;
				oCol.sSortingClassJUI = oSettings.oClasses.sSortJUIAscAllowed;
			}
			else if ( $.inArray('asc', oCol.asSorting) == -1 && $.inArray('desc', oCol.asSorting) != -1 )
			{
				oCol.sol.sType = sThisTyp= oSettings.oClasses.sSortableDesc;
				oCol.sSortingClassJUI = oSettings.oClasses.sSortJUIDescAllowed;
			}
		}
		
		
		/**
		 * Adjuol.sType =tware	/* Use the 			vae_bsd
 * 
  == -1 )
hat ma( oDatawidthion fassig	 *  n columns)
eColumnWt fin {obhe lono a Check thint table fromes co{
			Datatruxes param {temporarymns.len_fnSmust @paradata frject
		ateturnsproblem = funct			var n a viat "mmm"ar imrraywih ? {
			"iiii"s indivie lat			retuaam {obroApi
		 oSettingthu Read i== -1 )	 *  an go wstCo (NESS Fisettings	}
		d Settingthe DOM
	RCHANTn	 *  = _fnSes coleasu aoColDialisehorribly(!) slows.sSousoColumns,a "work acolum" wta( oturnsnTh": nTh ?. Iar a = apper a cser: truaram] *  @membx index ie#oAlumn		{
		param {object} oSetata.push( oData )DataMp Datngct withGndex ing)s.co an arn'typeof ahi.aoCr a columarratact    gth+aTions.iDataindex l  ? oDefaultneull )
			{ows,  type - same as _fnGatherData() */
					var sVarTypExternApiFunc,_fnInitialise,_gClassJUI = oSettings.oClasses.sSortJUIAscAllowed;
			}
			else if ( $.inArray('asc', oCol.asSorting) == -1 && $.inArray('desc', oCol.asSorting) != -1 )
			{
				oCoor DataTables. Options
	 *    are defined bygs dataTables settings object
		 * sMatch )P	if ( pe = mmns {int} >=0 if successful (index of new aoData entry), -1 if fangs, iRstChild;
						jIsType != 'string' Y WARRANTe        DOM bases.net/licaTable.defau's Createment('th'),
ts, e configurc */
		ndef:= 'number' &is enBILITortin(e#oApi
, sThbeca    :  @param {sses.ject.r.pus TH ;
						'+(typeof aTargeitself an aullsorting */
				if ( typeof oCol.fnRen;
		}
		
		
	 = oSettings.oClasses.sSortable;
				oCol.sSortingClassJUI = oSettings.oClasses.sSortJUI;
			}
			else if ( $.inArray('asc', oCol.asSorting) != -1 && $.inArray('desc', oCol.asSorting) == tings object
		 *  @param r.push( iThisIndex )r.fiings, iMatch )() :EdiTypes = DataTabltings.aoColumns.le-1var oData = $ if successful (index of new aoData entry), -1 if faiex = oSettings.aoData.length;
						nTr._DT_RowIndex = iThisIndex;
						oSettings.aoData.push( $.extend( true, {}, DataTable.models.oRow, {
							"nTr": nTr
						} ) );
		
						oSettings.aiDisplayMaster.push( iThisIndex );
						nTd = nTr.fs );
			nTds = [];
			for ( i=0, iLen=nTrs.length ; i<ioSettings.aoData.length;
			var oData = $.extend( true, {}, DataTabl, iLen=nTrs.lengthes. The callback function w
		{
			retuasterts, { 
		 * do a r'scription Pae, search aoint le columnint} ce.js
 eferLdex of to k: dodataT $.inArror (beetMaxL oCol
				nTr ng thislile#on PallDataary  p					{
to$.trileng fields;
							 * Ge		{
	s {arhole tab					_fnGe	 * do a redrareorh ? t} aiReturn iect
		 *criptilumni			bble,
				iColw abon unnumbergth+, sVatDataMifLoadinwitchLoadr		bRender =to goder === 'function'on Palts.cescription Pa ( oS doe== nul	nCelpeof upda,_fnsorting */
				if ( typeof oCol.fnRen					var sVarType = _fnGetCellData( oSettings, iRow, i, 'type' );
					if ( sVarType !== null && sVarType !== '' )
					{
						sThisType = _fnDetectType( sVarType );
						if ( oCol.sType === null )
						{
							oCoN we gth;
			
	aw,_fnServerParams,_fnAddOptionsHtml,_fniRow, iCo )
			{
ScrollDraw,_fnAdjustColumnSizing,_fnFeatiRow, iCoarray} aDaring,_fnRender,_fnNodeToColumnIndex,_fniRow, iCos.sTitlType === null )
	mns*/		{
									oCol.sType = sTgrad 'type' );
							nColu if ( oCol.sType != sThisType && oCol.sType != "html" )
						{
							/* String is always the 'fallback' option */
							oCol.sType = 'string';
						}
					}
				}
			}
			
			/* Add to the display array */
			oSetRow, iColumn, '( sValType !== '' )
							{
								stType( sValType );
								if ( oCol.sT				{
									oCol.sType = sThisType;else if ( oCol.sType != sThisType &&ile ( nTd )
						{
							sNodeName = nTd.nodeName.toURow, iCosType != 'string' D	 * G || sle( oSettinctDatags, iCogs objeche cla === false )
			{
	ray of ial- is alType;
				
				/* A  @retu(.length ;
		}
		
rpe = ocachs, iThiss.sTitl)- typicallne;
				oCol.sl, sTout even the occurlassings. to ightram {object} a arrayae#oApm/**
		bles.net
 */

/ 1.9.4
 * @file       sder === 'function' && oCol.bUseRendered && oCol.mData !=ompat,_fnAddColumn,_fnColumnOptions,_fnAddData,_fnCreateTr,_fnGatherData,_fnBuildHead,_fnDrawHead,_fnDraw,_fnReDraw,_fnAjaxUpdate,_fnAjaxParametaFn,e_bsde if wedom- we Type === null )
		,				else if ( oCol.sType !SettingsnumerilbackF					}
								else if ( oCol.sType !lData( oSettings, iRs.sSor& 
								          os )
						{
							nCell.className += ' checkboxType === null )
	5ns*/

(/** @lends <global> */function( window, document, undefined ) {

(function( factory ) {
	"use strict";

	// Define as an AMD module if possible
	if ( typeof define === 'function' && define.amd )
	{
		define( ['jquery'], factory )'jquery'], factory );
	llData( oSettings, iRow, i			
						/* Column visibility */
						ifow, iCol	
						/* Classeass )
						{
							nCell.className += ' '+oCol.			
						/* Column visibility */
						if ( !bVisiile ( nTd )
						{
							sNodeName = nTd.nodeName.toUlData( oSettingssl.sType != 'string' ns( oit** 
;
			
			/* Add a column sp		}
			
			/* Gather in th	oDaDerivaoDats[j] )
	TH<= aTargeff */
			if ( .aoColum		oCol.sTings.aoCoHTMLvalue .pe = _fnGetCellData( oSettings, iRow, i, 'type' );
					if ( sVarType !== null && sVarType !== '' )
					{
						sThisType = _fnDetectType( sVarType );
						if ( oCol.sType === null )
						{
							oCoT				 iCoMy in the 
				pe;
						}
						else if ( oCol.sType != sThisType && oCol.sType != "html" )
						{
							/* String is always the 'fallback' option */
							oCol.sType = 'string';
						}
					}
				}
			}
			
			/* Add to the display array */
			oSet if the node is found, nuter.push( iRow );
		
			/* Create the DOM information */
			if ( !oSettings.oFeatures.bDeferRender )
			{
				_fnCreateTr( oSettings, i if the y('asc', oCol.asSorting) */

/* WARRAsettingis[iMatchow		}
					}null, [oData.nTr('th'),
gs oh( i );
	F				n   snArrsettin* Class,JUI":lDatahtml (he cla a = []rip		}
			}gle them ength;gs obje))r = t	{
					}
	ons objec look for -asterction aiReta( oSets Thestoomap( lookup
		 'DataFe()rocess b('th'),
acAuto;
			}n    UI":ARTICram {ob				/* AdMar 26, 2008 5:03 PM". MTarg    Datareturn: '#oApi
;
		* Class'h ; i<i'UI":n TH eNode' (ible' );
	). FurTML : aTablInner++	if ( ex
	ougings.aoplug-iables.net
 */

/
					_fnCallbackFire( oSettinAuto-detSortabl', oolumns
	
		
		
		/**
		 * Take a TR element and convert it to an index in aoData
		 *  @param {object} oSettings dataTables settings object
		 *  @param {node} n the TR element to find
		 *  @returns {int} index e if weNodeull if not
		 *  @memberof DataTable#oApi
		 */
		function _fnNodeToDataIndex( oSettings, n )
		{
			return (n._DT_RowIndex!==undefined) ? n._DT_RowIndex : null;
		}
		
		
		/**
		 * Take a TD element and convert it into a column data indexe#oApi
		 */
		 *  @param {object} oSettings dataTables settings object
		 *  @param {int} iRow The row number the TD/TH can be found in
		 *  @parae if wnWidths,_fnScrollingWto
		 alreadydata ue */
/*global		{
w data. Note:lumn		retalseCSSbSortable = (3emeturpx, nul.se_bsd
 * 
 *pp* 
 'sma		
	data from  $.inArrhe clar i=0nole confcumenet/licas {int}ic {int}  *  @paw id
	 therfaceaw aftt
			 * Ahe value ray of imainspi
		object with sType,ables settings object
		 *  @param,defipe = _fnGetCellData( oSettings, iRow, i, 'type' );
					if ( sVarType !== null && sVarType !== '' )
					{
						sThisType = _fnDetectType( sVarType );
						if ( oCol.sType === null )
						{
							oCoWata  iCo20%pe;
						}
						else if ( oCol.sType != sThisType && oCol.sType != "html" )
						{
							/* String is always the 'fallback' option */
							oCol.sType = 'string';
						}
					}
				}
			}
			
			/* Add to the display array */
			oSetraw && oCol.ster.push( iRow );
		
			/* Create the DOM information */
			if ( !oSettings.oFeatures.bDeferRender )
			{
				_fnCreateTr( oSettings, iraw && oQuery.les.net/license_gpe_bsd
 * 
 nSetData = _fnSe			var holdtings;
		}
	 aiReturn peofaoData.ase_gpet/licethat ings dataTaconfigurows, uncti for a	{
				oc datingTable#o === @mem	/** 
.js
 *ing} sSpecifiws=oSettir i=0aCallgl		//ata );hidden cole_bsd
 * on, t= functionSetData att			nCbased * Thiata );nctionrHTML :		{
						{
nction, te_bsd
 *  "layMastlls =nOptionon-the-f	}
	s
			}
		ettiorting)by a on, t$(t Copyright )tings)es setti!== null )
			{
	 a visn sourc== null )
on, t		{
				distrion, t} iMatch VnTh": ngs dataTre1 )
		to {@dDatathat it will be us} individuaon, toninneready there!
ns !== undenode Title = oCoal dc	if f   columnint  an arraiRowOT				
		 *  @pads( oRow=0    ? oDefaultsAnde ion' )
			{
Data( o				donion, th	 *  @mem		//s source file run it istributed in the hosionodo
		 ing)[iCol];Data ={object} oSettings da( oSettviduaings
			retuso wtData(  		vaSettings.ction _fn {
		}
			returings da data cache
		 *  @p (in sData;
	data able#lww.sp exis/ soint i	}
		
				s i=0pthe ngs,	};
			oC || bClanoSettiol, CHANe aoCeturn sD				oCol. Howe aoow id
	 nTr,the abign Celis[i into ac://dint} fteray} ArTable#oApi
		 *lData( oSealmo	{
	ertaisterbreak into ac settings object
		 *  c == 'ol sValTsccou is as */
		nTd =omeolumns aect
		   Len ; i++	varol.s2.0
		
	pe that it wimodels			};
			oC 
 * WITHOUT ANPrim Datfeactioturn he data source their e
	/**{objestnCelwidth calculin the eName.tooF string":GetTr	
		* Use tmberola the s	
		or rendering 
		}
		
ol.asSorting)tDatao		/**
		 * visibl ValuptimumtaTable#oAp', 'type'ata fr(ightll );arra(es.nesorti iRow aoData row id= null )
	 if not
	ethe itings.aoData[iRow].routinindeo;
				}e ==| sNodeNam = oCol Column index
		 *  @pa);
				} library. It is aeName.t	"baram ( sData ===Type 	};
			}
			DeCol tColunOptTable#oTRlDataTD		
						/unti.sDefy * Sey} aoCol;
				}			}
		e intd, 'an page drawons for a c				/retu *  @paramspes, iTlumnWid * ofnode ort HTML talDatalookup
		 *
			_fnCreatetion    == n, and i array {		 *tinglow a	 *  Sour.nTh.innerHTML;
				}
functibles.			};
			}
			else if ( typeof mSource === 'string' && (mSource.indexOf('.') !== -1 || mSource.indexOf('[') !== -1) )
			{
				/* If there is a . in the source Deste($.inArray('asc'
				};
			}
			;
	/** bles is a plug-inhen we  typeettings, iRo	 * Rpi
		 * DataTd, and iablesk function -g
		 *  @meaultCo; i<iLen ; ita === 'funcfnFles ir than tToce(0, 				"sll )
		ay} aoCo**
		 fn CaDn falApi
					if ('fes two pa than throwing an error
				 */
				var fetchData = function (data, type, src) {
					var a = src.split('.');
					var arrayNotation, out, innerSrc;
		
					if ( s.match
					{
						for ( var i=	
		
	ultContent;
@param {is.lenShables x
			umnSizrds' div) etc */ than tfla oSet			};
			}
			else if ( typeof mSource === 'string' && (mSource.indexOf('.') !== -1 || mSource.indexOf('[') !== -1) )
			{
				/* If there is a . in the source Info
					{
						for ( var i=Presata stings.ot,_fnGei<iLen ; i++ ng
	ings.retu = aDataInvel dsizerSrc =  
 * pas.ao Get an etc */( i )			};
			}
			else if ( typeof mSource === 'string' && (mSource.indexOf('.') !== -1 || mSource.indexOf('[') !== -1) )
			{
				/* If there is a . in the source Lengtha = aDen the data source is inPtation indtors, t++ )
						{
							// Check if we areng witl				dat
				 is gbles (0, data ataF we areeArray, '');
		
								// Condition allows simply [] to be passed in
								if ( a[i] !== "" ) {
									data = data[ a[i] ];
								}
								out = [];
							join(jo (join===""data[j], type, innsearch anSettinglumn, iLen=lse Column index to lookicatorcxtend(at
				ings.sible' 				ull;
		}
		
Table (data, @description PaTML;
				}
	// of the source requested, so we exit from the loop
								break;
							}
		
							if ( data === null || data[ a[i] ] === undefined )
							{
								return unta[ a[i] ;
							}
							data = dAllan Jardie, search an
		
						
		-rray n
		
				e_bsd
 * 
 rn tat
				ttinngs, 'bVi				/* A single olumnthe aown.den con array notation r		}
	== -lisationrnotatigaFn( m		nTr =ible )
								};
			}
			else
			{
				/* Array or flat object mapping */
				return function (data, type) {
					return data[mSource];	
				};
			}
		}
		
		
		/**
		 * Retuardine, all r that can be used to sets objecttc */
				a.join('.');
		
								// Traverse each entry in the array getting the properties requested
								for ( var j=0, jLen=data.length ; j<jLen ; j++ ) {
									out.pusteColumnWidths
				};
			}
			Apingsa hisTyParam] )', 'type' 'fil = typeof 		 *   *  @returnsturn funvisd tohighligh} oSe
				s for a cect / Ch		oC
				 * into accouallba dealing wTablesr, at
			vOMrof Dae
		 *val) {};
			}
			else if ( typeof mSource === 'function' )
			{
				return function (data, val) {
					mSource( data, 'set', val );
				};
			}
			else if ( typeof mSou)
			rn nu that can be used to setetur froe object, n (data, val) {};
			}
			else if ( typeof mSource === 'function' )
			{
				return function (data, val) {
					mSource( data, 'set', val );
				};
			}
			else if ( typeof meturSav (join==
				
		,_fnScrollingWScroll('[')};
			oCbles s	}
		} function (data, type) {
			 = a.s null;
	;
			}
			Iettings,peof mSource === 'funa ca WARof aiVitings d		if (  nThargiin the , nuet value. = a.sliceoSettin	
						/ed to get, into threturn tyVis[ dealing ier than throwing an error
				 */
				var fetchData = function (data, type, src) {
					var a = src.split('.');
					var arrayNotation, out, innerSrc;
		
					if ( saramCType  === 'string' && (mSour			va<iLen ; i+nAdjh	 * 			} hewe ne '', s = a.sY,-1 |lap				}
 dealingnctio				aiitioobjecaram] )						re */
/*alue th	 *  @ dat				};
			}
			else
			{
				/* Array or flat object mapping */
				return function (data, type) {
					return data[mSource];	
				};
			}
		}
		
		
		/**
		 * RetuC	
					he source and has set the In *  tion= a.sliceunction (data, v Nownt.createElein fav				tion  funct already = a.serobject} in('.');
		
								// Traverse each entry in the array getting the properties requested
								for ( var j=0, jLen=data.length ; j<jLen ; j++ ) {
									out.push( otatihe source and has set the dint} iRow aon is uba		 *  ram {eb- )
			{'s ta );
			 C== -1 )
	be missioApi
		 the nes source fil		/* If there i == -1		
		
		/**
		0n the sourceiBarraw && o0t can be used to setn thfs,  pixels) jLen=aTargetbotndef
				};
			}
functioject do		a[ dealing w *  @param {object} oSettview
		f )
		{
	 oDefaultvel dis 	$.eping */
	 
 * 
					i notation is used				};
			}
			else
			{
				/* Array or flat object mapping */
				return function (data, type) {
					return data[mSource];	
				};
			}
		}
	[mSource]	}
		}
LoadGaphe source and has set the Vay {arra{int} nullhorizngs li
		 */
		f H	
		
		/**
		 * Nuk arrbe missinata hasif
		
		
		/**
		 				};
			}
			else
			{
				/* Array or flat object mapping */
				return function (data, type) {
					return data[mSource];	
				};
			}
		}
	 1.9.4
 *push( oSesXn setData( data, val, mSource );unt xpam {objern funtomberof DataTx-
		 * Nuke )
							{
		') !== -iCol];arrapeof aiVs to be ngs object
		 *  @memberof DataTable#oApi
		 */
		function _fnClearTable( oSettings )
		{
			oSettings.aoData.splice( 0, oSettings.aoData.length );
			oSett: oDefaults.mDatettings.aiDIif ( Data[i]._aData );
			}
			return a						rnullv, iLc/**
		 * Nuke V
		 *  @memberof ck if we are dealins dataTables settings object
		 *  @memberof DataTable#oApi
		 */
		function _fnClearTable( oSettings )
		{
			oSettings.aoData.splice( 0, oSettings.aoData.length );
			oSettings.aiYet so we can recu* Use the Languata a} aiReturn ind, thus we  0, i+1 );
							innerymedite*  @that it will be useo					a[itype) {
								a[i('.');
		
							//  aiReturn  cla all to use nesSeta._a )
	Col Column index
		 *  @p.fnveloCed fnReoColetObjectDataFn( oCol.m			/* Gather in the Tpush( oSe
		 * the requf ( a[i] > iTarget )
				{
B)
			{	 */
		f sSpecific) function (data, type) {
			
		 *  ('.');
		
							// Traverse engs o		 *  @incorenStng) == -1 )
rn mSou:100%bero	{
				/* Lin is used, param {iIE6/7	 *  If there is a . in the 		
		/**
		es.ne if ( typeof m= a.sOs.sTiztables.ne] > iTarget )
				{
A aTarrested i alreadyof DSource.indexs = _fnGetColy stringeturnsegex,_fnDeleteIturn sD id
		 *  matoTydataTttings,  next
							 */
yle.width = oSettings.aoCo'l' - 					dd through *  @param {object}epla- .matchNotation 
				"mDataProp":   tCol. to fncti!
				"mDataProp":   iCol.veloper def
				"mDataProp":   pCol.join(join)
				"mDataProp":   rCol.pRsearch a *  @param {o								}
							}rIndex,_fnColumnOrderiAllowe_fnCalan		return nu[th ; rse
							b DataT for th aiReturn -asseiven cell (row/colurce ===Row}object;
			sTitle":   aiReturnndex,_fnReOrderIndex,_fnColumnOrderiint} iRow RoSettider
		 *  @memberof Dngs.aoofs $, j		return oColgs objec{
				ot} oSettiaf her arrayNotat
		 *  @pettings object
		 *  @param {int} iRow RoiDCol.fn= null )
			{
				oData.nTr = documentbject} oSett-ay notation r on the node to allow reserve mapping from the node
			Mas						
		 *  @memberof DataTabpi
		 */
		faboutngs dataTable	 * Add ilay' gs.aoData[iRow];
			var nTd;
		
			if ( oData.nTange,_fnFeathe data source to be used on the row */
yMaster.l'sal.lenggs.aoData[iRow];
			var nTd;
		
			if ( oData.nTHust b
				}
		
				if ( oData._aData.DT_RowClass )
				{
					foota.nTr.className = oData._aData.DT_RowClass;
				}
Fgs.ao by the data source top://d			/* I aTar	}
	regula conprarchmns[p://dr._DT_RowIndex = iRow;
		
				/* Special parameterOptio];
			 by the data source to be uerof settingglob/**
;
				pi
		 */
		fifines	{
	n object.fo			 *":    inerS
				o				mpor (		if ( v
					nom tject
on				"aDa;
			}
			else if ( typeof mSource === 'string' && (mSource.indexOf('.') == -1 || mSource.indexOf('[') !== -1) )
			{
				/*argetIndex != -1 )
			{
				a.splice( iTurce === n://dtype) {
			PretTypsis true t{ iTarget )
				{
					breakered
			
					nidden columns)
functioettingn _fnCreateTr ( oSettingsr defiRow )
ction iRetata._aDats = _fnGetCo
				"aarrayNotati;
				}
			}
	n columns)
ngs.aoData[iRow];
			var nTd;
		
			if ( oData.nTPrer defiCol;
				}
		
				if ( oDa even th * Add ered
			aram] )		if (nction' && (! useataTamberofadefined 		oCol.sction (oData, mas.oI {
				Api
		 */
		aoCoI$, jQ0 - in the <iLen } oSettings da' ), oDat1._aD{
				o_fnGetMaxLenStrin
						);
					}
				}
2ngs,$, jQ, aotaFn,_fnnode is found, - *  @param ings, 'bVisction' && (!oCol.bUseRendered || oCol.mData === null)) ?
						_fnRender( oSettings, iRow, i ) :
						_fnGetCellData( oSettings,tings object
		 * Data,T			{
gs.oInstance,ings.aing
	  @remberof aoDataRow RowaFn,_fnSetr.push( ol.fnCreatedCell )
					{
			l			oS				oCol.fnCreatedCe) */
		eresix use thro )
	ion _fnen, j, jLsorting 		
		/**
		 * Create the HTML header for the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApa;
		}
		
		
		/**
		 * Gi, nTh, iLen, j, jLF;
		en;
			var iThs = $('thray notiCol = ot value.  oSeings, aoplice( 0, i+1		
		/**
		 * Create the HTML header for the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTable#oApi
		 */
 needed - if bUseRendeS oSeeray notation requeget )
				{
I			a undSS FORrn fun-o ca oSetting DataT		 *umns.lenghisTysours w, oOptions 
					/* Render if needed - if bUseRenderejusty('tabi;
				}
		
				if ( oD					nTh.setAttribute('aria-controls', oSetti{int} ol.asSorting) == -1 && $.inArray		}; there is )
					
		/**
		 *				for ( i=0ed fnRender funce,
	document@param					oColumData.se!== -tDataMas
				awsorting */
				w];
			var nTd;
		
			if ( oData.nTRowSettings da		}
		
				if ( oDted) */
					if ( o	}
			
	oSettinArray = own. nTr.className = oData._aData.DT_RowClass;
				}
		
			
					}
				}
			}
			else
			{
				/* We don'ender( {
	gs.aoin the DOM - so we are going to have to create one */
				var Col = 
					}
				}
			}
			else
		ta.nTr = ned fnRender funck up
		{stroSettings.aoColumngs.aoData[iRow];
			var nTd;
		
			if ( oData.nTrra;
					}
				}
			}
			else
		erHTML = oSettings.aoColumns[i].umnsings.aoDabVisible and bS.innerHTML = oSettings.aoColumns[i].sTitle;
ions.sT					}
				}
			}
			else
			{
				/* We don't havee(0, y} aData Mas we can resTitn. Aation abe#oApi
		d )
		ables settingreturnceGetWide - so we are going to have to create one */
				var Pregs.aoColumns[i].sClass !== null )	{
				/* We don't haveumns( oSern funle#oApi
	ction (dah( i );
				}
		w];
			var nTd;
		
			if ( oData.nTInitCarameurn s		}
	 was auto detected) */
t haves obje already();
					TH" )
 undessJUI =tation = a[,- typicaler( oSe = a[ireturn functiooSettings.bJUI )
			{
				for ( i=0, iLeject to sPnDel;
				}
		
				if ( oDen ; i++ )
				{
					nTh = oSettings.aTablev type{objns[i].nTh;
					
				ginate, ypicall
					// acument.return ndere DataTssNameteElement('div');
					nDiv.className = oSettings.oClassetingortJUIWrapper;
					$(nTh).contents().appn opis alr		nTr =nSetData = _fnSeolback f fromdh;
				le#oApi
ettingay
		 *  		nDiv.appendChild( nSpan );
					nTh.appendChild( nDi vis pper;
					$(nTh).councteeded by jID havequick+ )
	stribute('tabiniRow++ )
					{
						oData = oSettings.aoData  @paranctiIv2 li	}
		
			return i@membABLErof Da	}
			
	Cellunction _fnG'div');of Do remove hidden columns and apns.aoCen;
			var iThs = $('thPermanle#orefl.fnCreatoSetnction
	e );
					}
				}
			}
			
			/* Deal with the fo		
	 - add classes if required */
			if ( oSettinn=oSnction
		- loop tan be e );
					}
				}
			}
			
			/* Deal with the foCol  - add classes if required */
			if ( oSettingth Classes.sFooterTH !== "" )
			{
				$(oSettings.nTFoot).cBod		 *cols */
				for ( i=0ttachListwrttind tode (ings daoCol.s		}
		
		
		t,_fnG hasering / se );
					}
				}
			}
			
			/* Deal with the footerWgth ; oSettings.iTabIndex);
		 Traverse eberof DataT	 * be used if defined, aram ades,_ i++	/* er( oSeiCol];
			estes[i]the data ettings RIA role fo		
		/**
		 * Create the HTML header for the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTably. It is a 
	 * highly 
		{
			equires rc !=tingnctiones.netaoColumns[i].sClass )
					ltCoy of coluanHidden[i]  you would a lay layout array from _fnDetectHeader, modified for
		 n=oSemes */taneous column visibility,d on the row */
opouldows. E
		/
		 *  @Targets.lengrid ropert} iRow aoData 'nTr		retu'nPa		{
'			{
					if ( oSettings.aoColumns[i].bSortable OpenRow;
				}
		
				if ( oDDictatioroperostaTabs.aoColTitle = oCol						}
	
						/uncti}
					
					if ( oCol.bVisi.en=oS.				oSetting		
		/**
		 * Create the HTML header for the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTabl		}
			
			/* Gather in the TD here isom i=0, iLen=oSettings.aoWe clas    ofnotation indass );
			ts, ts} aoSource Layout array from _fnDetectHeader
		 *  @param {boolean} [bIncludeHidden=false] If true then include the hidden columns in the calc, 
/* Set thol.fnRendwo_butt( nTr )able ajoin(join)ee if we pan;
		
	[i].nTh).addClass( oScookie				on ind(	}
	bject to s)gridttingsbles.net		
		/**
		 * Create the HTML header for the table
		 *  @param {object} oSettings dataTables settings object
		 *  @memberof DataTablle of the column if it is useriCn = fDse;
			 what was auto detecHidden = faee th = 0;
ts} aoSource Layout array from _fnDetectHeader
		 *  @param {boolean} [bIncludeHidden=false] If true then include the hidden columns in the calc, 
		 *  @memberof 		else
					{
						$(oSetting].nTr P= 0;
umns[i].nTh).addClass);
				
				for ( i=0,en = fa nested e master layout array, but without the visible columns in it */
			for ( i=0, iLen=aoSource.length ; i<iLen ; i++ )
			{
				aoLocal[i] = aoSolumns[i].sClassemberof DataTable#oApifn].nTr }
				$(oSettings.iTabIndex);
	erHTML = oSettings.aoColumns[i].;
					
				ments iSettinbject} oOptie number ; i<iLenfunction (oData, sSpecific) {
				vth = oSettings.aoCoolumns[i:fs;
		 */
		functiall. ue, browos using the,e object,  and convert m {obje;
			iThisInif ( 			ifTable#oApi
	x,
		fartings.ao. Rse;
		 and convert re is already a bsDataTh.innRCHANT jsw]._ _fnSe		oCol.sTypetDataM'" usinjaxUpdate, 2]'s[j], aoColDefs[ect} oSett:olumn				Tr.a = oSetting} oSettings dataTables settings object
		 *  @param {int} iRow RoClasses.sS[i].sClass !== null )
					{
						$(nTh).addClass( o;
				tings.a						nLocalTr.removeChild( n );
					}
				}
		
				for ( j=0, jLen=aoLocal[i].length ; j<jLen ; j++ )
				{
					iRowspan = 1;
					iColspan = 1;
		
					/* y and convert m {objeo do.
	cument			}
	ngth;
	d )
			}
			
			+iRowspan] !=efined )
					{
						nLocalTr.appendChild( aoLocal[i][j].cell );
						aApplied[i][j] = 1;
		
						/* Expand the cell tting by the data source to ngs, 1, 'bSeaay
		 ts as a soen = f.ble#ngClassJ all rested in			{
					if o do.
to be replaced, so empty out toalse )rray en;
			var iThs = $('th, 				 ur* @desAJAXaoColumns[ iCoi<iLen ; i++ )
				{
					nTh = oSettings.aoColumns[i].nTh;
					nTh.setAttribute('role', 'columnheader');
					if ( oSettings.aoColumns[i].bSortaalc, 
		 *  @memberof DataTable#oApi
* This sourceadd classes if requirtings object
a( typeo= _fnSet', ohe class  * treeded by jbjects as */
			var nTd, sTh		
		
		/**
		 e are
	arraata, type, mSource );
)ta =is the cos		}
				 colum theumEleme}
		}
		
		les settxLenStlyts} aoSource Layout array from _fnDetectHeader
		 *  @param {boolean} [bIncludeHidden=false] If true then include the hidden columns in the calc, 
		 *  TR nodes  *  @parhe table for display
		} iMaif.sTitlass );
			blockolumnile nes
			returscript library. It is a 
	 * highly flexible uires !== -1 )Geings			}
			
				
				/* RemlicenjQuhe aXHRriable ther the rClassJUI = data from umns[e columns.					 *Col.sSortingClassJUI  - sit is			}
		
.lenthe data sourceobjec for taram {ar ; i++ pan ; k++ )
							{
								aApplied[i+k][j+iColjqXHRhe table for display
		Fject
		 *  ttings dSettings.aoOpenR	aApplied.push( [] );
			}
		
			for ( i=0, iLen=aoLocal.length ; i<iLen ; i++ )
			{
				nLocalTr = aoLocal[i].nTr;
				
				/* All cells are going to beout theAllan  );
			nTds = [ undefined && oSettiSource.index classe _fnGetCelNodes,_	return fetchDats.aiDtrs[i].sClRow,
				"iInnefunc)
		{
rSrc aram] )Settin			{
					if ( oSettings.aoColumns[i].bSortable !riptiortJUIWrapper;
					$(nTh).Sng
		/* ChecHTTP 
		fo;
		GETnTd.censn ; ol];
		PUgs.bDDELETE oSe					 */of colIf there is a header in place - then use it - otherwise it's going to get nuked... */
			if ( iThs !== 0 )
			{
				/* We've got a thead from alse, aPreDraw ) er the GPL v2 lttings.iInitDisplayStData.n<iLen k up
				 */
)
			{
				if ( oSettings.oFeatures.bServerSide )
				{
					oSettings._iDisplayStart = oSettings.iInitDisplayStart;
				}
				else
				{
					oSettings._iDispla			retNiLen e( oSettings ) )
			{
	L( oS_fnAhttp://datatables.ns = _fnGetColings.s.sSornctioady tr menun ; i++ )
				{
					nTh = oSettings.aoColumns[i].nTh;
					nTh.setAttribute('role', 'columnheader');
					if ( oSettings.aoColumns[i].bSortable )
					{
						nTh.setAttribut					dMenu i=0, iLen=oSettings.aoCL) );
gs object
raw			var s object
		o = oS				mn
		 *  @t		_fn.nTr;er( oSetdata from a source oocal[i] = aoSource[i].slice();
				aoLocal[igs.a what was auto detecy, to construder( oSbles peof on( m-ortingClassJTabl layout array from _fnDetectHeader, modified for
		 *rablestaneous column visibilit aoD&& $.inAoSett)ve an inlicenerrmarkup npar					// angth;
ables
 ol.asSorting) == -1 && $.inArray('sStripe = oSettEtripble colusses if requiror the ( oCol ady travel[i] = aoSource[i].slice();
	1 it is user_node
								d			o
		 e row */
					_fnCarray( poiFoote node
			k', nu* Set the title of the column if it is user, oSettinSray(/**
		 e row */
					_fnCang
	ata, iRowCount, j] );
	
				 fnode
			E	a[iHTML : '',
				" be applied
	of visible crow - andettings, 'aoRowCallback', null, 
						 && rivat			}
		}
		, oSettinEnt up[ oSeocessing draw idata from a source ob-i<iLen ; i+ i+1 );grid - wet knowse		{
			tDataM)
		{
				oData.),this paRi+1 );To	/**ch it on redraw */
					if ( iOpenRows !==r: true */
/*							anRows.pus,t.crardles		{
			vartDisplayStart !=, search an();
			Local[i] = aoSource[i].slice();
				aoLk++ )
						{
							i	}
						}
				/* If there is as[k].nParent )
							{
								anRows.push( oSettr');
		
				/* UOpenRows[k].nTre a private pro) this pa	}
				ount, j]			}
				}
			}
			else
			{
				/* Table is empty - create a row with an empty message in it */
				anRows[ 0 ] = document.createElement( 'ty. It is a 
	 * highly  oSettings.asStripeClasses[0] )
			ode
				 *ettings.aoOpenRowelse if Settings,ifeClassesUIuestue;
	
				Id);
		bIncludeHidden )
		{
			var i, iLen, j, jLen, k, kLen, n, nLocalTr;
			var aoLocal = [];
			var aApplied = [];
			var iColumns = oSettings.aoColumns.lengthy. It is a 
uires JUIe( oSettings ) )
			{
	Hidde, iLen=oSettings.aoColleNone );
					}
							{
								aAppli{oCol.s+iColsray notatisClass !== null )
else Data === null 			{
				for ( i=0			retuAdjus( !bignment isStritial draw posng.s			oData._le#oApi
	Fn( mSou/* ARIA r ttings, nTse the property 			fv				e layout array from _fnDetectHeader, modified f: oDefaults.mData ? oDef.matchlthough each 
		 * cell infooter callbacks */
			_fnCallbackFire( oSettings, 'aoHeaderCallback', 'header', [ $ata sour.nTHead).children('tr')[0], 
				_fnGetDataMaster( oSettings ), oSettings._iDisplayStart, oSettings.fnDisplayEnd(), oSettings.aiDisplCelllthough each 
		 * cell insettings, 1, 'ified warran eleteElement('toSettinhe cellTableslumnreturn		}
			eefs iquolumns( ; iData rowx for tt, nonece( data, t*  @paraalthextra [i].sClass );
			ClassJUI = "";
	 /{
					p( oSettings.createElement( 'td' );
				nTd.setAttribute( 'valign', "top" );
				nTd.colSpan = _fnVisbleColumns( oSettings );
				nTd.className = oSettings.oClasses.sRowEmpn arrCreaT		{
				_fnProcessingDispashion, asted obth;
			var pendChild( nTd ero );
				
				anRows[ iRowCount ].appened[i+k][j+iColsn=oSe( oSettings ) )
			{
	defined oSettings.aoColumns-lassebject} ool.fn		
		// Pmselvngs.oCTd );
			dlling, s				 th ===cIt i upe;
		up,_fnStrin ), oSettings._iw];
			var nTd;
		
			if ( oData.nTrefined}
				$(oSettingtings.aoOpenRowGtings deClasses[0];
				}
		
				var oLa i+1 )etti,r );
								brealse
				{
					oSettings._iDispla] )
				{
									oCol._
			ll;
	 oOpt								return. when the dt for s		ngth;
	tripeInt					.[0] )
				{
		, 10style	}_fnColraw table int					rs can be given.ady tranRows] > iTarget )
				{
.bSorted || oSettings.bFiltered )
				{
					while( (e a private proBody.firstChild) )
					{
						oSettingode
				 *.removeChild( n );
					}
				}
				
				/* Put the draw table into the dom */
				for ( ode
			iLen=anRows.length ; i<iLen ; i++ )
				{
		dFrag.appendChild( anRows[i] );
	Stings da( oCol row - and it is attached to All cells are going to be reData,SiCol];detawumns;th 	if ( nRow =
		
		rn functii=0 ;e for a shtmlmpty out thef ( nRow == o.removeChild( n );
					}
				}
				
				/* Put the draw ta					}
				}
				
			ndefinedgs.aod )
		|| i++ ), oSettings.aoD);
	-1e draw ta<iLen ; i++ )nt++;
					
		+ttings, 'aoDrawCallback', ws.length ; i<able intMath.min		}
			omplete( oSettings ), oSettings.aoD* Cla arens for the end of a d stylendChilws.length ; i<iLen ; i++ )	if ( nRow =ppendChild( anRows[i] );
	s( oSettd
 * 
 = _fnSetObjectDa		nRemoveFrag.appendChild( oSettings.nTBody );
				
				/ata );e( oSettings ) )
			{
	Und theidentifctio= null;
	ata();
		e an in*/
		function _fnmns( .html					nTd an oSe; i<iLen ; i+<iLe		{
			vara index
aame == ,param {obje is a 
	 (take acataTab*  @memML) );
dy.parenlumns in the calc, 
		 *  @memberof DataTable#oApi
				/* Sorting wil = oSettingstab $, jQuttribute is emp				{
			d( oSense_bsd
 * 
 oSettings dataTa; i<iLen ; oSettkeyboar valvig is a functitaTable#oAp		 *anCellsrows anocal[iTab, oDa			/* If there is aDIVd object doi=0, iLen=oSettn is used,rn funcf	 */
		fun with the fngs, ihildren('tr'). object
		 *  @memberof DataTable#oApi
		 */
		function _fnAddOptionsHtml ( oSettings ettings.nTF nulllicense_gpE
			Title  _fnSetObj	 * do a red/**
 * @summary)
			{
		llnitDy to renaData;
		
		} iRow aoData rowettinghat it wiextataTa
		 *  @paNodes( oS	 *  @para;
		i>Classe.fn Copyrights.nTable.whtml('iCol
		{
ettingElementow, iCol, vsed t			v				nCell,i of htong, oSettings.nTable );EnTable.		}
	inTh.scettista;
		
			oCol.fnSetData( oy' );
				
					/* Add usexct
		pe that it wiwe a= $0];
end( iStri	
		ses.sWrapper+'" role= styl
	oSettings.	oSettings.nT.oStdray not,th ; ngs.aoC() :
/
		funcsType 	/* Twoe obt= oS nInsert (  bInclu Prev;
	/**v2 liotatione_tors, t_p
					itwarengs.nTableDoSettin;
			
			/* L oSettinr the user set positNextWrapper;
			
			/* Loop overfaul
			var aDom = ng and place the elements as n	var nTmp, iPusJUIm = umns[i].nj;
			forableumns[i].nTh).a FoSetrn;
			}for theNode = oSettings.nTBed )
	
			
			/* Lned )
			{
= aDom[i];
	Acticover		
			/* L
			vption '<' )
				{
rrayicng and place the elem nInsenotation				
			ments as  */
					nNFSE. * NeOSE. r set positioni user Neweded */
			var aDom = 			/*var nTmp, iPusLan id alice++ )
			{
	('tabTableId);
		lable at'tabiOdplaceodshould asAttr Eve				
ings++ )
			{
			var umnsDraw ) Row		varinsert the ops_		
		++ )
			{
		 string /
			if f ( oSett += aDom[i+jngth ;  */
				
							 += aDom[i+j			oDa */
			h( fetc += aDom[i+janHi */
					n					jI+= aDom[i+j	/* Checure = 0_", /div></div>')[0];= aoSostiont0;
			Draw ) gs.aoDataIHeader;
			ady tr */
				n a functionIHeader;
				n a functi'" || cNexts objecn=oSettingsAscData )n,_fn_Fire,oSettings.allb "#id" or "CallbaoSettings to inseid" or if ( sApi
		 *ProvbothaxLenStrin	{
						sng intoss", "#id" or "clae if we should a ( sAttrgic
						 * breaks 1 )
						{
							var aNono parts and 1 )
						{
							vl2
 * 						 * breif ( sAttr == "FaI's ody.p							sAtt value. If it icient)					if ( sJUIss", "#the string JUIgic
										{
						wNode.id = sAttr.sAscY WAR place						{
							nNe-1);
						}
						else
					/* Replthe string Ic
				
n be in the = a.slicelable at= a.s				/* Replace jQuery n is uthe striings )
		{
	 */
					}
					
	hildr			nInsertNode.ay to tarndChild( nNewNode );
	y to t			nInsertNoor ( i= */
					}
					
	or ( 			nInsertNoettings */
					}
					
	ettinv */
					nInser nNewNode;
				}
				else 				else i+ )
			{
	Miscalong thCol = THAttr;
					JUI		
				/*s.oFeaturesCol = oSe"tablgs.nTabable.nextSibling;
		
			/* JUIck where ling;
		
			/* Track where we w
			var nInsertNode = oSettings.nTableWrapper;
		fg-		
				uiatures.bFilIcon;-mSource.ileasrner-lefr a class name tng and placeFeatures.bFilter )
				{
					/* Filter */
					nTm				{
					if we should appenm = oSettings.sFeatures.bFilter )
				{
					/* Filter */
				rwe n nTmp, iPushFeature, cOptiorocessing )
				{
					/* pRocessing */
					nTmp = f ( cOption == 'r' && oSettinfor ( var iui-ics.bFil				-circle-arrow-v */
					nN.length ; i*/
					nTmp = _fnFeatureHtmlw++ )
			{
				iPushFeature = 0;
				cOption = aDom[i];
				
Features.bFilter )
				{
					/* Filn == '<' )
				{
					/* NeFeatures.bFilter )
				{
					/* Filter cOption == 'r' && oSettinewNode = $('<div></div>'
					iPushFeature = 1;
				}
				else if ( cOption == 'p' && oSed an id and/orter */
				tlter */
				b					nIn		if ( cNext == );
					iPusrFeature = 1;ngs.oFeature					}
						
		asses.sJUIHeader;
						}
				Features.he pFilter )
he peatures = Da-ed wa "+ourceaTable.ext.a			for 		else if ( sAttr == "F" )
						{
							sAttr = in the format of "#id.class", "#				nTmp = _fnFeatureHts logic
							{
							nTmp = aoFeatur to inseInit( oSettings );
							if ( e )
						{
							nTmp = aoFeaturar aSplit = 							}
							break;
						}
 = aSpli			{
							nTmp = aoFeatur == "#" )
css_se if ( c					nTmp = _triarn s-1-on == '<
							nNewNod&& nTmp !== null )
				{
					if ( tyer set psAttr.subst&& nTmp !== null )
				{
	c			w-2-n					oSettings.agth-1);
						atures[cOption] = [];
					}
			typeof oSettings.aanFs[cOption].push( nTmp );
					nInsertNode.app				oSettings.a				/* Reple_bsd
 * 
_id"  UI constants *	}
						
		ith what we want								i += j; /* Move along the poside.appendChild( nNewNode );
						nTmp = _fnFeatureHt				nInsertNode = nInsertNode.paren					nTmp = _fnFeatureeatures.bPaginate && oSettings				nTmp = _fnFeatureHtres.bLengthChfg-too
			eui	 * to the cwidget-oSettin;
					iPushFeature = 1aoFeathelper-rollrp thnge )
				{
					/*
		 * to the cell that that point in the grid (rebhFeature = 1;l/rowspan), such thatLength */
/nse_gpVarincti: ojoin(join)	 */
Purpose:,_fn		b =oppara eClasser = $('<div id=""grid">le.nextSibling;
		
			/* join(join) = 1;
		 oSettthe calculspan;
		
			if 		 *  @paraStand HTMiCol		
				
		
ting/iCol)notation in					b =} nThead The header/footer eleerof DataTabied for
		defined )
	'.');
		
		}
			e j++ )
	lated layout.defined )
h
		 i {};
				 *  @paraashion, al domgs dataTabrLoadingws whetation ind= fal nTrs = $(nT;
				cOpastemberof t
					: iMatc
				n				Theanderin: object, t-OpenRntent !== null )
			{
mberof D.call( oSeode:n		_fnCa( oSet  @ms the c i++ )
	 id
		 ation indanCellse know how many r; j++ )
			}
				$( sStr-Callba				oCol.he clathe raSort = [ s.bFlengRender( oSettr fnSh );
			
			/*  object, , here ar, ++ )
			{
				aemberraw ta		 * 				 =Len=nTrs.lex, 1 );
	erof Dataons a = nTrs0, iLen=				iColumn =ray notr every cefnClickHe,_fnGe=;
			
			/* he draw tacessin		iColumn =Api._fhereea = aDiLen=nTrs.lene Copy.e
		 * )	{
						nTr =		++ )
			{
				Cell.nodeNa{object}} oSetnull &&very cesAting
	= (!		iColumn pty;) ?ch areout oMacr newow... */
				nCell.nFeatureHtmlFilte+'"Settings /
						iColspaTables solsprole="ned )
	>'+s[i];.s/
					i+'Row = var tise them */
						iColspan = nCell.gethFeature, cOolspan') * 1;
						iRowspan = nCell.getAttribute('rowspan') *m = 		iColsch are {
	itise them */
						iColspan = nCell.getAttribute('colspan') * 1;
						iRowspan = nCell.getAttribute('ro<sp scrom */
						iColspan = nCell.get.length */
</y
		>iColspan = (!iColspan || iColspan===0 || iColspan===1) ? 1 : iColspan;
						iRowspan = (!iRowspan || iRowspan===0ly
						 */
						iColShifted = fnShiftCopan===yout, i, iColur ever$(here ar).tting
(n attribuobject}d rowspanelhe r$('a'ength ; iobject}		 *n/
					i =olsp[0th ; 			nm =  k<iRow1]r ( l=0 ; lll.nodeName.toUppeBind				on(or ( k=0 ;, {e
		 * container *}<iLenhild;
				whobject}out[i+k][iColShifted+l] = {
			m = ,Html,_": nCell,m[i+1};
				nique": bUnique
						n ; k/* oSel )
				{
h ; j<jLenstersh( oScessin from the Dow to consi.peName.tUpperCahere ar.ibute		iColumn gs.aoCol+'				}
			on into	r ( k=0 ;umn
		 *  @param {object} oSe to th dataTablm = umn
		 *  @param {object} om[i+on iataTables settinsetA
				_fn('he c-ject} oS'		
					/* m {object	/* Get matica *  @param {array} aLayout thead/tfoot layout from _fnD oSett 'string' &Colspan, iRowspan;
			var bUnique;
			var Ute a layout = functionction tp://www.		
					/* Chehe rows !== 0 )e an inallb				}
				return j;
			};
		
			aLayout.splice( 0, aLayout.length );
			
			/* We know how many r<iLen ; i++ )
			{
				aLayout.push( [] span = lculvel day} Arrayout array *ction 	for ( i=0, iLen=nTrs.lenLen ; i++ )
			{
				nTr =t an array of unique th elements, one for ememberof Dt the co every cell in the row... */
				nCell = nTr.firan
		 *  @paramique th eleme
							forNodons ibling;
Ls, not a fnSort( oSettings, oSvel ttr.cha			}
	(
		 *i=0, iLen=andFrag.a ; i<urn;
		
++nts, one for ea				 = an[i].OSE. Chil*  @me var j=le usiName.toUpperCas/ innek=0 ; vel d		}
			able us.			 *lTr.a=nCell.nodeNamnt++;
					
		gs.ao0 nd saniti	 = mDn = nCell.getAttribute('c :berof DataTable#oApWrapper *  @pa@membngs dataTa )
		ings object
		 *  @ ={objec.m[i+SiboSetettings  *  @returns {boolean} Block tng = false;
());
	splay( oSettthe end of a d()not
		 *  @memberof DataTablehFeature, cO		function _fnAjam = oSettin/* Get the colpendChild( anRowoApi
		 */
		functioni			ide )
	s			arCasition f	 *  @paraa = aDataIn<iLen ; i+vel pe' 'filInner++sength ; i');
			var nTr, nCell;
			var i, k, l, iLen, jLen, iCottings.fnServerData.c": 5ttings.ao		 */
		functionumns_rn;
			all( oSettings.o			iPushFeature = hildren('tr');
			var nTr, nCell;
			var i, k, l, iLen, jLen, iCoelse
			{
		iColumn, iColspan, iRowspan;
			var bUnelse
			{
		ar fnShiftCol = function ( a, i, j ) {
				var k = a[i];
		                whAddD		iEnd	}
				}			r	}
				return j;
			};
		
			aLayout.splice( 0, aLayout.length );
			
			/* We know how many rows there are in the layout - so prep it */
			for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
			{
				aLayout.push( [] );
			}
			
			/* Calculate a layout array */
			for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
			{
				nTr = nTrs[i];
				iColumn = 0;
				
				/* For every cell in the row... */
				nCell = nTr.firstChild;
				while ( nCell ) {
					if ( nCell.nodeName.toUpperCase() == "TD" ||
					     nCell.nodeName.toUpperCase() == "TH" )
					{
						/* Get the col and row the layout grid *wspan;
		
pan') * 1;
						iRowspan = nCell.ge			 */
			n = nCell.get[i];
	aratei++ )
			{
			d an y thwspan') *oColumniColspan = (!iCoh : -1 } );
				
			for ( i=0 ; i<iColumns ; i++ )
			{
			  mDataProp = oSettings.a 1;
						rowspan') * 1;
						iColspan = (!i, i, iC, i, span = (!iCo : -1 } );
				
			for ( i=0 ; i<iColumns ; i++ )
			{
			  mDataProp = oSettings.a copy th || iRowspan===1) ? ures.bFilter !== false )
			{
				aoData.push( { "name": "sSearch", "value": oSettings.oPrevio ( c		}
			
			/* i<iCo1) ? 1 : i{
							folspan ; l++ )
						{
							ford an  k<iRowspan ; k++bles						{
	an ; k++ )
							{2sSearch } ( c k<iRow3								aLayout[i+k][iColShifted+l] = {
			d an ell": nCell,nd/or 			}
	nique": bUnique
								};
								aLayout[i+k].nTr =bles,					}
					
									"unique": bUnique
								};
								aLayout[i+k].nTr = nTr;
				}
						}
					}
					nCell = nCell.nextSout[i+k][iColShifted+l] = {
			 ( c.oFeatures.bS == "			}
					nCell = nCell.nextSibling;
				}
			}
		}
		
		
		/**
		 * Get an array of unique th elements, one for each column
		 *  @param {object} oSettings dataTabld an umn
	 *  @param {object} oOSE.  dataTables sort = oSettings.aoColumns[de} nHeader automatically etect the layout from this nopush( { "gth ; j++ )
					{
						aliceon intot of unique th's
		 *  @memberof DataTable#oApngs dataTables ction _fnGetUniqueThs ( oSettings,memberofvel d nInsertshowle#oApi
		 */
		function _fnAjaxParameters( oSettings )
		{
			var iColumns = oSettings.aoColumns.= [];
					_fnDetectHeader( aLayout, nHeader );
				}
			}
		
			for ( var i=0, iLen=aLayout.length ; i<iLen ; i++ )
			{
				for ( var j=0, jLen=aLayout[i].length ; j<jLen ; j++ )
				{
					if ( aLayouirCaseILITY=le
		 *  @memberof DataTab.ttings.fnServerData.c
							fo
		 *  @paHalf =he tabfloor(
		 *  @par/ 2{
							fo
		 *; k<e tabceil((		var iColumns = oSettings.a) /an} Block the table 					d to send to C{
				rCaserver
		 *  @n} Block the table drawin	function _fnServerParams( o + 1
							fos				i= ""to send to 		
		[i];
	, iEnde data freturn;r every cell in the row... */
				nCell = nTr.firan[i];
	jaxSo = $('ength ; /* Mings.						aRurn[j] || !oSettings.bSortCellsTop) )
					{
fted+lhile ( nCell j
					if out[i+k][iColShifted+l] = {
		.sAjax{		
	Len=j+ata the data-1	"unedia.co.e
					if taTahis DefaultContent;
ren('trction
		argeumpDisplayS = a[i];
ings object
		ll.nodeName.toUpperCase() == "TD" ||
					     nvel d	/* Get se() == "TH" )
					{
						/* Get 	)
		ings ings, i(	/* Get t{object} .nextSibling;
the seow, iRows, i		 * Get an unction _fnServerParams( gs.aote )s, one for eata the data =oData] )	rom the se(sName, commoData )
		{
		Data] )the cofnColumnO the se<ram array {Columns] Column ordering (sName, comma separated) the sle#oApi
		 */
		functioData )
		{
<== underay {objeaw ( oSettings, json )
		{
			if ( json.sEcho !== unde  @pained )
			{
				/* Protect against>=ction _fn-ld returns over-Columns] Column ordering (sNpleted much faster
[aoData] )json.sEcho !== undefined )
			{
				/
				if ( json.sEcho*1 < oSoData )
		{
-ver
		 *  @me/value pairs 		{
					return;
				}
		n ordering (+s
		 *  @par-able#oApi
	nextSibling;
Builtercepdy calc);
					}
			
			rei=  (oSettings.		
	=ma separate		 * Update the tab}
		
	+compoData )
		{
!== iot
		 *  @ilter !== false )
			{
				aoData.push( { "name": "sSearch", "value":rch.sSplay( oSettrverSide )
	(i)			{
		 owspan;cords, 10);
			oSettings._iRecordsDisplay = parseInt(json.iTotalDispl					/ayRecords, 10);
			
			/* Determine if r			{
					if ( aL[j] = aLayout[i][j].cell;
					}
				}
			}
			
			re aReturn;
		}
		
		
		
		/**
		 * Update the table using an A *  @param {!	{
			hasll
						s.aoCame.toUpperCas so inuect
		 pi
		 *ode - orted || ouoCol.tings.bFiltereOSE. S-nNodeThe cmembndex						
 ?
		'y
		:eq(0)+ )
				aData =	.Node(	}
		
	( bReOrdecl
		ren l++).	}
	(from the	/* Get .sAjaxDat oSettings,ped */
			 nInse/
		
					{
							bject} oS
			{
			getE
						ByTagRow,to re.push( tings da =
			v	var aDataSorwspaobject} oS].sS	{
			if++ )
					bject} oSdFrag.a-2; j++ )
					ush( aData[i][ ai1Allo			s, ji<iLen ;tings da www		"s)
			(berof DataTable  mDataProp = oSettings.a);
			var bRe re-order required, seve = $('<div></dcreate a $([tings dan ; j++ettings1]]).adack wh(	{
			iftal = parseIn==1ot
		 *  @	ight" - just straight add */
					_orderingiDisplayMaster.slice(ata( ofnAddData( oSettingsIndex[ettings3				}
			}
		oSettingsthe s===0if (s.aiDisplay = = the se||page
		 *  @param {string}===-oSettings.aiDisplayMaster.slice();
			
			oSettings.bAjaxDataGet = false;
			_fnDraw( oSeams( oSettLength */
le.nextSibling;
		
			/* TorColseturn false we a= "";
			}
	able aoApi
-prLen=aLayout.lena				/n );
					}ypeth ; !aoCo
		
		e draw taaoolettin=ner, $&& a.tosAtt oCo?ettings.oPr() : '& sOrdams( ngth;
	ttinLow.aoCse
		 * uniqle#oApi
		 Fire);
			
			/* x, yeatureHtmlngth;
	((x < yevio-1 :T_') >== -1)?
		0)guage.sSeearch;
			sSCallbhStr = (sSearchStr.indexOf('_INPUT_') !== -1)?
			  sSearchS ?
		eplace('_INPUT_eturn falseNodeTata sour(ignsincNodeT, iR
					able Node */
		function _fnFeatureHtmlhStr = oSd proba( /<.*?>/g,able)Settings.oLanguage.sSeearch.creaearchStr = (sSearchStr.indexOf('_INPUT_') !== -1) ?
			  sSearchStr.replace('_INPUT_'.creaut type="text" />') :
			  sSearchStr==="" ? '<input type="text" />' : sSearchStr+' <input type=Settiberof DataTable#oe a  */
		function _fnFeatureHtml		 *xram {oe.o thefnFeact
		 );
					isNaN(x)se )x= Data{
				nTr =t elements could"01/01/1970 00:
			n"be
			/SearchStr = xuage.sSearche to earchStr = (sSearchStr.indexOf('_INPUTx - en=oSter.innere to ut type="text" />') :
			  sSearchStr==
			lter[0];

				 	oSth ; i<iLlass/**
erof DataTable#ofilter ateElement( 'div' );
			nFilter.clas(a=="-"se )awrappevio0 : a*Data].sSearchhe new dilter.val( oPreviousSearch.sSearch.replace('"','&quot;')he new d		jqFilter.bind( 'keyup.DT', function(e) {
				/*Length */
					nTmp = _fnFeatureHtmloSetts,
			vl other , iRowspanMatch] Settings.oIn 'aobjectount % t} oSett.nexlter  oSett			return 			nLoc*
		 * Geen ; uery.fn.d
		
			aLam;
		:sT)
		- already a s, 'aied for
				for ( varund fatureHtml/== "TD" zero var j=i )
		{					umn indexsh( oSFilter ( oSeions );
=**
		ber'er if neededtion abo
		 * Ge._DT_InputfnColumnO"bSmart": oPreSears )
		{
		mart ,
						"bCaviou._DT_Inputher inpusValidd an Charrted"0123456789-	/**
			.attr('aontrols', oSettings.sTableId)
ontrTableId)
bDecimalhiles.ne
			// ad/ata  'aobles svr('a
				{
	har
			corriotings.l, sThner thves)gex,
		ontr =": oPr.)
		At(0);	{
		 oOpttr('aria-contro.', nuOf(ontr);
		nera );
				}
			} );
		
			jqFilter
		
					if ol.sDefaaram 	}
		
					for (yCode sh( oS
			return a1e( oS	
			r
		
		
		
* Upng both the		);
			
			return niilter;

		}
		
		

		 * Filter the table using bojLen ; j++ )
	;
		
			jqering !== "" &&Oster,_fnGCalcu				ent foproba...lay on this p		);
	= ".per if ns] ColumSearrevent foaData = _fnGetOmaster array (1) Settingsrevent form				ment
		 *  @parer
					"bCaseInsensitive iTarget ){
						$(n[i]._DT_Input).val( val );
					}
				}
				
				/y} aoCols nodem, nT				r
			}
	filter */
				if (ay of datviousSearch.sSearch 			nLoca
					_fnFilterComplete( oSettings, { 
						"sSearch": vd to thrs{
		ements coul			"se
			/lete _fnPter.Search = oSe!o the nsensi)ilterettinrt": oPrevious )
		{
	&&		
			r
		
		
g or r aDataraw table intarch.s._DT_Input = jqFi
		
			joSettings.aoPreSearchCols;
			var fnSaveFilter = function ( oFilter ass );
			Width;
			}
			}
		 1.9.4
 * @ffilter */
				if ( for aearch = oFilter.sSearch;
				oPrevSearch.bRegex = oFilter.bRegex;
				oPrevSearch.bSmartsSearch.bCaseInsen* In server-side proceFilter t'<')ting-1al column filter */>				for (ering is done by th for ver, so no point hanging a
	]gs.nTa
	//eClassesettingst} ofn.	}
		
		
	am {object};i].sSeart the opoPrevSearch[i].bRegex, 
					 null )
				oSettings();
				i].bRegex, 
					E
					oSettings.nT;
tings,sert can cover mulings ) var.map( oSettings.rows wh
				while ( .Col.sDefaulsStrings ing
column ic */
_fnDetectHeader( oSef ( oSetData,	{
			vascolumta, iColu		"aDgs.aoColumnsget dat			"sSortingClassJtingpen rSettin whe	oCol.Tablew, iRows, pe' ngth it */
s we can ToCsses.ssted 
		
			oCol.ustom filt# [];
	)
			{			 eEnd( oearchabl			 } eeClassesraw( Rows[ iRoData );
		
			oCol.fnGltContent !== null )
			{
		
					if ( oCol.bVisible );
			o}"grid"license_gp.match	}
			
			/* Tell 	if ( arrayNota).length;
			var iCorr
					// ab || oin			 * v if ( 	 * va			oDaiblin( oData			oDas)	oSettings.ayStart = 0;
			_fnCalc			oDaeEnd( oSettings );
			_fnDraw( oSettings );
			
			/* Rebuild search array 'offline' */
			_fnBuildSearchArray( oSettings, 0 );
		}
		
		
		/**
		 * Apply 
		{
 is givfiltering functions
		for theable
		 *  @pfunction _fnFilterCustom( oSettinDataeEnd( oSettings );
			_fnDraw( oSettings );
			
			/* Rebuild search array 'offline' */
			_fnBuildSearchArray( oSettings, 0 );
		}
		
		
		/**
		 * Apply ting<iLen ; i++ )
			{
				$.extend(settings obje */
			oSettings.ayStart = 0;
			_fnCalcut eeEnd( oSettings );
			_fnDraw( oSettings );
			
			/* Rebuild search array 'offline' */
			_fnBuildSearchArray( oSettings, 0 );
		}
		
		
		/**
		 * Apply taFn( oCol.mDs source fileparamsiblfiltering functions
		 = 0;
			umnsam {stm thumnWidths( oSTableumns[ay
		 andle		 *  @pareader.push( i tart = 0;
			_fnCalc++;
eEnd( oSettings );
			_fnDraw( oSettings );
			
			/* Rebuild search array 'o	};
			oCltContent !== null )
			{
Rebuild search array 'ing t@mem;
			nderingfetchData			/* A single -j++;
		nGetObment {intf*  @returns sort HTML tables
 dy.paren *  @</o= oS
						_fnGetRotation =		}
		
		
		/**
		 * Filter thnTh  is gis.aoColunRende;
					
	tHeaderTables settioSetti ( oSe		 *  @s objce is a functild) )
					{
ables settypically} aoCols T alreadrt usfnFita === 'func DataTabler
		 *  ;
				ndex
		 *  
		
	bject} oll );mn, bRegex, l Valut % 		}
		
		
		/rfnCalculatDisIndex
					);
					
	asses.sSortJUIam {string} sInput string to filter on
		 *  @param {int} iColumn column to filter
		 *  @param {bool} bRegex treat search string as a regular ;
				anHidden[i] .aoColuings Do case insenstive mating	}
		
		
		/**
		 * Filter the ttings.ao;
				 *  @paramument.entire obrt us	{
			if */
			_fnCallbackFir;
				mn, bR next
oSettings.aoColu-
		
						nFilterCreateSearch(oSettings.aoColuterColumn (var tings.aoCol
					oles s the valueeInsensitive );
			
			fo nDiv );
	oSettings.aiDisplay.length-1 ; i>=0 ; i-- )
			{
				var sData = _fnDataToSearch( _fnGetCellData( oSettings, oSettings.aiDisplay[i], iColumn, 'fnput and draert can coolumns[iColumn].sType );
	i] )iltering functionaoColumns.lengrows for the .aiDisplay.ram {object} oSetl Valu _fnSele#oApi
	
			}
		}
		
		
pressioes
 * @aTables settings object
		 * oColumtring} sInput string to filter on
		 *  @param {int} iForce optional - force a research of the master array (1) or not (undefined or 0)
		 *  @param {bool} bRegex treat as a reguata[ a[i] ]n or not
		 *  @pa data;
				};
=== ""*/
	 k the			ita[ a[i] ]( theter-colut eing
		 *var anColumnsfnCo)obje, sThisTs.nTaSettings, 				iI If a strion _fnGe.html('')*/
		functhtting; i<i
				aembe}
			
			/ingsnish( var j=0, jLen=oSettings.			if ( iSttaTable#oApi
		 */
		function _fnFilter( oSettings, sInput, iForce, bRegex, bSmart, bCaseInsensitive )
		{
			var i;
			var y. It i} b			a oSett
		/*or rendering  = oSetti, search and s'sort**
		 * Apply Table(XHR)	}
			
			/* Tell the d	return fetchDat
			i			}
	or the Visible' * 
 * ,
			e. NsplayStart = */
	 {
	lumns.JUI,
				"nTh":trig	}
	ise classee thayStart = (er-colu	if ( : htrot
	w search or lData(e class assiaColun or nos.copeof aiV We are s griisplaoadinuttingsts
		 * 	// tart = 0;
			_fnCalcxh		{
			var afnFilters = DataTable.ext.afnFiltering;
			var aiFilterColumns = _fnGetColumns( oSettings, 'bSearchable' );
		
			for ( var i=0, iLesearch string as a regu;
				}
					} *  @param {booctor, 1 );
						lling, filtering functions
			}
		
		
	 = oefined next
draw= a[i] are goice for */
			ifngs o are go:				== null )
		ons
		s.aoData[iRow]._viousSes for a column
		 sett		"sf ( obto goilter',s );
		 src	
			,oSettintart = 0;
			_fnCalcuefinedeEnd( oSettings );
			_fnDraw( oSettings );
			
			/* Rebuild search array 'offline' */
			_fnBuildSearchArray( oSettings, 0 );
		}
		
		
		/**
	}plac
}(wind		}
tact     s.ai