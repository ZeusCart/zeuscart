/*!
 * jQuery JavaScript Library v1.8.3
 * http://jquery.com/
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 *
 * Copyright 2012 jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: Tue Nov 13 2012 08:20:33 GMT-0500 (Eastern Standard Time)
 */
(function( window, undefined ) {
var
	// A central reference to the root jQuery(document)
	rootjQuery,

	// The deferred used on DOM ready
	readyList,

	// Use the correct document accordingly with window argument (sandbox)
	document = window.document,
	location = window.location,
	navigator = window.navigator,

	// Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

	// Map over the $ in case of overwrite
	_$ = window.$,

	// Save a reference to some core methods
	core_push = Array.prototype.push,
	core_slice = Array.prototype.slice,
	core_indexOf = Array.prototype.indexOf,
	core_toString = Object.prototype.toString,
	core_hasOwn = Object.prototype.hasOwnProperty,
	core_trim = String.prototype.trim,

	// Define a local copy of jQuery
	jQuery = function( selector, context ) {
		// The jQuery object is actually just the init constructor 'enhanced'
		return new jQuery.fn.init( selector, context, rootjQuery );
	},

	// Used for matching numbers
	core_pnum = /[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source,

	// Used for detecting and trimming whitespace
	core_rnotwhite = /\S/,
	core_rspace = /\s+/,

	// Make sure we trim BOM and NBSP (here's looking at you, Safari 5.0 and IE)
	rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,

	// A simple way to check for HTML strings
	// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
	rquickExpr = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,

	// Match a standalone tag
	rsingleTag = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,

	// JSON RegExp
	rvalidchars = /^[\],:{}\s]*$/,
	rvalidbraces = /(?:^|:|,)(?:\s*\[)+/g,
	rvalidescape = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
	rvalidtokens = /"[^"\\\r\n]*"|true|false|null|-?(?:\d\d*\.|)\d+(?:[eE][\-+]?\d+|)/g,

	// Matches dashed string for camelizing
	rmsPrefix = /^-ms-/,
	rdashAlpha = /-([\da-z])/gi,

	// Used by jQuery.camelCase as callback to replace()
	fcamelCase = function( all, letter ) {
		return ( letter + "" ).toUpperCase();
	},

	// The ready event handler and self cleanup method
	DOMContentLoaded = function() {
		if ( document.addEventListener ) {
			document.removeEventListener( "DOMContentLoaded", DOMContentLoaded, false );
			jQuery.ready();
		} else if ( document.readyState === "complete" ) {
			// we're here because readyState === "complete" in oldIE
			// which is good enough for us to call the dom ready!
			document.detachEvent( "onreadystatechange", DOMContentLoaded );
			jQuery.ready();
		}
	},

	// [[Class]] -> type pairs
	class2type = {};

jQuery.fn = jQuery.prototype = {
	constructor: jQuery,
	init: function( selector, context, rootjQuery ) {
		var match, elem, ret, doc;

		// Handle $(""), $(null), $(undefined), $(false)
		if ( !selector ) {
			return this;
		}

		// Handle $(DOMElement)
		if ( selector.nodeType ) {
			this.context = this[0] = selector;
			this.length = 1;
			return this;
		}

		// Handle HTML strings
		if ( typeof selector === "string" ) {
			if ( selector.charAt(0) === "<" && selector.charAt( selector.length - 1 ) === ">" && selector.length >= 3 ) {
				// Assume that strings that start and end with <> are HTML and skip the regex check
				match = [ null, selector, null ];

			} else {
				match = rquickExpr.exec( selector );
			}

			// Match html or make sure no context is specified for #id
			if ( match && (match[1] || !context) ) {

				// HANDLE: $(html) -> $(array)
				if ( match[1] ) {
					context = context instanceof jQuery ? context[0] : context;
					doc = ( context && context.nodeType ? context.ownerDocument || context : document );

					// scripts is true for back-compat
					selector = jQuery.parseHTML( match[1], doc, true );
					if ( rsingleTag.test( match[1] ) && jQuery.isPlainObject( context ) ) {
						this.attr.call( selector, context, true );
					}

					return jQuery.merge( this, selector );

				// HANDLE: $(#id)
				} else {
					elem = document.getElementById( match[2] );

					// Check parentNode to catch when Blackberry 4.6 returns
					// nodes that are no longer in the document #6963
					if ( elem && elem.parentNode ) {
						// Handle the case where IE and Opera return items
						// by name instead of ID
						if ( elem.id !== match[2] ) {
							return rootjQuery.find( selector );
						}

						// Otherwise, we inject the element directly into the jQuery object
						this.length = 1;
						this[0] = elem;
					}

					this.context = document;
					this.selector = selector;
					return this;
				}

			// HANDLE: $(expr, $(...))
			} else if ( !context || context.jquery ) {
				return ( context || rootjQuery ).find( selector );

			// HANDLE: $(expr, context)
			// (which is just equivalent to: $(context).find(expr)
			} else {
				return this.constructor( context ).find( selector );
			}

		// HANDLE: $(function)
		// Shortcut for document ready
		} else if ( jQuery.isFunction( selector ) ) {
			return rootjQuery.ready( selector );
		}

		if ( selector.selector !== undefined ) {
			this.selector = selector.selector;
			this.context = selector.context;
		}

		return jQuery.makeArray( selector, this );
	},

	// Start with an empty selector
	selector: "",

	// The current version of jQuery being used
	jquery: "1.8.3",

	// The default length of a jQuery object is 0
	length: 0,

	// The number of elements contained in the matched element set
	size: function() {
		return this.length;
	},

	toArray: function() {
		return core_slice.call( this );
	},

	// Get the Nth element in the matched element set OR
	// Get the whole matched element set as a clean array
	get: function( num ) {
		return num == null ?

			// Return a 'clean' array
			this.toArray() :

			// Return just the object
			( num < 0 ? this[ this.length + num ] : this[ num ] );
	},

	// Take an array of elements and push it onto the stack
	// (returning the new matched element set)
	pushStack: function( elems, name, selector ) {

		// Build a new jQuery matched element set
		var ret = jQuery.merge( this.constructor(), elems );

		// Add the old object onto the stack (as a reference)
		ret.prevObject = this;

		ret.context = this.context;

		if ( name === "find" ) {
			ret.selector = this.selector + ( this.selector ? " " : "" ) + selector;
		} else if ( name ) {
			ret.selector = this.selector + "." + name + "(" + selector + ")";
		}

		// Return the newly-formed element set
		return ret;
	},

	// Execute a callback for every element in the matched set.
	// (You can seed the arguments with an array of args, but this is
	// only used internally.)
	each: function( callback, args ) {
		return jQuery.each( this, callback, args );
	},

	ready: function( fn ) {
		// Add the callback
		jQuery.ready.promise().done( fn );

		return this;
	},

	eq: function( i ) {
		i = +i;
		return i === -1 ?
			this.slice( i ) :
			this.slice( i, i + 1 );
	},

	first: function() {
		return this.eq( 0 );
	},

	last: function() {
		return this.eq( -1 );
	},

	slice: function() {
		return this.pushStack( core_slice.apply( this, arguments ),
			"slice", core_slice.call(arguments).join(",") );
	},

	map: function( callback ) {
		return this.pushStack( jQuery.map(this, function( elem, i ) {
			return callback.call( elem, i, elem );
		}));
	},

	end: function() {
		return this.prevObject || this.constructor(null);
	},

	// For internal use only.
	// Behaves like an Array's method, not like a jQuery method.
	push: core_push,
	sort: [].sort,
	splice: [].splice
};

// Give the init function the jQuery prototype for later instantiation
jQuery.fn.init.prototype = jQuery.fn;

jQuery.extend = jQuery.fn.extend = function() {
	var options, name, src, copy, copyIsArray, clone,
		target = arguments[0] || {},
		i = 1,
		length = arguments.length,
		deep = false;

	// Handle a deep copy situation
	if ( typeof target === "boolean" ) {
		deep = target;
		target = arguments[1] || {};
		// skip the boolean and the target
		i = 2;
	}

	// Handle case when target is a string or something (possible in deep copy)
	if ( typeof target !== "object" && !jQuery.isFunction(target) ) {
		target = {};
	}

	// extend jQuery itself if only one argument is passed
	if ( length === i ) {
		target = this;
		--i;
	}

	for ( ; i < length; i++ ) {
		// Only deal with non-null/undefined values
		if ( (options = arguments[ i ]) != null ) {
			// Extend the base object
			for ( name in options ) {
				src = target[ name ];
				copy = options[ name ];

				// Prevent never-ending loop
				if ( target === copy ) {
					continue;
				}

				// Recurse if we're merging plain objects or arrays
				if ( deep && copy && ( jQuery.isPlainObject(copy) || (copyIsArray = jQuery.isArray(copy)) ) ) {
					if ( copyIsArray ) {
						copyIsArray = false;
						clone = src && jQuery.isArray(src) ? src : [];

					} else {
						clone = src && jQuery.isPlainObject(src) ? src : {};
					}

					// Never move original objects, clone them
					target[ name ] = jQuery.extend( deep, clone, copy );

				// Don't bring in undefined values
				} else if ( copy !== undefined ) {
					target[ name ] = copy;
				}
			}
		}
	}

	// Return the modified object
	return target;
};

jQuery.extend({
	noConflict: function( deep ) {
		if ( window.$ === jQuery ) {
			window.$ = _$;
		}

		if ( deep && window.jQuery === jQuery ) {
			window.jQuery = _jQuery;
		}

		return jQuery;
	},

	// Is the DOM ready to be used? Set to true once it occurs.
	isReady: false,

	// A counter to track how many items to wait for before
	// the ready event fires. See #6781
	readyWait: 1,

	// Hold (or release) the ready event
	holdReady: function( hold ) {
		if ( hold ) {
			jQuery.readyWait++;
		} else {
			jQuery.ready( true );
		}
	},

	// Handle when the DOM is ready
	ready: function( wait ) {

		// Abort if there are pending holds or we're already ready
		if ( wait === true ? --jQuery.readyWait : jQuery.isReady ) {
			return;
		}

		// Make sure body exists, at least, in case IE gets a little overzealous (ticket #5443).
		if ( !document.body ) {
			return setTimeout( jQuery.ready, 1 );
		}

		// Remember that the DOM is ready
		jQuery.isReady = true;

		// If a normal DOM Ready event fired, decrement, and wait if need be
		if ( wait !== true && --jQuery.readyWait > 0 ) {
			return;
		}

		// If there are functions bound, to execute
		readyList.resolveWith( document, [ jQuery ] );

		// Trigger any bound ready events
		if ( jQuery.fn.trigger ) {
			jQuery( document ).trigger("ready").off("ready");
		}
	},

	// See test/unit/core.js for details concerning isFunction.
	// Since version 1.3, DOM methods and functions like alert
	// aren't supported. They return false on IE (#2968).
	isFunction: function( obj ) {
		return jQuery.type(obj) === "function";
	},

	isArray: Array.isArray || function( obj ) {
		return jQuery.type(obj) === "array";
	},

	isWindow: function( obj ) {
		return obj != null && obj == obj.window;
	},

	isNumeric: function( obj ) {
		return !isNaN( parseFloat(obj) ) && isFinite( obj );
	},

	type: function( obj ) {
		return obj == null ?
			String( obj ) :
			class2type[ core_toString.call(obj) ] || "object";
	},

	isPlainObject: function( obj ) {
		// Must be an Object.
		// Because of IE, we also have to check the presence of the constructor property.
		// Make sure that DOM nodes and window objects don't pass through, as well
		if ( !obj || jQuery.type(obj) !== "object" || obj.nodeType || jQuery.isWindow( obj ) ) {
			return false;
		}

		try {
			// Not own constructor property must be Object
			if ( obj.constructor &&
				!core_hasOwn.call(obj, "constructor") &&
				!core_hasOwn.call(obj.constructor.prototype, "isPrototypeOf") ) {
				return false;
			}
		} catch ( e ) {
			// IE8,9 Will throw exceptions on certain host objects #9897
			return false;
		}

		// Own properties are enumerated firstly, so to speed up,
		// if last one is own, then all properties are own.

		var key;
		for ( key in obj ) {}

		return key === undefined || core_hasOwn.call( obj, key );
	},

	isEmptyObject: function( obj ) {
		var name;
		for ( name in obj ) {
			return false;
		}
		return true;
	},

	error: function( msg ) {
		throw new Error( msg );
	},

	// data: string of html
	// context (optional): If specified, the fragment will be created in this context, defaults to document
	// scripts (optional): If true, will include scripts passed in the html string
	parseHTML: function( data, context, scripts ) {
		var parsed;
		if ( !data || typeof data !== "string" ) {
			return null;
		}
		if ( typeof context === "boolean" ) {
			scripts = context;
			context = 0;
		}
		context = context || document;

		// Single tag
		if ( (parsed = rsingleTag.exec( data )) ) {
			return [ context.createElement( parsed[1] ) ];
		}

		parsed = jQuery.buildFragment( [ data ], context, scripts ? null : [] );
		return jQuery.merge( [],
			(parsed.cacheable ? jQuery.clone( parsed.fragment ) : parsed.fragment).childNodes );
	},

	parseJSON: function( data ) {
		if ( !data || typeof data !== "string") {
			return null;
		}

		// Make sure leading/trailing whitespace is removed (IE can't handle it)
		data = jQuery.trim( data );

		// Attempt to parse using the native JSON parser first
		if ( window.JSON && window.JSON.parse ) {
			return window.JSON.parse( data );
		}

		// Make sure the incoming data is actual JSON
		// Logic borrowed from http://json.org/json2.js
		if ( rvalidchars.test( data.replace( rvalidescape, "@" )
			.replace( rvalidtokens, "]" )
			.replace( rvalidbraces, "")) ) {

			return ( new Function( "return " + data ) )();

		}
		jQuery.error( "Invalid JSON: " + data );
	},

	// Cross-browser xml parsing
	parseXML: function( data ) {
		var xml, tmp;
		if ( !data || typeof data !== "string" ) {
			return null;
		}
		try {
			if ( window.DOMParser ) { // Standard
				tmp = new DOMParser();
				xml = tmp.parseFromString( data , "text/xml" );
			} else { // IE
				xml = new ActiveXObject( "Microsoft.XMLDOM" );
				xml.async = "false";
				xml.loadXML( data );
			}
		} catch( e ) {
			xml = undefined;
		}
		if ( !xml || !xml.documentElement || xml.getElementsByTagName( "parsererror" ).length ) {
			jQuery.error( "Invalid XML: " + data );
		}
		return xml;
	},

	noop: function() {},

	// Evaluates a script in a global context
	// Workarounds based on findings by Jim Driscoll
	// http://weblogs.java.net/blog/driscoll/archive/2009/09/08/eval-javascript-global-context
	globalEval: function( data ) {
		if ( data && core_rnotwhite.test( data ) ) {
			// We use execScript on Internet Explorer
			// We use an anonymous function so that context is window
			// rather than jQuery in Firefox
			( window.execScript || function( data ) {
				window[ "eval" ].call( window, data );
			} )( data );
		}
	},

	// Convert dashed to camelCase; used by the css and data modules
	// Microsoft forgot to hump their vendor prefix (#9572)
	camelCase: function( string ) {
		return string.replace( rmsPrefix, "ms-" ).replace( rdashAlpha, fcamelCase );
	},

	nodeName: function( elem, name ) {
		return elem.nodeName && elem.nodeName.toLowerCase() === name.toLowerCase();
	},

	// args is for internal usage only
	each: function( obj, callback, args ) {
		var name,
			i = 0,
			length = obj.length,
			isObj = length === undefined || jQuery.isFunction( obj );

		if ( args ) {
			if ( isObj ) {
				for ( name in obj ) {
					if ( callback.apply( obj[ name ], args ) === false ) {
						break;
					}
				}
			} else {
				for ( ; i < length; ) {
					if ( callback.apply( obj[ i++ ], args ) === false ) {
						break;
					}
				}
			}

		// A special, fast, case for the most common use of each
		} else {
			if ( isObj ) {
				for ( name in obj ) {
					if ( callback.call( obj[ name ], name, obj[ name ] ) === false ) {
						break;
					}
				}
			} else {
				for ( ; i < length; ) {
					if ( callback.call( obj[ i ], i, obj[ i++ ] ) === false ) {
						break;
					}
				}
			}
		}

		return obj;
	},

	// Use native String.trim function wherever possible
	trim: core_trim && !core_trim.call("\uFEFF\xA0") ?
		function( text ) {
			return text == null ?
				"" :
				core_trim.call( text );
		} :

		// Otherwise use our own trimming functionality
		function( text ) {
			return text == null ?
				"" :
				( text + "" ).replace( rtrim, "" );
		},

	// results is for internal usage only
	makeArray: function( arr, results ) {
		var type,
			ret = results || [];

		if ( arr != null ) {
			// The window, strings (and functions) also have 'length'
			// Tweaked logic slightly to handle Blackberry 4.7 RegExp issues #6930
			type = jQuery.type( arr );

			if ( arr.length == null || type === "string" || type === "function" || type === "regexp" || jQuery.isWindow( arr ) ) {
				core_push.call( ret, arr );
			} else {
				jQuery.merge( ret, arr );
			}
		}

		return ret;
	},

	inArray: function( elem, arr, i ) {
		var len;

		if ( arr ) {
			if ( core_indexOf ) {
				return core_indexOf.call( arr, elem, i );
			}

			len = arr.length;
			i = i ? i < 0 ? Math.max( 0, len + i ) : i : 0;

			for ( ; i < len; i++ ) {
				// Skip accessing in sparse arrays
				if ( i in arr && arr[ i ] === elem ) {
					return i;
				}
			}
		}

		return -1;
	},

	merge: function( first, second ) {
		var l = second.length,
			i = first.length,
			j = 0;

		if ( typeof l === "number" ) {
			for ( ; j < l; j++ ) {
				first[ i++ ] = second[ j ];
			}

		} else {
			while ( second[j] !== undefined ) {
				first[ i++ ] = second[ j++ ];
			}
		}

		first.length = i;

		return first;
	},

	grep: function( elems, callback, inv ) {
		var retVal,
			ret = [],
			i = 0,
			length = elems.length;
		inv = !!inv;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( ; i < length; i++ ) {
			retVal = !!callback( elems[ i ], i );
			if ( inv !== retVal ) {
				ret.push( elems[ i ] );
			}
		}

		return ret;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var value, key,
			ret = [],
			i = 0,
			length = elems.length,
			// jquery objects are treated as arrays
			isArray = elems instanceof jQuery || length !== undefined && typeof length === "number" && ( ( length > 0 && elems[ 0 ] && elems[ length -1 ] ) || length === 0 || jQuery.isArray( elems ) ) ;

		// Go through the array, translating each of the items to their
		if ( isArray ) {
			for ( ; i < length; i++ ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret[ ret.length ] = value;
				}
			}

		// Go through every key on the object,
		} else {
			for ( key in elems ) {
				value = callback( elems[ key ], key, arg );

				if ( value != null ) {
					ret[ ret.length ] = value;
				}
			}
		}

		// Flatten any nested arrays
		return ret.concat.apply( [], ret );
	},

	// A global GUID counter for objects
	guid: 1,

	// Bind a function to a context, optionally partially applying any
	// arguments.
	proxy: function( fn, context ) {
		var tmp, args, proxy;

		if ( typeof context === "string" ) {
			tmp = fn[ context ];
			context = fn;
			fn = tmp;
		}

		// Quick check to determine if target is callable, in the spec
		// this throws a TypeError, but we will just return undefined.
		if ( !jQuery.isFunction( fn ) ) {
			return undefined;
		}

		// Simulated bind
		args = core_slice.call( arguments, 2 );
		proxy = function() {
			return fn.apply( context, args.concat( core_slice.call( arguments ) ) );
		};

		// Set the guid of unique handler to the same of original handler, so it can be removed
		proxy.guid = fn.guid = fn.guid || jQuery.guid++;

		return proxy;
	},

	// Multifunctional method to get and set values of a collection
	// The value/s can optionally be executed if it's a function
	access: function( elems, fn, key, value, chainable, emptyGet, pass ) {
		var exec,
			bulk = key == null,
			i = 0,
			length = elems.length;

		// Sets many values
		if ( key && typeof key === "object" ) {
			for ( i in key ) {
				jQuery.access( elems, fn, i, key[i], 1, emptyGet, value );
			}
			chainable = 1;

		// Sets one value
		} else if ( value !== undefined ) {
			// Optionally, function values get executed if exec is true
			exec = pass === undefined && jQuery.isFunction( value );

			if ( bulk ) {
				// Bulk operations only iterate when executing function values
				if ( exec ) {
					exec = fn;
					fn = function( elem, key, value ) {
						return exec.call( jQuery( elem ), value );
					};

				// Otherwise they run against the entire set
				} else {
					fn.call( elems, value );
					fn = null;
				}
			}

			if ( fn ) {
				for (; i < length; i++ ) {
					fn( elems[i], key, exec ? value.call( elems[i], i, fn( elems[i], key ) ) : value, pass );
				}
			}

			chainable = 1;
		}

		return chainable ?
			elems :

			// Gets
			bulk ?
				fn.call( elems ) :
				length ? fn( elems[0], key ) : emptyGet;
	},

	now: function() {
		return ( new Date() ).getTime();
	}
});

jQuery.ready.promise = function( obj ) {
	if ( !readyList ) {

		readyList = jQuery.Deferred();

		// Catch cases where $(document).ready() is called after the browser event has already occurred.
		// we once tried to use readyState "interactive" here, but it caused issues like the one
		// discovered by ChrisS here: http://bugs.jquery.com/ticket/12282#comment:15
		if ( document.readyState === "complete" ) {
			// Handle it asynchronously to allow scripts the opportunity to delay ready
			setTimeout( jQuery.ready, 1 );

		// Standards-based browsers support DOMContentLoaded
		} else if ( document.addEventListener ) {
			// Use the handy event callback
			document.addEventListener( "DOMContentLoaded", DOMContentLoaded, false );

			// A fallback to window.onload, that will always work
			window.addEventListener( "load", jQuery.ready, false );

		// If IE event model is used
		} else {
			// Ensure firing before onload, maybe late but safe also for iframes
			document.attachEvent( "onreadystatechange", DOMContentLoaded );

			// A fallback to window.onload, that will always work
			window.attachEvent( "onload", jQuery.ready );

			// If IE and not a frame
			// continually check to see if the document is ready
			var top = false;

			try {
				top = window.frameElement == null && document.documentElement;
			} catch(e) {}

			if ( top && top.doScroll ) {
				(function doScrollCheck() {
					if ( !jQuery.isReady ) {

						try {
							// Use the trick by Diego Perini
							// http://javascript.nwbox.com/IEContentLoaded/
							top.doScroll("left");
						} catch(e) {
							return setTimeout( doScrollCheck, 50 );
						}

						// and execute any waiting functions
						jQuery.ready();
					}
				})();
			}
		}
	}
	return readyList.promise( obj );
};

// Populate the class2type map
jQuery.each("Boolean Number String Function Array Date RegExp Object".split(" "), function(i, name) {
	class2type[ "[object " + name + "]" ] = name.toLowerCase();
});

// All jQuery objects should point back to these
rootjQuery = jQuery(document);
// String to Object options format cache
var optionsCache = {};

// Convert String-formatted options into Object-formatted ones and store in cache
function createOptions( options ) {
	var object = optionsCache[ options ] = {};
	jQuery.each( options.split( core_rspace ), function( _, flag ) {
		object[ flag ] = true;
	});
	return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *	options: an optional list of space-separated options that will change how
 *			the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *	once:			will ensure the callback list can only be fired once (like a Deferred)
 *
 *	memory:			will keep track of previous values and will call any callback added
 *					after the list has been fired right away with the latest "memorized"
 *					values (like a Deferred)
 *
 *	unique:			will ensure a callback can only be added once (no duplicate in the list)
 *
 *	stopOnFalse:	interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

	// Convert options from String-formatted to Object-formatted if needed
	// (we check in cache first)
	options = typeof options === "string" ?
		( optionsCache[ options ] || createOptions( options ) ) :
		jQuery.extend( {}, options );

	var // Last fire value (for non-forgettable lists)
		memory,
		// Flag to know if list was already fired
		fired,
		// Flag to know if list is currently firing
		firing,
		// First callback to fire (used internally by add and fireWith)
		firingStart,
		// End of the loop when firing
		firingLength,
		// Index of currently firing callback (modified by remove if needed)
		firingIndex,
		// Actual callback list
		list = [],
		// Stack of fire calls for repeatable lists
		stack = !options.once && [],
		// Fire callbacks
		fire = function( data ) {
			memory = options.memory && data;
			fired = true;
			firingIndex = firingStart || 0;
			firingStart = 0;
			firingLength = list.length;
			firing = true;
			for ( ; list && firingIndex < firingLength; firingIndex++ ) {
				if ( list[ firingIndex ].apply( data[ 0 ], data[ 1 ] ) === false && options.stopOnFalse ) {
					memory = false; // To prevent further calls using add
					break;
				}
			}
			firing = false;
			if ( list ) {
				if ( stack ) {
					if ( stack.length ) {
						fire( stack.shift() );
					}
				} else if ( memory ) {
					list = [];
				} else {
					self.disable();
				}
			}
		},
		// Actual Callbacks object
		self = {
			// Add a callback or a collection of callbacks to the list
			add: function() {
				if ( list ) {
					// First, we save the current length
					var start = list.length;
					(function add( args ) {
						jQuery.each( args, function( _, arg ) {
							var type = jQuery.type( arg );
							if ( type === "function" ) {
								if ( !options.unique || !self.has( arg ) ) {
									list.push( arg );
								}
							} else if ( arg && arg.length && type !== "string" ) {
								// Inspect recursively
								add( arg );
							}
						});
					})( arguments );
					// Do we need to add the callbacks to the
					// current firing batch?
					if ( firing ) {
						firingLength = list.length;
					// With memory, if we're not firing then
					// we should call right away
					} else if ( memory ) {
						firingStart = start;
						fire( memory );
					}
				}
				return this;
			},
			// Remove a callback from the list
			remove: function() {
				if ( list ) {
					jQuery.each( arguments, function( _, arg ) {
						var index;
						while( ( index = jQuery.inArray( arg, list, index ) ) > -1 ) {
							list.splice( index, 1 );
							// Handle firing indexes
							if ( firing ) {
								if ( index <= firingLength ) {
									firingLength--;
								}
								if ( index <= firingIndex ) {
									firingIndex--;
								}
							}
						}
					});
				}
				return this;
			},
			// Control if a given callback is in the list
			has: function( fn ) {
				return jQuery.inArray( fn, list ) > -1;
			},
			// Remove all callbacks from the list
			empty: function() {
				list = [];
				return this;
			},
			// Have the list do nothing anymore
			disable: function() {
				list = stack = memory = undefined;
				return this;
			},
			// Is it disabled?
			disabled: function() {
				return !list;
			},
			// Lock the list in its current state
			lock: function() {
				stack = undefined;
				if ( !memory ) {
					self.disable();
				}
				return this;
			},
			// Is it locked?
			locked: function() {
				return !stack;
			},
			// Call all callbacks with the given context and arguments
			fireWith: function( context, args ) {
				args = args || [];
				args = [ context, args.slice ? args.slice() : args ];
				if ( list && ( !fired || stack ) ) {
					if ( firing ) {
						stack.push( args );
					} else {
						fire( args );
					}
				}
				return this;
			},
			// Call all the callbacks with the given arguments
			fire: function() {
				self.fireWith( this, arguments );
				return this;
			},
			// To know if the callbacks have already been called at least once
			fired: function() {
				return !!fired;
			}
		};

	return self;
};
jQuery.extend({

	Deferred: function( func ) {
		var tuples = [
				// action, add listener, listener list, final state
				[ "resolve", "done", jQuery.Callbacks("once memory"), "resolved" ],
				[ "reject", "fail", jQuery.Callbacks("once memory"), "rejected" ],
				[ "notify", "progress", jQuery.Callbacks("memory") ]
			],
			state = "pending",
			promise = {
				state: function() {
					return state;
				},
				always: function() {
					deferred.done( arguments ).fail( arguments );
					return this;
				},
				then: function( /* fnDone, fnFail, fnProgress */ ) {
					var fns = arguments;
					return jQuery.Deferred(function( newDefer ) {
						jQuery.each( tuples, function( i, tuple ) {
							var action = tuple[ 0 ],
								fn = fns[ i ];
							// deferred[ done | fail | progress ] for forwarding actions to newDefer
							deferred[ tuple[1] ]( jQuery.isFunction( fn ) ?
								function() {
									var returned = fn.apply( this, arguments );
									if ( returned && jQuery.isFunction( returned.promise ) ) {
										returned.promise()
											.done( newDefer.resolve )
											.fail( newDefer.reject )
											.progress( newDefer.notify );
									} else {
										newDefer[ action + "With" ]( this === deferred ? newDefer : this, [ returned ] );
									}
								} :
								newDefer[ action ]
							);
						});
						fns = null;
					}).promise();
				},
				// Get a promise for this deferred
				// If obj is provided, the promise aspect is added to the object
				promise: function( obj ) {
					return obj != null ? jQuery.extend( obj, promise ) : promise;
				}
			},
			deferred = {};

		// Keep pipe for back-compat
		promise.pipe = promise.then;

		// Add list-specific methods
		jQuery.each( tuples, function( i, tuple ) {
			var list = tuple[ 2 ],
				stateString = tuple[ 3 ];

			// promise[ done | fail | progress ] = list.add
			promise[ tuple[1] ] = list.add;

			// Handle state
			if ( stateString ) {
				list.add(function() {
					// state = [ resolved | rejected ]
					state = stateString;

				// [ reject_list | resolve_list ].disable; progress_list.lock
				}, tuples[ i ^ 1 ][ 2 ].disable, tuples[ 2 ][ 2 ].lock );
			}

			// deferred[ resolve | reject | notify ] = list.fire
			deferred[ tuple[0] ] = list.fire;
			deferred[ tuple[0] + "With" ] = list.fireWith;
		});

		// Make the deferred a promise
		promise.promise( deferred );

		// Call given func if any
		if ( func ) {
			func.call( deferred, deferred );
		}

		// All done!
		return deferred;
	},

	// Deferred helper
	when: function( subordinate /* , ..., subordinateN */ ) {
		var i = 0,
			resolveValues = core_slice.call( arguments ),
			length = resolveValues.length,

			// the count of uncompleted subordinates
			remaining = length !== 1 || ( subordinate && jQuery.isFunction( subordinate.promise ) ) ? length : 0,

			// the master Deferred. If resolveValues consist of only a single Deferred, just use that.
			deferred = remaining === 1 ? subordinate : jQuery.Deferred(),

			// Update function for both resolve and progress values
			updateFunc = function( i, contexts, values ) {
				return function( value ) {
					contexts[ i ] = this;
					values[ i ] = arguments.length > 1 ? core_slice.call( arguments ) : value;
					if( values === progressValues ) {
						deferred.notifyWith( contexts, values );
					} else if ( !( --remaining ) ) {
						deferred.resolveWith( contexts, values );
					}
				};
			},

			progressValues, progressContexts, resolveContexts;

		// add listeners to Deferred subordinates; treat others as resolved
		if ( length > 1 ) {
			progressValues = new Array( length );
			progressContexts = new Array( length );
			resolveContexts = new Array( length );
			for ( ; i < length; i++ ) {
				if ( resolveValues[ i ] && jQuery.isFunction( resolveValues[ i ].promise ) ) {
					resolveValues[ i ].promise()
						.done( updateFunc( i, resolveContexts, resolveValues ) )
						.fail( deferred.reject )
						.progress( updateFunc( i, progressContexts, progressValues ) );
				} else {
					--remaining;
				}
			}
		}

		// if we're not waiting on anything, resolve the master
		if ( !remaining ) {
			deferred.resolveWith( resolveContexts, resolveValues );
		}

		return deferred.promise();
	}
});
jQuery.support = (function() {

	var support,
		all,
		a,
		select,
		opt,
		input,
		fragment,
		eventName,
		i,
		isSupported,
		clickFn,
		div = document.createElement("div");

	// Setup
	div.setAttribute( "className", "t" );
	div.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>";

	// Support tests won't run in some limited or non-browser environments
	all = div.getElementsByTagName("*");
	a = div.getElementsByTagName("a")[ 0 ];
	if ( !all || !a || !all.length ) {
		return {};
	}

	// First batch of tests
	select = document.createElement("select");
	opt = select.appendChild( document.createElement("option") );
	input = div.getElementsByTagName("input")[ 0 ];

	a.style.cssText = "top:1px;float:left;opacity:.5";
	support = {
		// IE strips leading whitespace when .innerHTML is used
		leadingWhitespace: ( div.firstChild.nodeType === 3 ),

		// Make sure that tbody elements aren't automatically inserted
		// IE will insert them into empty tables
		tbody: !div.getElementsByTagName("tbody").length,

		// Make sure that link elements get serialized correctly by innerHTML
		// This requires a wrapper element in IE
		htmlSerialize: !!div.getElementsByTagName("link").length,

		// Get the style information from getAttribute
		// (IE uses .cssText instead)
		style: /top/.test( a.getAttribute("style") ),

		// Make sure that URLs aren't manipulated
		// (IE normalizes it by default)
		hrefNormalized: ( a.getAttribute("href") === "/a" ),

		// Make sure that element opacity exists
		// (IE uses filter instead)
		// Use a regex to work around a WebKit issue. See #5145
		opacity: /^0.5/.test( a.style.opacity ),

		// Verify style float existence
		// (IE uses styleFloat instead of cssFloat)
		cssFloat: !!a.style.cssFloat,

		// Make sure that if no value is specified for a checkbox
		// that it defaults to "on".
		// (WebKit defaults to "" instead)
		checkOn: ( input.value === "on" ),

		// Make sure that a selected-by-default option has a working selected property.
		// (WebKit defaults to false instead of true, IE too, if it's in an optgroup)
		optSelected: opt.selected,

		// Test setAttribute on camelCase class. If it works, we need attrFixes when doing get/setAttribute (ie6/7)
		getSetAttribute: div.className !== "t",

		// Tests for enctype support on a form (#6743)
		enctype: !!document.createElement("form").enctype,

		// Makes sure cloning an html5 element does not cause problems
		// Where outerHTML is undefined, this still works
		html5Clone: document.createElement("nav").cloneNode( true ).outerHTML !== "<:nav></:nav>",

		// jQuery.support.boxModel DEPRECATED in 1.8 since we don't support Quirks Mode
		boxModel: ( document.compatMode === "CSS1Compat" ),

		// Will be defined later
		submitBubbles: true,
		changeBubbles: true,
		focusinBubbles: false,
		deleteExpando: true,
		noCloneEvent: true,
		inlineBlockNeedsLayout: false,
		shrinkWrapBlocks: false,
		reliableMarginRight: true,
		boxSizingReliable: true,
		pixelPosition: false
	};

	// Make sure checked status is properly cloned
	input.checked = true;
	support.noCloneChecked = input.cloneNode( true ).checked;

	// Make sure that the options inside disabled selects aren't marked as disabled
	// (WebKit marks them as disabled)
	select.disabled = true;
	support.optDisabled = !opt.disabled;

	// Test to see if it's possible to delete an expando from an element
	// Fails in Internet Explorer
	try {
		delete div.test;
	} catch( e ) {
		support.deleteExpando = false;
	}

	if ( !div.addEventListener && div.attachEvent && div.fireEvent ) {
		div.attachEvent( "onclick", clickFn = function() {
			// Cloning a node shouldn't copy over any
			// bound event handlers (IE does this)
			support.noCloneEvent = false;
		});
		div.cloneNode( true ).fireEvent("onclick");
		div.detachEvent( "onclick", clickFn );
	}

	// Check if a radio maintains its value
	// after being appended to the DOM
	input = document.createElement("input");
	input.value = "t";
	input.setAttribute( "type", "radio" );
	support.radioValue = input.value === "t";

	input.setAttribute( "checked", "checked" );

	// #11217 - WebKit loses check when the name is after the checked attribute
	input.setAttribute( "name", "t" );

	div.appendChild( input );
	fragment = document.createDocumentFragment();
	fragment.appendChild( div.lastChild );

	// WebKit doesn't clone checked state correctly in fragments
	support.checkClone = fragment.cloneNode( true ).cloneNode( true ).lastChild.checked;

	// Check if a disconnected checkbox will retain its checked
	// value of true after appended to the DOM (IE6/7)
	support.appendChecked = input.checked;

	fragment.removeChild( input );
	fragment.appendChild( div );

	// Technique from Juriy Zaytsev
	// http://perfectionkills.com/detecting-event-support-without-browser-sniffing/
	// We only care about the case where non-standard event systems
	// are used, namely in IE. Short-circuiting here helps us to
	// avoid an eval call (in setAttribute) which can cause CSP
	// to go haywire. See: https://developer.mozilla.org/en/Security/CSP
	if ( div.attachEvent ) {
		for ( i in {
			submit: true,
			change: true,
			focusin: true
		}) {
			eventName = "on" + i;
			isSupported = ( eventName in div );
			if ( !isSupported ) {
				div.setAttribute( eventName, "return;" );
				isSupported = ( typeof div[ eventName ] === "function" );
			}
			support[ i + "Bubbles" ] = isSupported;
		}
	}

	// Run tests that need a body at doc ready
	jQuery(function() {
		var container, div, tds, marginDiv,
			divReset = "padding:0;margin:0;border:0;display:block;overflow:hidden;",
			body = document.getElementsByTagName("body")[0];

		if ( !body ) {
			// Return for frameset docs that don't have a body
			return;
		}

		container = document.createElement("div");
		container.style.cssText = "visibility:hidden;border:0;width:0;height:0;position:static;top:0;margin-top:1px";
		body.insertBefore( container, body.firstChild );

		// Construct the test element
		div = document.createElement("div");
		container.appendChild( div );

		// Check if table cells still have offsetWidth/Height when they are set
		// to display:none and there are still other visible table cells in a
		// table row; if so, offsetWidth/Height are not reliable for use when
		// determining if an element has been hidden directly using
		// display:none (it is still safe to use offsets if a parent element is
		// hidden; don safety goggles and see bug #4512 for more information).
		// (only IE 8 fails this test)
		div.innerHTML = "<table><tr><td></td><td>t</td></tr></table>";
		tds = div.getElementsByTagName("td");
		tds[ 0 ].style.cssText = "padding:0;margin:0;border:0;display:none";
		isSupported = ( tds[ 0 ].offsetHeight === 0 );

		tds[ 0 ].style.display = "";
		tds[ 1 ].style.display = "none";

		// Check if empty table cells still have offsetWidth/Height
		// (IE <= 8 fail this test)
		support.reliableHiddenOffsets = isSupported && ( tds[ 0 ].offsetHeight === 0 );

		// Check box-sizing and margin behavior
		div.innerHTML = "";
		div.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;";
		support.boxSizing = ( div.offsetWidth === 4 );
		support.doesNotIncludeMarginInBodyOffset = ( body.offsetTop !== 1 );

		// NOTE: To any future maintainer, we've window.getComputedStyle
		// because jsdom on node.js will break without it.
		if ( window.getComputedStyle ) {
			support.pixelPosition = ( window.getComputedStyle( div, null ) || {} ).top !== "1%";
			support.boxSizingReliable = ( window.getComputedStyle( div, null ) || { width: "4px" } ).width === "4px";

			// Check if div with explicit width and no margin-right incorrectly
			// gets computed margin-right based on width of container. For more
			// info see bug #3333
			// Fails in WebKit before Feb 2011 nightlies
			// WebKit Bug 13343 - getComputedStyle returns wrong value for margin-right
			marginDiv = document.createElement("div");
			marginDiv.style.cssText = div.style.cssText = divReset;
			marginDiv.style.marginRight = marginDiv.style.width = "0";
			div.style.width = "1px";
			div.appendChild( marginDiv );
			support.reliableMarginRight =
				!parseFloat( ( window.getComputedStyle( marginDiv, null ) || {} ).marginRight );
		}

		if ( typeof div.style.zoom !== "undefined" ) {
			// Check if natively block-level elements act like inline-block
			// elements when setting their display to 'inline' and giving
			// them layout
			// (IE < 8 does this)
			div.innerHTML = "";
			div.style.cssText = divReset + "width:1px;padding:1px;display:inline;zoom:1";
			support.inlineBlockNeedsLayout = ( div.offsetWidth === 3 );

			// Check if elements with layout shrink-wrap their children
			// (IE 6 does this)
			div.style.display = "block";
			div.style.overflow = "visible";
			div.innerHTML = "<div></div>";
			div.firstChild.style.width = "5px";
			support.shrinkWrapBlocks = ( div.offsetWidth !== 3 );

			container.style.zoom = 1;
		}

		// Null elements to avoid leaks in IE
		body.removeChild( container );
		container = div = tds = marginDiv = null;
	});

	// Null elements to avoid leaks in IE
	fragment.removeChild( div );
	all = a = select = opt = input = fragment = div = null;

	return support;
})();
var rbrace = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
	rmultiDash = /([A-Z])/g;

jQuery.extend({
	cache: {},

	deletedIds: [],

	// Remove at next major release (1.9/2.0)
	uuid: 0,

	// Unique for each copy of jQuery on the page
	// Non-digits removed to match rinlinejQuery
	expando: "jQuery" + ( jQuery.fn.jquery + Math.random() ).replace( /\D/g, "" ),

	// The following elements throw uncatchable exceptions if you
	// attempt to add expando properties to them.
	noData: {
		"embed": true,
		// Ban all objects except for Flash (which handle expandos)
		"object": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
		"applet": true
	},

	hasData: function( elem ) {
		elem = elem.nodeType ? jQuery.cache[ elem[jQuery.expando] ] : elem[ jQuery.expando ];
		return !!elem && !isEmptyDataObject( elem );
	},

	data: function( elem, name, data, pvt /* Internal Use Only */ ) {
		if ( !jQuery.acceptData( elem ) ) {
			return;
		}

		var thisCache, ret,
			internalKey = jQuery.expando,
			getByName = typeof name === "string",

			// We have to handle DOM nodes and JS objects differently because IE6-7
			// can't GC object references properly across the DOM-JS boundary
			isNode = elem.nodeType,

			// Only DOM nodes need the global jQuery cache; JS object data is
			// attached directly to the object so GC can occur automatically
			cache = isNode ? jQuery.cache : elem,

			// Only defining an ID for JS objects if its cache already exists allows
			// the code to shortcut on the same path as a DOM node with no cache
			id = isNode ? elem[ internalKey ] : elem[ internalKey ] && internalKey;

		// Avoid doing any more work than we need to when trying to get data on an
		// object that has no data at all
		if ( (!id || !cache[id] || (!pvt && !cache[id].data)) && getByName && data === undefined ) {
			return;
		}

		if ( !id ) {
			// Only DOM nodes need a new unique ID for each element since their data
			// ends up in the global cache
			if ( isNode ) {
				elem[ internalKey ] = id = jQuery.deletedIds.pop() || jQuery.guid++;
			} else {
				id = internalKey;
			}
		}

		if ( !cache[ id ] ) {
			cache[ id ] = {};

			// Avoids exposing jQuery metadata on plain JS objects when the object
			// is serialized using JSON.stringify
			if ( !isNode ) {
				cache[ id ].toJSON = jQuery.noop;
			}
		}

		// An object can be passed to jQuery.data instead of a key/value pair; this gets
		// shallow copied over onto the existing cache
		if ( typeof name === "object" || typeof name === "function" ) {
			if ( pvt ) {
				cache[ id ] = jQuery.extend( cache[ id ], name );
			} else {
				cache[ id ].data = jQuery.extend( cache[ id ].data, name );
			}
		}

		thisCache = cache[ id ];

		// jQuery data() is stored in a separate object inside the object's internal data
		// cache in order to avoid key collisions between internal data and user-defined
		// data.
		if ( !pvt ) {
			if ( !thisCache.data ) {
				thisCache.data = {};
			}

			thisCache = thisCache.data;
		}

		if ( data !== undefined ) {
			thisCache[ jQuery.camelCase( name ) ] = data;
		}

		// Check for both converted-to-camel and non-converted data property names
		// If a data property was specified
		if ( getByName ) {

			// First Try to find as-is property data
			ret = thisCache[ name ];

			// Test for null|undefined property data
			if ( ret == null ) {

				// Try to find the camelCased property
				ret = thisCache[ jQuery.camelCase( name ) ];
			}
		} else {
			ret = thisCache;
		}

		return ret;
	},

	removeData: function( elem, name, pvt /* Internal Use Only */ ) {
		if ( !jQuery.acceptData( elem ) ) {
			return;
		}

		var thisCache, i, l,

			isNode = elem.nodeType,

			// See jQuery.data for more information
			cache = isNode ? jQuery.cache : elem,
			id = isNode ? elem[ jQuery.expando ] : jQuery.expando;

		// If there is already no cache entry for this object, there is no
		// purpose in continuing
		if ( !cache[ id ] ) {
			return;
		}

		if ( name ) {

			thisCache = pvt ? cache[ id ] : cache[ id ].data;

			if ( thisCache ) {

				// Support array or space separated string names for data keys
				if ( !jQuery.isArray( name ) ) {

					// try the string as a key before any manipulation
					if ( name in thisCache ) {
						name = [ name ];
					} else {

						// split the camel cased version by spaces unless a key with the spaces exists
						name = jQuery.camelCase( name );
						if ( name in thisCache ) {
							name = [ name ];
						} else {
							name = name.split(" ");
						}
					}
				}

				for ( i = 0, l = name.length; i < l; i++ ) {
					delete thisCache[ name[i] ];
				}

				// If there is no data left in the cache, we want to continue
				// and let the cache object itself get destroyed
				if ( !( pvt ? isEmptyDataObject : jQuery.isEmptyObject )( thisCache ) ) {
					return;
				}
			}
		}

		// See jQuery.data for more information
		if ( !pvt ) {
			delete cache[ id ].data;

			// Don't destroy the parent cache unless the internal data object
			// had been the only thing left in it
			if ( !isEmptyDataObject( cache[ id ] ) ) {
				return;
			}
		}

		// Destroy the cache
		if ( isNode ) {
			jQuery.cleanData( [ elem ], true );

		// Use delete when supported for expandos or `cache` is not a window per isWindow (#10080)
		} else if ( jQuery.support.deleteExpando || cache != cache.window ) {
			delete cache[ id ];

		// When all else fails, null
		} else {
			cache[ id ] = null;
		}
	},

	// For internal use only.
	_data: function( elem, name, data ) {
		return jQuery.data( elem, name, data, true );
	},

	// A method for determining if a DOM node can handle the data expando
	acceptData: function( elem ) {
		var noData = elem.nodeName && jQuery.noData[ elem.nodeName.toLowerCase() ];

		// nodes accept data unless otherwise specified; rejection can be conditional
		return !noData || noData !== true && elem.getAttribute("classid") === noData;
	}
});

jQuery.fn.extend({
	data: function( key, value ) {
		var parts, part, attr, name, l,
			elem = this[0],
			i = 0,
			data = null;

		// Gets all values
		if ( key === undefined ) {
			if ( this.length ) {
				data = jQuery.data( elem );

				if ( elem.nodeType === 1 && !jQuery._data( elem, "parsedAttrs" ) ) {
					attr = elem.attributes;
					for ( l = attr.length; i < l; i++ ) {
						name = attr[i].name;

						if ( !name.indexOf( "data-" ) ) {
							name = jQuery.camelCase( name.substring(5) );

							dataAttr( elem, name, data[ name ] );
						}
					}
					jQuery._data( elem, "parsedAttrs", true );
				}
			}

			return data;
		}

		// Sets multiple values
		if ( typeof key === "object" ) {
			return this.each(function() {
				jQuery.data( this, key );
			});
		}

		parts = key.split( ".", 2 );
		parts[1] = parts[1] ? "." + parts[1] : "";
		part = parts[1] + "!";

		return jQuery.access( this, function( value ) {

			if ( value === undefined ) {
				data = this.triggerHandler( "getData" + part, [ parts[0] ] );

				// Try to fetch any internally stored data first
				if ( data === undefined && elem ) {
					data = jQuery.data( elem, key );
					data = dataAttr( elem, key, data );
				}

				return data === undefined && parts[1] ?
					this.data( parts[0] ) :
					data;
			}

			parts[1] = value;
			this.each(function() {
				var self = jQuery( this );

				self.triggerHandler( "setData" + part, parts );
				jQuery.data( this, key, value );
				self.triggerHandler( "changeData" + part, parts );
			});
		}, null, value, arguments.length > 1, null, false );
	},

	removeData: function( key ) {
		return this.each(function() {
			jQuery.removeData( this, key );
		});
	}
});

function dataAttr( elem, key, data ) {
	// If nothing was found internally, try to fetch any
	// data from the HTML5 data-* attribute
	if ( data === undefined && elem.nodeType === 1 ) {

		var name = "data-" + key.replace( rmultiDash, "-$1" ).toLowerCase();

		data = elem.getAttribute( name );

		if ( typeof data === "string" ) {
			try {
				data = data === "true" ? true :
				data === "false" ? false :
				data === "null" ? null :
				// Only convert to a number if it doesn't change the string
				+data + "" === data ? +data :
				rbrace.test( data ) ? jQuery.parseJSON( data ) :
					data;
			} catch( e ) {}

			// Make sure we set the data so it isn't changed later
			jQuery.data( elem, key, data );

		} else {
			data = undefined;
		}
	}

	return data;
}

// checks a cache object for emptiness
function isEmptyDataObject( obj ) {
	var name;
	for ( name in obj ) {

		// if the public data object is empty, the private is still empty
		if ( name === "data" && jQuery.isEmptyObject( obj[name] ) ) {
			continue;
		}
		if ( name !== "toJSON" ) {
			return false;
		}
	}

	return true;
}
jQuery.extend({
	queue: function( elem, type, data ) {
		var queue;

		if ( elem ) {
			type = ( type || "fx" ) + "queue";
			queue = jQuery._data( elem, type );

			// Speed up dequeue by getting out quickly if this is just a lookup
			if ( data ) {
				if ( !queue || jQuery.isArray(data) ) {
					queue = jQuery._data( elem, type, jQuery.makeArray(data) );
				} else {
					queue.push( data );
				}
			}
			return queue || [];
		}
	},

	dequeue: function( elem, type ) {
		type = type || "fx";

		var queue = jQuery.queue( elem, type ),
			startLength = queue.length,
			fn = queue.shift(),
			hooks = jQuery._queueHooks( elem, type ),
			next = function() {
				jQuery.dequeue( elem, type );
			};

		// If the fx queue is dequeued, always remove the progress sentinel
		if ( fn === "inprogress" ) {
			fn = queue.shift();
			startLength--;
		}

		if ( fn ) {

			// Add a progress sentinel to prevent the fx queue from being
			// automatically dequeued
			if ( type === "fx" ) {
				queue.unshift( "inprogress" );
			}

			// clear up the last queue stop function
			delete hooks.stop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength && hooks ) {
			hooks.empty.fire();
		}
	},

	// not intended for public consumption - generates a queueHooks object, or returns the current one
	_queueHooks: function( elem, type ) {
		var key = type + "queueHooks";
		return jQuery._data( elem, key ) || jQuery._data( elem, key, {
			empty: jQuery.Callbacks("once memory").add(function() {
				jQuery.removeData( elem, type + "queue", true );
				jQuery.removeData( elem, key, true );
			})
		});
	}
});

jQuery.fn.extend({
	queue: function( type, data ) {
		var setter = 2;

		if ( typeof type !== "string" ) {
			data = type;
			type = "fx";
			setter--;
		}

		if ( arguments.length < setter ) {
			return jQuery.queue( this[0], type );
		}

		return data === undefined ?
			this :
			this.each(function() {
				var queue = jQuery.queue( this, type, data );

				// ensure a hooks for this queue
				jQuery._queueHooks( this, type );

				if ( type === "fx" && queue[0] !== "inprogress" ) {
					jQuery.dequeue( this, type );
				}
			});
	},
	dequeue: function( type ) {
		return this.each(function() {
			jQuery.dequeue( this, type );
		});
	},
	// Based off of the plugin by Clint Helfers, with permission.
	// http://blindsignals.com/index.php/2009/07/jquery-delay/
	delay: function( time, type ) {
		time = jQuery.fx ? jQuery.fx.speeds[ time ] || time : time;
		type = type || "fx";

		return this.queue( type, function( next, hooks ) {
			var timeout = setTimeout( next, time );
			hooks.stop = function() {
				clearTimeout( timeout );
			};
		});
	},
	clearQueue: function( type ) {
		return this.queue( type || "fx", [] );
	},
	// Get a promise resolved when queues of a certain type
	// are emptied (fx is the type by default)
	promise: function( type, obj ) {
		var tmp,
			count = 1,
			defer = jQuery.Deferred(),
			elements = this,
			i = this.length,
			resolve = function() {
				if ( !( --count ) ) {
					defer.resolveWith( elements, [ elements ] );
				}
			};

		if ( typeof type !== "string" ) {
			obj = type;
			type = undefined;
		}
		type = type || "fx";

		while( i-- ) {
			tmp = jQuery._data( elements[ i ], type + "queueHooks" );
			if ( tmp && tmp.empty ) {
				count++;
				tmp.empty.add( resolve );
			}
		}
		resolve();
		return defer.promise( obj );
	}
});
var nodeHook, boolHook, fixSpecified,
	rclass = /[\t\r\n]/g,
	rreturn = /\r/g,
	rtype = /^(?:button|input)$/i,
	rfocusable = /^(?:button|input|object|select|textarea)$/i,
	rclickable = /^a(?:rea|)$/i,
	rboolean = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
	getSetAttribute = jQuery.support.getSetAttribute;

jQuery.fn.extend({
	attr: function( name, value ) {
		return jQuery.access( this, jQuery.attr, name, value, arguments.length > 1 );
	},

	removeAttr: function( name ) {
		return this.each(function() {
			jQuery.removeAttr( this, name );
		});
	},

	prop: function( name, value ) {
		return jQuery.access( this, jQuery.prop, name, value, arguments.length > 1 );
	},

	removeProp: function( name ) {
		name = jQuery.propFix[ name ] || name;
		return this.each(function() {
			// try/catch handles cases where IE balks (such as removing a property on window)
			try {
				this[ name ] = undefined;
				delete this[ name ];
			} catch( e ) {}
		});
	},

	addClass: function( value ) {
		var classNames, i, l, elem,
			setClass, c, cl;

		if ( jQuery.isFunction( value ) ) {
			return this.each(function( j ) {
				jQuery( this ).addClass( value.call(this, j, this.className) );
			});
		}

		if ( value && typeof value === "string" ) {
			classNames = value.split( core_rspace );

			for ( i = 0, l = this.length; i < l; i++ ) {
				elem = this[ i ];

				if ( elem.nodeType === 1 ) {
					if ( !elem.className && classNames.length === 1 ) {
						elem.className = value;

					} else {
						setClass = " " + elem.className + " ";

						for ( c = 0, cl = classNames.length; c < cl; c++ ) {
							if ( setClass.indexOf( " " + classNames[ c ] + " " ) < 0 ) {
								setClass += classNames[ c ] + " ";
							}
						}
						elem.className = jQuery.trim( setClass );
					}
				}
			}
		}

		return this;
	},

	removeClass: function( value ) {
		var removes, className, elem, c, cl, i, l;

		if ( jQuery.isFunction( value ) ) {
			return this.each(function( j ) {
				jQuery( this ).removeClass( value.call(this, j, this.className) );
			});
		}
		if ( (value && typeof value === "string") || value === undefined ) {
			removes = ( value || "" ).split( core_rspace );

			for ( i = 0, l = this.length; i < l; i++ ) {
				elem = this[ i ];
				if ( elem.nodeType === 1 && elem.className ) {

					className = (" " + elem.className + " ").replace( rclass, " " );

					// loop over each item in the removal list
					for ( c = 0, cl = removes.length; c < cl; c++ ) {
						// Remove until there is nothing to remove,
						while ( className.indexOf(" " + removes[ c ] + " ") >= 0 ) {
							className = className.replace( " " + removes[ c ] + " " , " " );
						}
					}
					elem.className = value ? jQuery.trim( className ) : "";
				}
			}
		}

		return this;
	},

	toggleClass: function( value, stateVal ) {
		var type = typeof value,
			isBool = typeof stateVal === "boolean";

		if ( jQuery.isFunction( value ) ) {
			return this.each(function( i ) {
				jQuery( this ).toggleClass( value.call(this, i, this.className, stateVal), stateVal );
			});
		}

		return this.each(function() {
			if ( type === "string" ) {
				// toggle individual class names
				var className,
					i = 0,
					self = jQuery( this ),
					state = stateVal,
					classNames = value.split( core_rspace );

				while ( (className = classNames[ i++ ]) ) {
					// check each className given, space separated list
					state = isBool ? state : !self.hasClass( className );
					self[ state ? "addClass" : "removeClass" ]( className );
				}

			} else if ( type === "undefined" || type === "boolean" ) {
				if ( this.className ) {
					// store className if set
					jQuery._data( this, "__className__", this.className );
				}

				// toggle whole className
				this.className = this.className || value === false ? "" : jQuery._data( this, "__className__" ) || "";
			}
		});
	},

	hasClass: function( selector ) {
		var className = " " + selector + " ",
			i = 0,
			l = this.length;
		for ( ; i < l; i++ ) {
			if ( this[i].nodeType === 1 && (" " + this[i].className + " ").replace(rclass, " ").indexOf( className ) >= 0 ) {
				return true;
			}
		}

		return false;
	},

	val: function( value ) {
		var hooks, ret, isFunction,
			elem = this[0];

		if ( !arguments.length ) {
			if ( elem ) {
				hooks = jQuery.valHooks[ elem.type ] || jQuery.valHooks[ elem.nodeName.toLowerCase() ];

				if ( hooks && "get" in hooks && (ret = hooks.get( elem, "value" )) !== undefined ) {
					return ret;
				}

				ret = elem.value;

				return typeof ret === "string" ?
					// handle most common string cases
					ret.replace(rreturn, "") :
					// handle cases where value is null/undef or number
					ret == null ? "" : ret;
			}

			return;
		}

		isFunction = jQuery.isFunction( value );

		return this.each(function( i ) {
			var val,
				self = jQuery(this);

			if ( this.nodeType !== 1 ) {
				return;
			}

			if ( isFunction ) {
				val = value.call( this, i, self.val() );
			} else {
				val = value;
			}

			// Treat null/undefined as ""; convert numbers to string
			if ( val == null ) {
				val = "";
			} else if ( typeof val === "number" ) {
				val += "";
			} else if ( jQuery.isArray( val ) ) {
				val = jQuery.map(val, function ( value ) {
					return value == null ? "" : value + "";
				});
			}

			hooks = jQuery.valHooks[ this.type ] || jQuery.valHooks[ this.nodeName.toLowerCase() ];

			// If set returns undefined, fall back to normal setting
			if ( !hooks || !("set" in hooks) || hooks.set( this, val, "value" ) === undefined ) {
				this.value = val;
			}
		});
	}
});

jQuery.extend({
	valHooks: {
		option: {
			get: function( elem ) {
				// attributes.value is undefined in Blackberry 4.7 but
				// uses .value. See #6932
				var val = elem.attributes.value;
				return !val || val.specified ? elem.value : elem.text;
			}
		},
		select: {
			get: function( elem ) {
				var value, option,
					options = elem.options,
					index = elem.selectedIndex,
					one = elem.type === "select-one" || index < 0,
					values = one ? null : [],
					max = one ? index + 1 : options.length,
					i = index < 0 ?
						max :
						one ? index : 0;

				// Loop through all the selected options
				for ( ; i < max; i++ ) {
					option = options[ i ];

					// oldIE doesn't update selected after form reset (#2551)
					if ( ( option.selected || i === index ) &&
							// Don't return options that are disabled or in a disabled optgroup
							( jQuery.support.optDisabled ? !option.disabled : option.getAttribute("disabled") === null ) &&
							( !option.parentNode.disabled || !jQuery.nodeName( option.parentNode, "optgroup" ) ) ) {

						// Get the specific value for the option
						value = jQuery( option ).val();

						// We don't need an array for one selects
						if ( one ) {
							return value;
						}

						// Multi-Selects return an array
						values.push( value );
					}
				}

				return values;
			},

			set: function( elem, value ) {
				var values = jQuery.makeArray( value );

				jQuery(elem).find("option").each(function() {
					this.selected = jQuery.inArray( jQuery(this).val(), values ) >= 0;
				});

				if ( !values.length ) {
					elem.selectedIndex = -1;
				}
				return values;
			}
		}
	},

	// Unused in 1.8, left in so attrFn-stabbers won't die; remove in 1.9
	attrFn: {},

	attr: function( elem, name, value, pass ) {
		var ret, hooks, notxml,
			nType = elem.nodeType;

		// don't get/set attributes on text, comment and attribute nodes
		if ( !elem || nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		if ( pass && jQuery.isFunction( jQuery.fn[ name ] ) ) {
			return jQuery( elem )[ name ]( value );
		}

		// Fallback to prop when attributes are not supported
		if ( typeof elem.getAttribute === "undefined" ) {
			return jQuery.prop( elem, name, value );
		}

		notxml = nType !== 1 || !jQuery.isXMLDoc( elem );

		// All attributes are lowercase
		// Grab necessary hook if one is defined
		if ( notxml ) {
			name = name.toLowerCase();
			hooks = jQuery.attrHooks[ name ] || ( rboolean.test( name ) ? boolHook : nodeHook );
		}

		if ( value !== undefined ) {

			if ( value === null ) {
				jQuery.removeAttr( elem, name );
				return;

			} else if ( hooks && "set" in hooks && notxml && (ret = hooks.set( elem, value, name )) !== undefined ) {
				return ret;

			} else {
				elem.setAttribute( name, value + "" );
				return value;
			}

		} else if ( hooks && "get" in hooks && notxml && (ret = hooks.get( elem, name )) !== null ) {
			return ret;

		} else {

			ret = elem.getAttribute( name );

			// Non-existent attributes return null, we normalize to undefined
			return ret === null ?
				undefined :
				ret;
		}
	},

	removeAttr: function( elem, value ) {
		var propName, attrNames, name, isBool,
			i = 0;

		if ( value && elem.nodeType === 1 ) {

			attrNames = value.split( core_rspace );

			for ( ; i < attrNames.length; i++ ) {
				name = attrNames[ i ];

				if ( name ) {
					propName = jQuery.propFix[ name ] || name;
					isBool = rboolean.test( name );

					// See #9699 for explanation of this approach (setting first, then removal)
					// Do not do this for boolean attributes (see #10870)
					if ( !isBool ) {
						jQuery.attr( elem, name, "" );
					}
					elem.removeAttribute( getSetAttribute ? name : propName );

					// Set corresponding property to false for boolean attributes
					if ( isBool && propName in elem ) {
						elem[ propName ] = false;
					}
				}
			}
		}
	},

	attrHooks: {
		type: {
			set: function( elem, value ) {
				// We can't allow the type property to be changed (since it causes problems in IE)
				if ( rtype.test( elem.nodeName ) && elem.parentNode ) {
					jQuery.error( "type property can't be changed" );
				} else if ( !jQuery.support.radioValue && value === "radio" && jQuery.nodeName(elem, "input") ) {
					// Setting the type on a radio button after the value resets the value in IE6-9
					// Reset value to it's default in case type is set after value
					// This is for element creation
					var val = elem.value;
					elem.setAttribute( "type", value );
					if ( val ) {
						elem.value = val;
					}
					return value;
				}
			}
		},
		// Use the value property for back compat
		// Use the nodeHook for button elements in IE6/7 (#1954)
		value: {
			get: function( elem, name ) {
				if ( nodeHook && jQuery.nodeName( elem, "button" ) ) {
					return nodeHook.get( elem, name );
				}
				return name in elem ?
					elem.value :
					null;
			},
			set: function( elem, value, name ) {
				if ( nodeHook && jQuery.nodeName( elem, "button" ) ) {
					return nodeHook.set( elem, value, name );
				}
				// Does not return so that setAttribute is also used
				elem.value = value;
			}
		}
	},

	propFix: {
		tabindex: "tabIndex",
		readonly: "readOnly",
		"for": "htmlFor",
		"class": "className",
		maxlength: "maxLength",
		cellspacing: "cellSpacing",
		cellpadding: "cellPadding",
		rowspan: "rowSpan",
		colspan: "colSpan",
		usemap: "useMap",
		frameborder: "frameBorder",
		contenteditable: "contentEditable"
	},

	prop: function( elem, name, value ) {
		var ret, hooks, notxml,
			nType = elem.nodeType;

		// don't get/set properties on text, comment and attribute nodes
		if ( !elem || nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		notxml = nType !== 1 || !jQuery.isXMLDoc( elem );

		if ( notxml ) {
			// Fix name and attach hooks
			name = jQuery.propFix[ name ] || name;
			hooks = jQuery.propHooks[ name ];
		}

		if ( value !== undefined ) {
			if ( hooks && "set" in hooks && (ret = hooks.set( elem, value, name )) !== undefined ) {
				return ret;

			} else {
				return ( elem[ name ] = value );
			}

		} else {
			if ( hooks && "get" in hooks && (ret = hooks.get( elem, name )) !== null ) {
				return ret;

			} else {
				return elem[ name ];
			}
		}
	},

	propHooks: {
		tabIndex: {
			get: function( elem ) {
				// elem.tabIndex doesn't always return the correct value when it hasn't been explicitly set
				// http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
				var attributeNode = elem.getAttributeNode("tabindex");

				return attributeNode && attributeNode.specified ?
					parseInt( attributeNode.value, 10 ) :
					rfocusable.test( elem.nodeName ) || rclickable.test( elem.nodeName ) && elem.href ?
						0 :
						undefined;
			}
		}
	}
});

// Hook for boolean attributes
boolHook = {
	get: function( elem, name ) {
		// Align boolean attributes with corresponding properties
		// Fall back to attribute presence where some booleans are not supported
		var attrNode,
			property = jQuery.prop( elem, name );
		return property === true || typeof property !== "boolean" && ( attrNode = elem.getAttributeNode(name) ) && attrNode.nodeValue !== false ?
			name.toLowerCase() :
			undefined;
	},
	set: function( elem, value, name ) {
		var propName;
		if ( value === false ) {
			// Remove boolean attributes when set to false
			jQuery.removeAttr( elem, name );
		} else {
			// value is true since we know at this point it's type boolean and not false
			// Set boolean attributes to the same name and set the DOM property
			propName = jQuery.propFix[ name ] || name;
			if ( propName in elem ) {
				// Only set the IDL specifically if it already exists on the element
				elem[ propName ] = true;
			}

			elem.setAttribute( name, name.toLowerCase() );
		}
		return name;
	}
};

// IE6/7 do not support getting/setting some attributes with get/setAttribute
if ( !getSetAttribute ) {

	fixSpecified = {
		name: true,
		id: true,
		coords: true
	};

	// Use this for any attribute in IE6/7
	// This fixes almost every IE6/7 issue
	nodeHook = jQuery.valHooks.button = {
		get: function( elem, name ) {
			var ret;
			ret = elem.getAttributeNode( name );
			return ret && ( fixSpecified[ name ] ? ret.value !== "" : ret.specified ) ?
				ret.value :
				undefined;
		},
		set: function( elem, value, name ) {
			// Set the existing or create a new attribute node
			var ret = elem.getAttributeNode( name );
			if ( !ret ) {
				ret = document.createAttribute( name );
				elem.setAttributeNode( ret );
			}
			return ( ret.value = value + "" );
		}
	};

	// Set width and height to auto instead of 0 on empty string( Bug #8150 )
	// This is for removals
	jQuery.each([ "width", "height" ], function( i, name ) {
		jQuery.attrHooks[ name ] = jQuery.extend( jQuery.attrHooks[ name ], {
			set: function( elem, value ) {
				if ( value === "" ) {
					elem.setAttribute( name, "auto" );
					return value;
				}
			}
		});
	});

	// Set contenteditable to false on removals(#10429)
	// Setting to empty string throws an error as an invalid value
	jQuery.attrHooks.contenteditable = {
		get: nodeHook.get,
		set: function( elem, value, name ) {
			if ( value === "" ) {
				value = "false";
			}
			nodeHook.set( elem, value, name );
		}
	};
}


// Some attributes require a special call on IE
if ( !jQuery.support.hrefNormalized ) {
	jQuery.each([ "href", "src", "width", "height" ], function( i, name ) {
		jQuery.attrHooks[ name ] = jQuery.extend( jQuery.attrHooks[ name ], {
			get: function( elem ) {
				var ret = elem.getAttribute( name, 2 );
				return ret === null ? undefined : ret;
			}
		});
	});
}

if ( !jQuery.support.style ) {
	jQuery.attrHooks.style = {
		get: function( elem ) {
			// Return undefined in the case of empty string
			// Normalize to lowercase since IE uppercases css property names
			return elem.style.cssText.toLowerCase() || undefined;
		},
		set: function( elem, value ) {
			return ( elem.style.cssText = value + "" );
		}
	};
}

// Safari mis-reports the default selected property of an option
// Accessing the parent's selectedIndex property fixes it
if ( !jQuery.support.optSelected ) {
	jQuery.propHooks.selected = jQuery.extend( jQuery.propHooks.selected, {
		get: function( elem ) {
			var parent = elem.parentNode;

			if ( parent ) {
				parent.selectedIndex;

				// Make sure that it also works with optgroups, see #5701
				if ( parent.parentNode ) {
					parent.parentNode.selectedIndex;
				}
			}
			return null;
		}
	});
}

// IE6/7 call enctype encoding
if ( !jQuery.support.enctype ) {
	jQuery.propFix.enctype = "encoding";
}

// Radios and checkboxes getter/setter
if ( !jQuery.support.checkOn ) {
	jQuery.each([ "radio", "checkbox" ], function() {
		jQuery.valHooks[ this ] = {
			get: function( elem ) {
				// Handle the case where in Webkit "" is returned instead of "on" if a value isn't specified
				return elem.getAttribute("value") === null ? "on" : elem.value;
			}
		};
	});
}
jQuery.each([ "radio", "checkbox" ], function() {
	jQuery.valHooks[ this ] = jQuery.extend( jQuery.valHooks[ this ], {
		set: function( elem, value ) {
			if ( jQuery.isArray( value ) ) {
				return ( elem.checked = jQuery.inArray( jQuery(elem).val(), value ) >= 0 );
			}
		}
	});
});
var rformElems = /^(?:textarea|input|select)$/i,
	rtypenamespace = /^([^\.]*|)(?:\.(.+)|)$/,
	rhoverHack = /(?:^|\s)hover(\.\S+|)\b/,
	rkeyEvent = /^key/,
	rmouseEvent = /^(?:mouse|contextmenu)|click/,
	rfocusMorph = /^(?:focusinfocus|focusoutblur)$/,
	hoverHack = function( events ) {
		return jQuery.event.special.hover ? events : events.replace( rhoverHack, "mouseenter$1 mouseleave$1" );
	};

/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
jQuery.event = {

	add: function( elem, types, handler, data, selector ) {

		var elemData, eventHandle, events,
			t, tns, type, namespaces, handleObj,
			handleObjIn, handlers, special;

		// Don't attach events to noData or text/comment nodes (allow plain objects tho)
		if ( elem.nodeType === 3 || elem.nodeType === 8 || !types || !handler || !(elemData = jQuery._data( elem )) ) {
			return;
		}

		// Caller can pass in an object of custom data in lieu of the handler
		if ( handler.handler ) {
			handleObjIn = handler;
			handler = handleObjIn.handler;
			selector = handleObjIn.selector;
		}

		// Make sure that the handler has a unique ID, used to find/remove it later
		if ( !handler.guid ) {
			handler.guid = jQuery.guid++;
		}

		// Init the element's event structure and main handler, if this is the first
		events = elemData.events;
		if ( !events ) {
			elemData.events = events = {};
		}
		eventHandle = elemData.handle;
		if ( !eventHandle ) {
			elemData.handle = eventHandle = function( e ) {
				// Discard the second event of a jQuery.event.trigger() and
				// when an event is called after a page has unloaded
				return typeof jQuery !== "undefined" && (!e || jQuery.event.triggered !== e.type) ?
					jQuery.event.dispatch.apply( eventHandle.elem, arguments ) :
					undefined;
			};
			// Add elem as a property of the handle fn to prevent a memory leak with IE non-native events
			eventHandle.elem = elem;
		}

		// Handle multiple events separated by a space
		// jQuery(...).bind("mouseover mouseout", fn);
		types = jQuery.trim( hoverHack(types) ).split( " " );
		for ( t = 0; t < types.length; t++ ) {

			tns = rtypenamespace.exec( types[t] ) || [];
			type = tns[1];
			namespaces = ( tns[2] || "" ).split( "." ).sort();

			// If event changes its type, use the special event handlers for the changed type
			special = jQuery.event.special[ type ] || {};

			// If selector defined, determine special event api type, otherwise given type
			type = ( selector ? special.delegateType : special.bindType ) || type;

			// Update special based on newly reset type
			special = jQuery.event.special[ type ] || {};

			// handleObj is passed to all event handlers
			handleObj = jQuery.extend({
				type: type,
				origType: tns[1],
				data: data,
				handler: handler,
				guid: handler.guid,
				selector: selector,
				needsContext: selector && jQuery.expr.match.needsContext.test( selector ),
				namespace: namespaces.join(".")
			}, handleObjIn );

			// Init the event handler queue if we're the first
			handlers = events[ type ];
			if ( !handlers ) {
				handlers = events[ type ] = [];
				handlers.delegateCount = 0;

				// Only use addEventListener/attachEvent if the special events handler returns false
				if ( !special.setup || special.setup.call( elem, data, namespaces, eventHandle ) === false ) {
					// Bind the global event handler to the element
					if ( elem.addEventListener ) {
						elem.addEventListener( type, eventHandle, false );

					} else if ( elem.attachEvent ) {
						elem.attachEvent( "on" + type, eventHandle );
					}
				}
			}

			if ( special.add ) {
				special.add.call( elem, handleObj );

				if ( !handleObj.handler.guid ) {
					handleObj.handler.guid = handler.guid;
				}
			}

			// Add to the element's handler list, delegates in front
			if ( selector ) {
				handlers.splice( handlers.delegateCount++, 0, handleObj );
			} else {
				handlers.push( handleObj );
			}

			// Keep track of which events have ever been used, for event optimization
			jQuery.event.global[ type ] = true;
		}

		// Nullify elem to prevent memory leaks in IE
		elem = null;
	},

	global: {},

	// Detach an event or set of events from an element
	remove: function( elem, types, handler, selector, mappedTypes ) {

		var t, tns, type, origType, namespaces, origCount,
			j, events, special, eventType, handleObj,
			elemData = jQuery.hasData( elem ) && jQuery._data( elem );

		if ( !elemData || !(events = elemData.events) ) {
			return;
		}

		// Once for each type.namespace in types; type may be omitted
		types = jQuery.trim( hoverHack( types || "" ) ).split(" ");
		for ( t = 0; t < types.length; t++ ) {
			tns = rtypenamespace.exec( types[t] ) || [];
			type = origType = tns[1];
			namespaces = tns[2];

			// Unbind all events (on this namespace, if provided) for the element
			if ( !type ) {
				for ( type in events ) {
					jQuery.event.remove( elem, type + types[ t ], handler, selector, true );
				}
				continue;
			}

			special = jQuery.event.special[ type ] || {};
			type = ( selector? special.delegateType : special.bindType ) || type;
			eventType = events[ type ] || [];
			origCount = eventType.length;
			namespaces = namespaces ? new RegExp("(^|\\.)" + namespaces.split(".").sort().join("\\.(?:.*\\.|)") + "(\\.|$)") : null;

			// Remove matching events
			for ( j = 0; j < eventType.length; j++ ) {
				handleObj = eventType[ j ];

				if ( ( mappedTypes || origType === handleObj.origType ) &&
					 ( !handler || handler.guid === handleObj.guid ) &&
					 ( !namespaces || namespaces.test( handleObj.namespace ) ) &&
					 ( !selector || selector === handleObj.selector || selector === "**" && handleObj.selector ) ) {
					eventType.splice( j--, 1 );

					if ( handleObj.selector ) {
						eventType.delegateCount--;
					}
					if ( special.remove ) {
						special.remove.call( elem, handleObj );
					}
				}
			}

			// Remove generic event handler if we removed something and no more handlers exist
			// (avoids potential for endless recursion during removal of special event handlers)
			if ( eventType.length === 0 && origCount !== eventType.length ) {
				if ( !special.teardown || special.teardown.call( elem, namespaces, elemData.handle ) === false ) {
					jQuery.removeEvent( elem, type, elemData.handle );
				}

				delete events[ type ];
			}
		}

		// Remove the expando if it's no longer used
		if ( jQuery.isEmptyObject( events ) ) {
			delete elemData.handle;

			// removeData also checks for emptiness and clears the expando if empty
			// so use it instead of delete
			jQuery.removeData( elem, "events", true );
		}
	},

	// Events that are safe to short-circuit if no handlers are attached.
	// Native DOM events should not be added, they may have inline handlers.
	customEvent: {
		"getData": true,
		"setData": true,
		"changeData": true
	},

	trigger: function( event, data, elem, onlyHandlers ) {
		// Don't do events on text and comment nodes
		if ( elem && (elem.nodeType === 3 || elem.nodeType === 8) ) {
			return;
		}

		// Event object or event type
		var cache, exclusive, i, cur, old, ontype, special, handle, eventPath, bubbleType,
			type = event.type || event,
			namespaces = [];

		// focus/blur morphs to focusin/out; ensure we're not firing them right now
		if ( rfocusMorph.test( type + jQuery.event.triggered ) ) {
			return;
		}

		if ( type.indexOf( "!" ) >= 0 ) {
			// Exclusive events trigger only for the exact event (no namespaces)
			type = type.slice(0, -1);
			exclusive = true;
		}

		if ( type.indexOf( "." ) >= 0 ) {
			// Namespaced trigger; create a regexp to match event type in handle()
			namespaces = type.split(".");
			type = namespaces.shift();
			namespaces.sort();
		}

		if ( (!elem || jQuery.event.customEvent[ type ]) && !jQuery.event.global[ type ] ) {
			// No jQuery handlers for this event type, and it can't have inline handlers
			return;
		}

		// Caller can pass in an Event, Object, or just an event type string
		event = typeof event === "object" ?
			// jQuery.Event object
			event[ jQuery.expando ] ? event :
			// Object literal
			new jQuery.Event( type, event ) :
			// Just the event type (string)
			new jQuery.Event( type );

		event.type = type;
		event.isTrigger = true;
		event.exclusive = exclusive;
		event.namespace = namespaces.join( "." );
		event.namespace_re = event.namespace? new RegExp("(^|\\.)" + namespaces.join("\\.(?:.*\\.|)") + "(\\.|$)") : null;
		ontype = type.indexOf( ":" ) < 0 ? "on" + type : "";

		// Handle a global trigger
		if ( !elem ) {

			// TODO: Stop taunting the data cache; remove global events and always attach to document
			cache = jQuery.cache;
			for ( i in cache ) {
				if ( cache[ i ].events && cache[ i ].events[ type ] ) {
					jQuery.event.trigger( event, data, cache[ i ].handle.elem, true );
				}
			}
			return;
		}

		// Clean up the event in case it is being reused
		event.result = undefined;
		if ( !event.target ) {
			event.target = elem;
		}

		// Clone any incoming data and prepend the event, creating the handler arg list
		data = data != null ? jQuery.makeArray( data ) : [];
		data.unshift( event );

		// Allow special events to draw outside the lines
		special = jQuery.event.special[ type ] || {};
		if ( special.trigger && special.trigger.apply( elem, data ) === false ) {
			return;
		}

		// Determine event propagation path in advance, per W3C events spec (#9951)
		// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
		eventPath = [[ elem, special.bindType || type ]];
		if ( !onlyHandlers && !special.noBubble && !jQuery.isWindow( elem ) ) {

			bubbleType = special.delegateType || type;
			cur = rfocusMorph.test( bubbleType + type ) ? elem : elem.parentNode;
			for ( old = elem; cur; cur = cur.parentNode ) {
				eventPath.push([ cur, bubbleType ]);
				old = cur;
			}

			// Only add window if we got to document (e.g., not plain obj or detached DOM)
			if ( old === (elem.ownerDocument || document) ) {
				eventPath.push([ old.defaultView || old.parentWindow || window, bubbleType ]);
			}
		}

		// Fire handlers on the event path
		for ( i = 0; i < eventPath.length && !event.isPropagationStopped(); i++ ) {

			cur = eventPath[i][0];
			event.type = eventPath[i][1];

			handle = ( jQuery._data( cur, "events" ) || {} )[ event.type ] && jQuery._data( cur, "handle" );
			if ( handle ) {
				handle.apply( cur, data );
			}
			// Note that this is a bare JS function and not a jQuery handler
			handle = ontype && cur[ ontype ];
			if ( handle && jQuery.acceptData( cur ) && handle.apply && handle.apply( cur, data ) === false ) {
				event.preventDefault();
			}
		}
		event.type = type;

		// If nobody prevented the default action, do it now
		if ( !onlyHandlers && !event.isDefaultPrevented() ) {

			if ( (!special._default || special._default.apply( elem.ownerDocument, data ) === false) &&
				!(type === "click" && jQuery.nodeName( elem, "a" )) && jQuery.acceptData( elem ) ) {

				// Call a native DOM method on the target with the same name name as the event.
				// Can't use an .isFunction() check here because IE6/7 fails that test.
				// Don't do default actions on window, that's where global variables be (#6170)
				// IE<9 dies on focus/blur to hidden element (#1486)
				if ( ontype && elem[ type ] && ((type !== "focus" && type !== "blur") || event.target.offsetWidth !== 0) && !jQuery.isWindow( elem ) ) {

					// Don't re-trigger an onFOO event when we call its FOO() method
					old = elem[ ontype ];

					if ( old ) {
						elem[ ontype ] = null;
					}

					// Prevent re-triggering of the same event, since we already bubbled it above
					jQuery.event.triggered = type;
					elem[ type ]();
					jQuery.event.triggered = undefined;

					if ( old ) {
						elem[ ontype ] = old;
					}
				}
			}
		}

		return event.result;
	},

	dispatch: function( event ) {

		// Make a writable jQuery.Event from the native event object
		event = jQuery.event.fix( event || window.event );

		var i, j, cur, ret, selMatch, matched, matches, handleObj, sel, related,
			handlers = ( (jQuery._data( this, "events" ) || {} )[ event.type ] || []),
			delegateCount = handlers.delegateCount,
			args = core_slice.call( arguments ),
			run_all = !event.exclusive && !event.namespace,
			special = jQuery.event.special[ event.type ] || {},
			handlerQueue = [];

		// Use the fix-ed jQuery.Event rather than the (read-only) native event
		args[0] = event;
		event.delegateTarget = this;

		// Call the preDispatch hook for the mapped type, and let it bail if desired
		if ( special.preDispatch && special.preDispatch.call( this, event ) === false ) {
			return;
		}

		// Determine handlers that should run if there are delegated events
		// Avoid non-left-click bubbling in Firefox (#3861)
		if ( delegateCount && !(event.button && event.type === "click") ) {

			for ( cur = event.target; cur != this; cur = cur.parentNode || this ) {

				// Don't process clicks (ONLY) on disabled elements (#6911, #8165, #11382, #11764)
				if ( cur.disabled !== true || event.type !== "click" ) {
					selMatch = {};
					matches = [];
					for ( i = 0; i < delegateCount; i++ ) {
						handleObj = handlers[ i ];
						sel = handleObj.selector;

						if ( selMatch[ sel ] === undefined ) {
							selMatch[ sel ] = handleObj.needsContext ?
								jQuery( sel, this ).index( cur ) >= 0 :
								jQuery.find( sel, this, null, [ cur ] ).length;
						}
						if ( selMatch[ sel ] ) {
							matches.push( handleObj );
						}
					}
					if ( matches.length ) {
						handlerQueue.push({ elem: cur, matches: matches });
					}
				}
			}
		}

		// Add the remaining (directly-bound) handlers
		if ( handlers.length > delegateCount ) {
			handlerQueue.push({ elem: this, matches: handlers.slice( delegateCount ) });
		}

		// Run delegates first; they may want to stop propagation beneath us
		for ( i = 0; i < handlerQueue.length && !event.isPropagationStopped(); i++ ) {
			matched = handlerQueue[ i ];
			event.currentTarget = matched.elem;

			for ( j = 0; j < matched.matches.length && !event.isImmediatePropagationStopped(); j++ ) {
				handleObj = matched.matches[ j ];

				// Triggered event must either 1) be non-exclusive and have no namespace, or
				// 2) have namespace(s) a subset or equal to those in the bound event (both can have no namespace).
				if ( run_all || (!event.namespace && !handleObj.namespace) || event.namespace_re && event.namespace_re.test( handleObj.namespace ) ) {

					event.data = handleObj.data;
					event.handleObj = handleObj;

					ret = ( (jQuery.event.special[ handleObj.origType ] || {}).handle || handleObj.handler )
							.apply( matched.elem, args );

					if ( ret !== undefined ) {
						event.result = ret;
						if ( ret === false ) {
							event.preventDefault();
							event.stopPropagation();
						}
					}
				}
			}
		}

		// Call the postDispatch hook for the mapped type
		if ( special.postDispatch ) {
			special.postDispatch.call( this, event );
		}

		return event.result;
	},

	// Includes some event props shared by KeyEvent and MouseEvent
	// *** attrChange attrName relatedNode srcElement  are not normalized, non-W3C, deprecated, will be removed in 1.8 ***
	props: "attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),

	fixHooks: {},

	keyHooks: {
		props: "char charCode key keyCode".split(" "),
		filter: function( event, original ) {

			// Add which for key events
			if ( event.which == null ) {
				event.which = original.charCode != null ? original.charCode : original.keyCode;
			}

			return event;
		}
	},

	mouseHooks: {
		props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
		filter: function( event, original ) {
			var eventDoc, doc, body,
				button = original.button,
				fromElement = original.fromElement;

			// Calculate pageX/Y if missing and clientX/Y available
			if ( event.pageX == null && original.clientX != null ) {
				eventDoc = event.target.ownerDocument || document;
				doc = eventDoc.documentElement;
				body = eventDoc.body;

				event.pageX = original.clientX + ( doc && doc.scrollLeft || body && body.scrollLeft || 0 ) - ( doc && doc.clientLeft || body && body.clientLeft || 0 );
				event.pageY = original.clientY + ( doc && doc.scrollTop  || body && body.scrollTop  || 0 ) - ( doc && doc.clientTop  || body && body.clientTop  || 0 );
			}

			// Add relatedTarget, if necessary
			if ( !event.relatedTarget && fromElement ) {
				event.relatedTarget = fromElement === event.target ? original.toElement : fromElement;
			}

			// Add which for click: 1 === left; 2 === middle; 3 === right
			// Note: button is not normalized, so don't use it
			if ( !event.which && button !== undefined ) {
				event.which = ( button & 1 ? 1 : ( button & 2 ? 3 : ( button & 4 ? 2 : 0 ) ) );
			}

			return event;
		}
	},

	fix: function( event ) {
		if ( event[ jQuery.expando ] ) {
			return event;
		}

		// Create a writable copy of the event object and normalize some properties
		var i, prop,
			originalEvent = event,
			fixHook = jQuery.event.fixHooks[ event.type ] || {},
			copy = fixHook.props ? this.props.concat( fixHook.props ) : this.props;

		event = jQuery.Event( originalEvent );

		for ( i = copy.length; i; ) {
			prop = copy[ --i ];
			event[ prop ] = originalEvent[ prop ];
		}

		// Fix target property, if necessary (#1925, IE 6/7/8 & Safari2)
		if ( !event.target ) {
			event.target = originalEvent.srcElement || document;
		}

		// Target should not be a text node (#504, Safari)
		if ( event.target.nodeType === 3 ) {
			event.target = event.target.parentNode;
		}

		// For mouse/key events, metaKey==false if it's undefined (#3368, #11328; IE6/7/8)
		event.metaKey = !!event.metaKey;

		return fixHook.filter? fixHook.filter( event, originalEvent ) : event;
	},

	special: {
		load: {
			// Prevent triggered image.load events from bubbling to window.load
			noBubble: true
		},

		focus: {
			delegateType: "focusin"
		},
		blur: {
			delegateType: "focusout"
		},

		beforeunload: {
			setup: function( data, namespaces, eventHandle ) {
				// We only want to do this special case on windows
				if ( jQuery.isWindow( this ) ) {
					this.onbeforeunload = eventHandle;
				}
			},

			teardown: function( namespaces, eventHandle ) {
				if ( this.onbeforeunload === eventHandle ) {
					this.onbeforeunload = null;
				}
			}
		}
	},

	simulate: function( type, elem, event, bubble ) {
		// Piggyback on a donor event to simulate a different one.
		// Fake originalEvent to avoid donor's stopPropagation, but if the
		// simulated event prevents default then we do the same on the donor.
		var e = jQuery.extend(
			new jQuery.Event(),
			event,
			{ type: type,
				isSimulated: true,
				originalEvent: {}
			}
		);
		if ( bubble ) {
			jQuery.event.trigger( e, null, elem );
		} else {
			jQuery.event.dispatch.call( elem, e );
		}
		if ( e.isDefaultPrevented() ) {
			event.preventDefault();
		}
	}
};

// Some plugins are using, but it's undocumented/deprecated and will be removed.
// The 1.7 special event interface should provide all the hooks needed now.
jQuery.event.handle = jQuery.event.dispatch;

jQuery.removeEvent = document.removeEventListener ?
	function( elem, type, handle ) {
		if ( elem.removeEventListener ) {
			elem.removeEventListener( type, handle, false );
		}
	} :
	function( elem, type, handle ) {
		var name = "on" + type;

		if ( elem.detachEvent ) {

			// #8545, #7054, preventing memory leaks for custom events in IE6-8
			// detachEvent needed property on element, by name of that event, to properly expose it to GC
			if ( typeof elem[ name ] === "undefined" ) {
				elem[ name ] = null;
			}

			elem.detachEvent( name, handle );
		}
	};

jQuery.Event = function( src, props ) {
	// Allow instantiation without the 'new' keyword
	if ( !(this instanceof jQuery.Event) ) {
		return new jQuery.Event( src, props );
	}

	// Event object
	if ( src && src.type ) {
		this.originalEvent = src;
		this.type = src.type;

		// Events bubbling up the document may have been marked as prevented
		// by a handler lower down the tree; reflect the correct value.
		this.isDefaultPrevented = ( src.defaultPrevented || src.returnValue === false ||
			src.getPreventDefault && src.getPreventDefault() ) ? returnTrue : returnFalse;

	// Event type
	} else {
		this.type = src;
	}

	// Put explicitly provided properties onto the event object
	if ( props ) {
		jQuery.extend( this, props );
	}

	// Create a timestamp if incoming event doesn't have one
	this.timeStamp = src && src.timeStamp || jQuery.now();

	// Mark it as fixed
	this[ jQuery.expando ] = true;
};

function returnFalse() {
	return false;
}
function returnTrue() {
	return true;
}

// jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
// http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
jQuery.Event.prototype = {
	preventDefault: function() {
		this.isDefaultPrevented = returnTrue;

		var e = this.originalEvent;
		if ( !e ) {
			return;
		}

		// if preventDefault exists run it on the original event
		if ( e.preventDefault ) {
			e.preventDefault();

		// otherwise set the returnValue property of the original event to false (IE)
		} else {
			e.returnValue = false;
		}
	},
	stopPropagation: function() {
		this.isPropagationStopped = returnTrue;

		var e = this.originalEvent;
		if ( !e ) {
			return;
		}
		// if stopPropagation exists run it on the original event
		if ( e.stopPropagation ) {
			e.stopPropagation();
		}
		// otherwise set the cancelBubble property of the original event to true (IE)
		e.cancelBubble = true;
	},
	stopImmediatePropagation: function() {
		this.isImmediatePropagationStopped = returnTrue;
		this.stopPropagation();
	},
	isDefaultPrevented: returnFalse,
	isPropagationStopped: returnFalse,
	isImmediatePropagationStopped: returnFalse
};

// Create mouseenter/leave events using mouseover/out and event-time checks
jQuery.each({
	mouseenter: "mouseover",
	mouseleave: "mouseout"
}, function( orig, fix ) {
	jQuery.event.special[ orig ] = {
		delegateType: fix,
		bindType: fix,

		handle: function( event ) {
			var ret,
				target = this,
				related = event.relatedTarget,
				handleObj = event.handleObj,
				selector = handleObj.selector;

			// For mousenter/leave call the handler if related is outside the target.
			// NB: No relatedTarget if the mouse left/entered the browser window
			if ( !related || (related !== target && !jQuery.contains( target, related )) ) {
				event.type = handleObj.origType;
				ret = handleObj.handler.apply( this, arguments );
				event.type = fix;
			}
			return ret;
		}
	};
});

// IE submit delegation
if ( !jQuery.support.submitBubbles ) {

	jQuery.event.special.submit = {
		setup: function() {
			// Only need this for delegated form submit events
			if ( jQuery.nodeName( this, "form" ) ) {
				return false;
			}

			// Lazy-add a submit handler when a descendant form may potentially be submitted
			jQuery.event.add( this, "click._submit keypress._submit", function( e ) {
				// Node name check avoids a VML-related crash in IE (#9807)
				var elem = e.target,
					form = jQuery.nodeName( elem, "input" ) || jQuery.nodeName( elem, "button" ) ? elem.form : undefined;
				if ( form && !jQuery._data( form, "_submit_attached" ) ) {
					jQuery.event.add( form, "submit._submit", function( event ) {
						event._submit_bubble = true;
					});
					jQuery._data( form, "_submit_attached", true );
				}
			});
			// return undefined since we don't need an event listener
		},

		postDispatch: function( event ) {
			// If form was submitted by the user, bubble the event up the tree
			if ( event._submit_bubble ) {
				delete event._submit_bubble;
				if ( this.parentNode && !event.isTrigger ) {
					jQuery.event.simulate( "submit", this.parentNode, event, true );
				}
			}
		},

		teardown: function() {
			// Only need this for delegated form submit events
			if ( jQuery.nodeName( this, "form" ) ) {
				return false;
			}

			// Remove delegated handlers; cleanData eventually reaps submit handlers attached above
			jQuery.event.remove( this, "._submit" );
		}
	};
}

// IE change delegation and checkbox/radio fix
if ( !jQuery.support.changeBubbles ) {

	jQuery.event.special.change = {

		setup: function() {

			if ( rformElems.test( this.nodeName ) ) {
				// IE doesn't fire change on a check/radio until blur; trigger it on click
				// after a propertychange. Eat the blur-change in special.change.handle.
				// This still fires onchange a second time for check/radio after blur.
				if ( this.type === "checkbox" || this.type === "radio" ) {
					jQuery.event.add( this, "propertychange._change", function( event ) {
						if ( event.originalEvent.propertyName === "checked" ) {
							this._just_changed = true;
						}
					});
					jQuery.event.add( this, "click._change", function( event ) {
						if ( this._just_changed && !event.isTrigger ) {
							this._just_changed = false;
						}
						// Allow triggered, simulated change events (#11500)
						jQuery.event.simulate( "change", this, event, true );
					});
				}
				return false;
			}
			// Delegated event; lazy-add a change handler on descendant inputs
			jQuery.event.add( this, "beforeactivate._change", function( e ) {
				var elem = e.target;

				if ( rformElems.test( elem.nodeName ) && !jQuery._data( elem, "_change_attached" ) ) {
					jQuery.event.add( elem, "change._change", function( event ) {
						if ( this.parentNode && !event.isSimulated && !event.isTrigger ) {
							jQuery.event.simulate( "change", this.parentNode, event, true );
						}
					});
					jQuery._data( elem, "_change_attached", true );
				}
			});
		},

		handle: function( event ) {
			var elem = event.target;

			// Swallow native change events from checkbox/radio, we already triggered them above
			if ( this !== elem || event.isSimulated || event.isTrigger || (elem.type !== "radio" && elem.type !== "checkbox") ) {
				return event.handleObj.handler.apply( this, arguments );
			}
		},

		teardown: function() {
			jQuery.event.remove( this, "._change" );

			return !rformElems.test( this.nodeName );
		}
	};
}

// Create "bubbling" focus and blur events
if ( !jQuery.support.focusinBubbles ) {
	jQuery.each({ focus: "focusin", blur: "focusout" }, function( orig, fix ) {

		// Attach a single capturing handler while someone wants focusin/focusout
		var attaches = 0,
			handler = function( event ) {
				jQuery.event.simulate( fix, event.target, jQuery.event.fix( event ), true );
			};

		jQuery.event.special[ fix ] = {
			setup: function() {
				if ( attaches++ === 0 ) {
					document.addEventListener( orig, handler, true );
				}
			},
			teardown: function() {
				if ( --attaches === 0 ) {
					document.removeEventListener( orig, handler, true );
				}
			}
		};
	});
}

jQuery.fn.extend({

	on: function( types, selector, data, fn, /*INTERNAL*/ one ) {
		var origFn, type;

		// Types can be a map of types/handlers
		if ( typeof types === "object" ) {
			// ( types-Object, selector, data )
			if ( typeof selector !== "string" ) { // && selector != null
				// ( types-Object, data )
				data = data || selector;
				selector = undefined;
			}
			for ( type in types ) {
				this.on( type, selector, data, types[ type ], one );
			}
			return this;
		}

		if ( data == null && fn == null ) {
			// ( types, fn )
			fn = selector;
			data = selector = undefined;
		} else if ( fn == null ) {
			if ( typeof selector === "string" ) {
				// ( types, selector, fn )
				fn = data;
				data = undefined;
			} else {
				// ( types, data, fn )
				fn = data;
				data = selector;
				selector = undefined;
			}
		}
		if ( fn === false ) {
			fn = returnFalse;
		} else if ( !fn ) {
			return this;
		}

		if ( one === 1 ) {
			origFn = fn;
			fn = function( event ) {
				// Can use an empty set, since event contains the info
				jQuery().off( event );
				return origFn.apply( this, arguments );
			};
			// Use same guid so caller can remove using origFn
			fn.guid = origFn.guid || ( origFn.guid = jQuery.guid++ );
		}
		return this.each( function() {
			jQuery.event.add( this, types, fn, data, selector );
		});
	},
	one: function( types, selector, data, fn ) {
		return this.on( types, selector, data, fn, 1 );
	},
	off: function( types, selector, fn ) {
		var handleObj, type;
		if ( types && types.preventDefault && types.handleObj ) {
			// ( event )  dispatched jQuery.Event
			handleObj = types.handleObj;
			jQuery( types.delegateTarget ).off(
				handleObj.namespace ? handleObj.origType + "." + handleObj.namespace : handleObj.origType,
				handleObj.selector,
				handleObj.handler
			);
			return this;
		}
		if ( typeof types === "object" ) {
			// ( types-object [, selector] )
			for ( type in types ) {
				this.off( type, selector, types[ type ] );
			}
			return this;
		}
		if ( selector === false || typeof selector === "function" ) {
			// ( types [, fn] )
			fn = selector;
			selector = undefined;
		}
		if ( fn === false ) {
			fn = returnFalse;
		}
		return this.each(function() {
			jQuery.event.remove( this, types, fn, selector );
		});
	},

	bind: function( types, data, fn ) {
		return this.on( types, null, data, fn );
	},
	unbind: function( types, fn ) {
		return this.off( types, null, fn );
	},

	live: function( types, data, fn ) {
		jQuery( this.context ).on( types, this.selector, data, fn );
		return this;
	},
	die: function( types, fn ) {
		jQuery( this.context ).off( types, this.selector || "**", fn );
		return this;
	},

	delegate: function( selector, types, data, fn ) {
		return this.on( types, selector, data, fn );
	},
	undelegate: function( selector, types, fn ) {
		// ( namespace ) or ( selector, types [, fn] )
		return arguments.length === 1 ? this.off( selector, "**" ) : this.off( types, selector || "**", fn );
	},

	trigger: function( type, data ) {
		return this.each(function() {
			jQuery.event.trigger( type, data, this );
		});
	},
	triggerHandler: function( type, data ) {
		if ( this[0] ) {
			return jQuery.event.trigger( type, data, this[0], true );
		}
	},

	toggle: function( fn ) {
		// Save reference to arguments for access in closure
		var args = arguments,
			guid = fn.guid || jQuery.guid++,
			i = 0,
			toggler = function( event ) {
				// Figure out which function to execute
				var lastToggle = ( jQuery._data( this, "lastToggle" + fn.guid ) || 0 ) % i;
				jQuery._data( this, "lastToggle" + fn.guid, lastToggle + 1 );

				// Make sure that clicks stop
				event.preventDefault();

				// and execute the function
				return args[ lastToggle ].apply( this, arguments ) || false;
			};

		// link all the functions, so any of them can unbind this click handler
		toggler.guid = guid;
		while ( i < args.length ) {
			args[ i++ ].guid = guid;
		}

		return this.click( toggler );
	},

	hover: function( fnOver, fnOut ) {
		return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
	}
});

jQuery.each( ("blur focus focusin focusout load resize scroll unload click dbl JavaS" +
	"mousedown 1.8.3uphttp:/movehttp:/over
 *
 * uthttp:/entncludes leavebrary vchange //sict submit key
 * hkeypressy Foup error contextmenu").split(" "), function( i, name ) {

	// Handle event binding
	jQuery.fn[T lice] = under the data, fnense
		if (:33 == null GMT-05	aste 08:2;d Ti08:2 rn Stafunc}

		return arguments.length > 0 ?d Tithis.the  lic,n Sta, 08:20:33 GM:rence to triggere root );
	};

500 (ErkeyEery..testThe defe GMT-05e
 *
 *uery..fixHooksate: Tue Noe the correctkeycumenrredused on D1.8.3ready
	readyList,

	// Use the correct document accordingly with windo1.8.3rgument (s});
/*!
 * Sizzle CSS SCopyror Engine oveCopyright 2012gly wit Foundar th and otheer conributors oveR/sizsed under the MIT licensrite
http://s jQuejs.com/
 */
(under the window,	_$ =finedense
 var cachedruns,
	assertGetIdNotNoot 
	Expr,
	getText,
	isXML,
	 conaire_slcompiltypesortOrdeice,hasDuplicattypeoutermostCcontri,

	baseHring = Obje = trudexOftr= Array.pr= "= Array.p"ng,
expando = ( "sizush,
" + Math.r= Stm() ).replace( ".", "" )ng,
Tokee)
 String,
	doc
	//  =ore_pus.n( selection( Elem)
 *( selecext ) {
	e jQ{
		// ircore = 0tion(nObjenstrpop = [].popnhanushd'
		reushexOf

	/d'
		rt( se, * htUse a stripped-
 * hindexOf if a native ctoris unavailable
	// Used '
		r// Used || under the e jQuGMT-05pe.pir 'enha		luery e to centrafuncfor ( ; i < len; i++ndard Ti00 (Ee to[i] ===]?\d+|)/.souined ) {
ifunct} undeined ) {
-1rredng,
// Augelecta under th immispecial use byer jQue
	markFoking atNov 13 2012 fn, valucense
Time[ im = Stre NouFEFF\ern Stan||le wayfunced ) {
fnOM and NcreateCsh,
\uFEFF\xA0]+)/.source,ush,
 = {} Usedkeyt co[] usetrings
	trim = /^[\smethods
	cokeys\uFEFF\xA0]+$NBSPOnly keepwindotype reclecte in esrnotwhiteh (#y.fn.ag =  ) > .sli.ush,
Lentralpace = /deletevia lo[g = /^shift() ]// Make\-]*)$)Reag
	ve with (\s*\+ ease to avoid collisg at = /(atchingObject.prototype properties (see Issue #157)\-]*ed ) {
(rvalidchar:|,)(?simple wayerre	},via locerredoritilassd over <ize #id ove(),
	tjQue\d+|)/g,

	// Matches daype.indr\d+|)/g,

	// Matches d NBSPRegexa = /-Whitespace characters a referwww.w3.org/TR/css3- Copyrors/#w,

	// Us
	fcamelCaseProp[\\x20\\t\\r\\n\\f]"text, .camelCase as callback to ryntax/#d by jQuer
	d by jQueEncoliceProp(?:\\\\.|[-\\w]|[^\\x00-\\xa0])+re_tr// Loosely moegExd onry inidentifithe  The ready BSP n unquotedle way should botjQcument.addEvent(.camelCase as callback to replace()
	atin case replace()) {
		Pa-fA- 
	},

:etter + "" ).toUpperCaCSS21/sy

	/a.html#uFEFF-def-nt.addEven
	nt.addEvent=tListener dler anda local copw of w#jQuery
BSP ccept_pnu -fA-ace()etter + "" ).toUpperCase );
			jQuery.ready();
		} e
	e dom readself[*^$|!~]?=)rn (uery.readoaded\\[.tri function( + "*(.trievent handler and + ")// [[Class]] -> 
		"*(?:.trie dom read [[Class]] -> type?:(['\"])(f cleanup ^lean])*?)\\3|e paint.addEvent};

|)|
jQuery.fn = jQue "*\\urn se if (efer
var
	// A not in parens/brackete_sl//  windn uery.read* Copyrreadp ovnon-pseudos (dennt.reby :s da
		if ( !senythand elselemenThes[\dae $(ences are here\s*\reducewindonumber of {
			retulement)nee and shed ize$(unindoPSEUDO{
		Filttate		}

		/= ":e pairs
	class2type = {};

f clectioit: function( selector, contex2|([^()[\\]]*|if (totypeady();
		}
		var[^:]|leanu)*|.*))\\ mat	// HanFor match?:<\/POSrn th {
				// 	rets.toStrihanc ( typeuery|odd|eq|gt|lt|nth|first|last) {
			jQuery.fn = jQuery.pro(?:-\\d)?\\d*atch, elem, ret, doc;
)|)(?=[^-]|$length >=Lea and n this;
escaped trailand fcamelCased*\.ptufunc somehis;
 function( d by jQuerypndalturn the lattringrtriQuernew-([\Exp( "^// [[Class]] -> ty+|sele^lector, cf cleanu)l ];

			} else {
		+$ of gjQuery
rcomm( wintext) ) {

				// HANDLE: $(htm*,// [[Class]] -> typjQuert insbinentLoadeof jQuery ? context[0] : context;(, letter ) {
		ret>+~]atch, elem, ret, doct && co		}

	ype ? context.o		}

		/pha = /-Easily-parse_pnu/ridbracll thID or TAG		ifCLASSis.length = rquick.sli = /^(?:#([\w\-]+)|(\w+)|\.PlainObje)$/text ), $Quer:not/& cosibatch = /[lettet\r\n\f]*[+~]( selendsWithNs.attrcall\(					thhea = w= /h\d/i& coinput ( t// HAN| Copyr|ntriarea|button
			
	rbackslaw jQu/\\(?!\\)/g= do {
				//catiry.pID":e ? context.own#e pairs
	class2type = {};

jQ&& c	"gleTack parentNode to \\.atch when Blackberry 4.6 returns
		NAME nodes that are no [ lic=t: fu?e pairs
	class2type = {};

{
				;

	urns
		TAGck parentNode to e pairs
	class2type =  which is good enfor .6 returns
		ATTRck parentNode to elector.length rns
		Handle			return rootjQuery. = jQuery.p );
O/ nodes that arepos, "iturns
			HILeck parentNode to :(onlyd skip the regex-child check
				match = [ null.proth <> are(([+-]|)(null nmatch, elem, ret, docif ( ;
							}

					this.contex\\d+)|) ];

			} else {
				matc of  the jQu >= 3 ) 5.0in librag
	r imply jusno c.is(ens "s that start			return rootjQuery.[Class]] -> typ[				|rwise into theM and NBSPSupport// HanUte
	immi	reano conteselect Map ]?\d+entslice = \uFEFF\xA0]+|[\|)/.source,divuery object ize #illy jus("div")
	rqutry\w\-]*rings
	//(conte(?:\d\ c{
		 (e[\w\-]*rings
	/alsML st} finallLE: $(f// rrwrite memoryxt.jIEunctintextndow, unde and NBSPCheck forgeally jussByTagotot("*") ed ) {s gth 			} elssslice = selectoNoCom$(null= ice = methods
	co// Sh		// div.appendC = elt ).find( selectr = sel("")Shortced ) {
! = s
		}

		if ( selector.selting and t}pha = /-lector );
		Alector ) ctor !==normalized hrefctor.lengthslice = Href.prorent versitor.selector;
			this.context = sinnerHTML( ty<aion o='#'></a>"eArray( sel = sp ther.con && ]|u[ofber of elementsr, tr: "",

	/!==Quer= Array.pr&&		returthe matched element set
("on o"),
	co"#	// pty selector
	seleady();
		}
entListenec, truele $(Delector ) nodbeing usedr: "",

	ector.selector;
			this.context = sery object is  Copyr><hEvent(
	// Tpe.p]|u[\=ntained in trege.length;
	},

	toArrmultiple		//unctiIE8// The cujQueryngt you,ntexady();
		}
uery w( !s), $undaelse ray( sel]|u[\size"boolean" contains[ this.toAr) {
		return core_slic
		}

		if ( C-+]?otot cantenetrustedslice = Us_pnuments and tor.selector;
			this.context)$)/ dom pus't( jQdthiseconry Jass lice(in 9.6ens hed element set asturnname,='hidden e: 0,div>Query matched elemt set
			// T00 (Eector, this );
	},ments and ||uctor(), elems );

		// Add ("et with an// JSON eady
		} else if $/,
ch iafari 3.2via losy matc			// Returnp ovdoes fun for d/
 *
 rsin		return num =name,ning th"e	// The number object onto the stack (as a referenc
	co2 empty selector
	selectolly jusById// The cufined )  $(D licy( selector );
		}

		if (  and privilegest tome $ inols		ifor + "." + name + "(IDhe stack
	// (ning the new matched element set)
	puIn"\\\r cont	( nuhed e",

im = Str+ 0 'cl jQuery object is 0
de ) '.tri the argum": 0,

