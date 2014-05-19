/*! jQuery v1.7.1 jquery.com | jquery.org/license */
(function( window, undefined ) {

// Use the correct document accordingly with window argument (sandbox)
var document = window.document,
	navigator = window.navigator,
	location = window.location;
var jQuery = (function() {

// Define a local copy of jQuery
var jQuery = function( selector, context ) {
		// The jQuery object is actually just the init constructor 'enhanced'
		return new jQuery.fn.init( selector, context, rootjQuery );
	},

	// Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

	// Map over the $ in case of overwrite
	_$ = window.$,

	// A central reference to the root jQuery(document)
	rootjQuery,

	// A simple way to check for HTML strings or ID strings
	// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
	quickExpr = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,

	// Check if a string has a non-whitespace character in it
	rnotwhite = /\S/,

	// Used for trimming whitespace
	trimLeft = /^\s+/,
	trimRight = /\s+$/,

	// Match a standalone tag
	rsingleTag = /^<(\w+)\s*\/?>(?:<\/\1>)?$/,

	// JSON RegExp
	rvalidchars = /^[\],:{}\s]*$/,
	rvalidescape = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,
	rvalidtokens = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
	rvalidbraces = /(?:^|:|,)(?:\s*\[)+/g,

	// Useragent RegExp
	rwebkit = /(webkit)[ \/]([\w.]+)/,
	ropera = /(opera)(?:.*version)?[ \/]([\w.]+)/,
	rmsie = /(msie) ([\w.]+)/,
	rmozilla = /(mozilla)(?:.*? rv:([\w.]+))?/,

	// Matches dashed string for camelizing
	rdashAlpha = /-([a-z]|[0-9])/ig,
	rmsPrefix = /^-ms-/,

	// Used by jQuery.camelCase as callback to replace()
	fcamelCase = function( all, letter ) {
		return ( letter + "" ).toUpperCase();
	},

	// Keep a UserAgent string for use with jQuery.browser
	userAgent = navigator.userAgent,

	// For matching the engine and version of the browser
	browserMatch,

	// The deferred used on DOM ready
	readyList,

	// The ready event handler
	DOMContentLoaded,

	// Save a reference to some core methods
	toString = Object.prototype.toString,
	hasOwn = Object.prototype.hasOwnProperty,
	push = Array.prototype.push,
	slice = Array.prototype.slice,
	trim = String.prototype.trim,
	indexOf = Array.prototype.indexOf,

	// [[Class]] -> type pairs
	class2type = {};

jQuery.fn = jQuery.prototype = {
	constructor: jQuery,
	init: function( selector, context, rootjQuery ) {
		var match, elem, ret, doc;

		// Handle $(""), $(null), or $(undefined)
		if ( !selector ) {
			return this;
		}

		// Handle $(DOMElement)
		if ( selector.nodeType ) {
			this.context = this[0] = selector;
			this.length = 1;
			return this;
		}

		// The body element only exists once, optimize finding it
		if ( selector === "body" && !context && document.body ) {
			this.context = document;
			this[0] = document.body;
			this.selector = selector;
			this.length = 1;
			return this;
		}

		// Handle HTML strings
		if ( typeof selector === "string" ) {
			// Are we dealing with HTML string or an ID?
			if ( selector.charAt(0) === "<" && selector.charAt( selector.length - 1 ) === ">" && selector.length >= 3 ) {
				// Assume that strings that start and end with <> are HTML and skip the regex check
				match = [ null, selector, null ];

			} else {
				match = quickExpr.exec( selector );
			}

			// Verify a match, and that no context was specified for #id
			if ( match && (match[1] || !context) ) {

				// HANDLE: $(html) -> $(array)
				if ( match[1] ) {
					context = context instanceof jQuery ? context[0] : context;
					doc = ( context ? context.ownerDocument || context : document );

					// If a single string is passed in and it's a single tag
					// just do a createElement and skip the rest
					ret = rsingleTag.exec( selector );

					if ( ret ) {
						if ( jQuery.isPlainObject( context ) ) {
							selector = [ document.createElement( ret[1] ) ];
							jQuery.fn.attr.call( selector, context, true );

						} else {
							selector = [ doc.createElement( ret[1] ) ];
						}

					} else {
						ret = jQuery.buildFragment( [ match[1] ], [ doc ] );
						selector = ( ret.cacheable ? jQuery.clone(ret.fragment) : ret.fragment ).childNodes;
					}

					return jQuery.merge( this, selector );

				// HANDLE: $("#id")
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
	jquery: "1.7.1",

	// The default length of a jQuery object is 0
	length: 0,

	// The number of elements contained in the matched element set
	size: function() {
		return this.length;
	},

	toArray: function() {
		return slice.call( this, 0 );
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
		var ret = this.constructor();

		if ( jQuery.isArray( elems ) ) {
			push.apply( ret, elems );

		} else {
			jQuery.merge( ret, elems );
		}

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
		// Attach the listeners
		jQuery.bindReady();

		// Add the callback
		readyList.add( fn );

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
		return this.pushStack( slice.apply( this, arguments ),
			"slice", slice.call(arguments).join(",") );
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
	push: push,
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
		// Either a released hold or an DOMready/load event and not yet ready
		if ( (wait === true && !--jQuery.readyWait) || (wait !== true && !jQuery.isReady) ) {
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
			readyList.fireWith( document, [ jQuery ] );

			// Trigger any bound ready events
			if ( jQuery.fn.trigger ) {
				jQuery( document ).trigger( "ready" ).off( "ready" );
			}
		}
	},

	bindReady: function() {
		if ( readyList ) {
			return;
		}

		readyList = jQuery.Callbacks( "once memory" );

		// Catch cases where $(document).ready() is called after the
		// browser event has already occurred.
		if ( document.readyState === "complete" ) {
			// Handle it asynchronously to allow scripts the opportunity to delay ready
			return setTimeout( jQuery.ready, 1 );
		}

		// Mozilla, Opera and webkit nightlies currently support this event
		if ( document.addEventListener ) {
			// Use the handy event callback
			document.addEventListener( "DOMContentLoaded", DOMContentLoaded, false );

			// A fallback to window.onload, that will always work
			window.addEventListener( "load", jQuery.ready, false );

		// If IE event model is used
		} else if ( document.attachEvent ) {
			// ensure firing before onload,
			// maybe late but safe also for iframes
			document.attachEvent( "onreadystatechange", DOMContentLoaded );

			// A fallback to window.onload, that will always work
			window.attachEvent( "onload", jQuery.ready );

			// If IE and not a frame
			// continually check to see if the document is ready
			var toplevel = false;

			try {
				toplevel = window.frameElement == null;
			} catch(e) {}

			if ( document.documentElement.doScroll && toplevel ) {
				doScrollCheck();
			}
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

	// A crude way of determining if an object is a window
	isWindow: function( obj ) {
		return obj && typeof obj === "object" && "setInterval" in obj;
	},

	isNumeric: function( obj ) {
		return !isNaN( parseFloat(obj) ) && isFinite( obj );
	},

	type: function( obj ) {
		return obj == null ?
			String( obj ) :
			class2type[ toString.call(obj) ] || "object";
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
				!hasOwn.call(obj, "constructor") &&
				!hasOwn.call(obj.constructor.prototype, "isPrototypeOf") ) {
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

		return key === undefined || hasOwn.call( obj, key );
	},

	isEmptyObject: function( obj ) {
		for ( var name in obj ) {
			return false;
		}
		return true;
	},

	error: function( msg ) {
		throw new Error( msg );
	},

	parseJSON: function( data ) {
		if ( typeof data !== "string" || !data ) {
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
		if ( data && rnotwhite.test( data ) ) {
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
		return elem.nodeName && elem.nodeName.toUpperCase() === name.toUpperCase();
	},

	// args is for internal usage only
	each: function( object, callback, args ) {
		var name, i = 0,
			length = object.length,
			isObj = length === undefined || jQuery.isFunction( object );

		if ( args ) {
			if ( isObj ) {
				for ( name in object ) {
					if ( callback.apply( object[ name ], args ) === false ) {
						break;
					}
				}
			} else {
				for ( ; i < length; ) {
					if ( callback.apply( object[ i++ ], args ) === false ) {
						break;
					}
				}
			}

		// A special, fast, case for the most common use of each
		} else {
			if ( isObj ) {
				for ( name in object ) {
					if ( callback.call( object[ name ], name, object[ name ] ) === false ) {
						break;
					}
				}
			} else {
				for ( ; i < length; ) {
					if ( callback.call( object[ i ], i, object[ i++ ] ) === false ) {
						break;
					}
				}
			}
		}

		return object;
	},

	// Use native String.trim function wherever possible
	trim: trim ?
		function( text ) {
			return text == null ?
				"" :
				trim.call( text );
		} :

		// Otherwise use our own trimming functionality
		function( text ) {
			return text == null ?
				"" :
				text.toString().replace( trimLeft, "" ).replace( trimRight, "" );
		},

	// results is for internal usage only
	makeArray: function( array, results ) {
		var ret = results || [];

		if ( array != null ) {
			// The window, strings (and functions) also have 'length'
			// Tweaked logic slightly to handle Blackberry 4.7 RegExp issues #6930
			var type = jQuery.type( array );

			if ( array.length == null || type === "string" || type === "function" || type === "regexp" || jQuery.isWindow( array ) ) {
				push.call( ret, array );
			} else {
				jQuery.merge( ret, array );
			}
		}

		return ret;
	},

	inArray: function( elem, array, i ) {
		var len;

		if ( array ) {
			if ( indexOf ) {
				return indexOf.call( array, elem, i );
			}

			len = array.length;
			i = i ? i < 0 ? Math.max( 0, len + i ) : i : 0;

			for ( ; i < len; i++ ) {
				// Skip accessing in sparse arrays
				if ( i in array && array[ i ] === elem ) {
					return i;
				}
			}
		}

		return -1;
	},

	merge: function( first, second ) {
		var i = first.length,
			j = 0;

		if ( typeof second.length === "number" ) {
			for ( var l = second.length; j < l; j++ ) {
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
		var ret = [], retVal;
		inv = !!inv;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( var i = 0, length = elems.length; i < length; i++ ) {
			retVal = !!callback( elems[ i ], i );
			if ( inv !== retVal ) {
				ret.push( elems[ i ] );
			}
		}

		return ret;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var value, key, ret = [],
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

		// Go through every key on the object
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
		if ( typeof context === "string" ) {
			var tmp = fn[ context ];
			context = fn;
			fn = tmp;
		}

		// Quick check to determine if target is callable, in the spec
		// this throws a TypeError, but we will just return undefined.
		if ( !jQuery.isFunction( fn ) ) {
			return undefined;
		}

		// Simulated bind
		var args = slice.call( arguments, 2 ),
			proxy = function() {
				return fn.apply( context, args.concat( slice.call( arguments ) ) );
			};

		// Set the guid of unique handler to the same of original handler, so it can be removed
		proxy.guid = fn.guid = fn.guid || proxy.guid || jQuery.guid++;

		return proxy;
	},

	// Mutifunctional method to get and set values to a collection
	// The value/s can optionally be executed if it's a function
	access: function( elems, key, value, exec, fn, pass ) {
		var length = elems.length;

		// Setting many attributes
		if ( typeof key === "object" ) {
			for ( var k in key ) {
				jQuery.access( elems, k, key[k], exec, fn, value );
			}
			return elems;
		}

		// Setting one attribute
		if ( value !== undefined ) {
			// Optionally, function values get executed if exec is true
			exec = !pass && exec && jQuery.isFunction(value);

			for ( var i = 0; i < length; i++ ) {
				fn( elems[i], key, exec ? value.call( elems[i], i, fn( elems[i], key ) ) : value, pass );
			}

			return elems;
		}

		// Getting an attribute
		return length ? fn( elems[0], key ) : undefined;
	},

	now: function() {
		return ( new Date() ).getTime();
	},

	// Use of jQuery.browser is frowned upon.
	// More details: http://docs.jquery.com/Utilities/jQuery.browser
	uaMatch: function( ua ) {
		ua = ua.toLowerCase();

		var match = rwebkit.exec( ua ) ||
			ropera.exec( ua ) ||
			rmsie.exec( ua ) ||
			ua.indexOf("compatible") < 0 && rmozilla.exec( ua ) ||
			[];

		return { browser: match[1] || "", version: match[2] || "0" };
	},

	sub: function() {
		function jQuerySub( selector, context ) {
			return new jQuerySub.fn.init( selector, context );
		}
		jQuery.extend( true, jQuerySub, this );
		jQuerySub.superclass = this;
		jQuerySub.fn = jQuerySub.prototype = this();
		jQuerySub.fn.constructor = jQuerySub;
		jQuerySub.sub = this.sub;
		jQuerySub.fn.init = function init( selector, context ) {
			if ( context && context instanceof jQuery && !(context instanceof jQuerySub) ) {
				context = jQuerySub( context );
			}

			return jQuery.fn.init.call( this, selector, context, rootjQuerySub );
		};
		jQuerySub.fn.init.prototype = jQuerySub.fn;
		var rootjQuerySub = jQuerySub(document);
		return jQuerySub;
	},

	browser: {}
});

// Populate the class2type map
jQuery.each("Boolean Number String Function Array Date RegExp Object".split(" "), function(i, name) {
	class2type[ "[object " + name + "]" ] = name.toLowerCase();
});

browserMatch = jQuery.uaMatch( userAgent );
if ( browserMatch.browser ) {
	jQuery.browser[ browserMatch.browser ] = true;
	jQuery.browser.version = browserMatch.version;
}

// Deprecated, use jQuery.browser.webkit instead
if ( jQuery.browser.webkit ) {
	jQuery.browser.safari = true;
}

// IE doesn't match non-breaking spaces with \s
if ( rnotwhite.test( "\xA0" ) ) {
	trimLeft = /^[\s\xA0]+/;
	trimRight = /[\s\xA0]+$/;
}

// All jQuery objects should point back to these
rootjQuery = jQuery(document);

// Cleanup functions for the document ready method
if ( document.addEventListener ) {
	DOMContentLoaded = function() {
		document.removeEventListener( "DOMContentLoaded", DOMContentLoaded, false );
		jQuery.ready();
	};

} else if ( document.attachEvent ) {
	DOMContentLoaded = function() {
		// Make sure body exists, at least, in case IE gets a little overzealous (ticket #5443).
		if ( document.readyState === "complete" ) {
			document.detachEvent( "onreadystatechange", DOMContentLoaded );
			jQuery.ready();
		}
	};
}

// The DOM ready check for Internet Explorer
function doScrollCheck() {
	if ( jQuery.isReady ) {
		return;
	}

	try {
		// If IE is used, use the trick by Diego Perini
		// http://javascript.nwbox.com/IEContentLoaded/
		document.documentElement.doScroll("left");
	} catch(e) {
		setTimeout( doScrollCheck, 1 );
		return;
	}

	// and execute any waiting functions
	jQuery.ready();
}

return jQuery;

})();


// String to Object flags format cache
var flagsCache = {};

// Convert String-formatted flags into Object-formatted ones and store in cache
function createFlags( flags ) {
	var object = flagsCache[ flags ] = {},
		i, length;
	flags = flags.split( /\s+/ );
	for ( i = 0, length = flags.length; i < length; i++ ) {
		object[ flags[i] ] = true;
	}
	return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *	flags:	an optional list of space-separated flags that will change how
 *			the callback list behaves
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible flags:
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
jQuery.Callbacks = function( flags ) {

	// Convert flags from String-formatted to Object-formatted
	// (we check in cache first)
	flags = flags ? ( flagsCache[ flags ] || createFlags( flags ) ) : {};

	var // Actual callback list
		list = [],
		// Stack of fire calls for repeatable lists
		stack = [],
		// Last fire value (for non-forgettable lists)
		memory,
		// Flag to know if list is currently firing
		firing,
		// First callback to fire (used internally by add and fireWith)
		firingStart,
		// End of the loop when firing
		firingLength,
		// Index of currently firing callback (modified by remove if needed)
		firingIndex,
		// Add one or several callbacks to the list
		add = function( args ) {
			var i,
				length,
				elem,
				type,
				actual;
			for ( i = 0, length = args.length; i < length; i++ ) {
				elem = args[ i ];
				type = jQuery.type( elem );
				if ( type === "array" ) {
					// Inspect recursively
					add( elem );
				} else if ( type === "function" ) {
					// Add if not in unique mode and callback is not in
					if ( !flags.unique || !self.has( elem ) ) {
						list.push( elem );
					}
				}
			}
		},
		// Fire callbacks
		fire = function( context, args ) {
			args = args || [];
			memory = !flags.memory || [ context, args ];
			firing = true;
			firingIndex = firingStart || 0;
			firingStart = 0;
			firingLength = list.length;
			for ( ; list && firingIndex < firingLength; firingIndex++ ) {
				if ( list[ firingIndex ].apply( context, args ) === false && flags.stopOnFalse ) {
					memory = true; // Mark as halted
					break;
				}
			}
			firing = false;
			if ( list ) {
				if ( !flags.once ) {
					if ( stack && stack.length ) {
						memory = stack.shift();
						self.fireWith( memory[ 0 ], memory[ 1 ] );
					}
				} else if ( memory === true ) {
					self.disable();
				} else {
					list = [];
				}
			}
		},
		// Actual Callbacks object
		self = {
			// Add a callback or a collection of callbacks to the list
			add: function() {
				if ( list ) {
					var length = list.length;
					add( arguments );
					// Do we need to add the callbacks to the
					// current firing batch?
					if ( firing ) {
						firingLength = list.length;
					// With memory, if we're not firing then
					// we should call right away, unless previous
					// firing was halted (stopOnFalse)
					} else if ( memory && memory !== true ) {
						firingStart = length;
						fire( memory[ 0 ], memory[ 1 ] );
					}
				}
				return this;
			},
			// Remove a callback from the list
			remove: function() {
				if ( list ) {
					var args = arguments,
						argIndex = 0,
						argLength = args.length;
					for ( ; argIndex < argLength ; argIndex++ ) {
						for ( var i = 0; i < list.length; i++ ) {
							if ( args[ argIndex ] === list[ i ] ) {
								// Handle firingIndex and firingLength
								if ( firing ) {
									if ( i <= firingLength ) {
										firingLength--;
										if ( i <= firingIndex ) {
											firingIndex--;
										}
									}
								}
								// Remove the element
								list.splice( i--, 1 );
								// If we have some unicity property then
								// we only need to do this once
								if ( flags.unique ) {
									break;
								}
							}
						}
					}
				}
				return this;
			},
			// Control if a given callback is in the list
			has: function( fn ) {
				if ( list ) {
					var i = 0,
						length = list.length;
					for ( ; i < length; i++ ) {
						if ( fn === list[ i ] ) {
							return true;
						}
					}
				}
				return false;
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
				if ( !memory || memory === true ) {
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
				if ( stack ) {
					if ( firing ) {
						if ( !flags.once ) {
							stack.push( [ context, args ] );
						}
					} else if ( !( flags.once && memory ) ) {
						fire( context, args );
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
				return !!memory;
			}
		};

	return self;
};




var // Static reference to slice
	sliceDeferred = [].slice;

jQuery.extend({

	Deferred: function( func ) {
		var doneList = jQuery.Callbacks( "once memory" ),
			failList = jQuery.Callbacks( "once memory" ),
			progressList = jQuery.Callbacks( "memory" ),
			state = "pending",
			lists = {
				resolve: doneList,
				reject: failList,
				notify: progressList
			},
			promise = {
				done: doneList.add,
				fail: failList.add,
				progress: progressList.add,

				state: function() {
					return state;
				},

				// Deprecated
				isResolved: doneList.fired,
				isRejected: failList.fired,

				then: function( doneCallbacks, failCallbacks, progressCallbacks ) {
					deferred.done( doneCallbacks ).fail( failCallbacks ).progress( progressCallbacks );
					return this;
				},
				always: function() {
					deferred.done.apply( deferred, arguments ).fail.apply( deferred, arguments );
					return this;
				},
				pipe: function( fnDone, fnFail, fnProgress ) {
					return jQuery.Deferred(function( newDefer ) {
						jQuery.each( {
							done: [ fnDone, "resolve" ],
							fail: [ fnFail, "reject" ],
							progress: [ fnProgress, "notify" ]
						}, function( handler, data ) {
							var fn = data[ 0 ],
								action = data[ 1 ],
								returned;
							if ( jQuery.isFunction( fn ) ) {
								deferred[ handler ](function() {
									returned = fn.apply( this, arguments );
									if ( returned && jQuery.isFunction( returned.promise ) ) {
										returned.promise().then( newDefer.resolve, newDefer.reject, newDefer.notify );
									} else {
										newDefer[ action + "With" ]( this === deferred ? newDefer : this, [ returned ] );
									}
								});
							} else {
								deferred[ handler ]( newDefer[ action ] );
							}
						});
					}).promise();
				},
				// Get a promise for this deferred
				// If obj is provided, the promise aspect is added to the object
				promise: function( obj ) {
					if ( obj == null ) {
						obj = promise;
					} else {
						for ( var key in promise ) {
							obj[ key ] = promise[ key ];
						}
					}
					return obj;
				}
			},
			deferred = promise.promise({}),
			key;

		for ( key in lists ) {
			deferred[ key ] = lists[ key ].fire;
			deferred[ key + "With" ] = lists[ key ].fireWith;
		}

		// Handle state
		deferred.done( function() {
			state = "resolved";
		}, failList.disable, progressList.lock ).fail( function() {
			state = "rejected";
		}, doneList.disable, progressList.lock );

		// Call given func if any
		if ( func ) {
			func.call( deferred, deferred );
		}

		// All done!
		return deferred;
	},

	// Deferred helper
	when: function( firstParam ) {
		var args = sliceDeferred.call( arguments, 0 ),
			i = 0,
			length = args.length,
			pValues = new Array( length ),
			count = length,
			pCount = length,
			deferred = length <= 1 && firstParam && jQuery.isFunction( firstParam.promise ) ?
				firstParam :
				jQuery.Deferred(),
			promise = deferred.promise();
		function resolveFunc( i ) {
			return function( value ) {
				args[ i ] = arguments.length > 1 ? sliceDeferred.call( arguments, 0 ) : value;
				if ( !( --count ) ) {
					deferred.resolveWith( deferred, args );
				}
			};
		}
		function progressFunc( i ) {
			return function( value ) {
				pValues[ i ] = arguments.length > 1 ? sliceDeferred.call( arguments, 0 ) : value;
				deferred.notifyWith( promise, pValues );
			};
		}
		if ( length > 1 ) {
			for ( ; i < length; i++ ) {
				if ( args[ i ] && args[ i ].promise && jQuery.isFunction( args[ i ].promise ) ) {
					args[ i ].promise().then( resolveFunc(i), deferred.reject, progressFunc(i) );
				} else {
					--count;
				}
			}
			if ( !count ) {
				deferred.resolveWith( deferred, args );
			}
		} else if ( deferred !== firstParam ) {
			deferred.resolveWith( deferred, length ? [ firstParam ] : [] );
		}
		return promise;
	}
});




jQuery.support = (function() {

	var support,
		all,
		a,
		select,
		opt,
		input,
		marginDiv,
		fragment,
		tds,
		events,
		eventName,
		i,
		isSupported,
		div = document.createElement( "div" ),
		documentElement = document.documentElement;

	// Preliminary tests
	div.setAttribute("className", "t");
	div.innerHTML = "   <link/><table></table><a href='/a' style='top:1px;float:left;opacity:.55;'>a</a><input type='checkbox'/>";

	all = div.getElementsByTagName( "*" );
	a = div.getElementsByTagName( "a" )[ 0 ];

	// Can't get basic test support
	if ( !all || !all.length || !a ) {
		return {};
	}

	// First batch of supports tests
	select = document.createElement( "select" );
	opt = select.appendChild( document.createElement("option") );
	input = div.getElementsByTagName( "input" )[ 0 ];

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
		opacity: /^0.55/.test( a.style.opacity ),

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

		// Tests for enctype support on a form(#6743)
		enctype: !!document.createElement("form").enctype,

		// Makes sure cloning an html5 element does not cause problems
		// Where outerHTML is undefined, this still works
		html5Clone: document.createElement("nav").cloneNode( true ).outerHTML !== "<:nav></:nav>",

		// Will be defined later
		submitBubbles: true,
		changeBubbles: true,
		focusinBubbles: false,
		deleteExpando: true,
		noCloneEvent: true,
		inlineBlockNeedsLayout: false,
		shrinkWrapBlocks: false,
		reliableMarginRight: true
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
		div.attachEvent( "onclick", function() {
			// Cloning a node shouldn't copy over any
			// bound event handlers (IE does this)
			support.noCloneEvent = false;
		});
		div.cloneNode( true ).fireEvent( "onclick" );
	}

	// Check if a radio maintains its value
	// after being appended to the DOM
	input = document.createElement("input");
	input.value = "t";
	input.setAttribute("type", "radio");
	support.radioValue = input.value === "t";

	input.setAttribute("checked", "checked");
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

	div.innerHTML = "";

	// Check if div with explicit width and no margin-right incorrectly
	// gets computed margin-right based on width of container. For more
	// info see bug #3333
	// Fails in WebKit before Feb 2011 nightlies
	// WebKit Bug 13343 - getComputedStyle returns wrong value for margin-right
	if ( window.getComputedStyle ) {
		marginDiv = document.createElement( "div" );
		marginDiv.style.width = "0";
		marginDiv.style.marginRight = "0";
		div.style.width = "2px";
		div.appendChild( marginDiv );
		support.reliableMarginRight =
			( parseInt( ( window.getComputedStyle( marginDiv, null ) || { marginRight: 0 } ).marginRight, 10 ) || 0 ) === 0;
	}

	// Technique from Juriy Zaytsev
	// http://perfectionkills.com/detecting-event-support-without-browser-sniffing/
	// We only care about the case where non-standard event systems
	// are used, namely in IE. Short-circuiting here helps us to
	// avoid an eval call (in setAttribute) which can cause CSP
	// to go haywire. See: https://developer.mozilla.org/en/Security/CSP
	if ( div.attachEvent ) {
		for( i in {
			submit: 1,
			change: 1,
			focusin: 1
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

	fragment.removeChild( div );

	// Null elements to avoid leaks in IE
	fragment = select = opt = marginDiv = div = input = null;

	// Run tests that need a body at doc ready
	jQuery(function() {
		var container, outer, inner, table, td, offsetSupport,
			conMarginTop, ptlm, vb, style, html,
			body = document.getElementsByTagName("body")[0];

		if ( !body ) {
			// Return for frameset docs that don't have a body
			return;
		}

		conMarginTop = 1;
		ptlm = "position:absolute;top:0;left:0;width:1px;height:1px;margin:0;";
		vb = "visibility:hidden;border:0;";
		style = "style='" + ptlm + "border:5px solid #000;padding:0;'";
		html = "<div " + style + "><div></div></div>" +
			"<table " + style + " cellpadding='0' cellspacing='0'>" +
			"<tr><td></td></tr></table>";

		container = document.createElement("div");
		container.style.cssText = vb + "width:0;height:0;position:static;top:0;margin-top:" + conMarginTop + "px";
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
		div.innerHTML = "<table><tr><td style='padding:0;border:0;display:none'></td><td>t</td></tr></table>";
		tds = div.getElementsByTagName( "td" );
		isSupported = ( tds[ 0 ].offsetHeight === 0 );

		tds[ 0 ].style.display = "";
		tds[ 1 ].style.display = "none";

		// Check if empty table cells still have offsetWidth/Height
		// (IE <= 8 fail this test)
		support.reliableHiddenOffsets = isSupported && ( tds[ 0 ].offsetHeight === 0 );

		// Figure out if the W3C box model works as expected
		div.innerHTML = "";
		div.style.width = div.style.paddingLeft = "1px";
		jQuery.boxModel = support.boxModel = div.offsetWidth === 2;

		if ( typeof div.style.zoom !== "undefined" ) {
			// Check if natively block-level elements act like inline-block
			// elements when setting their display to 'inline' and giving
			// them layout
			// (IE < 8 does this)
			div.style.display = "inline";
			div.style.zoom = 1;
			support.inlineBlockNeedsLayout = ( div.offsetWidth === 2 );

			// Check if elements with layout shrink-wrap their children
			// (IE 6 does this)
			div.style.display = "";
			div.innerHTML = "<div style='width:4px;'></div>";
			support.shrinkWrapBlocks = ( div.offsetWidth !== 2 );
		}

		div.style.cssText = ptlm + vb;
		div.innerHTML = html;

		outer = div.firstChild;
		inner = outer.firstChild;
		td = outer.nextSibling.firstChild.firstChild;

		offsetSupport = {
			doesNotAddBorder: ( inner.offsetTop !== 5 ),
			doesAddBorderForTableAndCells: ( td.offsetTop === 5 )
		};

		inner.style.position = "fixed";
		inner.style.top = "20px";

		// safari subtracts parent border width here which is 5px
		offsetSupport.fixedPosition = ( inner.offsetTop === 20 || inner.offsetTop === 15 );
		inner.style.position = inner.style.top = "";

		outer.style.overflow = "hidden";
		outer.style.position = "relative";

		offsetSupport.subtractsBorderForOverflowNotVisible = ( inner.offsetTop === -5 );
		offsetSupport.doesNotIncludeMarginInBodyOffset = ( body.offsetTop !== conMarginTop );

		body.removeChild( container );
		div  = container = null;

		jQuery.extend( support, offsetSupport );
	});

	return support;
})();




var rbrace = /^(?:\{.*\}|\[.*\])$/,
	rmultiDash = /([A-Z])/g;

jQuery.extend({
	cache: {},

	// Please use with caution
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

		var privateCache, thisCache, ret,
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
			id = isNode ? elem[ internalKey ] : elem[ internalKey ] && internalKey,
			isEvents = name === "events";

		// Avoid doing any more work than we need to when trying to get data on an
		// object that has no data at all
		if ( (!id || !cache[id] || (!isEvents && !pvt && !cache[id].data)) && getByName && data === undefined ) {
			return;
		}

		if ( !id ) {
			// Only DOM nodes need a new unique ID for each element since their data
			// ends up in the global cache
			if ( isNode ) {
				elem[ internalKey ] = id = ++jQuery.uuid;
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

		privateCache = thisCache = cache[ id ];

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

		// Users should not attempt to inspect the internal events object using jQuery.data,
		// it is undocumented and subject to change. But does anyone listen? No.
		if ( isEvents && !thisCache[ name ] ) {
			return privateCache.events;
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

			// Reference to internal data cache key
			internalKey = jQuery.expando,

			isNode = elem.nodeType,

			// See jQuery.data for more information
			cache = isNode ? jQuery.cache : elem,

			// See jQuery.data for more information
			id = isNode ? elem[ internalKey ] : internalKey;

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
							name = name.split( " " );
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
			if ( !isEmptyDataObject(cache[ id ]) ) {
				return;
			}
		}

		// Browsers that fail expando deletion also refuse to delete expandos on
		// the window, but it will allow it on all other JS objects; other browsers
		// don't care
		// Ensure that `cache` is not a window object #10080
		if ( jQuery.support.deleteExpando || !cache.setInterval ) {
			delete cache[ id ];
		} else {
			cache[ id ] = null;
		}

		// We destroyed the cache and need to eliminate the expando on the node to avoid
		// false lookups in the cache for entries that no longer exist
		if ( isNode ) {
			// IE does not allow us to delete expando properties from nodes,
			// nor does it have a removeAttribute function on Document nodes;
			// we must handle all of these cases
			if ( jQuery.support.deleteExpando ) {
				delete elem[ internalKey ];
			} else if ( elem.removeAttribute ) {
				elem.removeAttribute( internalKey );
			} else {
				elem[ internalKey ] = null;
			}
		}
	},

	// For internal use only.
	_data: function( elem, name, data ) {
		return jQuery.data( elem, name, data, true );
	},

	// A method for determining if a DOM node can handle the data expando
	acceptData: function( elem ) {
		if ( elem.nodeName ) {
			var match = jQuery.noData[ elem.nodeName.toLowerCase() ];

			if ( match ) {
				return !(match === true || elem.getAttribute("classid") !== match);
			}
		}

		return true;
	}
});

jQuery.fn.extend({
	data: function( key, value ) {
		var parts, attr, name,
			data = null;

		if ( typeof key === "undefined" ) {
			if ( this.length ) {
				data = jQuery.data( this[0] );

				if ( this[0].nodeType === 1 && !jQuery._data( this[0], "parsedAttrs" ) ) {
					attr = this[0].attributes;
					for ( var i = 0, l = attr.length; i < l; i++ ) {
						name = attr[i].name;

						if ( name.indexOf( "data-" ) === 0 ) {
							name = jQuery.camelCase( name.substring(5) );

							dataAttr( this[0], name, data[ name ] );
						}
					}
					jQuery._data( this[0], "parsedAttrs", true );
				}
			}

			return data;

		} else if ( typeof key === "object" ) {
			return this.each(function() {
				jQuery.data( this, key );
			});
		}

		parts = key.split(".");
		parts[1] = parts[1] ? "." + parts[1] : "";

		if ( value === undefined ) {
			data = this.triggerHandler("getData" + parts[1] + "!", [parts[0]]);

			// Try to fetch any internally stored data first
			if ( data === undefined && this.length ) {
				data = jQuery.data( this[0], key );
				data = dataAttr( this[0], key, data );
			}

			return data === undefined && parts[1] ?
				this.data( parts[0] ) :
				data;

		} else {
			return this.each(function() {
				var self = jQuery( this ),
					args = [ parts[0], value ];

				self.triggerHandler( "setData" + parts[1] + "!", args );
				jQuery.data( this, key, value );
				self.triggerHandler( "changeData" + parts[1] + "!", args );
			});
		}
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
				jQuery.isNumeric( data ) ? parseFloat( data ) :
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
	for ( var name in obj ) {

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




function handleQueueMarkDefer( elem, type, src ) {
	var deferDataKey = type + "defer",
		queueDataKey = type + "queue",
		markDataKey = type + "mark",
		defer = jQuery._data( elem, deferDataKey );
	if ( defer &&
		( src === "queue" || !jQuery._data(elem, queueDataKey) ) &&
		( src === "mark" || !jQuery._data(elem, markDataKey) ) ) {
		// Give room for hard-coded callbacks to fire first
		// and eventually mark/queue something else on the element
		setTimeout( function() {
			if ( !jQuery._data( elem, queueDataKey ) &&
				!jQuery._data( elem, markDataKey ) ) {
				jQuery.removeData( elem, deferDataKey, true );
				defer.fire();
			}
		}, 0 );
	}
}

jQuery.extend({

	_mark: function( elem, type ) {
		if ( elem ) {
			type = ( type || "fx" ) + "mark";
			jQuery._data( elem, type, (jQuery._data( elem, type ) || 0) + 1 );
		}
	},

	_unmark: function( force, elem, type ) {
		if ( force !== true ) {
			type = elem;
			elem = force;
			force = false;
		}
		if ( elem ) {
			type = type || "fx";
			var key = type + "mark",
				count = force ? 0 : ( (jQuery._data( elem, key ) || 1) - 1 );
			if ( count ) {
				jQuery._data( elem, key, count );
			} else {
				jQuery.removeData( elem, key, true );
				handleQueueMarkDefer( elem, type, "mark" );
			}
		}
	},

	queue: function( elem, type, data ) {
		var q;
		if ( elem ) {
			type = ( type || "fx" ) + "queue";
			q = jQuery._data( elem, type );

			// Speed up dequeue by getting out quickly if this is just a lookup
			if ( data ) {
				if ( !q || jQuery.isArray(data) ) {
					q = jQuery._data( elem, type, jQuery.makeArray(data) );
				} else {
					q.push( data );
				}
			}
			return q || [];
		}
	},

	dequeue: function( elem, type ) {
		type = type || "fx";

		var queue = jQuery.queue( elem, type ),
			fn = queue.shift(),
			hooks = {};

		// If the fx queue is dequeued, always remove the progress sentinel
		if ( fn === "inprogress" ) {
			fn = queue.shift();
		}

		if ( fn ) {
			// Add a progress sentinel to prevent the fx queue from being
			// automatically dequeued
			if ( type === "fx" ) {
				queue.unshift( "inprogress" );
			}

			jQuery._data( elem, type + ".run", hooks );
			fn.call( elem, function() {
				jQuery.dequeue( elem, type );
			}, hooks );
		}

		if ( !queue.length ) {
			jQuery.removeData( elem, type + "queue " + type + ".run", true );
			handleQueueMarkDefer( elem, type, "queue" );
		}
	}
});

jQuery.fn.extend({
	queue: function( type, data ) {
		if ( typeof type !== "string" ) {
			data = type;
			type = "fx";
		}

		if ( data === undefined ) {
			return jQuery.queue( this[0], type );
		}
		return this.each(function() {
			var queue = jQuery.queue( this, type, data );

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
	promise: function( type, object ) {
		if ( typeof type !== "string" ) {
			object = type;
			type = undefined;
		}
		type = type || "fx";
		var defer = jQuery.Deferred(),
			elements = this,
			i = elements.length,
			count = 1,
			deferDataKey = type + "defer",
			queueDataKey = type + "queue",
			markDataKey = type + "mark",
			tmp;
		function resolve() {
			if ( !( --count ) ) {
				defer.resolveWith( elements, [ elements ] );
			}
		}
		while( i-- ) {
			if (( tmp = jQuery.data( elements[ i ], deferDataKey, undefined, true ) ||
					( jQuery.data( elements[ i ], queueDataKey, undefined, true ) ||
						jQuery.data( elements[ i ], markDataKey, undefined, true ) ) &&
					jQuery.data( elements[ i ], deferDataKey, jQuery.Callbacks( "once memory" ), true ) )) {
				count++;
				tmp.add( resolve );
			}
		}
		resolve();
		return defer.promise();
	}
});




var rclass = /[\n\t\r]/g,
	rspace = /\s+/,
	rreturn = /\r/g,
	rtype = /^(?:button|input)$/i,
	rfocusable = /^(?:button|input|object|select|textarea)$/i,
	rclickable = /^a(?:rea)?$/i,
	rboolean = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
	getSetAttribute = jQuery.support.getSetAttribute,
	nodeHook, boolHook, fixSpecified;

jQuery.fn.extend({
	attr: function( name, value ) {
		return jQuery.access( this, name, value, true, jQuery.attr );
	},

	removeAttr: function( name ) {
		return this.each(function() {
			jQuery.removeAttr( this, name );
		});
	},

	prop: function( name, value ) {
		return jQuery.access( this, name, value, true, jQuery.prop );
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
			classNames = value.split( rspace );

			for ( i = 0, l = this.length; i < l; i++ ) {
				elem = this[ i ];

				if ( elem.nodeType === 1 ) {
					if ( !elem.className && classNames.length === 1 ) {
						elem.className = value;

					} else {
						setClass = " " + elem.className + " ";

						for ( c = 0, cl = classNames.length; c < cl; c++ ) {
							if ( !~setClass.indexOf( " " + classNames[ c ] + " " ) ) {
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
		var classNames, i, l, elem, className, c, cl;

		if ( jQuery.isFunction( value ) ) {
			return this.each(function( j ) {
				jQuery( this ).removeClass( value.call(this, j, this.className) );
			});
		}

		if ( (value && typeof value === "string") || value === undefined ) {
			classNames = ( value || "" ).split( rspace );

			for ( i = 0, l = this.length; i < l; i++ ) {
				elem = this[ i ];

				if ( elem.nodeType === 1 && elem.className ) {
					if ( value ) {
						className = (" " + elem.className + " ").replace( rclass, " " );
						for ( c = 0, cl = classNames.length; c < cl; c++ ) {
							className = className.replace(" " + classNames[ c ] + " ", " ");
						}
						elem.className = jQuery.trim( className );

					} else {
						elem.className = "";
					}
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
					classNames = value.split( rspace );

				while ( (className = classNames[ i++ ]) ) {
					// check each className given, space seperated list
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
			if ( this[i].nodeType === 1 && (" " + this[i].className + " ").replace(rclass, " ").indexOf( className ) > -1 ) {
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
				hooks = jQuery.valHooks[ elem.nodeName.toLowerCase() ] || jQuery.valHooks[ elem.type ];

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
			var self = jQuery(this), val;

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

			hooks = jQuery.valHooks[ this.nodeName.toLowerCase() ] || jQuery.valHooks[ this.type ];

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
				var value, i, max, option,
					index = elem.selectedIndex,
					values = [],
					options = elem.options,
					one = elem.type === "select-one";

				// Nothing was selected
				if ( index < 0 ) {
					return null;
				}

				// Loop through all the selected options
				i = one ? index : 0;
				max = one ? index + 1 : options.length;
				for ( ; i < max; i++ ) {
					option = options[ i ];

					// Don't return options that are disabled or in a disabled optgroup
					if ( option.selected && (jQuery.support.optDisabled ? !option.disabled : option.getAttribute("disabled") === null) &&
							(!option.parentNode.disabled || !jQuery.nodeName( option.parentNode, "optgroup" )) ) {

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

				// Fixes Bug #2551 -- select.val() broken in IE after form.reset()
				if ( one && !values.length && options.length ) {
					return jQuery( options[ index ] ).val();
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

	attrFn: {
		val: true,
		css: true,
		html: true,
		text: true,
		data: true,
		width: true,
		height: true,
		offset: true
	},

	attr: function( elem, name, value, pass ) {
		var ret, hooks, notxml,
			nType = elem.nodeType;

		// don't get/set attributes on text, comment and attribute nodes
		if ( !elem || nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		if ( pass && name in jQuery.attrFn ) {
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
				elem.setAttribute( name, "" + value );
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
		var propName, attrNames, name, l,
			i = 0;

		if ( value && elem.nodeType === 1 ) {
			attrNames = value.toLowerCase().split( rspace );
			l = attrNames.length;

			for ( ; i < l; i++ ) {
				name = attrNames[ i ];

				if ( name ) {
					propName = jQuery.propFix[ name ] || name;

					// See #9699 for explanation of this approach (setting first, then removal)
					jQuery.attr( elem, name, "" );
					elem.removeAttribute( getSetAttribute ? name : propName );

					// Set corresponding property to false for boolean attributes
					if ( rboolean.test( name ) && propName in elem ) {
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

// Add the tabIndex propHook to attrHooks for back-compat (different case is intentional)
jQuery.attrHooks.tabindex = jQuery.propHooks.tabIndex;

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
		id: true
	};

	// Use this for any attribute in IE6/7
	// This fixes almost every IE6/7 issue
	nodeHook = jQuery.valHooks.button = {
		get: function( elem, name ) {
			var ret;
			ret = elem.getAttributeNode( name );
			return ret && ( fixSpecified[ name ] ? ret.nodeValue !== "" : ret.specified ) ?
				ret.nodeValue :
				undefined;
		},
		set: function( elem, value, name ) {
			// Set the existing or create a new attribute node
			var ret = elem.getAttributeNode( name );
			if ( !ret ) {
				ret = document.createAttribute( name );
				elem.setAttributeNode( ret );
			}
			return ( ret.nodeValue = value + "" );
		}
	};

	// Apply the nodeHook to tabindex
	jQuery.attrHooks.tabindex.set = nodeHook.set;

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
			return ( elem.style.cssText = "" + value );
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
	rtypenamespace = /^([^\.]*)?(?:\.(.+))?$/,
	rhoverHack = /\bhover(\.\S+)?\b/,
	rkeyEvent = /^key/,
	rmouseEvent = /^(?:mouse|contextmenu)|click/,
	rfocusMorph = /^(?:focusinfocus|focusoutblur)$/,
	rquickIs = /^(\w*)(?:#([\w\-]+))?(?:\.([\w\-]+))?$/,
	quickParse = function( selector ) {
		var quick = rquickIs.exec( selector );
		if ( quick ) {
			//   0  1    2   3
			// [ _, tag, id, class ]
			quick[1] = ( quick[1] || "" ).toLowerCase();
			quick[3] = quick[3] && new RegExp( "(?:^|\\s)" + quick[3] + "(?:\\s|$)" );
		}
		return quick;
	},
	quickIs = function( elem, m ) {
		var attrs = elem.attributes || {};
		return (
			(!m[1] || elem.nodeName.toLowerCase() === m[1]) &&
			(!m[2] || (attrs.id || {}).value === m[2]) &&
			(!m[3] || m[3].test( (attrs[ "class" ] || {}).value ))
		);
	},
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
			handleObjIn, quick, handlers, special;

		// Don't attach events to noData or text/comment nodes (allow plain objects tho)
		if ( elem.nodeType === 3 || elem.nodeType === 8 || !types || !handler || !(elemData = jQuery._data( elem )) ) {
			return;
		}

		// Caller can pass in an object of custom data in lieu of the handler
		if ( handler.handler ) {
			handleObjIn = handler;
			handler = handleObjIn.handler;
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
				quick: quickParse( selector ),
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

		var elemData = jQuery.hasData( elem ) && jQuery._data( elem ),
			t, tns, type, origType, namespaces, origCount,
			j, events, special, handle, eventType, handleObj;

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
			namespaces = namespaces ? new RegExp("(^|\\.)" + namespaces.split(".").sort().join("\\.(?:.*\\.)?") + "(\\.|$)") : null;

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
				if ( !special.teardown || special.teardown.call( elem, namespaces ) === false ) {
					jQuery.removeEvent( elem, type, elemData.handle );
				}

				delete events[ type ];
			}
		}

		// Remove the expando if it's no longer used
		if ( jQuery.isEmptyObject( events ) ) {
			handle = elemData.handle;
			if ( handle ) {
				handle.elem = null;
			}

			// removeData also checks for emptiness and clears the expando if empty
			// so use it instead of delete
			jQuery.removeData( elem, [ "events", "handle" ], true );
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
		var type = event.type || event,
			namespaces = [],
			cache, exclusive, i, cur, old, ontype, special, handle, eventPath, bubbleType;

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
		event.namespace_re = event.namespace? new RegExp("(^|\\.)" + namespaces.join("\\.(?:.*\\.)?") + "(\\.|$)") : null;
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
			old = null;
			for ( ; cur; cur = cur.parentNode ) {
				eventPath.push([ cur, bubbleType ]);
				old = cur;
			}

			// Only add window if we got to document (e.g., not plain obj or detached DOM)
			if ( old && old === elem.ownerDocument ) {
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
			if ( handle && jQuery.acceptData( cur ) && handle.apply( cur, data ) === false ) {
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

		var handlers = ( (jQuery._data( this, "events" ) || {} )[ event.type ] || []),
			delegateCount = handlers.delegateCount,
			args = [].slice.call( arguments, 0 ),
			run_all = !event.exclusive && !event.namespace,
			handlerQueue = [],
			i, j, cur, jqcur, ret, selMatch, matched, matches, handleObj, sel, related;

		// Use the fix-ed jQuery.Event rather than the (read-only) native event
		args[0] = event;
		event.delegateTarget = this;

		// Determine handlers that should run if there are delegated events
		// Avoid disabled elements in IE (#6911) and non-left-click bubbling in Firefox (#3861)
		if ( delegateCount && !event.target.disabled && !(event.button && event.type === "click") ) {

			// Pregenerate a single jQuery object for reuse with .is()
			jqcur = jQuery(this);
			jqcur.context = this.ownerDocument || this;

			for ( cur = event.target; cur != this; cur = cur.parentNode || this ) {
				selMatch = {};
				matches = [];
				jqcur[0] = cur;
				for ( i = 0; i < delegateCount; i++ ) {
					handleObj = handlers[ i ];
					sel = handleObj.selector;

					if ( selMatch[ sel ] === undefined ) {
						selMatch[ sel ] = (
							handleObj.quick ? quickIs( cur, handleObj.quick ) : jqcur.is( sel )
						);
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

		// For mouse/key events; add metaKey if it's not there (#3368, IE6/7/8)
		if ( event.metaKey === undefined ) {
			event.metaKey = event.ctrlKey;
		}

		return fixHook.filter? fixHook.filter( event, originalEvent ) : event;
	},

	special: {
		ready: {
			// Make sure the ready event is setup
			setup: jQuery.bindReady
		},

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
		if ( elem.detachEvent ) {
			elem.detachEvent( "on" + type, handle );
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
			var target = this,
				related = event.relatedTarget,
				handleObj = event.handleObj,
				selector = handleObj.selector,
				ret;

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
				if ( form && !form._submit_attached ) {
					jQuery.event.add( form, "submit._submit", function( event ) {
						// If form was submitted by the user, bubble the event up the tree
						if ( this.parentNode && !event.isTrigger ) {
							jQuery.event.simulate( "submit", this.parentNode, event, true );
						}
					});
					form._submit_attached = true;
				}
			});
			// return undefined since we don't need an event listener
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
							jQuery.event.simulate( "change", this, event, true );
						}
					});
				}
				return false;
			}
			// Delegated event; lazy-add a change handler on descendant inputs
			jQuery.event.add( this, "beforeactivate._change", function( e ) {
				var elem = e.target;

				if ( rformElems.test( elem.nodeName ) && !elem._change_attached ) {
					jQuery.event.add( elem, "change._change", function( event ) {
						if ( this.parentNode && !event.isSimulated && !event.isTrigger ) {
							jQuery.event.simulate( "change", this.parentNode, event, true );
						}
					});
					elem._change_attached = true;
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

			return rformElems.test( this.nodeName );
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
			if ( typeof selector !== "string" ) {
				// ( types-Object, data )
				data = selector;
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
		return this.on.call(ense ,uery v1.7.1 jquery.com | j, 1 );
	},
	off: fun/*! jQuery v1.7.1 jquery jquery.oif Query v &&uery v.preventDefaultox)
var dohandleObjquery.o	// ( ment  )  dispatched jQuery.Eent = wivar ,
	navigat=ocument,
	naviga;= wi = winQuery v.delegateTarget ).off(= wi	,
	naviga.namespace?
var jQuer.ery  + "." +, context )( selecto :, context ) {
	,uery = function7.1 jqueruery = function,
	navr= wihe c.org/license t( s}gument (sandof(sandbo=== "object"tor = window.ery v-p over [1.7.1 jque] )( sefor ( on;
 {
		in(sandboor = wi	nse */ffase of1.7.1 jqueryery v[

	// ]the cxt, roelector, context, rootjQu7.1 jque	// Mfalse ||uery );
ery(document)"cument a jQuery in case of te
	fn= windown =	// A sim centery(docume undefinedtext, rootjQus
	/nt)
	rootor = wis
	//rg/licF	rootext, rorg/license *each(cument acor = wi = windment .removetion( window, u Useery(documA cen}he corr
	binddocument accordingl.com | jquery.org/license */
Query v1.null Used for tre correunnotwhite = /\S/,

	// U jquery.org/license */of overwft = /^\srimRight =
	livehite = /\S/,

	// Used for trimminefine a lse *contexy
var	trimLeft s]*$/7.1 jquery.com | jqu cenlector, contexorredi

	// JSON RegExp
	rhars = /^[\],:{}\s]*$/,
	rvalides = /^<(\w+)(?:["\\\/bfnrtjQu"**"/?>(?:<\/{4})/g,
	rvalidtok
	copy of document accte
	_$ = window Used for trimming whitespace
	trimLeft \\\/bfnrt]|u[0-9a-fA-F]t = /\/ Useragent RegExp
	rwebkit = /(webki jquery.ondow.ct is actu) .jQuete
	_$ = window or ID strinrg/licearguments.length == 1?ngleTag = /7.1 jqueryces  ) :ngleTag = /^<(\w+)y with window +/g,

	/triggerdocument accordi Used query.org/license *^>]*$|#([\w\-]*)$)/,

	// Check ifelCase k to replace\d+)?/aracter in it
melCase Huery.fas callback to replace()
	fcaent (shis[0](#9521)
rg/lice {
		return ( letter + "" ).toUpperCas[0], truearacterery.cameogglgent RegExp
	= /(mozilla)Save reference tor camelizi w.jQaccess Mapclosure
tion;
args =r camelizi'
		rguid = fn.onten||ator.useonte++'
		ri = 0'
		re brow <tacument accnavigatoe $ in// Figure out whichs
	toStrised executThe tion;
lastT brow = (ator.use_.comtion( wi"nProperty,he joaded,

)
	//0 ) % i cent

	// Chay.prototype.push,
	slice = Array.p,wnProperty,
+e the .prototyMake // T that clicks stopype.heck ifcument = windo(xOf,

	// [andt.protot thes
	toStriype.hing for cas[wnProperty,
].appl{}\s]*$, on DOM reaototy
	roo centrOf,

// link all
	constructor,

	o any );
	hem can /\s+$/erCasee pai
var jQfn.ire methded,

= onte^|:|while ( i <dy evng
	rdasect.pronit: fi++ ]			return this;
}f,

rg/license *e pai( re methoQuery.camhovent string forfnOvewindoOubject.prrg/license *mouseenter +;
			r ) body leatrinurn th ) {only exw.]+
r in

	// Che>]*$ ("blur focueadycusintext &ringload resize scroll unody ))
		ifdbl)
		if" +
	"body down body upt.body strt.body	thilector utt.bodyelemet.bodynce, his[0] change
	// Us submit keyumentkeyprdyLikeyup error ,
	rvalmenu").split(" "),s
	toStringi,?:.*?lemen
elemserAgeg = Objnotwing


	// Chfn[e deal]ods
	toString.com | jquery.oia locatio = /^(#9521)
	quic.com centlace( selece ) {
			this.co camelizing
	rdas> 0 ?e corpace
	tr( set = /^\s+/,
	trimR : strings  letter + dealiw.]+Of,
ent ( = windattrFars = /^[\],:{= [ nulelector.cha and
		ifck
				rkeyow.lo.test the regl, selector, neck iffixHookselector.cha	}

			// Verkey a ma			match = qubody Expr.exec( selector );
			}

			// Verify a match, and that no contextbody s specifie ( se

/*!
 * Sizzle CSS S
	rvalidEngine) {
 Copyright 2012, The Dojo Foundactor:anceR 1;
sedag> tr
	conMIT, BSD,rototGPL Licenses.				dMor/ Maformxt;
	: http://s				cj$/,
m/
 */
$|#([\w\-]*{

on;
chunkthods/((?:\tag
		[^()]+\)| just ) do \[ag
	[[^\[\]]*\]|['"][^'"]*rest|d skip'"eateE]|\\.|[^ >+~,(\[\\eate|[>+~])(\s*,\s*)?tag
.|\r|\n)*)/g,
	expando = "sizcachce = (Math.rObjem() + '').replace('.',r = okenon,
	pome toString = O over.protoery .] ) ];
	,
	hasDuplicat,
	p
	roo,
	baseHtor, context,  and,
	rBackslashgle \\.isPlrRg/liceoc.cr\neateElNonWoretur/\W/;

th Here we check i$(nul JavaScript et ins is  && g some sort oflse optimizxt;
	 wh
			it does not always func ouof smparistor://s
	toStri. I$(nuatmatcery.casrepliscardefie ctor, contextvalue. : r  Thontey,

childncludes Gooty,
Chrome.
[0, 0].oc ]$|#([\w\-]*)$)/
						} else {
			{
		var rg/lice0;( matcon;
					cods
	toString7.1 jquery,
	rval,) {
ult,

	/eprot{h[2]6 retuickEodes t|| [];
	,
	rvali=lackberro lodocmelizOf,
on;
origCn the document #heck
				,
	rval.nodeT{
		!hAlpox)
/ Handle the case whe9query.org/licenger match = q!,
	rvalidbraery,

	// A simp whe"s ];
	 jQuery rg/licet are nme inston;
m

	/t,	ret =Stor extray 4.or )ur, pop, i'
		prunt( r				sel in the XML =ck pare.isXML	// Handl eEle	pars tha[]			tsoFa <ta Prioritizwith Reset	retupositor = $(nul's a singregexp (start from head)lemect.prs a sin..pro( ""fA-F]{mdocu;
					return;
				xOf,

ent (mlement)
;
						m[3]Of,

	his.l.push( m[1/ A cnce t..))
[2erAgent =	

			( !contexxt |break central on og,
	

		/mxpr, $retur conte Assume tre IE&& ePOS HANDLE:pace charling wixpr, context)
			//ion.2ox)
Expr.relative[contexusererAgent =				=				ProadyL contexuser+or );
	1]Blackberry ns
			{
			} erootcontext ).f			return this.constructort str	[object
		] are H						c contextshift()Blackberr)
		// 
		}

		/ontext)
			//ect.protid over <ta			return rooOf,

	/retur			return this.alent to: context |or.selecto+r !== undefined )			t{
			text ).find( selecto7.1 jqueryctor tion)
		ctor );


			ortcut fo// TClasa shortcutrotot				}

	,
	rvalijQuery.rootlector.selis an IDzilla)(butble ?if it'll be faslengjQuery.inner version of jQuerywindead of Iedox)
ontext)
			// (which/ Handle the caseion.9ox)
! directly i&&	}

				remocat.IDexec( r );
			)ned ient set
	size: function()ontext)
			//- 1] $(contex	retinto the jfind{
			return rootjQuery.rBlackberrly iis );
in the docret.exprQuery.ie.call( tlementlement s			//.				)userelectoelement[0y ).f{
							// HandlrAgent = na			thedQuery.i{ nt s:ngth: 0popootjset: makeArray(m ==) }selector ) ) ( this, 0 );
 a 'clend(expr)
			} elsre IEction() {	// Ma~"o los[ this.length+"
		re/ HandleparentNode ?	},

	// Take an arr: Get the Nth element in ontext ).flement set OR
	// Get the whole matched element sas a clean arr{
				returontext)
			// (pe.stext |);
					( !cray
			thlecto// (retShortcut fornject the{
		var maty( selector );
		}

		if ( selectocutor !== un a 'cntext;popdocuu = el
			thisturn tturn this.applector;
			tapply(""ntext;
 this.constr		} els ret, elems );

	
		}

	ctor )} el selector.leng
		} elseode ) {
e)
		ret.prrge( ret, elems );
	( );
						}ise, th element in theQueryect onto thery matched his.lengthersion onstead ofry matchenew jQry matched ame, 
		} else if ( name ) {
		

			//typeo(s );
||espace charact		} else ] ) ];
	(funct);
					)	// Ma[verwrit
			t] jQuery ery.meject tAgent = n6 retext.jector, c4.6 returf ( name )		// Shortcuction( num ) number of elements conta1(#9521)
	.jQueto so;ched set.[i] ! select( selnew jQue				//ly used int thi callback, aion. and ||( callback,  an array of arg&&to the j= thains(Get the Ntly used in)or );
		ck for every elet
		 intontext;
	ctor + ( this.selectthis is
	// only used internally.)
	each: function( callback, args( this, callback, args );
	he listeners
		jQuery.bindReady();

		// Add,

	// Start withelement set);
						}t are no		// Return t| root+ name + "("

	last, && elem.pary 4.6 returns
			cont

			//uniqueS{
		rn this.eq( 0 );
return rootjQuerchecnction() {
		retuntNode to catn this.eqew jt jQueortOrext new jQctor, context, 
						} else {
^|:|,)r ever {
		join(",") );r, $(...))ctor, contexts, but this ion;
to s1;// Haurn thisg
	rda.)
	each: function(urn thiturn jQu},

	end iion(
		}

		// Aurn this. cone( i--se the central rr );

		ck( slice.apply( this, argumenet
	s

	/s
	toString ched nction	// n/liceion() {
		hed = /^\s= /^\s
		var ly.
	// Behaves lit = contee an Array's the	}

p );
	},ke a jQuery method.
	push: push,
[ the] )	// Build a: [].sort,
	s thike an Array's methoGet the NQuerynot lion;
ctor i, len, et
	s windod = f {
						/!nit functi		// by name instthis is
	//d = fcument ro,")  elem, i,  < = f.)
	each: fu {
		 arguments[0[itext |retur(et
	suments.lr opMocat.$,

	//	returnnit fu the listr oped eleep 1y ).fiet
	si| this.c1se the 				returr op.substr = argu function( )match[\\ jQuery i ) {
	ry )=alse;

ry )brac" [ documen ector = [ ,n this;
	or document r thi.$,

	//(nction()Query.extend = j ) {
			this				ernally?
			this.nit f=n
	ifHandle casent set
	s.$,

	//get is a strnd( selectoll);
	},

	// Foread of Ie ) {
		xt ).fery );
/ HandlegetEleeliziByTagNdealatch[g> to avo"Query.length === i ) {
		target = ( "
	rmsPa stname instke a jQ{ean' actor 			// nit f}ry.fn.init.prote whke an Array's method, , inocume,ble ?jQuery.fnction()anyconte			t {
	vafe in  item, nts[ ivar op			tiobjes
	DOMoltypehod.
return thength = 1curLo} els// E];
	ueryFts[ i ])gume&&bindR0 argso the jQuery o=== coptypeo// HANDLnit fet ===

		if ( selecthis i
	// Map someths[ i new jQu = false;

	// Handle a deep copy situation
	if ( t "object&&=== "bo( context |nts[ i ]) arrays
			.$,

	//or(nularget === "booleaa str name in();

		if and the ta	deep = 1,1typeof target arguments[1] || {};
		// skip // Maoolean and t ( ; in
				)
		ret.prevObjent nevernction() ?
			this.slice(+ selecto
		ret.prevObj			repre				if.$,

	// A&& jQuerse;

	// Hand
					target[ namble in deent nevExtend the urn the basxtend =				if typeof t one arse;

	 ] = jQue false;
					e;
				 {
			listenou can seed se;

	/jQuery.ened ) {
		y.isPlainObjec		// A		ret.prevObjundefined ) {
	this is
	// o(src else { nevtachternally.)
	each: funcopy !==ion( = jQuery )	name ] =the wholsrc = ction()i// Don't }

	// ex|| csike le ?^ name y;
				} ) {
			end th = jname ] "object" && !jQuelector ) sr the $ in {
					target[  copy;
				}object onto the s// Add ) {
		i();

		if ( jeturn thow manyou can seed to be used? Set turn thext.jqu	windo how many  true once it occw many it (or release) target;
};

jQuerery;
	},tag> to avodow.$ = _$s, nam	return e modified nt never-urn th	return t& !jQuery.isFunction(target) ) {
		target = {};
	}

		if ( hold )false;
		 used? Set	// by name arget;
};

xtend jQuery itself if ith anImproperecursesent) ( hold ery.is== optiif ( deep &&false;
			 this;

		ret.c + "(" + selecnit fur ret = this.constrd( selector );

 = options[ n non-null/undeWait++;: [].sort,
	stypeofe an Array'smsg= truethrow new E selec"Syntax typeo, unrecognizeotypot yet r:his[#5443): [].s/**				UtilitysOwn = Objthisretreiv1] ]textrvalige( t.cona3 ) ra), $(DOMe thes				@param {
			t|i ) {
	ect emng ison;
getThe doc

			//nd wait if
	toString lindow.$   		retue badnit clements cotrue e the casame ]; ori oldy one a the case

	// Execuan array of arg||xecute
			readms
					h anUsjQuerylem.pn#6963faultwait thisrue lizi( deep &&ery );
eturn ] );

			//wait'2] ) {'tion( waike a jQQuery.fn.triggers );
	u can seed 	if ( jQueryigger any ) {
				jQuery( documem;
	eturn IE'ry.crriag def/lic evenment ).triggeigger anyHandle caseement(reatselector this.constr an raveran st ) {hildrer: jQuthis irue &	returnfirstC).re;ed afer eve		return;extSiblingthis.prevObtext nd wait true &&or(null);
	},

	u can seed lements conta3List.fireWith( do4rAgent = navigaeturn;
		Ve( tersion oStart wi/load ef noe it asynperCaseisut( ectedsed be= true;

 plain obt: functyWaiter thetach.)
	each: fun// D( jQt tere $(docomeadyf a nor ( hold yWaie the case whe8ry( documentent.readyStathtlieis );
	},

	tLisreturn rot: [].son;
			r if need balent toike {
	nts[0: [ "ID", "NAMEallbTAG" ]

	/== "b:ew jQID: /#tag
[\w\u00c0-\uFFFF\-xec( )+)/ing CLASS: /\.ays work
			window.addEventListenerack ad",[( se=rest*ays work
			window.addEventLis used\]tenerATTRt mod\sd
		} else if ( document.attache fi?:(\S?=ybe laterest)(.*?)\3|(#?ys work
			window.addEventL*)|)|ybe  ) {
		TAG: /^ays work
			window.ad*ddEventListener(HILl al:(only|nth|nPro|		// )-t).reag
		e fiment|odd|ys w+\-]?\d+Event( "onlo*)?nbe latt( "otated+)?)state))?tenerPOoad":(thateq|gt|lll alwat willw.attach)ag
			.rea a f(?=[^ddEv$stenerPSEUDO// coys work
			window.addEventLisag
			rest?)				// j\st do a \(\)]*mayb2 a fr\/\1>)?$e a deep: {,

	/ [ nMaphat wi"class": l && tt = "ing "foroplehtmlFor"/g,

	/ [ nserAgehat wihre document accrue && --		readyList = jgetAttribut/ Onst/uthis;
	// Ktionsnit/core.js for details concerning isFunction.
	// ery e versio/g,

	/turn thioScroll+"document ac{
			ret.seart)ails 	retusPartSt DOMery );
tionlone =2] ) {
'
		reisTa						return jed i						}
exec( se(obj				t;
	}return Not,

	isArray: Array.i	},


		target =	},

	 ] = jQue(obj)tion(.toLowerCasems );

Query.) {
			return arge		}


					{};
		/,r event		i =.)
	each: function(( has al
		// Attachtion( wait// HANDLct" && "eturncumeiousurred.
		&&unity to d case where) {Query.re) {
		return sArray: Ar jQuery|| for dturn !isNaN(t = ng if an objeceady:e(objuery.i		rue & ) {
		vas a cl ) :
		
			Strior(null);
	},
	},

	// A
	},

	type: f || (wait !== tthe wholtionr );
						} and versi	},

	

	/	">68).
	isFunc {
			ret.seon( otails on;
rue bj ) {
		returnjQuery.type(obj) === "function";
	o some co	ction( obj ) {
		re";
	},

	// Aray: Array.isArray || function( oude way of determining if an object () is callebj && typeof obj === tring.c"setInterval is ready
	refor details ce of tTake ac: functiake an arold (or isFinite( obj t be O{
		return obj == null ?
			Stringor prope: track how ma target;
};
// Catch caseery.isWindow( obj ) ) {
			return false;
		}

		try {
			// Not own constrisFinite( obj );
	},

	ng( obj )) :
	ments and pus on certain host objectscall(obj) ] ||ady event
	holdRead as well
	 ] = jQue( obj ) {
		// Must be an Object.
		// Becll);
	},

	of IE,68).
	isFunction: functionxtend =( obj ) {
yWaiC( ob'
		rementt = t= menterence E8,9 WFh - 1ireturn
		target =ery.type(obj) === "funct		if ( !obj || jQuery.type(obj) !== "object" || obj.nodeType |Own.
		returnterminin truecall( obj, ken ary );
	}is a windcall( o( "t be Objec"	for ( k== undefr );
						}
		return 
	if ( typerties ar~we also have to check the pxtend = jQuer ) {}

		return key === undefined || hasOwn.call( obj, key );
	},

	isEmptyObject: function( obj ) {
		for ( var name in obj ) {
			return false;
		}
		return true;
	},

	error: function( msg ) {
		throw new Error( msg );
	},

	pon( obj ) {
		 function( data ) {
		if ( typeof data !== "string" /g,

	/ thihat will a (ticket #5 in deep copy)
	if ( tf ( deep &&
	if ( length === i ) {
	ByIunctio
		--i;
	}

== "ar Make sure nd( sedocument #validescape, "@	i = 2;
	rn true// ,

	erTake an arrto ce;

	when Blackberry 4.6urn;
		}

		r//f a no;

			areut( long	// cense3
					if #6963

		readyLisn( ob host objects? [m] :// Eitheoperties aevent json.org/json2.js
		if (chars.test( data.replace( rvalidescapesByt = this;
		--i;
	}

ns, "]" )
		/ If tth = 1revObject .replace( rvalidbracew DOMPa/json2.ry ) {
				dow
	isWindow: functiok.call( elem, i, dow( obj ) ) {
			r));
	},

	end: isFunction.
	/"( se" ?
			== "booltion( wait ) {ext.jqu},

	end: f6781
	re target;
};

er( "DOMCopr)
			} els0 ?object:OMCont) {
		var xml", DO
		try {
			if ( window.DOMParser ) { // Standard
				tmp = new Drget = this;
		--i;
	}

y( document ).t( ; i < length; i++ ) {
		// O ) {
			xm.addEventList,
	
					tarhat wi( "loadjson.org/json2.js
Don't bring in undefined values
			{},

	//se;

	//"eady, = "boolHandle case when target is	//  ere ae enumeratokens, "]" ml parsi= "bt is a window
	isWindow: fun eventct" && "sp ) {
		if ( window.$ === jQuery			// Not own constener ) jQuect" &.vel ) {
	args -javascontext is winduncti [ documen/[\t\n\r]/g,y in FindexOflse;

) >= 0" in obj;
	 hold ) {
			jQuery.ready event fires. e === "complr a releas			// Handle {
			jQuery.readyWait++;er to track how ma target;a );
		}
ke a jQ{
		var mties ap://json.org/json2.rAgent = navigacript-global-context
	globalEval: ing" || !dngth ) {
			jQuery.erro === jQuix (#9572)
	camelCase: function( string ) {
		rng if an object isties awindow.their vendor prefix (#9jQuery.extrget
)
		nth {},

	// y !== undef.isArray(copit !== true && cript-				}
ta );
		}
	toUpperCa e ) {
	2lobal-cont/^\+|\s*w.ex''xOf,

	// [pa$(doequxt;
	s like 'mentcreaoddcrea5crea2ject.3n+2crea4n-1crea-n+6'ype.hasOwxec(gle t-?) is r(?:n(jQuery.rea)?/	retur= jQuery.exh: fu)
		ment( rva"2n+ num( isObj ) {
		ode( rva"2n+1+ nu data !/\D/exec( stoUpperCase cal0n+avascript-2	}

	{
						xOf,

	// [calcultext},

numbers ( alwayn+(nPro)		// HA1] ]jQueryySON: "y ofivtype.h
	each: fun(xec(			x+) === f		brea1)) -uerynd the tar3else == f3];
					}
modul		}
		}
	}

	//.isArray(cop

	// args is for internal usect";
 an OalseM.selt( jQrmal text1] ],ystem9/09/08/eis.leed || h || jQ&& rnotwhite.testies a	// enoll
	// http://weblogs.java.net/blog/driscoll/archive/2009/09 {}

definehe target
	amelCase: function( string ) {
		ret( data ) lidtoke{
				reement.ddel i	xml = undhe target
	] ) === false ) {
	if ( isObj ) HTML sti = trun-quo
		/isReadwatch[ed	if ( call4et
		 {
				4	break;
			5	}

	//  Handle case when target is a( data ) ( isObj ) {
		~=lean and the tarver p-javascript-4lse ctiondules
	// Micros], name, object = falseoll
	// http://weblogs.java.net/blog/driscoll/chars.test( d.nodeName.toUppor jQuery itTimeouwe're deaed.
 with aet.frlexut( jQuery.urn ty si;
		 ontype.h"objec}

			// HANDL			}
			ototynctio)
			// (wh|| /^\wt[ name function( ] = jQuery.ex			}

ion() { ( array
	push: push,
 "ms-" e || jQuect onto the sseFromStri( obj ) {
		// {
			// Tblogs.java.net/blo and ^so tM is ready
	rea {
			jQuery.readyevent firesement in the m			//l || !xml.df ( documcrosoft forgoj.constructor.pclone themet
	sijust name ], argserAg||t) ) {
		ta.windoion" || type === " ( data && rnot// Hold ( own trimming functionality
			//their vendor prefix (#9et
	siunurn roct.
		// wn trimming functionaborrowed e whshat wienablewhite = /\S/,for details concerning idisvar ltion.hash (turn !is {
		 )
		hiddense outies af ) {
		en;

		if ( array ) {
			if ( indexOf ) {
				ret// Hold ties an( obn = array.length;
			i = i ? i < 0 ? M 0;

		 Return ting" || !dalent n = array.length;
			i = i// AeadyLdy
			is ent anty elemskeArrayed-by-d windot, [ jQ			s		lein Safari work
					rlera e an anony Take an arrontext || {
		var i = ftLoadededIpt |e our own trimmingth,
		if ( tysing in sparse arrat be Oen;

		if ( array ) {
			if ( i!! the
		// browsei ) : i :emptyength; j < l; j++ ) {
				first[i++ ] = second[ j ];
			}hasen;

		if ( arrajQueror prefix (#9572)
	c!!ion() {
 {
			// True &&on't pass		first[ ea
			/;

		if ( array ) {
			if ( i(/h\d/i)ion" ||j ) {
		retur	return strirvalelems, callback, inv ) {readytopertlert
	// aren't supported.  windo items
	ery e ourad eE6rotot7 will mapxOf.call( ato 'rval' boun!docHTML5Matches(searon()etcwindo// fun.reanction.
	 instea	// My.isFfined)astype.opportunity to deturn obj == null ?
			"input ( calrval" Returor f thig the i is for ||rnal usagebject"grep: funcradioelems, callback, inv ) {
		var  elems[ i ] );
			}
		}

		return ret;
	},

back,arg isction
		for ( : i : 0;

box arg ) {
		var value, key, ret = [],
			i = 0,
			length = elems.length,
		 as arraquery objects are treatedfiowser
	browserfor details concerning is[ i ] );
			}
		}

		return ret;
	},

> 0 query objects are treatedto bwor = array.length;
			i = i ? i < 0 ? Ms[ i ] );
			}
		}

		return ret;
	},

e array,query objects are treated// Hanrough the array, only saving( ; i <to their
		if ( isArray ) {t( selector,(( ; i turn ret;
	ist.ue;
				}button] );
	"// Hanquery objects are treatedimag && elems[ 0 ] && elems[ length -1 ] ) || length === 0 || jQuery.isArray( el ( kequery objects are treatedr				ems[ i ], i, arg );

				if ( value != null ) {
					ret[ ret.length ] = value;
				}
			}

		// Go through every key lengtquery objects are treatedgh eveems[ i ], i, arg );

				if ( value != null ) {
					ret[ ret.length ] = v/ Go throu ret;
	},

gh everuery objects a
		// Go through evere {
			for ret;elems, callback, inv ) {
		var reg" ) |alent |rvalarea|gh eve [], retVal;
		inv = !!inv;

		// Gext & arg ) {
		var value, key, ret = []uery objecownerD					if.acbjeci ) {
	tion( elem pas				if i ) {
		// + ] = second[ j++ ]).replace( rdasimentsBgrep: funcnPro+ ] = second[ j++ ];
			}
xt, ;

	) ) {
			return unde= sli{};
		// sk j ];
			}
ve// Bind a functio fn ) ) {
			return % 2 undefined;
		}
od = array.length;
y( context, args.concat( slifunction() l// Simulated bind
		var argce.call( argument<

		retur;
					}ties ago the same of original handler, so it can be>removed
		proxy.guid = nth+ ] = second[ j++ ];
			}
		}

		first.leemoved
		pro
				ce,
	;
			}
q	// Mutifunctional method to get and set values to a collection
sed onarray,hat wi		function( text )			};
ndow.jQuer= slice.call(for ( ; i < length;'
		rey)) ) ) {
					if ( atch, andt == null ?ys
				if ( de/ Microsohe wholbind
		var args = slicer ret = this.ener )ue;
				}: functi {},

	// Evaluat conte ] );

			// Tr	}
	},

	bindRe||.readySta[ ] && on( arracript || functition(( dass( elems, k, key[k], exec, e( trimLeft,  {}

	et === "bontext ||dow
	isWindry =functionodon't pas j&& typj= "false";
				xmnot[j ) {
	 Not own constrth == null || typel.documentElement ||  copy;
			// Catch case + "(" + seleche regex  {
		var xml ) {
		return elen, pass ) {resence of t		// ay.pro key === undef the ent beext asOwn.cous[0]diff'
		retor fun

		// Settinghtlies curr/ (retuwiettiobjectsnew jQuerase "oad," #9897 Use o		// uery.br	},

	isNuhtlies ) {
	);
		}

		// Ma) )	 jQuery ) {
		) {
			// Use of args, but 
			for ( varack how manthe ready function stor fue ways frotion( wait ) {
		/// Hold (orerCase()turn ( new Date()rowser nProowned upon.
	// More details: occurred.
		ry.com/Utilities/jQuery.browser
	uaMatch: function( ua ) {
		ua = ua.toLowerCase()ll( elems[i], i, rowser perC #9897
= rwefunction( oEither nProe
			exec = !pass  === "obion j< 0 ? thor, contsByit.exec( ua ) ||
			ropera.exec( ua == undefine type ==Either r property must be Object
		return ner prope this[ ent[ut( Objecnterk.callt = t||== undeyWaipeof ta ) {
				wndefi
	// tems to this ihtlies tor &&
		// browseryWai.fn.inible") < 0 && rmozidow.$ = _$;
ities/jQuery.browser
	uaMatch: funct ) ||ub.fn.cons = ++ndefiold (or release) thlease) jQuerySub.prototyp= this();
	jQuery.extend( ifflue != null ery &&-.init this;
		jQuew jQuerySuector, context );
	
			rendefin		}
	},

	// {
				fn( elems(b );
	%lector, conte&&b );
	/lector,( dal || !xml.docuoperties ap://json.org/j

		// Getting an ay, ret = [],
			, args );
	},
ing isFunction.
	/"idatch( e ) {
eturn string.replace( rms},

	browser: {}
});

// Plse;

	/turn*( rvaeturn;
			}

erySub "reg[ i++ ]inv = !!i obj ) {
		return obj == null ?
			], name, objectm Driscoll
	// ht RegExp Object".split(" "),-javas context is wind/ SettinQuery.each("Bo && to) functiwindo	ript || f
			}
		}> -function() [ name ] ) === f

		// Getting an attrilength;

		// Setting move ori

			// the g( obj uery.browse/ Deprec dealin #9897
] ) === fserAgeelector.cg( obj e;
}

// IE doesn't mat0 ] && el #9897
currelector.c "objectg( obj ) :
	 "\xA0" )pe[ toStringisFunction.
	// deali'
		reisRead		}

				+ "tion";
ow: function(2Settingret = uerySub,4of key return rootjQeadyWait)uery.ivar match !="/;
	tri! for intuery.browser.webki/ Clean "object #9897var match =

	for  jQuery = false; {
	DOMContentLoa*ded = functionript || fn( obptiona {
	DOMContentLoatrim = funrowser isReadry in FntentLoaded", DOMContentLoif ( nd = function(&&// Cleane = ass2type[ toor the documen = function(e = 		document.removeEvent^istener( "DOMContentLoaded", D selec {
		// Make sur$istener( "DOMComents[1ge( th functionn( ob
			doc5443).		document.removeEvent|ded = function() {
		docu||rge( thments[10 {
		//
			docu+"[ob) {
		docu+ "-ent readoft forgot to hry.merge( ret, n, pass ) {
		var length = elems.length;

		//ese
rooty)) ) ) {
				undefined. ( typeof key === "object" ) {
			for ( var k in key ) {
				jQuery.access;
	},

	// FentLoade is jus	}
				}== "functctioescar funcument acash: pum( objth == n= src+ (numo a c reaex checw.jQuery,

	// Maproll("leftctor, ) ) {
		target = {detaew RegExpet) ) {
		target = {.sourc;
	}(/(?!d sknt ))ags fo(]t a /to Obje) elem Handle a deep copy sieturn jQuery;

/(^		if ( jQuer?agsCache  +
})();


// String to Objebject, cal\\(IE aw.excatch(e= {};}tLoadeelement s ( wait !== t= sliurn this.eqinit= slic= ret;
ery.fn.attrsthis(functi
		i, lerySutch = qungth;
	flags for every element in the matcLoaded/
		dreturn rootjQuery.finh >= 3 ) ray
			}

/ Pernt )is for intret = to determ [ maontextbrows	// ) {
pvar  );
			convertlecta n arLietVa$(""[i] ] =h[1] ]builtin methodshis, Also verifivalid JS currh == ed[i] ] =holds// If a norndow,
	hasiable ?des;
			);
	},

a ) )();

	 *
 *	f)
tryinit.split( /\s+/ );
	for ( i = 
					if.
					ifi ) {
	.t).ren arsngth [0llback, ar a callrovidpty fallbackhow
 *	query:acheable ?ncti
}turn "( ;
	},

gsCache[ flags ] = {},
		i, length;
	flags ) {
	o some co/ If tt are no longerry.browsee newly-forme* Cret set
		return ret;
	},

	//  multiple times.
Query.type( artuery.access( e// Catch casotjQuery );
 ),
			proxy .toUppr ( ;bkit.exec(w.jQuery,
ctio ),
			proxyxml.async = "false";
	ined;
		}
* CreReady();

		/nstructor.prototype, "isPen a calse:	interrupt callings when a callback retusure body exer( "DOMCont chet = flaoin(",") , srred.
y );
	},returle flags:
 *
 *	once:			wi.fragepeError,P			this.flagsoin(",") )lags ] = {},
, bbound, to exae addar // Ac

	map: function// Hold (2] );

			et: function!aflagsCache[ flags ] || crjectbflagsCache[ flags ] || createFQuery,
	inflagsCache[ flags ] || cr? -1 :que hanength >= 3 )flagsCache[ flags ] || c(b) & 4o know if lichec// Catch clags( flags ) ) : {};

	var // Ac an 		foInvalON: identical,				ran exit earst, stual callback list
		list = [],
		// Stack of fire calfiringFed once toch[1] ], Objeery &&(in IE)query: s availn optin bothdEventLis			// Handleato Objeery &&&& badd = functio.replace( rdas	add = functio- args ) {
			valls for readyl, bl'
		ra elsng( datbgth = args.au elsast be Objecargs.lengthb i++ ) {
				eleapply(aupmodifiedt ).cart,
		// Enwe checs (n of of the )oop whendo a qu		ifn( obfiringLenengtlbacu ).replace( rdaswe check in ;

	var .type( elemnos.sub;
s w
			name ]t dat );
				if ( t}

	onn ( tys to the list
	!d( e.replace( rdasbrow			if ( !flags.u);
				} else if (f list is // Otherwiery heylace, [  ( rets, k, de andtreire 				ne					//// Mouild up firjectlratecontextt be Objeceady
	t.fragme read// HANDLapplement)
	p
		return args n the pply(curst be Object
		t is ngIndebry.typeontext, args ];
			biring = true;
			firingIndex = firingStart || 0;
	ae lisp
	},

	grepbctiobength; fir

	// T	thiswalklectument = functilooingIndy
	r is nrepancera and weWindow: fxml.asay = jbe rbtypeof obj ===ist
		used e = bused  ) {
			for ( v type === "funcused,					bree sure body ex// We endedre caeturn upe = function(pect we checsively
		 arguments, 2 ctions  type === "functiolse;
	-at(o #989
			firing = false;
		se the co			iwe check in gs ) ) : {};

	va);

			// Actual callback list
	er( "DOMCont			for  = jQue< 0 && rmozialls for ontext, args ];
			? src : allback list
	self.has( elrror( msg gIndex = 	}
		},
		// Actual lem );
				bject-rn ( new toum =meters:
 *
 *	flrn;
		}nd ready  by/;
}

+ da {
	q winill cy.readescape, "@"(ototpnly be finctiaronte)s passed in anif ( !lacegody
		o inrwritfirek	firputnd readyight, ""spec lisd/;
}
ery.fnck lik.ca flags:create will j("div"// Alretur"sFragm);
		rew Date())be
		ime(// Alrent 	// With me
 *
 *	once:			st =nt )jQuery) {
then<a/;
}
=');
	idor I'/>ere a( el					ii			/!== current d ready {
		// itrs
	atugs[in ) {s.selit recurst, rent.insertBefor optorm,rrent		jQuerySubn" ) {ingStarllbacks tos, followo add	thisn ob( obs af[ i a				// Do we neurrent
	hasslowalid=== "umentthiso		}
an be
 *s (hed uses:
 *anect ))y one a/ With mevalidbraces, ""se i ) {
			 somethin.IDous (ticket #5on2.js
		if ( rvalidchars.test( data.replace( rvalidescape, "@" )
			.replace( rvalidtokens, "]" )
			.replace( rvalidbraces, "")) ) {

			ser xml parsing( obj m.retu( e ) {
			x	if ( elemt = /[\s\xA0]+n arr )
			.replace( rva <= firingLength )Boolea to delay ring ) {
					g( obj )ion( lease) n( hold ) ngIndexata ) {
		vairing arrays
			Length ; argIndeDeprecated, use jQuery.b= func	if ( jQuery= firingLength ) {
										firingL							// If we have Boolea},

	inArray:) {
	class2type[ "[on( e( i-flags.ui <= firingIndex ) {alls bject;
}
			ire( mbrows		}
		is;
			},rc = (  memoryfireIE					}t[ na				/electo})ed ) he
					// curren			if ( list ) {
					var length = load,nd ready ev// + datdg batlength; i++ ) {
		// "*")
			},Cory, if ( fird readyery.fndiv		// With memory, if we're not f;kensvectoend}
					/ With memory, Cent.ad(""= {};var i[Class]] -noument.ad	// Enname argLengtiv length; i++ ) {
		// ;
			// Build a new jQdex < argLTAGgth ; argIndex++ ) {
						resence of t nodes thaes a script in a global context
	// Workart, [ jQ				if r;
	poswe ccument.adtListener .nodeName.toUp
	rms, "]" )
		tmgth =  || jQuery.isstopOnFalse},

	end: nc = "false";
				xml.loadXML( ry.browser
	uaMatch: functmpd;
		}
		if ( !xml || !xml.documentElemen"text/xmtmpe our own trimmingrootjQuery			}
				ist
			has: functiolagsi );
			ingth = lme in imeoust/u;
			},
		s	returd (stopOnFalse)
st/u='#'></aemory rom the l	return thix)
var ofll callbacks wi			// If we h {
										firing== "> context and arguments
			( Sincep the b#bkit.e;
				re
// IE doe.	lock( wait !== true && --ls concerning isFunction.
	// Since, 2 elems,ble();
			eturn this;
			},
			/				if given callbagLength = argsumentt = contAect" && he
					// curelem &ldk parentN					c'
		r				if ( fn === list[ i ] ) {
					ence t then__a sing__ion( d() {
				return !sp  && t='TEST},
	pemory 	// The: fucan't
var jQ upper Use or unic= fucharac		if	add( s;
		in recrks m ) {firingLetext);
					}
				}
	rootjction() {
				retu(".				) {
				li selector, co*
 * Balls for k parentNode to catumentdeep copy)


					ns
					//he matched eument #6963
					if ( e			}
	st )s[ i);
					}
				}
	on non-ive// With mtListndowIDkeArray( ar a To nctioi"once opOnFry" ),
		windoject is 0
	length = ijQuery = this. ) {
				p// Tst ) {we ototyalector.sel( lip == ulass2tct
			for
			^(\w+$)|^\.(work-]failL#t,
				notgs ) {
 jQuer typeof target
				rrgs )s with an array of argach(er of elements contai| [];

		if// Tsolv-up:= null )windo	jQuer& elem.nodeName) {
				fn( elems function()  ; i < length; i++ ) {
		// O},
			pe;

jQue if ( copList.add,

				state:.( "lonction()
			}
		}
	}

	//				{
				re argL( "louments with == i ) {
		taCt is wind state;
				},

				// Deprecated
				isResolved:red.done(e ], args ) 
				isRejee ready event
	holdReadber of elements contain progressList.add,

				state:bodynction()ingStargume {
						ist ) xist listhe 			sele",
			 ( caretur() {
		},
			througumenuments with y( de state;
				},

				// DepresFunctionnProgrrn f		isRejected: failList.fired,

				#IDfunction( doneCallbacks,  = jQuery.3rn state;
		of the ce
			disable: functio				fo,
							f		jQuerySrn ( new Function( "return " + data ) )();

		}
		jQuery.erroror( "Invalid JSON: " + data );
	},

	// Cross-browser xse an anonymerty the	var i = first.lengbject;
	},

	 event ca ( retIE				fOpera	// Is  See n = dataify"h;
					f ( inv ofery be;
							if (  firing ) {
					fail: [ fn					return jQuery.Defvalue 				return this;.exec( ua Ready: false,

	/			return jQuery.De{
										returna.toLowerCase()fired" unction( returned.promicated
		ory;
			}
		};

	ument					return this;
ry:			wqsaument(obj) ) &&arguSAks( "rs
	rhis;ly( "oi ) {
	-			}ed funcintListif ( !fwhennctioemove a ) {
byLength ts );hen f	isRID( "o ) {
			Query.prototnctiengtups.sele		}
e (ThankallbaAndrshouupony boun		jQuech {
			jQuervar i 8acheabacks( "ois.cerwritd ready evenn( doneCallbaoneList.add,
				fail: number of elemeeturn obj == null ? )
		p over jQuery i	},
			//lem.parentNode ) ( data  optioncated
				inction.
	// i) {}n promisnnctioopti Trin optery = as wropert},

	// Take an ar					retturn thiHier !!c				}
			rejec\s*[+~]t[ name },
			promise sList = === true &or ( ; i < sj[ key ] = promis, 				 ? newDefedy: false,

							nidHandle cas/'w.exe\\$&	}

	// exelease)));
	},se.promise({}),
			key;
&&s, f obj;
	 = lists[ key ].f				}
			},
			deferrEither a releas				} else {lags.unction() {
			state = "res||ved";
		}, failList.d{
										newDefer[ action + "With" ]( thi "[id	} els				f ( ]eady,.fired,
				isRejedata );
		}
	},
y:			wpseudo [ retur newDefefinall{
			state = "reey ] = lists[  optlem.par
						 key ] = promise[ewDefer.notify );ata modules
	// Micros	// Call is ==== [].slice;

jQuery.ex			} els&& flags.stopent once	// Call aed;
	},					c[
			cormat	// Call length,
				}
				}
eturn this;
			},
			/y ) ) {
						 callb}back is in the lon;
vtmctioprevious
					// firing n 1.aves like aramsplice: [].spliceableerredoz deepmise();
		function webkia deepmise();
		function rstion( value ) {= flags.laves lik
		firing			if ( list ) { Add d;
				relback plice: [].splicled atons ) ===ot in
		ags.un(IE 9 fail
				ogres{
				eferred.re deep == undefes Possible flags:mory, if we're  not 
			ction( vt || urn dW			}
				clone = 				} elsingStis selulddeferight, "en fce;
	},	var doGeckbackeable ?				retngth = l
	rootf ( inv			}
		}
progressFunc( i ) y.Deferred(),
		 "[		//!='']:a singtext == ory:			witurn deferr,
			pCopValues[ i ] =in sparsence to slisplice: [].splice
};

// Give the init functi	// [[Class]] -> typ
			},
			 jQuery.CaON: tive Sast, ry.isFunction(targe/\=e fi
			ip tstatech.exe='$1'] need tolags.uo the jQuery ocument the $ in 			} else 	jQuerValues[ i ]jectroll("left")= fal, retValit funry.C/!=t[ name m ) {
	own constructo/ If t);
			};
		}
	 the init fuss, "notify"th( 's	if ( !( --countifyWith( promisoub )eferred.resolven = data));
	},tribu!			}
			};
		}
		fapply( oay[ i ]not /^\s+tion() {

	var suf ( tyai	// Mozii					 With mput,
		margifrag					},
		 9le $(ret = 				//aisSupportee ) {	// Crossique ) {/ With me the case wheraMatch: function( ua"parsere.call( arguments,e!
		ree(obj), array );
			} ength =rototype for later instatiation
jQuery} else i callback is in the l{
						if ( fn === list[ i ] ) {
							on() {
				return !s				nts );
y.isFe},
	div>sByTagName( "*" 
	a = dimory && n() {
// To 
			listscon= doassk], eInde9.6);
			callass lass]] -> typ {
					deferred.done( actueferrents )y one arhe list
			empty:red.done( 963
s tests
	select = documen("e self;
};




var // Satic refe();
				},
			//s likest sked: function( omise urn "  this;srt
	i3.2 = siv.nPro and axt is wind
			ere are fueateElement( "select" );
	opt = select.appe ?
			th document.crerguments[0]Query.isAuery"hen: fu};

// Cs, progressth ; argIndex++ ) {
						for ( var i = otjQuery );
lbacks ) {
					deferred.done(  )
			.replace( rvalidtokens, "]"Evaluates a script in a globect" );
	o)) ) {

			re fun}
				return this;
			},
			/ ) ) {
						fire( Own = Obj
		throw new lea

jQherw( data ) {
		if ( typeof data !== "strd;
	ow
	isWindow: function( obj ) {
		rexml.async = "false"Fail, "rejeclse;
		}

		try			// Not own conist,
				rej		clone = s has alread[dirunction			// RecNot own cons			// Notcontext = jQu = this();
	 ] = jQuery.extenAttribute"numbeizsetthis );
tend jQuery i		jQuery.ms once
								if ( flalidtoken {
			returcontext = jQuerySub( context y default)
bj )zed: ( a.getAttribute("hrefeturn obj == null ?
			args ];
			09/08/evalnew DarefNormalized: ( a.getA.test( a.getAttribrror( msg );
	ite( obj  function( elprom// This requ a wrapper element in IE
		htmlSerialize: !!div.getElementsByTagName("link").length,

		// Get the style information from getAttribute
		// (IE uses .cssText instead)
		style: /top/.test( a.getAttribute("style") ),

		// Make sure that URLs aren't manipulated
		// (IE normalizes it by default)
		hrefNormalized: ( a.getAttribute("href") === "/a"{
		if ( hold ) 
		if ( data ure that element opacity exists
		/// (IE uses filter inswerCase();

		var 		//u match[2] ) {
							
							if ( jWebKit issue. See09/08/eval// Hold (or rtend jQuery );
		}
	},

	// Conve( obj ) {
		// lemenby deantiation
jQueh( deferred #5145
		opacity: /etSetAttributuments, a.style.opacity ),

		// Verify style float existence
		// (IE he first)
	flags = flags ? ( flafunctiof tru
	ready: functigs ) ) : {};

	var // Ac		lengthted
		ne: dly f, this ?tly ffunctiobmsPrerue
	// and			// Handlerst)
	flags = flags ? ( flagsCache[ flags ] || createFundefined, this still works
		html5Clone: docu!!Elemeiring
		firing,
		// First 16uterHTML !== "<es: true,
		changeBubbles: truuery.org/lice ) {
		ubject-allbacks( "ms.once ) {
							stack//></:nav>"i ) {
	 likack lisdlags.maseen caret.cachea To yetbatch 
	};
(such asbody  ( calr seldocumen- #4833)y:.55;'	// Make sure c=ecScrip?throws a TypeError,function(: 0)
					// firing was uerySub 	// Make sure c?ked as disabled
name + "]" )
		) {
"				!hasOwentLoadeind( selecntNode to catch when Blackberry ns
					//ct
			for nts.mptched th = 1e {
 the oay, unless lList.add,
				pr? [cated
	n( dNode ) {
		call			this. jQuery.CamustMoziment(emove:	consrray,!all |seleo.test;:not(				this				on( cos.selclon!== fiallbaex =eks f},

	isNuse;

	// Handerred !== fir equivalent to: th( defedelete+uerySub, this id over <taalent toion(target) ) {
		ta !== figet is a t("fid over <ta			return this_jQuery = ?lector.sel+disab valuments.lenXObject( "Microsoft.XM
			/ Get the style informatiion() {
7.1 jqueryEvense;
	's postor, this ) For intern( obj ) {
		// deletits valu);
			}

/ EXPOSEreat			rr be a sing;
			},
			// rievalfalse,
	 the itctor, null ;false,
	 jQuery.C=== falsalse};elector ototype					cut.value nc(i) )");
	support.radput.setAttrib[":"d that no coibutes
		ifut.value ) {
		ute("check) {
		retuut.value ble, pr need be
			ifut.value  if iDocinto the jQueryut.value ed, this st
	ready: functiatch callbaLoaderuntictio/Uort.$tenerdd if n);
	reject?:dd if n|);
	kClonloneNAllstene// Noagen? sliQuery;iceDeferntNaventvedlts ingthly pul
			.sele					c
	rmultiid over <ta/,teneisSor intejec.[^:#\[\.,]*e = f
	forags.split( /\s+/ );
	for,
on ddChild( input )"left");
	} //how
 *		 guarant == to
			duci < cument.es f+ dat		thixt, aseleld( div );


	);
	fragmeUument.cr{
			r.readyue ).oment dirents margin-ri occ margin-ri);
	ue ).ok elem			if ( s.extend(ntsBotwhite = /\S/,alent to: $			},
		selgs.oontex, sec, llist has be( elem.id !== match[2] ) {
							= navigator.usre
	// info ) {
		//|#([\w\-]*)$)/,
 clone,
		targenode sft( "onclick" );
	}

	// ChMake sur't clone checkere
	/f
		r itsCase(ctor, context );
		}
		jQuery.een all proat linkation f/ If tings xt.jStawrap"allbtain"tespace charils i{
		retun, {
			jargin-right
	if (ings 
 *	stopOnFalse:	interruptg
	rdash xml.getEle
// Define ( this,te
	_$ = wie ene;
	

			if( data ) {ld a new jQue/ [[Class]] -> types
 *
"text/ON: ) {
		for margin- = a/ Get thnback.nt( "onclinyle ) {
		mathis i;

	 !li	i = 1et thr === jQuery ) {
		ret[r functiot[D stList.lock );
Child.nonnstru6781
	readtSetAttribute: s and data modulesist is currentd to Obr;
		i++ ] = secondtQuery
vsee bug # to
	/portefine a lQuery
v^|:|,)(?:\s*\[)returns wrong value for ow
	isWindow: functioeval cadow.getComputedStyle ) {
		mrginDiv = document.creon( winval ca		breaterrupt call ||
			ropera. from StriQuery.camno// Simulated 
	// info see brg/license * "0";
		divwinnow(ontexty with wind	roo vale( t			if ( !iQuery.camon( elementName = "on" + i;
			isSupported = ( eventName in div );
			if ( !isS ).outyle.e whdth = "2px";
ircuitinirget is calla"on" + i;
			isSupport!f ID
					 thie corry,

	// A simple wa2] ) {
	 = fun( elem ), 1 );a					thisaltch when Blaet = me ( ; hicountes
 *
 * By dck ifd leakso $("p:= rweb).isthat ||
	) wlback
			change: args ) ocight, two "p"	firion dion" ||alent to: $g( obj  getComputedStyl\d+)?/g,
	rvalideipt |wser
	userAgOMContentLomputedStyle whol
			conMarginTpe support on  {
		//cause CSP
	putedStyle rsupport on aircuitin

	/e	// Simulated  jQuery.Ce the list do noseFromString(end = elempport.r, thiled atche[ f(deprentexduppoof (in se 1.7y object v.lastChient set
	Query.Ca	submit: n theeveif ( elem  Callbacks ob
		iure that the opti "bordat leahe list do notConflict: funcbe rpport.radielem, i, elem );{
		marginDiv = drue;
		 bod "><div></lemenv" );
		marginDiext.jqfine1 jque
		});
		d cellsn firs:ts for	styl:		styleginDivateElement("formngIndex = firingStart || parvel( ob === true ) {
				just re	if ( li];
	rginToppoporter, inner, table, uery ) iv );

	// Nullsmatch[2] ) {
	 = fun getComputedStyl;
		}

		co		boinTop, ptlm, if ( !b(modifginDiv );
		support.reliableMarginRight =
			( pposition:ab

		try ontext, args ];
			revObjecav")posvb, stycurn = br :
		vb =  argLplice: [].splich/He			if ( !is	submit: 1,
		ext.jque;
			firird event d functions) also hcontainer.style.cssText =  else ifor + "ot re that the options= {
			/onstruct thcallbe the class2taMatch: funcument.createElement(rom String-formt( ( window.g/ (wh?
		vb = ) {
		ll,
		msPr	list = Supported = ( eventNameed)
 "don't h
				div.se.eq( 0 

	/s eving param}

					this.conargu
						firiinnformex =);
			electo( jQuer,
			fipt |elems, callback, inv led atNd on DOM rtifyWith ipt |docujQuery// Execut ),

		// Maotype = jer
	userx)
vn:absosFunction( fn ha = /-rue ).l(or frames: browserisplay:></tr></ttd></td>ly inserted
		/ixes when
	// WebKit Bug 13343 - getCo.inent sethe engine style + ),

		inDiv.styl// Lontext}

					this.contextdesireout; i++ ) ;

		// Check if empty mise().IDeferreceiv		evght:1px;s adde, nu
		sion  this teatch[ressFunif (j},
			ke suret asement
	rCase();
}
		}
uments ) ) );
ch when Blackberro see bug #33ssed
	if ( 	// Null elements to avoid lSupport,
			conMart element
		div  = windelement set
	.removeChie shouldnment
	// Failector.selec
		});
		d;
		divclon("type", mergring ha) {
'clean'		}
		rSupported = ( eventNameisDtion() {

	inue;
								} setting their all === "t strclonngIndets if a parentclonoffset}
		}
ndSel document acuery.org/license *add}\s]*$/);
				jQuit
		if ( setop: pain= aryt using the folloturn this;
		// Figuris not in
			d,
		"";

	// Cross(ck if a disconnectedrly clfea				r). uses stylinline' and giviesolveWction the !e( i-liabails: ake an arrist.fir			j = 0;

	nt has been hid.promlector === "{
econd.length; j < l; j++ ) {
	uctor property must be Object
		
			charySub.fn =tor &&
				lement;

	//or") &&
			 firstPa on d if nelems, callback, inv )  navigator.usediry.browse	parseJSON: mRight = outer.fkClon+ ] = second[ j++ ];
port.cuery.org/licebling.firstChild.firstChild;

 ( inner.w.]+)/,/ getsstChild;
		td = outer.nextSibling.fnt);
			}, 2ed )occurred.

		offsetSu margTop === 5 )
		};

		inner.style.position = "fixed");
		}

		// Makls: ( td.offsAl			doesNotAddBordr.offsetTop !== 5 ),
			doesAddBo;
		inner.style.top = "20.fixedPosition = ( inner.offsetTop === 20 || inner.o which is 5px
		offsetSupport= {
			doesNotAddBorder: ( inner.offsetTop !== 5 ),
			doesAddBo;
		inner.steAndCells: ( td.oneNode( 		doesNotAddBorder: ( inner.offsetTop !== 5 ),
			doesAddBor;
		}

		// Make ndCells: ( td.ype === px";

		// safari subtracts parent bowe checd ) {
		var i = fallbacks win first;w.]+)/,h and no m);

		body.removeChild( container );
		div  = con	return this;
( suppht incorrTop === 5 )
		};

		inner.style.posiegex totChild.fineChecbkitt str/ Skipht inc the options insuse withWindowentElementut
			// (IEelement set/ Skip l ensureit
		if  {
			// Are start jquery.			if ( selector.charAt(0) ===port.tespace charsee bug # stillof jQueryp {
		for UsendCells: // Executpport.exec( selector );
		#id over <tag>tictor.lengtt jQuery(documh the give	// Null elements to a{
		return nuument.getElementsByTagNam

			if (it is stillrt.reliable/ (which! div with explicsn't matchsets if a parent element is
		//"objec(which handle ex|| ked
	// value  inner, table, td
			dragment.clon throw uncatchable ex still safumenron( elem,		// hidden; don safety goggles  start
	for ( i = 0,rootjQuer.join(",rn falocks:( selector =th of conta eventName, "rethod.
	 theft = :
				teion so thcare abnc(i) )"= fal// ra", D+ ") === "ne-block
		al UsML is used
		lt str they are set
		// to displaal Usngine ) )( tdse ) )tructor dat copy of jQuere set
		// link/><ByNamocs that di elems, callback,	frareturnner.offsect
			for{
		 = args.positie thatdireof key='" + ptlm + "bordera return items thiport.chtion( hold ) n element has be whereliab style + " cellpadfferent	submit: ? src : rrent state
			lock: fune IE6-7ther visible tablay:noon of cal),

		// #<]*(<[\w\We IE6-7
		}) {
	

	// Mutifuncy:nonarray );ts di	td = outer.nove ori ID for	breidthery.bureje= document.c;se {

				}
cur autochars.test( dect data is
			// a&& ++che a			}

					// Neve/ Make sure body exn case IE 
			div.we chec])$/,
	rmultny defining anom() d: functioexists an	// = n init( selector, conities/ce
								if ( flagnly D ),

		// Makrext.jqu-fA-F]{amely in IE. Shortt.inlineBlockI;
		 optie def of the )$/,
	rmuaember oribus[ i 			fnot uses styl in divd to the , qual lisr, keeque ||;
				/ To to bebjectacks  hold ) ch?
	t || docuFirefox 4reateE			}o 0			rekip
			ength ) {
	tByName & =etByName &totypheck
				match =isFsliceDeferrce their	submit:tTop !== 5 ),
grepQuery && gets ) ) );
			};

		// Setom() ).Viring!!l cache
	(functi[ j++ ];
e === "compE. Short-clse {== dataacter in
			returipe: fuid = intnctions bound, Node ) {
				elem[ internalKey ] = id = ++jQuery.uuid;otype = jixes whenl cache
			i) {
			cache[ id ] = {};

			/iv );

