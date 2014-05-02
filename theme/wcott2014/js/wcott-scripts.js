/*
 * Scripts used in the wcott_2014 theme
 *
 */

( function( $ ) {

$( '#bk-list' ).hide();

    $( document ).ready( function() {
        if ( $( '.demo-step-togglers' ).length > 0 ) {
            WCOTT.latestPostsSteps.init();
        }

if ( $( '#bk-list' ).length > 0 ) {
            $( '#bk-list' ).imagesLoaded( function() {
                booksInit();
            } );
        }

    } );






    var WCOTT = { };

    WCOTT.latestPostsSteps = {
        init: function() {
            var _this = WCOTT.latestPostsSteps;

            _this.$section = $( '.section-ten-latest-posts, .section-fifteen-latest-books' );
            _this.$toggler = $( '#btn-add-step' );
            _this.iCurrStep = 0;
            _this.iMaxStep = 3;

            _this.$toggler.on( 'click', function( e ) {
                e.preventDefault();

                var $this = $( this ),
                    iWhichStep = $this.data( 'which-step' );

                if ( typeof iWhichStep == 'undefined' || iWhichStep == _this.iMaxStep ) {
                    _this.$section.removeClass( function( index, css ) {
                        return ( css.match( /\bstep-\S+/g ) || [ ] ).join( ' ' );
                    } );

                    _this.iCurrStep = 0;
                    _this.$section.masonry( 'destroy' );
                }

                _this.iCurrStep ++;
                $this.data( 'which-step', _this.iCurrStep );

                _this.$section.addClass( 'step-' + _this.iCurrStep );

                if ( _this.iCurrStep == _this.iMaxStep ) {
                    _this.$section.masonry();
                }


            } );
        } //init()
    };



    /*
     *
     * By the fabulous folks at Codrops
     * http://tympanus.net/codrops/2013/01/08/3d-book-showcase/ *
     *
     */
    function booksInit() {

        var $books = $( '#bk-list > li > div.bk-book' ), booksCount = $books.length;


        $books.each( function() {

            var $book = $( this ),
                $other = $books.not( $book ),
                $parent = $book.parent(),
                $page = $book.children( 'div.bk-page' ),
                $bookview = $parent.find( 'button.bk-bookview' ),
                $content = $page.children( 'div.bk-content' ), current = 0,
                iCoverHeight = $book.find( '.bk-cover img' ).height(),
                $heightElements = $parent.find( '.bk-front, .bk-back, .bk-front > div, .bk-left' ).add( $book ).add( $parent ),
                $slightlySmallerHeightElements = $book.find( '.bk-page, .bk-right' ),
                iParentWidth = $parent.width(),
                $widthElements = $parent.find( '.bk-front, .bk-back, .bk-front > div' ),
                hexCoverColour = $book.data('cover-colour');

            //Dynamically adjusting the book's height
            $heightElements.height( iCoverHeight );
            $slightlySmallerHeightElements.height( iCoverHeight - 10 );

            $book.find( '.bk-left h2' ).width( iCoverHeight - 10 );

            $widthElements.width( iParentWidth);
            $parent.find('.bk-page').width(iParentWidth - 15);

            $book.find('.bk-front > div, .bk-back, .bk-left, .bk-front:after').css('background-color' , '#' + hexCoverColour);

            console.log($book.find('.bk-front > div, .bk-back, .bk-left, .bk-front:after'),  hexCoverColour );






            $parent.find( 'button.bk-bookback' ).on( 'click', function() {

                $bookview.removeClass( 'bk-active' );

                if ( $book.data( 'flip' ) ) {

                    $book.data( { opened: false, flip: false } ).removeClass( 'bk-viewback' ).addClass( 'bk-bookdefault' );

                }
                else {

                    $book.data( { opened: false, flip: true } ).removeClass( 'bk-viewinside bk-bookdefault' ).addClass( 'bk-viewback' );

                }

            } );

            $book.on( 'click', function() {
                console.log( $( this ), 'clicked' );
                var $this = $( this );

                $other.data( 'opened', false ).removeClass( 'bk-viewinside' ).parent().css( 'z-index', 0 ).find( 'button.bk-bookview' ).removeClass( 'bk-active' );
                if ( ! $other.hasClass( 'bk-viewback' ) ) {
                    $other.addClass( 'bk-bookdefault' );
                }

                if ( $book.data( 'opened' ) ) {
                    $this.removeClass( 'bk-active' );
                    $book.data( { opened: false, flip: false } ).removeClass( 'bk-viewinside' ).addClass( 'bk-bookdefault' );
                }
                else {
                    $this.addClass( 'bk-active' );
                    $book.data( { opened: true, flip: false } ).removeClass( 'bk-viewback bk-bookdefault' ).addClass( 'bk-viewinside' );
                    $parent.css( 'z-index', booksCount );
                    current = 0;
                    $content.removeClass( 'bk-content-current' ).eq( current ).addClass( 'bk-content-current' );
                }

            } );

            if ( $content.length > 1 ) {

                var $navPrev = $( '<span class="bk-page-prev">&lt;</span>' ),
                    $navNext = $( '<span class="bk-page-next">&gt;</span>' );

                $page.append( $( '<nav></nav>' ).append( $navPrev, $navNext ) );

                $navPrev.on( 'click', function() {
                    if ( current > 0 ) {
                        -- current;
                        $content.removeClass( 'bk-content-current' ).eq( current ).addClass( 'bk-content-current' );
                    }
                    return false;
                } );

                $navNext.on( 'click', function() {
                    if ( current < $content.length - 1 ) {
                        ++ current;
                        $content.removeClass( 'bk-content-current' ).eq( current ).addClass( 'bk-content-current' );
                    }
                    return false;
                } );

            }

        } );

$('.bk-list li .bk-book > div, .bk-list li .bk-front > div ').css({
    position: 'absolute'
});

         $( '#bk-list' ).masonry();


         $( '#bk-list' ).fadeIn();

    }



} )( jQuery );