Querys, but this is
	// only u( this.co The jQ.ine = Beforethis.,ry oargs f elements 	// HAeTypes( nupe.pponteery object ;
		}

		// Return{
		re// buggy browsuerywillet
		re few= wina
		// corr set2unctiction( fn ) {
		// Add th(is is
	//} else if ( nais.conack
		jQuery.ready.promise().dmo thi );

		return th0s;
	},

	eq: function( i ) {
		i = +i;
	+ 0		return  'clice = Array.protot = !},

	eq: function( elec	i = +i;
		k, args Cengtupback, args r.com/r.contex/ Shor num < 0 ?ady: {
		;

atchf t( selill), $	core_pnu,\da-vidotjQumenup
NDLE: $t( se.calltext;args ] = eNin t,;
	}[0]. in Type;
ut for do F\xA0]+t( selecunder the M|)/.source,?\d+ Usedresullecto1)
	trimming w(?\d+| detec[i])ce
	core_rnot callba^<(\w+)?\d+|)Query.ret.prevO callbarred u}

ooking atr jQue( {
			ret,r contri,t || thi, se.prototn callback. callbac||.call( contriletet like ||ry object;


	re {
		,
			re xml, return this.p a jQuery rn this.pussed on !{
			retmethtained it functi: this[ num contextvObject || this.cove the i	splice: size1 conrototype = jQ9er instantiaticall(fn.ixml = exOf ( jQuery mpply(the in = f&&init Behavesons, n( {
		n Ar[1] ) && .exec

	// For  )

	// Us

		rpeed-up:l);
	},
"#ID"ens =IsArray =e_push[1]| {},
		iinit.prototype 
	coxtend = 			elem );.splice
1 );
	},

	slicern this		i = lectordefintck )\s*\ for d the Blackberry 4.6et
		ret
		deep = in t i, tntextno longer}

		// n( select#6963
		dee00 (E?\d+|&&is a .t;
		targetuation
	i* http://jq
		reselew = thIE,ushSta,( namWebkitand+/,

	teme boole			th"(" +  instead	thi
	//n target is a n see==" ) possible unction() {
		return thislf if object || this.c i ) .pre) {
tor.npossible 	if ( length === i ) 
		taret = this;
		-p = t like core_sli Handle cen target i.splice
ownerD( select&&, elem );s
		if ( (options = aget === "boolean" ) )e callb		Array.proues
		if ,
	sor ct
	// extend jQuery itself i only one argument is passedi;
	}

	for ( ; i < length; $/,
	rva1,
		length = argurn iens =et = th00 (Ep = fa2]ry itself.fn.selely(se only.
	/

	map: fueof target === "bo ( selectoruments[0] |, 0makeArr	// Prevent never-
		i = 1,
		length = argu.			// 				continue;
					deep = fa3]	src  stack
	// (returning &&peof target === "bo;

		// Add t/ Recurse if we're merging plain objects or arrays
				if ( de stack (a" ) uery.isPlainObject(copy) ||  Make sure
			BSP llver thatchif ( l Copyrcopy && ( a local co] || , "$1era nternal use only.
	// Bt: [] opt}

r jQue. {
		nt se:[eE][\-+]?slic" + name +haves l ) {
);
	},

fined Query(Query(values
			;
d us
				// Don't  case of ring in undefsort:fine			} else if ( copy !== undefined ) {
	[is a s]		return i>mentd usrvalid
			thiooking attoontext.j		}

		/immi/ HAN the suctor(nullize #iI HANP	}

	(? this		} else if :[eE][\-+]?\d+|)/.source, licecore_rrn thotot.toLowix =se(keArray( seljQuery thi/ HANh + n= _jQtion( = num )s.construunction( deep ) {
		if ( window.$ === jQuery			elendow.$ = _$;
		}
B		ele ( deep && window.jQuery === jQuery ) {
			window.jQuery = _jQuery;
		}

		return jQuery;
	},

(	// Is the DOM re||
	// Is the			ele"	src = tare used? Set to true once it occurs.
	isReady: false,

	// A counteposir thalndow.$ = _$;
		}
P);
		}
	} ( deep onstructickExpr = /^(?:[^#<]*(<[\w\W]+var
	// y.isArrt if ther= +var
	// eArray( sel = /^(?:[^#<]*(<[\w\W]+ clone Don't by itselpe.pj Usedh[2] )I/ Ust brinn( []
	// Bting an,rt if there jQuer

	/y.isReady ) ting and 
		i = M, clo + name +fy,

 atopy)
, Saffied	// Us	rsingwhile ( i--;

	// Handle  cop[ (jsts, at least, ));
tendation
	ietTimje No!ay, clesember  RemembisPlain
		take suerredpy );
/** oveUtilitylooking at youc, trueatch && like uFEFF\ofr)
	arraywaitDOMt in th * @param {Aneed|lly juset =emcore 
	core_ry =				//0 ) {
			r:[eE][\-+]?\d+|)/.sodow.jodntex: fur + rn (xists/ Use	splice: []= _jQuery// Give the i	splice: , copyIsArra deep copy s1Ready deep copy sitvents
		if ( jQu11 {},
		i = rootntriy deantQueryfined ) {
/ Onlery o {
		usag

	/com/nt to:consistencd be
of jlin{4})/g,
#11153s.length,
tained 		if (nt ).trigges thefor later inst	// Preveince version 1.3				}
t = this;
		eTypravernue;ts ] = eren funcimmingelem );= _jQf elements;n: fu ) {
	ith( docuextSctor, c		}

		// exe+=n arore_gument is passy.isReady ntinue;
			ts
		if ( jQu3ry.fn.trigger ) {4ce)
		ret.prevO= _jQueryV HTML st.pre// Dol), $(uclud	ret= sel		ifprocessoArr) {
ruing at in thesupported'clean'f
		its
		if ,e = /withexpect.retotenerif needl( elem, i, ts
	ion: fu));
	},

	end: fun( obj ) {teturn fan obj != in thection";
	},

	isArte( o this.pr}y: functiretict: fexOf 		return;
call(obj:[eE][\-+]?\d+|)/.so// Handle clly juswithver43).
	est/uases( typeoitme === "fyet exi
	},// (such as Querbj ==fram {
	 {
	 - #483 isFr( counction( obj ) core_rsguments[( (options = ar||	},

) is actually jus;y: functir property.
		//?, as well
		if (Query;
		otype bjec" :	} else t: func( obj ) rray.pro aner th
y.isWindo	return;
 ) {
			retction( ca.isWindo?
	
		// Abort, b|)/.source,a
 * h= arn this.popy sit? a is actually jus : a Usedbued'
bsurebr somethingeArray( sela, DOMn.cahe o!(_hasObj, upt
			if ( obj.uery. be O		// Not o, "isPrototypeOf"(bupmakeAr}	rootry {
			/mdefiions = an the DOown constructor property lse if (obj,calla e ) {
			// IE8,9 Will (prope& 16
			}
		} constructor property ment.bod(ball(r something| {},
		i00 (Eb, DOMa and functions lct.p// Make sure we trim} else iname ] = couery		}
	}

	// Return  license
ructoval
		r = function()eturn thions, name, 		}

	jQuery  lic}

		return jQuer}ions, n(va funrget uerytp://jate: Tue

	// Uslse if val	return thir name;
, co|| {
				ed element n false;
		}
that h;
	},

	toArhe deferredned  funrror( msg );
	},
ck )
	// data: e;
		}
		rferen.
	// Sinceate: Tue N this.length erencnt will be cr?== und:n Stanrootjval. #5443).
	?
		r.uFEFF\ment
	// scndow, d us;

				eturn;
{
			retur			/selectush itadjnto t(tar && ustate\1>|)$/,

	: 50oritize #i ( dee: ready
		if (atch[2] ) ( !
				//	// HanIE6/7 && !jQua {
	43).
	on oready(tp://j: {
				
	jquery: "1.8.3",eren{
		} 	d funray: f: === jQuery ) {
			winrow new Error( msg );
	},

	ray: f, 2.isPlaion.has"]|u[ntext = 0;
		}
		context = context || document;

		arsed ag
		if:\d\d

	ctio:		// Check unction() {
		returerencunder the MdjQuery.exte	isEmptyObunction.
	// Seof target === "boolea	size: function() {


	isEmptyObdyWait  typeof target === "boolean"iback,		deep = target;
		target = arguments[1] || {};
		// skip the boolean and the target
		i = 2;
	}

	// Handle case when tarlready rd.caor something ? [m] :.call( .isArray// scragment( [ data ], context, scripts ? null : [] );
		return jQuery.merge( [],
			(parsed.cacheable ? jQuery.clone( parsed.fragment ) : parsed.fl;
		}

		// Maerencuerytend jQuidion the jQuml
	// context (opge( [],
			(parsed.caml
	// context (opt"id") true, ow.JSON		return	ailin passed
= Array.pr/json.or whitespace isarseturn ite			this.selector = selecildFragment( [ tagjQuery.ex scripts ? null : [] );
		return jQuery ( selecto	size: function() == "function().d or arrays
				if ( deep && cotag Array.isArray removed (IE canvalidtokens, "]" )
		pe.p callback.ata ) )();

		}
		jQuery.error( "Invad. They L stri Sizzposectoturn obj e boolction.agreated!== m ? jQuery.c			returnencemed'
		 {
			if

	//.JSON.paelem, i, elem ); callba));
	},

	end: fu;
	}

	// extuctor.prototypey itself iftmpne argument is passed
		targeJSON.parse ) {tmphitespace i// Prevent never-endst( dat ( elem Execute a callba&&";
	},

	isvalidtokens, "]" )
		.replace( rvalidbraces, "")) ) {		return ( new Function( "retun " + data ) )();

		}
		jQu {
		ie deferrement( parse					// no{
						copyIsArray = falunder the s.selectota ], context, scripts	.replace( rvalidbraces, "")) ) {ments and e( [],
			(parsed.cacheable ? jQun " + data ) )();

		}
		jQu jQuery.isPs.selectorror" ).leng.ready(reltchin ) ];
	>": { dir: "t;
		targe", p the:rties on.ha" 2009/09/08/eval-javascontext
+2009/09/08/ereviouse(obj) cript-global-context
~
		if ( data && core_rnotwh t/blog/dHTML stri ) ];
								under the y, clon null;p = falsdeep = fals
					targeument.getof jQu IE gets aom/
 && gijustuFEFF\tocopyIsArr( tyr thement.re conument.rn so that 3onte			}

		4]r: fp = fa5w, da jQundow
			// rather than jQuery in;
				}

				/eated~=s and func"eval" ].cafals+cript || f|,)(?{}\s]*$/,
	lready retchr, con( 0,j) =?:\d\dh ) {
y objecn anonymous function so/* --jQueryfrom!== "strin[melCase]itesp1? thisngth = 1;
...ens =	2rt if therxt = docum\d*deNan		retDLE:?hAlpha, fc3 xn-e ) onj != f xn+ymelCase );
	ret?e: f|ha, fc4 signlem.no		return eitesp5 x() === name.toLowerCa6rCase() =y name.toLowerCa7 d be
l usage only
	e*/n so that context is win

		return jQueashed to camelCcont thinths and funcan ath0] = e requirconter
	// ipts ? nul!	}

				// Recurs	eturn;
 othe			}

		0] Array.isA length =umeric x( namyet;
ameQueryimmirget f stri.elCas length reme;
			e tar} els/al-cocastand, SachinlyecSc0/1e css and data m+			}

		3s to( window,+ray, cl
			} )1) : 2 *to camelCase; useuerydReadcamelCase; useoddter d.fragm( window, < le			}

		6( calback.7;
		 {
						break;
					}
 IE gets er the		winull hibiarger
	// A			continue;
				}

				// Recurs) {
			if ( isObj ) {
				forot to hump their v#9572)
	cam
						}
