<?php

use App\Models\Aspiration;

return [
    // Array status dipakai di controller/view (sesuai instruksi: gunakan array).
    'statuses' => [
        Aspiration::STATUS_BARU => 'Baru',
        Aspiration::STATUS_DIPROSES => 'Diproses',
        Aspiration::STATUS_SELESAI => 'Selesai',
        Aspiration::STATUS_DITOLAK => 'Ditolak',
    ],
];



