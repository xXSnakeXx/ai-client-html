<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2016
 */

$enc = $this->encoder();

$basketTarget = $this->config( 'client/html/basket/standard/url/target' );
$basketController = $this->config( 'client/html/basket/standard/url/controller', 'basket' );
$basketAction = $this->config( 'client/html/basket/standard/url/action', 'index' );
$basketConfig = $this->config( 'client/html/basket/standard/url/config', [] );

$checkoutTarget = $this->config( 'client/html/checkout/standard/url/target' );
$checkoutController = $this->config( 'client/html/checkout/standard/url/controller', 'checkout' );
$checkoutAction = $this->config( 'client/html/checkout/standard/url/action', 'index' );
$checkoutConfig = $this->config( 'client/html/checkout/standard/url/config', [] );

$optTarget = $this->config( 'client/jsonapi/url/options/target' );
$optController = $this->config( 'client/jsonapi/url/options/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/options/action', 'index' );
$optConfig = $this->config( 'client/jsonapi/url/options/config', [] );


$link = true;
$stepActive = $this->get( 'standardStepActive', false );


?>
<section class="aimeos checkout-standard" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optController, $optAction, [], [], $optConfig ) ); ?>">

	<nav>
		<ol class="steps">

			<li class="step basket active">
				<a href="<?= $enc->attr( $this->url( $basketTarget, $basketController, $basketAction, [], [], $basketConfig ) ); ?>">
					<?= $enc->html( $this->translate( 'client', 'Basket' ), $enc::TRUST ); ?>
				</a>
			</li>

			<?php foreach( $this->get( 'standardSteps', [] ) as $name ) : ?>
				<?php
					$class = '';

					if( $stepActive )
					{
						if( $name === $stepActive )
						{
							$class .= ' current';
							$link = false;
						}

						if( $link === true ) {
							$class .= ' active';
						}
					}
				?>

				<li class="step <?= $name . $class; ?>">

					<?php if( $stepActive && $link ) : ?>
						<a href="<?= $enc->attr( $this->url( $checkoutTarget, $checkoutController, $checkoutAction, array( 'c_step' => $name ), [], $checkoutConfig ) ); ?>">
							<?= $enc->html( $this->translate( 'client', $name ) ); ?>
						</a>
					<?php else : ?>
						<?= $enc->html( $this->translate( 'client', $name ) ); ?>
					<?php endif; ?>
				</li>

			<?php endforeach; ?>

		</ol>
	</nav>


	<?php if( isset( $this->standardErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->standardErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>


	<form method="<?= $enc->attr( $this->get( 'standardMethod', 'POST' ) ); ?>" action="<?= $enc->attr( $this->get( 'standardUrlNext' ) ); ?>">
		<?= $this->csrf()->formfield(); ?>
		<?= $this->get( 'standardBody' ); ?>
	</form>

</section>
