<?php

namespace Database\Seeders;

use App\Models\MailingList;
use App\Models\StaffEmail;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    public function run(): void
    {
        // Mailing List
        $mailingLists = [
            ['department' => 'All Department', 'email' => 'all@tangcity.com'],
            ['department' => 'Accounting', 'email' => 'accounting@tangcity.com'],
            ['department' => 'Assistant', 'email' => 'assistant@tangcity.com'],
            ['department' => 'Building Manager', 'email' => 'bm@tangcity.com'],
            ['department' => 'Cashier', 'email' => 'cashier@tangcity.com'],
            ['department' => 'Collection', 'email' => 'collection@tangcity.com'],
            ['department' => 'Community Relation', 'email' => 'comrell@tangcity.com'],
            ['department' => 'Direksi', 'email' => 'director@tangcity.com'],
            ['department' => 'Engineering', 'email' => 'engineering@tangcity.com'],
            ['department' => 'Finance', 'email' => 'finance@tangcity.com'],
            ['department' => 'Fitout', 'email' => 'fitout@tangcity.com'],
            ['department' => 'Human Resource', 'email' => 'hr@tangcity.com'],
            ['department' => 'IT', 'email' => 'it@tangcity.com'],
            ['department' => 'Legal', 'email' => 'legal@tangcity.com'],
            ['department' => 'Marketing', 'email' => 'marketing@tangcity.com'],
            ['department' => 'Operational', 'email' => 'operational@tangcity.com'],
            ['department' => 'Parking', 'email' => 'parking@tangcity.com'],
            ['department' => 'Purchasing', 'email' => 'purchasing@tangcity.com'],
            ['department' => 'Security', 'email' => 'security@tangcity.com'],
            ['department' => 'Tax', 'email' => 'tax@tangcity.com'],
        ];

        foreach ($mailingLists as $item) {
            MailingList::create($item);
        }

        // Staff Emails (email_workspace = null for staff without Google Workspace)
        $staffData = [
            // Direksi - semua punya workspace
            ['nama' => 'Alexander Bambang', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Direksi', 'email' => 'alexander@tangcity.com', 'email_workspace' => 'alexander@tangcitymall.com'],
            ['nama' => 'Calvin Lukmantara', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Direksi', 'email' => 'calvin@tangcity.com', 'email_workspace' => 'calvin@tangcitymall.com'],
            ['nama' => 'Norman Eka Saputra', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Direksi', 'email' => 'eka@tangcity.com', 'email_workspace' => 'eka@tangcitymall.com'],
            ['nama' => 'Robert Yapari', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Direksi', 'email' => 'robert@tangcity.com', 'email_workspace' => 'robert@tangcitymall.com'],
            ['nama' => 'Ian Wisan', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Direksi', 'email' => 'ian@tangcity.com', 'email_workspace' => 'ian@tangcitymall.com'],
            ['nama' => 'Sugiyanto Lie', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Direksi', 'email' => 'sugi@tangcity.com', 'email_workspace' => 'sugi@tangcitymall.com'],
            // Building Manager
            ['nama' => 'Rawanto', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Building Manager', 'email' => 'rawanto@tangcity.com', 'email_workspace' => 'rawanto@tangcitymall.com'],
            // Assistant - sebagian punya workspace
            ['nama' => 'Ang Chen Lie', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Assistant', 'email' => 'chenlie@tangcity.com', 'email_workspace' => 'chenlie@tangcitymall.com'],
            ['nama' => 'Diyah Susilowati', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Assistant', 'email' => 'diyah@tangcity.com', 'email_workspace' => 'diyah@tangcitymall.com'],
            ['nama' => 'Maritza Antalia Sutikja', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Assistant', 'email' => 'maritza@tangcity.com', 'email_workspace' => 'maritza@tangcitymall.com'],
            ['nama' => 'Melanie Yusuf', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Assistant', 'email' => 'melanie@tangcity.com', 'email_workspace' => 'melanie@tangcitymall.com'],
            ['nama' => 'Nadia Ratnaningtias', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Assistant', 'email' => 'nadia@tangcity.com', 'email_workspace' => 'nadia@tangcitymall.com'],
            ['nama' => 'Selvyra Ciptadi', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Assistant', 'email' => 'selvyra@tangcity.com', 'email_workspace' => 'selvyra@tangcitymall.com'],
            ['nama' => 'Wenny Rosseno', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Assistant', 'email' => 'wenny@tangcity.com', 'email_workspace' => 'wenny@tangcitymall.com'],
            // Accounting
            ['nama' => 'Susanty', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Accounting', 'email' => 'pfsusanty@tangcity.com', 'email_workspace' => 'pfsusanty@tangcitymall.com'],
            ['nama' => 'Dewi Anggraeni', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Accounting', 'email' => 'dewi@tangcity.com', 'email_workspace' => 'dewi@tangcitymall.com'],
            ['nama' => 'Fiona Amelia', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Accounting', 'email' => 'fiona@tangcity.com', 'email_workspace' => 'fiona@tangcitymall.com'],
            // Collection
            ['nama' => 'Kurniawan Sasmita', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Collection', 'email' => 'kurniawan@tangcity.com', 'email_workspace' => 'kurniawan@tangcitymall.com'],
            ['nama' => 'Randi Permana', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Collection', 'email' => 'randi@tangcity.com', 'email_workspace' => 'randi@tangcitymall.com'],
            ['nama' => 'Toni Andrean', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Collection', 'email' => 'toni@tangcity.com', 'email_workspace' => 'toni@tangcitymall.com'],
            // Engineering
            ['nama' => 'Budi Santoso', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Engineering', 'email' => 'budi@tangcity.com', 'email_workspace' => 'budi@tangcitymall.com'],
            ['nama' => 'Hendra Wijaya', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Engineering', 'email' => 'hendra@tangcity.com', 'email_workspace' => 'hendra@tangcitymall.com'],
            ['nama' => 'Rizky Pratama', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Engineering', 'email' => 'rizky@tangcity.com', 'email_workspace' => 'rizky@tangcitymall.com'],
            // Finance
            ['nama' => 'Ayu Lestari', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Finance', 'email' => 'ayu@tangcity.com', 'email_workspace' => 'ayu@tangcitymall.com'],
            ['nama' => 'Cindy Putri', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Finance', 'email' => 'cindy@tangcity.com', 'email_workspace' => 'cindy@tangcitymall.com'],
            // Human Resource
            ['nama' => 'Sandra Wulandari', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Human Resource', 'email' => 'sandra@tangcity.com', 'email_workspace' => 'sandra@tangcitymall.com'],
            ['nama' => 'Yuni Ariani', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Human Resource', 'email' => 'yuni@tangcity.com', 'email_workspace' => 'yuni@tangcitymall.com'],
            // IT
            ['nama' => 'Andi Firmansyah', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'IT', 'email' => 'andi@tangcity.com', 'email_workspace' => 'andi@tangcitymall.com'],
            ['nama' => 'Deni Kusuma', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'IT', 'email' => 'deni@tangcity.com', 'email_workspace' => 'deni@tangcitymall.com'],
            // Legal
            ['nama' => 'Putri Handayani', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Legal', 'email' => 'putri@tangcity.com', 'email_workspace' => 'putri@tangcitymall.com'],
            // Marketing
            ['nama' => 'Fitri Maharani', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Marketing', 'email' => 'fitri@tangcity.com', 'email_workspace' => 'fitri@tangcitymall.com'],
            ['nama' => 'Gita Puspita', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Marketing', 'email' => 'gita@tangcity.com', 'email_workspace' => 'gita@tangcitymall.com'],
            ['nama' => 'Lestari Dewi', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Marketing', 'email' => 'lestari@tangcity.com', 'email_workspace' => 'lestari@tangcitymall.com'],
            // Cashier
            ['nama' => 'Rina Oktavia', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Cashier', 'email' => 'rina@tangcity.com', 'email_workspace' => 'rina@tangcitymall.com'],
            ['nama' => 'Sari Indah', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Cashier', 'email' => 'sari@tangcity.com', 'email_workspace' => 'sari@tangcitymall.com'],
            // Operational
            ['nama' => 'Agus Setiawan', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Operational', 'email' => 'agus@tangcity.com', 'email_workspace' => 'agus@tangcitymall.com'],
            ['nama' => 'Bambang Sutrisno', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Operational', 'email' => 'bambang@tangcity.com', 'email_workspace' => 'bambang@tangcitymall.com'],
            // Purchasing
            ['nama' => 'Eko Prasetyo', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Purchasing', 'email' => 'eko@tangcity.com', 'email_workspace' => 'eko@tangcitymall.com'],
            // Community Relation
            ['nama' => 'Hani Rahmawati', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Community Relation', 'email' => 'hani@tangcity.com', 'email_workspace' => 'hani@tangcitymall.com'],
            ['nama' => 'Intan Permata', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Community Relation', 'email' => 'intan@tangcity.com', 'email_workspace' => 'intan@tangcitymall.com'],
            // Tax
            ['nama' => 'Joko Susilo', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Tax', 'email' => 'joko@tangcity.com', 'email_workspace' => 'joko@tangcitymall.com'],
            // Parking
            ['nama' => 'Kevin Halim', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Parking', 'email' => 'kevin@tangcity.com', 'email_workspace' => 'kevin@tangcitymall.com'],
            // Fitout
            ['nama' => 'Lukman Hakim', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Fitout', 'email' => 'lukman@tangcity.com', 'email_workspace' => 'lukman@tangcitymall.com'],
            // Security
            ['nama' => 'Maman Abdurrahman', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Security', 'email' => 'maman@tangcity.com', 'email_workspace' => 'maman@tangcitymall.com'],
            // Tambahan workspace supaya genap 50
            ['nama' => 'Nova Sari', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Marketing', 'email' => 'nova@tangcity.com', 'email_workspace' => 'nova@tangcitymall.com'],
            ['nama' => 'Oscar Pratama', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'IT', 'email' => 'oscar@tangcity.com', 'email_workspace' => 'oscar@tangcitymall.com'],
            ['nama' => 'Pramudya Aji', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Engineering', 'email' => 'pramudya@tangcity.com', 'email_workspace' => 'pramudya@tangcitymall.com'],
            ['nama' => 'Qori Annisa', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Finance', 'email' => 'qori@tangcity.com', 'email_workspace' => 'qori@tangcitymall.com'],
            ['nama' => 'Reza Mahendra', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Accounting', 'email' => 'reza@tangcity.com', 'email_workspace' => 'reza@tangcitymall.com'],
            // Staff TANPA workspace
            ['nama' => 'Suharto Binsamin', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Security', 'email' => 'suharto@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Teguh Santoso', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Security', 'email' => 'teguh@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Usman Harun', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Parking', 'email' => 'usman@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Vina Kartika', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Cashier', 'email' => 'vina@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Wahyu Nugroho', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Operational', 'email' => 'wahyu@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Xandra Putri', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Collection', 'email' => 'xandra@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Yogi Pratama', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Engineering', 'email' => 'yogi@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Zahra Aulia', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Human Resource', 'email' => 'zahra@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Arif Budiman', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Fitout', 'email' => 'arif@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Bayu Setiadi', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Parking', 'email' => 'bayu@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Candra Wijaya', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Security', 'email' => 'candra@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Dede Suryana', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Operational', 'email' => 'dede@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Elisa Santika', 'pt' => 'PT Estate Facility Management', 'departemen' => 'Cashier', 'email' => 'elisa@tangcity.com', 'email_workspace' => null],
            ['nama' => 'Ferdy Gunawan', 'pt' => 'PT Pancakarya Griyatama', 'departemen' => 'Engineering', 'email' => 'ferdy@tangcity.com', 'email_workspace' => null],
        ];

        foreach ($staffData as $item) {
            StaffEmail::create($item);
        }
    }
}
