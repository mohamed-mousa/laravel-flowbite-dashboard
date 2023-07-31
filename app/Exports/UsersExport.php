<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromQuery, WithHeadings, withMapping, ShouldAutoSize
{

    use Exportable;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function query()
    {
        if ($this->ids) {
            return User::query()->whereIn('id', $this->ids);
        } else {
            return User::query();
        }
    }

    public function headings(): array
    {
        return [
            __('messages.users.username'),
            __('messages.users.email'),
            __('messages.users.type'),
            __('messages.users.phone'),
            __('messages.users.created'),
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->type == 1 ? __('messages.users.admin') : __('messages.users.user'),
            $user->phone,
            $user->created_at->format('Y-m-d'),
        ];
    }
}
