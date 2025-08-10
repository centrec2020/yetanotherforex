<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            // Data from ureg-tech/fiddle.sql
            ['code' => 'USD', 'name' => 'US Dollar'],
            ['code' => 'EUR', 'name' => 'Euro'],
            ['code' => 'GBP', 'name' => 'British Pound'],
            ['code' => 'JPY', 'name' => 'Japanese Yen'],
            ['code' => 'AUD', 'name' => 'Australian Dollar'],

            // Additional Testing Data
            ['code' => 'CAD', 'name' => 'Canadian Dollar'],
            ['code' => 'CHF', 'name' => 'Swiss Franc'],
            ['code' => 'CNY', 'name' => 'Chinese Yuan'],
            ['code' => 'HKD', 'name' => 'Hong Kong Dollar'],
            ['code' => 'NZD', 'name' => 'New Zealand Dollar'],
            ['code' => 'SEK', 'name' => 'Swedish Krona'],
            ['code' => 'NOK', 'name' => 'Norwegian Krone'],
            ['code' => 'DKK', 'name' => 'Danish Krone'],
            ['code' => 'SGD', 'name' => 'Singapore Dollar'],
            ['code' => 'KRW', 'name' => 'South Korean Won'],
            ['code' => 'INR', 'name' => 'Indian Rupee'],
            ['code' => 'RUB', 'name' => 'Russian Ruble'],
            ['code' => 'BRL', 'name' => 'Brazilian Real'],
            ['code' => 'ZAR', 'name' => 'South African Rand'],
            ['code' => 'MXN', 'name' => 'Mexican Peso'],
            ['code' => 'TRY', 'name' => 'Turkish Lira'],
            ['code' => 'PLN', 'name' => 'Polish Zloty'],
            ['code' => 'TWD', 'name' => 'New Taiwan Dollar'],
            ['code' => 'THB', 'name' => 'Thai Baht'],
            ['code' => 'MYR', 'name' => 'Malaysian Ringgit'],
            ['code' => 'IDR', 'name' => 'Indonesian Rupiah'],
            ['code' => 'PHP', 'name' => 'Philippine Peso'],
            ['code' => 'VND', 'name' => 'Vietnamese Dong'],
            ['code' => 'AED', 'name' => 'UAE Dirham'],
            ['code' => 'SAR', 'name' => 'Saudi Riyal'],
            ['code' => 'QAR', 'name' => 'Qatari Riyal'],
            ['code' => 'KWD', 'name' => 'Kuwaiti Dinar'],
            ['code' => 'BHD', 'name' => 'Bahraini Dinar'],
            ['code' => 'OMR', 'name' => 'Omani Rial'],
            ['code' => 'EGP', 'name' => 'Egyptian Pound'],
            ['code' => 'ILS', 'name' => 'Israeli New Shekel'],
            ['code' => 'HUF', 'name' => 'Hungarian Forint'],
            ['code' => 'CZK', 'name' => 'Czech Koruna'],
            ['code' => 'RON', 'name' => 'Romanian Leu'],
            ['code' => 'UAH', 'name' => 'Ukrainian Hryvnia'],
            ['code' => 'KZT', 'name' => 'Kazakhstani Tenge'],
            ['code' => 'AZN', 'name' => 'Azerbaijani Manat'],
            ['code' => 'GEL', 'name' => 'Georgian Lari'],
            ['code' => 'NGN', 'name' => 'Nigerian Naira'],
            ['code' => 'KES', 'name' => 'Kenyan Shilling'],
            ['code' => 'GHS', 'name' => 'Ghanaian Cedi'],
            ['code' => 'MAD', 'name' => 'Moroccan Dirham'],
            ['code' => 'TND', 'name' => 'Tunisian Dinar'],
            ['code' => 'DZD', 'name' => 'Algerian Dinar'],
            ['code' => 'PKR', 'name' => 'Pakistani Rupee'],
            ['code' => 'LKR', 'name' => 'Sri Lankan Rupee'],
            ['code' => 'BDT', 'name' => 'Bangladeshi Taka'],
            ['code' => 'NPR', 'name' => 'Nepalese Rupee'],
            ['code' => 'CLP', 'name' => 'Chilean Peso'],
            ['code' => 'COP', 'name' => 'Colombian Peso'],
            ['code' => 'PEN', 'name' => 'Peruvian Sol'],
            ['code' => 'ARS', 'name' => 'Argentine Peso'],
            ['code' => 'UYU', 'name' => 'Uruguayan Peso'],
            ['code' => 'PYG', 'name' => 'Paraguayan Guarani'],
            ['code' => 'BOB', 'name' => 'Bolivian Boliviano'],
            ['code' => 'CRC', 'name' => 'Costa Rican Colón'],
            ['code' => 'DOP', 'name' => 'Dominican Peso'],
            ['code' => 'GTQ', 'name' => 'Guatemalan Quetzal'],
            ['code' => 'JMD', 'name' => 'Jamaican Dollar'],
            ['code' => 'TTD', 'name' => 'Trinidad and Tobago Dollar'],
            ['code' => 'XOF', 'name' => 'West African CFA Franc'],
            ['code' => 'XAF', 'name' => 'Central African CFA Franc'],
        ];

        DB::table('currencies')->upsert($currencies, ['code'], ['name']);
    }
}
