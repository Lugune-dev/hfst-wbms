<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('Hope for Students Tanzania (HFST)'))</title>
    <meta name="description" content="@yield('description', 'Supporting students in Tanzania with education, books, and uniforms.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700,800,900" rel="stylesheet" />

    <!-- Theme init: apply saved theme before CSS loads to avoid flash -->
    <script>
        (function(){
            try{
                var stored = localStorage.getItem('hfst_theme');
                var applyTheme = function(theme){
                    if(theme === 'system' || !theme){
                        document.documentElement.removeAttribute('data-theme');
                        var isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                        document.documentElement.classList.toggle('dark', isDark);
                    } else {
                        document.documentElement.setAttribute('data-theme', theme);
                        document.documentElement.classList.toggle('dark', theme === 'dark');
                    }
                };
                applyTheme(stored || 'system');
                if(window.matchMedia){
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e){
                        var t = localStorage.getItem('hfst_theme') || 'system';
                        if(t === 'system') applyTheme('system');
                    });
                }
            }catch(e){}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/filament/filament/app.css') }}">
    @livewireStyles
</head>
<body class="font-sans antialiased hfst-body flex flex-col min-h-screen">

    <!-- ======================================================
         VERTICAL SOCIAL SIDEBAR (Fixed Right)
    ====================================================== -->
    <div class="social-sidebar" aria-label="Social media links">
        <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook" class="social-icon">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
            </svg>
        </a>
        <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Instagram" class="social-icon">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
        </a>
        <a href="https://youtube.com" target="_blank" rel="noopener" aria-label="YouTube" class="social-icon">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
            </svg>
        </a>
        <a href="mailto:info@hfst.co.tz" aria-label="Email" class="social-icon">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
        </a>
    </div>

    <!-- ======================================================
         NAVIGATION BAR
    ====================================================== -->
    <nav class="hfst-nav" id="main-nav" role="navigation" aria-label="Main navigation">
        <div class="nav-container">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="nav-logo-link" aria-label="HFST Home">
                <div class="nav-logo-ring">
                    <img src="{{ asset('images/logo.png') }}" alt="HFST Logo" class="nav-logo-img">
                </div>
                <div class="nav-brand-text">
                    <span class="nav-brand-name">HFST</span>
                    <span class="nav-brand-tagline">Hope for Students</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="nav-links" role="menubar">
                <a href="{{ route('home') }}"     class="nav-link {{ request()->routeIs('home') ? 'nav-link--active' : '' }}" role="menuitem">{{ __('nav.home') }}</a>
                <a href="{{ route('about') }}"    class="nav-link {{ request()->routeIs('about') ? 'nav-link--active' : '' }}" role="menuitem">{{ __('nav.about') }}</a>
                <a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects','programs') ? 'nav-link--active' : '' }}" role="menuitem">{{ __('nav.projects') }}</a>
                <a href="{{ route('news') }}"     class="nav-link {{ request()->routeIs('news') ? 'nav-link--active' : '' }}" role="menuitem">{{ __('nav.news') }}</a>
                <a href="{{ route('donate') }}"   class="nav-link nav-link--donate {{ request()->routeIs('donate') ? 'nav-link--active' : '' }}" role="menuitem">{{ __('nav.donate') }}</a>
                <a href="{{ route('contact') }}"  class="nav-link {{ request()->routeIs('contact') ? 'nav-link--active' : '' }}" role="menuitem">{{ __('nav.contact') }}</a>
            </div>

            <!-- Right Controls -->
            <div class="nav-controls">
                <!-- Language Switcher -->
                <div class="lang-switcher" id="lang-switcher">
                    <button class="lang-btn" id="lang-toggle-btn" aria-haspopup="listbox" aria-expanded="false" aria-label="{{ __('nav.language') }}">
                        @php
                            $localeLabels = ['en' => '🇬🇧 EN', 'sw' => '🇹🇿 SW', 'fr' => '🇫🇷 FR'];
                            $currentLocale = app()->getLocale();
                        @endphp
                        <span>{{ $localeLabels[$currentLocale] ?? '🇬🇧 EN' }}</span>
                        <svg class="lang-chevron" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    <div class="lang-dropdown" id="lang-dropdown" role="listbox" aria-label="Select language">
                        <form method="POST" action="{{ route('language.switch', 'en') }}" id="lang-form-en">@csrf</form>
                        <form method="POST" action="{{ route('language.switch', 'sw') }}" id="lang-form-sw">@csrf</form>
                        <form method="POST" action="{{ route('language.switch', 'fr') }}" id="lang-form-fr">@csrf</form>
                        <button type="button" onclick="document.getElementById('lang-form-en').submit()" class="lang-option {{ $currentLocale === 'en' ? 'lang-option--active' : '' }}" role="option">🇬🇧 English</button>
                        <button type="button" onclick="document.getElementById('lang-form-sw').submit()" class="lang-option {{ $currentLocale === 'sw' ? 'lang-option--active' : '' }}" role="option">🇹🇿 Kiswahili</button>
                        <button type="button" onclick="document.getElementById('lang-form-fr').submit()" class="lang-option {{ $currentLocale === 'fr' ? 'lang-option--active' : '' }}" role="option">🇫🇷 Français</button>
                    </div>
                </div>

                <!-- Theme Toggle -->
                <button id="theme-toggle" aria-label="{{ __('nav.theme') }}" class="theme-btn">
                    <span id="theme-toggle-icon">🌙</span>
                </button>

                <!-- Login CTA -->
                <a href="/login" class="nav-cta-btn">{{ __('nav.login') }}</a>

                <!-- Mobile Hamburger -->
                <button class="hamburger-btn" id="mobile-menu-btn" aria-label="{{ __('nav.open_menu') }}" aria-expanded="false" aria-controls="mobile-menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div class="mobile-drawer" id="mobile-menu" aria-hidden="true">
            <div class="mobile-drawer-inner">
                <div class="mobile-nav-links">
                    <a href="{{ route('home') }}"     class="mobile-nav-link {{ request()->routeIs('home') ? 'mobile-nav-link--active' : '' }}">{{ __('nav.home') }}</a>
                    <a href="{{ route('about') }}"    class="mobile-nav-link {{ request()->routeIs('about') ? 'mobile-nav-link--active' : '' }}">{{ __('nav.about') }}</a>
                    <a href="{{ route('projects') }}" class="mobile-nav-link {{ request()->routeIs('projects','programs') ? 'mobile-nav-link--active' : '' }}">{{ __('nav.projects') }}</a>
                    <a href="{{ route('news') }}"     class="mobile-nav-link {{ request()->routeIs('news') ? 'mobile-nav-link--active' : '' }}">{{ __('nav.news') }}</a>
                    <a href="{{ route('donate') }}"   class="mobile-nav-link mobile-nav-link--donate {{ request()->routeIs('donate') ? 'mobile-nav-link--active' : '' }}">{{ __('nav.donate') }}</a>
                    <a href="{{ route('contact') }}"  class="mobile-nav-link {{ request()->routeIs('contact') ? 'mobile-nav-link--active' : '' }}">{{ __('nav.contact') }}</a>
                </div>
                <div class="mobile-lang-btns">
                    <form method="POST" action="{{ route('language.switch', 'en') }}">@csrf<button class="mobile-lang-btn {{ $currentLocale === 'en' ? 'mobile-lang-btn--active' : '' }}">🇬🇧 EN</button></form>
                    <form method="POST" action="{{ route('language.switch', 'sw') }}">@csrf<button class="mobile-lang-btn {{ $currentLocale === 'sw' ? 'mobile-lang-btn--active' : '' }}">🇹🇿 SW</button></form>
                    <form method="POST" action="{{ route('language.switch', 'fr') }}">@csrf<button class="mobile-lang-btn {{ $currentLocale === 'fr' ? 'mobile-lang-btn--active' : '' }}">🇫🇷 FR</button></form>
                </div>
                <div class="mobile-portal-links">
                    <a href="/donor"   class="mobile-portal-link">{{ __('nav.donor_portal') }}</a>
                    <a href="/student" class="mobile-portal-link">{{ __('nav.student_portal') }}</a>
                    <a href="/login"   class="mobile-cta-btn">{{ __('nav.login') }}</a>
                </div>
                <!-- Mobile Social -->
                <div class="mobile-social-row">
                    <a href="https://facebook.com" target="_blank" class="mobile-social-icon" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="mobile-social-icon" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://youtube.com" target="_blank" class="mobile-social-icon" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="mailto:info@hfst.co.tz" class="mobile-social-icon" aria-label="Email">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow hfst-main" id="main-content">
        @yield('content')
    </main>

    <!-- ======================================================
         FOOTER
    ====================================================== -->
    <footer class="hfst-footer">
        <div class="footer-container">
            <div class="footer-grid">
                <!-- Brand -->
                <div class="footer-brand-col">
                    <div class="footer-logo-row">
                        <img src="{{ asset('images/logo.png') }}" alt="HFST Logo" class="footer-logo">
                        <span class="footer-brand-name">Hope for Students Tanzania</span>
                    </div>
                    <p class="footer-desc">{{ __('footer.description') }}</p>
                </div>
                <!-- Quick Links -->
                <div>
                    <h4 class="footer-col-title">{{ __('footer.quick_links') }}</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}" class="footer-link">{{ __('nav.about') }}</a></li>
                        <li><a href="{{ route('projects') }}" class="footer-link">{{ __('nav.projects') }}</a></li>
                        <li><a href="{{ route('news') }}" class="footer-link">{{ __('nav.news') }}</a></li>
                        <li><a href="{{ route('donate') }}" class="footer-link">{{ __('nav.donate') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-link">{{ __('nav.contact') }}</a></li>
                    </ul>
                </div>
                <!-- Portals -->
                <div>
                    <h4 class="footer-col-title">{{ __('footer.portals') }}</h4>
                    <ul class="footer-links">
                        <li><a href="/donor"   class="footer-link">{{ __('footer.donor_dashboard') }}</a></li>
                        <li><a href="/student" class="footer-link">{{ __('footer.student_access') }}</a></li>
                        <li><a href="/admin"   class="footer-link">{{ __('footer.staff_login') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ __('footer.copyright') }}</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script src="{{ asset('js/filament/support/support.js') }}" defer></script>

    <script>
    (function(){
        /* ---- Theme ---- */
        var icons = { light: '☀️', dark: '🌙', system: '🖥️' };
        function getStored(){ try{ return localStorage.getItem('hfst_theme') || 'system'; }catch(e){ return 'system'; } }
        function applyTheme(theme){
            if(theme === 'system' || !theme){
                document.documentElement.removeAttribute('data-theme');
                var isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.classList.toggle('dark', isDark);
            } else {
                document.documentElement.setAttribute('data-theme', theme);
                document.documentElement.classList.toggle('dark', theme === 'dark');
            }
        }
        function updateThemeIcon(){
            var icon = document.getElementById('theme-toggle-icon');
            if(!icon) return;
            var t = getStored();
            icon.textContent = icons[t] || icons.system;
        }
        function nextTheme(curr){ return (curr === 'system') ? 'light' : (curr === 'light') ? 'dark' : 'system'; }

        /* ---- Language Dropdown ---- */
        function initLangDropdown(){
            var btn = document.getElementById('lang-toggle-btn');
            var dd  = document.getElementById('lang-dropdown');
            if(!btn || !dd) return;
            btn.addEventListener('click', function(e){
                e.stopPropagation();
                var open = dd.classList.toggle('lang-dropdown--open');
                btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
            document.addEventListener('click', function(){
                dd.classList.remove('lang-dropdown--open');
                btn.setAttribute('aria-expanded', 'false');
            });
        }

        /* ---- Mobile Drawer ---- */
        function initMobileMenu(){
            var mBtn    = document.getElementById('mobile-menu-btn');
            var drawer  = document.getElementById('mobile-menu');
            if(!mBtn || !drawer) return;
            mBtn.addEventListener('click', function(){
                var open = drawer.classList.toggle('mobile-drawer--open');
                mBtn.classList.toggle('hamburger-btn--open', open);
                mBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
                drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
                document.body.style.overflow = open ? 'hidden' : '';
            });
        }

        /* ---- Navbar Scroll Effect ---- */
        function initNavScroll(){
            var nav = document.getElementById('main-nav');
            if(!nav) return;
            window.addEventListener('scroll', function(){
                nav.classList.toggle('hfst-nav--scrolled', window.scrollY > 20);
            }, {passive: true});
        }

        document.addEventListener('DOMContentLoaded', function(){
            applyTheme(getStored());
            updateThemeIcon();

            var themeBtn = document.getElementById('theme-toggle');
            if(themeBtn){
                themeBtn.addEventListener('click', function(){
                    var next = nextTheme(getStored());
                    try{ localStorage.setItem('hfst_theme', next); }catch(e){}
                    applyTheme(next);
                    updateThemeIcon();
                });
            }

            if(window.matchMedia){
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(){
                    if(getStored() === 'system') applyTheme('system');
                });
            }

            initLangDropdown();
            initMobileMenu();
            initNavScroll();
        });
    })();
    </script>

    @stack('scripts')
</body>
</html>
