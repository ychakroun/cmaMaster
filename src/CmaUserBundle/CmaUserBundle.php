<?php

namespace CmaUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CmaUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