/*!
 * imagesLoaded PACKAGED v3.1.6
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

( function() {
    function e() {
    }
    function t( e, t ) {
        for ( var n = e.length; n--; )
            if ( e[n].listener === t )
                return n;
        return- 1
    }
    function n( e ) {
        return function() {
            return this[e].apply( this, arguments )
        }
    }
    var i = e.prototype, r = this, o = r.EventEmitter;
    i.getListeners = function( e ) {
        var t, n, i = this._getEvents();
        if ( "object" == typeof e ) {
            t = { };
            for ( n in i )
                i.hasOwnProperty( n ) && e.test( n ) && ( t[n] = i[n] )
        } else
            t = i[e] || ( i[e] = [ ] );
        return t
    }, i.flattenListeners = function( e ) {
        var t, n = [ ];
        for ( t = 0; e.length > t; t += 1 )
            n.push( e[t].listener );
        return n
    }, i.getListenersAsObject = function( e ) {
        var t, n = this.getListeners( e );
        return n instanceof Array && ( t = { }, t[e] = n ), t || n
    }, i.addListener = function( e, n ) {
        var i, r = this.getListenersAsObject( e ), o = "object" == typeof n;
        for ( i in r )
            r.hasOwnProperty( i ) && - 1 === t( r[i], n ) && r[i].push( o ? n : { listener: n, once: ! 1 } );
        return this
    }, i.on = n( "addListener" ), i.addOnceListener = function( e, t ) {
        return this.addListener( e, { listener: t, once: ! 0 } )
    }, i.once = n( "addOnceListener" ), i.defineEvent = function( e ) {
        return this.getListeners( e ), this
    }, i.defineEvents = function( e ) {
        for ( var t = 0; e.length > t; t += 1 )
            this.defineEvent( e[t] );
        return this
    }, i.removeListener = function( e, n ) {
        var i, r, o = this.getListenersAsObject( e );
        for ( r in o )
            o.hasOwnProperty( r ) && ( i = t( o[r], n ), - 1 !== i && o[r].splice( i, 1 ) );
        return this
    }, i.off = n( "removeListener" ), i.addListeners = function( e, t ) {
        return this.manipulateListeners( ! 1, e, t )
    }, i.removeListeners = function( e, t ) {
        return this.manipulateListeners( ! 0, e, t )
    }, i.manipulateListeners = function( e, t, n ) {
        var i, r, o = e ? this.removeListener : this.addListener, s = e ? this.removeListeners : this.addListeners;
        if ( "object" != typeof t || t instanceof RegExp )
            for ( i = n.length; i--; )
                o.call( this, t, n[i] );
        else
            for ( i in t )
                t.hasOwnProperty( i ) && ( r = t[i] ) && ( "function" == typeof r ? o.call( this, i, r ) : s.call( this, i, r ) );
        return this
    }, i.removeEvent = function( e ) {
        var t, n = typeof e, i = this._getEvents();
        if ( "string" === n )
            delete i[e];
        else if ( "object" === n )
            for ( t in i )
                i.hasOwnProperty( t ) && e.test( t ) && delete i[t];
        else
            delete this._events;
        return this
    }, i.removeAllListeners = n( "removeEvent" ), i.emitEvent = function( e, t ) {
        var n, i, r, o, s = this.getListenersAsObject( e );
        for ( r in s )
            if ( s.hasOwnProperty( r ) )
                for ( i = s[r].length; i--; )
                    n = s[r][i], n.once === ! 0 && this.removeListener( e, n.listener ), o = n.listener.apply( this, t || [ ] ), o === this._getOnceReturnValue() && this.removeListener( e, n.listener );
        return this
    }, i.trigger = n( "emitEvent" ), i.emit = function( e ) {
        var t = Array.prototype.slice.call( arguments, 1 );
        return this.emitEvent( e, t )
    }, i.setOnceReturnValue = function( e ) {
        return this._onceReturnValue = e, this
    }, i._getOnceReturnValue = function() {
        return this.hasOwnProperty( "_onceReturnValue" ) ? this._onceReturnValue : ! 0
    }, i._getEvents = function() {
        return this._events || ( this._events = { } )
    }, e.noConflict = function() {
        return r.EventEmitter = o, e
    }, "function" == typeof define && define.amd ? define( "eventEmitter/EventEmitter", [ ], function() {
        return e
    } ) : "object" == typeof module && module.exports ? module.exports = e : this.EventEmitter = e
} ).call( this ), function( e ) {
    function t( t ) {
        var n = e.event;
        return n.target = n.target || n.srcElement || t, n
    }
    var n = document.documentElement, i = function() {
    };
    n.addEventListener ? i = function( e, t, n ) {
        e.addEventListener( t, n, ! 1 )
    } : n.attachEvent && ( i = function( e, n, i ) {
        e[n + i] = i.handleEvent ? function() {
            var n = t( e );
            i.handleEvent.call( i, n )
        } : function() {
            var n = t( e );
            i.call( e, n )
        }, e.attachEvent( "on" + n, e[n + i] )
    } );
    var r = function() {
    };
    n.removeEventListener ? r = function( e, t, n ) {
        e.removeEventListener( t, n, ! 1 )
    } : n.detachEvent && ( r = function( e, t, n ) {
        e.detachEvent( "on" + t, e[t + n] );
        try {
            delete e[t + n]
        } catch ( i ) {
            e[t + n] = void 0
        }
    } );
    var o = { bind: i, unbind: r };
    "function" == typeof define && define.amd ? define( "eventie/eventie", o ) : e.eventie = o
}( this ), function( e, t ) {
    "function" == typeof define && define.amd ? define( [ "eventEmitter/EventEmitter", "eventie/eventie" ], function( n, i ) {
        return t( e, n, i )
    } ) : "object" == typeof exports ? module.exports = t( e, require( "eventEmitter" ), require( "eventie" ) ) : e.imagesLoaded = t( e, e.EventEmitter, e.eventie )
}( this, function( e, t, n ) {
    function i( e, t ) {
        for ( var n in t )
            e[n] = t[n];
        return e
    }
    function r( e ) {
        return"[object Array]" === d.call( e )
    }
    function o( e ) {
        var t = [ ];
        if ( r( e ) )
            t = e;
        else if ( "number" == typeof e.length )
            for ( var n = 0, i = e.length; i > n; n++ )
                t.push( e[n] );
        else
            t.push( e );
        return t
    }
    function s( e, t, n ) {
        if ( ! ( this instanceof s ) )
            return new s( e, t );
        "string" == typeof e && ( e = document.querySelectorAll( e ) ), this.elements = o( e ), this.options = i( { }, this.options ), "function" == typeof t ? n = t : i( this.options, t ), n && this.on( "always", n ), this.getImages(), a && ( this.jqDeferred = new a.Deferred );
        var r = this;
        setTimeout( function() {
            r.check()
        } )
    }
    function c( e ) {
        this.img = e
    }
    function f( e ) {
        this.src = e, v[e] = this
    }
    var a = e.jQuery, u = e.console, h = u !== void 0, d = Object.prototype.toString;
    s.prototype = new t, s.prototype.options = { }, s.prototype.getImages = function() {
        this.images = [ ];
        for ( var e = 0, t = this.elements.length; t > e; e ++ ) {
            var n = this.elements[e];
            "IMG" === n.nodeName && this.addImage( n );
            var i = n.nodeType;
            if ( i && ( 1 === i || 9 === i || 11 === i ) )
                for ( var r = n.querySelectorAll( "img" ), o = 0, s = r.length; s > o; o ++ ) {
                    var c = r[o];
                    this.addImage( c )
                }
        }
    }, s.prototype.addImage = function( e ) {
        var t = new c( e );
        this.images.push( t )
    }, s.prototype.check = function() {
        function e( e, r ) {
            return t.options.debug && h && u.log( "confirm", e, r ), t.progress( e ), n ++, n === i && t.complete(), ! 0
        }
        var t = this, n = 0, i = this.images.length;
        if ( this.hasAnyBroken = ! 1, ! i )
            return this.complete(), void 0;
        for ( var r = 0; i > r; r ++ ) {
            var o = this.images[r];
            o.on( "confirm", e ), o.check()
        }
    }, s.prototype.progress = function( e ) {
        this.hasAnyBroken = this.hasAnyBroken || ! e.isLoaded;
        var t = this;
        setTimeout( function() {
            t.emit( "progress", t, e ), t.jqDeferred && t.jqDeferred.notify && t.jqDeferred.notify( t, e )
        } )
    }, s.prototype.complete = function() {
        var e = this.hasAnyBroken ? "fail" : "done";
        this.isComplete = ! 0;
        var t = this;
        setTimeout( function() {
            if ( t.emit( e, t ), t.emit( "always", t ), t.jqDeferred ) {
                var n = t.hasAnyBroken ? "reject" : "resolve";
                t.jqDeferred[n]( t )
            }
        } )
    }, a && ( a.fn.imagesLoaded = function( e, t ) {
        var n = new s( this, e, t );
        return n.jqDeferred.promise( a( this ) )
    } ), c.prototype = new t, c.prototype.check = function() {
        var e = v[this.img.src] || new f( this.img.src );
        if ( e.isConfirmed )
            return this.confirm( e.isLoaded, "cached was confirmed" ), void 0;
        if ( this.img.complete && void 0 !== this.img.naturalWidth )
            return this.confirm( 0 !== this.img.naturalWidth, "naturalWidth" ), void 0;
        var t = this;
        e.on( "confirm", function( e, n ) {
            return t.confirm( e.isLoaded, n ), ! 0
        } ), e.check()
    }, c.prototype.confirm = function( e, t ) {
        this.isLoaded = e, this.emit( "confirm", this, t )
    };
    var v = { };
    return f.prototype = new t, f.prototype.check = function() {
        if ( ! this.isChecked ) {
            var e = new Image;
            n.bind( e, "load", this ), n.bind( e, "error", this ), e.src = this.src, this.isChecked = ! 0
        }
    }, f.prototype.handleEvent = function( e ) {
        var t = "on" + e.type;
        this[t] && this[t]( e )
    }, f.prototype.onload = function( e ) {
        this.confirm( ! 0, "onload" ), this.unbindProxyEvents( e )
    }, f.prototype.onerror = function( e ) {
        this.confirm( ! 1, "onerror" ), this.unbindProxyEvents( e )
    }, f.prototype.confirm = function( e, t ) {
        this.isConfirmed = ! 0, this.isLoaded = e, this.emit( "confirm", this, t )
    }, f.prototype.unbindProxyEvents = function( e ) {
        n.unbind( e.target, "load", this ), n.unbind( e.target, "error", this )
    }, s
} );