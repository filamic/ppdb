<?php
 
namespace App\Filament\Operator\Pages;

use App\Models\Student;
use Filament\Actions\Action;
use App\Models\ViolationType;
use Filament\Facades\Filament;
use App\Models\StudentViolation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use App\Filament\PointSystem\Resources\ViolationTypeResource;
use App\Filament\PointSystem\Resources\StudentViolationResource;
 
class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'icon-s-home';


    public function getSubheading(): string|\Illuminate\Contracts\Support\Htmlable|null{
        dd(Filament::getTenant());
        return new HtmlString('
            Statistik Pelanggaran Siswa 📈
            
        ');
        // <img src="'.asset('notebook.svg').'" alt="" srcset="" class="size-40">    
        
    }

}