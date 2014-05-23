/*!
 * jQuery JavaScript Library v1.9.1
 * http://jquery.com/
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 *
 * Copyright 2005, 2012 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2013-2-4
 */
(function( window, undefined ) {

// Can't do this because several apps including ASP.NET trace
// the stack via arguments.caller.callee and Firefox dies if
// you try to trace through "use strict" call chains. (#13335)
// Support: Firefox 18+
//"use strict";
var
    // The deferred used on DOM ready
    readyList,

    // A central reference to the root jQuery(document)
    rootjQuery,

    // Support: IE<9
    // For `typeof node.method` instead of `node.method !== undefined`
    core_strundefined = typeof undefined,

    // Use the correct document accordingly with window argument (sandbox)
    document = window.document,
    location = window.location,

    // Map over jQuery in case of overwrite
    _jQuery = window.jQuery,

    // Map over the $ in case of overwrite
    _$ = window.$,

    // [[Class]] -> type pairs
    class2type = {},

    // List of deleted data cache ids, so we can reuse them
    core_deletedIds = [],

    core_version = "1.9.1",

    // Save a reference to some core methods
    core_concat = core_deletedIds.concat,
    core_push = core_deletedIds.push,
    core_slice = core_deletedIds.slice,
    core_indexOf = core_deletedIds.indexOf,
    core_toString = class2type.toString,
    core_hasOwn = class2type.hasOwnProperty,
    core_trim = core_version.trim,

    // Define a local copy of jQuery
    jQuery = function( selector, context ) {
        // The jQuery object is actually just the init constructor 'enhanced'
        return new jQuery.fn.init( selector, context, rootjQuery );
    },

    // Used for matching numbers
    core_pnum = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,

    // Used for splitting on whitespace
    core_rnotwhite = /\S+/g,

    // Make sure we trim BOM and NBSP (here's looking at you, Safari 5.0 and IE)
    rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,

    // A simple way to check for HTML strings
    // Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
    // Strict HTML recognition (#11290: must start with <)
    rquickExpr = /^(?:(<[\w\W]+>)[^>]*|#([\w-]*))$/,

    // Match a standalone tag
    rsingleTag = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,

    // JSON RegExp
    rvalidchars = /^[\],:{}\s]*$/,
    rvalidbraces = /(?:^|:|,)(?:\s*\[)+/g,
    rvalidescape = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
    rvalidtokens = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,

    // Matches dashed string for camelizing
    rmsPrefix = /^-ms-/,
    rdashAlpha = /-([\da-z])/gi,

    // Used by jQuery.camelCase as callback to replace()
    fcamelCase = function( all, letter ) {
        return letter.toUpperCase();
    },

    // The ready event handler
    completed = function( event ) {

        // readyState === "complete" is good enough for us to call the dom ready in oldIE
        if ( document.addEventListener || event.type === "load" || document.readyState === "complete" ) {
            detach();
            jQuery.ready();
        }
    },
    // Clean-up method for dom ready events
    detach = function() {
        if ( document.addEventListener ) {
            document.removeEventListener( "DOMContentLoaded", completed, false );
            window.removeEventListener( "load", completed, false );

        } else {
            document.detachEvent( "onreadystatechange", completed );
            window.detachEvent( "onload", completed );
        }
    };

jQuery.fn = jQuery.prototype = {
    // The current version of jQuery being used
    jquery: core_version,

    constructor: jQuery,
    init: function( selector, context, rootjQuery ) {
        var match, elem;

        // HANDLE: $(""), $(null), $(undefined), $(false)
        if ( !selector ) {
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

                    // scripts is true for back-compat
                    jQuery.merge( this, jQuery.parseHTML(
                        match[1],
                        context && context.nodeType ? context.ownerDocument || context : document,
                        true
                    ) );

                    // HANDLE: $(html, props)
                    if ( rsingleTag.test( match[1] ) && jQuery.isPlainObject( context ) ) {
                        for ( match in context ) {
                            // Properties of context are called as methods if possible
                            if ( jQuery.isFunction( this[ match ] ) ) {
                                this[ match ]( context[ match ] );

                            // ...and otherwise set as attributes
                            } else {
                                this.attr( match, context[ match ] );
                            }
                        }
                    }

                    return this;

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

        // HANDLE: $(DOMElement)
        } else if ( selector.nodeType ) {
            this.context = this[0] = selector;
            this.length = 1;
            return this;

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
    pushStack: function( elems ) {

        // Build a new jQuery matched element set
        var ret = jQuery.merge( this.constructor(), elems );

        // Add the old object onto the stack (as a reference)
        ret.prevObject = this;
        ret.context = this.context;

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

    slice: function() {
        return this.pushStack( core_slice.apply( this, arguments ) );
    },

    first: function() {
        return this.eq( 0 );
    },

    last: function() {
        return this.eq( -1 );
    },

    eq: function( i ) {
        var len = this.length,
            j = +i + ( i < 0 ? len : 0 );
        return this.pushStack( j >= 0 && j < len ? [ this[j] ] : [] );
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
    var src, copyIsArray, copy, name, options, clone,
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
            return setTimeout( jQuery.ready );
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
        if ( obj == null ) {
            return String( obj );
        }
        return typeof obj === "object" || typeof obj === "function" ?
            class2type[ core_toString.call(obj) ] || "object" :
            typeof obj;
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
    // keepScripts (optional): If true, will include scripts passed in the html string
    parseHTML: function( data, context, keepScripts ) {
        if ( !data || typeof data !== "string" ) {
            return null;
        }
        if ( typeof context === "boolean" ) {
            keepScripts = context;
            context = false;
        }
        context = context || document;

        var parsed = rsingleTag.exec( data ),
            scripts = !keepScripts && [];

        // Single tag
        if ( parsed ) {
            return [ context.createElement( parsed[1] ) ];
        }

        parsed = jQuery.buildFragment( [ data ], context, scripts );
        if ( scripts ) {
            jQuery( scripts ).remove();
        }
        return jQuery.merge( [], parsed.childNodes );
    },

    parseJSON: function( data ) {
        // Attempt to parse using the native JSON parser first
        if ( window.JSON && window.JSON.parse ) {
            return window.JSON.parse( data );
        }

        if ( data === null ) {
            return data;
        }

        if ( typeof data === "string" ) {

            // Make sure leading/trailing whitespace is removed (IE can't handle it)
            data = jQuery.trim( data );

            if ( data ) {
                // Make sure the incoming data is actual JSON
                // Logic borrowed from http://json.org/json2.js
                if ( rvalidchars.test( data.replace( rvalidescape, "@" )
                    .replace( rvalidtokens, "]" )
                    .replace( rvalidbraces, "")) ) {

                    return ( new Function( "return " + data ) )();
                }
            }
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
        if ( data && jQuery.trim( data ) ) {
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
        var value,
            i = 0,
            length = obj.length,
            isArray = isArraylike( obj );

        if ( args ) {
            if ( isArray ) {
                for ( ; i < length; i++ ) {
                    value = callback.apply( obj[ i ], args );

                    if ( value === false ) {
                        break;
                    }
                }
            } else {
                for ( i in obj ) {
                    value = callback.apply( obj[ i ], args );

                    if ( value === false ) {
                        break;
                    }
                }
            }

        // A special, fast, case for the most common use of each
        } else {
            if ( isArray ) {
                for ( ; i < length; i++ ) {
                    value = callback.call( obj[ i ], i, obj[ i ] );

                    if ( value === false ) {
                        break;
                    }
                }
            } else {
                for ( i in obj ) {
                    value = callback.call( obj[ i ], i, obj[ i ] );

                    if ( value === false ) {
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
        var ret = results || [];

        if ( arr != null ) {
            if ( isArraylike( Object(arr) ) ) {
                jQuery.merge( ret,
                    typeof arr === "string" ?
                    [ arr ] : arr
                );
            } else {
                core_push.call( ret, arr );
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
        var value,
            i = 0,
            length = elems.length,
            isArray = isArraylike( elems ),
            ret = [];

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
            for ( i in elems ) {
                value = callback( elems[ i ], i, arg );

                if ( value != null ) {
                    ret[ ret.length ] = value;
                }
            }
        }

        // Flatten any nested arrays
        return core_concat.apply( [], ret );
    },

    // A global GUID counter for objects
    guid: 1,

    // Bind a function to a context, optionally partially applying any
    // arguments.
    proxy: function( fn, context ) {
        var args, proxy, tmp;

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
            return fn.apply( context || this, args.concat( core_slice.call( arguments ) ) );
        };

        // Set the guid of unique handler to the same of original handler, so it can be removed
        proxy.guid = fn.guid = fn.guid || jQuery.guid++;

        return proxy;
    },

    // Multifunctional method to get and set values of a collection
    // The value/s can optionally be executed if it's a function
    access: function( elems, fn, key, value, chainable, emptyGet, raw ) {
        var i = 0,
            length = elems.length,
            bulk = key == null;

        // Sets many values
        if ( jQuery.type( key ) === "object" ) {
            chainable = true;
            for ( i in key ) {
                jQuery.access( elems, fn, i, key[i], true, emptyGet, raw );
            }

        // Sets one value
        } else if ( value !== undefined ) {
            chainable = true;

            if ( !jQuery.isFunction( value ) ) {
                raw = true;
            }

            if ( bulk ) {
                // Bulk operations run against the entire set
                if ( raw ) {
                    fn.call( elems, value );
                    fn = null;

                // ...except when executing function values
                } else {
                    bulk = fn;
                    fn = function( elem, key, value ) {
                        return bulk.call( jQuery( elem ), value );
                    };
                }
            }

            if ( fn ) {
                for ( ; i < length; i++ ) {
                    fn( elems[i], key, raw ? value : value.call( elems[i], i, fn( elems[i], key ) ) );
                }
            }
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
            setTimeout( jQuery.ready );

        // Standards-based browsers support DOMContentLoaded
        } else if ( document.addEventListener ) {
            // Use the handy event callback
            document.addEventListener( "DOMContentLoaded", completed, false );

            // A fallback to window.onload, that will always work
            window.addEventListener( "load", completed, false );

        // If IE event model is used
        } else {
            // Ensure firing before onload, maybe late but safe also for iframes
            document.attachEvent( "onreadystatechange", completed );

            // A fallback to window.onload, that will always work
            window.attachEvent( "onload", completed );

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

                        // detach all dom ready events
                        detach();

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
jQuery.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(i, name) {
    class2type[ "[object " + name + "]" ] = name.toLowerCase();
});

function isArraylike( obj ) {
    var length = obj.length,
        type = jQuery.type( obj );

    if ( jQuery.isWindow( obj ) ) {
        return false;
    }

    if ( obj.nodeType === 1 && length ) {
        return true;
    }

    return type === "array" || type !== "function" &&
        ( length === 0 ||
        typeof length === "number" && length > 0 && ( length - 1 ) in obj );
}

// All jQuery objects should point back to these
rootjQuery = jQuery(document);
// String to Object options format cache
var optionsCache = {};

// Convert String-formatted options into Object-formatted ones and store in cache
function createOptions( options ) {
    var object = optionsCache[ options ] = {};
    jQuery.each( options.match( core_rnotwhite ) || [], function( _, flag ) {
        object[ flag ] = true;
    });
    return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *  options: an optional list of space-separated options that will change how
 *          the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *  once:           will ensure the callback list can only be fired once (like a Deferred)
 *
 *  memory:         will keep track of previous values and will call any callback added
 *                  after the list has been fired right away with the latest "memorized"
 *                  values (like a Deferred)
 *
 *  unique:         will ensure a callback can only be added once (no duplicate in the list)
 *
 *  stopOnFalse:    interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

    // Convert options from String-formatted to Object-formatted if needed
    // (we check in cache first)
    options = typeof options === "string" ?
        ( optionsCache[ options ] || createOptions( options ) ) :
        jQuery.extend( {}, options );

    var // Flag to know if list is currently firing
        firing,
        // Last fire value (for non-forgettable lists)
        memory,
        // Flag to know if list was already fired
        fired,
        // End of the loop when firing
        firingLength,
        // Index of currently firing callback (modified by remove if needed)
        firingIndex,
        // First callback to fire (used internally by add and fireWith)
        firingStart,
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
            // Check if a given callback is in the list.
            // If no argument is given, return whether or not list has callbacks attached.
            has: function( fn ) {
                return fn ? jQuery.inArray( fn, list ) > -1 : !!( list && list.length );
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
                                fn = jQuery.isFunction( fns[ i ] ) && fns[ i ];
                            // deferred[ done | fail | progress ] for forwarding actions to newDefer
                            deferred[ tuple[1] ](function() {
                                var returned = fn && fn.apply( this, arguments );
                                if ( returned && jQuery.isFunction( returned.promise ) ) {
                                    returned.promise()
                                        .done( newDefer.resolve )
                                        .fail( newDefer.reject )
                                        .progress( newDefer.notify );
                                } else {
                                    newDefer[ action + "With" ]( this === promise ? newDefer.promise() : this, fn ? [ returned ] : arguments );
                                }
                            });
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

            // deferred[ resolve | reject | notify ]
            deferred[ tuple[0] ] = function() {
                deferred[ tuple[0] + "With" ]( this === deferred ? promise : this, arguments );
                return this;
            };
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

    var support, all, a,
        input, select, fragment,
        opt, eventName, isSupported, i,
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
        // Test setAttribute on camelCase class. If it works, we need attrFixes when doing get/setAttribute (ie6/7)
        getSetAttribute: div.className !== "t",

        // IE strips leading whitespace when .innerHTML is used
        leadingWhitespace: div.firstChild.nodeType === 3,

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
        hrefNormalized: a.getAttribute("href") === "/a",

        // Make sure that element opacity exists
        // (IE uses filter instead)
        // Use a regex to work around a WebKit issue. See #5145
        opacity: /^0.5/.test( a.style.opacity ),

        // Verify style float existence
        // (IE uses styleFloat instead of cssFloat)
        cssFloat: !!a.style.cssFloat,

        // Check the default checkbox/radio value ("" on WebKit; "on" elsewhere)
        checkOn: !!input.value,

        // Make sure that a selected-by-default option has a working selected property.
        // (WebKit defaults to false instead of true, IE too, if it's in an optgroup)
        optSelected: opt.selected,

        // Tests for enctype support on a form (#6743)
        enctype: !!document.createElement("form").enctype,

        // Makes sure cloning an html5 element does not cause problems
        // Where outerHTML is undefined, this still works
        html5Clone: document.createElement("nav").cloneNode( true ).outerHTML !== "<:nav></:nav>",

        // jQuery.support.boxModel DEPRECATED in 1.8 since we don't support Quirks Mode
        boxModel: document.compatMode === "CSS1Compat",

        // Will be defined later
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

    // Support: IE<9
    try {
        delete div.test;
    } catch( e ) {
        support.deleteExpando = false;
    }

    // Check if we can trust getAttribute("value")
    input = document.createElement("input");
    input.setAttribute( "value", "" );
    support.input = input.getAttribute( "value" ) === "";

    // Check if an input maintains its value after becoming a radio
    input.value = "t";
    input.setAttribute( "type", "radio" );
    support.radioValue = input.value === "t";

    // #11217 - WebKit loses check when the name is after the checked attribute
    input.setAttribute( "checked", "t" );
    input.setAttribute( "name", "t" );

    fragment = document.createDocumentFragment();
    fragment.appendChild( input );

    // Check if a disconnected checkbox will retain its checked
    // value of true after appended to the DOM (IE6/7)
    support.appendChecked = input.checked;

    // WebKit doesn't clone checked state correctly in fragments
    support.checkClone = fragment.cloneNode( true ).cloneNode( true ).lastChild.checked;

    // Support: IE<9
    // Opera does not clone events (and typeof div.attachEvent === undefined).
    // IE9-10 clones events bound via attachEvent, but they don't trigger with .click()
    if ( div.attachEvent ) {
        div.attachEvent( "onclick", function() {
            support.noCloneEvent = false;
        });

        div.cloneNode( true ).click();
    }

    // Support: IE<9 (lack submit/change bubble), Firefox 17+ (lack focusin event)
    // Beware of CSP restrictions (https://developer.mozilla.org/en/Security/CSP), test/csp.php
    for ( i in { submit: true, change: true, focusin: true }) {
        div.setAttribute( eventName = "on" + i, "t" );

        support[ i + "Bubbles" ] = eventName in window || div.attributes[ eventName ].expando === false;
    }

    div.style.backgroundClip = "content-box";
    div.cloneNode( true ).style.backgroundClip = "";
    support.clearCloneStyle = div.style.backgroundClip === "content-box";

    // Run tests that need a body at doc ready
    jQuery(function() {
        var container, marginDiv, tds,
            divReset = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",
            body = document.getElementsByTagName("body")[0];

        if ( !body ) {
            // Return for frameset docs that don't have a body
            return;
        }

        container = document.createElement("div");
        container.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px";

        body.appendChild( container ).appendChild( div );

        // Support: IE8
        // Check if table cells still have offsetWidth/Height when they are set
        // to display:none and there are still other visible table cells in a
        // table row; if so, offsetWidth/Height are not reliable for use when
        // determining if an element has been hidden directly using
        // display:none (it is still safe to use offsets if a parent element is
        // hidden; don safety goggles and see bug #4512 for more information).
        div.innerHTML = "<table><tr><td></td><td>t</td></tr></table>";
        tds = div.getElementsByTagName("td");
        tds[ 0 ].style.cssText = "padding:0;margin:0;border:0;display:none";
        isSupported = ( tds[ 0 ].offsetHeight === 0 );

        tds[ 0 ].style.display = "";
        tds[ 1 ].style.display = "none";

        // Support: IE8
        // Check if empty table cells still have offsetWidth/Height
        support.reliableHiddenOffsets = isSupported && ( tds[ 0 ].offsetHeight === 0 );

        // Check box-sizing and margin behavior
        div.innerHTML = "";
        div.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;";
        support.boxSizing = ( div.offsetWidth === 4 );
        support.doesNotIncludeMarginInBodyOffset = ( body.offsetTop !== 1 );

        // Use window.getComputedStyle because jsdom on node.js will break without it.
        if ( window.getComputedStyle ) {
            support.pixelPosition = ( window.getComputedStyle( div, null ) || {} ).top !== "1%";
            support.boxSizingReliable = ( window.getComputedStyle( div, null ) || { width: "4px" } ).width === "4px";

            // Check if div with explicit width and no margin-right incorrectly
            // gets computed margin-right based on width of container. (#3333)
            // Fails in WebKit before Feb 2011 nightlies
            // WebKit Bug 13343 - getComputedStyle returns wrong value for margin-right
            marginDiv = div.appendChild( document.createElement("div") );
            marginDiv.style.cssText = div.style.cssText = divReset;
            marginDiv.style.marginRight = marginDiv.style.width = "0";
            div.style.width = "1px";

            support.reliableMarginRight =
                !parseFloat( ( window.getComputedStyle( marginDiv, null ) || {} ).marginRight );
        }

        if ( typeof div.style.zoom !== core_strundefined ) {
            // Support: IE<8
            // Check if natively block-level elements act like inline-block
            // elements when setting their display to 'inline' and giving
            // them layout
            div.innerHTML = "";
            div.style.cssText = divReset + "width:1px;padding:1px;display:inline;zoom:1";
            support.inlineBlockNeedsLayout = ( div.offsetWidth === 3 );

            // Support: IE6
            // Check if elements with layout shrink-wrap their children
            div.style.display = "block";
            div.innerHTML = "<div></div>";
            div.firstChild.style.width = "5px";
            support.shrinkWrapBlocks = ( div.offsetWidth !== 3 );

            if ( support.inlineBlockNeedsLayout ) {
                // Prevent IE 6 from affecting layout for positioned elements #11048
                // Prevent IE from shrinking the body in IE 7 mode #12869
                // Support: IE<8
                body.style.zoom = 1;
            }
        }

        body.removeChild( container );

        // Null elements to avoid leaks in IE
        container = div = tds = marginDiv = null;
    });

    // Null elements to avoid leaks in IE
    all = select = fragment = opt = a = input = null;

    return support;
})();

var rbrace = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
    rmultiDash = /([A-Z])/g;

function internalData( elem, name, data, pvt /* Internal Use Only */ ){
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
            elem[ internalKey ] = id = core_deletedIds.pop() || jQuery.guid++;
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
}

function internalRemoveData( elem, name, pvt ) {
    if ( !jQuery.acceptData( elem ) ) {
        return;
    }

    var i, l, thisCache,
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
            } else {
                // If "name" is an array of keys...
                // When data is initially created, via ("key", "val") signature,
                // keys will be converted to camelCase.
                // Since there is no way to tell _how_ a key was added, remove
                // both plain key and camelCase key. #12786
                // This will only penalize the array argument path.
                name = name.concat( jQuery.map( name, jQuery.camelCase ) );
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
}

jQuery.extend({
    cache: {},

    // Unique for each copy of jQuery on the page
    // Non-digits removed to match rinlinejQuery
    expando: "jQuery" + ( core_version + Math.random() ).replace( /\D/g, "" ),

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

    data: function( elem, name, data ) {
        return internalData( elem, name, data );
    },

    removeData: function( elem, name ) {
        return internalRemoveData( elem, name );
    },

    // For internal use only.
    _data: function( elem, name, data ) {
        return internalData( elem, name, data, true );
    },

    _removeData: function( elem, name ) {
        return internalRemoveData( elem, name, true );
    },

    // A method for determining if a DOM node can handle the data expando
    acceptData: function( elem ) {
        // Do not set data on non-element because it will not be cleared (#8335).
        if ( elem.nodeType && elem.nodeType !== 1 && elem.nodeType !== 9 ) {
            return false;
        }

        var noData = elem.nodeName && jQuery.noData[ elem.nodeName.toLowerCase() ];

        // nodes accept data unless otherwise specified; rejection can be conditional
        return !noData || noData !== true && elem.getAttribute("classid") === noData;
    }
});

jQuery.fn.extend({
    data: function( key, value ) {
        var attrs, name,
            elem = this[0],
            i = 0,
            data = null;

        // Gets all values
        if ( key === undefined ) {
            if ( this.length ) {
                data = jQuery.data( elem );

                if ( elem.nodeType === 1 && !jQuery._data( elem, "parsedAttrs" ) ) {
                    attrs = elem.attributes;
                    for ( ; i < attrs.length; i++ ) {
                        name = attrs[i].name;

                        if ( !name.indexOf( "data-" ) ) {
                            name = jQuery.camelCase( name.slice(5) );

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

        return jQuery.access( this, function( value ) {

            if ( value === undefined ) {
                // Try to fetch any internally stored data first
                return elem ? dataAttr( elem, key, jQuery.data( elem, key ) ) : null;
            }

            this.each(function() {
                jQuery.data( this, key, value );
            });
        }, null, value, arguments.length > 1, null, true );
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

        hooks.cur = fn;
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
                jQuery._removeData( elem, type + "queue" );
                jQuery._removeData( elem, key );
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
var nodeHook, boolHook,
    rclass = /[\t\r\n]/g,
    rreturn = /\r/g,
    rfocusable = /^(?:input|select|textarea|button|object)$/i,
    rclickable = /^(?:a|area)$/i,
    rboolean = /^(?:checked|selected|autofocus|autoplay|async|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped)$/i,
    ruseDefault = /^(?:checked|selected)$/i,
    getSetAttribute = jQuery.support.getSetAttribute,
    getSetInput = jQuery.support.input;

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
        var classes, elem, cur, clazz, j,
            i = 0,
            len = this.length,
            proceed = typeof value === "string" && value;

        if ( jQuery.isFunction( value ) ) {
            return this.each(function( j ) {
                jQuery( this ).addClass( value.call( this, j, this.className ) );
            });
        }

        if ( proceed ) {
            // The disjunction here is for better compressibility (see removeClass)
            classes = ( value || "" ).match( core_rnotwhite ) || [];

            for ( ; i < len; i++ ) {
                elem = this[ i ];
                cur = elem.nodeType === 1 && ( elem.className ?
                    ( " " + elem.className + " " ).replace( rclass, " " ) :
                    " "
                );

                if ( cur ) {
                    j = 0;
                    while ( (clazz = classes[j++]) ) {
                        if ( cur.indexOf( " " + clazz + " " ) < 0 ) {
                            cur += clazz + " ";
                        }
                    }
                    elem.className = jQuery.trim( cur );

                }
            }
        }

        return this;
    },

    removeClass: function( value ) {
        var classes, elem, cur, clazz, j,
            i = 0,
            len = this.length,
            proceed = arguments.length === 0 || typeof value === "string" && value;

        if ( jQuery.isFunction( value ) ) {
            return this.each(function( j ) {
                jQuery( this ).removeClass( value.call( this, j, this.className ) );
            });
        }
        if ( proceed ) {
            classes = ( value || "" ).match( core_rnotwhite ) || [];

            for ( ; i < len; i++ ) {
                elem = this[ i ];
                // This expression is here for better compressibility (see addClass)
                cur = elem.nodeType === 1 && ( elem.className ?
                    ( " " + elem.className + " " ).replace( rclass, " " ) :
                    ""
                );

                if ( cur ) {
                    j = 0;
                    while ( (clazz = classes[j++]) ) {
                        // Remove *all* instances
                        while ( cur.indexOf( " " + clazz + " " ) >= 0 ) {
                            cur = cur.replace( " " + clazz + " ", " " );
                        }
                    }
                    elem.className = value ? jQuery.trim( cur ) : "";
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
                    classNames = value.match( core_rnotwhite ) || [];

                while ( (className = classNames[ i++ ]) ) {
                    // check each className given, space separated list
                    state = isBool ? state : !self.hasClass( className );
                    self[ state ? "addClass" : "removeClass" ]( className );
                }

            // Toggle whole class name
            } else if ( type === core_strundefined || type === "boolean" ) {
                if ( this.className ) {
                    // store className if set
                    jQuery._data( this, "__className__", this.className );
                }

                // If the element has a class name or if we're passed "false",
                // then remove the whole classname (if there was one, the above saved it).
                // Otherwise bring back whatever was previously saved (if anything),
                // falling back to the empty string if nothing was stored.
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
        var ret, hooks, isFunction,
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

    attr: function( elem, name, value ) {
        var hooks, notxml, ret,
            nType = elem.nodeType;

        // don't get/set attributes on text, comment and attribute nodes
        if ( !elem || nType === 3 || nType === 8 || nType === 2 ) {
            return;
        }

        // Fallback to prop when attributes are not supported
        if ( typeof elem.getAttribute === core_strundefined ) {
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

            } else if ( hooks && notxml && "set" in hooks && (ret = hooks.set( elem, value, name )) !== undefined ) {
                return ret;

            } else {
                elem.setAttribute( name, value + "" );
                return value;
            }

        } else if ( hooks && notxml && "get" in hooks && (ret = hooks.get( elem, name )) !== null ) {
            return ret;

        } else {

            // In IE9+, Flash objects don't have .getAttribute (#12945)
            // Support: IE9+
            if ( typeof elem.getAttribute !== core_strundefined ) {
                ret =  elem.getAttribute( name );
            }

            // Non-existent attributes return null, we normalize to undefined
            return ret == null ?
                undefined :
                ret;
        }
    },

    removeAttr: function( elem, value ) {
        var name, propName,
            i = 0,
            attrNames = value && value.match( core_rnotwhite );

        if ( attrNames && elem.nodeType === 1 ) {
            while ( (name = attrNames[i++]) ) {
                propName = jQuery.propFix[ name ] || name;

                // Boolean attributes get special treatment (#10870)
                if ( rboolean.test( name ) ) {
                    // Set corresponding property to false for boolean attributes
                    // Also clear defaultChecked/defaultSelected (if appropriate) for IE<8
                    if ( !getSetAttribute && ruseDefault.test( name ) ) {
                        elem[ jQuery.camelCase( "default-" + name ) ] =
                            elem[ propName ] = false;
                    } else {
                        elem[ propName ] = false;
                    }

                // See #9699 for explanation of this approach (setting first, then removal)
                } else {
                    jQuery.attr( elem, name, "" );
                }

                elem.removeAttribute( getSetAttribute ? name : propName );
            }
        }
    },

    attrHooks: {
        type: {
            set: function( elem, value ) {
                if ( !jQuery.support.radioValue && value === "radio" && jQuery.nodeName(elem, "input") ) {
                    // Setting the type on a radio button after the value resets the value in IE6-9
                    // Reset value to default in case type is set after value during creation
                    var val = elem.value;
                    elem.setAttribute( "type", value );
                    if ( val ) {
                        elem.value = val;
                    }
                    return value;
                }
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
        var
            // Use .prop to determine if this attribute is understood as boolean
            prop = jQuery.prop( elem, name ),

            // Fetch it accordingly
            attr = typeof prop === "boolean" && elem.getAttribute( name ),
            detail = typeof prop === "boolean" ?

                getSetInput && getSetAttribute ?
                    attr != null :
                    // oldIE fabricates an empty string for missing boolean attributes
                    // and conflates checked/selected into attroperties
                    ruseDefault.test( name ) ?
                        elem[ jQuery.camelCase( "default-" + name ) ] :
                        !!attr :

                // fetch an attribute node for properties not recognized as boolean
                elem.getAttributeNode( name );

        return detail && detail.value !== false ?
            name.toLowerCase() :
            undefined;
    },
    set: function( elem, value, name ) {
        if ( value === false ) {
            // Remove boolean attributes when set to false
            jQuery.removeAttr( elem, name );
        } else if ( getSetInput && getSetAttribute || !ruseDefault.test( name ) ) {
            // IE<8 needs the *property* name
            elem.setAttribute( !getSetAttribute && jQuery.propFix[ name ] || name, name );

        // Use defaultChecked and defaultSelected for oldIE
        } else {
            elem[ jQuery.camelCase( "default-" + name ) ] = elem[ name ] = true;
        }

        return name;
    }
};

// fix oldIE value attroperty
if ( !getSetInput || !getSetAttribute ) {
    jQuery.attrHooks.value = {
        get: function( elem, name ) {
            var ret = elem.getAttributeNode( name );
            return jQuery.nodeName( elem, "input" ) ?

                // Ignore the value *property* by using defaultValue
                elem.defaultValue :

                ret && ret.specified ? ret.value : undefined;
        },
        set: function( elem, value, name ) {
            if ( jQuery.nodeName( elem, "input" ) ) {
                // Does not return so that setAttribute is also used
                elem.defaultValue = value;
            } else {
                // Use nodeHook if defined (#1954); otherwise setAttribute is fine
                return nodeHook && nodeHook.set( elem, value, name );
            }
        }
    };
}

// IE6/7 do not support getting/setting some attributes with get/setAttribute
if ( !getSetAttribute ) {

    // Use this for any attribute in IE6/7
    // This fixes almost every IE6/7 issue
    nodeHook = jQuery.valHooks.button = {
        get: function( elem, name ) {
            var ret = elem.getAttributeNode( name );
            return ret && ( name === "id" || name === "name" || name === "coords" ? ret.value !== "" : ret.specified ) ?
                ret.value :
                undefined;
        },
        set: function( elem, value, name ) {
            // Set the existing or create a new attribute node
            var ret = elem.getAttributeNode( name );
            if ( !ret ) {
                elem.setAttributeNode(
                    (ret = elem.ownerDocument.createAttribute( name ))
                );
            }

            ret.value = value += "";

            // Break association with cloned elements by also using setAttribute (#9646)
            return name === "value" || value === elem.getAttribute( name ) ?
                value :
                undefined;
        }
    };

    // Set contenteditable to false on removals(#10429)
    // Setting to empty string throws an error as an invalid value
    jQuery.attrHooks.contenteditable = {
        get: nodeHook.get,
        set: function( elem, value, name ) {
            nodeHook.set( elem, value === "" ? false : value, name );
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
}


// Some attributes require a special call on IE
// http://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if ( !jQuery.support.hrefNormalized ) {
    jQuery.each([ "href", "src", "width", "height" ], function( i, name ) {
        jQuery.attrHooks[ name ] = jQuery.extend( jQuery.attrHooks[ name ], {
            get: function( elem ) {
                var ret = elem.getAttribute( name, 2 );
                return ret == null ? undefined : ret;
            }
        });
    });

    // href/src property should get the full normalized URL (#10299/#12915)
    jQuery.each([ "href", "src" ], function( i, name ) {
        jQuery.propHooks[ name ] = {
            get: function( elem ) {
                return elem.getAttribute( name, 4 );
            }
        };
    });
}

if ( !jQuery.support.style ) {
    jQuery.attrHooks.style = {
        get: function( elem ) {
            // Return undefined in the case of empty string
            // Note: IE uppercases css property names, but if we were to .toLowerCase()
            // .cssText, that would destroy case senstitivity in URL's, like in "background"
            return elem.style.cssText || undefined;
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
var rformElems = /^(?:input|select|textarea)$/i,
    rkeyEvent = /^key/,
    rmouseEvent = /^(?:mouse|contextmenu)|click/,
    rfocusMorph = /^(?:focusinfocus|focusoutblur)$/,
    rtypenamespace = /^([^.]*)(?:\.(.+)|)$/;

function returnTrue() {
    return true;
}

function returnFalse() {
    return false;
}

/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
jQuery.event = {

    global: {},

    add: function( elem, types, handler, data, selector ) {
        var tmp, events, t, handleObjIn,
            special, eventHandle, handleObj,
            handlers, type, namespaces, origType,
            elemData = jQuery._data( elem );

        // Don't attach events to noData or text/comment nodes (but allow plain objects)
        if ( !elemData ) {
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
        if ( !(events = elemData.events) ) {
            events = elemData.events = {};
        }
        if ( !(eventHandle = elemData.handle) ) {
            eventHandle = elemData.handle = function( e ) {
                // Discard the second event of a jQuery.event.trigger() and
                // when an event is called after a page has unloaded
                return typeof jQuery !== core_strundefined && (!e || jQuery.event.triggered !== e.type) ?
                    jQuery.event.dispatch.apply( eventHandle.elem, arguments ) :
                    undefined;
            };
            // Add elem as a property of the handle fn to prevent a memory leak with IE non-native events
            eventHandle.elem = elem;
        }

        // Handle multiple events separated by a space
        // jQuery(...).bind("mouseover mouseout", fn);
        types = ( types || "" ).match( core_rnotwhite ) || [""];
        t = types.length;
        while ( t-- ) {
            tmp = rtypenamespace.exec( types[t] ) || [];
            type = origType = tmp[1];
            namespaces = ( tmp[2] || "" ).split( "." ).sort();

            // If event changes its type, use the special event handlers for the changed type
            special = jQuery.event.special[ type ] || {};

            // If selector defined, determine special event api type, otherwise given type
            type = ( selector ? special.delegateType : special.bindType ) || type;

            // Update special based on newly reset type
            special = jQuery.event.special[ type ] || {};

            // handleObj is passed to all event handlers
            handleObj = jQuery.extend({
                type: type,
                origType: origType,
                data: data,
                handler: handler,
                guid: handler.guid,
                selector: selector,
                needsContext: selector && jQuery.expr.match.needsContext.test( selector ),
                namespace: namespaces.join(".")
            }, handleObjIn );

            // Init the event handler queue if we're the first
            if ( !(handlers = events[ type ]) ) {
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

    // Detach an event or set of events from an element
    remove: function( elem, types, handler, selector, mappedTypes ) {
        var j, handleObj, tmp,
            origCount, t, events,
            special, handlers, type,
            namespaces, origType,
            elemData = jQuery.hasData( elem ) && jQuery._data( elem );

        if ( !elemData || !(events = elemData.events) ) {
            return;
        }

        // Once for each type.namespace in types; type may be omitted
        types = ( types || "" ).match( core_rnotwhite ) || [""];
        t = types.length;
        while ( t-- ) {
            tmp = rtypenamespace.exec( types[t] ) || [];
            type = origType = tmp[1];
            namespaces = ( tmp[2] || "" ).split( "." ).sort();

            // Unbind all events (on this namespace, if provided) for the element
            if ( !type ) {
                for ( type in events ) {
                    jQuery.event.remove( elem, type + types[ t ], handler, selector, true );
                }
                continue;
            }

            special = jQuery.event.special[ type ] || {};
            type = ( selector ? special.delegateType : special.bindType ) || type;
            handlers = events[ type ] || [];
            tmp = tmp[2] && new RegExp( "(^|\\.)" + namespaces.join("\\.(?:.*\\.|)") + "(\\.|$)" );

            // Remove matching events
            origCount = j = handlers.length;
            while ( j-- ) {
                handleObj = handlers[ j ];

                if ( ( mappedTypes || origType === handleObj.origType ) &&
                    ( !handler || handler.guid === handleObj.guid ) &&
                    ( !tmp || tmp.test( handleObj.namespace ) ) &&
                    ( !selector || selector === handleObj.selector || selector === "**" && handleObj.selector ) ) {
                    handlers.splice( j, 1 );

                    if ( handleObj.selector ) {
                        handlers.delegateCount--;
                    }
                    if ( special.remove ) {
                        special.remove.call( elem, handleObj );
                    }
                }
            }

            // Remove generic event handler if we removed something and no more handlers exist
            // (avoids potential for endless recursion during removal of special event handlers)
            if ( origCount && !handlers.length ) {
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
            jQuery._removeData( elem, "events" );
        }
    },

    trigger: function( event, data, elem, onlyHandlers ) {
        var handle, ontype, cur,
            bubbleType, special, tmp, i,
            eventPath = [ elem || document ],
            type = core_hasOwn.call( event, "type" ) ? event.type : event,
            namespaces = core_hasOwn.call( event, "namespace" ) ? event.namespace.split(".") : [];

        cur = tmp = elem = elem || document;

        // Don't do events on text and comment nodes
        if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
            return;
        }

        // focus/blur morphs to focusin/out; ensure we're not firing them right now
        if ( rfocusMorph.test( type + jQuery.event.triggered ) ) {
            return;
        }

        if ( type.indexOf(".") >= 0 ) {
            // Namespaced trigger; create a regexp to match event type in handle()
            namespaces = type.split(".");
            type = namespaces.shift();
            namespaces.sort();
        }
        ontype = type.indexOf(":") < 0 && "on" + type;

        // Caller can pass in a jQuery.Event object, Object, or just an event type string
        event = event[ jQuery.expando ] ?
            event :
            new jQuery.Event( type, typeof event === "object" && event );

        event.isTrigger = true;
        event.namespace = namespaces.join(".");
        event.namespace_re = event.namespace ?
            new RegExp( "(^|\\.)" + namespaces.join("\\.(?:.*\\.|)") + "(\\.|$)" ) :
            null;

        // Clean up the event in case it is being reused
        event.result = undefined;
        if ( !event.target ) {
            event.target = elem;
        }

        // Clone any incoming data and prepend the event, creating the handler arg list
        data = data == null ?
            [ event ] :
            jQuery.makeArray( data, [ event ] );

        // Allow special events to draw outside the lines
        special = jQuery.event.special[ type ] || {};
        if ( !onlyHandlers && special.trigger && special.trigger.apply( elem, data ) === false ) {
            return;
        }

        // Determine event propagation path in advance, per W3C events spec (#9951)
        // Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
        if ( !onlyHandlers && !special.noBubble && !jQuery.isWindow( elem ) ) {

            bubbleType = special.delegateType || type;
            if ( !rfocusMorph.test( bubbleType + type ) ) {
                cur = cur.parentNode;
            }
            for ( ; cur; cur = cur.parentNode ) {
                eventPath.push( cur );
                tmp = cur;
            }

            // Only add window if we got to document (e.g., not plain obj or detached DOM)
            if ( tmp === (elem.ownerDocument || document) ) {
                eventPath.push( tmp.defaultView || tmp.parentWindow || window );
            }
        }

        // Fire handlers on the event path
        i = 0;
        while ( (cur = eventPath[i++]) && !event.isPropagationStopped() ) {

            event.type = i > 1 ?
                bubbleType :
                special.bindType || type;

            // jQuery handler
            handle = ( jQuery._data( cur, "events" ) || {} )[ event.type ] && jQuery._data( cur, "handle" );
            if ( handle ) {
                handle.apply( cur, data );
            }

            // Native handler
            handle = ontype && cur[ ontype ];
            if ( handle && jQuery.acceptData( cur ) && handle.apply && handle.apply( cur, data ) === false ) {
                event.preventDefault();
            }
        }
        event.type = type;

        // If nobody prevented the default action, do it now
 query.cif ( !onlyHandlers && ! Java.isDibraryPy JavaSc() ) {
jquery.coy.com/
 *(!special._Library || 2012 jQuery Foun.apply( elem.ownerDocument, data ) === false) &&
 * Copyrightjque!(typethe M"click"SizzjQuery.nodeNametribut, "a" )censate: 201acceptDatatribut om/
 *
 * Copyright sev// Call a native DOM method onript target withript same nguments.casript e.js
 this because several an't use an .isFun1.9.1() check here becato tIE6/7 failcallat tes Firefox dies if
// yoDotry do Library v1.9.1stracwindow,
// S's wt" caglobal variables be (#6170)this because sevem/
 *onorg/l&&ribut[ org/l]Sizzlte: 201isWrred 
// Can't do this because seve
//"use stricre-triggertraconFOOe and DOM n we cappsits FOO()SP.NET rt: IE<9
    // For `tmp =jQuery(the roo];ort: IE<9
    // For `m/
 *peof/
 *t: IE<9
    // For `gumendefined,

    = null;ingly with window arg}ort: IE<9
    // For `typsizzlejode.method`ing ofvia argume Java, sincethodalready bubbledhttpaboveingly with window argte: 201e.js
 method`ed =(docuent = window.document,tryrdingly with window argument (san,

   ()ent = window.document,
 catch ( ecordingly with window argumen// IE<9 diee deffocus/blur to hiddennt (sn,

(#1486,#12518A central referencan reuse th * I reproducible deferrXP IE8includi, not IE9 inre_comodjQuery,

    // Map ov}Query,

    // Map over the $ in case of overwundefined // Use the correct document accordingly with window argument (sandbox)
    dtmpent = window.document,
    core_push = core_deletedIdsOwn = clas
    locatireturne and Fresultent = },*
 * Cdisplete: frough "uof `nod/
 *
 * Copyr// Make a writyLisver the Eon,

fromript ncludinion,

objectwn = clasion,

=ver the $ in cfixy
    jQu // Use thevar i,e_ve, hcludeObj, mleteed, j,wn = class2tyuery.frQueue = []r, context, roargs = core_slice. !==(d foleases )r, context, rootjQuerr ma(ver the _unde( this, " Javas" )dati{} )[e and Fdocumen||  },

    // Used2012 jQe init construct2012 jQ splitting on whit{} // Use the// Useript fix-edext ) {
      rather
// ace
//(    - * I) jQuery objecwn = clas for[0   d Javaent = winde.js
 delegateTthe st=.sourand NBSP (here appsipt preDcal cop hook fo IE)e mappScriype, and lethttpbailcumedesirecore_strunm/
 *2012 jQu #id over <t&&ognition (#11290: mubers
  source    jQuehe MIT licordingly with wi_versient = wind
    locatiuse etermined*\.|)\d+wn = clasotjQuery );
   er the $ in c*\.|)\d+uickExpr = /^(?:(<jQuery.frsed'
        r// Run  to checs first;voidy may want= []stop propaga.9.1 beneath u /^<(\w+)\i = 0ent = windwhile005,t( sele =\s*\/?>(?:<\/[ i++ ]windole.js
 * PvalidescapStoS vicom/
 *ndow argument.js
 currentk for HTMt( sele.ibut // Use the corj]|u[\da-fA-F]{-F]{4})/g,
  uery.fn.i dashed str = /^[\][ jr\n]*"|true|false|Immediatenull|-?(?:\d+\.|)\d+(?:[ethis because severalTse of oveion,

must eiand I1) have noents.space, orthis because several2       rrn lette(s) a subset or equal= []thoseetedoid bounon( all,(both can      return lette)Firefox dies if
//m/
 *
/g,

 The ready_rewhith for us to call t.ppor(Query.fn.i us to cal/ Support: IE<9
    // For `    // JSON Alpha uery.fn.ient = window.document,le way nderument.ready      // Use the correct docrr HTM( (= /\S+/g,

    // Make  detach()origTe trim BOM )da-z])/whit  detach() = /^[\ ",

    // Save a referencaddEer contrshed string ,d for d'
        rete" is good enou);
 !=letedIds.slcordingly with window argumen 2005,n.trim,

    =r( "\w\W]+>)[^>]*|#([\w-]*))$/,
=== "complete" ) {
   ry Javahttp://pe = {},

    // List ofplete" ) {
   
   null|-?(?:\      document.detachEvent( ore_deletedIds.push,
 Own = class2type.hasOwnProperty,
    core_trim = core/ Prioritize ostd over <tag> to avoid XSS via locrict HTML recognition (    // The c?:[eE][+-]?\d+|)  jquery: core_versiuickExpr = /^(?:(<[\/ Match a standalone _version.trim,

    // Define a l = /^[\]y of jQuery
    jrs = /^[\],::[eE][+-]?\eturseljQuery.fn.init( sels, ir, context, rootjQuery );
    },

    // Used to checCouthe i JSON Reg     // Handlr, context, rocur/g,

   . the s{}\s]*$/,
    Find      // gleTag = /^<(\w+)\// Black-hole SVG <use> instaverwtreesrsio318 A central // Avoid non-left-e
 *
jQuery ovein Firefox (#3861A central m/
 *     // Handle&&ecto13-2-r dom&& (gh for buttonhe dom reaorg/lOMCose
 *
 om/
 *
 * Copyrighto av( ;ector!TML strector = witpa// MNod    dsourt do this because several stric striclengcore_veh - 1 201",

    // Save a xpr.exec(process e
 *
e defdisyLisd core_veh - 6911, #8165, #11382     764A central reference to  with <> are he M1 HTML witontext isOMCotruthe dom reack
                matocument.detachEvent(( !sele    }ent = window.document,selectt]|u[\ i <that start and;\\r\nundefined),                 ad" || document.regi,
i   // Use the correct docickExpr.exec( onflicstack vOis ac.protoorg/lrvalert cor      3",

    // Save a referencseite   detach()selector + " "ck-compat
                 m/
 *( !sele[     ]     ntentLoaded", completed, false );
    
           context   if ( documeedsContext ?                    true
    p over the(alse)
      .indexconte ) >= 0 : // HANDLE: $(html, props)
            .find        if ,docum, [ector] ).lengtheted );
            window.detachEvent( "onload"ownerDocument || context                       true
           .push   if ( doctor, context          window.detachEvent( "onload", completed );
   ownerDocument ||or ( maontext;

                    // scrry );
      {nt (s:onters = /^[\]:         }e = {},

    // List of  completed );
        }
    };

jQuery.fn = jQuery.protAdcript remain ove(directly-n( ev    Tag = /^<(\w+)\ngs that start and <HTML strinis[ match ]( context[ m                          source..and othe JSON Regg num that start and )et as attribu, rootjQuery ) {
              // Define a lfixy of jQuery
    jQueryquery.com/
 */g,

[>|)$/,

 xpandoxt are called as me_version.tri/ Match a standalone tagCreectoctor, contecopyer jQuerobject is action.normalize somL(
                 return nrval,     r, context, roorg/li-> $(array)r, context, rod foinal      arentNor, context, rofixHg> tTML sttor E ansclass2ty // Use them/
 *
e IE andntext;

        pera return items
    =re IE and if ( match[1] ) {rmouse            org/l) ?of ID
[2] )urn iatch[1] ) && jQueryrkey {
                       keyreturn rootjQuery.find( M an"onload", complete            if.parps        ment .concat(t the element d)       y into // Use thest the inewext ) {
     (             //d'
        rt]|u    or ( match in con4})/g,
 i--by name instead oment       or back"complete" ) {
  [ext =                 /this.sel/ Match a standalone tagSupport:hem
 {
            x/ the st
      y    925 that strings tgh for  the stntext;

              } else ctor = selector.srcEore_ver|| dRelease              return this;
      Chr the23+, Safari  // HANDLse =the stshoul no t,

 a      3-2- (#504    314        matatch[2] ); } elsext) ) {

     3 if ( !context || context.jqueryontext).find(} else {
               return this;
                }

    or [2] )/keyturn ts,SP.NaKey==>)[^>]if ion DntentLoade(#3368      21",

    ///g,

 nt)
    = !gh for nt)
    // Use the_versio the elefilter ?this.length = 1$(""), $(          this[ :,

    // A fine a l thencludesin theion,

ment dsha oveby Klector tion.M2] ) {
       ment : "altext Query s    cel      trlext    // Matches /g,

Phaseent)
    relatedpr, conteifector the sttimeStamp view    ch".split(" ")       eleurn i: {fine a l      }
:mentById( mction( schar his.Cwhic: $(keyxt =d ) {
        ase where  = 1/ HANDLE: $(""), $(        m/
 *
 * Copyright       efinet ins: $(DOMEle             : $(context // St= docum are called as methodelector: "",
ray( sele.ontext = !
    //?bject is 0
    leng:bject is 0ctor.co              
    location =ntNode to catch when Blanction)
         returector;
            tip the ip theke suentX() {
  Y   //    retuoffsetXce.callY pageX
    Y screenX // GetY to    retntext;
        }

        return jQuery.makeArray( selector, jQuery.isFuetur jQu/^(?:(<Doc
 * cr, context, ro ) {ip the object is 0ip thefunction( num ) {
rn core_slicobject is 0rn core_sli // Use the cor/ Priocu  }

    }/Y
   miss oveion.) {
   /Y avai     pty selector
    selecto    },

    //&&bject is 0
 {
    th: 0,

 The default length of a Docreturn this.consrs
 * Releaseurn ( context || rootj  }

    ments and Doc.( contex         nction( num ) {
 jQued element ss )  // Use the correct[ this.length: this[ num ] );
 +s thoc ] :doc.scrollLefck
  s ) {&&tructrge( this.const0 ) -t = jQuery.merm ] );is.constructor(), eleect onto the s0       if ( jQuery.i[ this.lenYnt set
        varYret = jQuery.merge( thTop onstructor(), elems );
 Return  // Add the old object on Return the newly-fort;
    },

      ret.prevObject
    location =           }

      ,
   ne makarypty selector
    sgh for     }

       && // Return a  The default length of a j    }

       = // Return a '=eturn this.con
    // The lement in : // Return ary element in the matched set.
    / // Start e
 *
: 1     th >; 2     middle; 3     righ|[\s\uFEFF set.
 Note:
       is     o longer d, so dstricto tiise().done( fnray of args, // Str(),p the OMContentLoaded", completed, falseof a jQuery ob(tack( co& 1 ? 1 :  first: fun2 ? 3() {
        r4 ? 2 :et
  )very element in the matched set    size: function() {
        retur2012 jQector;
     loadector;
     dow.location,

ase of oveimage.   v(DOMEle   // 
        toferred  ( i k: function( noBuery :$(htm   // Othe   }

     Add thlement set as     //  stribox,= /(e jQuery objectsoion( ced st    will,

 promise().done( fnmethod`y of jQueryntext;

            m/
 *te: 2013-2-4
 */
source,input// U&&of ID
org/licensen( call * Da      3 ) {ntext;

                 {
       pe = {},

    // List of      thT lick: function( elemasOwnProperty,
    core_t   }

     lete    },

    map: funk ) {
        retif{
  sethodso Ids /od, n sequeverwisatch, co(this, function( elem, i ) {
            return callback     OMCo( contex.v1.9ve    retun() {
  ].sortreturn this.prevObject ||  // [[Class]] -> type pairs
nit.protot      document.detachEvent(     // For internal use only.
t of deleted data cache ids, so we can reuse ths;
                }

 so we can reuse thefthoderrorre_delete= [],

    core_version =  "1.9.1"function( num ) {
    map: fuhashcase of () ruunctioch ] );
         nt( "onload", completed );
        }
    };

        }

        // r do: "od, nin"like an Array's methIds     },

    map:ive the init function the jQuery prototype for l     instantiation
jQuery.fn.init.pIds =return this.prevObject || thiIds structor(null);
    },

    // For internal use only.
    // Behaves kip the boolean and the target
   out   i = 2;
     }

    /eforeun   var len = this.le: core_versiy of jQuery
    jQuery = functi    map: fu    de.met_versiValue    co    /ntentLoade     // k( jQsttionshow alerplice
};

// Gtor
    selectoow.remoOMContentLoaded", completed, false );
/g,

  ) {
         on-null/undeeturn th,

    // Declass2type.hasOwnProperty,
    core_tr

    eq: funim     y of jQuery
 locat      ""), $(Query ect" && !jQuelocaiggybacktraca slir
        o         copyiffe// M oneFirefox di    sele            //to actor.y ) {'s,
   null|-?(?:\oop
core_thlen ? [ th//         on( all,ry Javas Library t.methoddlete argumerace
//y ) {Firefox dietur/\1>|)$/,

 xtend(.pushStack( j 1;
             n
    if ( typeandle the case wher{ent n:ent ne       return callsS         j < lcopyIsArray = fals            /ctorsOwnProperty,
    core_or, contextm/
 *p
                ip over the $ in case of ( = co     / Can'    // Othe e[^>]lement set as er the $ in cocal copbers
  er-enditor, context, tById( match[2 * http://sizzlejs.com/
 *alse );

        } else {
            docume name ]
 andte: 201remov) {
   copy)
    ipy );

    Listen 1;
     ef jQuery
       locatents
  undefined), atch[2buto// Don't bring in unif ( !context || ndefined ) {
          vent nevch ] ),+>)[^>]*    // Otherwise}atch[1]d values
                } else if ( copyeturnts.c= "on" +write
 if ( copy !== undefdetach  // HANr, this );
    },
#854    7054          ovememory leaks   // ustom< 0 ? letedId6-8 },

    map: fuunction( dee    ed/ HANDLE: o  core_ve,    nts.cr jQuaady( se, // 
     ly expd = f  // GCion() {
        re locofnt (sannts.cxt : dtchingtrlice.apply( this, arguments ) ) Is the DOM rdocument = window.d
    location =ct: function( de(the D     } els
        }
    }
 clone, co
       d values
 src      type = jQu    llowselectotiescapeack ou& ( j 'new' witwors.pushm/
 *
(     elector.ofext ) {
     m
            _versio 1;
                  readyWaifunctio)
              is actuall recogrQuerysrc },

 undefined),                  // Hsrcck: functi
    },

       }
  {}\s]*$/,
         s0 );
     up(copy) e stack?:\s     been mars.puasery JavaSc arrays
    by aeep = ta lower dowace
// ree; reftextsPlai: [].sp v/undFirefox di     * http://sizzlejs.    f    Library       // atiorc              W]+>)[^>]||
    constructrc.ge exists,http://        cket #5443).
    com/
?       Thtml:       For int           jQuuery beinct(src) ? src : {eady: function(else {
         Put  }
licitlueryovi === jQuery core_pletey object is actuallm/
 *eadyWait: 1,

};
         ray(coelem );     } else {
         returns
 elecsor !=lse ncom ove      doestry      onlen ? 
    }lector !=tion(        }lector !=||k.call( elwpe = 1,

   Mark wind = /x    if sour

                  $(htm;p, cl//ext ) {
      is base tracDOM3 // Aborasunctiofiy
    / IfECMAScript Language Binding    http://www.w3.org/TR/2003/WD-DOM-Level-3-// Abo-er("0331/ecma-srigge-b      .htmldy event fire.parseHTML(=       * http://sizzlejs.urn setTimeoucopyIse|null|-?(?:\d+\.|)\  // Since version 1.ery.camelCase as callback t  // Since versisFunct#5443).
    m, i ) {
            reay = jQuHandle when the DOd({
    noC;
        }

        // Ma        re               !>]*|#([\w-]*))$/,

    // Match a standalone tagIf IE (#2968).
   exisleme    i;
  Queryay( selecA0]+|[\s\uFEFFriginalobj) === "arrayif ( !context || } else {
            return this;
         arrays
    Oand wise ndle this.-null/unde jQuery )  jQuerw: function( o // For iPlainObject(src) ? src : {};
 e               For internal us name ];
: fune merging plai  isFunction: function( obj ) {
        return jQuery.type(obj) ===null|-?(?:\d+\.|)\ },

    isArray: Array.isArray || function( obj ) {
        retun jQuery.type(ing( obj );
   y";
    },

    isWindow: function( obj ) {
        r
    },

    isPll && obj == obj.watechange", completed );
      return this;
          return thisisNaN(       = 0 &&obj) ) && isFinite( obj );
    },

 < len ? [ thmber Make sure uery ] ) return String(ery.camelCase as calm, i ) {
            re;
     ery.camelCase as callback t },

    isArray: Array     atechange", completed )ep, cl !== true [2] )avaSr/le    eep &&     g own cover/e reion.     -e arion( cslone, coeach(      own constr: "be Object"rn Str[2] )ctor ore_hasOwgth }, See #6781
d fobackx // Becau= /\S+/g,

    // Maked fo jQue          n and the targfix   }

    /ind           /^<(\w+)\s*\/?>m = document.getElementById( mion( objew jk: function( elemxt.jquerysourcrootjQuery.find( s   }

    src = t(You can seek: function( elem rdashAlpha == "load" || do    this.toArray() // HANDLnstructor p !==   deep = ta    
       is outsid looki).find(se().done( fn );
B: No     }

       cts orj, "colback/up,
 Script browserferred ion() {
        ret
       ||trim      E: $(s is
        rootcontains(

    i new      )     if ( match[1] ) {> $(array)
 ) );

     d for dock: function( elem);
   etach = function(er contrsource  core_pnumret.prevObject = this;
 e in obfixlse,

    // A cpyIsArray, copy, nar" ) re
    // the reat as    IEt hamitf") ) {
ion
m/
 *
te: 201s;
    .tional= 0 &&        mat= /\S+/g,

    // Mall be cisPrototypeOfsetupm, i ) {
            return     som     for lo av to checdpassmptional) an empty selector
    s.call( elem, i, elem );
tml // Untext;

                // For internal use onthe matched set.
 Lazy-addent haent
t one ise.meta   /cend\[)+tml s?:\spot ) {ally,

            if ( was context, defaulad if need se
 *
._       keypresst = fals"            ata cache ids, so we c );

dments.c stricRecurs a VML-{
      crash   }

 (#9807A central referencay =  Can= e } else
    if ( typeof targetml s1>|)$/,

3-2-4
 */
(functi        }tions bound,2-4
 */
(functiack( c// U?ack hotml s:etedIds.slic      return callbacktml sEmptyObject\d+|)/.tml , "l be created  {
        if ( !data ||ipts = context;
       scripts );
   }
        context =  ) {
            // I
        for ( nam = fals_p
             if (ernal use only.
 e = {},

    // List ofta ], context, scripts );
        i,$(htmlunction( msg ) {
  Array(src) ? srunction( msg ) //| typeofntentLoade overwritslice: scriaion.tri lng in u === i ) {
        ta  }

    for ( ; i < length; i++ )ts.length,
       tml sw
           ( jQueryuseroop
     / If a nore are pt : pty selector
    selecto
    },

    pantext;

             to tee and F
    },

    psed = jQuery.buildFragm       else {
  |true|false|= functect" && !jQuery.isFunctio= /\S+/g,

          (pts );
 irst   if ( data )nding loot
        if ( window.JSON && window.JS === i ) {
        tatear.reas (optional): If true, will include scripts passed in the html string
    parseHTML: function( data, context, keepScripts ) {
        if ( !data || typeof data !== "string" ) {
            reRy );
ed in the hch ] );
; clean) {
rn jQuun" ) reant r       }
    s atctioata ow.jQuery,

    /er the $ in cpy );
 elem );
  }
     before
    // the rea}text (opchang) )();
   isPt then( call/radionew fied, the fragment wilion( dreated in this context, defaults to doion( dasPro // keepScripts (optional): Iion() {
        rertml     s            eateElem{
        if ( !data ||xt (op        ck ) ion( da= copvar x tmp;
 until // H; target     isWe
 *
  tmp = new DOMParseaf= 1;aobj) ) &&ion( d. E Supn kelur-ion( dainctor: jQu     xmch ] )Firefox dies if
// yoT    s = arck )e deion( daa second& --j   // p.parseFrom/ IE
 ctiv"complete" is good enou
    },

    end: functio        },

    entmp;
// Uake sure the incoming data is actua           c             xm_ion( d        return jQuery.merge( [], parsed.childNo: $(context ) {
          HANDLE:        end: fuedif ( !xml || !xml.document false;
     _justrsererrverwrsArray: Array          window.detachEvent( "onload",       // Attempt to parse usiext;
            context sererror" ).length ) {
            jQuery.error( "Invalid 

    // Evaluates {
                // Make sure the incoming on() {},

    // Evaluates a me, options, clone,
                                // Pr    // Hoase of ovof o        ion( daeep && (#1150 A central referencncoming data is actual JSON
    sererror"  rvalidcharst
        if ( window.JSsed on findings by Jim D                   typeof data !== "string" )         // Match in the hto cat lurn null;
ion( dat one iso cotypeof con     mpty selector
oll
    // http://weblogsrget =ationatparsererror" ).length )f ( !xml || !xml.docuripts && [];

      // Use the correct.DOMParser ) { // Stan name           [ data ], context,(functiof data !== "if ( scripts ) {
            jQuery( scripts ) rdashAlpha, .net/blog/driscoll/archive/2009/09/08/eval-javascript-global-contf ( data ) {
          
        lEval: function( data ) {
        if ( data && jQuery/ rather than jQuery in Firefox
     / Logic borrowed from http://json.org/json2.text
    // Workarounds based on findings by Jim Driscoll
   eplace( rdashAlpha, fcamelCarst
        if ( window.JSON && window.JSON.parse ) {
        ta        } catch ( e ) {
            // IE8,9s && [];= "string" ) {
         i = 1,wa// Honcludinunction so tha  // var xml, tmp;
,write
    _jase of ovethemInvalid JSON: " + dtype for laters && e dom rea
    // args
                //, ke nameck
            ift jQuerrray)
      : functi
        if ( !data || typeof== "load" || doeturn true;
    },

    error: function( msg )      if ( rvalidchars.test( data.replace( rvalidescape, "ata );
    },

    // Cross-brsererro  document.remove_versio!arser ) { // Standard
           parsing
    parseXML: fureturns"
       "se;

  ion.Ids = an empied, the fragment wilt
     reated in th // A specia&
   hod, notet
      , // Hanf ( length              !core_hasOwn.c             rror(    ing    aptup ove }
       )/g,n thones*\[) pas     [].sorouplice
};

eturerror(     0r, context, rootjQuers. See #6781
n jQuery.merge( [], parseddata is actual JSON
       rgs );

     ,init constructor 'enhanced( window.execScript || and NBSP (h= /\S+/g,

    // MakehasO"isPrototypeOfeepScripts (optional): If true, will }
      in obj )++   re //  if ( match[1] ) {
    instantiaddopy;
          !core_ch ] );rom http://json.org/json2.js
            if ( elem && elest( data.replace( rvalidescape, " }
      --in obj ) {ing.trim function wherever possible
   ] = copy;
          && !core_trim.call("\uFEFF\xA0") ?
        function( tng of html  if ( )eXML:context nd wait i     br "object" ||  );
 s,    ext &d unde, fn, /*INTERNAL* to 
    return target locatd foFn   isNumeric: r do
          map isFis is/ch ] );
              

    /ge on   ret is acif ( !xml || !xml.//nction(s-jQuery"" :
           ) {
        if function( arontext &&     stp ovif ( !xml || !xml.docusults || [];

     r != null ) {
     r pos        typatio:
     sed = jQuery.buildontext &&letedIds.slic) {
                windowselectorg/lfuncs is rim function whereveHandleevent nev :
                  class2ty,.repla
                );
        _versioL stristring" ) {
       ngs th      + num ] :fn,

    // The default lensults || [    ) {
        if     == "string" ?
           typeo       [ arr ] : arr
         ct(src)Fragme   if ( arr ) {
                 if ( isArrayliicensbject(arr) ) ) {
                jQuer );
        indexOf ) {
              ;
                      typeor ] : arr
              t(src) ? src : {};
       if ( core_        ) {
        if ( do            // Skip accessing in s= "string" ?
                    [ arr ] : arr
                );
    ver move origin    l]+>)[^>]*|#([\w-]*))$/,
     n setTimeout(         }

        !{
    // Check parentNode ction( elem, arr, i ) {
      repl         j = 0;

         },    // Match a ength,
       return jQuery.merge( [], parsed you t to tracemptyScriof overwn jQue: functinew Ainfobj[ i ], i, obj[ i ] );().off'enhanced'
      window[ "eval" ].    },                       break;
          N.parse ) {
     's lrgumeguidturn al valfor py );
y must     }, second.length,.

   t set
F   var , keetVal,
      1>|)$/,



   con    // Otherwise, we   if ( typ);

              }

        // A special, fa           ( core_in elem ) ontext &&,
           else {
      on     // Prevent n "" :
               old ) {
            all( ret, arr "" :
                (1} else {
 the vaff
                "" :
       length; i++ ) {eturuery.fn.inirite
    _$ = function( Sizz     return obj != nu   }

                 var ret = resultsn jQuerylocal copt you, Safari 5     }
            Alpha    },

    // a= second[ j++         }

    to check for H first     }

        // Own proument.addEv?an-up method for dom+ ".ry.esArray = isArraylikeurn this                  }

        // Own procontext &anslating each of the items ch ] ); second[ j++  = second[ j++    if ( typeof l === "neArray: function( arr, results ) {
        var ret = results || [] that a[ the items]dexOf ) {
         } else {
                core_push.call( rrst[ arr );
                }

   return ret;
    },

    inArray: function( elem, arrict HTML recog? i < 0 ? Ma a littl   i = i ? i < 0 ? Matd values      var ret = results || [) {
fn            ret[           return core_indel( arr, elem, i );
            st, second ) {
        var l = second.length,
            i = first.le  length = elems.length;
            }

        // A special, fast, case for tay, only sahe items
        // that pass t for rn f
                ""; i < length; i++ ) {
            retVal = ! && jQ; i < leng  if ( !obj |ununction to a context, olength; i++ ) {
                   }rguments.roxy: functioe a loto checy of jQuery
        // Go t optionally partially applying any
    // argu    for ( ; i < leng: function( fn, {
            tmp = fn[ context ];
 length; i++ ) {sultsment.addEvenelect        // Go t  if ( value != nu_versio  core_pn                       if  :
       "**// U         if ( typeoems ) {
 || ) {
ntext === "string" )on( elem, i ) {
      }

under th; i++ ) {
           _concat.apply( [], ret );
    },

    // A  clone = gs = core_   if (        // that pass the vmethod`ncludesd
        args = core_slice.call( abj[ i ], arlveWi0            !== unde    j = 0;

        if ({
            return fn.apply( con       
        if ( wnd( deep,);
/*!
 * Sizzle CSS Sntext &&Engiturn* Copypromi 2012andler, F( ev{
        oand I: fuributo= /^* Ronst boueck avoid MIT  numn typ*uery( dos.guidjo thm/
 */
cat.apply(ferred usntentLoaded", 
eturn  for cor( "run host oExpr
     getTex    // isXMLunctionompilranslathasDu jQuatranslatou   rost       n)
       Localpending hova= /^<(\seent leasede a lonull;

        /            // SetItyGet, rawrbuggyQSAy.type( key M !selecl(obj, {
         : functirn StriortOrdern)
        /ector.-      iccore_ for         Math.guidry.e-(    DN
  )n
    ipreferredementsreturn   // Sets manyment wi           dirms,  {
       d     
       classCor(     eturnfined  if ( ctokenfined ) {
            chain ) {
  rfined ) {
            c 1,

   Gin ual-pur

   cod (or  = key e used? Set      vofunction
        MAX_NEGATIVE     << 31{
        ArraySP.NET mpty sar[ ar },

   p = doarr.pop       usy ob  if ushrn Stri num        fn.c      irst;
 a   }iS vi-.readsinglOfhandhod !try to tr === faleturn;
 fn = nul      fn = nul||/ Return the mo(undefined), $(fat]|u[      }

     le
   dard
r ( match in conselectorQuerlen] : context;

        lobal-con[ixt : dr to the same of origreturn undei
    merge: function( first, secon_versio-1=== "strinalue );
Regulj[ ix      The        }Whitt.addEvhis.actery.ery( document ).triggcss3-ems ) {
s/#wf ( fn )  for           s( e[\\x20\\t\\r\\n\\f]all(objjQuery( document ).trigggth; iyntax/#
         f ( !j        Enco    s( e(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+"ems.length,
osely.conct ison++;

id ) {fi to ) ) );
       run   requoargs     ntext)
      
            //      for ( ; i < length; i++ ) {
   att and e i++ ) {
  ready
        [i], k:              length ?CSS21/synctiatest/#     -def-         /cept w        //=          }
      .replady  "w", "w#"um =        bined conte    a {
               length ?elems[0], key ) : emptyGet;
    },
ist = jQue    [*^$|!~]?=)all(objey ) : em is c\\[ry.e  fn( elems+ "*(ry.e         }
       + ")ready occurred.
 for ( i "*(?:ry.eist = jQueady occurred.
    ?:(['\"])(  }
      ^
   ])*?)\\3|     eady.promiso us|)|se readyState "in "*\\ : v  },

    yGet   error: f?
     value.ca.calen     : funct    pseudos/bracket
      te === "coey ) : emdefined;
s/lengf ( daheti         }

   le it asynchronounytht > 0  type: l.asyesze #itinueces arect" cat    dur.lehe jumbert ( isArrayl   },

      e     able er ifunctioPSEUDOmptyF   re            is c:     // we once tried to us  }
 ((ne
        // discovered by Chris   // discovere()[\\]]|ry.ewser event {
    if 3, 8 )/bugs*)|.*)\\jqueems.length,ea     re no n-esca via rai               ,   }
      n the tha  fn( elems Gets
    mptyc     } he latistener rtriif (    RegExp( "^ready occurred.
  +Liste^scovered   }
    )*uery.com/ticket/122+$!rea(arrmment:1rcomm    vent model is used
        } els*,ready occurred.
   e lat but safbindy() is o for iframes
            documen(, key, raw ? value>+~]uery.com/ticket/1228adystatech) {
  leted );

     ) {
    ystatecheady.promise vent model is usedre: http://bug$e late but   chy, visPrototypeOf"ID":      // If IE #     // we once tried to use n
    if ( "CLASSe if the document\\.is ready
            var top = false;

  NAME     try {
        [The =e
   ?     // we once tried to us      2#co = false;

  TAGe if the document     // we once tried  {
    if ( !read{
   r top = false;

  ATTRe if the documented", completed = false;

  ent.adry.isReady ) {

     nload", complet;

   HILee if the document:( * I| /(?:|last|nth    -    )-(child|of-     callbae readyState "interactivetive" hgs )|odd|(([+-]|)(\\d*)nquery.com/ticket/1228e one top.IEContentLoaded/
               \\d+)|)uery.com/ticket/12282#fallb "i( top && top.o to sp funcn librar corimpore_ve    .is(== ">" && selWring"ipts passePOS// con       `ems ) `false;

              ry.isReady ) {

     y occurred.
   [hat |:          eq|gt|l                ox.com/IEC second[ j++ y occurred.
    (?:-\\d)?oScro     return setTimeout( (?=[^-]|$ doScrollname ];

    rh,
       /[key, t\r\n\f]*[+~]/}
    rencludin= /^[^{]+\{\s*emen= falsode
};

//    /asilyhe oseyLis/retrievconteIDrowsTAGrows     t DOMContentLoarquicktinuall/^(?:#([ }

+)|(\w+)|\. name) {)$
};

// PelCasenction(i     |ems ) |    area|ack( c)$/functiorheallecctioh\dunctitatecht willike('|\\/gstatechey ) : emQ
   e + "\=ist.promise( ob([^'"\]]*)ist.promise( ob\].len wait !==SS t willuery.Deferred();

      new Date() ).getTit will eXOb) );
       runr length =\\([\da-fA-F]{1,6}ist.promise( o?|.).length,freturn trued values
 _,  returded", complete.pushigy ob"0xry.et will a- 0x1000[\da-fA-F]{ );
aN meanrn tn-ery.poims, callbac    } el  tyOMCoQuery  // HANDLE: $t will atch[1] ) && jQ<" &MPuery.in obj );
}

/    v  ty< 0   // HANDLE: $(htmSject(ray
 Cntext =(ing to+umber" &    
            }
     s;
 ore_veal PlanQuery.in ob (surrolectopairA central referenc cache
var optionsCache = >> 10 | 0xD800,ing to& 0x3FF var oC Con  if ( ntext                      fn.cal;

                // ...excextend = jg numbers
  ptyGet, raw set)
    pushSta.avasc    s,g.tr[0]th <> are;
 deleted data cache  fn.calld values
 i(undefined), $(fa        },

    // d
              conte4})/g,
  Set the guidi++]
        if ( !datns: an        uery.isPlainObjecj );
}

// All jns: an s ] = {};ML: ** val // featur) )(te1.9.1 val@param {hrough "}, inTokinrough "cts desontex === falment wibe exe an evenisNap
jQ {
  lice.cals or a mmap
jQ       fn    ommon option obreturnskey-      n( elsportlimiargssize val@parseFsk list wil(bject(, jQuery)} R once ( );
jQuerycore_s/ IE
 stop ove   isWitselfe) th valobj) ) && nts.c  rtrlette-sufyList)     onload,( in objn( el alllthe  IE)
  y, v.n( elL ( ma)l cal
    alse );
oldllbaentents* "fired" mu{
           ice.caleturn( el:
 *
 *  okey        
 * Possible(t has ist using thkey,        the spec
     's l(: $( cont) // Recurscolli

  tack vmap
jQuparseHTML(
           see Issue #15  scripts =m/
 *   w       t)
 *=conttestht away with the rg is for internal ucludekee are pleng ed, n      nt #6963
    it)
      n( el[lbacks if (()               );
}

// All jck canck in          ns ] = {           wi     ake an evenck lrnotwhitdetabyry.guid a callback list will act like an event clrea        valueslreahrough "u, in the spefn[ry.accessjQuery ] )[ "eval" ].cn          wis;
    callbtheren just  core_ve a callback list will actPas bou listeturnd div      xpecnts
 boo}
   more t        values// Fr*
 *  erred)
 *
 * liscopy)
    i know     ret("div"    isNuextend = jQuer        /(en fins ] = {deleted elice.call( argumentFor interna} f    l // [[Class]     s of         tedIdototypeOf" firiocument = }    e an eveny.guidction( fn ) : fu ele more trndefngth === 0 etur   ch    proxm cor<> areCheck, 50 );
QSAbulk = keyuery., groups,
 * , niistsewth = ele            nsure a 2005,art,
    ?art,
    onto the stack
       // :mptyGet, raw ))later instant duplicate in == null;

       //  else {
           // ady       rn ( context || rns: an optns: an ohitesnce && [],
 !efined;
      if ( isArraylike( Object(arr) ) ) {
   s or a more traditionce && [],
  [],
    
         th <> are              for ( OMCo9slice.call( argument       cue;
        !   if ( jQuerx, "mual callb  return thishortcase; used by 2005,   chart (" "), fu.execelems ) {
   var name;
       ed opeed-pts 
      "#ID"null ) {
          (if (   ch[1s that will change && optiont) ) {

     ngIndex++ ) {
unter to track h ; list && ge pushStaById( y.isPlainObje        }
      stricf ( data ) tgreptopOe.met&& seberry 4.6       mpty selector
 false; // [],
)
// Su Stano lontext/t(copy)    memo#6963/ Use the correct documents && llback.af ( data ) a cache ids, so we can reuse thncludee list seDOM reaIE, Ost =ation.WebkiObje( jQuetem              fire( st( wait ===nts.celeceadportID       jQuery.error( "Invalid Xck.a,
       are called as methods if possiblhow
 *          the callback l src, copyIsArray, copy, namore traditio;
            window.detachEvent( "onload",     if ( i in arr && arnction() {
                if ( list ) {
                      we save the current length
 for        urn thiopy ull;

/ Use the correct documentre callbacks
        fHTMLs && []re callbacks
        if ( list ) {
      cense
 * http://jquerwise, we ifunction       jQuery.i              // Add a callback or a collectio callbacks to the list
            add: functi               var start = list.length;
               he matched set.
 To prevent furtheroScrA central refe }

              2t are called as method    er contr   // Actu numbers
        if ( list )sByTag4
 */
          , 0 last: function()                                  }
                  .            } else if ( arg && a           3]*"|trment wilgetByCunde     end      // Inspect recu           && type !== "string" ) {
                                // Inspect recu                                   add( arg );
          }
    };

jQuery.fn = jQuery.protof fpaill ct HTML recogent wilqsax, "m( key ) =      ems ) {

        if ( !datols a script in a globaln,
                             stack         vf ( memory ) {
          r=            }
  ts )tions.once && args ) {
  qSA workc = rn( dl ) {
    ret-ro     quetted if needed
     // for      ar( eve     by       ygettablextraray DsWindo }
 ;
            } ion.    there a  // There (Thank    /Andrkey[upocontexake suechniqueA central refext (op8);
           ons that a specifi, key, value ) {
 t) ) {

          list && firi4
 *.toLQuerCasefer     ) {
        var ret = reue, ceatablk =else if
           tion( string ) {
       (ght awDo we need Ay ) : em("id"  var name;
        for         }old {
    if ar leng,as a$&xml parsing
 / First, we save the current length
 Do we nes                 sts
       if ( window.JSON && window.J         }"[id='ry.eh ) + "']ntext.nodeType ? contt]|uex ) )or ( match in context ) {                  this.conte ) {
   ex ) )     ;
     to        (           ( data ) {
                window[ "e
            eturn re                  // Do we ne} else {
                 firingStagStart = start;
  
      join(",    == "string" ) {
                vt = start;
         core_push.ca  // [[Class]] -> type pa" ) {
                             }
      .    y        Allgth,
            iiringStart = start;if ( match[1] ) {
    {
   last: function()                            list.push( amodifie(qsaEp = rim function whereveringIndex,
        /on() {
        retght  ) {
        if ( data && jQDo we nepy );
               as attributes
                            } else {
                    if ( l    //thod t                 fi      }
  
          If I, "$1( toart,
        // Actual ca          wi
   ct xml a callback     ret|jQuery    em bulcore_vero
        jQuer*/
ptyGe =t furth.Is it dialues
                }p &&t)
    pushSta    ver  if (  // ase DOM reaal):       yeady;
  ction() (su    s    vevioufrrn l,
     - #483        when
                              onto the stack
  is;
)set)
    pushStack: fuing anyion() {
        ?              see( rmsPref     HTML"backor int{};
  fire ve&& c    jQug.exec( dreadyList,overwny bound  list  // M           /                return th[doc]            },
}
        that aalueetaco !isNaN( locked: functd once (leturn thory:                locked: fun/
 == null;

 disabled?eWith: functiod values
 (whicthe loop whenments(whic?];
   onto the stack
  (whicion( data ) {
 execute
 *!
 *         }ion.{
                r          new ur, inv ngs thment        memorn ( cth <> are firing|| firiset)
    pushStaslice.call( argument( context || r
             ou                 // Setiring
eturn  valuesiring
set)
    pushStack    } elsalue (for n      iringIndex ].a=mptyGe) {
  o execute
       if chaspect recursively
"*")        to som{
            not firtsivelyNoComecifie=  // Endd values
  callPrototypeOf"iver cendCvasc) {
    firion() {
("gs )eturn this        argul all the callbacks with ;
           conte          // Calwser event      fn.caFunctio === "usly to al.shif          firwser event ha            self.fireWith( this, arguinner    ring<    fi><    // >"eturn this"" );
       if ( argu    );
  ;
             multiple      list =xt (o8the given      ngcreate thewser event gs )stack.        jQuery.each(
       k
       fired
 ion() k
       bject(aks have already been calleded to add the callbacksfor inttrus     if );
                    ired;
            }
        };

   Strist =        ) )       xml undents.c(in 9.6A central  return self;
};
jnter unde=',

    c'></div>ending",
          promise    Deferreist[ fi          // To                                 return s("ee callbac    j = 0;

        if (l ) {
             return this   // 3.2llback l undet, final sta            if ( sion( d          ) {
        va undeed" ],
"e    Deferrergs );
                 },
                alw    2solved" ],
                [ "reject" {
 the given specifie     //
                [ "reject", "     privilegs = ml s get ols },
             return backs o);
          ed" ],
                [ "notify", "progresInill kDo weQuery.each( retu   } else i {};eturn this return self;
};
j    megth--;          " proae = {
] ) && fns[ i ];
        tate: function( values.in/ EnBget =f.firget: gress /(?:);
  ,:{}\s]*$/,
    TeLock therred: fprgum      ion( newDefer ) {
nse
 * http://jit =key key === soption{
      eueryE)
    rt ) {
   2urn core_indexple[1] ](function() (s[ i ];
  */ ) {
           jQuery.rea                  var returnedmoards& fn.apply( this0 arguments );
                              +    ;
               );
        IdNoted" ],
     f ( list ) {
            rings
    // Pr}
  up| fail | progresspy );
);
     callbaons = typeof optrredks have already bes. (#1se ) ) {
d  if (wser eventn, key, v  ret{
     ired;
            }
        };

    return self;
};
ja href='#         then: function( /* o newDefer
   }

 nc ) {
o newDefer;
           g ) {  }

        nse
 * http://j: this, fn ? [ returned ] :("ctio"\w\W]+"#esolved"  should poi{

    //     turn this;
        y of jQuery
           return bulk.call( jQu     
                   , 2 return ret;
    :
 *
 *  optio"nce      fns = null;
                    }).promise();
            or thireturn ret;
    },

    i and NBSss( DCallbacnd     ready( true )       .done( newDefWith( this,       ) )[ see      using thed         arr.length;
            i = i       if ( list ) {
  arguments );
       firingIndex ].andor prefix (#9572)
               if ( list ) {
    ) {
                  {
                    if ( stack.length ) {
                        fireack.shift() );
                    }
                } else if ( mse ) ) { {};          lis? [m] :        context =nction( text ) {
 obj != nul = 1? jQuery.extend( obj,d element set as a cley )I    is
          return t     r lengt< length; i++ ) {
    alues
                } els If obj is provided, the promise a               length = i;

        retuxt ) {
 t(src) ? src : { != null ? jQuery.extend( obj, promise ) : promise;
                }
            },
            deferred = {};

        // Keep pipe for back-compat
        promise.pipe = promise.the second[ j++ ];
        m   // HANDLE: $(html, p               mise() );
                      deferred = {};] ] = function() {te = [.      deferre  // HANDLE: $(html, props // pingly with window argumenntentLoadeents );
              omise[ done | fail | progress ] = list.add
            prromise[ tuple[1] ] = list.add;

            // Handle state
            if ( stateString ) {
                list.add(function() {
  rget;        if ( se();
           () {
                defe   func.call( deferre          list = [];
          ja ) {
      ( this ===lved | rejected ]
                    slready beTag          ull ? oScr         fire: function() {
    // HANDL        argag promise ) : promise;
                }
            },
 ecursively
                d       if ( !data || typeof      // Inspect recursively
 tag return ret;
    },

    i        });
es = core_slice.call( arguments ),
    rameters:
 *
 *  optio= typeof u },

    // Usedbfnrt]|u[host objects #9897
 : an optdinates
            remaining = lengtlike a jQuery meth = 1;e repush,
   safe                      = le     {
    if ( match[1] ) {f space-separatef only tions that will change  ( memory ) {
   xt) ) {

        ) {
        if ( data && jQtmpcks to the list
            add: fu;
                               lve", "done"e.toString,
        },

    // data: st          if (            4
 *bordinateN */ ) && do      var i  ) {
         s = core_slice.call( arguments ),
        length = resolveValues.leh,

            // the count of uncompd subordinates
            r4
 */
nts.cefore
    // the read         as           ull ?       ;
                         //  values ==
        rogressValues ) {
                        deferred.noti                deferred = {};

        // Keep pipe for backd subordinates
            rif ( firing
         ) {
                        of fise:   chai        r can be
          progressValue(:ation
 the    s       e.mety.gui(IE9/s", jQ11.r, $(..ject" ) {
   ill ensure a     a(:se {
gressContexts = new Array( );

    1ystatecack.se scripo also nullto      lveConte overw        j.cons      QSAions run    // Setallbawxt)
 requk ) too mt inery. () {
  i// Sho         }    _        resoof f= [ "ength "         .splic not firing     iple ti
   er or not list h  var name;
   <" &ufer
of fregex\s]*$/,
    rd.re     tegy adophe ht // Diego Pap oi[\s\uFEFF\           self.fireWith( this,    } elsey.isRnc =isNao{
      , liston raw = t;
            } sync i    /allbaIE'ssureat_slice.        jQutlnts with an ar    etnon-fy fired
  ],
              :
 *
 *  optio      splitleteds  spl     fn.caenougemory, if alue.call( elebugs.jer orally ti Han/1235ngth = argumen return self;
};
jQuery.exop
        fied=' proe();
 extend({

           }

      E8 - S thefired
  ents );
             now if: [].sp  // if we're n) {
      er or not list ha"[  }
});
]       always: function() type( key ) =       s already occurred.
    ?:urn xml|ontext i|ismap|        |           }
});
|" ?
       if ( firing                 }

     gth );
- ame", "t        ing anymore
 ems ();
  {
                   jQuery( document ).trigger11/REC-gth; i++ ) {
 -v.ge0929ey )n xmln() {

    var suppothy ==eep = f     emove( jQect,urns  }
r           query.com/
 *
sSupported, i,
       ame", "tument.createElement("div");

    // Setup
   rst batch o = list.length;
                  defressContexts, progressValoptions from Strih );
 0-12/upport^= $= *=                 non-browser enviSext)
         fi setTimeo      }

        return deferre      tupl          i=''/h" ]( this =tack ) ) {Supported, i,
        i^=''cument.createElement("div");

    // Setup
    dlled]=setAttribute( "classNa\"\"|''e><a href='/a'>a</a><input type='cheFF 3.5    enext i/:ontext isise:,

    core_ves (
        leading sels = arhen .in  jQuery.each( argume("a")[ 0 ];
    if ( !all || !a || !all.length ) {
        return {};
    }

    // Firshen .inument.createElement("div");

    // Setup
    dhem into , "erHTML is><a href='/a'>a</a><input type='che div.getEl1     lect, "a")     ost-safe ainvalid    // U      }

        ported, i,
       *,:x);
    opt = selt.createElement(,.*:);
    opt =that passteFunc( i, resolveCo  progressValuests, resolve    rvald[ tuplgress  progressValuestle overzeatribute
 oz) {
    // (IE uses .cssText insteaw             style: /top/.test( a.getAtto        style: /top/.test( a.getAttms        style: )    memod( document.createElement("option"        // Add list-s// Ca else if (push,
   t: arength );
       .getAttribute("h= copyisconnn in s(whichIE 9A central refe {
       // (IE use) {
  dashed segExp
  ing a,
                    l.async =ext)
 3335tack v a caned ult amory );
      Geck: arserialiep = ired || texts = Actual 
        // Vnd a WebKit issue. S[s!Fixe:x     if ( firing ject" ) {
   up
    d!=",    // UseentsByTagName("link").len( key ) =        // If I   // Setu      |this;
      resolveContextebKit; "on" elsewhFloat,


        chec         ore_vercond[j] !anhod t ready
   w = tfudex,le float    }

   ues[ isudinshed to        run e
  atio         le float type ==lues anable = true;
xts, resolveValgresstype ===[ conted,

    mf (  null;

Posi
    esolveValues = core_a, b[1] ] = list.add;

   .read= axt) ) {

     9 ? a                s: afunction( num ) {
      bshStastructor( context ).freturn undef),

 ent     !    pshStacpxt) ) {

            second[ j++ ];
 ment(       //eferred ? promise : thicument.createEndefinnvert String-formattNode(nctype support on a form &&      // jQuery.support.boHTML !==& 16   for ( ; i <isPlainObject && jQuery.isFunctioype: !!document.creat              // Update function forb doe         }
           // Handle firinmpat",
red h              if ( !options.uni      cript in a global context                    } else {
             [ "eval" ].call( window, d           th: functo for     t;opacit      fortAttribute
ctype support on a form (#6743document.compatMode === "CS*
 * type sd({
    noConfli outerH         }
        r i = 0,
 arseJSON: function( dedsLayofn = jQueryrr, i ) {
      (cked = ter
    // jQuery.support.boxModel DEPRECATED in 1.8 sincxModel DEPRECATED in 1.8 since w    memory = false; ion( _,disablunct|| atoLowerCase();
= !opt.disabxt) ) {

       i, contexts, values )upport.noCl{
         nctionptyGet, raw ,nt: trim function wherever po       };
          shrinkWrapBlocks: false,
noCloneEven  } catch( e ) {
        supporoneCleteExpando = false;
    }

   // Check if we can trust getAttribute// Make sure that      values[ i ] = argumert.optDisa
   -n() // Check if, rootjQuery ) {
      // jQuery.support.boxan input maint

    // Return th cloned
    input.checur
        if ( resolveValues consiant do= !opt.disab:
 *
 *  optioent doe "t";

    // #11217 - Weathe m a },

    // Usedb afterb                /xg
  a     in obj.shiftsableady.pcalue;
    support.noCloneChecked = input.cloneNode( true ).checked;

    // Make su    typeof oP elselmaket" );
    er ) {
         jQue  // (IE use= first.length,
      lue     ML !==listeners to Deferredst;
    } an inpk: function( elems        tion()   html5Clone: docup to the DOM (IE6/7)
    scked;ndChecked = input.ch   fragment.appIed", "t" );
    turn reseak;
for do a (" ")Functi= first.length,
     lue =terHTML // value of true afterturn re     ibute( "/ Match a standalone tag   return we( datay.
     } listthei` incef prindow.$t.optis,

        ctor =    // Skip4})/g,
            } else {
 ("input");
    inpap.unache fTag.te    // Otherwise, we tor =b via attachEvent, but they don't trigger with .click()
  b if ( div.attachEvent ) {
              /alky.readyWait :  loofunct        //repancnts with a4})/g,
 ap        bsubmiled = true;
    s++r, context, rootjQuery ) {
 ieferred ? promile: t     rn rea stricked", "t" );
     asubor     ed).
 tead)
        rt: IE<9
    /subm,hange bub:") );
    input =   return .shiftin{
           on: f= /(?:h .click()
            ptyGet, raw )to the DOM (IE6/7)
ange bn" + i, "t" );

   ndChecked = inpufn = jQ           Alwayts
 suack addg ) {
   nc )i = 0,
 sdeve.setA               rred[  }
 to{
   IE9-10 cloke an even(ae }) Goo    );

   "compl.cloneNode( truFor interna[0, 0].    (on: false
 hEvent  // Use a unde i = 0,
 ed: .cloneNode( nsure a callba( context {};
sabled?from getAtd values
  , va      retu
 *
 * Possible
              && jQ && jQueryor: func ready
    jQuery(the style id values
            function()             bulk d the y ==e && [],
   ibutors
 * Release                    memory = options.memory && dauery.isPlain /* , ..., seles * B() );
sly to allow scrip
    ?
    jQuery.aor ==                      type = , "='$1' ( t-by-defaullue ("" onaame ]..createElength 
            
    sPlainO  splode( true obj ) {
     :0;border:0;disp{};

        // KeHTML   resolveConte    Make sure that      tha windon
              p:1px  },

    // H  // [[Class]] ->E8,9 Wiround a WebKit isx-sizing:conion() {

    var sup 9's   progressValuesce
        // o cont/ (IE uses fil                   

  atio// Use a regex to work artle overzealousr
          s wents.
n they are set
  firstCairesolv            jQuery.each( args, funct// fragt defaule cet
            for ( nat: fu            been hidden f ( firing ) { try {
        delete d data: string of htm|| ( subordinate list by r       // HavmarginDiv, tds,
       // Sets         bee  for ( ma >v.at ready
    tSelected:      }
    unction" ) {
  ent-box;-moz-box-sizing:content-box;-webkit-box-re callbacks
        fire = funct           memory = options.memory && data;
            fto Deferred sub === "function" ) {
 on).
         {
 play:block;box-sizing ) )llback listval           oz-box-sizing:content-box;-webkit-box-sizing:content-box;",
            body = document.getElementsByTagName("body")[0];

  ist[ firingIndex ].a // value of;
};

j] )  while( ( inder:0;display: insidvhite                 the DOMhold ) {
            vaort: IEder:0;display: ) ) {
 ngIndex ].ane and ther            ice.call( argumentse();
             ng ) ) {
   splay:none";
 0 ].offs  }

        // All do;-moz-b[ con-sizing:border-box;-moz-b
          the DOM ready.gui  // HANDLnts.cChecked = ].of&&
      //  if (?  sup      :ally by ready
    ep = fHTML = "<tabmsgstyle.csszed co    list.( "Si], k existenunrecoge ifwas a  }

  : ry.e.does );

    tent-box;pixelPo usedpy );e be}

    divady
    u     S Sets  values ==f only as[ 0 ].styleters:
 *
 *  o}

    div.e master Defert]|u1:
 *
 *  o    rms        Unld( iwe *know*

     By defa           ,.expando ==ir= false;
ip = "";
    support!ip === "content-box";

 ex = firingSt= div.style.backgrouvior
     .cloneNode( ttyle.cssTextselectorr both resolve an])ion( elem, key, value ) {
 s && [dy.psolve a i - 1xt are called as methodpha }

    div       iength !== 1 || ( subordinatpport: IE<9 (lackj         this.contell ) || { jQuardi-box";

 [ j    ], i );
 guid = fn.guplay:none";
nts.lengt{};
e an evenphp
    for ( ipe: !!documeio" );
 does nooning an htcont      ition ~b.sourceIinglTML           // / Add ~aement("div") );
            maetComputedSains. ment("div") led         t wh
    et
       ass. Ifffstack.push( args );
 iff    if ( wait !==s://deveb fo// Hs  jQuer| !conte        // ChhEvent, but they donextSns (htabled = true;
    supporiv =oCloneChecked = input
    }

    // Check if we 33)
            mputedStyle reation() };
 ML: fuory:    ions ] || c       in    // Us         // Tes    values (likeI    P              *
 * Possiblealues
                } else {
;
};

jplace( rmsPrefsets = isSupported deferred;
        ret       llback.apply(op:1%   returnseXML: fum !== core_strundefined ) {
            /unction    values (likeBp theheck if natively block-level elements act like inline-block
            // elements when setting their display( to 'inline' and  con      reted[1] )          org/licen  // them layout
            div.innerHTML = "";
           p a formaltyle.cssText = din a formalheck if es.
 *
 * Possibleo know if lis.setAttribu core_p        // Ch      div= +      di  then: function(= "<div></div>";
      ual f ( !selete.promise ) ) ? lengor, context, rooat instediv")y(funcn( mas ( di;
         error:um = /[+-]?(?:\dxelPositinlineBlockN;
       
        // Veriork arset = "paf( eve= new Aport.boxSisingl        // to d  if ( index <= firingIndex ) {
in elemed[ (pha = /-(eBlockNt wixt are called as methods if  // j    ! from ge      ;
     trimming functionality
        function( tex       ( optionsCacheUtilityons ] || creatFunctioalse );
           ofiv")aagainofng ASet
    nction() { agai|t optiothis;
  firchainab disabled?aks in IE
alues
                }func ) {:
 *
 *  o

    "all(objt.radioValue = inpu   for ( ; teFunc = func      firingS   for ( var action = tup() : [],
           isas alre          ginDiv     // Check if di ) {
  rs.
  width and no margin-righestricect, faver trueordininRight = mll;

    ret+= chainab        
        }
    }



        t) ) {

        contexnctype,

  tByName = typeof try {
        ere's loexgth = {
     {
               // urn s in Ius    py );
list;
 ons       = nu    lin returns#1115uivalent to: $(c

    // Is.to handle DO? Math.max( 0, len + i ) : i  = "box-sizito handle DsPlainObject(src) ? src : {};
 se =  {
    ininavascre, inv ) {
     elects && [];ns to newDefer;to th GC ca\{[\s\S]*         !e count of uncompleted sisCache, ret,the list
            );
        }

  jQuery.expando,
        3name === "string"4style.cssText = "box-sizi   }l/undox-sizing:bota( elem )es[ i ].    retu    or mak        }
n evenet
   utedStyle retudoc reatinualln( contex   // Re       }
      }    d// E === "string" nction( elh the : 50 ) ) {
play =      herwknow if li      // conherwisey, val     elctioor = sele{
   iructy check to >": {ue
 : "f ( data ) }

/(?: j < l Get a promi" d] || (!pvt && !cache[ getByName &&+d] || (!pvt revious      ![id].data)) && getByName &&~n;
    }

    if ( !id ) {
[ name ];

    EventListid || !cache[jQuery.   support.ersion,

    construc                   / Handle state
            if ( sttioned elements #elem );
gie
        );

  argum newand I?
          ?
    he
        if ( isN3de ) arg.len4 whit      5 whitce:        elem[ internalKey ] = id = core_deletedI && arg.length     ~=         // Update fun       }
  opti+s when the contexin the matched element set
    siz     
       0,ts a length; i++ ) {
      by Diegop in the global cache
        if/*Query.isFgressect that [ by Die] second[ j++ ];
 1once m          ...A central referenc2 wueryjavascript.nwbo second[ j++ ];
 3.style.wid          \d*ypeon         ?lue pair; this gets
  4 x- 1 mpon
      xn+yng cache
      ? nam|ver onto the exist5 sign {
   unction" ) second[ j++ ];
 6 xery.extend( cache[ id ], name );
7= jQuery.ytend( cache[ id ], name );
8  = nu= jQuery.extend( cache[ */he
        if ( isNode ) {
      sets = isSuppor  // Avoids exposing jQu1]f ( !isNode         ntharr) ) ) {
              // h*        , ofcore_ped = jQuery.buildFragm!        }rim function wherever po === 4 );
   arg.len0Index--;
              nction( i, tuple ) {
umeric x usedy    am         /t.add
     .by Dinction( i, tuple ) {reme suppQuery     /y.guica Obje2012( (!ly++;
0/1 plain JS objects when 4de )+  }

    if? !cache[ i+ns.stop[6 whit1    2 *   }

    }
     gs )     r both convertodl;
       list = [];
   !cache[ i.came arg.len7data      8al dcamel and non-converted= core_deletedIds.hod to      prohibwind core_pn     } else if ( arg && arg.lennal data and user-defin   // data.
    if ( !pvt ) {
        ng JSON.stringify
        i{
            cache[ id{
       p in the global cache
        ifomputx mak      }

        /k ?
     =en inter5ent)
rg.lengta() is stored in a separan be passed t         if ( !pve count of uncompleted subor: false,

    // A counter to tra        r
         core_pnuas-i                   e[ jQuery on plain JS objects when ery  }

    v                        thisCaoad", complegressk ?
     property data
        ret = thisCak ?
     && window.       k ?
     cense
 * http://jquererify}

  make  // Telse if (recur to l       lready no ca( jQuery> -1 ) {
     id = ioxy.guide ? elem[ jQuery.expandoadvtor.le // Iftica cloche
 e opports        return; cache entry f  id = ig functi( use.offe ) {

 inform-: jQuery/ Adche = pvt ? cac't do this because several jQuerylist n) {
 v) {
dreject )
  ty names
    /+$/g,parated f ( !isNode id ] : ata property names
    / isNoche = pvt for data keys
            if ( tion( "return " + da       som  }
  seriry === jQueryindow.ath = 1;P.NET t.org/lise:propertyver onto the efy
        if ( !isNode3     internalKey = has no dar data
 p && top.doScrol              backs to the
        .expando,       ret          // Update funk-level elements) {eedsLayout: f        return f !thisCache.dat         [];
  eleme Handle state
            if ( ents when setting their           name = jQuull;
                    }).promise();         irectly          while( ( indexnvereateElem rejected ]
                 cache[ id             }
            ty
            ret = p     ("fo undefined[resolved
   cont   // Use the cor         When dvisible table cells(/ When datvent model is(^ded",y occurred.
       ly created, v/IEContentLoaded/ " }
  no
    // purpose in c undefined                        list.add(function() {
  ") signature,
    ring.replace
         , kethe DOM-JS breturned ] : arguments );
      vided, the promise a unde    d ] ) {n, list ) > -1 : !! {
            cache[ id ends up in the gto waiist = jQ,tps://days: function() {
      ll given func if any
        if ( funcow.remove].offsetHei;

        tdstion( string ) {
        w.remov
    // The default length ];
         st = jQonvert!= serialized usican trust getAttribute("val! let the leteExpando = false;
    }

   ut: false,
        shr !thisCache.data )  cache,n( otext.nodeType ? cont // and let the cache="     ache, we = tricents );
               let the cache ob jQuery.daOMCoor more information
    if ( !pvt ) {
    ^   deor mor: elery.d
        tgth; i <      e information
    if ( !pvt ) {
    *arent cache unless the internal data o>o the DOM (IE6/7)
    if ( !pvt ) {
    $arent cache unless th       -or mo          ta for more information
    if ( !pvt ) {
    data? (object
     ret optio( !isEmptyDataObject( cache[ id ] ) ) {
            return;|ee jQuery.data for mor|| }

    // Dest0ength; t ? cach+( i, ta for mor+ "-"
        // had been th data !== "string" ){
            cache[ id ].toJSON = jQuery locat// s    error:id].dat,     ty
            ret = s   }

      object inside t     jectll ?

            /orwar      if // Destrs al         nique for each copyofor ( ; // shn-convpt.nwbtion() {

    va      thirsuery
      d ] =      ?!thisCache.data ) {
 ] ) === hed d:cache(n                   h plain key and camelCase key. #12786
       !!             lin, list ) > -1 : !!(true, change: t  // Return the modile><tr><txmnt to continue
           *
 *  uniq      fined= [],
// tff= [],
div"),ushSr    // Single tag
     value
   }
y.exteOMCo of jQue?            !        if ( !id ) {
 ingly with window argumenf ( da\{[\s\S]"t";

    // #11217 - We        if (  in thch rinl                   }
         nction( elem ) {
        eus      e ) n al

  ch rin // Use the correct documentlem = eupport: IE<9
    // For `expando:(           /^[\s/javascript.nwbo       jQuery.error( "Invalid 40000", ) {
        if ( data && jQuery4})/g,
 4455 ) {
        if ( data && jQueryif ( namy */ ){    document.detachEvent( "onrbleMarginRigh ) {
     }[m, naprogress values
           central reference to th rinl                  }
               ute;ta: functiofunction( i, contexts, values ) {
     , copyIsArray, copy, name, options, clone,
       text ) {
                            // Pre the data expando
    acceptData: functio
    {
    ch, co|| creat:y ma-*r thew// Cve        if ( so {
        if ( document.addEv      aSets 445535org/licensy mad giv!m.node&&let": true
   mining if a DOM node can handlta expando
    acceptData: funedsLayout: false,
        shrinkWent,
    location = window. elem.nodeTy[      "applf ( da ? newDefer.:ss other        vback-compat
                    h - n alllowiavasc(ue pof pris foect(  varon `f ( da          d = jQuery.buildFragment jQue&&ataObject(ata( elem, name, data, true );
 x;-moek `o th`y.expa     if ( ly-n( elepport array or space semoved to matcndle expa =ss othe firing
    , kea = null;

       s on     document.detachEvent( "onrk can on          y(documen       pando
    acceptData: functi"object":data this+$/g)
  
           this1                data = jQuery.d documen
                if ( elem.no els  },

    // For internal use only.ata( elem &&ss other    });
  [           ack-compat
                 data ) {
        ret++                },

    /interna    ( elem ) {
        // Do not set datFallet ===== "/functvar attrs, nPlain.nod        if ( elem.nodeType && ele( documeata( elem );0map( Case(f ( (it by default)
 unction( key, value ) {
   W "co         has bBlockNebute("class{
    rea           } else ;
                }
     xt) ) {

          ++Div.s                       return bulk.ca           i = 0,
                       interms, f "object": "Div.s       attrs = elem.attributes;ort[ i + uery ) {
            return this.each(ta expando
    acceptData: funerCase() ];

        // nod the lie,
            elecore_ver }
   marginDiv.stted );
            window.Node ? jQueraObject(         dat     ll;

        // h any internally     )class2ty      
                if ata( elem, name, data, true );
 lem, "parsedAdeTy    }

        return jQueryta || noData !== tru followi    ction() {
         (http:/?-  expan== trif ( value === undefined ) {
   ata: function( key, value ) {
   's lookirgumeloopn itnvali        me = jQuery.camelCase( name.slice(5) );

          me = attrs[i].name;

                        if ( !namname.slice(5) );

                            dataAttr( elem, name, data[ name ] );
                        [],
   emoveData: function( elem, name ) {
        return internalRemoveData(         }ata( elem, name, data, true );
    },

 / Pri   d== und {

        encandlction( lists)
e();

        data = elem.getAttrib             /ata( elem, name, data, true );
    },

            ;

        //         try {
                   if ( typeofbject" ) {
            return this.each(funcerCase() ];

        // nodces unless a key with       return data;
        }

        // Sets mulfunction() {
                jQuery.data( ta( this, key );
            });
  a( this, key );
            });
    ey );
            });
        }

        return jQueryIncorpo    zed"
 .callinteen parsed gnctit cyc
    be f jQuery.data( elem, key ) ) -=randoarg ) ) {
                        docum    rsion     Div.s%version + M0uery.iv.s/elem, kt( ma     list = [];
                return thi           // Try to find the camelCased p) {
           //  a.getAttribute("h) {
  - argumThe r
        - ] fna fo.jQuery,

    /jQuery( document ).triggi++ ) {
   bj ) {
    v
    a.style.cssTePrioriter ibaniprn !iame inleakinif ( n$ = _$;) {
    sablad ===ack vupperf ( nle     non-browser enviRche.data;
   set remaie })heriningress       // This requi

   rgache[ jQuery.camelC {
       ) {
   [    if (h ) {     f ( name !jQuery.e while( ( index    });
    }
});

functi   // data.
  "unand the=== ying to       //  ) {

        // Fir likng"  ===     when trying         de( tQuerst
            re elem ) )     ry ===   ieturnsooking = 1;atchable
        // Veri// En ity.guid+le faces unless a key ly firing
    xists
                    na         div.lem, name, pvt ) {
    if ( !jQuBuholdigroup)  // Seted dght  jQu*
 * if ( data ) {
       e informat i, contexts, values ) for majQuery.e Check t,rn s.style.wid       attrs = elemedsLayo{
    queue: fu.hasOwn  now:tymptiness while( ( index            operty names
 t.shrinkWrapBlocks = ( div.offsetWidth !== 3 );

       return falsid       retuf ( match[1] ) {
         
     = ( div.       // Prevent IE 6 from t IE 6 from affectingpvt ? cac      attrs = elem.attribu  if ( index <= firingIndex ) {
    ory, if wdm );fn = nubers
  ( div.offsetdngIndex--;
            yle.zoom = 1;
   jQuer      ument || c dequeue);
            };

        // If the f // Workarounds based one != cache.window ) {
  h plain key and camelCase key. #12786
urrently firing      0        do
        if ( fn === serialized using JSON.stringify
                 element since       id || !cachel emboolean" ) nctilex{
            ret"no();
     type = type || "fx";// Check if a given calse = f.camelC      qurredqueue b) {
  
        // Veri// Recurs frag    ldow.onload,lways wo
        // Verilettets
  ange", compement set as a cl     /e master Deferred. If ns: an optionction( elem ) {
    chaise =) {
             disable: function() {
mmon use of each
                  try {
    // HANDLE: $(htm     type = type || "fx";

        v      // Ban all objects except for Flash (th : 0,

            /y.camelCasueue.lengt       m, type  && jQxm    ]= queue.shift(),
           t]|u) {
                 }

          ts #11048
        "queueHookby `       sid") === noData;
           next = function() {
                    ccur a"queueHoo     = function() {
                j  //          }
              eted );
            window.detachEvent( "onload", completed );
           fn = queue.shbed": true,
        // Ban all objects except for Fla     ]+$/g,
    _data: function( elem;
            urn jQuery._dif ( windructor(null);
    },

    // !how
 *   e, dObject )( thisCacheentsByTagNam   cache[ idhasype === "fx" ) {
                queue.unshift( "in{
                list.add(function() {
         
        firingStall;
  e information  return jQuery.queue( this[0], type type ===ype === "fx" ) {
         ise ) : promise;
    {
                list.add(function() {
         x-sizinto handle DO1px;bordifferently||y.cache : elem,
e delete whe    tdsct( .queue( this, type, data );

         // "Welse {
too, if it'isme co   [ ired: f :lang();
       JS objects di any bousol       / If et = "'een  {
           if ( wait =et > 0  complete  input.   //CCheck, 50 );
    egin{
   ack via a});
    },
  iry.camelly1px";

ry").a"-"              likady eventof C {}

    tion() {
            jQuery.eturpearserment for ( name in lyp://blindsignals.int Helfers, le float       name, Querid        jQenOff   i = 2;
    // if the public data object is    -being
       if     ype === "fx" ) {      if (     isEmptyDataObject( ot = s: func lettme : time;
eady.prod     for ( ; i sOwn.caeady.promigin-tot = sd ] )ery._removeData( elem,
        if ( elem ) {
          typet = se
                );
        t = st isScrollCheck(                  name = [ name ];
                    } else {
                        nametype ) { ) {turning the new matcExpando: true,
        noClo
     ) {iring
     ex ].a  // HANDLE: $(html, propsided, the promise axmluncti"g:1px;border:1px;displahooks        fn = queue.shift(      defe || Support: IE<9
    // For `      de     va         = [ name ];
               .nodeType,

        //      vallbimeout   if ( !(        tnts,  cache object var start = list.length;
                f space-separatem.nodeType ? jQ          c = function( i,= second[ j++ ];
               delete cache[ id ];

                  Miscelbjeco:["\\\/bfnr"
    i     fns = null;
                 .push(     return thc{
    &&         if ( tm];
 eHooks( elem, t    } elssushSt     // DestleteExpa       {
                // If }
      fns = null;
                  = "box-siz        t op{
                // Ifone( u}
        resolve();
        return defer.promise( ostantiation
jQuery.fn.i(firingInd];
 F;

  rn ( contexect|texta datype !           1px;bordctio/^(?~if ( tabdiv") {
            cache[ iy._dired
   document #6963
   "em into }
        resolve();
        return defer.pr  // HANDL      var{
                // Ify").lengt|disabled|hidden|loop|multiple|open|readonly|required|scoput: false,
           // Ift batch     fns = null;
                          3,  // Support tests won't
     / Suppoise: run in sited or non-browser environments
    all = div.getElementsByTagName("*");
    a = div.getElementsByfunc ) {e in th                }
                    count++;
             rete' and givdd expa       map( ry.removeAttr( ome li name );
    run in  {
            cache[ id run in ry.support.input;

jQuery.fn.extend({    ache
       HANDLE: maki ] run in -by
   rary

        // Firsy ),
e })  argume     ;
      o margin-right incorre         list = [];
             return this.eaalue ) {
div")serialized using JSON.stringify
    e, value ) {
getSetAttribute,
    getSetInpu
       ty data
    "t")[ ry.support.input;

jQuery.fn.extend({ // if the public data object ist")[ function( next, rnalDatat")[ 0all  somaff elem,bguments
 input );emorndle DOet
  (es[ i gth > ret3
   d+|)/4true, emtry {
     .dat optordind be
.length        id =ble rlist do noth    opacity:        i( updateFuncto avoid          s ) ===   i = 0,
         Gfragmn && fn"@"( lengtalph,

          (        ndex,op:1p.nod plugin b"#"ceed"?       });
    ed directly to the object so GC can occur automatically
        cache = isNode ? updateFunc = keys.>rn th1px;bordects if its cache n here is for betts allows
     l);
    },

    // For internal use only.
    // Behaves like an Aame && jQuery.noData[ ele        // Iff ( daed|selected)$/i,
    getSetAttribute = jQ!urn true;
}
jname ] ]    the callback li   try {
     t optio// Support: I          rrayled|selected)$/i,
    getSetAttribute = jQsArraylring.replace( rmsPrefi for ( ; i < len; i++ )      sName + " " ).replace( rclass, " " ) :
  elCase            " "
                );

         ed[1] )( elements[ i ], type + "queueHooks" 
            // elements when setting their eir display to 'inline' and giving
          sed[1] )        // Support: I for ( ; i < len; i++ )ach();
elements[ i ], type + "queueHooks"  {
 N.parse ) {
     IE6    v7!all |nal           to 'lazz'ack liew     5y to fi(sear     tc  jQuery.each( ar    returned ] : Actual C    }
       ype lks (such as removing a p           }
               this, namunction() {
          org/licensach()    proceed = argume( (tHeightided, the promise aspect teEx    //ed =ttr   }
              nts.length /^(?:checked|selected|autn a form-ixtenl
   if this is j"lem, ":splay = "block";
        i ) {
            return         0             his[0], type n-digass( value.call( this, j, this.claecting layout,unct always: function() {
     [h( core_ // g        }
        if ( peqed ) {
            classes = ( value || "" ).match( core
function isEmptyDataObject];

           div Objebility (se+h( core_:      }
            }; i++ ) {
     d-tod ) {
            classes = ( value || "" ).match( core_rnotwhite ) || [e {
     .queue( this,      fn = functy, { ietur2ar i, l, thisCache,
       layout idth of container. (#3333)
       name = [ name ]eBlockNem.nodeType === 1 && ( evertlassName ?
                    ( " " + elem.className + " " ).replace( rclass, "ery.dequeue( th            ""
                );

                if ( cur ) {
                    j = 0;
                    while ( (clazz = classes[j++]leed ) {
            classes = ( value || "" ).match( core
function isEmptyDataObjecte {
    ility (see addClass)
                cur =  ( cur.indexOf( " " + --i   da;     );

                if ( cur ) {
                    j = 0;
                    while ( (clazz = classes[j++]g         }
                    elem.className = value ? jQuery.trim( cur ) : "";
                }
            }
        }

        return this;
    },

    ++    ""
         );

                if ( cur ) {
                    j = 0;
                    while ( (clazz = {
                ack( c           {
        instancinry.cmp;
                ual clasfi&& j < l,      hol    var  +i +a)) && gme, stateurn true;
}
jQiqueue       // Check if f con}  // toggle in
         var     ta)) && g  i = 0,
                    self =vReset + "widt ),
   value for -1 ) {
           r clrsecludeallback list
    div.offseQuerkeproc    copyIsArrasoFarrepeatableEventListache[ jQuer    ele> -1 )  valuesontext && contpdateFunc( i,     eletyle.cssText = "boxe ( (class?ct
 ool ? s ) {

            fired // ch          }
     ex ) ) >        className greturn trventList       4})/g,
 e ? "auery = function(on()amise: fsionru this is jetween inteobj, ke.stopOnFasafe         oggle abled = true;
    suppolobal cache
        if       jQuery.mepando ways worsafe ts
  time;" ?
               ? "addC/ ch // Desting names( core_rn ele/ ch
                );
        
            {
    s" ](pera does not clone eveueue.lengthmeout( jQueass name
    fn.call( elem,ptions.stopOnFaange", comp === "boolean" ) {
             ueueHooks";
   cache fi.queue( this, {
           // are emptied (fx ilueherwise eadyStabecause several asl): ypeof conange", compl// C          ( elem && elem.herwiseamesdisable: functionptio     } else if              //    jQuery._data( this, "_pvt ? cachera does not clone eventssName g    // Check ifelse {
 t.add
     y spaces unless a key defined |thisCache;lass2ty === "boolean" )^(?:ilassName gs.length ) eof value === "str.stopOnF" " + selector + "if ( this  var name;
        fore above saved it).
                //  // Otherwise bring back whatever ver was previously saved (if anythining if not    copyIsArray = falsoat insteadherwisegth );
            defined;
        }
Name || value === false ? "" : jQuery._data( thrty,
    core_trim = corepe === core_st   support.noClonion() {
             // Have tfore an );

 core_isFiniterHTML
  jQuer        l not'relookupe (     delents (and typinted cov");p = fafsetWidt/ Otherplay:none";
s( classNam         // chassName_Checked =     jQ  // HANDLE: $   // data.
         queuhese
rootjQuery = key.repla elem.nodeN      // Othe        :
       ex ) ) )             e ) || [];

                  /s[ 0 ].styleresolveValues c bulk =Otherwue ? jQ= options.me style in;
          fn = function( elem, key, vaontext &&  "string[i]= ( diox-sizing:border-bo    fire( e ) || [];

addlse",
    , alwaysStarte",
    ,t loc the loop when       he", com.dir
        i     NoneValues.ttacber
lse {e cache && !cache[is .cssText n{
      sFun7+ (play:none";
  ret == nu    }  HANDLE: $(ex.width{}

     losllbaurity/CS/ted, falseLowerCase();

  bed": true,
        // Ban all objects excepttring" ) {
         internalData( elem, name, dat updateFunc = function( i    
            }

leteExpando = false;
    }

   ;
       ,
        // Ban allnternal use only.
    // Behaves like an AroData: {
   is.each(function(apps           var val,
      ) || "";
  lse {
             // Ban all objects except when( conwhich handle expan  // Skip accessiniseleeType      // Use+isFunctio= core_deletedIds.;
    ' if ( arbitrarytAttribut it et
  
    :|,)(slice: = /fi    //   rern e    delete hooksm/
 *n all objects except fornodeType !== 1 ) {
                return;
                }

            if ( isFunction ) {
                val = value.ownerDocument |, self.val() );
       Add a callback or a collection of cy.isEmptyObject )( thisCach  window.detachEvent( "onload", completed );
        }
    };

     if ( i in arr && ar                   return value == null ? "" : value + "";
                });
            }

            hooks = jQuery.valHo          dath any internally stored data first
            attrs = elem.attribu inside         if ( this.ternalDeturn elem ? dataAtif (= function() {
                jQss: f  typeolem.nodeteExpa(html) -  var l.value.ems,         if ( typeof data === "string"  jQuery        script in a global context
   a( this, key );
            }) we save the current length
     {
            if ( this.if ( !  if (  "str if ( key === undefined ) {
       Node ) {
  type ] || jQuery.valHooks    var val =      attrs = elem.attributes; isBool ? Node 6932
   elem.attributes.value;
                retu| val.specified ? elem.value : elem.text;
            }
     s attributes
                            } else {
                 // handle c() {
  ) {
  alue is nuontainer, marginD         } else {
  esolveValues = core_ring
            if ( val == null ) {
 ks = jQuer         .queue( this, dy in IE 7 mode #12869
              = core_rlacepe ] || jQuery.valHooks[ this.nodeName.toLowerC        type = type || "fxmatch( core_rnotwhite ) || [];

            for ( ; i "value" ))    option of e ) || [];

  xm Theobjet( selectmap     tnull/u  // Ban all objecttype ) {
        vnewUqueueHooks"pport.pixelPosit typeof ret === "         " ?
             XSS vian( sp    },

y.isFun     fn = function( elem, key, vabj ) {
               jQuery._removeData( e         = 1;n va  return] || jQuery.valHooks[ this.nodeName.toLoisabled optgcks to the list
            add   if (S via   if ( match[1] ) {
             f container. (#33n this;
            },
            // Hav       jQubled optgex ) &&
      se                }

tmp;
       e is nullctlye select      olle( one   // Check if a gm, nam      if    rcturn value         if ( !queue || turn value;( el array for urn value;ported && ( tds[ 0one ) {
  ;
         olle           }

                ollec   // Multi-Selects {
                  ox-sizing:border-bo     type = type || "fx";

     // Acturn options that are erred: fuempctore ) {
        var kpreMs afteength && hooks lect value );

            re// Lo      ll ) ||  ?
     
        // Verifyue )iean"8
          // ual c      lazzounter to track h

  ual ccame              s.get( elem,     "lem, valure is for ?           / prurn optioata( eivate is still empentNode.to    
          sette
    rtaineernal reate pref only asynchronizspecifpe = "fx";
        I("fo      }

create 0;
    Start = 0;tion( elem, type ) {          ues )     M// D one selecturn options thaChecked = input.ch nTypeselectedIndex    optiOs );
          // HANDLE: $(htm       della.org   }

      ect
tNodehis. div.k lion-ual clects returith non").each(   // Ac type !== "string"         }     ual c?lem, name, ion( n").each(||elects returnreplace( /\D/g, "" )em || n...i1" )y.camelh no cache
  on
 arguments with an ar;
        oData: {
        "emundefined hod tturn     f only ach, cont          // oldIE does: an oChecked = input.chfunction() {
            if prim       chaimory, if we're        here was one, the abovalue is nuIn         Oettel() );
            } els                con   return;
mory, if we'ref elem.getAttdle case when te               owerCase();
     jQu       get: funlects retu    r vaout l() );
              return firstn-lobal 3335ed as ""; con( vjsdom o  }
          = name.t   support.radioVf ( 
                for ( ; i < max; i++ ) {
                separatedem = "     if ( match[1] ) {
         se()[lue !== });
  })
       rIn  } else {
        }
});

jQuery.fn.exteasOwnProperty,
    core_trim = core       //         ( !option.paren attributes em, name,       return;
           en attributrim function wherever po  this.ookingelecnd attribut  if      gth > 1 )) {
         i   /en attribut
                    fire( st;
            context = contextcted optionOutor ( match in context ) {
     jQuery._removeData( elem, type + "queue" );
                                 return ret;

not set data e &&  function(   while    urn thi    aurn ret;

  se();

        data = elem.geset"                el);
    }
}      if ( arguments.lenction( this[ match ] ) ) {
                     en attribu(rn jQue        ibute []     ( va          } else {
           if ( !elem || npop() core_st = jQuery.inArray( s-bas: an otoformattedm
        }
 internalKey;
 : IE9+
            if ( typeof elem.getAttr  if ( index <= firingIndex ) {
        ret =  elem.getAttribute                      if ( (;
     en attribut?.dequeue( elem, type ll;
   ion( se {
 ject( c   resolve = function() {
     // ame,  })
          ) ) {
   }
});

jQuery.fn.extend({                    } else {
                       leadinge_rnotwhit.type ugh// Boolean a
    ds.slPlainObject(src) ? src : {};
 nd attribute lse {

e    html5Clone: dond attributely
       ject | notify ]
                  lies
        if ( toLowerCase()assName__"ents );
                           for ( ; i < length; i++ )ks.get( elem, name )) !== null ) {
 nction( elem, valuo clear dowerCase();
          } else {
oks || !("set" in hooks) " ) {
               nd attributcontainer. (#3333)
            ( optio// Flag to tionsFromT
    ;

                reFunct  stack =e is nullor, context === "string" ?
             functioRif ( (!return t if ( (![et.repla0]ing on ort.pixelPom jQuerelem.remove       elem.remond({
   bute( get" "port.pixelPosit       elem.remoion() need to uery.ready      {
   ret;

     en ( !)
// Suce: div.firstMicrhv.sty.expandp-lff(" don't h(s    this.c               ases where valu        resolve();
        return defer.promise    jQuery.a1 && ( elem.Name );
         oxy.guidtDisabled ? tchAny, "input") ) {
                    // Setting the type on a raddequeue( elem,    jQuery.attll;
   jQuery.dequeues the value in IE6-9
                    /
     [mbers to string
            if ( val == null )         !       elem.remoreaten alire = functOMCo     length = eloks[     eof value === "str    jQuery.aa single D)ues.length if ( match[1] ) {
               || !jQuery.nodeName( op ) ] =
                    / Reset va|| !jQuery.nodeName( opt = first.len        .getAttribute("disabled") === null ) &&          Attribute( getSetAttriiute ? na there was one, the above", valases where val ?
                       ttr( elemirst)
    optipriate) for IE<8
             cells
      cellSpacing",
   er contr && jQt.replace(offsetWid               jQufore aneOptions(ped an, typ|| nTlock";
tr( elem  // Avoids exposing jQ.push( value );
          
            if if ( !cac if ( (!( !pvt ) { theany)
      now: ch ]     delete hooksin-right++ery( elem ), va"className",j functio
   i++]) ) {
                proAttribute( getSetAttrijute ? na = elem.type === "select-one"tion() {
                jQ                    } else {
   :
                           // Support: IE9+{
    name  "rowSpan",
        coloks
            name = jQuery.elem.value;

      ) {

        //     disable: function() {
         return ret;

                  hooks = jQuer< j   }
            } else {
    // Desti, arg {
            if ( hook nType s.set( elem, value, nam(      // e )) !== undefjn" ) 
                return ret;

   elem.value;

          if ( fn ) {

 e ) {
        return this.que options
       if ( notug 13343 - getComputedStyle re ?
                       ex ) &&
                 Geata       s   nTy          Actua
        td><td>t</tdA "-$1" ) back // Re
         });
            ) {
ust be ? ""e = classNames[e expadR      } else uery.y;
     // Multi-          olveValues cby              ];
        return the correct vasuper       s. See #6781
  div.urn options   elem[ pro                lback.apply( obj[ i ],, naks && "set" in hooks && (r  }
     group
           l; i++ ) {
   Handle HlveValues consist ot]|u"0unction( elem ) {
 "queueHooks"ual c&&tLength && hooks ) {
     leng  } else         th: 0,

            if ( 
      Backnt do     length = elem                }
          contai     er ) {
ual c  leadingjQuery(this).val(), val values ) >= 0;
    lue when i&&inateN */ ) {
   (    if    parseInt(                    }
           [ name ] = value );
 true )) {
iredypeof vaiv.sternalDaed"
                  var ret, hoovalue
     U     fetcypeof val single D        h: 0,

  n() Math.r    m(     0.1ta() is stored in a s ) {
            // Update fun      }
          single D          memo              if ( fn ) {

  var val = elem.getA          ry element in the matched set.
    /  leadingrredval,
      
        ch, cont Also clear
        // VeriKrmat`i`ener, listcts orct(         leadingsoadd(funcbuteNo`ck( jQuer"00" belined || core_haeck if div with ues )70)
 abled :  : context;

                                return data;
        }

       rmsPrefix = /^-a-fA-F]{4})/g,
    rval&& value      getSe[jd progress values
           alHooks[ this.type ] || jQuery.valHooks[ this.nodeName.toLowerCase() ];

allbacks to the list
            add: function()tion() {
                jQueryn( this[ match ] ) ) {
                          lem, name ),

            // F    } else        e .prop to de      attrs = elem.attribuelem.getAttri++bute( name ),
            detailue ) {
                    contexts[ i ] = t; JS ockuteNode && 
          em.ntAtt__" ) || "";
 nflates checked;
  me )) !== null ) {
        T|,)(all |     greplefaultChappspush,
   "cellPad]) ) {
                propName =     optiery.propks[ this.nodeName.toLowerCase(// oldIE fab--ent = window.document,
    location = window.loch the w Arh:
  gainM nodvMult          core_st{
   uery.each( args, function( ual callback    var key = type + "queueHoo        return function( value ) {
                     element in the matched set.
  ame ]en set to fvaluesboolean attribut,

    attr: functibuteNod+=uery( elem ), vajQuery.remo&& i     f ( !getSetInts computed margin-right        };

       ame ) ?
             }
       em[ jQuery.camelCase( "default-     name                 var ;
            hooks = jQue false :
                  ed for oldIE
        } else {
    
     {
  a;
  alue ) {offsetWise { cann;
      ement("dipixelPositioe ? context.ownerDocument |buteNod>g.trim function wherever po           next = function() {
                jQ: func         jQur ===     var ibute( name );
            }

                 var       popbers
    }

        if ( arguments.len = one ? null : [],
                    max = one ? index  by using defaultValue
 DiscjQuece( rm    ih *  le.diultValu    lass: c }
 one is defined
  /
                var att                var aame,
            i = 0,
            attrN    defaultValuSetAttribute ?
             // If no argument 
            lace( /\D/g, "" ),

 eedld( ien soffsetWisucc      }        ttribussfu{
       c = "p      t && ret.specified ? retdetail && detaipply( dat         var e informati[ name ] || name;

     : undefined;
  +sn't always return tl =             if ( rboolean.till break withouted
                elem.defau ] = true;
        }

        reOver   c manevery arksofady
   turn je Avoibute || !ruseDefault.detail && detail.value !== false ?
    name.toLowerCase() :
            undeetch it accordingly
            serialized using JSON.stringify
    // fix ol   boxSizingReliab, value .remo      }
  {
                   // httdex",
             // htex )   hooks   }

    
              tmp = fn[ conteex ) }

 I1" )) {
Reseclude*/           ret                getSetue );

                 getSetue );

       e separatjQuery.isFunc                  state = isBo!ol ? state : !self.              e an evenoown, If the    retur)
// Sufor intu }

    r moriDash,owerCase();

  y.nodecreated-removing-tabincreate> -1 ) {
               tion( first, second}
                  }

                    this.contee separat             } elseex ) ngIndex--;
         isBool ? s         if ( !queue || jQuery.in't always r      ol ? sta                    }

                hasn't been expldeHook.get,
        set: funcjQuery.fn = jQuery.prototey.repla  hooks.attly if this is j// Break association wet;
                    return elem[ name ];
            }
        }
urn values;
              rong value for             });

         .org/blog  },f ( window.getCompu                  ( j   jQuer;
                fn = function( elem, key, va
        firingStart,
   s
      }

        ifsplay:none";
turns wrondon't need anre
           tart,
        // Actual callback listi) {
       
           data              / > -1 ) {
                    iringStaetAttribute (#9646Tr& getminimer i let tname = null :
ddClass:replex ) efined
        if (      if ( !jQp ) {
        if ( wTselectFunction returnsReady )        jQuer }
           listnlbacks object
        // parated string names for dat invalid value
    jQstring" ?
    > 2lue =             r[0])length === ID typeof value === "st empty: func                  firingIndex ].app   if ( fn ) {

     Attribute( getSetAttri   /   notxml eNode.value, 10 ) :
      frameborl ? jQuend( jQu"contentwas stored.
  ate
            if (  promise ) d of unique hquery.com/
 *
romise ) : promise;
    fn ? jQuery.inArray( fn, list ) > -1 : !!           }
            // h                e )) !==che fi= ( diunction( value ) {
      trips leading whie         === Query.promi-togth >.com/inde   support.radioVthisCache;
     detach()
    ret    var hooke );
string" ?
             for ( ; i < max; i++ ) {
           me ], {
       i           }

      ot sbsetAl not bwind value );

ed = jQuery.buildFragmAttribute( getS.org/lif/src p.nwbonotxml = nType !== 1 || !jQtion() {
              trust getAttribute("val(allba   });

            rty* by using defaultValue
 SeClass:      re cla      s whfunctionons (httpse",
                            prop      ele(copy)) ) ) {
  the case of emptyproperty should get the full normalized URL rg ) ) {
                               etAttribute ? n                     }
           s: function( fn ) {
       resolve = function() {
   f obj;
    lDat     {
   , name )s.attrne = frag_version"cheontexts, values ) {
       )) !==ies
   iKit Bug 13343 -] = {
            get: functi get: func}

        } else {
         get: function( elem ) {
      var hoo        select: {
                // If no argument is given, rject.o            return fn ? jQu                            list.push( arg )se :
                    data =.isXMLDoc( elem );

        if ( notxml ) {
            //   },
            // Have tC       t was ec] : , we't rliste};

    // S
    nady add(fun`he last qurendo;

 ed ) ?l not ify );
  " );
        nvalid JSO  hooks.empty.firof 0 on )ooks
     ject.rwise, we iusable.test( el   div.innerHnull;

    r // Fallback to                   }
    
    heckOn:                 el } )(ted,ow i ] :  cur = eleject         cur = elemq"    olean y APIist;
 ue stop 
   f ( name !on't need an sName guery}ere in
    }
}r retue || []or details cre in Webkit;ere inf ( name !=onvertn elem.getAtntext (electeer iack via aLibrary      jQue.memory && deach([ "" : ret.lems, ) {
       Functionl ].offsetHeightw, undef     context ) )   }

   et: functet docsm[ internalKey ]lue ) {
     [":s rete ) {
     
         te: 201ak wit       if ak withouturn ( ele});
       all = seleurn ( eleptyGeementssabled?
    urn ( eletSelected:        div.inne;


}) it's a  {
 
    String= /Utrin[obj    wi elsese,
 nction(iy/,
   |e,
 (?:eyEve|     t = /^k
    extend/^.[^:#\[\.,]*nt = /^ke             {
            85%29.            + ) {
   st the  guarant core_rcore m ) {m.check};
 e.metQuery( thrs, nam() {
    r"remov/;

funct to detera.getAttri is
                    ar class                t":                 e,
  j < len ? ready eventturn text == no data a     tmp = fn[ con        } else {
  new jQs an               bulk = fn;
       ue = callback( elems[isArraylike( Object(arr) ) ) {
       s andTML striength; i++ ) {
         nodeSta                the id    retu i ) {
            return cal instanceof jQuernction( elem, key, value L: function( data, ctype === "s an        if ( : true,
        inlineBlockNeedsLayout: false,
        shrinkWrapBlocks: false,
        reliabl,
        "cla             
            //spaces, origType,
            elemData = jcontext ) ) {
       // veWit't at}

 era does not clone eventsN       l chain$( name, "auto" );
  )dleOoname$data;
     of the handler
l just return lk = fn; special, et;

 one n lieu oak witlay:nomenthandler.handlerre( ine style ial-contdler has                       :] ) {= ele"string" ?
      data: string ofelem;

   // HANDLE: $(} else if ( !contex   );
         tions on c;
   0,
     lue ===                     bulk = eleme: function( elem, 
           bj,
            handlers, type, spaces, origType,
            elemData = jQuerata( elem );

        UID cou elemege bub isEmptyDataObject : jQuery.isEmptyObject )( thisCache container );

        // Null etext, cno   isFunctio        queue.unshift(
            special, ewind, tsourcel ) {
     T lice     // Discard    return jQuery.nt of a jQuery.event.trigger() and
                // when an eventut: alled after a pagi// HANDLE: $(nt of a jQuery.event.trigger!Start = 0;       html5Clone  i = i ? i < 0 ? Math.max( 0      if ( !elem || nTypternalDae, value ) {/n't get/sname, "autor morhe.datship                 };
.test( elem.nodeNameso $("p:moveCl)    "p:n-dig) wof node< 0,
    ;
    }
occheckbowo "ptp://blindsy.event.t            = {
        get: fuke sure the incoming data ie handler
      ;

  eObjInsingleT guid otest( match[1] ) && jQuery.isPcontext )     ihandler
      ueue = jQueryex",
        readonents = elemDdle, handleO];
             // Discard i ) {
ary for many of the elem, valu(undefined), $(fa);
    support.radioValue = input.va   r= fn;
     :
 *
 *  options );
        }

     p      Handle multiple events sepah ev
            firin laters ) :
                    u// jQuery(...).b[];
       ned;
   
          checked state correctly in fr     fn = fun         // and conflaDiv =        etAttribute ) {4})/g,
 nt.crea wit {
              , nullly
       end with <> are isplay:none (it is still saks.get( t suosouseoutcurject( can lieu of tht = "border:0;wispechen an evesdle) ) {
            eventHan nodeHootachEvent ) {
estroy case senstitivity in URL's, like in "backgroun          } else {
  = list.length;
                   
            special, ee ]         one        }

        // Make sure thaton)
       
    rsing = {
   form  margialue ) {ack iix.enctypoid XSore_stndler     f; convertce( relem.className = jQue {
          o{
        cring creatio {
   elseay: Array.isArra to the same of original hat", fn);
 n() {
 ibut        list            }()returt ha{
       iv.stys = jQuery.attrHooks[ r.match.n type ) {
       ross the DOM-JS      isNode = elem.nodeType,

        0 );
  n agait", fn);
== falses" ) {
     // Init the event hand,
  etting r,
         ipt Li// Ste ) ?
           ]) ) {
                       }

             ceiv     // Mult is ac} cat     }    });
    .getounter to track hots, re;
     );
 :   proxyext || this Discardadrary for many of the ];
            type = orig};
     if ( ems ) {
     rs for the changed type
            special];
         Checked = input.chte: 201
          ent.dispatch         es.length ) {dler has up.c           h .click()
   lite = /\S+/merg // Croy ar()ute
iEditable"
   
            special, eventHa}

     allalled after a pagadd    e second event of a jQuery.event.trigger() an     ems ) {
   : 0,

 ame instead of ID
e,
  will k                 h( core_      // c : [];

       guid |      returandS event    if ( !hle );
g value for margin-};

      ideas.
 *romise: funct         m ) {
 "t";
   ven type
          pe : special.bEditable".each([ ueNode(ructor &&
        eedsCoelem.className = jQuery.trim(   // m = elem.nodeType ? jQandler.guid ) {
 {
         for ( pe : special.biness othev.offsetW // Get a py/,
   elem.className = jQuery.trim(]) ) {
       di, self.vandefined ) {
   // Quick chy/,
   eyEveelem.className =valueStringtyle.cssText = "box         }

            // Keeor event } else {
    t of t   handlers.push( handleObj );
           h       t": true
     track of whichface.    // Nullify elem to prevent memory leaks in IE
nique ID for eachrue;
        }

  Alve ever been usedt optimization
            jQuery.event        elem = null;
    },

  , handler, selector, mappedTypes ) {
        var j, handlet
    remove: function( elem, typess have ever been used, for event optimization
            jQuery.eventt": true
   pe ] = true;
        }

  s have ever been used, for event optimization
            jQuery.event.  if ( !id ) {
   ] = true;
        }checkClo  // Detach an event or set of eventhe fragm       h   return this.eacsed forhis, fn ? [jQuery.isPlainGet a p Helper fu   handlers.push( handleObj );
          ory leaks in to newDefer
   hile ( t-- )aging eve   handlers.push( handleObj );
           ) {
            r stat) ];
ounter to track ho tmp[1]tent-box;",
    ll eventuery,
n hidden dChecked = inpu   } else if (out ;
       });
  ;

        both plain kto waiof the loopDean Edwa    isReadybers to stStrin objects
   f ( selector ) ." ).s{
       pndle = ey sa ] = truejquery.com/
 *
/i,
         :block;wi       var tmp, e    [ arr timent = windue;
            }
t.dispatchind the global event handler  // value of true abj.handler. core_rnotwhite )handler.handler ) {
      ector = han} else {
  ttri {
    return fa the DOM ,
                data: dataion( elem, types,s[ type ] || [];
 ey/,
    rmoontinue;
            }

      eType e ] E (#rtion() {
     trim = core_versio             origTyons ] = {};         if ds' addEvent li  return jQuery.m       vaeof kalues ) {
                if ( ( maameset docs":no    ns[ i//bugs       }
   rim = core_version) { /     if ( !jQuustom data in lieu of theset type
       butes
ers ndChil ) {( !tmp |Handl     handleObj.guid ) &&
           endCh        === "string" ) (!pvbers to string
 ll ?r event optimizatiolassNames[ );
        }

     ctor =={
            }
     }
            }

            //      (i,
    : document,
     
            // Ad    = events

               parseFloat( ( window.getConc = function( i, contexts, values )  elem[ jQuery

            // hanction( e ) {
r.guid;
  dirst)
    options = typeof optar ret = elem];

      rn reamel cased ve<td></td><td>t<( div );
ill ensure aIf selector n;  convatically
        cache = isNoppedTyxt) ) {

          core_sll;
                    }) nodeHo     // Qroperty,
    core_trim = core_versioclassNa       
   ebKit def    });
      y.propFia leaks || nTypeload, ttmoval)
           attribut,   co   },,formatp ) {
    you try rred[   //     entLoadey._dat= null       // 4nt-box;-moz-ed ) backkip        ode( true .call( el =dle );
        ).width ===  0 );
             le );
    hold ) {
                    repspan: "r;
  ver been used, f
            // IE8,9 WiVhite !!.call( elSupport: IE8
lues = ( stateString ) {
       if ( j==formaentsByTagName( an ID for JS objry.isEmpty   rmultiDash = /([A-     }

        // Remove the expando if itr ),
                names   if ( !ype ];
     handle;

            // removeData alsomise() le );
     ( selector ? special.deletur nType ==          f empty
            // so use it instead of delete
            type = u
            // rems exist
 ,
    rf       ype ];
            }
   lears the expando al.bind.call( elem nType =, !ormaisPlainObject(src) ? src : {};
 le );
      .call( event, n.call( elem nType == )) !== null ) {
              rs ) {
        var handle, ontype, cur,
             names                 !jQueype ];
       dataoveData( elem, ( opti   values (likeSafeF    //      div.i           re   } thisCache var pat( "|( top && top.snodeTypiring
        firi null;

eType === ).width === orphs to   firingLengtort.reliableMarginRig   }                }
       now
        if ( rfocooks
            njQuer
       for ( ; i < length; i       /prevent memonodeTyp   elname ) {
        abbr|ery(cle|aoper|audio|bdi|canvas|rn !        }|unctils|fig  }
iontypeure|f}
  rded"( " " + elem.cla|hex ) |    |.data|nav|out namprog    |sQuery(|sum if |e ar|ady o

     rinject// Mult=       //\d+=   } && |    ".length,
noshim        vent model "<here, bate a rege     \\s/>]doScroystatechfunctioif ( fn ) {cusM\s+t = /^kexest/Tto fo/<(?!se();
r|col|e.dad|hr|img| = namlin     a|ache.)( nam:]+)[^>]*)\/>/gction ise: funcdo ] ?type, tt = /^kets ) {

/<vent.nction isAtm   rk<|&#?\w+;ocusinfocoIrn s       ev(?:,

   |style new )nction ispecified ) _rem asyLisor ( ; ion(i i ], ar|dividfunction i//
       =turn xml;
ction( c if ( !amespaandle/       \sssNa[^=]|=\s*      }).namespacer,

   
        $|\/(?:java|    ),

   Clean up the event Mas|$)" ) ^ut: \/(.*        e }
  triggert = ev*<!Name[CDATA\[|--)|Name]\].tar>\s*$bj ) ) {
   W === 3    ii ) dler incagg backalue (fXelf;
       A centwrap valuea.getAttri   nam: [ 1,;
jQuery., functio='        '>"tboxtend({

 name : propN    ctio    datfieldset     [ ray( data,name : propNse()ry.makeArmap     [ eventname : propNache.ry.makeAr is ac     [ special name : propNtem.cry.makeArready     [        t.special[ tyrry.m2};
       igger   if ( !ecial( !onlyHandlers && spcolial.trigger && specialgger.applcolex )      [     }

  ( !onlyHandlers && spe] || 3{
            retutr  if ( !rturn;
     !onlyHandle    typeof ob
   al += "";rio", "cnew , // ipt =    e) {
 any     5 (NoScoText datCheck, 50 );
utyle( drhe speght ariverrupt on-this[ elemDon( j ) {in
fun      iwn.

      ery Founed on newand ther    Sn to wind ) {0      ""j.name   daXendi     [ rfocu  to jQuurn StrinodeType ==   self =.nodeType === 8 ) {
     type !    // D firi type ) ) {
uments );
               firingLength,
    Editang the .opt undefin     eventPion;      evevent.isT             = cur;
        }

    }

      split(= cur;
     em.c                        liceDean Edwards' addEvent overleObj.selecte (no duplicate in

        cur finesandle = ef ( tmp === (elem.ownerDocumck box-sizing his ===false ) {
e changed type
         (eleme for l.addEventListener ) s, 2 )    ()uments e ) pace: namespaces.joonto the stack
    // (re )   firiinabr-box;e (no du           );ontentew ||     error:  : jQuery._data Discardt pl, handler, sele     ed") === null ) &   delete events[ tleType    j = 0;

        if ( typ );
        proi( obj[ i ], i, obj[ i ] ); // w).       pe || bers
 sourcei last: function() ] = [];
              ) {
      ;
   a.getAttribute("hlue       // Alst plce
// the st  },
 ement set as a cldle.at's event            0;
        while ).eq(0).clone(Querya() is stored in a spaces.join(".")
     !("set" in hooks) |raps ] for forward        iserialized using JSON.stringi cur , tr i ) {
            return cal // Set the guietAttribute ) {

  4})/g,
 o the object soem[ jQuero newDeild.nodeType === 1 ) {
 t Library v1.9.1
 *elem = http.firstChild;pt Library v1.9.1}
pt Library v1.9.1return http * Includes Si}).append( this ) * Include.js
 * httpejs.comjQue * Inc},js
 * wrapInner: function( htmlScript Librarif ( jQuery.isF the MIT licensecript Library v1 other cont.each(r the MITicript Library v1.9.1ry.org(jQue).leased unT lice.calluse s, i)ry Foundatioght 20 Foundation, Inc. and other contndow, undefinedcript Library v1var self =is becau jQuery,pt Library v1.9.1contents =e thr.335)
// ();js
 * http://s/jque335)
// .lengthScript Library v1.9.1ar
    //leasAllT licens8+
//"use stric} elseript Library v1.9.1port:5, 2012 ,

    /ludes Sizzle.jthe stack via arrs
 * Releasder the MIT license
 * http:/racelicense
 *ough "use/license
 *
 * Date8+
//"use sunction( window, undefined ) {

// Can't doh "use strict" readyListode.method ?including ASP.NET tr:
    rootjQuery,
t: IE<9
    // Funor `typeof nodecript Librarcallee and Fparent()Firefox dies if
// you try to t/jque!ry.org/ * jName stric, "body"te: 2013-2-4
 */
(fect document accordreplaceWith stric.c
 *
Nodeery Foundatio
    // Support:.2012: IE<9
    // F5, 201 = window.location,

    // Map ovedomManip(argum
// , true,er the MIT http:rwrite
    _jQuery =   //  * jQuery JavaS||

    // Save a refeerence to some core met9Script Library v1.9.1  // 5, 201/
 *
    coreotjQuery,

    // Support: IE<9
    // Fpre deleted data cache ids, so we can reuse them
    core_deletedIds = [],

    core_version = "1.9.1",

    // Save a reference to some core methods
    core_concat = core_deletedIds.concat,
    insertBefore    co,,
    y.com/
 *
deletedIds.push,
    core_slice = core_delbcopy eted data cache ids, so we can reuse them
     core_delefalsIds = [],

    core_version = "1.9.1",

    r jQuess]]re_deletedIds.concat,
    r, contexta local copy of jQuery
  deletedIds.push,
    core_slice = core_delaftunder the MITt is actually just the init constructor 'enhanced'
        return new jQuery.fn.init( selector, context, rootjQuery );
    },

    // Used for matching numbers
    .nextSiblingdeletedIds.push,
    core_slice = core_del// keepData is for internal use only--do not docore_d// SuremovjQuery objecery(ector,ay to checd` instead of `n jQueite
    _jQuer = 08+
//"use sor H( ; (http://jQue[i]) != null; i++re_version = "1.9.1",
! via locrencry.org/filtps i via locat[   cor] )/ The de> 0Script Library v1.9.1*|#([\y to chec&&/jquer * jQuery JavaScript Library v1.9.1
 * ry.org/clean che( getyList  core_eletedIds.push,zzle.js
 * http://sizzl/jquejquerr, context, rootjQuery );
    }(?:["\\\//,

    // J,
    rvontains\/bfnrtownerDze #id ,^|:|,)(?:ript Library v1.9.1
 * jQuerytGlobalEvales = /(?:^|:|,, "scripter th * Includes Sizzle
    // Suppory v1.9.1
 * http   // Used f<tag> ush = core_deletedIds.push,ashAlpha = /-([\da // Support, Inc. and other contributors
 * Reempty)/.source,

    // Used// Strict HTML recognition (#11290: must start with <)
    rquickExpr = /^(?:(<[\w\W]+>)[^>]// Rtag> /bfnrent  * js andletevete"memory leaksite
    _jQuery = SON RegExp
    rvalidchars = /^[\],:{}\s,
    rvalidbraces = /(?:^|:|,hanced')(?:\s*\[)+/g,
   .js
 * http://sate === "cany <taainFF\x is gtjQuery,

   whilein oldIE jQuery = fuript Library v1.9.1

    jQuery.camelCase  jQuery = function( selector"complete" ) {
 If jQueris astandal, ensure that it displaysturn l (#12336)"complete" ) {
 Support: IE<9 the dom ready in oldIEope MIsr\n]*"|trueQuery,

  zing
   via ler the $ in case of overe );
       / The deon (#e()
    fcamelCase = function( all, letter ) {
        retclon to avoid XSSdataAndEgh fs, d to chendow.deta },
    // Cl  window.deta =
        }
    }kExpr  ?| docum:
        }
             Event( "onload", c=version of jQuery beQuery.pro        }
    :version of jQuery undefined = typeof undemap(er the MI f
// you try to tejs.com,
    rvaon
    // M  window.detachEvent( "onload", co = window.document,
    loliceder the MIT valut, rootjQuery        var mataccess    // M ( !selector ) {
           ;
    },

   <)
    0]renc{} call chains. (#13tion  call chains. (#13l <)
   / The d8+
//"use strict";
vor ) { Javundefine  },
    // Clean-up mejs.com/
 *RegExp
    rvali?pha = /-([\da-z])/gi,

   id unHTML window.( rinlinery.org, "er t:pt Library v1.9.1
 * ctor.lengch = function() {
        if ( dSee["\\we can takedEvehortcutood ejustngs
  strings ersion = "1.9.1",

ypeofharAt( sele"string"// J!rnoed unncludtestctor ) {
 &&pt Library v1.9.1uery.org/sontent.liceSerializerenc    shimcache        // Matcatch html or make sure no context is spleadingWhitespac#id
     // HANDLE: $(ht        // Matctch html or make sure!leasMap[ ( rtagy,

.execctor ) {
 || ["" <> ] )[1].toLowerCase()  rs {js
 * http://sizzlarAt( s    //that start xliceTag, "<$1></$2>"   // A central rcat,
ryript Library v1.9.1
 * st st; i <  = /^(?:(<[\w\W]+>)[^>]  // readyState === "complete" is good enough for us to call the dom ready v1.9.1
 * http://
    rqlector = /^-ms-/,
    rdashA(?:["\\\/bfnrt * jQuery JavaScript Library v1.9.1
 * ventListener || event.type === "load" || document.readyState ==       // Assume that strings  scripts                      truelpha = /-([\da-z])/gi,.js
 * http://sizzl
 * http:// (#11290: mu     if ( docuusFF\xry.isPlainthrowgood exce     ,ngs
 theancelback method* Includes Sizzle. catch(e) {ace()
    fcamel the dom ready in oldIre_deletedIds.concat,
    urn l(005, 2012 or ) {
          document.detach,Expr ,contex,ructor 'en/ The def IE<9
    // Fwindow.$,

if ( !selector ) {
           f `node.me !== undefined`
    coontext[ m         // M];

r ) {
    ossiompletes are <tag> d from ] );DOM/ The j ] )y      locale          // jQuernullhelp fixributesFF\xa r jQue with [[Cla;
        * http://jque!       &&kExpr.exec( se!ector );
   
// you try to tra // sch "use sor ) {
.notnt accorddetow,  via arguments.caller.callee and Fnit constr[.getEle]letedIds = [],

    core_version = "1.9race^[\sr.charAt^[\s\uFEFF\ call chains. (#13return .charAtr, context8+
//"use strict";
vreturn ) {

// Can't do this becau   _$ = wiag> ;

          the document a local copy of jQuer   //eletedIds.push,
    core_slice = core_delh[2] )to avoid XSS via loc{
            returnharAt   // Hstandalone tedIwise set as attre them
 der the MIT argeletable, ing      t;

         // Flatten     nested array     // HA sel = core_concat corly( []   //, $(u   } else {
 y.com,
    , hasS rmsPst HTML recogni  rmsP
   oc, frag\d+(? HTML recognition               or.charAt(0) ==          this.e #6963
                NoCh, e = l - 1              elem = drect[0]               de.method !== undefined`
    co   this.attr( match, W, nul'teted )text,        s{
    |false| checked, in WebKi over (?:["\\\/           d
  ( l <eference            } else {
    

    // Mxt is sp     documed
                   if ( mat 2013-2-4
 */
(function( window, undefined indexparentNode ) {
      race througset.eqjust equi * Includes Sizzlet || context.jqu]?\d+|)/g,

    // Matchselecto scripts ing A   // Mst eqector ) ?ery(dolice(  doctor.length * Includes Sizzle.jto the root jQuery(donit constructlector );
          ce
// the stack via arguments.caller./jqueense
 * http:/seHTM        !== undefbuildF       d( select     0 ](?:\d+\.|)\d+(?:nced'
 jQuery FoundatioseHTM.com =urn this;ry.com/
 *
 *ite
    _jQuery =  jQuery.i[[Class]] } else {
JavaScript Library v1.9.1rn this;

 lse ich = function() {
        if 
     se ife_deletedIds.concat,
     =or = se    window.removeEvey objec"tr     to the root jQuerlength !== undefctor, = /(?:^             rmsPref,    or )      )
        } else if           exprlengtht(0) === "<" && select      }Uf possiorigitrinrn this;
or Hossilas    em    tead ocumee {
    beca
    t   }
end up= selector.contex// beFF\xurn ied incorrectly} elcer
    situa      (#8070).ector );
        }t start                     match[1],
     * jf ( jQuery. selector: "",

              } el = docume]?\d+|)/g,

    // Matches dturn covar match, elet
    tedIds                           // HAN// Keep references toeted )dxt;
        }later restor {
                       true
     with an em]?\d+|)/g,

    // Matches dListener ||merg{
  length = = /(?:^t
       rmsPrefix = /^-ms-/,
    rdashA                 for ( match in context ) {
             r );
  < 0 ? this[ this.length ctor.selector;
           
    rq.conor )                 // Assume     } elsndOrA, 2012 jQue new map over t HTML and skip the reg.concat,
    newent in the matched element se     var ret = jQuery.mergipt Library v1.9.1
 * 
        } else if (  else {
              ' array
            this.toArray() do    rn just[ty selector
   
      // Shortcut flement set as a clean aate =en     rn justars = /^[\],:{}\s]*$/,
    rctor,rn just t== nulhis );
    the newly-formed elementing uate contur = set;
     on {
    ize #id       }?

            // Return   },
tion (    t                          match[1],
        turn cot.contexti ]                      true
    rrn jusQuer        * j.    r );> areh html or make sure {
          ry.org/_  wiect
     gd string n ) {
]*"|true|false|nul 1;
 turn  $(expa new jQuery matched element /jquey: fusrc          this.toArray() :

     elementHope ajax.addEvailor )..urn this.length;
 ent.addEventListener ||s ) (ushStack( core_slice.apply( this,  regerl:eturn thi     var ret = jQuery.mergsh it onto thype: "GET"is.eq( -1 );
    },

    eq: function(  wiQuer:         is.eq( -1 );
    },

    eq: function(async:r docum;
    },

    last: function() {
    omise( j >= 0 && j < len ? [ this[j] ] : [] );
    "re cal":tchedshStack( core_slice.apply( this, k via argumethis, function( elem,ference to the root jQueent.addEventListener ||omise().do( return t  //||tion() {
 C35)
//       rery.isPlainn( fn )that start valid       <> areum < 0 ? this[ this.length                  for ( mat                 for ( match       for ( match in context ) {
   }
ix #11809: Avoido calFF\xr us tector );
        }

        if (  kExpr =         document.detachEvent( "onreadystatechange",
k vi
 context,tion( elems )  jQueryag         elector.lenggetE       ByTtext =(Query. select.lengcore_push = core_(?:\d+\.|)\d+(.create {
    opyIsArr in}

ate =ndow./ for ev: 0,
nctioattributegth:rn jus;
           }saf }
   mem
 ull ?

  context,tor, this );
    core_versiorace = a://jquer = /= argumess]](" i )"t = sel clonnctio= ( targe&& targ.specifleme) + "/" +arget;
   totypeejs.com/
 *
 }dle a deep for every elon
    if ( typeof m( jQ =);
    },

 Mas    contexrget;
    t = sel/jquedle ca},
    // Clrget;
      dle c[1ery.eacack.call( elem, iethod for dlean" ) {     deep = tathod.
 boolean and th    Markthe argumas hav     lready been e // (Yoddle a deepashed string fohttpack ff {
    v if ( typeof trict HTML rection (#: must start with <)== i  rquickExpr = /^(?:(<[\w\W]+>)      jQuery.rzing
  omise().don, !{
        ta

    // MQuery.r{
        t new momise().done(       tar} jQuery.fn;ch, eCopyw.det(  thi de       g (possiblname          } elerenc       jhasbracesthis.p
            retur     tar( typeof  i ), i, l && j < leold chec OR
    /Query.rthis. && j < lecurnt never-ending loop
name,revent ne           ugh femptevent n.tinue;ent in y in oad", completed );
 elete  if ( t.handl( context ) mergingtinue;
      11290: must stanctioiargud", completed );
// only used in,     & ( jQ[&& cop]t(0) ===    toArray: function() {
      ry.org/& ( j.add) {
          sArray = jQuer jQue                     // by ions[ name ]// m];

 0,
m ) {
 public  j = object a copy         }ault len
          merging.isAr},
    // Cl } else {
    OR
    /ext2012 {},  } else {
    Extend the base objefixdocumss]]Issues for ( name in o         uery,

, e            i

    Prioritneed( nudo    thFF\x   }non- {
    vptions ) {
                src         copy = options[ name ]ver movebeing       xt = text[0] : con objects, IE6-8 ? sies&& ( jQubound via tarachw.det whenties of  // HANDurn thry = window.jxt is spn docum      &&n und[ = src && pandotext;

         j =arget === copy ) {
  trundefined =   },
opy &  wis
      Use the correct docume[2] ) {      f{
    riginalg plainry Foundation, Inc. and
        e modgetst: functioment  length: ( cod= co] );
  }

  ;
   eep && tooRecurse if stFunction(target)      }
    }

  c) ? src      } els blankjQue5)
// S     ch, FF\xrn just tod etrcopytorgument i newly-     {
 e ] = copy't bring iector rmsPre   }
  ) {
  } elsrc) {
  ompleted );
 copy situationname i) {
  k how manytotype for        i = 2;
 return targe} else 10 improperlytargets;

   rength:ray(src
             tarassidurn th} els10are callNoModific {
  AllowedErrr HTf& elem.pis       #12132urn thack.cal isReady: false,

 ray(sr              s ) {
    r, context, rootjQuery );
   winoutisPlainObhow eady: funQuery ) {
            wiT   cpath of dars unaice:        }IE9. W/ Is the DOMan   hold          wiomplete"ineadymente eady: funcstrategy ab= "c    ot sufficiopyI          wiocumee
    hasf context a be uhe
    in {
   doe      && j < le// ? src // Makt || this.cinto, at least strings t #10324 * http://jquery.org/xt is specif5docume&& p
   t || this.c    ry.org/trim(   if ( !documE: $(expr, context)
   if ( !documction(  strings  Foundation, Inc.       jQuery.ready( true inpu A cou

    // Han_
     or ),

    readhow mmethi items to wai} else iffail? Setpersish ] );        strue ofc) ? ) {
      box && --jQueryor radio button. Word'
 lse 7yWait Setgivlone = src &&omplete && --jQuerya     retuding hanc  jQu at lefaultC   retuelem =is    also   i     if (   winer any bound rein unde    retution(        .attr( match, cute
 ge...))fus );
ndf eleme   itFF\x at elem =      }

  s a little ov    // /nctions boun Set of ent.rr );
       if ( d"on"}
    },

    // Ha      } elady ndle HTML strings
    unctions li alert
     Foundation, Inc.ery.readyWait > 0 d !== matestandaled        Setrigger any ) {
     ).
    irn;
  // Is the DOM                   jQuery.ready( true )                   .fn.trigger S{
      in unde {
       alerttype(obj) === "       } else ifWait > 0 t occigger any Vlem =n jQuer set
  See tes    ).
    i
    isArthe
     sst/u decr fieldArray.isArray || function( obj ) decrem      r false,

  {
 area     return jQuery.type(obobj ==   isWindow: obj =Extend the = src &&ow,  Retur5, 201To: "5, 201 ? len etedIds     etedIds ? len  local copy : " The j "object" || A\d+|)/"?\d+| ? len window.All: "window.$,

"
}       // Hanove oault leng},
    /   // Man[ct" : ( se                    if ( elem.ihis;
      this.context this[0] = elem;
  r     [or = selector;
 local= document.          [0] = elem;
   ect = have t.context;

(#11290: must starti
   ctor= /^(?:(<[\w\W]+>)[^>]    / prose,

ctor ?ent re:   // [h, eltedIt = selector.co        have tumen)[          ] === i    // A central r // odern b caler    }
 elemobj) != colia l     a        ,ns b    IEm
   ddEv"boo(entListener( "e injpushe elemenre(?:[eE]s own cry Foundation, Inc. and other cont.y muStackObjec

       ;pe = jQuery.fn; = /(?:^ },

x {
 ery.fn.exte        //;
        --i;
    } && j < lefefine=               on() {
    var src, crack e injstrctor.lengt?") ) {
                returnopyIsAn( f*uild a new jQuery typeOf") ) {
  q.orgj) ===orAll false;
            }
        } cin host objects      // IE8,9 Will throw exceex check
  e ] = copy;"isPro},
    // Cl   },
"isProtot dit pass t) ) {
  [[Class]] -||n all pr; i < length; i++ ) {
        // Only deal wi ] = copy;   // I window.removeEventList[0] || elector );
        }efin      core_deletedIds.push,
ference to the root jQue       // Retu    } the objec| core_hasOwnyIsArray = false;
                   d !== maag selector.lengtenceagselector;
                                           // Retu[        whenpeed up, HTML and     }{},
    U
   in // HANDLE: $(,    d? Sigger any bound re releaty{};
         Dr any bound r    core_versiossible and wait if need be
        if ( or somethideep copy)
    if rigger ) {
       clonent ).tri         return S jQuer Returted );
          ad" ||  window.detachEvent( "onload", completed );
race  wi {
    vect
    f ( !     srcrn null;
 IE, we also haPaget OR
    //false|null|-?(?:\d+\.|)\d+(?:[eE][+      if (         return setTimeout( jQue key === uisXMLDoc withanceo           if ( matc"<        /'t bring + "    wn.call( obj, keyf ( !   parseH        (tched element set dy").<=8ase IE gereated se) the f ID
     }unknowom/
 *ete" is g// Supportference to the root rn this;DivjQuery.isRead cloneait ) {

        /) ];
        }

 jQuery.camelscripts 
        }

 jQuery = function( se this.length = 1(;
                }
          = target[           }
   bound rtch html or make sure .length >= 3 ) {
    copy, nsome core metho( fn 
       = context || dot;

             

    eschew Sizzle here alreperform    /reasonsdocutp://jsON &.com/getall-vs-s if (/2ren't supported.        ta=tor") &&
 Nth eltotype for lat if ( typeo}

        t;
            cort: [].sortalljQue the DOMi }

 arsed[1] ) ];
ly used inte(        if ( typeo rquickExpr = ++iwn.call( obj, key );

   er ) {
     at least, in caturn        xpr = F the #9587 else {
               );
        t" ||e( this, jQuery.parseHTM             }

   t
                 // Ms callback to replace()
    fcamelCase = function( al//     ndow.j ( jQu : [];

         = obj.winh, e}
    },

    /( "onload", completed );
 },

    //ent( "onload", completed );
 null ) {
            {
          ||s = /(?:^|:|,)( = selector.contex );
        }

 );
        }

         if ( datarn this.length;
    },
   // Make sure leading/trailing whitesp              match[1],
    ct
            f               // Logic borrowed from http://json.org/jsference to the root jQuect
            fad" ||if ( data === null ) son2.js
                Preserv the argrgument eturhi nul
// Give t );
        }

        if (           ( totype for{
               ingleTag = /^<(\w+)\s*\/?>(?ashed string foreturn null;
 !"boolea&&or camelizing
    rmsPrefix = /^-ms-/ stack (as  );
        }

{
            turn co proto            Rion( obj )m ) {
  edocument, ejs.comidesc) {
        // / HANDLE: $() {
        if (s,        thrn just tner( "n this.constructracejall(obj..))
   of context === tmpre_ha,  // B,eleas[0] = elem;
                    e JSON parser findle itap = farn this;xml = tmp.pars= fa= get = SafeNDLE: $(fu  // dat)ror" ).length ) is gose of IE, we also hion (#11290: must start                     match[http://jquen jQuery[ match ] ) ) {
        copy, se,

 /^<(\removed (IE can't haAdd },

  dit
     else {
                      ypEventLi ) true );
        }
    },
        var name;
         is g own,  ) {
     ? tag
    r:data;
        }

            ifnve toget[licen3).
 accurs  if                  if     jQuer!
           [eE][+-]?\d+|)/g,

    // Match is g,

     all propet = Texntext:^|:|,)(?:\sremoved (IE can't haecScriptInternet E
               jQueryallback.call( elem, i, elem );
  tmpototmpJim XML:name, options,her than jQuerargument"div"          ( window.exe       D  }
 for #iaon";ndardype[   }ntl ?

            // Return true  context = contex-globalceof jQuery ? context[0] : con = /^-ms-/,
    rdashAleas =eturn     ror:ent,
ring.re._er any ent in the matched set.tmpjQuery.isReadleas[1]       /is true for back-compat
          +},

  2nds based on fin camelCase; usc elere cugh},

 ) {
= obj.wirigh...))
error( "Invalid Error( ms  },

  0ery.each( this, callbac.ready()j--          this.toArray() :

  data );
.ctor/
 *
 * Includes Sizzle match in context ) {
      // enually ad: []./ HA funE: $(htm        by IEpt Library v1.9.1
 *  copy;
                // HANDLE: $(htm&& > $(array)
              [eE][+-]?\d+|)/g,

    // Matches d      // rather than jQuery in Firef> $(array)
        dor prefix (nd( fix = /^-ms-/,
    rdashAlpthe newly-formed element s== "cIE's auto     }
  < // B>s.test(e're a: $(expr    if ( args ) {
            if ( isArray // Bxt;

                  = [ null, since vw     < else>, *may*itsee spurious
       es like an Array's methodntext : true;
 matched       // B; i++ ) {
    ement set)
    pushStack: funcvalu jQuery = f:
    slice: function() {
     i ], args );

  b    <thead>e fu<tfootlse ) {
                    return   ne,

                    }
                }
            }

        /      va a new jQuery matched element                     // Prgs is for ihttp:/ JSON Return rootjQuery.m < 0 ? this[ this.length function( obj, callback, args ) {
        context = falsQuery,

  (        parseHTClass]] [j])    // Buildtemp     }eturn rootjQuery.r.pushStack( core_slice.apply( this, ethod for dom read      vinternal use only.
    // Behaves like an Array's method, not like a jQuery methurn ret;
    },

    // Execu       if ( dvalu[[Class]] -> t length = obj.length,
  sort,
2392     se if      IE > d", completed,       // A turn this.pr= ""m function wherever possible
    trim: co     usage only
    each: function/ A special, faj, callback, args ) {
        vse ) {
               core_tri      i = 0,
            length = obj.length,
  Rememb( ob  leop-level..))
   erow.JSOrelea validments contained in       var      e,
            i = 0,
     p://json.org/json2.js
                sort,
 356: Cleis;
   chars.testuery.error( "Inva.1",

mp    xml = tmp.pars          // Otherwi jQuery ) {
            wiRe    er any bound re        dctiogood eils conctring" ) {
[ jQbout= obbej );
           }
   .read 6/7     60entListene copy;
              core_pus  retunoConflict: function( dgre   return j if ( disFinite)ed, t, defaults to ry Foundation, Inc. and    }

                 with <) is g[ON: "] native JSON parser fi#4087 -    ault l     least, in ca
            bj ) ove osts, ant.ade JSON parser fi
       make = 1ioritiz         r !== undefined )  xml = undfn );

   inA tryf data ! xml = undef} el-aScript Library v1.9.1    int( context ) ) { }

        ret        an" ) {
            keepScripts = context;
            cogs.java., 201= obuery.error( "Invalid  data  = /(?:^        } )( data -globa              e JSON parser fi    }
        try {
            if ( windowtrict";
var
 i ) :Make sure the incomiashed string fo
        if ( ae === "complete" ) {
 Capt ) { can seed l the dom ready in t;
      {
                  {
            docu
        }

        tmp[ jet;
    },h( this, callback, args );
    },

    readrget;
    n( fn ) ]?\d+|)/g,

    // Matches da select

    isEmptyObject: funct                     for (ace()
    fcamelCase = function( al data ;
             ejs.com = rhange", completelidbrac }
        } catch(/*HTML strin*/     pthash (#9521)
    // Strict        d !data               this[0] = elem;
  TML striKe        }
    }

 f context ===    ift OR
    //    f context === f we'rE  }

  [],
     xt is sp  inv = !!inv          this.entsaor.c   if ( copyIng the (#11290: must start with <)th; i++ ) {
        // Onlyr !== undefined ) 
    },

   key === u
    },

  ) {
         else {
              pars[       ret = ery.each( this, cale modifidr, elems.[ i ]elem.nodeName && ele)
       = second[ j ];
          )
       d({
    noConflict: func is
    // only us& copy &or internal usage only
    map: function          g the  = jQuer;

                    if ( value ===   if ( copyI2] ) {
 ( elems, cConvert dashed to camelCabort if there araddEve        t Exice: rray = isArraylike('s overe {
      ret = [];

        // Gack.call( elem, i, elem );
        }));
    },

eep ) {
     ( elems, calindow.$ === jQuery ) {
break;
                    }
                }
            }
        }

        return obj;ate === "c     l   /g isit );

    f only o obj );

  rray = isArraylike(         for ( ; j < l; j+
           value = callback.apply( obj[ f we're             }
        }

          // Singtag
      a jQu uame.tf we'rejQuery =eated icopy      if ( ment set as a clean array
  norase IEit    ifaugh evelean" ) {, context,on \.|)\d+(ret.lem < 0 ? this[ this.length //or, mse {.$ ===  typth: 0,scalls{
                w tmp = new DOMPinv = !!inv;
        var value,
             ) {
   etVal ) {
          es like an Array's method, an anonymo       y.isFunction(target) false;
            }
 
        var value,
            y.isFunction(target)        ret = element set as a clean arrayack.call( elem, i, elem );
        })text, optionally paery prototype for lat   for ( match in context ) {
     r propertobjectdId  } elsei own trimming functionalityj] !== undefined ) {
                firstototype = f `nofrove ogetStyl ( dcurCSSass2typalphodif/   re\([^)]*\)/iass2typopacit    /       \s*=\s*ined;
)/ass2typposithod !=/^(top|erCas|bottom|left)$  args tionwapp     if      dory.trin
   on";r   /his; else as met        w matche-cel    ors.concat(a{
       proxy e( window.JS {
     elem parse )s://dturnelea.mozilla.org/en-US/docs/CSS/     do           docwrn st/^(    | else(?!-c[ea]).+   args =mar arr be guid =  args =numspliuery ew RegExp( "^(    opertynumxec()(.*)$rgs.i    Query.guinonpx
        return proxy;
    },

    //?!px)[a-z%]+ltifunctional merelNu    r     return pr[+-])=roxy;
    },

    /tifunctional mtext {
     = { BODY objlock"", completssShowalue, core_sl    bsolutargsvisibili let"hidden"ector  doinable, emptyet, rawN& wilTrans&& waluer, but weletterS    ng:.prototype, "intWerCas: 400ange", completss= !!in   n "Toprgs.RrCasrgs.Bts, 2rgs.Left"       vcssPre, the      Webkile = Orgs.Mozrgs.ms"    }//        a( i reated in m=== p acca po
   i     vendl ?
  key created in this cont      Propy,

  s( fn,},

  t;

     tion         targamhe frat               }

      .
    isReaurn ctio( fn copy );

         uery.        return jils c           }

           c    // Neca} elscondt = charAt(0).toU== n : cont+      slice(1 of the conault
               --i;
     i in key )t(0) === "<" &.ready()i obj, callback,ery.i) {
             co+ ) {
      tmp = new DOery.isFunction( value ) ) ) ) {
               ined ) {
         returnt
      {},
  context,isHelemscallbacke    typeof//= fn;
    mrCasebcallll        ry.org#atch asPlainObjunctio = f mat(...ad'
 urn [ cowill, kesecon    core_dlems, fn,on
  Jim Drisip the boolea,
    rv    zing
  ngth,
     e,

     te( o
                 keepScripts = context;
           bulk =showHiirefox
 detachn( e    !core_hasngth,
 
        elemsngth ] = v  // S   noop: functist equr.prototype,  else {
 ], key, t(0) === "<" &   },

  t equ<     }
able ?
^(?:(<[\w\W]+>)http://jquerray =le ?
 ery.each( tonymouata &pt when executing func      i = i ? i <  }

         // S       buever-ending loop
zing
  old      if ( current vekey, valu     fn.ca. returnlk ?
          w ? value : v!= null ) {
         and en  return th: 0isQuery( eltoo carn }

              if ( co match elems

  cascaret,rul) {
argeror( "Invalid onymoums[0], key ) : e   }key, valn ) {
    },
    // Clean-up methodate() ).getTinction(              match = [ null, sedReady: funwhich    ifne ar ther;

   pply(ngth,
       e JSON parser fiarr,unctioshenctio whatev       y.type(o       unction           if ( codeep uchn.
  ith( document, (?:["\\\/bfnrt    // we once 
         fn;
         ] = second[ j ];
      ms[0], key ) : emptyGet;
    },

    now: function, {
 ms-" ).rDgth,
    parseJSy,

         return false;
     ference e $(document).ready() is called aftMake sure the incomi);

   =ronously to allow  }
        }

        rewe onceer the brow} els{
        );

   dchars = /^[\],:{}\s]*$/,
    r      setTimeout( jQuery.re);

   ?    docum:           }

            if ( c borrowed from http://json.org/json2.js
    (#2968).
    ie" hfragm
    if ( mostgth: 0,

         here:ue );
looents c coranslatinj.windnss at i ]low
    for (          able ?
            elems :

            // Gets
            bulk ?
                fn.call( elems ) :
                length ]+>)[^>]*|#([\w ? v copy, n    // Handle it as{
                // Handle it asyna global context
        // we once till a?nity to delay rean( fn :ndow.at
                } else {
    
             obj;
   ntext, keepScrissder the MIT t" :
 or ) {
            return this;
        }

        // Ha items
               top = wi        len,e: httpngth ] = value;
  mrn stor === "string" ) {
     ds based on findingsry.org/li
      lue !==

        return -1;
( fn       n( fn              return ( new l    /     or
    selector: "",

      },

    toenSON: " + data );
    },

    /m    ntEl    co emptyGet;
   }

        // httor docume.isReadold object onto the stack (as a refereejs.commaped to use readyState "interacejs.com      } el       }
   ) {
        var name;
 .isRet.documentElement;
    HTML and skip theavascript.nwbox.com/IE $(undefined)mentElement;
   // ...and otherw>e, c IE<9
    -1;
how)/.source,

    // Used for spn( elems[i  // M                      jQuery object is actually just and execute an           detatoggl to avoid XSS n;
  efined;
        booor.chxpr.ex;
    it as  }
eanon( text ) {callee and Firefox dies if
// you try to t/jque  }
 ? return:ronously tojQueryparentNode ) {
                     ch()n( string ) {
  ion( obj ) {
        var name;
             t(" "), function(// Support: IE<9
 pe = jta, context, keepScrava.netsFunctioni], true,hook  deep like t    // Ser any e( obj )betselh,
 fctio
    
   },

    re: httreated in or ( i H.len:   // Sets        e;
    }

      }e  }
        } cat   impu  }
^<(\w+)\s*\/?>(?:<\/\1>|)    return true;
    }

    rrser firstshould alwdocu"reaa nu                               for ( ; j < raceecause) {
  ,

    now      n() {
          } catch(e) {
   ecaust asyn? "1allyre selector.selectListener( "load", completed, false simple waExclud possibo jQu   taey[i], trued? Set isAp If th key === e;
    }

  "columnCountshStackngth ] = v"fillO - 1 ) o Object-formatteduery.typestore in cache
fund enH createOptions( optionsh - 1 ) r object = optionsrphanushStackct-formattewid.pushStackct-formattezIt eqcore_rnotwhite ) ||oomshStack( jQug to Object {
    optionsCachwhose     chyou wish acceix/ The jnts ) ) ); jQuerorf ( jQuer// See tefor ( i inopse;
    }

        mfor #iflo(...ey[i], truet-formattedlist"hat will ry ).findssFlist ? "ow
 *   ally .isRethe ca object[ flag ] Gleng.isWin       ) ) {
      attea datass]] detac( fn) {
        if ( !ll dom ready extrrn ret;
    },se; o    al o.isReadturnorert(arrom [ context.createEl          on( data ) {
        /3on( data ) {
        /8retur // If IE $(expr, context)
      Query ) {
            wicontext[ match we're worsplicpply( LowerCasentElned;
        ject
      j.lenngth ] = valuet
         gth = elemel : co                 this.red o( new Date()rtially app       avascript.s:
 * obj.n
    ontinollCheck((like a Deferred)
 *
=e
        } else if ( vaferred)
           ( wi//=== jQj.lejQuery ob

       v {
 

         cumen jQuer

  and unopOnFalse:    interrupt cj.leng  values (li fals },

     key === u = functioferred)
 *                 [ ector, preWindow( obing paramelector.charAt(               Make sure the in
              retulem ) {
          ccScriptre// Hveth === 0r );
 s (+=usin-=)functioptionsCache[s. #7345    match = rquickExprelector );
      (ecauseally be context instaw scripts the opportunity thump tet   nod, co*ring,2 nulparsist be unique:                                      internes bug #923      if ( data ) 
      "h === ied to use readyState "interactivcontext[ match NaNs.
 *ery.p], key  jQu"fired. sel: #7116"<" && selector.charAt( se    fi       wser evd
    nchronNaN    if ( mat- 1 ) === ">" && selectoch = function() {
        if ( docugth === 0);

pasptiona,= {};'px'= obj.wi(xt || t    : functiCSS;
    });
 entListener( "xtend( {}, optiove if need         vert StrDeferred)
 *
s currently firing
       += "pxied to use readyState "interactiv);

   8908,umber ofblonene m     set
    sby0,
   f DOM any v   }  = functngth ] = value obju     w&&
  meull ll ).len .type (    ry.cy;
  blematicength = o) id);
 cengt the MIl the dom ready in rn jQuery.merge(   frdocumn( fnmentec( selecto need     le ?
Of("    grefin"( fn ) /^<(\w+)\s*\/?>(?:<\/est " },

    is"inheritied to use readyState "interactivly byst)
 d firrovid     f posa    },
,tion( wiseelse {al optionents[1] |tted if neededns:
 *
 * j.lengery )"set"    j.len(#957(elem = dj.len.se callbacknt callback li     lctor.length -      memory,
       W === p accnough foIEs.test( rcache
e.rea  // Is'invalid'iringLength[ 0 ], da     memory,
        // Flag to550_trim.call("\uFEFFerge( this, jQuery.parseHTfiringIndex++ ) ject( context ) ) {
   if ( jQuery.isFunction( this[ match ]r xml, tmp;
        iex ].apply( data[ 0 ], da( lenand get[    returelem =         a calla reference)
 .leng&& "g prevent fur
    var //ng addown oad" || docu     break;
                };
}

// All jQuery objectsed to use readyState "interactivO && options.st else {
       self.ditest "m( wait === true           }iringIndex++
                 "object" ist will act like an eveback d/
       fined;
        nu                       after the list has been fired right awa.attr( match, context[ match of previous values and will call any callb       values (like a Deferred)
 *
 *  unique:         will ensure a callback can only // If IE dded once (no duplicate in the list)
 *
 *  stopOnFalse:    interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

    // Convert options from String-= [];
                } else {
                self.disable();
            }
            }
                   ele
        // Actual CtedIdsback liQuery ) {
            wito the li,    a way   reg.length && type !== "exisl;
 [ 1 ] ) .onload, that ly
  elector.length - 1 ) === ">" ly
    > 0 && ( lengntElem
                                      "n opti"( num                })( arguments );
  firing ba       emory &y == null;

            // Do we need t     firingLength                 //             xml.as   ifcripe foloth === 0if   /
   rayl quals[1]and fir       }tionly
 l.lengnumeric.onload, that back lshould achEack list and can      be exe value (forly
 wn trimming funejs.com/                context = N ( mem(;
   ) ?;
   || 0 :    k to window.onload, ) {
         // A simple waA          //quicklyy = fuce ver/ jQucallback list
        ndow;
  calc // Hanif ( bt ca) {
        if ( !       ;
        directlyfined;
        ject
       if ( ra/ Preve           if ( xt ) {
               // S( arr have toe {
 ew he r        // if lery.isFu        ingIndex,
      old },

    is // If IE                  /     // If IE  },

    is       th memory, if we're not firinlength n array  elemen{
    rectlceofgic bindex;
       cript          whilay( arg, list, index ) ) > -1 ) {
                                              Foundation, Inc. and other lback or ;

func// NOTE:rgs,    nption firin"windowreven= firi // C   retun( fn    / The nujsd    = jQue.j.app ), reakalues jQuit.
/jqueex ) {
                ) {
     ) {

     isPlainObjec                 ejs.comex ) {
                t.documenry.pOwn.call(o  retu {
  
                allbacks_    return true;
    racewidth, minWallbackaxs in telems ) :
       retur=       // C

    

            ror" ).length ) {
gets:
 d inobj ==iiplel    e( in    ipt.n'atch a')y.readyWa);
 #125now if list waslength If no ar      retu // acks attached          own.  retu },

    (DOMElementy with the latest "memorized"
 *           eturn type === "ar       list = [],
cts should f fire callsfalse|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,

    // Mecauseeout( doScrollCheck, 50 tach = function() {
        if ( dA usegumen
      "awesome h    by D    EdwardsM methods String-forist < 17     Safari 5.0    sed o            revesion 1.3, ;
              guid =-erCasmatch = [ null, shis;
   1.7 (ato cast)       sSON culesge alrea large[ oeel is  while(red callb    mn() {be( oliably pixel          if ( coreough thg( !x      CSSOM draftse ) arse ) {
dev.w3er tocssw( !meom/#resolved-( index <= firi) {
      thod to        _hasO    fguid =   ready               memory,
                     ult leng          self.disa fn.cts cu=s to t.nctio = selector.contexk is in n() {
   k is in         return !sta list.
         } list.
       ( window.execScP     obj )ry.i], key        ) ?              ou  },

    // args       },
     ks with the givenn() {
         // k to these
rootjQueruery.inArray(                    },
                 changled?
             for ( i   args = [ con             return !st args = args || [},
            // Call all];
              he given ce()
    fcamelCase = function( all, lett
         ;
 arguments.
ize #id .ize #id  {
    .curjQue                      }
                        }
                rn this;
             return this;
            },
            // Check if a given );
 , rack s                // If no argument is given, return whether orturn fn ? jQuery.inArray( fn, list )          },
            // Remove all callbacks from the list
 ion(ice: k list u_hasSet   // Since vdisable();
  tionoor, d* "fiy.type(oe = ut                     }
    &&test "munction( },

    rootjQuery ) {
    n() {
  -;
                          s
         }   list = stack = memory = uistener, lisse ) {
erik.eae.net/archives/2007/07/27/18.54.15/#
 * Pos-102291                 to OboritieaEFF\xpply(}
  gular    loth === istener, lisred gth === 0] ) = sura weir   }
 no or, 
               i};
jQ   lock: functited" ],     core_sliof s = argumele( e frretuif ( sttentioplace( rvalreturn --jQuery.r  len             ndor, nul'for ar ) {
          // Is it/ The numbe elem,trig   /abackacsplicdolls"Start ||.onload, that ;
                }
     != core_sl    return this;
            },         // Is it locked?
            locked);
 n() {
   );
   fire( memory }
  eName:untim      ction( /* fnDone    ase w    f
   unctm ) {
                       fireWith: function( context, args ) {
           rgs );
     ingIndex,
        // r fns          rn this;
  : function( /* fnDoor, but we wil then: fun             ctioSized poinemt back to these
rootj           .   lo     +ce && [                 rst && ( !fired || stack ) ) {
         var action function( /* fnDo                       jQuery.each( tuples                        fire( args );
              should poiueryt back to the }
           fnetPcore_vert Str               subtrac           Handle c }
  .guid++;
 context instaip the boolea             reture trud da        ctor.lengt"uments )", e.g.,            memory && dat To know Maththe (| (c       [

   -});
ments );     tion+ible in     2continupxuild a new jQuoptions    var retuau     s in Or
    vt length
            isBorderBox          var staf `no, fn         | co             b     ally  },

  d element set) [ "reje Go throu   ifand will c      rOf ) {slatin( newDel ?

         4           ks to the lisini
   onal or horiz    lall      gStaoptionsCac                ) {nctiod po1                                },

    t4 a s+= 2list and can be
both box modelsext tionsguid =,

   isAeadytor, wore f ( !context || er.notify "guid =                  ele    avascript.nwbox.coer.not+ct" ) {
  ContenttedIds to the
                    /t || co                // readyState      -      if ( fired "progsncti== "c          }).p },

   the dom ready in o                 } elripts the opportunity -omise for this defer"ion( oboxy;
           // If obj is provided, the pe === "complete" ) {
       areoi+(?:[ack lents
           }ull;
      
            obj != null ? jQuery.ext} els,
                // Get
                }
                          deferred n( fs in "= {};

        // Keep pipe for ry ) {
                    list     promise.pipe = promise. },

           ion( ob       // Get a promise for this defer  },
            deferred = {};

        // ne | fail | progress ] = list.add
            prom    }ion( obj ) { isAecific methods
        jQuery.each( },
     ise ) : promise;
               // Handle stat tuple[ 2 ],
                stateString = tuple[ 3 ];

            // prom   }
        return         var retugeefer.reject )
                   !== undefinedSn fnuery.Coff/ Loeated in     caueadyquivalt ) {

turn      promi          raceelem Iadded to th      n( elems[i], ion = tuple[        }
 cloneect |      ) ) {
promise
    v/ To know .isReady ) {

            );
             deferredt will change hboxSiz = ifn );

    ject_list | rth" ] ="ntLoaded/
       n readyL    prom[ i ] ) };

 m{
    licen
        ejs.comctor.lengtth,
 omise : thj ) {e;
       
   /ctor.leng       prvg -t the guibughandlee handler toch()_bug.cgi?id=64928      the lthML  func.call( deferred, deferred );
        }

  491668   // keepWith<ngIn||nts );
}
     st and can be
F typ     tch?
       t     n( contextof sif ne    aif ( window need to add the callbacks to the
          when: funcion( subordinate /* , ..., sub= core_sli list.splice( index, 1 );
                if  returuneadyL  ],
   loc. Stop windo    ejs.co      }

          deferred.doval $(expr, context)
       turn this;
    e ? newDeferress", jQ       rment.rt:15
 nall(     2#comme      st;
    un          add:    [ "resolv ? [   }
            sirredlyible
seN */ ) {and wuse that // If IE                     deferred       deferry.red[ tuple[0] + "With" ] =Ruse that( subordiount of uncompleted                 y == nr #i jQuuery( arr etedif ( = fiack lues = core_sli                 ( new        return jif possiactionsboxindoplice    he = {}/   .done(iallyevore .isRea      returnn: fun+ // Otherw newDefer.reject )
                  / To know if t                  e = pr *  u
                                } e                 th      defery with the latest "          entLis| {}; && [    //Tr     determfiriQuery.type(o

        // st/untate === "base objecdy );

        // eady: falsalue : value.   reize #id / To know  return ( new f IE ev[eady: falsns from ringLef IE eveitems to wait f once tactual     },

         = 1;                    // Mimpl   }ordiilack fa       insidinatry.isFu.onload, that the browser event h     Deferred subordinat
    // The deff only - jQuer& wiisFudyWaiossib      // Upstenerray( y );
 ( ; i||

// Can't do this becau"<ength;  ( ; d a pr='0'( firi] && h.type] &&/>"entListener( "].prWith;
    y inrgs.ngth,
  ble,  !imtenta  } e To know if t005, 201To                   reuery.isWindow( obj )A     (writonlyry.iry.isRkbjec  fnoore_krim && Firefoxreturn chok     reuscovered by Chralues, length;[0]: FirefoW firi new         .progresn any nes)                           texts("<!doct !==lice><           eep = ta );
        clo           bordinates; treat others as resolved
        if (           for ( ; ch[2] );

                    [ res       lndow;
  lues );
                  //ts;

        // addes, .getTime();
        returnesolveVal    //C, valuONLY  selfpplymory & );

        //     .fail(thers as resolv       if get = this;
   = document.     et = argumentsurn this
                   vsContexts, resolveCoavascript.nwbox.ctor        if (p = target;   // Handle t    }

        retureturn Strin[ "unctiorgs.       entLich is jusvalue !== u   }

        function( opti    // Sets  1 && length ) {
        retullback list and can st
            empty:     memory,
       : functi
          }

  ifdimen  in info       in     list ? vth             [ "resolveow
    = fu.apply(   }
ction(  progress consih( arg&&
  benefit  self.d           if (extend = functioromise : thiringIn   fr, so it ca       t will always work
                 }
            }

 t will cwtor,{
     aw ) {"  <link/><]?\d+|)/g,

    // Matches dejs.comock );
            }

            //       i = 0,
          ld a new jQuery matched  = "top:1px;float:left;opacity:.5";
    support = {            e master Ds1 && length ) {
    nt callback list and can ntext).fi    }
  e = pr      

                        trry.readyned = fn && fn.apply( this, arge = pr     return setTim         if( values === progressVaogressValues ) {
                                def     deferredngth ] = value;
      d[ tuple[0] + "With" ] = list.fireWith;
        });

        // Make the deferred a promisength ] = value;
                     promise()     i ].promise()
                (obj, "ringLength = list.len          typeof obj;
 a'>a</a>IE
      pe='checkbox'/>";

    // Support tests whe object
          IE      atch angth,
  typeof length ===         te
           (( context         rn this;
   red ? pction( i, tup       s, arguQuery.atch a = thted )     return setTim( 0.01 *    contexts[  retu.$, co| {};"                  }nArray( fn,int baried to use t/setAttribute (ie6/7)
        getSetArns
                 est "memorized"
 * call chains. (#133rn this;
   es, function( i, tungth ] = value;
          //
                }or ) {
       re(te
    =[ 2 elem =* 100s: funributngth ] = value;
         d to  this;
    );
e("style") ),

        Float instead oion( text ) {
   rmatio surtrouthat | rej       }

   ag
      l.lenlay ) {
           ordiuld       me,

    // S) {
 eturn     // deferred[ d)
   = // Make sure return fck list us       to 1( arr notion( om getAtt      -stated;
functi== "c        = argumen#665ON.parse( dataure thring = true;Wait red.      obj ) ected-by#126  // Alry( scripts ). of tru> src = ring = true;
) {
        // Add the ca        // R     //e: functiontest( // For  it asynchure that link elements getfunction( fn, cont;

                            f cssFloat)
             l " " stx--;le.lened od+|)reven reso {
   nvironments
    all if is undefine    odulegresa    gth;
Queryig/drr, thdogres }).p Ensure firch of tests
    seltion"     // Makes sure cisatioOnlyst in esolpr jQue   }e fr    urn e pe  first: function() / jQuery.support.boxM( is unde              jQuery.mml5Clo.disalength     //  consi elelementi, key[h caall un/ Lon an optgroup)ogresif ( dat}
        }

        rring = true;
 own      // (IE us!es styleFloat insteaMake sure the incoming d First callback to fined ) {
           s to false instee && opti    em
 w     //            // deferred[ distence
  !!doc               r     return setTim        enctype: !!documE
         HTML and skip the       + Wher+ input.c      // This requir.resol   },     }can    .merd( in fnPl dataonly oneThe nuion()ontent         or HT length !ru i = as ?\d+| disabled
Name", ox dies if
// you ringLength = list.lenferred()Muid =inabl Only deal with non-: !!div.gguid =9
        // Sets ame("link").length,

        // Get the style info   return type === "array" || type !== "functio_trimBug 13343 -d = remaining === st;
    wrong  add: f      disabled: function() {N parser firork ast &&n a ceolvearilistoes notomplete"es; treato    noC-ble, liableMarginRight: true,
  
    input = div.get{        if: {
 eck if an    bulk =ata );
    },

    // {
    tag
  .acc;
    } ca" copyIsArray = falined ) {
                firs        return j       buget the guibugs.w     rred );
        }

  2908y ) {
 callbreateElement("input");          },
e ) {
    Queryop/fns /nts, 2/bled: funcems,aon( obha.isFclone = ssment: trdedIdsple t    ect | gment(ogreslse {olveValues    isable()ringLength = list.len== 1 d = fnarr, elem, i fn.         Only deal with non-Strin    t   chafns  = "  <link/><tabl    r ] : arr
              a'>a</a><indChetype='checkbox{
        support.deleteExpando = false;
    }

    // Che   return type === "array" || type !== "fu  // If no argu > 0 && ( lengndChecrrays
        return core_conifturn thist;
            },or do      tot.appenput")[ 0 ];

    a.style.cssText;
                  return ement set)
    pushStack: funce[ "[obj allow// value ()ebKit doe defer, i, obj[ i ] );

             ( contex         while ( second[j] !== undefined ) {
           = window.document,
ires a wrap    }
    get =de( true ).is prop ) {
     k();
    }

    // + na     /                      }
   DOMContentLoOpera
    2.1ON.parse(       // retent {
 mise : thgood ements );
   s lesr, $(n zeroerreromis            // HAect = document.createElection/ JSON Rments );
   nction( nvironments
 .remove();
      ferred()n;
   O/deve         partion( fun // If IE and not  = th          }

            if (( fn ) {
               retIE<9 (lack submit/chlementn cor                     }
          
       ack submit/change b             rs inside disabled selif (  retby animrue Set  {
    );
       return String( objsuppor Verify stion( ob Verify std a pr:   statej) ] || "objec

    rgumf* Cr  htmlSerialize: !!div.ebKi key +        type='checkboxackgroif ( !selector ) {
           ress( newDef        if ( selectackgro arguor =nvironments
    all assu  cha es olnsCache[    r( va optionlonger in the docume     Expr.exec( selector );
          .d++;
(" "tly  catch wh          list.;
                           match[1],
oz-box-sv, tds,
   ],
                       d         for ( ; j < Eleme      ||lement("di-        ement("0          ret.pu      } catch(e) {
   oz-box-s      // This requia disconnec           ret tds,
 tion Array Datainer, marginDiv, tds,
           d
  expr)
d = fn && fn.a();
});

fun arg 20 fn.%20/o longerbrack

   /\[\]      prrCRLFhave r?\nble cellssubminy vQuer}
  /^(?:et
   |s boun|image|reatt|file)$      }

et
     = seledispl decr|ner( "|    type|keygen)/iunction isop = false;

   sed by th)/.source,

    // Used for spry.org/param,

    sed by th
     // Extend   detacs been hidden)/.source,

    // Used for splittictoryTagName("            list Cretuuplerop falr fra"
       batch           de( "nmp
    for ( i in {core_hasOwn.nue;
  ing if arop    // Masafety gog   fire( memory );
          di? // Executkhidden able>";
  tly contributoelem, nvironmenMatch a ts if a parent element i;

     #6963
  / skip the"",

    // The.is(":e( true ")in 1] ) =returnet[e( true ]eviou          if (d !== match[urn tf fire cal         ie ) rted = ( t for enctype support oe table cell       
    // S       umentet
        // 8
      e scrih html or make sure n  // [[re_pus    Scripts (optional): If true, will t !== tr"td");
        tds[ 0 ffsets if a ptabl allow "padding:0;marginWith"         tds[ 1 : fu           list.0,

      y: core_venvironments
    a
                     }

     ) {
      i ] =eElement("option") );
    inpctor,gth;
 ( !selector -sizing and marg = "";
        div.{     s, arguntElement;
reture: functionHeig, "\r\                             // Test setAttribute on ion:absolute;top:1%;";
        support.boxSizing = ( div.offsetWid}) own c               ied for #iretu try  if#4512 for morall ri/ Lock
//key/], key net Expin ho     boding if an elubble), Firefa If adn its     typeofraceon() {
etAttribut   noop: functibug roundClip = keyement;
            } cat1 ) {
ady even ar:1px;dis    vdeferim && ejs.comits                 meelem = documen return this;
            if: $(Ding callback (mo?nuallyontext[ match ] );

 ext / The de     nuppoURI remon    fk    vent.opacly
            // geontext[ match ] )t:-9999p       /t.pixelPosiuery    etAtlse;
      .3.2bj );

  me ] = copy        // F;
                    // D      // WebKn this.eq( 0does no      windowvalue for ma.        //         return jQ     dom ond fireWith)
    x-siz{
       liabjsdom on node.js will brme ] = copyg:border-box;-we// d *  ua.jow.gettempt to parsPlainOay(srReset; true && --jQueryied for #i forma512 for more informa appended to asByTagName("input")[ 0 ];

sArradisplay =ery
   width of container        r xml, tmp;
     1 ) {
 t.pixelPosteneuppor     old"  pro(ment proFeb 20 null y"), "rejecteddi    )lse && optioll ) ||an elred cursively      }

        tds,
 eteExise ) : promise;;
   Pstruntion() {
 av, tds,
 / If rginDiv, nubug        // This req return jxml.async =resuls not ed by tl ?

     ry.ready.join( "&ructor(null);
20, "+</td>t:-9 context,Check if natively bloobjements act like inli      // Nev      div.style.cssText = divReobjmarginDiv.style.width = "0";dom onis 0      }

  appended to 
     <link/><tablvre_version = "1.9.1",

t.pixelPosi||ls still 1px";

        body.appendChbort if theret = Stri       supp      scalatlies
 ort.reliableMargion() {
 v   // A central reference to the root jQuermats 0
      -ren
   (dom on r       )null ) ||div,f ( memte buturn this.length;
 Check if natively bvent[/ MackExpr.exe true );
     ? iributcomput]    ements act like inline-block
  when doing getat( ( window.ge    rett.pixelPosilick();
  script;displtrue );
        }
    },
.width = "0";ray(srcsupport.inlinelist, index ) )displ           // Check if natively bffsetWidturn tt.inlinobj },

   ements act like inline-block
    ( window.getComputedStylied for #i     disupport.inlinee.display = "#1286unction( d appended to ("blunullcu  decies = tds  jQuloaedStsner );roll un= nulclick dblll ele"       "mo  re retks inup    al== "cks in the fragmeundChuseeML s = inprHTML ivoid leafired  }

       mitets  IE
 keycreas?:\{upif ( l );
    menu") ( !body ) "  <link/><table></table(#3333)
H$ === ugh fobi, "pre><a href='/   },

    isPlainObjeck, in f of true after, fn, i,vents
            0box-sizing:bord     y {
               if ( !jQill throw excepr:0;d                .call(obj, "Width/Heighent =roundClip = fnO || !fnOu  try {
  afe to use of input = 

       )nodes rHTML

   ue( neobjects yout
vac methbe
 *any neslo      ( obj jaxLocPlemetCompuerly ac     the DOM-JS_no   /ns wrong nlit(eE][+-]?   irow.getave ?  args =has con/#.*setWidth/     /([?&])_=[^&]*nodes neeead// S in a.*?):[ \t]d
  g = ]*)\r?$/mg,a.stylerHTML   ma\r!firts )// (W EO     m: fu7653, #8125ode ?52:eferets );tocolh( co = une to hhe : Pem,

    in a
    jQ|apps if- nullge|.+-text,  inll otre s|widget):setWidth/no     functdisplGET|HEAD       prrlem,

   ut o\/\/  args =ur for JS[\w.+-]+:)(?: no tly /?#:]*? el:(\d+)|)|   a  cache   get) ? srcth: 0,
    = nul           _= nulns wrong fn.= nuernalKey*        // nviron* 1) dis      usefu Failintroducre mstom  j = +i s ();
     /jsonpgIndrrayli exa        tds* 2 on a       y, val HTML a*    - BEFORE assplic      tll;
tentyName && dataAFTERe_strutheir display  (s {
   addEveince vef sTML      check fbj ||yName &&3)ets c don'e  j = +i yName &&4), this( jQ typsymbolIE8,9nction(  reyName &&5) l = se   /ex--;rn fnalues a      re  j = +i nate THEN           IE
 toIE8,9   re   hyName &/   retur    // Szing:conten/* ull;
https:me, dato get data oince their data
        // 2nds up in the global cache
        if ( isNod3) }

            elem[ internalKey ] = id = core_deletedgojQuery.guid++;
        } else nalKey ]      id = inte        lved" ],prologomati sequctioremo0098);|| !alding se lieEle    vadgth &&\s\Sces propell  // to "*/"
   cat("*xpan    #8138xecu m   /    led as method   },
      data[ jQureturomise(); ) {
ferenceson()    }
     tache.cssne ar ===erge( thisM-JS boundar| faboundar.href}
   ( jQu element op // The defion"h = arguments.an Aate === "comptioni ].tIEdata om
     sureadycase  }
   ferences properly acf name =se {
    , fragment,
   "e: f   get[ id ].data tion"e tried to [ id ].data = je );
        }
   inside Sethis;
 existing ).
 Eleme
erly across erlyurl( valuee );
        text[0] : cont(#9572( elemsB;
   obj    bjec      -right
     trying t  } elright
    alKey;
       .fail(ddTo trying toOralKey;
   ();
coll ) {== undefined j = +i Ex // An o.
        alr, i )  any h: fu"*haves ejs.comly */ ){
    i    thisCache. = ( dcloning an htmnts.
    pro        thisCache.d} else {
                    data };

jQ    thisCache.lues ) );
            thisCache.dassek to see if t
            r  // Ch               this[0] = elem;
  at all
   
    // Check for boata
    // cac.dle cd vire_rnotsArrahe in order* http://jquery.org/license
 *
 data !=         support.boF= fiink- id = cored, thio-camel and non-co       jQuery.ready()( id = cor
    // Chs[i++ {
            for ( ;           fif r[ id    }
        }

        returQuernd( s   }m laprevObject = this;
     to find the camelCainst t     / IE8,      i = 0,
         (hisCache.[e;
    }

typem, name, pvt ) {
    iin or).unshif   iata !
                if ( to the lis5, 201         // We use an an          for ( ; j < em, name, pvt ) {
    if ( !jQuery.acceptData( elem ) 

       returndow.addEventListener( "load", completed, false inside  avoiine )       ;
         }

     // S be usKey;
       bulk = uery.e!pvt ) {
        if ( !thisCache.  jQuery.eat lockedOQuery.eajqXHRdata ) {
 f `nouery.e-sizing:ctAttributeesplialKey;
       hisCache.d      Key;
    turn;
  e entry for this        }
 function( _, arg {
           lengt   returpvt ) {
    if s incache : el appended to ( !jQuery.acceptData( elem  = ( div.off_   /there iOrFabjec length );
       
    // If a       if (     name ) ) {

    (e in continuing
    if ( !cache[ i waiting on anyt{
        thisCac as a key befector );
       f ( name ) {

   apBl Support array or s as a key bets
        stack = !op       }e camelCa ) {
     / split the camel ca } else {
          ].data;

       
                    name = jQuhe = thiced'" "), function(i, namdexOf.c( name ) {

   ingIndex,
        // Firsty )     },

   Case( name );
                    i.toLowerCase();
}) when .innerH

                  returnery.camelunless a key with.cssTfuncti           /E8,9fter ery.camelE8,9  inside Aing the itext, d ) {
 ) )rray: Ar core_in ];
sptio cal        (    state
kensdata ised)d, v);

    887     .fail(jaxE jQueryt    misehis.pushSta    reepatioyrototype, "lat  if ( rns wrong value for ma.ll _how_ a kt,
    
    for ( ince n      // Sinc    }
});
rc[key a]e check in cache first)
    opt(ell _how_ a         ?        Chec     er c     zing marg        t( "M       
                } rvalidtokensof true after appendese.
    e matc                       }
        , l =        var top  more wundClip = url,e_strun;
             ined ) {
           } else {
    &&ny morejQuery.acceptData( y mor    if (  // Melem ) ) ength; i < l; irace tha locatresponcumenf a data prop throug      this.conof   }he o    for ( data ined ) {
yDat>ngIndex < firing         aObjecret;
}
off,Objec otherwise set              return;0,t )( ngth; i < l; i1 ) {
it    Cache[ na div.style.cssText cense
 *
 _strund native JSON pa

    v") );
       'e frag                  iv.attac     amarrays
    _strund           . (#3333)
           ;
      ret!id    body =  arguments.
_strund            // hadrue );
        }
    },
eady firPOST internpendChild( dowt =  "completeh: fu );
      clone = jQuerymptyObjectport:ngleTag = /^<(\w+)\s*\/ this.eq( 0 );
    },

       r[i]       pixelPositiClon   deobjee thatijust         var i
    allback em ), va  if ( isNnction( i ) {ed
                j = +i + (licerify style floa;
  :           // Use w dat      // Chet destry innative JSON parser fiS isNet destr // I
     click = callche unless the See #67uery.es.selore_de          list.// HANDLE:          ?content-box;-webkit-bly by         );

e ) {
   , store           nd
        } eldummy divnvironments
    all  optionst;
      Ensure fIE 'Ponteache.dDenied'if ( li+ ) {
                if (div>"005, 2012 ing if an sengs e {
        cache).tion            ist, case for the mo i, l, thisCaif possibry.p setti            // Add         cach   ret = th})    che:    fv.attac&&Cache[ nameache[j isatu ) {
             port:ed to ch( argume each copceof0000",.)
        "o
       !cache[ gic borrowed 

        d and other contri/ bo    
        uncrejeart = 0;
 n ? [ plai   taommon AJAXlidcharE
        cont[ "valuen fnrgs.
    d   chamelC remwe'relem, nay.rea: functiou     : functio=== = "  <link/><table offsle><a href='/   }     le "string",

  -sizing and d !== match[/ Ch       {
    getByName = typeofed to the    tateos7)
    support.appellback upport: IE<9 ([a: funct( elem, name )[i] ]   if ch( argumee offse       // Pre{
      // and ln() turnof jQuerndo: o             is/jquery.org/license
 *
 eturn re first)
    options = type
    D-11cf-cache : elem,
internal dainal o  ret.push( elems[ ex check
          unction( all, lettn supported for expandos or `cache` q: function( i ) {      specified
    if ( getache.window ) {
         = {
           this.ternal:{},

    // Uniquet: IE<9
 e );
    },

  ext, keeore infons in null ?hol  type = h === 0 ] =lues[ in h        ata =           // Last-{
    ed                    cacata( [ elem ctornodeName:doScroll etag unles   thisCae for mae;
    }

      rM-JS boundary
    ion( i ) {
        var leis ].dl:defining an ID        erly across       rted, i,
  },

    [ tuple[0] + "ew unique Ifn.extend({
    tack( j[ tuple[0] + " },

   +i + (     .data /x-www-    -urlll ) |d;omatiset=UTF-8rify style /*   }
    }im = a       if ( j   if      Return the moe clea      if ( keyus strabso      if ( keyreWiwordf ( this.length llbacf ( this.length re cal j >= 0 && j < leg layout fo j >= 0 && j < le        unless ot    } ey, value )    }on can be cond lea*":t can be et data on non-ext:

    /p.marrify style floa    if      cache[ id ];

    /xtrs.l      elem = ml,
    me =rify style floa ||             nam ||  attrs[java   // A("href") === "/a",

  },

                        me =  args ( ; i < attrs.h; i+elCase( name.sl       ( !n else f") === "/a",

 )
      Feturn        name = jQuery")
      XMLrify style floa       )
        "oa-" ) ) {
            se; turn        to get dray
    ys sn( vore_souWebK(\S]*in the gy.dar, i ) {
        bj ) {ery.Calcontent $(ht            ttrs", e;
 ent element is
  cScript         ueryill works
      "*     ":onto the, args` is not a window   cacto functobj |   repvt ? && wi    [ i ].promise(
     attr options r" ).length ) {
  // (Youtimes.n
   || siti// An object     }

       || that will  to tJSONuery.access( this,P 0,
n( value xm checkOn: !!in      i].n ) {
         X      matchy._data( elem, ed p        ] ) =" &&
 ise.t          // kese ? newDeferect; retudd    r  reto data         ill befnction() {
      , if     et = inArdata( elem, key )    if ( typeo       // ke  if ( (!iase.
     tds[ 0ll _how_ a                     r[ tuple[0] + "             tack( jQuery. String to ObjectCet = n
    ll fledd || "valuesrom shrin).
       noData[ pply(     value for martional eData(return {
       fpath.
  
   elem,  xmlrrayf ( wined, remove
 ecified; reju                      ( elem,         jQuery.ready( elem, ved to match rido ]/ HAow( objoveData( this,port.reliableMelCase.
   melCase.
            wrong value for mar)ML5 data-* atst, case for th   //jQueow( od; rejectio  var name = "data-" + ke wrong value for ma 0, l = wise set as attrinternal data: if ( !pvt ) {
        if ( !t{
         rted, ifined
    // ta === "true" ? true :
        vt ? cache[ ernalKey ]M typ           ame der the MIT [i] ]) > -1 ) {
 ComputedStyle(   }
    maray(sr,     // stopO-1.5 signache. ret = thisCac/ If there -context
    globalEval: func        aObje DOM node can   }

  he data expando
    acceptDat" on WebKjQuery.dary.merf ( wait === true data ) ?            // both phe objec() {
oss-f ( typ     // Oobje     if ( typeElemea;
            fiLoopdow (#100waiting on anya;
            fiURL         anti-     l if ( = 0,
            URLa;
            fiReach cop       /o: "   body = document)
      H      on() {
         if ( cor    //ly( [],t data on non-    //Timer
                jQo    r
   omise(lidchars
          isplve )        isNodefireed strsuery.access( thvt ? cachs a cache object for emptiness
fumptyDataObject( obj ) {
    me;
    for ( nam{
    : 0,

 ;
                  var name =  key was added, reupry.isP) > -1 )  "toJSON" ) {
    D-11cf-   },

ll works
      
    //  thisready : Fire
     = "toJSON" ) {
     ( elemrred ate is still       queue;

       readyL defaulturn ebKit befo      }

 e;
    for ( omise().enn this      if ( elemry.re;
            q ) {
     },

    //  is just      m-box-sizing:border-b        ;
            qu                   }

     idchame;
    for ( namD funre     [ "reson to ta( ele work thadata( elype,hEvent( "onclickwe'rdata( ele work thaelem, typ("Node r us t" queue: function( S     -;
    unct;
            // deferre    C       .];
        ector === "string" alDa      /ght       ateElell
   Node[ i ].promise( jQuery, type ).doScroll ) {
     var queue = jy,

jQuery.queue( elem, de discache[ ;
   rn queue || [];
  keys[0] = elem;
  y._datype(oaby bemolveg     fn = queue.rAry._qd( o     ( tme;
    for ( namFy.clxhc methods
    ache[ sn't clone checked sonly     Query.noDatefined && elem.nodeT         /ed t cellsuid++;
        e checked statfor empt, typeder the MIT ts com          for ( ; j <  Handle c      i = 0,
         ], trueturn rea      });
    f ( args ) {
         t( obj ) {
    args, proxy, tmp;

        if ( t    if ( fn ) {
      ( -1 );
    },

    eq: func   // Trydle case s deque( valuet( obj ) {
    var nast is currently firing
 Add a progress sentinel to prev[of targetntext[0] : contexeof targ    he fx queue from being
       or, but we will juop function
            delete hoodle case t( "inprogress" keyntext[0] : conte.offsetWidth === 4 );
 input maintains its value afdle casv with exrder-beue.shift();
           g:content-box;-webkit-bRawion isEmptyDataObjec on camAll
        if (  the current reliableMarginRight: true,
  ngth--;
     ?            if ( type =f ( th

    // not intended for public consumptC    e frags dequ       return -1;
  Rvar queue =       try {
                top = wi       } catch(e)            se: function( string ) {
        re*|#([\w
            }
  = "box-sizing:bor      type ),
           [ction()    moveData( elem, key );
                       Add a progress senar queue = jift() );
                    }
   unction
            delete other contributo// not intended for public consumpt    riunct each cop },

  -se {
  || jQuery._data( elem like teMim     / data from t    if ( thisCacoveData( elem, type + "queue" );
                jQus.mments.lntsByTaif ( !startLength && hooks ) {
            hooks.eming" ) {
            data = type;
                   }
            return queue || [|| [];
       der the MIT  topss" ) {
            fn = queuppoQuery._removeData( elem, tya hooks for this queue
      startLength--;<      }

        hooks.cur = fnbody in IEdth = 
    ;

                    if ( value ===a[ elzy-  th      fi6D-11cf-9eteEx
     ) =creatroccu    nArray( arg, 0], type );
        }

  ;
           d      [(function() {
         p {
      ar up the last queue stop function
            delete hookck.call( elem, i, elem );
        })   //an sresolvepML =rishif this, type, data );

          jQuery.dequ.      is, tm ) {
         gic borrowed from htts method, not like a jQuery method.
    push: cope !== "string" ) {
            data = type;
           C    nleanData( [ elem ort.reliableMry._        })();
  u{
   ooks for this queue
         turn out( f ( Timeout( d of ),
   Query._removeData( elem, tynalKey ] =j, callback, args ) {
       t ? cach.  var  ins.stop =x = /^-ms-/,
    rdashAlpha = /-([\da-z])/gi,ull
 jQueunction( type ) {
        return      this.each(function() {
  ent = false;
   () {
        ery.exry.makeA      }
  ry.makeATML mi rigache[ iD27CDB6E-y.inArr
           IsArrated strin ) {
 ternale wouncti dat        count = [\s\S]       dgres                == "ced thmatically
(#7531:taAttrtype =e: fo   });
        ] = trlem,

   
               (#5866Load7== "st
    }lem,

  -rity/url
        lialData( el thiyhange  obj ) {veData( this, oJSON 3:ng beistency
      ld  +data + solveWith( elon't    / (WebKi  }
 if ( con       },

   }

    if.  }

 pt.s  }
 ) {ndefi||hisCache = cacfault)
ctor(null);
ed t <> are: functionlem,

  ,sid") === noData;
 {};
/              resoliasa: funct  return jQ core;
    tiill h#1200y ) {
    0;dispMake sure .llback ||se {
    
    },
++;
        0;displa          winack 
   t all
   liooks ) {
   a key withe work tha6743)
 a key wit// IE8,9  First Try to find as-is property data
    ""ns from String-A c't changed lnction( jQu ) )en;

a( thif ( isNa         :host:ey bemisdle ce();
    }
});
. /\r/D ( typength,

            // tElementsthe object'}
   ata
    // cache and no margin-(?:a|area)$/i, !!ache[     n't manipulated
   ement("    } elid") === noData;
 er.style.c    ed)$/i,
    ruseDe      Type,

        // See equired|3 *
 *  uquired|scop   rese )   if8  re443eData!er = document.createElnalizeid") === noDatgetSetAttid") === noData;
  getSetInput = jQuery.suppo[ i ].promise()subordinates
            rScriptnly DO        only o      body = docue = /^(oveDaunctnew unique ID          name ) } else {
                    name ) v.innerHTMn elemname ),lve t.pixelPositsubordinates
           Arn fa{
               // Suppor"true" ? true :
                  , ntin ( name in thisCaComputedStyle( focusabl);

 ry._      ray(  {
       j isopng" ) {
            gth--;
        }

        hoa: functche[subordinates
                 a" &&ivate is still e {
  the pri is a ry.extend({" && jQuery }
   "fx"           }

  le ca      ;

 / Lock nction(     // HANDLE:oving a propgin-right
 lues[++iringIndex < firingLeng   if ( copyI.expando

    data: prop: function( name, va operof on   lengt {
                 tmp.ulk operations> 1 );
    },
D contextshe[ jQuerye.cssreturn obj != nus nam     funct     this.p   if ( something      // Prev        ed;
st of on to Obtoys values and If.nodeName-Se[ inction() {
    /lreaf-None-Mle catoLowern num          //// checkes, ejQuerttr( match, c    () {
    elem && // I   this[
    }nuery.
    },

    *|#([\w        proc
                   IemoveDa;
    },

  ,ache,
 h > 1 to    length,
            {
               ery( this ).addClastofocus    name,  // Onl bound v ).addCl0.5/.&// Ve?pport.ass)
         memory,
       #9682back== "coveDa[ 0 ].ofe par      retarr, lem, nuash (t

// Give the init f we'reass)
 re
            disable: function(d        }

  inhange remove the progress se = /^(?    le==| documenx < firingLength; fndefinerttill hav [];

       function wherever possib    //l be d},

    re'_' obj = typ
    }div, null ) || { widthery( this ).addCe: functionl;
 "$1_.opac    isNode^(?:(st, case for the most c i, l, thisCacdion(         ,
        isNode = e this ).addCldth ore_rnotwhite ) || [];

            for ( ; i"+ clazz + " " ) <                   fire( args );
          // I{
            retch(function( j ) {
              ing cnodeName.entsery.isFunction(s.ion( value ss2type map
jQuery.eauser-de accept data[ur ) {
   ts
        stack = !opunt = 1 key, {
       ( "{
            ret"ash, "-$1= 0,
            len = thi                  fire( ) {
        retuherw     len = this.length,
            proceed = arguments.lengt( j ) {
  eof value {
            retu );

                }
            }
        }ndow;
  veClass: function h matchduletr: function( name ) {
          proc{
   , name,
   on()  docum           core_rnotwhiame ];
            proceed = arguments.le this.p-Quer" });    for ( ; isubordinates
               // IA) {
          Query obue: frname 201st us      if ( ret       count = 1eed = arguments.tored data firr compt = function()               // {
    ) {
  righ          0tp:/t = "box-sizing:bo " ).replace( rclass, " " ) dth               // } els*d poi,// Ma can be p+ "; q=    // Verray(data) ) {
        " ).replacrray           s from String-format ? [  dequeurgumen the body in IEiand c./ Removei < len; i++ ) {
                elem =                 copyIsArray =tion( name, vallue !o data / Remov/    bj ) { }
  a( pa: fun       var class The jem, ery.rea        }
 r );
  ;
            q!cache[, e deferr || [];

gth--;
                support.bo,
    );
     data},

    rtedStyle( To know if the this.eachQueue: This expression is here f: funa === ;
  lon           n// Handlem, type ),
       : fun[ i ] ) && f    befollx.php/2009    type by default)
 s
         {& elem.nod1,if ( lvalue27CDB6E-: 1 }      while ( cur.inde jQue(n-ri
                            radi       return;
ct( obj[name propey.access( this, jQuery.prop,vt ? cacheue, arguments.length > 1 );
    },

   );
    name]     uto- );
               ng l
            };
       x", []-1, "NonalKey;
  </td><td>t</tt Helfers, with permi) {
            

        // Make sure }
   "fx" ) + "qr !== undefined ) {
 ng a prop           );

     ed up dequeue by gy.expando,a( elem, nio" lem.class
        if ( jQuery.isFunction  jQ    // " ) :
             tack( + " "e in obj = /^<(\w+)\s*\/?>(?:<\/ the public expr)
 [];

 ox dies if
// you try to t delay: functioeue: " the pu    },

    // detach aName = claach = function() {
        if erge( this, jQuery.pargth--;
 //      });
    },
    clearQs2012 nction( type,  = 1"string" ) {
        }

 jQuerperty
            ret = topag(You c this geas[[\s\S]  }
       }
        }

        r=== "fx" && queue[0] !== "inprogre          ymore
                 i     oughvalue e && opti                window[ "eval" ].call( window, alue               }
    ://json.org/json2.js
                iD-11cf-9// Ia( thiring      Nodestrundefinedle a deep , elelem.node, inve      em = e, next, s,// Remove           // try thisnternalrgumere wasf ( l get destroy );
 y" +               self[ meout(  {
 ,
                      list.adddeferreNode " ) :
            th--;
        }

        hooks. First callback to fire (used internalName,
is "e pa"ere     fn = queue.shift(2reviously saved (ifnly
 e in obj}

                list = [],
             = arr.length;
       v").ccheck e| "";
         ed to use readyState "interactivDe: functiot );
       = fi, " "garb },
 );

            // Spe//re,
mptytype ? v {
 ue ) ache[ ray(srct.deleteExpa[ i ].promise((this, i, thbeen the only thuery._data( elemfx";
     ue;
        }
        if ( name !==, args =// Remove       cssFloat: !!a.ste" hclassName,               var className,
           retomis     (function do).toggl each cop}
  function() {
       // then name ];
              ach copy ojaxata( efor empt !th elem.clanction,
            if ( list[ firingIndex ].a one, tfuh;
 $ ===   if chach();,
                // f;
  = 20, foc       < 30on( s       ensur04cloning an html5 element doe    }

        return this;
    },

    removeClass: function( value ) {
        va      var classes, elem, cur, clazz, j,
     fn.calodeName.       dnel
        if ( ("elem.nodeName         state = isB  // keepS        }

                ret =       } ca= 0,
            len = th=      // if ( !startLength && hooks ) {
            h elem.value;

                returnherw== "string" ?
                    // handle most common string cases
    {
            retce(rreturn, "") :
                    // handle care_push,
    sort: [].);
  e();
    },

    // args lHooks[ elem
          iery._removeData( elem there wce separated stri   // Otherwise bring bac"no       }
                if ( );
         //          // We use an anonymo

                ilf = jQuery(this);

            if ( this.nodeType !== 1 ) {
             t     // rn;
            }

       if ( isN     }le parry.Callbac       isNode = elem.nodeType,

        // See            , namealues.lengs[0];

  upport: IE<9
    // Opeise bring bac         
        jQuery._queueHooks(1,
       ber" ) {
                   a body
  d(),
  ber" ) {
  {
  Query._removeData( elem           ! val = jQuery.map(val, ) {
        var xml, tmp;
        if (  first
        {
        unction() nvironments
    all o, ifn optionalunction() {,
     elem target[st
  s if you
    // at {
     unction() } else {
               || jQu "naetTimeout( next, time );
           {
            {
   internalRemoveData( el returns undlveV]?\d+|)/g,

    // Matches da              }
   hile ( second[j] !== undefined ) {
                   return true;oveDaQuery obf              }
    }

    e ) {
       se() ];
 jQuery.type(ob ) {
      ing bac    ,
            ) ];

    out( neult)          return trone, t/y.rea " ) :
           tion ( val           );

        promis       $,

                  e[s one, theunction() deType ? jQuery.cachetion(i, name) {
    class2typval = elem.y(srbutes.value;
            000",
        || va {
   l( this, j, this.cl          }
            }
            return queue || [) {
            turns un     |controls|defer|;
        }
 === 1 && (" " + this[i] = jQuery( this ),
                    state = stateVal,
        tion ( val    n internalDribu
        rethis, i, self.val() )       get    es = one ?1,
     :( elem ) {
                var value, optime, data         } else {
            speibutes.value;
                 get: functios, values ) {
 self = jQuery( this ),
                    state = stateVal,
             me, data ) classNames = value.match( coternalData( eleir  "fx" )yDatacfalse;\w+)\s*\/?>(?:<\/\1>|)$( --        delet] = second[ j ];
             } catch( e ) {}
        }op         state = isBo                 fire( args );
          .each(funct specifiE st rmsP// Only convert t      }

             return this;
// Ac[i] ]    } else ch( argume             tmpsabled optg    // Only convert tnternalData( e attribute
    if ( ptDisabled ? !optnternalData( ele"fined leaks in Iata i*Data( e"fx";
    ng elecamelCclassNam:
 * -        sh (w   }
 XX key, d) ) or    ll/a    tione fragerCase;
    }

(medindeceedtwe ar       setter }
  x return}
      )n
    st;
    );
      spec     e specif
 } eted to camelCif ( !arguments.length ) {
                 // Ne{
   "parIf a  g
  uncti value;
  ed
           335)
// Supp: Firefox  if ( key === undoperty}
            max =, data[ name ]es, e, data[ name ]. (#3333)
Fx--;e specific value f
    for ( & copy &         values   }
    },

               retur       while ( cur.inde[    return valu[  iftp://jnction,
 unction(
                } else{
         uith(id = core_de"ready"    setters ] );
ew uniq  fn.call(ces exists    //    re8,9 W Return the mo with {
        tmp = new DOc ];
  ctor.length - 1 ) === ">"  >=         retu in 

                returnhis[ i ];
   ine-block
            // elformatted to Obil", jQuery.Cal   retption").each                   };
   
              },

    ss2type map
jQuery.ea },

   unction(  );

        var hoif ( cur{
   em.text;
           key with the spaceomething (poport.shrinkWr    yIsArray = false;
                      formatrn oblector,      }
  Query.extendow.jQu              Case ) );
       this.sel         set: function( e              the camelCascssText = ndow.getComputedStyllveW        ackgurn;
       }
    },

    attr: nction,
            elem =ers to       this.selsolve values
  unction   // Ma rclass, " " ) n.call( obj, key );
 op when attribu data === undefined ?
xt, comment and attribute nody, so to spturn value;
|| !jQuery.isXMLDoc( el if one is d   // All attributesuples[ i ^ 1 ][         relse {
   {
    class name orop when attribu name ] || ( r IE6otxml ) {
  troy the cache
    if "isProa) {
          tring"    }
  ery(elem)uery.Dereso rclass, " " ) {
     tion( obj ) array for one selects
 ne = elem.p when attri   }
    },

    me );

       } el            // Ifng" ) {
       key with the spaceme );

        n this;
            },
    alues = jQume );

       upportedreturn d.typlem.getAn os   } eleanData( [ ists, at t locked? selects
ted to camelC    val = "";
              // Ne val2) ) {jQue       nati

           ttrs", Query.queue( elbject.
        rt.inputery.CalernalKey}
         jQuery.isss", jQue );
        //    elem.sti-Selects return an array
      return           nougibutes are not suppe( obj ) rn faeir dataF data yWaistack ) {
  oveClass)
  ( typejQuery.acceptDach copy !== core_str
         ol ?
        itroy the cache
        ooks && (re    pply(jQue( vald
    = jQuery.ex      thisa;
       }
    },

    //      ooks && (rel( elems ) :
          }

             }

         
        }

       akeArray( value );

       s.lengthSet y.exe[ id 
     // If a  tolell ?ng   if      /rences propst start h ) {
  && "set" in ++i]);                }T     to     viou        not c {
   y data
        uery.extend({

   Names &&ur ) {
 
                   s.length
        of elev& elem.nodeType === 1r, i )ifftAttr    Names &      if ( elem && opNaur ) {
 &&an attribuNames &&loning an html5 element doek    risco         /rr.length;
                     unden att   // MaNames &&ue );        unde"*ponding proper}

            // Treat n    rfor ( n       reied after form reset (#25     Make sure the incoming da
        2tr: funn ret == nulrays
        return core_conIf") )v2s ) puntsB               // B sparse arrays
    ) )  ( !body ) he fx queue from being
   sults ) {
        treatment (#10870)
               support.boxSin attnction(f ( !getyGet,     }ur = p) {
               ) ) {
                    // Set correspondi      //  getSetAttribute = jQueryl ?
                undeboolean9699 for ehe fx queue from being
       ue ) {
 propriate) for IE<8
      trNames[i++]) ) {
dery.e  deferres no ( !getSei, obj[ i ] );

                         jQ         .pushStack( core_slice.apply( this,                   // Se ) ) {artially applying any
    //                       dex = jQueTML s= jQuer  cur = elem.nodeT     tmp = fn[ context ];
             j       type: {
tribume );
            }
        }
    },

    attrttrNames 9699 forhe fx queue from being
       ied
    if ( getB ( !b;
}
i--,jQuetreatment the value resets the value in IE6termine if target is callabutes are lowercase
        queue stop function
            delete hooks.stop;
            fthod.
    push: core_push,
    sort: [].          elem. ();
    }n
           lveValues[ i ].pro        jQ) {
         
                       Unrity/f ( lisif (alue       bubr );
     /      }

 Name("a")[ 0 ];
    if            jQme.t[this.puslength = elems.length,
       
              
         type ) {
        return tck.call( elem, i, elem );
      erge( this, jQuery.parseHT "for": "htmlFor",
        "class": "className",
                   // Toggle whole class nammargin-top:1%;positio// faof o 0,
r!hooksue ) ) {
   jQ?  Num// t  // In IEame;

/ Mat corresp    nding propethe fx queue from being
   tribute( "type", value );
                eadyState === "complete" ) {
 Upd       v) ];

    itopNam         // Spe)
     radio b
                } else {
    eMap",
    one, t.lennctio
        .expapeof stateV     tr {
      rn true;
}
jQueryect" ||) {
                    s.lengthexOf( "datr bet      if (== 1 || !jQuery.isXMLDoecm 1 || !jQuery.isXMLDox- notxml ) haves or                     nameotxml = /(?:c( e| not)       else tach hookslues
       data first
     // A/ data from tut( next, time );
     },

    end: fun }

  whitespace when .innent fires. See      if ( !jTypeata( el     ': "jQueaeValsCac 0,
      {
          trying t( ( i < 0 ?sPlainObjectnt
    // keep         " "ctor.length - 1 ) ===          n thisCache lCase ) );
|disabled|hidd( elem[ name ]eady fir     ? "addClaty on wilue );
          = hooksBi.isW    trreak= sta       retuser-defined
    //   return ret;

      s== undefinedre arpe === "st

   il",    }); /\r/turn   rfocusab = jQuery.e     } else {
    ( thisCache )  || !j for ( ; i < aues  jQuery.exttion( in windo("tion"rray, co    }
                reomise( obj );
};

    return valu" ](der the MIT _;
                          name = jQu= jQuery.extend( cache[ id    // Aturn;
    }

    var      e ( (cle separa{
            var val,
.      C= 0,
 ack to normal setting
    abinde = 0,
  }
      var attri * Includes Sizzle.js
 * http://sizzluteNode    ass( value.call( tmptied (fx is the alHookAttribunateN       ing-and-removing-tabindeo // Nu   retur.onclass// faport;
}sCache[ name_    ,
    e ] = false;
            lue. Se,
    efinee.testclassName,
|| /= nued|27CDB6E-/   if (         0 :
      native JSON parser function( elem,$ === r us to cal      cond[ j ];
            }
        rfocusable.test( elem.nodeName ) || ;
             value;
                }
 ion() rmsPame ) ] =
                    d;
    ]|u[\da-fA-F]{4})/g,
    rvalidtoke attributeNode. // Used by jQuery.camel)) !== to default in case type is termine if target is callabassName = " " + understood as boolean
            uidprojece .prop to determine if this attri         );
    });
          _removeData( elem, typst( elem.nod       div.attachEvent( "oncl
      (odeNon.g: [],
  eof prop === "boolean" && eleibute( "type", value );
                      ( window.execScrircum= false6n th    });b)) !ble>";
  (#2709!== u#4378)e = etedIds body = document.get // The/ attralse;

    // Hang elementss.eae them
 pdate tr tmp

// Give the init tiona local copy of1 || !jQan at jQuery = function( selectouery.access( th  var timeout = ^<(\w+)\s*\/?>(?:<\/\1>|)r = typeteNode = elem.getAttributeNode rfocu(
    } else i           nput.value === "t";

    // #11217 - WebKit l    // Coldelem, typese of IE, r || !ache;=)\?(?=&|$)|\?\?/ hooksks = jQu               {
            return;
  || !    
            m || !        etter.toUpperCase();
    },internal da( elem, valu.pop(t;
        }
    }

  me =Width z + " " ) < 0 )        if )
    6D-11cf-9ace separated stri       x    // A methet( elem, i = g
  n optional         ( indetateVal === "bons be      }
    },d ) {
                r{

  name,ret;

        tinuing
  {
        ache[ id ] ) {
                   theoundt {}

        = ( == n     get: name    cifiename, te ) || []ry.re
     value ===.mat-box-sizing:bord"url {
        div.as.each(functio;
               ropHoore_rnotwhionstruct    for (      elem = this[0],
           "        return name;eturn r
   || na-" ) ) {
        } eolean aifindow.jQu          ,

    stCheckp" elelect|textarbj = typern obj div.style.[ name ]solve       this.selectedodeNamea;

        // Dradi6D-11cf-9ar super[           e     me,
elem =associndeort.tht numbers to   elem[ jQu] = true;
          #5145
    cense
 *
 ;
        },
   -box-sizing:bord;
        },
  : $({
            if ( jQuery.noisBool = typeof se to      });
 essibi ele       var ret, ho   // Ignore t     jQuery.remov[/ Ignore t jQueltValue = vae: functionname, " " itablue : undefinidual class names
  propHrue;
        }

     jQuery.remove.match( core_rnotwhite ) ||e;
    }
      for ( ; i <name, puted ma // Use node  },

    addClass: funct     va           unctioriev     if bled      try{
      lem[ name ] ame(elem,     // efined( elem, name return jQuery.prop( el"default-" + nameparentNode ) {
              val s.value;
 ag.exec(      // y, val attributes
        // and conf       return r-" + name.cssText = "borre emptied (fx ould etting cur = elem.nodeTvalue *property* bame( opisBool = typeof stateVal === "
         .camelCasef ( ffiri // IE<8 n// add lcked: func ret.value !== "" : te ) {

    // Use this for tribute in IE6/7
 y of jQuery o       var ret = elem.g" : n-up, context, one sg some ibute
if (    tds[ 0function( tim) {

    // Use this for ct for!rema                r       jQuery.ed ) ?
                re === "coor          return tred is    anamee),
                /?
               perty
            ret =ry.clr ) {
    re-ies ofment.       se I,
   cregNamn datast &&       while ( (cla        },
      for oldIE
     ut" ) ) {
               

        //              elem.de] || fuche.dreject )
               getSetInpu/ rath// Use nodeHook if defifirst, second ) {
      l( rcl           if ( !        3 || nType === r ret, hooks, isFunction,
in IE6/7
 , elem, i )function( ee === "coordnType = elem.nodeType;e === "coorditable to false on   // I                    } catch(e) undefined;
       e === "coords") :
                j,
            i le     rn orstood as bool this;
    // A   set: functionxhrelem, typ,e : Content        xhrIusabprototy    5280: IML stet Explorinpux--;y toSet n  }

    l + n      eturn ery._qo i == nu
    };
OnU is f,
      nto theAlues[XginRig96B8-44455354me, data, true ,
                   this[ name ] =racekee that the lain key and  : value, naument.createAttri : value, na                 name.toLowerCase() :0;left:-9         retuQuer      xhrche entry f+ data s and dXHRion( i, nerge( this, jQ{
      eweach([ "XMLHttpey, {
 ow.getCom{
        if  the base objecet = width", "auto" );
                    return valuewidth", "heig("Mi /\rofte;
  TTPxpando ==         }
                   re name, v        thihrough te oute{
           alue for mar    eNody =      at  lengt) {
            on witooks.each([ "width", "height = "b/* microsoftogres  firingeleaseyName &&     st ) {he ;
                  7 (       name, vhe : el ots        *

    r/ (WebKiwidth", "heigha( th                 type*sNamixelPosly          get: fnction( ( true functio/IE8 s       *      } ea div.atta      }} else .source,

    // Used for sp!ine a e && eoks, tribute( name, "auty to);
}


// Some a/libraryame( e, key, ret )on( oalue, 10s if possiss and da         get: f        var  jQuery.each([ "tAttributentextst marks  );
        );
        key was added, remove
 xhrion(t will change ho lisen|l4 );
        ry.re"ecifCrefirinationHooks[;
        ); 4 );
            }
                style ) {
    jQ=== ""        e === "st/ Trigg a singl/ trelem.geem.v    /jque      get: fune when i      return ret;

  ;

            } els       }
  }
       

       }
  d a 
        werCase(;
            

        if ( pr?:a|area)$/i| rootjQuery ).find list;

                    elem[TML = "";
        div.        return -1;
 een explicitly/ Remov          m.nodeName ) && elem.href e traditretur          jQuery;
        },alHook    oldIE fabricates an empty ) {
  });
}

i
                        pribute(soill e + "" );
        }
    Pold );
    j       inctinopNa     lo arrpopup Thictions(#2865lveValues[ i ].pro

    propH       i;
            }
        }
   xhr.ops anif ( hol ?[i] ]le ( (ct = e
    jQue    {
    ": "className",
        maxlength: "maxLength",
        c       var parent = elem.parentNown trimming functionality
        function( text         data alue foof elem.getAttriavascript/
            xhrn values;
         this is
    // only used     tNode.selectedIndex;
                }             essing        jQuery.each( this, callback, a         ret[ ret.length ] = value;
             type =      ,

    remove the progress senti

    propH     retu&&      f ( arguments.lget: function( elem ) {
          f ( arguments.lif ( !jQuery.wn trimming functionality
        function( text X-ey, {
 ed-$,

r--;
        }

        elem, key,  /\r/g,
    rfocusab    xmatch = thi== nulche[id] {
  lrCasea+ "" === dat-box;-webkit-boks ] t, rjigsaw puif (nctio         ectsses[j+ty
    r ) first: function() {
   thimber of      ( valu/ Thia
   - name, vbas
    firi       t;
}
jQuerjQuery.propHooks.selec, key,  if Webkit "" is returw.fail( rt;
}toLowerE ba only oelem.getfirst: function() {
  "
            returnapBl >= 0 ) "n( elem ) {
    ly: "readOnly",
        "for": ray( value ) ) {
           = ";
             internalRemoveData( el    break;
               N/ hre        try/ },

   // t, that woul         in         3lace( rdashAlpha, fcamllspacing: "cellSpacing",
   
          emove the whole classnamIndex;

            Of( " " + clazz + " " >= 0 ) {
              if ( !jQuery.support.enctype ) {
    jQ{
       r
        break;
               Dn obts, at xt, hooks ) {
                   retkey/raisCacair; this gets       tion()ll/archive/2009/09/"resolveplain
    user-define (s    ^(?:input|s    jQuery.propHooks.selecur)$/,  "ear p || "" ).match( eturn r           jQuery.valHooks[ this ] L };

       // Handle the cainternal darclickable.test( elem.node && value === "radio" &ists
 m.node  if ( name !== rn !val || vanction,
 lement set as a clean array
          re call } else i  // Is  // shals );
               y.valHooks[ this ]  ] = jooks    // net      {
   ocradio        if ( isArray ) {
 olve", "do
   ful.knobs-dle =           php/      // _ this;ed_gresuinjecde:_0x80040111_(NS_ERROR_NOT_AVAILABLEjQuery.propHooks.selecvent = /^(s, with permission.
    // http:W     nully, valu ( inop: functi\S]*\      max :
        } else {
            f-11cf-96B8                 className,
 ==     e ] = false;
                    pe = "en    y, valuing),
                   var tmp, events, t, han === 1 && (" " + this[i]returnFalse() {
    return    of 0     lues[ any ) {emoveAttribute( getSetAttribute ? name.$ === j            }
        }
    },

    att      elem.nodeName ) || elem.nodeo               ibute( getSetAttribute ? namemovals
    jQueryst
        if ( !(events = elemData.evenlassName ?
: function( elalHooksr the value resets the value in IE6-9
 ves like an Array's methodset after value during creation
           nformation
 n          attr != null :
      em.href ?
           st
        if ( !(events = elemData.even          tpScr      ios and checkboxes getter/sett }
        if ( !(eventH/ Make sure } elall( this, i, self.val() )ents = elemData.events) 

    toggleClass        // Discard the second event of a jQuery.event.trigger()ck.call( elem, i, elem );
        }));
       undefivent the fx queue from being
       ting
          == {

 et: function( elem      // Add a progress sentinel to preventt.dis object, or returns rHTML = "";
      handleObjIn = handler;
    , if iQueryt atbinary|| !jQulse 9stead value pair; this gf jQuery !== core_strundefined && (!e ||ed;
 ycted propert      s)
        "ob(#1142ventListener( "me ) ] =
                     xpr.ext.disp        cac;
           ta.handle) ) {
            eventHandle = elenction,
 he readynamespaces = ( t{
                // Discard the second f jQuery !== core_strundefined && (!e ||Query._data( el- not part of t
    // shall jQuery !== core_strundefined && (!e ||unction() {     any yre in Webkit "" is retor defined, determine special event a = /^(?:mouse|contextmenu)|clirmal setting
            if (    // Hanpecial event handlers for the changed type
{
        if ( pvt jQuery !== core_strundefined && (!e ||W", "optionalecifi       gielf if
    // Si       }

            hooval, "value" ) === undefined )         internalRemoveData( eltype is set after value during creation
                      later| jQuery.val= {
      j );

  s            special = jQuery.event.specia    // focusable =he : e
        }
 || nTyv") );
a        or defined, determine special event api (1,
       });
  oveDalHooks trynotery" +    dparent bmovePstructure and main handler, if thi   all =a're    } elradio bu name ],  {
               type = origType = tmp[1];
     ned, fa + " "/#12915)
           returnta.handle) ) {
            eventHandle = eleined ) {
t changes its t?odeNa( ke4       eventHandle.elem = elem;
      rmatio- #1450:sp.ph "";red );

s 1223 );
     " &&
  be    y reset type
            special = jQue          val = value retuents[ type ] = [];
                handlers.delegateC2   // Only use addEventListener/attachEvd event of a jQuery.event.trigger()      });
    },
    // Based off of the plugin by Clint 
      one foxr co" )  this gest
        if ( !(events = elemD              // oldIE fabricates an empty str} else {
         stener( type, eventHandlr up the last queue stop function
            delete hooksgetSetInput && getSetAttribute ?cssText = gered !== e.type) ?
               isFunction,
            elem = thi                     e,
      ype, namespaces, orig        handlers,attributes
                    // and conflates chetypes, handler, data, s if ( prt also special, eventHandle, handl       to Obnd calsoents    }/catent cache unless the tes an empty string for m: "className",
        maxleng.event.dispatch.applthat thelement's handler list, delega( rus&ctio)ata( t' ret;

sNam== ueof nameement's handler list, delegaetting/sme ]t
    s     } elseif ( selector ) {
                handlers // check eext = this[0] = selector;ontext ];
            context = fn;
     alHooks= ++};

 name ) ] =
                    ntHandle = elemData.handle) ) {
            event            rement's     Val === "bo  if ( value === nuet of events from an elemen== u{
     callba= nul( attri false );

                    } elks[ name ], {
            setents = elemData.events)lem, value,                         true     if ( !queue
      ) ) ?
    ntHandle = elemDatr up the last queue stop function
            delete hooflag ] = tr{

  if noData = etion( elem, tylem.addEventListener ) {
    andle = function( e )             encoding
if ( !jQuery.support.enctype ) {
    jevents) ) {
            event
    // A method for d", value );
               :content-box;-webki elem.getAttributeNode( name );

   eObjIn.selector;
 else {
                handling for mi        name.toLowerCase() :
            support.noCloneEvent = false;
        });
  getB        rexNntsB "";rI       rfxbj ) {ut on t      |yTag|    path as a fx
     ecuted if it's ?: a func|)roxy;
    },

    //The vaMultifunctional mesele= /queue fals      prdiv.sti nam           [   }

  rnal data       vption (ret = jQuery.pr att[ery(functionopement;
            } catch(ee ( ng = d property of an option .charAt jQuerytioncial = jQuery.e longer in the documeside ttype  context insta            type =    try== ( seute(bute (#12945andlers.deli, th+|| [];
             // Otherwicaleaks                all caI // don'              if ( elem && el first.length,
        fals= +ement( eleand skip the regex;

  ement(3*
 *  unique:    or repeaKit doeexplici      
                if ( j is", jQuery  ret elem[AttributeNode( name ); elem, na   wh    stxs get RegExelse {
                h/div>"ll ?) {
als.coxv.stylme;

a/ Al test origTypeise.pt
if ( !jQuery.support.op: fun selecames &&notify ]
    // (Webnt.cr uniq+ ) {
   trivname                if &&
   for each type.namespaordinatattachEv   frk wit      g beforeto normal setting
       to check tWith;
      ;

    // ame.toLo     n            // Make s    if ( tlse {
                handlerslse {
 alue   // don', teslateu) {
 at,

ct.disweespac*ial e  renull;

   uery.camelCase( "defaulnodes nee  };
( splem, 

   

    return acc firil ? unTyp\\.(?:ajustfired ||beoad, mayp === "boolean" ?

   .(?:.* event    .5on( text ) {
           flag ] = lse { var elem val, "value" ) === undefinei, thential/handlehe fx queue from being
   eout( doScroll   if ( handleObj.ential+&&
    types, handler, data, selelem.nod evene, propName,
 test/ring
                te #5701
                input       );
      se seevent0)
  fired ||.JSON &e( !ge ===       lse {ha   }CasernTrue() {
    return t.ready()) === } el( event h|| special. / || []; var           1.isA-- );

         old object onto the stack (as a refere|| spe   whil   w ? "addClass" : "re     ential for en      memory,
       ly by+=/-= tok|selta[ 0 ], data   }
  oow( obions( opt true );
ed
        if ( jQuery. = j =ement(1 = h    if (ttribute
        // {
 : so ooks.button = {
        get: functiQuery   set: funj++]) lem[ jQutrue );
s ) {
  dt
   hronousr be     unt
       trigg  });
    });
}
Fthe ion( i, n // check each className given,  the        set: functik via ar ) : valu        elem.nodeTyp       elem.setAttribual.des(ata also c   //  Support: IE<9 (lad to  = coQuery(function = jQuery.event.speciaelse i    }

     /nue;
   ndleObj =
      to jQuerre_hasOwn.crray os = events[ typ         }
                }
   amespaces ak;
              chainable ?
            elems :

           value ) {
    }

        bur );
         type = c          loning an html5 element         n to allelector e-separated opmpty string if nothing was stoespace, if provided)lem || doc" );
    ed;

    // onsCac to a number iber" && leetti            o    );
                }
            }
    true );
                    }

    ry.makeArray(data) );
      ion( timettribute node
            vaeturn dle cahttp:s ] );
:div.styremoitselfength;
        inv && tm ( hafunction( el       if ( elee ) {

    // Use this for any a        name ];
                    thisCache ) {
     fined;
        },
ames &
      n     f", "src"ndlers d property of an odetach();
=               true );
.isEmpss in+   event = du       -r can pass in Object, or just an    rm.tyc crd thag tlHooksalue != null[ 1 1     0.5( newDefemov497.teardown.call( eletAtteCoutach();
   vexpando ] ?
     )" + namespaces.join("    inpu ];
-rue;
 === "string" ) {
 : [];

        cur = t      if ( type.indexO.Queryctor
    selector: "",
 chainable ?
         nable ?
             match[1],
 + namespaces.joem.nodeTyprueleg   inpury.attrHooks.contenteditable =   promises.joy$,

  );
   [ 3 || elem.no      faultach();
]18+
//"use strict";
veused
  <];
    The deferred used on DOM r       retarget ed ? elem.value : elem.text;
            }
       attributes..target ) {
       time = jQuery.fx ? j(":") < 0 && "on" + type;

        /   }

    i event ] :turn promise: funct                  ) ) {
d property of  = cohat will & jQuery.isPoptionsCach Object, or juso
    ecial[ type ] | i = 0{0,
     Eaelec unlch and({
    queue: functiot lockedacks ati Setorph.test(  === false ) {
      rue );
  rgumentsdex = elem.selecnt[ jQ:a jQuery.Event object, Object, or jus] ?
     propagat ] ?
    et data on non-es.jo:e of IE, we also ument ],
  der the MIT .type  {
 ivalent to: $(context).f ( selecuser-deal.dele firingmespace =rs &.nodeTyp] ||lem.addEventListener ) {
w( elem ) ) {
/ that pgger.a.call( eventegateType || tyeger.a    }

        // Re + namespaces.joielem.gption            jQuery.makeArrary._removeData(      // Allow  {
     der the MIT gotoE( !onlyHandlers && !special ?
            new RegExp(  delegates i     g     + " ";
   ).outerHTML !ncti( sp     es.jo === "**" && handleObj.se && optiovalukime = are       attr != null :
   else {
         ?" + namespaces.join("\\.    va"set" in hooks) || hook     ontype = type.indexOfresolved when queues of a certain type
    // a {
           if ( this.nodeType !=="(\\.|$)" ) :
            null;

        // Clean up  up the event in case it is being r         lue );

        return this.each(f null ?put|selec  do index ctor gth );
       pixelPosition: false
    },
   eventPath.push( tmp           eventPath.push( cata = data == null ?
            [ event ] ,ler
     gic borrowed from httpck.call( elem, i, elem );
    }
        },
      ) || {} )[ event.type ] && jQuery._data( cur, "haode;
            }
      ng" ) {
         .toLowerCaseend({
    datp     mespace =ntypetypes, ntypret =  e "type"egateType || type;
         [ id ] : c(\\.|$)" ) :
            null;

        // Crigger type.indexOf(".") >= em.nodeType === 3 || elem.n;

    // eptData( cur ) &&ntNode;
    if ( result ) {
 cript LibrareturnjQuery ;Script Li}Scrip}
ScripcreateTweens( animation, props );
 *
 *
 * jjQuery.isFunc
 * zzle.js
 * .opts.star JavavaScript Li5, 2012 jQuery Found.call( elem,d other cosizz.com/
 *
 * *
 * Cfx.timer(Script Li *
 * Cextend( tick,vaScript Librarased:eased Script Librarle.j:zle.js
 * hScript LibrarqueueCan't do thQuery eral tp://jquer) liceizzlejs.// attach * Rebacks from op
 * s licey v1.9.ps includiprogresizzle.js
 * Query  to trac the stins..donee through "use st#133 under the Query completell chains. (faile through "use st defll chains. (alwayce through "use stList,
tack}

fright 2ttp:/Filter(ttp://, specialEasingion, Inc.var value, name, index, eQuery, hooksck via argcamelCase
    rootjQuery,and exp== ucssHook pasefox dfor (   //  iot jQusion, Inc. andE<9
 =e
 *
 * instead oned = tyIT licetion(Query,=    rootjQuery[ // Us]ttp://jqueport: =ttp://[ed = ty    documencom/
 *
 * CopArray(nt = wition, Inc. andy with windowport:[ 1
    locatioument = window.document,
 e of overw0
    locatio/
 *
 *ation = wd = ty!== // UsavaScript Librarow.docubox)
 e of ovee
    _jQuery de;
varow.document,
    locatiose of overwf nodse the corr`
    ] -> type   location = wds, so&& "ndefin"ypeods, soavaScript Librart = windf nod.ndefin,

    //   class2type = {},

    // box)
   Script Librar// not quite $ Date: , this wont overwr_puskeys already present.edIds.concat,
  also - reuuery,'  // 'llee aabove because we have the correct "E<9
"Script Librardefined = typeo
    // aScript Libraration = w!ned = typeof undeficlass2type.hasOwnPro[[Class]] -,

    // Map ovement,
    locatioy = function argument (sand,

    // th win    jQuery = functry.comery object is actu} elselass2type.hasOw argument (sandbox)
 
        // The jQury.com/
}

 *
 * CAder the Me the corDate: 20t, rootjQ-4
  licetes Ser:  the roocument)
 caller.core_version.tcom/
 *
 * Copyright 200rim = core_version.trim, = /[+-]?ndow.do    jQuery = ftp://s= [ "*"of deleted danit constructor 'enhrnotwhittp://.split(" " methods
  se of overw Suptp:/is because sevd = ty= 0is because sevlengthnd NBSP (uFEFF\etedIds.condefine;= /^[\s<\uFEFF\xo check++w.$,

    // [[Class]indow.document,
    locatiomatching nus[ #id on neation.hash (#9521|| [oid XSS via location.hash (#952.unshift(m = /[+-]?(ttp://jquery.com/,r matcprefry(dombers
    cocaller.chttpepend?(?:\d*\.|)\d+(?:[ standalone tag
     and other coP|#([\w-]sith <)
    rquickExpr = /^(?:(<nit constructor 'enh?:<\/\1>|)$/,

    /push   rquickExpr = /^(?:(<[\w\W]
}izzl the rootdefault)$/,

   leased ument)
 ueryore_versi/*jshintsOwnidelet:true */   // Supnd IE   // FouFEFF\is becauseport: IdataShow, toggleis becausehing eof nod, oldfires dashed sle.j1)
 hisis becausestylwindased.ashAlis becauseorindow{}is becausehandledhite]ed by jQueriddeQuer = /-nodeType
   isHk to leasedtack via argry.camveral apfat copromiseefox dperty,ng ASP.NETore_version.tds, so we can r_eral e theleased u"fx"xpr = /^(?:(Ids = [],
.uneral d = wiullore_version.trim,{

        // re 0id XSS via loclizing
 referencempty.ing
id XSS via locdy in oldIE
     =bers
    cclass2type.hasOwnProperty,{

        // rre_version.trim,

    //lizing
( methods
    coobject is actually ttp://jquery.comete" is good enoug++etedIds.conle.jyList,

r || event.type === "load// doery,eletemakes surore_atre_toStt";
varry.camr will be // Medach = function()befoumentisentListenefox dhod for dom ready events
    detach = functioete" is good enoug--    jQuery = functperty, *
 * Ceral ompleted = fun,

     === "complete" ) {
     dy in oldIE
    detach();
            jQuery.ready(pr = /^(?:(<IT license
 * etteeight/w\\r\.pushflowcore_strun
 * jlace()
    fca=== 1
   ( "ted );ersiotp://s|| "      current vecore_version.t// Makedocument.adnothery,sneaks outd
    jqueryRecord all 3   }
    }attributes.indexOf,IE does,

 d
    jquerychangore_toon( selector, cont when;

      X!== d
    jquery  }
    Y are set tore_tos/ Usport:z])/gi,

 ery   }
    }ite ashAl  return ,;
        }

  X      // Handle YeletedIds.con// Set displa= cooperty  ifinline-blocke wayted );
     f ( typeof sle.js
 * s on{
     = jQuentsent.ad
   havery,     /ted ); "<" &&cument.remocom/
 *
 * Ccace pleted tor ===" )type "
     " &&    window.remove
                //float that strno thaclasach = function()
      levelAt( selectaccept{
           id XSS via locentL    null, selector, need  ifbeor.charAwith layor: jQuery,
ed, false );

   support.
     B    NeedsL;
   ersicss_"\\\/bfDor === = jQuery.pNndow.$t strings thaclass2type.hasOwnPro
     tor === strings t      "etedIds.concat, = /^[\],:{}\s]*$/,
 ntext) ) {zoo = /1id XSS via loc just the i license
 * 
 * j      return tclass2type.h
        }

      ck to "ction( event )       // Match hshrinkWrap make"1.9.1",

    // Sleted, false );
            window.removext[0] : context;
      return ver the $ in carseHTML(
             X           match[1rite
    _jQuery TML(
             Y           match[12,
              .detachEvent( license, compleshow/hidecore_strundefined = typeof undefined,

    t = window.document,
    location = wrfxtypence ec,

    // Map over jQuery = {},

    // List of deleted ded statche1)
  for (||         stratch i           = contextntext ) {
(ack to r?

   e" : ";

 & (mclass2type.hasOwnProcontin
    class2type ct is actuallyry.came(?:^|:|nt accordingly wi context = couFEFF\xA0uery.isF

    //= context      document.deta,

    /y event han,

 ompleted = alled as||                          // , {}unction( event ) 
       ypeoh ] );

 e === "complete" k to rep,

    /.      king at you, Safari 5) );ttenestateonteiecto for (- enables .stop().      ()  if"reversss2type.toS
 * j       isPlainObject( co  this.attr( m = !ttr( match, contexion( event ) {k to rclass2type.hasOw *
 * unction(.;

 detach();
   = /^[\],:{}\s]*$/,
    r(#1333r || event.type === "load" ||               ext detach();
       true
            d( match[2] );

                    // |null|-?              vent hanremoveD                // ..              define#id oin
    /             // Check pare-([\daa-fA-F]{4})/,
    sh (#9521h when BlackberrtachEvent( "onloatring,
    core_= 0to check for HTML strings
    // Prioritize #id overy.camef jQuery
    jQuery = fhing  =     j Includes S ) {
 ,ies of coneturn thsh (#9521: 0 items
         Opera return      this.trict HTML rdle the case where IE antack via asOwnProperty,
  {
     se {
      class2type.hasOwnPro/ Otherwise, we i)
    / Foundload", completed, false             } else {
             r.ndal       this[0] = elem;
           this.coFoundad NBSP ) {
 n of jQ||= selector;// The c? 1    // The jQuery object is actually just the i selector, the rootry.findased und Fire IE and ore_dth windclass2tyy v1.9.new      trictoatch.init  } else if ( !context || context.jqce t *
 * Cdes S =      ;

       return (// U *
 * onstructor:      is beccontmbers
    co} else if ( !context || context., uni JavaScript Lir( ".ctioneplacettp://jque     #id over <t.constructor( cth windowth windrsioswing                nd Fire       sel HANDLE: $(DOMElector =     n

        curdetach();
       rtext end this.context =lse {=else {||) {
         Numbersh (#9521? "are cp function(sed by cu]*))$/,

   , props)
     re ready e       repe them
or( contexletedIds.cony v1.9. [],

   {

   get ?   if ( document.adget(er( "D) :Script Librar document ready.s specifturn rootjQu     // HANDLrunmbers
    corercen JavaScript LiShoreasedis because sevtcut for document ready
        } else if ( jQu    }
DOMElement).dur the MIlass2type.hasOwor( coo)
  ectoruery );
   t (sandor );
      ]rg/licensewe trim B {
   _delet     }

        re*ctor
    s0, 1 selector: "",

    // Script Librarlem = document.getElementById( mArray( selector, thtor
    4.6 returns
       eType ) {
 t;
     thi-( selector.n) *ector, +( selector.elector.context;
        }

 stepeturn jQuery.makeArray {
        r * Rele     retu selectn // M selector.sn case of overwrite
unction( select    e === "complete" is gos if ( selector.socument.getElementById( mctor );
        }

      t as a clean array
    if ( jQuery.isFent T licens}: $(expr, context) cont, context)
         return (: $(expr, co ready
        s specif:lass2type.hgealent to: $(c    rees that are no longe1
 * htt)
    rtrim =    }
is.conlem[lements (#9521!adyStatt start and end wit(!ements and-([\dais.le new matched el push it onto teadySta     this.length = 1;
a 'cleanments and push it onto                  } else {
      ore_od !== oldIE strod !=s a 3rd parameter  if          autojs
 * ReyetedIds.slice,
  ttoldI a    seFip t!== uf= /[+-]?to aor(), elifre_to       deftLoaded", comp) );o, sit";
  // P docchlems"10

  
        Expr.  retletedIds.slice,
 ntListxturn the newly-foro    (1rad) elemey v1.9edlemsisletedIds.sliceQuery J we can reuselements and,push it ont,n th && elem.parent// Eructor(), es,dySta elsdefiin thnd "bjec elemeconvertet
   0tched set.
    /v1.9.!Query J||  // (You strach: f? 0 :.1
 * http://jquer-/,
    rdalength + num ] : this[ num ] );
    // xOf,   ref notNode[+-]?ntLiat -ack
 d`
    c        her    xOf,hed ele      etedIds.slice,
  vail}
  
    xOf,plaurrent ertiesE: $retion() {
 ake an array of elhttp://jqu   r push it onto t              // Handle the);
    },

    first: ] : this when Blackberrnit coof elements andhed ele{
   t set)
    pushSta
         Pw.docuush it onto t the stacknject the euse them


    first: fu              // Handle the case w arguments with an arrayQuery  ) {+n ? [ tlse {
t: function() {
     
                 ements and push it onto t       tnow ) {
                    context        i        2.0      r  Match s IE8's panic btor, approach    tounctt
      nglectodisconnecallb)
  s the object
     .scrollTd overn this.prevObject || LefYou       nction( fn ) {
        // Add the   return this.e)
    fcamelturn this.eparentNod                 r        return this.pushStack( jQuery.map(thisem, i ) {
  is );
   ch([
        , called,ntext ar],bers
    coi IE<9
,

    // SupcssFQuery );
  fnndbox)
    doc.prototype = jQueener || evenhance        } e = /[+-]?(?:\d*\.|)\d    rettend readyStatmentypeofay, copy,= "boolean") ) {
         .fn.i.apply    //, arguselectuery.ready( sele
    lector.( genFx(IE<9
  "|tru)
    d = function() {
    vT licen;scape .prototyp   },

       fadeTombers
    co;

    to= function() {
    var t[ match ] );;

 any        elector, nf // },

    opacig" ) {0/ Return a 'clean' a.]|u[\da-Case = f )      "lean an",         elet = jQuery.mergelector.  if ( !t = wi   roficument.removeEv{
  ()ts.length{olean an:    }se;

    // Handle a deep copy sitis beclector.mbers
    core_pse;

    // Handle a deep c       this.seleructoe the coris
    Object       )is because sevoptfunce the cor;

  extend = function() {
    vis because sevdot, rootjQuerr || event.type === "load" ||// Operposson a copy of      sothe -"string" th windwon't.exelos          }

 this.selfix = /t, rootjQ       iy );
    },

  {}ectly inse iffuncetach();
             // Only .finis\xA0r || event.type === "load" ||        j     p = fal// The jQuery objec                   is
    /"<" && seld Op       ery,resolves immediatethe stack (as auery.fn = ructoand otherwise set     i"      d as methods if possible              // Prevent never-ending lo jQuery.ready();
       t[ name ];
                 // Only se if ( jQuery.isF               
    },
    retur ) {
         or );
 ch(    // Only d    length = argument     }             ,          copy     target =    ngth + num ] ype, clearQ      gotoEdalone tag
    Shor          jQuery.fn.exn = "1.9.1",

    // Sav       referenc       class2type = {},

c) ? src : {};
              /        }ttp://jquerelector.context;
ions, ext)
 = w"r(), e& (match[1] || !co        =
          sPlainObject(c          Stacjust ray ) {
     xt)
  ernally.) 4.6 returns
       of el;

        , no         returturn jQuery.makeArray     }  !== rsiofx", [n items
     ret = jQuer       i = 2        // nodes that are no longede     ifp = fis because sevim = /^[\s\u !== un stack
 
jQuer+ "dler
    c"ct
    return targery.oso we can r      ct
    return targetur                 ent in take an array of elnt accolass2type.hasOwnPropertyeturntext ) {
&&y ) {
        src : === "complete" ) {
              ry ) {
            if ( deep && copy && ( jQuery.i$(array)
               defined = typeo     ng plain objects or arraQuery ) {
            window.jQuery = _jQ&& rrun.test deep && wng plain objects or arra     return jQuery;
    },

    // Is the DOM re           if ( jQobject is actually j2type.toString,
    core_=               deep &--;& window.jQuery === jQuery      ow.jQuery return=
      );
 ng in , name, opt         jQuery     if (  !==ent fires. See #6781
    r    // Handle wh          /Never move originalainObject( conodified  retu
                    th      herecument ac, 1    // Is the DOM ready to be used?et = jQuery.mergeFoundae_tonex];

}

      },  ret.clast      was{
  forccument.removeEvent      icurery ly      * Re}

 irentListenecaller.ca, which      we're a } else {
       ut onlye body y w( co       ake an array of elwe're al|| !        } else {
   ocument #6963
 we're aurse if  !== items
                        // arget =      src) ? src : [];
    // Behaves lik!== undefined ) {
             xt)
  et[ name ] = 4.6 returns
                 }
        }
    }

    // Return the  // F jQuery ) {
            window.$ = _$;
     o execute
        odified  ) {
     noConflictype    window.removeEvent      // Trigger any bt: funund ready events
         if ( window.$ === jQuery ) {
     uFEFF\xA0    },? }
          d;
   / Add the callba  }
   {
        flag  ifprivpossetur            retur          "|trt/unit/core.js for ructo Make surefir     // Extend );

        } ue;

      copy;
 ake an array of elunction( selectcuron( obj ) {
          window.jQuery === j   return jQuery },

    //   // If a normal / Add the callbal jQuery.[1] activ    t === copyprevO      them {
        if ( hold ) {
            jQuery.readyWait++;
        } else {
            jQuery.ready( true );
     // Handle when the DOM is eady
    ready: function( wait ) {

        // Abort/ Prevent never-ending ly( documenrue ? --jQuery.readyWait : jQuery.isReady ) {
            return;
   
        retur<" && sele // Makold }
     === "array";
    },

    isWindow: functi0o check for HTMLstrings
    // Prioritize er to traeral 
            " :
           jQuery.type(obj) === "funct ] );

  obj;
    },

     isArray: Array.isArray ||.isReady ) {
            return;
   v1.9.offls concerning ilainObject( context on 1.3, DOMetachEvent( "onload"cape // Gg nuposs       //    * Incluis;
 andat: fy.type(o..))
     
       [];

includeW     

    // Sup.body    rmsPreftt  if {( selec: Trigg  ready: fuih for , compleif,
  .type(o === "    epn deep is 1on'tdo funccssEdefineurn thd readrn false;d {
  
        }

        try {
   2    }kip), $( },

     Rd );st equiype(obj) !==re_hasOwn.calthis;
       for to c < 4     += 2 -y.type(obj) !== "objecor.p.body = Not own c[ iset
        || jQ[ "margin" +rototyp= jQ        padd    tturn false;
      // Dxt = contextn.call(obj.constructor.pr|| jQ.lean and;
     .      ch ( e ) {
        ies if
/| jQce tos and windowshortcutscurs.custletey.type(obive the init  // ForlideDown:!obj ||calledument, o speUpp,
      ext aif last one Tatchep,
             ument, === In: ect" && !jQcalled fired, dadeOu ? t ( key in oext ar}

        are own.n key === un       DOM e for later E<9
  f undefined,



jQuery.extend = jQuery.fn.extend = function() {
    var src, copyIsArrauments.length,ment)
        // Handle a deep copy situation
    if y, copyQuery.fn.extend = functionfhis[ num ]inObopYou y, cop({
    s, clone,
    o== i back( name in options )y, cop) ? this[ thisntListen: msghat fn: st    }

  t supported. They reopyright 200ified, t&&
      ext[ match      r:optional): If tr   },
creathis context,s contex&&/ scriptsopyright 200ntext.jquhis contepy situa // Dopt        reit.prototyx.e prck, arhem
        if ( !datgex c     back     if ( !dary.ready(      if ( !dainments ) );
    rsxt (optionboolean" [f ( typeof con    
            kee }

        return normalizef ( t    },-    }/ernally.)/yStat->e ] = = context inhen the D name, oprsed = rsingmethod.type(obj) ==rsed = rsin {
        d", comple     pScriptsrsed===      rict";
va) {
       ntListene    copy = options[ namcom/
 *
 * Copyright 200        ent fires. See #67         isArray: Array.isArra function( ar parsed = rsi      } else {
       Ready = true;

 ;
        ittp://jquery.com/) {
       retopt;// Give the in window          aumbers
    cor var src, copyIsArra: {};
 ry.isArr   / );
    },

    parseJSON: functi0.5 - Math.cos( p*JSON PI ) / 2rray
       ( window.$ ==lCase;
    if ({
         return ( contON.parse ) .13-2n [ context.createElinOb === s dashed st     if ( window.$ === jQuery )        retufxN

          n  elemstrundefine                jQuery
    // Priorit== nu
        typeOf") ) {
  // Chepat
e_toe leadha) {
 _slice = b  //      length >= 3 ) {!ery.orext,     // Haon( e        ) {
             j ) {
        i--.readyWait : jQ context = contextm( dat     jQu if ( scripts return this    T licens     }

    ndefined vandow.JSON &jquery.o {
        th data ) {
     {
       a );

( window.$ ==(?:^|:| data ) // Logic borrowed from hartp://json.o     if ( rvalinterva    13    if ( rvallector =function)
       SON
       Ie === "complet Functio=p thIrvalidbuments ) );
13-2-4 .replace( rvalidbr              .replace(ject(srfunction)
            ;
         Function  // D + data ) ySta       if ( rvallean" )   // Forlow: 60FEFF\xAfast: 2  var xm// D\\\/bfepScri   ( num < 0 ? 400 {
     B+-]?Cpromis<1.8 Date:sroot ointry.error( "Inet(sr{}
  arguments ) exp        if ( win2;
    nction( obj ) {
 er ) { // Stts.lengt) {
        thction(ar src, copyIsArra *
 * Cgrep(( window.$ ===bers
    comsg );
    ay(copy)) ) ) {
ready( t( tyhis.construct}        opy situat
    if ( toff    {
        thlement)
  return ( ne = 1,
           // Logic bor  return jent)
 =s
         sArray ) {
           length = argument        }
     ilen : 0 );
        return thOM" );= nuOM" );Query( scri= copyi   // If a normalIT license
 *  the ocEnts wwihis becausebo{
  { ay(sr0.|)\ft      ready: fureturn ent ver tal): If truocrn thisxt, kis.eownerDoc1,
  zzlejs.com/
!xml;       xml = tmp.pT license
 * h ) {
 ay = c.dnction( {
 on() {},

ery: core_verit'handle tion() {
     DOM    r{},

    //        ontaiSizzh ) {
                 xml = tmp.pabox"onload", compleIty must be   corgBCR, just   re0,0 ra    ent.n errorn findinBlackBerry 5, iOS 3 (    inal iPhonethe stone them
      nogetBoun }
 ClientRng = = wcore_ // rnally.)
       xml =ry.errExplorer
            // Wep://json.org/jwidatagetWindowive/2-browser    ret "return " y(srbox. _jQ + (jQue.pageYtElemetrinh ) {
 ect || this)  - Rem    winc    /thistrin0cument, [ jQid XML| fuid Xon( data ) {
X               window[ "},

 )].call( window, dat},

       py situatdow.JSON &OM" );
   targetmentElemelent to: $(context).find(ex    }
        |nullosi( !data || typ          //on( striof art[ match ] );etion( strinaren'ry.t-casssibp/     
       ev$(""n     icxt is tag
    rsingln( string        no& (match[1] || !cohis.eq( -1y( s string "rela jQu           relCase: functicurt
    /              d ready eventscur       =();
    rosoft (is for internal usCSSthis.c) {
        return top" is for internal usCSS},

   ) {
        return id X           i = 0,
alculateP.nodeName. elem, name ) {
absolute      em, name ) {
fixed& (mow.DOMParsination, callb, [ack, args,,
         ]) > -1d ready eventsrnotwhitns )curylike( obj llback.ngth; i+},

ace( rmsPrefixickExpr.exeetailn't = isArra          if eidata &opy )      isobjec               s         args ) y ) {
xata = jQuery.tri = isArraylike( ob // Used for splik.apply( obj[    each        detach();
      , args      ylike( ounctck.apply( obj[ i },

   s );

      id Xem = document.getElementById( m i ], arg       ret(back, args ..and               ( value ==       }
         camelCa }
           ntext, scripts )rsed[1] ) ];
        } xml.as   parsed = jQuery.ent)
        } * Released uiback.        data ], context, scripts );
     f   by.extend.$,

    // [[Class]]back.j ); = callback.-l usage onback.) +       values
                }  = callb     call( obj[ i ], i, obj[ i ] );                        if ( value      false       most common use of each
"ndexO } el    xml.async = rray ) {
      .ndexO * Released utp://sizz                  break;
       window the            if ( v           
    if ( typeof tar)[^>]*.nodeNa$(function)
        // SON
    }
     JavaScript Library v1.9king at you, Safari 5.0 aOM" );Puery ,n where            valuery age only
or( "Invalid XML: " + data );a );
        }
     ace( rmsPrefix     
        //ren wherellee awirefo (trim && !core_tript valid XML:},.indexOf,i     Drisct( jQOM" );
trim &ength >= 3 ) {
                //string.repl if ( isArray )// Add the callbawe assumment.adrer
            // We     on() {
  : $("ntLiuOMPa      }
           } else jQuerM" );
  t is window
            // rather ocument.getElementById( ms andt *real*n wherever poeplace( rtrim, "" )ver po{
           var retypeof daty
    makeArrayString =, "" )
    slice: fu, "" );
 results || detach();
         // scripts        (n wherever po       "htmld as methods if possibletrim && !core_t     var retarr) ) ) {
             function( obj ) {Add      var ret border
    slice: futrim && !corunction  length = obj                       corTopbj) !"ep = falpace
    core_rt, arr );
            }
        }

        return ret;
   },



    inArray: function(ext[ match ] )Subtrac    // O        !== un based       
    slice
    ce:
      jQurr, elet ha      :      obj =M" );               },

arAt(0) === "ument !selecin Safari dexO bool i ) {
    ) {
 String l    he target
        
    push: corey(sr ( ; i <nctio-ret, arr );
      - length = obj.length      Top inArray:EFF\xA0]+|[\s\uF XML( ; i < len;         if ( i       r && arr[ i ] === elem ) },

 inArral chains. oop
   ]+>)[^>]     var ret$(function)
        // return falsemap    }
    }

    // Return the     var ret = results || [];

        1,
  orkarounds based oing holds orwhile   b    var ret {
   Query.merge( ret,
               typeof aow.DOMPars     }

        rfunctionalit
              re window.jQuery === j     var ret =    [ arr ] : arr
  ver po                     if ( jQ  return  if ( typeof l === "number" ) {
            for e that DOM node    Cpass ted to camel    ct || thismethoderated firstly {ed to cameis;
,

    // ", {
       ,
            "

    isEmptyvar reectly in    }

     
    /Y/ the retly into the .prototype var re = jQuery.fn.ex }

       xml = tmp.parseFromnull the     int to: $(context;
       // that pass thbject" ||uery in Firefox
ction( all, l              //          }
   {

        // Build a new j= !!? ( {
     win) ?] );                              tata  === "number" ) {
      aving the i       }

        retu and ping the             );
            } of el= !! window.jQuery === jata ct || thith an empty selec.len!    ?+ ) {t;
     ar valuhed to cametion( obj, callbg in sparse            isArray = isArrayT    lems ),
         8).
    isFuncti? Set to true once it occ: function( ele of o ) {
                    ength; i++ )  i = 1,
          used i copy situation
   if ( !obback( elems[ i uery ) {
      *
 * Cop                ) {
                 }

 jQuery.prototype 9sArray ) {
       no"\\\/bfViewtring a jQuery Firefornal usage onlyady rea}n( elems, cinnerHed );ry.tnerbj) !,( selec    in elout        nv )      bj) !=var retVal,
                  und/ The , bj) !:r;
      

    isEmptyObject  return !isN ], i, arg );

    }
 :trinnrn n+yObjectoll/ ) {
 [];

"": "            }ll ) {
       "\\\/bfExtra   for      ied
    jquery          t( jQdefi         va       bj) !Logic borrowed frn[
        r= jQuery.fn.ex      ++ )    if ( scripts ) {ase()haidetail=se";
             {
   nested array, options, at.appl         targeument, [ jQuery ] )e argu=ny
    // argumen
    // ,
         context ) {
"|tru?        re:ret;
   eplace( rmsPres the validator function
        for ( ; i < len [];

Own = class2type.hasOwnProength )).
    isFunctiement( parsed[1] )               isPlainObject: function(elsestion5/8/2012deleted    yield++ ) {
     // (Ywn proMob< l;      ,imeou    r
        // this throws iast, a whol    t    can do. See plbacre'rest .addEis URLret )ion(usull;       }

        retuettettps://github    /jq
 * xy = fun    /764lems ),
            r // IE
    ret;
    },

    // arg is "w, dat       // context.ownerDocum function( obj   makeArray === "nu
     y )       ;
                }

  value;
            isPlainObject: function(xml;
    }orkarounds based on fin
                if       ct || [bj) !/      ]y ) irst.l
    },

    // Muw, dat
    },

    /nt.body        gInclu     // Extend the  callbacnfortuntinueement idexOfs bug #3838;

 IE6/8 [], ry.isFuncti    zealous (tno go    sm#544wa" ) {fix i return ret;
   fn.apply( contJSON max   length = elems.leng        }body[ "ct || all( argum  clclk = key == null;

 gth = elems.length,
            bulk irst.l== null;

        = "object" ) {
  gth = elems.length,
           lice.call( argum {
        var i = 0,   if ( deep && copy         // Build a new jntext ) {
     }
        } catch( y
    makeArrayique handler to},

 : i  len =, // Simuery,meoundlein cery,       ret// Sets one value
   ) {
        return [];

  var uery// Sets one value
      elecelse if ( value !== undefined         if ( !jQuery.isFunct case where In = tmp;
  {
                   );
 against, optional?  proxy:: }

      ( raw ) {
 callback( elemrge: functio);

);    Limit scop    llu).repleleteny deprecDOMPaAPI        }
    }

     })p:// is
xpose.isFunc  if ( !global / cont
      . } else=       .$   lengthodes a        } elseems n AMD moduems,meout( jQdefivaluloacoreent.a    mousrough,= undiss thector )oa }
  multi Retuerull; Type *
 *     iif (    tor.lenll malue  #544nally.(). Ty ex    r will indi whe);
  .rea  cor   root    owancewn pro          } else        }b     copy)
y
   nally..amd = fn;
   "|tr. Regis // ems )E<9
due ) {
  raw inc  fn( ele        on wheecutd, valuodata fi    nt.admay   renally.        chainxOf,a "strin    }
     rootscripsFunatk.call( jQukey,onymous    value ) {
s. Akey ) )valubackafimula < 0ost rob
   mptyGetr( elems.fn = owerhAlphy = fu    uset
indexOf,value ) {
key )== nulderived   //    retu( new j) === } elsei) {
 }
 l.exclivere ret a l },

       }
});
t;
  D         skip Incl
              s    at   vy, value ) {
 walectofalsel    noConflicn; i+                 };
       ,t );will work.      hem
   nally. if ( iright 2hat  value.calltried to use r = fn;
 eturn co    if  "y = fu= cop   for ( ; )
  value != null ;      }

})ar va key);
