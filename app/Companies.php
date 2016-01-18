<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Companies extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id','name','description','address','mobile','opening_hours',
                           'email','long_term_deals', 'image_file_path', 'multiple_usage'];

    /**
     * @return array of companies with offers
     */
    public function getCompaniesAndOffers() {
        return  DB::table('offers')
            ->join('companies', 'companies.id', '=', 'offers.company_id')
            ->select('companies.name', 'offers.name AS offers_name', 'offers.is_super_deal')
            ->get();
    }

    /**
     * @return array of comapnies with used offers
     */
    public function getCompaniesWithUsedOffers() {
        return DB::table('offers')
            ->join('companies', 'companies.id', '=', 'offers.company_id')
            ->join('offers_used', 'offers_used.offer_id', '=', 'offers.id')
            ->select('companies.name', 'offers.name AS offers_name', 'offers.is_super_deal')
            ->get();
    }

    /**
     * @return array of companies with their offers counted
     */
    private function getCountedOffersForCompanies() {
        $companies = $this->getCompaniesAndOffers();
        $company_stats = array();

        foreach($companies as $key => $company) {
            if(!isset($company_stats[$company->name])) {
                $company_stats[$company->name] = array(
                    'offers' => [],
                    'total_deals' => 0,
                );
            }
            array_push($company_stats[$company->name]['offers'], array('name' => $company->offers_name, 'used' => 0));
            $company_stats[$company->name]['total_deals']++;
        }
        return $company_stats;
    }

    /**
     * @return array above + their used offers
     */
    public function getUsedOffersForCompanies() {
        $company_stats = $this->getCountedOffersForCompanies();
        $companies_offers_used = $this->getCompaniesWithUsedOffers();

        foreach($companies_offers_used as $company) {
            foreach($company_stats[$company->name]['offers'] as $index => $offers) {
                if($offers['name']===$company->offers_name) {
                    $company_stats[$company->name]['offers'][$index]['used']++;
                }
            }
        }
        return $company_stats;
    }


}