n anonymous function sope.p				windn th&& oor" );
				}

	( rmsPrefix, 
	readyObj ) {
		arounds based onndow, un obj[ n;
				}

		3;
		}

		/camelCase;				breaken't supportame;
	cument.re}
		}

	4se;

	// Ha)$)/,

	cector"), $(nulle tar	// Not a.$ === ipts ? nulk-compa
	read				windct
			for // Gf IE,&& oing.rethis;
		}(recurs
			}ha, fc	( {
			r=n text ==({
				for (al-coect
			for // advan seloelectons, cloobj =t;
		thesie boole	core_trim				wind\d*\.|)\(;

jh = return central-) {
			r) -?
				"" :
				( ], i,fragment) {
			ri	thinegtching// Usfragme/ Use nativ
				"" :ndor prefixt + "" .fragmeObj ) {
	}
		}

	0or, con arr, results ) {
	
		tar				}
			}

				"" {}\s]*$/,
	rvalid().d unde sure es		ret( data, co-compatj[ nam ).fiod (]|u[\p ov
				forens = /"[^"\eir vendor prefi3		class2tyarsed[rer
			// W	}

		parsed = jQuery.buildFragment( [ da scripts ?atividndow
			// rather than jQuercrosoft.XMLxt = 0;
		}
		context =)) ) {
			return [ context.		// borrowf ( arren't suremoved (IE can'ttype === "string" || type === "function" || type === "regexp" || jQuery.isWindons bound( num ) {
 html
	// context (opa global context
	//  html
	// context (opth.cal.fragme[ i++ ] if (ry.fn;
 Logic borrow arr );
			} t( data.replunder the e(obj) !=	noop: functe(obj) !=			return null;
 === "regexp" ||) { && !jQuties  ;
			}  typ
			for ( 

			for ndow
			// rather than jQue,
			i = 0,
			leng === "regexp" || jQuery.isWindray";
	},

	isWiml.loadX= _jQuery;
		}

		return jQ( ; i( first,or" ).#9572)
	came		// no + data );
		}
		rey.readyWait pmatchObje\-+]?\d+|),

	// A si[ttp://webloe|false		}
			}
		}
{
			for|| type({
			for (of jQuery ? c(^r, co[Class]] -> tyrn thirst[ i++ ] =k
				match = [ n "ickE// Otherwis\-+]?\d+|));
		}
		retuegexp" || jQuery.isWindow( arr {
			fo
	readythat s.selector|| sligh;

		if ( arr ) {
		( core_indexOf ) {
				return core_ind("name,")he mon" || type = tr i ? i <e use an anonymouroot je dom re,erever e)
		ret.prevOb[eE][\-+]?\d+/ Cross-browser xml parsing
ed in the ueryn key === unde, tmp;
rim.ca !!callrn Standard Tierge: fune dom re( ; i !=t forgrr != non( ob[ i ] );
	ret.push( elemsties are  ( name  retVal+cute, tmp;
( elems[ i ] );
			}
=" ?= retVal )ete"ctor/json.o[ i ] );
			}
		} value, kesize		ret = [],
			i = 0,
			le^gth =		ret &&= retVa text == nidator fy,
	0 = [],
			i = 0,
			le* treated as arrays
			isArray = elems > -1 = [],
			i = 0,
			le$ treated as arrays
		subss[ irays
		
				( te		retreference)y,
			ret = [],
			i = 0,
			led by?ng.pdules: functi the )eof length === "number" && ( ( length > 0 &&|ar value, key,
			ret || elems[ length -0alidato|| lengt+data y,
			ret + "-" = [],
	} else ift.length,
			jlCase: function( ]|u[ Make sureript-gl, rege" );
		},ction.
	/th,
			isObj = leng	inArray: function( elem, arr, i ) {
		, diff {
			ift;
		t of htmlconstructor"en target ip theototype, "}

		instan ];
				copyternal usage onml = new 00 (Eallbacky itself i			ver ) {	xml =imming{
		vart;
		tnction( obj ));
	( [], i in ary.type(obj) === "functHandle a deeFromString( data , "text/xten a++ested ararget is a sgth,
				// Bind a fu	break to a cont
		targguments.
	
				xml = new atchecorpor= Ob && offset (e an Otwn tNaN)
		renerever pg.prot cycle sizested aen an-=!= nu arr, elem, i en any==				if 			rext = %				if ( va0s aren an/				if >) {
	 arr );
			} 	}
			}
		}

		return -1;
	},

	meri ) {
		var {
		y, argswick( jQ&& window.or ( sele"gth "/json.od.
		ip the!jQuery.rstly, so t );
	},

	/a && core_rnotw ], i, objter for objects
	guid: 1,

	// Bind a fuvar key;
		for ts.
	proxy: func= {};
	}

	/ every keytion( ry itself if ot.length ] = val	return fnte( obj );
ey, arg 	retfall
	trroughore efined.
		irege fn ) ) {
			return undefined;.type(obj) lated bind
		args = core_slice.call( arguments, 2 );
		proxy = function() {
			return fninternal usage onlyue != null ) {
					break;
					}
		}

	 Make sure b function		}

	-.conte licontextd.
	-) {
n;
		v
			t letter + "" ).toUpperCareplace()
	lly be execu	rsing if (iorit
		}btions) {
on
	acmal in exec,custom.$ === jQtextadve ' = /(upperexec,leatchoff("reaR false ) {
		setL strienceherlse ng.re		}

		} else {arge_sl Time)
 rget 		}

		['
			// w, darget ( key && try.acces l = second.lenw, d args ) {
			if ( is"unss justed"object:dules-compatch
		} elsT contex mayontexparsed;
		ifwn tg/li = Obe taff("rea"), $(nullget
	have ' = aze #i tmp,Tweakedr ( ; i ff("reation to r jQuere ==o through/g,

	// A simhe object,
		} ebort if there{}\s]*$/,
	rvaBizzlaiore_tr		// Se.apploldrCasea) alson( value ) central rata , "texfor ck.c
	// The 	// The "" Make sure whitespe_slicems, fn, i, key[.hasOwn ( doctyn
	// Th l = second.len)ed from ready
		if ( wait === true ? --jQuery.readyWws a Tyidx {
			ifnull )nativBulk cloneake sure body ex exists, at " :
				( functioment.body ) {
			ret== "sxtrin/ Usedap: funrue ? --jQued\S/,( arr, e// Reme.calsimpl!all( obes fn( elems value.call( elems[i
		targe
	rootjoved (IE canjQuery.isWindofunction)
		eturn 0= nullts ) {
		is callable, in the / Pret/blog/d		}

		 ) ];
	noy ).ready
		if ( wait === trunts[0] | functionT|| !cket 	now: fuady:ec is tpe.indff("reas*\[)+/g,tze #oArrl( selector // Matchff("rea// Uss to ntext.nodeT} else { ) {
	indow.DOMP callback.ca jQuery.isRmpletepe.indclone them
					target[ name ] =  if ( vakberry 4.7 Rer,

	// A sim		retuready
		if ( wait === true ? --jQuerta ], context, scripts 		}
		try {
			ifun value );
nt has , exec ?Query( [].s[]		}
			}



	/;
		}

		//ey, arg ts a little overzes like theby `nt has `ndler  < length; i++ ) {
			ame;
	eturn js like th, 1 )y itself ifetTimS/,
 that the Dpts tdow o { // IE
				xml 		chainable =r ( ; i < length; i++ )tive" here, but/ HANype,
	

		//lems, valuer(ist = vered by Chri callbac( arr, elem, i !nction() opjQuerye != nulpha =	"has0], key ) : emptyGet;
	},

	now: function(	}
		}

		return -1;
	},

	merge: fun);
	},

	// For in?\d+|)({
	noConflic handy event cal	// Not 0], key ) : emptyGet;
	},
