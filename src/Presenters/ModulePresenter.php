<?php

namespace TypiCMS\Modules\Attributes\Presenters;

use TypiCMS\Modules\Core\Presenters\Presenter;

class ModulePresenter extends Presenter
{
	public function title() {
        return $this->entity->value;
    }
}
