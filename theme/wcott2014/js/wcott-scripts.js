/*
 * Scripts used in the wcott_2014 theme
 *
 */

( function( $ ) {


    $( document ).ready( function() {
        if ( $( '.demo-step-togglers' ).length > 0 ) {
            WCOTT.latestPostsSteps.init();
        }
    } );




    WCOTT = { };

    WCOTT.latestPostsSteps = {
        init: function() {
            var _this = WCOTT.latestPostsSteps;

            _this.$section = $( '.section-ten-latest-posts' );
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
                    _this.$section.masonry('destroy');
                }

                _this.iCurrStep ++;
                $this.data( 'which-step', _this.iCurrStep );

                _this.$section.addClass( 'step-' + _this.iCurrStep );

                if(_this.iCurrStep == _this.iMaxStep) {
                    _this.$section.masonry();
                }


            } );
        } //init()
    };


} )( jQuery );