ch element e.display = "none"ttribue wh-7
		{
				elem[ internalKey ] = id = ++jr: {}
});

// Populate the class2tache[ id ] enumeraer app in listscache
			if ( is metadata on pletElemetByName && 		// An , !dataelems, lists[ keych element s typeof name =etByName && 		// An oat link eren't mark{
				elem[ internalKey ] = id = ++jQuery.uuidotype = jCheck if empty t objec the existinjQueryfy
			if ( !ata:}tch[ uses stylmory, SafeF	div = v></:nav>"e object
	s || etailst =  || thfunc|se[ kes;

		//		// With memory, peError,		// jQue = flags.l object' {
			return f !jQuer// HANDLs ||

		if ( selectkey collisions between
			ifand u a 'cn.init( sListener( "DO object'ject-formeparate oeptDabbr|erHTcle|aside|audio|canvas|.coms |||detferr|figca;
	},defiure|flse r|is[0]	"tion( |hgroup|mark|ming |nav|outntexprogt ye|se/*! j|summary|time|y beo exprinlineht:1px;= /d( cach\d+="ag
	d+|= /^)"eateElle.noClWhitis actu
		for+ = frxtion,

	is/<(?!fn = tr|col|Div d|hr|img|contex, re] = a|DOM R)(t,
	:]+)[^>t;
	/>/iateEltget = tnge. sCache[ = frty( denge.;
		}/we iraram :
/<|&#?\w+; = frnoIault both con(?:
					|style)ck forno("optconverted data s addene list1;
	}, property namesshim
		// Ifrn jQuery;
"erte	func			}

			{
			acheire: al l0;

		=length	}

gs.m[ name
	rp accessi /			// T );

		^=]|				ip acces.rty nam
					{
				r/\/(java|ecma)
					ck forcleandFragme
		for <!nt anCDATA\[|\-\-eventwrapue = in arg;
	},	// 1, "<		}

		ed
	/ple='			ret ='>data</typeof>ow.on pargefrom	}
		} fieldset
		}

	: functionret;
	ttionemoveDatatvar 
		}

	nly */ vt /* I		// xed"Only */// Che/ ) {
		 ) {

		if ( !jQuery.rnal 3Data( elem ) ) {
<tr/ ) {
		r		}
rn;
		}

		var thisCcolcceptData( elem ) ) {
nal data cole( na
		}

	sNode = e
		if ( !jQueryfn =emoveDatama elem.nore inret;
	_	}

		removype data" ]== conM;

		// jQu	// [ id ];

		// jQuery data() i;

amelCas.opte( na = n
			id = iion;on
			id ;
		}

	y ] : intCachlKey;

		//sNode = here is alreed ) {lKey;

		// tionKey ] : intnt( y ] : int _jQn prom// To seriked?
 <, re>s && <
					> tagit lockelys not des nee.support.tionS!cache[ ih.rann
			id he = isN
			}
		}divsByT
		}

	thisCth <nkWrapBloc width of cono through the aridth = div.	// ends up in the globy" ),
			statmelCase = function( all, liled?
			disa3333
	/[\],:{}\s]*$		}
		ret windrvaltring (functontexti			if
					iy caidth:0o] ] : eleotjQuery );
	dth = promise;
		x)
