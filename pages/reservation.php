<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Karnak Temple Details - Go Egypt</title>
    
    <!-- External CSS & Fonts -->
    <link href="reservation.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;family=Playfair+Display:wght@600;700&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS Script & Config -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#d1c5b4",
                        "secondary-fixed": "#e5e2dc",
                        "surface-bright": "#fff8f3",
                        "primary": "#775a19",
                        "surface-container": "#f8ecdd",
                        "tertiary-container": "#aaa4a0",
                        "surface-tint": "#775a19",
                        "inverse-surface": "#363025",
                        "on-tertiary-fixed": "#1e1b18",
                        "on-background": "#201b12",
                        "secondary": "#5f5e5a",
                        "primary-fixed-dim": "#e9c176",
                        "on-secondary-fixed": "#1c1c18",
                        "surface-container-high": "#f2e6d7",
                        "on-surface-variant": "#4e4639",
                        "surface": "#fff8f3",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-secondary": "#ffffff",
                        "primary-container": "#c5a059",
                        "secondary-container": "#e5e2dc",
                        "tertiary-fixed-dim": "#ccc5c1",
                        "tertiary-fixed": "#e8e1dc",
                        "outline": "#7f7667",
                        "on-tertiary-container": "#3e3a37",
                        "surface-dim": "#e4d8c9",
                        "on-error": "#ffffff",
                        "inverse-primary": "#e9c176",
                        "error": "#ba1a1a",
                        "tertiary": "#625e5a",
                        "on-tertiary": "#ffffff",
                        "primary-fixed": "#ffdea5",
                        "background": "#fff8f3",
                        "on-secondary-container": "#656460",
                        "on-surface": "#201b12",
                        "surface-variant": "#ece1d2",
                        "on-primary-container": "#4e3700",
                        "on-tertiary-fixed-variant": "#4a4643",
                        "inverse-on-surface": "#fbefe0",
                        "surface-container-highest": "#ece1d2",
                        "surface-container-low": "#fef2e2",
                        "on-primary-fixed-variant": "#5d4201",
                        "on-primary": "#ffffff",
                        "secondary-fixed-dim": "#c9c6c1",
                        "error-container": "#ffdad6",
                        "on-primary-fixed": "#261900",
                        "on-secondary-fixed-variant": "#474743"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin-mobile": "16px",
                        "margin-desktop": "64px",
                        "container-max": "1280px",
                        "unit": "8px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "display-lg": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"],
                        "display-lg-mobile": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "label-caps": ["Inter"]
                    },
                    "fontSize": {
                        "display-lg": ["64px", { "lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-lg": ["48px", { "lineHeight": "56px", "fontWeight": "600" }],
                        "display-lg-mobile": ["40px", { "lineHeight": "48px", "fontWeight": "700" }],
                        "headline-md": ["32px", { "lineHeight": "40px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "label-caps": ["12px", { "lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "600" }]
                    }
                },
            },
        }
    </script>
