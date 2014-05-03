$(document).ready(function( ) {


    revealInit();

});




var DEMOS = {};
DEMOS.toggleMasonry = function( ) {
    var $toggler = $('#toggle-masonry'),
            $container = $('#masonry-container'),
            msnry;

    if ($container.attr('data-masonry-on') == "true") {
        $container.masonry('destroy');
        $container.attr('data-masonry-on', "false");
    } else {
        $container.masonry({
            columnWidth: 30,
            itemSelector: '.box'
        });
        $container.attr('data-masonry-on', "true");

    }

//    $toggler.on( 'click', function( e ) {
//        e.preventDefault( );
//        var $this = $( this ),
//            isActive = $this.hasClass( 'active' );
//        if ( ! isActive ) {
//            console.log( 'Masonry on' );
//        } else {
//            console.log( 'Masonry off' );
//            $container.masonry( 'destroy' );
//            $this.removeClass( 'active' );
//        }
//
//    } );
}; //DEMO.toggleMasonry = function() {


DEMOS.toggleMasonryColour = function( ) {
    var $boxes = $('#masonry-container').find('.box'),
            arrWhiteIndexes = [1, 3, 5, 6, 7, 9, 10, 12, 13, 14, 16, 18, 19, 20, 22],
            arrBlueIndexes = [2, 17],
            arrYellowIndexes = [4, 8, 10],
            arrRedIndexes = [6, 15],
            $arrWhite = $boxes.eq(arrWhiteIndexes[0]),
            $arrBlue = $boxes.eq(arrBlueIndexes[0]),
            $arrYellow = $boxes.eq(arrYellowIndexes[0]),
            $arrRed = $boxes.eq(arrRedIndexes[0]);

//console.log($arrBlue, $arrYellow, $arrRed);

    $boxes.toggleClass('colour');

//    for ( var i = 1; i < arrWhiteIndexes.length; i ++ ) { //Skipping the first one
//        $arrWhite.push( $boxes.eq( arrWhiteIndexes[i] ) );
//    }
    for (var i = 1; i < arrBlueIndexes.length; i++) { //Skipping the first one
        $arrBlue.push($boxes.eq(arrBlueIndexes[i]));
    }
    for (var i = 1; i < arrYellowIndexes.length; i++) { //Skipping the first one
        $arrYellow.push($boxes.eq(arrYellowIndexes[i]));
    }
    for (var i = 1; i < arrRedIndexes.length; i++) { //Skipping the first one
        $arrRed.push($boxes.eq(arrRedIndexes[i]));
    }

    $arrBlue.toggleClass('blue');
    $arrYellow.toggleClass('yellow');
    $arrRed.toggleClass('red');
    //console.log($arrBlue, $arrYellow, $arrRed);

};

DEMOS.toggleSize = function( ) {
    var $boxes = $('#masonry-container').find('.box'),
            $toggler = $('#toggle-size');

    $boxes.toggleClass('no-size');
    $(this).toggleClass('active');
//    $toggler.on( 'click', function( e ) {
//        e.preventDefault( );
//    } );
};
DEMOS.toggleFloat = function( ) {
    var $boxes = $('#masonry-container').find('.box'),
            $toggler = $('#toggle-float');

    $boxes.toggleClass('floated');
    $(this).toggleClass('active');
//    $toggler.on( 'click', function( e ) {
//        e.preventDefault( );
//    } );
};

DEMOS.toggleMondrian = function( ) {
    if ($('#mondrian_pic').length == 0) {
        $('body').append('<img id="mondrian_pic" src="img/mondrian.png" />');
    } else {
        $('#mondrian_pic').remove();
    }
    console.log('toggling mondrian');
};


DEMOS.startOwlCarousel = function() {
    $("#owl-demo").owlCarousel({
        items: 3,
        lazyLoad: true,
        navigation: false,
        autoPlay: 3000,
transitionStyle : "goDown"
    });
};


