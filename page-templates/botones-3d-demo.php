<?php
/**
 * Template Name: Demostración de Botones 3D
 * 
 * Plantilla para mostrar todos los estilos de botones 3D disponibles en el tema.
 * 
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

get_header();
?>

<div class="page-content">
    <div class="page-container">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo esc_html(get_the_title()); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Esta página muestra los diferentes estilos de botones 3D disponibles en el tema UI Panel SAAS.</p>
                        
                        <h5 class="mt-4 mb-3">Botones 3D Básicos</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="btn-3d-wrapper primary mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Primario</span>
                                        <i class="ti ti-arrow-right btn-3d-icon"></i>
                                    </a>
                                </div>
                                
                                <div class="btn-3d-wrapper secondary mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Secundario</span>
                                        <i class="ti ti-plus btn-3d-icon"></i>
                                    </a>
                                </div>
                                
                                <div class="btn-3d-wrapper success mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Success</span>
                                        <i class="ti ti-check btn-3d-icon"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-3d-wrapper info mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Info</span>
                                        <i class="ti ti-info-circle btn-3d-icon"></i>
                                    </a>
                                </div>
                                
                                <div class="btn-3d-wrapper warning mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Warning</span>
                                        <i class="ti ti-alert-triangle btn-3d-icon"></i>
                                    </a>
                                </div>
                                
                                <div class="btn-3d-wrapper danger mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Danger</span>
                                        <i class="ti ti-trash btn-3d-icon"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <h5 class="mt-4 mb-3">Botones 3D de Diferentes Tamaños</h5>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="btn-3d-wrapper primary btn-sm mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Pequeño</span>
                                    </a>
                                </div>
                                
                                <div class="btn-3d-wrapper primary mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Normal</span>
                                    </a>
                                </div>
                                
                                <div class="btn-3d-wrapper primary btn-lg mb-4">
                                    <div class="btn-3d-back"></div>
                                    <a href="#" class="btn-3d">
                                        <span class="btn-3d-text">Botón Grande</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <h5 class="mt-4 mb-3">Uso con Shortcode</h5>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <?php echo do_shortcode('[ui_panel_button_3d color="primary" icon="ti-rocket"]Botón con Shortcode[/ui_panel_button_3d]'); ?>
                                
                                <?php echo do_shortcode('[ui_panel_button_3d color="success" icon="ti-check" size="lg"]Botón Grande[/ui_panel_button_3d]'); ?>
                                
                                <?php echo do_shortcode('[ui_panel_button_3d color="danger" icon="ti-x" size="sm"]Botón Pequeño[/ui_panel_button_3d]'); ?>
                            </div>
                        </div>
                        
                        <h5 class="mt-4 mb-3">Comparación con Botones Normales</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="mb-2">Botones Bootstrap Originales</h6>
                                <button class="btn btn-primary mb-3 me-2">Botón Primary</button>
                                <button class="btn btn-secondary mb-3 me-2">Botón Secondary</button>
                                <button class="btn btn-success mb-3 me-2">Botón Success</button>
                                <button class="btn btn-danger mb-3 me-2">Botón Danger</button>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-2">Botones con Efecto 3D Aplicado</h6>
                                <div class="btn-3d-wrapper primary me-2" style="display: inline-block;">
                                    <div class="btn-3d-back"></div>
                                    <button class="btn-3d">Botón Primary</button>
                                </div>
                                <div class="btn-3d-wrapper secondary me-2" style="display: inline-block;">
                                    <div class="btn-3d-back"></div>
                                    <button class="btn-3d">Botón Secondary</button>
                                </div>
                                <div class="btn-3d-wrapper success me-2" style="display: inline-block;">
                                    <div class="btn-3d-back"></div>
                                    <button class="btn-3d">Botón Success</button>
                                </div>
                                <div class="btn-3d-wrapper danger me-2" style="display: inline-block;">
                                    <div class="btn-3d-back"></div>
                                    <button class="btn-3d">Botón Danger</button>
                                </div>
                            </div>
                        </div>
                        
                        <h5 class="mt-4 mb-3">Ejemplos de Uso en Formularios</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <form action="#" method="post" class="mb-4">
                                    <div class="mb-3">
                                        <label for="exampleInput1" class="form-label">Campo de Texto</label>
                                        <input type="text" class="form-control" id="exampleInput1" placeholder="Escribe algo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleSelect1" class="form-label">Selecciona una opción</label>
                                        <select class="form-select" id="exampleSelect1">
                                            <option selected>Selecciona una opción</option>
                                            <option value="1">Opción 1</option>
                                            <option value="2">Opción 2</option>
                                            <option value="3">Opción 3</option>
                                        </select>
                                    </div>
                                    <div class="btn-3d-wrapper primary">
                                        <div class="btn-3d-back"></div>
                                        <button type="submit" class="btn-3d">
                                            <span class="btn-3d-text">Enviar Formulario</span>
                                            <i class="ti ti-send btn-3d-icon"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title">Tarjeta de Ejemplo</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Este es un ejemplo de tarjeta con botones 3D en acciones.</p>
                                        <div class="d-flex justify-content-end">
                                            <div class="btn-3d-wrapper danger me-2">
                                                <div class="btn-3d-back"></div>
                                                <button class="btn-3d">
                                                    <span class="btn-3d-text">Cancelar</span>
                                                </button>
                                            </div>
                                            <div class="btn-3d-wrapper success">
                                                <div class="btn-3d-back"></div>
                                                <button class="btn-3d">
                                                    <span class="btn-3d-text">Guardar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <h5 class="mt-4 mb-3">Menú Lateral con Efecto 3D</h5>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Visualización de Menú</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="side-nav p-0">
                                            <li class="side-nav-item">
                                                <a href="#" class="side-nav-link active">
                                                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                                                    <span class="menu-text">Dashboard</span>
                                                </a>
                                            </li>
                                            <li class="side-nav-item">
                                                <a href="#" class="side-nav-link">
                                                    <span class="menu-icon"><i class="ti ti-user"></i></span>
                                                    <span class="menu-text">Usuarios</span>
                                                </a>
                                            </li>
                                            <li class="side-nav-item">
                                                <a href="#" class="side-nav-link">
                                                    <span class="menu-icon"><i class="ti ti-settings"></i></span>
                                                    <span class="menu-text">Configuración</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <p>Los enlaces del menú lateral también tienen un efecto 3D sutil cuando pasas el ratón sobre ellos. Este efecto es menos pronunciado para mantener la usabilidad, pero mantiene la coherencia con el resto de la interfaz.</p>
                                <p>Cuando se aplica la clase <code>apply-3d-effect</code> al <code>body</code>, todos los elementos <code>.side-nav-link</code> reciben automáticamente el efecto 3D al pasar el ratón por encima.</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <h5><i class="ti ti-info-circle me-2"></i>Nota de Implementación</h5>
                                    <p class="mb-0">Para implementar los botones 3D en todo el tema, simplemente se ha añadido la clase <code>apply-3d-effect</code> al elemento <code>body</code>. Esto permite que todos los botones estándar de Bootstrap y WordPress muestren el efecto 3D automáticamente.</p>
                                    <p class="mb-0 mt-2">Si prefieres crear botones 3D individualmente, puedes usar el marcado HTML directo o el shortcode <code>[ui_panel_button_3d]</code>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php
get_footer();
?>
