    <!-- Footer -->
    <footer class="bg-white  border-t border-slate-100 relative overflow-hidden">

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Footer 1 -->
                <div class="col-span-1 md:col-span-1">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    
                    <?php endif; ?>
                </div>

                <!-- Footer 2 -->
                <div class="col-span-1 md:col-span-2">
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <div class="footer-widget-area" style="display: flex;align-items:center;height: stretch;">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>
                   
                    <?php endif; ?>
                </div>

               
            </div>
            <div class="container border-t border-slate-100 py-2 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] text-slate-400 font-medium">
                <p><?php echo wp_kses_post( get_theme_mod( 'kermancopper_copyright_text','' ) ); ?></p>
                <div class="flex gap-6">
                    <span class="text-slate-500">طراحی و توسعه : <a href="https://ihasht.ir/" target="_blank" class="hover:text-copper transition-colors">هشت بهشت</a></span>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 left-8 bg-copper text-white p-3 rounded-full shadow-lg opacity-0 translate-y-10 transition-all duration-300 z-50 hover:bg-slate-800">
        <?php echo kermancopper_icon('arrow-up', 'w-5 h-5'); ?>
    </button>

    <?php wp_footer(); ?>
</body>
</html>
