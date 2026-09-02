<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id'        => '48e7f132-64d2-493e-9b5d-4aaeb608996c',
                'name'      => 'Dashboard Access',
                'slug'      => 'dashboard_access',
                'parent_id' => NULL,
            ],
            [
                'id'        => 'fb6e85b8-3e6b-487f-9358-9ee6f71506c7',
                'name'      => 'Export Access',
                'slug'      => 'export_access',
                'parent_id' => NULL,
            ],
            [
                'id'        => 'ff86227b-b3d8-49d2-96ae-37c5d4ed4f3a',
                'name'      => 'Export Create',
                'slug'      => 'export_create',
                'parent_id' => 'fb6e85b8-3e6b-487f-9358-9ee6f71506c7',
            ],
            [
                'id'        => 'cc31572f-49e7-4e4e-b8b0-85e2a23be09b',
                'name'      => 'User Management Access',
                'slug'      => 'user_management_access',
                'parent_id' => NULL,
            ],
            [
                'id'        => 'd924e0f2-a594-40d1-a5bf-67aef4ab5072',
                'name'      => 'Permission Access',
                'slug'      => 'permission_access',
                'parent_id' => 'cc31572f-49e7-4e4e-b8b0-85e2a23be09b',
            ],
            [
                'id'        => 'beed901a-469a-42a8-8d68-f5ae02e0bec6',
                'name'      => 'Permission Create',
                'slug'      => 'permission_create',
                'parent_id' => 'd924e0f2-a594-40d1-a5bf-67aef4ab5072',
            ],
            [
                'id'        => '5bd1e9e9-2d4f-48ea-be5a-2e218f328a6b',
                'name'      => 'Permission Edit',
                'slug'      => 'permission_edit',
                'parent_id' => 'd924e0f2-a594-40d1-a5bf-67aef4ab5072',
            ],
            [
                'id'        => '70577427-c6d6-4d9a-803e-c5ef4ddefe4a',
                'name'      => 'Permission Show',
                'slug'      => 'permission_show',
                'parent_id' => 'd924e0f2-a594-40d1-a5bf-67aef4ab5072',
            ],
            [
                'id'        => 'e9335a99-a802-4cdb-94ad-383812f28b92',
                'name'      => 'Permission Delete',
                'slug'      => 'permission_delete',
                'parent_id' => 'd924e0f2-a594-40d1-a5bf-67aef4ab5072',
            ],
            [
                'id'        => 'a03a05cf-f196-4954-aee5-cd5ac1a4e989',
                'name'      => 'Role Access',
                'slug'      => 'role_access',
                'parent_id' => 'cc31572f-49e7-4e4e-b8b0-85e2a23be09b',
            ],
            [
                'id'        => 'b3b6021c-f422-4db7-887b-bf183278e166',
                'name'      => 'Role Create',
                'slug'      => 'role_create',
                'parent_id' => 'a03a05cf-f196-4954-aee5-cd5ac1a4e989',
            ],
            [
                'id'        => 'bae31927-302d-415c-9c58-d8d615505fb6',
                'name'      => 'Role Edit',
                'slug'      => 'role_edit',
                'parent_id' => 'a03a05cf-f196-4954-aee5-cd5ac1a4e989',
            ],
            [
                'id'        => '6076f14e-7125-402d-821f-6402cf68d69a',
                'name'      => 'Role Show',
                'slug'      => 'role_show',
                'parent_id' => 'a03a05cf-f196-4954-aee5-cd5ac1a4e989',
            ],
            [
                'id'        => 'c1ebd8e6-6b2e-44ce-aa0a-44042999e68d',
                'name'      => 'Role Delete',
                'slug'      => 'role_delete',
                'parent_id' => 'a03a05cf-f196-4954-aee5-cd5ac1a4e989',
            ],
            [
                'id'        => '32254277-f7f1-40a6-a16b-37be06d20629',
                'name'      => 'User Access',
                'slug'      => 'user_access',
                'parent_id' => 'cc31572f-49e7-4e4e-b8b0-85e2a23be09b',
            ],
            [
                'id'        => '7b1493a4-fa14-45d5-ae23-50f7d98d473e',
                'name'      => 'User Create',
                'slug'      => 'user_create',
                'parent_id' => '32254277-f7f1-40a6-a16b-37be06d20629',
            ],
            [
                'id'        => 'f8d7c2fc-941d-4e91-8fec-c2d683069b6e',
                'name'      => 'User Edit',
                'slug'      => 'user_edit',
                'parent_id' => '32254277-f7f1-40a6-a16b-37be06d20629',
            ],
            [
                'id'        => 'f762b0f4-49c0-443d-9d54-674a8e81e2d2',
                'name'      => 'User Show',
                'slug'      => 'user_show',
                'parent_id' => '32254277-f7f1-40a6-a16b-37be06d20629',
            ],
            [
                'id'        => '4f504b5c-37c6-4576-91af-ba7e6465bf07',
                'name'      => 'User Delete',
                'slug'      => 'user_delete',
                'parent_id' => '32254277-f7f1-40a6-a16b-37be06d20629',
            ],
            [
                'id'        => '54c6c109-3248-441f-a40b-6bb33776453e',
                'name'      => 'Misc Access',
                'slug'      => 'misc_access',
                'parent_id' => NULL,
            ],
            [
                'id'        => '6998a1b5-2694-46ed-ab1d-3682fd25ccbb',
                'name'      => 'Login History Access',
                'slug'      => 'login_history_access',
                'parent_id' => '54c6c109-3248-441f-a40b-6bb33776453e',
            ],
            [
                'id'        => '4358a1b5-2694-46ed-ab1d-3682fd25fcdk',
                'name'      => 'Import Access',
                'slug'      => 'import_access',
                'parent_id' => NULL,
            ],
            // [
            //     'id'        => '8903j1b5-2694-46ed-ab1d-3682fd25fcdk',
            //     'name'      => 'Code Access',
            //     'slug'      => 'code_access',
            //     'parent_id' => NULL,
            // ],
            // [
            //     'id'        => '4629s1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'Code Create',
            //     'slug'      => 'code_create',
            //     'parent_id' => '8903j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            // [
            //     'id'        => '3429i1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'Code Show',
            //     'slug'      => 'code_show',
            //     'parent_id' => '8903j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            // [
            //     'id'        => '1250f1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'Code Change Access',
            //     'slug'      => 'code_change_access',
            //     'parent_id' => '8903j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            // [
            //     'id'        => '1232j1b5-2694-46ed-ab1d-3682fd25fcdk',
            //     'name'      => 'State Access',
            //     'slug'      => 'state_access',
            //     'parent_id' => NULL,
            // ],
            // [
            //     'id'        => '5678s1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'State Create',
            //     'slug'      => 'state_create',
            //     'parent_id' => '1232j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            // [
            //     'id'        => '5679i1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'State Show',
            //     'slug'      => 'state_show',
            //     'parent_id' => '1232j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            // [
            //     'id'        => '7643f1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'State Edit',
            //     'slug'      => 'state_edit',
            //     'parent_id' => '1232j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            // [
            //     'id'        => '6578j1b5-2694-46ed-ab1d-3682fd25fcdk',
            //     'name'      => 'City Access',
            //     'slug'      => 'city_access',
            //     'parent_id' => NULL,
            // ],
            // [
            //     'id'        => '5436s1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'City Create',
            //     'slug'      => 'city_create',
            //     'parent_id' => '6578j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            // [
            //     'id'        => '7890i1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'City Show',
            //     'slug'      => 'city_show',
            //     'parent_id' => '6578j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            // [
            //     'id'        => '5479f1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'City Edit',
            //     'slug'      => 'city_edit',
            //     'parent_id' => '6578j1b5-2694-46ed-ab1d-3682fd25fcdk',
            // ],
            [
                'id'        => '6570j1b5-2694-46ed-ab1d-3682fd25fcdk',
                'name'      => 'Latest WD Access',
                'slug'      => 'latest_wd_access',
                'parent_id' => NULL,
            ],
            [
                'id'        => '0921s1b5-2694-46ed-ab1d-3682fd25ccbb',
                'name'      => 'Brand Access',
                'slug'      => 'brand_access',
                'parent_id' => NULL,
            ],
            [
                'id'        => '8453i1b5-2694-46ed-ab1d-3682fd25ccbb',
                'name'      => 'Latest Code Access',
                'slug'      => 'latest_code_access',
                'parent_id' => NULL,
            ],
            [
                'id'        => '9538f1b5-2694-46ed-ab1d-3682fd25ccbb',
                'name'      => 'Latest Order Access',
                'slug'      => 'latest_order_access',
                'parent_id' => NULL,
            ],
            [
                'id'        => '6570j1b5-2694-46ed-ab1d-3682fd25erfd',
                'name'      => 'Latest Wholesaler Access',
                'slug'      => 'latest_wholesaler_access',
                'parent_id' => NULL,
            ],
            // [
            //     'id'        => '0921s1b5-2694-46ed-ab1d-3682fd23kdnc',
            //     'name'      => 'Latest Wholesaler Create',
            //     'slug'      => 'latest_wholesaler_create',
            //     'parent_id' => '6570j1b5-2694-46ed-ab1d-3682fd25erfd',
            // ],
            // [
            //     'id'        => '8453i1b5-2694-46ed-ab1d-3682fd67hnbd',
            //     'name'      => 'Latest Wholesaler Show',
            //     'slug'      => 'latest_wholesaler_show',
            //     'parent_id' => '6570j1b5-2694-46ed-ab1d-3682fd25erfd',
            // ],
            // [
            //     'id'        => '9538f1b5-2694-46ed-ab1d-3682fd39okdr',
            //     'name'      => 'Latest Wholesaler Edit',
            //     'slug'      => 'latest_wholesaler_edit',
            //     'parent_id' => '6570j1b5-2694-46ed-ab1d-3682fd25erfd',
            // ],
            // [
            //     'id'        => '3248a1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'Payout Access',
            //     'slug'      => 'payout_access',
            //     'parent_id' => NULL,
            // ],
            // [
            //     'id'        => '4358a1b5-2694-46ed-ab1d-3682fd25ccbb',
            //     'name'      => 'Payout Create',
            //     'slug'      => 'payout_create',
            //     'parent_id' => '3248a1b5-2694-46ed-ab1d-3682fd25ccbb',
            // ],
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }
    }
}
