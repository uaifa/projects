<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $currencies = [
            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'British Pound', 'code' => 'GBP', 'symbol' => '£', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'South African Rand', 'code' => 'ZAR', 'symbol' => 'R', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Danish Krone', 'code' => 'DKK', 'symbol' => 'kr', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Israeli Shekel', 'code' => 'ILS', 'symbol' => 'NIS ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Swedish Krona', 'code' => 'SEK', 'symbol' => 'kr', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Kenyan Shilling', 'code' => 'KES', 'symbol' => 'KSh ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Canadian Dollar', 'code' => 'CAD', 'symbol' => 'C$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Philippine Peso', 'code' => 'PHP', 'symbol' => 'P ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Indian Rupee', 'code' => 'INR', 'symbol' => 'Rs. ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Australian Dollar', 'code' => 'AUD', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Singapore Dollar', 'code' => 'SGD', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Norske Kroner', 'code' => 'NOK', 'symbol' => 'kr', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'New Zealand Dollar', 'code' => 'NZD', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Vietnamese Dong', 'code' => 'VND', 'symbol' => '', 'precision' => '0', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Swiss Franc', 'code' => 'CHF', 'symbol' => '', 'precision' => '2', 'thousand_separator' => '\'', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Guatemalan Quetzal', 'code' => 'GTQ', 'symbol' => 'Q', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Malaysian Ringgit', 'code' => 'MYR', 'symbol' => 'RM', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Brazilian Real', 'code' => 'BRL', 'symbol' => 'R$', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Thai Baht', 'code' => 'THB', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Nigerian Naira', 'code' => 'NGN', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Argentine Peso', 'code' => 'ARS', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Bangladeshi Taka', 'code' => 'BDT', 'symbol' => 'Tk', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'United Arab Emirates Dirham', 'code' => 'AED', 'symbol' => 'DH ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Hong Kong Dollar', 'code' => 'HKD', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Indonesian Rupiah', 'code' => 'IDR', 'symbol' => 'Rp', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Mexican Peso', 'code' => 'MXN', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Egyptian Pound', 'code' => 'EGP', 'symbol' => 'E£', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Colombian Peso', 'code' => 'COP', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'West African Franc', 'code' => 'XOF', 'symbol' => 'CFA ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Chinese Renminbi', 'code' => 'CNY', 'symbol' => 'RMB ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Rwandan Franc', 'code' => 'RWF', 'symbol' => 'RF ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Tanzanian Shilling', 'code' => 'TZS', 'symbol' => 'TSh ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Netherlands Antillean Guilder', 'code' => 'ANG', 'symbol' => '', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Trinidad and Tobago Dollar', 'code' => 'TTD', 'symbol' => 'TT$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'East Caribbean Dollar', 'code' => 'XCD', 'symbol' => 'EC$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Ghanaian Cedi', 'code' => 'GHS', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Bulgarian Lev', 'code' => 'BGN', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ' ', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Aruban Florin', 'code' => 'AWG', 'symbol' => 'Afl. ', 'precision' => '2', 'thousand_separator' => ' ', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Turkish Lira', 'code' => 'TRY', 'symbol' => 'TL ', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Romanian New Leu', 'code' => 'RON', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Croatian Kuna', 'code' => 'HRK', 'symbol' => 'kn', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Saudi Riyal', 'code' => 'SAR', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥', 'precision' => '0', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Maldivian Rufiyaa', 'code' => 'MVR', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Costa Rican Colón', 'code' => 'CRC', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Pakistani Rupee', 'code' => 'PKR', 'symbol' => 'Rs ', 'precision' => '0', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Polish Zloty', 'code' => 'PLN', 'symbol' => 'zł', 'precision' => '2', 'thousand_separator' => ' ', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Sri Lankan Rupee', 'code' => 'LKR', 'symbol' => 'LKR', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Czech Koruna', 'code' => 'CZK', 'symbol' => 'Kč', 'precision' => '2', 'thousand_separator' => ' ', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Uruguayan Peso', 'code' => 'UYU', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Namibian Dollar', 'code' => 'NAD', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Tunisian Dinar', 'code' => 'TND', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Russian Ruble', 'code' => 'RUB', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Mozambican Metical', 'code' => 'MZN', 'symbol' => 'MT', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Omani Rial', 'code' => 'OMR', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Ukrainian Hryvnia', 'code' => 'UAH', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Macanese Pataca', 'code' => 'MOP', 'symbol' => 'MOP$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Taiwan New Dollar', 'code' => 'TWD', 'symbol' => 'NT$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Dominican Peso', 'code' => 'DOP', 'symbol' => 'RD$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Chilean Peso', 'code' => 'CLP', 'symbol' => '$', 'precision' => '0', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Icelandic Króna', 'code' => 'ISK', 'symbol' => 'kr', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Papua New Guinean Kina', 'code' => 'PGK', 'symbol' => 'K', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Jordanian Dinar', 'code' => 'JOD', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Myanmar Kyat', 'code' => 'MMK', 'symbol' => 'K', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Peruvian Sol', 'code' => 'PEN', 'symbol' => 'S/ ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Botswana Pula', 'code' => 'BWP', 'symbol' => 'P', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Hungarian Forint', 'code' => 'HUF', 'symbol' => 'Ft', 'precision' => '0', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Ugandan Shilling', 'code' => 'UGX', 'symbol' => 'USh ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Barbadian Dollar', 'code' => 'BBD', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Brunei Dollar', 'code' => 'BND', 'symbol' => 'B$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Georgian Lari', 'code' => 'GEL', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ' ', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Qatari Riyal', 'code' => 'QAR', 'symbol' => 'QR', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Honduran Lempira', 'code' => 'HNL', 'symbol' => 'L', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Surinamese Dollar', 'code' => 'SRD', 'symbol' => 'SRD', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Bahraini Dinar', 'code' => 'BHD', 'symbol' => 'BD ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Venezuelan Bolivars', 'code' => 'VES', 'symbol' => 'Bs.', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'South Korean Won', 'code' => 'KRW', 'symbol' => 'W ', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Moroccan Dirham', 'code' => 'MAD', 'symbol' => 'MAD ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Jamaican Dollar', 'code' => 'JMD', 'symbol' => '$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Angolan Kwanza', 'code' => 'AOA', 'symbol' => 'Kz', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Haitian Gourde', 'code' => 'HTG', 'symbol' => 'G', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Zambian Kwacha', 'code' => 'ZMW', 'symbol' => 'ZK', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Nepalese Rupee', 'code' => 'NPR', 'symbol' => 'Rs. ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'CFP Franc', 'code' => 'XPF', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true], // precision should be zero
            ['name' => 'Mauritian Rupee', 'code' => 'MUR', 'symbol' => 'Rs', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Cape Verdean Escudo', 'code' => 'CVE', 'symbol' => '', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => '$', 'swap_currency_symbol' => true],
            ['name' => 'Kuwaiti Dinar', 'code' => 'KWD', 'symbol' => 'KD', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Algerian Dinar', 'code' => 'DZD', 'symbol' => 'DA', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Macedonian Denar', 'code' => 'MKD', 'symbol' => 'ден', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Fijian Dollar', 'code' => 'FJD', 'symbol' => 'FJ$', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Bolivian Boliviano', 'code' => 'BOB', 'symbol' => 'Bs', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Albanian Lek', 'code' => 'ALL', 'symbol' => 'L ', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Serbian Dinar', 'code' => 'RSD', 'symbol' => 'din', 'precision' => '2', 'thousand_separator' => '.', 'decimal_separator' => ',', 'swap_currency_symbol' => true],
            ['name' => 'Lebanese Pound', 'code' => 'LBP', 'symbol' => 'LL ', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Armenian Dram', 'code' => 'AMD', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Azerbaijan Manat', 'code' => 'AZN', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Bosnia and Herzegovina Convertible Mark', 'code' => 'BAM', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Belarusian Ruble', 'code' => 'BYN', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Gibraltar Pound', 'code' => 'GIP', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Moldovan Leu', 'code' => 'MDL', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Kazakhstani Tenge', 'code' => 'KZT', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
            ['name' => 'Ethiopian Birr', 'code' => 'ETB', 'symbol' => '', 'precision' => '2', 'thousand_separator' => ',', 'decimal_separator' => '.', 'swap_currency_symbol' => true],
        ];

        Currency::insert($currencies);
    }
}