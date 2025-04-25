<?php
/**
 * Plantilla para mostrar un mensaje cuando no hay contenido coincidente
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="no-results not-found">
    <div class="card">
        <div class="card-body">
            <div class="page-content">
                <?php if (is_search()) : ?>
                    
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="ri-search-line text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="h4 mb-3">
                            <?php esc_html_e('No se encontraron resultados', 'ui-panel-saas'); ?>
                        </h3>
                        <p class="text-muted">
                            <?php esc_html_e('Lo sentimos, pero no se encontraron resultados para tu búsqueda. Por favor, intenta con diferentes palabras clave.', 'ui-panel-saas'); ?>
                        </p>
                        
                        <div class="search-form mt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <?php get_search_form(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif (is_home() && current_user_can('publish_posts')) : ?>
                    
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="ri-article-line text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="h4 mb-3">
                            <?php esc_html_e('¿Listo para publicar tu primer artículo?', 'ui-panel-saas'); ?>
                        </h3>
                        <p class="text-muted">
                            <?php esc_html_e('Comienza a escribir y compartir tu contenido con el mundo.', 'ui-panel-saas'); ?>
                        </p>
                        
                        <a href="<?php echo esc_url(admin_url('post-new.php')); ?>" class="btn btn-primary mt-2">
                            <i class="ri-add-line me-1"></i>
                            <?php echo esc_html__('Crear nueva entrada', 'ui-panel-saas'); ?>
                        </a>
                    </div>
                    
                <?php else : ?>
                    
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="ri-file-search-line text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="h4 mb-3">
                            <?php esc_html_e('No se encontró contenido', 'ui-panel-saas'); ?>
                        </h3>
                        <p class="text-muted">
                            <?php esc_html_e('Parece que no pudimos encontrar lo que estás buscando. Tal vez la búsqueda pueda ayudar.', 'ui-panel-saas'); ?>
                        </p>
                        
                        <div class="search-form mt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <?php get_search_form(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php endif; ?>
            </div><!-- .page-content -->
        </div>
    </div>
</section><!-- .no-results -->