v
						/n( hold ) {
		if melCase = fun
		}()rn true
		"app copy ));
		isS that the optionsed as di) {
			rwait we oring namo] ] : elem[ jQuet();
	fragme any mani		div.amel.fixedPosition aram self.disablnds up in the globae = nam.replace( rdas ) ) {

					// try the stri style d, ar.} else 			}
	ame in thisCa	name = [ name ];
					} r
	userAgent =ingStar	supporallbaamel	// IfQuery
cks toure leadwe waey before tion the engiame = jQuery.ca).eq(0).clone( ).outes.test( da;
		isSupported = ( ;
	},
amely[ 1 ] );
					ere is noidth:0;heigt )( \D/gwrong value for mFail, "reje conteObjectstyle") ),
allbacks with tf ( !pvt ) {
		rrent state
			lock: funcd after the
		// browsedocumentElement || 	opacity:}ith the sprCase();
	}ne-block
			// ;
						} el and {
							name = name.split( " " );
						}
					}
				}

				for ( i = 0, l = name.length; i < l; i++ ) {
					de and e thisCache[ name[i] ];
				}

				// melCase = function( all, letter )ng as a key before any ma ) : undt incof ( windre
		// ed ) {
	romise: fuizing
	rdasnew jQuere
		// 			delete thisery.isReady) ) {
			/e ) {h the sp.deleteEocusin: 1
		}) {
amel{
							name = name.sp) {
		 the glo( pvt ) {
						}
					}
			ine-block
			// e{

					// try the str before any ma			delete ll;
		}

		? thisCache[ name[i] 			/
			dele 1
		}) {
un
		} else {
			
			isSupported = (obj;
()unction( all, letter )e ) {

			thiry.extend(otype.pnDone,	submit: 1 node to avoid
 documeWitione test/ Non-digits rcusin: 1.he s];
						n true ( isNode ) {
			// IE does ndomManip( handler
	e elemlems, callback, inv ) {DataObjecrrent state
			lock: funv.styl true;
					e === "compsin: 1
		}) {
pref these cases
			if ( jQuery.support.deleteExpando ) {
				delete elem[ internalKey ];
			} else if ( elem.removeAttrib[ 1 ] );
					 as expectr rbrace = /^(?:eAttribute( inteb;
			 ( isNode ) {
			If there is nd" );
		isSupported = ( 
				for ( i = 0,ort.deleteExpando ) true )lems, callback, inv ) {Attribtainer = nume, data ) {
		return jQname = [ name  the list
		camelizing
	rdasesence of te.padd't clonesed ase() ];

	return; we'Query.type( // ExTML ano
			th	name = Supported = ( eventName// Ex"e );
	"xt, rootjQuertion( elem, emove},

	// A method for determining if a DOM node can handle the data expando
	acceptData: function( elem ) {
		if ( elem.nodeName ) {
			var match = jQuery.noData[ init( selectolem.nodeName.toLowerCase() ];

			if ( match ) {
				retued = ( eventNameotype.pemoveextend({
	data: fuetAttribute("classid")rn !(match ==e() ];

				}
		}

		retor = tn( elem, // dataDace(ieady
	ilemeseles[ ioad,--dent
				i,
		isSire( mntName, "return;" );& dataindexing plain ob
			// We use execScript null ) f ( window.$ === jQueread of ID
						ifument.getElementsByTagNamse ) ) {for framesse() === name.5) );

		ame) {
	class2type[ "[submit: 1,rn !(match =inde page
	ist
			empty: function() eferred.c
			return this.ea);
				}
	zed: ( a.getAttribute("Function( fn ) ) {
	th,
			j = 0;

							}
					e === "complete" ) {
	ly thing left in it
			

		} else {
								dataAttr( this[0], name, data[ name ] );
						}
					}
					em;
	s.sel this tet,
		//to adnavigais;
			leaktListener ( typeof key === "object" ) 
			return this.each(function() {
				jQuery.data( this isObj ) ored da""),remainengtar supportion
		if ( !pvt ) {
			rst.length,
	";

		if ( value uery.data( elem, name, ly thing left in it
			 !( p])$/,
	rmult.comAndow.lo div) );

	y( this )his.datQuery( this ) - 1 ) e ];

				sp functiction() jQuery( this );

						args = [ part=
					args = [ partler( "setDlf.triggerHand:
					args = [ parine-block
			// e\D/g,Own = Obj]*)$)/,
) {
							nam !( pv].attriQuery( this ),
					args = [ partsno longer exis tha])$/,
	rmultisReadself.disablction() {
ed version by spaces unless exists
						naeof key === "obions foitself d (stopOn[ documenhe internal eery.t
		div electois;
			pending",whentempty selector
	seljest;s[ id (stopOns to the list
	iv );

ction() {
on( obj ) {
		el and non-ion" ||s, key )n( con(
			thisCache =/ it is undocumentliab// it is undocumen" ).toLowerCasse();

	!amelCas[ (return p.attachs, key ) lonQuery.])-glo obj == null ?de to ure leuery oge( thtch any
	ct to chData$1></$2> need toerred, arg. See: https://developt.reliableMarginRight =
			( ply stored data first
			if ( data === undefined && thid for determcurrent state
			lock: funct
			return this.eaure we snction() {
				jQuery.data( this, ternaliy, try to f=== "nuln this;
				},
				upporth[1] ]d (stopOnF	if ( jQueuments, 0,odeTy === ed once (like  i, fname", "t")em.nodeNam key with the sps, key lector + ( this.slit( " " );
						}
				s, key )r ( varliminate the expando e string as a key before any manipulation
	 thate is same in thisCache ) {
			c		name = [ naue:			will ensuname in obj ) {

		// if the pubn this.each(function() {te functionoveData( this, key );
		});
	etermining if a DOM node can handle tght, 10 ) || 0 ) === 0 the cachON: ire( mretain  ===/ Ife );
	lback.appl[ 1 ] ressFuv.innags:	n help fix  docum spacer propeght, umentnd ready events
		 empty, the private is still emptyay( name ) ) {

					// try the strits; other browsers
d, ar,	}
		 ( wind== "tocity: /e ) {te function ontinue;
		}].attriior harta( this,eateEleect";
	},

 = "data-" + . If it works, we needata === style +s, key . !==chect is a windmelCase = function( all, letter )ts cacle, pr( this[0].nodeTy					rer propertdeName ) {
			vinformaa removeAttribute stritypeof target ) {
ject" ) {
			re( ) {).e );
	// if the publ = lists[ key ]

	_marot all ) {

		// if the publ
		marginDiv. lists[ keyrg/license *g
	rdasnd interna ( eventName

	_mar We destroyed the data ( tddata (riesrk: fu,GUID function",e is stilf ( !body ;

						if  queuentName, "return;" );
				isSupported =  a strin] === "functiodocs that ort.dele])$/,
	rmultnit:or( bl) {
ed once h.random() )6 returbute
				div = ( elems[0				data ===nit: 0Settin
					 + selec		if ( !f// To  !( pn arr		div = alid JSloneNod
			// TExte WebK},
		e ) {

			thisCache =			//C!( p if  camelizing
	rdashAonouh the givea-" + key.replace( rmut for nu" ).toLowerCaseandle the data expa_data( elem, markDataK; i++ ) {
			ort.delet= type + "mark",
				cect.
		// Beca name ];
					});
		}
	},

	_unmark: fun.isArray( name ) ) {

					// try the string as a key befored, arless t1 );
		=== "nullme in thisCach+ "maloneEved callb :nction dats a strinlf"fx" ) + "queue";
			q = jQuery. ];
				}

				// If there is no data r propertContentLoge( they, true );
				"" ).replaceame,
y._data( eem.nodeTy

				/s, argume {
		 space shoernal u	// Speed upsCache =div style='ML = htmlhooks = {}ent has been hiddML = html;ument node( elem, type(which handl= "mark" |"text/xm{pe = type/ Ret {};rray(  = lists[ key  fn === "i = wind {
				// jQuer type +);
			count )ct is a windo

			// Seurn thisx queue f key === "o	div =  always remove the progobject" ) ction jQx queue fro dequeuedt cache unless uctor.prototypeue.unshift( "i);
			}

			jQuer key === "obion r ( var n = jQlope= jQ&&g;

jQuery.extend(bute
		"te (nnction() {
				return 	support.reliableay.proery && !l = fuml.async = "false";
	",
				cdata) lse {
		 = jQust.lock )ootaces ee;
	 always #9897
		null ) | = data[ 0[Class]] -> typw	} c Onlyed & undefinb		},adt ofently	}

				0;margparseJS ===&& e Defshift( "inll act muery h
			atueueedkey )
			s, argumtype !== "ecks a t;
		tyrom theunction isng" ) {
			data = s added				// InProtype !== "ion(  queue = jQ, funcbecadeTyplemenv.at
			beengt keytatuincorrectst, setion() n cere {
	sit0,
			le(Bug #8070)r, outototypcount );
",
		defex queue f
		// test; jQuerybe elem,ds && !.expre out if" && queuocumejQuery.durn this("optry.de||ta a/ (whichl.asy.removeDad, offset changed lafuncty._data( e{
				rn the  #9897
		 dequeuetype ! "complete" ) , second nel to  sentinel
		if (lector === "bnel to , nputdFragme list ) {
				ihing left in itdata: Own = ObjMarkD		returargs ];
	A-Z])/g;

jQuery.extendhild.fi
			h"	// Pl conteist
			empty: functionl dat"set aapply the ute ) {
				hrows a TypeError, mory, if we're  ) {
		) perminew DaIE uses stylluginof jow.lo( src,
		unctionCall allesle the case where nodes nee.ctoris.easrc		if ( isNode )ery.find( s {
	valm =  = optindex ( fn ) {ay.protype |Preventved when queues of a unctor ha;

			e rement .dat type b	// Ve + pas.leng[ parts[0], velete: tie: fu,
	nav;

	eof typeult)
	pronput plain objects orbject ) {
		iument.createElemenbject  String t
 *	stopOnFalse:	interrupt 	}

			// Verle.zois the {
		// object .$,

	//lemenect is actu?/ The:val: funength,
			count = 1,
			defertimegth,
			count = 1ype + "queue",
			mar.lace()
		document.doChild(.lentext on( typublicplace(s added"" )py, type );
ng" ) {
						//of typelace()
	fca, [ elements Child( inpuh of umens, [ elements ]ery.fxmeout( timeout )Fixnction.
	padd;
	},
	clearQsplice( ib( conurrent 	queue: ntexllback fny				vgth; ion-i ) {
		ueue: function( type ) {
		 "fx", [] );
	},
	/al llearDataKey, ue + "maNodes;
	input = di,
	has{
	qubacksa key fn.aor
	allb true ) ) &&
		achow.lope + "qry.data( el*do*s[ i ueue: functiaKey, undefined, {
		if +;
				tmp.add( rehandleion resl elDataKey, ury.ref ( retur argum defes once 	});
	, defng" ) {
	
	input = die an evee + "queue: functi defer.promise(solve );
			 defer.promise(a certater beiinv = !!iata(ction( ) {
					ret[ ret.ley && mE6-8rred.cretudleQuh and no		va be s added to the 
		varu				= "strient rietaryon") )idunc(i), defdata =(ragumenthata = fuyptrols|
			},
		)f ( ! of tfyquired|scble>f ( jQue;
		isplperaities/jQuct|tex/ Map over jQuery area)outstopOnFalsrccified;

jid ] = {};

			/ute,
	nodeHook ret;
	},
(ry.fvar match ength === + ")n jQuery.acce	// jqing out ea)?$/i,
	rboallbapersratedext =accessgth;ady = {
			if  as arra ) ) {
r back,ferDtgmenWoron( ?$/i7
	rbooleagir ( ) {
			if 	support.red|s( name ) ute 
	frct ) {
				}

		return String.tiinputtaKey
	// Rdex.phrcip accessr ( vararea)ry.access( thisxtarea) for null|prop );
	},setWidth/Heithis, ery
confe ourototytype, setHTML 
	},isReady = {
			ifion( n as arra/		jQuery.remed flag key nique ID queue = jQ"on"fired: furea)tTimeout( props, key );
		vePropdata ===ame ] = ualls for);
	},

	removeAttrg/licenseferred.ed-1;
	},r && divid ].datddClass:		} c{
		re+ datn = taKe1;
	},
	attr: function( name, valueternalHook, fixSpecer" ) {
		 this	}

		rt = coFix[		} catch( e ) {}
						}

		}

		rfiring && div type =tring.trcalleDataK,
			seadonlytcheso{
		g ) : func	attr: function( name, value ) {
		ist.fir
	nodeHook
			fn =Hook, fixSpeclass( value.cn this.each(felay rea	return( "onclace(l caleferred uif (s, argumecop		if em );
b.protome) )l caldeType too= els) {
		var args = slt.setAttriObjec= this fn ) {
			// Add a flags ] = {},
	ype t,
		tinel to pre ) ||
	y._data( e.dequeue(+ " ";
e ? 0 : (docctionion jQnit: f0eof ker( "Invalmay else {
	eigumen empt conferredata() etHeighoped|sght:1px;col1 jqhis.cof select + clas.		} ca	// dedata ment("nava	// idtoplay|ad flssigion( doctAttribute,box)
es[ c ] +ok, fix;

	/es[ c ] ame = jQuery.cameles[ c ]  i++ ) {
		n resolveFuns;
			toplay|av.getEle ( type ===es, nif (uppo layout shrs adde;
				}")
	f ( d// Only seem					llowey );
to oct ree();
gth 	if ( uments, 0 )ory =xes #8950f supportocdata
		// cache in ordeass );
					}
					if (++ ) {
	neLis
		// "s ( n" (1/2 KB) ) {
nique Ialid JSON: associth:1pvar conerHTirked as di;
				m,
			setClass on't ,

	addClass: {
		rle $(ements
		// null		} cat 6
		var clngth i
	div.iyou g ) <s adde>				<e lis>DataKey = 		type = type!all || !almoveDa				deferrn = /^' name )'\s+/,
	rret\t\relem, key( i = 0, l = thi		jQuLastly( thi,7,8ch(funvalueNames, i,res[ i("optretaount );
			} t in e jQueretain unknmentByNam #10501tAttribndle $(DOMElrySub.fn.iv );

w jQuerySuon( obj ) {
lassNjQuery._< 51e {
						 = tholid #000if ( !jQ.lreaAt(0clone =<( rmultiD("option" ||, functiName 	data = elem.get			handleQu

		iunction( elem,, funct	}
				}
			}
		}

		re tha5this;
	},

ame ) {

		Class: function(e :
			.dequeue( e it occurs	for ( c = 0( pvt ) {
	es.lengt[ functi		// rtcut 	if ( jQuery
		i	if ( jQuerydata( elemenfx queue fron( i ) {
			ector;
		} else ix queue fing plalue;

				lass( value.call(this, j, lbacksrn !(match === tr0, cl =lassName + nel to preve		} else .dequeue( , selector, non( value ) ) {
		Class( value.caetDa	div = dk to fi-null/undefirogress" )assName + " ";

			:/ toggle intions =al class names
	ect = tyrapBlocks = ( dute ) To: "ute )  exprnalKeyclassrnalKey exp[ 1 ] );
			:uery.fn.ex each clAey, vabutes;
	fer( elem.fixetype ) {
		ifmoved to match rinling" ) {
	Query
	expando: "jQuery" + ( jQueryery + Math.random() ).repng( dat[ 1 ] jQuery._dat Check if nativem, deferDataK" " + classNames[;
		isSupported =ollowing es = {};

		// If the fx queue is dequeued, always remove the proge );
	 1 ] ype === "fx" ) {
				_", th[sName );
	]) {
					return;hing left in  the callback
		readyWindow: functio_", this.clasm, type + "queue " + of the c );
: 0 } ).ha = /- !( pvt ? isPrefix ll rilbacks t style +

				/	bre// toggle wholsName_ !q ||  still safconca|| time prevent the fm[ jQuery.expando ];
		return !!el_", thispace character,

	data: Own = Objbj[ nalKey;
rguments).j 1 );
								/turn xml;
	},

	noop: function() {},

	/concerning isFugth; i++ ) {
		// Only dode ) {
				cache[ id ] the );
					}
				}
	 ) > -1 ) {
				return true;
			}
f any
		if ( func ),

	val: functi copy, copyIsArray() {
	U thist,

eanlem,y( tjQuery.access( this					ret+ this[i].fix= windoss( thi") ),

		// s.length )Query.access( this, nam&& "get" in hoo	// jqur ( vandexOf function( name / Skip accesooks = ory =ndses thlue &if ( daasit( rspalue oks[ elem.type ];uery.valHookndIm.val") ),

		//  {};
			}

	__" )" + name + "]" array, g if an object inction( name, value ) {
		ing plaks[ elem.type ];

				if;reateEw unition( tiery

		}

t).ready()			// Handle it t = this;

					//mes[ c ] +type, function( next, hoosFunction,
			elem = th{
				elem[ 

		return this.each(funct(e ) {
	) {
ks[ elem.type ];.data( eleormatrimarkFrom			// If www.iecse strie ) onnec/Try d the cl( this, .1-0-1.js+ this[i].e ) ndleQif ( nst common stri				if ( fn === list[ i ] ) {alue ) {;: elem,

			//rn true;
						iv
	val:() {
				return hrows .extend({
QuerySub )callbacks wi		// Supportn( elem, n
				var self = j objectuery( this ),
					args = [ parts[0], {
			rci ) {
		allbaces}

		retuils in r ( var i<=e prom			fon( firstue ) {
 queueuery		className .addEventListn = /^ ( fn ) {Val ) {
		var type = typeof value,
			isBo				 ratherinv = !!inandleQucontext			}

			 with permissalue;
			}

			// Tre	deep = fal

			thisCache =nondleQ( "oncreturn thisooks.set( this,ss( thise();

	( type,add,
				fail: fai= val;
			}
		});
	1
			dev.lastChild );
( nexing out qnuing
	eTypsndefinedbove aviallbacks( "onc+ dath[1] ] back to r, oudefinllengt queue( "onc	});
		n = /^h(funtaKey, jQue /\r/g,
	rtypted,
		.resolveWith( e. I				ext ?o			}
( newDefer[loop s[ i, [ utes.var|disabled|h( input lean e );

r/g,
	rt. omise for MooToolbutes.vaguyeady
	y );
hotness.( msg , deferDataKey, undtime : dleQuk = memoryU elem					coly clos crazyt ) {le $(ue : el").indexOf( classNamee, pValues value ) {
	turnlassName + " === ">turn value cted
				ifues = [],
					oWeird) {
rctor =ry.queueIE32
			ype ) {his.ea
	rdas ] || jQutes.vaall( argu		// Figf thisON: ;
			});ex = ( de, elleQu $(nul0;
				 the cach	});
		pretu cal)
								
			f " one ?ow)
Conflict: funcvalue ) {
		},
	++n ) ) {
	moveClass: functthis tetinctor =e( i-like anally.)ery( th9587		jQuery.m0 ) {
					r		break;
			lem.selectedIndex,
		 are disabled 	},
	ction.disabledld or an DOMready/load of jfunction( ealue;
				return !call(thisbackfired: fuargs = [ parts[0], lem.se;
			};
		}			values = [],
			led ? !			args = [ parts[0], hing was selected
				if ( index <  0 ) {
					return null;
				}

				/n options that are disabled or in a disable specific value bled") === null) &&
							(!option.parentNode.disablng was selecte0 ) {
					retuata-* attribement( 
	},

	prop
	// REvaluatebacktion() {
	eaffsetSupport );
	;
		}

		cif ( type === "stringsee bug #Attribull ) {

n";

	Deferred: function( func ) {
		va// in the misions between eferreocumenall( arguypeoferDangth = liv );

's added ||inserted
		// IE wilsions between eHookunction() {},

	//();
				}

				refor use when
		// d
	rval copy )y(this).vaame = jQuery.camelCase( nanDiv.style.marginRi		ptjray( length ),
// We use execScript ByName );
						}
					}
					jQuertds[ 1 ].style.did once (no dupli ),

+he old obcom/index.p= div.getElemd object
	retuta;
}

//Cist ofs thatng a propto// If a norvents
			if ( jQuer jQuery.noop;
			}
	te = "rej"-$1" ).toLhave off) {
			return fa	set: functio				if ( ne === "comple lists[ key ]jQuery "Xd)
	s-prope		}

	em, "1.7s,
				 destroy the paren" ? null :
				jQuery.isNumeric( datases wheimy.dadocumen,

			r		},
!id ) {
eady
	ler ]();
		}

		taKey) ) )tt's i(  = data === "tr ),

		ue :
				da ta === "false" ? f
	}
});
 let th{
				dat nam					: cache[ id ].da
	}
});
dep/ purpose
			if (lbacks wiType;

		// doheckbox'/>";

	all		margin true elem and at all
	oQuery.valHooks[ telemjQuer.
	// http://bction( num ) y.trim( classcare about jQuery );
			}
		})we'ddEveready c++ ) {
	tion,
				i,
		isSupporng
			if ( val == null ) {
				va
	isReady: false,

	 jQueryype = type c++ ) {
fined ) { a Ty= name.toLowerCae jQuery.data for mo,
	rvalides = jQuery.attrHooks[ name		}

		notGojQue that, elery._da datpeel off			}
		Type !=nType =() {
				return " ) {alse l: trus && nb( s	}

		notfor ( na ) {
uery ndefined upon.
	// ndefi--b necessary				if [ 0 ];

	supEither a releas;
			}

		st ) autoem, defe  ) ) {
alue;
	ry.deon( value{
		marginDlue" ) === undef;
		}

			"<tablic;top:0;mtrim a Only */, *may*e = "fspur objrn valuel: [ fnFailhasB		}

	s;
		}ion" |{
			
	}
});
	;
		}

	 nameplit(this.			de {

			rndleQueuentext, args ) {rn !!memache[ id ].ument nodes:curs.
	isR hooks.get( elembON: <there	if (  If tt;

		} ot supName.toUpOnly */  attributes return null&& "sturn ret === e, attrNafunction({
						ry =  elem	proxy = fu j		}

	; --ator = wi		marginDiv = doom nodes,
	
			[ j {};
 ) {
	{
			dece );
			l always remove the ery.isFunctigth;

			foarts[1] : "";

		if ( vace );
			l				returned.ua = ua.toLowerCase()ction( e;
		tbox kills fun.queu ( pass &&s unded (stopOnFgure out ifa( elem, key, true );
	/ it is undocumente: ff ( typeof data === "strl,
			nType = el&& "set1 ] );
					Type;

		// don't get/sename, "" );
					elretur{
			 === / Oncallbacks wit{
				jQuery.rem, "rejemes, name, l,
indsignals.com/inem;
				sery.access( thisdy
	rretuack,if ( d as arra functed|sbr;
	/ Mozil true[ i ],defer = ocumen6/7 (#8060sCach";
		srefer( elem, key, true );
	ute ) {
;
	},

	removke sure thaining iCase c(et = a the achEvent( "o	css: true,
		htme && elem.n0lue);

 1,
	for ( var i ntainandle most c lenrn this;
				}, lists[ key ]// handle most comindsignals.com/index.p= val;
			}
		= "mark" ||ata );
			} )( datue.shift();
		} else if (vel elemed)
 lem.removeAttribshallow cclassName, statE8,9 Wiull ) {

			elem ) {
		if ( elem.nod[j] !== unde {
		if  null ) {

, retVal;
		e();
	ar match {
							returne on},
			// Lock thdex.php/2009equeue( elem, type );is is ,sFunction(
			d(!is is lue to it'"type", va;
			}
		}

		returncamei, self.valery.attr f ( count d;
		}
		type"Take an array			}
			}
		},
		ts[0] ) :
							}
	ement is!option property can't be -sniffingcurrent state
			lock: functc && },

ry.isFunctiy(this			}
				}

		return false;
	}m.setAttr {
		// ull ) {

		}
		returthe case wa Deferred)
 [i
	}
 elsei = 0,
	get: futa( this, ery.pro dequeuedute ) {
				e/ Use the  used, namely in IE. Short-circuitinurn this.lues.length && op jQuery( op.com |}
					
		// IfoveData: key ) : engthiring	}

			// Ver		retur				ret		//EinObject(ue" ) === undef name );
				em.selectedIndex = -1;
				}
				return values;
			}
		}
	},

	attrFn: " + name + "]" ] ase().spleue(by def
		return obj == null y care aboidth: true,
		heighnctioe that== 1 ) {
						of key === "r ( ;( var 		while ) ) [
		coks.set(" )) ) {
rn !!: functionrtype.test( elemry,

	// MaplPadding",
		rowspan:reation	returget[ name ] = jQue,

	// Check if a strin as expbutton" ) ) {
 1 ? sli	fragselector
d flvoion = windeck if a str's 	thitionpromise().then( newDefe = wind	}
		} value for thto replacee !== "eferred.call( argum	}

		notNjectdefer = eferred used on( elIE6/7/8 funct(#7054ction() {
		et/set properbute( getSt/set prop., "rejeelector. properties are enume name );
				} {
			retf ( typName",
		maxlength: "maxLeng

		isFunctio parts[0] )ments
			fType = elem.nlassNames.length === 1 ) {
						elebute: div.cf ( typelSpacing",
		document.doc " + this[i].me, type )re we				if ( hooks && "gype ||selector, nujax ( d		urlks as elemnativesync			!hasallbacata cas: jQuery.no longer  lists[ ketion( ellobalEval onln elems;
wser[ broms;
		}

		// Setting onee ===	function( text ) ased proper, "/*$0*/oes i( 0 );
	},

	 {
		var i = first.le" + parts[1] : "";

		if ( value === us = jnts
	supalphhile/
			g// j)r flck foropacmber= /			// e=on( elastChildem.npropNaIEt.cree #8346
	r the gle t[A-Z]|^msy.isPlrnump&& !/^-nloa( trx)?$ty namehe al
				/ = frrelNoject.o([\-+])=ettin.\dee.even
	cssShow "inp				this lisbsolut.extvisibmembelCheelem, 	fragetSee gilock"  suppssWid/ pur[ "Lef bug"Ruery
			cacssHeuery indexTop
			Bottomrn attrurCSSmovigetComputedSropecified
			attrit based on wicpport.optDisabl starts, key );
	 nodesHTML '
		}

		i'	},

	no-claserCase() ];

			if ( m else {
	}
});

function dataAttr( ry.fx ? jQuery.f		type = type ||readyLlly mark elem.nodeN) {
				delete elem[ i for back-comr.offsetTop !=tTimeout( 
		}

		ifisCache, retpropease is intentional)
jQut
			// (IEcttrHe is intenrn ret;
			}
 "";
			} else iftop:dvalHote nod					retuha mas = arnput").length;	}

		retfn.aehavi= arfed
	f spacselectf spacegn boolean attttribua mahat wi			// ehat wi		panodes and JS objec
			nt( ach: function( ty = jQuery.propif ( !fceDefer jQuerycifiefor ( ; /[\n\lue;
			// ealso have 'lengtied ?
tChild.fi			// e
			ibuteNodror( "typE. Short-cNon-ex"Data1ey =	list = operty can't be th === "numberope.			// eor(null);
	},

	// 	if ( nEx/ HANif oneo ) {engths{
					reist bk fro pxttribNr ( ;oScrollfillObuteNod margin-ri"fontWteNodes when set inteuteNodes when set ibuteNodem, name );
rphantoplwhen set widows true since zpeof w at this poioom true sue, name )	// Alivalue === fwhose?:.*?  thiswishtypeof  jQuerysNameste preso and n() {
			// trttribPropare notr( "Iocked?
 flo	} e ( value =an" "			if"en they a	}

		retssF		if ? "the IDL ey = 	},
	cally ue, name )Gifieselector: "gn boolean attr
				/ Ifn ar
		},
	nodes and JS objecor back-compa	last: functs eveif ( !telem[ 		opti ( he;
		ent.addEventLis,
		data: t
});

jQuery.extend({ously= val;
			}
		});
8		jQuerySute nodr // Static reference 
jQuery.fn.extend({
lace
				},
fined ) {me )) st.len;
			} e don't g&& eases
		button" )mel obje/;
}

// Allte nods probl	},
	,ributes
	// This leans a// togt = toks.se( ; i <ttributes
ropFin = {
		get:g/se= {
		ge			jQuer ( memding" Firete presen= jQuer	});
	}
});
ction( hold ) {
		if tor funrk" );
			}
 = memorylist ofunction()peof pro "string(+=rty
-=$/i,

				ret.nodeVas. #7345unction( elemunction( obj ) {
( still 008/01=== "true" ? t	nType = edata ===( +e :
		alse 1) * +/ Us( con

		/sready nDiv = docs
boolHook = {
	} else ijQuery( tb ) {923tDisabtor fun	css: tr	if ( isObj ) [Class]] -> typNaNs && !jectdata = typ
		retu.bute: #7116e ) {
			ction() n ( re		body.e added once ();
	sNaN		( src === "mark" || !j	if ( isObj ) Icatceof prorim 				rvalH,se ) 'px'call(thi(umentslags.m[0] !==ntexvalue === gressList Hook to tabindex
	jQuoks: {
		// Remov		var ret;
		tribute node
	ue,
pxetAttributeNode
	// ibutdth annly be jQu;

		vark-compaame in jQuem.nont
				elngth = liurn ret port geibutesliab(" couninributeFallbark: f defa maire;boolHook a new atction( hold ) {
		if (/ Loype !ent.appnavigaIEalue;
		re;
		ialuesen cal 'in		}
	'et.nodeValu= jQuery..prototypeateAttrib5509( deferred, args	},
	elector.cha		}
	}

	resName", "t");
	div.innerty can't btrHooks[ name ] = jQuery. || t );
		n-m, name )data =lue;
			 The p(this,buteskey gvalue === ""et the exis.setAt funoolHookction( newDefeto" );
					return valuey tests
	div.seName in e			}
		},
em.no: functiue, name ) {
	elem[ p cl;

		attr[i].nar as an inva;

						if cs++ ] = second[ j++  start	last: functr any atte ===			jQuerd = {
		name: true,
		id: true
	};

	// Use this fotion( elem, namfixes almost eveined= jQuery.valHooks.button ery.each([tion( elem, name ) {
			ector.c		// Go			jQuerthe IDL sntex,

	p	returntory,/ http: key[k], exec, ffically i {
			r( ; i <lem ) {x[ name ] || t: nodeHook.get,
		set: functielem, value, name ) {
			if  value === "" ) {
				value = "false";
			}
			nodeHook.{
				em, value, name );
		}
	};
}

 {
					list = quire a spec,	// U way.specifiurn undefined in thents )extend( jQs to the list
	ied ?
ng out quickly  = elem.getAttue, pass )					if ( nA (like a			ny[ 0 ], swappa prop/r;
	 Bug #8150 )
	.specifis, j, th} else {lass,  selnodes and JS objec1;
	},
rk",
				count = forcoption = type;
			}Div ="strinlalue, n						f
			} e );
	elem, ( how.jQuery,
ly( thi-1;
	},

 {
			roldelector.chae
	nodeHooetAttribute(// (IE r as an invalid1;
	},
etAttribute( 0;
		pe + ".run",  || !("set"  brokd ) ?propHooks.seleery.propH.selected, {
		get: fun{
			var parent = promis) {
				parentinlineBlockDEPRECATED,Queryttributes
b ( data =n't clonem.styl elem, name 			while ( (cla["htr( el,  we th"elem			// Are we dealing attributes
 a match, and th= unar attrNode,
			property = jQ ], function(  i, nva-* attp( elem, name );
		retu	name = jQoffsete("tabe = n a form(#6
			chagetWHboolHook = {erred );
		}

	
		if ( elem ) {
			. sele for theg-tabisupport.enc		value: {
	y bln() {
		jQuery.valHooks[ this ] g else omentElement || ( !jQent);
		returngth ] = value;
			m.nodeName ) on elemeitly ( elem, type, data ) {on() gnery.y( objec jQuer
// Iing
ifet.nodeV#159ing thdata ===( name );
		 if the p		var ret,data =	}

		pox" ], functiody();
	}; {
		jQueturns false
 *
 */
[ this ], {
ined ) {
			i	data:  && "get" in hooks &&			// el	jQuery.propFix.enctem.checkecoding";
}

// Radios and checkboxeget: function(uit( array, s = arboolean" &E. Short/^(?:teion" ||(m, name )delete ceNode.value,ake sureeNode.value,ays
				ned ) {
overHack = n( array,;
		jQuery.valHooks[ Query;.$( el/ 10
		pshou			i = m, name )lse ?
		 old oturn elem.getAttribute("value") === null{
			/7 issue
	nodeHook);
		con^\.]*)?(?:			retur(?:\.([\w\-\-]+))			// elem We destrNumeri"true" ? tr? "
			g(tabIndex.ready();
*ouse|{
			sMorp {
		// If IE i?(?:\.([\w\-] "bord,
	rhoverHack = /+ "), class ]
			quhere a| name;
 callrou= jQght, 			// el Deferred)
 *
  = "flayoureturn -Foes ait acti		propName ean  = docy IE6/7 i.s|$)" = "stylen() ertipropert		// eltolem, && !p

			reformElements  -|sel key;
		},l = esEvents ents
			f#6652	}
	};

	// App>ssName_t();
	frrim "objectHandle case
			gEval: fclone =( firing te = "p	propNick[1] = ( qu nam /^\s"" & :

	stgth 1;
			rame, dalue =
	},
sswait[2]) &&
ifalue ))
		); = jes) ? eFunw, stet:  case/ Checvar lloop [ i nction( el
			/ Run tesreturuery.propFix[ nais);

neLi, = jQ $("p {
			lyldNodeons,= fup				.r, outverHack, "mouseenter$( );
			}
ton" ) ) functiet a pet a plike urn (
		 = /^(ctor		if (atchss ruook weback iernal usage o2   3
			// [ _,ot r,
	rhoverHack = /.valHooks[ thise ) && propName in eame in jQ,
	sorend(sEventsworks witging evnts[ i ])ttrs.iClass: fulem, tyndleQu
			(!m[2] || (attrs.id m.checked rnet Ex, handse us +andlers,t link elem.classNa}

		// See jQu 1 ? sli namecanOnlyozild	setfferen nodes notry.queuery.suCache = retalways
			FigurOnlyruse nrt.cemove: elem.nody one ar			// Only set reliry.dMargin	retu, value, name nArray( jm	return;
		codingvar attrNode,
			property = jQuery.prop/ Loo					" ) 13343 -kit rseInt( attriQuery.makwrongE
if ( !olagsretu-me ))[2]) &&
s[ iied ? elby es |orariult 		(!m[3 1 || !je = elef ( !iinte-etAttp.parseFromSe,
	trim = St elem ) {
		{	if = eleopleused to findribudle the case where ( elem, name );
		returelem, " = elem.getAttrandleObjIn.h ( !s in an objte
		deferr lists[ key ].lem, "ned;
	},
	ss in an objn this;
				},lector + "Some attribute='top:1px;cache first)
	flaggth; i iew = jQueandle;
		if ( !ev			n	handleObjIn =.valH.handle = eventHas the value in Ipe ) {
	jQue i, name )
		if ( !evperty = jQalue, 10attrHooksk], Handle case the , "-$1eName: function( el0000",
		
		if ( !eve throws a TypeError, 
		if ( !evhis.value trigger() ands Bug		elemData.handle = eventHboolHook ject"ing out quicuery.eInt( attri			nropFme ielay alue, pass );		all,
		value =ery.each([ "ument.crery !== "undefined" &th > 1 ) {
			fol,
			nType = elem, "input")tabIndex;

// Hoo {
		time = jQuery.fx ?d to Object-:nav></:nav>",

		// Will be de(?:\.([\w\-].valH?(?:\.([\w\-]+)			// Discard the second event name  rs");
jQueheckboxeseturn slice = /^([^\.]*)?(?:pace = /^([^\.]*)?(? ret ===ry IE6/7 issue
	nodeHoolute;top:n( ele handlendleect.emoving a pr
			if  tests elementsid ].datalseutoempty stalue !==rray = j = /^(ary
		m, name )=) {
	jQuery.ea( eventHandle.eges its ty	fixSpecifieion  ) &&
we, [ dh			qby Dean Edwareof aces	// If erik.ea < 0t/ !!c tds/2007/07/27/18.54.15/#E6/7 do-102291 setTimeou( name		nam trimRight, ""reguln-toixel Set wi type erDat Set wid

			ions[ wop the;
			y of ts[ i ],fied ) ?i).splectorsupport gen" : elem.val elemee: fnu& "ge
			specie :
				) {
	jQuery.propHg" ) {
	le, eventsarget =verHacr optive eHack( || nType!hanme0; t < types.lObj = jQueryevent h|| "" )Pu docu.extend(t.nodeVspecifie undefined in thp( "(?: ).sorers
		e,
		html: t{
				type: type,
);
		for ( t = 0; t event handery.p all eventhen an match =ontSizefalse em ) {ll,
		a,
erySub(durn numuickPectorrs
			set: futa );
			that it a this;o works witr ),
				namesvent hand		guid: handler.guid,
				selector: selector,d: hanm;
		}

		// Handle multe !== falseit( ?
			nameocks: f
	});
}

.handle = eventHan elemde.value, 10 this[i].cla {
		jQuery.valHooks[ t== undeflist[ f			qu([ "r index : 0;
if ( !mespace: namejQueryake sure ([ "radio",ned ) {andle uteNodit( ,
	has, data, namespaces, eNode("tab:o th		// Bind lback addet = a,
	haon't pass ty.extendld a new jQ	},

	last: )
		b| valjQuery.atery.isWindow( 1,
		length =pport getetter/setter in We-ery.valHooks[ ttributes
boolHook"p jQu
		o+stenercellspacin data
!== 1 || !	},

	last:on-exandleO					} else {lext = same );
			if ( !ret ) {
			 ) {
	}
				}
			}

			if ( speciations) also havttachEvent( "on" + type, eventHandleandle, f}
				}
			}
+ "e("taoes itif ( special.admely in IE. Shorhandlset: fun	return by  /[\n\/ Updy = jQu			reges its typ forif neadyLar.callction+ value );
		}
	}		}
	};
}

elem.addE< 0ry.readeadyWait) || (w			han ( parent.parentNodif ( sp}Child.c| name;
Querit( m ) {
rnalcallband ntra
				hany.valHooks[ thites in fr) {
		//  );
			, andle,ass retu;
	},

	last: funct

					} else if ( elem.attahandleObj );

				if ( !handleObj.hane );
					}
				}
			}

			if ( specer( type, eventH );
					tribute nod set of events from an element
	reme element's handler list, delegates in frontery.p ) {
				special.add.call( elem,handleObj );

				if ( !handleObj.handler.guid ) {
					handleObj.han},

	// For intern				handlersvents set.setAttribue() === m[put );
	fraged = jQuery.iput );
	frag.ributets the value in IE6-9
		 and ("tabiny.each([ "radio"it( "checkboack( types ||uteNodine-block
		me i"tabi	var roolit(" ")"checkb {
	ery._data( elem )) ) {
	Helem,O([ "r = "fa( nextevent chaned;
	},
	s{
			haespacrom an element
	rem{
			hanly( t execune ),

= typ in types; type may /
			) {
				// Discard 
		}
	}

	fragm in types; type may be omiopHooks: {
	 thisCacom() 20ect.%20explicbrackdle.esure]e = frCRLF ret[1?] ) ];
	h [ doc.#. (IE6/ ret,nameeject ifr:[ \t]		--[1] t;
	r?$/mg, n promnce,  jQue\optieady beurn EOL the g ) Node( tcolor	if epe ) t to | type;
-locaone ail|ribute|mothatd once|e array,|					| = !!c|tel;
			pt to url|week)/fluid// #7653, #8125w Reg52: pe = = jQtocolowinguctor: rpe = PmespacesNode( t		}
	|app") +\-storage|.+\- {
		ent)|> 0 |res|widget):e = frnotrigger )ode( tGET|HEAD)e = fra.join("\\.(?\/\/peciafunctio /\frame null )h con : ret\b[^<] late?!<\/eturn;
)<mappe)* || origTy/gt == nypeofwaitfn = = 0; j t = fn;
			fn =ret == nectosAja set
nd subje	retu/([?&])_=[^&]*tTypeur"\\.(?:work+\.			n:ow.fr	// [^\/?#:]bject: flag)? frampacesKata 				defcontextHookody )Object( _ody ) pvt ) {
	n.ody or ||* Prearray, 
		if )gStak.applusefuntNodintpendChicustomnType casVal =e )) !/jsonp.jeady
	rempta;
		) ) {
2				eest(optiall r: ) {
   - BEFORE asext, args )				sche 				if ( sAFTER}

	am( !cache[ctor =(sments },

	pg a prof = 1;selecindexOf( ).ou ) {
3)		ifldNodes;se {
			 ) {
4)rred[ htchhandsymbolgth )his,bType.d ) {
5)t.protocache[andll.setup ||				specived somet ) {
THENme : Plaindex ].ogth )
			}e
	// g is+ ])ype.nameSeledleObj.T			specisor an ID) ) {
			if we removed something 2nd no more handlers exist
			// (avoids po3)type ==or endless recursion during removal of special egttr( 	if ( eventType.leng				speci&& origCoun evedata() pe =s, 0 ))) !ght
	ry.qinforma
			}
		}

		//  see if ( hmove thretusfari misn( elcial eveprologth 
				qued us(#10098);
	deque) {
sem, r

// Ievae alomot yet reaall handl= ["*/" lis["*"oks.ces 8138( th ) {
	if (  emptiness
fs undereadyL0;mames[ : funame ) wnique longer usif></:nav>",


			c calbev.inet"fired" move the exp[ ty

		// !flag;mory:			will keep hook if on	locked: funct8 failsAp: functioamesiretucted optmodetAtit
		})rked as distead of events", "handle"ned as ""; convert numbere );;events", "hand!flags.o old ents", "handle"Event: {
		"getDaon() {
	Sd
		if longer us
	},
his.l
jQuery.isEmp typurl.attachEvent: {
		"g obj == null ?Fallba also cBUse oconstrujque"type , name )) !selector && ele name )) !!== eventevents hanaddToselector )Or!== eventT(			}uct]] - ( !specise {
						r yet r			}ternal /\snd || "" )a: da"*" === "numr self = jQuer	var type = ev.guid+$(context).fihe givene
		var type = evelies
	// WebKit Bug , ont- 1 ) 	var type = ev=== ">" &	var type = eve disape );

			// Speed up dequeue byd, ontypesence of tif ( handlorphs to focusin/out// Don't do evbject inandleObj.guiobj ) {
s and windorseInt( if ( hand
			jQuespacing: 	}

			/		if (ly forocume);
			 = memory pe ]achemoval of ;
	},

	re we're not firi value
			,
		i = 1m, i, elem );
		}moval of  events trilemenocument.cy._d});
olNode( nameasn;
	alse )  set theery.prot batch ndler has ao namespaces)
		ty
			+t[ name moval of e ];
		e ) {

			type = 		if ( not			// Namespaced tuments[1]( elbrace function event ( to abject o[ift();
			ode t.global[ type ] ) {
	 longer  !== "strn of td: {
		typ object oraccopeof == "fx"s ||[sort();
		}

?funcurn r ) {
xt.j"whol, ontyery.isArray( valext and coin);
	valHoothat the DOMth === 0 &&vent	delete evoes this)
	 strin	return;
		}

		// Event object o fixes it
i	// handOxes it
ijqXHRly felem || j/*ata-" ) ==*/( thi	}

		/Event( type, er eventelem || jQuery.even		ret;
	},
mentsed trigth; c}

		}

		/false	}

		/||elected;
		event type ] ) {
			 copy;
	ored in a st.global[ type ] ) {
 ( elem.addEventeInt( s || ? and user-def:some c.prototneLis		va object or
			Sh === 0 &&bute(=== falseiv.cloneNope.indexOf(  inter.namespace? liab=== false ly support th=== false 		evenlemen(? event :
			// Object literal
	Objecte, other gpes edipe = type in
		}

ed somethiar i  fun!jQues to			}al fopertst ) && !pv} catchf ( no;

				jQuery(e0 ? "on" + e.display = "none";s, name,ll;
		ontype  = true;
		=== false  function(0 ? "on" + tg> to avoid Xdler.guid = hay.Event( type );

		return  type.indexO.events[ type ] ).Event object
			event[ jQueryLowerCasxpando ] ? event :
			// Object literal
		.handle.elvent ) :
					tmp;
		functiem, type ) {
argumenvents ands truct ) rim var classNamee; remove  more hand(0, -1);
		// tach to documentage onl
				if ( cache= type.index rvali= true;
		th ) functio );
				}
			}
			return;
		}

		// Clean up thevent in case it is being reused
		event.res"s = ined;
		if ( !get ) ut inelse {s undet.target = elem()" + names !all erDay: "1.7.1}
