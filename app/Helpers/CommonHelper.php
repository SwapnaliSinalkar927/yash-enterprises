<?php

namespace App\Helpers;

use DB;

class CommonHelper
{
    public static function getAllTables()
    {
        if (auth()->user()->roles[0]->slug == 'super_admin') {
            $tables = [
                "codes",
                // "users",
                // "wds",
                "wholesalers",
                "orders",
                /*"wholesaler_login_histories",
                'multi_sheet_code',
                'daily_summary',
                'wholesaler_orders_per_week',
                // 'order_summary',
                'order_date_summary',
                "wholesaler_survey_details",*/

            ];
        } else {
            $tables = [
                "orders",
                "wholesalers",
            ];
        }

        // $additionalTables = [
        //     'master_reports',
        //     'summary_report'
        // ];

        // return array_merge($tables, $additionalTables);
         return array_merge($tables);
    }

    public static function ignoredTables()
    {
        return [
            'cache',
            'cache_locks',
            'failed_jobs',
            'jobs',
            'migrations',
            'password_reset_tokens',
            'permission_role',
            'permissions',
            'personal_access_tokens',
            'roles',
            'role_user',
            'users_roles',
            'cities',
            'states',
            'wholesaler_payment_details',
            's_m_s_histories',
            'login_histories',
            'payouts'
        ];
    }
}