function revealInit() {
    Reveal.initialize({
        width: 1080,
        // Display controls in the bottom right corner
        controls: true,
        // Display a presentation progress bar
        progress: true,
        // Display the page number of the current slide
        slideNumber: false,
        // Push each slide change to the browser history
        history: true,
        // Enable keyboard shortcuts for navigation
        keyboard: true,
        // Enable the slide overview mode
        overview: true,
        // Vertical centering of slides
        center: true,
        // Enables touch navigation on devices with touch input
        touch: true,
        // Loop the presentation
        loop: false,
        // Change the presentation direction to be RTL
        rtl: false,
        // Turns fragments on and off globally
        fragments: true,
        // Flags if the presentation is running in an embedded mode,
        // i.e. contained within a limited portion of the screen
        embedded: false,
        // Number of milliseconds between automatically proceeding to the
        // next slide, disabled when set to 0, this value can be overwritten
        // by using a data-autoslide attribute on your slides
        autoSlide: 0,
        // Stop auto-sliding after user input
        autoSlideStoppable: true,
        // Enable slide navigation via mouse wheel
        mouseWheel: false,
        // Hides the address bar on mobile devices
        hideAddressBar: true,
        // Opens links in an iframe preview overlay
        previewLinks: false,
        // Transition style
        transition: 'concave', // default/cube/page/concave/zoom/linear/fade/none

        // Transition speed
        transitionSpeed: 'default', // default/fast/slow

        // Transition style for full page slide backgrounds
        backgroundTransition: 'default', // default/none/slide/concave/convex/zoom

        // Number of slides away from the current that are visible
        viewDistance: 3,
        // Parallax background image
        parallaxBackgroundImage: '', // e.g. "'https://s3.amazonaws.com/hakim-static/reveal-js/reveal-parallax-1.jpg'"

        // Parallax background size
        parallaxBackgroundSize: '', // CSS syntax, e.g. "2100px 900px"

        dependencies: [
            // Cross-browser shim that fully implements classList - https://github.com/eligrey/classList.js/
            {src: 'lib/js/classList.js', condition: function() {
                    return !document.body.classList;
                }},
            // Interpret Markdown in <section> elements
            {src: 'js/libs/reveal.js-master/plugin/markdown/marked.js', condition: function() {
                    return !!document.querySelector('[data-markdown]');
                }},
            {src: 'js/libs/reveal.js-master/plugin/markdown/markdown.js', condition: function() {
                    return !!document.querySelector('[data-markdown]');
                }},
            // Syntax highlight for <code> elements
            {src: 'js/libs/reveal.js-master/plugin/highlight/highlight.js', async: true, callback: function() {
                    hljs.initHighlightingOnLoad();
                }},
            // Zoom in and out with Alt+click
            {src: 'js/libs/reveal.js-master/plugin/zoom-js/zoom.js', async: true, condition: function() {
                    return !!document.body.classList;
                }},
            // Speaker notes
            {src: 'js/libs/reveal.js-master/plugin/notes/notes.js', async: true, condition: function() {
                    return !!document.body.classList;
                }},
            // Remote control your reveal.js presentation using a touch device
            //{ src: 'js/libs/reveal.js-master/plugin/remotes/remotes.js', async: true, condition: function() { return !!document.body.classList; } },

            // MathJax
            //{ src: 'js/libs/reveal.js-master/plugin/math/math.js', async: true }
        ]

    });


    Reveal.addEventListener('fragmentshown', function(event) {
        // event.fragment = the fragment DOM element
        var dataRun = $(event.fragment).attr('data-run');
        console.log(event, dataRun);

        if (dataRun == 'DEMOS.toggleSize') {
            DEMOS.toggleSize( );
        } else if (dataRun == 'DEMOS.toggleFloat') {
            DEMOS.toggleFloat( );
        } else if (dataRun == 'DEMOS.toggleMasonry') {
            DEMOS.toggleMasonry( );
        } else if (dataRun == 'DEMOS.toggleMasonryColour') {
            DEMOS.toggleMasonryColour( );
        } else if (dataRun == 'DEMOS.toggleMondrian') {
            DEMOS.toggleMondrian( );
        }
    });

    Reveal.addEventListener('fragmenthidden', function(event) {
        // event.fragment = the fragment DOM element
        var dataRun = $(event.fragment).attr('data-run');
        console.log(event, dataRun);

        if (dataRun == 'DEMOS.toggleSize') {
            DEMOS.toggleSize( );
        } else if (dataRun == 'DEMOS.toggleFloat') {
            DEMOS.toggleFloat( );
        } else if (dataRun == 'DEMOS.toggleMasonry') {
            DEMOS.toggleMasonry( );
        } else if (dataRun == 'DEMOS.toggleMasonryColour') {
            DEMOS.toggleMasonryColour( );
        } else if (dataRun == 'DEMOS.toggleMondrian') {
            DEMOS.toggleMondrian( );
        }
    });
    
    Reveal.addEventListener( 'slidechanged', function( event ) {
    // event.previousSlide, event.currentSlide, event.indexh, event.indexv
    //console.log(event.currentSlide);
    if($(event.currentSlide).hasClass('owl')) {
        
        DEMOS.startOwlCarousel();
    }
    
} );
}