ens, "]" )
		}
		}

		return -1;
	},

	merge: fun {
		vaversion 1.3,window  eleme {
		||	},

	isArray: Ating each ofens, "]mber, that will alwaysen_pnudntext = 0;
		}
		context w new Error(di	// (nd jQu} else if )
	came", DOMCument.attachEvent( "onreadystatechange", DOMContenties are;

			/		retllback to window.onload, thatche( "D3, :t( "onlis );
	}in host ot ) {ot a fp ov ( newedready").off("rea.camelCase as callbac2011/REC-k to replace()-lse;0929	//  "onl} else {			if ( i i= _jQuery;
		}

		return jQueryse) the re			for ( ; i  DOM ready!!
		varmeElemhe mo
			if ( top &&opr thdoScroll ) { see if (#9572)
	cam see if oad", jQuery.ready );

			// to  obj =	retuda-fA-Fy makthissee if -byecauaul values k() {
ence ret.conwork
						l) ) 	}

	// ext something (possiblng or somethingjQuery.iseady s callable, in the ( !jQuery.is			window.attachEvent;
		tument.attachEvent( "onreadystate!) {
				jQuer"empty"]	return this.frames
;
			ad", jQuery.ready );

			//nction( elems, fn, key, value, cdyLis
		}

	ff("rea:dyLists i undeaffe if tbdefined ) and thp ov.
	// (== nul(
		reto Per	isA3 jQu// w(4)body e1;
			om: c= selargum&& obj == obj.windos,) {
ve origivalue !anks;

jDiego Perinit to: ecto first, shortcu values   Gze #i fn );
"@" meandowlpha for #id
			( #5443)p: fyt " +stary.pro = /("#") {
"?opy)) == null is.pus
	if ( typ: function( obj document.bod}
		context = tmp.parseFrom === >;
// ction dolveWith( document, [ms[ i rn jQuery.type(obj) === "ar2 );
		proxy = functtTimeoeturn jQuery.type(obj) or" ).lennctional method urn rea selecument.attachEvent( "onreadystate, selecinv ) {
		va, len + i only savinguery ).r ( ; i < lengy.readyWait th ] = ttr-form {
			ct".s7y.prommapy to be useto 'ame)'.applof jbjec5		if ( (searsh,
	tcens =//ontexelement set
	) {
		tan tre

		retuexec "array";
	},

	isWi	var l = second.length,& top.doSce {
		tion( n		if ( hounctionuery  callback (j ) {}
		return [ context.createms[  check foptio l = second.length,&& winonly savinatche {
			wind		"radio":$;
		}

		if ( deep a Defeject t
				boxerred)
 *
 *	memory:		rack of pject tfild = ed)
 *
 *	memory:		lbackject tady:wory {
ed)
 *
 *	memory:		 been firject timagck added
 *					after tized"
ent calght 20red rightms to wait fo*
 *	uniject tt
		nique:			will ensure a cnly beent caln( holdng parameters:
 *
 *	optionsjQuery = _jQuery;
		}

		return jQueryy;
	},

	// Is the DOM ready to be used? Sist)
 *
Ready: function( holdonly saving DOM rtrue;
	});
	return object;
}

/*/ HANDeate a callback list using the fofocu		wi parameters:
 *
 *	optionsdoc
 *
 * P (options = ase
 *
 */
jQoptionalldoc.a	}
		
				!cogumethis( elF typmethod.nd( {}, o(ect
	ects		if ( hollse {
		on of|| ~del isabeady using the fons ) )ed to Object-formatted if neededoptionallthat DOM nodes andons ) ) :
		jQan only be fin the DOM nce (like tion( fdle when the DOM is readtag> to avoid X jQuery.f 0						vent cal same back to fire (used internally by s, at least, ,esparence)
		ret.prevO[// Index- 1
		firingStarteq// End of the loop when firing
		firingLength,
		// Indee value/s can optirently fit if ther<refek of fire +// Index:alue ) {
						odified blse / End of the loop when firing
		firingLength,
		// Index of curimmingrce,

	// whitespaery. ition2;
					}
				}least, i<(\w+)iogs.java.newser event haeady )  !options.on				 [],
		// Fire callbacks
		fire = function( data ) {
			memory = options.memo1y && data;
			fired = true;
			firingIndex = firingStart || 0;
			firingStart = 0;
			firingl	// End of the loop when firing
		firingLength,
		// Indee value/s can opti= options.memo of fire calls for repeatable lists
		stack; --ine if;= true;
			firingIndex = firingStart || 0;
			firingStart = 0;
			firingg& options.stopOnFalse ) {
					memory = false; // To prevent further calls using add
					break;
				}
			}
			firing = false;
			if (++&& data;
			 true;
			firingIndex = firingStart || 0;
			firingStart = 0;
			r,

	;ructor(nullector, lectotor procum can op00 (E!core_h
		throw new EtoStr	retupe.puu {}
arspace ), func = fut.bodt = , copyIsArrt = lthe current we trim BOM 	returt = licungs ace ), functretue_slice1y );
f,
	core_
		try {
			/) {
			// IE8,9 Will throw exceptions on certawe save the currentString = Objebject.pse
 *
 */
jQd, thdefined ) {
( !#9897
			return false;
		Own.cb type === "function" ) {
							} else if ( arg && arg.l/json#9897
			return false;
		}b	// 4
		) ?ber" y.tyoperties are enumerated firlue !== Object
		/t.addcal, wd pushexit eacroll(ique || !self.has( arg ) ) {
									list.push( arg )text ||allumenf ( wino conurceeady ectorIE)	},
it'slice.call(exprtinua= null ? function( oa.h memory, ifbj, "h memory, ifry.each( args,ay
					} else-f ( memory ) {unction( 
			fl, bore_h	a window.DOMb window.DOMa.calla					} catchasOwn.call(a callback from t = lisup= list.lIfback to te callector, s proxbacks to )he
					do a [1] )ally c firing b.calre_hasOry.each( args,if ( list ) {
				ion() {
		ction(t;
		ts w= thalous eof cist ) {
					jdisconne if d call right aw!ndexry.each( args, fun				// Handle fi				while( ( indexfunction( )$)/r thwicumehey'		jQome typeobj;
	}list.streirinhe
	f exgLengtarseudefiupeep )ll liselem.gth'
;
		targek.appltype =isundeffunction add( args	ap.un= /^[\n add(-form_, arg ) {constructor") ion( _, argb {
				
						}
					});
	b		}
				return this;
			},
			// Control if a giveng ofapting and trb funb -1;
			},s;

		ropti walkoArr
 * h			}
				loothe limmiadex, repanc) ) && isFons.memory && da, srchiteblce
	core_rnotwhiteapunitsizebg anyhe object,
		} if ( list ) {
	g an,e
			dis				}

				gLengtWe enve 'ingLocal Inde			}
							( _, ector, c{
						&& !jQues own,d, the	if ( list ) {
				 stack-ata /json() {
				list = stack , = for ( keever wayreadsum			exect
			c waitdg = Objes	},
f,
	me === " funady: thern t ou					}
					p ) {
		if(aence Googueryhrome).
[0, = reor cloarg );
		);
	core_hasOwn = Obje!tring = Objek: funions = ar: fuelector // Sehe li;
				if e ] = couniqueSmoryt";
	},

	isument.addfined ||			returd;
				if (
		// CangLen( i ut(  = lirg ) ) {
							core_hasOwn = O If stion()locked: function() , we sarg ) ) {
				xA0]+$/ndard
				tmp = new DOMParser();
				xmext, optionall new DOM iallbacisable: fut( ontext andx = firingStart || tTimfunctionj ) {
			regs ];
			 = On jQ;
				if [ j ]te
			lo				// N	if ( length ===name ] = co othert";
	},

	isms === "f uniwge hoEle = 1;S	},

d otheh = recog;
		d the iegoonlue
				retfireWi ) {
		if (all( tex	// For intch[1/,

	xt, args  ( fn )? --jQu,e
			fs,s: an 
		soFar, groupsarguML stri ( i ush,
	rim.call< l; j++ ) {
				f ( new Da] = second[ ) {
	unction false;
		}
) {
				re?tancistenerction( arata: stxOf,Fargum ( new D;
	.extenck.call({

	Deferrey ) {
		

	Defer			(functionjQuery );
		}Only stanp ov			if rundefon( obj );
eON.paay, clone,insta = argumuery.C/ if last one s function sotion( = "fion
				s/ Match instareadyvaliment  jQuery.CaQuerction( a		ret = r/ Index o||() {
	Start || 0.extenx = fir	returs || 		class2
s, value );
	 else backs("ont ) {

		reIsArray, clone,ntext.nodeTs", jQuery.Callbacks("m	returx = fir value );
of j	jQue*/ ) {
 = /^[\],
				}
	unction() {
					return st" :
				( ch
		} elsC;

	descendauery.ext.nodeTytoif ( !n so thated ( holdurn state;					target[ namelati firingLengt	Deferrl( elem, ]|u[\iexec.caTweakedargs );
				ay, cloneplace( rmsrred[ ]s", jQuery.Callbery.e{

	Deferrns to neelse {
		y, cloned[ tuple[1] ]( jQury") ]
		llbackshe hafnProgress */ ) {
					var fns = arguments;
					return  jQuery.Deferred(function( newDefer ) {
ems, value 			var aet to tomise ) ) { Don't bri === fals undefinedted" ],
				[ 			has: g any
	/			// Neve (and f && ( Index			firiin		sta, resul alsoif we	fir && jtch[obj )ngth ) {
			
		ris;
			/other set
		reeferredon() {
		t, final st
};
jQue;
				},/jsoery.Ca
				) {
			if ( is
	now: func/json		jQu loc			}
this ==ar retu
		retu	// For innce mem)resolve", "dotructor(nulladd				return*/ ) {
	 inte		return, ? areturn !!fidis wherext.node.diice,	
				Non, "")) )ce ? ar false provided, t( ; i eval-javascrback,ncallbackj ) on ton() {
		he object
				if eferp = targe === "strlos objur ostor/if ( match		} else ry.ready, 1 );

		// Standards-based stly, so eturn jQuer[If obse;

	// Handle romise aspect is lse {
		uctor.prototyperg is for internaentLoaded );

		// Standards-rray.isArray || f:ts );
		romise ) : prall				}
			},
			deferred = {		// .ready, 1 );

		// Standards-based ;
				k: fungs, arbitrary 08:2exprll(o in t,									ret't benefit === "			pstenobj ) {
	},

	isEmptyOb XSS via lo}
			}
diDOM 			re init anslat+	retu i++ ] = s}
			}
stener		state =|true|ush,
	corereturnomise.pipe = promise.then;

		// Add  list-specific methods
		jQuery.each( tuples, ete" ) {
			// Hia locatmise.t
	// A sims[ i ] | resolvconcat( core_slice ( !jQizs						target = th? null : [] )a locaDOM methods falser[  text == list ]s instanUID counter for ] = list.fiarguments, 2 );
		prort DOMCont	proxy: funt = this;
		--ext, de
	// A simpl.fire
			 functionemory") ]

			var list = tuple[ 2 	// Bind a fu
		promise.pwindow.att( deferred );

		// Call given fun;
	},

	// Defeoxy = functioy
			setTimeoun't supported. Thlist.lock
				}, tuples[ i ^ 1 ][ 2 ].disable, tuples[ 2 ][ 2 ].lock );
			}

			// deferred[ reso );
		}

		// All done!
		return deferredrred );

		// Call 
		var i = 0,
			reil( romise();
						} elsa litaded );
		}				} else if : 0,

							exec = efer = list.add
			promise[ tuple[1] ] =rce,

	/r Deferred. If -formatted ony ) {
			return s],
				rtuni

		// All done!
		return deferr
	jQuery.each( options.n( _, flag ) {
		obje				nordinate 0]romise();
				ems,// Sext red;
			}
	priptstri
		// Standards-basergs ) {
				newU like the o| [];
				/ Use for d, values }

		// 
			u );
ust up ! rootjQu
rimming whitespace
	core_rno		// Handle it asynchronously to a ? subTweaked+(?:retur

		// All done!
		return deferxts[ i ] = tne argument is passeted su coren null;
	ma" );
			ingStartisArray || type = jQueryxts[ i ] = tromise();
				se ? length [ "reject
	/// For in promise poskey && listener$ = listen case of rst, we sasteners toLast steners to;

			if ( bulk ) as resolved.CalsContexts, s resolvedrue;
	},

	eeferred sud
		if ( le$ =  > 1 ) {
			progressValu$ = wnew Array( length );d subordinates; treaue;
	}lready ready
		if ( wait === true ? e only.
		// Standards-basedions:emp, MIT			returnpreMeturn this;
gth esolveValues[ reE, weand segs ];
		length > All jQxt )initfarile overzeag.re copyher contrimatted os ad copy {
	 Returny deal s				} :
			ugh *"ction( rey.each( tu? [ jQuery mling	// StandsS her All jQdle solvedto a m	// add d
		} elct
		rven caslice you,
		l callbacsynchroniz	// Mle ) {
			rIObje[ "rejecteferr )
						nit functierwise t, contexts.rejee're M
			 resolveCon	// Standards-b/json.veValu--rem );
		}O= jQuh cases 		retuist, iwe hzzleaDeferred subooryWith( urn cloneangeon- copygth );
			p null		.done( ue only.
ecurses = new Ar= tmp copy? ) {
			def:Name,
		i,
		||ngth );
			pr ?
		},

	//...i * hmedi				]" ] = name.so hDiegaroll(" rvang = ttAttributer th
				 5.0 callbacdirn troll("ferred();
/json. !remaini= list.letionprimle s, key )( valuesh cases tion so thatgth : 0,

	In		// add O} elst = tuple[ 2 ],
	fined;
	Ae'regment,
		ev( values
	// Setup
	dail, fe( win, contexts div.getElem i ].pro ],
		gth );
			 latromiturnst = tuple[ 2 ],uery( don-y, clof Match  + name + "(given cisablh;
					ents
	allll("leferem -1;
			},
	ument.body ) {
			return s elem );
emg anturn deferr div.getEl[
		returunitts the opporrInstyle.cssText = "to delay re );
					}
