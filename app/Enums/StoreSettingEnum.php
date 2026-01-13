<?php

namespace App\Enums;

enum StoreSettingEnum: string
{
    case SIMPLE_TRANSACTION = 'simple_transaction';
    case USE_QRIS = 'use_qris';
    case USE_BANKS = 'use_banks';
    case USE_EVIDENCE = 'use_evidence';
    case USE_PRINTER = 'use_printer';

    public function label(): string
    {
        return match ($this) {
            self::SIMPLE_TRANSACTION => 'Transaksi sederhana',
            self::USE_QRIS => 'Pembayaran QRIS',
            self::USE_BANKS => 'Gunakan rekening bank',
            self::USE_EVIDENCE => 'Bukti transaksi',
            self::USE_PRINTER => 'Gunakan printer',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::SIMPLE_TRANSACTION => 'Mode transaksi sederhana tanpa perlu memilih produk.',
            self::USE_QRIS => 'Pembayaran melalui QRIS, memungkinkan aplikasi untuk membuat QRIS sesuai nominal transaksi.',
            self::USE_BANKS => 'Pembayaran menggunakan transfer rekening bank. Kamu harus membuat list rekening bank terlebih dahulu.',
            self::USE_EVIDENCE => 'Mewajibkan user melampirkan bukti transaksi pada saat mengakhiri transaksi.',
            self::USE_PRINTER => 'Memungkinkan kamu untuk mencetak struk transaksi dengan buetooth thermal printer.',
        };
    }

    public static function list(): array
    {
        $result = [];

        foreach (StoreSettingEnum::cases() as $case) {
            $result[] = [
                'key' => $case->value,
                'label' => $case->label(),
                'description' => $case->description(),
            ];
        }

        return $result;
    }
}
