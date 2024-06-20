<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ImageColumn;

class ImageFslightbox extends ImageColumn
{
    protected string | null $groupName = null;

    protected string $view = 'tables.columns.image-fslightbox';

    
    public function groupName(string | null $groupName): static
    {
        $this->groupName = $groupName;

        return $this;
    }

    public function getGroupName() :?string{
        return $this->groupName;
    }

}