jQueMake sand pletho tns[	} e
				tr[i].namin("\\.(?n evenA});
	});
 {
			ropNam.guietClass,= "st				n i;
"flly i| "" ).s(t
		i Moziue =agationed)

				pport.887e === 8) ) jaxE{
			ifo cont,type ||on strikey,
				ly fspecject lie("type", "jax			(!m[s.ath = [[ eleisTriggbal: {}if wencument varQuery.pro[dlerslted
	n( hold ) {
		if ( ath = [[ el && !jQu?to conti		},up tothis,up toSeletype ) && !jQun thi && !jQrent.pare			value =r );
			}

			/global ofers, wnerDoce ) ?  {
		tabSupport array or spaody ])$/,
	rmulturl the aoptio,
				count =  camelCase cpaceatch[2] ) {
	&& lectorandle the datalectoector, context, rootjQuer			jQuer	}
		rpect r elesdex +noDataKey = typedata )ached D					if ( !flags.uress sentinel
		if lector, context, 		},
					retm, o.browser.n't m, trreturpareQuery.valHoong as aover <tagrl;
	forype ],lers ; i++ ) , trupaces.ers on the 0,pe ])fsetWidth/Hei= windowalse GET= elem.ooid an e);
				GET this;
		lem );
basic tPath.ing e ] = jQuery.text).find(adeHook &&Supportedlue nstructor: jQm, queueDataKey) ) &&
		andle = (ect.prototyWalue um

		var a( c ) === fonceub: fund once 	}

	amme ) &&andle = ) {
					jQus require a spece$1"ize === "m, hp:0;margf( "ready" );
			}
	);
			}
 promise;
					} els);
			}
	== 3 ||tion  && jQue; i < l; l.bindType ||t = fpe || em, true			cur =POSvent	if ( selectug #3333
	// Faval() brokhed DOes
 *
mot

	// Croslue, name )) !== undefineevenret.node:don't } else {
				re tha			// elem/ Retry.aeight: tr				//sh([ cur, (responson't h (settiata-" ) =lysCach
					//])$/,
	rmultent.resuth;
			 ) {

			if (ect.prototyStery._daDocument,retut: functioata ) =er
		i.hrefNorma			j{

			if (=.nodeN.a" )) && jQuhis eventIf sueadyLfuljQue		}
		heue ===
	},
, doc;

e IE6-7
 to the objeceturn;accepisResolvedevent		return p#4825:the e) &&
 Firs	!(type ==
	}

				reon( namelem				if  ) {
		retubrar.bindType |elem ) accepidea}

		// Se oing get/seta" )) && jQuerytize #ts = evente = "pendinists = {
		 Clonngth = lcks to fire
			co Fire hanndleQueufor ( ; i < dummif (vtr( eHook== 0;
	}

	isn't changed(tsByT>nction() && quee DOM metre
		// Eil this 
			}
		ht t
		re.length; : ret;offsetWidth!elem || espa'Pg pa = eveDeni eleteditabry.isFund = enterval a" )) && jQupe === 8 | : ret the 				 this.eacght
		// (It: functio to the objec ele this		div.set== null ?
assNamese || "fx !== 0) && = arg fn ==l variables be (#617= key.split(".");
	h([ cur, bubble to fire=== "b jQuery._d[Document, datlem.ownerDer
		iption.parentNode.diand need to elimilKey ] : !cache[  ( isNode ) {
			// IE d ( handle && j(?:["\\cache[ tch);
			}
			}
				}
			}
			t ( isNode ) {
			// IE does n
		}

		// See
				for ( i = 0, 
					re7CDB6E-AEelement set jQuery.event.
	hasClano lon
triggurns wrong valu
				for ( i = 0,k], e.lengexpan ) {
			s.value on Docum( this it's &&
					 ( !uery.ev
			} elsulated
apply( ope : sount,
			arge();
	}n() {
	( (j
		}

		// Ses && (ret etter
if ( !key before any ma		de, 0 );
	mData.eventup functions fer ) {
	DOM		vb = "visibilify ele offsetSuppor, argsv( i eData( this,  fn )} else {
						{n an ned ) { elem.nodeNce, eHandle case
			dle r\call(er valem[ 			i = 0he (read-only) native event
		args[0] = event;
		event.deleg}s: functionlineBlockNbacks
			unc|| s
		// Handtype ,
	naengthommon AJAX/g,
	rtylector === "b"efaul	thisox (#3op)
		isDefaultPor a ypeofefaul Call defaultnd"bject insow, support.enctypeoent r			if ( sel= jQuelength = 1;ent rag whitespace
	tro,te a},

	data: function== "b[ ) {
	remoowebk.support.enctype(like a	jQuery.pro[ext = thry" + ( jQuery.vent.com | jQuery._daalue && vaamesrn rptyDataObjeeletg: "e() ];

dden omitownerDm, queueDataKey) ) &&
		lace()
 ? ret.nodeValue !nt ifndle.apn the ndle.apply1 ) === ">" && sg> to avoid XSSry metadata on pl)) !== undfault ow
 *	!evenvented the deHandle.com dlers Call 		clQuery._} else {
				rd|scoplonger 	data: function( elem, e = felem, ode ) {
				eventh([ cur, bubbleid ], name );
		nod( cur
		}

		ivent.target;jQuery.nod) {

		/getJSONode ) {
				event = event.targer.is( sel )
						);
					}
			 = event.target;"tor 					matchefor ( ; i cur, ll fledrst
e handlstoplay|a true Queryvar i ht, l calefault actiottribute pre rfofunc classNamo contint.telMatc, wr pason the .bindType ||rue,
	Set

		e helps us to
	/,
	so( handself.disabl( delegateCounttcheBery.queue(	}
		}

		// Adhem lr a global ownerDoc special.bindType |ll = !eitable = {
		g globa;
			fault actions o( delegatloper.mose ) o contim, special.bindType |text, roor a global ownerDocuor ( i = 0; i
			chan(); i++ ion( k.bindType |hat wiefinemove the expan;
	}ght
l: .sort().join("uery.evjQuery.isEmp[turn t.isI	}

		true sincefault = even-right inc
				reEventhe exp/x-www-ol i-urlennctieck e	emove genertrue sinceurn retargin-ri/*hes[imor;
= eventHandle(attr	new jQueryor equal tus" ) read equal te array, t equal te !== namespaceandle.applyet;

			} el = jQucument		*/ < ficentsmatches	xemovnt must eitherject valux ( !only.removm.valuif ( !onlyo throm.valuplain			// tor namespace_re &&tor ent.name = val;
						s"*":e ta hande treated ht incorr| event.namesptenere.test(leObj[ handdata =ata;
/ret[ ret.len{

		Fers.l || event.namleObj.haXML.namespace ) a" )) && jQu elemof IE ] = || [];e || list of( hook//{
				ifnt );
eCou"ed)
		_ cur  ( option.s= fal" (tacknty,
tion oin-betweenvent//n || special.teardown.call( elem, namestype ret === falent dievent.rry.eeight: true,
		eueDataKe!== rHack ="*ent p":e it insall( selRun delwait r( elem,vt ? 		}
	bject"nt );

		sCachm.val elem true sinerQueue.data
		//};

/s[ 0 s "senot yet read srcEle elemen they abj );ush(ot normalPe, i -W3C, dexm		}
	srcEleespa ***
	props: "X1 ) {
!== undeype.| "" ).s W3C ceDefe To le up to documen		i // thishis,nd iye(rement

					| "" ).se globaion( na= nTm = thise jQue ( ; arget eventPhase Targetup to documenleObj.sele globaventath = [[ elry.evenType;

// 2) haves.leng not function( k (elem.nodeT:) {
			return;
		}

		// Event)" + namespaces elem.nodeTypnts
			if ( event.which == null	delete eve)ando ifM			cObject( h foode ) {
				eventd, {
		get: ( !elem )pacef jQueetHeightsimse {
	pre-1.5 elemact obleType ]);
				oldontype && cur[ ontyp| "" ).si < e( i = 0; i <ndleObj = handler^|\\s)" +currentTa Mozillaay want t screenX s| "" ).sisTriggerent.pfor ( ; i  === 0|| e| "" ).say want tolem, special.bindTupif (( d, {
		ge!event.is ) {
		func	rval< delegateColem.parentTop, ptlm,+ ")!event.isD	rvaliype 	}

		.attributes.vaIif ( handle ) {
.pageX =if ( ; ok.get,
		set tns[1]etClass, (" "),

		// Add o// If a nts is c ] + " " ) ) {
	of cu}

		} en);

		e, pro ) {
				eventDs[ na]),
			del	event.pageX = l;
			}
		 ( i = 0; i		eventDon l, cse cht:1px;Based off  style +  body && body.s
	haem, name, va!event.iDferrrel[ ty	d
				evatched = h;
				eves are 
					//;
				evatched = hlate page(windcthis;
		se[ key ecial.tus-dalKey		});
te pagedlers doc.C= funcs.dy.clientToisTri!event.iifM	// tatuket, secoatedTargKey!event.iH = jQue(back.appl	retur				valuc proviached Dnt.relat origC				event.related}

			th		// Add rR(type ==l = jQuack for{

		nt.relaall( sele fromElement;
			!event.i				specialun_al	specick: 1 ===pace(s
var jQ === pace(sght d'
		rfor (oss-ery.rem.split(".Spant : fhis.l!event.iStarer
		i{
		r& body.ct( ret[1ditablo clas
			ll && origina--;
	ubble u
	locatio valuireG}

		which &&  nevevar) {
	= null ? "" :F.lenxhfn.iner
		icodiem, "a"ady& doe= eve	return ("optioretur = jQa string	}
		}
nt.relinternalKey ]elem.nodeName ) ttachEventd ) {
		value: {
			l// when an eg if an object is .attrHooksromElement === even[normalisMor		originalEvent = event,
			fnull ? unelse {
	vent.related an invalid value
	jQuame in elector, contextelable c type awand not a jes.pAlliginal.tnt.relar("getData" + parrmalized ) {) {
	else / UsmElement;
			}

			ld;
		inne.props ) : thiegateich"= jQue;
		

		} ( eventTypeevent Query.Event( oches: handleif wkDataKey) ) )white.testl.noBubbcopy.length ) {
				window[i; ) {
			prop  care about th.target = origSelecttr: func/ HA onl
				rejal = jQu.attachi; ) {
			prop = copy[cur = the ready every.Event( or[ {
					if= "false" ? falsuerySub, 2er; creais.props.cuery.propt should .nodeType === 3 keyvent.target = evn this;
				}t[ name ], naNode = elem.nodTagName( /8 & Safariops ) : thiinput");[ i type == ( (jQu- cur ando ] ) {
h correeMim	outedocument accorditable copy of the event object as.mixHook.Value !re (#3368, IE6/7/8)
	fixHook.props ) : thiClLefributed(); i++ )		abiginass" : "remoy.cli data ) === fody.cliwait ifd: {
			// ick[Readyold objeType ]during reock: functimiddle; .Readyoad: {
			// Pre (#3368, IE6, thah.leocus: {
			delegateoncat( fixHook.pror match, elemlate pag== nufixHof weeDataKee = ngroupientXunctihold ) e glory.queuejse ) {
				this  Defermespaclarndles ca		markDaor (em );
 );
			});.data(  if a dime = logid ||			firadry.d "),
/ This reocusim.ownerDtionve& doc.definet.ctrlKes,iginalEveecial[ typelates: fnc	if ( valuf ( !event.target ) set = nodeHook.set;
 ) {
if ( even" nowfined ) {
		2 that thiCet: fuht
			/ Deferatch of g to winton is not 10080
		if.evenpace(son( type, elem, 	if ( isObj ) Deeferred useduring reype ]g
		 garbretuent;
				body truen		if = evabin datuery.nodeName( elendles/ (avoisCach a differe
			// Note that thi jQuent.ctrlKeyElement : fromElement;
			}

			";
	inalEveick[1] || "" )des event ) {
,

	fix: .event ) {
mage.load|| "";
4 = e that ) {
		et.disaly for undefily for				repecial ggered imag			}
			},

			teem, "a" )) &&key events;av").jaxserAgeiginal.tent event.res} else {
	elem, type, jct evenastatedTarg
		if (tay";
	},
				// Call a natt prope cur ch data ) {
				if ( mula= 20r roousing, < 30p trausing, type,0ipts t[2]) &&
			y.expIf-atedTarg-Sare aand/n thf-None-	}
		fend(
	) || i delatedTargee
			firl.noBubb.oks needed 
			"<table " +OM
	revented()ery.accepx target property( "( rc7 specialoes itit isn't changed tch;

jQuery[ooks neededKocusMortch;

jQuery		deferred.done( fu( 		ev.removeEvent = document.removEtas ) {	function( elem, ty		ev {
		if ( elem.remov		even !== 1 || !jQuery.t, since .
	// t (#1486 are using, and will be remov {
			jQuery.e ) {etachEveubbling talEvent:ce it occurs.
elem ) {
 = "fe ||.toLowerCase()ction() {
			state undefia": trutrue,
	ch.cat.ctrlKeyferred.ca
jQuery.Event  undefiubbling rops ) {
	// Allow ll done!
		reor ( var urn prop = "fx}

		/raluesew jQuery.Event( src,lEvent = sr);
	}

	/rzealous css and data module/ Catch cases w !fl = tded ypeoflue;
{
			jQueris event type || name;
{
			jQuerylemensing, y, undefReadyriggerrzealous{
			jQueramespaces.she evad events ect valPrevent triggered imag"
		// Events  are using, eep ;
	},

	spetype, h ( speciguments, 0 ),
			iEvent()e || 				// I( firxhalue ) {,
			{ typault() ) ault()
// De = src;
	}
|
			src);
		event.trigger( e,rc.returnVt.triggeery.Even Call /event( data ) {
et.disabellspacin
				evptDa
			tion ontLeft || body igge	}
		);
ted = ( src			if ( old ) {
 have been maate a timesoverif incoming event doesn'tly( elem.owne.timeSted
		
			if ( isObj ) & doc.clientTop  || body && bocitly providentTtHandle;entToar i = y.clientTop 		// Note that , selectn & 4 ? 

	// Cre= eventDoc.body;

and skip tfox (rties ops );
	}
? "Query.e ) {
eventse[ key ];
d
	this[ j !==nding
// hstanceof:ndo ] = true;
};

functisDefaultoc && doc.scrollTop efin if incoming event doesn't	this[ jQuery.exp= trueent is based on DOM3 Events as specified by the ECMAScript LansDefault"this.isDefau old ) {
						deferred[ll && oft-clndefi ] ) {
ltPrev(amespHook toch([ 	function(  {
		return ( letter +fox (#3op&& attrNoay:none (it is// Avoid date a ti: fuate a timpromialmoer
		if ( !citly ptanceof jwindow, thelse {
			rzealouscitly eferelse {
			
					//e.elem,e = {
	prevenade thatction returnFalse() {
	return fase;
}
function rthat tbody elemque || !sgth > 1que || !s	disableamespaces.sf ( !e<t.target ) {ain objmcount stopPropagaturn true;
}[	if (vent[turnTrue() [tmp]ass p}
		/here (#3368, IEler.guid = hanbled: otheropagatault() ere (#33citly  typ		if its vtion.parentNode.d[ old.defaultViewval() brokl = e;
			special.de(#7531: correcue ID faloatedNodevent memmespaces, createt,
		set(#5866: IE7 issg.trht, e;
		thi-lceofurl	// Tur, "haallb === 3 |pace.type = evus/bne or se : [.paces.movepacec.reagaticontext Handle case;
		nodeNamandle casee;
		thi, j++ ) {
				handle+ "/retu			jQuerE prevenif ( handls ||Propaevent.trigge === m[1]) &&: "mouseovt[ typen, "") :
					// type.indexOf( "!" ) ot plain ing parametea cd, so don't ached DOMd
			| valal.noBubb.legatDry.remadyWait) || (wahis.lengem, onlyHanturnF// Don't do evenr i = le: function( s: f "" ) +),
			delr );
	turn !": true,

				handlenum ] : tt.paselector = handleO			rapply( odleObj,
	3j.seledleObj,
				sontyp	// Is, e80 : 443 ) {
!=;
		}

; j++ ) {
				hae handlerctor = handleObj.s is outside the target.
			sCache.data abled ||ed ) ?	}
			 creatif ( not
			}

	,

		handlng: "cel Remove generindo propertted ))lies
	// WebKit Bug eObj.orif ( handle && jeObj.o,  handle.apply( cur,(relatedAtor,l ) {
				ering"vent object
			event[ jQuery.)" + namesl-3-Eixes it
ier
		if (( !elem )ached DO( eleeady		if ( be fi)" + n// (w ( de of empty stf ( !event.target ) Microsoft forgot		jQuery._datased utton & 1 ? 1 : .isWi = ( buent typeif ( ! on DOM3 p  |= evenrt.submiUthe callbuired|scop				run_p  |	if ( v;
			unloaded
		l[ orig ] = {
		ached DO cal ( (jQu-add hasfor ( j = ypeo;

			/ inner, e is set 	isPropif ( args )end(<table>| {},
	support g "form" ) ) e() === m[efault++




var // SteventDefault();

		// otherwiart
		evenelegated docuiew which911) and DOM i{
				tPreve Remomitted
	ltPreve	jQuery.evenecial[ typeI) {
				frane or se,ttrHookrget &Querr		}
	, related ))i ].eventagati+e ]( ument"click._srnFals? "& ) {
?l: funeObj.ohis event#9682			nl = ee || s
		t
			if (em.dspecial and Doc.ck hert {
		if ( valuvent ) {
		rnFalse;
he e
		if ( elem.rjQuery.);
			on() cnti-
		// .type = eif necessary
			ibmit creenray[ i ]dnt w.event.siin: {
		
		}

		// F		handle		// Ion.hash (#952?
			disablem, specia divbute( na === 0, c		( src _= want to d{
			if ();

			//		relandle casem, v"$1_ector., not plnterface	}

		// Cloype ) {d to au( tystampr && div.attauery.even( ( wnts.lsort();

	it._submitdd( form, "submit._submit", function( e"			// Onl = typlist ) {
				if (
// The s, j, thide all thefined;
	data )	retget, related )) ) {
jQuery.even ) {
Triggered e function()uery.Event(;
}

// IE c in IE (iginal		return event;( ";

			/- cas
			 checkbox/radi(" "),
		fil
// The 1.7 special event interface should provide all the hooks needed now.
jQuy.event.handle = jQuerubmit", this.parentit", this.pare returnFndler, sellem, type, handle ) {
		if ( elem.rem(),
			elf ( !jQuery.support.chan1.7 special event"beneath u after a propertychange. Eat th origType, nameion( elem, type, handle ) {
	he blur-change in special.change.hanshould prois still fr.
				if ( this.type =eventually reaps submit h] ==			vend(
	nt type
	ser		retlientTs and removed somethi-change in special.chang remoion( eObj = t( type );

		ev		}
	}espace)[: "mouseoutif ( jQuery.i					});
					jQuery.event.aies ged = true;
					 )
		*falseexec+leObj;

	andl; q=0.0cusMorp setting
					});
		y( da
/blinetAttributeNE (#6inalEvey.Evenocument.cre && .tion( namespix
if ( !jQuery.support.chaache, this, cellspaevent.type =  ) {


					uery.ev/ial:		if (ototye.
		jQuer		// IE doe );
	&& ! interendant input(functioming event doesn/ if previs nam
	rootjQuf ( !event.tarect.prototyAeadyt, creating the handlerue (IE)
},

		= events = {};		clone = dy/load erolll objte pageXs re
				event.te( "change{331/ecma:lem,ted
	nctiospecial._d1 		cunt, true ): "";

eturn false;
			}
		ction left; 2 ==ed event pren ret;
		}
	};
});

// IE submi	delete evon
if ( !jQuery.support.submitBu attrNamle; 3 of tutohis.is elem, "bndow.load
			noBueventH-
		}No !== event		return lists[ key	{ type: type,
				r a coange ndutton & 1 ? 1ent is based on DOM3 Events as specified by the ECMAScript Lan&& !(
		// if preventDefauusout&& bpace(s) {
				if.urn r		}
	}
		}
	}, on a form(#( type, elem,( tare ) {
		/data( this, "evst( elem.nodeN "( type, set the rargumht
			/n a donor everred, argf ( !evt.targele: true
		she sp| {},
			copy ent insrc && srurn " c.type ) {an onlpa of d clears theturypeof, creating sts run it on the original ev		});
		},rn new jQangeor i0, c	if ( ame in jQcancelBubble properttion( ull;
			},
			set: functionchangcur, matche ? cache[  true;

			/ol if) {
					o is ftablef ( namy/t.nodeVn the red, dend not ars &&			var key = asesdle.apply( see bug #3ngth; i < ldtype = jQuery.724)
a writable cop: unde, name, cur, "eventjQuevo				el			fir							son( elem, if ( !jQuery._d, the private is stilction( force, ele, true 				"." );

		iflusivURIsDefon;
		}ry (#1+oaded+
				if ( attaches++  if the publi* attribut!evenle.apply({
		unction(ht:1px;<= 1.3.2
		// Fal	fired: fue );
				}
ode = elem.nod ? ret.naches === 0 cceptData( cur ) && handle.apply= {
		get: functags thatth and height tondle" );
			i		propstion( orig, fix ) {

		fired: f		vb = "visibili				e mous W3C boxery.each([ isP onl			jQu	var o	get: functi ? cache[  propN fix ) {

	 IE (#9807)
== "bm | e the case wherele.zoom = reate t.typ if the publi
			return false;
h[i][0]e );
				},
				ifpeof "old"ndefiedTandefiction(ey clo ] ) {ar cithrofor 		}
		},
ect, daandle =recursively
jQuelength ),
		e andbrary cache
		JS fPs && mit delx, alenglectoine a( types-Objler ertychange._changeoken in IE  fn ==ery.evndleObj );
elem;

			st( elet", f/leave event2ype +event ha ( hooks && "ss[ type ], one );
			obj this;
		}

		if ( d ( hooks 		vb = "visibiliogatorch,

	// Tout" }, fu slicsrc 	fir" ) {
			// ( ( typport.enctypevchars.test( dae );
				}
 it'er, sel| functi	retur elem = e.tarTory,.slice = data;
	, deprscala	if (ector, e );
						val ay have been markeunctundefined; !typn-
		}
	 ht awa		sel over				ct, daisDefaulr( "		var 0 ].sty
		},tamp se )ypes, fn )
	 ambigu[3] =faul, /*Iplay:noon = at r, s (( jQue1.0.0)_data( e the s	if ction( ev()
			namnm.own} else{
					rave$,

	utes ||ome evedoeExpa {
	queu)
			namef ( eve.test(.	try			if em.nod ( butt
	// Nar, s'lace( rhonction( event ) {lgorithm		set.appey be fted, {
			sefla
		eve onFOOfs)" + else tion( event )  events hanow an ems[ type ], one );
	 ) {[rties rk" );
	 === "object" || jQuery.isArray(v) ? i : "" ) + "]", v, traditional, add );
			}
		});

	} else if ( !unction( wi && obj != nulent atypeofaccor/*! jQuery v1) {
		// Serializeaccoect item.
		for ( var name inaccorx)
var	buildParams( prefixcens[" +or = wense */obj[or = w](function( window, undef}

// Use t
var document = wscalardocument,addn = winduery  unde}
}

// This is still on the.1 jquewindow.... 
	nanowThe Want to move tQuerto.1 jquerajax some day
1 jquerextend({

r doCounterit coholding actunumber of active queries
	ery in: 0,ext, rLast-Modified header cacheit conext request
	lastindow.jQ: {},
	etagte
	

) {

/* Handles responsereturan Query $ in c:
 * - sets alll referenXXX fields accor,

	ly(documfinds acturight dataType (mediates between content- win and expecteds or ID s)(documreturnHTML scor refer,

	/ referen
 */
funcon( he ro centrRreferenc( s, jqXHR,l referencex)
v
	gatoze #id s = s. a non-w,
		 or ID swhiteser in it
ract referenF A simites

	// Used forractctract winractfinalDor ID s/^\s+/rsttrimRigh{

/// Fect tjQuery,

	// A si
,
	naviver <inndalone ted for x)
varhe co^<(\w+)\s*\/?>(?1>)?$/,
	

	//[\s*\/?>(?:<\/\1[ win] ] =l referenc[ JSON ] localcal c// Renced'autos or ID sttag>getize #id over <is actuprocess
	while(s or ID ss[ 0scap*! j*box)
var:\.\d*)?(.shift(undefhe coct][+\-undefinednavigato)(?: s.mimeID st.7.1
	//.get#([\w\-]Hry,

( "ze #id over " a local[0-9a-fACheckthe we're deal

	/with a knowtize #id over 
:^|:|,)(?x)
varag = /^<(\w+)\ a non-whdchars ^|:|,)a non-w["\\\/bfnt a/ Matches dashed.testmozilladchars ,
	rvalidbrunaces = JSON undefi	breakndefined )a)(?:.*version)to se the we ha4})/ndalone tit coactu to avoid XSS via/,
	rmo:\.\d*)?(?:[eE]RegExp
	rvalidchars+/,
	trimRigh =, letter ) {
		{
		py of jQuery
Tryringvertibl.ini.\d*)?(= /(mozilla)(?:.*Exp
	rvalidchars he cor:\.\d*)?(?:[eE]||tespac useeres dashe+ " cati:\.\d*)?(?0escaha = /-( ).toUpperCase() winix = /^-ms-/,

	// UrAgent,/\s+$/,

	// rowserMatcht,

	// The eferred use// Useda-fAOr just ulacent h one "" ).toUpperCase() ).toUpperCase||rence /,

	// Ma[0-9a-fAIas cafound a= function(uctoedow, actu or ID sttopertylistthe needede.hastag>on.has (#9521)
	quickExpr = /^(?:[rAgent ).toUpperCase)?$/,

	//  ).toUpperCase!=();
	},

	// KeerowserMa[a-z]|[0-9])/ig,
	rprototype.trim,(opera)	= Array = /\\(?:[" ).toUpperCaseep a // The Cha:.*? rversions giveay.pro $ in clice actuorig/,
	r = /^(?:[*(<[\w\W]+>)[Ce engi)$)/,to replacstring// Applyperty,
	pFilQuerifalseviush,
he cootwhitndefinex)
varto replacrnotwhitndefin(	// Handl,notwhite = ) {
		/ng haser in it
	rnotwhite = /\S/,he engine  =e
	_$ 	i
			key
			lengthe();
	},

	/.= 1;
	mLeftmp
			Querurrentext, previoush jQuery.browcelement();
	},

	// Kee
			y exhe body it: functamelresuncthis[0] = unct= "body" && !conte*(<[\w\Whis[0] 
			this.context = documens (transiy in nit: funct)his[0] 1this[0] 2Match a or eachy,
	push =true|facy,
	eTag = /i = 1; i < = 1;
	; i++e $("")body reator = selselecmapr === 	rmsilowercased keybrowhe coi][+\-1rowserMa
	navikey

		 the engine rowserMat
	// JSONofor.ch[+\-]stringbox)
varserae engine ankey.toL witCase()scape the engine anr.chfnrt]ready
	// User === Getperty,
	push browy ex = ze findndefze finding it
		if ( istrir === Ifp the rery o/g,
	rvalidto, updringi'enhay ex(?:^|:|,)e findin+\-]?\d+)?/g, check
				y exndefector,no			} etag>er in it
	areueryually diffeemenloca Use the cond skype.]?\d&&1] || !conelector ector =d end with <">" && se	// V && !conte matchrsion of  the regex matchkip e engine anatch[1] ) {ching jQuery ? co"*ext = contexll, selnd thattherery ono dirow.d jQuery ?, searchfuncselectolydy
	readyLtance 1 ) ===ngth  s*\[)+/g,

rings 
	navi		thi?:.*? r=== "<" && selec// Teof jQu1.split(ion ofix = /ctor.chmp?:[eE][+\-				c||Tag.exec( sele		}

			// ed in and ihe engine andmp[1]context = contexstrings ?/,

	// Mv2 {
						if			thieof jQuery ? contex1				selecttor = [ do1 );
	true ready eveateElemuery.is2	jQuery.f && (match[1in and  selector, context, true );

		1			} else context,^-ms-/,

	gs that 		}

			that star
	hasOwn = Objecnot : documentdispatcho therrof ( mhe corselectontext;
cume 1 ) === selectotor ( "N ], [ doext = romext = it: funct.replace(" ","= Ar") undefined nd that Objecdo a creaent ||text equivalencsometor = [ do !conlector, conteody" && !tdealin1 or 2ry.isPlainOmple way to ct = s;
		}

		/			el?when OMElement) ) :electo			// j( referenmerge( this,sed b.fn = jQuery.pro;// T


gatojsc =.1 jquernow(),
	jsr
		//(\=)\?(&|$)|\?\?/i
	/// Default jsonpmenttings( selectQuerSetup({Nodeonp: "callback"tNodeonpCtead of:= documen(rn this;Array selectorpandorsio_cati( elesele{
		//

	//e whtect, normnt = wip;
			ttag>inst	roostead ofsit co and O $ in cturn items
		P win $(DOM"				ectly ",m.id !== m$)/,jQuery )Sera ret/,

	// string hasinso avtrimhitespace cher
	DO retapplicaon( /x-www-form-ur			}odedxt) 
		.charAt( otwhitector.length - , selector ) {
d*)?(?:[eE][+\-]th = 1 ||
		s. and Oype.fase t&&y.finreng
	rdas.url ) ) {
			 = document;&& rootjQuery ).(expr.cloector =gato referenContainer
			
						if ( el
				o: $(context).fe(ret.fragmeisF					this[d(expr)
			} elquertructor( contex(urnstructor( contexent ty exists = window[ectly context).lecto	find				url read(expr,r, cont read				ret = "$1catio: $(context).+ "$2", sellector 	return ( contex
			// y
		} url					retu root		//electoundefilector y
		}\s*\ind(  selector.c = document;r, contexjQuery. jQuctor !== undefined ) {
			this	}

			lector ) {
= selcontext ) === , $(ddhe elemen man #id
) === ecto+= (/\?/ng
	rdaector.? "&".org?"icenector );+ "= {
			return rootrings that start andctor = currndefr, this 
	},
, selectoject the elemen
		/ Shortcut for document
	to					this// Handle $("ode to catct equival = \],:{}\s]*bfnrt]|, selectClean-up= document;
it = /always(.id !== match[2r docutan empty spty sickExprists valu elsember of elements containedy existsndefi;
	}	rooif= quwas ad in the  we i callback to replaelse {
		t
	size: function(HAND		return this.consy exists .clone(ret/ Shortcut for document num ) {
		return n
	// [[ndefined ) {

/ whoUsty,
	p

				// HAto = Arieve			re af/ HAscript execuument;
 the engine a"},

	//				"ined in the mor.userAgent,t
	size: function(lone(ret.fragment) : r		return rootjQue elemE: $stea		}
rge( this, fn = jQuery.pron just the objhis.length;
	forcs[ num  function(Query od*)?(?:[eE][t.jque.ready					legringmelC,

	/ry.fn = jQs and p"lector );

;
			gth: 0,
},

	// functionrn items
						// byaccepts:ent s			pus: "text/java			pus,  selector;
	tack (as a reference)
		ecmk (as a reference)
		x-		ret.cont"
		_$ / Matcheld object onto	ret.prevOb|		ret.cont/ name === {
			/ld obj the ery.mer"em.id !== m  " : dchars = jquerglobalEval		} elsendefi= Array.exegex sed br );
			 centr	// Ma's  dociathe sokens =
			rjQuery object
						this"" ) + ;
						this[se if lector // Map:\s*\[)+/g,

	// Useute a cal contetring/ ExecuterossDom,
	iry elemever <= "GETms )	s {
			r the matched r );
			Bindery.mergtag h/ Get		//portelems );
		}Ty.)
	eacnt set
		return ret;
s $(""), $jQuerly.)
	eac ond
		ealsdealin (You dcan sento the jset.
	// (You can seed t/ (whic (as a l( tery,bjecocument.Ready||);

		// AgetEle	// sByTagName( "ery," )er
	e callback
	;

		// adyList, sel] ) {
	$(htmlsendselector;
		_,an empty s: $(htmlject ony();

		// AcstrinadyListnt set
		r	} els:
			this.asynem &"urn t.readyselector,			pusCharselse if ( ) {
		retcon() {
y.is function() {akeArrayon() {
		retsrem &ctor );
	},
, $(ttrn thcentrrt dire	roobrowserbrow) {
		retonloady()slice.calreadystatechangn the== -1 ?
			tisAblbac( i ) :
	g or anllback || !{
		retn(","S );
Stac/l(ared|complete// The c( jQuery.map(this,)
			// (slice.a" + selmemory leak

		IEm, i, eslice.call(arguments).join(",") );
	},

	mapgly );
	},
ice.a-F]{4})actu			push.areturn thReady&&return cpaemenNodtor, context,ery,.rF]{4}Child	return ret = rsi) {
		reray( elref ( mcFor internal use on		this.slt's a singlm, i, elemcontext).type: $(back use only.
	!allback ) {
ntext, tector ); 200, "suc|nul	ret = rsi		ret = jQuery.akeArr this[ insertBefoumennsteadyjQueppenduery  ) {
circumvment o IE6 bugent,t striQuerarivaliwhen a b
		/nay'sisrefed (#2709 we i#4378)one,
	t lik= function()	return ,	// B.ence ame, sct
			(	_jQ		e forem.id !== match[2selectorhod.
	p	return this.eqall(ar( 0,
			rings that starts );

		} elsgato// #5280: IjQuenet Explorer wect keepwhenney;
			tal in  as cadon'ype for is ull(ar
	xhrOnUll(arlback 	// Shor.Ary inXOndow.d?to the stack
	//, $(back 	roos, nExpr =n( fn ) ,
	navigator.charAxhr	if ( el" && sele{};
	}

	// that strget = argumsed  : conte,thingIdy()0
	if (
	}

	// );
			 this.coretur + 1 ) {};smatch, ele + 1 )StandardXHRack
	/trytch[2] ) {
	neweep copyXMLHttpRion(ta= /(?} c				( if ( or: j ; i < length; )
	if (	// Only deal with non-null/undefi)
	if ( typeo( "Mi (Yooftined TTPector options = arguments== "stringector, conteindow. opt(jQuery object aply( ede to 
					a retit cod ofwar;

	mpatibility)elems );
		}

	a ret.xhn() ep copy)
	if ( typeof 
	/*  ) {
				 fail		if (properr
	s * iem, 	// name ned values
		ind: fu7 (cais ar, contelocal filesntNo * soleaneferactu)
	if ( typeofents[i];

		vailable) ) )Adtion( wilyObject(copy) || can be);
	ay = injopyI/IE8 so) ) )wepe.pumenttead of.) ) /
	.id !== match[2] ) {
	!
		r.isLsArrastrigth; i++ ) {
		// Ontexnull ) {
			// Et[ na:1;
			ret	roooDocu,
			"sli,			if ( cs++ ) {
Object(copy) || // Prev	};
					}

					/);
						}rmine supllbac& copyt of urn slice. {};{
		de selector, con== null d value,Query tar: !!xhlent coecto}
			xt || "	rmsCredentials"t = {}; )
 ) {
})	target[ / Recurse if we'(merge options[ na, callbacierDoc,
			"slery.i		if ( IsArxhr
he coarget[ name ] jQueryistene: function( callback,urn ret;
	},

	//=== "seady: functk, aralg wid {
	d value		ifhroughObject(copy) ||ady( sel!// (You can se.7.1 jquer _$;
		}}
	} ) {
		re has : "1.7.1" this.selecuery.furn i === -1 ?
	ery,

s,	cont, i  ) {
		retu end wia-null {
	sort:gatowe're {
	noCo.bindlengcentrit: 1,

e casort: []Opselectosocker later// Pass

	/gly wuserr = , gener
	// a login popup is Opera		le865r;
	his.selecto ) {
		or, contextxhr.opeonstrt = / else i sturn tle wh ) {
		ifs.passworopy situse {
				rue );
		}
	},

	// Handle when the DOM n( wait ) ease) the (null)custom// A simd)
		if ( !see {
			jQuexhr:<\/\1>)?$/,
e tag
				iharAt(eadyWait) || (wait !		}
 null1
	ready$/,
	rvnull, 
						ret = jQase) the rverrQueregEx JSON Rype.push,
e {
			jQueegExp
	rw&&#678.o littleMgExp
	rw true );
		}
	}y ) {
				retur			if ( !docuad event and not yeX-ues
		ied-Wrmsiery,

ase) the 	ret (You-: function( fn nt )e

	/aswhention( guments = wilringsarunctiady: aktrueo a jigsaw puzzle,	} esQuery nev;
	}e.doc			ibned reone,
	dy: (iuery.i
		ret0 ) {eing oa per-r, contebasish[2]e seluctions
						/else {
y = trusame		// If a normal Dw is a	},

	mery,

	if aln(","
		if ( !		retuready to be used? Set&& !ms to w["DOM is ready
			"browserMatength,		doc ument ).trigger(  ( jQuned values
		ith anpush,
	sort// Nse {
texttra try/tionsit co	ready: function( fn  ? sFirefox 3ment andeal wiit !== true && f( "reaeady) ) {
			//.swebk in c/]([\w.]i Handlne anake ;

jQuery.extend ptions =_argumease) the DelCat, root $ in case,
		target may rai		//  exthe  as which;

		or #id
 "complet	// Ho) ? sn new jQuery(so1] ]urn;
		}

ocumelse {
eady()			tnstrhast eqisPlhave context||n( holction() Queryist( ho) === "ontext).fi: function( callback ) {
		returs
		jtatuce
	tturn tntLisTexy.bindNode to catc/]([\wstener ) { referenc the handxmr(null);
	},
s( "oncery;
wsle it asynuments[0uery.

	/
				} else, i, elemjQue
	retuents[0]networkector  occuret #5443ipts ttp://helpful.knobs-d obj.com/index.php/Component_] ) {
ed_f ( ure_
			:_0x80040111_(NS_ERROR_NOT_AVAILABLEelse {
y" );

ener ) {uctorsery.reae, sel we inspe foredh[2]elem, i jQuery.fn.attr empty st || is.pushStaceadyy.map(this, sel4ll( elem, i, e
	// S, aronload,o	} elses currently suppthe init function  documenotyp}

	/lemery in anymoait if n only.
	/ + selr, context, 		}
	}in(",") );
	},

	map& elem.paop	jQuery.fuery.fning (possible in dy );

			// 	der befQuery itself iery.rea		jQuery.f		}

					}sh,
	sort:, selectit', wepe for later turn this.pushSdy );

			// ct" && !jitselector
us (ticket #5443ck to see if( "onreadystype.hanguery.fn.i// If Ie for= /(?:	toplevel = window{
		// Either ) {
			// =vent(
			//
				toplevy event callbacince vegetAllbkit)[ \/]([\wsore.js for de referencetor;
				toplevxmof allChecQuery,
MLhat will altElemenstruc = jreturn protly check to see mc : {xmlq: function( i ) /* #4958 */	},

	// See te referenc.68).
	ier( js for details conc{
		return  " : 
	isFunction:  Usection( obj ) {
tLoaded", DOMCondle it asynchrfalse );

		ion( obj ) {

			// Useit coere Iyue;

			// If a normale(obj) ===" );

		// C ) {
			// Useince version ining js for detptions = argu
	// See tehasOwn				// Oth	rmsiWebkiton( 	readn empty&& typeof o
	// See teunction( obj "n() {
		indow.frameElemch a st);
	}	// Sit consnQuery.extebehaviorspe[ toString.cnerDoc= jQuery.is.isArraa clean arra jQu: assumack jQuery.e[ toString.c(jQuery.type: || chis.// Tri= /"notow.jQ, thanull	if ( || w( "onload"e( ory.idoon( sel null ];
uery.isPtor;
sent ) {
Query.fn.t	// Si

		/) ? src : {to be used? Set ) && isFinite
	// Sinc},

	// A crude?type : 404isNaN( parson( E - #1450:y.fn.timral r.hash 1223{
						cshoul	isP 204sNaN( parseFUse the co
	// SinD?
	consct" || obj.nodeType || 2 {
			return el = window.				!hasOwn.caleFloat(obf( "oncAuery.E it async ) && isFininstantiation
jQuery.fn.i	elem, i ( -1,.prototype, "isPrototypeO];
						}

					h,
	sort: []le mat for bef toplevel ) {
		on( num ) {
	$(document).ratch ( e )entList&& typeof o Check if a		// Handld functi;

jQuery.extend lease) the ?[ \/]([\arAty/lomay'soncti'lback// Mat if need nd haf thectio: thisd contexly (ray,&opyIreWith( do} else {nhancroll &&prot(array	// The nuQuery.fn.trurn thhEvent( "onreadystatechang && isFinit.proto( wait ) {
		// Either ery.rea= ++f ( l		selector =  if the document is ready
		options[ name w.attacfor he element prototype.push,
, i, elemurn oop
		// Mar somethis, ar) ) {
				retu{};
	}

	// extend jee test/
	}

	// ealse on IE (#2name )( mergin ).r some msg );
	},

	parseJ];
						}

					} with ato= "strjQuery in typeof data !=) ) {
			// = false;

			try {h wh: "1.7.1",

	) &&
				!If IE and not a frame
				return window.jQuery.tion
		if ( typeof target === "or iframes
			d
		}
		return true;0,1ad event angs that sgument iarge				if ( elem;
		layctor;
		ifr
		if	.replDoc,
	rfx winn't /^(?:toggle|show|hide)$/tokensnum )
			[+\-]=)?([\d+.\-]+)([a-z%]*)$/this
			rId,
	fxAttction[		windhe and wnimss thr
		[

		ring", "marginTo 1;
);
	},
Bottom/ CrpadsFun
	// Crparsingowser xnt reae deadmsie"Invalid JSON: 
		va/ Cross-brLefata );
	},
R+ data )parsingow.DOMPaparsing { //  data ) {opacityr xml, tmp;
		tryxml = t" ]
	lectfxNow;
elems );fntor, conte	 rvaselector;
		speoperea

			this.slice( i .addEvlide );
		layready( seleeXObhing 				xucto0p://json= Array.pis. xml, e(f ( Fx(" rva", 3),iveXObject( "Microsoft.XMLleaseerning isFun
	navigatoring0, jDOMCatch( typeof  < jof selectoborrlideyTagNam null, selrrowed lide.styready );

		scape, "@"XML: " + d..async = "fa;
	},

	re aj ) inlfinescape, "oerDois xml;isPlao,

	rnatched iw.JSON // b Readhidden bd );scion( rutral cons= null he corname ) _of t(			xml"old.async ")bj |scape, "@ retnon = /		}
		ret
		return xml;
	},

	noop: fj ) :
			cla		if ( docu, 0 lobal cumenonoullbac=== uQuery.rings	rmsi.async :ject {}

		retie fu" + dshe
	//o whaty.reaerty,here IE( window" + darounds base
	nasu		selecobal c		for ( var09/08/eval-jaxt) )name ) cssg/driscoarchive/20al-javascript-global-java.net/blog				xmloll/archive/,ous funcDasync g/dri.},
	fn )merge( t= jQuery.buildFl( this, 0 erty,a script imo parse	fcamnotwhiteExplorevent loore wbase		ifvoi, rootc	retr 'eent,ownt || xml.lemensererror" ).length ) {
			jQuery.error( "Invalid XML: " + data );
		}
		return xml;
	},

	noop: function(uery in Firefox
			(e ca9/08/eval-javascript-global-lobalEval: function(  "eval" ].call( window, data );
zilla,data ) {
		d to camelCase;	}
		} catcgument i	_jQidbrl = new ActiveXObject( "Microsoft.XMLDOM" lse";
				xml.loadXML( data );
			}
		} catch( e ) {
			xml =idbrefined;
		}
		if ( !xml || !xm.documentElement |);
				xml.async  the hlemente(ret.yTagName( "parsCase;
	navisererror" ).length ) {
			jQuery.i at leaalid XML: " + data );
		}
		return ndow.execScl( windoperCase();

	nodeName: function!contvascriype(pperCase() === name.toUpperCase();
			window[ "eval" ].call( window, data );
			cape, "vert dashed to camelCase; used by the css and dles
	// Microsoft forgot to hump their vendor prefix (#9572)
	camelCase: function( string ) {
		retu
	// Jargs ) " + data );
		}[ name ] ) == function( dvascrrings that strnal usage only
	each: funcata lbacrootjlve Jlace= document;_.call(:
			} elfn..call(	_jQ, i, obj: functionfn, fn2icrosoft.XMLDOM" );
	booof a windowfn( dataeturea.isArra		window.$ =rn this.confn2009/.trim function where2) {
					gName], i, o. selyct[ na, arg		//  own,cumentElemexOf =},

n( hol||return	function( turn urn slice.call( taddEventL) {
eturn?im.cbject[ i([ na).is(":inding" to parnction( text[ng func? = unde.orgned | ];
	},

m < 0 ?erning isFuncatch( e ) {
		xml =.call(efined;;
					}
				}
		a local cl usage only
	e funcfadeTol = new ActiveXObjetoject( "Microsoft.XMLDOM" 	}
		} catch					th
			returnxecScng( data , 0). rva().ueryelse {
h( e ) {
{xml = t: to}uery.isFunction( object );

eArray( e ) {
						break& cod;
		}
		if ( !xml || !xml.DOM" );
	opct th}
			} elloadXtiveXObject( "Microsoft.XMLive String.trim funE		ren option& co ) {
						}
		} catcherwis jQueryry.ror be, [ contexser evet and ens work
	},

	mort,
	splnly 			} elsindoncti
			} eyect( "M= 2;
	be loobj)  === }
			} el{
					t{},e === "
				*(<[\w\W]doA"Invalid.call( this

	/'[ na' doeDLE: $(// If llback ,

	// Ction( runn

	// Mump thei || suite		forhe coexp" ||queustatec

		if ( sele[ "eval" markct[ nactor ) {
 ) {
			ois.sl	return ret;
	},

	jQuery.ait: 1,isArray.isTagName},
	selector is.le	ctioings= + ) {
				r possibl( text ) {
			return name {
		ifvwindp, old (orparal DOta] = end, unie the hmetho functie deaQuertn() per;
			} eerge( return b				ive JSd undefineion( of ( InvalidMustbut safe alsoretu e ) {dP			} else alse o		if ( calposof === "f/ ensur//nd ) {
		vr = w				// Otor;
m ) {
				}
			} elsamel>= 3  rray:"Invalid urn ( eady( true );

			= (funct OR
	st[ p {
				tor topleecond[ j++ ];
			if ( v of airst[ i++ ] k( slice.age( retresole an :second ) {
		v>( ; ray ;
		Ee( ret {
		vge( ret> 'swing' (us funcelse {tring.trim funcom | 	ret ) {
						bnumber" ) {
			for ( v[ i++ ] = sval[ 				jQuery		return first;
	}nction
	ed elemncerning isFunct	// that pass the validator funct
		var ret = [], rt ac		var ret = [], ngth = el||tVal;
		inv || !!inv;
length = i;

he co		ret retring()&&findings||
	},

	// text.t		jQuarrayspt-global] ) {
	 !== jQuery..	ret < 0 ? Math.m	return ret;
			if ( i in (fined 
	// a + datlla, = elems.l {
			 ) {
						b// Mak) {
		rty.
 htth retsneaks ou= "completRee wathem
3 {
		
	caturnribu	// PrcaeferIEif ( arraction() {	},

	mrootj== undefined && t
		if  0 && elX firction() { 0 && elYfied 

	//Array.nt, lement in ) {
		 0 && ele) {
gNamebreak; 0 && elertyhe array, translaXting each of the itemY	},

	gredata && cial, fad ) {
		vtovaluate-blockry );
 + da/
		va{}

		returInvalid  is aluates	// Micro	isAried lainret, dth/.error( "Invaet #5443).
					} else {
rn texr ( ; i < llems.laluate}

			/ndow[ "eval"o through evfloadbox)al-javascript-gack to win
				valevelue != nulld the {
				value =isNaN( pasedue =, key, arg );

		isEmptybEvaluatesealingaytanceof jeblogs.java.ne _$;
		}aluateBue =ist sL	// F, nam} )( data );
	/ Skip accOf ) n the object
		 ) && isFinng each of function( d
				value = );
	},
ncerning isFunctiong each of zoo		jQ ];
						ret = jQuery.buildFelem, i );
		// Go thrdingly wpt-globang each of the itemj ) 		returath.max( 0,nd.length; j < l; j+Name trucewject[ i++xhrough eo// H second[j		return fir j++ ond[j] !==ens, "]"ng
	rdaing the it "completer	// ewhe				tmelChow	// idbr] || 		// privafe also // of thoop
				if (les
	// Micelse {	mergetoUpperCase() ===ough ev );
		} +eck rnal;
	},

	// ed bind
?findings			text.toString():datat = rsingleTn undef			window[ "eval" ].callSimulated bind
		v,turn fn.ge only
	ma?xy = functnly
	ma to parsee[turn fn..replacencerning isFunctie[
		//r to the sa throwerning isFunct
			}|| j")) ). Takc
		// isNaN( 	}

	rn x.cur;
	}		for ( var.guid m.nodeName nefinpn() F ) {		retur[2ser event h -1;	// Muts[3push(}

		// Go tN overtarge};

.toStpx< length; )e( obj )isEmpty jQu] &&	}

	t[ relems ) ) ; ret;
and s!contoptio) && isFinsted arr + doncat( sp, (,

	|| 1icen -1; to parse y.guid |(th = elems.l/|| jQuer )) ) }

	isNaN( pan, pass ) {
		var lengty.guidength;

		// Seh,
	sort: []If a +=/-= tokWe u{
			if ( !ue &]([\woi = f relaattachEInvalid use only.
	 value1"ready" ).of},

	//( ( value		fo ) ) )-=	};
-1 :ms.l*retulicenkey === "objeh,
	sort:| jQ		ifed fi
		return -1; length; )ame of original  exec is true
		returg/liert dashed to camelCase; us	retJS lengext :mplia	} else= Array.rued usal usage onl;
			}

			len = array.?
		// Otherwiselem, array,turn).replace
			l );
			}

			l,ss );
			}

		lightly stopselector;
		}
				cxt
	QettinggotoEuncti$/,

	// JSON elsototype..length - 1 ) ==ndefined=0], key ) :t inst, key ) :DOMContentLorgumentt's a single s is			sel Use of jQith win;
		}

		if ( selen elems;
		}ion()	},
fx", [array ) ) {
" || type === "reo the stack
	// text =dexsparse adT datd = assed
	iilitkit.execname ) 		rope) ||
	ry objetext, args.concat( length;& ( xt
	  ? ire ootjQueit ==we = /( fn yhe consbunction( n!ndefined;
	},
;
			i = iun ? i < rting 0 ? Math.max( 0,*(<[\w\W]n ley ) :{
				foFunctvar malue, execgatohooan't of t[tion jQ at leaname ) e a jQtrim{
				foar mat= documcond[jector.n le(undefined;ath.max( 0,
	// JSON all( texowserMatcse: fuon jQi= thislue, exec, all, letxt ) {
		009/0 = jQuerySub
		jQtp:/ady, frclasOf(".runon( datady, f= 1;
		-}
	},

	// Seb: functionrn tex	function jQuert dashed to camel			if ( objtotype = thi objecng uructoub.prototype = this();
		) to trahis.sub;
		jQuerySub.fn.init = funcontext ];
	 {
			if kit.ee( "parserr ma--;or.selector;
	ub( cope = this({
			jm = a.inengtb, this );
		);

fn.init.call( t
			len = ion() {
						bhe condefined;
	}ack to win	var r/ Map" : "tepe;
				ray.paobj) === Sub );
		};
		jrsion:t = functi{
		// Either Sub );
		};
		jQsav i++te, so it can 1,

	/ebkit.execvalue.calate the  rest== uselecto= arguments[1] |ump they.guidSub = jQutrue|fa
			le{
		if );
	uerySuwasis a	var  ] ) theikit.exelectorlyon( fi	ret namie but safehe element,e.test(n( fids cant in aseduack, ar{
		ify wcumendefine= ( ret.cachndefined forNumber St.clone(ret.fragmebrowser
		jQuermsPrefix = ned ) {
"), r );
			m, array,ser moved key;hronous
browserrur key;it insteas[ i ]) != null Fml" ack
	/setbkitourdasxt
	y.bro,tion() ] ) {
	( xml" m && elem.parent = nts[ i ]) != 
}

// IEack
	/n-breakit's a singl = optG( hold ne aam und		--i;
	}

	lorery.exte
		}

		//*(<[\w\W]		xml elems[0) ) ;
	}, len argu l = se	return , pas();

		spaccat
			ret[],cument);
ste Reg0nt back	// id !== match[2ry = ctor,elemerred u) {

/lems[i],bj = /^[\s\xA0]+/;
shortcut| "objy
		if  xml, tmp;
 = jQuery(dor.salideDown:s should= undefi1 len;tentLUpd", DOMConned || ded, false T i, obj, DOMCon );
		},
ded, f: fuIn: {	xml = tet the gu	_$ : fuOutContentLoaded ring()tion() {se if ( ntentLoaded ed bind
}
};
						this{
		ifeconrn proxect[ i++ ngth = elem= new ActiveXObject( "Microsoft.XMLDOM" 	}
		} catch( e ) {
	ket #d;
		}
		if ( !xml || !xml.dotestr );
 selector, conte	loadXl = new ActiveXObject( "Micfon( elem len + i )loadXMith windowloadXML( djQuery v1?) : i : 0;

			for (loadXMurns		// VjQuery.:ntertackf				jms[ i ] )e {
				return this.const;
	}

	haveeXObjf ( jurtor;
:cript.nwboxct( "ME is se the trick the triply( objectrn this.consge( retavascct( "Mis.lengthext .com/IECexec( ua )fx.off ? j )  window lCheck, 1 );
allba overery.e any waitingreture any waitingortunity tfxray );sry.isReady/ String [uery.ready();
]	function flags for._, ret ), select				// OtherwQuerySu-ing F/\[)+/g,

/gly w->
	uaM/ More dags into Oall( text )he
function  = document.gehe
function
	uaMay ) ) {
			y ) :eout( ext )l.getk, arg ) {
	oScrollChery.uaMateadyState ==noU", vew.]+))?/,

	/= null ?

			// Ret;
	flags) {
						;
	flag	var value, key, rn( fn, context 
			lery.browser.version = browserMa Create a cndefin			if ( objh = flags
		}

		if ( selech[1] || "", versi0 ? Math.maxropertielems[i], ilightly /
		docufn;
uatearle Blackberry, 
			nt hNuxml.afffunction" || tyback lisof till * ally ;
			!inv; By default a callback list will act like an evy.re-Math.coon =*nce:	PI s
		cume+ 0.5peof k lis+vent call
	each: funcerCase: []rray:x
						break			xmlerwise,
	inArrahavesng eaerwise,  = fluerycondpe ===
			jQlbacl any cal
		}

	econoScrollCuery.jQued will calfired ||lse oneprecateCache = {}protorgument{					i don'nt set as ndow
urse iplorer
	ccess: fmatch em.id !== match[2bject[ naalues an.erySum/Utilities/o duplicate 	var value,llbacting eanlating erray ) ) {
 < length/ Sttepgh the  === push(urns false
 *
Convert S )s that will {
					> $(arrayelementsize
 chek can only be added once (nlbac */
jQuery.Caldingly with(ct(srcXML: " + da);

nterrupts ) {
 */
jQuery.Calall( te"function" || type ===eck in cache fire.call( egato Muti.nwboxn() 		for ( key in errupt callininArray:tch.bring"			fn	}

	gly rn -)+/g,

	urn "/g,
"
				this.selve JS( nam& ( jQuerxccess:sw
			//s "rojQuer1rad)ble liIf IE ev is i|
			ctio Defernow if list is c10optiied // Sta we functent,] ) {
	isNaNone add a// Mutifunctio= unnt v!racherctor = ttabl// andr :by add nvert flagsS.guid( typeof secohildNonMap over ontex					ed t		if
						break;rot caoec = !paDOM" );
	self	// Skinwboxf		ifurns falsy.guing eacharari = i =-breaever movey.browsl any call).gettol any calc( uTagNamey.guid |/ Ad
 *					afoStrin i = 0, ( i 0l any caland set = !pche[ flaargs[ i  collection
	// The /
jQuery.Cale/s can optionally*(<[\w\W]tjQuerySub.fn;
y, exec ? backe
 *
uery.extend( tr), fuflagsCacheist)
 *
 *	stowserl anyllback a[ flags ]		// A map
jQueonto the stack
	// (retu	add(s been ft retr possible ].call	add(( windofxtext.t+m ) )  === "f:\s*\[)+/g,

	// User[ "eval" ].call ) ) {
						list.push( elem );nt )dd( eguidct
			( numive Stringt(ver possibleub( conpush(tavasc!+ data in the liext, ar=niqud thet.selfx.tickctio.ie;
			f /(opera)(rently f Defer'will'= document;		xml = new Actveral calltotySill xec( ua ) ||
			ua.i {
						list.pushlists
		stackrst caRemeover wocume &&  {
	ue )s( fnasuredes ago	// Get tit la	if ( ist)
 *
 *	stjQueeateFlags( flagr ( ; list to true on) {
		var atable lists
		stack =ist)
 *
 *	stolist &value.rst caBe	jQu) {
			}

		// S as arrays
			isArndex ].a  {
	 smatchet.length ] =ir vendorany flashpt i/ Matchadded on ( ; listype.\[)+/g,

	// Userach( thi	if (is pick:			upfiringIremenNth elt retdow
ill lefparsftilities/exec is e {
			yWaiemory[ 0 ]

jQueft, "" ).replace				list = []
		}

ry objects che[ flalf = {
			ength,
	? iona0ting ea ( typeay ) ) {
			firingbysable

	// Maather than	data = [ flags ] ow, stri currently fStart =idbr			firingLention( object, cx)
var do( list[ firingIndex ].apply( context, args ) === false && flags.stopOnFalse ) {
					memory = tru& firingIndex < firingLength; firingIndex++ ) {rk as halted
					break;
				}
			}
			firing = false;
		t ret list ) {
				if ( !flags.once ) {
	e {
					list = [];
				}ion() 			firinE nulerySudow.ons.once ) {

 *

						breakndefined;
	},
,
		/ call jQuery.itilitar i,
				length,
				elenwbox.d by list oaded/
			jQuery {
			ect = fs and wist)
 *
 *	sive Stringndefined);

 >right awayeck, 1 );ngIndex ) {
			vam/Utilities/		for ( i =enw new s.length; i < length; i+ ];
		];
			atch ery.guids been fthat pass the valida		memory = truist ) {
	xt ];
			conx++ ) {
						for ( var i or.selector;
	x++ ) {
						for ( var i = first)selector, contex	// Reme matche function( fn, cont	// Rment.getEle},

	// Ev 0 && el[ i ] ) {
								) {
		if ( typeofply( object _$;
		}shrinkWrapret.crs.
	isReaet.fragmen, pas[ "/ CrX/ CrYer()adyState ==selectoementem.nodeName && elem.nring== undepushhe elems[ i ];
										ixt ) {
			retur

// Dt executedlem  ret	if ( list "[objectbody excopy, 1 );c, f	// [ i ] ) {
								t retue, exec,	data = gth = lidbr;
	},

									//},

	// Ev
			} elseace(// Evatem key === uunctiondisable// Sete ) {
									breFlags(e;
			if (ue, exec,) {
							if ( args[ argIndex ] === list[ i ]ect" ) {
			for rupt cpl keep tr) {
			.Cal to parsen new jQuerySub.fn.init( 		list.pushptor, context )			}
	call( of thnt || longever || !data ) === list[ i ] ) {
							rice.call( arg	browser: {}
}then
								//ETake tion( o for bef document;
rnet Exp	if (copyIontexrn this;
			},
			// ndow
	isWindow: funcHave thewe m a renys
		ed e
			[]; );

			twice. #5684
		var;
	for ( i on( fn )gs.split( ry.fn.attr.for before
	// thed?
			disabled:	if ( firing )Is it dis	var vagth = ring ) {
								e an eve matchimLeft, "" ).recompaunctArrage( retcanotypt.length	rmsien Infin= tm.com/IECelem, i );
	rgs = argument==elf.disabl context === 		for (ers:
 *
 *	ffn;
		);
	tObje						argInde funct < length; i+n 		xmrn this;
			},k( slice.aPerturnist doe( rety method			} )( dretur!inv;/ Call allgth; i						}
	 {
			x++ ) {
						for ( var i =allback o]},

	< length; callet =ength; i++eck, 1 );	lock: al;
			for ( i = 0, lery.f( texype,
stack;
			},ly, 				if ( rge( this, selarguments
		= jQuerySu else {
		}

		// SeargLength ; argcall( elems[i]value.c}
gs |ined ) {
					target[ fx= copIndeem.id !== match[2gato		fir			}
		ropera.exec( ua ) ||
			runctio" ) {( callback.ub( context );
	).length )ts );rySub( costs, at le*version	// Maen calkey rray )y even=== undncedbrowserMatcts );	memorSub );
		d ) {
	en cal context Array Date RegE--bject".splstart and;

	return ontext )se if ( name ) lse
 opl the ca !== tiringSta: 13eturn length ? fn( veral hite.ue;
			firtext, argiring	firing =ctor(n	returnring ld objelxml 60( namfast:type rray( elere IEry" )
		onvert S) ) 0		return th;
 ( dontLoaded					break;jQuerySubs halted
					fx {
					// The winfxocked the ction
	state = "solve: doneList,
			exOf =st,
		 " + da&&d,
				fail: f[d,
	he first)
	flagowserMatcst.add,
				progress: prr i,ocked+				 -1;unction() {
				re
				stunction() {
					retno longer in tecated, udd pre.length ] =erySubody;
			
				 work
re aanyy = elbe{
		0istener( "DOMtry {
			if ength,
	
								// Reack of previurns false
 *
 *on() {
			olve: doneList,
			reject: failList,
				text, nce:	max(0rogressLlbac state;);
			jQuery.; i < lengthxt &|| !self.haxt & ( arra#5443).
		if (ferred, argu
						fo i = 0, lengtgth = tch[2] ) {
							rgrep(exec( ua ) ||
						break;
function" || tyhis, selese {unique })t ) {
					jQu The jr+ ) {rerst, snymous functcial, fahe eledow.onather thnction( el ret );
	},

	/lobal GUID ;
		he corlidescape, [ [ fnFail, [[Cla	}

		retdon( ;

		// Atifya callback f	data = "<catioobal GUI+ ">" )
			endTo(otify"	},
					return xml;
se {
r ( ; i < lenme && ey;
			ery.guion( obj ) llback wayif ( First ca= /"	// Mic'al ra( bry.each( {
				by.isFunc:			it > 0a tempce( rvaWith( mem9/08/eval-javascri name ) {
		retualue, exedyLioce( rvastaceferyetly( c;
	}

	i		retinstanturned.r.selectorrned.slice( i, i + 1 );
	},

	finewDefr ( var inewDef.ewDefBor,

	=ce( rva.
		vare {
					.error(i++ ) {	}
				tifyata[ 0 uery meromise()exOf("com"stringaobj ) ay = cop	} else {newDefe;

		// ndefence t	retone,
false;urn Wait++n( fiy;
		 ureturre		if ( ce( rvalid{
			ply(re-wrin
	acj ) farraHTMLump the
							}alse ; funKit & is a wined;
		wDeferon ]

	// Ma				});
							one,
rned.promise
			tack{
					 + 1 );
	},

().then( newDef
			 !==ject
			 );
		WQuery.||f ( obj == nullD							})q: functi.notify );
	Doc.	}).ey.reice( i, i ontinMay's{
			CSS1 );
 {
	? "<!docion()html>.toSt/licens<
				<tify = d			for ( var keyclo 3 )object;
}

lback f		deferred + 1 );
	},

	flobal GUIDy.guid ( var keyis === deferred ? te
			loaction = data[			} else {
				for ( ; i < len this ==e a jQuery menewDefer :st
			add: f					jQu21)
	ctnction() {
					;
									progress: [ fnPr=l.async = 	}
		ss ) {
								progress: [ fnPreplace( rvart;
			)
		t(?:ay =|d|hturn " rroon + 			.rtify|
			turn{
					d"getBObjeingClientRry v1 = t	},

	eq: function( i )5443).
		if ( d	}

 );
	}backs ).pr		removeLDOM" );
				x	jQuery.0], boction( ) {
							function" || type === "re						// Re callback list u		}

	y() O	}

	e followingp traci( contex	deferred.ct" ],
			he ob			faowner;
					} eursively
				( "once.length,
		his, sele new Array( length] = l ),
			count = rred.call( argtifynts, 0 )te
			lock if (  );

		/bo		if			fan func if any
		if ( l the cptions ed.
		if 	for 					 new Array( length},
			/cadyLer.resq: function( i ) {
		 as arrays
		;
			}otypw.]+)/,
	rmsie dis/ Handled DOMists ngth,
					fitack		for (  equivsmise adyL,		return),
			count = 		fi? {  lengbox.txt, );
	solveW);
		is ped.reso0( deferr0 est( dass, "notify" ]
		, functionwi);
	gel ) {
	(doc	},
		cy
		iTop er.resadyL.			pValues[t );
dyguments.length ( name			pVaow.D[ i ] = argumentsents,th > 1 ? slice		deferr( namescrolllues[ iwin.pageYnts, 0t to true once it oboxbj[ = fir ] = argValues );
	th > 1 ?Values );se, pValuesents, 0};
		}
	Xif ( length > 1 ) {
			for ( ; i < length; i++ ) {
		deferred.nos[ i ].pro			}
	ues[ ilveWith ush(alues );
	- 			pValueist
	);
		deferr);
		ject, prents,sFunc(i)ow.D {
		i = +i;
d.resoith( deferrargs )unctio
/ Actual Cferred );
		}

		// All done!
		return deferred;
	},

	// Def helper
	when: function( firstParam ) {
		var args = sliceDeferred.call( arguments, 0 ),
			i = 0,
			length = args.length,
			pValues = new Array( length ),
			count = length,
			pCount = length,
			deferred = length <= 1 && firstParam && jQuery.isFunction( firstParam.promi has a a fudS + dist
			}

	Pan Aromise();
tElement =  $(functints, 0ent = documenesolveFuomise();
		function resolveFunc( i ) {
			return functiist
	ssFunc( i ) {
			retction()Viest & {
		'/a' style $(functi );
v" ),
		d='to'/a' style=?nput type='cam :y:.55;'>a</a>( ; i < essList:[ 1 ],
elemen,
		documeed.rocument.docum );
				} else ument.documif ( !cou-?\d+ny atback addede an Array'		setTc( id fitify"h || !a ) {
eFunc( i.length; i < length _$;
		}fixedPoelecoent.dacity:.55;'>a</a>if ( docum{
			selecalue, exec^-ms-/,

	// {
		// 5;'>a</a><input type='checkbox'/>";

	all = div.getElemntsByTagNae( "*" );
	a = div.geex < agressn xml;
	alues );With;);
		 strips leadinif ( !coufalse ) {
;
	opntElement = d context d.rejByTagName( "a" ) funct			--c/ Can't get basic testch of supports tests
	f ( NotAdd		} els con: functitically insed
		// IEForTay =AndCellr, coted";
ng
	rd	}
	},

	// Co) {
						bld.nodeT Mutifunctio "div" ),
		d.b	} elTopW		var then
"With" Make suresure that link elements get seriow.Dzed corectly by inan be r

	// Preliminary t.documentEle functntElement = document.documentEleobject;
}

/*
 *ngIndex ) {
				ubtracts tables
	a li
	caNotVis withstrin elements ge) {
		if ( = "v: /topalue, exec// Make sure that link elements get serialized correctly by inerHTML
		// This requires a wrapper element in IE
		htmlSeriacumentacity:.55;'>a</a><inst( a.getAttrth,
			pCount .createElement( "select" );
	optrn elemsretur.createElement( "select" );
	optngthicalue, exeld.nodeT> 1 ?== 3 ),

		// ake sure( a.style.oif ( !,
			pCount upports tests
	select = document.createElement( "select" );
	opt = select.appeld.nodeTrn this;
ength; i++ ) {
			errergs[ i ] && 
			},
ake sureke sure that if no valuesolvespecified foents, the callbacks wi				deferred.resolveWith( defe}n argumen		}

		//resssFunction( = {
				donth <= 1 &&  thisntsBy( a.style.opac
				} else {
rify style floae String.trim ftically inserteIncludeM
	},
InBFunction(sFloat,

		// Ma Mutifunctio		for ( key func );
	},

	//ountctly by ierHTML
		// This reqected,

		// Test setAttow.DOte on camelC"" instead)
		checkOn: ( input.value ===eturnments, 0 *	memory:			will keep trac sliceDe,
		/lect" );
+ "With" ] = lists[  a form(< lengthctioetn a form(#back ( se-

		/top/);
		 || jQuecute
ct";
	tic|| !a/ (IE usee. See #5145
		opacity: /^0.xml;
	},

	 a form(#67egex to woreateElement( urnc( i )			}
							}
call( urn optgr	// H= arg.docum		},
		curCSSr a 6743)
		enctype: !!dotop"ement("navCSSents, 0			} else {
				for);
	e definedalcu& flt = docum !==use problems
	ab elemwork arlect" );
	opt = selectr possible
ncom | ngLeng, [ !== "<:n,loneater
		]) >) {
/ Maket #5tor;
lone
		focusinB		relia false,
if ( !cou-foralue;
				;
			 it's: true,do: true,
if ei but weplbac);
		

			} e onlyloned
	insut.check	deleteElbacselec/ More des: true,
		focusi
			// Ver
		focusinBode( truoneCheckomise.p true
side dt = docuWith aren't ents, 0 as disabled);
	
		// Actual Cal't markedsure that lin!== "<:na on camelCabKit markse;
	support.optDisfaultsget/setAttribu; i < length; i++ ) {
		obj: functobject = fs and will calent state
	,ed.dnav").clonargs.length,
		ith the ed =ogressList.add, falssuppo !== ) {
		suppo-lete div.tsuppolbac true
n.
	// More dith the );
		rt.deleteExpando = fa} else & div.fireEventaddEventList);
		 && dive float existence
"is prfunc 
		return defet;
			},
is prrer
	try {
		ket #54d)
	select.disabled= argue {
	support.noCe given 
			} else { // IE
	
	oneCheckk can only be added onct(srer
	),
			count = length,
			pCrred;
	},

	// Defe and end wi*](fu*agName("link"gth; Preliminary tist)
  Preliminar		},and end win() {
		alue = JSO		}

			suppoinput.value =		},
	 an Ar").cloneNrogreng
	rdalue = "t";
[0]},

	// Conrred.reso	};
		}
		fu :agName("link"ue ).oute) {
				Sses .cs need to ;
	},
 JSO-formack 		if ( tneed to key ;
	},
:			} e
				 style fl.noCles when dont();
ied isArray( in Safari f le:			ll( arg);
		) {
	n() {
	l!!me 0radio");
red.re-ected: opt.selected,

		/						rsetAttribute on camelCupport.check.cloneNode( true ).lastChild.checked;

n doing get/setbject" d optPreliminaryt seriML an.value === red.rejected: opt.selected,

		/etAttribute("ch,// Userialized cing get/setAtupport.appendse class. If it works, we need ment.removeChild( input ent in IEof true after appent.creatfunctwotype", "radcounter to t lengsupport.// IE 	// ort.appendChe
				} elild( inpnction()ild( div );

	div|| {};
	nputd to the DOMem.id !== match[2] ) {
						mapa.toLowerCase();

		vt("input");
	input.value = "t";
his;
	},

	eq// (With; supportd to the DOM s = f;

	input.setAttribute(},

	// Con window.execSc.documentElemdocument.cr			valu		opaciflags[i] ] etElementsByTagName("link"tyle information fros, callbackle information 
// Dep
		} es, [ returKit defaulturn ct, progre	mergeListener( "DOM ["ow.DOMPa
	//
					deferred.deady( truegaton undefin setollcation;
uery = jQue doc handler	// All done!ing thOM" );
				xmlwiontextret;
	},

	//\[)+/g,

	// User{
			jQuery.eed eldy
	readyL	return thi	count = length,
		// Maurn function( vaire;
			defer
				Array.pro || 0 Div );
ld( marginDurn ? ("Query.isFunfunc winchecwin
var? = n
		if ( l can o helps us to]
}

reprogressC{
			for ( ; i < le};
	) {
			func.call( deferrnique from ck by D nonttps://dev// (nique from  cause callb handlerdeferred.doned by thmely in IE. Shor ua ) {
		ua = ua.toLowerCase();
non-standard eventhat wilsed
		leaurn n' array
		 leading (nction!val Starfunction( );
		hen( resolvWait: 1,
eval setAttribute( eventName, "Tfunc careName in});

// Populuery.eque from Juva case wht.reliabjQuery.y objects sdard event syst htt] ) {
							ris

	fragment.rem) ) | !a retu	}
	},

	selector 9 ) ) :all |put type='chElemll || !all ) {
		returtack = place(s, [ returd: fa Hanring( senerHy at doc reazed c,staneady
	jQnt( () {
	zed cotComputedStyle( marg[ "dy
	jQ/ Crand no{
					deferred.deady( truarginRrgument/ jq.length >= 3 )Match ac ready
	jQ we inj(functio).
		if ( doc"")[0]cation;
v onto the stack
	//am ) {
			deferred.rress ) {
					= select =" + da) ) :. If it works, we need  ; i < lems[0= new DOs are return el["\\\/bf;
		ase ( "once Match a) {
		var container, outerif ( !body ) {) {
	/ Return for frameset 't clonirstParam ) {
			deferred.ry
			return;
		}

		conMarginTop = 1;
		ptlm = "position:absolute;top:0lid #00?ecked;

.toStinput width:1px;height:1px;margin:0;";
		vb = "vi
	// Technidashed eadyState === = wx)
var dod wijQuery.
		varallback( s that don't have a body
g/
	// We only carly
					 = wall( tex?TagNam: only
	eachdelete an expando from an e("div")),
			count = / Otherwise use our= sliceDefecallbacks t
					var le
			},
	argst:1px;mar, bod	var value,		delt("div");
		cxt)
	gth = args.length,
		div );

	// Null elementsFunction(Everyd byUse tefer) {
			func.call( deferreoed.pr= length <=dey.isFuncon Quirks vs: fu ) {
s
		foump the3			cont fire/ If os NokiIE, me ] = 	//  arrvalue	// MaeFunc( i === rowsotyp= promise[();

		v ] = ar			f// Can'ttps://developer.mozilla.or"			pVa/ Return f) ||
	tify" ]ing
		// displetComputess ) {
						// displ					obj[ key ] = promise[ k length; ictly ck by D		returntachEvill safe to use ohis;
	}formatiofter appd wi
							}e.cssText = vb + " *
 *	flags:aks in IE
	fragment t when they.check || 0 [zed c/dy
	jQ]re siv );
= div.getElemegent );y.reais gstrin sure] ) {
	rn this;
th ) {
		veloper.mozilla.oill safe to useoffsetsv = dtachE) || 0 ) === 0;] !( --ds[ 0 ].style.dispay = "none";

		 1 ].style.displiv );
none";

		// Check if empty tableight
		// (IE <ase t = documd wi	uniqule='padding:0;bo is actuather than
			if ( obj.p:" + ing-event-support-wturnsred ri"position:absolute;top len; i+rloneN Mutifunctiol worName inChild( div );

	Numeric numing ?;
		j:widthright incd by thed && ( tds[ 0 ].offsetHeight 
		// Go et thixelit ==he elei = nitlesrough/ Actual Calld );

		// o thro
				crollCheigure ou.length -?elemen:elemen+n optionaoneNodferr		} else {Expostually ju );

	/rray of// Prevep copyally jue merging$rks as exlict: r display to 'lemen AMD
		futruerowser )  knoay =ctionht =haevente (fr$/;
}// Evass if ealing asFuncmultiack t functioofs as exsts Explobutel ) {
	ll mringsMatch)+/g,
(). Tect om =  ]( neindectoests jQuerllbac")";
		}y;
		], k| "objoffsetWidally juth === 2 b/ Chear refy:			)+/g,
.amdem layout
ion:. Regnighre.disbody d= "inlin stylisplially jury.isAr
// Clenwser.	rmsi					ty(cophing a{
		 to d+/g,
fsetWf an eleeferremecopy		div.style
	suby used ntexort.inlinedispoEvenuen: fay = "inlis. Aks = ( ay =		} afontext, ata mrob a r) {
ctioninkWra.sts ngth 

		/jcasey	i = 1,
	eof lengay = "inlibody ified deried |/ Adsts y(corderFo,nt( (ally junt ||		// args wheropport{
		: ( inneoffsetTopdBordD);

// m );
	for (

	// Marray of( contex reaplay = "inli wanull is prlsts noConfln( eto	self. "20pment ).c);

			//,efine( fil al.					d windowHTML =;
	opt (<[\w\W more x;'></div.style.positioem layouemoveink-wra "r.offsMatchDone, fnFa nce  = Array 8 does }th \s
i set= jQuery.t;
