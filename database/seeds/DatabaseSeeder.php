<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InformationSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PersonelSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PriceListSeeder::class);
        $this->call(PriceListDetailSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ReceiptCategorySeeder::class);
        $this->call(ReceiptStockSeeder::class);
        $this->call(ReceiptStockDetailSeeder::class);
        $this->call(DebtSeeder::class);
        $this->call(CashflowSeeder::class);



    }
}
