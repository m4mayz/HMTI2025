<?php
/**
 * The template for displaying 404 pages (not found)
 */
get_header();
?>

<!-- 404 Error Page -->
<section
    class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1a1a1a] via-[#222] to-[#2a2a2a] overflow-hidden ">
    <!-- Background Pattern -->
    <div
        class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS1vcGFjaXR5PSIwLjA1IiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-30">
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-20 left-10 w-32 h-32 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-40 h-40 bg-secondary/10 rounded-full blur-3xl animate-pulse"
        style="animation-delay: 1s;"></div>
    <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-primary/5 rounded-full blur-2xl animate-pulse"
        style="animation-delay: 0.5s;"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-24 relative z-10 pb-24 sm:pb-28 lg:pb-32">
        <div class="max-w-4xl mx-auto text-center">

            <!-- 404 Number -->
            <div class="mb-8 sm:mb-12 flex items-center justify-center">
                <div class="flex items-center justify-center gap-1 sm:gap-2 lg:gap-3 animate-fade-in">
                    <h1
                        class="font-title text-[120px] sm:text-[180px] lg:text-[240px] font-bold text-white/10 leading-none flex items-center">
                        4
                    </h1>
                    <div class="relative animate-fade-in-delay flex items-center justify-center">
                        <svg class="mt-20 w-24 h-24 sm:w-32 sm:h-32 lg:w-40 lg:h-40 text-primary" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 bg-primary/20 rounded-full blur-xl">
                            </div>
                        </div>
                    </div>
                    <h1
                        class="font-title text-[120px] sm:text-[180px] lg:text-[240px] font-bold text-white/10 leading-none flex items-center">
                        4
                    </h1>
                </div>
            </div>

            <!-- Error Message -->
            <div class="space-y-4 sm:space-y-6 mb-8 sm:mb-12 animate-fade-in-delay-2">
                <h2 class="font-title text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                    Oops! Halaman Tidak Ditemukan
                </h2>
                <p
                    class="font-body font-medium text-base sm:text-lg lg:text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin halaman tersebut telah dipindahkan atau
                    URL yang Anda masukkan salah.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-delay-3">
                <a href="<?php echo home_url('/'); ?>"
                    class="inline-flex items-center gap-3 bg-gradient-to-r from-primary to-primary-dark hover:from-primary-dark hover:to-primary text-white font-body font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>

                <button onclick="window.history.back()"
                    class="inline-flex items-center gap-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-body font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-full transition-all duration-300 border-2 border-white/30 hover:border-white/50 transform hover:scale-105 group">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Halaman Sebelumnya</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Custom Animations -->
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    .animate-fade-in-delay {
        animation: fadeIn 0.6s ease-out 0.2s both;
    }

    .animate-fade-in-delay-2 {
        animation: fadeIn 0.6s ease-out 0.4s both;
    }

    .animate-fade-in-delay-3 {
        animation: fadeIn 0.6s ease-out 0.6s both;
    }

    .animate-fade-in-delay-4 {
        animation: fadeIn 0.6s ease-out 0.8s both;
    }

    .animate-fade-in-delay-5 {
        animation: fadeIn 0.6s ease-out 1s both;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.6;
            transform: scale(1);
        }

        50% {
            opacity: 1;
            transform: scale(1.1);
        }
    }

    .animate-pulse {
        animation: pulse 3s ease-in-out infinite;
    }
</style>

<?php get_footer(); ?>