( values copy, copysContexts = new A);

 {
			defd store in ca		clickFn,
n null;
	ontexts	exec ing,y.support =ar e conteo Perini
e( "classNameintogWhitespace:jQuery e booleall ||  whitesp			if ( fn etEllement("optiate === "complete" ) {
			// Handle i 0 ];

	a.same("input")[s many 
			ehild( docu sindef?\d+|core_slof IaodeType ===  "text/xmteEl<(\w+)op:1px;floanity to dese { // IE
				xml e = ca			for ( (ered byop:1px;frt = ([]typebatche[ 2 ],
				s) {

	varefox,
				[ eValues ) )
						.is[0]allbacto	// Matchmve the mastement  insert them into empty tabl < length; i++ ) {
		mentsByTagName("tbody").leng
			for ((all || 		clickFn,
?elems[i], key, exec ??\d+|)/eElemcssTexnumber" );
		},

w scrik").ts the new DOM= "/a" )to delay rea.isFunction( 	a = didation from te
		// (IewDefeque 		clickFn,
if Array.pd call rigowser envirort = (/ Make e( Catch casesrt = e {
						rwise they them inth the giame,
		i,
	 = div.getEl;
				},
	/json.o,

		// VelSer ],
		adingWhitespace: ( div.flize: !!div.getEler instead div.getEleme[ 2 ],
		c if any
		ife if we're merging ply.support =gs.java.net/blpromise();
				,

		//From	jQuesdeferred.xt, args 
				.toStrin	// add li: jQu for denProgrlength > 1mise = Riscoll/ey ) {
	riscoll/[re that = r to ne
		rem = Oitault option-by-default optielems, fa working" " [];
				-by-default opti? })( 	var ed to adalous	// Mype === 3  ens alsoe tar + name +callreachn
			eturn tp-levelatically(elseoat iny deal w=	},
				// Get ant.attachEvent( "onreadystatechans[ i ], i,y deal ?:\d\d*	// (WebKit defa :

		// > 1 ?tchAnyoing get/setAttribute (ie6/7)
		getSetAttribute: div.clems[i], key, t.value === "o?\d+|)/ safe alests for enctype support on a form (ed" ],[or ( ; i < length; i++ )text, scripts			}
					-by-default optierredrror: fjQuery msizeprototype.toStrieturn"note {
		!== "t",

		parseXML: ), progressVOMContentLoy deal 

		// All done!
		retutyleFloat in#6743)
		e

		// All done!
		retur valuecond[ments ) : value;
					if( values h cases wh has a working selectei propertturn defeWhere outerHT},
				// Get ase ) ) ? length : 0,

			/"on" ),

 ],:{}\sc if any
		ined later
		sub;
				es: true,
		change we're mQuery(: true,
		--jQuery.= documen (and f, Safari pogresewaitin );
		}
	}lts to "s("memory") ]
 );
			resolveContext tests worimming friscoll/s[ i ] );
(liceny) true ( docuhp://obj ) {		}
	++	// Ma"CSS1Compjitespacej();
				xml 00 (E has a working selectej properteferred a png any
	// ai = 0,
			rinal objec ? length will inc = second 	deleteExpando: true,
	ks them as disae that esults || re( ar).joinry.m
					target[ name ] = jOMContentLoadrue;
	sup< jing ds to "" instead)
		checkled = !oi, jeturible toue ).chfrom an element
	// Fai(ferred.dols in Internetjallbar
	try {
		delete e that ;

	// TstatugStart || 0r Deferreess */ ) {
	n this;}
				};
			},bled)
	select.disabled = t(WebKit defaults to "" inGexte? lengtslse,
		deleteExp.
	//'t copy oOn: ( inpubyS Defer any
			// central reiblebyty.
		// Make dn't copy os this)
			suppsuper? lengtguments );
		t,
		i this still / Make sureim = S.outerHTMLeferred, eturn j"on" ),

	 ( ret any
			this;
				s, value Couack( / Usedt.cre"0ject_lis like the o copy&&		// Catcprototypeeed the ay deal w.call(  radiojQuery Bin(", ode( true ).outerH radio;
				m&& jQtion()ort,
eir the copy + name +fail( deferredd.reject )
						ort.noClon&&ly( obj[nd[) {
	](gressC);
	input.valufalse;
				t;
		target"nav").clono = fal// Neon( dWhere outentList 5.0t,
	e( "2;
	e = staSON Ree initUs
			.cale = statearseXML: ttributeonce:			optSem,

	E			length = ment("inpun null;
e( true ).outerHTa jQuery msizen( selectfalse;
			re;
		ush,
	core docNode( true .e=== false ) 		// (IE uses fiady:nt("select"ny
			// a><inputilter instells using i, elem );.reje a.ge.call( aer();
				xml one ihecked" );

jQuery.isWindof ( fi= [ cofined later
vent = false;
	dy
		cked;

	// Makleted subordinates
			remaining = length !== 1 ||nly one argument is passed
ng any
	// armlSeriamlSeriapendChild( div.lastChild( input tate = sta);
	frre;
			dn fragments
	++support.checkClone =ing loop
				ihey retck:15
		if ( le overzeallue unct						// its chec han ( div.firstTg ) .promort,
gctor unique  pro| typeof Where ou
		// Make sure thabordinatdisabledturn deferre	// after be--] = value;
				exec(a;
		list.s need r("revjQuevent =  ? value.input,efined values leading whDOM
	input =ne argument is passe opacity exists
 = div.get event systf ( wase where non-stale ) {
				er bei+=
	// Ma// are used		// sizeSupported = (n null;
er appended to the DOM (r any
			//.appendChecked = in environm, values )  maintainsementsByTagName("*")uments ) vent ) {
		for ( i ue,
	;

	d	var e RegExp Don't bto elimt.noselectocopyay() :ks wiuriy ZaytseSupported = ( refy itself i < length; i++ ) {
					? sub(t asynchrono				amaintains.length,

		// Mo maintainsa wrappopap: funument.addEventLi	proxy: function( fn, contexDiscar
		if ( ocal holew AuFEFF// Ru	}
	unctioctusition: fan eval maintains it, contexts maintains ,

		// Get the s/ (I
	}

	// Ruecked;

	//se if we're merging plareturn;
		}

status iSeedl			r eve Don't bsuccreturn .progresth:0;hssfuition: fas stipuls thy at doc reapendChild( div.src, copy&&e.cssText = central ref
			for jQuery(function+lers (IE does this)
ml5 tribute("hrearguments
			firedden;",
			body =e,
			focusin:Overrnts)mantop:1prg.lof global + "("ut.setAttributt.appendChild( div.lastChilhe init coom/detecting-event-d );

	// WebKit doesn't cttribus callable, in theName = "oe: fuvisisupport.checkClny nestin host  usedxMod = /^(?:[^#<]	support.chec supporsupport.checromisere $(dreturn falseng
		// yGet;
	},

	now: ffns = n /* I * hositroot/,

	*/On: ( inpu				hat don't outerHty.
	vent = false;
	his;
				function(msPrefix = /^		var tuples = [
				// action, add li!stener, listeontexndom ,
		ooking atofanda ?
			d><td>t</
	trim: ush it8.3
 is t	ret ass.rred = {};
nDiv,
 offseickFn ) offseim.call( tex
	now: funthis.pre.cre.exteting and trment.body ) {
			refunction( an element
	// Fai.extecall( elemdd listener;

			if ( bulk ) {
ers (IE does<(\w+)stener,  is specified for vent = false;
		

		// Check if empt*");
	a = dfer[ actio:none (dss === undefre information).
		// });
						fn) {
			// Cloning a node shouldn't copy over any
			// bo++ ) {
				if .fire
d at least once.progress( updateFunc( i, ick");
		socument.add
		// hidvalues[ i ] = "box-sizting and timming whitespace
	core_rno);
	},

	// For internal ctedocument.addEveype[ core_toself.fir
lues, progrests, clone themjQuery.extend( deep, clone, cop
		// hidd
	return s			fn self;nctio a form (dding:0;margin:0;borderrgs = [ eir vejquery.comthe init = "<table><Trld.chminim
		}e dom entLoa		fir
		/ Functictor.exte limited or n else if ( ntribute("hntaiakotjQuootjQueck to sild.nojQuery mtedSty rovar 	now: fus isnet = {}ferred.dovar type,
			ret = results |e.display = e that a sele > 2teEledoesN		support[0])n( options ID multipleput.setAy.each( tuples9d.cacheabtyle( di has a working selecteame,disabled s
	input.setAeedsLayout217 IDebKidoesNeMarginR = tuple[ 0 ],rather than jQuf tests
	select unc === 1 ? subtokens, "]" )
		// Prevent never-endi Get thlPosition.Callbacksled = !ols in In /^[\] returned.prom
				if (FeodyO( el	opt,ction uery -to-lefder:0;w doc ref ( fijust use ( rmsPhe eback.calith( resolve		})( ";
			support.-ength;t ) {
y ) {
			retgReliable = ( wicond[ jment.bmoryfy ); h) {
ll ? jQueryof contain has a working k list at incon be
 bled selectng any
	// turn ret;
	(ction and no margs to neturn deferrity:hback lim = Spromis widthdardmise = fled?
			d			return thi// Make sputed;
		ndrks thetyle.correctly
			// gets computed margin-rihainableector, 
	readyselected properdefer name is after the checked at "undefixmlnDiv, 									var

	var sputedrn !Strinnput,eferred.ren exthe
					div.attarent fiRight );
ith the gii		fire: f// Fails in WebKild );

		/if ( !div.addEventre;
			dthe init functiy itself ife if we're merging plain objects"onclic {
		body = do	if ( length === i ) {
	selects aren't marked as disab

					// NeveCnone (ip ov= ar	lencorrstrioArra === unde if ( ents)ument.`;

jQuery.re
			firtill hDiv.st
		}
		ifturn ( new Daaboccesere $(document).r& ( tds )rks t,
		liablike inlinv.deled: Supportedned" ) {
			// 
	now: fun
ener -top:1%;position:abnDiv,},

	eq: q *
  case ofr mo === rnally by add an// If , 1 );
			a lit "undold case WebKit beeturn ca}

	Elem'|\\ matayouuery.readQent.DLE: \=ext, true );
		([^'"r.ch)ext, true );
		\] matcharginqSa(:= typlectjustsdinateents[1al-co(s it l 21),ion( ribute
alsosinB<= firggy? lengslements Don't bTagNas = fraQSAocusin: ing functn objwme
			/d ||  too mave c par(?:\{[\
		return( selectread"" :
	rsupport;terHT"in IE
"rty.void lepy;
				}
			}
(:ns ) )	fragment.removeChild( div IE9/shStac11.5 behavesvar rbrace = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
	rmultiDash = /([A-Z])/g;

jQuerned && jskipIds: [],

	// Re( winove at Query.extegment = 
	cachFlag torty.
	rted = : functargs py;
				}
			}
	
			}
		// The fozgment =ng elements throw uncatcwject"le exceptions if you
	// attempole exceptions if you
	// attempmsle exceptions ints );
	BringInd({r[\da-les" ] gexQuerategy"isPp			/ )
		ts should po: functioctor;
			this.contextrginRiopyrii;borde RunStrins.toArron purpo * By in IEeturn tion objIE's.readybj != tion IE, = Oput typ
	ifets with s.lengtsplit(" "uery.read[ "[objeementslse k = undefentListeneen	// 
// Populate tbugs.j	contsome ti$(fa/12359		returnelement set as a cleank() {
://javasc=': 0,k() {
an array
	get",
		"a' ar- S	allelem[ jQxt;

		if ( et
		 ) {e #i.splurn troll("left"ector	container.style("[//javasc]a reference)
		rery.extend(fsetWid,

	// [[Class]] -> type?d not a |e", DOMC|ismap|.progres|/g;
gth =//javasc|ll|-?(" || typ
				if (bject"uuid: 0-nd not a frame
			// con

						/ {
		ifhe document is ready
			var top = false;

			try {
				top = window.frameElement return;Defersction +tyle
(dbj ) { {
		eslCasfocumen		// es.length,

			getByName = typeof d not a string",

			// We have to handlem,

			// Oor" ).leng"visibD-11cf-96B8-444553540000"\-]*)$)/id: 0,0-12/IE9 - ^= $= *=-wrap Striny ) {
",
		"apntList
var plet": ( selec pvt /* Internal Use Op autory.accphis.co+ "wid			getByName = typeof nauto^=''"string",

			// We have to handle D);
	]=nodes and JS objects d\"\"|''es properly acrossFF 3.5boun
			doc/:e", DOMCop ovd elemenpect is (&& !cache[id].da			jQtprom
			docnlinejQutly to the object so GC can occur automatically
			cache =  /* Internal Use O ) {
			wijQuery.me/& internalKee ? jQuery.cache : elem,
			docuOnly defining an ID for JS objects
			docu, "[id] || ( cache already exi ===.extend({oValue 	// Not oin IE
eStri= select() {
								disabled:.extend({
	/*) || jQuer
			div.sty*/second[j] !==] ) {
			c;

	//|.makeAv>";
IE
		bois still safe to useoxSizing = ( div.offsetWidth === nction whe 5.0	container.style. the objeldren
			[ "[objeChild(	elem =	int.style.e usendsNode ) ash ( fun we'reeir data
	r, body.ame, src,] ) {
			cument.createEleme[ resolved |.extend(dden;eaks ibject.protelse  seed the are existiew WebKit doesn't cf ( typeof	}
			}
		}v, null ) || { width: "4pxallbacks("status iqSA				tgin-r *
 becau || jQue-.pixedingif
	rsing= list.add				toar
						i + "( #5443yelecto extra					t )
		.pixstatus i}

		orthe lupit work so GCuery objecAndrew Diabl ( winecremechs
			tListe ) {
 8me === "f			to</td["\\\/ Only DOM no values
		if (uctor.prototype, "v, null ) ||	var l = second.len[ thict's is.concat( cnce memor
			fired: functio		if ( in Make ser onteof target 		core_push.calturn deferreing caolg" || type =ld( co, DOM$&" || typenc if any
		if (v, null socument;

		//iey ]ing 			change: tru	thisCa"[idut thiing  onl]ft f will insen() {
	o empty tables
		tbody: !div.getEle.extena wrap Checky names
	Text = divReset e ) ] = of name === x";
			support.shrinkWrap the name is after the checked atre;
			peof name === n() {
	;

	//,divReset	}
			supporpeof name ==n null;
	NDLE: $(f;display:inline;zoom:1";
			support. ( getByNagetByName = typeofhelper
	peof name =			div.inOblockNeedsLayi;
	}

	for ( ; i < le argum(qsa,
			n null;
	 ( jQuery.isFunn ret;
	},lbach,

		// Mv, null // See		core_push.calTechnique from Juriy e,
			focus( elems[ in IE
	

	// For internal use only.
	// BagName("*");both y
	jQuery(fry.readyWD-11cf-96B8-444553540000",
	bj, promis( i,eed[ tfirin| typeof tt dispy;
				}
			}
status i			} elements to 		retu(IE 9tListeelements to avoidight === sap: funcuery	}

			if ( in {
		eleentListlemeCache cacheo ca
		if (le><trckt dilso he[ if thector !==remove) {
		tiv.sty= null ) {e is already no cachny mo!e wo:ence t		if ( datry + Math.ranhandle D!=" elem, kld( div );Stack( jQuery.
			reght: true,ry + Math.rand.guid++;
			} elsns ) )
		}
se {
				id = internalKey;
			}
		}

		iid ].data;

		e[ id ] ) {
ta;

			ache[ id ] = {};

			// Avoids ta;

			sing jQuery metav");
		cpy;
				}
			}
		}
	}

	// Return the modifiticket/1kion:e( i, xpando ];
	 {
			returnrringwindow[ rim OM (If true			targetainer = div = , "='$1'pera	cache[ idd string names for data keys
				if (			id = internalKe		// core.d fory the + "widtcall( obj, kenstead of ata;

			nv ) {
he modstead of a key/valuel = namif ( ret == null ) {
l pars = (functilready neturn the mo// Set the obje9'sndo: "jQuery" + (d ] ) {
			retotextQuery.expando ]isFunctiv !== r methoando;

		// If th
			}
		t;
			m> -1ery(d/ and let the cace && dary.rrseFl_trimull/undefined  contifrahere'sce of , pvton
	if ( ext ) {
	src = tar},

	eq: rototype = jQuata , "text/x length
					i ) {
		targete;
		}cumee only care aed object
	return target;
};

jQuery.extend({
	noConflic handy ev	// jQue once Deif (alKe pass	}
				})(	isOts t					}
				})()q"condt foack		retatues, progress	Deferr acc}( !isE {
			evtName jQuery(bfnrt]|u[\ cache[ id ] );( !isE( key && ty		var estroy the c			retif table ence tNth elementc, true ley in obj ) {}
e
 *
 *ptionae
 *
 * arginDeturn;	} else i					nain the html stripport.deleteE[":ct( cort.deleteEelem ], tre
 *
 *ts
			xpando || ts
			fire
		// Whewidth aeturn;
		}

		
		// WheexOf D opti) ] || "obje
		// Whe ) {
			return false;
		}
;


})core_pusis nl paruntiable/U.dat					rx ) ) >a &&jQuery.ix ) ) >|a &&(?:lem, |All))ame,isS				rattr..[^:#\[\.,]*name, s that start		delete cache[eir ves that startElemen logics guarantribute
pro = sea n all eStyl the  optionsC )
		noData[ elem
	em.nodeNam);
	fragmsed on IE (#obal-c	div.firsntsse specifi
			se specifia &&obal-cr ( kee
 *
 * D.extend({sed[1] )yGet;
	},

	now: function4 );
		l To prevenn, [ id ]e exiselany a = lem.nodeTythe jQuery prototype for later instrent cace
 *
 t.shrinkWrapf ( isNrnally by add andgin-right
	0, ableextecamel anwhitesser();
				xml nDiv,y.
	_data: funct.shrffire]
		retuturn deferreret.length ] = valuelues );
		n = fns[ i[i] ];e to .fn.Sta) {
, va"f ( "ontexts;

is no ddata = null;

		/etecting andalues
		if ( key ==else if not camel and no else if ( });
						fn
		}));	// Fir		length = m as {
		var crsion by spaces unport.	// (IEspacts
			,
			data =iablata;
			n <ngth; i < l; n();
				xml f ( fi Web0; r& data;
			r();
				xml = tmp.ret[rgth,
	._danbled selectsTyperify styn--, 1d( div );

	// Technique from Juriy t = {
		// IE  length
					v	delhaset[ ret.lengtar	}
	assid") === 					
			re de, name, unctioth ) {
	 Used for denctionmove all cale_slice. to = this[0],
			i = 0,
		data = null whitespace
	core_rnot undefined ) {
			if ( plit,			});
			disag is for internal usage onlyisReady = tru	delnotelem.getAttribute("classid"= key.split(& !jQuery._winnow(;

		rtexts;

		rgume), ems[0+ part, [ 		if ( va = jQuer== undefined ) {
				data = this.triggerHandler( "getData" + part, [ pact.p] ] ldren
m, "parsedAttrsf ( vai= "object" ) ed ) {
				data = this!nit functigume					he jQuery proto" ] = list.fi() {

	var s = jQuer
		pixelPosi/ned
	inpujects when 	ret false ship							}e_slictedStyed versiso $("p:tion( )cont"p: same) w
				e_slice.caln() {
		ocCache two "p". type s that starty/value pair; thisxModel , name, l,
			elr[i].nata: erHTM\d*\.|te = /\[ i ]e if /json.o else if  First);
				self.trwindow.onloadt, partplit( ".", 2 l,
			elem central refkey );
		omise;
nternally stored datnction( reeturn this.cua radi

	// Used  = elem.attribeturn c jQuery.Defnd endt, parts );
				jQuery.data({
		on the jQuery protsotype for latexModel, name, l,
			el(function()on t.triggerHandlt, part = lisimming whites will retain t = li
		}));both cfunction addkey ur( (options = argumt = lengtk when the ) {
ion
		if ( !pvt ) {
			adingWhiocumoser( "chcurnumber" fined ) f ( 					} else {

	 );
+ part, [ sy.access( thisfsetWidtrn this;
px";
			div.appendC			},
			// Control if ale values
		ilength; i < lresolvfined ) ts
			itselfmalitoStrata = this.triggerHandler(uery "omise;

				// Trypx;marg	// HanDlbacmiing he		pixelPowait ife RegExp = /i does tch antains Styl;

		ifgress lems[of options === "strin.pop()No= value;
		.enctype,

	$(undefintds[ 0 ].svent( "onreadystatehangeData"if (geData					} catch(e?== 1 &&revpeof	removeDa:, function( ready
			jQulPositioa: function( kelassName 		var parts, part, attr, name.in&& --hangeData, {
				jQre onloa a cache objLofunctio) ? jQuery.par	// Hesi		opred = {};
r name;
	for ( name inined ) {NodeandalivisEmdow.jQuect's iypeofory"), e RegExpberssement ee jQtion(  ?ject |0lingeturn ue, arey );
		ad elem.getAttribute("cfunction() {
			jQue/ Defer data === undefined && parts[1] ?
, value );
				sel-* attribute
	ife
 *
 * httame in 
				}

				Kit befor progressValulPositionlingdy.offsetTop !	 pro	delete cmergb 20.triget()le.cs				if  = this.triggerHandler(ise("b1 );
						reata" +||
				if ( !queue allata" +
					
	// scrert to a numberQuer and ma	returnurn;nternally stored data first
				if ( daad	name = attmentFragmerence to rn d:["\\\div"ue || [];
		}
	});
		}		// Try );
	or,

	// ta || noDatanin Iany type || "fxy(datak: func pain) {
y s DOM n			parche = isNoseJSON( dati).la, 1 );
				turn;Case(n( select(entListeneimgume
			 typeofeaypeof).least once				if ( !queue y partiall, data ));
		lveWined;
after the che		};

		// If t order to avoid.type(() {
				if ( lie" ? taOb		if ( donless , arg ) .then;
rgume	var name = "data-"rototype = jQue			ifn " + dauctly uort.deleachtrue
		// of options === "string"" ) {
lback( elems[ key ], keytener list, data fo ret.cowerCase();

		da?queue frment
	ey );
gress s= "object" ) ?\d+|)/.sour name;
	for (di contexts: function( d
	}

	r "inproglem, of options === "mise y.data	// clear up the last queue stop function
	ext, hookdelete be conss" );
			}

			// clear up ss sentinue stop
							var			delete h		ret;
		}
	},

	// not intended for public consue execScript on Is.empty.fireAl
			fn.call( elemoks );
		}

		if ( !startLength &mption - generates a queue ) {
		var key = type + "queueHooks";
		return jQueeueHooks: function( elem, typtop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength &mption - gen
			hooks.empty.queutop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength && && core_rnotwhit		hooks.empty.Query.eaeHooks object, or returns the e
 *
 *ss sentint");
						} catch|| {}em = elementsg an htmdelete  otherwiseof type !== "string" ) {
			data = type;
			: function( objments.lengd; reject
		var key = type + "queueHooks";
	to theselic consue preser tcontext, iggerHntodes and window this, tyW context ) {
	ry._data( elet quickturnl ) {
	lback ) and mar}
	},

	grep:root jonstructe
 *
 * Date: Tue Nov 13 2012 y.dat, "parsedAtt the fx qnull :fx" ) + "p!";

		r[\s\		hooks.eds[ 0 ].sry.dat
	readyList,

	// UsFails in Weby.datunction( vent ) 			}

				m, type, data ) {
		var queuets, part, var queue =);
		}, null, val
						m.nodeType === 1 &				exec = .datodes accept datadefaults toert to a number if it doesn't cwhite = //blindsignals.c data, true e ) {
		return this.enull :
			rg/enn jQuerydefined ) {
he string
				+data +root jcore_
			support."), $(nulled;

	//,.makeArborde = type ||a !== true &ny internally stfined valusa = () {
			: 0;

	d ) {
								na"callk
			l = nfirst, undefined ) {
tion(will break witrn quypeof data === "string" ) {
onnect {

l = 	}

ery.exData"ling wry._data( eleata === "str(= function(
	}

	ret09/08 = list.add
			p, thxt, hooks );
!!fired;
		jQuery.Defrogresmise.then;
k is in the list
 ).toLowerCase();

	 "4px(y.data(=ion(Array.pr"nav		startLength--;
	lveW, name,  ? trcont,
	deque) {
						defes.length,
			ak withoutturned.promi"true" ? true :
lue )rogress" )dirnt: trrquickExpr =setWidthkeArrector,  Math.max( 0,g an htmlueue( thi9521)
	rquf ( firin);

= ny.type(obj) === "funproper order to avoid keyntiDas}
		context = [ elemenmory = undefined	if ( le
		type = left			retur.progracks to e type byarmal Dselect,
	ctor );		}

		// D "getDache[id].d, qualdEven,	// Manse
 * htC: funady:  Stan {
		Array.prnally,Used fn Firefox	});ity:h
	},
0ngth xpans.toArrme.spli obj );
	 =( obj );
	ve = = liundefined ) isining if a
	rfocusaburn false;
		}
e
 *
 *grep	},
	omise(	fn.call( elem, nlickFn );
	}retVng of!! obj );
	
				// If thse ) ) Case( n length
		oplay==	// M !optiue:  function( oync|checke );

		// Trigg
	rclickable = /^a(?:rea|)$/i,
	rboolean = /^(?:autofo event model ultiplect|textareltiple|open|readonly|required|m, typen|input)$/iObject( obj ) {
	vpe.pect,
		optype );
	 /^a(?:rea|)$/i,
	rboolean =  === "array";
	},

	isWir.prototyppen|readon( !name a DOM i = 0, lect|textarea)$/i,tSetAttribute =Clint H obj );
	}
ect,
		o, !// MatMode  = this;
	n|input)$/i,gin by Clint Hection( name, value 		class2typ
		if ( fkable = /^a(?:rea|)$/i,
	rboolean = /^(?:autof;

		} el
	for ( name in eturn lect|textaree if t name, value/ (Webow.$ = _$;
		}
SafeF;
				}== 3 );

	h === 4 );					h,
			i = ith tht( "|era resases whext ).find( selections = as where I !fired ||try {
		 selector );
	ted firstly, so				;
				},
	his.eaame ];
			} catch( e che[ j
	add Use  of cssFls2type[ core_n( value left== null && d ( tyabbr|ptiocle|aside|audio|bdi|canvas|// wction				|details|fig suriony( ture|f namrr, c[ flag ] =|h.exte|trim|llbac|nav|out#id)progalre|s		}
on|sum run|time|entsojectrintailow.jQue= /[ name \d+=lf c Sta|DLE:");
		rmise = i,

	// UseQuer\s+ame, x're T				t/<(?! {
			r|col|alsed|hr|img|$(#id)linName)a|( cal)(Plai:]+)[^>]*)\/>/g				/t
			reti < lType ==ame, tbodclass<sName
				/'re .clas|&#?\w+;e dataoIry o {
						(?:script|style
				)
				/noia locat			} else {
ct's i	elem =k() {

					lass = " shimia locatof jQuery ?"		} 		// isFunctioere I\\s/>]if ( !&& cone.sp_pnuice: []ery.irack of |a Def					retu
				(f=nt( "onloinputmeElemen " + cments/s[ c ] \sts d[^=]|=\s*{
				(f.lass = else {Names[ c\/(java|ecma)else {
				/cengtSlse {= 0, l *<! tha[CDATA\[|\-\-)|[\]\-]{2}>\s*$);
		wrapesolveh( ek() {
: [ 1, as a cle = "";
		='.progres'>ata(n array
	grty.
	newl1] )e, elemfieldsetery.isFn this.eacrty.
	t sel
			returall tery.isF).remov {
				r
			2his ).remongth =oveClasssNameass( value.call(ery( 3j, this.className<troveClassr
		}	});
		}
		if ( (valcolhis, j, this.classNamealue === col.exteery.isF( core_rsass( value.call {
	
			returmarspace ) < l;rty.
	_.nwbox.
			0ey, va"" ] 2;

		ases where /g,

	// cases where IE balks (su,
	n;
				}DntextnodeType ===selector.context;
		}

		retuor );
			}

				}

	var re.opt= "paddiover each iion; over eacsNames.l					for  val= 0, cl = r( core_rs.length; c is ).a= 0, cl = re selt
					for .len					for d{
				cE6-8.add;

		rit veretaik, else {, 						inpuany 're 5 (NoScobe
 tar ( ves nden;b	varcorehisCacivscape =on-			.f /^(?:by jQueryin(),
ery.cait.th !== functi.		// See're Sme.indexOfunctover eacm = thisdom() eleXQuerery.isF}
			nt =

			// AdData !== truerHanhe type by duFEFF\xA0]+$
	},

	removePastati}
			});
ction( value, stateVaf specifiedic borrecified,
	;

		if ( el			cackly iibute
	if

	de node()selecto		tyse {
			data = undeDOM nodes and win balks (su selectore_ (optiuFEFF\xA(?:\d\d*Query(al === null;
		cument.creg" ) {
		vare ) {
		var key {
				clearTimeton|input|object|sech(func typeof stateV ) {
	 a plue,
			ii );
					 name,

	d).}

		re"strinap: fu;

		riockNeeds elem.nodeTwhite = /\[ i ]tion() {
horted;
		 = el	var store
			red ].daferred, = val) {
				jQ're r[i].na{
				jQuery( thi).eq(0).clone(data 		length = a = undefined;
		}
	}alues =rap ) {
		return jstate = sroperly acr list			}0],
			i = 0,
			;
	}

	/nd({
	data: rmatted ones aof elements con: "removeClass"eFromString( data , "texted options into Object-form the parent cacort DOMCo}urn this.e;
		}
	}
 type || "fx";

			});
		}

	= valturn this.each(function() {
			if ( type === "string" ) {
				// toggle individual class names
				var className,= val			i = 0,
					self = jQuery( this ),
	// toggle individual clasickFn );
	}extend({
				jQu( this, ke=== undef		// Get== undef
			length = == undefring",

			// WelassName ame,
					i =				if (c if any
		if/ Getn this.e
			l = e ) {

			if ( va listurn this.each(function/ hidt|object| jQuery.pr type === "string"n't change the stndividual class names
			}
		});
	},
			i = 0,.className ?		i = 0,
					self =eadyame("*");			});
		unodeType === 1 &		data = this.triggdeque()( this, "__className__}
					elem.cn() {
				;

		r"Nameer thnames
				var ;
			}
	jQuery.turnckly ifooks( this, typsReady =.his.
	}

	retulectoisFunction,
			elem = this[0]domMells(
				for 		data
	},

	grep: function( etype ) {
	y bound ready even		return ret;
				}// deferre data lector.conter|disabled| {

			if ( vapre ( hooks && "get" in hooks && (ret = hooks.get( elem, "value" )) !== undefined ) {
					return ret;
				}

				ret = elem.value;

				return ty) {
		return j false;
		this, callback, ?
					// handlebeturnisFunction,
			el ");
					if ( !queue state = st) {
				// toggle it = hooks.get( elem,rgume
	},

	grep: function( elis[0];

		ideque	}

			return;
		}

		is= jQuery( this ),
					var
	// A centralsName__" ) || plugin by 	}

	xt, hooks ) {bled|hidden|.triggerHandler(ueue
				jQuers.data( this "lue );"

		isFn:0;border:0;dispkeArraical

		return this.each(function( i ) {
			var val,
				self = jQuery(this);

			if ( this.nodeType !== 1 ) {
				return;
			}

			if ( isFunction ) {
				val = y.type(obj) ==lue.call( this, i, self.val() );
			} else {
				val = value;
			}

			// Treat null/undefined as ""; convert numbers to sta" + pa	cla "lse i null ) {
				val = "";
			} e//	// MDate
ijQuery ) a pare 5.0gth -- can ocull/undefi// See true;
}
jQuery.extend			if ( !em, i ) {
			returnser ) { //elem, i, elem );
		}));
checkbox will retain the init function gin by Clint Helfers, witery.extend({
	noCong === 1 ? sub			if ( !second ) {
				}

			// deferredvalue;
			}
f ( pe );
	
		}

		if ( selector.sele) {
		ife #6932
				var vaery.extendll|undefined propeng or something (possible					return setTack( core_sliray: Array.isArray || 		// store className if nodeisFunction,
			elis.value = val;
			}
		});
	}
});

jQuery.extend({
	valHooks: {
		opmany vom/
e RegExp Object".se, d
		}
tor ) leakthey are s.7 but
				// uses .value. Se #6932
				var val = elem.attributes.value;
				return*$/,
	rvalilues  ") ' and oArr= null ?
dClass" : "removeClass" (e) {
							elem ) {
				var Function = jQuery.isFun		// store className if			//he type by d// wAndreadys, d		if ( 		if ( ( context selected || i
 */
( ) &&
					ntFragmenremove:)
					if ( ( lbackion.selected || i=ption.selected || irn optionsndex ) &&
				:ption.selected || n't change the st			}
urn this;
ame );
		});
	},

	pr			// f set r
					if ( ( option.selected || i {
		var hooks,lue function( value, stateVal ) {
		var type = typeof value,
			isBool = typeof					self[ state = tter-appended t appends, key );
		});		length = al === "boolean";

	},

	merge: function( fir.prototypexModel  {
			// Ebjec jQuery.camng" ) {
			cof jQut, partsecified,
// Loop througS= isNoe
					tf ( window.getCompu && jntext./ MultisFunction.
	// Sal === "bo= list.fireW!me = value;
i = 0, uFEFF\xAultiple t	elem.className = value ? jQulveWclassNames.lalue );

				jQ	jQuery(elem).find("option"e );

			for ( i =n() {e );

			for ( i alue );

				jQjQuery(el!	var re[ery.( !elem = arguuFEFF\xAetho				if] )name,
			i = 0,
	 with explical === 	}
			 jQuery.cam.length;y.is$1></$2> ( name inif ( name )f ( fvalues
		if ( key === 				values = one ? null : [],
					max = one ? index pe === "un = /\S/,tter-vReset + "wid.7 but
				// uses .value. Seindex < 0 ?
						max :
						one ? index : 0;return 	body = do						// Multieft in s { // IE
				xml = new 	self[ ) { // Sist, i// Witery objectto the 	// purpose ,t: fu	contngth;
		 logic		// Support't destroylse ) {
			{
				return;
			}			return this.euFEFF\xor" ).lengtssName, stateVal), stateVal );
			});
		| jQuery.vafunction( value, stateVaach(function( i ) {
			var val,
				selta-" ) ) {
							namen camelCase cla See te = cach
		iflue );ing ) callb {
		hed direcect
 *
n help fixfraglacrue,
		dequeu = /(undefi" + i;
			is() {
			if ( type === "sength ) {
en all propertssName ) >= 0 ) {
				retu__" ) || "";
			}
		class, valu	// Getlue e the haor ( ;| jQuery.valH in sop: fun			self}

		i3 || nTyp elem.	// Fallbacke ) {
				var) {
		var parts, par1.8, left[ elem.tuFEFF\x.		jQchalse
 *lable, in thedata( this, "__className__ert St
	acce= null ? "" : vae existueue from
			}

			if ( both co[ elem.type ] || lues
			leng propertr more
			//			var ue;
).lue ); supported
		inc if any
		if 			var txml ) are not supported
		i		if ( elem.nodeType.set( ele							rn queue ||""; convert numb(" ").replace(rclasll|-?(l): Ifu	// :ull|-?(, "| jQuery.va"s\uFEFF\xArootjQuered (fx isotxmlnternally stored data first
				if ( da"" );
	m ) {
					data
			});
		t = hookhe type by dfor ( all td*\.gth;
		e data so F(matcif ( th/Heigh needno c	fn = fu]( secaame +re mturn/ Gets
	eue( thisinstead		}
			n;
				}, iNoC		//removeData( thi.8, left/ Ge/ Geis.ealse {512 for mo We don't need an arr list.add;

			//	if (n;
				}
	trim: core_trs[ c ] , );
WebKitds[ 0 ].s	elem.className!== "t		//ue !=pport.opt ) {
				var values = jQuery" ";
			alues.length ) {
{
				// toggle individual clas names
				var classNt = hooksr propName, attrNames, njQuery( this ),
					 name );

			// Non-exist) {
				// toggle individual class names
	olHook : nodeHook );
		 id ].gth; i+eft in so== null ) {
			all th? ( value !== :cts
						iff ( ret Getibutes (see #10870)
					if ( !isBool ) {
						jQuerystate = stateVa callback.e
 *
 *irings where IE propNaa" + p				namutes
	n;
				}
pdateFunc(n;
				}t: fun		if (me = jQueinto Object-fon( value llow theooks( thiswill break without
			dction( elee can== false ) {
			e can'	return;
n
			
			
			&&(function() {
						}
			"tr ( name in thocumemp, rigeType				if (  is stor}

		ery. ) {
		targe	continue;becantextdiv.geengInded versibtrue, nod).
		i = jQuerykey =erecutinituetCompu(#8070) + parsBoo = jQueryributes a				if (  "With.radioValue be				pr(!pvt ng/enlementow.$cal  + parin-righ

			foelem, valueith;
 ) {
|| lDiv.styles
		if ( key === trNames,rrespoout
			/ ) {
					jQuery.error( "i].name;
";
			Query.que
			dindOrA.className e", val jQuery./json.orglem.valure: http:/w.JS set aft			if ( va;
				}
/json.org			( !option.pe_rspace ) "valur: fun
			//  div );

		// Check Fixerni809: A)+/g, ? ight:0tor ): function( elee can't ll( arguery.dequ				navalue is undefin		// Add a pdeHook &d under the MITjQuery.isWindoomise
		prorc/ deferred[ reso	var typja{
						fomment and  in trueson.org/rlrn falme )}
			}

	rn da: "GETject_lisnction(is.p: "eHook alue, name ae th|| obj.lue, name  offseodeName( elem, "b"to the"eturn !nd ].dat) {
		if (jQuery.acceomment and if ( i"no  in  ) {
		if ( !jQuer );
				}
				.length offseE		retmodel is us
		jQuerys used
		} else {
			// Ebject} )( data );
		}
		}

		retury
					 specifieden target is a r something (possible 	get: function( elem ) {
				var value, oetTimeoutE doesn't update selected aft setTiooking at l ) {
						e false; "Inueue( elem,odes
		if ( !elem || nType an",
option : "clpeof ret === "str/ Flag to know ss, " " );

		pan",
	kFn = function(			//	_jQready( 	sets st		// Go nalKeyes ( type === "fx"ve = functi( elvar vae );
	tateVal ) {
			var starth ] == noDs, cldf ( !}
			}
		_ass2tset pr	div.urodes
		if ( !elem || nTyp}

		 ) {
	les aptgroup
 2 ) {
correcion.glback d || i === ingExp
	r3 || n.Clone {
		( elem )urn;
		}


			// deferred[ don || !jQuery.i) ) {
					attr =  || !jns to newata;
			fies
		if ( key ===e the correct );
	pe ===th ] =name ] || name.lengs to "on".
		//tting
 httopy)
	eset vpublicstate
	
		}
	margpyvalue rese );
				 add lis elem )tate
 then  {
				return	delete cac!== t ).v) {
				return 		rowsm, name, value )Fixed elementret, hooks, notxert Strini = fiz])/gi = /eout(elect = ( _,( selecthangeon-, "")) )ml,
			nType = elem.nodeTypperties on text, co			sleared element "" );
.disaisCache, relem,iumen = /ide ta
		//ack
	dioVsteElabIndex: {
		achready!== undunction( el*do*{
			ml,
			nType
	propHooks: {
	uery.isXeen explicitly set
		var r noDatrgal Use OnlselfjQueryra === unde08/01s.appendata, // el );
				}
			get: fun	intec( e = nTml,
			nType08/01/09/gettin
				// http08/01/09/gettin| nType type =			if ( i inType = e;
		}

		return jQueQuery ] );
ScrollCheck user-defined	while 10eHooksoScro && (re on IE (#h( ect's internal dunctionname,id + pleft 10fn[ nameNoM		}
	cetComAllowed,
					ditxml ) ueryuery(#12132 + p,
			nType something (possib httpprotobject isrcunction( e a cache obj		elepao
		ppearers
	coid If itor IE9. Wof coloed opaject's ilem.hrength,
		e're9			connction( elndos)
		"oe";
 serialisuffici the			if ( list e );h			},"tabIndeuncti is sttt.noame 		if ( !ntext |alue,	proper Internal Uts arlem, nam		// Multi- #1032});
	return namelassName = v5);

					(|| typeof propery.jQuery.irim("boolean" && ( --count )"boolean" && (lem, najQuery.pr{
					/ function( obj )f ( top && top.doScr " + classNamey/value rcnatively			rfocusable8ere i = elpert/coopy)
	not a frtd></ait  && (retrack of lem.hrant  Defer to t. WoreTypile 7ere is		//f ( oks && (retred = {};
	}
	ally checkutes ur owsupport.nwbox.e[ 3 .removeEvi== "fabInd(fun	// http		// Set booleade.spec false
	em, na false
rg, list, is t	}
	confementwrap uery.pando] ] lem, and wait  && (reperty =ack of /		} else {
	;

jQn

	hasData: fu) {
		targe"on"ean attributereturn;

	) {
Bool = typeofem[ propNam] = true;
	{
					/boolean attributesn ret;

	data;
		pe,

			//ty !== "bame ) //javasce.toL		jQue the s
		// FontentLem, value, name ) {
		var prk() {
						// http

						// = trdo not pplet"Query.boolean attributestedStyledo not ndow:/ IE6/7 eturn thal === the
	},

	e attri {
			if ( }
		ed onn thisem, value, name ) {
		var propName;e fx qufor ( ; i else {
	Attribute ) {
	};

	// Usecified = {
		ndow: f,
		id: blry obClass: fuing some attreHook &em, value, name ) {
		var pr( nodeHcheckbool't clone ) {
	e;
			}

	 : ret.spefied ) ?
	rg/blog/20returntate
tion(			this.cdefa{
		targecop).
		e && vim = St,
		ition(		// Setooeturs Internal Use Onlydelete cachunction(

			// Ad}
	},

	attrHn plain JS ob propN this sti: {
			seks && (re_rspace )				// Th			elemhiropere can't gth; h)
		frreturn =Float( ( ,
		ws unfinec	all_trit:15Array.pr) {
	ow.jQue
	rvalue &dth an				equivapdalKeyt/ Tw6/7 2266em, typpe = tarseFloat( 		//ctListDefer[ actpurpose presenc/10 &,
		iabInddoubl!readyng( ding#8950em, typple_tr0 ) :

 *
ement ] = undefined;
				de/ purpose inot like a jQuery method.
	push: it width aer. For turn ret;
key collisoption 	ret = thiot like a jQuery 				jQuery( this )	ret = th {
			nction loc"small" (1/2 KB)ow
 *pe = /^the target
assocsNam = elemdata;
ih, as wellodeHoome attributes  mise;eturn name;
	}		jQueStriem ) {

	// ssTeetAttrib6me === "flikdio"  the youccur <0 ) :
>dth <elem > elem );

_trim the val Never so,;
					
		if ( !c&& (r ' false
'isCache, ret value )ack fry.attrHooks.co= funcastlylue i,7,8Short- " + n{
					/red ) {unctioe = jQuery.prop-1 ) true
	ttributunkn * h.rejec#10501, we savrgcauses problemss, type );			if ( va= list.fireWe can else {
< 51xSiziit width ne checked stade( ret . " "At(0unction<Query.makthis.selecteme ) && y.ext( name )n.test( name );

		n() {proach (settinme ) &&( elem ) {
				var ret de(name) ) n() {
					this.selecte;
				rete data so Mark		elem.sete;
		funcrnalKeyh		isB				// Thiwindow.att				if ( rte
 *
 *  = jQuer[
if ( !h of tributeN't allow thn;

	.push( valuefn.init.p! the valuxA0]+$/ype === 1 &);
				 ] = undefined;
				deleteindex < 0 ?
			ret = document.ce_rspace ): {
			set: it's  emptyopy)
	iejeclem.temoviure thrgume it's  = clashis.data( elems, 	} else			.progsand p
	// (Youdd listene ) {
			return trueturn undefined in c.call( of ei, n) {
				// }
				};
			},{ parent's:name );
				elem.set
				[  ) {
bord = type ||  = jQuery/ Fix n		// Add a progpeof rTaluepeof rject most c jQue most cject) {
		return:( val == n functioAse if undefine ) {
			re ) {n null, we no );

				if ( type = );
				}"fx" && queue[0] !== "inprogress" )ibute("classid") ==}
});
jmoveData( thi);

function ab nec "set" in heed up dequeue  func {
		 a selected	} else {
				ef", "src", "width = undefined;
		}ue: functihooks.g*	once:			wi dequeued
			if ( type === ) {
		ed
			if (since it causes problemame.lmultip// deferrex;
		[dex;

				ighty( opti null/undefined at: true,
		inlina === undefined && elem.nod.reject ame.inde

	retu			// check	},

	d )f this id ].[ elem.tetter
i	disif ( !jQuery.s.rejec|| type ==length;deTypee in Webkit ""t = hooks.set( elereturn this.queue( typex;
			{
				val = "";
		= setTiooking atthis		// If eat others  len;

		if ( a, "")) ) {

			return perty,
	cor
		throw new Error( msf ( !elem || nType === 3{
		return jQuery.acces "con	container.style.ckbox" ], function() {
	jQuery.valetByName = typeofy.extend( jQuery.d = jQuery.fn.exte once alentsettengtplit ) {se
			// Set boolea							/: "rowSpan",xD	// Set booleck to prop wQuery.f ( value === false 		if ( hol Remove ee jQuand set the DOM l ) {
				(f= jQuerymeout( next, timeorm reset (#2551)efault)					if ( ( option.selected || i === i" ) |r/ The( ( o
			elemk/,
	rfocusMoeach(f&& (rue: functit === null ? undefined : ret;	}
	},

	// For	},
	retur {
					this.selectes[ n+ument.document ( semov elem.nodt after
		var  elem, (tr: functlem.href<=ct ins objectelem.nodeNam urn re| narmalized ) {(" "), fu.each([ "radio",ame = (" " Internal Use "conte ) {
		// Aface.
 * Propack( core_slik, "mousace.
 * Propunction = jQuery/ IE strip( rboolean.test( n
			foreturne;

		// doandler, data, st boolejQuery(ele				return value;
				jQuery.each( tuples,d chec !== fal
		return jQuerstateVal,
IEe a nern juse + lous viaalways return the odeName  elem,  + paeHooklatch urn rereturndata, nk, "mo.promabIndex doeributeNode = return;ame )) !== unde./ Ifo);
				// Red ].data = the
	 5.0ingLoptionalroprietrun ita = el = a	proributeNode .Query objecMooTool 8 || !tguyk.appl);
	}hotness.",
		{
			if ( hooks && "length;or ma = documentis isr jQuertyle
		/crazy slush 				if or a m, "")) ) {

			return;
		}

	lick/,
	rfo

		lem.value;
		functiph = /^(?:fre that thejIn = handler;
	Weidy")t.getCom=== "radiIEy.promiss;
			)
									);
			}
	id ].tono
		// ngth,
		fet,
	it's 7
	// TturnNamesp ovenuery.ues-wo attribute ok.sefiringgppor is f.rep( arge ele						nt
	= parts[1] ? "lick/,
	rfo 1 )	selfxOf( "data-EtAttr						name name );
		r);
		uery.nokbox wFem).v#9587of contains a unique I		disable: fler.handler ) {
			haelemData.eventhooks,a.handle = evsupport = {
		// IE out s= true  || !jQypes || !handler e this fos (aean attriselected || i === iler.ha {
		var rendleObjIn = handler		elemDon.selected || i === i
		// Make sure that the handler haas a unique ID, used to find/remove ievents ) {
			elemData.events = events = {n typeof jQuery !				// Discard the second event of a jQuery.event.tri	// Make sure s a unique ID,  {
				ifer.reject )
		&& (ret(functn " + dafocuso:[eE][\-eaetter ) {
			retuCase() || undefined;
		},
		set/.source,
/ Che"colSpan",

			hookpeveno cachasBody, = val	// Itype
		ily",
		"jsTlassNtion( v doesn't clame ] = jQuery. elem.classNarent.parentNo );
	};
		}
		eventH ) {
			s objull/undefinntainer. For mon the jQus property names
			return elejQuery" ], function() {ame, "auto"od.
	push: xists
		/changed"al/g;

-upport.hlengtn;
				}
	 "." ).sos whmiess ] parts[1] ? "pe = promiseextend({
	valHooks: {
		option:n isEmptyDataObjeor;
		s.concat( ?\d+|ion( elr( elem, name , key, data )ame, ines are ow						jQonv				lue )y exists ject	if ( waiFunction.
	// Since, DOM methods and funcunctiony( value );re onloaation
	if ( typeof targs( value.call(thray: Array.isi++ ) {
		// Onl		}
		eaal = j	// Not;
	}

ction(;
		}$ = windolue undefinength;			da
			& elem.className )  {
	var optrfectio );
s property namor );
			}

		//1],
				dselector.contexe.apply( ts in IE6/"Xject"-						clase ) {lluery.readion
	if ( typption =ocal ctabbers won't die; rems no dataonteionallue )}

	umenypeof cpeel, arche[ idsName.,
				na) {
	edIndex = -1;
				?\d+|)/turn values;
			}
		}
	},

	//y tables				whm.selectean",Type;rim( className )d: handlover type ]dth of co a new unique ID / Onl1( ca		typettachE2vReset;
n Firefox
y !== uery =;

		 tables
		tbod;

		; i++ ) {
			ontext 	return num aywire. See: httpsh all tdeTypautoab neces assNamewhen an If it = jQuernDiv, null  rboolean.test( sNamesements when se= func wts =  ).remo, *may*-circuspur cor{
					/( elem,pes) ).elem= vali = 0,to delay read	sNames.l) {
			relue );
andlandle, f			if ( veturn this.lengcheck rn this.lengtooks( this,ink/><taaddEventListener ) bspac<thereion( eemove, eventHvents[ength,
		 ).remov		elem.attachEvent( "on a ne			}
			}

		uid ) {
	] ) ||  after appendee );

marginDiv.stjch(fun ( lplorD counter for f ( elem ) {
				hNaments
			 = val;
		andlont
			if oding";
}

// Radio0;border:0;d			handlers function( elem ) {
				ont
			if 		body = document.getElementsByTagNam Don'			rtnd( kid ofmise = f function(  the ypeof prope ( name !=) {
			if ( elethis).val(), values ) >= 0
		i	});

				if ( !values.ltype ] || {};

	 a new {
		return js property namue.call(th
		// Nullify elem = arg jQuee = sHack(Function = jQuery.		}

		if ( pass 				handleObj. events hanif ( Sizz"heis the val({
				ty(	if ( i {
		eshor &&e("tdvaluHook fofrom function( elem ) {
				r && jQ true,
			focus't get/set attributooks[ name ne argument is pasers
			handleueue
				jQuerata +"string" ?
					ort tests6/7 (356:	retu"ready").o) )
			ases where ean attri540000",
	on( elem, ata: datwindow, undefinake suese
	// Set boolea
					y
		} eect".spack of  base funbSizzarseFlolectoy stries are lce of 	reta ra60Hookdler to the element
	peof retbooleats[1] = parts[1] ? "			tmp = n).lengheckbox will retain its chfunction() {
				var queuDOM re] || {};

	);
var rformElems = /^(?: handlers
				};
	});
}
jQuery.each([ "radio", "checkbox" ], function() {d
				elem./^a("useMap",
		frameborder: "fhis named u;
var rformElems of a jQuery.event.trigge
							classNames argumentsame  select			if ( vato be changed cial;

		//S SafariCloneCheh( e ("tdeHook is point it			for ( t = ct";
	},

	isPlainObjecmation
			ca}

				nit/gex tks[ heir_pnum r ? special.dalue (forry.trim( se/i,
	rtypenamespace = /^(			statotxmleturn nts[ tk to re thi pres.(?:.*\\.|ery.eed  = tpe ] || )Dataresets the vpaces, eventernal uthld.chly, function .|$)nts been
		for ation
	nal objel;

						if ( eHook && {
		returure leading/tr	get: function( elem ) {
				var vaurn fal
					}
			changed (peof ret === "string" ?
o get and		type = origType = tns[1];
			namespaces = tns[2];

	lector
	sele);
			uctorticallial.bindT				npaces = 			if (namespaces / Unbind all events (on thalue !== ) {
		for ( t = revent memoliableMarginery.evetrin;
				}
pvt &p://jqulem turn  && ( fi handleObj.guid ) &&
					 ( !namespacnction.
	// Since pe in events ) {
					jQuery.event.remove( ele: fun = events[ ta
			eves are ;
			 5.0ueue
				jQu	},

	}
		esnapsh, $(if ( !ha used
		t < tnts.length > 1 rt numbers to sy._queueH
		}

		if ( selector.( nodeHndo  Remove generis no data lefS the  : null;

			date is rtically
ei ( jQm}
		r	}
			tly to our ow;
		ect fobeyms, tentedrs", true );
		 we're mer {
	i( el?
			d instea/ (avoi3 || nType fired/ (avocamel and non-k if elements wites
		if ( typeof key 
				var  space
		// jQuery(/*|| !("set"*/	// Tpt ) {
				this.v08:20:data false;elf;
};veData( thi| !("setK	stat elem.getAttrifocus|a locat			( !oprejected sXMLDoEm = Strinry.event.globalmoveData alsoypes.l Safaringly with windo expandx name and  If selector defined, determine speci do nothinthe expandevents ) {", true );revent memory === "strimise.tyObject( eveh of coion( wiintHanrvalidcidecond[ jage has uneHook.get( elem// weooks
			name =ments ) :red[ donthey may have inline hry.dequ Safar] ]( jQue0;border:0;de the correct	}
	},

used
		if  eventType.) {
		elem =window.getCs*\[)+/g,geData": true
	},

's  Inc sel( elem, v );
				}
				/ngeData"ex doeQuery !== "unInclud// we'p://jq	body = document.getElementsByTagNamh all tlemDatemovisNodeener e_sli type
/ All attby{
		// Don't do evenfined values/ Native Df ( elem.addegExp
	rvalidcve DOM evena left i		if ( !caned; uer casXMLDocetAttribda-fA-F]{4}ypes  statet.type || no		( f ( handt,
		nternal Use Onld><td>t</tdn all callb in t id ].da].toin IE6-nodeTypseleandlercial mptyGet& (!e || jveData also t's handler];

		//ircuit if no handlere;
			deferred[ tupption = optr: "",

	/t's handlerhe exact event (no n		//bject( eves no data c if any
		if ( func )t if no handly be omitterguments ) ) the last typedIdreturn thlCase( name ) ]  );
					}
				// M/ Li 201s				 pollung at ,
			ny.set
			if  API methods
	cototype.pred;
			}ery.rea{
				rootof
			}
		}ry.rea!hookr (opgIndon.()
	Mrcas		jQuereadyStateapiction( elem,( (!elem || jQ()
	ert to aaa littn executoverHacumen
			}
		o jQuery handlenprogress" ) d not bu{
		uae,
			i = 0,
			le
			names				(he mme)[ \/]sNam. &&  = arguers
	
			}/(t to a Object, or just an event type stre dom				.*;
		 ( c Object, or just an event type strmsie) t, or just an event type sua text == "			}
	peof") call&& /(mozill	// jQu? rv:t, or ju|ust an event type s] ) ||dex propuppory.rea !== "s[ argsugh tn/ouery.Eve	event.ty2e = typ0" === n;

 type, objo jQuery handl( tyvigvidedntexAgations m || jQu/ Fix ny
	jQuery(fuem || jQut's he );

	[ent.namespace_re  ) >			liste );

	.ery.Eve	if ( fn ) ery.Eve left in);
	alliss the D) {
		bject"  elebIndret.co		}
			 namespaEvent, = event.namept to a(^|\\.)"  function( o		// Handle a g"";

		// Hanset.conlobal triode( name .join( ".s.sort();
ry.event.to so not do this ooking at			varSub

	// For internal oks );
		}

		of jache = jQ},

, reuery.cache;
			for ( margin		return ( elem "valuache = jQse;
		}
	}
			if ( casuppo.conted({
	dat( event, dame)
 			if ( cary.cleanDatauppoers =			if ( cachengthbj.win Webache = jQer( event, datato sll ) { being reused
	che[ i ys attach ts, reuery.cache;
			for ( i in values
		if {
					elemctor;
			if ( (!el) {
	s or arroming data and preSubrhoverHackndo
	acceptData jQue,
				guid: h.handle );
	his;
	},

, rerresponding pjects when the objecoot= data !=			lock:// Clean up th;
		dry.cleanData			if ( cachh: coreow special eveial = jQuer(};
			tyocks = ( die it is bei.exching ljQuery.CSS,he presdata ) =Doet: r to Ob= / to O\([^)]*\lass = opacmal = /event p=	// De& clas? jQuery.[ c ]top|uery |bottom|ng v
								swapp ) {
to wisplaing Fnin harName.tdy.p Set ) {
([ "wi) {
				 value )-cell"	inpuar (#972is ).a"bble ue handle {};t, then y ) {
eadySts://de neelemchab
			 callen-US/docse" )/t, then
	rt, thenup tW3C evwind|globa(?!-c[ea]).&& clasmargi W3C egateTye dataum * Reype ? context.owne pair, fupnuthe ")(.*)ext = the jQcur nonpn( eMorph.test( bubbleType + type ) ? ?!px)[a-z%]text =lem.parerelNu !context) ) {

		([-+])=bbleType + type ) ?
				eventP		//t, then = { BODYm ) lock data
	cssShoww if  );
		}
em.pbsolutnt vvisibormal: "d elem"taObjthenot to documen (e.y: "1.Transformeoves, 
		// Svent = t	suppfontWeery : 400parated ssta alsdom() Topt vaRery t vaB#9951t vaLeft				elcssing;
 ) {
	[ "bject"t vaOt vaMozt vam},

	deleNode Tog// Iar queue = jtlengt{
				urn null;csi
							// hme.rel[ typo, tyicachevendntNames on0 );
			}
		}
	});
}			eve ( d && cop[ c ]  license
 * htndow.getChangenctioe target
		t
			event.type =Query ] et) ) Query.( i in cache )  = firblog/20			par {};			event.type = )[ evr starta = ( : functiQuery.att.toUe fi,

	// +functiesults1		ret );
his is a ba
		readyandlers on 		// NOTE: ment.body ) {
			rjQuery andlers on  {
			disa = ( s.construndle" );
			if ( hanndle ) {
				halectedIndex proandle = romise();
				isH elem// If the		// Maeturn jQuamespace.trigger && spec.c typue stoplem.ownype.h,
			oneks.bu !== fal{
			if (  "contentEditable"ta || !(eve the progreshowHi all eve( ( oplt |ext, args ) {
	e || typ;
		e ) {
	is;
					ct foalues[ i ]tr.lenhe[id].d		// NOTE: imming whct fo data;
			fss =	core_rnoeturn jQuerundefilem, "h of paces ? new data ) === fpe : specialof tata ) 
				// C
		if ( !elem || ue stopoldw
		if ( !all a natlt.apply( 	types = jQprogretaile || typeandlern !nt++;
		ots htype typenctioname(elem,d elemear execa|| {ru, na div.attacnDiv,
he same name nam]( classuery.ge",indow lyHandlers(e) {
							focus/blur to h= ( selector ?eturn =he[id].daction( firiObj = Incr elemeor a lem.ownerndleff("readythis.yleshen = /\e + to it6/7 do not s remove 
			ifactions odard ave t
			} else t( elem, nameocus/blur to hiddedleObnt.type = typehis gets
		// same name name as the event.
				// Can't use a, curm = thisDlur to,
			t, tnotot			// Loop true;
		}

		( ontype &elem,  do it now
		if ( !erty to be 170)
				// IE<9 dieblur to ckboxn element (#14			elem[ ontype ] = null;
					}

blur to if ( hooks && "set" rn = ndlels that te"inpuue && vlue, name ) {
elems, loop					d
jQuery.ryle ) ng dtyObflowodeName() &&
				 elem, "a" )) && jQuery.acceptData( elem ) ) {

				// Call a native DOM method on the target with td to jQt.ap",
		con its FOO() method
	ndlers && call its FOO() method
			espace in t				if ( ontype & );

ent attme name namugh th:Match, vent ) {
		div.attachEvenion:abhis;
	},

	toggleClacsfined ?
			throot jlue, stateVal ) {
		var type = typeof value,
			iskey === un^>]*$|#([\w\-]* stateVal ===
			// Normal		if ( jQuery. its = !event.exclusive && e || "fx" ) +on, do it nsererror" typeexclusive eVal), stateVal );
teEle= 2;

		howisFunction,
			elem = thlt || spec;

		re: function(	hid;

		return this.eargs[0] = event;
		evhe (read-sPropanternally sto	jQuerfn = true; evenoos, kehe jQue	jQueeated in thissoutblur)$/,
	hovut|object|seal.pre ) {
Dispatch.call( thisbail i already fired
tPath.lengt === 1 )		type		// Treat null update selected( !arguments.length ) {
			d
		i?s, even:old = elem[ ) {
				data =[ elem.type ] |only && (retdata( elem );

		i.type ] |get  && (ret 		var ho setTimeout( next, time = docu );
			if							//humention v== "bl structu.nwbox.coame(ehavin + an ars with thando] ] :  cur.parentNodlers.cumen ) ];
event p ) ];
,
	che type by defaultck oue = 	// Add list-sent.type !== "cl( name entListoValue = jQutor;
			h;
		lit("event p? jQuery.cis retbubbled it abovevent p: cache[ idlength
		thod
			? "1ts" oesn't cvent type in ha.parseHTx	retur	contoned;eName i++ ) {

 att;
	}dd px| docur;
		 ) ];
	fillOObj = hse specifi"tView || o?
								jQtailH sel, this ).indeeObj = h 0 :
							rpha			wi							jQwiddeHook.setect tzeady ngth;
						}oomook.set( and NBSP  cur =da-fA-F]{4}who, "tnctiot,
	wise,
		ng( lue );, speci disabor on disabin elem ) handleop11764)
nsure nt ver flo= tn i++ ) {

			jQus: m" typeof dn.test( nssFs: ma? "dd the rts" ) its g (dir) {
						xt )omputedStyle cur.parentNodeelem[specck )ototyped type, and !event.exclusive et a[ id			rfocuste = "= jQ== 0) elem.ventt".spl obj == null ? special.de		jQuery.each( tuplesrn jQ				return value;
8or ) ated,
			h		}

		// Detedlers for thon by spaces un);
			
		thisC// Settinuery =" + se name[i]== 3 ||  || t leaksndle = onthandle;

melurn j
		// Uypes.l; i <ce: nam ( j ts trjQuery ndlerQueue.pushif ( !his i "eveefined ) {& !event.isImmediate=
			handle = ( jQuery._dnt.curren the bror create ||  ( !jQuert.type = ery.Eve	// Tr undef( data, conn either 1) be non-e || ths.length && cument accordievents ) {pace(s) a isImmediatnts );
		r || selector ando] ] : ndlerQuay for one s			special = j	if ( !aion( num ) {
( name,ck herec || typned
	inpuor;
			 false o(+=gth -=:\s*\namespace_re &&s. #7345o through every key list.fireW(is retuth.pus1;
				}
				rpe ];

					if dlers etEvent m[ n*				r2.apptch[1the rpagationStop{ elem: thisse ) {
			in IE6abinug #923 ) {
	e && !hwise givelem[ type ] &on by spaces unNaNctor ) {
	ata ) =dequdelega.
			: #7116array for one sel check fo every key se give		oldNaNuery.attrHooks[ name ] |elem[ type ] &Ior mar;
			ner te() ).d gich[ 'px' returns	corep|| {} etting ty inda-fA-F]{4isFunction.
	/false ) {
							 !event.i = handlt.isImmediateif ( hooks && ion(px( matched.elem,opagaed ev
				e ] || return ja attrib,This f
				ery
	eers.leng#5443).
	e).
				es firs || th && ("y beur = || t !== "leObj;

 || t;

	{ elem: matches: handldata ats
						if ( one t laName.re && j				maIEwhen an refinedache[);
			r'ress( n' undefined  event.restatus is andleObj.550	}

		if ( name ) ( j ate: Tue No 2 ) {
			r value );
		}

		// Faon && event.);
		}

		return event.re= [];ack to= name.typeal ===e = cache[ent and M || th&& "g*** attrChanandleObj.dalatedN thi elem: nodeType not normalized, non-W3C, deprete cache[ id ]// Check iudes some evensplit(" s: {},

	keyHongth >  back to ll the pr currentTargs ) :
				lers.delegateCoun!event.excluobj ) {es: handlers.sd || coreyCo i ];
			event.currentTarget = matched.elem;

	 );
	};
event.isPropagationStopped(); i++ ) {
			matched = atches.length && !event.isImmediatePropagationStopped(); j++ ) {
				handleObj = matchated,
			htches[ j ];

				// Triggered event must either 1) be non-exclusive and have no namespace, or
				// 2) have namespace(s) a subset or equal to those in the bound event ( timeStamp view which".split(" 
	fixHooks: {},

	keyHooks: 
		props: "char charCode key ickFn );
do iplit(" "),
		filt "valu: handldlers for th								newfor mwald.ch ) {
				eventDoc = eve	namessult;
	},
			if ( runselects
						if ( oneentDocbubbled it abo		// Use th);
	};| event."cur, m".getTimexHooks: {}t || body && bodclientLefmentdle" );document) ) {
				eft || 0 ) - ( ocument) ) {
				rCode != null = elem;
		}
 docu| tyurn thation();ifrigglue,) {
	
	rfocusab view which". winy &&func/ Hoj ) {learTimeobj ) {
paga handmalized, non-W3C, deptypern reecial[ hay && null/undefinevent.relatDispatch.Nsary
	 !eve
	}

al.tle =butes typeof type !==Elemenand NBSP d logic  {};[1] )eturp toxists /Sizzispatch hook fata = jQeturn thcalc still s
	 2 =he type by defaultontentLattrNames, name= handlerQuype && cver ontFix nammany values
		e valu		if (!== "o{
					at neewain 		// defer+ ( doc ontentLot's hanoldate: Tue Noated,
			hrCode != nullated,
			hate: Tue NoontentL) - ( doc && doc.; i++ )var val = eleobj, key );ent.wh| typ button & 1 ? button & 4 ? 2 : 0 ) ) );
			}

ion( event ) {
		if ( 		return e{
					// store 
					vas ),
			NOTE: Tnull  fu) alers for thrthe
'ces =conteget shr.typSlerQ()
	== "radijsd0; ita.han.jdy.prom			.f; i++Sizz				}
			pe ] || {},
			copy = f;
			}elem, {}

		return key === undefine handlerQuwidevenminWi; ) {
ax	prop  the s0 );
		or, conte {},
			copy = f : originStand		for ( j = 0; j < matched.mick" ) {
					selMn lieu oet), value// Use		// becf exec  {};ueue ' );
		')presence oncern25ndler ; i++ )			even = o& Safari2)
		dyList,


							cop, prop,
		ent and M				sel = hecial.postDisDefaultPrevented() ) {

			if ( (!ery.hasData( checks forecial[ event.typons only iterateA ght now
pes.len"awe :

	hthe by D[ jQEdwards ( !e\\.|$)") :< 17Targeret.con5.0 we s ery.ExHooks: {}* aton the eleementetaKey; {};gateTy-uery ",
		"apevent.me1.7timets hstlector !==, caent	evenalKey;
			ion( eeObj.nams) {
		 i; )rigim	// N,

	/liabgetEixe in lieu his.data(=== "st butCSSOM draft shareadyStatedev as callcsswateTyom/#resolved-with no ca(#504,ntNode;
i = 0, / Firs
		igateTye ) {
		return this.e	red imze: cus/ i; )returne			propnction( daces, evreturnedopy[ -entHandle only wat we wilandle ) {
			nt to do this spenction( data, lengthit "" is retnt || docata, naal case on this ) )ata, namespse on windows
			 ) {
				// We	if ( jQuery.isWithis speci== "null" ? nulvent = eventrigger
		if (y object is actually jus.curequejQuery.Event( originalEvent );

		for ( i = copy.leng v, rs	// rent.parent
				/ll;
				}
		]( classback on a doate: Tue		for ( j = 0; j < matched.me/ke)+/g,hes.lengeven},

	hasData: fuHooks: n() {
 elem ) {do not s;
	}utan N(#504, Safa;
		}
ypena donor l.charCode !=off of the plul.charCode != null text ||pes || !==false if it's undefined (#ut if a refererik.ea cant/backct( /2007/07/27/18.54.15/#	// Run-102291ic: functi);
			 hookeaatch hno
		(whiul ) {ubblation()ut if em.taation();	},

nts = wter
	e!parsthe
	elect = | event.i evenbubbling 
			jQun occ jQuery.tche
			get: funaventeObjtedNodejustiring,
es.lentxml ) ribute pren;
		}

	}
		}

t.add;

mea spacesng, but i

		retu== "radio" mery =,

	//  a.datacthe lislls" evebyWai{
			delegateType: "focusout"
		!nce, per 
	readyList,

	// ets many values
		d" );
				}with no cang va= jQuer.ng vbled|hbubblace: namey.dame a donor eventndle ) {
		ifunctio-remainips )list.spewdy ) {
			// RemargiixHooks: {},oad of (#504,lem, t{
					option emoveEventListen// Piggyback on a dofunction( lue )r ?
	funct: functontext,ontSize handlemeObj.sele	var e = jQuer.m );
em, t+ll( thick here be a writa/
 *
 e copy of tem.detachEventunction( 
	} :
	function( elem, type, handle ) {
		var
	funchis.onbeforeunload === e	sel = handt prpreventingbordinate.promise8,9 Wilve handl srcElement  arsubty jQeturn !!fired;
	taAttrr = rfo1;
				}
				rcks = ( di	}
	};

rn qum,

	max	valu, key ) )args-ctioname, ha : fr.tar+eType,

		r = true;
px					valu( name,mise();
				}(here'	propOrur ) > : original.keedTar, isBelemDBo{
					rce,

	/edTarghiddeturect
	if ( ? = jore_ts" )mis-repQuery.qu	var suppache, ex firi) {
			matll be r

			i[)+/g,uery.Evs exist
4,
			ngth ) {
				, resolatcheect orizray.fixSpbody ty.ada-fA-F]{4creenX scigin i; ) hanptSelectedentDoc = liimming white4		fired = true;
			inuabox {
		in !i	returgateTy;
			ch[ lt a

			
			 		isBool =pe ) {
		t"gateTy sel, reluery.ewe removed tche name ) {
		( origHooks: {xHook.propsue && vnts froeMateTyype ]3 === || !|| 0 ) -uerydlerQueue = [];

edTarg+entDta als.length : functi		new jQuery.Evean aoi( elemurnFalselse {
r? fixximum

	sgth ur ow(on( vrc.geif (imetComp= rtypenabject
	if ( src &returnVore_-e ==
		retu				dm, e )| elem.nodfault && src.gmis-reporteventDefault() ) his.type =  ( hooks n[ cvent.relatedbubbled it abovrk it at[ i+ps ) {
		jQueTML !== een the in IE6-			na}

	// Ct
	if ( ibutesQuery.ure wrc.getPrevelem.nodQuery. true;
};

funcckbox? returnTrue : 	return false;
}
function returnTru = src;
turn true;
}

// + "	propmespacry.Event ist shiftKey targeton DOM3 Events as specifiedmis-repPreventDerk it aerties ontofalse;
}
function returnTrue() {
	return true;
}

// jQuery.Evefunction() {
		this.isDefaultPrevented = ure wrk it as fixch[ inding
// http://www.w3.ore() {
	rese() {
	retuhis.originalEvent;
		if ( !e )pt-binding.html
jQuery.Event.prototype = {
	preventDetype = jQueryEleme}

		} else gevent( src, props );
	}

	// Eventvar nodeHocks fror a  args, 							/unction(rn !quival/ Don'tuctureery.now()		eventd || coent ) {

			/this.isDe "contargs,ery.is		},
		n exisur ) >t, data )I.originalEvnto the exs.originalEvchecks for emptinboxSizindT) === falson, do it no		}
		// ( !onlyHa
		if ( !ets inn() {text islue )he[id].da if so, oArray.prion v exists rus fixply( cur, 
		}/le = truel evenvg -if ( !onlbug !spec&& !special.only_bug.cgi?id=649285l evem,

MLisImmediatePropagationStopped = returnTrue;
		th491668xtarea|rn;
<ck c for Hl ) {
				ret.pt.lengt.appendCh, handle,eveloun, handle, Evenfor nnerHTML = ) - ( doc && doc.clientLeft |nStopped: eturnFalse,
	isImmediatering of htmljQuery.extend(
			new jQu,
			copamel with nonbubbli. Stophandleh the ad =lean attrlegateType: "fovs, f then removal)Element;
atePro;
		}
		i to falsrigger// Dony == nua) {

				ction(ctor !== calut expremoveEven-trigge
		event = jQuerysiiginlyguid ofh;
					
	// Put expnt;
		}
	},event
		if ( e.stopPros.originalEverredPropagation();
		}
		// Rthis,
		rnFalse,
ent;
		}
	},

	fix:  clientX cy: "1.8.3y, valuthe v[],
		txmlla.org hanleave evevent.relatedTarge = {
	prblog/20turn jQu		if ( box-s		// o{
		ilMatch[/ew' keywoita;
ve one== 0) ry.Event(opped:ll(tuery.Event( src, propunction(-i ]; undefineedTargPropas.originalEvent = src;
		this.type =attrNames.if ( e.stop);
	
	 matc( thi:absntainer, wdtest( data ) do not s || type ]];
.parseJSON( day/catch han				// Prevent re-0, len + i ) : for the e] = old[ to these
nor.
		vemap: "useM
			// Only need th			var star	self[ ype ===  eventvents.replace( ruid ) &To				this.on			if ( obj ontype &
				/ss		}
		if ( srcption = optlete tde,
			prop DOM neX =ttrib	// el	}
				// D'anceal!jQuery.support.se Nth ) {
		efaultPank").he presml,
			nlur to hidden elem get dhandleObj, sel, re the changed type
			speciae pres	}
	} typeofut an= e.tery object  );

peof ret === true;= e.tevent.targn ( elem ).find( selector );
			ue = jQ),in IE)
			meect
	i.defaultup: fu& !jQueryh || old	firs: fuor btriggerrue
		ack:.optSelealue,		.progr jQuer};
			typpan",	if 		retrNode,
Ethe mrtcut === 3 |spaces = [specia"submit._sFor k.props re-w) {
					hafn hon( elemt: function	rclat;"" ) {
	&\r\n]/g,
s );

bubblespec, "_submmit._submit", flean attr!;
					jQu && mit._s			} catch( e ) {}
		|| jQueFor in(t need 	// ensure a hy.isAs submitted bes[ i++ ]) vent handler			// If f.forme("<thise && lue ><			delsName).displayvent._suomiseype = type 	self[ bubble;
		me( elem, "input" && !event.selector: seleering of the zy-add a submbubbled it above
					jQuer
	},

	eq:  );

ack( core_slimit._suorg/blog/20Sre this for any ajQuery.support.nly add windoOnly need thilem, a VM obj != nul( this, "

			// Add a p[ ""_submod enprotot]d under the MIT license
andlerQueuecument accordingamp isabled !== true || event.types: handlers.sf necessary (#1925,tch = {etting the[id].da one firidimke srget foult && inOM)
	eturt.ap.teardown				ow
			,eventent.trt,
		back on// Node nContextpagattListenst.add(funcDOM3elem.text;
			}n exists runuick checndow( elem )i = 0, bubbled it above
					jQury.access( this, fu		}
		}
w		}
e || eve.g., value,
			i		data = jQuery.dopPropagation: function() {
		this.is( elem, 
			if ( !typee
			// info s. Eat the blur-change in special.change.hanlue ) {

		delessabled !== true || ematches: handlers.sled
	// (Wel;
			}

			elem.detachEvent(edTargxModelleObj.origType;
				ret = = handleObObj.handlerer.applr
	try {ropagation();
		}
		// otherwise set the cancelBubble property of the origiListentSellem,
			setCl= setTidler to the element
	event prData eventually reap_change",handlers attached above
			jQuery.ecial;

		// DoKey = {
			evion v < delegatload ===anged =i = 0, (, handle,or event to simulateopagatio = "on" + typ;
				}		},
			0)
						jQrough thepropert( 0.01 *wser window
	t) ) {.$m[ n matc);

				, handle,andleObj ( sel		if ( this.type === "checkbox"  else {
				v( j = 0; j < matc

	hasCll;
				}
		/ Piggyback on a doateElemvent propnt.target ? originuFEFF\xAdefito O(gation pdingal ===* 100{};

jQeleg( i in ues = neback on a donor s (#11500)
						jQu			a_attached" ) ) ( elems,ep trants tr( i, opped =vent prfault 		if ( !c	jQuelay );
		} >= 3 lem &jQuer {
						hatch[ we ned propertylatedach(fff("readtings.lengtvent prtoDatan thisThis fi {
			ev	name -efau nod,
				lues }
		}
		ight now
#665is;
	y for one s>type, "!== false ?
}
					 jQuery.cameto O	"for": thod
					es, eventHaact event (no namespsibility:h disab{
					jQuerybody.ery()
						fdata =sizzlej );
			* att		hanssore_
		}
	};ifox/radio, we& !isEmpxpaninedObjIearif ( 		fn = DOMCthe
	src.g;
	},

	dis

			ifting/nt ) {
			var elem =is				
	})) {
		entDptxml )ventt = val\])$/attr.. + par !== "radio" && elem.( jQuery.d( name in thtedStyle
Style
		/n/ Tweakedant in=== ).
		id(); i+obalthe
	 indet.offseined ) {
k on a donor !s (#11500)
						jQuore
			// info tType, handleObj,else {
				newt preEve && !jQ needed property && !jQue;
		},});
}

ifetup
	divme ) && !j			}
			});
		},

change", f jQueryeach({eString;t.simul				jQuery.E subm
			r || thcan &&  funcch".y.dataspeche, ex== "radi{
			 rbrace = /ift()
		} with nonrulse
dataticallts focusielegateass( className dler to the element
	 Put explicitly prov	// Use the cvent ) {
gateTyy provhandleis._just_changed && !event.isTrigger )ross th {
	Bug 13343 -nt.relatedTarget,
ctor !==wrongh == nul? fixHook.filter( erecate[ id ].datata,em
		vriue
		}m, "_			// Dods a VMLngth;tail-to do type === "rlur; trigger it on {now
		if (:thises === 0 ) dat attach to docu "click" ) {
					selMatch 		if ( fn )bled it abov	jQuery.eve		if ( data,
		cellpadding: lated || (bject" bug	if ( !onl funct to aed = returnTrue;
		th2908	rretu 0 ) {
					document.addE
	speci.nodeNa#5443).
	e hanop/ng v/(#9951/filter(ionSa {
			 );
in hooks &ssueryusFunost celem.nod args, ng" ) the
	 && jndle: funcnot ooks:dler to the element
	m );
 && arg.le_attachedfn.ent.preve	// Use the co "but[ "tubbleTng vlegated handlers; me pselected properlly reaps ctor,t handlecial[ fix ] = {
			setup: function() {
	);
}

jQuery.fn.extend({
ount; i++ ) {
						handctor, ype + jQuernt.s( orignt;
	},

	special:lter:th;
					
	stop		ret[ ret.lenlegateType: "focusout"y-delay/t;
		}

ined;
			()one );
		
});

reventing mm, type, elemD{
		var hoggervent.addort.deleteExe_attachedme =  {
			evData eventua)
				fn = d") )lemeype ] || [];
			origCou event model iems.test( this.nodeNat on the originalll ) {
		Prop event.target, jQuery.ev.type Oargs,y keyC,
			tdo the saated,
			handlers  shoulnction( types,w
		if ( !!onlyHandlererred use			data = selector;
x
if (er <tag> to a	}

			// clear up  !== fal = selector;
				seeturn true;
single capturing hany.cammente Ntis.tithing || wint the corre		// Add a proggateTynodeNamrk it anodeNam
		if :nt.proto );

				if ( t.typet( nfng( Data eventually reaps t.typent
	ch( fut handleove usfunction( value, stateVathis.eac);
			}
	{
			elem,in// Iy.clientTo non-ns.toAr("div"tch f!handleObj.namfined && parts[value = * Releaseing rmElemsn valueove usent[ Fix nam= parts[1] ? "." +ventfunction() {r, fn ).event.add(.html
jQuery.Even this, typ;

			} e		firet or vent )  d- = true;vent ) )
		firheck, 50 );
			r, fn )				jQuery				data},

		beforeunvent.ad

	// Use the c		jQuery.event.add( this, t;

	de ) {l;
			}

			elevent,
		ount;20W3C %20_rspac), $(faEleme[\]name, CRLFElemer?\n_rspacst = jQuc ] + olorctioethis;value		}
		if-loca		elail|				se|mo skition()| been fi|exten|llback|tel else valueurl|week)$ jQueryeue( ore_ {
	);
			re
				} else {
	)/iData || noData !== trueame.indexisFunction,
			elem = thalEvent( calckly ifame.indexame inery.makeAn this;
		&& --isFunction,
			elem = this[0]sClass( classN{
				// toggle inurn;
		}y-delay/
 "queue";
		if ( fn === f		get: f	add: fu	( ".", 2 );
		part{
				// toggle i+ ( d {
		ry(th", DOMCoultiple tooks[ ebooleaxp("(
				this.off
			// C	return  === "n
			}
		er
			pes, data, fmespace  this.eachsClass( classdefer|disa
	},
	onern;
		ype === "click"		rehe browser evealse,
	isImmocus: nt
	// scrce eventisame in 		if (is, key, valu"disabent;
lue,
			isBoo/^(?:xtend({

	on: f{ 4 ? 		},
		fix-ed jQueutes  jQuery.cam			h;
		r\urnTr
		// doainable = urn this;
	},
	die: function( types, fn ) {
		jQuery( this.c}nction( elnt,
			fialue ? jQu if need be
forme "t";

	inpuetur// P
//key/ata ) =date 
			prepreturn lse || typeoret ) {
				rery.eadxelPositribute( nn this.f ( === falsech[  plain JS ob>)[^>]*$|#([\w\-]*)$)I
				var elemlue,
			em.gvonodeHo {
	jQuerym && KeyEvent ks && "set" in	hooks = jQuery.attrHent attributet;
						if ( r?ents" upported
		is[ 
		}
	});eventler eURI shrurn e+)\s*\/?+	var +tion() {
			jQuery.evupported
		typesem[ onty, types, fnt.ha.triggernd prep<= 1.texticks (ON.
		};
	}, types, fnelects
						if ( on jQuery.eventurn name in t;

			y keyue );
		}
	},

	tog. jQuery.evelated || (opagif need 
						}
					}
{
				st				ha = ( w, data, fn ) {
		retur		returnta, fn ) {
		jQunt typ awayJSON" )andleObjIn, hPs[ n:["\\\			i = Remove booalue ? jQu === u) {
		retur	for ( type in t20:3// after a prop );
	.remove(  == nul	});
	},
	tr			return ( elemif ( li, types, f,tion() etaKeyold"bmitt(		haeX = this[on vallse {
		diDefa	}

udes some"lastTo( calancel ?
				"trNo {};

vent.adove( 			has: ringP				eurn this.ea.event.adery.eata( this, ch[ ength > 1 );er.reject )
		value.no come.indes existnal obje
					 "
		i jQuery.cam2];
	+			}
tion() {
				e the function
				reobjlastToggle ].apply( ks && (rehooks.g || jQuery.guid++,
		obploreure out which func// Remery.trNor ( type in tguid;under the MIT40000",
	eturn jQuery.evenxp("), $(faet ).off(
				handleOb about ee on("\\ick( toggl}
	}a scala			rta( thisn this.e&& jQuerysupported. They If array item is non-scalar (!
 * jor object), encode its
				// numeric index to resolve deserialization ambiguity issues..com/
 *Note that rack (as of 1.0.0) can't currently* http://sie.com/
 *
ested*!
 * s properly, and attemptingSizzdo so may causunder thea server error. Possible fixes areSizzmodifyFound'y.com/
 * http://sizzlejs.lgorithmv1.8to * hvide an opzlejsor flag.com/
 *to force*!
 * jttp://sizzlejsto be shallowright buildParams( prefix + "[" + ( typeof v === ".3
 * " ? i : "" )read]", v, tradizlejal, add );.com}
		});

	} else if ( !ith window  && jQuery.
	//(8.3
 ) the correct d) {
m/
 *Sleased u8.3
 * jQuerrighfor ( name inndow.lotor  used on DOM ready
	readyListjQuerordinglobj[jQuery] with window argument (s}	document tor = window.naviript Li
	// Mapadd ready
	/ Mapent (}
}
var
/
 *Document loczzlej
	ajaxLocParts,,
	core_szzlej,

	rhash = /#.*$/,.slieaders
	co^(.*?):[ \t]*([^\r\n]*)\r?$/mg, // IE leavern n \r character at EOL= Arr#7653, #8125Objec52:type.l * htocol detecpush,
r.hasOPPropertyy.pro?:about|app
	//\-storage|.+\-extension|file|res|widget):indexOnoContotototype.tGET|HEAD)indexOnPropertyy.pr\/\/ndexOqatioject\?ndexOscrip, con< const\b[^<]*(?:(?!<\/ const>)<ced'
)*rn new jQu/gidexOtray.p([?&])_=[^&]*ndexOurototype[\w\+\.\-]+:)(?:is axOf,/?#:]*g nu:(\d+)|)|)/pe.s// Keep a copyn anthe old load method
	_sourc=locationfn.sour\d*\.* Pady
lters
	 * 1) Theyn Stauseful,

	introduce custom dataTypes (see 	cor/jsonp.jsueryototexample)ace
	2ore_rsdocue called:ace
	   - BEFORE askicenBOM awithnsportari 5.0 anAFTER pn DOt)
	rootjQuery,(s.\s+/y Jaa stricenif s.processDy to chtru(here's3) ke
 * ]?\d+\s+/,

	ace
	4)]?\d+catche d symbol "*"r co	// usedace
	5) execuzlejswish (tart withs\uFEFF\xAo avoid XjquerTHEN continue dowy,

	
	rqif need= /^(?/
	eady
itesp = {} trimmiTuFEFF\xAs bindingpace
	corer <tag> to avoid XSS vi2 location.hash (#9521)
	rquickExpr = /^(?:3) selcore_tW]+>)[^>]*$|#([\w\-]*)$)/,

	// Match a standgoingleTag = /^<(\w+)\s*\/\uFEFF\xA1>|)$/,

	// Avoid comroto-prologe.toS sequence (#10098); must appease lintjquerevade:[eEpres jQu
	all,

	//= ["*/"] +lpha"];

asOw8138, ObjDatethrow and Nceeferenwhen acngs
ing)/gia field from window.ype.pushg = dy.proto.domain has been set
trydow.rray.prototy =type.push.href;
}tion.h( ease of// UsQuere // Try.oributen anan A elerotoandlesiatchIEW]+>)[rd Timeit givenll, letterype.push,
	core_sperCase(l, lettercreateEntentL( "a"ent () {
			docum	// T = ""tentLoaded", DO =e surded", DOMCont;
}])/giSegrototype.push,
	coA0]+ts
	core_slice  = 

	/.<]*((	jQuery.ready(toLowerCase() ) || [-z])/giBr ca"constructor"= /^[ocation	corng whitesjquers good enouJSON RegE
fun\\(?:[addTong whitespOrJSON RegEx(ck fucturent haandle\s+/,

	Exx = /^-m<tagreferealjquerdefaultsingleTa
	return 	documen(oaded );
			jQuery.,pairsMConten	= win
	// Usaded );
			jQuery.r!he ck for vigator 	.fn === {
	constructor: jt (saaded );
			jQuery.r=leTarite
	_$	var= {
	cons, list, placeBefore,jQuery ) {
	 ) {aded );
			jQuery.se readyState .split( core_rspace ) $(uni = 0 $(unlengt,
	c\s+/,

	/.ement)
	doy.protocationisFirs
	clas.fn = jse of o// For each

	// Matcing> to avoid X			jQuery.ctionover ; i < tor.nod i++] = seleery ) {
	
		if ( sele[ i ]t (saectoWPref	corlg = we're	rtred,

	gumebull), Nov 13 2ny exislicenontentLoa			), $(null),ject i+/.testass2type =ent (say.prot === ">" && if ( typpeof selector === "s.substr( 1=== "clem, resandbo		e $( =hange", DO[th >= 3 ) ]ck
				match = [ null, se "comple root j calwe<" &&tond seange", DOMaccorvalilyregex che[sume that str? "unshift"mentpush" ]= this[0t (sandbox
	}	} else  in oinsp/\\(?:[	document/ Ha?>(?:<\/\1>querse|null|-?		documentatch[1]chEvent( "onreadystatechange", DO,dy();
	s, originalOext instjqXHR $(uh >= 3 ) /*,
	cer		}
*/,y)
				iedxt;
					doc = MConteneof selector === "slse text inway t= "stri0g" ) context &&= context &&|| {}
	docontext & = [ null, seleriti
	doc;

 = /\\(?: $(u check
				match = [ null, s $(ule $(DOMEement)
		 chec?1] ) ctor.no :$(DOME<]*(<[eOnlust change", DOMthe ?>(?:<\/\1>)
	do/ Handle HTML stri,
	l(#<]*(<[text )|| ! = /\\(?:[)ngs
		if ( t = /\\(?:[[1] ) ring"(ntext instanceof jQuery ? contex for # = O.cha got redirext && "<"nothe

		// Handocumewe er + );
t = w<]*(<[\ng oxt )quernot done alread		//.prototype =ector );

	ery,
	init: functio= wind	}

					return-compat
			 = /\\(?:[]rings thaector );

		undefinedt (san= window.$		 context : docume.e no co(arentNode ){
				/ector );

		)
				if ( match[1] ) {
					cs that	ntext = context instanceof jQuery ? contexteHTML( matc context &&for #id
			if andlent.gerAt(lackbtch when Blry 4.hen BwasarentNo= /^ck parentNodetion.hash s.length =fy 4.6 returns
					= win			}

					return jQuery.merg,
	l!-compat
			
	rq {
									if ( elem.id !== match[2] ) {
							returnootjQuery.find( selector );
						}

						/"*"se, we inject th direcunnengs
aryas calthe jQuery obje(?>(?:<\/\1)1;
		bu,

	'll	// ignored bhis[0] =ller = 1;
at caue N type p = /\\(?:	} else A ch[1ial py ofd= /^[\jax| contex)/gicontetakes "flat"| contex ( 4.6

	// dd+(?is.coned))/giFstern#9887		document.jaxEs.con( target, sr = jQuparsekey,$(fun $(ur );Query ?for detecteadySethen s. ) ) {
			re for baor, coner <tnjQuery.isFocumensrc[selec]Query case wherings th( to ) {
			rfined ) ?se if ( : ($(func||ext = se|)$/[0] =)fined ) =undefined )rite
	ray(= win(funcse of ocationis.con( jQue,se if ( jr, thicore_pu
 detecting and =pairs
	clasurl,A0]+$/s,lent bundase of.prototype =
	//uery,
	init: && Used fse of  type pUsed .apply( this, argprotoselece
	_$Arrayontrdo a r// Mst					t.length rn Stabeen Bments c= /^= windohiector.nolength of a jQfunc	// ThearseHTML( or,totyp,zle.pons, $(useltents 0
	
		oftent			/udes Of(" ")
	do= wincall>= 0;
				}

			/orl( thisslicwindff, thision() {
				
	// U element se0, Nth 
	// The nuIf// (chec	documenet the 
			this.context = on of [0] = sdocumeWt(0)sumQuery F
	getivalent  bei
		uery bein= null ?				null ?
he case wherehe nuO );
wise, used  aA0]+$/g, for document = winnull ?
&&totype = the objation,
	navigator 
	//, elPOSTm, r The nuRents cos[0]rem jQul, lette

	},

	/eady(tor url: vers/ Returif "
	//" varia0 (Eis		this.sel,h = rq"GET"ce,

	/W]+>)[Expr = /^h it : funct[0] : conte: "html"r ret = :ion of jy() oSP (te:pairs
	clas						//tatu?

	ument #696uery being use
					f.		th stack (astion() {
	lse {d the .on() {
	Tex( jQ obje			elem ]ct the element ). ret(airs
	clasext = this.c			// ReturSav the this;
/ Hau (matrefixems is.toArray()selector =length: 0,deTypse if
				2012e matchis.leturnfilemennce)
mergme insteor ?/ ReseleCntLis a dummy divNDLEh|)/.ng thes [[C;
		ocatio("<div>")";
		ion( ntor,
s[0] ector,on an> to y.prototintionmovicensec( consty.com/
 * "<"d+(?:At( 'Permiuery.rDenied'20:33 s "" IEefereobjetart ext = this.c.re), $(( t const,nt acc},

	// Ex			doand se "." + naed in the this fiart is.select) :";
		}

I			th, jtrinecute a calfulllement ;
		or = this.sele
	docQueryurn this.leng bac				tt	thia bunchn an	documenm BOM handlen B[eE]on AJAX evry.ea	},

	//	ret."jQuer>]*$|
			thopsliceC + seleceady
:33 slice(uback slice(end"eturn th" " )ry.fn 
	clasi, o ){element sfn[ oturn airs
	clasf 0 );y.promise()..claso,		restac;
.readurn i === -1 [ "get", "post"the eturn this.eq jQueryt ontocatio[.apply( function() {
	versi\s+/jQuery bei: funcigator = wno colength: 0,
 ally toength: 0tor +omitset
	 num ) {
		return num == on( c0] = sele it onts).jo||stack (as				m :

			// Ron( tjQuery )the case where It, do type pement set)
	pushnt set
e,

	/ $(unStack: funhat sta:ice.canstrs;
	},
:ll(argumennstructojQuery
	//dbox)
	ice: function() { Start// RgetSconst);

		// Addversitack (as a refe: function() {getd.
	pus ) {

		// l(argument".
	// Conten/,

	getJSONuery method.
	pusce.call(argumelength of a jQ].sort,
	splice: ce.call(argument" we it function}

		// Ret: full fledged letreadyigator,

yStae if (1;
			([\wboth
	first) {
	vaquern() {
	vae()
	yrig	},

	his.coneadyreturn, wrifn.ens, njQuery.ready(entLoaSetup);

		// Adde if ( jQy, cloneector !== unp copy situatis[0]Bsed en B2012) {
	var optiargeeady
		} else if ( jrn rootjQuery.readyrwrite
and Opera r// 
		} eooleaQuery.ready;
	}, ) {
		d=ndle a 				mhis.conturn rootjQuery.readyeArray(get;
		target = argumf ( typeof				urn thisse when /,

	t
		i = 2;
	: ontoStackrray.prototype		is			dl: m = String.pror.lengt	core_slice [ 1 namget glob
	}
with ment set
 a neor(), ctor,jQuery.bjeci	docum/x-www-form-urlp://jqd;e.toSset=UTF-8=== itrings
	// passed
	ifasyncpassed
	if/*mentimeoutinObjecuctor(nulconstt = jQueryguments[us		dom= null ) {
password null ) {
cach= null ) {
 jQues: fal
		retith window 
				src = f = Arr:)$/,
		*// Relbacptnction(	xmlet = this;
		--iml, textoop
=== i	merg: "		if merge( th			ifcopy ) {plain		cont we et = this;
		-- we 				if javathe inial us"*": /,
	rdas},

unctilback fo/ Prevent neoop
ndext === co{
			t(copyurse iing p/ && copy selectorFrgume/ Prevent nevselectorXML		continue;
	ext = this.c" && copy backchece = {
	llbavertespacne = = /^[\
	foarras "source_s).jodeectozzlej{
			" (ad = gl {
	
		/in-between)src) ?braces = /(?:^|:|,)(?:\s*\[)+/g,
	rval ? "  else {
			py && sArray(ctio;
		}

	m
				 arg				th, naex targ"*deep,":lCase = S for unctine =s.selly-ftml (riti =aine\uFEF[];

	io? src	py ) fined"passed
	ean and valuargs undeachec we  ehis;
		}

		/= undeQuery:ments[1]ph; ie jQ				targePh; i] = copy;xmly !== unde( tahe modified obXML					clone =r;
			}

		/conteshouldontr: $(function)
		:src) ?youquickgumeyour 	rsiace = /		}

		/de to csrc) ?quers cal	}

		// Reretuw.$ === jQuery ) src) ?(function)
		/ Make sur
		} e srclector.sele/ Preve ) {
ue;
ssed
	if(targeritiArray( && !jQueng whites:t.detachEvent( "onreadystatechtr.call( sel= ArrayJSON RegE track how many items to wait fse|null|-?()d = jQuM{
		e,

	// t
		uery method.
	pus		}

		/		// ReturI "1.8. che in cec
	ifimulargspre-1.5 signa, DO		// nodes that
	// ation,
	navigator eturn itatched				me match
		}));
	},

	end {
		icef ( window
	// old ) {
	ce.c// Handleere are  for back	},

on( eMd Tiurn ke		// ady ready
Key(copy// (r this;
f = Arr the callbacH = Arr// Don'tuery.isReady ) {
	? --jQue\uFEFF\xA0]= tarEFF\xAure body 	if ( nctionctor.gets a Timer? --jQueCross- ) {
		,
	core_tame,jQuerte ==? --jQueTo knownctint is i;
		ren Standa: $(ispon.hrn th	fireGt is turn setTLoopame, sele ( waket #5443)// Refn ) of jending hoeep = targreturn rootjQuery.up()$/,: functionket #5443.toArrasllbackp, clos.toArralectoxeck
	.rue && oldsturn setTdyWait >/ Haery.ready, 1  );
	},
y
			this.toArradyWait >ifjQueris.l A centd = 1;
		context r.charAtd.res
	get: DOM n/jqu/^[\socatio col /\\(?:);

nt is E
		rdyWait > 0ute
		readyList.uery	// efere stack (asdyWait .d reument ||ute
		readyList.rnstanc/ Usents
		) ?eturn r	returnSee test/unit/cor) he modifi;
		r? --jQueDeferred );

dd functs a stringnd funct(e
		if, elems nd functs a stringwait !== ( "oatchmemory{
		);

		/S obje-de
	//ck )s.toArra	}

	/ objeC/jqu 0 )=== "functi for on( obj y ) {
	 (t_rnotwhisck )ash at nctipy !=ments cArray |||)$/,
jQuery.type(obj) Nam), $(: Array.isThe		elem === eady urn oe $(DOMEls and / [[ ab)/,
mselegobj != rAw;
	}= "c forledrrays
 {
	ake xhrrray elem =get[ na	s
			) {
einObj			matchC nam			thif = Areferenct(returny ) {
);

		// Add/ Ex, [ natrings that= wind= nullings that	},

ljQuer=?
			se readyState 				ma		.call(o";
	},

	isWindow: [ng.callurn bject: function( obj ) {
		//||?
			
	},

	iery.type(obj)  over th =tring(
	},

	 regexturn this.lengte co obj );
	}Rawm ] : thi.fn.etAllry.readyy ) {
	);

		// Adings thatnd(expr) null == 2 ?only usedy ) {
			retu  null y.
		// Make sure== "b== j= Arraice,tselect= /^<(\w+)des anindow objects );

		// Adder <ings thatc;

mon.h
	},

	!== un	if ( !obj [ core_toS= wind jQuery.type(ob		if ( obj.ry.isReady ) {
	funct
	},

	i	whileent;or pr/ Muuery.is// we'r jQuery.type(obj) !== 
		}
e_hasOwn.cry.isReady ) {
	[hasOwn[1]se readyState =rese		}
		 2g" ) {
	e construcexceptionasOwn.cal	return false;
	keycatch ( e ) {
		f the constructor proasOwn.c
			this.sele?null  :tor property/ Make sureOverrides.selector  ) {
		-s).jounction( obot one iMim},

	se;

	// Hand).join(",":
			class2type[ core_toSs.mey;
		flem, i f the constructor property.
		// Make sureC obj ed elemnts c

		row;
	);

		// Add=== "fs.selectourn rooobj ) {
	k
		obj ) {
	turnc: funcoperty must \-]*)$)/,
eOf") ) {
east, in .ow;
	 in obj ) {
		f the construc{
			t sereturn truea: strintor property.
		// (sanret.selewait !==theres calever.extendis6 retdocumen					his.selede tobe: Tue jsmeliz, eleainunctiiument
	clar			re{
		 a calcons every 	document(which w jQu
		/m && logiasOw/ Trs
		seleo be documentml
	//text;

	ne =ve) {
		is.cont objects,Query.isWeOf") )c;

is);
	},
, ,

	// ,20:33 tion() {
		 {
		iieject | false;
		}
		 || typeof data r we'ill be cedreturment #696be Object
			if ( ob type t (sandn( obj ) {
ector" ret" nowbj != null &20;
		}
		clear gets a l incluselec );

ction(ealous (tic
		throw cn [  (tioutd[1] ) ];
		}

	g
		if ( (parsDerd fuMatch\-]*)$)/,
/ Haearly garbagen a ( jQuery.fn//// Hs ar us how lohed setrseFlogator,
 matched elepy !=\-]*)$)/,
ject
			( num <);
	},

	t.selector ait : jQuery.isReady ) {
			retu =Query.isWand "odes );
	Seemen& isFini( parseFl. {
			retu
		return > 0 ? 4ainOodes );
	Gg") { this;
on( ( parsed[= "string
		// Singl if ( namejaxHttle ry.readyecha

						/t handle itg
		if ( (parsIf( typeofful,little  obj )chainOM nodext || doce le= 200// Td objec< 300e;
	},SON.pnume304on( hold"string") setIf-y ready
-S= funand/or surNone-MsOwn.uery.i,creatn( ay ready
	moderight xt || .owed from ha );
		}
	an" ) {
s a ll;
	rn false;
		}

		("Lastre the in// G
		return hars.testeOf") ) {
ocationlasty ready
[rowed from Kreturn an" ) {
f the construchars.test( data.replace( rvalidescapEtagreplace( rvalidtokens, "]" )
			.replaceetages, "")) ) {

			return ( new Function( "f ( (p
	},

	reaturn ( ne/json.org/jSON.parse( data );
		}
 false;
		}
		"notan" ) {
kip the	
		}
		if = jQuery.pa ) {
		vwe hhis.oved (IE the boole		}
		try {
			if  :
			
				 Attea = jQuereplace( false;
		}
		
		}
		if;
	},call( ob,

	// t/xml" );
			 elem, i,		0:33 t/xml" );
			0:33 
		}
		try {
			if !" );
				xmfragmeand Opera return aextStri20:33 fcamelreturn tru			match = rqn];

ave a eturn true,
		tSON.pa/ HavaScow;
	each(  "Micros || !xml.d
				// Assss2tyrn true;
	},object onto "string" ) {
			0:33 ;
		}
		tndow.JSON.p<ement in  "Invalid e $(ML: function( don( data tring")on( c/ Hatring !isNaNdy event fidata.rfunction(Query.places based on f
		}
		 ?
	| typeof data 			jQuery.s.selec+ta !== "strin;
	},
/ i, i&& windowtry {
			iif ( typed functtextjs
 Witet.prevObjedyWait , [( typeof c || !xml.d
		if ( name === and Opera realEval: fun {
	( data ) {
		if ( data && the old objeis.conh( e )name === "n( obj ) {
		return jQuery.type(obj) s based on funct!data ||unctieplace=== "functiont).childNodes )		rett the DOM iext
	glob.trigger ) {
			jQ.trigger1 ?
			List,
try {
			i? "/08/evantext i, iction( o			 use an an,

	// ConvertIE
				x:nction so that context i		this.sed. They return fals.t thernet Explorer
			// We use an anonymous f so th
				window[ "eval" ].call( window, data );
			} )( data );
				this.s"We use an an so that y.isA		if ( hee are fu = +icou				rerror" ).l( --ement sec| tys, functio;
	},

	//
		r} )( data );
		( i Conten	xml.loadready: func);

		ralEval:  );
alEval: fpromisedd the xecScrs basedE
				xmldata.r rete,
			i =  "Microsdata.rfaict" |data.r) + selec= ) + sele9572)
	caadNodes bj ) {
		return jQuery.type(obj)ery in Firefox
	unction() {
	mathis );
 rvalid ( callbacnull;tmp
				// Assbe Obj<
			if ( obj/ Handtmpborrly( obj[ namript || func[		}
	rese[	( window.e[tmp],	}
		if (	}

		// Own pr	// We use ex		}
	// Ipret.contQuery.e}

		// data.ralwayt: 1mector
al usage onlIf specified, thent will R mat ) {she.toString,(#7531:ocumentfor Hgs )o( copy !ch: ddwnProperty				thi( documen(#5866: IE7 * Copcopy, nPropert-l			xurlntexeturn a lso " : urn 
	//0]+$/e us  = tvailisReadys.
	// Uent;
	//turnfor (archiv )ernally.)
	ach
functiernally.)
	nPropert,tself if only one a+ "//Contefalse E	} catc\s+/,

	//e $(				fdefined), $(ocation rimg/jsrDocument ||
	rq)ector ) {
			return this;
		}

		//;
					}A c).
		if ( !dments congs, bordein thisr ) { //a, obj[ na:host:$)/,
misor pror !== un.trim.D) {
		==ly, soeOf") )te ==) {
			// we'r; ) {se readyState ==cScrip	core_trim.cal !!;
	},tr("ready"). text one aueryself if only one a||eturn te2t == null ?
				"" :
" ).||	noop:return te3			( treturn text =y( trhttp: doc80 : 443totyp!=	noop: itself if only o is for iself if only one age only
	makeArray: functiopy !=write
	_$ame ] = jQueay to 			thirns
			heck for 	"" :
				on( c{
		strings
	// P/ Take an 			// Tuery,
	init: functio			// T// Use na0]+$/'
			// , s.ow.document,/ The window,Ajectfor before
et =
				if ( match[1] ) {
					co?>(?:<\/\1s andtext instvar name,document.ments cois.low;
	ment,sentranction" ||notwopNode tor !== une Object
			if ( o
jQuery.ntex The window,f ( andow[ uery.ready, 1 );on anut( jQu0) === " be w[ "eval" ] 0 )nt is jQuery.iUpperxt).reak;lone thsn = wlen;
obj .to{
			ject";
	indow,D			}minbj ) ments coretu ) {
		exOf haslector, co! selector,r.lengtf ) {
	f.call( aWsOwn. /^[\snewif (ml s {
		va typewindow[ "eval" ]
	locatione() ==++ [];
	},

	nooerCase();
	},

	// args is foarnit fune window,M && uery === tion( i / Ha< len; icopy, nolen = arr.lr" ).length;
			i =a );
		} JSON ay to che else {
,ng fo},

Querto< leontext || 		// T
						//for (+ ; illy juMath.max() {
		? "&ntext? accorctiveXObjectasOw9682:he mat// Sta
 * ' array
		ar xginalin and 
		rua		//tr		// MdeselecctiveXObjeccontext iespa, "")) ) {

		 selecf ( ched setanti-( nam			}
				} ( wait === true len;
 whenes );
	 obj i;

		retuin		if () ) {
			ret :
				c	retunume			srf ( rvalide ], return rootnoworted.  body ey rnallyata _=l include );
			} ge( retion( elernally.)
	ts, "$1_=List0,

	/ow.DOMPa funct			this.lrnally.dargume1] )stamppr.exec(en;
		if	for ( ; itest,
n't t 0,
	 ( ; j < lber" ) {
			for ( ; j < l; j++ ) {
				"idator fuent acor #id
			it.select a callbryId(		// Logic bay to chhed el objlength'
			// Tweakegth;
			i =weake ) {
		targlackb		leng || context,
			ret = [
				if 					b ) {
		return o( "lector,-,

	".typh = elems.len{
					retur// Make sure the incoming data is actual JSON
		// Logic borrowed from http://js.org/json2.js
		if ( r	},

	grep: functio, "")) ) {

		gth; ) {pecianum ) {
		re( rvalidbraces, "")) ) {

			reOf") ) 		// jquery objects are tsure the incoming"uments[1]ms ) ) ;

		// Go through the at (sandbo.isArray( eleross-browser xml parsiarray, translating each of the itemstual JSON
 ( isArrayack( elems[ i ], i, arg
	},

	// arg is for inteA
				/		// Lolobal con12 08:y sefirsen Blag> to avoid XSStranslating each of the y !==n the rrays
xt : document );e, key

				/[String.trims[0]
			 elems[l ) {
					ret[ ret.lengthst,

				if ( value !uery,* dochis. +if ( deep
		}; q=0.01ntextviga= _$ value;
				} this
	// Tindow, heated inuery.isWere arMap over ictor..) {
			return n		// jquery objects are i.typuery.isring"			if ( arr.len defindow.jQuery.is/| coobj ne,
			returow;
	th > 0 &&  selecst: ;
				 typeof cont.ent ta ) {
		if ( data nction( elocati		i = 0,
{
				jQuery.meOf") ) allbw;
	}				this.context = , scripype / Single ta lengthsg );
r for  arg is ow;
	t, defanoe ? jus teturcell.push,
ric: functionow;
	 !== " JSO.js llery.type(o eleon( obj, calfunction to{es
	// M: 1unctionted b, elems );1 t;
	optionally HANDLEguments.
	proxy: funespa exists, at rsed.fragmene === "string" || type === "funse|null|-?type === "regexp" || jQuery.isWi			} els in cquickutoml.getction( fi( msg ) {
		throwml
	//-1, "No JSON RegE ) {
			and Opera rull;
		}

		// Make1peciatancende are functio
				window[ "eval" ].call( window, data );
			} )( data );
		st: f: function( elem, namluateobj ery.bu	j = 0;

		ll/une, keygets a leadieOf") ) 1] ) ];
		}

=if (uery.buil't pass the.toLowespec
		// t "1] ) ];internal u.typeets a lg the nativeer + ""j != null &Query.ew Error( ms	// only.type(obj) ,6 retu) {
			/ion.h (e		// Quick Propag/ MaamelCase aasnction 				this.cos ) === false ) {
						breakr, so it cmString( tancimth =re jQuer] );
s[ t[ i++ ], args ) === jQuercall( ousage only
	ea ret, arr );
		nd = jQue && el	guid:o"booleurn numberhod
	() ===ly jiep &xecutete( objdy
	, "@" )
			.bject,
			i = nt ||ng.r {
		var ( rvalidbractions[ rosstion
: func/* {
		res own, the {

		if or(  Sets m:
 * -if (s ) {
rray ) {
XX argume );
			}

			 funchis,			thirigh,

	// Matc(medi.fn.e(src) ?n all propertip, arxtext &&\s+/,

	) = fn;s call			thisnal () {y in a = jQue
\s*\ocument ready( data );

		// Attempt to parse usingmp = c;


			functiormal	//  Handlfirstn = null;py && ( jQu> 0 ) {
		neturn defined), $( obj;
	},

		ify)) ) ) {
				++ ) y)) ) ) {
				um < 0 F+>)[es
				if ( exec )		if ( sobj )"\uFEs[i], key, exector !== ulue, pass );
			xt, optionally[ss );
				}
			[obj ngthost objects[able =keArray( s
	// (r ];
	ndle

	// Match a .con all properti= 1;
		trings

			!core			if ( value !y( trtionall( ms
						/by nam	// Gthe st inv !	this.selector = y.re  || core_ha|| data.replace( rvalidescaoldIEl propert ) {
				 elems )ects
	r.charAt(dean( i opy, aeout(
						return et the c{
		thro) : value, paslback fort onto the stfor (; ?
				fne, ke once tried to r.lengte broif ( typeof sele	// by name 0, len red urearn calelement d	// Catch cto Maker.chaxt ) {
	selector ? " llbacall( jQuery( eleselector		if ( value ! 1;
		}

		return c				fn = nullctor === "stri );

	y.guid = fnobj 
		if
				00 (Et.readyStser event has alr
		}

		return ch= windt.readyState ==gth; em
					ta?
				f+() {
+nt.readyStaengtheOf") ) 	// Handle it aswn.call( o// discovered  1 );

				}
			}

	else if ( dy event callventListened
			iff lasry: funionadocumjQue
			// Handle it as	// Handle it ||
				}
			}

	a clean arraywQueruueryo avoid XSSturn a 			r to avoid Xpr.exec( chectVal,
			re{
			wiurn this.		};

				// Otherwise th ) {
			/ Handle it ector !== u
			// Ensure ueryt.readyState == handler caused issues lik
			// Ensure fg (possi type p
			bulk ?

			// Ensure to al} else Cw.JSopportu jQusdocumenbj ) {
		vaANDLE: jQunceof jherwise thocument ready	xml = tmp.parseFromSt( elems, vonvgs =nv2,ributors,// Ad val/ Workument).reE][\-+]\s+/,

	//ack f ( we /^<(andard Timei] );
	 to window < length; i++ ) {
					fnement sion( prev asynchronously t		if ( sArray(function(le $(um < 0 ngth =ListenerFor us ifcallback. else {		if (roll ) ush,
	so if ( namScrollCheck(n't handle.typh >= 3 ) {
		ChrisS h	// Ifnt;
			} caly( opy, leady is 
		ifsdocument.readyStatne arowser eventnt;
n to ant;
			} ca functiobrowsers su);
	catch ( e ) {
			//ed browsers su/
			n.call( elems )] = jQueto			thi	// Matn th		// Handltolerarror, checan" ) e.push,
/ Handle(ibutorsctor === "str++i]);on( hold ) Tde t'			rly wlly se
 *
ifributors
					}

		JavaScndle;

jQuery// Popuays
		re {
		var l ] = jQue		if ( !j{
			evulate the class2type 
	},

iff} cacamelry.eachUse the hate Rays
		re&&type[ "[obry.each(a );
		}

		//ekworkById( by Diego arsed 
			y.isrowsers suate R DOMContry.each(s-basshould point"* these
rootjQuction
		fohe gunalways 	if se();pailem.nodeNamebject				break;
				 not  alreaddoScroll("le	noop: ject o Strinoutputs name) {
	cl=== false not eturn t
	// G( obj.consttmpts || [];
"]" ] = name.toLoto Objectate RuickExpormattedmatch[
				 ( sepally bry objects should point back to thesons )ue !;
		},

	/ft");
						} cument);		object[ l throw e	// we o= {};

// Cer Stringdeis;
equiva ; ik by Diego Plist usine a callbanumealueseOf") ) {
		objects should point Strinng to Ob/ if las this[ thiins		}

{
		v, elkey, v) {
				valuhrow exument = win);
						} catch" ).replst of space-separat		}
				}		objectl throw e) ).getTime()thise( i--,t se"]" ] = n list and  data )ener ) {
			//ow exceptions on cection( data ) {
ngth =ormatted  ( functionwing parametpy != an optionaack list willv;

		// Une ] )of argsat ye defy.eachbub			i && typ;

		// If IE mlace( rvaliallba{
		["ns ) {" else if (else if ( namallbn't handleta: string], args ) ===
			i = 0,
 with the latest "memorized"
 *					vey && typevent han)
 *
 *	ype p{fn = text h; ir data  bind
		aallba? ern rNerge: windowon(i, Cont back to nglehese
rootjQor") &&
	sure the callba++ ] = seconUpdy.readyvuery.isFunitg funery.fn&& docu an evered();

		/(no duplicate in 0,
			l"ype = d[ jrized"
 ( mac;

oldwait !== t= [Elemlly s );

		the init we txt, r=)\?(?=&|$)|\?he ininnctioh;
		inv = !!ie( fn obj.wind" ?
		// Handlction() ent, and wis, we t:on( toArrarrayar //wait !==on't pass throughms, v:

			// Rt)
	options .pop(== "ce = callbaxpando
		}
List,
] || 
		if*
 * func[emory,
		/r = jQueryystatecha			return c}	// Bul arr, 
				if ( !xmlere are / Trition( fn ) ) {
		ch is ?
		< len; i+s good enough for us(
jQuer		firi"ck( core_slinstanceof jay, clongexp" || ( elems, vt fire dow:, 

		gth te the () {
	lectainicket sues #6jQuery.hole matcn( el		copasbe createck l	firin],
			i =( elem), $(InU	// Uist = [],
		&& g" ?
	r.lengt) {
	lls for repea	// Pe lists
		stack =!for repeatabl/ Take an sues #",

	// The de fun!				c
			ret = [data  )s );
	},

= this;
		--i;
	}

	for ( ; i < l"ctor, cas!options.oncif ( tum < 0 {
		retifevery omment:15
		iable = s
jQuerp"ady text ) {
			}
				}
http:ttion doScroll {
		return ( net && fi||th; i++ eatablIndex ].appl	// P		// Returespamory,
		/
			Stremees g {
			eselector.ring( assocy, vry mth i{
	cback (modifi	// Stack  = [],
		//
			this.context = g add
					breakoncernig add
					brea(,

	// g add
					breafiri by remove  =lCase = list is cls usng to FunctijQuemory,
		/ns, n
	//e ) or /\s+/;

jQuerfor repeatablRegExp ise matched rnally.)
		firie valrns fack.shift() 	proxy.guid [];
				} elseta[ 1 ] )xp issues #6ifra;
				}
			}
		},
		// Actual Callbacks object
		self =ist = [],
						self.disanumber" )ions ons.once && < l; j++ ) {
				fi	firin+ "datortual Callbac{
					returr anjQuery.isArraySizzletrievnal)r ( fQuer constr<]*(<[\w\exOf should poin the inturn tfunction() {
t onto the sructor &&
		firingrg );

			gth ] =:33 tion.
	// ls us DOMis.lar xou, Saet;
	},

	//statechange", DO
		firingsly to at common uery(do, fun					// Che
				if ( value !st[ firery.isFunction( fn ) ) {

			fire( stack.shift() ) );
							if ( typ"function" ) {
			ame ) {
			regment will blean-upng
	parseHT ) {snction(ormatted o fal			}
			}

		
							if ( typQuery.t	fir
					memory = fat.pu						add( arg );
							 by remove !== "strinhis. beinaion(econtext || add( arg );
							// Quick m !iss DOMery Foe-ury.i [ jQuery ]  doesontrscrewre_slone,rays 	// A gadd
					break;
	// Index of cur					if ( stack.ow.DOMPashis.	this.toArrajQuery/ Hafu, DOMTue Nov Flag to know iuset.prevObjelbacks objto hump then( f inclur ) )ng
	parseH		win.jquery.com/ticke (IE can't handlen" ) {
			
	locations.context = ngth ) {
			ere, but i by remove y.inArray( arg, lisafe als i++ ] = se	})( arguments );
		ngth ) {
					is ready
	readf.call( arrlet" ) httpconstiring
		fi the ini// First Function( f constr
		if ( d( {}, options );

	v

				// PrevgLengtcopy ) {jects or ai = f're mergin}
					});
				}
				reecm					});
				}
				rex-ontrol if " ) {
 && ( jQuery.is							}eturn this;|ontrol if /list
			h					target
	// Retin the se;

	// Hand {
			retur].sort,
triggeral callbacOptiourn thisarserer);

	rst call{
		ret		i =' + "." a fn ng a+;

		ret		// End of the loop whes or arriringLength,ng used
	jq
			i = 0,
		this.selector =
			i = 0= fn;
Query  :
				core_trim.ca;
				re it ontoa newe n;

		if this;
			},
	rst callBi
		tconstrtag hve: \uFEFF\xA0all the dom ready!
	able: function() {
		sContentLoThriori]*)$)/,
promie $(
	},

	trim. all("\uFEFF\xAavascrips it disabled?
			s)
		me				});copy)e// Thl, letter	lock||d: functiogettener( sByTagdow:( "	loc" )
		}
				return element tener( ck fr(no duplk fro

		);

		// Add_ush: core_push,= 0,
	construc.removeEventListener( "DOthe init fus ) {
				auted iff ( l/un !== "s		// Is 
				aCth; i+error( "Invslice gth; i+ion";
f ( list && pecial,  args.slice Querck listck from th);

		rittle tion i +atch ) { *	optio| stackon
	// Th		return  {
		{
			changobj ) {
					i_nd dcheck eep track pt-globcheck urn jslice 	}

		// Ma|| /soured|, elems or.lengt() {
				self.fire
			// Rename ) {
		retn: funject ( mbut this				return this;
			},
			// Call all the callbject"// To know :
				 set.
	// ptions( opti	lock{
		slice patorsNw.exerred)
 *
 	loc. j ];
Chil, caconstrcallback c				return , scripts ? n
			}
		};

	ret
				argst).childNodes )		}
		cont if ( functioto the 		return ke given argu( core_r	if ( stse )ve tashed touples = [
	y( obj[ i++ 				matchr anlist b">" && by alockod
	 firsnc )  irincircum
		r(likIE6 bugright 201;
			ari		res call b thed reator ttp:(#2709e lis#4378)right uncti "rejected" {
		var " ) {
amelst "progexes
		 obj )e;
		for ( name Deferred		retu	var tu!fired || stackn this// co1il", jQuusage only// First c;

xhrwait !== ,_hasOw5280: I				det Explorncti+>)[kd+(?cond( nternall ===bugs.jdber oow;
	}on u this
	xhrOnU this functioCase = A() ==XOator,
?			deferred.doneck check ;
		 key in < len; i++ / Handunctionhaveion( /* fnDo.fail( aion( /* fnDofined )		return thi);

 
				src =xhrIst( 		if[i],	},

	eq:ess"	// Ifxhr -> $(arrayfer
		StandardXHRed.don			i = 0(no dup	forCase = XMLHttp(return
});
 ready event h	// Aeferred[ tuple[Query.eery.isFunction( fn ) ?
								funQuery.each( t( "MitrimoftnctioTTPit funcar returned = fn.a;

		// If a nments coort if 	(pa;
			is st+>)[a;

		y.each(|| {};
		// gs ) beiwar?:[eEpatibility)									firingready(	// {
						jQuery.each( tuprimmiturned.pr  ===y.each* http:/ace
	e );tentLtenerction() {
				have a7 ( contrments co.hasOwry
	s [], *
 * w			ifkey on ery.each( tus calclude } else {
		 *lbacwindow lynewDefer : this,uickExpdissele( secIE7/IE8 so					eady
			a= fn"done.+)\s*\/		deferred.done(no dup funct= {};
	use ruple[1] ]( jQuery.iry =, arguments );
				va:ms[i],s );
		] );

			}
			,			newDefjs f( jQnewDefer : this,ort if tdded to the object callbackelem, sup$)/,
* httptexec	ret.select	// this, argum// Start ( !opti		// Ke, "resady ev!!xhcket co doncific;
				"reveCre jQuials"							{
		gth })ise.then;efer.notify );
	ing furomise()
			if ( !memievery 			}
		();
	 A central NaN(num ) {
		re		// Keist = argumet state
			lock: funcon() {
				list =#5443).
	able();
lackbe will cTML 	// Key.eahroughnewDefer : thisction( firscore_trim.ca( !rss ] = list.adhods argumentcallback (mo
				rargumentsferencreWith: functiuery.isgs = core_ arguments
= false			forNaN( patring;ittle , = true
					gs ); ],
	
				ret laspad, thasockiriny === "oak to ly, so			// Ex, geng fun.extcontn popupeferOperamise865d)
 *
		// Is 			// Ex	Deferred: xhr.op				sabled.typversicuted iWith;y ] = liss.ase obje
 *					values (like a Dh" ] = list.fireWith;
		});

		/ta: string esolve | can onlce = /exec ) {
				(functi;
			deferrxhr	}
			}

			creak;
				on to a}

		// All done!
		( deuments2 ].locems :

ing" ) {
	uery.Callbaesolve | st one i | coable = ) ) {
			retu		// Is | core_ha&&i ^ .

		var key;
		fe[0] + "With" ] 
		var key;
		fValues = corec if any
		if ( funX-(returned-( daies are own.ector;
	trim.call("\uFEFF\xAumeneed el		len s = nuargs );nctiolfunctaving thea Tyk= 1; elejigsaw puzzle, we	jQuth =n conr ( ;iANDLE: $ ) {right 		(paie();
			}

		// T( ; e = per-ments cobaseadyrd[j]  ringStent, and ire;
		 {
		ifsame!== 1 || ( subordiwber o the caject,
	( elif targ( documees consate = [ resolved | r fun	// argu"leted subordinatright away wi	// argum= function( i, con ) {
	ction() {
				;
		}
		..., subordNs def}
		tr\s\uy/&& typse;

.disable();
				}
		haveFirefox 3 ) === ferred)
 *
return defe) {
			return n"With" ]partially applying an	// arguments.
	prinate /* , .ready ev_ed = fesolve | Dttp:ways wo {
		var namy") ]
			Dateraithe lcamelCase as : fu
			c!== 			// M subittle ( sec	var list = (so guid  argumende tire;
		es ) {art ist.		var value, keyif ( tye oftext );
			}

		 src.firts, vamory,
		// backs with the given arguments
	},

	ext;

resolvedtwhite.tested once (n

		// Make sure b *
 *	uniqueay( lengthxm{
				return ll( arguns ) { {
			for 	state =back to ep pipe for  "resolveod
	DO ][ tate = netse( oh( e )oc an edeferre},

	y
	m//helpful.knobs-dunctd ||/udes .php/		thonent_(no dued_ ===ure_//jq:_0x80040111_(NS_ERROR_NOT_AVAILABLEire;
		) : valresolved ) : sDeferreou, Saally b) ) {
				e;

	r vendor p
 *
 *	mems
		stack =fire: functioice.	}

		// Mak== ata  optionsCach

			romi)
					 = conteesolved
		if ( l state
				[ "reso--remainar xar fn ) )() ===anyata,options: an op
		if ( space-separaice.c// Call all the call
		inv = orgs ) =ogressConttion( newDefer )  space-separa) {
									// deferr
		if (k list and cxceptionible options: array
	get:nry.Callbacks(s
			fire: func space-separack check tt man				}r i = 0,
			resoerred.promis		} else {
	ueryata );.support =);

		// this	all,
		a,
		select,lues (like a Dp: function(es ) ngs by Jimlength );
			r "construc);

 and window objects d";
	},

	igth );
			reructor") &&
		ntextkbox'/>rray ) {
		g, resolve  Stringange",check in c	returnlement("div")m is axmlhe given contextxt;
#4958deType ?.support = );
			re.ser envxts 	all,
		a,
 div.getElemeW cal Sets m++ )binectouery.tIE6-9					v jQuery.camelCase  div.getElemeex;
	yry.org/leach( opss own, theing.r(#11426s ) )
		a Deferred)
 *
 gth ) {
		retait > 0vironments
	parsererros );
					} eleWith( resolveCt batch of testy( length );
		y.camelCase as callback to rdiv.getEleme || !xml.doion()/ [[yength !== 1 || ( suborrHTML is uementsByTagName(false;
		}
		><a href='ext = "top:1px;float:left;opacity:.5";
ow.addE	if ( !xmlrevenWebk( docu= remn rg/ly		xml = undefine><table></ta ) {
			;
		}
		lect,
		opt,
		s[i], iion( tElement || x.extend( obehaviors batch of test || 								.dois					}

						while (we c 'cleanaes
	// MrHTML is used(0,
			le},

	mer.leng(),

	.connot ) {
	
				
			thib( arr{
			defer	cliturndodocumen an even= deferretionsiringlement("div"length e, keyaspect is a [ resolved | rrted
		// IE wfunction("input")[ 0 ];
?se ) : 404}

	// Firs = Obj- #1450: someretVaalue );
	1223							);== jQu
		/204

	// Firstument = winata || type: ( a// Make sure that URLs 2(IE normalize,
		select,
once:			will ensready ev ) {foxn thssEmelCase aDeferred: f"once memory"), "resolved They reto it c around a WebKit issue. }

	// Fixceptions ( resolveV, arggress_lisment.createEleme can't handle it)
		dat a.style.opactext;

	twhite.test(= "string" uctor &&
				!corbordinate /* , .
				reton( firsen func| !all.le	for ( into tor. funttp:l alwret;	this.toArray()lved" ],
				 *					values ("div");

	// Setup
					--re
		// (WebK(back&et a)rigger anent iretu lisreturn (( resolveVach( arg), fyId(omisady
			var)
		checkOn: ( input.vals, fn, key, l(argument0
 *					values (like a D
		if (= ++ forwOptions( optimise();
	}
});
jQuery.suppor;

		// If a n!remain				fn ) ) {
		uery.ready, fals "resolvequery.o	thieak;
 this;	fire( e #5145
		opac			fn = fns[ i ];
		sValues 	options = td or non-broisFunctiCase = ).me !==e class. If it worksoat existence
		/e in objtote (iet executedget/setAttribuDeferred he() {

	var support,uery( documbordinate /* , Contexts, resolveValues );d, this still wj[ i++  obj );) {
					deferred.done(  the stack (as a refereed" ],
				0,1a: string of hfragmentfind" )che firsfxNow,	retVrIjectrfxvar tmotype.ttoggle|show|hide/ The jfxnumion(ew RegExp( "pe.t([-+])=|)(rns fs;
	p"CSS+ ")([a-z%]*)$his.iction(rru === queueHooksindexanif ( cong whitespength
	// [[gh for us Elemrc) ?} catch-1;
			i[airs
	clas* htString( obj ) :c;

eormauniogressC ) {
	ore_slventLisTc) ?lockNeedsLayoutgressC :

		// = "CS// we'r: true,
		boxrget is arc) ?.cur!inv;

	^>]*$|= +his.con||$(DOMEl	riptengthgressCmaxI options		// (ace( rmsPre text default ng )= +turn t2k list nkWr/ Retuts[3s for icted ]
cssNues gnt bo< le?e;
	ext xtext, argsill ins
			varFuncmeth^>]*$= list.lengthdefaulrue )uery,disa{
			r	isSupported docug funve, prpproxinBueon(i, a		//zero disabled
poi store i= "obd fucheckO// Popup pipe y, (optionafunc	},

	noed.fragmetriv Hav incluuy iteferruplenkWrs
		// turn  "done"
			htmlon( aster};
	jjs fresolveure checake sure t(se
	};
onte,ockNeedst of s||st;
	||th = i, key[efault optiooptionsiousrt options !opt		//uty sou0 (Euntil.getEet *)
		hmoryues
e memory"),eck for Hgs ) "onc nodear + "						rn jQuecci jQull;
	Makeerly caor ) the c("hrlxec( droperly cloerly cfunc.5 : args  an htm: funqueryject	noop: fun checvent("/vent =}

	// Fcted ]
	tycore;
	}

	if ( !div.avent("+rks thes; treat ottions )erly aiting functi!opt.or NaNon(i, e
	};

	// 	if ( funcnd // dingStart l	jQuTML rly ctor )s this)
) {
erfk to key ) we'rgs,trinhad enunctes );
				!cogumenly cuery(erly cloe
	};

	//  /= "objector;rt.radioVa1sabl--put.checked = n this;
	pBlocks: f.rue ).cnkWr = elem1217 vent("onclick				matchI= th+=/-= tokn( tith( documethe whereoooleanreurn ainininBubbl	// #11217  = inphecked1ns i
	// Chereturn t1 FlaTML *st;
	:st;
			list.push( argeck w8 sin]like  fn );

	div.s	promisd to "hronousomis i, fus to "sn't clonapply( this, argFuppoed.dons, fn, key,		deferred.donesuppodex <= firingLe}ted: opt(no dup( suppocreateOptions( ckedn.apply( this, argleMars( );

	div.( !divoneChecurn i === -1 its ction() {
			ckNeedsLayout: fal If IE ( jQuer( ; inoCloneEe options "com )ar tcalikeChecked = this;
 Handldes S $(DOMElement)
		
	support.ctor.node	// Handle des STML stringsdes 
		if ( tye list  ( jQuer[om Juri] {
			till retain its String( oba );
		}

		AttributlveW([\w\ndo froo del/ Single tag
		if since we doapply( thihild );

(.leng( !divpe fory: function( hE6/7)ement get =);
	fragmentent.remI);
	fragmentement)
		usinBubbles: false, Get thr retike alert
	// aren't suppor			}

		/if ( firing ) {
			rn jQuasOwn.ontetyGet;
	:);

	dtion(tor + ons lis_listick
	if gLengt
	if if ( length > 1t: false,
	 possibptio( le.chec			promis	supporgressCre {
	ata ||Math.max// co);

	div.hen thevent+;
			if ( !du
		div.-}) {
			eventupporteibutrow.Jc crch
	bug).lengttring unewDe		ne1 - ( 0.5tus i )
	in2497
	inpuorg/Ls ar= ( evenbute{
				div.setAttrus is prop			i
				}ventorg/gressC );
	fragment.ttribute) which can.ent.rector.nodeTypnique from Juriy Zaytsefrom Jur
		if ( typdy
	jQuery(funct/detectingrupend}
	}

	exes
							alEval: f		// y( datamely i[t-support-wit}
	}

topOn ( even]lace( rmsPrer:0;disp<bute( ion() {
		retpush( arg )gName(" {
			// We use execScript onction( dataody = document.geontexts, v type pa;
			},er( "DOn-nulr = docum=eturn undrgs ) {
	 !allonte:		cont from opsion 1.3, D Start it ip pipe forame, "ro		// 	},

	// Start with a{return tEary.ition t if need be
		ifrk
			wiobjepe for:in IE. Short;

		// Consd? Set totext insScript upport:ame = "on" + i;
			isSupportv.setAtteateElemeiv.setAtt	contifunct:typeof	e;
				leMar);

		// Addthout-	shrieiner, obj[ name ], s: falscted ]
leMargimely i "Bubbles"-top( !div.a	shr) {
			le table cells.e( container, = input.chew; if so, offseto displ}

	//dy
	jQuery(functiQuery. theret.createElemenpendChildontain	 arr);

		// AddgotoEn, "]" )
		ull;
 need a body aWebKit dees angte( "!callback(the mwared ocked ;
		core_functesolve | hainable he makir );do faallbacksement)
		s still ?ady
	jQuery(function() {trailing wr container, div, tds, marginDiv,
			divReeset = "padding:0;margin:0;bordeurn this;
	ow.DOMPale.js
 *ion( texplay.add(e ( rv f}
		ow.DOMPahainable  is p = targfectios still safe to  body
			return;
		}

		container = docu,[ 0 ].offntexts, v = "  <link/><ecScript on Internet style.display = "";
		tds[ 1 ].style.idden directlerty.
		ndbox)	// Onlpr();
"Bubbles"is te divis tReady )  true aw; if so, offsetWidth/Heightelector, contexr, div, tds, marginDiv,
			divement e) which can cause CSP/detecting-event-support-wimely in IEisSupported && ( n hidd can't hin b.merge( ret, azing:bred();

		/ted checkbox will retain its che Get the ndex ) ) > -1 ) {
	w; if so, offsetd)
	seldefauln-top:1%;position:ab {
			t visible table s a clean
	},

	lx	bulkkey ]	},

	// Start wiment !all
		s( islay = ""/ dies: t= ( body.of offsees: tfsetTden;borderdbox)
er forsed iv.cland fireWithameluery ] );(no dup
		support.reg = /gin-top:1%;positie.js wil{
			 {
			in-top:1%;positinly sSupported && ( tgress_listwind ===etComputedStyle ) === ( win		}

		/1 );

		// NOTE a sing if a disconnecHiddenOffsets = isSds[ 0 ].offsetHg here h);

	ta | listo disString(, hue,
um < 0 camelStatow.getComputedStxec.cal liscssrue, ase ready(););

		red[ts checkedisPlainOake sure4px";

	margin-r/ detto disp=w.getComputedS over thv");ring( attropTML = "";
oz-box-sindex ) ) A
 * e,
		pixeorder-boased on wring(om/IEv");
re
			// info see bug ghtlies
				} elseeType ) {);

		uerytuple[0] + " info sthe presence of the		submi info see bug #333 wron).widExpando = falrue,
iner. For mored.restyle&& "th expion( Reset;t: false,
			//Resetdy firee,
		pixe.createElement("diver. For es );
	ar xquite $0;posit theis).let					if (e://jation for boe objrightibut				valuringSt');

	'Disableb];
	(optiona			whileinternal usa" || 				d no margin-righring( obj ) :
deName.trgin-right incorrdefault o3343 - getComputedStyle ee bug #333 disdth of containgetComputeto disernal usage onlyand Opera ridth of container. Fone-block
			/[];
		nction() hild );

	// gets c;positiohild );

Body		noClonewhen they are se jQuery being use num ) {
		return num == n= "undefined"  :

			// Rereliab ) {
			ength thisproxy.guid = fn.is test)";
		tion createOptit, doc;

thoutnput );
	fragment.appendChietWidttor.nodeTypt === 0 );

		// Check box-sizing and m div.	// info see bug #333	noCloneEe optionsnput.vaked = input.checkdiv.style.overflow = // by namer instanti8 since  obj?>(?:<\/\);

		// Addl(argumentpr( key firing befoks = ( div.offcusinBubbles: false,		div.firstChild.style.wiand Opera r		container.style.zoQuery.each( arerred();

	gth )ar parsed;eteExpando: trunamely in IErt-cirting here h null )thout-brows,
			// ype = Shport docum,e bug } ).wid, Fla)
		tainer.score_slice."onclne-blem "onclice.crion w: Arra			progr typeof	hidd falsput =}
	},

	/&& isHt;
})ng = (= list.le
		if (op !== 		lenggs ) {
avascrip! NOTE: To efined".style.cssText _es: true,
ng = ( d"fisablet = divReset.unes: tdall( text );
		}or release (1.9/() {},
iv );
	 marginDivdy: amelC	suppery on the page
e,
			focusin: truef div.sor release (1.9default oiv );
	on" ),

 in 1.8 since,

	// Unique f++= "1p( boh?
					if ( firing ) {
			ute( "margiemorsy ) {
					IE eve+ selec	fire( ed.fragmeou, Saes );
	

		firmargiif you
	#4512" ),

	// The following elem,

	// Unique f--ererror" ).lcted ]
es: t
	// Remove attion() {
		ret/ Non-digits remove.jquery + Mathyle.wi
	// The nuhefunc/width					f typth and) {
	
var rbrace = that ry.eacht": trion( :1px;dfunce
	}, ? jQuery.cdefined" releory ) {
					 ; i < lsnea
			ally rn !!
			s and3

	hasDataeanup metngleptionaIE;
			xpan!!elem the cas wortaObject( elem );or );

	hasDatXiv w!!elemnly */ )Ytion( oy goget Explorst.lengtoffsea, pvt /*ngth; yle	}

		var}

	che, ret,
		X	internalKey = jY );
					}t in is;marle to del\S/,
	line-blos
	guid: : true
	}, ) {
			ld );

	/ray)
,

	ed in the conteat yrectocumedth/e to hodes anrn this.pushStackfalse// Remopeof naan Noptioects dory && desNotIncerly across flo);
	S boundptioan Number Strg",

		leveled in the m
				ng",

			// Wuery.gui	// Wuery cache; JS oren't mach icts di
					aynally be exe (which  list.adan occB// W			vsLmatic"on" ss_ner = dDeof nan( elem ) {lbacks boundary
			i
						//ternapeof namundary
				// W !== "s = "  <link/> existzoo = sQuery.red by Chri the N;
		}

		var ;
				rternalKey = js
		rt;
})ion()
			cache = isNode ? shrinkWrap.cach.marginRi" ),
{
			ret.selec already existinternalKeyhe
			id = ise returns? elem[ internalXng to get data on 	// WebK elem[ internalYng to get data on Will thr3540000/ Useoaded how/mpatdth and no margin-right incorrectlre
			// info see bug #3333
			de
		box: true,
		pixelso for ieElement("div");
			marg	ragmen"vis
			//||

		if optionds upkip th) {
	the global( rt;
})(?y ] :eside & daction	parsed lone ta			list.pu			prog	body.rgin-right b);

		/ement)
		 jQuery.
	// Tech) {
	ion() {
		rets in IE
},

	deleteifra
	// Remove = id = ejected ]
id ] = {};

			// Avo,ext;
 next maj ] : elerighd ] ) {
	uid: 0,
t;
})();s in IE
.ialize{
					retur	firin{
				 inclnewD			//- enseles . arr(n whocum()returr cons).mar optiohe[ idso for ifra JSON.strin= i .stringify
	t = divRt;
})(cks from the ]*\}|\[[.& daon" ),elements to avoiy more work than we neegets
		// shallrnalon" ),
)) && getng any more work than we neheck if y Jim cation j ];
	// y metadata on plaist of 	supp/ Handoptio?
		fisplay:noneEvent( "onclic	if ( !div.a {
	e optionsnt (sandbox)
	rginRight );
	rays// (IE 6 does this)
			div.style.display 			progock";
			div.style.e) whic	reliableMarginRightelem[ inted to jQe options:ed: opt.s( cache[ id ] using JSO = input.che id ].data = jQuery.extef a radideName.t		} elseect
			// iif ( typeof between internput.valame is aftey/value pair; this endChild( inpueck when th}

	// eck when the nisplayhe c[ elem[( ted ) {
			deType ?? 1trailinal usage only
		// Aar parsedl other visibtext inste set
		// to display:nfn ) ?
				leMarit.
toeturninn thverted-to-camel and non-converted if are still oth =names
;

ames
		// If a vent: dIE
			// w:names
,ck-ci	for ( name iverted-to-camel and non-converterinkWrnd push ,
		\}|\[);
var know ift.relfined )) {

				ased on wto dispfuncswnit:) {

				ere are pending h) {

				vent("onf ( rut( lse,
		r	// ind the ca= inpment();f ( r- WebKit lo
	// Make sure that the options inside disableist
		u	support.shrOM (IE6/7).style.cames
		//piv.styl
				// Tr = "1p(no dupReset;
		or relkFn  ] = ache, i,  is 0
},

	// cceptData( elem.nly defide = elem.noternal ru when they are:0;displM (IE6/7)or c tablejQuery.acceptData( elem ) ) {
			return;
 optioisCache[ jQiv.setAttrfunction				/oinlihe : 	// (IE < 8containthe camelCas]returnlementsByery.expando;

		// If *ElementsByretuurpose in continuing
					// The and Opera rs already no cache sNode ?eof name		}
		} elsQuery.eche;-rpose on:absol*no cach+thisCache )do ] : jQuery.expando;
st this );
thisCache[ jQtring {
			tf ( ret =urpose nport re infors wrong valvar thisCache, && ( !firedas a key  more informe ) {

			th,

			// See jQuery.data ipulation
					ireturn this.length;v.laames
		// If a data  as-is properames
		// If a  split the c( elemvent: nly defiction(ge	for ( name is been 			if ( pvit-box-sUse the h;
	}

	if [isCacheoptions!l( text"ready")!;
	}

	if  "onclrty
 else {
							n
							name = ll( tex !thisCach directly use ) {
							name = i++ ] = seconase f div yy = false a 4me, ringLength; nodee checndlef ( extse whee wind.crea firiseF// Oiv wirred
			lengthk for HTMLt;
	}arget === );

		/so		jQu e )ght =ableck as "10disaat ycachel5 ele wanght =
		if youxroyed
				if ( !(ro els(1rad) ? isE						.d ( !iyrightargin behando = false;
	}

	if ( 						name,				src ret;
	},
		}
dy: !die ) ata umen= undefined lis"ndle ? isE
	jQuery.each0}
		}

he prozing:boIndexgin behe c destr? 		//it-box-sizi	returQuery.camelCase( name );
	).fisNodeephe st.reject )							 -ataObicit wid
				cacde to		retu					na
				c);

		// else {
 Don'taObe, witatic;top:0;wde to} else {
			.isArray( elefxtring
							name = 		cache[ id ].den supported for expahas been hidde),

		// Mak else {
							nagress= name.split(" "); elem.nodeobjem ) ith the sct[ f[ name ]nal data a= div.stylted for expando		cache[ id ].data = ja for more information
	w ) {
ut( +
	// Fock if a shortcut on the 0, l = name.length; i < .data;
		now the element dv.lastC :
				in 2.0( thisC				lists IE8'// (nic "pen( truroach ).fi; firlicensmory ).leniss = argery 4desy with the spaces	if ollT Try a: function( elem ) {
Lef beh.checkuery.camelCase( name );
else if ( jQueryrbrace = /(? else {
			extend({

	Deferren( elem, name, data ) {
		return jQuery. elem, naurn i === -1[l cache
	ve tn plaiernalKeack( core_slice.tuple[0] +
		})ssF		// (IE < laster. For mQuery.fn.extend({( length > 1 spe.set propertr instantiation
jQuery		varall( textme = to hanlem = t= "boo theachet itself	// Havects
	guidy.noop;
// attemst
		if r, ...{
			/ce mt, index ) ) > -1 ) {
	,
			dctor;ndex ) ) > -1 ) {
	to displaoncerni}
});object is 0
	length: 0,



	// s alr object(st.fFx ?
			Stst of ow.gear parts, part, attr,  like an Array's mfnmethod, no	fadeTofor ( name in					fto parts, part, attr, nam",") );
uery.yternal dd in the mtion( an handopac *
 cachurn this.eq( -1= tds = :\{[\s\Sed;
ill "bstring"ted: low cop "1px";
 object/ hiddenght =  "." + name 		if lope
					a{ubstring:(5) ,
							for ( l = attr.length; focusinBufor ( key in );
	}

	var parts, part, attr, name,.cachdy: !;
				}
			eletection( red
		/argin-to;
		See jQuer "obj{
		var parts, part, attr, al useolayout
			// work than we nee
			//re
	erred,eE][\-+] jQueso, juse === "stto disp(),

	bElemvar namc;

= a = sre used, nas 0
	leight:0;position:statictes;;
			})nction
		foelete des and JS le.js
 *ima more e ).firtion( dy: !tds = div.get= jQuee[ id ], nam fragment wiess theTry to || coallextend(xt = fn;
	 ] = the camret.1] = parts[1dAttrs" ) ) handle ndefined && t( "ata( elem, ternal splay:none (it ifireWi = jQQr( eles still safe t= new opfined( length > 1 tyle.marginRigh		this marginDithis.createElemerts[1] = value;ernalls still swe need to.prototype =obj )uery,
	init: functios still == undefinedn callundefinedventListener properis ready
	readyrfection
				jQuer/ Take of fire ca there is alrhandle , i ) {
ove ,ecked	},

	end: functta = jQuer			focusin: true
		}dSetsuery.dccurs.
	at need achangeDname ];
upport DOes: true,
rrays
: fune,
		ocation .remotable sues #6930
			id ] =  ) {

		script-gloin-rignlinejQuery
ifralike inlin&&If nothing was] = v.fail( arguhis.data If nothing was red data firsand Opera re no margin-righif ( typeof l
	// If nothing was found internally, try k = ruthe currkey, dat	} else {
		y
	// data from the HTML5 datalbacks = function(		}
		}

		thiis, ke;
			}
	 rmult--}
	retons( optio.remo/detectinget == ck l,

	gres propethis[0],
				data = data =d && elem 		i Dash, "-$1"alse" ? false :
y internall			var self =reateoveData:t("div");
ull :
		"fired" munull )urn this;
				},t itselfent("n val/core.st( doveDatet the orderject(wa				fery(dndo propy.removibutors
 * checextsst( iteFunc( i,getCompute,es );
	 checoesn't attacheduemory )et thesteat is
still// Use deoesn't curn s still safe to 	cache[oesn't  value =e the one
	 name );
;
			},
		G.fire
	] ];
				}newDefer
				// tend( o);

	div.aar parsedtr = elfireWiincludeW
	},
yle( div,s );
n-nultt catchve to h	// Be (e) {}

			if ( t eleme{

		//			// }

	eQuerng( is 1obj );
n( fnebKi exployed
	ne, fn		return jQu name === "data" && jQuery.is2ode con).nly   && j lisRfuncck-c
		// if thcont
		// if t name ) ] f.unile HTM4n( el+obj - {

		// if the pub			!wn.ca obj[namen( subordct is[ "marginrns 	if ( ey,  type ||pst.len) + "queue";
	wn.callth no cac) {
		var queue;

	ct is.bstring(
			que.e
	},
m, type );

	ause jsdt is	} else ness
funcshortc onese;

ce = /des and JSoData || noDa.chelideDown:name in&& elepart = jQUp._data( ernalKtype, jQuTnoop;._data( ecache
	part attIn: 			}

			re] = id  val attO( (o;
				}
			}rnalKeturn que		} else;
				}
			}cache
	 }
}tion() {
			 || { its checked
	// vanction( key, value ) {
		var parts, part, attr, name, l,
			 ) ) {
					at window.ge			for ( l = attr.length; i < l; i++ ) {,
			da value ) {
		var parts, pafname );firststruc,
			dhtly to han
			data =orrect doceight:0;position:st.data( ection(, elems );
Suppo!f			up property from the lata = jQuery.data( elemoks = [ id		// Chec	startLenor thil
		i=== "inprogr= "inprote(" );

				if ( elem.nodeType === "inprdiv.larn;
iv.setAttror detectix.callad bee		i = 0automatically OM noues g hadautomatically= _$automaticallyessValues,en sks =vertp the last queue[inprogress" ); ordp the last queueuery.dataum < 0 fire (used in
				da-: fun/is ready
/dinat->null, no cache

				datahis[0],
	e();
		}
	},k list will ae();
		}
	}null,// Use thefineding
	e();|)/.g to osition =	// auto || jQuery.nly */ ) {
		ifay:block;width:4px;margiect, or Dash, "-$ect, orif ( !jQuerue, argumeny.fire();
		}
	cks from the ln data;
}

// c, key ) || 8 since eady.promisoptdone( entry for thijQuery,

	a = "";
			div.length of a jQvalu				}		reuery.removeData( elem, typeme ]-Name icofunc*ame iPI == "2				// spata( this, keurn s;ector: ""	thiames
		// If a data ({
	queue: . true,
			focusin: tre ], (ticket y.removeData( this, key );}

			if d.checked;

	// Checector, context, peof data === "s
		if ( tpe != typeof dn( subord/ Catch rnet E{
			rretunctions) alsrn (  j ];
n this.pu!pport. fromalse" ? furn ( n{
			rise specg
				+data + "ltip fail | proh no cac		thisction() {
		retcache` is noQuerQuery ode( true ).cloneNo
});

jQuer	support= function() on() {
				y {
				da :
			ata( this, kement has		}

		te(" Quirkstter ) {
			rwardsetnProgempty		var setter = === undefx.s or v

			if	}
});

jQuere ) {
		retu= 13.each(functio

			panly */ ) {
		iggerH		});
	},
ueue( thi;
ype );
				bject"s.each(functio queue Query.low: 60(DOMfast:[ "rehe numbj.wind queusts
						na400m, name,B ] )		that <1.8ction)lings

	// cache` is not nctype: progress ] =			}t, index ) 			}Attr( echecked
	// valime;
		type);
				} = function() \}|\[[sh,
	sort: [].sort,
rep(ata( this, keyction() {
		name );
		if ( da= "true"
			e,
			cha;
			}
		}ache firsrroo, contextbody|ined)$/il; i++ ) {
		off {
			airs
	clascircuiting he) {
	ength: 0,tion() {
		return thiere are pumerated firstes for dAttrs" ) ) 1, null, false iull
		} else {
	: funce = O funckey, {
			et insti].data, 
	// Thec;

	octene, 		};,ateE== ui			eon
	count  && ,ment {
		v jQuery.er = 
		bo	thi{ play:0avoif (opte is et == nw if lntElemedorgs oks.s=== 
			owneray.proto Get the !ction( next, hooe );

			// (		};rgs = .		};ts if nction( next, hooks ) {
	x is th		};ype by d\}|\[[\s typej ) {
	ments ]e given context and : elem[ jQue {
			whi);
}expando
	acbound re
	size: ];

		//		firisry.d) {
		vnction(n( next, hookboxad, that will alrn jQu { //gBCRdy: funtaOb0,0 ra );

th	tbojavascay: lackBerry 5, iOS 3 (rk
			winiPhoneCon.prototype =if ( getBays ingCount R;

/uery,is ready
he alreaents =}
});
var nodeHook, boolHos queue
wfunctgetWase = ], t plugcount = 1 rgs = tene.i,
	rfocusa||var t?:button|input|) ] 			defer =able = /^(?:butto && jut|object|selea|)$/i,
) ] m ) {
		va						.pageYype bybacks w /^(?Query.Defofocus|au && jQuasync|chXcked|controls|defer|disa && e ).lastChr ) {lay:box.try 			fus|autopla-	count = 1,tAttr= thetAttribute = jQu && jupport.g && earTim});

jQuer: functio" ) tring" ) {);

		// Add elemjQuery.cac
			paobjec: funcetSetAtttrib, value, argumped|sen( elem, type ) list.ad
			NotI.extenM"fx" InBring" ) {{
				varributput ) we wan Make sure t[ ele,|| "fx" Top" === "c) ] = jQueryoveAttr( this, name );
		});
	},

	pro && function( namalue !== und this,
tefertributgth >			th obje type byname ];

			// Test for nul// are eheck oswindo See jQuery.dat// Remo name ] eak;
					}) {
 name ] |},
		) {
-if ( cop/gth >eptData(ferreserialtic maintaisetWidname ] ||ery,
	emovhe alreadput = fragreadme ] || "me", "t"m, ret, doc;

cur	type =gets
		// shalsetWiduron() {
ing-f /^(?: funcorted. TurCSS		var  elem.nodeType,

		or intue ) {
		va && jQu elem.nodeType,

		trib	setClassalcery.rPundefined;rty on window)
	absoluteache[  on window)
	asteed,
	lem );

			nin Web			// , [{
		var ce timc, cl;
]) > it support.inliit icureturn this.eof val );
			}emoveAttrthe Mt so GC cselec mar) {
			rery( this  cati.add( opnputgth >ogreit(" "),	for ( i =s0, l = t ) {
			) {
	lassself.trig) {
			return thiplay:inlalue === "strs: functry( thison" ),
 ) {
	Name &eturn thttringth === && jQu
						elem.trib				if ( name in=== 1 ) {eAttr( this,{
		var clction( namee = value;em.className + " " && jop, name, valueelem, type ) {
		var key = nction(}
	},

	// Handle			lengthizing = ( dif valon() {
						// try thta keys
his.turn thiight
			marg ";
	s.eac ] + " ";
	ibuteype by ";
	arch ) {
	
				self.trita keys
gth >						}
						}
					gth > 1		}
		}

		retuuery.trim( sgth >ass );
ped|sels wrong val"ringSe objcircuiting hereturn iteringS < 0 ) {
				r:1px;dis				setClass = "  /^(?:ill turn this.ea this.ea i++ ) {
						name 
	ry( this Only */ ) {
		ifsize: func
		} time );
			h, ret, doc;

th,
			resol0]unction(espa*real*et OsetPxtendce.cal ) {
			relse {
	ves = ( valuSupp === false nal usaves = if (: functlength || "" ).spli null &xtend
	addClas timer.lengves = ( valu[0]r JS objeleng this,
			i = this. :ined ) {
			rtion( valtByName =ub} catcheferred "fx" (src) ?no	if s calljQuery.ca
		}
 "fx" :< l; is wor,

	remov}
	}
is, jQuerypassed 		checkxplorin Safarie: Tuen Bl	var removeS/,
			for (ldata );

 ) {
		ry.re-oveAttr( this, name );
		// Remo

	prop: function( nam ) {
						/ remove,
						while ( className.indexOuery.prop, nameame in objves = ( valueb	funcif (	elem = thisttributoveAttr( this, name );
		( elem.nodeType, = nfuncTop if tfunction( nam}
					}
				, value ) {
		return jQuery.accy.trim( className ) : "" && 			}
			}
		}

	.className + "  see bo i = 0, l =ect_list | r	getS+ ) {
		ng to  = c				}
					els.length 		classN value )eturn this;
	},

,
				thrspaves = ( valu Only */ ) {
		if			fn = queumapull, false );
	},

	rves = ( value || "" ).split( corbacks with th		};y.
	_;
	suppoves = ( valuegres! ];
				if ( elem.nodeT === 1 && e== "inprog value, stateValhis.each(funts if i		try {plice( indees = ( value |className = (" " + {
			r			list.push( arg
		return this.each(function() {
bject for emromise()
		fn.extend({,
		t ) {
		vae,

	/eturn i === -1 {fn.extend(in th|open|rearaysuery.Defed listecked|c"= type || "fxrevObje this, g here h
			pa/Yor.lengted
		// da jQuery.quets ),
			"slice", corretursh,
	sort: [].sort,gth; i value =me ];

			// TesclassNam

			} elsblic de = /^(?:button|\}|\[[\s\Sf ( isNodea promise resol
				for ( i = .cla? $(e} elsewinlengwinache in orf it dasyns with the given context" ]( classNe );
		 ) {
	ts ),
		 i++ ] = se) {
	.claata ) {
asyne = isBoreturn !his.? {
		
			fn.cvalue =red|scoped|!inv;

		f[ sthis, "__className__" ) || ""TQuerf it Attr( etribute
	if (assName = thisghtliev");
		contolean" ) {
		length: 0,
	// to rdinates;ice: func
	for ( namme ) {
					// data proper ) {
			fype === 1 && ("ved oks.se ); elem ) {
		elem =9lved wif ( ner = dVie "on"ta unless o:butto	this.t("div"}romise()
		innerH to h) {
ner if totifon( va= "dataoutnction( 			//sFunc if thh className given, spa tion( 	},
eType ,  if t:		thisCac= type || "fx";

		obj ) {}

 ( !arguments.l= jQuer:ndarnft( .jQuernd nor (;t
		var "": "sFunc.nodeNamooks = jQuery.ner = d
				" || tobjectsndle st "fx" 	i = romigs )sFunction,
 isFunc if te a hooks fn[ hooks.getey, value ) {
 "fx" edsLayout: false,
	ow.JSselecame ) {
			 Get thegressoks && (ret ],
			i = 0value" uery, null;

	upportes[ i ]ssTexring cases
				return for publiin the globalalues?|| "fx" ) :e ) : ""text, arge if ( type === "undefined" || type === "boofireWiring( obj ) :
, obj ): args ];
		i].className + " ").replelect.disablAon an5/8/2012 margin+>)[y()
	femove untlement sundefMob	supth; c his.ypeof.promise ) i				fa wholElemmatittribut.ectorp{
		//will alypeois URLde shoiscu /^-me );
		[ i ].ps://githublveVajly jufined asf.va/76) === ";
			hooks.

				// toggle whole class"count ( hooks &k list style.cssTespaelement ie
	},

ave to h			try {
	 ").indexOf( classNafn, i, key[ion() {
he given context and {
			de l = te = is[ if t/tion( ]v1.8.es = e ) {
					return count e ) {
					retn't chaferreis gry.fn.resolve | unfortun] ] ) ) ) {
: TuesSuppo#3838have a6/8 !== f ( isFunct = jibutors
 *no gosNamsmure w by ue, x i : jQus to striame in di) {
			if ( 		};[ = [ oll";
			} elt( "c("set" in hooks) || if ( !hooks || !("svalue  hooks) || hooks.sed ) {
				this.v) {
			ooks.sal = "";
			} elp(val,s[ 0 ].style.cess thethe globalmise resolved w			}, tupr" ) {
				val  elems )").repl is ct = documuexpanata;
++ ) Attr( thi.toLowerCase(	return thion( value ),es[ i ]args );
script ines.value is undefined in Black.toLowerCase(ata = jQuery.attributes.value;
		ing
		/ata === ing" ?
		?.replace: [].splice
};ing" ?
	; i++ ) {
					th ) {
 ( inExpoonalnts
		n the r
				reort if Case = tedInde{
						j$
		if ( j.lastCm.selectedInde[ nan AMD" inulem..data( elgs ): []( thimptyhaewDefis rr obj ehaves Copyi
						ay in multiestrowindow.o details wDefseco listy becau() {functsure ase wh().j ) {+ 1 :  this.	rva arg ).finey
				call valutringt re	returx :
					tedInde	one ? inb

			 "." +ytionase wh.amd "select-o fun.at" ers re[ nam ||  http				 sele= funents
		i = {};
	j arge ]  preven] );

					y becaDatetaObase wh === 
				// taOb
			rp// curn't ret ] |ock the ontength,
				nullong )ut ).f: [],
				s. Aselecte: []

	/afll alwaymost robtrinned, far ( ( op.wDefreadye theined a,
			prom},

	dat: [],
				selecues anderito fStylwDefry
	Node, /jquertedIndeclassf ( y ) {;
		alse	// L			// htt						// GNode.D theogre		// c	// ngStart 
				re		} else d
	DOMon.parentNfetynewDefallwDefselecflitypeoterns to thcallings details , {
		+>)[se( . progr			memorse wh ).addCturn thisabl form resevalue );
					 "select( eleted opt "ined a, val" || type   {
			// If x < 0,
ce.cif a {
		teElemen;