</head>
<body class="pb-[180px] md:pb-0">
    <!-- TopAppBar (Mobile context) -->
    <header class="md:hidden bg-surface/80 dark:bg-surface-dim/80 backdrop-blur-md fixed top-0 w-full z-50 bg-transparent flex items-center justify-between px-margin-mobile w-full h-16 transition-all duration-300 ease-in-out">
        <button class="text-on-surface-variant dark:text-on-surface-variant hover:opacity-80 transition-opacity duration-300">
            <span class="material-symbols-outlined">arrow_back</span>
        </button>
        <h1 class="font-headline-md text-headline-md text-primary dark:text-primary-fixed-dim">Heritage Detail</h1>
        <button class="text-on-surface-variant dark:text-on-surface-variant hover:opacity-80 transition-opacity duration-300">
            <span class="material-symbols-outlined">share</span>
        </button>
    </header>

    <!-- Desktop Nav Fallback -->
    <header class="hidden md:flex fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-md border-b border-outline-variant px-margin-desktop h-20 items-center justify-between">
        <h1 class="font-display-lg text-primary text-2xl">Go Egypt</h1>
        <nav class="flex gap-gutter">
            <a class="font-label-caps text-label-caps text-on-surface hover:text-primary transition-colors" href="#">Explore</a>
            <a class="font-label-caps text-label-caps text-primary border-b-2 border-primary pb-1" href="#">Bookings</a>
            <a class="font-label-caps text-label-caps text-on-surface hover:text-primary transition-colors" href="#">Saved</a>
            <a class="font-label-caps text-label-caps text-on-surface hover:text-primary transition-colors" href="#">Profile</a>
        </nav>
    </header>

    <main class="w-full md:max-w-container-max md:mx-auto md:pt-24">
        <!-- Hero Section -->
        <section class="relative w-full h-[530px] md:h-[618px] md:rounded-xl overflow-hidden mt-0 md:mt-8">
            <img alt="Karnak Temple" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzZnWdXRxs7j4RUvXD2tuCuaABXTjgqoGXIeIFJ_8RYDEE_pVK2TLLnOiSrIstZ00lydXM7btIE--W6nPM68o-wQWpBIzfTzFfyeisOWLQhDzWG17G_AxC1ljxo8lfLsTm8bXXLJjGqa-YBRFRAD-k0H8aG19vA7LwJt-zKFurzahGSxRJX34fy5odpXPfhL0wIHh6xnZQMNys9dfFxFwQd16KTdG2h2BzZwG-6jRFU6xGhzPRrrs1rw"/>
            <div class="absolute inset-0 bg-gradient-to-t from-inverse-surface/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full p-margin-mobile md:p-margin-desktop flex flex-col gap-unit text-on-primary">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-fixed text-sm">location_on</span>
                    <span class="font-body-md text-body-md text-surface-container-low">Luxor, Egypt</span>
                </div>
                <h1 class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg text-surface-container-lowest">Karnak Temple Complex</h1>
                <div class="flex items-center gap-2 mt-2 bg-surface/20 backdrop-blur-sm w-fit px-3 py-1 rounded-full">
                    <span class="material-symbols-outlined text-primary-fixed text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="font-label-caps text-label-caps text-surface-container-lowest">4.9 (2,400+ Reviews)</span>
                </div>
            </div>
        </section>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter px-margin-mobile md:px-margin-desktop py-8 md:py-16">
            <!-- Main Content Area -->
            <div class="md:col-span-8 flex flex-col gap-8 md:gap-12">
                <!-- Quick Info Bar -->
                <div class="flex flex-row flex-wrap gap-4 md:gap-8 border-b border-outline-variant pb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">schedule</span>
                        </div>
                        <div>
                            <p class="font-label-caps text-label-caps text-on-surface-variant">Opening Hours</p>
                            <p class="font-body-md text-body-md text-on-surface font-semibold">6:00 AM - 5:30 PM</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">local_activity</span>
                        </div>
                        <div>
                            <p class="font-label-caps text-label-caps text-on-surface-variant">Entry Fee</p>
                            <p class="font-body-md text-body-md text-on-surface font-semibold">From 200 EGP</p>
                        </div>
                    </div>
                </div>

                <!-- Overview Section -->
                <section class="flex flex-col gap-4">
                    <h2 class="font-headline-md text-headline-md text-on-surface">Historical Grandeur</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        Karnak is not just a temple; it is an extraordinary open-air museum and the largest religious building ever constructed. Built over 2,000 years by generations of pharaohs, it stands as a testament to the immense power and devotion of ancient Egypt. 
                    </p>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mt-2">
                        Wander through the Great Hypostyle Hall, a forest of 134 massive sandstone columns towering reaching towards the heavens. Each pillar is intricately carved with scenes of gods and kings, preserving the history of a civilization in stone.
                    </p>
                </section>

                <!-- Gallery -->
                <section class="flex flex-col gap-4 -mx-margin-mobile md:mx-0 px-margin-mobile md:px-0">
                    <h3 class="font-body-lg text-body-lg text-on-surface font-semibold">Visual Journey</h3>
                    <div class="flex overflow-x-auto gap-4 pb-4 hide-scrollbar snap-x">
                        <img alt="Temple Columns" class="w-64 h-80 object-cover rounded-lg snap-center flex-shrink-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCMiGn0DIK42tnm495ocfIYUS3AojDEhLbyD95P5suFIJ6a91g2KmQ21KGIFOIwqTq9OTNkP729hKJIfiagOgZ0J-8MMuiQqP8dQs3HNh3TBWfAhgOYolub1VZNGfLTmKqfrL_b428EoRbJDIgkfwGZa6JhxY4ZZMGt3I74AO-_QdFp6TGv0OVXMcgPogMckWoGIo3D52EjEeEzhsCn4edYDrHQ0As1gUBtaLfaJpT9FTGTvGU3nRs4w"/>
                        <img alt="Hypostyle Hall" class="w-64 h-80 object-cover rounded-lg snap-center flex-shrink-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6YmWU-JT-t_d3wB3JbjsKUYBe6_wQ0UUOAVTHpkxaI_kS1W4v4zplF23dCA_z1UXb7imXWZsFW14dZDzjmCLbfsKPDR1oWKtsN7fl1oW7ipOst6uA_wIGoPe5LRqayU0UAQAdC5CcsMc3fa0sxqQa7g2z6g-Y7BjODKfjwbQ-Dbi-5lBiLd1GNRi2n-7-Ax83nuWdeBw38xzlklyuxBnDHN-TH7wWk0PAN1UfBkP_bW8XFBg1bl9z_g"/>
                        <img alt="Obelisk" class="w-64 h-80 object-cover rounded-lg snap-center flex-shrink-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxe9srmS9lCurZpvD-YS6pFOW6UTeXghusEi2yuuC8FOc9kTmGzgXGxe7urQe_rjDKm9SwbpLE0kwTW0eWRB2f5ebm9vHmc3QR3Q9nCrT06doXz3GLyDOfeSdZtBE-CSC8EWrqD3dA2Mzsv2geyRWVLdfnCJyIP5xEwNnNmeWPlx__XvBOhN372e02kKNor39mdFuv7sg5ZXzYpsVpl3ls1re6zP2cWQsH-Pm50lAbtouDujfXulG20A"/>
                    </div>
                </section>
            </div>

            <!-- Booking Widget -->
            <div class="md:col-span-4">
                <div class="fixed bottom-16 md:bottom-auto md:sticky md:top-28 left-0 w-full md:w-auto bg-surface-container-lowest/95 backdrop-blur-md md:rounded-xl md:border md:border-outline-variant p-margin-mobile md:p-6 booking-glow md:shadow-[0_4px_40px_rgba(44,41,38,0.05)] z-40">
                    <h3 class="hidden md:block font-headline-md text-headline-md text-on-surface mb-6">Plan Your Visit</h3>
                    <div class="flex flex-col gap-4">
                        <!-- Date Selection -->
                        <div class="flex flex-col gap-1">
                            <label class="font-label-caps text-label-caps text-on-surface-variant">Select Date</label>
                            <div class="flex items-center border-b border-outline-variant py-2">
                                <span class="material-symbols-outlined text-secondary mr-2">calendar_today</span>
                                <input class="w-full bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md text-on-surface" type="date" value="2024-05-15"/>
                            </div>
                        </div>

                        <!-- Ticket Counters -->
                        <div class="flex flex-col gap-3 mt-2">
                            <!-- Adult -->
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-body-md text-body-md text-on-surface">Adults</p>
                                    <p class="font-label-caps text-label-caps text-on-surface-variant">400 EGP</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button class="w-8 h-8 rounded-full border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-container transition-colors">-</button>
                                    <span class="font-body-md text-body-md font-semibold w-4 text-center">2</span>
                                    <button class="w-8 h-8 rounded-full border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-container transition-colors">+</button>
                                </div>
                            </div>
                            <!-- Student -->
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-body-md text-body-md text-on-surface">Students</p>
                                    <p class="font-label-caps text-label-caps text-on-surface-variant">200 EGP</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button class="w-8 h-8 rounded-full border border-outline-variant flex items-center justify-center text-outline hover:bg-surface-container transition-colors">-</button>
                                    <span class="font-body-md text-body-md font-semibold w-4 text-center">0</span>
                                    <button class="w-8 h-8 rounded-full border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-container transition-colors">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Total & Action -->
                        <div class="mt-4 pt-4 border-t border-outline-variant flex justify-between items-center md:flex-col md:items-stretch md:gap-4">
                            <div class="md:flex md:justify-between">
                                <span class="font-label-caps text-label-caps text-on-surface-variant">Total</span>
                                <span class="font-headline-md text-headline-md md:font-body-lg md:text-body-lg md:font-semibold text-primary">800 EGP</span>
                            </div>
                            <button class="bg-primary-container text-on-primary-container font-label-caps text-label-caps py-3 px-6 rounded-full hover:opacity-90 transition-opacity whitespace-nowrap">
                                BOOK TICKETS NOW
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- BottomNavBar (Mobile context) -->
    <nav class="md:hidden bg-surface dark:bg-surface-dim font-label-caps text-label-caps text-primary fixed bottom-0 w-full z-50 rounded-t-full shadow-sm bg-surface dark:bg-surface-container shadow-[0_-4px_40px_rgba(44,41,38,0.05)] scale-95 active:scale-90 transition-transform duration-300 fixed bottom-0 left-0 w-full flex justify-around items-center py-4 px-margin-mobile bg-surface dark:bg-surface-dim">
        <a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed-dim" href="#">
            <span class="material-symbols-outlined">explore</span>
            <span class="mt-1">Explore</span>
        </a>
        <a class="flex flex-col items-center justify-center text-primary dark:text-primary-fixed-dim relative after:content-[''] after:absolute after:-bottom-1 after:w-1 after:h-1 after:bg-primary after:rounded-full hover:text-primary dark:hover:text-primary-fixed-dim" href="#">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">confirmation_number</span>
            <span class="mt-1">Bookings</span>
        </a>
        <a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed-dim" href="#">
            <span class="material-symbols-outlined">favorite</span>
            <span class="mt-1">Saved</span>
        </a>
        <a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed-dim" href="#">
            <span class="material-symbols-outlined">person</span>
            <span class="mt-1">Profile</span>
        </a>
    </nav>
</body>
</html>