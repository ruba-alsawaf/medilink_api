<?php

namespace App\Constants;

class Constant
{
    public const CLINIC_TYPES = [
        'hospital',
        'lab',
        'clinic'
    ];

    public const DOCTOR_STATUSES = [
        'active',
        'inactive'
    ];

    public const ENTITY_ROLES = [
        'partner_admin',
        'clinic_admin',
        'doctor'
    ];

    public const MODEL_TYPES = [
        'Partner',
        'Clinic',
        'Doctor'
    ];
}
