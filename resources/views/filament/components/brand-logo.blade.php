@php
    $panelId = filament()->getId();
    $locale = app()->getLocale();
    $isSw = ($locale === 'sw');

    $panelNames = [
        'admin'   => $isSw ? 'Usimamizi wa Juu' : 'Admin Executive',
        'donor'   => $isSw ? 'Lango la Mfadhili' : 'Donor Impact',
        'staff'   => $isSw ? 'Watumishi & Miradi' : 'Staff Operations',
        'student' => $isSw ? 'Lango la Mwanafunzi' : 'Student Beneficiary',
        'teacher' => $isSw ? 'Walimu & Shule' : 'School Teacher',
    ];

    $panelBadges = [
        'admin'   => $isSw ? '🛡️ LANGO KUU LA USIMAMIZI' : '🛡️ ADMIN EXECUTIVE GATEWAY',
        'donor'   => $isSw ? '💛 LANGO LA WAFADHILI & ATHARI' : '💛 DONOR IMPACT GATEWAY',
        'staff'   => $isSw ? '📋 LANGO LA WATUMISHI NA UENDESHAJI' : '📋 STAFF OPERATIONS GATEWAY',
        'student' => $isSw ? '🎓 LANGO LA WANAFUNZI NA WANUFAIKA' : '🎓 STUDENT BENEFICIARY GATEWAY',
        'teacher' => $isSw ? '🏫 LANGO LA WALIMU NA SHULE WASHIRIKA' : '🏫 SCHOOL TEACHER GATEWAY',
    ];

    $currentPanelName = $panelNames[$panelId] ?? 'HFST Portal';
    $currentBadge = $panelBadges[$panelId] ?? 'HFST SECURE PORTAL';
@endphp

<div class="hfst-brand-root group">
    {{-- Modern High-Definition Emblem --}}
    <div class="hfst-emblem-wrap">
        <div class="hfst-emblem-halo"></div>
        <div class="hfst-emblem-box">
            <img 
                src="{{ asset('images/logo.png') }}" 
                alt="HFST Logo" 
                class="hfst-emblem-img"
            />
        </div>
    </div>

    {{-- Typography Lockup for Dashboard Sidebar & Topbar --}}
    <div class="hfst-brand-info">
        <div class="hfst-brand-title-row">
            <span class="hfst-brand-title">HFST</span>
            <span class="hfst-status-pulse" title="{{ $isSw ? 'Mfumo Uko Hewani' : 'System Live' }}"></span>
        </div>
        <span class="hfst-brand-subtitle">{{ $currentPanelName }}</span>
    </div>

    {{-- Auth & Login Dedicated Lockup --}}
    <div class="hfst-auth-brand-info">
        <div class="hfst-auth-org-title">HOPE FOR STUDENTS</div>
        <div class="hfst-auth-org-subtitle">TANZANIA &bull; EDUCATION EMPOWERMENT</div>
        <div class="hfst-auth-gateway-badge">
            {{ $currentBadge }}
        </div>
    </div>
</div>
