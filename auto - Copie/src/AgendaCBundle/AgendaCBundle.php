<?php

namespace AgendaCBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
class AgendaCBundle extends Bundle
{
	public function getParent()
	{
		return 'BladeTesterCalendarBundle';
	}

}
