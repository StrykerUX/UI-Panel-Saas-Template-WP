<?php
/**
 * Template Name: Dashboard
 *
 * Plantilla para mostrar una página tipo dashboard con widgets y estadísticas
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

get_header();
get_sidebar();
?>

<main id="primary" class="content-body">
    <div class="container-fluid">
        
        <?php
        // Obtener el título de la página y breadcrumbs
        if (function_exists('ui_panel_saas_page_title')) {
            ui_panel_saas_page_title();
        } else {
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo '<div class="page-title-box">';
            echo '<h4 class="page-title">' . esc_html(get_the_title()) . '</h4>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>

        <!-- Stats Widgets -->
        <div class="row">
            <!-- Widget: Total Orders -->
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-shopping-cart-2-line widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Orders">
                            <?php echo esc_html__('Pedidos totales', 'ui-panel-saas'); ?>
                        </h5>
                        <h3 class="mt-3 mb-3">
                            <?php
                            // Si WooCommerce está activo, mostrar el número real de pedidos
                            if (class_exists('WooCommerce')) {
                                $total_orders = wc_get_orders(array(
                                    'limit' => -1,
                                    'return' => 'ids',
                                ));
                                echo esc_html(count($total_orders));
                            } else {
                                echo '687.3k';
                            }
                            ?>
                        </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2">
                                <i class="ri-arrow-down-line"></i> 9.19%
                            </span>
                            <span class="text-nowrap">
                                <?php echo esc_html__('Desde el mes pasado', 'ui-panel-saas'); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Widget: Total Returns -->
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-arrow-go-back-line widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Returns">
                            <?php echo esc_html__('Devoluciones', 'ui-panel-saas'); ?>
                        </h5>
                        <h3 class="mt-3 mb-3">
                            <?php
                            // Si WooCommerce está activo, mostrar el número real de devoluciones
                            if (class_exists('WooCommerce') && function_exists('wc_get_order_statuses')) {
                                $total_refunds = wc_get_orders(array(
                                    'limit' => -1,
                                    'return' => 'ids',
                                    'status' => 'wc-refunded',
                                ));
                                echo esc_html(count($total_refunds));
                            } else {
                                echo '9.62k';
                            }
                            ?>
                        </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2">
                                <i class="ri-arrow-up-line"></i> 26.87%
                            </span>
                            <span class="text-nowrap">
                                <?php echo esc_html__('Desde el mes pasado', 'ui-panel-saas'); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Widget: Average Sale -->
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-currency-line widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Average Sale">
                            <?php echo esc_html__('Venta promedio', 'ui-panel-saas'); ?>
                        </h5>
                        <h3 class="mt-3 mb-3">
                            <?php
                            // Si WooCommerce está activo, calcular el promedio de venta
                            if (class_exists('WooCommerce')) {
                                global $wpdb;
                                $average_sale = $wpdb->get_var("
                                    SELECT AVG(meta_value) 
                                    FROM $wpdb->postmeta 
                                    WHERE meta_key = '_order_total' 
                                    AND post_id IN (
                                        SELECT ID FROM $wpdb->posts 
                                        WHERE post_type = 'shop_order' 
                                        AND post_status IN ('wc-completed', 'wc-processing')
                                    )
                                ");
                                echo wc_price($average_sale ? $average_sale : 0);
                            } else {
                                echo '$98.24 <small>USD</small>';
                            }
                            ?>
                        </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2">
                                <i class="ri-arrow-up-line"></i> 3.51%
                            </span>
                            <span class="text-nowrap">
                                <?php echo esc_html__('Desde el mes pasado', 'ui-panel-saas'); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Widget: Number of Visits -->
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-eye-line widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="Number of Visits">
                            <?php echo esc_html__('Número de visitas', 'ui-panel-saas'); ?>
                        </h5>
                        <h3 class="mt-3 mb-3">
                            <?php
                            // Si está activado algún plugin de estadísticas, mostrar datos reales
                            if (function_exists('stats_get_csv') || function_exists('ga_get_analytics_view_id')) {
                                // Implementar la lógica para obtener datos de Jetpack Stats o Google Analytics
                                echo esc_html('12.45k');
                            } else {
                                echo '87.94M';
                            }
                            ?>
                        </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2">
                                <i class="ri-arrow-down-line"></i> 1.05%
                            </span>
                            <span class="text-nowrap">
                                <?php echo esc_html__('Desde el mes pasado', 'ui-panel-saas'); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Stats Widgets -->

        <!-- Charts and Activity -->
        <div class="row">
            <!-- Traffic Sources -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Actualizar datos', 'ui-panel-saas'); ?></a>
                                <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Exportar reporte', 'ui-panel-saas'); ?></a>
                            </div>
                        </div>
                        <h4 class="header-title mb-3"><?php echo esc_html__('Fuentes de tráfico', 'ui-panel-saas'); ?></h4>

                        <div class="chart-container" style="height: 280px;">
                            <div id="traffic-sources-chart" class="apex-charts" data-colors="#3e60d5,#47ad77,#fa5c7c"></div>
                        </div>

                        <div class="chart-widget-list mt-3">
                            <div class="row">
                                <div class="col">
                                    <p>
                                        <i class="mdi mdi-square text-primary"></i> <?php echo esc_html__('Directo', 'ui-panel-saas'); ?>
                                        <span class="float-end">65%</span>
                                    </p>
                                </div>
                                <div class="col">
                                    <p>
                                        <i class="mdi mdi-square text-success"></i> <?php echo esc_html__('Social', 'ui-panel-saas'); ?>
                                        <span class="float-end">25%</span>
                                    </p>
                                </div>
                                <div class="col">
                                    <p>
                                        <i class="mdi mdi-square text-danger"></i> <?php echo esc_html__('Afiliados', 'ui-panel-saas'); ?>
                                        <span class="float-end">10%</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Chart -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Actualizar datos', 'ui-panel-saas'); ?></a>
                                <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Exportar reporte', 'ui-panel-saas'); ?></a>
                            </div>
                        </div>
                        <h4 class="header-title mb-3"><?php echo esc_html__('Resumen financiero', 'ui-panel-saas'); ?></h4>

                        <div class="mt-3 mb-4 chartjs-chart">
                            <div id="revenue-chart" class="apex-charts" data-colors="#3e60d5,#47ad77,#fa5c7c,#ffbc00"></div>
                        </div>

                        <div class="row text-center">
                            <div class="col-md-3">
                                <span class="d-block text-primary">
                                    <i class="ri-money-dollar-circle-line fs-22"></i>
                                </span>
                                <h4 class="mt-1"><span>$29.5k</span></h4>
                                <p class="text-muted mb-0"><?php echo esc_html__('Ingresos', 'ui-panel-saas'); ?></p>
                            </div>
                            <div class="col-md-3">
                                <span class="d-block text-danger">
                                    <i class="ri-store-2-line fs-22"></i>
                                </span>
                                <h4 class="mt-1"><span>$15.07k</span></h4>
                                <p class="text-muted mb-0"><?php echo esc_html__('Gastos', 'ui-panel-saas'); ?></p>
                            </div>
                            <div class="col-md-3">
                                <span class="d-block text-success">
                                    <i class="ri-bank-line fs-22"></i>
                                </span>
                                <h4 class="mt-1"><span>$3.6k</span></h4>
                                <p class="text-muted mb-0"><?php echo esc_html__('Inversión', 'ui-panel-saas'); ?></p>
                            </div>
                            <div class="col-md-3">
                                <span class="d-block text-warning">
                                    <i class="ri-wallet-3-line fs-22"></i>
                                </span>
                                <h4 class="mt-1"><span>$6.9k</span></h4>
                                <p class="text-muted mb-0"><?php echo esc_html__('Ahorros', 'ui-panel-saas'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Charts and Activity -->

        <!-- Recent Orders and Brands -->
        <div class="row">
            <!-- Recent Orders -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="header-title"><?php echo esc_html__('Pedidos recientes', 'ui-panel-saas'); ?></h4>
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary">
                                <i class="ri-add-line"></i>
                            </a>
                        </div>

                        <div class="inbox-widget">
                            <?php
                            // Si WooCommerce está activo, mostrar pedidos recientes
                            if (class_exists('WooCommerce')) {
                                $args = array(
                                    'limit' => 5,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'status' => array('completed', 'processing', 'on-hold'),
                                );
                                $orders = wc_get_orders($args);
                                
                                if (!empty($orders)) {
                                    foreach ($orders as $order) {
                                        $items = $order->get_items();
                                        $first_item = reset($items);
                                        if ($first_item) {
                                            $product = $first_item->get_product();
                                            $product_name = $first_item->get_name();
                                            $thumbnail = $product ? $product->get_image('thumbnail', array('class' => 'rounded-circle img-fluid')) : '';
                                            $order_status = $order->get_status();
                                            
                                            echo '<div class="inbox-item mb-3">';
                                            echo '<div class="inbox-item-img">' . $thumbnail . '</div>';
                                            echo '<div class="inbox-item-details">';
                                            echo '<p class="inbox-item-name">' . esc_html($product_name) . '</p>';
                                            echo '<p class="inbox-item-text">' . wc_price($order->get_total()) . ' - ' . esc_html(wc_get_order_status_name($order_status)) . '</p>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                } else {
                                    echo '<p>' . esc_html__('No hay pedidos recientes', 'ui-panel-saas') . '</p>';
                                }
                            } else {
                                // Mostrar datos de ejemplo
                                $example_orders = array(
                                    array(
                                        'name' => 'Marco Shoes',
                                        'price' => '$29.99 x 1',
                                        'status' => 'Sold'
                                    ),
                                    array(
                                        'name' => 'High Waist Tshirt',
                                        'price' => '$9.99 x 3',
                                        'status' => 'Sold'
                                    ),
                                    array(
                                        'name' => 'Comfirt Chair',
                                        'price' => '$49.99 x 1',
                                        'status' => 'Return'
                                    ),
                                    array(
                                        'name' => 'Smart Headphone',
                                        'price' => '$39.99 x 1',
                                        'status' => 'Sold'
                                    ),
                                    array(
                                        'name' => 'Laptop Bag',
                                        'price' => '$12.99 x 4',
                                        'status' => 'Sold'
                                    ),
                                );
                                
                                foreach ($example_orders as $order) {
                                    $status_class = $order['status'] === 'Sold' ? 'text-success' : 'text-danger';
                                    
                                    echo '<div class="inbox-item mb-3">';
                                    echo '<div class="inbox-item-img">';
                                    echo '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/products/product-placeholder.jpg" class="rounded-circle img-fluid">';
                                    echo '</div>';
                                    echo '<div class="inbox-item-details">';
                                    echo '<p class="inbox-item-name">' . esc_html($order['name']) . '</p>';
                                    echo '<p class="inbox-item-text">' . esc_html($order['price']) . ' - <span class="' . esc_attr($status_class) . '">' . esc_html($order['status']) . '</span></p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                            ?>
                            
                            <div class="text-center mt-2">
                                <a href="javascript:void(0);" class="text-muted">
                                    <i class="ri-arrow-down-line me-1"></i> <?php echo esc_html__('Ver todos', 'ui-panel-saas'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Brands Listing -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="header-title"><?php echo esc_html__('Listado de marcas', 'ui-panel-saas'); ?></h4>
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary">
                                <i class="ri-add-line"></i> <?php echo esc_html__('Añadir marca', 'ui-panel-saas'); ?>
                            </a>
                        </div>
                        
                        <p class="text-muted fs-14">
                            <?php echo esc_html__('69 marcas activas de 102', 'ui-panel-saas'); ?>
                        </p>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo esc_html__('Marca', 'ui-panel-saas'); ?></th>
                                        <th scope="col"><?php echo esc_html__('Establecido', 'ui-panel-saas'); ?></th>
                                        <th scope="col"><?php echo esc_html__('Tiendas', 'ui-panel-saas'); ?></th>
                                        <th scope="col"><?php echo esc_html__('Productos', 'ui-panel-saas'); ?></th>
                                        <th scope="col"><?php echo esc_html__('Estado', 'ui-panel-saas'); ?></th>
                                        <th scope="col" style="width: 10%;"><?php echo esc_html__('Acción', 'ui-panel-saas'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Datos de ejemplo para marcas
                                    $brands = array(
                                        array(
                                            'name' => 'Zaraon - Brazil',
                                            'year' => '2020',
                                            'stores' => '1.5k',
                                            'products' => '8,950',
                                            'status' => 'Active'
                                        ),
                                        array(
                                            'name' => 'Ninetheme - USA',
                                            'year' => '2018',
                                            'stores' => '2.3k',
                                            'products' => '12,650',
                                            'status' => 'Active'
                                        ),
                                        array(
                                            'name' => 'Whisis - Spain',
                                            'year' => '2022',
                                            'stores' => '650',
                                            'products' => '3,245',
                                            'status' => 'Inactive'
                                        ),
                                        array(
                                            'name' => 'Alimama - China',
                                            'year' => '2019',
                                            'stores' => '3.7k',
                                            'products' => '17,230',
                                            'status' => 'Active'
                                        ),
                                        array(
                                            'name' => 'Barrins - UK',
                                            'year' => '2021',
                                            'stores' => '920',
                                            'products' => '5,830',
                                            'status' => 'Active'
                                        ),
                                    );
                                    
                                    foreach ($brands as $brand) {
                                        $status_class = $brand['status'] === 'Active' ? 'badge bg-success' : 'badge bg-danger';
                                        
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<div class="d-flex align-items-center">';
                                        echo '<div class="flex-shrink-0">';
                                        echo '<div class="avatar-xs bg-light rounded p-1">';
                                        echo '<span>';
                                        $brand_letters = ui_panel_saas_get_initials($brand['name']);
                                        $brand_color = ui_panel_saas_generate_color($brand['name']);
                                        echo '<span style="background-color: ' . esc_attr($brand_color) . '; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #fff;">' . esc_html($brand_letters) . '</span>';
                                        echo '</span>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<div class="flex-grow-1 ms-2">';
                                        echo '<h5 class="mb-0 fs-14">' . esc_html($brand['name']) . '</h5>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</td>';
                                        echo '<td>Since ' . esc_html($brand['year']) . '</td>';
                                        echo '<td>' . esc_html($brand['stores']) . '</td>';
                                        echo '<td>' . esc_html($brand['products']) . '</td>';
                                        echo '<td><span class="' . esc_attr($status_class) . '">' . esc_html($brand['status']) . '</span></td>';
                                        echo '<td><a href="javascript:void(0);" class="text-reset fs-16 px-1"><i class="ri-edit-line"></i></a><a href="javascript:void(0);" class="text-reset fs-16 px-1"><i class="ri-delete-bin-line"></i></a></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-2">
                            <a href="javascript:void(0);" class="text-muted">
                                <i class="ri-arrow-down-line me-1"></i> <?php echo esc_html__('Ver todos', 'ui-panel-saas'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Recent Orders and Brands -->

        <!-- Dashboard Widgets Area -->
        <?php if (is_active_sidebar('dashboard')) : ?>
        <div class="row">
            <div class="col-12">
                <div id="dashboard-widgets-area">
                    <?php dynamic_sidebar('dashboard'); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- End Dashboard Widgets Area -->

    </div>
</main><!-- #main -->

<?php
// Agregar script para los gráficos
$dashboard_charts_js = "
    jQuery(document).ready(function($) {
        if (typeof ApexCharts !== 'undefined') {
            // Traffic Sources Chart
            var trafficOptions = {
                chart: {
                    height: 280,
                    type: 'donut',
                },
                series: [65, 25, 10],
                labels: ['" . esc_js(__('Directo', 'ui-panel-saas')) . "', '" . esc_js(__('Social', 'ui-panel-saas')) . "', '" . esc_js(__('Afiliados', 'ui-panel-saas')) . "'],
                colors: ['#4F46E5', '#10B981', '#EF4444'],
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                }
            };
            
            var trafficChart = new ApexCharts(document.querySelector('#traffic-sources-chart'), trafficOptions);
            trafficChart.render();
            
            // Revenue Chart
            var revenueOptions = {
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: '" . esc_js(__('Ingresos', 'ui-panel-saas')) . "',
                    type: 'column',
                    data: [23, 32, 27, 38, 27, 32, 27, 38, 22, 31, 21, 16]
                }, {
                    name: '" . esc_js(__('Gastos', 'ui-panel-saas')) . "',
                    type: 'line',
                    data: [23, 32, 27, 38, 27, 32, 27, 38, 22, 31, 21, 16]
                }],
                stroke: {
                    width: [0, 3]
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%'
                    }
                },
                colors: ['#d0d7fc', '#4F46E5'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                },
                yaxis: [{
                    title: {
                        text: '" . esc_js(__('Ingresos', 'ui-panel-saas')) . "',
                    },
                }, {
                    opposite: true,
                    title: {
                        text: '" . esc_js(__('Gastos', 'ui-panel-saas')) . "',
                    }
                }],
                markers: {
                    size: 5
                },
                grid: {
                    borderColor: '#f1f1f1',
                }
            };
            
            var revenueChart = new ApexCharts(document.querySelector('#revenue-chart'), revenueOptions);
            revenueChart.render();
        }
    });
";

// Agregar el script al footer
wp_add_inline_script('ui-panel-saas-main', $dashboard_charts_js);

get_footer();
