<?php

return [
    'APP_NAME' => 'Lets Connect',
    'error'=>[
        'option' => 'error',
        'title' => 'Error!',
    ],
    'success'=>[
        'option' => 'error',
        'title' => 'Success!',
    ],
    'export_filename_prefix' => 'lets-connect-',
    'CDN_URL' => 'https://media.ottomac.in/itc-pods/',
    'wati' => [
        'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJlNTQzZmYxZS04ZDI5LTQ5NmItYjZmZS0wYjdhOTBlZDZlMmUiLCJ1bmlxdWVfbmFtZSI6ImxldHNlbGV2YXRlMjAyNUBnbWFpbC5jb20iLCJuYW1laWQiOiJsZXRzZWxldmF0ZTIwMjVAZ21haWwuY29tIiwiZW1haWwiOiJsZXRzZWxldmF0ZTIwMjVAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDcvMTcvMjAyNSAwNDowMToxOCIsInRlbmFudF9pZCI6IjQ1NzQ2NSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.-2CGuOQvtCRhz3GTEQ_-5v5uljUuugUYyC_8YcTGjS8',
        'url'   => env('WATI_API_URL', 'https://app.wati.io/api/v1'),
        'token'
    ],
    'reward' =>[
        'wholesaler' => 200,
    ]
];
