jQuery(document).ready(function($) {
    
    if (typeof elegant_pink_ajax !== 'undefined') {
        
        //Start Ajax Pagination
        
        var pageNum = parseInt(elegant_pink_ajax.startPage) + 1;
        var max = parseInt(elegant_pink_ajax.maxPages);
        var nextLink = elegant_pink_ajax.nextLink;
        var autoLoad = elegant_pink_ajax.autoLoad;
        
        if ( autoLoad == 'load_more' ) {
            // Insert the "Load More Posts" link.
            $('.pagination')
                .before('<div class="pagination_holder" style="display: none;"></div>')                
                .after('<div id="load-posts"><a href="#"><i class="fa fa-refresh"></i>' + elegant_pink_ajax.loadmore + '</a></div>');
            if (pageNum == max+1) {
                $('#load-posts a').html('<i class="fa fa-ban"></i>'+elegant_pink_ajax.nomore).addClass('disabled');
            }
            $('#load-posts a').on( 'click', function() {
                if(pageNum <= max && !$(this).hasClass('loading')) {
                    $(this).html('<i class="fa fa-refresh fa-spin"></i>'+elegant_pink_ajax.loading).addClass('loading');

                    $('.pagination_holder').load(nextLink + ' .latest_post', function() {
                        // Update page number and nextLink.
                        pageNum++;
                        var new_url = nextLink;
                        nextLink = nextLink.replace(/(\/?)page(\/|d=)[0-9]+/, '$1page$2'+ pageNum);
                        
                        //Temporary hold the post from pagination and append it to #main
                        var load_html = $('.pagination_holder').html(); 
                        $('.pagination_holder').html('');                                 
                        //$('.ep-masonry').append(load_html); 
                        
                        // Make jQuery object from HTML string
                        var $moreBlocks = $( load_html ).filter('article.latest_post');
                    
                        // Append new blocks to container
                        $('.ep-masonry').append( $moreBlocks ).imagesLoaded(function(){
                            // Have Masonry position new blocks
                            $('.ep-masonry').masonry( 'appended', $moreBlocks );
                        });
                        
                        var $this = $('.ep-masonry').find('.entry-content').find('div');
                        if( $this.hasClass('tiled-gallery') ){
                            $.getScript(elegant_pink_ajax.plugin_url + "/jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.js");                    
                        }
                        
                        if(pageNum <= max) {
                            $('#load-posts a').html('<i class="fa fa-refresh"></i>'+elegant_pink_ajax.loadmore).removeClass('loading');
                        } else {
                            $('#load-posts a').html('<i class="fa fa-ban"></i><span title="'+elegant_pink_ajax.nomore+'">'+elegant_pink_ajax.nomore+'</span>').addClass('disabled').removeClass('loading');
                        }
                    });
                    
                } else {
                    // no more posts
                }
                
                return false;
            });
            $('.pagination').remove();
        } 
        // End Ajax Pagination
    }
    
});