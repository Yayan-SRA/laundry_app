<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }
    
    public function query()
    {
        return Transaction::query()->whereBetween('created_at', [$this->invoices[0], $this->invoices[1]])->latest();
    }

    public function map($transaction): array
    {
        if($transaction->cod == 1){
            $codResult = "Yes";
        } else{
            $codResult = "No";
        }
        if($transaction->is_done == 1){
            $isDoneResult = "Yes";
        } else{
            $isDoneResult = "No";
        }
        if($transaction->is_paid == 1){
            $isPaidResult = "Yes";
        } else{
            $isPaidResult = "No";
        }
        if($transaction->date_complete){
            $dateComplete = $transaction->date_complete;
        }else{
            $dateComplete = "Not finished yet";
        }
        return [
            // $transaction->count(),
            $transaction->key,
            $transaction->store->name,
            $transaction->staff_name,
            $transaction->customer->name,
            $transaction->type,
            $transaction->product,
            $transaction->service,
            $transaction->duration,
            $transaction->price,
            $transaction->quantity,
            $transaction->unit,
            $transaction->total_price,
            $transaction->created_at,
            $transaction->target_date_complete,
            $dateComplete,
            $isDoneResult,
            $codResult,
            $transaction->note,
            $isPaidResult,
        ];
    }

    public function headings(): array
    {
        return [
            // 'No',
            'Kode',
            'Store',
            'Staff Name',
            'Customer',
            'Type',
            'Product',
            'Service',
            'Duration',
            'Price',
            'Quantity',
            'Unit',
            'Total',
            'Date Entry',
            'Target Date Complete',
            'Date Complete',
            'Is Done',
            'COD',
            'Note',
            'Is Paid',
        ];
    }

}
