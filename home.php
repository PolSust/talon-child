<?php

/**
 * The home template file.
 *
 * @package Talon
 */

get_header(); ?>

<div class="row">
	<div id="primary" class="content-area col-md-8 <?php echo esc_attr(talon_blog_layout()); ?>">
		<main id="main" class="site-main" role="main">

			<?php
			$pages = get_pages();
			foreach ($pages as $page_data) {
				$content = apply_filters("the_content", $page_data->post_content);
				$title = $page_data->post_title;

				//fullWidth
				$page_data->ID != 56 ? $width = "fullWidth" : $width = "";
				//Color text
				$page_data->ID == 81 || $page_data->ID == 97 ? $color = "white" : $color = "";

				//pageid
				$titleID = strtolower($title);
				$titleID = str_replace(' ', '-', $titleID);

			?>
				<article class="pageSection <?= $width ?>" id="<?= $titleID ?>">
					<div class='coverImg'>
						<?= get_the_post_thumbnail($page_data->ID) ?>
					</div>
					<section class="pageContent">
						<h2 class="pageTitle <?= $color ?>"><?= $title ?></h2>
						<?php
						echo $content;
						if ($page_data->ID == 81) { //Games
							echo "<div class='gamesContainer'>";
							// The Query
							$the_query = new WP_Query(array('post_type' => 'games'));
							// The Loop
							if ($the_query->have_posts()) {
								while ($the_query->have_posts()) {
									$the_query->the_post();
						?>
									<figure class="game white">
										<span class="dashicons dashicons-games"></span>
										<figcaption>
											<h5 class="gameTitle white"><?= the_title() ?></h5>
										</figcaption>
										<?= the_content() ?>
									</figure>
							<?php
								}
							} else {
								// no posts found
								echo "not found";
							}
							/* Restore original Post Data */
							wp_reset_postdata();
							echo "</div>";
						}
						if ($page_data->ID == 210) { //shop merch

							$args = array(
								'post_type' => 'product',
								'posts_per_page' => 12
							);
							$loop = new WP_Query($args);
							if ($loop->have_posts()) {
								echo "<div class='productsContainer'>";
								while ($loop->have_posts()) : $loop->the_post();
									wc_get_template_part('content', 'product');
								endwhile;
								echo "</div>";
							} else {
								echo __('No products found');
							}
							wp_reset_postdata();
						}
						if ($page_data->ID == 160) { //Game Prices
							?>
							<div id="gamePrices">
								<figure>
									<figcaption><b>Hollow Knight</b></figcaption>
									<div class="icon">
										<svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300.000000 300.000000" preserveAspectRatio="xMidYMid meet">
											<g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
												<path d="M1073 2121 c-248 -118 -284 -449 -71 -659 l47 -46 3 -190 c3 -171 5 -196 25 -238 30 -66 96 -133 162 -165 56 -28 57 -28 261 -28 204 0 205 0 261 28 66 32 132 99 162 165 20 42 22 67 25 238 l3 191 40 38 c51 48 93 109 121 176 17 42 22 75 22 149 1 83 -2 102 -26 152 -15 32 -39 73 -53 92 -30 39 -113 97 -163 114 -64 22 -100 -25 -61 -79 18 -26 19 -33 8 -40 -8 -5 -17 -9 -21 -9 -4 0 -10 -11 -14 -25 -5 -20 1 -34 29 -64 67 -75 62 -204 -12 -300 l-18 -23 -74 17 c-122 29 -304 31 -428 6 -118 -25 -112 -28 -156 64 -43 87 -30 190 29 244 33 31 33 55 1 83 l-24 21 19 28 c25 34 25 44 0 69 -25 25 -23 25 -97 -9z m48 -55 c-27 -43 -26 -60 4 -76 l24 -13 -23 -28 c-39 -46 -59 -111 -54 -176 4 -62 40 -148 81 -197 l25 -28 112 22 c96 19 134 22 249 17 92 -3 158 -11 204 -25 65 -19 68 -19 91 -1 36 29 87 133 93 193 8 75 -2 117 -41 175 l-33 49 23 13 c29 15 30 32 3 75 -25 41 -18 42 47 4 156 -89 208 -279 124 -455 -22 -46 -53 -89 -92 -127 l-58 -58 0 -187 c0 -176 -2 -191 -24 -238 -29 -64 -77 -112 -141 -141 -47 -22 -62 -24 -235 -24 -173 0 -188 2 -235 24 -64 29 -112 77 -141 141 -22 47 -24 62 -24 238 l0 187 -58 58 c-152 149 -176 370 -56 511 32 37 125 101 147 101 5 0 -1 -15 -12 -34z"></path>
												<path d="M1241 1272 c-121 -62 -73 -287 58 -268 115 17 142 203 38 266 -39 24 -53 25 -96 2z m109 -50 c29 -36 28 -122 -2 -156 -57 -62 -148 -19 -148 70 0 24 5 54 11 67 25 55 102 66 139 19z"></path>
												<path d="M1663 1271 c-104 -65 -77 -250 38 -267 68 -10 129 57 129 142 0 103 -92 172 -167 125z m111 -52 c46 -55 27 -160 -32 -176 -70 -18 -112 20 -112 103 0 45 4 59 25 79 36 37 86 34 119 -6z"></path>
											</g>
										</svg>
									</div>
									<h4 class="price"><sup>$</sup>14,99</h4>
									<button><a href="https://store.steampowered.com/app/367520/Hollow_Knight/" target="_blank" class="purchase">Purchase</a></button>
								</figure>
								<figure>
									<figcaption><b>Silksong</b></figcaption>
									<div class="icon">
										<svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300.000000 300.000000" preserveAspectRatio="xMidYMid meet">
											<g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
												<path d="M1261 2330 c-57 -58 -121 -183 -170 -332 -81 -246 -94 -627 -30 -858 56 -202 211 -405 364 -476 64 -30 89 -30 155 3 115 57 259 225 322 376 92 216 101 591 24 888 -45 169 -132 348 -197 403 -63 54 -69 29 -34 -148 62 -310 26 -561 -99 -691 -66 -69 -117 -72 -186 -9 -128 116 -173 399 -109 694 28 130 30 173 8 178 -9 2 -31 -11 -48 -28z m548 -165 c51 -101 85 -207 113 -348 19 -94 22 -144 22 -312 0 -218 -17 -335 -65 -444 l-23 -54 -11 33 c-13 39 -58 80 -88 80 -39 -1 -102 -36 -138 -79 -41 -47 -59 -98 -59 -167 0 -80 55 -116 120 -79 46 26 42 15 -12 -31 -107 -92 -159 -106 -243 -65 -59 29 -160 109 -120 96 11 -4 36 -9 56 -12 30 -4 39 -1 57 22 65 82 -22 274 -137 305 -72 19 -130 -22 -131 -92 l-1 -23 -14 25 c-27 47 -63 175 -74 265 -26 214 -10 458 45 665 28 108 119 303 158 339 33 31 33 24 5 -112 -29 -137 -32 -381 -6 -475 40 -141 118 -254 198 -286 39 -16 43 -16 85 5 83 39 157 155 190 295 23 97 14 374 -15 492 -12 46 -21 91 -21 100 1 29 67 -57 109 -143z m-513 -1094 c69 -31 114 -109 114 -196 0 -57 -18 -72 -68 -57 -119 36 -212 219 -132 259 32 16 37 16 86 -6z m512 -8 c40 -54 -29 -182 -123 -229 -60 -29 -94 -26 -96 9 -6 81 19 154 68 200 51 47 122 57 151 20z"></path>
											</g>
										</svg>
									</div>
									<h4 class="price">TBA</h4>
									<button><a href="https://store.steampowered.com/app/1030300/Hollow_Knight_Silksong/" target="_blank" class="purchase">Wishlist now!</a></button>
								</figure>
							</div>
							<?php
						}
						if ($page_data->ID == 97) { //Team
							echo "<div class='usersContainer'>";
							$user_query = new WP_User_Query(array("role" => "Editor"));
							// var_dump($user_query->get_results());
							foreach ($user_query->get_results() as $user) {
							?>
								<figure class="user">
									<img class="userPicture" src="https://picsum.photos/id/1/400/500" alt="">
									<figcaption class="userInfo black">
										<p class="userName"><b><?= $user->display_name ?></b></p>
										<p class="userDescription"><?= $user->description  ?></p>
									</figcaption>
								</figure>
							<?php
							}
							echo "</div>";
						}
						if ($page_data->ID == 102) { //Porfolio
							?>
							<div id="porfolioOptions">
								<button autofocus id="btn-all">All</button>
								<button id="btn-hollowKnight">Hollow Knight</button>
								<button id="btn-silksong">Silksong</button>
							</div>
						<?php
							echo do_shortcode("[ngg src='galleries' ids='1' display='basic_thumbnail' thumbnail_crop='0']");
						}
						echo "</section>";
						if ($page_data->ID == 56) { //Awards
						?>
							<div id="awards">
								<figure>
									<span class="dashicons dashicons-awards"></span>
									<figcaption>
										awards winner
									</figcaption>
									<h2>54</h2>
								</figure>
								<figure>
									<span class="dashicons dashicons-yes"></span>
									<figcaption>
										jobs done
									</figcaption>
									<h2>1054</h2>
								</figure>
								<figure>
									<span class="dashicons dashicons-businessman"></span>
									<figcaption>
										happy clients
									</figcaption>
									<h2>120</h2>
								</figure>
								<figure>
									<span class="dashicons dashicons-portfolio"></span>
									<figcaption>
										reviews recived
									</figcaption>
									<h2>54</h2>
								</figure>
							</div>
							<?php }
						if ($page_data->ID == 171) { //Blog

							function myPosts()
							{
								echo "<div id='postsContainer'>";
								while (have_posts()) {
									the_post();
							?>
									<figure>
										<div class="postThumbnail" style="background-image: url('<?= get_the_post_thumbnail_url() ?>');"></div>
										<a href="<?= get_permalink() ?>">
											<figcaption>
												<p class="dataInfo"><?= get_the_date() ?> / by <?= get_the_author() ?></p>
												<h3><span class="dashicons dashicons-arrow-right"></span><?php the_title() ?></h3>
												<p class="theExcerpt"><?= get_the_excerpt() ?></p>
											</figcaption>
										</a>
									</figure>
					<?php
								}
								echo "</div>";
							}
							if (have_posts()) myPosts();
						}
						echo "</article>";
					}
					// Reviews
					?>
					<article id="reviews">
						<div class="slider">
							<div class="sliderComponent">
								<p><span class="dashicons dashicons-format-quote"></span>It's a deep dive into a dark place, and a brilliantly rich experience.<span class="dashicons dashicons-format-quote reverse"></span></p>
								<h5 class="author">GAME INFORMER</h5>
							</div>
							<div class="sliderComponent">
								<p><span class="dashicons dashicons-format-quote"></span>Truly a masterpiece of gaming if there ever was one, and certainly art worthy of being in a museum<span class="dashicons dashicons-format-quote reverse"></span></p>
								<h5 class="author">DESTRUCTOID</h5>
							</div>
							<div class="sliderComponent">
								<p><span class="dashicons dashicons-format-quote"></span>Best Platformer 2017 - The joy of Hollow Knight is the joy of discovery, always hard-earned, never handed to you.<span class="dashicons dashicons-format-quote reverse"></span></p>
								<h5 class="author">PC GAMER</h5>
							</div>
						</div>
					</article>
					<?php
					map();
					function map()
					{
						if (!get_theme_mod("maps_active")) return;
					?>
						<!-- maps -->
						<div id="map"></div>
						<script>
							// The location
							var place = {
								lat: <?= get_theme_mod("latitude") ?>,
								lng: <?= get_theme_mod("longitude") ?>,
							};
							// The map, centered
							map = new google.maps.Map(document.getElementById("map"), {
								center: place,
								zoom: <?= get_theme_mod("zoom") ?>,
							});

							// The marker, positioned
							var marker = new google.maps.Marker({
								position: place,
								map: map,
								animation: google.maps.Animation.DROP,
							});
						</script>
					<?php
					}
					?>


		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>