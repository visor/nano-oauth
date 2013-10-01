<?php /** @var \Module\Oauth\Service[] $services */ ?>
<strong>Login via:</strong><br />
<?php foreach ($services as $service): ?>
	<a href="<?php echo $service->getAuthoirizeUrl(\Module\Oauth\Scope::EMAIL); ?>"><?php echo $service->getName(); ?></a><br />
<?php endforeach ?>