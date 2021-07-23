<?php

namespace App\Modules\Admin\Analytics\Export;

use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithHeadings
{
    private User $user;
    private string $date_start;
    private string $date_end;

    public function __construct(User $user, string $date_start, string $date_end)
    {
        $this->user = $user;
        $this->date_start = $date_start ? Carbon::parse($date_start) : new Carbon('first day of this month');
        $this->date_end = $date_end ? Carbon::parse($date_end) : new Carbon('last day of this month');
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        $leads = $this->getLeads();

        return $leads->map(function ($lead) {
            return [
                $lead->created_at->format('d.m.Y'),
                $lead->user->fullname,
                $lead->link,
                $lead->phone,
                $lead->source ?? '',
                $lead->unit ?? '',
                $lead->status->title_ru,
                $lead->is_quality_lead ? 'Да' : 'Нет',
                $lead->is_add_sale ? 'Да' : 'Нет'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Дата',
            'Менеджер',
            'Ссылка',
            'Телефон',
            'Источник',
            'Подразделение',
            'Статус',
            'Успешный ?',
            'Доп. продажа'
        ];
    }

    private function getLeads(): Collection
    {
        return $this->user
            ->leads()
            ->where('status_id', Status::DONE)
            ->whereDate('leads.created_at', '>=', $this->date_start)
            ->whereDate('leads.created_at', '<=', $this->date_end)
            ->with(['source', 'unit', 'user'])
            ->get();
    }
}
