<?php
/**
 * Template Name: Ejemplo Botón 3D
 * 
 * Plantilla que muestra el botón 3D exactamente como en el ejemplo.
 * 
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

get_header();
?>

<div class="page-content">
    <div class="page-container">
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Botón 3D - Tal como en el ejemplo</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-4">Ejemplo de botón 3D</h5>
                        
                        <div class="mb-5">
                            <div class="btn-wrapper">
                                <div class="btn-back"></div>
                                <a href="#" class="btn">
                                    <span class="btn-text">Add Brand</span>
                                    <span class="btn-icon">+</span>
                                </a>
                            </div>
                        </div>
                        
                        <h5 class="mt-5 mb-4">Explicación</h5>
                        <p>Este es un ejemplo del botón 3D que utiliza exactamente la estructura HTML y CSS del ejemplo proporcionado:</p>
                        
                        <div class="bg-light p-3 mb-4 rounded">
                            <h6>HTML</h6>
<pre><code>&lt;div class="btn-wrapper"&gt;
    &lt;div class="btn-back"&gt;&lt;/div&gt;
    &lt;a href="#" class="btn"&gt;
        &lt;span class="btn-text"&gt;Add Brand&lt;/span&gt;
        &lt;span class="btn-icon"&gt;+&lt;/span&gt;
    &lt;/a&gt;
&lt;/div&gt;</code></pre>
                        </div>
                        
                        <div class="bg-light p-3 mb-4 rounded">
                            <h6>CSS (Variables)</h6>
<pre><code>:root {
    --offset: 4px;
    --hover-offset: 3px;
    --border-radius: 4px;
    --front-bg-color: #2c2c2c;
    --front-text-color: white;
    --front-border-color: transparent;
    --back-bg-color: transparent;
    --back-border-color: #000000;
}</code></pre>
                        </div>
                        
                        <div class="bg-light p-3 mb-4 rounded">
                            <h6>CSS (Estilos)</h6>
<pre><code>/* Contenedor principal */
.btn-wrapper {
    position: relative;
    display: inline-block;
}

/* Contenedor trasero */
.btn-back {
    position: absolute;
    top: var(--offset);
    left: var(--offset);
    width: 100%;
    height: 100%;
    background-color: var(--back-bg-color);
    border: 1px solid var(--back-border-color);
    border-radius: var(--border-radius);
    z-index: 1;
    box-sizing: border-box;
}

/* Botón frontal */
.btn {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    color: var(--front-text-color);
    background-color: var(--front-bg-color);
    border: 1px solid var(--front-border-color);
    border-radius: var(--border-radius);
    cursor: pointer;
    position: relative;
    z-index: 2;
    text-decoration: none;
    transition: transform 0.1s ease-out;
}

/* Texto e icono */
.btn-text {
    margin-right: auto;
}

.btn-icon {
    color: var(--front-text-color);
    margin-left: 4px;
}

/* Efectos hover y active */
.btn-wrapper:hover .btn {
    transform: translate(var(--hover-offset), var(--hover-offset));
}

.btn-wrapper:active .btn {
    transform: translate(var(--offset), var(--offset));
}</code></pre>
                        </div>
                        
                        <div class="alert alert-info">
                            <h6><i class="ti ti-info-circle me-2"></i>Comportamiento</h6>
                            <p class="mb-0">Al pasar el cursor sobre el botón (hover), este se desplazará hacia abajo y a la derecha según el valor de <code>--hover-offset</code>, mostrando parte del fondo. Al hacer clic (active), se desplazará completamente según el valor de <code>--offset</code>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<style>
/* Estilos locales para esta página de demostración */
.page-content .btn-wrapper {
    position: relative;
    display: inline-block;
}

.page-content .btn-back {
    position: absolute;
    top: 4px;
    left: 4px;
    width: 100%;
    height: 100%;
    background-color: transparent;
    border: 1px solid #000000;
    border-radius: 4px;
    z-index: 1;
    box-sizing: border-box;
}

.page-content .btn {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    color: white;
    background-color: #2c2c2c;
    border: 1px solid transparent;
    border-radius: 4px;
    cursor: pointer;
    position: relative;
    z-index: 2;
    text-decoration: none;
    transition: transform 0.1s ease-out;
}

.page-content .btn-text {
    margin-right: auto;
}

.page-content .btn-icon {
    color: white;
    margin-left: 4px;
}

.page-content .btn-wrapper:hover .btn {
    transform: translate(3px, 3px);
}

.page-content .btn-wrapper:active .btn {
    transform: translate(4px, 4px);
}
</style>

<?php
get_footer();
?>
