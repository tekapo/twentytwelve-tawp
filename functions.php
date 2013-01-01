<?php

// remove p tags from excerpt for the top page.
function remove_p_tag( $string ) {
	$removed = strip_tags( $string );
	return $removed;
}

//add_filter( 'the_excerpt', 'remove_p_tag' );

function add_ad_content( $a ) {
	$b = <<<EOT
<div id="add_ad">
<script type="text/javascript"><!--
google_ad_client = "pub-0173465279213646";
/* tawp 横長 */
google_ad_slot = "7945774425";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
EOT;
	return $a . $b;
}

add_filter( 'the_content', 'add_ad_content', 100 );

/**
 * 1年以上前の投稿に古いということを表示する
 * 
 * 
 */
function how_old_the_post() {

	$how_old_text = '';

	$now_time_utc_unix	 = date( 'U' );
	$post_tiem_utc_unix	 = get_post_time( 'U', true );

	$diff_time_u = $now_time_utc_unix - $post_tiem_utc_unix;

	$diff_time_year_u	 = floor( $diff_time_u / 2629743.83 );
	$diff_year			 = floor( $diff_time_year_u / 12 );
	$diff_month			 = floor( $diff_time_year_u % 12 );

	if ( !$diff_month == 0 ) {
		$m = 'と' . $diff_month . 'ヶ月';
	}

	if ( !$diff_year == 0 ) {
		$m				 = '';
		$how_old_text	 = <<<EOL
<div class="how-old">注意!! この投稿は{$diff_year}年{$m}くらい前に公開したものです。そのため最新版の WordPress では正常に動作しないかもしれないので、ご注意ください。</div>
EOL;
	}
	echo $how_old_text;
}

add_action( 'how_old_the_post', 'how_old_the_post' );
