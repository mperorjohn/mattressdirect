	<!-- Start Testimonial Slider -->
	<div class="testimonial-section before-footer-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 mx-auto text-center">
					<h2 class="section-title">Reviews</h2>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-12">
					<div class="testimonial-slider-wrap text-center">

						<div id="testimonial-nav">
							<span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
							<span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
						</div>

						<div class="testimonial-slider">
							
							<div class="item">
								<div class="row justify-content-center">
									<div class="col-lg-8 mx-auto">

										<div class="testimonial-block text-center">
											<blockquote class="mb-5">
												<p>&ldquo;This mattress has completely transformed my sleep quality. The support and comfort are unparalleled. I wake up feeling refreshed and ready to tackle the day. Highly recommend to anyone looking for a great night's sleep!&rdquo;</p>
											</blockquote>

											<div class="author-info">
												<div class="author-pic">
													<img src="images/john.png" alt="joh" class="img-fluid">
												</div>
												<h3 class="font-weight-bold">John Jones</h3>
												<span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
												<?php
												$rating = 3; 
												?>
												<div class="star-rating">
													<?php for ($i = 1; $i <= 5; $i++): ?>
														<span class="fa fa-star <?php echo $i <= $rating ? 'checked' : ''; ?>"></span>
													<?php endfor; ?>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div> 
							<!-- END item -->

							<div class="item">
								<div class="row justify-content-center">
									<div class="col-lg-8 mx-auto">

										<div class="testimonial-block text-center">
											<blockquote class="mb-5">
												<p>&ldquo;I have never experienced such comfort and support from a mattress before. It has significantly improved my sleep quality and overall well-being. I highly recommend this mattress to anyone in need of a restful night's sleep.&rdquo;</p>
											</blockquote>

											<div class="author-info">
												<div class="author-pic">
													<img src="images/john.png" alt="Maria Jones" class="img-fluid">
												</div>
												<h3 class="font-weight-bold">John Oyekola</h3>
												<span class="position d-block mb-3">Engr.</span>
												<?php
												$rating = 5; 
												?>
												<div class="star-rating">
													<?php for ($i = 1; $i <= 5; $i++): ?>
														<span class="fa fa-star <?php echo $i <= $rating ? 'checked' : ''; ?>"></span>
													<?php endfor; ?>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div> 
							<!-- END item -->

							<div class="item">
								<div class="row justify-content-center">
									<div class="col-lg-8 mx-auto">

										<div class="testimonial-block text-center">
											<blockquote class="mb-5">
												<p>&ldquo;This mattress is a game-changer! The perfect balance of firmness and softness has alleviated my back pain and improved my sleep quality immensely. I can't imagine going back to my old mattress. Highly recommended for anyone seeking a better night's rest.&rdquo;</p>
											</blockquote>

											<div class="author-info">
												<div class="author-pic">
													<img src="images/john.png" alt="Maria Jones" class="img-fluid">
												</div>
												<h3 class="font-weight-bold">John Oyekola</h3>
												<span class="position d-block mb-3">Developer, MattressDirect</span>
												<?php
												$rating = 4; 
												?>
												<div class="star-rating">
													<?php for ($i = 1; $i <= 5; $i++): ?>
														<span class="fa fa-star <?php echo $i <= $rating ? 'checked' : ''; ?>"></span>
													<?php endfor; ?>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div> 
							<!-- END item -->

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Testimonial Slider -->

	<style>
		.checked {
			color: #DCDC00;
		}
	</style>